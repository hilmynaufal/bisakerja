<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class DataPegawaiAsn extends Component
{
    public $activeJabatanId;
    public $dataPegawaiAsn;
    public $id_jabatan;
    public $nip_lama;
    public $nip_baru;
    public $nama;
    public $kedudukan_hukum;
    public $golongan;
    public $jabatan;


    public function mount($activeJabatanId)
    {

        $array = DB::table('data_pegawai_asn')
            ->where('id_jabatan', $activeJabatanId)
            ->select('*')->get()->toArray();

        // dd($array);

        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataPegawaiAsn = $array;
    }

    public function insertDataPegawaiAsn()
    {

        DB::table('data_pegawai_asn')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'nip_lama' => $this->nip_lama,
            'nip_baru' => $this->nip_baru,
            'nama' => $this->nama,
            'kedudukan_hukum' => $this->kedudukan_hukum,
            'golongan' => $this->golongan,
            'jabatan' => $this->jabatan,
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataPegawaiAsn dan $activeJabatanId
        $this->reset(['nip_lama', 'nip_baru', 'nama', 'kedudukan_hukum', 'golongan', 'jabatan']);

        session()->flash('message', 'Data Pegawai ASN berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data pegawai asn
        $this->mount($this->activeJabatanId);
    }

    public function render()
    {
        return view('livewire.data-pegawai-asn');
    }
}
