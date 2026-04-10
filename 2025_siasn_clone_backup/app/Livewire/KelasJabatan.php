<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class KelasJabatan extends Component
{
    public $activeJabatanId;
    public $dataKelasJabatan;
    public function render()
    {
        return view('livewire.kelas-jabatan');
    }

    public function changeKelasJabatan($i)
    {
        $this->dataKelasJabatan = $i; // Mengubah nilai dataKelasJabatan

        DB::table('kelas_jabatan')->updateOrInsert(
            ['id_jabatan' => $this->activeJabatanId],
            ['kelas' => $i]
        );


        session()->flash('message', 'Kelas Jabatan berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

    }

    public function mount($activeJabatanId)
    {
        $array = DB::table('kelas_jabatan')->where('id_jabatan', $activeJabatanId)->select('*')->first();

        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        if ($array == null) {
            $this->dataKelasJabatan = null;
        } else {
            $this->dataKelasJabatan = $array->kelas;
        }
    }

}
