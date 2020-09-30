@extends('layouts.base')
@section('title', 'Penilaian')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="alert alert-warning">
                <p><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;&nbsp;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Pariatur autem voluptatem in, dolores tempore nisi.</p>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Penilaian</h4>
                </div>
                <div class="card-body">
                    <button class="btn btn-sm btn-flat btn-primary mb-3" id="tambahPenilaian"><i class="fa fa-plus"></i> Tambah</button>
                    <table id="penilaian_table" class="table table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>Penilaian</th>
                                <th>Level</th>
                                <th>Point Benar</th>
                                <th>Point Salah</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('admin._modals.modal-penilaian')
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#penilaian_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.penilaian') }}",
                }, columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    }, {
                        data: 'penilaian',
                        name: 'penilaian'
                    }, {
                        data: 'level',
                        name: 'level'
                    }, {
                        data: 'benar',
                        name: 'benar'
                    }, {
                        data: 'salah',
                        name: 'salah'
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ]
            });

            $('#tambahPenilaian').on('click', function () {
                $('#modalPenilaianTitle').text('Tambah Penilaian Baru');
                $('#action_button').val('Tambah');
                $('#action').val('Add');
                $('#modalPenilaian').modal('show');
            });

            $('#formPenilaian').on('submit', function (event) {
                event.preventDefault();
                var action_url = "";
                var txt = "";
                if ($('#action').val() == 'Add') {
                    action_url = "{{ route('admin.tambahPenilaian') }}";
                    txt = "Mata Pelajaran berhasil di tambahkan";
                }

                if ($('#action').val() == 'Edit') {
                    action_url = "{{ route('admin.updatePenilaian') }}";
                    txt = "Mata Pelajaran berhasil di update";
                }

                $.ajax({
                    url: action_url,
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.success) {
                            $('#penilaian_table').DataTable().ajax.reload();
                            toastr.success(txt);
                            $('#modalPenilaian').modal('hide');
                            $('#formPenilaian')[0].reset();
                        }
                    }
                });
            });

            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: '/admin/penilaian/'+id,
                    dataType: 'JSON',
                    success: function(data) {
                        $('#penilaian').val(data.penilaian.penilaian);
                        $('#level').val(data.penilaian.level);
                        $('#benar').val(data.penilaian.benar);
                        $('#salah').val(data.penilaian.salah);
                        $('#hidden_id').val(data.penilaian.id);
                        $('#modalPenilaianTitle').text('Edit Penilaian');
                        $('#action_button').val('Update');
                        $('#action').val('Edit');
                        $('#modalPenilaian').modal('show');
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
                    url: '/admin/penilaian/delete/'+user_id,
                    beforeSend: function () {
                        $('#ok_button').text('Menghapus...');
                    }, success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            $('#penilaian_table').DataTable().ajax.reload();
                            toastr.success('Penilaian berhasil di hapus');
                        }, 2000);
                    }
                });
            });
        });
    </script>
@endsection