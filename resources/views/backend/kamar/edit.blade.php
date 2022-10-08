@extends('backend.layouts.app')
@section('title','Edit Kamar')
@section('content')
<x-page-form page='edit' route="kamar.index" title="Kamar">
    <div class="mt-2">
        <div class="">
            <h4 class="text-center">Foto Cover</h4>
        </div>
        <img src="{{asset('images/kamar/'.$kamar->cover)}}" class="img-thumbnail mx-auto d-block" alt="...">
    </div>

    <div class="mt-3 container">
        <h4 class="text-center">Foto Lain</h4>
        <div class="row justify-content-center">
            @foreach ($kamar->foto as $item)
            <div class="card mr-2" style="width: 18rem;">
                <div class="img-content" style="background-image: url('/images/kamar/multiple/{{$item->nama}}');">
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
    <form action="{{route('kamar.update', $kamar->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="">
            <h4 class="text-center">Data Kamar</h4>
        </div>
        <div class="form-group row mb-0">
            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <span style="color:red;">*</span>Nomer Kamar</label>
                <select class="form-control form-control-user @error('pintu_id') is-invalid @enderror" name="pintu_id">
                    <option selected disabled>Nomer Kamar</option>
                    @foreach ($pintu as $item)
                    <option value="{{$item->id}}" {{$item->id == $kamar->pintu_id ? 'selected':''}}>{{$item->nama}}
                    </option>
                    @endforeach
                </select>
                @error('pintu_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            {{-- Name --}}
            <x-form-input label="Ukuran" type="text" required="required" name="ukuran" value="{{$kamar->ukuran}}">
            </x-form-input>

            {{-- Status --}}
            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <span style="color:red;">*</span>Tampilkan</label>
                <select class="form-control form-control-user @error('tampil') is-invalid @enderror" name="tampil">
                    <option value="1" {{$kamar->tampil == 1 ? 'selected':''}}>Ya</option>
                    <option value="0" {{$kamar->tampil == 0 ? 'selected':''}}>Tidak</option>
                </select>
                @error('tampil')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            {{-- Status --}}
            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                <span style="color:red;">*</span>Status</label>
                <select class="form-control form-control-user @error('status') is-invalid @enderror" name="status">
                    <option value="0" {{$kamar->status == 0 ? 'selected':''}}>Kosong</option>
                    <option value="1" {{$kamar->status == 1 ? 'selected':''}}>Dihuni</option>
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
                        value="{{$kamar->harga}}"
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

        <div class="form-deskripsi mb-3">
            <span style="color:red;">*</span>Deskripsi</label>
            <textarea class="ckeditor form-control" placeholder="Tambahkan Deskripsi Kamar" name="deskripsi" rows="10"
                style="height:100%;">{{$kamar->deskripsi}}</textarea>
        </div>
        <div class="card-footer text-right border-0">
            <a class="btn btn-danger mr-3" href="{{ route('kamar.index') }}">Batal</a>
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
@endpush
