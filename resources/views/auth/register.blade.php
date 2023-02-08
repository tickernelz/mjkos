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
                                        <label for="frist_name">Nama</label>
                                        <input required id="frist_name" type="text"
                                               class="form-control @error('nama') is-invalid @enderror" name="name"
                                               autofocus>
                                        @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="email">Email</label>
                                        <input required id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               tabindex="1">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="role">Role</label>
                                        <select
                                            class="form-control form-control-user @error('role') is-invalid @enderror"
                                            name="role">
                                            <option selected disabled>Pilih Role</option>
                                            <option value="2">Pemilik Kost</option>
                                            <option value="3">Penyewa Kost</option>
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
                                        <label for="email">No. Telp</label>
                                        <input required id="email" type="number"
                                               class="form-control @error('telp') is-invalid @enderror" name="telp">
                                        @error('telp')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Jenis Kelamin</label>
                                        <select name="jk"
                                                class="form-control selectric @error('jk') is-invalid @enderror">
                                            <option disabled selected>Pilih Jenis Kelamin</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
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
                                        <label>Pekerjaan</label>
                                        <select name="pekerjaan"
                                                class="form-control selectric @error('pekerjaan') is-invalid @enderror">
                                            <option disabled selected>Pilih Pekerjaan</option>
                                            <option value="Mahasiswa">Mahasiswa</option>
                                            <option value="Bekerja">Bekerja</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        @error('pekerjaan')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Status</label>
                                        <select name="status"
                                                class="form-control selectric @error('status') is-invalid @enderror">
                                            <option disabled selected>Pilih Status</option>
                                            <option value="1">Lajang</option>
                                            <option value="2">Kawin</option>
                                            <option value="3">Kawin Belum Memiliki Anak</option>
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
                                        <label for="password" class="d-block">Password</label>
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
                                               class="d-block @error('password-confirm') is-invalid @enderror">Password
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
                                        <label>Foto KTP</label>
                                        <input required id="password2" type="file"
                                               class="form-control @error('ktp') is-invalid @enderror" name="ktp">
                                        @error('ktp')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Foto KK</label>
                                        <input required id="file2" type="file"
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
<script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- Page Specific JS File -->
</body>

</html>
