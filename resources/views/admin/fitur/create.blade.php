@extends('template/admin/main')

@section('title', 'Tambah Fitur')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-3 px-4">
        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="/admin/fitur">Fitur</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Fitur</li>
    </ol>
</nav>
<div class="content">
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-theme-1 rounded-3 shadow border-0 d-flex justify-content-between align-items-center">
            <h5 class="my-2">Tambah</h5>
        </div>
        <div class="card-body">
        <form method="post" action="/admin/fitur/store">
            {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Nama Fitur <span class="text-danger">*</span></label>
                <div class="col-md-10">
                    <input type="text" name="nama_fitur" class="form-control {{ $errors->has('nama_fitur') ? 'border-danger' : '' }}" value="{{ old('nama_fitur') }}" placeholder="Masukkan Nama Fitur">
                    @if($errors->has('nama_fitur'))
                    <div class="small text-danger">{{ ucfirst($errors->first('nama_fitur')) }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                <div class="col-md-10">
                    <textarea name="deskripsi_fitur" class="form-control {{ $errors->has('deskripsi_fitur') ? 'border-danger' : '' }}" rows="3" placeholder="Masukkan Nama Fitur">{{ old('deskripsi_fitur') }}</textarea>
                    @if($errors->has('deskripsi_fitur'))
                    <div class="small text-danger">{{ ucfirst($errors->first('deskripsi_fitur')) }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Gambar <span class="text-danger">*</span></label>
                <div class="col-md-10">
                    <input type="file" id="file" class="d-none" accept="image/*">
                    <a class="btn btn-sm btn-secondary btn-file" href="#"><i class="fa fa-folder-open mr-2"></i>Pilih Gambar...</a>
                    <br>
                    <img id="img-file" class="mt-2 img-thumbnail d-none" style="max-height: 150px">
                    <input type="hidden" name="gambar" id="src-img">
                    @if($errors->has('gambar'))
                    <div class="small text-danger">{{ ucfirst($errors->first('gambar')) }}</div>
                    <canvas class="d-none" id="c" width="848" height="480"></canvas>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label"></label>
                <div class="col-md-10">
                    <button type="submit" class="btn btn-theme-1 rounded-3 px-3">Simpan</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal Croppie -->
<div class="modal fade" id="modal-croppie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded-2 border-0">
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
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Batal</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Croppie -->
  
@endsection

@section('js-extra')

<script type="text/javascript" src="{{ asset('assets/plugins/croppie/croppie.min.js') }}"></script>
<script type="text/javascript">
/* Croppie */
var demo = $('#demo').croppie({
    viewport: {width: 640, height: 360},
    boundary: {width: 640, height: 360}
});
var imageURL;

// Button File
$(document).on("click", ".btn-file", function(e){
    e.preventDefault();
    $("#file").trigger("click");
});

// Change Input File
$(document).on("change", "#file", function(){
    readURL(this);
    $("#modal-croppie").modal("show");
});

    // Show Modal Croppie
$('#modal-croppie').on('shown.bs.modal', function(){
    demo.croppie('bind', {
        url: imageURL
    }).then(function(){
        console.log('jQuery bind complete');
    });
});

    // Hide Modal Croppie
$('#modal-croppie').on('hidden.bs.modal', function(){
    $("#file").val(null);
});
// Crop Image
$(document).on("click", "#btn-crop", function(e){
    demo.croppie("result", {
        type: "base64",
        format: "png",
        size: {width: 848, height: 480},
    }).then(function(response){
        var canvas = document.getElementById("c");
        var ctx = canvas.getContext("2d");
        var image = new Image();
        image.onload = function(){
            ctx.drawImage(image, 0, 0);
            $("#img-file").attr("src",canvas.toDataURL("image/png")).removeClass("d-none");
            $("input[name=gambar]").val(canvas.toDataURL("image/png"));
        };
        image.src = response;
    });
    $("#file").val(null);
    $("#modal-croppie").modal("hide");
});
function readURL(input){
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            imageURL = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection

@section('css-extra')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/croppie/croppie.css') }}">

@endsection