<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Illuminate\Support\Facades\Auth;
use function Termwind\render;

class Login extends Component
{

    public $username;
    public $password;
    public $showResetModal = false;
    public $resetUsername;
    public $resetMessage;

    public function render()
    {
        return view('livewire.login');
    }

    public function login_siasn()
    {

        // $credentials = [
        //     'email' => $this->username,
        //     'password' => $this->password,
        // ];

        // if (Auth::attempt($credentials)) {
        //     session()->regenerate(); // Penting untuk keamanan
        //     return redirect()->route('home');
        // }


        $user = DB::table('user')->where('username', $this->username)->first();        

        
        if ($user && $this->password == $user->password) {
            session()->put("id", $user->id);
            session()->put('username', $user->username);
            session()->put("nama", $user->nama);
            session()->put('jabatan', $user->jabatan);
            session()->put('id_jabatan', $user->id_jabatan);


            session()->save();

            // Catat log aktivitas login
            DB::table('logs')->insert([
                'user_id' => $user->id,
                'username' => $user->username,
                'activity' => 'login',
                'ip_address' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
                'created_at' => now(),
            ]);

            LivewireAlert::title('Berhasil!')
                ->text('Login Berhasil!')
                ->success()
                ->toast()
                ->position('top-end')
                ->show();

            // Lakukan tindakan setelah login berhasil, misalnya redirect
            return redirect()->route('home');

        } else {
            LivewireAlert::title('Gagal!')
                ->text('Login Gagal')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

    public function showResetModal()
    {
        dd('');
        $this->resetMessage = null;
        $this->resetUsername = null;
        $this->showResetModal = true;
        // $this->render();
    }

    public function closeResetModal()
    {
        $this->showResetModal = false;
    }

    public function resetPassword()
    {
        $user = \DB::table('user')->where('username', $this->resetUsername)->first();
        if ($user) {
            \DB::table('user')->where('username', $this->resetUsername)
                ->update(['password' => 'Bandungkab@2025']);
            LivewireAlert::title('Berhasil!')
                ->text('Password berhasil direset! Password baru Anda: Bandungkab@2025')
                ->success()
                ->toast()
                ->position('top-end')
                ->show();
        } else {
            LivewireAlert::title('Gagal!')
                ->text('Username tidak ditemukan.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }
}
