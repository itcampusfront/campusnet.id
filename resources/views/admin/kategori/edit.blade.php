@extends('template/admin/main')

@section('title', 'Edit Kategori')

@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-list"></i> Edit Kategori</h1>
      <p>Menu untuk menambah data kategori</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="/admin/kategori">Kategori</a></li>
      <li class="breadcrumb-item">Edit Kategori</li>
    </ul>
  </div>
  <div class="row">
    <div class="col-lg-6 mx-auto">
      <div class="tile">
        <form method="post" action="/admin/kategori/update" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $kategori->id_kategori }}">
            <div class="tile-title-w-btn">
                <h3 class="title">Edit Kategori</h3>
                <p><button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-save mr-2"></i>Simpan</button></p>
            </div>
            <div class="tile-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kategori" class="form-control {{ $errors->has('nama_kategori') ? 'is-invalid' : '' }}" value="{{ $kategori->nama_kategori }}" placeholder="Masukkan Nama Kategori">
                        @if($errors->has('nama_kategori'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('nama_kategori')) }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                      <label>Gambar</label>
                      <br>
                      <input type="file" id="file" class="d-none" accept="image/*">
                      <a class="btn btn-sm btn-secondary btn-file" href="#"><i class="fa fa-folder-open mr-2"></i>Pilih Gambar...</a>
                      <br>
                      <img id="img-file" src="{{ $kategori->gambar_kategori != '' ? asset('assets/images/kategori/'.$kategori->gambar_kategori) : '' }}" class="mt-2 img-thumbnail {{ $kategori->gambar_kategori != '' ? '' : 'd-none' }}" style="max-height: 150px">
                      <input type="hidden" name="gambar" id="src-img">
                    </div>
                </div>
            </div>
            <div class="tile-footer"><button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-save mr-2"></i>Simpan</button></div>
        </form>
      </div>
    </div>
  </div>
</main>

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
        viewport: {width: 500, height: 333},
        boundary: {width: 500, height: 333}
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
    $('#modal-croppie').on('shown.bs.hidden', function(){
		  $("#img-file").removeAttr("src");
      $("input[name=gambar]").val("");
      $("#file").val(null);
    });

    // Crop Image
    $(document).on("click", "#btn-crop", function(e){
      demo.croppie("result", {
          type: "base64",
          format: "jpg",
          size: {width: 1000, height: 667}
      }).then(function(response){
        $("#img-file").attr("src",response).removeClass("d-none");
        $("input[name=gambar]").val(response);
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