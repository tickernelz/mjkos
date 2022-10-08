@extends('backend.layouts.app')
@section('title','Edit Nomer Kamar')
@section('content')
<x-page-form page='edit' route="pintu.index" title="Nomer Kamar">
    <form action="{{route('pintu.update', $pintu->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group row">

            {{-- Name --}}
            <x-form-input label="Nomer Kamar" type="text" required="required" value="{{$pintu->nama}}" name="nama">
            </x-form-input>

        </div>
        <div class="card-footer text-right border-0">
            <a class="btn btn-danger mr-3" href="{{ route('pintu.index') }}">Batal</a>
            <x-tabel-button type="submit" color="primary" title="Simpan"></x-tabel-button>
        </div>
    </form>
</x-page-form>
@endsection
