<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Clase utilizada para el control y edicion de usuarios del cms AlineCMS
 * @author Roberto Urita Jimenez  @robertuj robertuj@gmail.com 
 * 
 */
class Sesion extends CI_Controller {

	var $url_origen = "";

	public function __construct(){
		parent::__construct();
		$this->load->model('model_usuarios', 'usr');
		
		// Config URL para direccionamiento
		$this->url_origen = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:null;
		if(! is_null($this->url_origen)){
			$url_origen_2 = base_url('inicio/error_inicio');
			if($this->url_origen === $url_origen_2){
				$this->url_origen =  null;
			}
		}
	}

	public function inicia_sesion(){
		$query = $this->usr->verifica_usuario();
		if($query != FALSE){
			$row = $query->row();		
			$newdata = array(
				'id'  => "$row->id",
				'nombre'  => "$row->nombre",
				'apellidos'  => "$row->apellidos",
				'usuario'  => "$row->usuario",
				'pass'  => "$row->pass",
				'email'  => "$row->email",
				'perfil'  => "$row->perfil",  // 1 Admin  || 2 Editor  || 3 Suscriptor
				'logged_in' => TRUE
			);
			$this->session->set_userdata($newdata);
				
				if(! is_null($this->url_origen)){
					redirect($this->url_origen,'');
				}else{
					redirect('/','location');
				}
		}
		else
		{
			redirect(base_url('/inicio/error_inicio'),'refresh');
		}
	}// End authenticate function

	public function cerrar_sesion(){
		$this->session->sess_destroy();
		if(! is_null($this->url_origen)){
			redirect($this->url_origen,'refresh');
		}else{
			redirect('/','refresh');
		}
		
	}
}