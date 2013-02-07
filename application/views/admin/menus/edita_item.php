<?=$head?>
<body>
	<?=$header?>
	<div class="wrapper container-fluid">
			<div class="row-fluid">
				<div id="body_content" class="span12">
					<div class="page-header">
						<h2><?=$titulo_pagina?> <small><?=$descripcion_pagina?></small></h2>
					</div>

						<div class="accordion" id="accordion2">
							<div class="accordion-group">
							  <div class="accordion-heading">
							    <a id='paso_1' class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
							      <h4>Paso No. 1</h4>
							    </a>
							  </div>
							  <div id="collapseOne" class="accordion-body in collapse" style="height: auto; ">
							    <div class="accordion-inner">
						    		<h4>1.- Selecciona el tipo de elemento:</h4>
						    		<?php 
						    		$pagina="";$blog="";$articulo="";$inicio="";$contacto="";$url_directa="";
						    		switch ($row->tipo) {
						    			case 3:
						    				$pagina="selected";
						    				break;
							    		case 5:
						    				$blog="selected";
						    				break;
							    		case 4:
						    				$articulo="selected";
						    				break;
							    		case 1:
						    				$inicio="selected";
						    				break;
							    		case 2:
						    				$contacto="selected";
						    				break;
							    		case 6:
						    				$url_directa="selected";
						    				break;
						    		
						    		}
						    		?>
						    		<input type="hidden" name="idItem" value="<?=$row->idItem?>" id="idItem">
									<select id="sel_tipo" style="margin-top:10px;" name="tipo">
										<option value='0'>Selecciona el tipo</option>
										<option value='3' <?=$pagina?> >Página</option>
										<option value='5' <?=$blog?> >Blog</option>
										<option value='4' <?=$articulo?> >Articulo de Blog</option>
										<option value='1' <?=$inicio?> >Inicio</option>
										<option value='2' <?=$contacto?> >Contacto</option>
										<option value='6' <?=$url_directa?> >URL Directa</option>
									</select>
							    </div>
							  </div>
							</div>
							<div class="accordion-group">
							  <div class="accordion-heading">
							    <a id='paso_2' class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
							      <h4>Paso No. 2</h4>
							    </a>
							  </div>
							  <div id="collapseTwo" class="accordion-body collapse" style="height: 0px; ">
							    <div  class="accordion-inner">
							    		<div class='span4'>
								    		<h4>Ingresa el titulo para el item del menu.</h4><br>
								    		<label for="titulo">Titulo para el Item</label>
								    		<input neme="titulo" id="titulo" type="text" value="<?=$row->titulo?>">
								    		
								    		<fieldset>
									    		<label>Id y clases para css</label>	
									    		<label for="id_css">Id(s)</label>
									    		<input neme="id_css" id="id_css" type="text" value="<?=$row->id_css?>">
									    		
									    		<label for="clase">Clase(s)</label>
									    		<input neme="clase" id="clase" type="text" value="<?=$row->clase?>">
								    		</fieldset>
								    		<?php
								    			$extra_log_si="";$extra_log_no="";
								    			switch ($row->is_logged) {
								    				case 'si':
								    					$extra_log_si = "selected";
								    					break;
								    				case 'no':
								    					$extra_log_no = "selected";
								    					break;
								    												    				
								    			}
								    		?>
								    		<label for="islogged">Es necesario que el usuario inicie sesión?</label>
								    		<select name="islogged" id="islogged">
								    			<option value="no" <?=$extra_log_no?> >No</option>
								    			<option value="si" <?=$extra_log_si?> >Si</option>
								    		</select>
								    		<label for="islogged">Atributos extras</label>
								    		<input type="text" name="atributos" id="atributos" value="<?=$row->atri?>">
								    		<div style="clear:both;"></div>	
							    		</div>

							    		<div class='span6'>
							    	
								    		<h5>Selecciona el padre del elemento.</h5>
								    		<?=$padres;?>
								    	</div>	
								    	<div style="clear:both;"></div>
								    	<button class="sig_paso btn" sigbtn="paso_3">Siguiente Paso</button>
							    	
							    	<div style="clear:both;"></div>	
								    	<div id="alerta_1" class="alert" style="width:30%; margin-top:5px; display:none;">
							            	<button type="button" class="close" data-dismiss="alert">×</button>
								            <h4 class="alert-heading">Aline CMS</h4>
								            <p>Ingresa un titulo para el item del menu</p>
								      	</div>

							    </div>
							  </div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a id='paso_3' class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
									  <h4>Paso No. 3</h4>
									</a>
								</div>
									<div id="collapseThree" class="accordion-body collapse" style="height: 0px; ">
									<div class="accordion-inner">
									    	
									    	<h4 id="MensajePaso3">Selecciona la pagina a enlazar.</h4><br>
									    	<div id="cont_tipo"></div>
									      	<div style="clear:both;"></div>
									      	<div id="divUrl" style="display:none;">
									      		<label>Ingresa la url</label>
									      		<input class="" type="text" id="url" name="url" value="<?=$row->url?>">
									      	</div>
									      	<div style="clear:both;"></div>
									      	<button id="btnCreaItem" class="btn btn-warning">Guardar</button>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
		<!-- Footer -->
		<?php $this->load->view('admin/helper/footer.php'); ?>
	</div> 
</body>
<script type="text/javascript">
var postID = 0;
	$(document).ready(function(){
		

		$(function(){

			$("#sel_tipo").on("change",function(e){
				e.preventDefault();
				var mTipo = $(this);
				var valor_tipo = mTipo.val();

				if(valor_tipo == '0'){ 
					alert("Seleccione un tipo por favor"); 
					mTipo.focus(); 
					return false; 
				}

				switch(valor_tipo){
					case "3":
						$("#divUrl").hide();
						$("#cont_tipo").load("<?php echo base_url('panel/menus/get_paginas/2');?>");
						$("#paso_2").click();
					break;
					case "4":
						$("#divUrl").hide();
						$("#cont_tipo").load("<?php echo base_url('panel/menus/get_paginas/1');?>");
						$("#paso_2").click();
					break;
					case "5":
						$("#divUrl").hide();
						$("#cont_tipo").html("");
					break;
					case "1":
						$("#divUrl").hide();
						$("#cont_tipo").html("");
					break;
					case "2":
						$("#divUrl").hide();
						$("#cont_tipo").html("");
					break;
					case "6":
						$("#cont_tipo").html(""); 
						$("#divUrl").show();
					break;
				}


			}); // End Click
		}); // End Function anonima
	

		$(".btnSel").live("click",function(e){
			e.preventDefault();
			$(".btnSel").removeClass("badge-success");
			$(this).addClass("badge-success");


			var mId = $(this).attr("id_post");
			$("tr").css("font-weight","normal");
			$("#mf_"+ mId).css("font-weight","bold");

			postID = mId;
		})

		$(".btnSeltr").live("click",function(e){
			e.preventDefault();
			$(".btnSel").removeClass("badge-success");
			$("i").removeClass("icon-ok-sign").addClass("icon-asterisk");

			$(this).find(".btnSel:first").addClass("badge-success");

			
			$(this).find(".btnSel:first > i").removeClass("icon-asterisk");
			$(this).find(".btnSel:first > i").addClass("icon-ok-sign");

			var mId = $(this).find(".btnSel:first").attr("id_post");
			$("tr").css("font-weight","normal").removeClass("green");
			$(this).css("font-weight","bold").addClass("green");
			postID = mId;
		})

		$(".sig_paso").on("click",function(e){
			e.preventDefault();
			if($("#titulo").val() == ""){ 
				$("#alerta_1").fadeIn('slow').delay(2000).fadeOut('slow');
				return false;
			}
			var sig = $(this).attr("sigbtn");
			$("#"+sig).click();
		});


		$(".clPadre").on('click',function(){
			$(".clPadre").removeClass('padre_sel');
			$(this).addClass('padre_sel');
		});

		$("#btnCreaItem").on("click",function(){
			var vidMenu = "<?=$menu_id?>";
			var vidPost = $(".badge-success").attr("id_post");
			var vTitulo = $("#titulo").val(); 
			var vPadre  = $("#menuPadres").find('.padre_sel').attr("idItem");
			var vidTipo = $("#sel_tipo").val();
			var vOrden  = 0;
			var vid_css = $("#id_css").val();
			var vclase = $("#clase").val();
			var visLogged = $("#islogged").val();
			var vatributos = $("#atributos").val();
			var vUrl = $("#url").val();
			//var orden = $("#orden").val();
			if(vPadre == undefined){
				vPadre = 0;
			}

			var idItem = <?php echo $row->idItem ?>;

			var vDatos = "idmenu="+ vidMenu +"&idpost="+ vidPost +"&titulo="+ vTitulo+"&padre="+vPadre+"&tipo="+vidTipo+"&orden="+vOrden+"&id_css="+vid_css+"&clase="+vclase+"&misLogged="+visLogged+"&atributos="+vatributos+"&murl="+vUrl+"&idItem="+idItem;
			//alert(vDatos);

			$.ajax({
				type: "POST",
				url: "<?php echo base_url('panel/menus/edita_item_menu')?>" ,
				data: vDatos,
				success: function(datos){
					alert("El elemento se guardo satisfactoriamente.");
					location.href="<?php echo base_url('panel/menus') ?>";
				}
			});

		});





		$(".alert").alert();
	});// End Ready document
</script>
</html>
