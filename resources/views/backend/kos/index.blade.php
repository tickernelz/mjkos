@extends('backend.layouts.app')
@section('title','Informasi Rumah Kos')
@section('content')
    <x-alert/>
    <section class="section">
        <div class="section-header">
            <h1>Informasi Rumah Kos</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Form Data Informasi Rumah Kos</h4>
                </div>
                <div class="card-body pt-0">
                    <form action="{{route('kos.update', $kos->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleFormControlInput1"><span style="color:red;">*</span> Nama Kos</label>
                            <input type="text" value="{{$kos->nama}}" name="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   id="exampleFormControlInput1"
                                   placeholder="Nama">
                            @error('nama')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1"><span style="color:red;">*</span> Telphone Kos</label>
                            <input type="number" value="{{$kos->telp}}" name="telp"
                                   class="form-control @error('telp') is-invalid @enderror"
                                   id="exampleFormControlInput1"
                                   placeholder="Telphone">
                            @error('telp')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1"><span style="color:red;">*</span> Email Kos</label>
                            <input type="email" value="{{$kos->email}}" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="exampleFormControlInput1"
                                   placeholder="Email">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address-address"><span style="color:red;">*</span> Alamat Kos</label>
                            <input type="text" value="{{$kos->alamat}}"
                                   class="form-control map-input @error('alamat') is-invalid @enderror"
                                   id="address-input"
                                   name="address_address" placeholder="Alamat">
                            <input type="hidden" name="address_latitude" id="address-latitude" value="0"/>
                            <input type="hidden" name="address_longitude" id="address-longitude" value="0"/>
                            @error('alamat')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div id="address-map-container" style="width:100%;height:400px;margin-bottom: 10px">
                            <div style="width: 100%; height: 100%" id="address-map"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1"><span style="color:red;">*</span> Deskripsi
                                Kos</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                      id="exampleFormControlTextarea1" rows="10" placeholder="Isi Deskripsi Kos"
                                      style="height:100%;">{{$kos->deskripsi}}</textarea>
                            @error('deskripsi')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <img src="{{asset('images/' . $kos->cover)}}" width="500" class="img-fluid">
                            </div>
                            <label for="exampleFormControlInput1"><span style="color:red;">*</span> Gambar
                                Banner</label>
                            <input type="file" class="form-control @error('banner') is-invalid @enderror" name="cover">
                            @error('banner')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="card-footer text-right border-0">
                            <a class="btn btn-danger mr-3" href="{{ route('kamar.index') }}">Batal</a>
                            <x-tabel-button type="submit" color="primary" title="Simpan"></x-tabel-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
        async defer></script>
    <script src="{{ asset('js/mapInput.js') }}"></script>
@endpush
