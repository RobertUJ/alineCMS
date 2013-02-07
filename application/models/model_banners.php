<?php
class Model_banners extends CI_Model {

    function __construct(){
        parent::__construct();
    }

	public function agrega_banner(){
		$id_post = $this->input->post('id_post');
		$nombre = $this->input->post('nombre');
		$orden = $this->input->post('orden');
		$imagen = $this->input->post('imagen');
		$width = $this->input->post('width');
		$heigth = $this->input->post('heigth');
		$link = $this->input->post('link');
		$clicks = $this->input->post('clicks');
		$activo = $this->input->post('activo');
		$data = array(
			'id_post' => $id_post ,
			'nombre' => $nombre,
			'orden' => $orden,
			'imagen' => $imagen,
			'width' => $width,
			'heigth' => $heigth,
			'link' => $link,
			'clicks' => $clicks,
			'activo' => $activo,
		);
		$this->db->insert('banners', $data); 
	}	

/*	public function agrega_catalogo_editado(){
		$id_catalogo = $this->input->post('id_catalogo');
		$titulo = $this->input->post('titulo');
		$descripcion = $this->input->post('descripcion');
		$data = array(
			'titulo' => $titulo ,
			'descripcion' => $descripcion
		);
		$this->db->where('id',$id_catalogo);
		$this->db->update('catalogos',$data);
	}	

	public function agrega_categoria(){
		$titulo = $this->input->post('titulo');
		$descripcion = $this->input->post('descripcion');
		$data = array(
			'titulo' => $titulo ,
			'descripcion' => $descripcion,
		);
		$this->db->insert('categorias_cat', $data); 		
	}	

	public function agrega_categoria_editado(){
		$id_categoria = $this->input->post('id_categoria');
		$titulo = $this->input->post('titulo');
		$descripcion = $this->input->post('descripcion');
		$data = array(
			'titulo' => $titulo ,
			'descripcion' => $descripcion
		);
		$this->db->where('id',$id_categoria);
		$this->db->update('categorias_cat',$data);
	}

	public function agrega_producto($imgs){
		$titulo = $this->input->post('nombre');
		$descripcion = $this->input->post('descripcion');
		$activo = $this->input->post('activo');
		$id_catalogos_cat = $this->input->post('id_catalogos_cat');
		$id_categorias_cat = $this->input->post('id_categorias_cat');
		$catalogos = "";
		$categorias = "";
		foreach ($id_catalogos_cat as  $val)
		{
			if ($catalogos == "")
				$catalogos .= $val;
			else
				$catalogos .= ",".$val;
		}
		foreach ($id_categorias_cat as  $val)
		{
			if ($categorias == "")
				$categorias .= $val;
			else
				$categorias .= ",".$val;
		}
		$img = "";
		if ($imgs != "")
		{
			$imgs_temp = $imgs;
			$imgs_temp = substr($imgs_temp,0,-1);
			$imgs_temp = explode(",", $imgs);
			$img = $imgs_temp[1];
		}
		$data = array(
			'nombre' => $titulo,
			'id_catalogo_cat' => $catalogos,
			'id_categorias_cat' => $categorias,
			'descripcion' => $descripcion,
			'imagenes' => $imgs,
			'img_cat' => $img,
			'activo' => $activo,
		);
		$this->db->insert('productos_cat', $data);
	}	

	public function agrega_producto_editado(){
		$id_producto = $this->input->post('id_producto');
		$nombre = $this->input->post('nombre');
		$descripcion = $this->input->post('descripcion');
		$activo = $this->input->post('activo');
		$data = array(
			'titulo' => $titulo ,
			'descripcion' => $descripcion,
			'activo'	=> $activo
		);
		$this->db->where('id',$id_producto);
		$this->db->update('productos_cat',$data);
	}	

	public function borrar_catalogo($id=0){
		if($id == 0) return FALSE;
		$this->db->where('id', $id);
		$this->db->delete("catalogos");
		return TRUE;
	}
	
	public function borrar_categoria($id=0){
		if($id == 0) return FALSE;
		$this->db->where('id', $id);
		$this->db->delete("categorias_cat");
		return TRUE;
	}	
	
	public function borrar_producto($id=0){
		if($id == 0) return FALSE;
		$this->db->where('id', $id);
		$this->db->delete("productos_cat");
		return TRUE;
	}	

	public function get_catalogo_by_id($id=0){
		if($id == 0) return FALSE;
		$query = $this->db->get_where('catalogos', array('id' => $id), 1);
		return $query;
	}*/

	public function get_banners(){
		$banners = $this->db->get('banners');
		if($banners->num_rows > 0){
			return $banners;
		}else{
			return FALSE;
		}
	}

/*	public function get_categoria_by_id($id=0){
		if($id == 0) return FALSE;
		$query = $this->db->get_where('categorias_cat', array('id' => $id), 1);
		return $query;
	}

	public function get_categorias($tipo = "1"){
		$categorias = $this->db->get('categorias_cat');
		if($categorias->num_rows > 0){
			return $categorias;
		}else{
			return FALSE;
		}
	}	

	public function get_categorias_para_catalogo($in){
		$query = "SELECT id,titulo FROM categorias_cat WHERE id IN($in)";
		$categorias = $this->db->query($query);
		if ($categorias->num_rows > 0)
			return $categorias;
		else
			return FALSE;
	}

	public function get_productos(){
		$productos = $this->db->get('productos_cat');
		if($productos->num_rows > 0){
			return $productos;
		}else{
			return FALSE;
		}
	}	

	public function get_producto_by_id($id=0){
		if($id == 0) return FALSE;
		$query = $this->db->get_where('productos_cat', array('id' => $id), 1);
		return $query;
	}	

	public function get_productos_by_id_categoria($id=0){
		$query = "	SELECT *
					FROM
					(
					SELECT id,id_catalogo_cat,CONCAT(',',id_categorias_cat,',') AS id_categorias_cat,nombre,descripcion,imagenes,img_cat,activo
					FROM productos_cat
					) AS p
					WHERE p.id_categorias_cat LIKE '%,".$id.",%';";
		$productos = $this->db->query($query);
		if($productos->num_rows > 0){
			return $productos;
		}else{
			return FALSE;
		}
	}*/
} 	