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
        <div id="cari" class="container p-4 mt-5 shadow-sm"
             style="border-radius: 25px; background: rgba(5, 87, 158, 0.9) !important;">
            <div class="search">
                <div class="section-title">
                    <h4 class="fw-bold text-light">Cari Kos</h4>
                </div>
                <form action="{{ route('cari.kos') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="alamat" id="autocomplete" class="form-control"
                               placeholder="Masukkan Alamat" value="{{ $alamat }}">

                        <div class="form-group" id="latitudeArea">
                            <input type="text" id="latitude" name="latitude" class="form-control" hidden>
                        </div>

                        <div class="form-group" id="longtitudeArea">
                            <input type="text" name="longitude" id="longitude" class="form-control" hidden>
                        </div>
                        <button class="btn btn-outline-light" type="submit" id="cari-btn">Cari</button>
                    </div>
                    {{--Filter--}}
                    <div class="filter_harga" style="margin-top: 2em">
                        <h6 class="fw-bold text-black mb-3">Harga</h6>

                        <div>
                            <label class="filter__label">
                                <input type="text" class="filter__input" name="fil_harga_min">
                            </label>

                            <label class="filter__label">
                                <input type="text" class="filter__input" name="fil_harga_max">
                            </label>
                        </div>

                        <div id="sliderPrice" class="filter__slider-price" data-min="{{$harga_min}}"
                             data-max="{{$harga_max}}"
                             data-step="5"></div>
                    </div>
                </form>
            </div>
        </div>
        <section>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    @if ($kos->isEmpty())
                        <div class="col-md-6">
                            <div class="alert alert-danger text-center">
                                <span class="font-weight-bolder">Data Kos Tidak Ditemukan</span>
                            </div>
                        </div>
                    @endif
                    @foreach ($kos as $item)
                        <div class="col-md-5 mt-5 col-lg-4 col-xl-3">
                            <a href="{{route('detail.kos',$item->id)}}">
                                <div class="card card-item shadow-lg text-black">
                                    <div class="img-content"
                                         style="background-image: url('/images/kos/{{$item->cover}}');">
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <h4 class="card-title fw-bold">{{$item->nama}}</h4>
                                            <p class="text-muted my-0">Ukuran : {{$item->ukuran}}</p>
                                            @if ($jarak != null)
                                                <p class="text-muted my-0">Jarak : {{round($jarak[$item->id], 2)}}
                                                    KM</p>
                                            @endif
                                            <span
                                                style="font-size: 14px">Terakhir diupdate {{$item->updated_at->format('d M Y')}}</span>
                                        </div>
                                        <div class="d-flex justify-content-between total font-weight-bold mt-3">
                                            <span>Rp {{$item->hargaNumber()}}</span><span>/ bulan</span>
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
@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.css" rel="stylesheet">
    <link href="{{asset('css/sliderHarga.css')}}" rel="stylesheet">
@endpush
@push('scripts')
    <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.js"/>
    <script>
        $(document).ready(function () {
            $("#latitudeArea").addClass("d-none");
            $("#longtitudeArea").addClass("d-none");
        });
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());

                $("#latitudeArea").removeClass("d-none");
                $("#longtitudeArea").removeClass("d-none");
            });
        }
    </script>
    <script>
        const slider = document.getElementById('sliderPrice');
        const rangeMin = parseInt(slider.dataset.min);
        const rangeMax = parseInt(slider.dataset.max);
        const step = parseInt(slider.dataset.step);
        const filterInputs = document.querySelectorAll('input.filter__input');

        noUiSlider.create(slider, {
            start: [rangeMin, rangeMax],
            connect: true,
            step: step,
            range: {
                'min': rangeMin,
                'max': rangeMax
            },

            // make numbers whole
            format: {
                to: value => value,
                from: value => value
            }
        });

        // bind inputs with noUiSlider
        slider.noUiSlider.on('update', (values, handle) => {
            filterInputs[handle].value = values[handle];
        });

        filterInputs.forEach((input, indexInput) => {
            input.addEventListener('change', () => {
                slider.noUiSlider.setHandle(indexInput, input.value);
            })
        });
    </script>
@endpush
