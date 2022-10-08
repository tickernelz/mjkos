@extends('backend.layouts.app')
@section('title','Daftar Pengguna')
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
                <div class="d-flex flex-column align-items-center text-center p-3 pt-2">
                    <h4 class="text-center font-weight-bold text-dark">DETAIL PENGGUNA</h4>
                    <img class="rounded-circle my-2" width="150px"
                        src="{{ asset($user->foto ? 'images/user/'. $user->foto : 'backend/assets/img/avatar/avatar-1.png') }}">
                        <h5>{{$user->name}}</h5>
                </div>
                <table class="table table-striped table-light table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row">Email</th>
                            <td class="">{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Kelamin</th>
                            <td class="">{{auth()->user()->jk == 'L' ? 'Laki-Laki' : 'Perempuan'}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td class="">
                                @if (auth()->user()->pekerjaan == 'Mahasiswa')
                                Mahasiswa
                                @elseif(auth()->user()->pekerjaan == 'Bekerja')
                                Bekerja
                                @else
                                Lainnya
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td class="">
                                @if (auth()->user()->status == '1')
                                Belum Kawin
                                @elseif(auth()->user()->status == '2')
                                Kawin
                                @elseif(auth()->user()->status == '3')
                                Kawin Memiliki Anak
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Bukti KTP</th>
                            <td><button class="btn btn-primary ktp-btn" value="{{$user->foto_ktp}}">Lihat</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Bukti Kartu Keluarga</th>
                            <td><button class="btn btn-primary kk-btn" value="{{$user->foto_kk}}">Lihat</button>
                            </td>
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
