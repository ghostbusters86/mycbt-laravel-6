<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Mapel;
use App\Pertanyaan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MapelController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Mapel::with('events')->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a href="/admin/mapel/tambah-pertanyaan/'.$data->id.'" class="text-success" title="Buat Soal"><i class="fas fa-pen"></i></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a href="#" id="'.$data->id.'" class="edit text-info" title="Edit Mata Pelajaran"><i class="fas fa-pencil-alt"></i></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a href="#" id="'.$data->id.'" class="delete text-danger" title="Hapus Mata Pelajaran"><i class="fas fa-trash"></i></a>';
                    return $button;
                })
                ->addColumn('events', function (Mapel $mapel) {
                    return implode(', ', $mapel->events()->get()->pluck('event')->toArray());
                })
                ->addColumn('jlh_soal', function ($data) {
                    return $data->pertanyaans->count();
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        
        return view('admin.mapel.mapel', [
            'events' => Event::all()->groupBy('tingkat')
        ]);
    }

    public function tambahMapel(Request $request) {
        $lastNumber = Mapel::orderBy('id', 'desc')->first()->kode_mapel ?? 0;
        $lastIncrement = substr($lastNumber, -3);
        $newNumber = 'MP'.str_pad($lastIncrement + 1, 3, 0, STR_PAD_LEFT);

        $mapel = Mapel::create([
            'mapel'         => $request->mapel,
            'waktu'         => $request->waktu,
            'kode_mapel'    => $newNumber
        ]);

        $mapel->events()->attach($request->event_id);

        return response()->json(['success' => 'Mapel di tambahkan']);
    }

    public function edit($id) {
        if (request()->ajax()) {
            $mapel = Mapel::find($id);
            $events = $mapel->events()->get();
            return response()->json(['mapel' => $mapel, 'event' => $events]);
        }
    }

    public function updateMapel(Request $request, Mapel $mapel) {
        $form = [
            'event_id'  => $request->event_id,
            'mapel'     => $request->mapel,
            'waktu'     => $request->waktu
        ];

        $mapel = Mapel::whereId($request->hidden_id)->update($form);

        return response()->json(['success' => 'Mapel di update']);
    }

    public function delete($id) {
        $mapel = Mapel::find($id);
        $mapel->delete();
    }

    public function tambahPertanyaanMapel($id) {
        $mapel = Mapel::find($id);
        $mapel->with([
            'pertanyaans' => function ($q) {
                return $q;
            }
        ])
        ->get();

        return view('admin.pertanyaan.pertanyaan-mapel', [
            'mapel' => $mapel,
        ]);
    }

    public function insertPertanyaanMapel(Request $request) {
        $request->validate([
            'pertanyaan' => 'required',
        ], [
            'pertanyaan.required' => 'Pertanyaan harus diisi'
        ]);

        $form = [
            'mapel_id'      => $request->mapel_id,
            'pertanyaan'    => $request->pertanyaan,
        ];

        $pertanyaan = Pertanyaan::create($form);

        $notification = [
            'message' => 'Pertanyaan berhasil dibuat',
            'alert-type' => 'success'
        ];

        return redirect('/admin/mapel')
            ->with($notification);
    }
}
