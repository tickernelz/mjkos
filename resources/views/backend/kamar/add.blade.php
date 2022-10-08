@extends('backend.layouts.app')
@section('title','Tambah Kamar')
@section('content')
<x-page-form page='create' route="kamar.index" title="Kamar">
    <form action="{{route('kamar.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group row mb-0">

            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <span style="color:red;">*</span>Nomer Kamar</label>
                <select class="form-control form-control-user @error('pintu_id') is-invalid @enderror" name="pintu_id">
                    <option selected disabled>Nomer Kamar</option>
                    @foreach ($pintu as $item)
                    <option value="{{$item->id}}">{{$item->nama}}</option>
                    @endforeach
                </select>
                @error('pintu_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            {{-- Status --}}
            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <div class="row">
                    <div class="col">
                        <span style="color:red;">*</span>Luas Kamar</label>
                        <input autocomplete="off" type="number" name="luas" required
                            class="form-control form-control-user @error('luas') is-invalid @enderror" id="exampleName"
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
                    <option selected disabled>Tampilkan</option>
                    <option value="1" selected>Ya</option>
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
                    <option selected disabled>Status</option>
                    <option value="0">Kosong</option>
                    <option value="1">Dihuni</option>
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
                    <input type="text" id="uang" class="form-control @error('harga') is-invalid @enderror" name="harga"
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

        <div class="form-deskripsi mb-3">
            <span style="color:red;">*</span>Deskripsi</label>
            <textarea class="ckeditor form-control" placeholder="Tambahkan Deskripsi Kamar" name="deskripsi" rows="10"
                style="height:100%;"></textarea>
        </div>
        <div class="card-footer text-right border-0">
            <a class="btn btn-danger mr-3" href="{{ route('fasilitas.index') }}">Batal</a>
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
@endpush
