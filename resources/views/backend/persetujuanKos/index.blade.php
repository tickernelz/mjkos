@extends('backend.layouts.app')
@section('title','Daftar Persetujuan Kos')
@section('content')
    <x-page-index title="Persetujuan Kos" create="0">
        @if ($kos->IsNotEmpty())
            <table id="dataTable" class="table table-striped table-borderless responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kos</th>
                    <th>Nama User</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($kos as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->nama}}</td>
                        <td>{{$data->user->name}}</td>
                        <td>
                            @if ($data->verifikasi == 'proses')
                                <span class="badge badge-warning">Menunggu Persetujuan</span>
                            @elseif($data->verifikasi == 'ditolak')
                                <span class="badge badge-danger">Ditolak</span>
                            @else
                                <span class="badge badge-success">Disetujui</span>
                            @endif
                        </td>
                        <td>
                            <div class="table-actions btn-group">
                                <a href="{{route('persetujuan_kos.show', $data->id)}}"
                                   class="table-action btn btn-info mr-2" data-toggle="tooltip" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button" class="table-action btn btn-success mr-2 setujui" data-toggle="tooltip"
                                        title="Setujui" id="setujui" value="{{$data->id}}" name="setujui">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button type="button" class="table-action btn btn-danger tolak" data-toggle="tooltip"
                                        title="Tolak" id="tolak" value="{{$data->id}}" name="tolak">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="align-items-center bg-light p-3 border-secondary rounded">
                <span class="">Oops!</span><br>
                <p><i class="fas fa-info-circle"></i> Belum Terdapat Data </p>
            </div>
        @endif
    </x-page-index>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.setujui').on('click', function () {
                var id = $(this).val();
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang sudah disetujui tidak bisa diubah kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, setujui!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{url('/persetujuan_kos')}}/" + id,
                            type: "PUT",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "verifikasi": "sudah"
                            },
                            success: function (data) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Data berhasil disetujui',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                location.reload();
                            },
                            error: function (data) {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Data gagal disetujui',
                                    icon: 'error',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        });
                    }
                })
            });

            $('.tolak').on('click', function () {
                var id = $(this).val();
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang sudah ditolak tidak bisa diubah kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tolak!',
                    html: `<input type="text" id="alasan" class="swal2-input" placeholder="Alasan">`,
                    focusConfirm: false,
                    preConfirm: () => {
                        const alasan = Swal.getPopup().querySelector('#alasan').value
                        if (!alasan) {
                            Swal.showValidationMessage(`Alasan harus diisi`)
                        }
                        return { alasan: alasan }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{url('/persetujuan_kos')}}/" + id,
                            type: "PUT",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "verifikasi": "ditolak",
                                "alasan": result.value.alasan
                            },
                            success: function (data) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Data berhasil ditolak',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                location.reload();
                            },
                            error: function (data) {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Data gagal ditolak',
                                    icon: 'error',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        });
                    }
                })
            });
        });
    </script>

@endpush
