<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/style.css') }}">
        <link rel="shortcut icon" href="{{ asset('/assets/images/logo/'.get_icon()) }}">
        <title>Login | {{ get_website_name() }}</title>
    </head>
    <body class="bg-light">
        <section class="my-5 py-5">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="row">
                    <div class="col-6 text-center">
                        <img class="img-fluid px-5" src="{{asset(('assets/images/ilustrasi/undraw_Online_learning_re_qw08.svg'))}}">
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-header text-center bg-theme-1 rounded-3 border-0 shadow">
                                <h1 class="m-0">Masuk</h1>
                            </div>
                            <div class="card-body p-5">
                                <form class="login-form" action="/login" method="post">
                                    {{ csrf_field() }}
                                    @if(isset($message))
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="control-label">EMAIL ATAU USERNAME</label>
                                        <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" type="text" placeholder="Email / Username" autofocus>
                                        @if($errors->has('username'))
                                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('username')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">PASSWORD</label>
                						<div class="input-group">
                							<input type="password" name="password" class="form-control {{ $errors->has('password') ? 'border-danger' : '' }}" placeholder="Password">
                							<div class="input-group-append">
                								<a href="#" class="btn btn-toggle-password border-0 btn-theme-1 {{ $errors->has('password') ? 'border-danger' : 'btn-outline-secondary' }}"><i class="fa fa-eye"></i></a>
                							</div>
                						</div>
                                        @if($errors->has('password'))
                                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('password')) }}</div>
                                        @endif
                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="utility">
                                            <div class="animated-checkbox">
                                                <label>
                                                    <input type="checkbox"><span class="label-text">Stay Signed in</span>
                                                </label>
                                            </div>
                                            <p class="semibold-text mb-2"><a href="#">Forgot Password ?</a></p>
                                        </div>
                                    </div> -->
                                    <div class="form-group text-center">
                                        Belum punya akun? <a href="/register">Daftar disini</a>
                                    </div>
                                    <div class="form-group btn-container">
                                        <button type="submit" class="btn btn-theme-2 btn-block rounded-3"><i class="fa fa-sign-in fa-lg fa-fw mr-2"></i>SIGN IN</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
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
	</script>
</html>