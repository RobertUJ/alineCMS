<?=$head?>
	<body>
		<?=$header?>
		<div class="wrapper container-fluid">
			<div id="panel_config" class="span10">
				<h2><?=$titulo_pagina?></h2>
				<form action="<?php echo base_url('panel/configuracion'); ?>" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
					<div>
						<label for="titulo">
							<h4>Título</h4>
						</label>
						<input type="text" name="titulo" value="<?=$titulo?>" />
						<label for="Logo">
							<h4>Logotipo</h4>
						</label>
						<input type="file" name="logo" value="<?=$logo?>" id="logo" />
						<input type="hidden" name="nuevo_logo" value="0" id="nuevo_logo">
						<?php $logotipo = "assets/img/" . $logo; ?>
						<labe>
							<h4>Proporciones de logotipo</h4>
						</label>
						Ancho: <input type="text" pattern="[0-9]{0,5}" title="Solo se permiten números" name="logo_ancho" class="span1 proporcion" value="<?=$logo_ancho?>" id="logo_ancho" /> Alto: <input type="text" pattern="[0-9]{0,5}" title="Solo se permiten números" name="logo_alto" class="span1 proporcion" value="<?=$logo_alto?>" id="logo_alto" /> Proporcional: <input type="checkbox" name="logo_proporcional" id="logo_proporcional" />
						<div>
							<img src="<?php echo base_url($logotipo); ?>" alt="<?php $titulo ?>" width="50" />
						</div>
						<label for="email">
							<h4>Email administrador</h4>
						</label>
						<input type="email" name="email" value="<?=$correo_admin?>" required />
						<label for="nombre_admin">
							<h4>Nombre del administrador</h4>
						</label>
						<input type="text" name="nombre_admin" value="<?=$nombre_admin?>" />
						<label for="template">
							<h4>Template predeterminado</h4>
						</label>
						<select name="template" id="template">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
						<label for="twitter">
							<h4>Twitter</h4>
						</label>
						<input type="text" name="twitter" value="<?=$twitter?>" />
						<label for="facebook">
							<h4>Facebook</h4>
						</label>
						<input type="text" name="facebook" value="<?=$facebook?>" />
						<label for="google">
							<h4>G+</h4>
						</label>
						<input type="text" name="google" value="<?=$google?>" />
						<label for="num_articulos">
							<h4>Número de artículos</h4>
						</label>
						<input type="number" name="num_articulos" value="<?=$num_articulos?>" />
						<label for="categoria">
							<h4>Categorías</h4>
						</label>
						<select name="categorias[]" id="categorias" multiple>
							<option value="--">Todas</option>
							<?php foreach($categorias_select->result() as $categoria){ ?>
								<option value="<?=$categoria->id?>"><?=$categoria->nombre?></option>
							<?php } ?>
						</select>
					</div>
					<div class="span3" id="botones">
						<input type="submit" class="btn btn-primary" value="Guardar">
						<button class="btn btn-danger">Cancelar</button>
					</div>
				</form>
			</div>
		</div>
		
		<script type="text/javascript">
			$(document).on("ready",function(){
				var plantilla = "<?php echo $plantilla ?>";
				var logo_ancho = $("#logo_ancho").val();
				if(plantilla){
					$("#template option[value=" + plantilla + "]").attr("selected","selected");
				}
				var categorias = "<?php echo $categorias ?>";

				if(categorias){
					categorias_ar = categorias.split("|");
					for(var i=0; i<categorias_ar.length; i++ )	{
						$("#categorias option[value="+categorias_ar[i]+"]").attr("selected","selected");
					}
				}
			});
			$("#logo").on("change",function(){
				$("#nuevo_logo").val("1");
				$(".proporcion").val("");
			});

			$("#logo_proporcional").on("change",function(){
				if($(this).is(":checked")){
					$(this).val("1");
					$("#logo_alto").attr("disabled","disabled").val("");
				}else{
					$(this).val("0");
					$("#logo_alto").removeAttr("disabled");
				}
			});
		</script>

	</body>