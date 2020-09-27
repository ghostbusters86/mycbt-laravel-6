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
                    <a href="/admin/pertanyaan/create" class="btn btn-sm btn-success mb-3"><i class="fa fa-plus"></i> Tambah</a>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible alert-dismissible fade show mb-3" role="alert">
                            <span><strong>Berhasil!</strong> {{ session('success') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table class="table table-bordered">
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
                                    <td>x</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection