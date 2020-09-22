<?php

namespace App\Http\Livewire\Admin;

use App\Event;
use Livewire\Component;

class EventCreate extends Component
{
    // public variabel
    public $event, $start_date, $end_date, $description;

    // method menambahkan ke database
    public function tambahEvent() {
        // Validasi
        $this->validate([
            'event'                 => 'required|max:100',
            'start_date'            => 'required',
            'end_date'              => 'required',
        ], [
            'event.required'        => 'event harus diisi',
            'start_date.required'   => 'tanggal mulai harus diisi',
            'end_date.required'     => 'tanggal selesai harus diisi',
        ]);

        // menangkap isi data yang dikirim ke form
        $form = [
            'event'         => $this->event,
            'start_date'    => $this->start_date,
            'end_date'      => $this->end_date,
            'description'   => $this->description,
        ];

        // Memasukkan data ke database
        $event = Event::create($form);

        /**
        * Menutup modal dan menghapus form setelah data masuk ke database
        * Menambahkan pesan sukses ketika data berhasil
        */
        $this->emit('tambah', $event);
        $this->emit('eventStored');
        $this->resetForm();
    }

    // Mengosongkan form setelah modal tertutup
    private function resetForm() {
        $this->event        = null;
        $this->start_date   = null;
        $this->end_date     = null;
        $this->description  = null;
    }

    public function render() {
        return view('livewire.admin.event-create');
    }
}
