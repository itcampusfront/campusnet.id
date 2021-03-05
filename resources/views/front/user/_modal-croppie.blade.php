

<!-- Modal Croppie -->
<div class="modal fade" id="modal-croppie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Potong Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<div class="table-responsive">
                	<div id="demo" class="mt-3"></div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn-crop"><i class="fa fa-save mr-2"></i>Potong dan Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Batal</button>
            </div>
            <form id="form-croppie" class="d-none" method="post" action="/profil/update-foto">
                {{ csrf_field() }}
                <input type="hidden" name="gambar">
            </form>
        </div>
    </div>
</div>
<!-- End Modal Croppie -->