	<?=$head?>
	<body>
		<header>
			<?=$header?>
       	</header>
			
			<!-- Le main menu -->
			<div id="fondo">
            <div id="back-wrapper" class="container">
	            <div id="home-wrapper" class="span12">
                <div id="contenido-txt">
                <h2>El usuario no existe, la contraseña esta incorrecta o aun no realiza el pago a la suscripción. <br/> <a href="<?php echo base_url('zeus');?>">Intente de nuevo por favor.</a></h2>	 
 	            </div>  
                <div id="banners-hor">
                <?php $this->load->view('/public/helper/banners'); ?>
                </div>
            </div>
            </div>
	<div id="footer-wrapper">
	    <?php $this->load->view('/public/helper/footer-menus.php'); ?>
    </div>		
	
	<?php $this->load->view('public/helper/footer.php'); ?>
	<!-- ******************************************* -->
	</body>
</html>
