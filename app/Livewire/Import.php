<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Illuminate\Support\Facades\DB;

class Import extends Component
{

    public $activeJabatanId;
    public $importMode = 'append'; // 'append' atau 'replace'

    public function render()
    {
        return view('livewire.import');
    }

    public function mount($activeJabatanId)
    {
        $this->activeJabatanId = $activeJabatanId;
    }

    use WithFileUploads;

    public $file;

    public function updatedFile()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);
    }

    public function confirmReplace()
    {
        if ($this->importMode === 'replace') {
            LivewireAlert::title('Konfirmasi Replace Data')
                ->text('Mode Replace akan menghapus semua data existing dan menggantinya dengan data dari file Excel. Apakah Anda yakin ingin melanjutkan?')
                ->asConfirm()
                ->onConfirm('import')
                ->show();
        } else {
            $this->import();
        }
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        // Mulai transaction database
        DB::beginTransaction();

        try {
            // Jika mode replace, simpan data existing terlebih dahulu
            $existingData = [];
            if ($this->importMode === 'replace') {
                $existingData = [
                    'tugas_pokok' => DB::table('tugas_pokok')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'bahan_kerja' => DB::table('bahan_kerja')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'perangkat_kerja' => DB::table('perangkat_kerja')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'tanggung_jawab' => DB::table('tanggung_jawab')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'wewenang' => DB::table('wewenang')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'korelasi_jabatan' => DB::table('korelasi_jabatan')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'kondisi_lingkungan_kerja' => DB::table('kondisi_lingkungan_kerja')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'resiko_bahaya' => DB::table('resiko_bahaya')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'pendidikan' => DB::table('pendidikan')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'bakat_kerja' => DB::table('bakat_kerja')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'minat_kerja' => DB::table('minat_kerja')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'upaya_fisik' => DB::table('upaya_fisik')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'fungsi_pekerjaan' => DB::table('fungsi_pekerjaan')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'tempramen_kerja' => DB::table('tempramen_kerja')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'prestasi_kerja' => DB::table('prestasi_kerja')->where('id_jabatan', $this->activeJabatanId)->get()->toArray(),
                    'syarat_jabatan' => DB::table('syarat_jabatan')->where('id_jabatan', $this->activeJabatanId)->first(),
                ];

                // Hapus data existing
                DB::table('tugas_pokok')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('bahan_kerja')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('perangkat_kerja')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('tanggung_jawab')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('wewenang')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('korelasi_jabatan')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('kondisi_lingkungan_kerja')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('resiko_bahaya')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('pendidikan')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('bakat_kerja')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('minat_kerja')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('upaya_fisik')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('fungsi_pekerjaan')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('tempramen_kerja')->where('id_jabatan', $this->activeJabatanId)->delete();
                DB::table('prestasi_kerja')->where('id_jabatan', $this->activeJabatanId)->delete();
                // Syarat jabatan diupdate jadi null
                DB::table('syarat_jabatan')->where('id_jabatan', $this->activeJabatanId)->update([
                    'jenis_kelamin' => null,
                    'umur' => null,
                    'tinggi_badan' => null,
                    'berat_badan' => null,
                    'postur_badan' => null,
                    'penampilan' => null,
                    'keterampilan' => null,
                ]);
            }

            $path = $this->file->getRealPath();

            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestRow();

            $namaJabatan = null;
            $namaJabatanKorelasi = null;
            $test = null;
            $kodeJabatan = null;
            $unitKerjaList = [];
            $kualifikasiList = [];
            $tugasPokokList = [];
            $perangkatKerjaList = [];
            $bahanKerjaList = [];
            $hasilKerjaList = [];
            $wewenangList = [];
            $tanggungJawabList = [];
            $resikoBahayaList = [];
            $kondisiLingkunganList = [];
            $korelasiJabatanList = [];
            $ikhtisarJabatan = null;
            $prestasiKerja = [];
            $kelasJabatan = null;
            for ($row = 1; $row <= 300; $row++) {
                $colB = trim((string) $sheet->getCell("B$row")->getValue());
                $test = $test . $sheet->getCell("A$row")->getValue();

                if (strtolower($colB) === 'nama jabatan' && !$namaJabatan) {
                    $namaJabatan = $sheet->getCell("C$row")->getValue();
                }

                if (strtolower($colB) === 'kode jabatan' && !$kodeJabatan) {
                    $kodeJabatan = $sheet->getCell("C$row")->getValue();
                }

                if (strtolower($colB) === 'ikhtisar jabatan') {
                    $ikhtisarJabatan = $sheet->getCell("C$row")->getValue();
                }

                if (strtolower($colB) === 'unit kerja') {
                    while ($row <= $highestRow) {
                        $currentColB = trim((string) $sheet->getCell("B$row")->getValue());

                        // Jika kolom B TIDAK kosong dan TIDAK sama dengan 'Unit Kerja', berhenti
                        if ($currentColB !== '' && strtolower($currentColB) !== 'unit kerja') {
                            break;
                        }

                        $unitValue = $sheet->getCell("G$row")->getValue();
                        $unitKerjaList[] = $unitValue;
                        $row++;
                    }

                    $row--; // Karena for-loop akan menambah 1 lagi
                }

                if (strtolower($colB) === 'kualifikasi jabatan') {
                    while ($row <= $highestRow) {
                        $currentColB = trim((string) $sheet->getCell("B$row")->getValue());

                        if ($currentColB !== '' && strtolower($currentColB) !== 'kualifikasi jabatan') {
                            break;
                        }

                        $kualifikasiValue = $sheet->getCell("G$row")->getValue();
                        $kualifikasiList[] = $kualifikasiValue;
                        $row++;
                    }

                    $row--;
                }


                if (strtolower($colB) === 'tugas pokok') {
                    $row += 3; // skip header baris
                    while ($row <= $highestRow) {
                        $currentColD = trim((string) $sheet->getCell("D$row")->getValue());

                        // Berhenti jika kolom D berisi "Jumlah"
                        if (strtolower($currentColD) === 'jumlah') {
                            break;
                        }


                        // Ambil semua kolom yang diperlukan
                        $uraianTugas = $sheet->getCell("E$row")->getValue();
                        $satuanHasilKerja = $sheet->getCell("L$row")->getValue();
                        $jumlahHasil = $sheet->getCell("M$row")->getValue();
                        $waktuPenyelesaian = $sheet->getCell("N$row")->getValue();
                        $waktuEfektif = $sheet->getCell("O$row")->getValue();

                        // Jika baris kosong, berhenti
                        if (empty($uraianTugas) && empty($satuanHasilKerja) && empty($jumlahHasil) && empty($waktuPenyelesaian) && empty($waktuEfektif)) {
                            break;
                        }

                        // Hanya tambahkan jika uraian tugas tidak kosong (bisa disesuaikan sesuai kebutuhan)
                        if (!empty($uraianTugas)) {
                            $tugasPokokList[] = [
                                'id_jabatan' => $this->activeJabatanId,
                                'uraian_tugas' => $uraianTugas,
                                'satuan_hasil_kerja' => $satuanHasilKerja,
                                'beban_kerja' => $jumlahHasil,
                                'waktu_penyelesaian' => $waktuPenyelesaian,
                                'waktu_kerja_efektif' => $waktuEfektif,
                            ];
                        }

                        $row++;
                    }

                    $row--; // Koreksi karena for-loop akan menambah 1
                }

                if (strtolower($colB) === 'hasil kerja') {
                    while ($row <= $highestRow) {
                        $currentColB = trim((string) $sheet->getCell("B$row")->getValue());

                        // Jika kolom B terisi dan bukan lagi 'Hasil Kerja', stop loop
                        if ($currentColB !== '' && strtolower($currentColB) !== 'hasil kerja') {
                            break;
                        }

                        $hasilValue = $sheet->getCell("D$row")->getValue();
                        if (!empty($hasilValue)) {
                            $hasilKerjaList[] = [
                                'id_jabatan' => $this->activeJabatanId,
                                'uraian_hasil_kerja' => $hasilValue,
                            ];
                        }

                        $row++;
                    }

                    $row--; // koreksi karena for-loop akan tambah 1 lagi
                }

                if (strtolower($colB) === 'perangkat kerja') {
                    $row += 2; // skip header baris
                    while ($row <= $highestRow) {

                        $nama = trim((string) $sheet->getCell("E$row")->getValue());
                        $penggunaan = trim((string) $sheet->getCell("M$row")->getValue());

                        if (empty($nama) && empty($penggunaan)) {
                            break;
                        }

                        if (!empty($nama)) {
                            $perangkatKerjaList[] = [
                                'id_jabatan' => $this->activeJabatanId,
                                'uraian_perangkat_kerja' => $nama,
                                'penggunaan' => $penggunaan,
                            ];
                        }

                        $row++;
                    }
                    $row--;
                }

                if (strtolower($colB) === 'bahan kerja') {
                    $row += 2; // skip header baris
                    while ($row <= $highestRow) {

                        $nama = trim((string) $sheet->getCell("E$row")->getValue());
                        $penggunaan = trim((string) $sheet->getCell("M$row")->getValue());

                        // Jika baris kosong, berhenti
                        if (empty($nama) && empty($penggunaan)) {
                            break;
                        }

                        if (!empty($nama)) {
                            $bahanKerjaList[] = [
                                'id_jabatan' => $this->activeJabatanId,
                                'uraian_bahan_kerja' => $nama,
                                'penggunaan' => $penggunaan,
                            ];
                        }

                        $row++;
                    }
                }

                // Loop Tanggung Jawab
                if (strtolower($colB) === 'tanggung jawab') {
                    $row += 2; // skip header
                    while ($row <= $highestRow) {
                        $currentColB = trim((string) $sheet->getCell("B$row")->getValue());

                        // Stop jika kolom B tidak kosong dan bukan "Tanggung Jawab"
                        if (!empty($currentColB) && strtolower($currentColB) !== 'tanggung jawab') {
                            break;
                        }

                        $uraian = trim((string) $sheet->getCell("E$row")->getValue());
                        if (!empty($uraian)) {
                            $tanggungJawabList[] = [
                                'id_jabatan' => $this->activeJabatanId,
                                'uraian_tanggung_jawab' => $uraian,
                            ];
                        }

                        $row++;
                    }

                    $row--; // koreksi for-loop
                }

                // Loop Wewenang
                if (strtolower($colB) === 'wewenang') {
                    $row += 2; // skip header
                    while ($row <= $highestRow) {
                        $currentColB = trim((string) $sheet->getCell("B$row")->getValue());

                        if (!empty($currentColB) && strtolower($currentColB) !== 'wewenang') {
                            break;
                        }

                        $uraian = trim((string) $sheet->getCell("E$row")->getValue());
                        if (!empty($uraian)) {
                            $wewenangList[] = [
                                'id_jabatan' => $this->activeJabatanId,
                                'uraian_wewenang' => $uraian,
                            ];
                        }

                        $row++;
                    }

                    $row--; // koreksi for-loop
                }

                //  Korelasi Jabatan
                if (strtolower($colB) === 'korelasi jabatan') {
                    $row += 2; // skip header
                    while ($row <= $highestRow) {
                        $currentB = strtoupper(trim((string) $sheet->getCell("B$row")->getValue()));
                        if (!empty($currentB) && strtolower($currentB) !== 'korelasi jabatan') {
                            break;
                        }

                        $namaJabatanKorelasi = trim((string) $sheet->getCell("E$row")->getValue());
                        $unitKerja = trim((string) $sheet->getCell("K$row")->getValue());
                        $dalamHal = trim((string) $sheet->getCell("O$row")->getValue());

                        if (!empty($unitKerja)) {
                            $korelasiJabatanList[] = [
                                'id_jabatan' => $this->activeJabatanId,
                                'nama_jabatan' => $namaJabatanKorelasi,
                                'unit_kerja' => $unitKerja,
                                'dalam_hal' => $dalamHal,
                            ];
                        }

                        $row++;
                    }

                    $row--;
                }

                // Kondisi Lingkungan Kerja
                if (strtolower($colB) === 'kondisi lingkungan kerja') {
                    $row += 2;
                    while ($row <= $highestRow) {
                        $currentB = strtoupper(trim((string) $sheet->getCell("B$row")->getValue()));
                        if (!empty($currentB) && strtolower($currentB) !== 'kondisi lingkungan kerja') {
                            break;
                        }

                        $aspek = trim((string) $sheet->getCell("E$row")->getValue());
                        $faktor = trim((string) $sheet->getCell("M$row")->getValue());

                        if (!empty($aspek)) {
                            $kondisiLingkunganList[] = [
                                'id_jabatan' => $this->activeJabatanId,
                                'aspek' => $aspek,
                                'faktor' => $faktor,
                            ];
                        }

                        $row++;
                    }

                    $row--;
                }

                // Resiko Bahaya
                if (strtolower($colB) === 'resiko bahaya') {
                    $row += 2;
                    while ($row <= $highestRow) {
                        $currentB = strtoupper(trim((string) $sheet->getCell("B$row")->getValue()));
                        if (!empty($currentB) && strtolower($currentB) !== 'resiko bahaya') {
                            break;
                        }

                        $namaResiko = trim((string) $sheet->getCell("E$row")->getValue());
                        $penyebab = trim((string) $sheet->getCell("M$row")->getValue());

                        if (!empty($namaResiko)) {
                            $resikoBahayaList[] = [
                                'id_jabatan' => $this->activeJabatanId,
                                'nama_resiko' => $namaResiko,
                                'penyebab' => $penyebab,
                            ];
                        }

                        $row++;
                    }

                    $row--;
                }

                // Prestasi Kerja yang Diharapkan
                if (strtolower($colB) === 'prestasi kerja yang diharapkan') {

                    while ($row <= $highestRow) {
                        $nextB = strtoupper(trim((string) $sheet->getCell("B$row")->getValue()));

                        // Jika kolom B sudah berubah (bukan kosong dan bukan "PRESTASI...") maka berhenti
                        if (!empty($nextB) && strtolower($nextB) !== 'prestasi kerja yang diharapkan')
                            break;

                        $value = trim((string) $sheet->getCell("D$row")->getValue());
                        if (!empty($value)) {
                            $prestasiKerja[] = [
                                'id_jabatan' => $this->activeJabatanId,
                                'uraian_prestasi_kerja' => $value,
                            ];
                        }

                        $row++;
                    }

                    $row--; // kembalikan satu langkah agar tidak skip baris berikutnya
                }

                // Kelas Jabatan
                if (strtolower($colB) === 'kelas jabatan') {
                    $kelasJabatan = $sheet->getCell("C$row")->getValue();
                    // dd($kelasJabatan);
                }


                if (strtolower($colB) === 'syarat jabatan') {
                    // $row += 1; // lewati header

                    while ($row <= $highestRow) {
                         $nextB = strtoupper(trim((string) $sheet->getCell("B$row")->getValue()));
                        $subBagian = strtolower(trim((string) $sheet->getCell("D$row")->getValue()));

                        if (!empty($nextB) && strtolower($nextB) !== 'syarat jabatan') {
                            $row--;
                            break;
                        }

                        switch ($subBagian) {
                            case 'keterampilan kerja':
                                $syaratJabatan['keterampilan_kerja'] = trim((string) $sheet->getCell("G$row")->getValue());
                                $row++;
                                break;

                            case 'bakat kerja':
                                while ($row <= $highestRow) {
                                    $nextD = strtolower(trim((string) $sheet->getCell("D$row")->getValue()));
                                    if (!empty($nextD) && $nextD !== 'bakat kerja')
                                        break;

                                    $kode = trim((string) $sheet->getCell("H$row")->getValue());
                                    $value = trim((string) $sheet->getCell("J$row")->getValue());
                                    if (!empty($value)) {
                                        $syaratJabatan['bakat_kerja'][] = [
                                            'id_jabatan' => $this->activeJabatanId,
                                            'kode' => $kode,
                                            'nama_item' => $value,
                                        ];
                                    }
                                    $row++;
                                }
                                break;

                            case 'tempramen kerja':
                                while ($row <= $highestRow) {
                                    $nextD = strtolower(trim((string) $sheet->getCell("D$row")->getValue()));
                                    if (!empty($nextD) && $nextD !== 'tempramen kerja')
                                        break;

                                    $kode = trim((string) $sheet->getCell("H$row")->getValue());
                                    $value = trim((string) $sheet->getCell("J$row")->getValue());
                                    if (!empty($value)) {
                                        $syaratJabatan['tempramen_kerja'][] = [
                                            'id_jabatan' => $this->activeJabatanId,
                                            'kode' => $kode,
                                            'nama_item' => $value,
                                        ];
                                    }
                                    $row++;
                                }
                                break;

                            case 'minat kerja':
                                while ($row <= $highestRow) {
                                    $nextD = strtolower(trim((string) $sheet->getCell("D$row")->getValue()));
                                    if (!empty($nextD) && $nextD !== 'minat kerja')
                                        break;

                                    $kode = trim((string) $sheet->getCell("G$row")->getValue());
                                    $value = trim((string) $sheet->getCell("J$row")->getValue());
                                    if (!empty($value)) {
                                        $syaratJabatan['minat_kerja'][] = [
                                            'id_jabatan' => $this->activeJabatanId,
                                            'kode' => $kode,
                                            'nama_item' => $value,
                                        ];
                                    }
                                    $row++;
                                }
                                break;

                            case 'upaya fisik':
                                while ($row <= $highestRow) {
                                    $nextD = strtolower(trim((string) $sheet->getCell("D$row")->getValue()));
                                    if (!empty($nextD) && $nextD !== 'upaya fisik')
                                        break;

                                    $kode = trim((string) $sheet->getCell("G$row")->getValue());
                                    $value = trim((string) $sheet->getCell("H$row")->getValue());
                                    if (!empty($value)) {
                                        $syaratJabatan['upaya_fisik'][] = [
                                            'id_jabatan' => $this->activeJabatanId,
                                            'kode' => $kode,
                                            'nama_item' => $value,
                                        ];
                                    }
                                    $row++;
                                }
                                break;

                            case 'kondisi fisik':
                                while ($row <= $highestRow) {
                                    $nextD = strtolower(trim((string) $sheet->getCell("D$row")->getValue()));
                                    if (!empty($nextD) && $nextD !== 'kondisi fisik')
                                        break;

                                    $value = trim((string) $sheet->getCell("L$row")->getValue());
                                    if (!empty($value)) {
                                        $syaratJabatan['kondisi_fisik'][] = $value;
                                    }
                                    $row++;
                                }
                                break;

                            case 'fungsi pekerjaan':
                                while ($row <= $highestRow) {
                                    $nextD = strtolower(trim((string) $sheet->getCell("D$row")->getValue()));
                                    if (!empty($nextD) && $nextD !== 'fungsi pekerjaan')
                                        break;

                                    $kode = trim((string) $sheet->getCell("H$row")->getValue());
                                    $value = trim((string) $sheet->getCell("J$row")->getValue());
                                    if (!empty($kode) || !empty($value)) {
                                        $syaratJabatan['fungsi_pekerjaan'][] = [
                                            'id_jabatan' => $this->activeJabatanId,
                                            'kode' => $kode,
                                            'nama_item' => $value,
                                        ];
                                    }
                                    $row++;
                                }
                                break;

                            default:
                                $row++;
                                break;
                        }
                    }

                    $row--;
                }

                
            }

            // dd($syaratJabatan);

            //injeksi data jabatan
            $dataJabatan = [
                'id_jabatan' => $this->activeJabatanId,
                'nama_jabatan' => ucwords(strtolower($namaJabatan)),
                'kode_jabatan' => $kodeJabatan,
                'jpt_madya' => $unitKerjaList[1],
                'jpt_pratama' => $unitKerjaList[2],
                'administrator' => $unitKerjaList[3],
                'pengawas' => $unitKerjaList[4],
                'ikhtisar_jabatan' => $ikhtisarJabatan,
                'pendidikan' => $kualifikasiList[array_key_first($kualifikasiList)],
                'pengalaman' => $kualifikasiList[array_key_last($kualifikasiList)],
                // 'kualifikasi_jabatan' => $kualifikasiList[2],
            ];

            DB::table('data_jabatan')->updateOrInsert(
                ['id_jabatan' => $dataJabatan['id_jabatan']],
                $dataJabatan
            );

            //injeksi pendidikan
            $arrayPendidikan = explode(',', $kualifikasiList[1]);
            $dataPendidikan = [];
            foreach ($arrayPendidikan as $pendidikan) {
                $dataPendidikan[] = [
                    'id_jabatan' => $this->activeJabatanId,
                    'nama_pendidikan' => $pendidikan,
                ];
            }
            DB::table('pendidikan')->insert($dataPendidikan);

            // injeksi tugas pokok
            for ($i = 0; $i < count($tugasPokokList); $i++) {
                // dd($tugasPokokList);
                $tugasPokokList[$i]['hasil_kerja'] = $hasilKerjaList[$i]['uraian_hasil_kerja'];
                $kebutuhanPegawai = ($tugasPokokList[$i]['beban_kerja'] * $tugasPokokList[$i]['waktu_penyelesaian']) / $tugasPokokList[$i]['waktu_kerja_efektif'];
                $tugasPokokList[$i]['kebutuhan_pegawai'] = $kebutuhanPegawai;
            }
            DB::table('tugas_pokok')->insert($tugasPokokList);

            DB::table('bahan_kerja')->insert($bahanKerjaList);
            DB::table('perangkat_kerja')->insert($perangkatKerjaList);
            DB::table('tanggung_jawab')->insert($tanggungJawabList);
            DB::table('wewenang')->insert($wewenangList);
            DB::table('korelasi_jabatan')->insert($korelasiJabatanList);
            DB::table('kondisi_lingkungan_kerja')->insert($kondisiLingkunganList);
            DB::table('resiko_bahaya')->insert($resikoBahayaList);

            //injeksi syarat jabatan
            DB::table('syarat_jabatan')->updateOrInsert(
                ['id_jabatan' => $this->activeJabatanId],
                [
                    'jenis_kelamin' => $syaratJabatan['kondisi_fisik'][0],
                    'umur' => $syaratJabatan['kondisi_fisik'][1],
                    'tinggi_badan' => $syaratJabatan['kondisi_fisik'][2],
                    'berat_badan' => $syaratJabatan['kondisi_fisik'][3],
                    'postur_badan' => $syaratJabatan['kondisi_fisik'][4],
                    'penampilan' => $syaratJabatan['kondisi_fisik'][5],
                    'keterampilan' => $syaratJabatan['keterampilan_kerja'],
                ]
            );

            //injeksi bakat kerja
            DB::table('bakat_kerja')->insert($syaratJabatan['bakat_kerja']);

            //injeksi minat kerja
            DB::table('minat_kerja')->insert($syaratJabatan['minat_kerja']);

            //injeksi upaya fisik
            DB::table('upaya_fisik')->insert($syaratJabatan['upaya_fisik']);

            //injeksi fungsi pekerjaan
            DB::table('fungsi_pekerjaan')->insert($syaratJabatan['fungsi_pekerjaan']);

            //injeksi tempramen kerja
            DB::table('tempramen_kerja')->insert($syaratJabatan['tempramen_kerja']);

            //injeksi prestasi kerja
            DB::table('prestasi_kerja')->insert($prestasiKerja);

            //injeksi kelas jabatan
            DB::table('kelas_jabatan')->updateOrInsert([
                'id_jabatan' => $this->activeJabatanId,
            ], [
                'kelas' => $kelasJabatan ?? 0,
            ]);

            // Commit transaction jika semua berhasil
            DB::commit();

            session()->flash('message', 'Data Berhasil diimport!');

            DB::table('logs')->insert([
                'user_id' => session('id'),
                'username' => session('username'),
                'activity' => 'Melakukan Import Excel Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
                'ip_address' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
                'created_at' => now(),
            ]);

            LivewireAlert::title('Berhasil!')
                ->text('Data Berhasil tersimpan.')
                ->info()
                ->toast()
                ->position('top-end')
                ->show();

        } catch (\Exception $e) {
            // Rollback transaction jika terjadi error
            DB::rollback();

            // Jika mode replace dan ada data existing, restore data
            if ($this->importMode === 'replace' && !empty($existingData)) {
                try {
                    // Restore data existing
                    foreach ($existingData as $table => $data) {
                        if ($table === 'syarat_jabatan') {
                            if ($data) {
                                DB::table($table)->where('id_jabatan', $this->activeJabatanId)->update([
                                    'jenis_kelamin' => $data->jenis_kelamin,
                                    'umur' => $data->umur,
                                    'tinggi_badan' => $data->tinggi_badan,
                                    'berat_badan' => $data->berat_badan,
                                    'postur_badan' => $data->postur_badan,
                                    'penampilan' => $data->penampilan,
                                    'keterampilan' => $data->keterampilan,
                                ]);
                            }
                        } else {
                            if (!empty($data)) {
                                DB::table($table)->insert($data);
                            }
                        }
                    }
                } catch (\Exception $restoreError) {
                    // Jika restore juga gagal, log error
                    \Log::error('Failed to restore data after import error: ' . $restoreError->getMessage());
                }
            }

            session()->flash('error', 'Gagal import data: ' . $e->getMessage());

            LivewireAlert::title('Error!')
                ->text('Gagal import data: ' . $e->getMessage())
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

}
