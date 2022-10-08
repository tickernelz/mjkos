@extends('frontend.layouts.app')
@section('title','Home')
@section('content')
    <x-alert/>
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-cntent-center align-items-center"
             style="background: url('/images/{{$pengaturan->cover}}') top center; background-size: cover;">
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown"><span>Mau Cari Tempat Kos ?</span>
                </h2>
                <p class="animate__animated animate__fadeInUp">Cari Kos Sesuai Kebutuhanmu di
                    <span class="fw-bold">{{$pengaturan->nama}}</span> Sekarang.</p>
                <a href="/daftar" class="btn-get-started animate__animated animate__fadeInUp scrollto">Cari Kos</a>
            </div>
        </div>
    </section><!-- End Hero -->

    <div id="tracking" class="container p-4 mt-5 shadow-sm"
         style="border-radius: 25px; background: rgba(5, 87, 158, 0.9) !important;">
        <div class="search">
            <div class="section-title">
                <h4 class="fw-bold text-light">Tracking Kode Booking</h4>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="kode" placeholder="Masukkan Kode Booking Anda"
                       aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-light" type="button" id="tracking-btn">Cari</button>
            </div>
            <div class="hasil"></div>

        </div>
    </div>

    <!-- ======= Services Section ======= -->
    <section id="icon-boxes" class="icon-boxes">
        <div class="container" data-aos="fade-up">
            <div class="d-flex justify-content-between mb-3">
                <h2 class="title" style="color: #054a85;">Kos Pilihan</h2>
                <a href="/daftar" class="btn btn-light shadow-sm" style="border:1px solid rgb(189, 189, 189)">Lihat
                    Semua</a>
            </div>
            <div class="row">
                @foreach ($kos as $key=>$item)
                    <div class="col-md-5 mt-5 col-lg-4 col-xl-3">
                        <a href="{{route('detail.kos',$item->id)}}">
                            <div class="card card-item shadow-lg text-black">
                                <div class="img-content"
                                     style="background-image: url('/images/kos/{{$item->cover}}');">
                                </div>
                                <div class="card-body">
                                    <div>
                                        <h4 class="card-title fw-bold">{{ $item->nama }}</h4>
                                        <p class="text-muted my-0">Ukuran : {{$item->ukuran}}</p>
                                        <span style="font-size: 14px">Terakhir diupdate
                                    {{$item->updated_at->format('d M Y')}}</span>
                                    </div>
                                    <div class="d-flex justify-content-between total font-weight-bold mt-3">
                                        <span>Rp {{$item->harga}}</span><span>/ bulan</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- End Services Section -->
    <div id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="text-center">
                    <h1 class="logo fw-bold"></i>MJK<i class="bi bi-house-heart-fill"></i>S</h1>
                    <span class="text-start">{{$pengaturan->deskripsi}}</span>
                    <div class="row mt-3">
                        <div class="col">
                            <div class="fw-bold">Nomor Telp</div>
                            <div class="">{{$pengaturan->telp}}</div>
                        </div>
                        <div class="col">
                            <div class="fw-bold">Email</div>
                            <div class="">{{$pengaturan->email}}</div>
                        </div>
                        <div class="col">
                            <div class="fw-bold">Alamat</div>
                            <div class="">{{$pengaturan->alamat}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ======= Footer ======= -->
        <footer id="footer">
            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>Muhammad Jailani</span></strong> 2022.
                </div>
            </div>
        </footer>
    </div>
@endsection


@push('scripts')
    <script>
        $("#kode").keyup(function (event) {
            if (event.keyCode === 13) {
                var kode = $('#kode').val()
                if (kode == '') {
                    data = `<h1 class="text-center text-warning fw-bold">Masukkan Kode anda.</h1>`
                    $('.hasil').html(data);
                } else {
                    $.ajax({
                        url: "{{ route('tracking') }}",
                        type: "GET",
                        data: {
                            kode: kode
                        },
                        success: function (data) {
                            console.log(data);
                            if (data.output == null) {
                                data =
                                    `<h1 class="text-center text-warning fw-bold">Kode tidak ditemukan</h1>`
                            } else {
                                data = `
                                <div class="md-stepper-horizontal orange">
                                    <div class="md-step active">
                                        <div class="md-step-circle"><span>1</span></div>
                                        <div class="md-step-title">Ajukan sewa</div>
                                        <div class="md-step-bar-right active"></div>
                                    </div>
                                    <div class="md-step ${data.output >= 2 ? 'active' : ''}">
                                        <div class="md-step-circle"><span>2</span></div>
                                        <div class="md-step-title">Pemilik menyetujui</div>
                                        <div class="md-step-bar-left ${data.output >= 2 ? 'active' : ''}"></div>
                                        <div class="md-step-bar-right ${data.output >= 2 ? 'active' : ''}"></div>
                                    </div>
                                    <div class="md-step ${data.output >= 2 ? 'active' : ''}">
                                        <div class="md-step-circle"><span>3</span></div>
                                        <div class="md-step-title">Bayar sewa pertama</div>
                                        <div class="md-step-bar-left ${data.output >= 2 ? 'active' : ''}"></div>
                                        <div class="md-step-bar-right ${data.output >= 3 ? 'active' : ''}"></div>
                                    </div>
                                    <div class="md-step ${data.output >= 4 ? 'active' : ''}">
                                        <div class="md-step-circle"><span>4</span></div>
                                        <div class="md-step-title">Check-in</div>
                                        <div class="md-step-bar-left ${data.output >= 4 ? 'active' : ''}"></div>
                                    </div>
                                </div>`
                            }
                            $('.hasil').html(data);
                        }
                    });
                }
            }
        });

        $(document).on('click', '#tracking-btn', function () {
            var kode = $('#kode').val()
            if (kode == '') {
                data = `<h1 class="text-center text-warning fw-bold">Masukkan Kode anda.</h1>`
                $('.hasil').html(data);
            } else {
                $.ajax({
                    url: "{{ route('tracking') }}",
                    type: "GET",
                    data: {
                        kode: kode
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.output == null) {
                            data =
                                `<h1 class="text-center text-warning fw-bold">Kode tidak ditemukan</h1>`
                        } else {
                            data = `
                                    <div class="md-stepper-horizontal orange">
                                        <div class="md-step active">
                                            <div class="md-step-circle"><span>1</span></div>
                                            <div class="md-step-title">Ajukan sewa</div>
                                            <div class="md-step-bar-right active"></div>
                                        </div>
                                        <div class="md-step ${data.output >= 2 ? 'active' : ''}">
                                            <div class="md-step-circle"><span>2</span></div>
                                            <div class="md-step-title">Pemilik menyetujui</div>
                                            <div class="md-step-bar-left ${data.output >= 2 ? 'active' : ''}"></div>
                                            <div class="md-step-bar-right ${data.output >= 2 ? 'active' : ''}"></div>
                                        </div>
                                        <div class="md-step ${data.output >= 2 ? 'active' : ''}">
                                            <div class="md-step-circle"><span>3</span></div>
                                            <div class="md-step-title">Bayar sewa pertama</div>
                                            <div class="md-step-bar-left ${data.output >= 2 ? 'active' : ''}"></div>
                                            <div class="md-step-bar-right ${data.output >= 3 ? 'active' : ''}"></div>
                                        </div>
                                        <div class="md-step ${data.output >= 4 ? 'active' : ''}">
                                            <div class="md-step-circle"><span>4</span></div>
                                            <div class="md-step-title">Check-in</div>
                                            <div class="md-step-bar-left ${data.output >= 4 ? 'active' : ''}"></div>
                                        </div>
                                    </div>`
                        }
                        $('.hasil').html(data);
                    }
                });
            }
        });

    </script>

@endpush
