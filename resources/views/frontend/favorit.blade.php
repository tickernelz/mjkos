@extends('frontend.layouts.app')
@section('title', 'Profile')
@section('content')
<x-alert />
<div class="" style="background-color: #eee;">
    <section class="breadcrumbs shadow-sm" style="background-color: #eee;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="font-weight-bold">Profile</h2>
                <ol>
                    <li><a href="/">Beranda</a></li>
                    <li>Profile</li>
                </ol>
            </div>
        </div>
    </section><!-- Breadcrumbs Section -->

    <section>
        <div class="section-title">
            <h2>Favorit</h2>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @if ($transaksi->isNotEmpty())
                @foreach ($transaksi as $item)
                <div class="col-md-5 mt-5 col-lg-4 col-xl-3">
                    <a href="{{route('detail.kamar',$item->kamar_id)}}">
                        <div class="card card-item shadow-lg text-black">
                            <div class="img-content" style="background-image: url('/images/kamar/{{$item->kamar->cover}}');">
                            </div>
                            <div class="card-body">
                                <div>
                                    <h4 class="card-title fw-bold">Kamar Nomor {{$item->kamar->pintu->nama}}</h4>
                                    <p class="text-muted my-0">Ukuran : {{$item->kamar->ukuran}}</p>
                                    <span style="font-size: 14px">Terakhir diupdate {{$item->kamar->updated_at->format('d M Y')}}</span>
                                </div>
                                <div class="d-flex justify-content-between total font-weight-bold mt-3">
                                    <span>Rp {{$item->kamar->harga}}</span><span>/ bulan</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                {{$transaksi->links()}}
                @else
                <div class="card shadow-sm p-3 mb-4 bg-white rounded" style="border-left: solid 4px rgb(0, 54, 233);">
                    <div class="card-block">
                        <span class="">Oops!</span><br>
                        <p><i class="fa-solid fa-circle-info text-primary"></i> Belum Terdapat Favorit.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection