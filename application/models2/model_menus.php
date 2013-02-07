<?php

class Model_menus extends CI_Model {

    function __construct(){
        parent::__construct();
    }
	

	function get_menus($tipo = "1"){
		$menus = $this->db->get('menu');
		if($menus->num_rows > 0){
			return $menus;
		}else{
			return FALSE;
		}
	}

	public function agrega_menu(){
		$titulo = $this->input->post('titulo');
		$descripcion = $this->input->post('descripcion');;
		$data = array(
			'titulo' => $titulo ,
			'descripcion' => $descripcion
		);
		$this->db->insert('menu', $data); 
	}

	public function borrar($id=0){
		if($id == 0) return FALSE;
		$this->db->where('id', $id);
		$this->db->delete("menu");
		return TRUE;
	}

	public function get_menu_by_id($id=0){
		if($id == 0) return FALSE;
		$query = $this->db->get_where('menu', array('id' => $id), 1);
		return $query;
	}

}	