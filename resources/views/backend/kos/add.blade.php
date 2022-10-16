@extends('backend.layouts.app')
@section('title','Tambah Kos')
@section('content')
    <x-page-form page='create' route="kos.index" title="Kos">
        <form action="{{route('kos.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama"><span style="color:red;">*</span> Nama Kos</label>
                <input type="text" name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       id="nama"
                       placeholder="Nama">
                @error('nama')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="address-address"><span style="color:red;">*</span> Alamat Kos</label>
                <input type="text"
                       class="form-control map-input @error('alamat') is-invalid @enderror"
                       id="address-input"
                       name="address_address" placeholder="Alamat">
                <input type="hidden" name="address_latitude" id="address-latitude"
                       value="0"/>
                <input type="hidden" name="address_longitude" id="address-longitude"
                       value="0"/>
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
                          style="height:100%;"></textarea>
                @error('deskripsi')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group row mb-0">
                <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                    <div class="row">
                        <div class="col">
                            <span style="color:red;">*</span>Luas Kamar</label>
                            <input autocomplete="off" type="number" name="luas" required
                                   class="form-control form-control-user @error('luas') is-invalid @enderror"
                                   id="exampleName"
                                   placeholder="Luas Kamar"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            @error('luas')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <span style="color:red;">*</span>Lebar Kamar</label>
                            <input autocomplete="off" required type="number" name="lebar"
                                   class="form-control form-control-user @error('lebar') is-invalid @enderror"
                                   placeholder="Lebar Kamar" id="exampleName"
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            @error('lebar')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Status --}}
                <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                    <span style="color:red;">*</span>Tampilkan</label>
                    <select class="form-control form-control-user @error('tampil') is-invalid @enderror" name="tampil">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                    @error('tampil')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                    <span style="color:red;">*</span>Status</label>
                    <select class="form-control form-control-user @error('status') is-invalid @enderror" name="status">
                        <option value="0">Tersedia</option>
                        <option value="1">Penuh</option>
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
                <span style="color:red;">*</span>Cover Foto</label>
                <input type="file" id="input-file-now-custom-3" required class="form-control m-2" name="cover">
                @error('cover')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-imgaes mb-3">
                <span style="color:red;">*</span>Multiple Foto</label>
                <div class="input-group mb-3">
                    <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="multiple[]" required>
                </div>
                <div class="input-group mb-3">
                    <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="multiple[]" required>
                    <button class="btn btn-success" type="button">Tambah Lain</button>
                </div>
                @error('multiple')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="clone"></div>
            </div>

            <div class="card-footer text-right border-0">
                <a class="btn btn-danger mr-3" href="{{ route('kos.index') }}">Batal</a>
                <x-tabel-button type="submit" color="primary" title="Simpan"></x-tabel-button>
            </div>
        </form>
    </x-page-form>
@endsection

@push('scripts')
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
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
        async defer></script>
    <script src="{{ asset('js/mapInput.js') }}"></script>
@endpush
