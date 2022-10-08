@extends('backend.layouts.app')
@section('title','Edit Pengguna')
@section('content')
<x-page-form page='edit' route="pengguna.index" title="Pengguna">
    <form action="{{route('pengguna.update', $user->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group row">

            {{-- Name --}}
            <x-form-input label="Nama" type="text" required="required" value="{{$user->name}}" name="name">
            </x-form-input>

            {{-- Email --}}
            <x-form-input label="Email" type="email" required="required" value="{{$user->email}}" name="email">
            </x-form-input>

            {{-- Email --}}
            <x-form-input label="No.telp" type="number" required="required" value="{{$user->telp}}" name="telp">
            </x-form-input>

            {{-- Status --}}
            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <span style="color:red;">*</span>Status Akun</label>
                <select class="form-control form-control-user @error('status') is-invalid @enderror" name="status">
                    <option selected disabled>Select Status Akun</option>
                    <option value="1" {{$user->status == 1 ? 'selected' : ''}}>
                        Active</option>
                    <option value="0" {{$user->status == 0 ? 'selected' : ''}}>
                        Inactive</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            {{-- Status --}}
            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <label class="labels">Jenis Kelamin</label>
                <select class="form-control form-control-user @error('jk') is-invalid @enderror" name="jk">
                    <option selected disabled>Select Jenis Kelamin</option>
                    <option value="L"
                        {{old('jk') ? ((old('jk') == "L") ? 'selected' : '') : (($user->jk == "L") ? 'selected' : '')}}>
                        Laki-Laki</option>
                    <option value="P"
                        {{old('jk') ? ((old('jk') == "P") ? 'selected' : '') : (($user->jk == "P") ? 'selected' : '')}}>
                        Perempuan</option>
                </select>

                @error('jk')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <label class="labels">Pekerjaan</label>
                <select class="form-control form-control-user @error('pekerjaan') is-invalid @enderror" name="pekerjaan">
                    <option selected disabled>Select Jenis Pekerjaan</option>
                    <option value="Mahasiswa"
                        {{old('pekerjaan') ? ((old('pekerjaan') == "Mahasiswa") ? 'selected' : '') : (($user->pekerjaan == "Mahasiswa") ? 'selected' : '')}}>
                        Mahasiswa</option>
                    <option value="Bekerja"
                        {{old('pekerjaan') ? ((old('pekerjaan') == "Bekerja") ? 'selected' : '') : (($user->pekerjaan == "Bekerja") ? 'selected' : '')}}>
                        Bekerja</option>
                    <option value="Lainnya"
                        {{old('pekerjaan') ? ((old('pekerjaan') == "Lainnya") ? 'selected' : '') : (($user->pekerjaan == "Lainnya") ? 'selected' : '')}}>
                        Perempuan</option>
                </select>

                @error('pekerjaan')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <label class="labels">Status</label>
                <select class="form-control form-control-user @error('status') is-invalid @enderror" name="status">
                    <option selected disabled>Select Jenis Status</option>
                    <option value="1"
                        {{old('status') ? ((old('status') == "1") ? 'selected' : '') : (($user->status == "1") ? 'selected' : '')}}>
                        Belum Kawin</option>
                    <option value="2"
                        {{old('status') ? ((old('status') == "2") ? 'selected' : '') : (($user->status == "2") ? 'selected' : '')}}>
                        Sudah Kawin</option>
                    <option value="3"
                        {{old('status') ? ((old('status') == "3") ? 'selected' : '') : (($user->status == "3") ? 'selected' : '')}}>
                        Kawin Memiliki Anak</option>
                </select>

                @error('status')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- Role --}}
            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <span style="color:red;">*</span>Role</label>
                <select class="form-control form-control-user @error('role') is-invalid @enderror" name="role">
                    <option selected disabled>Pilih Role</option>
                    @foreach ($roles as $role)
                    <option value="{{$role->id}}" {{$role->id == $user->role_id ? 'selected':''}}>{{$role->name}}</option>
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
