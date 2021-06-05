$(document).ready(function(){

	$('#form-signin').submit(function(e){
		e.preventDefault();

		var login = $.trim($('#login').val());
		var password = $.trim($('#password').val());

		if (login!='' && password!='') {
			$(this).unbind().submit();
		}
	});
} );
