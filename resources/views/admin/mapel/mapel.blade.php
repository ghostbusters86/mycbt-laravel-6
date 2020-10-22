@extends('layouts.base')
@section('title', 'Mata Pelajaran')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;&nbsp;<strong>PERHATIAN</strong>. Menghapus Mata Pelajaran juga akan menghapus:</p>
                <ul>
                    <li>Pertanyaan</li>
                    <li>Jawaban</li>
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card card-primary card-outline">
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
                                <th>Jlh. Soal</th>
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

@section('css')
    <style>
        .chosen-container{
            width: 100% !important;
        }
    </style>
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
                        data: 'events',
                        name: 'events'
                    }, {
                        data: 'jlh_soal',
                        name: 'jlh_soal',
                        orderable: false
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
                // $('#kode_soal').val(soalGen(6));
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

        // Toastr
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif

        // function soalGen(length) {
        //     var result           = '';
        //     var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        //     var charactersLength = characters.length;
        //     for ( var i = 0; i < length; i++ ) {
        //         result += characters.charAt(Math.floor(Math.random() * charactersLength));
        //     }
        //     return result;
        // }
    </script>
@endsection
