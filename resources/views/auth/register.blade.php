<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/style.css') }}">
        <link rel="shortcut icon" href="{{ asset('/assets/images/logo/'.get_icon()) }}">
        <title>Daftar | {{ get_website_name() }}</title>
    </head>
    <body class="bg-light">
    <section class="container my-5">
        <div class="row">
            <div class="col-12 col-lg-6 vh-100 d-none d-lg-block">
                <div class="wrapper text-center">
                    <img class="w-75" src="{{asset(('assets/images/ilustrasi/undraw_Login_re_4vu2 .svg'))}}">
                </div>
            </div>
            <div class="col-12 col-lg-6 vh-100 vh-md-0">
                <div class="register wrapper">
                    <div class="card border-0 shadow-sm rounded-2">
                        <div class="card-header mx-3 bg-transparent text-center">
                            <h5 class="m-0 h2 color-theme-1">Daftar</h5>
                        </div>
                            <div class="card-body">
                                <form class="login-form" action="/register" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="control-label">Nama Lengkap</label>
                                        <input class="form-control {{ $errors->has('nama_lengkap') ? 'is-invalid' : '' }}" name="nama_lengkap" type="text" placeholder="Masukkan Nama Lengkap" autofocus>
                                        @if($errors->has('nama_lengkap'))
                                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('nama_lengkap')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">EmailL</label>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" type="email" placeholder="Masukkan Email">
                                        @if($errors->has('email'))
                                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('email')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor HP</label>
                                        <input class="form-control {{ $errors->has('nomor_hp') ? 'is-invalid' : '' }} number-only" name="nomor_hp" type="text" placeholder="Masukkan Nomor HP">
                                        @if($errors->has('nomor_hp'))
                                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('nomor_hp')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nama Pengguna</label>
                                        <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" type="text" placeholder="Masukkan Username">
                                        @if($errors->has('username'))
                                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('username')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                						<div class="input-group">
                							<input type="password" name="password" class="form-control {{ $errors->has('password') ? 'border-danger' : '' }}" placeholder="Masukkan Password">
                							<div class="input-group-append">
                								<a href="#" class="btn btn-toggle-password border-0 btn-theme-1 {{ $errors->has('password') ? 'bg-danger' : '' }}"><i class="fa fa-eye"></i></a>
                							</div>
                						</div>
                                        @if($errors->has('password'))
                                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('password')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Konfirmasi Password</label>
                						<div class="input-group">
                							<input type="password" name="password_confirmation" class="form-control {{ $errors->has('password') ? 'border-danger' : '' }}" placeholder="Konfirmasi Password">
                							<div class="input-group-append">
                								<a href="#" class="btn btn-toggle-password border-0 btn-theme-1 {{ $errors->has('password') ? 'bg-danger' : '' }}"><i class="fa fa-eye"></i></a>
                							</div>
                						</div>
                                        @if($errors->has('password'))
                                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('password')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group btn-container">
                                        <button type="submit" class="btn btn-theme-2 btn-block rounded-3">Daftar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
    <style type="text/css">
        .wrapper{ width: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
</html>