<!DOCTYPE html>
<html lang="en">
<head>
    @include('template/member/_head')
    <title>Login | {{ get_website_name() }}</title>
</head>
<body class="bg-light">
<section class="container">
    <div class="row">
        <div class="col-12 col-lg-6 vh-100 d-none d-lg-block">
            <div class="wrapper text-center">
                <img class="w-75" src="{{asset(('assets/images/ilustrasi/undraw_Login_re_4vu2 .svg'))}}">
            </div>
        </div>
        <div class="col-12 col-lg-6 vh-100">
            <div class="wrapper">
                <div class="card border-0 shadow-sm rounded-2">
                    <div class="card-header mx-3 bg-transparent text-center">
                        <h5 class="m-0 h2 color-theme-1">Masuk</h5>
                    </div>
                        <div class="card-body">
                            <form class="login-form" action="/login" method="post">
                                {{ csrf_field() }}
                                @if(isset($message))
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @endif
                                <div class="form-group">
                                    <label class="control-label">Email / Nama Pengguna</label>
                                    <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" type="text" placeholder="Email / Username" autofocus>
                                    @if($errors->has('username'))
                                    <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('username')) }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password</label>
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
                                <button type="submit" class="btn btn-theme-2 btn-block rounded-3">Masuk</button>
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
</script>
</html>