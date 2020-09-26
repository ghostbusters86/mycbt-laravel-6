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
                    $button = '<button id="'.$data->id.'" class="edit btn btn-primary btn-flat btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;<button id="'.$data->id.'" class="delete btn btn-flat btn-danger btn-sm">Delete</button>';
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
            'event' => $request->event,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
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
            'event' => $request->event,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ];

        $event = Event::whereId($request->hidden_id)->update($form);

        return response()->json(['success' => 'Event di update']);
    }

    public function deleteEvent($id) {
        $event = Event::find($id);
        $event->delete();
    }
}
