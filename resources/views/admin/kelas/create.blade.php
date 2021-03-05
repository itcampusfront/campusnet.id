@extends('template/admin/main')

@section('title', 'Tambah Kelas')

@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-list"></i> Tambah Kelas</h1>
      <p>Menu untuk menambah data kelas</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="/admin/kelas">Kelas</a></li>
      <li class="breadcrumb-item">Tambah Kelas</li>
    </ul>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="tile">
        <form id="form" method="post" action="/admin/kelas/store" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="tile-title-w-btn">
                <h3 class="title">Tambah Kelas</h3>
                <p><button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-save mr-2"></i>Simpan</button></p>
            </div>
            <div class="tile-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kelas" class="form-control {{ $errors->has('nama_kelas') ? 'is-invalid' : '' }}" value="{{ old('nama_kelas') }}" placeholder="Masukkan Nama kelas">
                        @if($errors->has('nama_kelas'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('nama_kelas')) }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label>Deskripsi Kelas</label>
                        <textarea name="deskripsi_kelas" class="form-control {{ $errors->has('deskripsi_kelas') ? 'is-invalid' : '' }} d-none" rows="3" placeholder="Masukkan Nama kelas"></textarea>
                        <div id="editor"></div> 
                        @if($errors->has('deskripsi_kelas'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('deskripsi_kelas')) }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>Kategori <span class="text-danger">*</span></label>
                        <select name="kategori_kelas" class="form-control {{ $errors->has('kategori_kelas') ? 'is-invalid' : '' }}">
                          <option value="" disabled selected>--Pilih--</option>
                          @foreach($kategori as $data)
                          <option value="{{ $data->id_kategori }}">{{ $data->nama_kategori }}</option>
                          @endforeach
                        </select>
                        @if($errors->has('kategori_kelas'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('kategori_kelas')) }}</div>
                        @endif
                    </div>
                    @if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager())
                    <div class="form-group col-md-6">
                        <label>Pengajar <span class="text-danger">*</span></label>
                        <select name="pengajar_kelas" class="form-control {{ $errors->has('pengajar_kelas') ? 'is-invalid' : '' }}">
                          <option value="" disabled selected>--Pilih--</option>
                          @foreach($pengajar as $data)
                          <option value="{{ $data->id_user }}">{{ $data->nama_user }}</option>
                          @endforeach
                        </select>
                        @if($errors->has('pengajar_kelas'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('pengajar_kelas')) }}</div>
                        @endif
                    </div>
                    @endif
                    <div class="form-group col-md-6">
                        <label>Level <span class="text-danger">*</span></label>
                        <select name="level_kelas" class="form-control {{ $errors->has('level_kelas') ? 'is-invalid' : '' }}">
                          <option value="" disabled selected>--Pilih--</option>
                          @foreach($level as $data)
                          <option value="{{ $data->id_level }}">{{ $data->nama_level }}</option>
                          @endforeach
                        </select>
                        @if($errors->has('level_kelas'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('level_kelas')) }}</div>
                        @endif
                    </div>
                    <!-- <div class="form-group col-md-6">
                        <label>Harga <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text {{ $errors->has('harga_kelas') ? 'border-danger' : '' }}">Rp.</span>
                            </div>
                            <input type="text" name="harga_kelas" class="form-control number-only thousand-format {{ $errors->has('harga_kelas') ? 'is-invalid' : '' }}" placeholder="Masukkan Harga">
                        </div>
                        @if($errors->has('harga_kelas'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('harga_kelas')) }}</div>
                        @endif
                    </div> -->
                    <div class="form-group col-md-12">
                      <label>Gambar</label>
                      <br>
                      <input type="file" id="file" class="d-none" accept="image/*">
                      <a class="btn btn-sm btn-secondary btn-file" href="#"><i class="fa fa-folder-open mr-2"></i>Pilih Gambar...</a>
                      <br>
                      <img id="img-file" class="mt-2 img-thumbnail d-none" style="max-height: 150px">
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

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
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

    // Input Hanya Nomor
    $(document).on("keypress", ".number-only", function(e){
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode >= 48 && charCode <= 57) { 
            // 0-9 only
            return true;
        }
        else{
            return false;
        }
    });

    // Input Format Ribuan
    $(document).on("keyup", ".thousand-format", function(){
        var value = $(this).val();
        $(this).val(formatRibuan(value, ""));
    });

    // Function Format Ribuan
    function formatRibuan(angka, prefix){
        var number_string = angka.replace(/\D/g,'');
        number_string = (number_string.length > 1) ? number_string.replace(/^(0+)/g, '') : number_string;
        var split = number_string.split(',');
        var sisa = split[0].length % 3;
        var rupiah = split[0].substr(0, sisa);
        var ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
    
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }
		
		// Quill Editor
		var toolbarOptions = [
			[{ 'header': [1, 2, 3, 4, 5, 6, false] }],
			['bold', 'italic', 'underline', 'strike'],
			[{ 'script': 'sub'}, { 'script': 'super' }],
			['link', 'image', 'video'],
			[{ 'list': 'ordered'}, { 'list': 'bullet' }],
			[{ 'align': [] }],
			[{ 'indent': '-1'}, { 'indent': '+1' }],
			[{ 'direction': 'rtl' }],
			[{ 'color': [] }, { 'background': [] }],
			['clean']     
		];

		var quill = new Quill('#editor', {
			modules: {
				toolbar: toolbarOptions
			},
			placeholder: 'Tulis sesuatu...',
			theme: 'snow',
			imageResize: {
				displayStyles: {
					backgroundColor: 'black',
					border: 'none',
					color: 'white'
				},
				modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
			}
		});
	
    // Submit Form
    $(document).on("submit", "#form", function(e){
      e.preventDefault();
      var myEditor = document.querySelector('#editor');
      var html = myEditor.children[0].innerHTML;
      $("textarea[name=deskripsi_kelas]").text(html);
      $("#form")[0].submit();
    });
</script>

@endsection

@section('css-extra')

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/croppie/croppie.css') }}">
<style type="text/css">
  #editor {height: 300px;}
	.ql-editor h1, .ql-editor h2, .ql-editor h3, .ql-editor h4, .ql-editor h5, .ql-editor h6, .ql-editor p {margin-bottom: 1rem!important;}
</style>

@endsection