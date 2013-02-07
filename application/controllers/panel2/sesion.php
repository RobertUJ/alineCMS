<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Clase utilizada para el control y edicion de usuarios del cms AlineCMS
 * @author Roberto Urita Jimenez  @robertuj robertuj@gmail.com 
 * 
 */
class Sesion extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_usuarios', 'usr');
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
			
			redirect(base_url("panel/admin"),'location');
		}else {
			$this->load->view('admin/fail_login');
		}
	}// End authenticate function


	public function cerrar_sesion(){
		$this->session->sess_destroy();
		redirect(base_url(),'refresh');
	}
	
	
}