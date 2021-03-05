<!DOCTYPE html>
<html>
    <head>
        @include('template/admin/_head')
        @include('template/admin/_css')
        <title>Login | {{ get_website_name() }}</title>
    </head>
    <body>
        <section class="material-half-bg">
            <div class="cover"></div>
        </section>
        <section class="login-content">
            <div class="logo">
                <img src="{{ asset('assets/images/logo/'.get_logo()) }}" height="150">
            </div>
            <div class="login-box">
                <form class="login-form" action="/login" method="post">
                    {{ csrf_field() }}
                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>LOGIN</h3>
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
								<a href="#" class="btn btn-toggle-password {{ $errors->has('password') ? 'border-danger' : 'btn-outline-secondary' }}"><i class="fa fa-eye"></i></a>
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
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw mr-2"></i>SIGN IN</button>
                    </div>
                </form>
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