<?=$head?>
  <body>
    <?php $data['menuactivo'] = '_3'; $this->load->view('/public/helper/menu_logged', $data); ?>
    
    <div class="container">
      <br/>
      <div class="row">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">MENU AUDITOR VIRTUAL</li>
              <li ><a  href="#">Cómo Aplicar la Auditoría?</a></li>
              <li  class="active"><a href="<?php echo base_url(); ?>">Aplicar Auditoría Virtual</a></li>
              <li><a href="<?php echo base_url('inicio/resultados_historicos'); ?>">Resultados Históricos</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="page-header">
            <h2>Auditoría para el usuario: <small> <?php echo $this->session->userdata('nombre') . " " . $this->session->userdata('apellidos'); ?></small></h2>
          <strong><h6>Infografia:</h6> Total reactivos <span class='badge badge-inverse' ><?=$totalreactivos?></span> | Total reactivos con respuesta <span class='badge badge-info' ><?=$totalrespuestas?></span> | Total reactivos sin respuesta <span class='badge badge-important' ><?=$totalsinrespuesta?></span></strong>
          

          </div>
          <form action="<?php echo base_url('inicio/procesa_resultado');?>" method="post" name="frmPreguntas" id="frmPreguntas">
          <?=$preguntas?>
          <input type="hidden" name="procesa" value="0" id="procesa" >
          <div style="text-align:center;" class="form-actions">
            
            <input value="Procesa Cuestionario" type="submit" class="btn btn-warning " name="btnProcesa" id="btnProcesa"/>
            <input value="Guardar respuestas" type="submit" class="btn btn-primary " name="btnGuarda" id="btnGuarda"/>
            
          </div>
          </form>
          
        </div><!--/span-->
      </div><!--/row-->
      <hr>
    
    </div><!--/.fluid-container-->

    <?=$footer?>

<script type="text/javascript">
$(document).ready(function(){

$(function(){

  $(".ch").click(function(){
    var label = $(this).attr('title');
    var nombre = $(this).attr('name');
    var selNombre = "span.cl_" + nombre;
    $(selNombre).removeClass('badge');
    $(selNombre).removeClass('badge-warning');
    $(selNombre).removeClass('badge-important');
    $(selNombre).removeClass('badge-success');
    $(this).addClass('badge badge-' + label);
  });

});


  $(function(){
    $("#btnProcesa").live("click",function(e){
      e.preventDefault();
        $("#procesa").val("1");
        var  datos = $("#frmPreguntas").serialize();
        //alert(datos); return;
        $("#frmPreguntas").submit();
    });
  });

   $(function(){
    $("#btnGuarda").live("click",function(e){
      e.preventDefault();
       $("#procesa").val("0");
        var  datos = $("#frmPreguntas").serialize();
         //alert(datos); return;
        $("#frmPreguntas").submit();
    });
  });

});
</script>

<style type="text/css">
  /*.badge{padding: 2px 2px 2px 2px!important;}*/
  
@media screen and (-webkit-min-device-pixel-ratio:0) {
  .sel_radio{margin-top:1px!important;}
}

  
</style>

</body>
</html>
