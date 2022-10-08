@extends('frontend.layouts.app')
@section('title', 'Detail Kamar')
@section('content')
<x-alert />
<!-- ======= Breadcrumbs Section ======= -->
<div class="" style="background-color: #eee;">
    <section class="breadcrumbs" style="background-color: #eee;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="font-weight-bold">Detail Kamar</h2>
                <ol>
                    <li><a href="/">Beranda</a></li>
                    <li>Detail Kamar</li>
                </ol>
            </div>
        </div>
    </section>
    <section style="margin-top: -40px">
        <div class="container">
            <a href="/daftar" class="btn btn-warning text-dark mb-3 fw-bold"><span><i class="bi bi-chevron-left"></i>
                    Kembali</span></a>
            <header class="header">
                <div class="hero" style="background-image: url('/images/kamar/{{$kamar->cover}}')">
                </div>
                @foreach ($kamar->foto as $key=>$item)
                @if ($key == 0)
                <div class="features bg-warning feature-1"
                    style="background-image: url('/images/kamar/multiple/{{$item->nama}}')">
                </div>
                @endif
                @if ($key == 1)
                <div class="features bg-warning feature-2"
                    style="background-image: url('/images/kamar/multiple/{{$item->nama}}')">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Lihat Semua Gambar
                    </button>
                </div>
                @endif
                @endforeach
            </header>
        </div>
    </section>
    <section style="margin-top: -100px">
        <div class="container">
            <div class="text-start mt-2">
                <h4 class="card-title fw-bold">Kamar Nomor {{$kamar->pintu->nama}}</h4>
                <p class="text-muted mb-2">Ukuran : {{$kamar->ukuran}}</p>
                <span style="font-size: 15px">Terakhir {{$kamar->updated_at}}</span>
            </div>
            <input type="text" id="harga" hidden value="{{$kamar->harga}}">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="float-end">
                        @if ($transaksi)
                            @if ($transaksi->status == 0)
                            <form action="{{route('destroy.transaksi')}}" method="post">
                                @csrf
                                <input type="hidden" name="delete_id" value="{{$transaksi->id}}">
                                <button type="submit" style="border: none"><span class="badge p-2 text-dark bg-light"><i
                                            class="bi bi-heart-fill text-danger"></i> Hapus</span></button>
                            </form>
                            @else
                            <a href="{{route('favorit.add',$kamar->id)}}"><span class="badge p-2 text-dark bg-light"><i
                                        class="bi bi-heart-fill text-secondary"></i> Simpan</span></a>
                            @endif
                        @else
                        <a href="{{route('favorit.add',$kamar->id)}}"><span class="badge p-2 text-dark bg-light"><i
                                    class="bi bi-heart-fill text-secondary"></i> Simpan</span></a>
                        @endif
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h6 class="card-title mb-2 fw-bold">Fasilitas Umum</h6>
                            <ul>
                                @foreach ($fasilitas as $item)
                                <li>{{$item->nama}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col">
                            <h6 class="card-title mb-2 fw-bold">Peraturan Umum</h6>
                            <ul>
                                @foreach ($peraturan as $item)
                                <li>{{$item->nama}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="">
                        <h6 class="card-title mb-2 fw-bold">Deskripsi</h6>
                        <p>{{$kamar->deskripsi}}</p>
                    </div>

                </div>
                <div class="col col-lg-4">
                    <div class="card float-end shadow-lg" style="width: 18rem;">
                        <form action="{{route('form.pengajuan',$kamar->id)}}" method="get">
                            @csrf
                            <div class="card-header" id="tite">
                                <h6 class="card-title text-center fw-bold">Rp.{{$kamar->harga}}/ Bulan</h6>
                            </div>
                            <input type="text" hidden name="biaya" value="{{$kamar->harga}}" id="biaya">
                            <div class="card-body">
                                <div class="">
                                    <input autocomplete="off" type="date" required
                                        class="form-control form-control-user @error('date') is-invalid @enderror"
                                        name="date" id="date" value="{{ old('date') }}">
                                    @error('date')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="my-2">
                                    <select id="select" name="durasi" class="form-select selectpicker">
                                        <option value="1" selected>Perbulan</option>
                                        <option value="3">3 Bulan</option>
                                        <option value="6">6 Bulan</option>
                                        <option value="12">Setahun</option>
                                    </select>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-success" id="btn-submit" style="width:100%">Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Foto Kamar No {{$kamar->pintu->nama}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="hero mb-2" style="background-image: url('/images/kamar/{{$kamar->cover}}')">
                        </div>
                        @foreach ($kamar->foto as $item)
                        <div class="hero mb-2" style="background-image: url('/images/kamar/multiple/{{$item->nama}}')">
                        </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    $(document).on('change', '.selectpicker', function () {
        var select = $('#select option:selected').val()
        var str = $('#harga').val();
        var harga = parseInt(str.replaceAll(',', ''))
        var hasil = harga * select
        var nama = `${select} Bulan`
        var reverse = hasil.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        $('#tite').html(`<h6 id="tite" class="card-title text-center fw-bold">Rp.${ribuan}/ ${nama}</h6>`)
        $('#biaya').val(ribuan)
    });

    var today = new Date().toISOString().split('T')[0];
    $('#date')[0].setAttribute('min', today);
</script>
@endpush
