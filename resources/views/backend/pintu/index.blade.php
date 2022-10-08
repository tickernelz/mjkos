@extends('backend.layouts.app')
@section('title','Daftar Nomer Kamar')
@section('content')
<x-alert/>
<section class="section">
    <div class="section-header">
        <h1>Nomer Kamar</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Daftar Nomer Kamar</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Nomer Kamar</h4>
                <div class="card-header-action">
                    <div>
                        <form action="{{route('pintu.store')}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary create-button"
                                style="border-radius: 0px !important">
                                Tambah Nomer baru
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    @if ($pintu->IsNotEmpty())
                    <table id="dataTable" class="table table-striped table-borderless responsive nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Nomer Kamar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pintu as $key=>$data)
                            <tr>
                                <td>{{$data->nama}}</td>
                                <td>
                                    <div class="table-actions btn-group">
                                        <a href="{{route('pintu.edit',$data->id)}}" class="table-action btn btn-primary mr-2"
                                            data-toggle="tooltip" title="Ubah">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="table-action btn btn-danger delete-btn mr-2"
                                            data-toggle="tooltip" title="Delete" value="{{$data->id}}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('backend.pintu.pintu-modal')
                    @else
                    <div class="align-items-center bg-light p-3 border-secondary rounded">
                        <span class="">Oops!</span><br>
                        <p><i class="fas fa-info-circle"></i> Belum Terdapat Data Nomer Pintu</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).on('click', '.delete-btn', function () {
        var sid = $(this).val();
        $('#deleteModal').modal('show')
        $('#delete_id').val(sid)
    });
</script>
@endpush
