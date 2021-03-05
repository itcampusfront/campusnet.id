@extends('template/admin/main')

@section('title', 'Edit User')

@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-users"></i> Edit User</h1>
      <p>Menu untuk mengedit data user</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="/admin/user">User</a></li>
      <li class="breadcrumb-item">Edit User</li>
    </ul>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="tile">
        <form method="post" action="/admin/user/update">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $user->id_user }}">
            <div class="tile-title-w-btn">
                <h3 class="title">Edit User</h3>
                <p><button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-save mr-2"></i>Simpan</button></p>
            </div>
            <div class="tile-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama_user" class="form-control {{ $errors->has('nama_user') ? 'is-invalid' : '' }}" value="{{ $user->nama_user }}" placeholder="Masukkan Nama">
                        @if($errors->has('nama_user'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('nama_user')) }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="text" name="tanggal_lahir" class="form-control {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}" value="{{ generate_date_format($user->tanggal_lahir, '/') }}" placeholder="Masukkan Tanggal Lahir (Format: dd/mm/yyyy)">
                        @if($errors->has('tanggal_lahir'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('tanggal_lahir')) }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>Jenis Kelamin <span class="text-danger">*</span></label>
                        <br>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="jenis_kelamin" id="gender-1" value="L" {{ $user->jenis_kelamin == 'L' ? 'checked' : '' }}>
                          <label class="form-check-label" for="gender-1">
                            Laki-Laki
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="jenis_kelamin" id="gender-2" value="P" {{ $user->jenis_kelamin == 'P' ? 'checked' : '' }}>
                          <label class="form-check-label" for="gender-2">
                            Perempuan
                          </label>
                        </div>
                        @if($errors->has('jenis_kelamin'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('jenis_kelamin')) }}</div>
                        @endif
                    </div>
                    <div class="separator"></div>
                    <div class="form-group col-md-6">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ $user->email }}" placeholder="Masukkan Email">
                        @if($errors->has('email'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('email')) }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>Nomor HP <span class="text-danger">*</span></label>
                        <input type="text" name="nomor_hp" class="form-control number-only {{ $errors->has('nomor_hp') ? 'is-invalid' : '' }}" value="{{ $user->nomor_hp }}" placeholder="Masukkan Nomor HP">
                        @if($errors->has('nomor_hp'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('nomor_hp')) }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ $user->username }}" placeholder="Masukkan Username">
                        @if($errors->has('username'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('username')) }}</div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Masukkan Password">
                            <div class="input-group-append">
                              <a href="#" class="btn btn-toggle-password input-group-text {{ $errors->has('password') ? 'border-danger' : '' }}"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                        <small class="text-muted">Kosongi saja jika tidak ingin mengganti password.</small>
                        @if($errors->has('password'))
                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('password')) }}</div>
                        @endif
                    </div>
                    <div class="separator"></div>
                    <div class="form-group col-md-12">
                        <label>Foto</label>
                        <br>
                        <input type="file" id="file" class="d-none" accept="image/*">
                        <a class="btn btn-sm btn-secondary btn-file" href="#"><i class="fa fa-folder-open mr-2"></i>Pilih Foto...</a>
                        <br>
                        <img id="img-file" src="{{ $user->foto != '' ? asset('assets/images/user/'.$user->foto) : '' }}" class="mt-2 img-thumbnail {{ $user->foto != '' ? '' : 'd-none' }}" style="max-height: 150px">
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

<script type="text/javascript" src="{{ asset('templates/vali-admin/js/plugins/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/croppie/croppie.min.js') }}"></script>
<script type="text/javascript">
  // Input Tanggal Lahir
  $("input[name=tanggal_lahir]").datepicker({
      format: "dd/mm/yyyy",
      autoclose: true,
      todayHighlight: true
  });
  
  /* Croppie */
  var demo = $('#demo').croppie({
      viewport: {width: 400, height: 400},
      boundary: {width: 400, height: 400}
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
        format: "png",
        size: {width: 400, height: 400}
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
  
  // Button Toggle Password
  $(document).on("click", ".btn-toggle-password", function(e){
      e.preventDefault();
      if($(this).find("i").hasClass("fa-eye")){
          $(this).find("i").removeClass("fa-eye").addClass("fa-eye-slash");
          $("input[name=password]").attr("type","text");
      }
      else{
          $(this).find("i").addClass("fa-eye").removeClass("fa-eye-slash");
          $("input[name=password]").attr("type","password");
      }
  });
</script>

@endsection

@section('css-extra')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/croppie/croppie.css') }}">

@endsection