<?php

namespace App\Http\Controllers\Admin;

use App\Jawaban;
use App\Penilaian;
use App\Pertanyaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JawabanController extends Controller
{
    public function index() {
        return view('admin.jawaban.jawaban', [
            'jawabans' => Jawaban::latest()->get(),
        ]);
    }

    public function createJawaban() {
        return view('admin.jawaban.jawaban-create', [
            'pertanyaans' => Pertanyaan::latest()->get(),
            'penilaians' => Penilaian::latest()->get()
        ]);
    }

    public function tambahJawaban(Request $request) {
        $request->validate([
            'pertanyaan_id' => 'required',
            'jawaban'       => 'required',
            'benar_salah'   => 'required',
            'penilaian_id'  => 'required'
        ], [
            'pertanyaan_id.required'    => 'Pertanyaan harus dipilih',
            'jawaban.required'          => 'Jawaban harus diisi',
            'benar_salah.required'      => 'Harus dipilih',
            'penilaian_id.required'     => 'Penilaian harus dipilih'
        ]);

        $point = '';
        $penilaian = Penilaian::where('id', $request->penilaian_id)
            ->get()
            ->map->only('id', 'benar', 'salah');

        if ($request->benar_salah == 'Y') {
            $point = $penilaian[0]['benar'];
        } else if ($request->benar_salah == 'N') {
            $point = $penilaian[0]['salah'];
        }

        $form = [
            'pertanyaan_id' => $request->pertanyaan_id,
            'jawaban'       => $request->jawaban,
            'benar_salah'   => $request->benar_salah,
            'penilaian_id'  => $request->penilaian_id,
            'point'         => $point,
        ];

        $jawaban = Jawaban::create($form);

        $notification = [
            'message' => 'Jawaban berhasil dibuat',
            'alert-type' => 'success'
        ];

        return redirect('/admin/jawaban')
            ->with($notification);
    }

    public function editJawaban($id) {
        $jawaban = Jawaban::find($id);
        $pertanyaans = Pertanyaan::latest()->get();
        $penilaians = Penilaian::latest()->get();

        return view('admin.jawaban.jawaban-edit', [
            'jawaban' => $jawaban,
            'pertanyaans' => $pertanyaans,
            'penilaians' => $penilaians
        ]);
    }

    public function updateJawaban(Request $request, Jawaban $jawaban) {
        $request->validate([
            'pertanyaan_id' => 'required',
            'jawaban'       => 'required',
            'benar_salah'   => 'required',
            'penilaian_id'  => 'required'
        ], [
            'pertanyaan_id.required'    => 'Pertanyaan harus dipilih',
            'jawaban.required'          => 'Jawaban harus diisi',
            'benar_salah.required'      => 'Harus dipilih',
            'penilaian_id.required'     => 'Penilaian harus dipilih'
        ]);

        $point = '';
        $penilaian = Penilaian::where('id', $request->penilaian_id)
            ->get()
            ->map->only('id', 'benar', 'salah');

        if ($request->benar_salah == 'Y') {
            $point = $penilaian[0]['benar'];
        } else if ($request->benar_salah == 'N') {
            $point = $penilaian[0]['salah'];
        }

        $form = [
            'pertanyaan_id' => $request->pertanyaan_id,
            'jawaban'       => $request->jawaban,
            'benar_salah'   => $request->benar_salah,
            'penilaian_id'  => $request->penilaian_id,
            'point'         => $point,
        ];

        $jawaban = Jawaban::whereId($request->hidden_id)
            ->update($form);

        $notification = [
            'message' => 'Jawaban berhasil di edit',
            'alert-type' => 'success'
        ];

        return redirect('/admin/jawaban')
            ->with($notification);
    }

    public function delete($id) {
        $jawaban = Jawaban::find($id);
        $jawaban->delete();

        $notification = [
            'message' => 'Jawaban berhasil di hapus',
            'alert-type' => 'success'
        ];

        return redirect('/admin/jawaban')
            ->with($notification);
    }
}
