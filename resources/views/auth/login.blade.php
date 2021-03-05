<!DOCTYPE html>
<html>
    <head>
        @include('template/front/_head')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/style.css') }}">
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
                                        <label class="control-label">USERNAME</label>
                                        <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" type="text" placeholder="Username" autofocus>
                                        @if($errors->has('username'))
                                        <div class="form-control-feedback text-danger">{{ ucfirst($errors->first('username')) }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">PASSWORD</label>
                						<div class="input-group">
                							<input type="password" name="password" class="form-control {{ $errors->has('password') ? 'border-danger' : '' }}">
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
    @include('template/admin/_js')
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