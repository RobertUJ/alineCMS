<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<aside id="menu_usuarios" class="span2">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
							<li class="active"><a href="<?php echo base_url('panel/menus'); ?>" >Panel de menús</a></li>
							<li class=""><a href="<?php echo base_url('panel/menus/crea_menu'); ?>" >Agregar menú nuevo</a></li>
						</ul>
					</div>
				</aside>
		
				<div id="body_content" class="span10 panel_usuarios">
					<div class="page-header">
						<h2>Menús <small>Crea edita y elimina menus de navegación</small></h2>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<a id="btn_crea_usuario" class="btn btn-warning" href="<?php echo base_url('panel/menus/crea_menu'); ?>">Nuevo Menu</a>
						</div>
						<div class="span6">
							<div id="cont_perfiles"></div>	
						</div>
					</div>				
					<hr/>
					<div class="row-fluid">
						<div class="span7">
							<h2>Menus</h2>
							<?=$menus?>
						</div>
						<div class="span5">
							<h2>Items del menu:</h2><h2 id="nombre_menu"></h2>
							
						</div>
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
