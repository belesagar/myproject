<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			Kissht - Franchise
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
						<div class="m-login__reset-password">
							<div class="m-login__head"> 
								<h3 class="m-login__title">
									Reset Your Password
								</h3>
								<!--<div class="m-login__desc">
									Enter your email to reset your password:
								</div>-->
							</div>
							
							{!! \Helpers::show_message() !!}

							{{ Form::open(array('class' => 'm-login__form m-form','route' => 'getresetpassworddata')) }}
							<!--<form class="m-login__form m-form" action="">-->
								<div class="form-group m-form__group">
									<!--<input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">-->
									{{ Form::password('password',array('class' => 'form-control m-input m-login__form-input--last','id' => 'id_reset_password','placeholder' => 'Password')) }}
									<span class="text-danger"> {!! $errors->login->first('password') !!} </span>
								</div>
								<div class="form-group m-form__group">
									<!--<input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">-->
									{{ Form::password('cpassword',array('class' => 'form-control m-input m-login__form-input--last','placeholder' => 'Confirm Password')) }}
									<span class="text-danger"> {!! $errors->login->first('cpassword') !!} </span>
								</div>
								<input type="hidden" name="id" value = "{{ (isset($reset_code) ? $reset_code : '' ) }}">
								<div class="m-login__form-action">
									<button id="m_login_reset_password_submit" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
										Reset
									</button>
									&nbsp;&nbsp;
									<a href="{{url('login')}}" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">
										Cancel 
									</a>
								</div>
							<!--</form>-->
							{{ Form::close() }}
						</div>
						<div class="m-login__account">
							<span class="m-login__account-msg">
								Don't have an account yet ?
							</span>
							&nbsp;&nbsp;
							<a href="{{url('login#signup')}}" class="m-link m-link--light m-login__account-link">
								Sign Up
							</a>
						</div>
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
