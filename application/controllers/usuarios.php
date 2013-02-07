<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Clase utilizada para el control y edicion de usuarios del cms AlineCMS
 * @author Roberto Urita Jimenez  @robertuj robertuj@gmail.com 
 * 
 */
class Usuarios extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_usuarios', 'usr');
		$this->load->library('Alinecms');
	}
		
	
	public function index(){
		
	}
	
	public function inicia_sesion(){
		$query = $this->usr->verifica_usuario();
		if($query != FALSE){
			$row = $query->row();

			if($row->estado != 1){
				$data['id_usuario'] = $row->id;
				$data['msg'] = "<div class='alert alert-error'>Error. No se ha completado el registro.</div>";
				$this->load->view('public/registro_paso2', $data);
				return FALSE;
			}	
			$newdata = array(
				'id'  => "$row->id",
				'nombre'  => "$row->nombre",
				'apellidos'  => "$row->apellidos",
				'usuario'  => "$row->usuario",
				'pass'  => "$row->pass",
				'email'  => "$row->email",
				'fecha_inicio' => "$row->fecha_pago",
				'perfil'  => "$row->perfil",  // 1 Admin  || 2 Editor  || 3 Suscriptor
				'logged_in' => TRUE
			);
			$this->session->set_userdata($newdata);
			$this->load->view('public/perfil');
		}else {
			$data['mensaje_error'] = "No existe el usuario";
			$this->load->view('public/ingresar',$data);
		}
	}// End authenticate function

	public function cerrar_sesion(){
		$this->session->sess_destroy();
		redirect('/','refresh');
	}

	public function crea_usuario(){
		$id = $this->usr->inserta_usuario_nuevo();
		$data['id_usuario'] = $id;
		$data['msg'] = "pagueme la tanda!!!!";
		$this->load->view('public/registro_paso2', $data);
	}


	public function activar_usuario(){
		$data['id_usuario'] = $_POST['transaction_subject'];
		$data['estado_pago'] = $_POST['payment_status'];
		$data['email_paypal'] = $_POST['payer_email'];
		$data['txn_id'] = $_POST['txn_id'];
		$data['fecha_pago'] = $_POST['payment_date'];
		
		if(!is_null($data['id_usuario']) && $data['id_usuario'] != 0){
			$this->usr->activar_usuario($data);
		}
		else{
			$this->usr->fail_activar_usuario($data);
		}
			
	}

	public function perfil(){
		$logg = $this->alinecms->is_Logged();
		if ($logg == TRUE) {
			$this->load->view('public/perfil');	
		}

		else{
			redirect(base_url());
		}
	}

	public function editar_perfil($edicion=0){
		
		if($edicion == 1){
			$this->usr->editar_usuario();
			$query = $this->usr->consulta_usuario();
			if ($query != FALSE){
				$row = $query->row();
				$newdata = array(
				'id'  => "$row->id",
				'nombre'  => "$row->nombre",
				'apellidos'  => "$row->apellidos",
				'usuario'  => "$row->usuario",
				'pass'  => "$row->pass",
				'email'  => "$row->email",
				'fecha_inicio' => "$row->fecha_pago",
				'perfil'  => "$row->perfil",  // 1 Admin  || 2 Editor  || 3 Suscriptor
				'logged_in' => TRUE
				);
			}
			$this->session->set_userdata($newdata);
			$this->load->view('public/perfil');
		}
		else{
			$this->load->view('public/editar_perfil');
		}
	}

	public function presentacion(){
		$this->load->view('public/presentacion');
	}
}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */