<?php

namespace App\Http\Livewire\Admin;

use App\Event;
use Livewire\Component;
use Livewire\WithPagination;

class EventIndex extends Component
{
    use WithPagination;

    public $search;
    public $tambah = false;

    // Untuk update query search, nama array disesuaikan dengan nama model
    protected $updatesQueryString = ['search'];

    // listeners
    protected $listeners = [
        'tambah' => 'refreshParent'
    ];

    public function test() {
        $this->tambah = true;
    }

    public function refreshParent($event) {
        $this->emit('alert', ['type' => 'success', 'message' => 'Event '. $event['event'] .' berhasil ditambahkan']);
    }

    public function render() {
        return view('livewire.admin.event-index', [
            'events' => $this->search === null ?
                Event::latest()->paginate(10) :
                Event::where('event', 'like', '%' . $this->search . '%')
                    ->orWhere('start_date', 'like', '%' . $this->search . '%')
                    ->orWhere('end_date', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->latest()->paginate(10)
        ]);
    }
}
