//== Class Definition

//This code for hiding alert message


var SnippetLogin = function() {
    var login = $('#m_login');
    var url_link = window.location.href;
    var hash_value = window.location.href.split('#')[1];
   
    var showErrorMsg = function(form, type, msg) {
        var alert = $('<div class="m-alert m-alert--outline alert alert-' + type + ' alert-dismissible" role="alert">\
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
			<span></span>\
		</div>');

        form.find('.alert').remove();
        alert.prependTo(form);
        alert.animateClass('fadeIn animated');
        alert.find('span').html(msg);
    }

    var displaySignUpForm = function() {		
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signin');
        login.removeClass('m-login--reset-password');

        login.addClass('m-login--signup');
        login.find('.m-login__signup').animateClass('flipInX animated');
    }

    var displaySignInForm = function() {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signup');
        login.removeClass('m-login--reset-password');
        login.addClass('m-login--signin');
        login.find('.m-login__signin').animateClass('flipInX animated');
    }

    var displayForgetPasswordForm = function() {
        login.removeClass('m-login--signin');
        login.removeClass('m-login--signup');
        login.removeClass('m-login--reset-password');
		
        login.addClass('m-login--forget-password');
        login.find('.m-login__forget-password').animateClass('flipInX animated');
		
    }
	
	// var displayResetPasswordForm = function() {		
	// 	$('.m-login__signin').hide();
 //        login.removeClass('m-login--signup');
	// 	login.removeClass('m-login--signin');
 //        login.removeClass('m-login--forget-password');
		
 //        login.addClass('m-login--reset-password');
 //        login.find('.m-login__reset-password').animateClass('flipInX animated');
 //    }

	
    /* var displayResetPasswordForm = function() {		
		        
        login.removeClass('m-login--signup');
		login.removeClass('m-login--signin');
        login.removeClass('m-login--forget-password');
		
        login.addClass('m-login--reset-password');
        login.find('.m-login__reset-password').animateClass('flipInX animated');
    } */

    var handleFormSwitch = function() {
        $('#m_login_forget_password').click(function(e) {
            e.preventDefault();
            displayForgetPasswordForm();
        });
		 // $('#m_login_forget_password_submit').click(function(e) {
   //          e.preventDefault();
   //          displayResetPasswordForm();
   //      });

        $('#m_login_signup').click(function(e) {
            e.preventDefault();
            displaySignUpForm();
        });

        $('#m_login_signup_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });

        $('#m_login_forget_password_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });
    }

    //This code for displaying forms after refresh page
    if(hash_value == "signup")
    {
        displaySignUpForm();
    }

     if(hash_value == "forgot")
    {
        displayForgetPasswordForm();
    }

    // if(hash_value == "reset")
    // {
    //     displayResetPasswordForm();
    // } 
 
    var handleSignInFormSubmit = function() {
        $('#m_login_signin_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
          
            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            //btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
             $(form).submit();
            /*form.ajaxSubmit({
                url: '',
                method:'GET',
                success: function(response, status, xhr, $form) {
                    //console.log(response);
                    $(form).submit();
                    // similate 2s delay
                    // setTimeout(function() {
                    //     //btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    //     showErrorMsg(form, 'success', 'Incorrect username or password. Please try again.');
                    // }, 2000);
                }
            });*/
        });
    }

    //This code for extra validation

    jQuery.validator.addMethod("validemail", function(value, element, param) {
                       var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                       
                       // var reg =  /^[a-z]+[a-z0-9._]+@[a-z0-9]+\.[a-z.]{2,5}$/i;
                       
                       if(reg.test(value)){
                           return true;
                       }else{
                               return false;
                       }
                }, "Please enter a valid email address.");

     jQuery.validator.addMethod("fornumber", function(value, element, param) {
                    
                           //console.log(value.indexOf("-"));
                           if(value.indexOf("-") == -1)
                           {
                             return true;
                           }else{
                               return false;
                            }
                      
                }, "Please enter a valid mobile number.");

      jQuery.validator.addMethod("samecpassword", function(value, element, param) {
                      var password = $("#id_password").val();
                       
                       if(value == password){
                           return true;
                       }else{
                               return false;
                       }
                }, "Password did not match");
				
				jQuery.validator.addMethod("samecpassword2", function(value, element, param) {
                      var password = $("#id_reset_password").val();
                       
                       if(value == password){
                           return true;
                       }else{
                               return false;
                       }
                }, "Password is not match");

      jQuery.validator.addMethod("notNumber", function(value, element, param) {
                       // var reg = /[0-9]/;
                       var reg =  /^[a-zA-Z ]{2,30}$/;
                       
                       if(reg.test(value)){
                           return true;
                       }else{
                               return false;
                       }
                }, "Please enter a valid name.");

     

    var handleSignUpFormSubmit = function() {
        $('#m_login_signup_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');
           
            form.validate({
                rules: {
                    first_name: {
                        required: true,
                        notNumber : true
                    },
                    last_name: {
                        required: true,
                        notNumber : true
                    },
                    email: {
                        required: true,
                        email: true,
                        validemail:true,
                        remote:{
                            url: "checkexist", //make sure to return true or false with a 200 status code
                            // type: "POST",
                            cache: false,
                            data: {
                                email: function() {
                                    return $("#id_email").val();
                                }
                            }
                        }
                    },
                    password: {
                        required: true,
                        minlength: 5,
                    },
                    cpassword: {
                        required: true,
                        minlength: 5,
                        samecpassword: true,
                    },
                    mobile: {
                        required: true,
                        number: true,
                        fornumber:true,
                        minlength: 10,
                        maxlength: 10,
                        /*remote:{
                            url: "checkexist", //make sure to return true or false with a 200 status code
                            // type: "POST",
                            cache: false,
                            data: {
                                mobile: function() {
                                    return $("#id_mobile").val();
                                }
                            }
                        }*/
                    },
                    agree: {
                        required: true
                    },
                    otp: {
                        required: true,
                        number: true,
                        fornumber:true,
                        minlength: 6,
                        maxlength: 6,
                        /*remote:{
                            url: "verify_otp", //make sure to return true or false with a 200 status code
                            // type: "POST",
                            cache: false,
                            data: {
                                mobile: function() {
                                    return $("#id_mobile").val();
                                },
                                otp: function() {
                                    return $("#otp").val();
                                },
                            },
                            success: function(data){ 
                                // if( data.responseText != "success" ) {
                                //    alert(data.responseText);
                                   //handle failed validation
                                //}
                                console.log(data.responseText);
                             }
                        }*/
                    },
                },
                messages: {
                        email:{
                            remote : "<font color='red'>Email is already exist.</font>"
                        },
                        mobile:{
                            remote : "<font color='red'>Mobile Number is already exist.</font>"
                        }
                    }
            });

            if (!form.valid()) {
                    return;
            }
            $(form).unbind().submit();
        });
    }

    var handleForgetPasswordFormSubmit = function() {
        $('#m_login_forget_password_submit').click(function(e) {
			e.preventDefault();

            var btn = $(this);
			var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        validemail:true,
                    }
                }
            });
            if (!form.valid()) {
                return;
            }           
             $(form).submit();    
             /*form.ajaxSubmit({
                url: '',
                method:'GET',
                success: function(response, status, xhr, $form) {                    
                    $(form).submit();                
                }
            });*/
            
        });
    }
	
	var handleResetPasswordFormSubmit = function() {
        $('#m_login_reset_password_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');
           
            form.validate({
                rules: {                   
                    password: {
                        required: true
                    },
                    cpassword: {
                        required: true,
                        samecpassword2: true,
                    }                    
                },
                messages: {
                        /*email:{
                            remote : "<font color='red'>Email is already exist.</font>"
                        },
                        mobile:{
                            remote : "<font color='red'>Mobile Number is already exist.</font>"
                        }*/
                    }
            });

            if (!form.valid()) {
                    return;
            }

            //btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            $(form).submit();  
            /*form.ajaxSubmit({
                url: '',
                method:'GET',
                success: function(response, status, xhr, $form) {                    
                    $(form).submit();                
                }
            });*/
        });
    }
	

    //== Public Functions
    return {
        // public functions
        init: function() {
            handleFormSwitch();
            handleSignInFormSubmit();
            handleSignUpFormSubmit();
            handleForgetPasswordFormSubmit();
			handleResetPasswordFormSubmit();
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    SnippetLogin.init();
});


setTimeout(function() {
    $(".class_alert_message").hide(1000);
 }, 3000);


 function mobile_send_otp() {

                                

                                //alert("i am in mobile_send_otp new = mob[" + mobile_number + "], name = [" + name + "]");

                                var mobile_number = document.getElementById("id_mobile").value; // $('#register-form input[name="mobile_number"]').val();
                                var first_name = document.getElementById("id_first_name").value; // $('#register-form input[name="first_name"]').val() || '';
                                var last_name = document.getElementById("id_last_name").value; // $('#register-form input[name="last_name"]').val() || '';
                                var name = first_name + ' ' + last_name;
                                //alert($("input[name=_token]").val());

 

                                //var phoneno = /^\d{10}$/;
                                if (/^\d{10}$/.test(mobile_number)) {

                                    //alert("i am in mobile_send_otp new = mob[" + mobile_number + "], name = [" + name + "]");
                                   
 

                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        console.log(JSON.parse(xhttp.responseText));  
                                        if (this.readyState == 4 && this.status == 200) {
                                            //document.getElementById("demo").innerHTML = this.responseText;
                                            var jsonObj = JSON.parse(this.responseText);
                                            if (jsonObj.ERROR_CODE > 0) {
                                                $("#otpsendfail").html(jsonObj.ERROR_DESCRIPTION);
                                                $("#otpsendsuccess").html("");
                                                //console.log(jsonObj.ERROR_DESCRIPTION);
                                            } else {
                                               $("#otpsendsuccess").html("OTP Sent");
                                               $("#otpsendfail").html("");
                                                //console.log("OTP Sent");

                                            }

                                        }
                                    };
                                    xhttp.open("POST", 'send_otp', true);
                                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                    xhttp.send("mobile_number=" + mobile_number + "&name=" + name + "&otp_for=signup&_token="+ $("input[name=_token]").val());
                                   

                                   



                                } else {

                                    //$('.forgetmerMSG').html('Please enter valid email address');
                                    
                                    //showloader();
                                    return false;
                                }

                            }
