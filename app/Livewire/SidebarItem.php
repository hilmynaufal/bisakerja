<?php

namespace App\Livewire;

use Livewire\Component;

use DB;
use Livewire\Attributes\On;
class SidebarItem extends Component
{

    public $sidebar;
    public $isDeleted = false;
    public $isActive;
    public $activeJabatanId;
    public $jabatanChildrens = [];
    public $id_jabatan;
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
    public $tipe_unor = 0;
    public $urutan;


    protected $listeners = ['setJabatanIsActive'];
    #[On('setJabatanIsActive')]
    public function setJabatanIsActive($isActive, $id_jabatan)
    {
        if ($id_jabatan == $this->sidebar->id_jabatan) {
            $this->isActive = true;
            $this->dispatch('hide-loading');
            return;
        } else if ($this->isActive) {
            $this->isActive = false;
        }

    }

    public function mount()
    {
        if ($this->activeJabatanId == $this->sidebar->id_jabatan) {
            $this->isActive = true;
        }
    }

    private function generateIdJabatan()
    {
        return md5(uniqid(rand(), true));
    }

    public function insertDataUnor($tipe_unor)
    {
        if ($this->id_jabatan == null) {
            $this->id_jabatan = $this->generateIdJabatan();
        }

        DB::table('data_unor')->insert([
            'id_jabatan' => $this->id_jabatan,
            'id_atasan' => $this->sidebar->id_jabatan,
            'nama_unor_hr' => $this->nama_unor,
            'nama_unor_bkn' => $this->nama_unor,
            'nama_unor_mapping_instansi' => $this->nama_unor,
            'nama_pembina' => $this->nama_pembina,
            'nama_unor' => $this->nama_unor,
            'nama_jabatan' => $this->nama_jabatan,
            'jenis_unor' => $this->jenis_unor,
            'jenjang_jabatan' => $this->jenjang_jabatan,
            'jabatan_prioritas' => $this->jabatan_prioritas,
            'rumpun_jabatan' => $this->rumpun_jabatan,
            'lokasi' => $this->lokasi,
            'unor_atasan_struktural' => $this->sidebar->nama_unor,
            'unor_induk' => $this->unor_induk,
            'kode_cepat' => $this->kode_cepat,
            'bup' => $this->bup,
            'level_struktur' => $this->level_struktur,
            'nama_sub_jabatan' => $this->nama_sub_jabatan,
            'jenis_jabatan_fungsional' => $this->jenis_jabatan_fungsional,
            'tipe_unor' => $tipe_unor,
            'urutan' => $this->urutan ?? 0
        ]);

        DB::table('data_jabatan')->insert([
            'id_jabatan' => $this->id_jabatan,
        ]);

        $this->insertSyaratJabatan();

        session()->flash('message', 'Data Unor berhasil ditambahkan!');

        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menambahkan Data Unor ' . $this->nama_unor . ' (id jabatan: ' . $this->id_jabatan . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        //refresh children
        $this->getActiveJabatanChildren($this->sidebar->id_jabatan);

        // reset input
        $this->resetInputFields();
    }

    public function insertSyaratJabatan()
    {
        DB::table('syarat_jabatan')->updateOrInsert(
            ['id_jabatan' => $this->id_jabatan],
            [
                'jenis_kelamin' => null,
                'postur_badan' => null,
                'umur' => null,
                'tinggi_badan' => null,
                'berat_badan' => null,
                'penampilan' => null,
                'keterampilan' => null,
            ]
        );

        session()->flash('message', 'Syarat jabatan berhasil ditambahkan!');
    }

    public function hapusDataUnor($id_jabatan)
    {
        $unor = DB::table('data_unor')->where('id_jabatan', $id_jabatan)->first();
        if ($unor) {
            DB::table('data_unor_deleted')->insert([
                'id_jabatan' => $unor->id_jabatan,
                'nama_unor_hr' => $this->nama_unor,
                'nama_unor_bkn' => $this->nama_unor,
                'nama_unor_mapping_instansi' => $this->nama_unor,
                'nama_pembina' => $this->nama_pembina,
                'nama_unor' => $this->nama_unor,
                'nama_jabatan' => "",
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
                'urutan' => $this->urutan ?? 1,
            ]);
        }
        DB::table('data_unor')->where('id_jabatan', $id_jabatan)->delete();

        // DB::table('data_jabatan')->where('id_jabatan', $id_jabatan)->delete();

        $this->isDeleted = true;



        DB::table('logs')->insert([
            'user_id' => session('id'),
            'username' => session('username'),
            'activity' => 'Menghapus Data Unor ' . $this->nama_unor . ' (id jabatan: ' . $id_jabatan . ')',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'created_at' => now(),
        ]);

        session()->flash('message', 'Data Unor berhasil dihapus!');

        //refresh children
        $this->getActiveJabatanChildren($this->sidebar->id_jabatan);
    }

    public function setActiveJabatan($id_jabatan)
    {
        $this->dispatch('show-loading');
        $this->dispatch('setJabatanIsActive', false, $id_jabatan);
        $this->dispatch('setActiveJabatan', $id_jabatan);
        $this->getActiveJabatanChildren($id_jabatan);

    }

    public function getActiveJabatanChildren($id_jabatan)
    {
        $this->jabatanChildrens = DB::table('data_unor')->where('id_atasan', $id_jabatan)->orderBy('urutan', 'asc')->select('*')->get()->toArray();
    }

    public function hideOrShowJabatanChildren($id_jabatan)
    {
        if ($this->jabatanChildrens != null || $this->jabatanChildrens != []) {
            $this->jabatanChildrens = [];
        } else {
            $this->jabatanChildrens = DB::table('data_unor')->where('id_atasan', $id_jabatan)->orderBy('urutan', 'asc')->select('*')->get()->toArray();
        }
    }

    public function render()
    {
        return view('livewire.sidebar-item');
    }

    // Tambahkan fungsi ini untuk reset input
    public function resetInputFields()
    {
        $this->id_jabatan = null;
        $this->nama_pembina = null;
        $this->nama_unor = null;
        $this->nama_jabatan = null;
        $this->jenis_unor = null;
        $this->jenjang_jabatan = null;
        $this->jabatan_prioritas = null;
        $this->rumpun_jabatan = null;
        $this->lokasi = null;
        $this->unor_induk = null;
        $this->kode_cepat = null;
        $this->bup = null;
        $this->level_struktur = null;
        $this->nama_sub_jabatan = null;
        $this->jenis_jabatan_fungsional = null;
        $this->urutan = null;
    }
}
