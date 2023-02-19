@extends('backend.layouts.app')
@section('title','Detail Kos')
@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('persetujuan_kos.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detail Kos</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('persetujuan_kos.index')}}">Daftar Persetujuan Kos</a>
                </div>
                <div class="breadcrumb-item">Detail Kos</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header pb-0">
                    <h4>Data Detail Kos</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center p-3 pt-2">
                        <h4 class="text-center font-weight-bold text-dark">DETAIL KOS</h4>
                        <div class="mt-2">
                            <img src="{{asset('images/kos/'.$kos->cover)}}" style="width: 30em; height: 30em"
                                 class="img-thumbnail mx-auto d-block" alt="...">
                        </div>
                        <div class="mt-3 container">
                            <div class="row justify-content-center">
                                @foreach ($kos->foto as $item)
                                    <div class="card mr-2" style="width: 18rem;">
                                        <div class="img-content"
                                             style="background-image: url('/images/kos/multiple/{{$item->nama}}');">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-light table-bordered">
                        <tbody>
                        <tr>
                            <th scope="row">Nama Kos</th>
                            <td class="">{{$kos->nama}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat Kos</th>
                            <td class="">{{$kos->alamat}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Deskripsi Kos</th>
                            <td class="">{{$kos->deskripsi}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Fasilitas</th>
                            <td class="">
                                @foreach ($kos->fasilitas as $item)
                                    <span class="badge badge-primary">{{$item->nama}}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Peraturan</th>
                            <td class="">
                                @foreach ($kos->peraturan as $item)
                                    - {{$item->nama}} <br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Ukuran</th>
                            <td class="">{{$kos->ukuran}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Harga</th>
                            <td class="">Rp {{$kos->hargaNumber()}} / Bulan</td>
                        </tr>
                        <tr>
                            <th scope="row">Surat Ijin</th>
                            <td>
                                <button class="btn btn-primary surat-btn" value="{{$kos->surat_kos}}">Lihat</button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Alasan Penolakan</th>
                            <td>
                                @if ($kos->alasan_tolak == null)
                                    <span class="badge badge-success">Tidak Ada</span>
                                @else
                                    <span class="badge badge-danger">{{$kos->alasan_tolak}}</span>
                            @endif
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="suratModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content bgdark shadow-2-strong ">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-light" id="deleteModalExample">Dokumen Surat Ijin</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body border-0 text-dark">
                        <div class="pdf"></div>
                    </div>
                    <div class="modal-footer border-0">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Oke</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.surat-btn', function () {
            var surat_id = $(this).val();
            $('#suratModal').modal('show')
            $('.pdf').html('<embed src="/surat_kos/' + surat_id + '" type="application/pdf" width="100%" height="600px" />')
        });
    </script>
@endpush
