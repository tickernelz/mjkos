@extends('backend.layouts.app')
@section('title','Detail Booking')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{route('transaksi.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Detail Booking</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{route('transaksi.index')}}">Daftar Transaksi</a></div>
            <div class="breadcrumb-item">Detail Booking</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header pb-0">
                <h4>Data Detail Booking</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-light table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Kode Booking</th>
                            <td class="">{{$transaksi->kode}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nama Pengguna</th>
                            <td>{{$transaksi->user->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nomer Kamar</th>
                            <td>{{ $transaksi->kamar->pintu->nama }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Ukuran Kamar</th>
                            <td>{{ $transaksi->kamar->ukuran }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Tgl Mulai</th>
                            <td>{{ $transaksi->tgl_mulai }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Tgl Selesai</th>
                            <td>{{ $transaksi->tgl_selesai }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Durasi Penggunaan</th>
                            <td>{{ $transaksi->durasi }} Bulan</td>
                        </tr>
                        <tr>
                            <th scope="row">Total Biaya</th>
                            <td><span>Rp.{{ $transaksi->biaya }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).on('click', '.ktp-btn', function () {
        var kid = $(this).val();
        $('#ktpModal').modal('show')
        $('.img').html(`<img src="{{asset('images/ktp/${kid}')}}" width="500" class="img-fluid">`)
    });
    $(document).on('click', '.kk-btn', function () {
        var kid = $(this).val();
        $('#kkModal').modal('show')
        $('.img').html(`<img src="{{asset('images/kk/${kid}')}}" width="500" class="img-fluid">`)
    });
</script>
@endpush
