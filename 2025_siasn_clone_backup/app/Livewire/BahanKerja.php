<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class BahanKerja extends Component
{
    public $activeJabatanId;
    public $dataBahanKerja;
    public $uraian_bahan_kerja;
    public $penggunaan;
    public function render()
    {
        return view('livewire.bahan-kerja');
    }

    public function getBahanKerja()
    {
        $array = DB::table('bahan_kerja')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataBahanKerja']);

        if (!empty($array)) {
            $this->dataBahanKerja = $array;
        }
    }

    public function insertBahanKerja()
    {

        DB::table('bahan_kerja')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'uraian_bahan_kerja' => $this->uraian_bahan_kerja,
            'penggunaan' => $this->penggunaan,
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataBahanKerja dan $activeJabatanId
        $this->reset(['uraian_bahan_kerja', 'penggunaan']);

        session()->flash('message', 'Bahan Kerja berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data bahan kerja
        $this->getBahanKerja();
    }

    public function hapusBahanKerja($id)
    {
        DB::table('bahan_kerja')->where('id', $id)->delete();

        session()->flash('message', 'Bahan Kerja berhasil dihapus!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil dihapus.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data bahan kerja
        $this->getBahanKerja();
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('bahan_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataBahanKerja = $array;
    }
}
