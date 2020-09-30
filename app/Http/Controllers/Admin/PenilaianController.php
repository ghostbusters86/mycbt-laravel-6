<?php

namespace App\Http\Controllers\Admin;

use App\Penilaian;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class PenilaianController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Penilaian::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button id="'.$data->id.'" class="edit btn btn-primary btn-flat btn-sm" title="Edit Penilaian"><i class="fas fa-pencil-alt"></i></button>';
                    $button .= '&nbsp;&nbsp;<button id="'.$data->id.'" class="delete btn btn-flat btn-danger btn-sm" title="Hapus Penilaian"><i class="fas fa-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.penilaian.penilaian');
    }

    public function tambahPenilaian(Request $request) {
        $form = [
            'penilaian' => $request->penilaian,
            'level'     => $request->level,
            'benar'     => $request->benar,
            'salah'     => $request->salah
        ];

        $penilaian = Penilaian::create($form);

        return response()->json(['success' => 'Penilaian berhasil di tambahkan']);
    }

    public function editPenilaian($id) {
        if (request()->ajax()) {
            $penilaian = Penilaian::find($id);
            return response()->json(['penilaian' => $penilaian]);
        }
    }

    public function updatePenilaian(Request $request, Penilaian $penilaian) {
        $form = [
            'penilaian' => $request->penilaian,
            'level'     => $request->level,
            'benar'     => $request->benar,
            'salah'     => $request->salah,
        ];

        $penilaian = Penilaian::whereId($request->hidden_id)->update($form);

        return response()->json(['success' => 'Penilaian berhasil di update']);
    }

    public function deletePenilaian($id) {
        $penilaian = Penilaian::find($id);
        $penilaian->delete();
    }
}
