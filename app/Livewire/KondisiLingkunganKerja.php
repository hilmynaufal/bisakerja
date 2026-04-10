<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class KondisiLingkunganKerja extends Component
{
    public $activeJabatanId;
    public $dataKondisiLingkunganKerja;
    public $aspek;
    public $faktor;
    
    // Variabel untuk fitur edit
    public $isEditing = false;
    public $editId;
    
    public function render()
    {
        return view('livewire.kondisi-lingkungan-kerja');
    }

    public function getKondisiLingkunganKerja()
    {
        $array = DB::table('kondisi_lingkungan_kerja')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataKondisiLingkunganKerja']);

        if (!empty($array)) {
            $this->dataKondisiLingkunganKerja = $array;
        }
    }

    public function insertKondisiLingkunganKerja()
    {

        DB::table('kondisi_lingkungan_kerja')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'aspek' => $this->aspek,
            'faktor' => $this->faktor,
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataKondisiLingkunganKerja dan $activeJabatanId
        $this->reset(['aspek', 'faktor']);

        session()->flash('message', 'Kondisi Lingkungan Kerja berhasil ditambahkan!');

        // Tambahkan log setiap kali update data UNOR
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menambah Kondisi Lingkungan Kerja Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data kondisi lingkungan kerja
        $this->getKondisiLingkunganKerja();
    }

    public function editKondisiLingkunganKerja($id)
    {
        $data = DB::table('kondisi_lingkungan_kerja')->where('id', $id)->first();
        
        $this->editId = $id;
        $this->aspek = $data->aspek;
        $this->faktor = $data->faktor;
        
        $this->isEditing = true;
    }

    public function updateKondisiLingkunganKerja()
    {
        DB::table('kondisi_lingkungan_kerja')->where('id', $this->editId)->update([
            'aspek' => $this->aspek,
            'faktor' => $this->faktor,
        ]);

        // Reset semua variabel
        $this->reset(['aspek', 'faktor', 'isEditing', 'editId']);

        session()->flash('message', 'Kondisi Lingkungan Kerja berhasil diupdate!');

        // Tambahkan log setiap kali update data
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Mengupdate Kondisi Lingkungan Kerja Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil diupdate.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data kondisi lingkungan kerja
        $this->getKondisiLingkunganKerja();
    }

    public function cancelEdit()
    {
        $this->reset(['aspek', 'faktor', 'isEditing', 'editId']);
    }

    public function hapusKondisiLingkunganKerja($id)
    {
        DB::table('kondisi_lingkungan_kerja')->where('id', $id)->delete();

        session()->flash('message', 'Kondisi Lingkungan Kerja berhasil dihapus!');

        // Tambahkan log setiap kali update data UNOR
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menghapus Kondisi Lingkungan Kerja Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil dihapus.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data kondisi lingkungan kerja
        $this->getKondisiLingkunganKerja();
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('kondisi_lingkungan_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataKondisiLingkunganKerja = $array;
    }
}
