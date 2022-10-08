@extends('backend.layouts.app')
@section('title','Edit Fasilitas')
@section('content')
    <x-page-form page='edit' route="fasilitas.index" kosId="{{$kos->id}}" title="Fasilitas">
        <form action="{{route('fasilitas.update', [$kos->id, $fasilitas->id])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group row">

                {{-- Name --}}
                <x-form-input label="Nama" type="text" required="required" value="{{$fasilitas->nama}}" name="nama">
                </x-form-input>
            </div>
            <div class="card-footer text-right border-0">
                <a class="btn btn-danger mr-3" href="{{ route('fasilitas.index', $kos->id) }}">Batal</a>
                <x-tabel-button type="submit" color="primary" title="Simpan"></x-tabel-button>
            </div>
        </form>
    </x-page-form>
@endsection
