$(document).ready(function() {
	$('.radiochecked').click(function(){
		if($(this).parent().parent().parent().children().children().hasClass('active')){
			$(this).parent().parent().parent().children().children().removeClass('active');
		}
		$(this).parent().addClass('active');
	});
	$('.checkboxchecked').click(function(){
		if($(this).parent().hasClass('active')){
			$(this).parent().removeClass('active');
		}else{
			$(this).parent().addClass('active');
		}
	});
	
});
