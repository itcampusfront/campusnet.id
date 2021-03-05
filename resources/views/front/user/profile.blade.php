@extends('template/front/main')

@section('title', 'Profil')

@section('content')

<div class="row">
    <div class="container mb-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profil</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->
        <section class="row">
            <div class="col-lg-3 col-md-4 mb-3">
                @include('front/user/_sidebar-profile')
            </div>
            <div class="col-lg-9 col-md-8 mb-3">
                <div class="card">
                    <div class="card-header">Profil</div>
                    <div class="card-body">
                        @if(Session::get('message') != null)
                        <div class="alert alert-dismissible alert-success">
                            <button class="close" type="button" data-dismiss="alert">×</button>{{ Session::get('message') }}
                        </div>
                        @endif
                        <form method="post" action="/profil/update-profil">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_user" class="form-control {{ $errors->has('nama_user') ? 'border-danger' : '' }}" value="{{ $user->nama_user }}">
                                    @if($errors->has('nama_user'))
                                    <div class="small text-danger">{{ ucfirst($errors->first('nama_user')) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" name="tanggal_lahir" class="form-control {{ $errors->has('tanggal_lahir') ? 'border-danger' : '' }}" value="{{ date('d/m/Y', strtotime($user->tanggal_lahir)) }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text {{ $errors->has('tanggal_lahir') ? 'border-danger' : '' }}"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    @if($errors->has('tanggal_lahir'))
                                    <div class="small text-danger">{{ ucfirst($errors->first('tanggal_lahir')) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis-kelamin-1" value="L" {{ $user->jenis_kelamin == 'L' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jenis-kelamin-1">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis-kelamin-2" value="P" {{ $user->jenis_kelamin == 'P' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jenis-kelamin-2">
                                            Perempuan
                                        </label>
                                    </div>
                                    @if($errors->has('jenis_kelamin'))
                                    <div class="small text-danger">{{ ucfirst($errors->first('jenis_kelamin')) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'border-danger' : '' }}" value="{{ $user->email }}" disabled>
                                    @if($errors->has('email'))
                                    <div class="small text-danger">{{ ucfirst($errors->first('email')) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'border-danger' : '' }}" value="{{ $user->username }}" disabled>
                                    @if($errors->has('username'))
                                    <div class="small text-danger">{{ ucfirst($errors->first('username')) }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor HP</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nomor_hp" class="form-control {{ $errors->has('nomor_hp') ? 'border-danger' : '' }}" value="{{ $user->nomor_hp }}">
                                    @if($errors->has('nomor_hp'))
                                    <div class="small text-danger">{{ ucfirst($errors->first('nomor_hp')) }}</div>
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

@include('front/user/_modal-croppie')

@endsection

@section('js-extra')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script type="text/javascript">
    // Input Tanggal Lahir
    $("input[name=tanggal_lahir]").datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true
    });
</script>
@include('front/user/_js-croppie')

@endsection

@section('css-extra')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
@include('front/user/_css-croppie')

@endsection