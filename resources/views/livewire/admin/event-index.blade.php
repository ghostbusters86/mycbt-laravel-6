<div>
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-4">
            <button type="button" data-toggle="modal" data-target="#modalEvent" class="btn btn-sm btn-flat btn-primary mb-3"><i class="fas fa-plus"></i> Tambah</button>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-8">
            <form>
                <div class="input-group input-group-sm">
                    <input class="form-control" wire:model="search" type="search" placeholder="Cari event" aria-label="Search">
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="text-center bg-dark">
                    <tr>
                        <th>#</th>
                        <th>Event</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($events as $key => $event)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $event->event }}</td>
                            <td>{{ $event->start_date }}</td>
                            <td>{{ $event->end_date }}</td>
                            <td>{!! $event->description ? $event->description : '<small class="text-muted">Tidak ada deskripsi</small>' !!}</td>
                            <td>
                                <button class="btn btn-sm btn-flat btn-info">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-flat btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $events->links() }}
        </div>
        
        {{-- Modal --}}
        <div class="modal fade" id="modalEvent" tabindex="-1" role="dialog" aria-labelledby="modalEventLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEventLabel">Tambah Event Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @livewire('admin.event-create')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Section --}}
@section('title', 'Event')
@section('css')
    <link rel="stylesheet" href="/datepicker/bootstrap-datetimepicker.min.css">
@endsection

@section('js')
    <script src="/datepicker/bootstrap-datetimepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#mulai').datetimepicker();
            $('#selesai').datetimepicker();
        });

        document.addEventListener('livewire:load', () => {
            window.livewire.on('alert', param => {
                toastr[param['type']](param['message']);
            });

            window.livewire.on('eventStored', () => {
                $('#modalEvent').modal('hide');
            });
        });
    </script>
@endsection