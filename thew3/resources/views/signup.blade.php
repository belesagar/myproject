@extends('admin.layouts.login_template')
@section('title', 'Login')

@section('content')
	  <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
			
          <section class="login_content">
			<div>
                <h2><i class="fa fa-paw"></i> <a href="#!login">Gentelella Alela!</a></h2>
                  
            </div>
            <form>
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" /> 
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Log in</a>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New User?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <!--<div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>-->
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
			<div>
                <h2><i class="fa fa-paw"></i> Gentelella Alela!</h2>
                  
            </div>
            {{ Form::open(array('id' => 'id_sign_up_form','route' => 'checksignup')) }}
            <!-- <form name="sign_up_form" id="id_sign_up_form" method="post"> -->
              <h1>Create Account</h1>
              
              <div>
                <input type="text" name="name" class="form-control" placeholder="Name" required="" />
              </div>
			         <!-- <div>
                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
              </div> -->
			         <div>
                <input type="number" name="mobile" class="form-control" placeholder="Mobile No." required="" />
              </div>
              <!-- <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
			  <div>
                <input type="password" class="form-control" placeholder="Confirm Password" required="" />
              </div> -->
			  
              <div>
                <button type="submit" class="btn btn-default submit">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <!--<div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>-->
              </div>
            <!-- </form> -->
            {{ Form::close() }}
          </section>
        </div>
      </div>
@endsection

@section('script')
  
  <script type="text/javascript">
    
    function checksignup()
    {
       $.ajax({
        url: "checksignup", 
        method: "post", 
        data: $("#id_sign_up_form").serialize(),
        success: function(result){
          console.log(result);
       }});
    }

  </script>

@endsection