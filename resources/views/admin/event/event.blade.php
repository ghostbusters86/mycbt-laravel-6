@extends('layouts.base')
@section('title', 'Event')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="alert alert-warning">
                <p><i class="fa fa-exclamation-triangle"></i> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Pariatur autem voluptatem in, dolores tempore nisi.</p>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Event</h4>
                </div>
                <div class="card-body">
                    <button class="btn btn-sm btn-flat btn-success mb-2" id="tambahEvent"><i class="fa fa-plus"></i> Tambah</button>
                    <table class="table table-bordered">
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
                            <tr>
                                <td>x</td>
                                <td>x</td>
                                <td>x</td>
                                <td>x</td>
                                <td>x</td>
                                <td>x</td>
                            </tr>
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

            $('#tambahEvent').on('click', function () {
                $('#modalEventTitle').text('Tambah Event Baru');
                $('#modalEvent').modal('show');

                $('#modalEvent').on('submit', function (event) {

                });
            });
        });
    </script>
@endsection