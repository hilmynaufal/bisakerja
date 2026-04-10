<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class PerangkatKerja extends Component
{

    public $activeJabatanId;
    public $dataPerangkatKerja;
    public $uraian_perangkat_kerja;
    public $penggunaan;
    
    // Variabel untuk fitur edit
    public $isEditing = false;
    public $editId;
  
    public function getPerangkatKerja()
    {
        $array = DB::table('perangkat_kerja')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataPerangkatKerja']);

        if (!empty($array)) {
            $this->dataPerangkatKerja = $array;
        }
    }

    public function insertPerangkatKerja()
    {

        DB::table('perangkat_kerja')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'uraian_perangkat_kerja' => $this->uraian_perangkat_kerja,
            'penggunaan' => $this->penggunaan,
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataPerangkatKerja dan $activeJabatanId
        $this->reset(['uraian_perangkat_kerja', 'penggunaan']);

        session()->flash('message', 'Perangkat Kerja berhasil ditambahkan!');

        // Tambahkan log setiap kali update data UNOR
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menambah Perangkat Kerja Unor ' .session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
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

        //get ulang data perangkat kerja
        $this->getPerangkatKerja();
    }

    public function editPerangkatKerja($id)
    {
        $data = DB::table('perangkat_kerja')->where('id', $id)->first();
        
        $this->editId = $id;
        $this->uraian_perangkat_kerja = $data->uraian_perangkat_kerja;
        $this->penggunaan = $data->penggunaan;
        
        $this->isEditing = true;
    }

    public function updatePerangkatKerja()
    {
        DB::table('perangkat_kerja')->where('id', $this->editId)->update([
            'uraian_perangkat_kerja' => $this->uraian_perangkat_kerja,
            'penggunaan' => $this->penggunaan,
        ]);

        // Reset semua variabel
        $this->reset(['uraian_perangkat_kerja', 'penggunaan', 'isEditing', 'editId']);

        session()->flash('message', 'Perangkat Kerja berhasil diupdate!');

        // Tambahkan log setiap kali update data
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Mengupdate Perangkat Kerja Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
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

        //get ulang data perangkat kerja
        $this->getPerangkatKerja();
    }

    public function cancelEdit()
    {
        $this->reset(['uraian_perangkat_kerja', 'penggunaan', 'isEditing', 'editId']);
    }

    public function hapusPerangkatKerja($id)
    {
        DB::table('perangkat_kerja')->where('id', $id)->delete();

        session()->flash('message', 'Perangkat Kerja berhasil dihapus!');

        // Tambahkan log setiap kali update data UNOR
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menghapus Perangkat Kerja Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
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

        //get ulang data perangkat kerja
        $this->getPerangkatKerja();
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('perangkat_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataPerangkatKerja = $array;
    }
    public function render()
    {
        return view('livewire.perangkat-kerja');
    }
}
