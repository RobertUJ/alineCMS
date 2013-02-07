<?php

class Model_configuracion extends CI_Model {

	private $tabla = "configuracion";

    function __construct()
    {
        parent::__construct();
        $this->load->library('Configuration');
    }
		
    function dame_configuracion(){
    	$this->db->select("*");
    	$configuracion = $this->db->get($this->tabla);
    	if($configuracion->num_rows() < 1){
    		return false;
    	}
    	return $configuracion;
    }



    function agregar_configuracion(){
        $cats = $this->input->post('categorias', true);
        $categorias = "";
        for ($i=0; $i < count($cats); $i++) { 
            if($i+1 == count($cats)){
                $categorias .= $cats[$i];
            }else{
                $categorias .= $cats[$i] . "|";    
            }
        }
    	$data = array(
    		'titulo' => $this->input->post('titulo', true),
    		'logo' => $this->input->post('logo', true),
    		'correo_admin' => $this->input->post('email', true),
    		'nombre_admin' => $this->input->post('nombre_admin', true),
    		'plantilla' => $this->input->post('template', true),
    		'twitter' => $this->input->post('twitter', true),
    		'facebook' => $this->input->post('facebook', true),
    		'google' => $this->input->post('google', true),
    		'no_articulos' => (int)$this->input->post('num_articulos', true),
    		'categorias' => $categorias
    	);
    	$this->db->insert($this->tabla, $data);

    }

    function editar_configuracion($logo,$imagen){
        $ancho = $imagen['ancho'];
        $alto = $imagen['alto'];
        $cats = $this->input->post('categorias');
        $categorias = "";
        for ($i=0; $i < count($cats); $i++) {
            if($i+1 == count($cats)){
                $categorias .= $cats[$i];
            }else{
                $categorias .= $cats[$i] . "|"; 
            }
        }
    	$data = array(
    		'titulo' => $this->input->post('titulo', true),
    		'logo' => $logo,
    		'correo_admin' => $this->input->post('email', true),
    		'nombre_admin' => $this->input->post('nombre_admin', true),
    		'plantilla' => $this->input->post('template', true),
    		'twitter' => $this->input->post('twitter', true),
    		'facebook' => $this->input->post('facebook', true),
    		'google' => $this->input->post('google', true),
    		'no_articulos' => (int)$this->input->post('num_articulos', true),
    		'categorias' => $categorias,
            'logo_ancho' => $ancho,
            'logo_alto' => $alto
    	);
    	$this->db->update($this->tabla,$data);
    	return true;
    }

    function dame_categorias(){
        $this->db->select("*");
        $categorias = $this->db->get("categoria");
        return $categorias;
    }

}

/* End of file Model_usuarios.php */
/* Location: ./application/models/Model_usuarios.php */