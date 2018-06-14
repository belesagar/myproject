<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="{{asset('admin/login/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('admin/login/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('admin/login/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css')}} -->
    <link href="{{asset('admin/login/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('admin/login/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
    <div>
	
	@yield('content')
	
	</div>

   <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

   <script src="{{asset('admin/js/loder.js')}}" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>



   <script src="{{asset('admin/js/validation_form.js')}}" type="text/javascript"></script>


   @yield('script')


  </body>
</html>