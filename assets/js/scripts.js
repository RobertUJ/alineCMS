$(document).ready(function(){
	
	//Javascript for login form
	
	//$(".alert").alert();
	/*
	$("#frmLogin").submit(function(){
		if( $('#frmLoginEmail').correo() &&  $('#frmLoginPass').pass() ){
			return true;
		}
		else return false;
	});
	
	$("#frmLogin").submit(function(){
		if( $('#frmLoginEmail').correo() &&  $('#frmLoginPass').pass() ){
			return true;
		}
		else return false;
	});
	*/
	
});

 // Funciones generales
	
		jQuery.fn.pass=function(){
			if($(this).val() != ""){
				$("#failPass").hide();
				$("#failLogin").hide();
				return true;
			}
			else{
				$("#failPass").show();
		  		$(this).focus();
		  		return false;
			}
		}

		jQuery.fn.correo=function(){
			if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($(this).val())){
				$("#failCorreo").hide();
				$("#failLogin").hide();
				return true;
			}
			else{
				$("#failCorreo").show();
				$(this).focus();
				return false;
			}
		}
