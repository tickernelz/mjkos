@extends('backend.layouts.app')
@section('title','Tambah Kos')
@section('content')
    <x-page-form page='create' route="metode_pembayaran.index" title="Metode Pembayaran">
        <form action="{{route('metode_pembayaran.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama"><span style="color:red;">*</span> Nama Pembayaran</label>
                <input type="text" name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       id="nama"
                       placeholder="Nama">
                @error('nama')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            {{-- Status --}}
            <div class="form-group">
                <span style="color:red;">*</span>Status</label>
                <select class="form-control form-control-user @error('status') is-invalid @enderror" name="status">
                    <option value="0">Tidak Aktif</option>
                    <option value="1">Aktif</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-imgaes mb-3">
                <span style="color:red;">*</span>Gambar</label>
                <input type="file" id="input-file-now-custom-3" required class="form-control m-2" name="gambar">
                @error('gambar')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="card-footer text-right border-0">
                <a class="btn btn-danger mr-3" href="{{ route('metode_pembayaran.index') }}">Batal</a>
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
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
    <script src="{{ asset('js/mapInput.js') }}"></script>
@endpush
