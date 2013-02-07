</div>
    	</div><!--container end-->
       <footer>
       <div class="container"> 
          <div class="span9">
            <nav>
              <?=$Menu_Principal?>
            </nav>
          </div>
          <div class="span2 blanco">
            <p>CALLE #3433<br />
              COL. AZUL BRIDES<br />
              MONTERREY NL<br />
              CP. 32599</p>
          </div>  
    </div>
             
      </footer>


	<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- This .js file, add generic functions. -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/js/hover/jquery.hoverdir.js'); ?>"></script>
    <script type="text/javascript">
        $(function() {
            $('#da-thumbs > li').hoverdir();
        });
    </script>

<script src="<?php echo base_url('assets/js/bootstrap-carousel.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-transition.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-modal.js'); ?>"></script>



<script type="text/javascript">
$(document).ready(function(){
    $(".link_to").on("click",function(e){
      e.preventDefault();
      console.log("click on link_to")
      var slug = $(this).attr("page");
      $(".modal-body").load( "<?php echo base_url('paginas/get_content_page');?>/"+slug);
      $("#myModalLabel").html(slug.toUpperCase());
      $('#myModal').modal('show');
    });
});
</script>

</body>
     
</html>



 
