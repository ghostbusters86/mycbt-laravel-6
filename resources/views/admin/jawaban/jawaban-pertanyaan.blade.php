@extends('layouts.base')
@section('title', 'Buat Jawaban')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <p><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;&nbsp;<strong>TIPS.</strong> Berikut cara mengupload soal yang terdapat gambar.</p>
                <ul>
                    <li>Seret gambar dari file manager ke text editor (Drag and drop).</li>
                    <li>Copy gambar melalui google, kemudian paste di text editor.</li>
                    <li>Copy gambar melalui snipping tool/screenshot.</li>
                    <li>Untuk equation/rumus bisa langsung di copy-paste.</li>
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pertanyaan: <br>
                        <blockquote>{!! $pertanyaan->pertanyaan !!}</blockquote>
                    </h4>
                </div>
                <form action="/admin/pertanyaan/insert-jawaban" method="POST">
                @csrf
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="jawaban">Tulis Jawaban</label>
                                <input type="hidden" name="pertanyaan_id" value="{{ $pertanyaan->id }}">
                                <textarea name="jawaban" id="jawaban" cols="10" rows="4" class="form-control form-control-sm @error('jawaban') is-invalid @enderror" placeholder="Tulis jawaban disini" required></textarea>
                                @error('jawaban')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="benar_salah">Benar/Salah</label>
                                <select name="benar_salah" id="benar_salah" class="form-control form-control-sm @error('benar_salah') is-invalid @enderror" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Y">Benar</option>
                                    <option value="N">Salah</option>
                                </select>
                                @error('benar_salah')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="penilaian_id">Tingkat</label>
                                <select name="penilaian_id" id="penilaian_id" class="form-control form-control-sm @error('penilaian_id') is-invalid @enderror" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($penilaians as $penilaian)
                                        <option value="{{ $penilaian->id }}">{{ $penilaian->penilaian }} ({{ $penilaian->level }})</option>
                                    @endforeach
                                </select>
                                @error('penilaian_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-block btn-flat btn-success">Tambah</button>
                                <a href="/admin/jawaban" class="btn btn-danger btn-block btn-sm btn-flat">Batal</a>
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
    CKEDITOR.replace('jawaban', {
            filebrowserUploadUrl: "{{ route('admin.uploadImage', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form'
    });
</script>
@endsection