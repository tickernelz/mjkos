@extends('backend.layouts.app')
@section('title','Tambah Pengguna')
@section('content')
<x-page-form page='create' route="pengguna.index" title="Pengguna">
    <form action="{{route('pengguna.store')}}" method="post">
        @csrf
        <div class="form-group row">

            {{-- Name --}}
            <x-form-input label="Nama" type="text" required="required" name="name"></x-form-input>

            {{-- Email --}}
            <x-form-input label="Email" type="email" required="required" name="email"></x-form-input>

            {{-- Email --}}
            <x-form-input label="No.Telp" type="number" required="required" name="telp"></x-form-input>

            {{-- Status --}}
            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <span style="color:red;">*</span>Jenis Kelamin</label>
                <select class="form-control form-control-user @error('jk') is-invalid @enderror" name="jk">
                    <option selected disabled>Pilih Jenis Kelamin</option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>
                @error('jk')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            {{-- Status --}}
            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <span style="color:red;">*</span>Status</label>
                <select class="form-control form-control-user @error('status') is-invalid @enderror" name="status">
                    <option selected disabled>Pilih Status</option>
                    <option value="1">Belum Kawin</option>
                    <option value="2">Sudah Kawin</option>
                    <option value="3">Kawin Memiliki Anak</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            {{-- Status --}}
            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <span style="color:red;">*</span>Pekerjaan</label>
                <select class="form-control form-control-user @error('pekerjaan') is-invalid @enderror" name="pekerjaan">
                    <option selected disabled>Pilih Pekerjaan</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Bekerja">Bekerja</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
                @error('pekerjaan')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            {{-- Role --}}
            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <span style="color:red;">*</span>Role</label>
                <select class="form-control form-control-user @error('role') is-invalid @enderror" name="role">
                    <option selected disabled>Pilih Role</option>
                    @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <span style="color:red;">*</span>Status Akun</label>
                <select class="form-control form-control-user @error('aktif') is-invalid @enderror" name="aktif">
                    <option selected disabled>Pilih Status Akun</option>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
                @error('aktif')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="card-footer text-right border-0">
            <a class="btn btn-danger mr-3" href="{{ route('pengguna.index') }}">Batal</a>
            <x-tabel-button type="submit" color="primary" title="Simpan"></x-tabel-button>
        </div>
    </form>
</x-page-form>
@endsection
