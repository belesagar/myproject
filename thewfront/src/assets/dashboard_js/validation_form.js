 

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
                       
                       if(reg.test(value)){
						   return true;
                       }else{
                               return false;
                       }
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

//This validation Code for personal details
$('#id_sign_up_form').validate({
					rules: { 
							  
					name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					mobile: {
                        required: true,
                        number: true,
                        fornumber:true,
                        minlength: 10,
                        maxlength: 10,
                       /* remote:{
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
					/*last_name:	{
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
					state: { 
						required: true, 
					},
					city:	{
						required: true,
						notNumber : true,
						minlength: 2,
					},*/
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
						 $("#id_sign_up_form").unbind().submit();
						 // checksignup();
					}
			  
			});


//This validation for Bussiness details
$('#id_business_details').validate({
					rules: { 
							  
					business_name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					business_address_line1:	{
						required: true,
						maxlength: 100,
					},
					business_pan:	{
						required: true,
                        fornumber:true,
                        pan:true,
					},
					gst_no:	{
						required: true,
                        fornumber:true,
                        notSpecialCharecter:true,
                        //gst:true,
					},
					business_state: { 
						required: true, 
					},
					business_city:	{
						required: true,
						notNumber : true,
						minlength: 2,
					},
					business_pincode:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 6,
					},
					business_office_phone_no_1:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 15,
                        minlength: 5,
					},
				//business_type: { valueNotEquals: "" }

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
						 $("#id_business_details").unbind().submit();
					}
			  
			});

//This validation for Franchise details
$('#id_franchise_details').validate({
					rules: { 
							  
					franchise_name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					franchise_address_line1:	{
						required: true,
						maxlength: 100,
					},
					franchise_shop_size:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
					},
					franchise_state: { 
						required: true, 
					},
					franchise_city:	{
						required: true,
						notNumber : true,
						minlength: 2,
					},
					franchise_pincode:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 6,
					},
					franchise_office_phone_no_1:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 15,
                        minlength: 5,
					},
				business_type: { valueNotEquals: "" }

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
						 $("#id_franchise_details").unbind().submit();
					}
			  
			});


//This validation for Account details
$('#id_account_details').validate({
					rules: { 
							  
					account_holder_name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					business_address:	{
						required: true,
						maxlength: 100,
					},
					bank_branch:	{
						required: true,
						notNumber : true,
						minlength: 3,
                        maxlength: 100,
					},
					bank_account_no:	{
						required: true,
						number: true, 
                        fornumber:true,
                        minlength: 9,
                        maxlength: 18,
					},
					bank_ifsc_code:	{
						required: true,
                        ifsc:true
					},
					account_type: { valueNotEquals: "" }

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
						 $("#id_account_details").unbind().submit();
					}
			  
			});



	//This validation for Upload Documents
$('#id_location').validate({
					rules: { 
							  
					location_address:	{
						 required: true, 
					},
					franchise_latitude:	{
						 required: true, 
            			 
					},
					franchise_longitude:	{
						 required: true, 
            			
					},
					
				},
						
					messages: {
						location_address:{
							required : "<font color='red'>Address field is required.</font>",
						},
						
					},
					submitHandler: function (form) {
						// $('#id_personal_details').attr('disabled','disabled');
						 // $(':input[type="submit"]').prop('disabled', true);
						 // $("#id_location").unbind().submit();
					}
			  
			});

	//This code for submit for on click
	$("#id_submit_location").click(function () {
		 $(':input[type="submit"]').prop('disabled', true);
		 $("#id_location").unbind().submit();
	});


//This validation for Submit Form
$('#id_submit_form').validate({
					rules: { 
							  
					agree:	{
						 required: true, 
					},
					
				},
						
					messages: {
						agree:{
							required : "<font color='red'>Please accept the terms and conditions.</font>",
						},
						
					},
					submitHandler: function (form) {
						// $('#id_personal_details').attr('disabled','disabled');
						 $(':input[type="submit"]').prop('disabled', true);
						 $("#id_submit_form").unbind().submit();
						 console.log("hiii");
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
						 console.log("hiii");
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


//This validation for Store details
$('#id_store_details').validate({
					rules: { 
							  
					reg_business_name:	{
						required: true,
						minlength: 3,
					},
					reg_business_add1:	{
						required: true,
						maxlength: 100,
					},
					regbusinesstype:	{
						required: true,
					},
					reg_business_pincode:	{
						required: true,
						number: true,
                        fornumber:true,
                        maxlength: 10,
					},
					
				//business_type: { valueNotEquals: "" }

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

//This validation for Kyc details of store
$('#id_kyc_details').validate({
					rules: { 
							  
					beneficiary_name:	{
						required: true,
						notNumber : true,
						minlength: 3,
					},
					pan_no:	{
						required: true,
                        fornumber:true,
                        pan:true,
					},
					bank_name:	{
						required: true,
						minlength: 3,
                        maxlength: 100,
					},
					baranch_name:	{
						required: true,
						minlength: 3,
                        maxlength: 100,
					},
					account_no:	{
						required: true,
                        fornumber:true,
                        maxlength: 30,
					},
					ifsc_code:	{
						required: true,
                        ifsc:true
					},
					vat_no:	{
						required: true,
					}
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



//This validation for Submit Form
$('#id_merchant_submit_form').validate({
					rules: { 
							  
					agree_terms:	{
						 required: true, 
					},
					
				},
						
					messages: {
						agree_terms:{
							required : "<font color='red'>Please accept the terms and conditions.</font>",
						},
						
					},
					submitHandler: function (form) {
						// $('#id_personal_details').attr('disabled','disabled');
						 $(':input[type="submit"]').prop('disabled', true);
						 $(form).unbind().submit();
						 //console.log("hiii");
					}
			  
			}); 

//This code for checking checkbox is checked or not of category
$(".class_categorycheck").change(function() {  
	// alert($(".class_categorycheck").is(":checked"));
     /*if($(this).is(":checked")) {
        var selectedval = $(this).val();
        var selectedtext = $(this).next().text();
        sendtobox(selectedval);
     }
      else {
        // remove the items 
     }*/
    });



jQuery.validator.addMethod("checkEmployeeType", function(value, element, param) {
                      var employment_type = $("#employment_type").val();
                    

                       if(employment_type == "salaried"){
						   return true;
                       }else{
                           return false;
                       }
                }, "This field is required.");


//This validation for calculate estimate form
$('#pl_eligibility_form').validate({
					rules: { 
							  
					city:	{
						required: true,
						
					},
					employment_type:	{
						required: true,
                        
					},
					/*gross_monthly_salary:	{
						//required: true,
						checkEmployeeType: true,
						
					},
					company_name:	{
						//required: true,
						checkEmployeeType: true,
                        
					},*/
					existing_total_emi:	{
						required: true,
                        
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
						// $(':input[type="submit"]').prop('disabled', true);
						 //$(form).unbind().submit();
						 submit_pl_eligibility_form();
					}
			  
			});


//This validation Code for Create Merchant

jQuery.validator.addMethod("checkcollected_amount", function(value, element, param) {
                      var fees_collected = $("input[name='fees_collected']:checked").val();
                    	console.log(fees_collected);

                       if(fees_collected == "0"){
						   return true;
                       }else{
                       		if(value != "")
                       		{
                       			return true;
                       		}
                           return false;
                       }
                }, "This field is required.");

jQuery.validator.addMethod("more_than_zero", function(value, element, param) {
                      return value > 0;
                }, "Please enter valid amount.");



//This code for instant cash

$.validator.addMethod("check_other_amount_selected", function(value, element, param) {
                      var amount_value = $("input[name='amount']:checked").val();
                    	

                    	if (typeof amount_value === "undefined") {
                    		return false;
                    	}
                    	
                       if(amount_value != "other"){
						   return true;
                       }else{
                       		if(value != "")
                       		{
	                             return true;
                       		}
                           return false;
                       }
                }, "Please enter amount.");

$.validator.addMethod("check_range_of_amount", function(value, element, param) {
                     
               		if(value > 0)
               		{
               			
                         if(value >= 20000 && value <= 200000)
                         {
                         	console.log("byyyyy");
                         	return true;
                         }else{
                         	return false;
                         }
               		}else{
               			return false;
               		}
                           
                }, "Please enter amount beetween 20,000 - 2,00,000.");


$('#id_instant_cash').validate({
					rules: { 
					
                    amount: {
                        required: true,
                    },
					/*other_amount: {
                        check_other_amount_selected: true,
                        check_range_of_amount: true,
                       	number: true,
                        fornumber:true,
                    },*/
					
				},	
				messages: {
						
					
					},
					submitHandler: function (form) {
						
						 // $('#id_personal_details').attr('disabled','disabled');
						 $(':input[type="submit"]').prop('disabled', true);
						 $(form).unbind().submit();
					}
			  
			});


$('#id_check_emi_amount').validate({
					rules: { 
					
                    amount: {
                        required: true,
                    },
					/*other_amount: {
                        check_other_amount_selected: true,
                        check_range_of_amount: true,
                       	number: true,
                        fornumber:true,
                    },*/
					
				},	
				messages: {
						
					
					},
					submitHandler: function (form) {
						
						 // $('#id_personal_details').attr('disabled','disabled');
						 $(':input[type="submit"]').prop('disabled', true);
						 $(form).unbind().submit();
					}
			  
			});

//This fumction is calling when radio button is selected

$( "input[name=amount]" ).click(function() {
	var loan_amount = $(this).val();

	if(loan_amount == "other")
	{
		$("#id_other_amount_section").show();
	}else{
		$("#id_other_amount_section").hide();
		$("#id_other_amount").val(""); 
	}

 
});


//This validation for check eligibility form
$('#id_check_eligibility').validate({
					rules: { 
					
                    salary: {
                        required: true,
                        number: true,
                        fornumber:true,
                        more_than_zero:true,
                    },
					emi: {
                        //required: true,
                        number: true,
                        fornumber:true,
                        //more_than_zero:true,
                    },
					
				},	
				messages: {
						 
					
					},
					submitHandler: function (form) {
						
						 // $('#id_personal_details').attr('disabled','disabled');
						 //$(':input[type="submit"]').prop('disabled', true);
						 $(form).unbind().submit();

						 //This function for calculation eligibility
						 //check_eligibility();

					}
			  
			});

//This function for caculation
function check_eligibility()
{
	var salary = $("#id_salary_amount").val();
	var existing_emis = $("#id_existing_emis").val();

	if(existing_emis <= 0)
	{
		existing_emis = 0;
	}

	var emi_eligible = (parseFloat(salary) - parseFloat(existing_emis)) * 0.5;

	var loc_amount = emi_eligible * 12;
	 
	alert(loc_amount);

	//applied_loc_amount = loc_amount, rounded off to nearest multiple of 5000

}


//This validation for checking franchise url
// $( "#id_url" ).keyup(function() {
// 	var url_string = this.value;

//   	check_url(url_string);
// });

$('#id_get_flipkart_data').on('click', function() {
	var url_string = $("#id_url").val();
    check_url(url_string,"submit");
});

function check_url(url_string,type="")
{
	if(url_string != "")
	{
		if(/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(url_string))
		{
			$("#id_url_error").hide();
			if(type == "submit")
			{
				$("#id_order_data").unbind().submit();
			}
		}else{
			$("#id_url_error").show();
		}
		
	}else{
		$("#id_url_error").show();
	}
}

$('#id_order_data').validate({
					rules: { 
					
                    flipkart_url: {
                        required: true,
                        url: true,
                        // number: true,
                        // fornumber:true,
                        // more_than_zero:true,
                    },
					salary: {
                        required: true,
                        number: true,
                        fornumber:true,
                        more_than_zero:true,
                    },
					emi: {
                        //required: true,
                        number: true,
                        fornumber:true,
                        //more_than_zero:true,
                    },
					
				},	
				messages: {
						 
					
					},
					submitHandler: function (form) {
						
						 // $('#id_personal_details').attr('disabled','disabled');
						 $(':input[type="submit"]').prop('disabled', true);
						 $(form).unbind().submit();

						 //This function for calculation eligibility
						 //check_eligibility();

					}
			  
			});