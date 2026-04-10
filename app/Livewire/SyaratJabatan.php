<?php

namespace App\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use DB;

class SyaratJabatan extends Component
{

    public $bakatKerjaOption;
    public $bakatKerja;
    public $activeJabatanId;
    public $tempramenKerjaOption;
    public $tempramenKerja;

    public $minatKerjaOption;
    public $minatKerja;

    public $upayaFisik;
    public $upayaFisikOption;

    public $jenisKelamin;
    public $posturBadan;
    public $umur;
    public $tinggiBadan;
    public $beratBadan;
    public $penampilan;
    public $keterampilan;

    public $fungsiPekerjaanOption;
    public $fungsiPekerjaan;

    public function render()
    {
        // Mengambil data dari tabel syarat_jabatan berdasarkan id_jabatan
        $syaratJabatan = \DB::table('syarat_jabatan')->where('id_jabatan', $this->activeJabatanId)->first();

        // dd($syaratJabatan);

        if ($syaratJabatan) {
            $this->jenisKelamin = $syaratJabatan->jenis_kelamin;
            $this->posturBadan = $syaratJabatan->postur_badan;
            $this->umur = $syaratJabatan->umur;
            $this->tinggiBadan = $syaratJabatan->tinggi_badan;
            $this->beratBadan = $syaratJabatan->berat_badan;
            $this->penampilan = $syaratJabatan->penampilan;
            $this->keterampilan = $syaratJabatan->keterampilan;
        }

        // Mengambil data dari tabel item_syarat_jabatan dengan kondisi kategori_id = 1
        if (empty($this->bakatKerjaOption)) {
            $this->bakatKerjaOption = \DB::table('item_syarat_jabatan')->where('kategori_id', 1)->get();
        }
        if (empty($this->bakatKerja)) {
            $this->bakatKerja = \DB::table('bakat_kerja')->where('id_jabatan', $this->activeJabatanId)->get();
        }
        if (empty($this->tempramenKerjaOption)) {
            $this->tempramenKerjaOption = \DB::table('item_syarat_jabatan')->where('kategori_id', 2)->get();
        }
        if (empty($this->tempramenKerja)) {
            $this->tempramenKerja = \DB::table('tempramen_kerja')->where('id_jabatan', $this->activeJabatanId)->get();
        }
        if (empty($this->minatKerjaOption)) {
            $this->minatKerjaOption = \DB::table('item_syarat_jabatan')->where('kategori_id', 3)->get();
        }
        if (empty($this->minatKerja)) {
            $this->minatKerja = \DB::table('minat_kerja')->where('id_jabatan', $this->activeJabatanId)->get();
        }
        if (empty($this->upayaFisikOption)) {
            $this->upayaFisikOption = \DB::table('item_syarat_jabatan')->where('kategori_id', 4)->get();
        }
        if (empty($this->upayaFisik)) {
            $this->upayaFisik = \DB::table('upaya_fisik')->where('id_jabatan', $this->activeJabatanId)->get();
        }

        if (empty($this->fungsiPekerjaanOption)) {
            $this->fungsiPekerjaanOption = \DB::table('item_syarat_jabatan')->where('kategori_id', 6)->get();
        }
        if (empty($this->fungsiPekerjaan)) {
            $this->fungsiPekerjaan = \DB::table('fungsi_pekerjaan')->where('id_jabatan', $this->activeJabatanId)->get();
        }

        return view('livewire.syarat-jabatan');
    }

    public function addBakatKerja($kode)
    {
        // Menambah bakat kerja ke dalam variabel
        $bakat = collect($this->bakatKerjaOption)->firstWhere('kode', $kode);

        if (!$this->bakatKerja->contains('kode', $kode)) {
            $this->bakatKerja->push($bakat);
        } else {
            LivewireAlert::title('Gagal!')
                ->text($bakat->nama_item . ' sudah dipilih!')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }

        $this->render();
    }

    public function removeBakatKerja($kode)
    {
        // Menghapus bakat kerja dari variabel berdasarkan index
        $this->bakatKerja = $this->bakatKerja->reject(function ($item) use ($kode) {
            return $item->kode == $kode;
        });
    }

    public function saveBakatKerja()
    {
        // Menyimpan bakat kerja ke database atau melakukan tindakan lain
        // Implementasi penyimpanan sesuai kebutuhan
        \DB::table('bakat_kerja')->where('id_jabatan', $this->activeJabatanId)->delete();
        foreach ($this->bakatKerja as $bakat) {
            \DB::table('bakat_kerja')->insert([
                'id_jabatan' => $this->activeJabatanId,
                'kode' => $bakat->kode,
                'nama_item' => $bakat->nama_item,
                'deskripsi' => $bakat->deskripsi,
            ]);
        }
        LivewireAlert::title('Sukses!')
            ->text('Data bakat kerja berhasil disimpan!')
            ->success()
            ->toast()
            ->position('top-end')
            ->show();
    }

    public function addTempramenKerja($kode)
    {
        // Menambah tempramen kerja ke dalam variabel
        $tempramen = collect($this->tempramenKerjaOption)->firstWhere('kode', $kode);

        if (!$this->tempramenKerja->contains('kode', $kode)) {
            $this->tempramenKerja->push($tempramen);
        } else {
                LivewireAlert::title('Gagal!')
                    ->text($tempramen->nama_item . ' sudah dipilih!')
                    ->error()
                    ->toast()
                    ->position('top-end')
                    ->show();
            
        }

        $this->render();
    }

    public function removeTempramenKerja($kode)
    {
        // Menghapus tempramen kerja dari variabel berdasarkan kode
        $this->tempramenKerja = $this->tempramenKerja->reject(function ($item) use ($kode) {
            return $item->kode == $kode;
        });
    }

    public function saveTempramenKerja()
    {
        // Menyimpan tempramen kerja ke database atau melakukan tindakan lain
        // Implementasi penyimpanan sesuai kebutuhan
        \DB::table('tempramen_kerja')->where('id_jabatan', $this->activeJabatanId)->delete();
        foreach ($this->tempramenKerja as $tempramen) {
            \DB::table('tempramen_kerja')->insert([
                'id_jabatan' => $this->activeJabatanId,
                'kode' => $tempramen->kode,
                'nama_item' => $tempramen->nama_item,
                'deskripsi' => $tempramen->deskripsi,
            ]);
        }
        LivewireAlert::title('Sukses!')
            ->text('Data tempramen kerja berhasil disimpan!')
            ->success()
            ->toast()
            ->position('top-end')
            ->show();
    }

    public function addMinatKerja($id)
    {
        // Menambah minat kerja ke dalam variabel
        $minat = collect($this->minatKerjaOption)->firstWhere('id', $id);

        if (!$this->minatKerja->contains('kode', $id)) {
            
                $minat->kode = $minat->id;
                $this->minatKerja->push($minat);
            
        } else {
            LivewireAlert::title('Gagal!')
                ->text($minat->nama_item . ' sudah dipilih!')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }

        $this->render();
    }

    public function removeMinatKerja($id)
    {
        // Menghapus minat kerja dari variabel berdasarkan kode
        $this->minatKerja = $this->minatKerja->reject(function ($item) use ($id) {
            return $item->id == $id;
        });
    }

    public function saveMinatKerja()
    {
        // Menyimpan minat kerja ke database atau melakukan tindakan lain
        \DB::table('minat_kerja')->where('id_jabatan', $this->activeJabatanId)->delete();
        foreach ($this->minatKerja as $minat) {
            \DB::table('minat_kerja')->insert([
                'id_jabatan' => $this->activeJabatanId,
                'kode' => $minat->kode,
                'nama_item' => $minat->nama_item,
                'deskripsi' => $minat->deskripsi,
            ]);
        }
        LivewireAlert::title('Sukses!')
            ->text('Data minat kerja berhasil disimpan!')
            ->success()
            ->toast()
            ->position('top-end')
            ->show();
    }

    public function addUpayaFisik($id)
    {
        // Menambah upaya fisik ke dalam variabel
        $upaya = collect($this->upayaFisikOption)->firstWhere('id', $id);

        if (!$this->upayaFisik->contains('kode', $id)) {
            $upaya->kode = $upaya->id;
            $this->upayaFisik->push($upaya);
            
        } else {
            LivewireAlert::title('Gagal!')
                ->text($upaya->nama_item . ' sudah dipilih!')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }

        $this->render();
    }

    public function removeUpayaFisik($id)
    {
        // Menghapus upaya fisik dari variabel berdasarkan kode
        $this->upayaFisik = $this->upayaFisik->reject(function ($item) use ($id) {
            return $item->kode == $id;
        });
    }

    public function saveUpayaFisik()
    {
        // Menyimpan upaya fisik ke database atau melakukan tindakan lain
        \DB::table('upaya_fisik')->where('id_jabatan', $this->activeJabatanId)->delete();
        foreach ($this->upayaFisik as $upaya) {
            \DB::table('upaya_fisik')->insert([
                'id_jabatan' => $this->activeJabatanId,
                'kode' => $upaya->kode,
                'nama_item' => $upaya->nama_item,
                'deskripsi' => $upaya->deskripsi,
            ]);
        }
        LivewireAlert::title('Sukses!')
            ->text('Data upaya fisik berhasil disimpan!')
            ->success()
            ->toast()
            ->position('top-end')
            ->show();
    }

    public function addFungsiPekerjaan($kode)
    {
        // Menambah fungsi pekerjaan ke dalam variabel
        $fungsi = collect($this->fungsiPekerjaanOption)->firstWhere('kode', $kode);

        if (!$this->fungsiPekerjaan->contains('kode', $kode)) {
            $this->fungsiPekerjaan->push($fungsi);
            
        } else {
            LivewireAlert::title('Gagal!')
                ->text($fungsi->nama_item . ' sudah dipilih!')
                ->error()
                ->toast()
                ->position('top-end')
                ->show();
        }

        $this->render();
    }

    public function removeFungsiPekerjaan($kode)
    {
        // Menghapus fungsi pekerjaan dari variabel berdasarkan kode
        $this->fungsiPekerjaan = $this->fungsiPekerjaan->reject(function ($item) use ($kode) {
            return $item->kode == $kode;
        });
    }

    public function saveFungsiPekerjaan()
    {
        // Menyimpan fungsi pekerjaan ke database atau melakukan tindakan lain
        \DB::table('fungsi_pekerjaan')->where('id_jabatan', $this->activeJabatanId)->delete();
        foreach ($this->fungsiPekerjaan as $fungsi) {
            \DB::table('fungsi_pekerjaan')->insert([
                'id_jabatan' => $this->activeJabatanId,
                'kode' => $fungsi->kode,
                'nama_item' => $fungsi->nama_item,
                'deskripsi' => $fungsi->deskripsi,
            ]);
        }
        LivewireAlert::title('Sukses!')
            ->text('Data fungsi pekerjaan berhasil disimpan!')
            ->success()
            ->toast()
            ->position('top-end')
            ->show();
    }

    public function saveSyaratJabatan()
    {
        // Menyimpan data ke tabel syarat_jabatan berdasarkan id_jabatan
        \DB::table('syarat_jabatan')->updateOrInsert(
            ['id_jabatan' => $this->activeJabatanId],
            [
                'jenis_kelamin' => $this->jenisKelamin,
                'postur_badan' => $this->posturBadan,
                'umur' => $this->umur,
                'tinggi_badan' => $this->tinggiBadan,
                'berat_badan' => $this->beratBadan,
                'penampilan' => $this->penampilan,
                'keterampilan' => $this->keterampilan,
            ]
        );

        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Mengubah Syarat Jabatan Unor ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        // Menyimpan bakat kerja, upaya fisik, dan minat kerja
        $this->saveBakatKerja();
        $this->saveUpayaFisik();
        $this->saveMinatKerja();
        $this->saveTempramenKerja();
        $this->saveFungsiPekerjaan();
    }



}
