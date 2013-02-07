<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<aside id="menu_usuarios" class="span2">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
							<li class="active"><a href="<?php echo base_url('panel/post/'); ?>" >Panel de articulos</a></li>
							<li class=""><a href="<?php echo base_url('panel/post/crea_articulo'); ?>" >Agregar articulo nuevo</a></li>
						</ul>
					</div>
				</aside>
		
				<div id="body_content" class="span10 panel_usuarios">
					<div class="page-header">
						<h2>Articulos <small>Crea, edita y elimina nuevos articulos</small></h2>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<a id="btn_crea_usuario" class="btn btn-warning" href="<?php echo base_url('/panel/post/crea_articulo'); ?>">Agregar Nuevo</a>
						</div>
						<div class="span6">
							<div id="cont_perfiles"></div>	
						</div>
					</div>				
					<hr/>
					<div class="row-fluid">
						<?=$articulos?>
					</div>
				</div>

			</div>
		
		<!-- Footer -->
		<?php $this->load->view('admin/helper/footer.php'); ?>
	
	</div> 
	<!-- End div class="wrapper container" -->

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



	</script>
</body>
</html>
