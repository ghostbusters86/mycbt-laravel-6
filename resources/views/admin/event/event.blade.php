@extends('layouts.base')
@section('title', 'Event')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;&nbsp;<strong>PERHATIAN</strong>. Menghapus event juga akan menghapus:</p>
                <ul>
                    <li>Mata Pelajaran</li>
                    <li>Pertanyaan</li>
                    <li>Jawaban</li>
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4 class="card-title">Event</h4>
                </div>
                <div class="card-body">
                    <button class="btn btn-sm btn-flat btn-primary mb-3" id="tambahEvent"><i class="fa fa-plus"></i> Tambah</button>
                    <table id="event_table" class="table table-bordered">
                        <thead class="text-center">
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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin._modals.modal-event')
@endsection

@section('css')
    <link rel="stylesheet" href="/datepicker/bootstrap-datetimepicker.min.css">
@endsection

@section('js')
    <script src="/datepicker/bootstrap-datetimepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.start').datetimepicker();
            $('.end').datetimepicker();

            $('#event_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.event') }}",
                }, columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    }, {
                        data: 'event',
                        name: 'event'
                    }, {
                        data: 'start_date',
                        name: 'start_date'
                    }, {
                        data: 'end_date',
                        name: 'end_date'
                    }, {
                        data: 'description',
                        name: 'description'
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ]
            });

            $('#tambahEvent').on('click', function () {
                $('#modalEventTitle').text('Tambah Event Baru');
                $('#action_button').val('Tambah');
                $('#action').val('Add');
                $('#modalEvent').modal('show');
            });

            $('#formEvent').on('submit', function (event) {
                event.preventDefault();
                var action_url = "";
                var txt = "";
                if ($('#action').val() == 'Add') {
                    action_url = "{{ route('admin.tambahEvent') }}";
                    txt = "Event berhasil di tambahkan";
                }

                if ($('#action').val() == 'Edit') {
                    action_url = "{{ route('admin.updateEvent') }}";
                    txt = "Event berhasil di update";
                }

                $.ajax({
                    url: action_url,
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.success) {
                            $('#event_table').DataTable().ajax.reload();
                            toastr.success(txt);
                            $('#modalEvent').modal('hide');
                            $('#formEvent')[0].reset();
                        }
                    }
                });
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: '/admin/event/'+id,
                    dataType: 'JSON',
                    success: function(data) {
                        $('#event').val(data.event.event);
                        $('#start_date').val(data.event.start_date);
                        $('#end_date').val(data.event.end_date);
                        $('#description').val(data.event.description);
                        $('#hidden_id').val(data.event.id);
                        $('#modalEventTitle').text('Edit Event');
                        $('#action_button').val('Update');
                        $('#action').val('Edit');
                        $('#modalEvent').modal('show');
                    }
                });
            });

            var user_id;

            $(document).on('click', '.delete', function(){
                user_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function (){
                $.ajax({
                    url: '/admin/event/delete/'+user_id,
                    beforeSend: function () {
                        $('#ok_button').text('Menghapus...');
                    }, success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            $('#event_table').DataTable().ajax.reload();
                            toastr.success('Event berhasil dihapus');
                        }, 2000);
                    }
                });
            });
        });
    </script>
@endsection