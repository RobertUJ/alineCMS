<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<aside id="menu_usuarios" class="span2">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
							<li class=""><a href="<?php echo base_url('panel/catalogo'); ?>" >Panel de catálogos</a></li>
							<li class=""><a href="<?php echo base_url('panel/catalogo/crea_catalogo'); ?>" >Administrar Catálogos</a></li>
							<li class=""><a href="<?php echo base_url('panel/catalogo/crea_categoria'); ?>" >Administrar Categorías</a></li>
							<li class="active"><a href="<?php echo base_url('panel/banners/crea_banner'); ?>" >Administrar Banners</a></li>
						</ul>
					</div>
				</aside>
				<div id="body_content" class="span10 panel_usuarios">
					<div class="page-header">
						<h2>Banners <small>Crea, edita y elimina banners</small></h2>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<a id="btn_crea_banner" class="btn btn-warning" href="<?php echo base_url('panel/banners/crea_banner'); ?>">Nuevo Banner</a>
						</div>
					</div>
					<hr/>
					<div class="row-fluid">
						<div class="span6">
							<h2>Banners</h2>
							<?=$banners?>
							<!--?=$catalogos?-->
						</div>
						<!--div id="cont_items_menu" class="span6">
							<h2>Elementos del catálogo:</h2><h2 id="nombre_menu"></h2>
							<div class='' id="items_menu_div"></div>
						</div-->
					</div>
				</div>
			</div>
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> 
	<!-- End div class="wrapper container" -->
<script type="text/javascript">
		
		$(function(){
			$(".btndel").click(function(e){
				e.preventDefault();
				if(!confirm("Esta seguro que desea eliminar a este producto?")) { 
 					return false;
				}
				var idUsr = $(this).attr('href');
				window.location.href=idUsr;
			});
		});
		
		$(".ver_items").on("click",function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			$("#items_menu_div").html("<img src='<?php echo base_url('assets/admin/img/139.gif');?>' >"); 
			$("#items_menu_div").load(href);
		});

		$("a[rel='tooltip']").tooltip();

		$(function(){
			$(".cont_items_first").live("mouseover",function(){
				$("a.item_link").hide();
				var div = $(this).find("div.cont_act");
				div.find("a.item_link").show();
			});
			$(".cont_items_first").live("mouseout",function(){
				$("a.item_link").hide();
			});

		});


		$(function(){
			$(".act_eliminar").live("click",function(e){
				e.preventDefault();
				var valorId = $(this).closest("div.cont_items_first").find("a.clPadre:first").attr("iditem");
				var answer = confirm("Esta seguro que desea eliminar definitivamente este elemento?")
				if (answer){
					$.post("<?php echo base_url('panel/menus/borrar_item'); ?>", { id: valorId});
					$(this).closest("li").remove();
				}				
			});
		});

		$(function(){
			$(".act_activar").live("click",function(e){
				e.preventDefault();
				var icono = $(this).find("i");
				var valorInicial = $(this).attr("estado");
				var idItem = $(this).closest("div.cont_items_first").find("a.clPadre:first").attr("iditem");
				var dirFuncion = "<?php echo base_url('panel/menus/activa_item') ?>";
				$.post(dirFuncion, { estado: valorInicial,idItem:idItem});
				if(valorInicial == 1){
					icono.addClass("icon-thumbs-down");
					icono.removeClass("icon-thumbs-up");
					$(this).attr("estado","0");
					$(this).closest("div.cont_items_first").find("a.clPadre:first").css("color","gray");
				}else{
					icono.addClass("icon-thumbs-up");
					icono.removeClass("icon-thumbs-down");
					$(this).attr("estado","1");
					$(this).closest("div.cont_items_first").find("a.clPadre:first").css("color","#08C");
				}				
								
			});
		});
</script>
</body>
</html>
