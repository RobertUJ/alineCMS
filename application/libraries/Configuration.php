<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Configuration{
	public $titulo = '';
	public $logo = '';
	public $correo_admin = '';
	public $nombre_admin = '';
	public $plantilla = 1;
	public $twitter = '';
	public $facebook = '';
	public $google = '';
	public $no_articulos = 0;
	public $categorias = '';
	public $logo_ancho = 0;
	public $logo_alto = 0;
	public $logo_ancho_original = 0;
	public $logo_alto_original = 0;
	public $configuracion = false;
	protected $ci;

	function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->model('model_configuracion','conf');
		$configuracion = $this->ci->conf->dame_configuracion();
		if($configuracion->num_rows() > 0){
			$this->titulo = $configuracion->row('titulo');
			$this->logo = $configuracion->row('logo');
			$this->correo_admin = $configuracion->row('correo_admin');
			$this->nombre_admin = $configuracion->row('nombre_admin');
			$this->plantilla = $configuracion->row('plantilla');
			$this->twitter = $configuracion->row('twitter');
			$this->facebook = $configuracion->row('facebook');
			$this->google = $configuracion->row('google');
			$this->no_articulos = $configuracion->row('no_articulos');
			$this->categorias = $configuracion->row('categorias');
			$this->logo_ancho = $configuracion->row('logo_ancho');
			$this->logo_alto = $configuracion->row('logo_alto');
			$this->configuracion = true;

			// Calcular ancho y alto del logotipo original
			$ruta_imagen = base_url('assets/img');
			$ruta_imagen .= "/" . $this->logo;
			$imagen = getimagesize($ruta_imagen);
			$this->logo_ancho_original = $imagen[0];
			$this->logo_alto_original = $imagen[1];


			if(($this->logo_ancho == 0) && ($this->logo_alto == 0)){
				$this->logo_ancho = $this->logo_ancho_original;
				$this->logo_alto = $this->logo_alto_original;
			}
		}
	}

	public function medidas_imagenes($ruta_imagen=""){
		if ($ruta_imagen) {
			return getimagesize($ruta_imagen);
		}else{
			return false;
		}
	}

}
?>