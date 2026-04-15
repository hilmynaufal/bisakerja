<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class DataJabatan extends Component
{

    public $dataDataJabatan;
    public $dataDataUnor;
    public $dataPendidikan = [];
    public $input_nama_pendidikan = [];
    public $nama_pendidikan;
    public $id_jabatan;
    public $kode_jabatan;
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
    // public $refJabatan;
    public $searchNamaJabatan = '';
    public $searchResults = [];
    public $searchPendidikanMinimum = '';
    public $searchPendidikanMinimumResults = [];
    
    public $kelasJabatan;

    public function mount($activeJabatanId)
    {

        $array = DB::table('data_jabatan')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray()[0];
        $array2 = DB::table('ref_jabatan')->select('*')->get()->toArray();

        $this->reset();

        $this->dataDataJabatan = $array;
        // $this->refJabatan = $array2;

        $this->id_jabatan = $array->id_jabatan;
        $this->kode_jabatan = $array->kode_jabatan ?? '';
        $this->nama_jabatan = $array->nama_jabatan;
        $this->searchNamaJabatan = $array->nama_jabatan;
        
        $this->jenis_jabatan = $array->jenis_jabatan;
        $this->jpt_madya = $array->jpt_madya;
        $this->administrator = $array->administrator;
        $this->jpt_pratama = $array->jpt_pratama;
        $this->pengawas = $array->pengawas;
        $this->ikhtisar_jabatan = $array->ikhtisar_jabatan;
        $this->syarat_jabatan = $array->syarat_jabatan;
        $this->pendidikan = $array->pendidikan;
        $this->searchPendidikanMinimum = $array->pendidikan;
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

        session()->flash('message', 'Pendidikan berhasil diupdate!');

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
        $this->kode_jabatan = $array->kode_jabatan ?? '';
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
            'nama_jabatan' => $this->searchNamaJabatan,
            'kode_jabatan' => $this->kode_jabatan,
            'jenis_jabatan' => $this->jenis_jabatan,
            'jpt_madya' => $this->jpt_madya,
            'administrator' => $this->administrator,
            'jpt_pratama' => $this->jpt_pratama,
            'pengawas' => $this->pengawas,
            'ikhtisar_jabatan' => $this->ikhtisar_jabatan,
            'syarat_jabatan' => $this->syarat_jabatan,
            'pendidikan' => $this->searchPendidikanMinimum,
            'diklat' => $this->diklat,
            'pengalaman' => $this->pengalaman,
        ]);

        // dd($this->kelasJabatan);



        // Melakukan updateOrInsert pada tabel kelas_jabatan berdasarkan id_jabatan
        if (!is_null($this->kelasJabatan) && $this->kelasJabatan !== '') {
            DB::table('kelas_jabatan')->updateOrInsert(
                ['id_jabatan' => $this->id_jabatan],
                ['kelas' => $this->kelasJabatan]
            );
        }

        // Tambahkan log setiap kali update data jabatan
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Mengubah Data Jabatan ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        $this->dataDataJabatan = DB::table('data_jabatan')->where('id_jabatan', $this->id_jabatan)->select('*')->get()->toArray()[0];

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        session()->flash('message', 'Data Jabatan berhasil diperbarui!');
    }

    public function hapusPendidikan($id)
    {
        DB::table('pendidikan')->where('id', $id)->delete();

        session()->flash('message', 'Pendidikan berhasil dihapus!');

        // Tambahkan log setiap kali update data UNOR
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menghapus Pendidikan di ' . "" . ' (id jabatan: ' . $this->id_jabatan . ')',
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

        $this->getPendidikan();
    }

    public function updatedSearchNamaJabatan($value)
    {
        // dd($this->searchNamaJabatan);
        $this->searchResults = DB::table('ref_jabatan')
            ->where('nama_jabatan', 'like', '%' . $this->searchNamaJabatan . '%')
            ->limit(10)
            ->get();
    }

    public function selectNamaJabatan($nama, $kelas)
    {
        $this->nama_jabatan = $nama;
        $this->searchNamaJabatan = $nama;
        $this->kelasJabatan = $kelas;
        $this->searchResults = [];
    }

    public function updatedSearchPendidikanMinimum($value)
    {
        // dd($this->searchNamaJabatan);
        $this->searchPendidikanMinimumResults = DB::table('ref_pendidikan_min')
            ->where('nama_pendidikan', 'like', '%' . $this->searchPendidikanMinimum . '%')
            ->limit(10)
            ->get();
    }

    public function selectPendidikanMin($nama)
    {
        $this->pendidikan = $nama;
        $this->searchPendidikanMinimum = $nama;
        // $this->kelasJabatan = $kelas;
        $this->searchPendidikanMinimumResults = [];
    }

    public function render()
    {
        return view('livewire.data-jabatan');
    }
}
