@extends('backend.layouts.app')
@section('title','Daftar Pengguna Kamar')
@section('content')
    <x-page-index title="Pengguna Kamar" create="0" buttonLabel="Tambah pengguna" routeCreate="transaksi.create">
        @if ($pengguna->IsNotEmpty())
            <table id="dataTable" class="table table-striped table-borderless responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Transaksi</th>
                    <th>Nama User</th>
                    <th>Nama Kos</th>
                    <th>Tanggal Masuk</th>
                    <th>Sisa Hari</th>
                    @role('pemilik')
                    <th>Aksi</th>
                    @endrole
                </tr>
                </thead>
                <tbody>
                @foreach ($pengguna as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->kode}}</td>
                        <td>{{$data->kos->nama}}</td>
                        <td>{{$data->tgl_mulai}}</td>
                        <td>{{$data->tgl_selesai}}</td>
                        @php
                            $tgl1 = new DateTime(date('Y-m-d'));
                            $tgl2 = new DateTime($data->tgl_selesai);
                            $d = $tgl2->diff($tgl1)->days - 1;
                        @endphp
                        <td>
                            @if ($d < 0)
                                <span class="badge badge-danger">Masa Sewa Selesai</span>
                            @elseif ($d == 1)
                                <span class="badge badge-danger">Masa Sewa Selesai Besok</span>
                            @else
                                <span class="badge badge-danger">Sisa Sewa {{$d}} Hari</span>
                            @endif
                        </td>
                        @role('pemilik')
                        <td>
                            <div class="table-actions btn-group">
                                <a href="{{route('transaksi.show', $data->id)}}" class="table-action btn btn-info mr-2"
                                   data-toggle="tooltip" title="Detail">
                                    Detail
                                </a>
                                <button class="btn btn-danger delete-btn mr-2" title="Delete" value="{{$data->id}}">
                                    Hapus
                                </button>
                                @if ($data->status == 5)
                                    <a href="{{route('transaksi.status', [$data->id, 6])}}"
                                       class="table-action btn btn-success mr-2" data-toggle="tooltip"
                                       title="Konfimasi Pembayaran">
                                        Setuju Perpanjang
                                    </a>
                                    <a href="{{route('transaksi.status', [$data->id, -8])}}"
                                       class="table-action btn btn-danger mr-2" data-toggle="tooltip"
                                       title="Setujui Pengajuan">
                                        Tolak Perpanjang
                                    </a>
                                @elseif ($data->status == 7)
                                    <a href="{{route('transaksi.status', [$data->id, 8])}}"
                                       class="table-action btn btn-success mr-2" data-toggle="tooltip"
                                       title="Setujui Pengajuan">
                                        Konfirmasi Pembayaran
                                    </a>
                                    <button class="btn btn-primary bukti-btn" value="{{$data->foto_pembayaran}}">Cek
                                        Bukti
                                        Pembayaran
                                    </button>
                                    <input type="text" hidden id="biaya" value="{{$data->biaya}}">
                                @endif
                            </div>
                        </td>
                        @endrole
                    </tr>
                @endforeach
                </tbody>
            </table>
            @include('backend.transaksi.transaksi-modal')
        @else
            <div class="align-items-center bg-light p-3 border-secondary rounded">
                <span class="">Oops!</span><br>
                <p><i class="fas fa-info-circle"></i> Belum Terdapat Data transaksi</p>
            </div>
        @endif
    </x-page-index>
@endsection
