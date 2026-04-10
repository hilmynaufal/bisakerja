<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class KondisiLingkunganKerja extends Component
{
    public $activeJabatanId;
    public $dataKondisiLingkunganKerja;
    public $aspek;
    public $faktor;
    public function render()
    {
        return view('livewire.kondisi-lingkungan-kerja');
    }

    public function getKondisiLingkunganKerja()
    {
        $array = DB::table('kondisi_lingkungan_kerja')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataKondisiLingkunganKerja']);

        if (!empty($array)) {
            $this->dataKondisiLingkunganKerja = $array;
        }
    }

    public function insertKondisiLingkunganKerja()
    {

        DB::table('kondisi_lingkungan_kerja')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'aspek' => $this->aspek,
            'faktor' => $this->faktor,
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataKondisiLingkunganKerja dan $activeJabatanId
        $this->reset(['aspek', 'faktor']);

        session()->flash('message', 'Kondisi Lingkungan Kerja berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data kondisi lingkungan kerja
        $this->getKondisiLingkunganKerja();
    }

    public function hapusKondisiLingkunganKerja($id)
    {
        DB::table('kondisi_lingkungan_kerja')->where('id', $id)->delete();

        session()->flash('message', 'Kondisi Lingkungan Kerja berhasil dihapus!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil dihapus.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data kondisi lingkungan kerja
        $this->getKondisiLingkunganKerja();
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('kondisi_lingkungan_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataKondisiLingkunganKerja = $array;
    }
}
