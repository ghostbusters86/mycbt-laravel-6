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

        return redirect('/admin/pertanyaan')
            ->with('success', 'Pertanyaan berhasil dibuat');
    }
}
