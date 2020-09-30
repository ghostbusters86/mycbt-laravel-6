@extends('layouts.base')
@section('title', 'Pertanyaan')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="alert alert-warning">
                <p><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;&nbsp;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Pariatur autem voluptatem in, dolores tempore nisi.</p>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pertanyaan</h4>
                </div>
                <div class="card-body">
                    <a href="/admin/pertanyaan/create" class="btn btn-sm btn-primary mb-3"><i class="fa fa-plus"></i> Tambah</a>
                    @if (session()->has('success'))
                        <span class="toastrDefaultSuccess"></span>
                    @endif
                    <table class="table table-bordered" id="pertanyaan_table">
                        <thead class="text-center">
                            <tr>
                                <th>Pertanyaan</th>
                                <th>Jumlah Jawaban</th>
                                <th>Mata Pelajaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pertanyaans as $p)
                                <tr>
                                    <td>{!! $p->pertanyaan !!}</td>
                                    <td>x</td>
                                    <td>{{ $p->mapel->mapel }}</td>
                                    <td>
                                        <a href="{{ route('admin.editPertanyaan', $p->id) }}" class="btn btn-sm btn-flat btn-info" title="Edit Pertanyaan">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        &nbsp;&nbsp;
                                        <button type="button" class="delete btn btn-sm btn-flat btn-danger" id="{{ $p->id }}" title="Hapus Pertanyaan">
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
                    <h4 style="margin:0;">Apakah anda yakin ingin menghapus Pertanyaan ini?</h4>
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
            $('#pertanyaan_table').DataTable();

            var user_id = '';
            $(document).on('click', '.delete', function(){
                user_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });

            $('#ok_button').click(function (){
                $.ajax({
                    url: '/admin/pertanyaan/delete/'+user_id,
                    beforeSend: function () {
                        $('#ok_button').text('Menghapus...');
                    }, success: function (data) {
                        setTimeout(function () {
                            toastr.success('Pertanyaan berhasil dihapus');
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