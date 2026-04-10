<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use DB;
use Carbon\Carbon;

class ReferensiPeraturan extends Component
{

    use WithFileUploads;

    
    public function render()
    {
        return view('livewire.referensi-peraturan');
    }

    public $activeJabatanId;
    public $id_jabatan;
    public $dataReferensiPeraturan;
    public $nama_file;
    public $nama_peraturan;
    
    public $file_peraturan;

    public $rules = [
        'file_peraturan' => 'file|max:51200', // 51200 KB = 50MB
    ];
    

    public function getReferensiPeraturan()
    {
        $array = DB::table('peraturan')
        ->where('id_jabatan', $this->activeJabatanId)
        ->select('*')->get()->toArray();
        
        $this->reset(['dataReferensiPeraturan']);

        if (!empty($array)) {
            $this->dataReferensiPeraturan = $array;
        }
    }

    public function insertReferensiPeraturan()
    {
        // Upload file jika ada
        // $this->validate([
        //     'file_peraturan' => 'required|file|max:51200',
        // ]);
        //dd($this->file_peraturan);
        if ($this->file_peraturan) {
            // Validasi tipe file
            $allowedTypes = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];
            $fileExtension = strtolower($this->file_peraturan->getClientOriginalExtension());
            
            if (!in_array($fileExtension, $allowedTypes)) {
                LivewireAlert::title('Error!')
                    ->text('Tipe file tidak diizinkan. Gunakan PDF, DOC, DOCX, XLS, XLSX, PPT, atau PPTX.')
                    ->error()
                    ->toast()
                    ->position('top-end')
                    ->show();
                return;
            }
            
            
            $fileName = time() . '_' . $this->file_peraturan->getClientOriginalName();
            
            // Pastikan folder peraturan ada
            $uploadPath = public_path('peraturan');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Simpan file di folder public/peraturan
            // $this->file_peraturan->move($uploadPath, $fileName);
            $this->file_peraturan->storeAs('/peraturan', $fileName, ['disk' => 'public_uploads']);
            $this->nama_file = $fileName;
        }

        // dd($this->file_peraturan);

        DB::table('peraturan')->insert([
            'id_jabatan' => $this->activeJabatanId,
            'nama_peraturan' => $this->nama_peraturan,
            'nama_file' => $this->nama_file,
            'waktu_upload' => Carbon::now('GMT+7'),
        ]);

        // Reset semua variabel yang digunakan untuk input setelah berhasil insert, kecuali $dataReferensiPeraturan dan $activeJabatanId
        $this->reset(['nama_peraturan', 'nama_file']);

        session()->flash('message', 'Referensi Peraturan berhasil ditambahkan!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil tersimpan.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data referensi peraturan
        $this->getReferensiPeraturan();
    }

    public function hapusReferensiPeraturan($id)
    {
        // Ambil data peraturan sebelum dihapus untuk mendapatkan nama file
        $peraturan = DB::table('peraturan')->where('id', $id)->first();
        
        // Hapus file fisik jika ada
        if ($peraturan && $peraturan->nama_file) {
            $filePath = public_path('peraturan/' . $peraturan->nama_file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        DB::table('peraturan')->where('id', $id)->delete();

        session()->flash('message', 'Referensi Peraturan berhasil dihapus!');

        LivewireAlert::title('Berhasil!')
            ->text('Data Berhasil dihapus.')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();

        //get ulang data referensi peraturan
        $this->getReferensiPeraturan();
    }

    public function lihatPeraturan($id)
    {
        $peraturan = DB::table('peraturan')->where('id', $id)->first();
        
        if ($peraturan && $peraturan->nama_file) {
            $filePath = public_path('peraturan/' . $peraturan->nama_file);
            if (file_exists($filePath)) {
                return response()->download($filePath);
            }
        }
        
        session()->flash('error', 'File tidak ditemukan!');
        return null;
    }

    public function mount($activeJabatanId)
    {
        
        $array = DB::table('peraturan')->get()->toArray();

        $this->reset();

        $this->id_jabatan = session('id_jabatan');

        $this->activeJabatanId = $activeJabatanId;

        $this->dataReferensiPeraturan = $array;
    }
}
