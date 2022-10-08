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
                            <th scope="row">Tgl Masuk</th>
                            <td>{{ $transaksi->tgl_mulai }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Tgl Selesai</th>
                            <td>{{ $transaksi->tgl_selesai }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Bukti KTP</th>
                            <td><button class="btn btn-primary ktp-btn" value="{{$transaksi->foto_ktp}}">Lihat</button></td>
                        </tr>
                        <tr>
                            <th scope="row">Bukti Kartu Keluarga</th>
                            <td><button class="btn btn-primary kk-btn" value="{{$transaksi->foto_kk}}">Lihat</button></td>
                        </tr>
                        <tr>
                            <th scope="row">Durasi Penggunaan</th>
                            <td>{{ $transaksi->durasi }}</td>
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
    <div class="modal fade" id="ktpModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bgdark shadow-2-strong ">
                <div class="modal-header bg-danger">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body border-0 text-dark">
                    <div class="img"></div>
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kkModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bgdark shadow-2-strong ">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-light" id="deleteModalExample">Foto Kartu Keluarga</h5>       
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body border-0 text-dark">
                    <div class="img"></div>
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Oke</button>
                </div>
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
