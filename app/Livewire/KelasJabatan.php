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

        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Mengubah Kelas Jabatan Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);


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
