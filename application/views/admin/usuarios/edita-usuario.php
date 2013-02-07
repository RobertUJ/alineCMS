<?=$head?>
<body>
<?=$header?>
	<div class="wrapper container-fluid">
		<div class="row-fluid">
			<aside class="span2">
				<div class="tabbable tabs-left">
					<ul class="nav nav-tabs">
						<li class=""><a href="<?php echo base_url('panel/usuarios/'); ?>" >Panel</a></li>
						<li class="active"><a href="<?php echo base_url('panel/usuarios/nuevo_usuario'); ?>" >Agregar Usuario</a></li>
					</ul>
				</div>
			</aside>
		
	<div id="body_content" class="span10">

<div id="body_content" class="span10 panel_usuarios">
	<div class="page-header">
		<h2><?=$nombre_pagina?> <small> <?=$descripcion_pagina?></small></h2>
	</div>
	<div class="row-fluid">

	<form method="POST" action="<?php echo base_url('panel/usuarios/guarda_edicion') ?>" name="" id="frmEditUsuario" class="form-horizontal">
	<fieldset>
	<!--  id de usuario a editar --> 
	<input type="hidden" value="<?=$usr->id?>" name="id" />	

<div class="row-fluid">
	<div class="span6">
		<?php 
			$flagValida = FALSE;
			$flagUsrFail = FALSE;
			$flagEmailFail = FALSE;
			if(isset($pass)){
				global $flagValida;
				$flagValida = TRUE;
			}
			if(isset($usr_fail) && $usr_fail == TRUE){
				global $flagUsrFail;
				$flagUsrFail = TRUE;
			}
			
			if(isset($email_fail) && $email_fail == TRUE){
				global $flagEmailFail;
				$flagEmailFail = TRUE;
			}

			function get_error($nombretxt = ''){
				global $flagValida , $flagUsrFail , $flagEmailFail ;

				if( $nombretxt == "usuario" && $flagUsrFail == TRUE){ echo "error";  return; }
				if( $nombretxt == "email" && $flagEmailFail == TRUE){ echo "error";  return; }
				
				if( $flagValida == TRUE ){
					if( form_error("$nombretxt")  != "" ) {
						echo "error";
						
					}else{
						echo "success";
					}
				}
			}

			function print_error($nombretxt = ''){
				global $flagValida, $flagUsrFail , $flagEmailFail ;
				
				if( $nombretxt == "usuario" && $flagUsrFail == TRUE){ 
					$flagUsrFail = FALSE; echo "<span class='help-inline'>El usuario ya existe, ingresa otro por favor.</span>";  return; 
				}
				if( $nombretxt == "email" && $flagEmailFail == TRUE){ 
					$flagEmailFail = FALSE; echo "<span class='help-inline'>El email ya existe, ingresa otro por favor.</span>"; return; 
				}

				if( $flagValida == TRUE  ){
					if( form_error("$nombretxt")  != "" ) {
						echo form_error("$nombretxt" , "<span class='help-inline'>","</span>");
						
					}else{
						echo "<span class='help-inline'></span>";
					}
				}
			}
			function get_data($campo = ""){
				if( set_value($campo) == "" ){
					//echo $usr->nombre;
				}else{
					//echo set_value($campo);
				}
			}
			?>

			<?php if( isset($pass) && $pass == TRUE){?>
				<div class="alert alert-info">
 					Usuario creado satisfactoriamente!!
				</div>
			<?php } ?>

			<div class="control-group <?php get_error('nombre'); ?>">
			<label for="idNombre" class="control-label">Nombre <em>(*)</em></label>
			<div class="controls">
				<input   name="nombre" value="<?php if( set_value('nombre') == "" ){echo $usr->nombre;}else{echo set_value('nombre');} ?>" type="text" id="idNombre" class="input-xlarge focus">
				<?php print_error('nombre'); ?>
			</div>
			</div>

			<div class="control-group <?php get_error('apellidos'); ?>">
			<label for="idApellido" class="control-label">Apellidos <em>(*)</em></label>
			<div class="controls">
				<input name="apellidos" value="<?php if( set_value('apellidos') == "" ){echo $usr->apellidos;}else{echo set_value('apellidos');} ?>" type="text" id="idApellido" class="input-xlarge">
				<?php print_error('apellidos'); ?>
			</div>
			</div>

			<div id="grpIdUsuario" class="control-group <?php get_error('usuario'); ?>">
			<label for="idUsuario" class="control-label">Usuario <em>(*)</em></label>
			<div class="controls">
				<input  name="usuario" value="<?php if( set_value('usuario') == "" ){echo $usr->usuario;}else{echo set_value('usuario');} ?>" type="text" id="idUsuario" class="input-xlarge">
				<?php print_error('usuario'); ?>
			</div>
			</div>

     		<div class="control-group <?php get_error('email'); ?>">
			<label for="input06" class="control-label">Email <em>(*)</em></label>
			<div class="controls">
				<input  name="email" value="<?php if( set_value('email') == "" ){echo $usr->email;}else{echo set_value('email');} ?>"  type="text" id="input06" class="input-xlarge">
				<input type="hidden" value="<?php echo $usr->email ?>">
				<?php print_error('email'); ?>
			</div>


			</div>
			<div class="control-group">
			<?php 
				$_suscriptor = "";
				$_editor = "";
				$_administrador = "";
				if( set_value('perfil') == "" ){
					 
					 switch ($usr->perfil) {
					 	case '3':
					 		$_suscriptor = "selected";
					 		break;
					 	case '2':
					 		$_editor = "selected";
					 		break;
					 	case '1':
					 		$_administrador = "selected";
					 		break;
					 }
					 
				}else{
					$_select_id =  set_value('perfil');
					switch ($_select_id) {
					 	case '3':
					 		$_suscriptor = "selected";
					 		break;
					 	case '2':
					 		$_editor = "selected";
					 		break;
					 	case '1':
					 		$_administrador = 'selected';
					 		break;
					 } // End Switch
				} // End Else 
			?>

			<label for="input06" class="control-label">Seleccione el perfil</label>
			<div class="controls">
				<select class="" name="perfil"s>
					<option <?=$_suscriptor?> 	 value="3">Suscriptor</option>
					<option <?=$_editor?> 		 value="2">Editor</option>
					<option <?=$_administrador?> value="1">Administrador</option>
				</select>
			</div>
			</div>

			<!-- Inputs escondidos para guardar contraseña -->
			<input type="hidden" value="<?=$usr->pass?>" name="pass">
			<input type="hidden" value="<?=$usr->pass?>" name="re_pass">
	</div>
		<div class="span6">
			<div id="edita_pass">		
				
				<div class="control-group <?php get_error('pass'); ?>">
				<label for="pass" class="control-label">Contraseña <em>(*)</em></label>
				<div class="controls">
					<input  name="new_pass" value="" type="password" id="pass" class="input-xlarge clsPass">
					<?php print_error('pass'); ?>
				</div>
				</div>

				<div class="control-group <?php get_error('re_pass'); ?>">
				<label for="idre_pass" class="control-label">Re-Ingrese Contraseña <em>(*)</em></label>
				<div class="controls">
					<input  name="new_re_pass" value="" type="password" id="idre_pass" class="input-xlarge clsPass">
					<?php print_error('re_pass'); ?>
				</div>
				</div>
			</div>
		</div>
</div>	



			<div class="form-actions">
				<input style="margin-left:10px;" class="btn btn-success btn-medium" type="submit" name="btnGuardar" value="Guardar actualizacion"/>
				<a href="#" id="btnEditarPass" class="btn btn-info btn-medium">Contraseña nueva</a>
				<a class="btn btn-medium" href="<?php echo base_url('/panel/usuarios/') ?>" >Cancelar edicion</a>
			</div>	



		</fieldset>
	</form>

	
		</div>

	</div>
</div>

	<!-- Footer -->
	<?php $this->load->view('admin/helper/footer.php'); ?>
	
	</div> 
	<!-- End div class="wrapper container" -->

	<!-- Script solo para esta pagina -->
	<script type="text/javascript">
		$(document).ready(function(){
			$(".usuario").hide();
			$(".alert_re_pass").hide();
			$(".alert_re_pass, .usuario").css('width','68%');
			$("#edita_pass").hide();
			var valUsuario = ""

			$(function(){
				$("#idUsuario").focus(function(){
					var self = $(this);
					if(self.val() != "") return;
					var nombre = $("#idNombre").val();
					var apellido = $("#idApellido").val();
					if( nombre == "") return;
					if( apellido == "") return;
					nombre = nombre.substring(0,1);
					apellido = apellido.split(" ");
					var user = nombre + apellido[0];
					self.val(user);
					valUsuario = user;
					$(this).after("<span id='msgUsuario'  class='help-inline'> Este este es solo una sugerencia para el nombre de usuario, es libre de editarlo a su eleccion.</span>");	
					$("#grpIdUsuario").removeClass("error");
					$("#grpIdUsuario").removeClass("success");
					$("#grpIdUsuario").addClass("warning");
				});

				$("#idUsuario").focusout(function(){
					$("#grpIdUsuario").removeClass("warning");
					$("#msgUsuario").remove();	
				});

			});

			$(function(){
				$("#idUsuario").change(function(){
					var self = $(this);
					if(self.val() == "" || self.val() != valUsuario) {
						$(".msgUsuario").fadeOut('slow');	
					}
				});
			});

			$(function(){
			/*
				$('#frmAddUsuario').submit(function(){
					if( checkData == true ){
						$('#frmAddUsuario').submit();
						return true;
					}else{
						return false
					}
				});
			*/
			});

			function checkData(){
				// agregar validacion del lado del cliente
				return true;
			}

			$(function(){

				$('#btnEditarPass').click(function(e) {
					e.preventDefault();
					$('#edita_pass').toggle('slow', function() {
					 	$(".clsPass").val('');
					 	$("#pass").focus();
					});
				});

			}); 



		}); // End document ready
	</script>


</body>
</html>
