<?php

namespace App\Livewire;

use Livewire\Component;

use DB;
class HasilKerja extends Component
{
    public $activeJabatanId;
    public $dataHasilKerja;
    public function render()
    {
        return view('livewire.info-jabatan.hasil-kerja');
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('tugas_pokok')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataHasilKerja = $array;
    }
}
