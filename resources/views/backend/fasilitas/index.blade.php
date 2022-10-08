@extends('backend.layouts.app')
@section('title','Daftar Fasilitas')
@section('content')
<x-page-index title="Fasilitas" buttonLabel="Tambah Fasilitas" routeCreate="fasilitas.create">
    @if ($fasilitas->IsNotEmpty())
    <table id="dataTable" class="table table-striped table-borderless responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fasilitas as $key=>$data)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$data->nama}}</td>
                <td>
                    <div class="table-actions btn-group">
                        <a href="{{route('fasilitas.edit', $data->id)}}" class="table-action btn btn-primary mr-2"
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
    @include('backend.fasilitas.fasilitas-modal')
    @else
    <div class="align-items-center bg-light p-3 border-secondary rounded">
        <span class="">Oops!</span><br>
        <p><i class="fas fa-info-circle"></i> Belum Terdapat Data Fasilitas</p>
    </div>
    @endif
</x-page-index>
@endsection
