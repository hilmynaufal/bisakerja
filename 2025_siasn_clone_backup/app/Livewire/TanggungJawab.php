<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
class TanggungJawab extends Component
{
    public $activeJabatanId;
    public $dataTanggungJawab;
    public $uraian_tanggung_jawab;
    public $uraianModel = [];
    // public $penggunaan;

    public function getTanggungJawab()
    {
        $array = DB::table('tanggung_jawab')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataTanggungJawab']);

        

        if (!empty($array)) {
            $this->dataTanggungJawab = $array;
            foreach ($array as $key => $value) {
                $this->uraianModel[$value->id] = $value->uraian_tanggung_jawab;
            }
        }
    }

    public function updateTanggungJawab($id)
    {
        $uraian_tanggung_jawab = $this->uraianModel[$id];
        // Validasi data secara manual
        
        // dd($uraian_tanggung_jawab);

        DB::table('tanggung_jawab')->where('id', $id)->update([
            'uraian_tanggung_jawab' => $uraian_tanggung_jawab,
        ]);

        // Reset variabel yang digunakan untuk input setelah berhasil update
        $this->reset(['uraian_tanggung_jawab']);

        session()->flash('message', 'Tanggung Jawab berhasil diupdate!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil diupdate.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data tanggung jawab
        $this->getTanggungJawab();
    }

    public function insertTanggungJawab()
    {

        DB::table('tanggung_jawab')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'uraian_tanggung_jawab' => $this->uraian_tanggung_jawab,
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataTanggungJawab dan $activeJabatanId
        $this->reset(['uraian_tanggung_jawab', 'uraianModel']);

        session()->flash('message', 'Tanggung Jawab berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data tanggung jawab
        $this->getTanggungJawab();
    }

    public function hapusTanggungJawab($id)
    {
        DB::table('tanggung_jawab')->where('id', $id)->delete();

        session()->flash('message', 'Tanggung Jawab berhasil dihapus!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil dihapus.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data tanggung jawab
        $this->getTanggungJawab();
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('tanggung_jawab')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        
        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataTanggungJawab = $array;
        
        foreach ($array as $key => $value) {
            $this->uraianModel[$value->id] = $value->uraian_tanggung_jawab;
        }
    }
    public function render()
    {
        return view('livewire.tanggung-jawab');
    }
}
