<?=$head?>
<body>
	<?=$header?>
<div class="wrapper container-fluid">
<div class="row-fluid">
	<aside id="menu_usuarios" class="span2">
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
				<li class=""><a href="<?php echo base_url('panel/menus'); ?>" >Panel de menús</a></li>
				<li class="active"><a href="<?php echo base_url('panel/menus/crea_menu'); ?>" >Agregar menú nuevo</a></li>
			</ul>
		</div>
	</aside>
		
<div id="body_content" class="span10 panel_usuarios">
	<div class="page-header">
		<h2><?=$titulo_pagina?> <small> <?=$descripcion_pagina?></small></h2>
	</div>
<div class="row-fluid">
<!-- ***************** Formulario para crear nuevo articulo  *************** -->

<div class="span5">
	<form method="POST" action="<?php echo base_url('panel/menus/guarda_menu') ?>" name="frmArticuloNuevo" id="frmAddArticulo" class="form-horizontal">
	<?php echo validation_errors('<div class="error"><span class="label label-important">', '</span></div>'); echo '<br/>'; ?>
			<fieldset>
				<label for="titulo">Titulo del Menu</label>
				<input type="text" name='titulo' id='titulo' class="" value="<?php echo set_value('titulo'); ?>" >

				<label for="titulo">Descripción</label>
				<textarea name="descripcion"><?php echo set_value('descripcion');?></textarea>

				<label for="titulo">Id para el menu</label>
				<input type="text" name='id_css' id='id_css' class="" value="<?php echo set_value('id_css'); ?>" >

				<label for="titulo">Clase para el menu</label>
				<input type="text" name='clase' id='clase' class="" value="<?php echo set_value('clase'); ?>" >

				<label for="titulo">Atributos extra</label>
				<input type="text" name='atributo' id='atributo' class="" value="<?php echo set_value('atributo'); ?>" >
			
				<label for="id_post">Seleccione las paginas a asignar<br/> (Presione Ctrl para seleccionar mas de una opción)</label>
				<select class="" name="id_post[]" id="id_post" multiple>
					<?=$paginas?>
				</select>

			</fieldset>

	<br/>

	<div style="padding-left:20px;" class="form-actions">
	    <input  type="submit" class="btn btn-primary" name="btnGuardar" value="Agregar nuevo menú" />
	</div>

	</form> <!-- Fin formulario para crear nuevo articulo -->
 </div>

<div class="span5">
	<?=$menus?>
</div>



</div>  <!-- Fin Row fluid  contenedor del form-->
</div>	<!-- Fin body_content -->
		
		<!-- Footer -->
		<?php $this->load->view('admin/helper/footer.php'); ?>
</div> <!-- Row fluid general" -->
</div>	<!-- End div class="wrapper container" -->

	<script type="text/javascript">
		$("a[rel='tooltip']").tooltip();

		$(function(){
			$(".btndel").click(function(e){
				e.preventDefault();
				if(!confirm("Esta seguro que desea eliminar a este menú?")) { 
 					return false;
				}
				var idUsr = $(this).attr('href');
				window.location.href=idUsr;
			});
		});
		

	</script>
</body>
</html>
