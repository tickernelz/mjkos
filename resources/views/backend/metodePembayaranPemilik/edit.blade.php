@extends('backend.layouts.app')
@section('title','Edit Metode Pembayaran')
@section('content')
    <x-page-form page='edit' route="metode_pembayaran_pemilik.index" title="Metode Pembayaran">
        <div class="mt-2 mb-3">
            <div class="">
                <h4 class="text-center">Gambar</h4>
            </div>
            <img src="{{asset('images/metode_pembayaran/'.$metode->MetodePembayaran->gambar)}}"
                 class="img-thumbnail mx-auto d-block img-fluid" alt="..." style="width:100%; max-width:200px;">
        </div>

        <form action="{{route('metode_pembayaran_pemilik.update', $metode->id)}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="">
                <h4 class="text-center">Data Metode Pembayaran</h4>
            </div>
            <div class="form-group">
                <label for="nama"><span style="color:red;">*</span> Nama Pembayaran</label>
                <select class="form-control form-control-user @error('nama') is-invalid @enderror" name="nama" disabled>
                    <option value="{{$metode->MetodePembayaran->id}}">{{$metode->MetodePembayaran->nama}}</option>
                </select>
                @error('nama')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nomor"><span style="color:red;">*</span> Nomor Rekening</label>
                <input type="text" name="nomor"
                       value="{{ $metode->nomor }}"
                       class="form-control @error('nomor') is-invalid @enderror"
                       id="nomor"
                       placeholder="Nomor Rekening">
                @error('nomor')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            {{-- Status --}}
            <div class="form-group">
                <span style="color:red;">*</span>Status</label>
                <select class="form-control form-control-user @error('status') is-invalid @enderror" name="status">
                    <option value="0" {{$metode->status == 0 ? 'selected':''}}>Tidak Aktif</option>
                    <option value="1" {{$metode->status == 1 ? 'selected':''}}>Aktif</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="card-footer text-right border-0">
                <a class="btn btn-danger mr-3" href="{{ route('metode_pembayaran_pemilik.index') }}">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

    </x-page-form>
@endsection

@push('scripts')
@endpush
