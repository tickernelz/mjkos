@extends('backend.layouts.app')
@section('title','Edit Kos')
@section('content')
    <x-page-form page='edit' route="kos.index" title="Kos">
        <div class="mt-2">
            <div class="">
                <h4 class="text-center">Foto Cover</h4>
            </div>
            <img src="{{asset('images/kos/'.$kos->cover)}}" style="width: 30em; height: 30em"
                 class="img-thumbnail mx-auto d-block" alt="...">
        </div>

        <div class="mt-3 container">
            <h4 class="text-center">Foto Lain</h4>
            <div class="row justify-content-center">
                @foreach ($kos->foto as $item)
                    <div class="card mr-2" style="width: 18rem;">
                        <div class="img-content" style="background-image: url('/images/kos/multiple/{{$item->nama}}');">
                        </div>
                        <div class="card-body text-center">
                            <form action="{{route('destroy.foto',$item->id)}}" method="post">
                                @csrf
                                <button class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <form action="{{route('kos.update', $kos->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="">
                <h4 class="text-center">Data Kos</h4>
            </div>
            <div class="form-group">
                <label for="nama"><span style="color:red;">*</span> Nama Kos</label>
                <input type="text" value="{{$kos->nama}}" name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       id="nama"
                       placeholder="Nama">
                @error('nama')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="address-address"><span style="color:red;">*</span> Alamat Kos</label>
                <input type="text" value="{{$kos->alamat}}"
                       class="form-control map-input @error('alamat') is-invalid @enderror"
                       id="address-input"
                       name="address_address" placeholder="Alamat">
                <input type="hidden" name="address_latitude" id="address-latitude"
                       value="{{ $kos->address_latitude ?? '0' }}"/>
                <input type="hidden" name="address_longitude" id="address-longitude"
                       value="{{ $kos->address_longitude ?? '0' }}"/>
                @error('address_address')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div id="address-map-container" style="width:100%;height:400px;margin-bottom: 10px">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div>
            <div class="form-group">
                <label for="deskripsi"><span style="color:red;">*</span> Deskripsi
                    Kos</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                          id="deskripsi" rows="10" placeholder="Isi Deskripsi Kos"
                          style="height:100%;">{{$kos->deskripsi}}</textarea>
                @error('deskripsi')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group row mb-0">
                <x-form-input label="Ukuran" type="text" required="required" name="ukuran" value="{{$kos->ukuran}}">
                </x-form-input>

                {{-- Status --}}
                <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                    <span style="color:red;">*</span>Tampilkan</label>
                    <select class="form-control form-control-user @error('tampil') is-invalid @enderror" name="tampil">
                        <option value="1" {{$kos->tampil == 1 ? 'selected':''}}>Ya</option>
                        <option value="0" {{$kos->tampil == 0 ? 'selected':''}}>Tidak</option>
                    </select>
                    @error('tampil')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                    <span style="color:red;">*</span>Status</label>
                    <select class="form-control form-control-user @error('status') is-invalid @enderror" name="status">
                        <option value="0" {{$kos->status == 0 ? 'selected':''}}>Tersedia</option>
                        <option value="1" {{$kos->status == 1 ? 'selected':''}}>Penuh</option>
                    </select>
                    @error('status')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                    <span style="color:red;">*</span>Harga</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" id="uang" class="form-control @error('harga') is-invalid @enderror"
                               name="harga"
                               value="{{$kos->harga}}"
                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        <div class="input-group-append">
                            <span class="input-group-text">/Bulan</span>
                        </div>
                    </div>
                    @error('harga')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="form-imgaes mb-3">
                <span style="color:red;">*</span>Edit Cover Foto</label>
                <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="cover">
                @error('cover')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-imgaes mb-3">
                <span style="color:red;">*</span>Tambah Foto</label>
                <div class="input-group mb-3">
                    <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="multiple[]">
                    <button class="btn btn-success" type="button">Tambah Lain</button>
                </div>
                @error('multiple')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="clone"></div>
            </div>

            <div class="card-footer text-right border-0">
                <a class="btn btn-danger mr-3" href="{{ route('kos.index') }}">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

    </x-page-form>
@endsection

@push('scripts')

    <script>
        $(document).ready(function () {
            $("#rmv").hide();
            $(".btn-success").click(function () {
                $(".clone").append(`
                <div class="input-group mb-3 hdtuto">
                    <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="multiple[]" required>
                    <button class="btn btn-danger" id="rmv" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Hapus Form</button>
                </div>
            `)
            });
            $("body").on("click", "#rmv", function () {
                $(this).parents(".hdtuto").remove();
            });
        });

    </script>

    <script>
        $(function () {
            $("#uang").keyup(function (e) {
                $(this).val(format($(this).val()));
            });
        });
        var format = function (num) {
            var str = num.toString().replace("", ""),
                parts = false,
                output = [],
                i = 1,
                formatted = null;
            if (str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for (var j = 0, len = str.length; j < len; j++) {
                if (str[j] != ",") {
                    output.push(str[j]);
                    if (i % 3 == 0 && j < (len - 1)) {
                        output.push(",");
                    }
                    i++;
                }
            }
            formatted = output.reverse().join("");
            return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };

    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
    <script src="{{ asset('js/mapInput.js') }}"></script>
@endpush
