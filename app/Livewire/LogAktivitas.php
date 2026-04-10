<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class LogAktivitas extends Component
{
    public $search = '';
    public $perPage = 10;
    public $page = 1;
    public $total = 0;
    public $lastPage = 1;
    public $logs = [];

    public function mount()
    {
        $this->getLogs();
    }

    public function updatedSearch()
    {
        $this->page = 1;
        $this->getLogs();
    }

    public function updatedPerPage()
    {
        $this->page = 1;
        $this->getLogs();
    }

    public function goToPage($page)
    {
        $this->page = $page;
        $this->getLogs();
    }

    public function getLogs()
    {
        $query = DB::table('logs');
        if ($this->search) {
            $query->where(function($q) {
                $q->where('username', 'like', '%'.$this->search.'%')
                  ->orWhere('activity', 'like', '%'.$this->search.'%')
                  ->orWhere('ip_address', 'like', '%'.$this->search.'%')
                  ->orWhere('user_agent', 'like', '%'.$this->search.'%');
            });
        }
        $this->total = $query->count();
        $this->lastPage = max(1, ceil($this->total / $this->perPage));
        $this->logs = $query->orderBy('created_at', 'desc')
            ->offset(($this->page - 1) * $this->perPage)
            ->limit($this->perPage)
            ->get();
    }

    public function render()
    {
        return view('livewire.log-aktivitas', [
            'logs' => $this->logs,
            'page' => $this->page,
            'lastPage' => $this->lastPage,
            'total' => $this->total,
            'perPage' => $this->perPage,
            'search' => $this->search,
        ]);
    }
}
