<?php

namespace App\Livewire;

use Livewire\Component;
use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Illuminate\Support\Facades\Http;

class DataPegawaiAsn extends Component
{
    public $activeJabatanId;
    public $dataPegawaiAsn;
    public $id_jabatan;
    public $nip_baru;
    public $nama;
    public $kedudukan_hukum;
    public $golongan;
    public $jabatan;
    public $isLoading = false;
    public $kebutuhanPegawai = 0;
    public $jumlahPegawaiSekarang = 0;
    public $sisaKuota = 0;

    public function mount($activeJabatanId)
    {
        $array = DB::table('data_pegawai_asn')
            ->where('id_jabatan', $activeJabatanId)
            ->select('*')->get()->toArray();

        $this->reset();

        $this->activeJabatanId = $activeJabatanId;

        $this->dataPegawaiAsn = $array;
        
        // Update informasi kuota
        $this->updateQuotaInfo();
    }

    public function testApiConnection()
    {
        try {
            // Set konfigurasi PHP untuk request yang lebih lama
            ini_set('max_execution_time', 300); // 5 menit
            ini_set('default_socket_timeout', 120); // 2 menit

            $response = Http::timeout(30)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'User-Agent' => 'Laravel/10.0'
                ])
                ->post("https://hirumi.xyz/bisa_kerja_api/api/get_pegawai_data", [
                    'nip' => $this->nip_baru
                ]);

            if ($response->successful()) {
                LivewireAlert::title('Berhasil!')
                    ->text('Koneksi ke API berhasil. Server API dapat diakses.')
                    ->success()
                    ->toast()
                    ->position('top-end')
                    ->show();
            } else {
                LivewireAlert::title('Error!')
                    ->text('Koneksi ke API gagal. Status: ' . $response->status())
                    ->error()
                    ->toast()
                    ->position('top-end')
                    ->show();
            }
        } catch (\Exception $e) {
            LivewireAlert::title('Error!')
                ->text('Tidak dapat terhubung ke API: ' . $e->getMessage())
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

    public function updateQuotaInfo()
    {
        // Ambil total kebutuhan pegawai dari tabel tugas_pokok
        $this->kebutuhanPegawai = round(DB::table('tugas_pokok')
            ->where('id_jabatan', $this->activeJabatanId)
            ->sum('kebutuhan_pegawai'));

        // Hitung jumlah pegawai yang sudah ada
        $this->jumlahPegawaiSekarang = DB::table('data_pegawai_asn')
            ->where('id_jabatan', $this->activeJabatanId)
            ->count();

        $this->sisaKuota = $this->kebutuhanPegawai - $this->jumlahPegawaiSekarang;
    }

    public function checkQuota()
    {
        $this->updateQuotaInfo();

        if ($this->sisaKuota > 0) {
            LivewireAlert::title('Info Kuota Pegawai')
                ->text("Kebutuhan pegawai: {$this->kebutuhanPegawai} orang. Sudah terisi: {$this->jumlahPegawaiSekarang} orang. Sisa kuota: {$this->sisaKuota} orang.")
                ->info()
                ->toast()
                ->position('top-end')
                ->show();
        } else {
            LivewireAlert::title('Kuota Penuh!')
                ->text("Kebutuhan pegawai: {$this->kebutuhanPegawai} orang. Sudah terisi: {$this->jumlahPegawaiSekarang} orang. Kuota sudah penuh!")
                ->warning()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

    /**
     * Mengambil data pegawai dari API eksternal
     * 
     * Troubleshooting Timeout di Hosting:
     * 1. Pastikan hosting mendukung outbound HTTP requests
     * 2. Cek apakah ada firewall yang memblokir request
     * 3. Pastikan DNS resolution berfungsi dengan baik
     * 4. Cek konfigurasi PHP di hosting (max_execution_time, memory_limit)
     * 5. Jika masih timeout, coba gunakan proxy atau VPN
     * 
     * Error Codes:
     * - cURL error 28: Timeout
     * - cURL error 6: Could not resolve host
     * - cURL error 7: Failed to connect to host
     * - cURL error 35: SSL/TLS connection error
     */
    public function fetchDataFromApi()
    {
        if (empty($this->nip_baru)) {
            LivewireAlert::title('Error!')
                ->text('NIP Baru harus diisi terlebih dahulu.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
            return;
        }

        // Set konfigurasi PHP untuk mengatasi timeout di hosting
        ini_set('max_execution_time', 300); // 5 menit
        ini_set('default_socket_timeout', 120); // 2 menit
        ini_set('memory_limit', '256M'); // Tambah memory limit jika diperlukan

        $this->isLoading = true;

        try {
            // Konfigurasi HTTP client dengan timeout yang lebih panjang
            $response = Http::timeout(120) // 2 menit timeout
                ->connectTimeout(30) // 30 detik untuk koneksi awal
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'User-Agent' => 'Laravel/10.0',
                    'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvc2ltcGVsYmtwc2RtLmJhbmR1bmdrYWIuZ28uaWRcL2FwaVwvdjFcL3Rva2VuIiwiaWF0IjoxNjk5NjEzODE1LCJuYmYiOjE2OTk2MTM4MTUsImp0aSI6InNyaVdudlltcVFxSVhnQXQiLCJzdWIiOjEsInBydiI6ImU0OTBjNTJiZmUzZjUwZTAyOWUyMzhkMTQwOWFkMzc3ODg0N2ExODAifQ.xiK0pYLwqyZ56dnMmRZGfJN42pcMoFolZwMy_WbsMJw'
                ])
                ->retry(3, 1000) // Retry 3 kali dengan delay 1 detik
                ->post("https://hirumi.xyz/bisa_kerja_api/api/get_pegawai_data", [
                    'nip' => $this->nip_baru
                ]);

            //dd($response);

            if ($response->successful()) {
                $data = $response->json();

                // Mengisi form dengan data dari API
                $this->nama = $data['data']['nama'] ?? '';
                $this->kedudukan_hukum = 'Aktif';
                $this->golongan = $data['data']['golongan'] ?? '';
                $this->jabatan = $data['data']['jabatan'] ?? '';

                LivewireAlert::title('Berhasil!')
                    ->text("Data pegawai {$this->nama} (NIP: {$this->nip_baru}) berhasil diambil dari API. Silakan periksa dan simpan data.")
                    ->success()
                    ->toast()
                    ->position('top-end')
                    ->show();
            } else {
                $statusCode = $response->status();
                $errorMessage = 'Gagal mengambil data dari API.';

                if ($statusCode == 404) {
                    $errorMessage = 'NIP tidak ditemukan dalam database API.';
                } elseif ($statusCode == 401) {
                    $errorMessage = 'Token API tidak valid atau expired.';
                } elseif ($statusCode == 429) {
                    $errorMessage = 'Terlalu banyak request ke API. Silakan tunggu sebentar.';
                } elseif ($statusCode >= 500) {
                    $errorMessage = 'Server API sedang bermasalah. Silakan coba lagi nanti.';
                }

                LivewireAlert::title('Error!')
                    ->text($errorMessage)
                    ->error()
                    ->toast()
                    ->position('top-end')
                    ->show();
            }
        } catch (\Exception $e) {
            $errorMessage = 'Terjadi kesalahan saat mengambil data dari API.';
            $errorCode = $e->getCode();
            $errorText = $e->getMessage();

            // Log error untuk debugging
            \Log::error('API Error: ' . $errorText, [
                'nip' => $this->nip_baru,
                'code' => $errorCode,
                'message' => $errorText
            ]);

            dd($errorText);

            if (str_contains($errorText, 'cURL error 28')) {
                $errorMessage = 'Koneksi ke API timeout (120 detik). Silakan coba lagi atau hubungi administrator.';
            } elseif (str_contains($errorText, 'cURL error 6')) {
                $errorMessage = 'Tidak dapat terhubung ke API. Periksa koneksi internet atau DNS server.';
            } elseif (str_contains($errorText, 'cURL error 7')) {
                $errorMessage = 'Tidak dapat terhubung ke server API. Server mungkin sedang down.';
            } elseif (str_contains($errorText, 'cURL error 35')) {
                $errorMessage = 'Koneksi SSL/TLS bermasalah. Silakan coba lagi.';
            } elseif (str_contains($errorText, '404')) {
                $errorMessage = 'NIP tidak ditemukan dalam database API.';
            } elseif (str_contains($errorText, 'timeout')) {
                $errorMessage = 'Request timeout. Silakan coba lagi dengan koneksi yang lebih stabil.';
            }

            LivewireAlert::title('Error!')
                ->text($errorMessage)
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }

        $this->isLoading = false;
    }

    public function resetForm()
    {
        $this->reset(['nip_baru', 'nama', 'kedudukan_hukum', 'golongan', 'jabatan']);

        LivewireAlert::title('Berhasil!')
            ->text('Form berhasil direset.')
            ->success()
            ->toast()
            ->position('top-end')
            ->show();
    }

    public function insertDataPegawaiAsn()
    {
        // Validasi input
        if (
            empty($this->nip_baru) || empty($this->nama) ||
            empty($this->kedudukan_hukum) || empty($this->golongan) || empty($this->jabatan)
        ) {
            LivewireAlert::title('Error!')
                ->text('Semua field harus diisi.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
            return;
        }

        // Cek apakah NIP sudah ada di database
        $existingPegawai = DB::table('data_pegawai_asn')
            ->where('nip_baru', $this->nip_baru)
            ->where('id_jabatan', $this->activeJabatanId)
            ->first();

        if ($existingPegawai) {
            LivewireAlert::title('Error!')
                ->text('NIP Baru sudah terdaftar dalam jabatan ini.')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
            return;
        }

        // Validasi jumlah kebutuhan pegawai dari tabel tugas_pokok
        $kebutuhanPegawai = round(DB::table('tugas_pokok')
            ->where('id_jabatan', $this->activeJabatanId)
            ->sum('kebutuhan_pegawai'));

        // Hitung jumlah pegawai yang sudah ada
        $jumlahPegawaiSekarang = DB::table('data_pegawai_asn')
            ->where('id_jabatan', $this->activeJabatanId)
            ->count();

        // Cek apakah masih bisa menambah pegawai
        if ($jumlahPegawaiSekarang >= $kebutuhanPegawai) {
            LivewireAlert::title('Error!')
                ->text("Tidak dapat menambah pegawai. Kebutuhan pegawai untuk jabatan ini adalah {$kebutuhanPegawai} orang, dan sudah terisi {$jumlahPegawaiSekarang} orang.")
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
            return;
        }

        DB::table('data_pegawai_asn')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'nip_baru' => $this->nip_baru,
            'nama' => $this->nama,
            'kedudukan_hukum' => $this->kedudukan_hukum,
            'golongan' => $this->golongan,
            'jabatan' => $this->jabatan,
        ]);

        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menambah Data Pegawai Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataPegawaiAsn dan $activeJabatanId
        $this->reset(['nip_baru', 'nama', 'kedudukan_hukum', 'golongan', 'jabatan']);

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

    public function deletePegawaiAsn($nip_baru)
    {
        try {
            // Ambil data pegawai sebelum dihapus untuk konfirmasi
            $pegawai = DB::table('data_pegawai_asn')
                ->where('nip_baru', $nip_baru)
                ->where('id_jabatan', $this->activeJabatanId)
                ->first();
            
            if (!$pegawai) {
                LivewireAlert::title('Error!')
                    ->text('Data pegawai tidak ditemukan.')
                    ->error()
                    ->toast()
                    ->position('top-end')
                    ->show();
                return;
            }

            // Hapus data pegawai berdasarkan NIP dan ID jabatan
            DB::table('data_pegawai_asn')
                ->where('nip_baru', $nip_baru)
                ->where('id_jabatan', $this->activeJabatanId)
                ->delete();

                DB::table('logs')->insert([
                    'user_id' => session('id'),
                    'username' => session('username'),
                    'activity' => 'Menghapus Data Pegawai Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->header('User-Agent'),
                    'created_at' => now(),
                ]);

            LivewireAlert::title('Berhasil!')
                ->text("Data pegawai {$pegawai->nama} (NIP: {$pegawai->nip_baru}) berhasil dihapus.")
                ->success()
                ->toast()
                ->position('top-end')
                ->show();

            // Refresh data setelah penghapusan
            $this->mount($this->activeJabatanId);

        } catch (\Exception $e) {
            LivewireAlert::title('Error!')
                ->text('Gagal menghapus data pegawai: ' . $e->getMessage())
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }
    }

    public function render()
    {
        return view('livewire.data-pegawai-asn');
    }
}
