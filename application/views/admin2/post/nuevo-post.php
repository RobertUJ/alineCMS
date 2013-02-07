<?=$head?>
<?php echo ck_includes(); ?>
<body>
	<?=$header?>
<div class="wrapper container-fluid">
<div class="row-fluid">
	<aside id="menu_usuarios" class="span2">
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
				<li class=""><a href="<?php echo base_url('panel/post/'); ?>" >Panel</a></li>
				<li class="active"><a href="<?php echo base_url('panel/post/crea_articulo'); ?>" >Agregar articulo nuevo</a></li>
			</ul>
		</div>
	</aside>
		
<div id="body_content" class="span10 panel_usuarios">
	<div class="page-header">
		<h2><?=$titulo_pagina?> <small> <?=$descripcion_pagina?></small></h2>
	</div>
<div class="row-fluid">
<!-- ***************** Formulario para crear nuevo articulo  *************** -->
<form method="POST" action="<?php echo base_url('panel/post/guarda_articulo') ?>" name="frmArticuloNuevo" id="frmAddArticulo" class="form-horizontal">
<div class="span8">
<?php echo validation_errors('<div class="error"><span class="label label-important">', '</span></div>'); echo '<br/>'; ?>
		<fieldset>
				<label><h4>Titulo</h4><em></em></label>
				<input placeholder="Ingresa el titulo aquí"   name="titulo" value="<?php echo set_value('titulo'); ?>" type="text" id="idtitulo" class="span9 focus">
				<br/>
				<label><h4>Slug</h4><em></em></label>
				<input placeholder='Ingresa "slug" aquí'   name="slug" value="<?php echo set_value('slug'); ?>" type="text" id="idslug" class="span5">
				<p class="help-block">El slug, es el nombre del titulo en texto simple y sin espacios</p>
				<br/>

				<label><h4>Contenido</h4><em></em></label>
				<textarea name="contenido"  placeholder="Ingresa aquí el contenido de tu artículo" class="span10" id="ckeditor" rows="15" >
				<?php echo set_value('contenido'); ?>
				</textarea>
				<?php $ck_config = array(     
					"replace" => "#ckeditor" // selector del objeto a reemplazar     
					, "options" => ck_options()     
				);
				echo jquery_ckeditor($ck_config); ?>
		</fieldset>
</div>
<div class="span4">

	<div class="well">
	<label><strong><h4>Seleccione una categoría</h4></strong><em></em></label>
	<?=$categorias?>
	<p class="help-block">Categoría del artículo</p>
	</div>

	<div class="well">
	<label><strong><h4>Etiquetas</h4></strong><em></em></label>
	<input name="etiquetas" value="<?php echo set_value('etiquetas'); ?>" type="text" class="span12" placeholder="Inserta las etiquetas aquí...">
	<p class="help-block">Separa con comas cada etiqueta.</p>
	</div>

	<div class="well">
	<input style="margin-left:10px;" class="btn btn-primary btn-medium" type="submit" name="btnGuardar" value="Agregar nuevo articulo"/>
	</div>

</div>
</form> <!-- Fin formulario para crear nuevo articulo -->
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
				if(!confirm("Esta seguro que desea eliminar a este articulo?")) { 
 					return false;
				}
				var idUsr = $(this).attr('href');
				window.location.href=idUsr;
			});
		});

		$(function(){
			$("#idslug").focus(function(){
				var slug = $("#idtitulo").val();
				$(this).val(convertToSlug(slug));
			});
		});


		function convertToSlug(Text)
		{
		    return Text
		        .toLowerCase()
		        .replace(/ /g,'-')
		        .replace(/[^\w-]+/g,'')
		        ;
		}


		function makeSlug(slugcontent)
		{
		    // convert to lowercase (important: since on next step special chars are defined in lowercase only)
		    slugcontent = slugcontent.toLowerCase();
		    // convert special chars
		    var   accents={a:/\u00e1/g,e:/u00e9/g,i:/\u00ed/g,o:/\u00f3/g,u:/\u00fa/g,n:/\u00f1/g}
		    for (var i in accents) slugcontent = slugcontent.replace(accents[i],i);

			var slugcontent_hyphens = slugcontent.replace(/\s/g,'-');
			var finishedslug = slugcontent_hyphens.replace(/[^a-zA-Z0-9\-]/g,'');
		    finishedslug = finishedslug.toLowerCase();
		    return finishedslug;
		}

	</script>
</body>
</html>
