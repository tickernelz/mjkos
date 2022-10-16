@extends('backend.layouts.app')
@section('title','Daftar Metode Pembayaran')
@section('content')
    <x-page-index title="Metode Pembayaran" buttonLabel="Tambah Metode Pembayaran"
                  routeCreate="metode_pembayaran.create">
        @if ($metode->IsNotEmpty())
            <table id="dataTable" class="table table-striped table-borderless responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Status</th>
                    @role('admin')
                    <th>Aksi</th>
                    @endrole
                </tr>
                </thead>
                <tbody>
                @foreach ($metode as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>
                            @if ($data->status == 0)
                                <span class="badge badge-danger">Tidak Aktif</span>
                            @elseif($data->status == 1)
                                <span class="badge badge-success">Aktif</span>
                            @endif
                        </td>
                        @role('admin')
                        <td>
                            <div class="table-actions btn-group">
                                <a href="{{route('metode_pembayaran.edit', $data->id)}}"
                                   class="table-action btn btn-primary mr-2"
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
            @include('backend.metodePembayaran.metodePembayaran-modal')
        @else
            <div class="align-items-center bg-light p-3 border-secondary rounded">
                <span class="">Oops!</span><br>
                <p><i class="fas fa-info-circle"></i> Belum Terdapat Data Metode Pembayaran</p>
            </div>
        @endif
    </x-page-index>
@endsection
