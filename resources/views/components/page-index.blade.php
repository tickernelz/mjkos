<x-alert/>
<section class="section">
    <div class="section-header">
        <h1>{{$title}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            {{-- <div class="breadcrumb-item"><a href="#">Layout</a></div> --}}
            <div class="breadcrumb-item">Daftar {{$title}}</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>{{ 'Daftar '.$title }}</h4>
                @if ($create == null)
                <div class="card-header-action">
                    <div>
                        @role('pemilik')
                        <a href="{{ route($routeCreate) }}" class="btn btn-primary create-button"
                            style="border-radius: 0px !important">
                            {{ $buttonLabel }}
                        </a>
                        @endrole
                    </div>
                </div>
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    {{$slot}}
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(document).ready(function () {
        $(".create-button").click(function () {
            $('#loading').show();
        });

        $('#dataTable').DataTable({
            responsive: true
        });

        $(document).on('click', '.delete-btn', function () {
            var sid = $(this).val();
            $('#deleteModal').modal('show')
            $('#delete_id').val(sid)
            // alert(sid)
        });

        $(document).on('click', '.reset-btn', function () {
            var rid = $(this).val();
            $('#resetModal').modal('show')
            $('#reset_id').val(rid)
            // alert(sid)
        });

        $(document).on('click', '.bukti-btn', function () {
            var kid = $(this).val();
            var bid = $('#biaya').val();
            $('#buktiModal').modal('show')
            $('.img').html(`<img src="{{asset('images/bukti/${kid}')}}" width="500" class="img-fluid">`)
            $('.modal-header').html(`<h5 class="modal-title text-light" id="deleteModalExample">Total Biaya: Rp.${bid}</h5>`)
        });
    });
</script>
@endpush
