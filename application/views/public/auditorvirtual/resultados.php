<?=$head?>

  <body>
    <?php $data['menuactivo'] = '_3'; $this->load->view('/public/helper/menu_logged' , $data); ?>
    <br/>
    <div class="container">
      <div class="row">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Menu Auditor Virtual</li>
              <li ><a  href="#">Cómo Aplicar la Auditoría?</a></li>
              <li  ><a href="<?php echo base_url(); ?>">Aplicar Auditoría Virtual</a></li>
              <li class="active"><a href="<?php echo base_url('inicio/resultados_historicos'); ?>">Resultados Históricos</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="page-header">
            <h2>Resultados Historicos para el usuario: <small> <?php echo $this->session->userdata('nombre') . " " . $this->session->userdata('apellidos'); ?></small></h2>
          </div>
          Selecciona el folio de los resultados historicos que deseas consultar.
          <select id="idFolio" name="folio">
            <option value="0">Selecciona un folio</option>  
            <option value="1">02-06-2012 Folio:1</option>  
          </select>	

	    	  <a href="#" id="btnRespuestas" class="btn btn-info" >Ver respuestas de cuestionario.</a>
          <a href="#" id="btnEscondeResp" style="display:none;" class="btn btn-info" >Esconder Respuestas.</a>
          <a href="#" id="btnGrafica" class="btn btn-info" >Ver grafico de respuestas.</a>

          <div style="display:none;"id="respuestas" class="span12">
          	<?=$resultados?>
          </div>
          <div style="display:none;"id="graficas" class="span12">
            <h2>Graficas de resultados y respuetas</h2>
          	<br/>
          	<?=$grafico?>
          </div>
          <hr/>

          
        </div><!--/span-->
      </div><!--/row-->

      <hr>

   

    </div><!--/.fluid-container-->

<?=$footer?>

<script type="text/javascript">
gvChartInit();
$(document).ready(function(){


	$("#btnRespuestas").click(function(){
		$("#respuestas").fadeIn('slow');
		$(this).hide();
		$("#btnEscondeResp").show();

	});
	$("#btnEscondeResp").click(function(){
		$("#respuestas").fadeOut('slow');
		$(this).hide();
		$("#btnRespuestas").show();
	});

	$("#btnGrafica").click(function(){
		$("#graficas").fadeIn('slow');
	});


	jQuery('#pie').gvChart({
		chartType: 'PieChart',
		gvSettings: {
			vAxis: {title: 'Respuestas'},
			hAxis: {title: 'Resultados'},
			width: 720,
			height: 300
			}
	});


	jQuery('#barras').gvChart({
	chartType: 'ColumnChart',
	gvSettings: {
	    vAxis: {title: 'No de Respuestas'},
	    hAxis: {title: 'Categorias'},
	    width: 720,
	    height: 300,
	    }
	});

  $(function(){
    $("#idFolio").live("change",function(){
      var folio = $(this).val();
        $("#btnRespuestas").val("Ver respuestas de cuestionario del folio No. " + folio);
        $("#btnGrafica").val("Ver graficos de respuestas del cuestionario con No. de folio: " + folio);
        if(folio == '0'){
          $("#btnRespuestas").val("Ver respuestas de cuestionario");
          $("#btnGrafica").val("Ver grafico de respuestas");
        }
    });
  })

});
</script>
  </body>
</html>
