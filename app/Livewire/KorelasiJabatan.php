<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class KorelasiJabatan extends Component
{
    public $activeJabatanId;
    public $dataKorelasiJabatan;
    public $unit_kerja;
    public $dalam_hal;
    public $nama_jabatan;
    
    // Variabel untuk fitur edit
    public $isEditing = false;
    public $editId;
    
    public function render()
    {
        return view('livewire.korelasi-jabatan');
    }

    public function getKorelasiJabatan()
    {
        $array = DB::table('korelasi_jabatan')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataKorelasiJabatan']);

        if (!empty($array)) {
            $this->dataKorelasiJabatan = $array;
        }
    }

    public function insertKorelasiJabatan()
    {

        DB::table('korelasi_jabatan')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'unit_kerja' => $this->unit_kerja,
            'dalam_hal' => $this->dalam_hal,
            'nama_jabatan' => $this->nama_jabatan,
        ]);

        // Tambahkan log setiap kali update data UNOR
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menambah Korelasi Jabatan Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataKorelasiJabatan dan $activeJabatanId
        $this->reset(['unit_kerja', 'dalam_hal', 'nama_jabatan']);

        session()->flash('message', 'Korelasi Jabatan berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data korelasi jabatan
        $this->getKorelasiJabatan();
    }

    public function editKorelasiJabatan($id)
    {
        $data = DB::table('korelasi_jabatan')->where('id', $id)->first();
        
        $this->editId = $id;
        $this->unit_kerja = $data->unit_kerja;
        $this->dalam_hal = $data->dalam_hal;
        $this->nama_jabatan = $data->nama_jabatan;
        
        $this->isEditing = true;
    }

    public function updateKorelasiJabatan()
    {
        DB::table('korelasi_jabatan')->where('id', $this->editId)->update([
            'unit_kerja' => $this->unit_kerja,
            'dalam_hal' => $this->dalam_hal,
            'nama_jabatan' => $this->nama_jabatan,
        ]);

        // Reset semua variabel
        $this->reset(['unit_kerja', 'dalam_hal', 'nama_jabatan', 'isEditing', 'editId']);

        session()->flash('message', 'Korelasi Jabatan berhasil diupdate!');

        // Tambahkan log setiap kali update data
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Mengupdate Korelasi Jabatan Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
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

        //get ulang data korelasi jabatan
        $this->getKorelasiJabatan();
    }

    public function cancelEdit()
    {
        $this->reset(['unit_kerja', 'dalam_hal', 'nama_jabatan', 'isEditing', 'editId']);
    }

    public function hapusKorelasiJabatan($id)
    {
        DB::table('korelasi_jabatan')->where('id', $id)->delete();

        // Tambahkan log setiap kali hapus data UNOR
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menghapus Korelasi Jabatan Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        session()->flash('message', 'Korelasi Jabatan berhasil dihapus!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil dihapus.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data korelasi jabatan
        $this->getKorelasiJabatan();
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('korelasi_jabatan')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataKorelasiJabatan = $array;
    }
}
