<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Banners extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if(!$this->alinecms->is_LoggedAdmin()){
			redirect('/' , 'location');
		}
		$banners = array(
		    "1" => "pos1",
		    "2" => "pos2",
		);
		$this->config->set_item('banners', $banners);
		$this->load->model('model_banners', 'banners');
	}

	public function index(){
		$data['head'] = $this->alinecms->get_head('Panel de banners' , TRUE);
		$data['header'] = $this->alinecms->get_header('_6');
		$data['banners'] = $this->get_tabla_banner_panel();
		$this->load->view('admin/banners/banners' , $data);
	}

	public function crea_banner(){
		$data['head'] = $this->alinecms->get_head('Panel de banners' , TRUE);
		$data['header'] = $this->alinecms->get_header('_7');
		$data['titulo_pagina'] = "Crea un nuevo banner";
		$data['descripcion_pagina'] = "";
		//$data['banners'] = $this->get_tabla_banner_panel();
		$data['banners'] = "";
		$this->load->view('admin/banners/nuevo-banner' , $data);
/*		$banners = $this->config->item('banners');
		foreach ($banners as $banner => $value){
    		echo $banners[$banner];
		}*/
	}	

/*	public function borra_catalogo($id=0){
		$result = $this->catalogos->borrar_catalogo($id);
		redirect('panel/catalogo/crea_catalogo', 'location'); 
	}

	public function borra_categoria($id=0){
		$result = $this->catalogos->borrar_categoria($id);
		redirect('panel/catalogo/crea_categoria', 'location'); 
	}	

	public function borra_producto($id=0){
		$result = $this->catalogos->borrar_producto($id);
		redirect('panel/catalogo/', 'location'); 
	}	

	public function crea_catalogo(){
		$data['head'] = $this->alinecms->get_head('Panel de catálogos' , TRUE);
		$data['header'] = $this->alinecms->get_header('_5');
		$data['titulo_pagina'] = "Crea un nuevo catálogo";
		$data['descripcion_pagina'] = "";
		$data['catalogos'] = $this->get_tabla_catalogo_panel();
		$this->load->view('admin/catalogos/nuevo-catalogo' , $data);
	}	

	public function crea_categoria(){
		$data['head'] = $this->alinecms->get_head('Edición de categorías' , TRUE);
		$data['header'] = $this->alinecms->get_header('_5');
		$data['titulo_pagina'] = "Crea una nueva categoría";
		$data['descripcion_pagina'] = "";
		$data['categorias'] = $this->get_tabla_categoria_panel();
		$this->load->view('admin/catalogos/nueva-categoria' , $data);
	}	

	public function crea_producto(){
		$data['head'] = $this->alinecms->get_head('Edición de categorías' , TRUE);
		$data['header'] = $this->alinecms->get_header('_5');
		$data['titulo_pagina'] = "Crea un nuevo producto";
		$data['descripcion_pagina'] = "";
		$data['catalogos'] = $this->get_catalogos_productos();
		$data['categorias'] = $this->get_categorias_productos();
		$this->load->view('admin/catalogos/nuevo-producto' , $data);
	}	

	public function edita_catalogo($id = 0){
		$catalogo = $this->catalogos->get_catalogo_by_id($id);
		if($catalogo == FALSE){
			
		}
		$data = array(
					"titulo_catalogo" => $catalogo->row('titulo'),
					"descripcion" => $catalogo->row('descripcion')
				);
		$data['id_catalogo'] = $id;
		$data['head'] = $this->alinecms->get_head('Edición de catálogos' , TRUE);
		$data['header'] = $this->alinecms->get_header('_5');
		$data['titulo_pagina'] = "Edita catalogo";
		$data['descripcion_pagina'] = "";
		$data['catalogos'] = $this->get_tabla_catalogo();
		$this->load->view('admin/catalogos/edita_catalogo' , $data);
	}	

	public function edita_categoria($id = 0){
		$categoria = $this->catalogos->get_categoria_by_id($id);
		if($categoria == FALSE){
			
		}
		$data = array(
					"titulo_categoria" => $categoria->row('titulo'),
					"descripcion" => $categoria->row('descripcion')
				);
		$data['id_categoria'] = $id;
		$data['head'] = $this->alinecms->get_head('Edición de categorías' , TRUE);
		$data['header'] = $this->alinecms->get_header('_5');
		$data['titulo_pagina'] = "Edita categoría";
		$data['descripcion_pagina'] = "";
		$data['categorias'] = $this->get_tabla_categorias();
		$this->load->view('admin/catalogos/edita_categoria' , $data);
	}	

	public function edita_producto($id = 0){
		$producto = $this->catalogos->get_producto_by_id($id);
		if($producto == FALSE){
			
		}
		$data = array(
					'id_catalogo_cat' => $producto->row('id_catalogo_cat'),
					'id_categorias_cat' => $producto->row('id_categorias_cat'),
					'nombre' => $producto->row('nombre'),
					'descripcion' => $producto->row('descripcion'),
					'imagenes' => $producto->row('imagenes'),
					'img_cat' => $producto->row('img_cat'),
					'activo' => $producto->row('activo'),
				);
		$data['id_producto'] = $id;
		$data['head'] = $this->alinecms->get_head('Edición de productos' , TRUE);
		$data['header'] = $this->alinecms->get_header('_5');
		$data['titulo_pagina'] = "Edita producto";
		$data['descripcion_pagina'] = "";
		$data['catalogos'] = $this->get_catalogos_productos($producto->row('id_catalogo_cat'));
		$data['categorias'] = $this->get_categorias_productos($producto->row('id_categorias_cat'));
		$this->load->view('admin/catalogos/edita_producto' , $data);
	}		

	public function get_catalogos_productos($ids_catalogo = ""){
		$catalogos = $this->catalogos->get_catalogos();
		$cadena_option = "";
		$select = "";
		if($catalogos == FALSE) return $cadena_option;
		foreach ($catalogos->result() as $row) {
			if ($ids_catalogo != "")
			{
				$ids = explode(",", $ids_catalogo);
				if (in_array($row->id, $ids))
					$select = " selected='selected'";
				else
					$select = "";
			}
			$cadena_option .= "<option value='$row->id' $select>$row->titulo</option>";	
		}
		return $cadena_option;
	}	

	public function get_categorias_productos($ids_categoria = ""){
		$categorias = $this->catalogos->get_categorias();
		$cadena_option = "";
		$select = "";
		if($categorias == FALSE) return $cadena_option;
		foreach ($categorias->result() as $row) {
			if ($ids_categoria != "")
			{
				$ids = explode(",", $ids_categoria);
				if (in_array($row->id, $ids))
					$select = " selected='selected'";
				else
					$select = "";
			}
			$cadena_option .= "<option value='$row->id' $select>$row->titulo</option>";	
		}
		return $cadena_option;
	}

	public function get_tabla_catalogo(){
		$catalogos = $this->catalogos->get_catalogos();
		$filas = 'No se encontraron catalogos';
		if($catalogos == FALSE){
			return $filas;
		}
		$filas = "  <table id='tblMenus' class='table table-striped table-bordered table-condensed'>
							<thead>
								<tr>
									<th>#</th>
									<th>Titulo</th>
									<th>Descripción</th>
								</tr>
							</thead>
					<tbody>";
		foreach ($catalogos->result() as $row){
		    $filas.= "<tr>";
		    	$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->id . "</td>";
	    		$filas.= "<td>" .  $row->titulo . "</td>";
	    		$filas.= "<td> " .   $row->descripcion ."</td>";
			    $filas.= "</tr>";
		}
		$filas .= "</tbody></table>"; 
		return $filas;
	}*/

	public function get_tabla_banner_panel(){
		$banners = $this->banners->get_banners();
		$filas = 'No se encontraron banners';
		if($banners == FALSE){
			return $filas;
		}
		$filas = "  <table id='tblMenus' class='table table-striped  table-bordered '>
							<thead>
								<tr>
									<th>#</th>
									<th>Titulo</th>
									<th class='cont_accion'>Acciones</th>
								</tr>
							</thead>
					<tbody>";
		foreach ($banners->result() as $row){
		    $filas.= "<tr title='$row->descripcion'>";
		    	$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->id . "</td>";
	    		$filas.= "<td>" .  $row->nombre . "</td>";
	    		$filas.= "<td><div class='cont_accion'>" 
						."<a class='badge badge-success' href='"   . base_url("/panel/catalogo/edita_catalogo/$row->id")   ."' rel='tooltip' title='Editar catálogo:  <br/>". $row->nombre . "'><i class='icon-edit icon-white'></i></a>"  
						."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/catalogo/borra_catalogo/$row->id") ."' rel='tooltip' title='Borrar catálogo: <br/>". $row->nombre . "'><i class='icon-remove icon-white'></i></a>"  
						."</div></td>";
			    $filas.= "</tr>";
		}
		$filas .= "</tbody></table>"; 
		return $filas;
	}

/*	public function get_tabla_categorias(){
		$categorias = $this->catalogos->get_categorias();
		$filas = 'No se encontraron categorías';
		if($categorias == FALSE){
			return $filas;
		}
		$filas = "  <table id='tblMenus' class='table table-striped table-bordered table-condensed'>
							<thead>
								<tr>
									<th>#</th>
									<th>Titulo</th>
									<th>Descripción</th>
								</tr>
							</thead>
					<tbody>";
		foreach ($categorias->result() as $row){
		    $filas.= "<tr>";
		    	$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->id . "</td>";
	    		$filas.= "<td>" .  $row->titulo . "</td>";
	    		$filas.= "<td> " .   $row->descripcion ."</td>";
			    $filas.= "</tr>";
		}
		$filas .= "</tbody></table>"; 
		return $filas;
	}

	public function get_tabla_categoria_panel(){
		$categorias = $this->catalogos->get_categorias();
		$filas = 'No se encontraron categorías';
		if($categorias == FALSE){
			return $filas;
		}
		$filas = "  <table id='tblMenus' class='table table-striped  table-bordered '>
							<thead>
								<tr>
									<th>#</th>
									<th>Titulo</th>
									<th class='cont_accion'>Acciones</th>
								</tr>
							</thead>
					<tbody>";
		foreach ($categorias->result() as $row){
		    $filas.= "<tr title='$row->descripcion'>";
		    	$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->id . "</td>";
	    		$filas.= "<td>" .  $row->titulo . "</td>";
	    		$filas.= "<td><div class='cont_accion'>" 
						."<a class='badge badge-success' href='"   . base_url("/panel/catalogo/edita_categoria/$row->id")   ."' rel='tooltip' title='Editar catálogo:  <br/>". $row->titulo . "'><i class='icon-edit icon-white'></i></a>"  
						."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/catalogo/borra_categoria/$row->id") ."' rel='tooltip' title='Borrar catálogo: <br/>". $row->titulo . "'><i class='icon-remove icon-white'></i></a>"  
						."</div></td>";
			    $filas.= "</tr>";
		}
		$filas .= "</tbody></table>"; 
		return $filas;
	}	

	public function get_tabla_producto_panel(){
		$productos = $this->catalogos->get_productos();
		$filas = 'No se encontraron productos';
		if($productos == FALSE){
			return $filas;
		}
		$filas = "  <table id='tblMenus' class='table table-striped  table-bordered '>
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Activo</th>
									<th class='cont_accion'>Acciones</th>
								</tr>
							</thead>
					<tbody>";
		foreach ($productos->result() as $row){
		    $filas.= "<tr title='$row->descripcion'>";
		    	$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->id . "</td>";
	    		$filas.= "<td>" .  $row->nombre . "</td>";
	    		$filas.= "<td>" .  $row->activo . "</td>";
	    		$filas.= "<td><div class='cont_accion'>" 
						."<a class='badge badge-success' href='"   . base_url("/panel/catalogo/edita_producto/$row->id")   ."' rel='tooltip' title='Editar producto:  <br/>". $row->nombre . "'><i class='icon-edit icon-white'></i></a>"  
						."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/catalogo/borra_producto/$row->id") ."' rel='tooltip' title='Borrar producto: <br/>". $row->nombre . "'><i class='icon-remove icon-white'></i></a>"  
						."</div></td>";
			    $filas.= "</tr>";
		}
		$filas .= "</tbody></table>"; 
		return $filas;
	}*/		

	public function guarda_banner(){
		$this->set_validacion_banner();
		if ($this->form_validation->run() == FALSE){
			//$this->edita_catalogo();
			echo validation_errors();
		}
		else{ 
			$this->banners->agrega_banner();
			redirect('/panel/banners/crea_banner', 'location');
		}
	}		

/*	public function guarda_categoria(){
		$this->set_validacion_catalogo();
		if ($this->form_validation->run() == FALSE){
			//$this->edita_catalogo();
			echo validation_errors();
		}
		else{ 
			$this->catalogos->agrega_categoria();
			redirect('/panel/catalogo/crea_categoria', 'location');
		}		
	}

	public function guarda_producto(){
		$this->set_validacion_producto();
		if ($this->form_validation->run() == FALSE){
			//$this->edita_catalogo();
			echo validation_errors();
		}
		else{ 
			
			//$img = $this->input->post('imagen');
			$titulo = $this->input->post('nombre');
			$imgs = $this->sube_foto_catalogo_productos($titulo);
			$this->catalogos->agrega_producto($imgs);
			redirect('/panel/catalogo', 'location');
		}	
	}	

	public function guarda_edicion_catalogo(){
		$this->set_validacion_catalogo();
		if($this->form_validation->run() == FALSE){
			//$this->crea_edicion_catalogo();
			echo validation_errors();
		}else{
			$this->catalogos->agrega_catalogo_editado();
			redirect('/panel/catalogo', 'location');
		}
	}

	public function guarda_edicion_categoria(){
		$this->set_validacion_categoria();
		if($this->form_validation->run() == FALSE){
			//$this->crea_edicion_catalogo();
			echo validation_errors();
		}else{
			$this->catalogos->agrega_categoria_editado();
			redirect('/panel/catalogo', 'location');
		}
	}

	public function guarda_edicion_producto(){
		$this->set_validacion_producto();
		if($this->form_validation->run() == FALSE){
			echo validation_errors();
			//$this->crea_edicion_catalogo();
		}else{
			$this->catalogos->agrega_producto_editado();
			redirect('/panel/catalogo', 'location');
		}
	}

	public function set_validacion_catalogo($value=''){
		$config = array(
			array(
				'field'   => 'titulo',
				'label'   => 'Titulo',
				'rules'   => 'required|trim|min_length[3]|is_unique[catalogos.titulo]'					
			)
        );	
		$this->form_validation->set_rules($config); 
	}

	public function set_validacion_categoria($value=''){
		$config = array(
			array(
				'field'   => 'titulo',
				'label'   => 'Titulo',
				'rules'   => 'required|trim|min_length[3]|is_unique[categorias_cat.titulo]'					
			)
        );	
		$this->form_validation->set_rules($config); 
	}	*/

	public function set_validacion_banner($value=''){
		$config = array(
			array(
				'field'   => 'nombre',
				'label'   => 'Nombre',
				'rules'   => 'required|trim|min_length[3]|is_unique[banners.nombre]'					
			)
        );	
		$this->form_validation->set_rules($config); 
	}

/*	public function sube_foto_catalogo_productos(){
		$str_img = ",";
		for ($i=0; $i < count($_FILES["imagen"]["name"]); $i++){ 
			if (($_FILES["imagen"]["type"][$i] == "image/gif") || ($_FILES["imagen"]["type"][$i] == "image/jpeg") || ($_FILES["imagen"]["type"][$i] == "image/png"))
			{
				$ext = explode(".", $_FILES["imagen"]["name"][$i]);
				$today = date("Y-m-d H:i:s");
				$today = str_replace("-", "", $today);
				$today = str_replace(":", "", $today);
				$today = str_replace(" ", "_", $today);
				$name = $today."_".$i.".".$ext[1];
				$archivo = $_FILES["imagen"]["tmp_name"][$i];
				$destino = $_SERVER['DOCUMENT_ROOT']."/vdiamonds/assets/img/catalogo"."/".$name;
				if(move_uploaded_file($archivo,$destino))
					$str_img = $str_img.$name.",";
			}
		}
		if ($str_img == ",")
			$str_img = "";
		return $str_img;
	}	*/
}
?>