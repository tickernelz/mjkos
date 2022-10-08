@extends('backend.layouts.app')
@section('title','Daftar Pengguna')
@section('content')
<x-page-index title="Pengguna" buttonLabel="Tambah Pengguna" routeCreate="pengguna.create">
    @if ($user->IsNotEmpty())
    <table id="dataTable" class="table table-striped table-borderless responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status Akun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $data)
            <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->role->name}}</td>
                <td>
                    @if ($data->aktif == 0)
                    <span class="badge badge-danger">Inactive</span>
                    @elseif ($data->aktif == 1)
                    <span class="badge badge-success">Active</span>
                    @endif
                </td>
                <td>
                    <div class="table-actions btn-group">
                        <a href="{{ route('pengguna.show', $data->id) }}"
                            title="Detail" class="table-action btn btn-info mr-2" data-toggle="tooltip">
                            <i class="fa fa-eye"></i>
                        </a>
                        @if ($data->aktif == 0)
                        <a href="{{ route('pengguna.aktif', ['user_id' => encrypt($data->id), 'aktif' => 1]) }}"
                            title="Inactive" class="table-action btn btn-success mr-2" data-toggle="tooltip">
                            <i class="fa fa-check"></i>
                        </a>
                        @elseif ($data->aktif == 1)
                        <a href="{{ route('pengguna.aktif', ['user_id' => encrypt($data->id), 'aktif' => 0]) }}"
                            title="Active" class="table-action btn btn-danger mr-2" data-toggle="tooltip">
                            <i class="fa fa-ban"></i>
                        </a>
                        @endif
                        <button class="table-action btn btn-warning reset-btn mr-2" title="Reset Password"
                            data-toggle="tooltip" value="">
                            <i class="fas fa-history"></i>
                        </button>
                        <a href="{{route('pengguna.edit',$data->id)}}" class="table-action btn btn-primary mr-2"
                            data-toggle="tooltip" title="Ubah">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="table-action btn btn-danger delete-btn mr-2" data-toggle="tooltip" title="Delete"
                            value="{{$data->id}}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @include('backend.users.user-modal')
    @else
    <div class="align-items-center bg-light p-3 border-secondary rounded">
        <span class="">Oops!</span><br>
        <p><i class="fas fa-info-circle"></i> Belum Terdapat Data Pengguna</p>
    </div>
    @endif
</x-page-index>
@endsection
