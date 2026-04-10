<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DashboardAdmin extends Component
{
    
    public $activeDashboardAdminPage = 'kelola-user';

    

    public function setActiveDashboardAdminPage($page)
    {
        $this->activeDashboardAdminPage = $page;
    }

    

    public function render()
    {
        return view('livewire.dashboard-admin');
    }
}
