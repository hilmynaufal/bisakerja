<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{

    public $username;
    public $password;
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
            // session()->save();
            // session()->save();
            // session()->save();

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
}
