/* Add here all your JS customizations */
$(document).ready(function () {
	$('.spwd').click(function(){
		if ($(this).is(':checked')) {
			$('#idpwd').attr('type','text');
		}else{
			$('#idpwd').attr('type','password');
		}
	})
})
$(document).ready(function(){
	$('#kuncis').click(function(){
		$('.userbox').load("config/ceklogout.php")
	})
})