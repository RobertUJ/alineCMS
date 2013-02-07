<?=$head?>
<body>
<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<div id="body_content" class="span12">

				<div class="page-header">
					<h1>Panel de administración <small></small></h1>
				</div>
				      
				      <div id="content_escritorio" style="margin:0 auto;">
				      <ul class="thumbnails">
				        <li class="span3">
				          <div class="thumbnail">
				          	<a href="<?php echo base_url('panel/usuarios'); ?>">
				          		<div class="cont_ico">
					           		<img src="<?php echo base_url('assets/admin/img/ico/retina/man_64.png');?>" alt="">
					            </div>
				        	</a>
				            <div class="caption">
				              <h4 class="label label-info" style="text-align:center;">USUARIOS</h4>
				              <p class="info" style="text-align:center; ">Accede al panel de administración de usuarios, en el podras crear nuevos usuarios, editar los ya existentes, activarlos despues de el pago correspondiente e incluso hasta eliminarlos.</p>
				            </div>
				          </div>
				        </li>
				        <li class="span3">
				          <div class="thumbnail">
				          	<a href="<?php echo base_url('panel/post'); ?>">
				          		<div class="cont_ico">
					           		<img src="<?php echo base_url('assets/admin/img/ico/retina/pencil_64.png');?>" alt="">
					            </div>
				        	</a>
				            <div class="caption">
				              <h4 class="label label-info" style="text-align:center;">BLOG</h4>
				              <p class="info" style="text-align:center;">Accede al panel de administración del blog plasma en texto tu creatividad, o informa a tu publico de las ultimas noticias de tu sitio web. Crea, edita o elimina articulos de tu blog.</p>
				            </div>
				          </div>
				        </li>

				        <li class="span3">
				          <div class="thumbnail">
				          	<a href="<?php echo base_url('panel/post/panel_paginas'); ?>">
				          		<div class="cont_ico">
					           		<img src="<?php echo base_url('assets/admin/img/ico/retina/document_64.png');?>" alt="">
					            </div>
				        	</a>
				            <div class="caption">
				              <h4 class="label label-info" style="text-align:center;">PAGINAS</h4>
				              <p class="info" style="text-align:center;">Accede al panel de administración del blog plasma en texto tu creatividad, o informa a tu publico de las ultimas noticias de tu sitio web. Crea, edita o elimina articulos de tu blog.</p>
				            </div>
				          </div>
				        </li>

				        <li class="span3">
				          <div class="thumbnail">
				          	<a  href="<?php echo base_url('panel/menus'); ?>">
				          		<div class="cont_ico">
					           		<img src="<?php echo base_url('assets/admin/img/ico/retina/paper_plane_64.png');?>" alt="">
					            </div>
				        	</a>
				            <div class="caption">
				              <h4 class="label label-info" style="">MENUS</h4>
			          	      <p class="info" style="text-align:center;padding:10px 0px; ">Accede al panel de administración de Ménus, aquí podras crear, editar y eliminar nuevos items para todos los menus diponibles en tu sitio web.</p>
				            </div>
				          </div>
				        </li>

				      </ul>
			      	<ul class="thumbnails">
				        <li class="span3">
				          <div class="thumbnail">
				          	<a href="<?php echo base_url('panel/banners'); ?>">
				          		<div class="cont_ico">
					           		<img src="<?php echo base_url('assets/admin/img/ico/retina/man_64.png');?>" alt="">
					            </div>
				        	</a>
				            <div class="caption">
				              <h4 class="label label-info" style="text-align:center;">BANNERS</h4>
				              <p class="info" style="text-align:center; ">Accede al panel de administración de Banners, aquí podras crear, editar y eliminar Banners.</p>
				            </div>
				          </div>
				        </li>
				        <li class="span3">
				          <div class="thumbnail">
				          	<a href="<?php echo base_url('panel/configuracion'); ?>">
				          		<div class="cont_ico">
					           		<img src="<?php echo base_url('assets/admin/img/ico/retina/gear_64.png');?>" alt="">
					            </div>
				        	</a>
				            <div class="caption">
				              <h4 class="label label-info" style="text-align:center;">Configuración</h4>
				              <p class="info" style="text-align:center; ">Cambia la configuración del sitio.</p>
				            </div>
				          </div>
				        </li>
				    </ul>
				  </div>
				</div>
			</div>
		<!-- Footer -->
		<?=$footer?>
	</div> 
	<!-- End div class="wrapper container" -->

	<script type="text/javascript">
	$(".info").hide().addClass("alert alert-info");
	$(document).ready(function(){
		$(".span3").addClass("animated bounceInDown");
	});
	
	$(document).ready(function(){
		$(".span3").live("mouseenter", function(){
			//alert("entro");
			var division = $(this);
			$(this).find(".info").fadeIn("slow",function(){
				division.find("img").addClass("animated bounce");
			});
		});

		$(".span3").live("mouseleave",function(){
			var division = $(this);
			$(this).find(".info").hide();
			division.find("img").removeClass("animated bounce");
		});

	});
	</script>
</body>
</html>
