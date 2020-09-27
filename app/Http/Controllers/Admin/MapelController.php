<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Mapel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class MapelController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Mapel::with('event')->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<button id="'.$data->id.'" class="edit btn btn-primary btn-flat btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;<button id="'.$data->id.'" class="delete btn btn-flat btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->addColumn('event', function (Mapel $mapel) {
                    return $mapel->event->event;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        
        return view('admin.mapel.mapel', [
            'events' => Event::orderBy('event', 'asc')->get()
        ]);
    }

    public function tambahMapel(Request $request) {
        $lastNumber = Mapel::orderBy('id', 'desc')->first()->kode_mapel ?? 0;
        $lastIncrement = substr($lastNumber, -3);
        $newNumber = 'MP'.str_pad($lastIncrement + 1, 3, 0, STR_PAD_LEFT);

        $form = [
            'event_id' => $request->event_id,
            'mapel' => $request->mapel,
            'waktu' => $request->waktu,
            'kode_mapel' => $newNumber
        ];

        $mapel = Mapel::create($form);

        return response()->json(['success' => 'Mapel di tambahkan']);
    }

    public function edit($id) {
        if (request()->ajax()) {
            $mapel = Mapel::find($id);
            return response()->json(['mapel' => $mapel]);
        }
    }

    public function updateMapel(Request $request, Mapel $mapel) {
        $form = [
            'event_id' => $request->event_id,
            'mapel' => $request->mapel,
            'waktu' => $request->waktu
        ];

        $mapel = Mapel::whereId($request->hidden_id)->update($form);

        return response()->json(['success' => 'Mapel di update']);
    }

    public function delete($id) {
        $mapel = Mapel::find($id);
        $mapel->delete();
    }
}
