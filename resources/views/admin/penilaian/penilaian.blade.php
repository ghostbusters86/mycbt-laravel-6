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

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection