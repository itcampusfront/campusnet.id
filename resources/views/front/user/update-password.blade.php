@extends('template/front/main')

@section('title', 'Ganti Password')

@section('content')

<div class="row">
    <div class="container mb-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="/profil">Profil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ganti Password</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <section class="row">
            <div class="col-lg-3 col-md-4 mb-3">
                @include('front/user/_sidebar-profile')
            </div>
            <div class="col-lg-9 col-md-8 mb-3">
                <div class="card">
                    <div class="card-header">Ganti Password</div>
                    <div class="card-body">
                        @if(Session::get('message') != null)
                        <div class="alert alert-dismissible {{ Session::get('status') == 1 ? 'alert-success' : 'alert-danger' }}">
                            <button class="close" type="button" data-dismiss="alert">×</button>{{ Session::get('message') }}
                        </div>
                        @endif
                        <form method="post" action="/profil/update-password">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password Lama</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="password" name="old_password" class="form-control {{ $errors->has('old_password') ? 'border-danger' : '' }}" value="{{ old('old_password') }}">
                                        <div class="input-group-append">
                                            <a href="#" class="btn btn-outline-secondary btn-toggle-password {{ $errors->has('old_password') ? 'border-danger' : '' }}"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                    @if($errors->has('old_password'))
                                    <div class="small text-danger">{{ ucfirst($errors->first('old_password')) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password Baru</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="password" name="new_password" class="form-control {{ $errors->has('new_password') ? 'border-danger' : '' }}" value="{{ old('new_password') }}">
                                        <div class="input-group-append">
                                            <a href="#" class="btn btn-outline-secondary btn-toggle-password {{ $errors->has('new_password') ? 'border-danger' : '' }}"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                    @if($errors->has('new_password'))
                                    <div class="small text-danger">{{ ucfirst($errors->first('new_password')) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="password" name="confirm_password" class="form-control {{ $errors->has('confirm_password') ? 'border-danger' : '' }}" value="{{ old('confirm_password') }}">
                                        <div class="input-group-append">
                                            <a href="#" class="btn btn-outline-secondary btn-toggle-password {{ $errors->has('confirm_password') ? 'border-danger' : '' }}"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                    @if($errors->has('confirm_password'))
                                    <div class="small text-danger">{{ ucfirst($errors->first('confirm_password')) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
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
</script>

@endsection

@section('css-extra')

@endsection