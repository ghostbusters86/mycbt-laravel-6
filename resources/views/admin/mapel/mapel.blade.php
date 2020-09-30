@extends('layouts.base')
@section('title', 'Mata Pelajaran')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="alert alert-warning">
                <p><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;&nbsp;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Pariatur autem voluptatem in, dolores tempore nisi.</p>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Mata Pelajaran</h4>
                </div>
                <div class="card-body">
                    <button class="btn btn-sm btn-flat btn-primary mb-3" id="tambahMapel"><i class="fa fa-plus"></i> Tambah</button>
                    <table id="mapel_table" class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>Kode Mapel</th>
                                <th>Mapel</th>
                                <th>Waktu</th>
                                <th>Event</th>
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
    @include('admin._modals.modal-mapel')
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#mapel_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.mapel') }}",
                }, columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    }, {
                        data: 'kode_mapel',
                        name: 'kode_mapel'
                    }, {
                        data: 'mapel',
                        name: 'mapel'
                    }, {
                        data: 'waktu',
                        name: 'waktu'
                    }, {
                        data: 'event',
                        name: 'event_id.event'
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ]
            });

            $('#tambahMapel').on('click', function () {
                $('#modalMapelTitle').text('Tambah Mata Pelajaran Baru');
                $('#action_button').val('Tambah');
                $('#action').val('Add');
                $('#modalMapel').modal('show');
            });

            $('#formMapel').on('submit', function (event) {
                event.preventDefault();
                var action_url = "";
                var txt = "";
                if ($('#action').val() == 'Add') {
                    action_url = "{{ route('admin.tambahMapel') }}";
                    txt = "Mata Pelajaran berhasil di tambahkan";
                }

                if ($('#action').val() == 'Edit') {
                    action_url = "{{ route('admin.updateMapel') }}";
                    txt = "Mata Pelajaran berhasil di update";
                }

                $.ajax({
                    url: action_url,
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.success) {
                            $('#mapel_table').DataTable().ajax.reload();
                            toastr.success(txt);
                            $('#modalMapel').modal('hide');
                            $('#formMapel')[0].reset();
                        }
                    }
                });
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: '/admin/mapel/'+id,
                    dataType: 'JSON',
                    success: function(data) {
                        $('#mapel').val(data.mapel.mapel);
                        $('#waktu').val(data.mapel.waktu);
                        $('#event_id').val(data.mapel.event_id);
                        $('#kode_mapel').val(data.mapel.kode_mapel);
                        $('#hidden_id').val(data.mapel.id);
                        $('#modalMapelTitle').text('Edit Mata Pelajaran');
                        $('#action_button').val('Update');
                        $('#action').val('Edit');
                        $('#modalMapel').modal('show');
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
                    url: '/admin/mapel/delete/'+user_id,
                    beforeSend: function () {
                        $('#ok_button').text('Menghapus...');
                    }, success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            $('#mapel_table').DataTable().ajax.reload();
                            toastr.success('Mata Pelajaran berhasil di hapus');
                        }, 2000);
                    }
                });
            });
        });
    </script>
@endsection
