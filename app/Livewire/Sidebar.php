<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Livewire\Attributes\On;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class Sidebar extends Component
{
    public $dataSideBar;
    public $id_jabatan;

    public function mount()
    {
        $this->id_jabatan = session('id_jabatan');
        // $this->dataSideBar = DB::table('data_unor')->where('id_jabatan', $this->id_jabatan)->orderBy('urutan')->select('*')->get()->toArray()[0];
        $this->dataSideBar = DB::table('data_unor')->where('id_jabatan', $this->id_jabatan)->orderBy('urutan', 'asc')->select('*')->get()->toArray()[0];
    }
    #[On('setActiveJabatan')]
    public function setActiveJabatan($id_jabatan)
    {
        $this->id_jabatan = $id_jabatan;
        session()->put("activeIdJabatan", $id_jabatan);
    }

    public function refresh()
    {
        $this->id_jabatan = session('id_jabatan');
        $this->dataSideBar = DB::table('data_unor')->where('id_jabatan', $this->id_jabatan)->select('*')->get()->toArray()[0];

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil direfresh.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();
    }
    public function render()
    {
        return view('livewire.sidebar');
    }
}
