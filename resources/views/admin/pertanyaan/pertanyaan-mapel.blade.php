@extends('layouts.base')
@section('title', 'Buat Pertanyaan')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Mata Pelajaran: <strong>{{ $mapel->mapel }}</strong></h4>
                </div>
                <form action="{{ route('admin.insertPertanyaanMapel') }}" method="post">
                @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label for="pertanaayn">Tulis Pertanyaan:</label>
                                <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                                <textarea name="pertanyaan" id="pertanyaan" cols="10" rows="5" class="form-control form-control-sm @error('pertanyaan') is-invalid @enderror" placeholder="Buat pertanyaan disini"></textarea>
                                @error('pertanyaan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-block btn-sm btn-success">Tambah</button>
                                <a href="/admin/mapel" class="btn btn-danger btn-block btn-sm btn-flat">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('pertanyaan', {
            filebrowserUploadUrl: "{{ route('admin.uploadImage', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
    });
</script>
@endsection