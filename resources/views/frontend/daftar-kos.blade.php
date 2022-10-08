@extends('frontend.layouts.app')
@section('title', 'Daftar Kos')
@section('content')
    <x-alert/>
    <!-- ======= Breadcrumbs Section ======= -->
    <div class="" style="background-color: #eee; padding-bottom: 130px;">
        <section class="breadcrumbs" style="background-color: #eee;">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="font-weight-bold">Daftar Kos</h2>
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li>Daftar Kos</li>
                    </ol>
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    @foreach ($kos as $item)
                        <div class="col-md-5 mt-5 col-lg-4 col-xl-3">
                            <a href="{{route('detail.kos',$item->id)}}">
                                <div class="card card-item shadow-lg text-black">
                                    <div class="img-content"
                                         style="background-image: url('/images/kos/{{$item->cover}}');">
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <h4 class="card-title fw-bold">Kos Nomor {{$item->nama}}</h4>
                                            <p class="text-muted my-0">Ukuran : {{$item->ukuran}}</p>
                                            <span
                                                style="font-size: 14px">Terakhir diupdate {{$item->updated_at->format('d M Y')}}</span>
                                        </div>
                                        <div class="d-flex justify-content-between total font-weight-bold mt-3">
                                            <span>Rp {{$item->harga}}</span><span>/ bulan</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                @endforeach
                    {{$kos->links()}}
            </div>
        </div>
    </section>
</div>
@endsection
