@extends('frontend.layouts.app')
@section('title', 'Trasaksi')
@section('content')
<x-alert />
<!-- ======= Breadcrumbs Section ======= -->
<div class="" style="background-color: #eee; padding-bottom:80px">
    <section class="breadcrumbs shadow-sm" style="background-color: #eee;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="font-weight-bold">Trasaksi</h2>
                <ol>
                    <li><a href="/">Beranda</a></li>
                    <li>Trasaksi</li>
                </ol>
            </div>
        </div>
    </section><!-- Breadcrumbs Section -->
    <section>
        <div class="container-fluid">
            <div class="card shadow mx-4 mb-4 border-0">
                <div class="card-footer text-center">
                    <h3 class="fw-bold">Daftar Kamar Terpilih</h3>
                </div>
                @if ($transaksi->isNotEmpty())
                <div class="card-body p-3">
                    @foreach ($transaksi as $item)
                    <div class="card rounded-3 mb-4">
                        {{-- <div class="">
                            <a href="/surat" title="Surat" class="btn btn-success float-end"><i
                                    class="bi bi-filetype-pdf"> Unduh Bukti Peminjaman</i></a>
                        </div> --}}
                        <div class="card-body p-4">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col col-lg-4">
                                    <div class="img-proc">
                                        <img src="{{asset('images/kamar/'.$item->kamar->cover)}}"
                                            class="img-fluid rounded-3">
                                        <div class="img-proc__content">
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Lihat Semua Gambar
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="text-start">
                                        <h4 class="card-title fw-bold">Kamar Nomor {{$item->kamar->pintu->nama}}</h4>
                                        <p class="text-muted mb-2">Ukuran : {{$item->kamar->ukuran}}</p>
                                    </div>
                                    <div class="my-3">
                                        <span class="fw-bold">Status</span>&nbsp;
                                        @if ($item->status == 1)
                                        <span class="badge bg-secondary">Pengajuan</span>
                                        @elseif($item->status == 2 || $item->status == 3)
                                        <span class="badge bg-warning">Pembayaran</span>
                                        @elseif($item->status == 4 || $item->status == 8)
                                        <span class="badge bg-success">Sewa</span>
                                        @php
                                        $tgl1 = new DateTime(date('Y-m-d'));
                                        $tgl2 = new DateTime($item->tgl_selesai);
                                        $d = $tgl2->diff($tgl1)->days - 1;
                                        @endphp
                                        @if ($d < 0) <span class="badge bg-danger">Masa Sewa Selesai</span>
                                            @elseif ($d == 1)
                                            <span class="badge bg-danger">Masa Sewa Selesai Besok</span>
                                            @else
                                            <span class="badge bg-danger">Sisa Sewa {{$d}} Hari</span>
                                            @endif
                                            @elseif($item->status == 5)
                                            <span class="badge bg-warning">Permintaan Perpanjang</span>
                                            @elseif($item->status == 7)
                                            <span class="badge bg-warning">Pembayaran</span>
                                            @elseif($item->status == -1)
                                            <span class="badge bg-warning">Pengajuan anda ditolak</span>
                                            @elseif($item->status == -2)
                                            <span class="badge bg-warning">Bukti Pembayaran anda ditolak</span>
                                            @endif
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <span>Total biaya Sewa</span>
                                            <p class="fw-bold">Rp{{$item->biaya}}</p>
                                        </div>
                                        <div class="col">
                                            <span>Tanggal Masuk</span>
                                            <p class="fw-bold">{{$item->tgl_mulai}}</p>
                                        </div>
                                        <div class="col">
                                            <span>Durasi Sewa</span>
                                            <p class="fw-bold">{{$item->durasi}} Bulan</p>
                                        </div>
                                    </div>
                                    @if ($item->status == 6 || $item->status == 2 || $item->status == -2)
                                    <div class="row">
                                        <div class="col">
                                            <form action="{{route('update.pembayaran')}}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="text" hidden name="id" value="{{$item->id}}">
                                                
                                                @if ($item->status == -2)
                                                <input type="text" hidden name="status" value="1">
                                                <span style="fw-bold">Upload ulang bukti Pembayaran</span>
                                                @else
                                                <span style="fw-bold">Upload bukti Pembayaran</span>
                                                @endif
                                                <div class="row">
                                                    <input autocomplete="off" type="file"
                                                        class="form-control form-control-user @error('bukti') is-invalid @enderror"
                                                        id="exampleName" placeholder="Nama" name="bukti"
                                                        value="{{ old('bukti') }}">
                                                    <button type="submit"
                                                        class="btn btn-primary mt-2 float-end">Kirim</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="col col-lg-2">
                                    <div class="text-end d-flex">
                                        @if ($item->status < 4)
                                        <a href="{{route('form.pengajuan', $item->kamar_id)}}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                                            @if ($item->status <= 2) 
                                                <button class="btn btn-danger delete-btn mx-2" title="Delete" value="{{$item->id}}"><i class="bi bi-trash"></i></button>
                                            @elseif($item->status == -1)
                                                <a href="/detail/kamar/{{$item->kamar_id}}"
                                                    class="table-action btn btn-warning mx-2" title="Ajukan Ulang">
                                                    <i class="bi bi-arrow-counterclockwise"></i>
                                                </a>
                                            @endif
                                        @else
                                            @if($item->tgl_selesai <= date('Y-m-d'))
                                            <a href="{{route('transaksi.status', [$item->id, 5])}}" class="btn btn-warning mx-2" 
                                            title="Ajukan Perpanjang"> <i class="bi bi-calendar2-plus"></i></a>
                                            <button class="btn btn-danger delete-btn" title="Keluar" data-toggle="tooltip" value="{{$item->id}}"><i class="bi bi-trash"></i></button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="card shadow-sm p-3 mb-4 bg-white rounded" style="border-left: solid 4px rgb(0, 54, 233);">
                    <div class="card-block">
                        <span class="">Oops!</span><br>
                        <p><i class="fa-solid fa-circle-info text-primary"></i> Belum Terdapat transaksi.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>

@if ($transaksi->isNotEmpty())
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto Kamar No {{$item->kamar->pintu->nama}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="hero mb-2" style="background-image: url('/images/kamar/{{$item->kamar->cover}}')">
                </div>
                @foreach ($item->kamar->foto as $data)
                <div class="hero mb-2" style="background-image: url('/images/kamar/multiple/{{$data->nama}}')">
                </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bgdark shadow-2-strong ">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-light" id="deleteModalExample">
                    Anda yakin ingin Menghapus?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body border-0 text-start text-dark">
                Jika anda
                yakin ingin
                manghapus, Tekan Oke !!</div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('user-delete-form').submit();">
                    Oke
                </a>
                <form id="user-delete-form" method="POST" action="{{ route('destroy.transaksi') }}">
                    @csrf
                    <input type="hidden" name="delete_id" id="delete_id">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
    window.onload = window.onload = function () {
        document.getElementById('clickButton').click();
    }

    $(document).on('click', '.delete-btn', function () {
        var sid = $(this).val();
        $('#deleteModal').modal('show')
        $('#delete_id').val(sid)
        // alert(sid)
    });

</script>
@endpush
