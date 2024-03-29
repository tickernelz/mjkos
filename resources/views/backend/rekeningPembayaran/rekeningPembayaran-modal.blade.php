{{-- Delete --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bgdark shadow-2-strong ">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-light" id="deleteModalExample">Anda yakin ingin Menghapus?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body border-0 text-dark">Jika anda yakin ingin manghapus, Tekan Oke !!</div>
            <div class="modal-footer border-0">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('user-delete-form').submit();">
                    Oke
                </a>
                <form id="user-delete-form" method="POST"
                      action="{{ route('rekening_pembayaran.destroy', $data->id) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="delete_id" id="delete_id">
                </form>
            </div>
        </div>
    </div>
</div>
