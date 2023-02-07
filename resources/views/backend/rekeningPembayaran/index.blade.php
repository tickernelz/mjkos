@extends('backend.layouts.app')
@section('title','Daftar Rekening Pembayaran')
@section('content')
    <x-page-index title="Rekening Pembayaran" buttonLabel="Tambah Rekening Pembayaran"
                  routeCreate="rekening_pembayaran.create">
        @if ($metode->IsNotEmpty())
            <table id="dataTable" class="table table-striped table-borderless responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nomor Rekening</th>
                    <th>Status</th>
                    @role('pemilik')
                    <th>Aksi</th>
                    @endrole
                </tr>
                </thead>
                <tbody>
                @foreach ($metode as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->MetodePembayaran->nama}}</td>
                        <td>{{$data->nomor}}</td>
                        <td>
                            @if ($data->status == 0)
                                <span class="badge badge-danger">Tidak Aktif</span>
                            @elseif($data->status == 1)
                                <span class="badge badge-success">Aktif</span>
                            @endif
                        </td>
                        @role('pemilik')
                        <td>
                            <div class="table-actions btn-group">
                                <a href="{{route('rekening_pembayaran.edit', $data->id)}}"
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
            @include('backend.rekeningPembayaran.rekeningPembayaran-modal')
        @else
            <div class="align-items-center bg-light p-3 border-secondary rounded">
                <span class="">Oops!</span><br>
                <p><i class="fas fa-info-circle"></i> Belum Terdapat Data Rekening Pembayaran</p>
            </div>
        @endif
    </x-page-index>
@endsection
