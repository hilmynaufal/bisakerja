<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\DataJabatan;
use App\Models\TugasPokok;
use App\Models\BahanKerja;
use App\Models\PerangkatKerja;
use App\Models\TanggungJawab;
use App\Models\Wewenang;
use App\Models\KorelasiJabatan;
use App\Models\ResikoBahaya;
use App\Models\KondisiLingkunganKerja;
use App\Models\SyaratJabatan;
use App\Models\BakatKerja;
use App\Models\TempramenKerja;
use App\Models\MinatKerja;
use App\Models\UpayaFisik;
use App\Models\FungsiPekerjaan;

class ResumeController extends Controller
{
    public function exportPDF()
    {
        $dataDataJabatan = DataJabatan::first();
        $dataTugasPokok = TugasPokok::all();
        $dataBahanKerja = BahanKerja::all();
        $dataPerangkatKerja = PerangkatKerja::all();
        $dataTanggungJawab = TanggungJawab::all();
        $dataWewenang = Wewenang::all();
        $dataKorelasiJabatan = KorelasiJabatan::all();
        $dataResikoBahaya = ResikoBahaya::all();
        $dataKondisiLingkunganKerja = KondisiLingkunganKerja::all();
        $dataSyaratJabatan = SyaratJabatan::first();
        $dataBakatKerja = BakatKerja::all();
        $dataTempramenKerja = TempramenKerja::all();
        $dataMinatKerja = MinatKerja::all();
        $dataUpayaFisik = UpayaFisik::all();
        $dataFungsiPekerjaan = FungsiPekerjaan::all();

        $data = [
            'dataDataJabatan' => $dataDataJabatan,
            'dataTugasPokok' => $dataTugasPokok,
            'dataBahanKerja' => $dataBahanKerja,
            'dataPerangkatKerja' => $dataPerangkatKerja,
            'dataTanggungJawab' => $dataTanggungJawab,
            'dataWewenang' => $dataWewenang,
            'dataKorelasiJabatan' => $dataKorelasiJabatan,
            'dataResikoBahaya' => $dataResikoBahaya,
            'dataKondisiLingkunganKerja' => $dataKondisiLingkunganKerja,
            'dataSyaratJabatan' => $dataSyaratJabatan,
            'dataBakatKerja' => $dataBakatKerja,
            'dataTempramenKerja' => $dataTempramenKerja,
            'dataMinatKerja' => $dataMinatKerja,
            'dataUpayaFisik' => $dataUpayaFisik,
            'dataFungsiPekerjaan' => $dataFungsiPekerjaan,
        ];

        $pdf = PDF::loadView('livewire.resume', $data);
        
        // Set paper size dan orientation
        $pdf->setPaper('a4', 'portrait');
        
        // Load CSS
        $pdf->getDomPDF()->getOptions()->set('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->getOptions()->set('isPhpEnabled', true);
        $pdf->getDomPDF()->getOptions()->set('isRemoteEnabled', true);
        
        // Load CSS file
        $css = file_get_contents(public_path('css/pdf.css'));
        $pdf->getDomPDF()->getOptions()->set('defaultFont', 'Arial');
        
        // Inject CSS ke PDF
        $pdf->getDomPDF()->getCanvas()->get_cpdf()->setEncryption('', '', ['print', 'copy']);
        
        return $pdf->download('resume.pdf');
    }
} 