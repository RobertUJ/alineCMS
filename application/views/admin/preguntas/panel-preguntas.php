<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<aside id="menu_usuarios" class="span2">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
							<li class="active"><a href="<?php echo base_url('panel/preguntas/'); ?>" >Panel de preguntas</a></li>
							<li class=""><a href="<?php echo base_url('panel/preguntas/nueva_pregunta'); ?>" >Agregar Pregunta</a></li>
							<li class=""><a href="<?php echo base_url('panel/preguntas/nueva_categoria'); ?>" >Nueva Categoria</a></li>
						
						</ul>
					</div>
				</aside>
		
				<div id="body_content" class="span10 panel_usuarios">
					<div class="page-header">
						<h2>Panel de preguntas <small>Crea, edita y elimina preguntas </small></h2>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<a id="btn_crea_pregunta" class="btn btn-warning" href="<?php echo base_url('/panel/preguntas/nueva_pregunta'); ?>">Agregar Pregunta</a>
							<a id="btn_crea_categoria" class="btn btn-info" href="<?php echo base_url('/panel/preguntas/nueva_categoria'); ?>">Agregar Categoria</a>
						</div>
						<div class="span6">
							<label style="display:inline-block;" for="categoria">Filtrar por requerimiento</label>
							<select  name="categoria" id="catego">
								<?=$categorias ?>
							</select>
						</div>
					</div>				
					<hr/>
					<div id="preguntas_cont" class="row-fluid">
						<?=$preguntas?>
					</div>
				</div>

			</div>
		
		<!-- Footer -->
		<?php $this->load->view('admin/helper/footer.php'); ?>
	
	</div> 
	<!-- End div class="wrapper container-fluid" -->

	<script type="text/javascript">
		$("a[rel='tooltip']").tooltip();

		$(function(){
			$(".btndel").click(function(e){
				e.preventDefault();
				if(!confirm("Esta seguro que desea eliminar a esta pregunta?")) { 
 					return false;
				}
				var idUsr = $(this).attr('href');
				window.location.href=idUsr;
			});
		});


		$(function(){
			$("#catego").on("change",function(){
				var url = "<?php echo base_url('panel/preguntas/get_tabla_preguntas_por_requerimiento');?>";
				var idReq = $("#catego").val();
				if(idReq == 0){ 
					alert("Seleccione un requerimiento por favor.");
					return false;
				}else{
					url += "/" + idReq;
					$("#preguntas_cont").load(url);
				}
				
			});
		});


	</script>
</body>
</html>
