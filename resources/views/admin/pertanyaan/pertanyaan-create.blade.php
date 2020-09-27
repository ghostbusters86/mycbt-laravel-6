@extends('layouts.base')
@section('title', 'Buat Pertanyaan')
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
                <form action="{{ route('admin.tambahPertanyaan') }}" method="post">
                @csrf
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="mapel_id">Plih Mata Pelajaran</label>
                                <select name="mapel_id" id="mapel_id" class="form-control form-control-sm" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($mapels as $mapel)
                                        <option value="{{ $mapel->id }}">{{ $mapel->mapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="pertanaayn">Tulis Pertanyaan:</label>
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
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
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