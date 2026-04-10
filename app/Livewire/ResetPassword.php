<?php

namespace App\Livewire;

use Livewire\Component;

class ResetPassword extends Component
{
    public $username;
    public $successMessage;

    public function render()
    {
        return view('livewire.reset-password');
    }

    public function resetPassword()
    {
        $user = \DB::table('user')->where('username', $this->username)->first();
        if ($user) {
            // Update password menjadi default
            \DB::table('user')->where('username', $this->username)
                ->update(['password' => 'Bandungkab@2025']);
            $this->successMessage = 'Password berhasil direset! Password baru Anda: Bandungkab@2025';
        } else {
            $this->successMessage = 'Username tidak ditemukan.';
        }
    }
}
