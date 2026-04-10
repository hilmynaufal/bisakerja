<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
// use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class ResumeExport extends Component
{

    public $activeJabatanId;
    public $dataDataJabatan;
    public $dataTugasPokok = [];
    public $dataBahanKerja = [];
    public $dataPerangkatKerja = [];
    public $dataTanggungJawab = [];
    public $dataWewenang = [];
    public $dataKorelasiJabatan = [];
    public $dataKondisiLingkunganKerja = [];
    public $dataResikoBahaya = [];
    public $dataSyaratJabatan;
    public $dataBakatKerja = [];
    public $dataTempramenKerja = [];
    public $dataMinatKerja = [];
    public $dataUpayaFisik = [];
    public $dataFungsiPekerjaan = [];
    public $dataPendidikan = [];
    public $dataPrestasiKerja = [];
    public $dataKelasJabatan = [];
    public $dataDataUnor;

    public $jumlah_waktu_penyelesaian;
    public $jumlah_kebutuhan_pegawai;



    public function mount($activeJabatanId = null)
    {
        $this->activeJabatanId = $activeJabatanId ?? "6512bd43d9caa6e02c990b0a82652dca";
        $activeJabatanId = $this->activeJabatanId;
        $this->dataDataJabatan = DB::table('data_jabatan')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray()[0];
        $this->dataTugasPokok = DB::table('tugas_pokok')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataBahanKerja = DB::table('bahan_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataPerangkatKerja = DB::table('perangkat_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataTanggungJawab = DB::table('tanggung_jawab')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataWewenang = DB::table('wewenang')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataKorelasiJabatan = DB::table('korelasi_jabatan')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataKondisiLingkunganKerja = DB::table('kondisi_lingkungan_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataResikoBahaya = DB::table('resiko_bahaya')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $syaratJabatan = DB::table('syarat_jabatan')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataSyaratJabatan = $syaratJabatan ? $syaratJabatan[0] : null;
        $this->dataBakatKerja = DB::table('bakat_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataTempramenKerja = DB::table('tempramen_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataMinatKerja = DB::table('minat_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataUpayaFisik = DB::table('upaya_fisik')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataFungsiPekerjaan = DB::table('fungsi_pekerjaan')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataPendidikan = DB::table('pendidikan')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        // dd($this->dataPendidikan);
        $this->dataPrestasiKerja = DB::table('prestasi_kerja')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataKelasJabatan = DB::table('kelas_jabatan')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray();
        $this->dataDataUnor = DB::table('data_unor')->where('id_jabatan', $activeJabatanId)->select('*')->get()->toArray()[0];

        $this->jumlah_waktu_penyelesaian = DB::table('tugas_pokok')->where('id_jabatan', $activeJabatanId)->sum('waktu_penyelesaian');
        $this->jumlah_kebutuhan_pegawai = DB::table('tugas_pokok')->where('id_jabatan', $activeJabatanId)->sum('kebutuhan_pegawai');
        
    }

    public function exportPDF()
    {
        $pdf = PDF::loadView('livewire.resume_export', [
            'dataDataJabatan' => $this->dataDataJabatan,
            'dataTugasPokok' => $this->dataTugasPokok,
            'dataBahanKerja' => $this->dataBahanKerja,
            'dataPerangkatKerja' => $this->dataPerangkatKerja,
            'dataTanggungJawab' => $this->dataTanggungJawab,
            'dataWewenang' => $this->dataWewenang,
            'dataKorelasiJabatan' => $this->dataKorelasiJabatan,
            'dataKondisiLingkunganKerja' => $this->dataKondisiLingkunganKerja,
            'dataResikoBahaya' => $this->dataResikoBahaya,
            'dataSyaratJabatan' => $this->dataSyaratJabatan,
            'dataBakatKerja' => $this->dataBakatKerja,
            'dataTempramenKerja' => $this->dataTempramenKerja,
            'dataMinatKerja' => $this->dataMinatKerja,
            'dataUpayaFisik' => $this->dataUpayaFisik,
            'dataFungsiPekerjaan' => $this->dataFungsiPekerjaan,
            'jumlah_waktu_penyelesaian' => $this->jumlah_waktu_penyelesaian,
            'jumlah_kebutuhan_pegawai' => $this->jumlah_kebutuhan_pegawai,
            'dataPendidikan' => $this->dataPendidikan,
            
            'dataPrestasiKerja' => $this->dataPrestasiKerja,
            'dataKelasJabatan' => $this->dataKelasJabatan,
            'dataDataUnor' => $this->dataDataUnor,
        ]);

        // Set paper size dan orientation
        // $pdf->setPaper('a4', 'portrait');
        
        // // Load CSS
        // $pdf->getDomPDF()->getOptions()->set('isHtml5ParserEnabled', true);
        // $pdf->getDomPDF()->getOptions()->set('isPhpEnabled', true);
        // $pdf->getDomPDF()->getOptions()->set('isRemoteEnabled', true);
        
        // // Load CSS file
        // $css = file_get_contents(public_path('css2'));
        // $css2 = file_get_contents(public_path('index.fbcc6d31.css'));
        // $pdf->getDomPDF()->getOptions()->set('defaultFont', 'Arial');
        
        // // Inject CSS ke PDF
        // $pdf->getDomPDF()->getCanvas()->get_cpdf()->setEncryption('', '', ['print', 'copy']);


        // return response()->streamDownload(function () use ($pdf) {
        //     echo $pdf->stream();    
        // }, 'resume.pdf');



       
        // return $pdf->download('resume.pdf');
        return view('livewire.resume_export', [
            'dataDataJabatan' => $this->dataDataJabatan,
            'dataTugasPokok' => $this->dataTugasPokok,
            'dataBahanKerja' => $this->dataBahanKerja,
            'dataPerangkatKerja' => $this->dataPerangkatKerja,
            'dataTanggungJawab' => $this->dataTanggungJawab,
            'dataWewenang' => $this->dataWewenang,
            'dataKorelasiJabatan' => $this->dataKorelasiJabatan,
            'dataKondisiLingkunganKerja' => $this->dataKondisiLingkunganKerja,
            'dataResikoBahaya' => $this->dataResikoBahaya,
            'dataSyaratJabatan' => $this->dataSyaratJabatan,
            'dataBakatKerja' => $this->dataBakatKerja,
            'dataTempramenKerja' => $this->dataTempramenKerja,
            'dataMinatKerja' => $this->dataMinatKerja,
            'dataUpayaFisik' => $this->dataUpayaFisik,
            'dataFungsiPekerjaan' => $this->dataFungsiPekerjaan,
            'jumlah_waktu_penyelesaian' => $this->jumlah_waktu_penyelesaian,
            'jumlah_kebutuhan_pegawai' => $this->jumlah_kebutuhan_pegawai,
            'dataPendidikan' => $this->dataPendidikan,
            
            'dataPrestasiKerja' => $this->dataPrestasiKerja,
            'dataKelasJabatan' => $this->dataKelasJabatan,
            'dataDataUnor' => $this->dataDataUnor,
        ]);
    }



    public function render()
    {
        return view('livewire.resume_export_2');
    }
}
