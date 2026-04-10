<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
class Wewenang extends Component
{
    public $activeJabatanId;
    public $dataWewenang;
    public $uraian_wewenang;
    public $uraianModel = [];
    // public $penggunaan;

    public function getWewenang()
    {
        $array = DB::table('wewenang')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataWewenang']);

        

        if (!empty($array)) {
            $this->dataWewenang = $array;
            foreach ($array as $key => $value) {
                $this->uraianModel[$value->id] = $value->uraian_wewenang;
            }
        }
    }

    public function updateWewenang($id)
    {
        $uraian_wewenang = $this->uraianModel[$id];
        // Validasi data secara manual
        
        // dd($uraian_wewenang);

        DB::table('wewenang')->where('id', $id)->update([
            'uraian_wewenang' => $uraian_wewenang,
        ]);

        // Reset variabel yang digunakan untuk input setelah berhasil update
        $this->reset(['uraian_wewenang']);

        session()->flash('message', 'Wewenang berhasil diupdate!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil diupdate.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data wewenang
        $this->getWewenang();
    }

    public function insertWewenang()
    {

        DB::table('wewenang')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'uraian_wewenang' => $this->uraian_wewenang,
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataWewenang dan $activeJabatanId
        $this->reset(['uraian_wewenang', 'uraianModel']);

        session()->flash('message', 'Wewenang berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data wewenang
        $this->getWewenang();
    }

    public function hapusWewenang($id)
    {
        DB::table('wewenang')->where('id', $id)->delete();

        session()->flash('message', 'Wewenang berhasil dihapus!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil dihapus.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        $this->getWewenang();
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('wewenang')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataWewenang = $array;
        
        foreach ($array as $key => $value) {
            $this->uraianModel[$value->id] = $value->uraian_wewenang;
        }
    }
    public function render()
    {
        return view('livewire.wewenang');
    }
}
