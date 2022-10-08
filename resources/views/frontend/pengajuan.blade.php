@extends('frontend.layouts.app')
@section('title','Pengajuan')
@section('content')
<x-alert />
<div class="pb-4" style="background-color: #eee;">
    <section class="breadcrumbs shadow-sm" style="background-color: #eee;">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="font-weight-bold">Pengajuan</h2>
                <ol>
                    <li><a href="/">Beranda</a></li>
                    <li>Pengajuan</li>
                </ol>
            </div>
        </div>
    </section>
    <section style="margin-top: -40px">

        <div class="container">
            @if ($transaksi)
            <div class="isNotEmpty">
                <a href="/transaksi-saya" class="btn btn-warning text-dark fw-bold"><span><i
                            class="bi bi-clipboard"></i>
                        Transaksi Saya</span></a>
                <h3 class="fw-bold mb-3 mt-5 text-muted">Kode Booking Anda : {{$transaksi->kode}}</h3>
                <div class="text-start">
                    <h4 class="card-title fw-bold">Kamar Nomer {{$transaksi->kamar->pintu->nama}}</h4>
                    <p class="text-muted mb-2">Ukuran : {{$transaksi->kamar->ukuran}}</p>
                </div>

                @if($transaksi->status == 1 || $transaksi->status == -1)
                <div class="">
                    <div class="md-stepper-horizontal orange">
                        <div class="md-step active">
                            <div class="md-step-circle"><span>1</span></div>
                            <div class="md-step-title">Ajukan sewa</div>
                            <div class="md-step-bar-right active"></div>
                        </div>
                        <div class="md-step">
                            <div class="md-step-circle"><span>2</span></div>
                            <div class="md-step-title">Pemilik menyetujui</div>
                            <div class="md-step-bar-left"></div>
                            <div class="md-step-bar-right"></div>
                        </div>
                        <div class="md-step">
                            <div class="md-step-circle"><span>3</span></div>
                            <div class="md-step-title">Bayar sewa pertama</div>
                            <div class="md-step-bar-left"></div>
                            <div class="md-step-bar-right"></div>
                        </div>
                        <div class="md-step">
                            <div class="md-step-circle"><span>4</span></div>
                            <div class="md-step-title">Check-in</div>
                            <div class="md-step-bar-left"></div>
                        </div>
                    </div>
                    <div class="data-priadi">
                        <div class="d-flex justify-content-between total font-weight-bold mt-3 fw-bold">
                            <span>Durasi Sewa</span><span>{{$transaksi->durasi}} Bulan</span>
                        </div>
                        <div class="d-flex justify-content-between total font-weight-bold mt-3 fw-bold">
                            <span>Biaya yang harus anda bayar</span><span>Rp {{$transaksi->biaya}}</span>
                        </div>
                    </div>
                    <hr>
                    @if ($transaksi->status == -1)
                    <div class="text-center mt-3">
                        <h2 class="text-danger">PENGAJUAN DITOLAK</h2>
                        <a href="/detail/kamar/{{$transaksi->kamar_id}}" class="table-action btn btn-warning mx-2"
                            data-toggle="tooltip" title="Ajukan Ulang">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>
                    @else
                    <div class="text-center mt-3">
                        <h2>Menunggu Persetujuan Pemilik...</h2>
                    </div>
                    @endif
                </div>

                @elseif($transaksi->status == 2 || $transaksi->status == -2)
                <form action="{{route('update.pembayaran')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <div class="md-stepper-horizontal orange">
                            <div class="md-step active">
                                <div class="md-step-circle"><span>1</span></div>
                                <div class="md-step-title">Ajukan sewa</div>
                                <div class="md-step-bar-right active"></div>
                            </div>
                            <div class="md-step active">
                                <div class="md-step-circle"><span>2</span></div>
                                <div class="md-step-title">Pemilik menyetujui</div>
                                <div class="md-step-bar-left active"></div>
                                <div class="md-step-bar-right active"></div>
                            </div>
                            <div class="md-step active">
                                <div class="md-step-circle"><span>3</span></div>
                                <div class="md-step-title">Bayar sewa pertama</div>
                                <div class="md-step-bar-left active"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step">
                                <div class="md-step-circle"><span>4</span></div>
                                <div class="md-step-title">Check-in</div>
                                <div class="md-step-bar-left"></div>
                            </div>
                        </div>
                        <div class="justify-content-center">
                            <div class="data-priadi">
                                <div class="d-flex justify-content-between total font-weight-bold mt-3 fw-bold">
                                    <span>Durasi Sewa</span><span>{{$transaksi->durasi}} Bulan</span>
                                </div>
                                <div class="d-flex justify-content-between total font-weight-bold mt-3 fw-bold">
                                    <span>Biaya yang harus anda bayar</span><span>Rp {{$transaksi->biaya}}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="data-priadi">
                                <div class="d-flex justify-content-between total font-weight-bold mt-3">
                                    <h4 class="fw-bold">Metode pembayaran</h4>
                                </div>
                                <div class="d-flex justify-content-between total fw-bold mt-3">
                                    <img src="{{asset('frontend/assets/img/bri.png')}}" alt=""
                                        width="10%"><span>034101000743</span>
                                </div>
                                <div class="d-flex justify-content-between total fw-bold mt-3">
                                    <img src="{{asset('frontend/assets/img/bni.png')}}" alt=""
                                        width="10%"><span>034101000743</span>
                                </div>
                                <div class="d-flex justify-content-between total fw-bold mt-3">
                                    <img src="{{asset('frontend/assets/img/mandiri.png')}}" alt=""
                                        width="10%"><span>034101000743</span>
                                </div>
                                <div class="d-flex justify-content-between total fw-bold mt-3">
                                    <img src="{{asset('frontend/assets/img/gopay.png')}}" alt=""
                                        width="10%"><span>034101000743</span>
                                </div>
                            </div>
                            <hr>
                            <div class="data-priadi">
                                <h4 class="fw-bold">Bukti Pembayaran</h4>
                                <span>Mohon upload bukti pembayaran anda.</span>
                                @if ($transaksi->status == -2)
                                <div class="text-center mt-3">
                                    <h2 class="text-danger">BUKTI PEMBAYARAN ANDA DITOLAK</h2><br>
                                    <p>Upload ulang bukti dengan benar.</p>
                                </div>
                                @endif
                                <div class="form-group mt-4">
                                    <div class="ktp">
                                        <label><span style="color:red;">*</span> Upload Bukti Pembayaran</label>
                                        <input type="text" hidden name="id" value="{{$transaksi->id}}">
                                        <input autocomplete="off" type="file"
                                            class="form-control form-control-user @error('bukti') is-invalid @enderror"
                                            id="exampleName" placeholder="Nama" name="bukti" value="{{ old('bukti') }}">
                                        <button type="submit" class="btn btn-primary mt-2 float-end">Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                @elseif($transaksi->status == 3)
                <form action="{{route('update.pengajuan',$transaksi->kamar_id)}}" method="post">
                    @csrf
                    <div class="">
                        <div class="md-stepper-horizontal orange">
                            <div class="md-step active">
                                <div class="md-step-circle"><span>1</span></div>
                                <div class="md-step-title">Ajukan sewa</div>
                                <div class="md-step-bar-right active"></div>
                            </div>
                            <div class="md-step active">
                                <div class="md-step-circle"><span>2</span></div>
                                <div class="md-step-title">Pemilik menyetujui</div>
                                <div class="md-step-bar-left active"></div>
                                <div class="md-step-bar-right active"></div>
                            </div>
                            <div class="md-step active">
                                <div class="md-step-circle"><span>3</span></div>
                                <div class="md-step-title">Bayar sewa pertama</div>
                                <div class="md-step-bar-left active"></div>
                                <div class="md-step-bar-right active"></div>
                            </div>
                            <div class="md-step">
                                <div class="md-step-circle"><span>4</span></div>
                                <div class="md-step-title">Check-in</div>
                                <div class="md-step-bar-left"></div>
                            </div>
                        </div>
                        <div class="data-priadi">
                            <div class="d-flex justify-content-between total font-weight-bold mt-3 fw-bold">
                                <span>Durasi Sewa</span><span>{{$transaksi->durasi}} Bulan</span>
                            </div>
                            <div class="d-flex justify-content-between total font-weight-bold mt-3 fw-bold">
                                <span>Biaya yang harus anda bayar</span><span>Rp {{$transaksi->biaya}}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center mt-3">
                            <h2>Menunggu Konfirmasi Pembayaran...</h2>
                        </div>
                    </div>
                </form>

                @elseif($transaksi->status == 4)
                <div class="">
                    <div class="md-stepper-horizontal orange">
                        <div class="md-step active">
                            <div class="md-step-circle"><span>1</span></div>
                            <div class="md-step-title">Ajukan sewa</div>
                            <div class="md-step-bar-right active"></div>
                        </div>
                        <div class="md-step active">
                            <div class="md-step-circle"><span>2</span></div>
                            <div class="md-step-title">Pemilik menyetujui</div>
                            <div class="md-step-bar-left active"></div>
                            <div class="md-step-bar-right active"></div>
                        </div>
                        <div class="md-step active">
                            <div class="md-step-circle"><span>3</span></div>
                            <div class="md-step-title">Bayar sewa pertama</div>
                            <div class="md-step-bar-left active"></div>
                            <div class="md-step-bar-right active"></div>
                        </div>
                        <div class="md-step active">
                            <div class="md-step-circle"><span>4</span></div>
                            <div class="md-step-title active">Check-in</div>
                            <div class="md-step-bar-left active"></div>
                        </div>
                    </div>
                    <div class="data-priadi">
                        <div class="d-flex justify-content-between total font-weight-bold mt-3 fw-bold">
                            <span>Durasi Sewa</span><span>{{$transaksi->durasi}} Bulan</span>
                        </div>
                        <div class="d-flex justify-content-between total font-weight-bold mt-3 fw-bold">
                            <span>Biaya yang harus anda bayar</span><span>Rp {{$transaksi->biaya}}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center mt-3">
                        <h2>Transaksi Anda Berhasil dilakukan.</h2>
                        {{-- <p><span class="text-danger">*</span> Anda dapat mengunduh surat sewa</p>
                        <a href="/surat" class="btn btn-success"><i class="bi bi-filetype-pdf"></i> Surat Sewa</a> --}}
                    </div>
                </div>
                @endif
            </div>

            @else
            <div class="Empty">
                <a href="/detail/kamar/{{$kamar->id}}" class="btn btn-warning text-dark fw-bold"><span><i
                            class="bi bi-chevron-left"></i>
                        Kembali</span></a>
                <h3 class="fw-bold mb-3 mt-5">Pengajuan Sewa</h3>
                <div class="text-start">
                    <h4 class="card-title fw-bold">Kamar Nomer {{$kamar->pintu->nama}}</h4>
                    <p class="text-muted mb-2">Ukuran : {{$kamar->ukuran}}</p>
                </div>
                <div class="">
                    <form action="{{route('update.pengajuan', $kamar->id)}}" method="post">
                        @csrf
                        <div class="md-stepper-horizontal orange">
                            <div class="md-step active">
                                <div class="md-step-circle"><span>1</span></div>
                                <div class="md-step-title">Ajukan sewa</div>
                                <div class="md-step-bar-right active"></div>
                            </div>
                            <div class="md-step">
                                <div class="md-step-circle"><span>2</span></div>
                                <div class="md-step-title">Pemilik menyetujui</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step">
                                <div class="md-step-circle"><span>3</span></div>
                                <div class="md-step-title">Bayar sewa pertama</div>
                                <div class="md-step-bar-left"></div>
                                <div class="md-step-bar-right"></div>
                            </div>
                            <div class="md-step">
                                <div class="md-step-circle"><span>4</span></div>
                                <div class="md-step-title">Check-in</div>
                                <div class="md-step-bar-left"></div>
                            </div>
                        </div>
                        <div class="justify-content-center">
                            <div class="data-penyewa">
                                <div class="d-flex justify-content-between total font-weight-bold mt-3">
                                    <h4 class="fw-bold">Data Penyewa</h4>
                                    <a href="/profile"><span class="badge bg-primary">Ubah</span></a>
                                </div>
                                <div class="">
                                    <span class="fw-bold">Nama Penyewa</s>
                                        <p class="text-muted">{{auth()->user()->name}}</p>
                                </div>
                                <div class="">
                                    <span class="fw-bold">Nomor Hp</s>
                                        <p class="text-muted">{{auth()->user()->telp}}</p>
                                </div>
                                <div class="">
                                    <span class="fw-bold">Jenis Kelamin</s>
                                        <p class="text-muted">
                                            {{auth()->user()->jk == 'L' ? 'Laki-Laki' : 'Perempuan'}}
                                        </p>
                                </div>
                                <div class="">
                                    <span class="fw-bold">Pekerjaan</s>
                                        <p class="text-muted">
                                            @if (auth()->user()->pekerjaan == 'Mahasiswa')
                                            Mahasiswa
                                            @elseif(auth()->user()->pekerjaan == 'Bekerja')
                                            Bekerja
                                            @else
                                            Lainnya
                                            @endif
                                        </p>
                                </div>
                            </div>
                            <hr>
                            <div class="data-priadi">
                                <div class="d-flex justify-content-between total font-weight-bold mt-3">
                                    <h4 class="fw-bold">Durasi dan Biaya sewa kos</h4>
                                </div>
                                <select id="select" name="durasi" class="form-select selectpicker">
                                    <option value="1" {{$durasi == 1 ? 'selected':''}}>Perbulan</option>
                                    <option value="3" {{$durasi == 3 ? 'selected':''}}>3 Bulan</option>
                                    <option value="6" {{$durasi == 5 ? 'selected':''}}>6 Bulan</option>
                                    <option value="12" {{$durasi == 12 ? 'selected':''}}>12 Bulan</option>
                                </select>
                                <div class="d-flex justify-content-between total font-weight-bold mt-3 fw-bold">
                                    <span>Durasi pembayaran yang dipilih</span><span class="durasi">/ {{$durasi}}
                                        Bulan</span>
                                </div>
                            </div>
                            <hr>
                            <div class="data-priadi">
                                <div class="d-flex justify-content-between total font-weight-bold mt-3 fw-bold">
                                    <input type="text" hidden name="biaya" value="{{$biaya}}" id="endbiaya">
                                    <span>Total Biaya</span><span class="harga">Rp {{$biaya}}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="data-priadi">
                                <div class="d-flex justify-content-between total font-weight-bold mt-3">
                                    <h4 class="fw-bold">Tanggal mulai ngekos</h4>
                                </div>
                                <input type="date" class="form-control" id="date" name="mulai" value="{{$tgl_mulai}}"
                                    id="">
                            </div>
                            <input type="text" hidden id="awal" value="{{$kamar->biaya}}">
                            <div class="mt-4">
                                <button class="btn btn-success p-3" style="width:100%;">Ajukan Sewa</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif

        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    $(document).on('change', '.selectpicker', function () {
        var select = $('#select option:selected').val()
        var nama = `${select} Bulan`
        var str = $('#awal').val();
        var harga = parseInt(str.replaceAll(',', ''))
        var hasil = harga * select
        var reverse = hasil.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        $('.harga').html(`Rp.${ribuan}`)
        $('#endbiaya').val(ribuan)
        $('.durasi').html(`/ ${nama}`)
    });
    var today = new Date().toISOString().split('T')[0];
    $('#date')[0].setAttribute('min', today);

</script>
@endpush
