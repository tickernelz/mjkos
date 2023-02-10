<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/font-awesome/css/fontawesome.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');

    </script>
    <!-- /END GA -->
</head>

<body>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div
                    class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="login-brand">
                        <h2 class="text-center">MJKOST</h2>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Register</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="frist_name"><span style="color: red">*</span>Nama</label>
                                        <input required id="frist_name" type="text"
                                               class="form-control @error('nama') is-invalid @enderror" name="name"
                                               autofocus value="{{ old('name') }}">
                                        @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="email"><span style="color: red">*</span>Email</label>
                                        <input required id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               tabindex="1" value="{{ old('email') }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="role"><span style="color: red">*</span>Role</label>
                                        <select
                                            class="form-control selectric @error('role') is-invalid @enderror"
                                            name="role" required id="role">
                                            <option selected disabled value="" hidden>Pilih Role</option>
                                            <option value="2" @if (old('role') == 2) selected @endif>Pemilik Kost
                                            </option>
                                            <option value="3" @if (old('role') == 3) selected @endif>Penyewa Kost
                                            </option>
                                        </select>
                                        @error('role')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="email"><span style="color: red">*</span>No. Telp</label>
                                        <input required id="email" type="number" value="{{ old('telp') }}"
                                               class="form-control @error('telp') is-invalid @enderror" name="telp">
                                        @error('telp')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label><span style="color: red">*</span>Jenis Kelamin</label>
                                        <select name="jk" required
                                                class="form-control selectric @error('jk') is-invalid @enderror">
                                            <option disabled selected value="" hidden>Pilih Jenis Kelamin</option>
                                            <option value="L" @if (old('jk') == 'L') selected @endif>Laki-laki</option>
                                            <option value="P" @if (old('jk') == 'P') selected @endif>Perempuan</option>
                                        </select>
                                        @error('jk')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label><span style="color: red">*</span>Pekerjaan</label>
                                        <select name="pekerjaan" required
                                                class="form-control selectric @error('pekerjaan') is-invalid @enderror">
                                            <option disabled selected value="" hidden>Pilih Pekerjaan</option>
                                            <option value="Mahasiswa"
                                                    @if (old('pekerjaan') == 'Mahasiswa') selected @endif>Mahasiswa
                                            </option>
                                            <option value="Bekerja" @if (old('pekerjaan') == 'Bekerja') selected @endif>
                                                Bekerja
                                            </option>
                                            <option value="Lainnya" @if (old('pekerjaan') == 'Lainnya') selected @endif>
                                                Lainnya
                                            </option>
                                        </select>
                                        @error('pekerjaan')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label><span style="color: red">*</span>Status</label>
                                        <select name="status" required
                                                class="form-control selectric @error('status') is-invalid @enderror">
                                            <option disabled selected value="" hidden>Pilih Status</option>
                                            <option value="1" @if (old('status') == 1) selected @endif>Lajang</option>
                                            <option value="2" @if (old('status') == 2) selected @endif>Kawin</option>
                                            <option value="3" @if (old('status') == 3) selected @endif>Kawin Belum Punya
                                                Anak
                                            </option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block"><span style="color: red">*</span>Password</label>
                                        <input required id="password" type="password"
                                               class="form-control pwstrength @error('password') is-invalid @enderror"
                                               data-indicator="pwindicator" name="password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password2"
                                               class="d-block @error('password-confirm') is-invalid @enderror"><span
                                                style="color: red">*</span>Password
                                            Confirmation</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password">
                                        @error('password-confirm')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-6">
                                        <label id="labelKTP">Foto KTP</label>
                                        <input id="ktp" type="file"
                                               class="form-control @error('ktp') is-invalid @enderror" name="ktp">
                                        @error('ktp')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label id="labelKK">Foto KK</label>
                                        <input id="kk" type="file"
                                               class="form-control @error('kk') is-invalid @enderror" name="kk">
                                        @error('kk')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- General JS Scripts -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Page Specific JS File -->
<script>
    $(document).ready(function () {
        const required = '<span style="color: red">*</span>';
        $('#role').change(function () {
            if ($(this).val() === '2') {
                $('#labelKTP').html(required + 'Foto KTP');
                $('#labelKK').html(required + 'Foto KK');
                $('#ktp').attr('required', true);
                $('#kk').attr('required', true);
            } else {
                $('#labelKTP').html('Foto KTP');
                $('#labelKK').html('Foto KK');
                $('#ktp').attr('required', false);
                $('#kk').attr('required', false);
            }
        });
    });
</script>
</body>

</html>
