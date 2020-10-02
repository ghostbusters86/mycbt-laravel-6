@extends('layouts.base')
@section('title', 'Kumpulan Jawaban')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Kumpulan Jawaban</h4>
                </div>
                <div class="card-body">
                    <a href="/admin/jawaban/create" class="btn btn-sm btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>
                    <table class="table table-bordered" id="jawaban_table">
                        <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>Jawaban</th>
                                <th>Benar/Salah</th>
                                <th>Point</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($jawabans as $j => $jawaban)
                                <tr>
                                    <td>{{ ++$j }}</td>
                                    <td>{!! $jawaban->jawaban !!}</td>
                                    <td class="{{ $jawaban->benar_salah == 'Y' ? 'text-success' : 'text-danger' }}"><strong>{{ $jawaban->benar_salah == 'Y' ? 'Benar' : 'Salah' }}</strong></td>
                                    <td class="{{ $jawaban->benar_salah == 'Y' ? 'text-success' : 'text-danger' }}">{{ $jawaban->point }}</td>
                                    <td>
                                        <a href="{{ route('admin.editJawaban', $jawaban->id) }}" class="btn btn-sm btn-flat btn-info" title="Edit Jawaban"><i class="fas fa-pencil-alt"></i></a>
                                        &nbsp;&nbsp;
                                        <button type="button" class="delete btn btn-sm btn-flat btn-danger" id="{{ $jawaban->id }}" title="Hapus Jawaban">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Confirmation</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h4 style="margin:0;">Apakah anda yakin ingin menghapus Jawaban ini?</h4>
                </div>
                <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">HAPUS</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#jawaban_table').DataTable();

            var user_id = '';
            $(document).on('click', '.delete', function(){
                user_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function (){
                $.ajax({
                    url: '/admin/jawaban/delete/'+user_id,
                    beforeSend: function () {
                        $('#ok_button').text('Menghapus...');
                    }, success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            location.reload();
                        }, 2000);
                    }
                });
            });
        });

        // Toastr
        @if(Session::has('message'))
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
    </script>
@endsection