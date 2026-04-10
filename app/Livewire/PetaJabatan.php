<?php

namespace App\Livewire;

use Livewire\Component;
use DB;

class PetaJabatan extends Component
{
    public $activeJabatanId;
    public $data;

    public function mount($activeJabatanId)
    {
        $array = DB::table('data_unor')
            ->where('id_jabatan', $activeJabatanId)
            ->orderBy('urutan')
            ->select('*')
            ->first();
        $children = $this->get_children($activeJabatanId);
        
        $data1 = [
            'id' => $array->id_jabatan,
            'name' => $array->nama_unor,
            'children' => $children
        ];

        // print ($data1);

        $this->data = $data1;
    }

    public function get_children(string $id_jabatan)
    {
        $array = DB::table('data_unor')
            ->where('id_atasan', "$id_jabatan")
            ->orderBy('urutan')
            ->select('*')
            ->get()
            ->map(function ($item) {
                $children = $this->get_children($item->id_jabatan);
                return [
                    'id' => $item->id_jabatan,
                    'name' => $item->nama_unor ?? $item->nama_jabatan,
                    'children' => $children
                ];
            });
        return $array;
    }
    public function render()
    {
        return view('livewire.peta-jabatan');
    }

    // public function initdata()
    // {

    //     return response()->json($data);
    // }

    public function children($id)
    {
        $children = DB::table('data_unor')
            ->where('id_jabatan', $id)
            ->select('*')->get()->map(function ($emp) {
                $hasChildren = DB::table('data_unor')
                    ->where('id_atasan', $emp->id_jabatan)->get()->isNotEmpty();
                return [
                    'id' => $emp->id_jabatan,
                    'pid' => $emp->id_atasan,
                    'name' => $emp->nama_unor,
                    'title' => $emp->nama_jabatan,
                    'hasChildren' => $hasChildren
                ];
            });

        return response()->json($children);
    }
}
