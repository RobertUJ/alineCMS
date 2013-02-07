<?=$head?>
  <body>
    <?php $data['menuactivo'] = '_5'; $this->load->view('/public/helper/menu_logged', $data); ?>
    <br/>
    <div class="container">
      <div class="row">
        <!-- contenido -->
        <div class="span12">
            <div class="page-header">
              <h2>Comunidad virtual <small></small></h2>
            </div>

           
            		<div class="thumbnail">
            			<img src="<?php echo base_url('media/img/Imagen-MyPink.png') ?>">
            		</div>
           
        </div><!--/span-->
      </div><!--/row-->
    </div><!--/.fluid-container-->
    <?=$footer?>
    </body>
</html>