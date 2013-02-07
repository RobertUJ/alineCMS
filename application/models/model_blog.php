<?php

class Model_blog extends CI_Model {

	var $tabla = "post";

    function __construct()
    {
        parent::__construct();
    }
	

	function get_posts($tipo = "1"){
		$strSql = " SELECT p.id as id_post,p.*,c.nombre as cnombre,c.slug as cslug,u.* FROM post p 
					LEFT JOIN categoria c ON p.id_categoria = c.id
					LEFT JOIN usuarios u ON p.id_autor = u.id
					WHERE tipo = $tipo;";

		$articulos = $this->db->query($strSql);
		if($articulos->num_rows > 0){
			return $articulos;
		}else{
			return FALSE;
		}
	}

	//**************Johnny*******************

	function get_posts_and_users($tipo = "1"){
		$strSql = " SELECT p.*, u.nombre, u.apellidos FROM post p 
					LEFT JOIN usuarios u ON p.id_autor = u.id
					WHERE p.tipo = $tipo;";

		$articulos = $this->db->query($strSql);
		if($articulos->num_rows > 0){
			return $articulos;
		}else{
			return FALSE;
		}
	}

	//*********************************
	
	public function get_post_by_slug($value=''){
		if(is_null($value)) return FALSE;

		$query = $this->db->get_where('post', array('slug' => $value ));
		if($query->num_rows > 0){
			// Si existe
			return FALSE;
		}else{
			// No existe
			return TRUE;
		}
	}

	public function dame_pagina_por_slug($value=''){
		if(is_null($value)) return FALSE;
		$query = $this->db->get_where('post', array('slug' => $value));
		if($query->num_rows > 0){
			return $query;
		}else{
			return FALSE;
		}
	}

	public function get_row_post_by_slug($value=''){
		if(is_null($value)) return FALSE;

		$query = $this->db->get_where('post', array('slug' => $value ));
		if($query->num_rows > 0){
			// Si existe
			return $query;
		}else{
			// No existe
			return TRUE;
		}
	}


	function get_categorias(){
		$this->db->where('id !=' , 2);
		$query = $this->db->get('categoria');
		return $query;
	}

	function get_post_by_id($id = 0){
		if($id == 0) return FALSE;
		$query = $this->db->get_where('post',array('id' => $id),1);
		if($query->num_rows == 0) return FALSE;
		return $query;
	}

	public function dame_bienvenida(){
		$query = $this->db->get_where('post',array('slug' => 'bienvenida' ));
		return $query;
	}




		
}

/* End of file Model_usuarios.php */
/* Location: ./application/models/Model_usuarios.php */