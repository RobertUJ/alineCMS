<?=$head?>
 <body>
    <?php $data['menuactivo'] = '_4'; $this->load->view('/public/helper/menu_logged', $data); ?>
    <div class="container">
      <div class="row">
          <div class="page-header">
            <h2>Biblioteca de documentos: <small> <?php echo $this->session->userdata('nombre') . " " . $this->session->userdata('apellidos'); ?></small></h2>
          </div>
            <strong style="display:block;margin:12px 0 4px"><a href="<?php echo base_url('inicio/auditorias_internas'); ?>" title="Como Implentar ITIL" target="_blank">Procedimiento Auditorias internas</a></strong>  
            <strong style="display:block;margin:12px 0 4px"><a href="<?php echo base_url('inicio/proceso_presupuesto');?>" title="Como Implentar ITIL" target="_blank">Proceso presupuesto</a></strong>  
    </div><!--/.fluid-container-->
  </div>
<?=$footer?>
</body>
</html>
