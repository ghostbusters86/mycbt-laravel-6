<?php

namespace App\Http\Controllers\Admin;

use App\Mapel;
use App\Pertanyaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PertanyaanController extends Controller
{
    public function index() {
        return view('admin.pertanyaan.pertanyaan', [
            'pertanyaans' => Pertanyaan::latest()->get()
        ]);
    }

    public function create() {
        return view('admin.pertanyaan.pertanyaan-create', [
            'mapels' => Mapel::latest()->get()
        ]);
    }

    public function uploadImage(Request $request) {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(('uploads'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('uploads/'.$fileName);

            return response()->json([ 'fileName' => $fileName, 'uploaded' => true, 'url' => $url]);
        }
    }

    public function tambahPertanyaan(Request $request) {
        $request->validate([
            'mapel_id' => 'required',
            'pertanyaan' => 'required'
        ], [
            'pertanyaan.required' => 'Pertanyaan harus diisi',
            'mapel_id.required' => 'Kategori Mata Pelajaran harus dipilih'
        ]);

        $pertanyaan = Pertanyaan::create([
            'mapel_id' => $request->mapel_id,
            'pertanyaan' => $request->pertanyaan
        ]);

        $notification = [
            'message' => 'Pertanyaan berhasil dibuat',
            'alert-type' => 'success'
        ];

        return redirect('/admin/pertanyaan')
            ->with($notification);
    }

    public function editPertanyaan($id) {
        $pertanyaan = Pertanyaan::find($id);
        $mapels = Mapel::latest()->get();

        return view('admin.pertanyaan.pertanyaan-edit', [
            'pertanyaan' => $pertanyaan,
            'mapels' => $mapels
        ]);
    }

    public function updatePertanyaan(Request $request, Pertanyaan $pertanyaan) {
        $request->validate([
            'mapel_id' => 'required',
            'pertanyaan' => 'required'
        ], [
            'pertanyaan.required' => 'Pertanyaan harus diisi',
            'mapel_id.required' => 'Kategori Mata Pelajaran harus dipilih'
        ]);

        $pertanyaan = Pertanyaan::whereId($request->hidden_id)->update([
            'mapel_id' => $request->mapel_id,
            'pertanyaan' => $request->pertanyaan
        ]);

        $notification = [
            'message' => 'Pertanyaan berhasil di edit',
            'alert-type' => 'success'
        ];

        return redirect('/admin/pertanyaan')
            ->with($notification);
    }

    public function delete($id) {
        $pertanyaan = Pertanyaan::find($id);
        $pertanyaan->delete();

        $notification = [
            'message' => 'Pertanyaan berhasil di hapus',
            'alert-type' => 'success'
        ];

        return redirect('/admin/pertanyaan')
            ->with($notification);
    }
}
