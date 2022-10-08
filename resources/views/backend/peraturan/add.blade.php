@extends('backend.layouts.app')
@section('title','Tambah Peraturan')
@section('content')
<x-page-form page='create' route="peraturan.index" title="Peraturan">
    <form action="{{route('peraturan.store')}}" method="post">
        @csrf
        <div class="form-group row">

            {{-- Name --}}
            <x-form-input label="Nama" type="text" required="required" name="nama"></x-form-input>

        </div>
        <div class="card-footer text-right border-0">
            <a class="btn btn-danger mr-3" href="{{ route('peraturan.index') }}">Batal</a>
            <x-tabel-button type="submit" color="primary" title="Simpan"></x-tabel-button>
        </div>
    </form>
</x-page-form>
@endsection
