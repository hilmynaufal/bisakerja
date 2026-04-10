<?php

namespace App\Livewire;

use Livewire\Component;

class InfoJabatan extends Component
{

    public $activeJabatanId;

    public $activeInfoJabatanPage = 'data-jabatan';
    
    public function render()
    {
        return view('livewire.info-jabatan.info-jabatan');
    }

    public function setActiveInfoJabatanPage($page) {
        $this->activeInfoJabatanPage = $page;
    }

    public function mount($activeJabatanId)
    {
        $this->activeJabatanId = $activeJabatanId;
    }
    
}
