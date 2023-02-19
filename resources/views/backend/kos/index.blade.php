@extends('backend.layouts.app')
@section('title','Daftar Kos')
@section('content')
    <x-page-index title="Kos" buttonLabel="Tambah Kos" routeCreate="kos.create" create="1">
        @if ($kos->IsNotEmpty())
            <table id="dataTable" class="table table-striped table-borderless responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kos</th>
                    <th>Tampilkan</th>
                    <th>Status</th>
                    <th>Verifikasi</th>
                    @role('pemilik')
                    <th>Aksi</th>
                    @endrole
                </tr>
                </thead>
                <tbody>
                @foreach ($kos as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>
                            @if ($data->tampil == 1)
                                <span class="badge badge-success">Ya</span>
                            @else
                                <span class="badge badge-warning">Tidak</span>
                            @endif
                        </td>
                        <td>
                            @if ($data->status == 0)
                                <span class="badge badge-success">Tersedia</span>
                            @elseif($data->status == 1)
                                <span class="badge badge-danger">Penuh</span>
                            @endif
                        </td>
                        <td>
                            @if ($data->verifikasi == 'proses')
                                <span class="badge badge-warning">Proses</span>
                            @elseif($data->verifikasi == 'sudah')
                                <span class="badge badge-success">Sudah</span>
                            @elseif($data->verifikasi == 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </td>
                        @role('pemilik')
                        <td>
                            <div class="table-actions btn-group">
                                <a href="{{ route('fasilitas.index', $data->id) }}"
                                   class="table-action btn btn-info mr-2">
                                    Fasilitas
                                </a>
                                <a href="{{ route('peraturan.index', $data->id) }}"
                                   class="table-action btn btn-info mr-2">
                                    Peraturan
                                </a>
                                <a href="{{route('kos.edit', $data->id)}}" class="table-action btn btn-primary mr-2"
                                   data-toggle="tooltip" title="Ubah">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="table-action btn btn-danger delete-btn mr-2" data-toggle="modal"
                                        title="Delete" data-target="#deleteModal"
                                        value="{{$data->id}}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @if($data->verifikasi == 'ditolak')
                                    <button class="table-action btn btn-success mr-2" id="alasan-btn"
                                            value="{{$data->id}}">
                                        Cek Alasan
                                    </button>
                                @endif
                            </div>
                        </td>
                        @endrole
                    </tr>
                @endforeach
                </tbody>
            </table>
            @include('backend.kos.kos-modal')
        @else
            <div class="align-items-center bg-light p-3 border-secondary rounded">
                <span class="">Oops!</span><br>
                <p><i class="fas fa-info-circle"></i> Belum Terdapat Data Fasilitas</p>
            </div>
        @endif
    </x-page-index>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            const alasanBtn = $('#alasan-btn');
            alasanBtn.on('click', function () {
                const id = $(this).val();
                $.ajax({
                    url: "{{route('kos.alasan')}}",
                    type: "GET",
                    data: {id: id},
                    success: function (data) {
                        Swal.fire({
                            title: 'Alasan Ditolak',
                            text: data,
                            icon: 'info',
                            confirmButtonText: 'Oke'
                        })
                    }
                })
            })
        });
    </script>
@endpush
