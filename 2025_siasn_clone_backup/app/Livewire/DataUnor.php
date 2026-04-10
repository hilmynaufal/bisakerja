<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class DataUnor extends Component
{


    public $dataUnor;
    public $id_jabatan;
    public $nama_unor_hr;
    public $nama_unor_bkn;
    public $nama_unor_mapping_instansi;
    public $nama_pembina;
    public $nama_unor;
    public $nama_jabatan;
    public $jenis_unor;
    public $jenjang_jabatan;
    public $jabatan_prioritas;
    public $rumpun_jabatan;
    public $lokasi;
    public $unor_atasan_struktural;
    public $unor_induk;
    public $kode_cepat;
    public $bup;
    public $level_struktur;
    public $nama_sub_jabatan;
    public $jenis_jabatan_fungsional;
    public $tipe_unor;

    public $urutan;

    public $rules = [
        'nama_unor_hr' => 'nullable|string',
        'nama_unor_bkn' => 'nullable|string',
        'nama_unor_mapping_instansi' => 'nullable|string',
        'nama_pembina' => 'nullable|string',
        'nama_unor' => 'nullable|string',
        'nama_jabatan' => 'nullable|string',
        'jenis_unor' => 'nullable|string',
        'jenjang_jabatan' => 'nullable|string',
        'jabatan_prioritas' => 'nullable|string',
        'rumpun_jabatan' => 'nullable|string',
        'lokasi' => 'nullable|string',
        'unor_atasan_struktural' => 'nullable|string',
        'unor_induk' => 'nullable|string',
        'kode_cepat' => 'nullable|string',
        'bup' => 'nullable|string',
        'level_struktur' => 'nullable|string',
        'nama_sub_jabatan' => 'nullable|string',
        'jenis_jabatan_fungsional' => 'nullable|string',
        'tipe_unor' => 'nullable|string',
    ];

    public function updateDataUnor()
    {
        // $validatedData = $this->validate();

        DB::table('data_unor')->where('id_jabatan', $this->dataUnor->id_jabatan)->update([
            'nama_unor_hr' => $this->nama_unor_hr,
            'nama_unor_bkn' => $this->nama_unor_bkn,
            'nama_unor_mapping_instansi' => $this->nama_unor_mapping_instansi,
            'nama_pembina' => $this->nama_pembina,
            'nama_unor' => $this->nama_unor,
            'nama_jabatan' => $this->nama_jabatan,
            'jenis_unor' => $this->jenis_unor,
            'jenjang_jabatan' => $this->jenjang_jabatan,
            'jabatan_prioritas' => $this->jabatan_prioritas,
            'rumpun_jabatan' => $this->rumpun_jabatan,
            'lokasi' => $this->lokasi,
            'unor_atasan_struktural' => $this->unor_atasan_struktural,
            'unor_induk' => $this->unor_induk,
            'kode_cepat' => $this->kode_cepat,
            'bup' => $this->bup,
            'level_struktur' => $this->level_struktur,
            'nama_sub_jabatan' => $this->nama_sub_jabatan,
            'jenis_jabatan_fungsional' => $this->jenis_jabatan_fungsional,
            'tipe_unor' => $this->tipe_unor,
            'urutan' => $this->urutan,
        ]);

        $this->dataUnor = DB::table('data_unor')->where('id_jabatan', $this->dataUnor->id_jabatan)->select('*')->get()->toArray()[0];

        // $this->dispatch('swal', 'Berhasil!', 'Data berhasil disimpan!', 'success');
        // Swal.fire(title, message, type);
        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        session()->flash('message', 'Post berhasil diperbarui!');
    }

    // protected $listeners = ['changeJabatan' => 'setDataUnor']; // Dengar event dari sidebar

    public function setDataUnor($id_jabatan)
    {

        $array = DB::table('data_unor')->where('id_jabatan', $id_jabatan)->select('*')->get()->toArray()[0];

        $this->reset();

        $this->dataUnor = $array;

        // dd($array);

        $this->nama_unor = $array->nama_unor;
        $this->nama_unor_hr = $array->nama_unor_hr;
        $this->nama_unor_bkn = $array->nama_unor_bkn;
        $this->nama_unor_mapping_instansi = $array->nama_unor_mapping_instansi;
        $this->nama_pembina = $array->nama_pembina;
        $this->nama_jabatan = $array->nama_jabatan;
        $this->jenis_unor = $array->jenis_unor;
        $this->jenjang_jabatan = $array->jenjang_jabatan;
        $this->jabatan_prioritas = $array->jabatan_prioritas;
        $this->rumpun_jabatan = $array->rumpun_jabatan;
        $this->lokasi = $array->lokasi;
        $this->unor_atasan_struktural = $array->unor_atasan_struktural;
        $this->unor_induk = $array->unor_induk;
        $this->kode_cepat = $array->kode_cepat;
        $this->bup = $array->bup;
        $this->level_struktur = $array->level_struktur;
        $this->nama_sub_jabatan = $array->nama_sub_jabatan;
        $this->jenis_jabatan_fungsional = $array->jenis_jabatan_fungsional;
        $this->tipe_unor = $array->tipe_unor;
        $this->urutan = $array->urutan;
    }

    public function mount($id_jabatan)
    {
        $this->reset();

        $array = DB::table('data_unor')->where('id_jabatan', $id_jabatan)->select('*')->get()->toArray()[0];

        $this->id_jabatan = $id_jabatan;

        $this->dataUnor = $array;

        $this->nama_unor = $array->nama_unor;
        $this->nama_unor_hr = $array->nama_unor_hr;
        $this->nama_unor_bkn = $array->nama_unor_bkn;
        $this->nama_unor_mapping_instansi = $array->nama_unor_mapping_instansi;
        $this->nama_pembina = $array->nama_pembina;
        $this->nama_jabatan = $array->nama_jabatan;
        $this->jenis_unor = $array->jenis_unor;
        $this->jenjang_jabatan = $array->jenjang_jabatan;
        $this->jabatan_prioritas = $array->jabatan_prioritas;
        $this->rumpun_jabatan = $array->rumpun_jabatan;
        $this->lokasi = $array->lokasi;
        $this->unor_atasan_struktural = $array->unor_atasan_struktural;
        $this->unor_induk = $array->unor_induk;
        $this->kode_cepat = $array->kode_cepat;
        $this->bup = $array->bup;
        $this->level_struktur = $array->level_struktur;
        $this->nama_sub_jabatan = $array->nama_sub_jabatan;
        $this->jenis_jabatan_fungsional = $array->jenis_jabatan_fungsional;
        $this->tipe_unor = $array->tipe_unor;
        $this->urutan = $array->urutan;
    }

    public function render()
    {
        if ($this->tipe_unor == 0) {
            return view('livewire.data-unor');    
        }
        return view('livewire.data-unor-jabatan-fungsional');
    }
}
