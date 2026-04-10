<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class KelolaUser extends Component
{
    use WithPagination;

    public $users;
    public $name;
    public $email;
    public $password;
    public $username;
    public $searchJabatan = '';
    public $searchJabatanResults = [];
    public $id_jabatan;
    public $jabatan;
    public $perPage = 10;
    public $page = 1;
    public $total;
    public $lastPage;
    public $search = '';
    public $editMode = false;
    public $editUserId;

    protected $queryString = ['page', 'perPage', 'search'];

    public function mount()
    {
        $this->getUsers();
    }

    public function getUsers()
    {
        $query = DB::table('user')
            ->leftJoin('data_unor', 'user.id_jabatan', '=', 'data_unor.id_jabatan')
            ->select('user.*', 'data_unor.nama_unor as jabatan_nama')
            ->orderBy('user.id', 'asc');

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('user.nama', 'like', '%'.$this->search.'%')
                  ->orWhere('user.username', 'like', '%'.$this->search.'%')
                  ->orWhere('data_unor.nama_unor', 'like', '%'.$this->search.'%');
            });
        }

        $users = $query->paginate($this->perPage, ['*'], 'page', $this->page);
        $this->users = $users->items();
        $this->total = $users->total();
        $this->lastPage = $users->lastPage();
    }

    public function updatedSearchJabatan($value)
    {
        $this->searchJabatanResults = DB::table('data_unor')
            ->where('nama_unor', 'like', '%' . $value . '%')
            ->limit(10)
            ->get();
    }

    public function selectJabatan($id_jabatan, $nama_jabatan)
    {
        $this->id_jabatan = $id_jabatan;
        $this->jabatan = $nama_jabatan;
        $this->searchJabatan = $nama_jabatan;
        $this->searchJabatanResults = [];
    }

    public function addUser()
    {
        // dd("test");

        DB::table('user')->insert([
            'nama' => $this->name,
            'username' => $this->username,
            'password' => $this->password,
            'jabatan' => $this->jabatan,
            'id_jabatan' => $this->id_jabatan,
        ]);

        $this->reset(['name', 'username', 'email', 'password', 'jabatan', 'id_jabatan', 'searchJabatan']);
        $this->getUsers();
        session()->flash('success', 'User berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('User berhasil ditambahkan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();
    }

    public function updatedPage($value)
    {
        $this->page = $value;
        $this->getUsers();
    }

    public function updatedPerPage($value)
    {
        $this->page = 1;
        $this->getUsers();
    }

    public function updatedSearch($value)
    {
        $this->page = 1;
        $this->getUsers();
    }

    public function goToPage($page)
    {
        $this->page = $page;
        $this->getUsers();
    }

    public function editUser($id)
    {
        $user = DB::table('user')->where('id', $id)->first();
        if ($user) {
            $this->editMode = true;
            $this->editUserId = $id;
            $this->name = $user->nama;
            $this->username = $user->username;
            $this->password = $user->password;
            $this->jabatan = $user->jabatan;
            $this->id_jabatan = $user->id_jabatan;
        }
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required',
            'username' => 'required|unique:user,username,' . $this->editUserId,
            'password' => 'required',
            'jabatan' => 'required',
            'id_jabatan' => 'required',
        ]);

        DB::table('user')->where('id', $this->editUserId)->update([
            'nama' => $this->name,
            'username' => $this->username,
            'password' => $this->password,
            'jabatan' => $this->jabatan,
            'id_jabatan' => $this->id_jabatan,
        ]);

        $this->reset(['name', 'username', 'password', 'jabatan', 'id_jabatan', 'editMode', 'editUserId', 'searchJabatan']);
        $this->getUsers();
        LivewireAlert::title('Berhasil!')->text('User berhasil diupdate.')->info()->toast()->position('top-end')->show();
    }

    public function cancelEdit()
    {
        $this->reset(['name', 'username', 'password', 'jabatan', 'id_jabatan', 'editMode', 'editUserId', 'searchJabatan']);
    }

    public function deleteUser($id)
    {
        DB::table('user')->where('id', $id)->delete();
        $this->getUsers();
        LivewireAlert::title('Berhasil!')->text('User berhasil dihapus.')->info()->toast()->position('top-end')->show();
    }

    public function render()
    {
        return view('livewire.kelola-user');
    }
}
