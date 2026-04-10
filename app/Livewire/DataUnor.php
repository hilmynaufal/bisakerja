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
    public $is_prioritas_nasional;
    public $is_prioritas_instansi;
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

    public $searchNamaJabatan = '';
    public $searchResults = [];
    public $kelasJabatan;

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
        'is_prioritas_nasional' => 'nullable|boolean',
        'is_prioritas_instansi' => 'nullable|boolean',
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
        // dd($this->nama_jabatan, $this->searchNamaJabatan);   

        DB::table('data_unor')->where('id_jabatan', $this->dataUnor->id_jabatan)->update([
            'nama_unor_hr' => $this->nama_unor_hr,
            'nama_unor_bkn' => $this->nama_unor_bkn,
            'nama_unor_mapping_instansi' => $this->nama_unor_mapping_instansi,
            'nama_pembina' => $this->nama_pembina,
            'nama_unor' => $this->nama_unor,
            'nama_jabatan' => $this->searchNamaJabatan,
            'jenis_unor' => $this->jenis_unor,
            'jenjang_jabatan' => $this->jenjang_jabatan,
            'jabatan_prioritas' => $this->jabatan_prioritas,
            'is_prioritas_nasional' => $this->is_prioritas_nasional,
            'is_prioritas_instansi' => $this->is_prioritas_instansi,
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
            'urutan' => $this->urutan ?? 1,
        ]);

        // Tambahkan log setiap kali update data UNOR
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Mengubah Data Unor ' . $this->nama_unor . ' (id jabatan: ' . $this->id_jabatan . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        // Melakukan updateOrInsert pada tabel kelas_jabatan berdasarkan id_jabatan
        if (!is_null($this->kelasJabatan) && $this->kelasJabatan !== '') {
            DB::table('kelas_jabatan')->updateOrInsert(
                ['id_jabatan' => $this->id_jabatan],
                ['kelas' => $this->kelasJabatan]
            );
        }

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

        session()->put('activeNamaUnor', $array->nama_unor);

        $this->nama_unor = $array->nama_unor;
        $this->nama_unor_hr = $array->nama_unor_hr;
        $this->nama_unor_bkn = $array->nama_unor_bkn;
        $this->nama_unor_mapping_instansi = $array->nama_unor_mapping_instansi;
        $this->nama_pembina = $array->nama_pembina;
        $this->nama_jabatan = $array->nama_jabatan;
        $this->searchNamaJabatan = $array->nama_jabatan;
        $this->jenis_unor = $array->jenis_unor;
        $this->jenjang_jabatan = $array->jenjang_jabatan;
        $this->jabatan_prioritas = $array->jabatan_prioritas;
        $this->is_prioritas_nasional = (bool) $array->is_prioritas_nasional;
        $this->is_prioritas_instansi = (bool) $array->is_prioritas_instansi;
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

        session()->put('activeNamaUnor', $array->nama_unor);

        $this->nama_unor = $array->nama_unor;
        $this->nama_unor_hr = $array->nama_unor_hr;
        $this->nama_unor_bkn = $array->nama_unor_bkn;
        $this->nama_unor_mapping_instansi = $array->nama_unor_mapping_instansi;
        $this->nama_pembina = $array->nama_pembina;
        $this->nama_jabatan = $array->nama_jabatan;
        $this->searchNamaJabatan = $array->nama_jabatan;
        $this->jenis_unor = $array->jenis_unor;
        $this->jenjang_jabatan = $array->jenjang_jabatan;
        $this->jabatan_prioritas = $array->jabatan_prioritas;
        $this->is_prioritas_nasional = (bool) $array->is_prioritas_nasional;
        $this->is_prioritas_instansi = (bool) $array->is_prioritas_instansi;
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
