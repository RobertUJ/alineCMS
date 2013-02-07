<?php 

class Model_ipn extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    public function habilita_usuario($usuario_id=0){
    	$data = array('estado' => 1);
    	$this->db->where('id', 1);
		$this->db->update('usuarios', $data); 
		return true;
    }

    public function agregar_usuario(){
    	$data = array(
            'nombre' => $this->input->post('nombre'),
            'apellidos' => $this->input->post('apellidos'),
            'usuario' => $this->input->post('usuario'),
            'pass' => $this->input->post('password'),
            'email' => $this->input->post('email')
            );
		$this->db->insert('usuarios', $data);
        return true;
    }



}

?>