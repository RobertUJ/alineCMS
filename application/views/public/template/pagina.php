		<?php $this->load->view('/public/helper/head.php'); ?>
		<?=$main_menu?>
			<div id="fondo">
            <div id="back-wrapper" class="container">
				
                <div id="home-wrapper" class="span12">
                
                <div id="contenido-txt">
                 
                 <h2><?=$pagina->titulo;?></h2>	
 	             <?=$pagina->contenido;?>

 	            </div>  
                <div id="banners-hor">
                <?php //$this->load->view('/public/helper/banners'); ?>
                </div>
            </div>
            </div>
			<!-- Le main content -->
			<div>
				<section>
					<article></article>
				</section>
<?php $this->load->view('public/helper/int.php'); ?>
				<!-- Le sidebar -->
				<aside>
					
				</aside>
			</div>
	<div id="footer-wrapper">
  
    </div>		
	<!-- Le footer && Javascript files -->
	<!-- ******************************************* -->
	<!-- Le head.php  ==> location: application/views/public/helper/footer.php -->
	
	<?php $this->load->view('public/helper/footer.php'); ?>
	<!-- ******************************************* -->
    <script type="text/javascript">
    	$('#myCarousel').carousel();
		//$('.dropdown-toggle').dropdown();
	  </script>
 
	</body>
</html>
