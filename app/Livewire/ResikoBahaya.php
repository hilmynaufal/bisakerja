<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class ResikoBahaya extends Component
{
    public $activeJabatanId;
    public $dataResikoBahaya;
    public $nama_resiko;
    public $penyebab;
    
    // Variabel untuk fitur edit
    public $isEditing = false;
    public $editId;
    
    public function render()
    {
        
        return view('livewire.resiko-bahaya');
    }

    public function getResikoBahaya()
    {
        $array = DB::table('resiko_bahaya')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataResikoBahaya']);

        if (!empty($array)) {
            $this->dataResikoBahaya = $array;
        }
    }

    public function insertResikoBahaya()
    {

        DB::table('resiko_bahaya')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'nama_resiko' => $this->nama_resiko,
            'penyebab' => $this->penyebab,
        ]);

        // Tambahkan log setiap kali update data UNOR
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menambah Resiko Bahaya Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataResikoBahaya dan $activeJabatanId
        $this->reset(['nama_resiko', 'penyebab']);

        session()->flash('message', 'Resiko Bahaya berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data resiko bahaya
        $this->getResikoBahaya();
    }

    public function editResikoBahaya($id)
    {
        $data = DB::table('resiko_bahaya')->where('id', $id)->first();
        
        $this->editId = $id;
        $this->nama_resiko = $data->nama_resiko;
        $this->penyebab = $data->penyebab;
        
        $this->isEditing = true;
    }

    public function updateResikoBahaya()
    {
        DB::table('resiko_bahaya')->where('id', $this->editId)->update([
            'nama_resiko' => $this->nama_resiko,
            'penyebab' => $this->penyebab,
        ]);

        // Reset semua variabel
        $this->reset(['nama_resiko', 'penyebab', 'isEditing', 'editId']);

        session()->flash('message', 'Resiko Bahaya berhasil diupdate!');

        // Tambahkan log setiap kali update data
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Mengupdate Resiko Bahaya Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
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

        //get ulang data resiko bahaya
        $this->getResikoBahaya();
    }

    public function cancelEdit()
    {
        $this->reset(['nama_resiko', 'penyebab', 'isEditing', 'editId']);
    }

    public function hapusResikoBahaya($id)
    {

        DB::table('resiko_bahaya')->where('id', $id)->delete();

        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menghapus Resiko Bahaya Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        session()->flash('message', 'Resiko Bahaya berhasil dihapus!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil dihapus.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data resiko bahaya
        $this->getResikoBahaya();
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('resiko_bahaya')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataResikoBahaya = $array;
    }


}
