<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class KorelasiJabatan extends Component
{
    public $activeJabatanId;
    public $dataKorelasiJabatan;
    public $unit_kerja;
    public $dalam_hal;
    public function render()
    {
        return view('livewire.korelasi-jabatan');
    }

    public function getKorelasiJabatan()
    {
        $array = DB::table('korelasi_jabatan')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataKorelasiJabatan']);

        if (!empty($array)) {
            $this->dataKorelasiJabatan = $array;
        }
    }

    public function insertKorelasiJabatan()
    {

        DB::table('korelasi_jabatan')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'unit_kerja' => $this->unit_kerja,
            'dalam_hal' => $this->dalam_hal,
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataKorelasiJabatan dan $activeJabatanId
        $this->reset(['unit_kerja', 'dalam_hal']);

        session()->flash('message', 'Korelasi Jabatan berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data korelasi jabatan
        $this->getKorelasiJabatan();
    }

    public function hapusKorelasiJabatan($id)
    {
        DB::table('korelasi_jabatan')->where('id', $id)->delete();

        session()->flash('message', 'Korelasi Jabatan berhasil dihapus!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil dihapus.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data korelasi jabatan
        $this->getKorelasiJabatan();
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('korelasi_jabatan')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataKorelasiJabatan = $array;
    }
}

