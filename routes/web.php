<?php

use App\Livewire\HasilKerja;
use App\Livewire\Home;
use App\Livewire\InfoJabatan;
use App\Livewire\PetaJabatan;
use App\Livewire\TugasPokok;
use App\Livewire\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeController;
use App\Livewire\ResumeExport;




Route::middleware(['web'])->group(function () {
    Route::middleware(['checklogin'])->group(function () {

        Route::get('/infojab', InfoJabatan::class);
        Route::get('/tugas-pokok', TugasPokok::class);
        Route::get('/hasil-kerja', HasilKerja::class);

        Route::get('/peta_jabatan/children/{id}', [PetaJabatan::class, 'children']);
        Route::get('/peta_jabatan/initdata', [PetaJabatan::class, 'initdata']);

        Route::get('/', Home::class);
        Route::get('/home', Home::class)->name('home');
    });
  
  Route::get('/resume-export/{activeJabatanId}', ResumeExport::class)->name('resume-export');


    Route::get('/login', Login::class)->name('login');
});



