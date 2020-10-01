@extends('layouts.base')
@section('title', 'Edit Pertanyaan')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Pertanyaan</h4>
                </div>
                <form action="{{ route('admin.updatePertanyaan') }}" method="post">
                @csrf
                @method('PUT')
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="mapel_id">Plih Mata Pelajaran</label>
                                <input type="hidden" name="hidden_id" value="{{ $pertanyaan->id }}">
                                <select name="mapel_id" id="mapel_id" class="form-control form-control-sm @error('pertanyaan') is-invalid @enderror" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($mapels as $mapel)
                                        <option value="{{ $mapel->id }}" {{ $mapel->id == $pertanyaan->mapel_id ? 'selected' : '' }}>{{ $mapel->mapel }}</option>
                                    @endforeach
                                </select>
                                @error('mapel_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="pertanaayn">Tulis Pertanyaan:</label>
                                <textarea name="pertanyaan" id="pertanyaan" cols="10" rows="5" class="form-control form-control-sm @error('pertanyaan') is-invalid @enderror" placeholder="Buat pertanyaan disini">{{ $pertanyaan->pertanyaan }}</textarea>
                                @error('pertanyaan')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-block btn-sm btn-info">Update</button>
                                <a href="/admin/pertanyaan" class="btn btn-danger btn-block btn-sm btn-flat">Batal</a>
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