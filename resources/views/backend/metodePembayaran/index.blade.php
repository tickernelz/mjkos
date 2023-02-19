@extends('backend.layouts.app')
@section('title','Daftar Metode Pembayaran')
@section('content')
    <x-page-index title="Metode Pembayaran" buttonLabel="Tambah Metode Pembayaran"
                  routeCreate="metode_pembayaran.create" create="1">
        @if ($metode->IsNotEmpty())
            <table id="dataTable" class="table table-striped table-borderless responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Created By</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($metode as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>@if($data->user == null)
                                Admin
                            @else
                                {{$data->user->name}}
                            @endif</td>
                        <td>
                            @if ($data->status == 0)
                                <span class="badge badge-danger">Tidak Aktif</span>
                            @elseif($data->status == 1)
                                <span class="badge badge-success">Aktif</span>
                            @endif
                        </td>
                        <td>
                            @if($data->user_id == Auth::id() || Auth::user()->hasRole('admin'))
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
                            @endif
                        </td>
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
