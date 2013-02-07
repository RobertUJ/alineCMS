<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title><?=$titulo?></title>
		<meta name="description" content="" />
		<meta name="author" content="newemage.com.mx" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />
		
		<!-- Le styles -->
		<?php 
	    	$this->alinecms->add_css('bootstrap',TRUE,TRUE);
	    	$this->alinecms->add_css('bootstrap-responsive',TRUE,TRUE);
			$this->alinecms->add_css('admin_estilos',TRUE,TRUE);
			$this->alinecms->add_css('animate',TRUE,TRUE);
		?>
		
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Jquery necesary -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<?php $this->alinecms->add_javascript('plugins',TRUE,TRUE);	?>
		<?php $this->alinecms->add_javascript('bootstrap.min',TRUE,TRUE); ?>
		
		<!-- Heyy!! Designer, replace favicon.ico & apple-touch-icon.png in the folder /assets/img/ico  -->
		<link rel="shortcut icon" href="<?php echo base_url('assets/img/ico/favicon.ico'); ?>"/>
		<link rel="apple-touch-icon" href="<?php echo base_url('assets/img/ico/apple-touch-icon.png');?>"/>
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('assets/img/ico/apple-touch-icon-114-precomposed.png')?>"/>
    	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('assets/img/ico/apple-touch-icon-72-precomposed.png');?>"/>
    	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url('assets/img/ico/apple-touch-icon-57-precomposed.png');?>"/>
	</head>