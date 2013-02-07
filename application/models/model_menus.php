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
		$id_css = $this->input->post('id_css');
		$clase = $this->input->post('clase');
		$descripcion = $this->input->post('descripcion');
		$atri = $this->input->post('atributo');
		$id_post = $this->input->post('id_post');
		$id_post_cadena = "";
		$cont = 0;
		foreach ($id_post as  $val) {
			if($cont == 0) $id_post_cadena .= "|";

			$id_post_cadena .= $val . "|";

			$cont ++; 
		}
		$data = array(
			'titulo' => $titulo ,
			'descripcion' => $descripcion,
			'id_css' => $id_css,
			'clase' => $clase,
			'atributos' => $atri,
			'id_post' => $id_post_cadena
		);
		$this->db->insert('menu', $data); 
	}

	public function agrega_menu_editado(){
		$id_menu = $this->input->post('id_menu');
		$titulo = $this->input->post('titulo');
		$id_css = $this->input->post('id_css');
		$clase = $this->input->post('clase');
		$descripcion = $this->input->post('descripcion');
		$atri = $this->input->post('atributo');
		$id_post = $this->input->post('id_post');
		$id_post_cadena = "";
		$cont = 0;
		foreach ($id_post as  $val) {
			if($cont == 0) $id_post_cadena .= "|";

			$id_post_cadena .= $val . "|";

			$cont ++; 
		}
		$data = array(
			'titulo' => $titulo ,
			'descripcion' => $descripcion,
			'id_css' => $id_css,
			'clase' => $clase,
			'atributos' => $atri,
			'id_post' => $id_post_cadena
		);
		$this->db->where('id',$id_menu);
		$this->db->update('menu',$data);
	}

	public function get_mainMenu($idMenu = 0){
		$query = $this->db->get_where('menu', array('id' => $idMenu), 1);
		return $query->row();
	}

	public function borrar($id=0){
		if($id == 0) return FALSE;
		$this->db->where('id', $id);
		$this->db->delete("menu");
		$this->db->where('idmenu', $id);
		$this->db->delete("item_menu");
		return TRUE;
	}

	public function get_menu_by_id($id=0){
		if($id == 0) return FALSE;
		$query = $this->db->get_where('menu', array('id' => $id), 1);
		return $query;
	}


	public function get_ItemsMenu($idmenu = 0,$padre = 0){
		$this->db->order_by('idItem ASC, padre ASC, orden ASC');
		return $this->db->get_where('item_menu', array('idmenu' => $idmenu, 'padre' => $padre));
	}

	public function get_ItemsMenu_front($idmenu = 0,$padre = 0){
		$this->db->order_by('idItem ASC, padre ASC, orden ASC');
		return $this->db->get_where('item_menu', array('idmenu' => $idmenu, 'padre' => $padre, 'estado' =>1));
	}

	public function get_hijos($idMenu , $padre){
		$this->db->select('idItem');
		$this->db->from('item_menu');
		$this->db->where('idmenu', $idMenu);
		$this->db->where('padre', $padre);
		return $this->db->count_all_results();
	}

	public function crea_item_menu(){
		$idMenu = $this->input->post('idmenu');
		$idpost = $this->input->post('idpost');
		$titulo = $this->input->post('titulo');
		$padre  = $this->input->post('padre');
		$tipo   = $this->input->post('tipo');
		$orden  = $this->input->post('orden');
		$id_css  = $this->input->post('id_css');
		$clase  = $this->input->post('clase');
		$t_isLogged = $this->input->post('misLogged');
		$atri = $this->input->post('atributos');
		$murl = $this->input->post('murl');
		
		$slug = "";

		switch ($tipo) {
			case '2':
				// contacto
					$slug = 'contacto';
				break;
			
			case '3':
				// page
					$slug = $this->dame_slug($idpost);
				break;
			
			case '4':
				// articulo del blog
					$slug = $this->dame_slug($idpost);
				break;
			
			case '5':
				// blog
					$slug = 'blog';
				break;
			
			default:
				
				break;
		}// end swithc

		$data = array(
			'idmenu' => $idMenu ,
			'idpost' => $idpost ,
			'titulo' => $titulo, 
			'slug'   => $slug,
			'padre'  => $padre,
			'tipo'   => $tipo,
			'orden'  => $orden,
			'id_css' => $id_css,
			'clase' => $clase,
			'is_logged' => $t_isLogged,
			'atri' => $atri,
			'url' => $murl
		);

		$this->db->insert('item_menu', $data); 

	} // end function crea_item_menu

	public function edita_item_menu($id){
		$idItem = $this->input->post('idItem');
		$idMenu = $this->input->post('idmenu');
		$idpost = $this->input->post('idpost');
		$titulo = $this->input->post('titulo');
		$padre  = $this->input->post('padre');
		$tipo   = $this->input->post('tipo');
		$orden  = $this->input->post('orden');
		$id_css  = $this->input->post('id_css');
		$clase  = $this->input->post('clase');
		$t_isLogged = $this->input->post('misLogged');
		$atri = $this->input->post('atributos');
		$murl = $this->input->post('murl');
		
		
		$slug = "";

		switch ($tipo) {
			case '2':
				// contacto
					$slug = 'contacto';
				break;
			
			case '3':
				// page
					$slug = $this->dame_slug($idpost);
				break;
			
			case '4':
				// articulo del blog
					$slug = $this->dame_slug($idpost);
				break;
			
			case '5':
				// blog
					$slug = 'blog';
				break;
			
			default:
				
				break;
		}// end swithc

		$data = array(
			'idmenu' => $idMenu ,
			'idpost' => $idpost ,
			'titulo' => $titulo, 
			'slug'   => $slug,
			'padre'  => $padre,
			'tipo'   => $tipo,
			'orden'  => $orden,
			'id_css' => $id_css,
			'clase' => $clase,
			'is_logged' => $t_isLogged,
			'atri' => $atri,
			'url' => $murl
		);
		$this->db->where('idItem', (int)$idItem);
		$this->db->update('item_menu', $data); 

	}// termina funcion edita item menu


	function dame_slug($idPost = 0){
		$this->db->select('slug');
		$query = $this->db->get_where('post', array('id' => $idPost), 1);
		return $query->row('slug');
	}


	public function slug_actual($idPost=0){
		$this->db->select('slug');
		$this->db->where('id',$idPost); 
		$query = $this->db->get('post');
		return $query->row('slug');
	}


	public function get_idMenu_by_Pagina($idPagina="0"){
		$strSql = "SELECT id from menu  WHERE id_post LIKE '%|".$idPagina."|%' ";
		$respuesta = $this->db->query($strSql);
		if($respuesta->num_rows > 0)
			return $respuesta->row('id');
		else
			return FALSE;
	}

	public function get_nombre_menu($idMenu){
		
		$query = "SELECT titulo from menu WHERE id = " . (int)$idMenu;
		$nombre_menu = $this->db->query($query);
		if($nombre_menu->num_rows > 0)
			return $nombre_menu->row('titulo');
	}

	public function get_datos_item($id = 0){
		$datos_items = $this->db->get_where('item_menu', array('idItem' => $id),1);
		if($datos_items->num_rows > 0)
			return $datos_items->row();
		else
			return false;
	}

	public function get_id_item_menu($idItem=0){
		$this->db->select("idmenu");
		$this->db->where("idItem",$idItem);
		$menu = $this->db->get("item_menu");
		return $menu->row('idmenu');
	}

	public function get_padre_item_menu($idItem=0){
		$this->db->select("padre");
		$this->db->where("idItem",$idItem);
		$menu = $this->db->get("item_menu");
		return $menu->row('padre');
	}

	public function borra_item(){
		$idItem = $this->input->post('id');
		$this->db->where('idItem', $idItem);
		$this->db->delete('item_menu'); 
	}

	public function activa_item($idItem = 0){
		$estado = $this->input->post('estado');
		$idItem = $this->input->post('idItem');
		$this->db->where('idItem',$idItem);

		if($estado == 1){
			$estado = 0;
		}else{
			$estado = 1;
		}
		$data = array(
			'estado' => $estado
		);
		$this->db->update('item_menu',$data);
	}


} // Fin modelo menus 	