@extends('template/admin/main')

@section('title', 'Detail Pengguna')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-3 px-4">
        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="/admin/user">User</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Pengguna</li>
    </ol>
</nav>
<div class="content">
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-theme-1 rounded-3 shadow border-0 d-flex justify-content-between align-items-center">
            <h5 class="my-2">Detail Pengguna</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-auto">
                  <img class="mb-2 rounded-2" width="150" src="{{ $user->foto != '' ? asset('assets/images/user/'.$user->foto) : asset('assets/images/default/user.jpg') }}">
                </div>
                <div class="col-lg-9">
                  <p>Nama : {{ $user->nama_user }}</p>
                  <p>Nomor HP : {{ $user->nomor_hp }}</p>
                  <p>Username : {{ $user->username }}</p>
                  <p>Email : {{ $user->email }}</p>
                </div>
            </div>
            <hr>
            <div class="d-block d-md-flex justify-content-between">
              <p>Bergabung Pada : {{ $user->register_at }}</p>
              <p>Terahir Masuk : {{ $user->last_visit }}</p>
            </div>
        </div>
    </div>
    <div class="website-list">
        <div class="Heading">
            <h5>Website</h5>
        </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm rounded-2 mb-3">
              <div class="card-header bg-transparent mx-3 px-0 ">
                <a href="#">Lorem Ipsum</a>
              </div>
              <div class="card-body text-center">
                <a href="#" class="btn btn-theme-1 rounded-3 px-3" target="_blank">Lihat</a>
                <a href="#" class="btn btn-theme-2 rounded-3 px-3">Kelola</a>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
  
@endsection

@section('js-extra')

<script>
    // Button toggle password
    $(document).on("click", ".btn-toggle-password", function(e){
        e.preventDefault();
        if(!$(this).hasClass("show")){
            $(this).parents(".input-group").find("input").attr("type","text");
            $(this).find(".fa").removeClass("fa-eye").addClass("fa-eye-slash");
            $(this).addClass("show");
        }
        else{
            $(this).parents(".input-group").find("input").attr("type","password");
            $(this).find(".fa").removeClass("fa-eye-slash").addClass("fa-eye");
            $(this).removeClass("show");
        }
    });

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
</script>

@endsection