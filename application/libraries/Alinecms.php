<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

class Alinecms {
  	protected $ci;

	function __construct(){
		$this->ci =& get_instance();
	}

	function get_head($titulo = '',$admin = FALSE){
		$data['titulo'] = $titulo;
		if($admin === TRUE){
			return  $this->ci->load->view('/admin/helper/head' ,$data,TRUE);
		}else{
			return  $this->ci->load->view('/public/helper/head' ,$data,TRUE);
		}
	}

	function get_footer($admin = FALSE){
		$data = "";
		if($admin === TRUE){
			return $this->ci->load->view('/admin/helper/footer.php', $data, TRUE);
		} else{
			return $this->ci->load->view('/public/helper/footer.php', $data, TRUE);
		}
		
	}

	function get_header($menu =  ''){
		$data['menuactivo'] = $menu;
		return $this->ci->load->view('/admin/helper/header', $data, TRUE);
	}


	/**
	 * Funcion para imprimir javascript
	 * @author Roberto Urita Jimenez @robertuj
	 * @param string $nombreJS Nombre del archivo javascript que se agregara
	 * @param boolean $imprime Variable 
	 * @return String
	 */
	function add_javascript($nombreJS = '', $imprime = TRUE,$admin = FALSE){
		$_path = base_url('/assets/js/');
		
		if($admin == TRUE)
			$_path = base_url('/assets/admin/js/');
		

		$_path .="/";

		if( $imprime == TRUE){
			echo "<script src='" . $_path . $nombreJS . ".js' type='text/javascript'></script>";
		}else{
			return "<script src='" . $_path . $nombreJS . ".js' type='text/javascript'></script>";
		}
	}


	/**
	 * Funcion para imprimir javascript
	 * @author Roberto Urita Jimenez @robertuj
	 * @param string $nombreJS Nombre del archivo javascript que se agregara
	 * @param boolean $imprime Variable 
	 * @return String
	 */
	function add_css($nombreCSS = '', $imprime = TRUE,$admin = FALSE){
		$_path = base_url('assets/css');
		if($admin == TRUE){
			$_path = base_url('assets/admin/css');
		}

		$_path .="/";

		if( $imprime == TRUE){
			echo "<link href='". $_path . $nombreCSS . ".css' rel='stylesheet' >";
		}else{
			return "<link href='" . $_path . $nombreCSS . ".css' rel='stylesheet' >";
		}

	}

	function is_Logged(){
		if ($this->ci->session->userdata('logged_in')){
			return TRUE;
		}ELSE{
			return FALSE;
		}
	}

	/**
	 * Funcion para imprimir javascript
	 * @author Roberto Urita Jimenez @robertuj
	 * @param string $nombreJS Nombre del archivo javascript que se agregara
	 * @param boolean $imprime Variable 
	 * @return String
	 */
	function is_LoggedAdmin(){
		if ($this->ci->session->userdata('logged_in') && $this->ci->session->userdata('perfil') == '1'){
			return TRUE;
		}ELSE{
			return FALSE;
		}
	}

		/**
	 * Get either a Gravatar URL or complete image tag for a specified email address.
	 *
	 * @param string $email The email address
	 * @param string $s Size in pixels, defaults to 80px [ 1 - 512 ]
	 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
	 * @param boole $img True to return a complete IMG tag False for just the URL
	 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
	 * @return String containing either just a URL or a complete image tag
	 * @source http://gravatar.com/site/implement/images/php/
	 */
	function get_gravatar( $email, $s = 80,$img = false, $d = 'mm', $r = 'g', $atts = array() ) {
		$url = 'http://www.gravatar.com/avatar/';
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= "?s=$s&d=$d&r=$r";
		if ( $img ) {
			$url = '<img src="' . $url . '"';
			foreach ( $atts as $key => $val )
				$url .= ' ' . $key . '="' . $val . '"';
			$url .= ' />';
		}
		return $url;
	}


	function get_user_name(){
		echo $this->ci->session->userdata('nombre');
	}

	function get_fecha_esp(){
		$week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
		$months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$year_now = date ("Y");
		$month_now = date ("n");
		$day_now = date ("j");
		$week_day_now = date ("w");
		$date = $week_days[$week_day_now] . ", " . $day_now . " de " . $months[$month_now] . " de " . $year_now; 
		echo $date;  
	}


}


/* Fin de AdminLib */