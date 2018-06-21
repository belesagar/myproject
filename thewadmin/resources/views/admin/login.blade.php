<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			Kissht - Thew
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf" value="{{ csrf_token() }}">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
    WebFont.load({
    google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
    active: function() {
      sessionStorage.fonts = true;
    }
    });
		</script>
		<!--end::Web font -->
    
		<!--begin::Base Styles -->  
		<link href="{{asset('public/admin/css/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('public/admin/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('public/admin/css/my-style.css')}}" rel="stylesheet" type="text/css" />
		
		
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="{{asset('public/admin/images/favicon.ico')}}" />
		
	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-1" id="m_login" style="background-image: url({{asset('public/admin/images/bg/bg-1.jpg')}});">
				<div class="m-grid__item m-grid__item--fluid m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img src="{{asset('public/admin/images/kisst-logo-img.png')}}">
							</a>
						</div>
						

						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">
									Sign In To Admin
								</h3>
							</div>
							{!! \Helpers::show_message() !!}


							{{ Form::open(array('class' => 'm-login__form m-form','route' => 'getlogindata')) }} 
							<!--<form class="m-login__form m-form" action="">-->
								<div class="form-group m-form__group">
									<!--<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">-->
									{{ Form::text('email',null,array('class' => 'form-control m-input','placeholder' => 'Email','autocomplete' => 'off')) }}
									<span class="text-danger"> {!! $errors->login->first('email') !!} </span>
								</div>
								<div class="form-group m-form__group">
									<!--<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">-->
									{{ Form::password('password',array('class' => 'form-control m-input m-login__form-input--last','placeholder' => 'Password')) }}
									<span class="text-danger"> {!! $errors->login->first('password') !!} </span>
								</div>
								<div class="row m-login__form-sub">
									<div class="col m--align-left m-login__form-left">
										<label class="m-checkbox  m-checkbox--light">
											<input type="checkbox" name="remember">
											Remember me
											<span> </span>
										</label>
									</div>
									<div class="col m--align-right m-login__form-right">
										<a href="javascript:;" id="m_login_forget_password" class="m-link">
											Forget Password ?
										</a>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
										Sign In
									</button>  
								</div>
							<!--</form>-->
							{{ Form::close() }}
						</div>
						<div class="m-login__signup">
							<div class="m-login__head">
								<h3 class="m-login__title">
									Sign Up
								</h3>
								<div class="m-login__desc">
									Enter your details to create your account:
								</div>
							</div>
							
							{!! \Helpers::show_message() !!}

							{{ Form::open(array('class' => 'm-login__form m-form','route' => 'getsignupdata')) }}
							<!--<form class="m-login__form m-form" action="">-->
								<div class="form-group m-form__group">
									<!--<input class="form-control m-input" type="text" placeholder="Full Name" name="fullname">-->
									{{ Form::text('first_name',null,array('class' => 'form-control m-input','id' => 'id_first_name','placeholder' => 'First Name','autocomplete' => 'off')) }}
									<span class="text-danger"> {!! $errors->login->first('first_name') !!} </span>
								</div>
								<div class="form-group m-form__group">
									<!--<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">-->
									{{ Form::text('last_name',null,array('class' => 'form-control m-input','id' => 'id_last_name','placeholder' => 'Last Name','autocomplete' => 'off')) }}
									<span class="text-danger"> {!! $errors->login->first('last_name') !!} </span>
								</div>
								<div class="form-group m-form__group">
									<!--<input class="form-control m-input" type="password" placeholder="Password" name="password">-->
									{{ Form::email('email',null,array('class' => 'form-control m-input m-login__form-input--last','id' => 'id_email','placeholder' => 'Email')) }}
									<span class="text-danger"> {!! $errors->login->first('email') !!} </span>
								</div>
								<div class="form-group m-form__group">
									<!--<input class="form-control m-input" type="password" placeholder="Password" name="password">-->
									{{ Form::password('password',array('class' => 'form-control m-input m-login__form-input--last','id' => 'id_password','placeholder' => 'Password')) }}
									<span class="text-danger"> {!! $errors->login->first('password') !!} </span>
								</div>
								<div class="form-group m-form__group">
									<!--<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">-->
									{{ Form::password('cpassword',array('class' => 'form-control m-input m-login__form-input--last','placeholder' => 'Confirm Password')) }}
									<span class="text-danger"> {!! $errors->login->first('cpassword') !!} </span>
								</div>
								<div class="form-group m-form__group">
									<!--<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">-->
									{{ Form::number('mobile',null,array('class' => 'form-control m-input m-login__form-input--last','id' => 'id_mobile','placeholder' => 'Mobile Number','oninput' => 'if(value.length>10)value=value.slice(0,10)')) }}
									<span class="text-danger"> {!! $errors->login->first('mobile') !!} </span>
									
								
									<button type="button" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary sendotpbtn" onclick="mobile_send_otp();">
										Send OTP
									</button>
									<div class="otpsendsuccess" id="otpsendsuccess" style=" color: white;"></div>
                    				<div class="otpsendfail" id="otpsendfail" style="color: red;"></div>
								</div>
								<div class="form-group m-form__group">
									<!--<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">-->
									{{ Form::number('otp',null,array('class' => 'form-control m-input m-login__form-input--last','id' => 'otp','placeholder' => 'OTP','oninput' => 'if(value.length>6)value=value.slice(0,6)')) }}
									<span class="text-danger"> {!! $errors->login->first('mobile') !!} </span>
								</div>
								<div class="row form-group m-form__group m-login__form-sub">
									<div class="col m--align-left">
										<label class="m-checkbox m-checkbox--light">
											<!--<input type="checkbox" name="agree">-->
											{{ Form::checkbox('agree','agree',null,array('id' => 'id_agree')) }}
											I Agree the
											<a href="#" class="m-link m-link--focus">
												terms and conditions
											</a>
											.
											<span></span>

										</label>
										<span class="m-form__help"></span>
										<span class="text-danger"> {!! $errors->login->first('agree') !!} </span>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signup_submit" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
										Sign Up
									</button>									
								</div>
								<div class="m-login__form-action">
									<span class="m-login__account-msg">
										Do you have an account yet ?
									</span>
									&nbsp;&nbsp;
									<a href="javascript:;" id="m_login_signup_cancel" class="m-link m-link--light m-login__account-link">
										Sign In
									</a>
								</div>
							<!--</form>-->
							{{ Form::close() }}
						</div>
						<div class="m-login__forget-password">
							<div class="m-login__head">
								<h3 class="m-login__title">
									Forgotten Password ?
								</h3>
								<div class="m-login__desc">
									Enter your email to reset your password:
								</div>
							</div>
							
							{!! \Helpers::show_message() !!}

							{{ Form::open(array('class' => 'm-login__form m-form','route' => 'getforgotpassworddata')) }}
							<!--<form class="m-login__form m-form" action="">-->
								<div class="form-group m-form__group">
									<!--<input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">-->
									{{ Form::email('email',null,array('class' => 'form-control m-input m-login__form-input--last','id' => 'id_forgot_email','placeholder' => 'Email')) }}
									<span class="text-danger"> {!! $errors->login->first('email') !!} </span>
								</div>
								<!--  -->
								<div class="m-login__form-action">
									<button id="m_login_forget_password_submit" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
										Request
									</button>
									&nbsp;&nbsp;
									<button type="button" id="m_login_forget_password_cancel" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">
										Cancel
									</button>
								</div>
							<!--</form>-->
							{{ Form::close() }}
						</div>						
						<!-- <div class="m-login__account">
							<span class="m-login__account-msg">
								Don't have an account yet ?
							</span>
							&nbsp;&nbsp;
							<a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">
								Sign Up
							</a>
						</div> -->
						<!-- Reset password -->
						
					</div>
				</div>
			</div>
		</div>
		<!-- end:: Page -->
		<!--begin::Base Scripts -->
		<!-- <script src="js/vendors.bundle.js" type="text/javascript"></script> -->
		
		<script src="{{asset('public/admin/js/vendors.bundle.js')}}" type="text/javascript"></script>
		<script src="{{asset('public/admin/js/scripts.bundle.js')}}" type="text/javascript"></script> 
		
		
		<script>
			
                  
		</script>
		
		<!--end::Base Scripts -->
		<!--begin::Page Snippets -->
		<script src="{{asset('public/admin/js/login.js')}}" type="text/javascript"></script>
		<!--end::Page Snippets -->
	</body>
	<!-- end::Body -->
</html>
