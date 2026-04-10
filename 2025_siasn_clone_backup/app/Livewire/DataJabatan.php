<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class DataJabatan extends Component
{

    public $dataDataJabatan;
    public $dataPendidikan = [];
    public $input_nama_pendidikan = [];
    public $nama_pendidikan;
    public $id_jabatan;
    public $nama_jabatan;
    public $jenis_jabatan;
    public $jpt_madya;
    public $administrator;
    public $jpt_pratama;
    public $pengawas;
    public $ikhtisar_jabatan;
    public $syarat_jabatan;
    public $pendidikan;
    public $diklat;
    public $pengalaman;

    public function mount($activeJabatanId)
    {

        $array = DB::table('data_jabatan')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray()[0];

        $this->reset();

        $this->dataDataJabatan = $array;

        $this->id_jabatan = $array->id_jabatan;
        $this->nama_jabatan = $array->nama_jabatan;
        $this->jenis_jabatan = $array->jenis_jabatan;
        $this->jpt_madya = $array->jpt_madya;
        $this->administrator = $array->administrator;
        $this->jpt_pratama = $array->jpt_pratama;
        $this->pengawas = $array->pengawas;
        $this->ikhtisar_jabatan = $array->ikhtisar_jabatan;
        $this->syarat_jabatan = $array->syarat_jabatan;
        $this->pendidikan = $array->pendidikan;
        $this->diklat = $array->diklat;
        $this->pengalaman = $array->pengalaman;

        $this->getPendidikan();
    }

    public function updatePendidikan($id)
    {
        $nama_pendidikan = $this->input_nama_pendidikan[$id];

        DB::table('pendidikan')->where('id', $id)->update([
            'nama_pendidikan' => $nama_pendidikan,
        ]);

        session()->flash('message', 'Tanggung Jawab berhasil diupdate!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil diupdate.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        $this->getPendidikan();
    }

    

    public function setDataJabatan($id_jabatan)
    {

        $array = DB::table('data_jabatan')->where('id_jabatan', $id_jabatan)->select('*')->get()->toArray()[0];

        // dd($array);

        $this->reset();

        $this->dataDataJabatan = $array;

        $this->id_jabatan = $array->id_jabatan;
        $this->nama_jabatan = $array->nama_jabatan;
        $this->jenis_jabatan = $array->jenis_jabatan;
        $this->jpt_madya = $array->jpt_madya;
        $this->administrator = $array->administrator;
        $this->jpt_pratama = $array->jpt_pratama;
        $this->pengawas = $array->pengawas;
        $this->ikhtisar_jabatan = $array->ikhtisar_jabatan;
        $this->syarat_jabatan = $array->syarat_jabatan;
        $this->pendidikan = $array->pendidikan;
        $this->diklat = $array->diklat;
        $this->pengalaman = $array->pengalaman;

        // dd($this->nama_jabatan);
    }



    public function insertPendidikan()
    {

        DB::table('pendidikan')->insert([
            'id_jabatan' => $this->id_jabatan,
            'nama_pendidikan' => $this->nama_pendidikan,
        ]);

        $this->reset(['nama_pendidikan']);

        session()->flash('message', 'Pendidikan berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data pendidikan
        $this->getPendidikan();
    }

    public function getPendidikan()
    {
        $array = DB::table('pendidikan')
            ->where('id_jabatan', $this->id_jabatan)
            ->select('*')->get()->toArray();

        $this->reset(['dataPendidikan']);

        // dd($array);

        if (!empty($array)) {
            $this->dataPendidikan = $array;
            foreach ($array as $key => $value) {
                $this->input_nama_pendidikan[$value->id] = $value->nama_pendidikan;
            }
        }
    }

    public function updateDataJabatan()
    {
        // $validatedData = $this->validate();

        DB::table('data_jabatan')->where('id_jabatan', $this->id_jabatan)->update([
            'nama_jabatan' => $this->nama_jabatan,
            'jenis_jabatan' => $this->jenis_jabatan,
            'jpt_madya' => $this->jpt_madya,
            'administrator' => $this->administrator,
            'jpt_pratama' => $this->jpt_pratama,
            'pengawas' => $this->pengawas,
            'ikhtisar_jabatan' => $this->ikhtisar_jabatan,
            'syarat_jabatan' => $this->syarat_jabatan,
            'pendidikan' => $this->pendidikan,
            'diklat' => $this->diklat,
            'pengalaman' => $this->pengalaman,
        ]);

        $this->dataDataJabatan = DB::table('data_jabatan')->where('id_jabatan', $this->id_jabatan)->select('*')->get()->toArray()[0];

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        session()->flash('message', 'Post berhasil diperbarui!');
    }

    public function hapusPendidikan($id)
    {
        DB::table('pendidikan')->where('id', $id)->delete();

        session()->flash('message', 'Pendidikan berhasil dihapus!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil dihapus.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        $this->getPendidikan();
    }

    public function render()
    {
        return view('livewire.data-jabatan');
    }
}
