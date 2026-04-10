<?php

namespace App\Livewire;

use Livewire\Component;

use DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class TugasPokok extends Component
{

    public $activeJabatanId;

    public $dataTugasPokok;

    public $id_jabatan;
    public $uraian_tugas;
    public $hasil_kerja;
    public $satuan_hasil_kerja;
    public $beban_kerja;
    public $waktu_penyelesaian;
    public $waktu_kerja_efektif;
    public $kebutuhan_pegawai;

    public $jumlah_waktu_penyelesaian;
    public $jumlah_kebutuhan_pegawai;

    // Variabel untuk fitur edit
    public $isEditing = false;
    public $editId;

    public function mount($activeJabatanId)
    {

        $this->activeJabatanId = $activeJabatanId;

        // dd($activeJabatanId);
        
        $array = DB::table('tugas_pokok')
        ->where('id_jabatan', $activeJabatanId)
        ->select('*')->get()->toArray();
        
        // $this->reset();

        if (!empty($array)) {
            $this->dataTugasPokok = $array;

            $this->jumlah_waktu_penyelesaian = array_sum(array_column($array, 'waktu_penyelesaian'));
            $this->jumlah_kebutuhan_pegawai = array_sum(array_column($array, 'kebutuhan_pegawai'));

            // dd($this->jumlah_kebutuhan_pegawai);
            // dd($this->jumlah_waktu_penyelesaian);
        }
    }

    public function getTugasPokok()
    {
        $array = DB::table('tugas_pokok')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataTugasPokok']);

        if (!empty($array)) {
            $this->dataTugasPokok = $array;
            $this->jumlah_waktu_penyelesaian = array_sum(array_column($array, 'waktu_penyelesaian'));
            $this->jumlah_kebutuhan_pegawai = array_sum(array_column($array, 'kebutuhan_pegawai'));

            // dd($this->jumlah_kebutuhan_pegawai);
            // dd($this->jumlah_waktu_penyelesaian);
        }
    }

    public function insertTugasPokok()
    {

        

        $kebutuhanPegawai = ($this->beban_kerja * $this->waktu_penyelesaian) / $this->waktu_kerja_efektif;
        DB::table('tugas_pokok')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'uraian_tugas' => $this->uraian_tugas,
            'hasil_kerja' => $this->hasil_kerja,
            'satuan_hasil_kerja' => $this->satuan_hasil_kerja,
            'beban_kerja' => $this->beban_kerja,
            'waktu_penyelesaian' => $this->waktu_penyelesaian,
            'waktu_kerja_efektif' => $this->waktu_kerja_efektif,
            'kebutuhan_pegawai' => $kebutuhanPegawai,
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataTugasPokok dan $activeJabatanId
        $this->reset(['id_jabatan', 'uraian_tugas', 'hasil_kerja', 'satuan_hasil_kerja', 'beban_kerja', 'waktu_penyelesaian', 'waktu_kerja_efektif', 'kebutuhan_pegawai']);

        session()->flash('message', 'Tugas Pokok berhasil ditambahkan!');

        // Tambahkan log setiap kali update data UNOR
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menambah tugas pokok ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
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

        //get ulang data tugas pokok
        $this->getTugasPokok();
    }

    public function editTugasPokok($id)
    {
        $data = DB::table('tugas_pokok')->where('id', $id)->first();
        
        $this->editId = $id;
        $this->uraian_tugas = $data->uraian_tugas;
        $this->hasil_kerja = $data->hasil_kerja;
        $this->satuan_hasil_kerja = $data->satuan_hasil_kerja;
        $this->beban_kerja = $data->beban_kerja;
        $this->waktu_penyelesaian = $data->waktu_penyelesaian;
        $this->waktu_kerja_efektif = $data->waktu_kerja_efektif;
        
        $this->isEditing = true;
    }

    public function updateTugasPokok()
    {
        $kebutuhanPegawai = ($this->beban_kerja * $this->waktu_penyelesaian) / $this->waktu_kerja_efektif;
        
        DB::table('tugas_pokok')->where('id', $this->editId)->update([
            'uraian_tugas' => $this->uraian_tugas,
            'hasil_kerja' => $this->hasil_kerja,
            'satuan_hasil_kerja' => $this->satuan_hasil_kerja,
            'beban_kerja' => $this->beban_kerja,
            'waktu_penyelesaian' => $this->waktu_penyelesaian,
            'waktu_kerja_efektif' => $this->waktu_kerja_efektif,
            'kebutuhan_pegawai' => $kebutuhanPegawai,
        ]);

        // Reset semua variabel
        $this->reset(['id_jabatan', 'uraian_tugas', 'hasil_kerja', 'satuan_hasil_kerja', 'beban_kerja', 'waktu_penyelesaian', 'waktu_kerja_efektif', 'kebutuhan_pegawai', 'isEditing', 'editId']);

        session()->flash('message', 'Tugas Pokok berhasil diupdate!');

        // Tambahkan log setiap kali update data
        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Mengupdate tugas pokok ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil diupdate.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data tugas pokok
        $this->getTugasPokok();
    }

    public function cancelEdit()
    {
        $this->reset(['id_jabatan', 'uraian_tugas', 'hasil_kerja', 'satuan_hasil_kerja', 'beban_kerja', 'waktu_penyelesaian', 'waktu_kerja_efektif', 'kebutuhan_pegawai', 'isEditing', 'editId']);
    }

    public function hapusTugasPokok($id)
    {
        DB::table('tugas_pokok')->where('id', $id)->delete();

        session()->flash('message', 'Tugas Pokok berhasil dihapus!');

        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menghapus tugas pokok ' . session('activeNamaUnor') . ' (id jabatan: ' . session('activeIdJabatan') . ')',
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

        //get ulang data tugas pokok
        $this->getTugasPokok();
    }

    public function render()
    {
        return view('livewire.info-jabatan.tugas-pokok');
    }


}
