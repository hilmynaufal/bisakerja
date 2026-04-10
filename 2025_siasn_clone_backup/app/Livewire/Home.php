<?php

namespace App\Livewire;

use Illuminate\Http\Client\Request;
use Livewire\Component;
use DB;
use Livewire\Attributes\On;

class Home extends Component
{
    public $activeJabatanId = "A8ACA73D811D3912E040640A040269BB";
    public $activePage = 'data-unor'; // Default tampilan

    public $availableIdJabatan;

    public $nama;
    public $jabatan;


    #[On('setActiveJabatan')]
    public function setActiveJabatan($id_jabatan)
    {
        $this->reset(['activeJabatanId']);
        $this->setActivePage('data-unor');
        $this->activeJabatanId = $id_jabatan;
    }

    #[On('saveActivePage')]
    public function setActivePage($page)
    {
        $this->reset('activePage');
        $this->activePage = $page;
    }

    public function render()
    {
        

        return view('livewire.home');
    }

    public function mount() {
        // $this->availableIdJabatan = $request->session("id_jabatan");
        // $this->nama = $request->session("nama");
        // $this->jabatan = $request->session("jabatan");

        // $this->availableIdJabatan = session()->get("id_jabatan");
        // $this->nama = session()->get("nama");
        // $this->jabatan = session()->get("jabatan");

        $this->availableIdJabatan = session("id_jabatan");
        $this->nama = session("nama");
        $this->jabatan = session("jabatan");
        $this->activeJabatanId = $this->availableIdJabatan;

        // session()->put('jabatan', "uhuy");
    }

    public function logout()
    {
        session()->flush(); // Menghapus semua data sesi
        return redirect()->to('/login'); // Mengarahkan ke halaman login
    }
}
