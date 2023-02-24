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
                            <th scope="row">Nama Penyewa</th>
                            <td>{{$transaksi->user->name}} <a href="/pengguna/{{$transaksi->user->id}}"
                                                              class="btn btn-sm btn-primary" style="margin-left: 10px">Detail</a>
                            </td>
                        </tr>
                        {{--<tr>
                            <th scope="row">Penyewa Tambahan</th>
                            <td>
                                @if($transaksi->penyewa_tambahan == null)
                                    <span class="badge badge-danger">Tidak Ada</span>
                                @else
                                    @foreach($transaksi->penyewa_tambahan as $penyewa)
                                        <li style="margin-bottom: 5px; margin-top: 3px">{{$penyewa->nama}}
                                            <span class="badge badge-primary">KTP: {{$penyewa->ktp}}</span>
                                        </li>
                            @endforeach
                            @endif
                        </tr>--}}
                        <tr>
                            <th scope="row">Nama Kos</th>
                            <td>{{ $transaksi->kos->nama }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Ukuran Kamar</th>
                            <td>{{ $transaksi->kos->ukuran }}</td>
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
