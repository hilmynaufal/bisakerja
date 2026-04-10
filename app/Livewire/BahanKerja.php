<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class BahanKerja extends Component
{
    public $activeJabatanId;
    public $dataBahanKerja;
    public $uraian_bahan_kerja;
    public $penggunaan;
    
    // Variabel untuk fitur edit
    public $isEditing = false;
    public $editId;
    
    public function render()
    {
        return view('livewire.bahan-kerja');
    }

    public function getBahanKerja()
    {
        $array = DB::table('bahan_kerja')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataBahanKerja']);

        if (!empty($array)) {
            $this->dataBahanKerja = $array;
        }
    }

    public function insertBahanKerja()
    {

        DB::table('bahan_kerja')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'uraian_bahan_kerja' => $this->uraian_bahan_kerja,
            'penggunaan' => $this->penggunaan,
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataBahanKerja dan $activeJabatanId
        $this->reset(['uraian_bahan_kerja', 'penggunaan']);

        session()->flash('message', 'Bahan Kerja berhasil ditambahkan!');

        // Tambahkan log setiap kali update data UNOR
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menambah Bahan Kerja Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
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

        //get ulang data bahan kerja
        $this->getBahanKerja();
    }

    public function editBahanKerja($id)
    {
        $data = DB::table('bahan_kerja')->where('id', $id)->first();
        
        $this->editId = $id;
        $this->uraian_bahan_kerja = $data->uraian_bahan_kerja;
        $this->penggunaan = $data->penggunaan;
        
        $this->isEditing = true;
    }

    public function updateBahanKerja()
    {
        DB::table('bahan_kerja')->where('id', $this->editId)->update([
            'uraian_bahan_kerja' => $this->uraian_bahan_kerja,
            'penggunaan' => $this->penggunaan,
        ]);

        // Reset semua variabel
        $this->reset(['uraian_bahan_kerja', 'penggunaan', 'isEditing', 'editId']);

        session()->flash('message', 'Bahan Kerja berhasil diupdate!');

        // Tambahkan log setiap kali update data
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Mengupdate Bahan Kerja Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
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

        //get ulang data bahan kerja
        $this->getBahanKerja();
    }

    public function cancelEdit()
    {
        $this->reset(['uraian_bahan_kerja', 'penggunaan', 'isEditing', 'editId']);
    }

    public function hapusBahanKerja($id)
    {
        DB::table('bahan_kerja')->where('id', $id)->delete();

        session()->flash('message', 'Bahan Kerja berhasil dihapus!');

        // Tambahkan log setiap kali hapus data Bahan Kerja
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menghapus Bahan Kerja Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
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

        //get ulang data bahan kerja
        $this->getBahanKerja();
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('bahan_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataBahanKerja = $array;
    }
}
