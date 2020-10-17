<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Event::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a href="#" id="'.$data->id.'" class="edit text-info" title="Edit Event"><i class="fas fa-pencil-alt"></i></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<a href="#" id="'.$data->id.'" class="delete text-danger" title="Hapus Event"><i class="fas fa-trash"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.event.event');
    }

    public function tambahEvent(Request $request) {
        $form = [
            'event'         => $request->event,
            'tingkat'       => $request->tingkat,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'description'   => $request->description,
        ];
        $event = Event::create($form);

        return response()->json(['success' => 'Event di tambahkan']);
    }

    public function edit($id) {
        if (request()->ajax()) {
            $event = Event::find($id);
            return response()->json(['event' => $event]);
        }
    }

    public function updateEvent(Request $request, Event $event) {
        $form = [
            'event'         => $request->event,
            'tingkat'       => $request->tingkat,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'description'   => $request->description,
        ];

        $event = Event::whereId($request->hidden_id)->update($form);

        return response()->json(['success' => 'Event di update']);
    }

    public function deleteEvent($id) {
        $event = Event::find($id);
        $event->delete();
    }
}
