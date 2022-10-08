@extends('backend.layouts.app')
@section('title','Daftar Transaksi')
@section('content')
<x-page-index title="Transaksi" create="0" buttonLabel="Tambah transaksi" routeCreate="transaksi.create">
    @if ($transaksi->IsNotEmpty())
    <table id="dataTable" class="table table-striped table-borderless responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Booking</th>
                <th>Nama</th>
                <th>Nomor Kamar</th>
                <th>Durasi</th>
                @role('pemilik')
                <th>Aksi</th>
                @endrole
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $key=>$data)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$data->kode}}</td>
                <td>{{$data->user->name}}</td>
                <td>{{$data->kamar->pintu->nama}}</td>
                <td>{{$data->durasi}} Bulan</td>
                @role('pemilik')
                <td>
                    <div class="table-actions btn-group">
                        <a href="{{route('transaksi.show', $data->id)}}" class="table-action btn btn-info mr-2" data-toggle="tooltip" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if ($data->status == 1)
                        <a href="{{route('transaksi.status', [$data->id, 2])}}" class="table-action btn btn-success mr-2"
                            data-toggle="tooltip" title="Setujui Pengajuan">
                            <i class="fas fa-check"></i>
                        </a>
                        <a href="{{route('transaksi.status', [$data->id, -1])}}" class="table-action btn btn-warning mr-2"
                            data-toggle="tooltip" title="Tolak Pengajuan">
                            <i class="fas fa-times"></i>
                        </a>
                        @elseif($data->status == 2)
                        <a href="#" class="table-action btn btn-secondary mr-2"
                            data-toggle="tooltip" title="Konfimasi Pembayaran">
                            <i class="fas fa-tasks"></i>
                        </a>
                        <button disabled class="btn btn-secondary">Cek Bukti Pembayaran</button>
                        @elseif($data->status == 3)
                        <a href="{{route('transaksi.status', [$data->id, 4])}}" class="table-action btn btn-success mr-2"
                            data-toggle="tooltip" title="Konfimasi Pembayaran">
                            <i class="fas fa-tasks"></i>
                        </a>
                        <button class="btn btn-primary bukti-btn" value="{{$data->foto_pembayaran}}">Cek Bukti Pembayaran</button>
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
