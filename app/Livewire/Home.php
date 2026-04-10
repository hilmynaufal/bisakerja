<?php

namespace App\Livewire;

use Illuminate\Http\Client\Request;
use Livewire\Component;
use DB;
use Livewire\Attributes\On;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Home extends Component
{
    public $activeJabatanId = "A8ACA73D811D3912E040640A040269BB";
    public $activePage = 'data-unor'; // Default tampilan

    public $availableIdJabatan;

    public $nama;
    public $jabatan;
    public $user_id_jabatan;

    public $showChangePassword = false;
    public $old_password;
    public $new_password;
    public $new_password_confirmation;

    #[On('setActiveJabatan')]
    public function setActiveJabatan($id_jabatan)
    {
        $this->reset(['activeJabatanId']);
        if ($this->nama === "Viewer") {
            $this->setActivePage('resume');
        } else {
            $this->setActivePage('data-unor');
        }
        $this->activeJabatanId = $id_jabatan;

    }

    public function setShowChangePassword($bool) {
        $this->showChangePassword = $bool;

    }

    #[On('saveActivePage')]
    public function setActivePage($page)
    {
        $this->reset('activePage');
        $this->activePage = $page;
    }

    public function render()
    {
        // dd($this->user_id_jabatan);

        return view('livewire.home');
    }

    public function mount() {
        // $this->availableIdJabatan = $request->session("id_jabatan");
        // $this->nama = $request->session("nama");
        // $this->jabatan = $request->session("jabatan");

        // $this->availableIdJabatan = session()->get("id_jabatan");
        // $this->nama = session()->get("nama");
        // $this->jabatan = session()->get("jabatan");

        $this->user_id_jabatan = session('id_jabatan');

        $this->availableIdJabatan = session("id_jabatan");
        $this->nama = session("nama");
        $this->jabatan = session("jabatan");
        $this->activeJabatanId = $this->availableIdJabatan;
        if ($this->nama === "Viewer") {
            $this->activePage = 'resume';
        }
    }

    public function logout()
    {
        session()->flush(); // Menghapus semua data sesi
        return redirect()->to('/login'); // Mengarahkan ke halaman login
    }

    public function changePassword()
    {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.'
        ]);

        $user = DB::table('user')->where('id_jabatan', $this->user_id_jabatan)->first();
        if (!$user  || $this->old_password != $user->password) {
            $this->addError('old_password', 'Password lama salah.');
            return;
        }
        DB::table('user')->where('id_jabatan', $this->user_id_jabatan)->update([
            'password' => $this->new_password
        ]);
        $this->reset(['showChangePassword', 'old_password', 'new_password', 'new_password_confirmation']);
        LivewireAlert::title('Berhasil!')
            ->text('Password berhasil diganti!')
            ->success()
            ->toast()
            ->position('top-end')
            ->show();
    }
}
