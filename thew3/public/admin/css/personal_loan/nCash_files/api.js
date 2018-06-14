/* global indexOf, contains */
var global = new GlobalVars();
$(document).ready(function () {
    var global = new GlobalVars();
    //Employer autocomplete list
    $(".company-employer-name").autocomplete({
        minLength: 3,
        source: function (request, response) {
            $.ajax({
                url: global.base_url + 'personalloan/companies_search',
                type: 'post',
                data: {
                    q: request.term
                },
                dataType: "json",
                success: function (data) {
                    response($.map(data, function (c) {
                        return {
                            label: c,
                            value: c
                        };
                    }));
                }
            });
        }
    }); //searchsite end   
    $('input[name="existing_total_emi"]').click(function () {
        var existing_total_emi = $(this).val();
        $('.doyouloanbox').hide();
        $('.doyouloanbox').addClass('divNotSerialize');
        if (existing_total_emi === 'yes') {
            $('.active_yes').parent().addClass('active');
            $('.active_no').parent().removeClass('active');
            $('.doyouloanbox').show();
            $("#existing_total_emis").attr('required', 'required');
            $('.doyouloanbox').removeClass('divNotSerialize');
        } else if (existing_total_emi === 'no') {
            $('#existing_total_emis').removeAttr('required');
            $('.active_no').parent().addClass('active');
            $('.active_yes').parent().removeClass('active');
        }
    });

    $('input[name="is_cheque_bounce_in_last_3_months"]').click(function () {
        var is_cheque_bounce_in_last_3_months = $(this).val();
        $('#cheque_bounce').hide();
        if (is_cheque_bounce_in_last_3_months === 'yes') {
            $('.active_yes').parent().addClass('active');
            $('.active_no').parent().removeClass('active');
            $('#cheque_bounce').show();
            $("#noOfChequeBounced").attr('required', 'required');
        } else if (is_cheque_bounce_in_last_3_months === 'no') {
            $('#noOfChequeBounced').removeAttr('required');
            $('.active_no').parent().addClass('active');
            $('.active_yes').parent().removeClass('active');
            $('#noOfChequeBounced').val('0');
        }
    });
    /* on change employment type hide and show sub div boxes */
    $('#employment_type').change(function (event) {
        var employment_type = $(this).val();
        $('.employment-type-div').hide();
        $('#salaried_gross_monthly_salary, #salaried_company_name').removeAttr('required');
        $('#self_emp_gross_monthly_salary, #self_employed_company_name').removeAttr('required');
        $('#profession_type, #self_employed_gross_monthly_salary').removeAttr('required');
        if (employment_type === 'salaried') {
            $('#salaried-div').show();
            $('#salaried_gross_monthly_salary, #salaried_company_name').attr('required', 'required');
            $('#salaried-div').removeClass('divNotSerialize');
        } else if (employment_type === 'self_employed') {
            $('#self-employed-div').show();
            $('#self_emp_gross_monthly_salary, #self_employed_company_name').attr('required', 'required');
            $('#self-employed-div').removeClass('divNotSerialize');
        } else if (employment_type === 'self_employed_professional') {
            $('#self-employed-professional-div').show();
            $('#profession_type, #self_employed_gross_monthly_salary').attr('required', 'required');
            $('#self-employed-professional-div').removeClass('divNotSerialize');
        }

    });
    /*SETP 1-1*/
    $("#pl_eligibility_form").submit(function (e) {
        var selectNotArray = ['.divNotSerialize select']; // this select fields will be not serialized
        var inputNotArray = ['.divNotSerialize input']; //this input fields will be not serialized
        $.ajax({
            url: global.base_url + 'personalloan/check_eligibility',
            type: 'post',
            data: $('#pl_eligibility_form input:not(' + inputNotArray + '),#pl_eligibility_form select:not(' + selectNotArray + ')').serialize(),
            dataType: "json",
            success: function (data) {
                var message = data.message;
                if (data.success === true) {
                    var eligibility_loan_amount = data.is_eligible_arr.eligible_amount;
                    $("#fc_prefios_btn").attr("data-perfiosloanamt", eligibility_loan_amount);
                    var amount = data.is_eligible_arr.eligible_amount;
                    amount = amount.toString().replace(/\B(?=(\d{2}){0,2}\d{3}(\d{7})*(?!\d))/g, ",");
                    $('#eligibility-amount').text(amount);
                    $('#estimatebtnbox').hide();
                    $('#eligibilitybtnbox').show();
                    $('#pl_eligibility_form select').change(function () {
                        $('#estimatebtnbox').show();
                        $('#eligibilitybtnbox').hide();
                    });
                    $('#pl_eligibility_form input').blur(function () {
                        $('#estimatebtnbox').show();
                        $('#eligibilitybtnbox').hide();
                    });
                    $('#pl_eligibility_form input').click(function () {
                        $('#estimatebtnbox').show();
                        $('#eligibilitybtnbox').hide();
                    });
                } else {
                    $('<div class="error-box"><p>' + message.replace(/\./g, ".<br>") + '</p></div>').css("color", "red").insertAfter('.display_error').fadeOut(8000, function () {
                        $('.error-box').remove();
                    });
                    window.scrollTo(0, 100);
                }
            }
        });
    });
    $("#proceed_step_1").click(function () {
        $(".step1-2").show();
    });


    /*SETP 3 Application form submit*/
    $("#pl_application_form").submit(function (e) {
        $.ajax({
            url: global.base_url + 'personalloan/apply',
            type: 'post',
            data: $('#pl_application_form').serialize(),
            dataType: "json",
            success: function (data) {
                console.log(data.status);
                if (data.status === true) {
                    $("#offer_loan_amount").val(data.offer_loan_amount);
                    $("#offer_tenure").val(data.offer_tenure);
                    $("#offer_final_interest_rate").val(data.offer_final_interest_rate_percent);
                    $("#offer_calculated_emi").val(data.offer_calculated_emi);
                    $("#pl_app_id").val(data.fb_pl_application_id);
                    $("#u_id").val(data.user_id);
                    $("#max_year").text('Max ' + data.tenure_in_years + ' Years');
                    $("#max_eligible").text('Max ' + data.offer_loan_amount / 100000 + ' Lakh');

                    $("#tenure_in_year").val(data.tenure_in_years);
                    confirmation_slider();
                    $(".step1").hide();
                    $(".step2").hide();
                    $(".step3").show();
                    $(".step3bx-btnbx").show();
                } else {

                }



            }
        });
    });

    /*SETP 4 offer submit */
    $("#pl_offers_form").submit(function (e) {
        $.ajax({
            url: global.base_url + 'personalloan/offer_submit',
            type: 'post',
            data: $('#pl_offers_form').serialize(),
            dataType: "json",
            success: function (data) {
                if (data.success) {
                    upload_doc();
                } else {

                }

            }
        });
    });
    var events = "change keyup blur";
    var submit_ready = {pancard: false, email: false, first_name: false, last_name: false, cities: false, mobile_number: false};

    /* Pan validation */
    $("#pancard").off(events).on(events, function () {
        $("#" + $(this).attr("id") + "-error").remove();
        var panVal = $(this).val();
        var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
        if (!regpan.test(panVal)) {
            var error = $("<div>", {id: $(this).attr('id') + "-error"});
            $(error).text("Not a valid pan ID");
            $(this).parents(".tabloggp").after(error);
            submit_ready.pancard = false;
        } else {
            submit_ready.pancard = true;
        }
    });

    /* email validation */
    $("#email").off(events).on(events, function () {
        $("#" + $(this).attr("id") + "-error").remove();
        var email_val = $(this).val();
        var email_reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (!email_reg.test(email_val)) {
            var error = $("<div>", {id: $(this).attr('id') + "-error"});
            $(error).text("Not a valid email");
            $(this).parents(".tabloggp").after(error);
            submit_ready.email = false;
        } else {
            submit_ready.email = true;
        }
    });

    /* first name, last name & cities validation */
    $("#first_name, #last_name, #cities, #mobile_number").off(events).on(events, function () {
        $("#" + $(this).attr("id") + "-error").remove();
        var vals = $(this).val();
        if ($(this).attr("id") === "mobile_number") {
            if (/^\d{10}$/.test(vals)) {
                submit_ready[$(this).attr("id")] = true;
            } else {
                var error = $("<div>", {id: $(this).attr('id') + "-error"});
                $(error).text("The mobile number is not valid");
                $(this).parents(".tabloggp").after(error);
            }
        } else if (vals.length === 0) {
            var error = $("<div>", {id: $(this).attr('id') + "-error"});
            $(error).text("This field can not be empty");
            $(this).parents(".tabloggp").after(error);
            submit_ready[$(this).attr("id")] = false;
        } else {
            submit_ready[$(this).attr("id")] = true;
        }
    });

    /* send an otp for signup */
    $("#otp-button").off("click").click(function () {
        otp($(this).prev("input").val(), "signup");
    });

    /* finalize checks and server side verifications / signing up the user */
    $(".proceedlogin1").off("click").on("click", function () {
        var halt = false;
        $.each(submit_ready, function (index, value) {
            if (value === false) {
                $("#" + index + "-error").remove();
                var error = $("<div>", {id: index + "-error"});
                $(error).html("Something went wrong with this field");
                $("#" + index).parents(".tabloggp").after(error);
                halt = true;
                return false;
            }
        });
        if (halt === true) {
            console.log("can not proceed !");
            return false;
        } else {
            var email = $("#email").val();
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var mobile_number = $("#mobile_number").val();
            var otp = $("#otp_box").val();
            var password = "abcd";
            var signup_type = "";
            var pancard = $("#pancard").val();
            $.ajax({
                url: global.base_url + "personalloan/signup_user",
                type: "post",
                data: {
                    password: password,
                    email: email,
                    first_name: first_name,
                    last_name: last_name,
                    mobile_number: mobile_number,
                    otp: otp,
                    signup_type: signup_type,
                    pan: pancard
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    var content = JSON.parse(data.response);
                    if (content.status !== false) {
                        if (content.signup.ERROR_CODE === '0') {
                            /* login the user */
                            login(content.signup.user_data);
                        } else {
                            console.log("show the error message");
                        }
                    } else {
                        $("#ui-id-4").click();
                    }
                }
            });
        }
    });

    /* login an existing user */
    $(".proceedlogin2").off("click").click(function () {
        var url = global.base_url + "personalloan/login_verify";
        var email = $("#login_email").val();
        var password = $("#login_password").val();
        $.post(url, {email: email, password: password, login_with: "password"}).done(function (response) {
            var data = JSON.parse(response);
            var content = JSON.parse(data.response);
            if (content.status) {
                login(content.signup.user_data);
            } else {
                console.log("Show error message");
            }
        });
    });

    /* dob date picker */
    jQuery(function () {
        jQuery("#dob").datepicker({
            changeYear: true,
            changeMonth: true,
            format: 'YYYY-MM-DD',
            yearRange: '1945:' + (new Date).getFullYear()

        });
    });

});


/* dom function in pure js */
function login(user_data) {
    console.log(user_data);
    var url = global.base_url + "personalloan/check_login_session";
    $.post(url, {user_id: user_data.user_id}).done(function (response) {
        var data = JSON.parse(response);
        if (data.status) {
            if (data.session) {
                $("#ui-id-4").click();
            } else {
                $(document.body).load(location.href);
            }
        } else {

        }
    });
}


function otp(mobile_number, otp_for) {
    var global = new GlobalVars();
    $.ajax({
        url: global.base_url + "personalloan/signup_otp_send",
        type: "post",
        data: {mobile_number: mobile_number, otp_for: otp_for},
        success: function (response) {
            var data = JSON.parse(response);
            showSuccess("OTP sent to " + mobile_number);
        }
    });
}

/* if already logged in show up step 3 */
function head_start(data) {
    $(document).ready(function () {
        populate();
        $("#loginbx").text(data.first_name);
        $('.mainsteploginbx').hide();
        $('.step1').hide();
        $('.step3').hide();
        $('.step2').show();

    });
}

function populate() {
    var url = global.base_url + "personalloan/login_verify";
    $.post(url, {login_with: "password"}).done(function (response) {
        var data = JSON.parse(response);
        var content = JSON.parse(data.response);
        if (content.status) {
            var user_data = content.signup.user_data;
            console.log(user_data);
            /* personal */
            $("#dob").val(user_data.dob);
            $("#gender").val(user_data.gender);
            $("#mother_name").val(user_data.mother_name);
            $("#profile_first_name").val(user_data.first_name);
            $("#profile_last_name").val(user_data.last_name);
            $("#profile_pan_card").val(user_data.pan);
            $("#profile_email").val(user_data.email);
            $("#profile_mobile_number").val(user_data.mobile_number);
            $("#marital_status").val(user_data.marital_status);

            /*professional details */
            $("#company_name").val(user_data.company_name);
            $("#office_email").val(user_data.office_email);
            $("#employment_duration").val(user_data.employment_duration);
            $("#total_experience").val(user_data.total_experience);
            $("#net_monthly_salary").val(user_data.gross_monthly_salary);
            $("#office_address_line_1").val(user_data.office_address_line_1);
            $("#office_address_line_2").val(user_data.office_address_line_2);
            $("#office_address_pincode").val(user_data.office_address_pincode);
            $("#office_address_std_code").val(user_data.office_address_std_code);
            $("#office_telephone_number").val(user_data.office_telephone_number);

            /*residensial */
            $("#residing_since").val(user_data.residing_since);
            $("#residence_type").val(user_data.residence_type);
            $("#present_address_line_1").val(user_data.present_address_line_1);
            $("#present_address_line_2").val(user_data.present_address_line_2);
            $("#present_address_pincode").val(user_data.present_address_pincode);

            /*bank details*/
            $("#bank_name").val(user_data.bank_name);
            $("#bank_account_no").val(user_data.bank_account_no);
            $("#bank_account_type").val(user_data.bank_account_type);
            $("#bank_branch_ifsc").val(user_data.bank_branch_ifsc);
            $("#bank_account_holder_name").val(user_data.bank_account_holder_name);

            /*others*/
            $("#existing_total_emis").val(user_data.bank_account_type);
        } else {
            showError("Some error occured in pre filling data");
        }
    });
}


function confirmation_slider() {

    $("#loan-range").slider({
        range: "max",
        min: 1,
        step: 0.1,
        max: ($("#offer_loan_amount").val() / 100000),
        value: $("#offer_loan_amount").val() / 100000,
        slide: function (event, ui) {
            $("#amount_emi").val(ui.value + 0.1);
            var offer_loan_amount = parseInt((ui.value + 0.1) * 100000);
            $("#offer_loan_amount").html(offer_loan_amount);
            $("input[name='offer_loan_amount']").val(offer_loan_amount);
            $.post(global.base_url + "personalloan/emiCal/" + offer_loan_amount + "/" + $("#offer_final_interest_rate").val() + "/" + $("#offer_tenure").val() + "/true", function (data) {
                $("#offer_calculated_emi").html(data);
                $("input[name='offer_calculated_emi']").val(data);
            });
        }
    });

    $("#amount_emi").val($("#loan-range").slider("value"));



    $("#year-range").slider({
        range: "max",
        min: 1,
        max: $("#tenure_in_year").val(),
        value: $("#tenure_in_year").val(),
        slide: function (event, ui) {
            $("#year").val(ui.value);
            var offer_tenure = ui.value * 12;
            $("#offer_tenure").html(offer_tenure);
            $("input[name='offer_tenure']").val(offer_tenure);
            $.post(global.base_url + "personalloan/emiCal/" + $("#offer_loan_amount").val() + "/" + $("#offer_final_interest_rate").val() + "/" + offer_tenure + "/true", function (data) {
                $("#offer_calculated_emi").html(data);
                $("input[name='offer_calculated_emi']").val(data);
            });
        }
    });
    $("#year").val($("#year-range").slider("value"));
}
function showError(msg) {
    $(".error_all").remove();
    var error = document.createElement("div");
    $(error).addClass("error_all");
    $(error).html(msg);
    $(document.body).append(error);
    setTimeout(function () {
        $(".error_all").remove();
    }, 2500);
}