@extends('backend.layouts.app')
@section('title','Daftar Kos')
@section('content')
    <x-page-index title="Kos" buttonLabel="Tambah Kos" routeCreate="kos.create">
        @if ($kos->IsNotEmpty())
            <table id="dataTable" class="table table-striped table-borderless responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kos</th>
                    <th>Tampilkan</th>
                    <th>Status</th>
                    @role('pemilik')
                    <th>Aksi</th>
                    @endrole
                </tr>
                </thead>
                <tbody>
                @foreach ($kos as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>
                            @if ($data->tampil == 1)
                                <span class="badge badge-success">Ya</span>
                            @else
                                <span class="badge badge-warning">Tidak</span>
                            @endif
                        </td>
                        <td>
                            @if ($data->status == 0)
                                <span class="badge badge-success">Tersedia</span>
                            @elseif($data->status == 1)
                                <span class="badge badge-danger">Penuh</span>
                            @endif
                        </td>
                        @role('pemilik')
                        <td>
                            <div class="table-actions btn-group">
                                <a href="{{ route('fasilitas.index', $data->id) }}"
                                   class="table-action btn btn-info mr-2">
                                    Fasilitas
                                </a>
                                <a href="{{ route('peraturan.index', $data->id) }}"
                                   class="table-action btn btn-info mr-2">
                                    Peraturan
                                </a>
                                <a href="{{route('kos.edit', $data->id)}}" class="table-action btn btn-primary mr-2"
                                   data-toggle="tooltip" title="Ubah">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="table-action btn btn-danger delete-btn mr-2" data-toggle="tooltip"
                                        title="Delete"
                                        value="{{$data->id}}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                        @endrole
                    </tr>
                @endforeach
                </tbody>
            </table>
            @include('backend.kos.kos-modal')
        @else
            <div class="align-items-center bg-light p-3 border-secondary rounded">
                <span class="">Oops!</span><br>
                <p><i class="fas fa-info-circle"></i> Belum Terdapat Data Fasilitas</p>
            </div>
        @endif
    </x-page-index>
@endsection
