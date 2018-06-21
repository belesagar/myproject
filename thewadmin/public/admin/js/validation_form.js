 

 jQuery.validator.addMethod("notNumber", function(value, element, param) {
                       // var reg = /[0-9]/;
                       var reg =  /^[a-zA-Z ]{2,30}$/;
                       
                       if(reg.test(value)){
						   return true;
                       }else{
                               return false;
                       }
                }, "Please enter valid input.");

 jQuery.validator.addMethod("notSpecialCharecter", function(value, element, param) {
                       // var reg = /[0-9]/;
                       var reg =  /^[a-zA-Z0-9\-\s]+$/;
                       
                       /*if(reg.test(value)){
						   return true;
                       }else{ 
                               return false;
                       }*/
                       if(value == "")
                   		{
                   			return true;
                   		}else{
                   			if(reg.test(value)){
						   		return true;
                       		}else{
                               return false;
                       		}
                   		}

                       /*if(reg.test(value)){
						   return true;
                       }else{
                       		if(value != "")
                       		{
                       			return true;
                       		}
                           return false;
                       }*/
                }, "Special characters are not allowed.");

jQuery.validator.addMethod("fornumber", function(value, element, param) {
                    
                           //console.log(value.indexOf("-"));
                           if(value.indexOf("-") == -1)
                           {
                             return true;
                           }else{
                               return false;
                            }
                      
                }, "Please enter a valid number.");

$.validator.addMethod("pan", function(value, element) 
    {
        return this.optional(element) || /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/.test(value);
    }, "Invalid PAN Number");

$.validator.addMethod("gst", function(value, element)
    {
        return this.optional(element) || /\d{2}[A-Z]{5}\d{4}[A-Z]{1}\d[Z]{1}[A-Z\d]{1}/.test(value);
    }, "Invalid GST Number");

$.validator.addMethod("ifsc", function(value, element)
    {
        return this.optional(element) || /^[A-Za-z]{4}[a-zA-Z0-9]{7}$/.test(value);
    }, "Invalid IFSC Number"); 

$.validator.addMethod("valueNotEquals", function(value, element, arg){
				console.log(value); 
			  return arg != value;
			 }, "Please select any one.");

 jQuery.validator.addMethod("samecpassword", function(value, element, param) {
                      var password = $("#id_new_password").val();
                       
                       if(value == password){
						   return true;
                       }else{
                               return false;
                       }
                }, "Password did not match"); 

 jQuery.validator.addMethod("validemail", function(value, element, param) {
                       // var reg = /[0-9]/;
                       var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                       // var reg =  /^[a-z]+[a-z0-9._]+@[a-z0-9]+\.[a-z.]{2,5}$/i;
                       
                       if(reg.test(value)){
                           return true;
                       }else{
                               return false;
                       }
                }, "Please enter a valid email address.");

function handleData(data /* , textStatus, jqXHR */ ) {
    // alert(data);
    //do some stuff
}

 jQuery.validator.addMethod("checkepincode", function(value, element, param) {
                       
                      
                }, "Sorry , We don't support given pincode.");

//This validation Code for personal details
$('#id_personal_details').validate({
					rules: { 
							  
					first_name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					last_name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					address_line1:	{
						required: true,
                        notSpecialCharecter:true,
					},
					address_line2:	{
						// required: true,
                        notSpecialCharecter:true,
					},
					pincode:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 6,
                        minlength: 6,
                        // checkepincode:true,
                        remote:{
                            url: "checkepincode", //make sure to return true or false with a 200 status code
                            // type: "POST",
                            cache: false,
                            data: {
                                pincode: function(data) {
                                    return $("#id_pincode").val(); 
                                }
                            }
                            
                        }
					},
					monthly_income:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
					},
					pan_card:	{
						required: true,
                        fornumber:true,
                        pan:true,
					},
					aadhaar_card:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 12,
                        minlength: 12,
					},
					/*state: { 
						required: true, 
					},
					city:	{
						required: true,
						notNumber : true,
						minlength: 2,
					},*/
				},	
				messages: {
						pincode:{
                            remote : "<font color='red'>Sorry , We don't support given pincode.</font>"
                        },
					
					
					},
					submitHandler: function (form) {
						
						 // $('#id_personal_details').attr('disabled','disabled');
						 $(':input[type="submit"]').prop('disabled', true);
						 $("#id_personal_details").unbind().submit();
					}
			  
			});


//This validation Code for personal details
$('#id_profile_details').validate({
					rules: { 
							  
					first_name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					last_name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					alternet_mobile_no:	{
						// required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
                        minlength: 10,
                        // checkepincode:true,
                        // remote:{
                        //     url: "checkepincode", //make sure to return true or false with a 200 status code
                        //     // type: "POST",
                        //     cache: false,
                        //     data: {
                        //         pincode: function(data) {
                        //             return $("#id_pincode").val(); 
                        //         }
                        //     }
                            
                        // }
					},
					address_line1:	{
						required: true,
					},
					// address_line2:	{
					// 	required: true,
					// },
					pincode:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
					},
					state: { 
						required: true, 
					},
					city:	{
						required: true,
						notNumber : true,
						minlength: 2,
					},
				},	
				messages: {
						// first_name:{
						// 	required : "<font color='red'>First Name is Required</font>",
						// 	notNumber : "<font color='red'>Enter Proper Name</font>"
						// },
					
					
					},
					submitHandler: function (form) {
						
						 // $('#id_personal_details').attr('disabled','disabled');
						 $(':input[type="submit"]').prop('disabled', true);
						 $("#id_profile_details").unbind().submit();
					}
			  
			});

	//This validation for Change password
$('#id_change_password').validate({
					rules: { 
					old_password: {
					required: true,
					minlength: 5
				},
				new_password: {
					required: true,
					minlength: 5
				},
				reenter_password: {
					required: true,
					samecpassword: true,
					minlength: 5
				}
				},
				messages: {
						old_password: {
							required: "<font color='red'>Please Enter a password</font>",
							minlength: "<font color='red'>Your password must be at least 5 characters long</font>"
					},
					new_password: {
							required: "<font color='red'>Please Enter a password</font>",
							minlength: "<font color='red'>Your password must be at least 5 characters long</font>"
					},
					reenter_password: {
							required: "<font color='red'>Please Enter a password</font>",
							samecpassword: "<font color='red'>Password is not match</font>",
							minlength: "<font color='red'>Your password must be at least 5 characters long</font>"
					}
					},
					submitHandler: function (form) {
						// $('#id_personal_details').attr('disabled','disabled');
						 $(':input[type="submit"]').prop('disabled', true);
						 $("#id_change_password").unbind().submit();
						 // console.log("hiii");
					}
			  
			}); 


$('#id_add_employee').validate({
					rules: { 
							  
					first_name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					last_name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					email: {
                        required: true,
                        email: true,
                        validemail:true,
                        /*remote:{
                            url: "checkexist", //make sure to return true or false with a 200 status code
                            // type: "POST",
                            cache: false,
                            data: {
                                email: function() {
                                    return $("#id_email").val();
                                }
                            }
                        }*/
                    },
					alternet_mobile_no:	{
						// required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
                        minlength: 10,
                       
					},
					mobile:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
                        minlength: 10,
                       
					},
					address_line1:	{
						required: true,
					},
					// address_line2:	{
					// 	required: true,
					// },
					pincode:	{
						// required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
					},
					role:	{
						required: true
					},
					is_active:	{
						required: true
					},
					// state: { 
					// 	required: true, 
					// },
					// city:	{
					// 	required: true,
					// 	notNumber : true,
					// 	minlength: 2,
					// },
				},	
				messages: {
						// first_name:{
						// 	required : "<font color='red'>First Name is Required</font>",
						// 	notNumber : "<font color='red'>Enter Proper Name</font>"
						// },
					
					
					},
					submitHandler: function (form) {
						
						 // $('#id_personal_details').attr('disabled','disabled');
						 $(':input[type="submit"]').prop('disabled', true);
						 $(form).unbind().submit();
					}
			  
			});

$('#id_edit_employee').validate({
					rules: { 
							  
					first_name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					last_name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					email: {
                        required: true,
                        email: true,
                        validemail:true,
                        /*remote:{
                            url: "checkexist", //make sure to return true or false with a 200 status code
                            // type: "POST",
                            cache: false,
                            data: {
                                email: function() {
                                    return $("#id_email").val();
                                }
                            }
                        }*/
                    },
					alternet_mobile_no:	{
						// required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
                        minlength: 10,
                       
					},
					mobile:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
                        minlength: 10,
                       
					},
					address_line1:	{
						required: true,
					},
					// address_line2:	{
					// 	required: true,
					// },
					pincode:	{
						// required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
					},
					role:	{
						required: true
					},
					is_active:	{
						required: true
					},
					// state: { 
					// 	required: true, 
					// },
					// city:	{
					// 	required: true,
					// 	notNumber : true,
					// 	minlength: 2,
					// },
				},	
				messages: {
						// first_name:{
						// 	required : "<font color='red'>First Name is Required</font>",
						// 	notNumber : "<font color='red'>Enter Proper Name</font>"
						// },
					
					
					},
					submitHandler: function (form) {
						
						 // $('#id_personal_details').attr('disabled','disabled');
						 $(':input[type="submit"]').prop('disabled', true);
						 $(form).unbind().submit();
					}
			  
			});

$('#id_add_user').validate({
					rules: { 
							  
					name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					email: {
                        // required: true,
                        email: true,
                        validemail:true,
                        /*remote:{
                            url: "checkexist", //make sure to return true or false with a 200 status code
                            // type: "POST",
                            cache: false,
                            data: {
                                email: function() {
                                    return $("#id_email").val();
                                }
                            }
                        }*/
                    },
					alternet_mobile_no:	{
						// required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
                        minlength: 10,
                       
					},
					mobile:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
                        minlength: 10,
                       
					},
					address_line1:	{
						required: true,
					},
					// address_line2:	{
					// 	required: true,
					// },
					pincode:	{
						// required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
					},
					// is_active:	{
					// 	required: true
					// },
					// state: { 
					// 	required: true, 
					// },
					// city:	{
					// 	required: true,
					// 	notNumber : true,
					// 	minlength: 2,
					// },
				},	
				messages: {
						// first_name:{
						// 	required : "<font color='red'>First Name is Required</font>",
						// 	notNumber : "<font color='red'>Enter Proper Name</font>"
						// },
					
					
					},
					submitHandler: function (form) {
						
						 // $('#id_personal_details').attr('disabled','disabled');
						 $(':input[type="submit"]').prop('disabled', true);
						 $(form).unbind().submit();
					}
			  
			});

$('#id_edit_user').validate({
					rules: { 
							  
					name:	{
						required: true,
						notNumber : true,
						minlength: 3, 
					},
					email: {
                        required: true,
                        email: true,
                        validemail:true,
                        /*remote:{
                            url: "checkexist", //make sure to return true or false with a 200 status code
                            // type: "POST",
                            cache: false,
                            data: {
                                email: function() {
                                    return $("#id_email").val();
                                }
                            }
                        }*/
                    },
					alternet_mobile_no:	{
						// required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
                        minlength: 10,
                       
					},
					mobile:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
                        minlength: 10,
                       
					},
					address_line1:	{
						required: true,
					},
					// address_line2:	{
					// 	required: true,
					// },
					pincode:	{
						// required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
					},
					
					// is_active:	{
					// 	required: true
					// },
					// state: { 
					// 	required: true, 
					// },
					// city:	{
					// 	required: true,
					// 	notNumber : true,
					// 	minlength: 2,
					// },
				},	
				messages: {
						// first_name:{
						// 	required : "<font color='red'>First Name is Required</font>",
						// 	notNumber : "<font color='red'>Enter Proper Name</font>"
						// },
					
					
					},
					submitHandler: function (form) {
						
						 // $('#id_personal_details').attr('disabled','disabled');
						 $(':input[type="submit"]').prop('disabled', true);
						 $(form).unbind().submit();
					}
			  
			});