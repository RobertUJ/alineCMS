<?php $this->load->view('admin/helper/head.php'); ?>
<body>
<?php $data['menu_usuarios'] = "active"; $this->load->view('admin/helper/header', $data); ?>


	<div class="wrapper container-fluid">
		<div class="row-fluid">
			<aside class="span2">
				<div class="tabbable tabs-left">
					<ul class="nav nav-tabs">
						<li class=""><a href="<?php echo base_url('panel/preguntas/'); ?>" >Panel de preguntas</a></li>
						<li class=""><a href="<?php echo base_url('panel/preguntas/nueva_pregunta'); ?>" >Agregar Pregunta</a></li>
						<li class="active"><a href="<?php echo base_url('panel/preguntas/nueva_categoria'); ?>" >Nueva Categoria</a></li>
					</ul>
				</div>
			</aside>
		
	<div id="body_content" class="span5">
	
	<form method="POST" action="<?php echo base_url('panel/preguntas/crea_categoria') ?>" name="" id="frmAddUsuario" class="form-horizontal">
		<fieldset>
		<legend>Agregar nueva categoria </legend>
			
			<?php echo validation_errors('<div style="margin:5px!important;"><span class="label label-important">', '</span></div>'); ?>	
			<?php if(isset($save_true)) ?>
			
			<?php if(isset($save_true)): ?>
			<div style='margin:5px!important;'><span class='label label-success'><?=$save_true?></span>
			<p><span class="label label-info">Puede seguir capturando categorias.</span></p></div>
			<?php endif;?>
			

			<br>
			<div class="control-group">
			<label for="idrequerimiento" class="control-label">Requerimiento <em>(*)</em></label>
			<div class="controls">
				<input name="requerimiento" value="<?php echo set_value('requerimiento'); ?>" type="text" id="idrequerimiento" class="span2 txt" autofocus>
			</div>
			</div>

			<div class="control-group">
			<label for="idcategoria" class="control-label">Categoria <em>(*)</em></label>
			<div class="controls">
				<textarea row-fluids="8"   name="categoria" id="idcategoria" class="span12 txt">
					<?php echo set_value('categoria'); ?>
				</textarea>
			</div>
			</div>


			<div class="form-actions">
				<input style="margin-left:10px;" class="btn btn-primary btn-medium" type="submit" name="btnGuardar" value="Agregar nueva categoria"/>
				<button id='btnLimpiar' class="btn">Limpiar</button>
			</div>	
		</fieldset>
	</form>

	
	</div>
	<div  style="padding-top:40px;" class="span5">

		<?=$categorias?>
	</div>

	</div>
		
	<!-- Footer -->
	<?php $this->load->view('admin/helper/footer.php'); ?>
	
	</div> 

	<script type="text/javascript">
		$("a[rel='tooltip']").tooltip();

		$(function(){
			$(".btndel").click(function(e){
				e.preventDefault();
				if(!confirm("Esta seguro que desea eliminar a esta categoria? Se eliminaran todas las preguntas relacionadas con esta categoria.")) { 
 					return false;
				}
				var idUsr = $(this).attr('href');
				window.location.href=idUsr;
			});
		});


		$("#btnLimpiar").live("click" , function(e){
			e.preventDefault();
			$(".txt").val("");
			$(".txt:first").focus();
		});


		<?php if(isset($save_true)): ?>
			$(".txt").val("");
			$(".txt:first").focus()
			$(".label").show().delay(5000).fadeOut('slow');
		<?php endif;?>



	</script>

</body>
</html>
