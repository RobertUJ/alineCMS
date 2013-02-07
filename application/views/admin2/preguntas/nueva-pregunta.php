<?=$head?>
<body>
<?=$header?>

	<div class="wrapper container-fluid">
		<div class="row-fluid">
			<aside class="span2">
				<div class="tabbable tabs-left">
					<ul class="nav nav-tabs">
						<li class=""><a href="<?php echo base_url('panel/preguntas/'); ?>" >Panel de preguntas</a></li>
						<li class="active"><a href="<?php echo base_url('panel/preguntas/nueva_pregunta'); ?>" >Agregar Pregunta</a></li>
						<li class=""><a href="<?php echo base_url('panel/preguntas/nueva_categoria'); ?>" >Nueva Categoria</a></li>
					</ul>
				</div>
			</aside>
		
	<div id="body_content" class="span10">
	
	

	<form method="POST" action="<?php echo base_url('panel/preguntas/crea_pregunta') ?>" name="" id="frmAddUsuario" class="form-horizontal">
		<fieldset>
		<legend>Agregar nueva pregunta <small> </small></legend>
			<?php echo validation_errors('<div style="margin:5px!important;"><span class="label label-important">', '</span></div>'); ?>	
			<?php if(isset($save_true)) echo "<div style='margin:5px!important;'><span class='label label-success'>" . $save_true ."</span></div>"?>
			<div class="control-group">
			<label for="idNombre" class="control-label">Categoria <em>(*)</em></label>
			<div class="controls">
				<select class="input-xlarge" name="categoria">
					<?=$categorias?>
				</select>

			</div>
			</div>

			<div class="control-group">
			<label for="idpregunta" class="control-label">Pregunta <em>(*)</em></label>
			<div class="controls">
				<input name="pregunta" value="<?php echo set_value('pregunta'); ?>" type="text" id="idpregunta" class="input-xlarge">
			</div>
			</div>


			<div class="form-actions">
				<input style="margin-left:10px;" class="btn btn-primary btn-medium" type="submit" name="btnGuardar" value="Agregar nueva pregunta"/>
			</div>	
		</fieldset>
	</form>

	
		</div>

	</div>
		
	<!-- Footer -->
	<?php $this->load->view('admin/helper/footer.php'); ?>
	
	</div> 



</body>
</html>
