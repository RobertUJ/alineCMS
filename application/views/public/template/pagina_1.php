		<?php $this->load->view('/public/helper/head.php'); ?>
		<?=$main_menu?>
			<div id="back-wrapper" class="container">
				
                <div id="home-wrapper" class="span12">
                
                <div id="contenido-txt">
                 
                 <h2><?=$pagina->titulo;?></h2>	
 	             <?=$pagina->contenido;?>

 	            </div>  
                <div id="banners-hor">
                	<?=$menu_left?>
                </div>
            </div>
            </div>
			<!-- Le main content -->
				<?php $this->load->view('public/helper/footer.php'); ?>
	
	
	</body>
</html>
