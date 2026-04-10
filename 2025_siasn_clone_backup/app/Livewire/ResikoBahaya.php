<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class ResikoBahaya extends Component
{
    public $activeJabatanId;
    public $dataResikoBahaya;
    public $nama_resiko;
    public $penyebab;
    public function render()
    {
        
        return view('livewire.resiko-bahaya');
    }

    public function getResikoBahaya()
    {
        $array = DB::table('resiko_bahaya')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataResikoBahaya']);

        if (!empty($array)) {
            $this->dataResikoBahaya = $array;
        }
    }

    public function insertResikoBahaya()
    {

        DB::table('resiko_bahaya')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'nama_resiko' => $this->nama_resiko,
            'penyebab' => $this->penyebab,
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataResikoBahaya dan $activeJabatanId
        $this->reset(['nama_resiko', 'penyebab']);

        session()->flash('message', 'Resiko Bahaya berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data resiko bahaya
        $this->getResikoBahaya();
    }

    public function hapusResikoBahaya($id)
    {

        DB::table('resiko_bahaya')->where('id', $id)->delete();

        session()->flash('message', 'Resiko Bahaya berhasil dihapus!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil dihapus.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data resiko bahaya
        $this->getResikoBahaya();
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('resiko_bahaya')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataResikoBahaya = $array;
    }


}
