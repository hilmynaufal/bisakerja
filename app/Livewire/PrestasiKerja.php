<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class PrestasiKerja extends Component
{
    public $activeJabatanId;
    public $dataPrestasiKerja;
    public $uraian_prestasi_kerja;
    public $uraianModel = [];
    // public $penggunaan;

    public function getPrestasiKerja()
    {
        $array = DB::table('prestasi_kerja')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataPrestasiKerja']);
        

        if (!empty($array)) {
            $this->dataPrestasiKerja = $array;
            foreach ($array as $key => $value) {
                $this->uraianModel[$value->id] = $value->uraian_prestasi_kerja;
            }
        }
    }

    public function updatePrestasiKerja($id)
    {
        $uraian_prestasi_kerja = $this->uraianModel[$id];
        // Validasi data secara manual
        
        // dd($uraian_prestasi_kerja);

        DB::table('prestasi_kerja')->where('id', $id)->update([
            'uraian_prestasi_kerja' => $uraian_prestasi_kerja,
        ]);

        

        // Reset variabel yang digunakan untuk input setelah berhasil update
        $this->reset(['uraian_prestasi_kerja']);

        session()->flash('message', 'Prestasi Kerja berhasil diupdate!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil diupdate.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data prestasi kerja
        $this->getPrestasiKerja();
    }

    public function insertPrestasiKerja()
    {

        DB::table('prestasi_kerja')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'uraian_prestasi_kerja' => $this->uraian_prestasi_kerja,
        ]);

        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menambah Prestasi Kerja Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataPrestasiKerja dan $activeJabatanId
        $this->reset(['uraian_prestasi_kerja', 'uraianModel']);

        session()->flash('message', 'Prestasi Kerja berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data prestasi kerja
        $this->getPrestasiKerja();
    }

    public function hapusPrestasiKerja($id)
    {
        DB::table('prestasi_kerja')->where('id', $id)->delete();

        session()->flash('message', 'Prestasi Kerja berhasil dihapus!');

        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menghapus Prestasi Kerja Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
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

        //get ulang data prestasi kerja
        $this->getPrestasiKerja();
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('prestasi_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataPrestasiKerja = $array;
        
        foreach ($array as $key => $value) {
            $this->uraianModel[$value->id] = $value->uraian_prestasi_kerja;
        }
    }
    public function render()
    {
        return view('livewire.prestasi-kerja');
    }
}
