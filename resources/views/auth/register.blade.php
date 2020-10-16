<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Halaman Registrasi</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/css/parsley.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="#"><b>Halaman</b>Registrasi</a>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register akun baru</p>
                <form method="POST" action="{{ route('register') }}">
                @csrf
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nama Lengkap" name="name">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Alamat Email" name="email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Konfirmasi password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-check"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="" selected>-- Jenis Kelamin --</option>
                                    <option value="L">Pria</option>
                                    <option value="P">Wanita</option>
                                </select>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fas fa-venus-mars"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="No. Telp/WhatsApp">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-mobile-alt"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Asal Sekolah" name="asal_sekolah">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-school"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Kelas (Hanya diisi 1-12. Contoh. 10)">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-tasks"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <select name="provinsi_id" id="province" class="form-control">
                                    <option value="">-- Provinsi --</option>
                                    @foreach ($provinces ?? '' as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fas fa-globe-asia"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <select name="kabupaten_kota_id" id="city" class="form-control">
                                    <option value="">-- Kabupaten/Kota --</option>
                                </select>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fas fa-city"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <select name="event_id" class="form-control">
                                    <option value="">-- Pilih Event --</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->event }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fas fa-code"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <textarea name="alamat_tinggal" cols="8" rows="2" class="form-control" placeholder="Alamat Lengkap"></textarea>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fas fa-home"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Daftar') }}</button>
                        </div>
                    </div>
                </form>
                <hr>
                <a href="/login" class="text-center">Sudah punya akun?</a>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <script src="/js/parsley.min.js"></script>
    <script>
        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            
            $('#province').on('change', function () {
                $.post('{{ route('getKabupatenKota') }}', {id: $(this).val()})
                    .then(function (response) {
                        $('#city').empty();

                        $.each(response, function (id, name) {
                            $('#city').append(new Option(name, id))
                        })
                    });
            });
        });
    </script>
</body>
</html>
