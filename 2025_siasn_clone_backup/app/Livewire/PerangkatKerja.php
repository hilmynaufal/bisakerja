<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class PerangkatKerja extends Component
{

    public $activeJabatanId;
    public $dataPerangkatKerja;
    public $uraian_perangkat_kerja;
    public $penggunaan;
  
    public function getPerangkatKerja()
    {
        $array = DB::table('perangkat_kerja')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataPerangkatKerja']);

        if (!empty($array)) {
            $this->dataPerangkatKerja = $array;
        }
    }

    public function insertPerangkatKerja()
    {

        DB::table('perangkat_kerja')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'uraian_perangkat_kerja' => $this->uraian_perangkat_kerja,
            'penggunaan' => $this->penggunaan,
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataPerangkatKerja dan $activeJabatanId
        $this->reset(['uraian_perangkat_kerja', 'penggunaan']);

        session()->flash('message', 'Perangkat Kerja berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data perangkat kerja
        $this->getPerangkatKerja();
    }

    public function hapusPerangkatKerja($id)
    {
        DB::table('perangkat_kerja')->where('id', $id)->delete();

        session()->flash('message', 'Perangkat Kerja berhasil dihapus!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil dihapus.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data perangkat kerja
        $this->getPerangkatKerja();
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('perangkat_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataPerangkatKerja = $array;
    }
    public function render()
    {
        return view('livewire.perangkat-kerja');
    }
}
