@extends('template/member/main')

@section('title', 'Profil')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/member"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Profil</li>
    </ol>
</nav>
<div class="content">
    <div class="bg-white rounded-3 shadow-sm py-3 px-4 mb-4">
        <h5>Profil</h5>
        @if(Session::get('message'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <form method="post" action="/member/update-profil">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $user->id_user }}">
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <div class="col-md-10">
                    <input type="text" name="nama_user" class="form-control {{ $errors->has('nama_user') ? 'border-danger' : '' }}" value="{{ $user->nama_user }}" placeholder="Masukkan Nama User">
                    @if($errors->has('nama_user'))
                    <div class="small text-danger">{{ ucfirst($errors->first('nama_user')) }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Email <span class="text-danger">*</span></label>
                <div class="col-md-10">
                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'border-danger' : '' }}" value="{{ $user->email }}" placeholder="Masukkan Email" readonly>
                    @if($errors->has('email'))
                    <div class="small text-danger">{{ ucfirst($errors->first('email')) }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Username <span class="text-danger">*</span></label>
                <div class="col-md-10">
                    <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'border-danger' : '' }}" value="{{ $user->username }}" placeholder="Masukkan Username" readonly>
                    @if($errors->has('username'))
                    <div class="small text-danger">{{ ucfirst($errors->first('username')) }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Nomor HP <span class="text-danger">*</span></label>
                <div class="col-md-10">
                    <input type="text" name="nomor_hp" class="form-control number-only {{ $errors->has('nomor_hp') ? 'border-danger' : '' }}" value="{{ $user->nomor_hp }}" placeholder="Masukkan Nomor HP">
                    @if($errors->has('nomor_hp'))
                    <div class="small text-danger">{{ ucfirst($errors->first('nomor_hp')) }}</div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label"></label>
                <div class="col-md-10">
                    <button type="submit" class="btn btn-theme-1">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
  
@endsection

@section('js-extra')

<script>
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