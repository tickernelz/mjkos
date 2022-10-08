@extends('frontend.layouts.app')
@section('title', 'Profile')
@section('content')
<x-alert />
<!-- ======= Breadcrumbs Section ======= -->
<section class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-weight-bold">Profile</h2>
            <ol>
                <li><a href="/">Beranda</a></li>
                <li>Profile</li>
            </ol>
        </div>

    </div>
</section><!-- Breadcrumbs Section -->

<div class="container-fluid">
    {{-- Page Content --}}
    <div class="row">
        <div class="col-md-3">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <div class="profilepic">
                    <img class="rounded-circle my-2 profilepic__image" width="150px"
                        src="{{ asset(auth()->user()->foto ? 'images/profil/'. auth()->user()->foto : 'backend/assets/img/avatar/avatar-1.png') }}">
                    <div class="profilepic__content">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"><i class="bi bi-camera"></i>
                        </button>
                        <span class="profilepic__text">Edit Profile</span>
                    </div>
                </div>
                <span class="font-weight-bold">{{ auth()->user()->name }}</span>
                <span class="text-dark">Email : {{ auth()->user()->email }}</span>
            </div>
        </div>

        {{-- Modal Update Foto --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Foto Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img class="rounded-circle my-2 profilepic__image" width="150px" src="">
                        <form action="{{route('profile.foto')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="foto">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            {{-- Profile --}}
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Edit Profile</h4>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label class="labels">Nama</label>
                            <input autocomplete="off" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nama"
                                value="{{ old('name') ? old('name') : auth()->user()->name }}">

                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="labels">Email</label>
                            <input autocomplete="off" type="text"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="Email" value="{{ old('email') ? old('email') : auth()->user()->email }}">

                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="labels">Jenis Kelamin</label>
                            <select class="form-select form-control-user @error('jk') is-invalid @enderror" name="jk">
                                <option selected disabled>Select Jenis Kelamin</option>
                                <option value="L"
                                    {{old('jk') ? ((old('jk') == "L") ? 'selected' : '') : ((auth()->user()->jk == "L") ? 'selected' : '')}}>
                                    Laki-Laki</option>
                                <option value="P"
                                    {{old('jk') ? ((old('jk') == "P") ? 'selected' : '') : ((auth()->user()->jk == "P") ? 'selected' : '')}}>
                                    Perempuan</option>
                            </select>

                            @error('jk')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mt-2">

                        <div class="col-md-4">
                            <label class="labels">Pekerjaan</label>
                            <select class="form-select form-control-user @error('pekerjaan') is-invalid @enderror"
                                name="pekerjaan">
                                <option selected disabled>Select Jenis Pekerjaan</option>
                                <option value="Mahasiswa"
                                    {{old('pekerjaan') ? ((old('pekerjaan') == "Mahasiswa") ? 'selected' : '') : ((auth()->user()->pekerjaan == "Mahasiswa") ? 'selected' : '')}}>
                                    Mahasiswa</option>
                                <option value="Bekerja"
                                    {{old('pekerjaan') ? ((old('pekerjaan') == "Bekerja") ? 'selected' : '') : ((auth()->user()->pekerjaan == "Bekerja") ? 'selected' : '')}}>
                                    Bekerja</option>
                                <option value="Lainnya"
                                    {{old('pekerjaan') ? ((old('pekerjaan') == "Lainnya") ? 'selected' : '') : ((auth()->user()->pekerjaan == "Lainnya") ? 'selected' : '')}}>
                                    Perempuan</option>
                            </select>

                            @error('pekerjaan')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="labels">Status</label>
                            <select class="form-select form-control-user @error('status') is-invalid @enderror"
                                name="status">
                                <option selected disabled>Select Jenis Status</option>
                                <option value="1"
                                    {{old('status') ? ((old('status') == "1") ? 'selected' : '') : ((auth()->user()->status == "1") ? 'selected' : '')}}>
                                    Belum Kawin</option>
                                <option value="2"
                                    {{old('status') ? ((old('status') == "2") ? 'selected' : '') : ((auth()->user()->status == "2") ? 'selected' : '')}}>
                                    Sudah Kawin</option>
                                <option value="3"
                                    {{old('status') ? ((old('status') == "3") ? 'selected' : '') : ((auth()->user()->status == "3") ? 'selected' : '')}}>
                                    Kawin Memiliki Anak</option>
                            </select>

                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Simpan Profile</button>
                    </div>
                </form>
            </div>

            <hr>
            {{-- Change Password --}}
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Ubah Password</h4>
                </div>

                <form action="{{ route('profile.change-password') }}" method="POST">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label class="labels">Password Lama</label>
                            <input autocomplete="off" type="password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                placeholder="Password Lama" required>
                            @error('current_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="labels">Password Baru</label>
                            <input autocomplete="off" type="password" name="new_password"
                                class="form-control @error('new_password') is-invalid @enderror" required
                                placeholder="Password Baru">
                            @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="labels">Konfirmasi Password Baru</label>
                            <input autocomplete="off" type="password" name="new_confirm_password"
                                class="form-control @error('new_confirm_password') is-invalid @enderror" required
                                placeholder="Konfirmasi Password Baru">
                            @error('new_confirm_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-success profile-button" type="submit">Simpan
                            Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
