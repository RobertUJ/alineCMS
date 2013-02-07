<?php header('Content-Type: text/html; charset=UTF-8');   ?>

<header>
   <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo base_url();?>">Aline CMS</a>
          
          <?php if($this->alinecms->is_LoggedAdmin()) {?>
					<div class="btn-group pull-right">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<?php echo $this->alinecms->get_gravatar($this->session->userdata('email') ,18,TRUE) . " ";    echo $this->session->userdata('nombre'); ?>
						  <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
						  <li><a href="<?php echo base_url('/sesion/cerrar_sesion') ?>">Cerrar Sesion</a></li>
						</ul>
					</div>
          <?php } ?>

          <div class="nav-collapse">
            <ul class="nav">
					<li id="_0"  class="item">
						<a href="<?php echo base_url('zeus'); ?>">PANEL PRINCIPAL</a>
					</li>
					<li class="divider-vertical"></li>
					<li  id="_1" class="item" >
						<a href="<?php echo base_url('panel/usuarios'); ?>">Usuarios</a>
					</li>
					<li id="_2" class="item">
						<a href="<?php echo base_url('panel/post'); ?>">Blog</a>
					</li>
					<li id="_3" class="item">
						<a href="<?php echo base_url('panel/post/panel_paginas'); ?>">Páginas</a>
					</li>
					<li id="_4" class="item">
						<a href="<?php echo base_url('panel/menus'); ?>">Menús</a>
					</li>
					<li id="_5" class="item">
						<a href="<?php echo base_url('panel/preguntas'); ?>">Preguntas</a>
					</li>
				</ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<script type="text/javascript">
$(".item").removeClass('active');
  <?php if( isset($menuactivo) && ! is_null($menuactivo) ){ ?>
	var menuactivo = "<?=$menuactivo?>";
	$("#<?=$menuactivo?>").addClass('active');
  <?php } ?>

	<?php if(isset($menuactivo) && $menuactivo == "--"): ?>
  		$(".item:not(:first)").hide();
	<?php endif; ?>

</script>


</header>
