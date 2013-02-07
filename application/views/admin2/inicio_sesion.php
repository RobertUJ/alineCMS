<?=$head?>
  <body>
    <?=$header?>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
        	<div class="row-fluid">
				<div class="page-header">
				<h1>Inicio de sesion <small>ingresa usuario y contraseña.</small></h1>
				</div>
                <div class="span4 offset4"  id="frmLogin">
                    <?php if($this->alinecms->is_Logged() && ! $this->alinecms->is_LoggedAdmin()){ ?>
	        		<p><span class="label label-important">No tienes permiso para estar aquí </span> <br/> <span class="label label-important">  Debes de iniciar sesion como administrador.</span></p>
                    <?php }?>
                    <form name="frmLogin" id="frmLogin" method="post" action="<?php echo base_url('panel/sesion/inicia_sesion'); ?>" class="well">
						<label>Ingrese su email:</label>
						<input name="email_login" id="frmUsuario" type="text" class="input-xlarge" placeholder="Email">
						<label>Ingrese su contraseña:</label>
						<input name="pass_login" id="frmLoginPass" type="password" class="input-xlarge" placeholder="Contraseña">
						<br/>
						<input value="Iniciar sesion" type="submit" class="btn btn-primary"/>
					</form>
                    <?php if($no_existe != ""){ ?>
                        <span class="label label-important"><?=$no_existe?></span>
                        <br/>
                    <?php } ?>
	        	</div>
        	</div>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

    <?=$footer?>
    </div><!--/.fluid-container-->

    <script type="text/javascript">
    	$(document).ready(function(){
    		$(".alert").hide();
    		<?php if(isset($fail)){ ?>
    			var loginfail = true;
    		<?php }else{ ?>
    			var loginfail = false;
    		<?php } ?>
    		    		
    		if(loginfail == true){
    			$("#failLogin").show();
    		}
    		
    	});
    	
    </script>


  </body>
</html>
