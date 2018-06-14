$(document).ready(function () {
    $('#counter-block').ready(function () {
        $('.borrowers').animationCounter({
            start: 100,
            end: 6245,
            step: 56,
            delay: 80,
        });
        $('.applications').animationCounter({
            start: 0,
            end: 2132,
            step: 52,
            delay: 90
        });
        $('.disbursed').animationCounter({
            start: 1,
            end: 132,
            step: 1,
            delay: 50,
        });
        $('.lenders').animationCounter({
            start: 1,
            end: 6,
            step: 1,
            delay: 900,
        });
    });

    $('.menulinkbx .menuicon').click(function () {

        $(this).parent().children().next().toggle();

    });

    $('.menulinkbx ul li a#loginbx').click(function () {
        $(this).parent().parent().addClass('mobile-menu-hide');
    });

    $(function () {
        $("#abouttab").tabs();
    });
    $('section, footer').click(function () {
        $('.loginmainbx').removeClass('slidelogin');
        $('.registrationbx').hide();
        $('.loginbx').show();
    });
    $('#loginbx').click(function () {
        $('.loginmainbx').addClass('slidelogin');
        $('.slidelogin').animate({right: '0'});

    });
    $('.btnCloselogin').click(function () {
        $('.loginmainbx').removeClass('slidelogin');
    });
    $('.registrationbxbtn').click(function () {
        $('.loginbx').hide();
        $('.registrationbx').show();
    });
    $('.signinbxbtn').click(function () {
        $('.registrationbx').hide();
        $('.loginbx').show();
    });
    $('#calcestimate').click(function () {
        $(this).hide();
        $('.estimateamount').show();
    });
    $('#proceed1').click(function () {
        $('.step1-2').show();
    });

    $(function () {
        $("#logintab").tabs();
    });

    $('.proceedlogin1').click(function () {
        $('.mainsteploginbx').hide();
        $('.step1').hide();
        $('.step2').show();
    });
    $('.proceedlogin2').click(function () {
        $('.mainsteploginbx').hide();
        $('.step1').hide();
        $('.step2').show();
    });

   
    $('#proceedstep5bx').click(function () {
        //$('.step4').hide();
        //$('.step5').show();
    });

    /* $('body').hover(function(){
     $('.advancebx1 .feature-box').slideDown(3000);
     $('.advancebx2 .feature-box').slideDown(4000);
     $('.advancebx3 .feature-box').slideDown(5000);
     $('.advancebx4 .feature-box').slideDown(6000);		
     }); */

    resizeDiv();
    $(window).scroll(function () {
        if ($(this).scrollTop() >= 50) {
            $('.back-to-top').fadeIn(200);
        } else {
            $('.back-to-top').fadeOut(200);
        }
    });
    $('.back-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 550);
    });
});

window.onresize = function (event) {
    resizeDiv();
}
function resizeDiv() {
    vpw = $(window).width();
    vph = $(window).height();
    $('.fullscreenbx').css({'height': vph + 'px'});
}
function upload_doc(){
 
        var global = new GlobalVars();
        $('.step3').hide();
        var encrypted_pltransid = $("#pl_transid").val();
        var upload_url = global.base_url + 'documents/initiate/' + encrypted_pltransid;
        window.location.href = upload_url;
        //$('.step4').show();  
   
}






