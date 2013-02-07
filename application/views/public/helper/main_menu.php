<div class="container">
<header>
	<div class="redes">
		<a class="icons" target="_blank" href="<?=$this->configuration->facebook?>" target="_blank"><img src="<?php echo base_url('assets/img/icon-fb.png'); ?>"</a>
		<a class="icons" target="_blank" href="<?=$this->configuration->twitter?>"><img src="<?php echo base_url('assets/img/icon-twt.png'); ?>"</a>
	</div>
	<?php $logo = "assets/img/" . $this->configuration->logo; ?>
		<div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url($logo); ?>" width="<?=$this->configuration->logo_ancho?>" height="<?=$this->configuration->logo_alto?>" ></a></div>
		<nav>
		  <?=$Menu_Principal?>
		</nav>
</header>
