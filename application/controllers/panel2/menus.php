<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Clase utilizada para el control y edicion de usuarios del cms AlineCMS
 * @author Roberto Urita Jimenez  @robertuj robertuj@gmail.com 
 * 
 */
class Menus extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->alinecms->is_LoggedAdmin()){
			redirect('/' , 'location');
		}
		$this->load->model('model_post', 'post');
		$this->load->model('model_menus', 'menu');
		$this->load->library('form_validation');
	}

	public function index(){
		$data['menus'] = $this->get_tabla_menu_panel();
		$data['head'] = $this->alinecms->get_head('Panel de articulos' , TRUE);
		$data['header'] = $this->alinecms->get_header('_4');
		$this->load->view('admin/menus/menus' , $data);
	}


	public function crea_menu(){
		$data['head'] = $this->alinecms->get_head('Panel de menus' , TRUE);
		$data['header'] = $this->alinecms->get_header('_4');
		$data['titulo_pagina'] = "Crea un nuevo menu";
		$data['descripcion_pagina'] = "crea un menu de navegación nuevo";
		$data['menus'] = $this->get_tabla_menu();
		$this->load->view('admin/menus/nuevo-menu' , $data);
	}

	public function guarda_menu(){
		$this->set_validacion_menu();

		if ($this->form_validation->run() == FALSE){
			$this->crea_menu();
		}
		else{ 
			$this->menu->agrega_menu();
			redirect('/panel/menus', 'location');
		}
	}

	public function set_validacion_menu($value=''){
			$config = array(
				array(
					'field'   => 'titulo',
					'label'   => 'Titulo',
					'rules'   => 'required|trim|min_length[3]|is_unique[menu.titulo]'
				)
	        );	
		$this->form_validation->set_rules($config); 
	}


	public function get_tabla_menu(){
		$menus = $this->menu->get_menus();
		$filas = 'No se encontraron menus';
		if($menus == FALSE){
			return $filas;
		}
		//if($tblarticulos->num_rows() == 0)   $filas = "<tr><td>Actualmente no hay usuarios registrados</td></tr>"; return $filas;
		$filas = "  <table id='tblMenus' class='table table-striped table-bordered table-condensed'>
							<thead>
								<tr>
									<th>#</th>
									<th>Titulo</th>
									<th>Descripción</th>
								</tr>
							</thead>
					<tbody>";
		
		foreach ($menus->result() as $row){
		    $filas.= "<tr>";
		    	$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->id . "</td>";
	    		$filas.= "<td>" .  $row->titulo . "</td>";
	    		$filas.= "<td> " .   $row->descripcion ."</td>";
	    		/*$filas.= "<td><div class='cont_accion'>" 
						."<a class='badge badge-success' href='"   . base_url("/panel/menus/edita_menu/$row->id")   ."' rel='tooltip' title='Editar menú:  <br/>". $row->titulo . "'><i class='icon-edit icon-white'></i></a>"  
						."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/menus/borrar_menu/$row->id") ."' rel='tooltip' title='Borrar menú: <br/>". $row->titulo . "'><i class='icon-remove icon-white'></i></a>"  
						."</div></td>";*/
			    $filas.= "</tr>";
		} // End ForEach
		$filas .= "</tbody></table>"; 
		return $filas;
	}//  __get_rows

	public function get_tabla_menu_panel(){
		$menus = $this->menu->get_menus();
		$filas = 'No se encontraron menus';
		if($menus == FALSE){
			return $filas;
		}
		//if($tblarticulos->num_rows() == 0)   $filas = "<tr><td>Actualmente no hay usuarios registrados</td></tr>"; return $filas;
		$filas = "  <table id='tblMenus' class='table table-striped  table-bordered '>
							<thead>
								<tr>
									<th>#</th>
									<th>Titulo</th>
									<th>Descripción</th>
									<th class='cont_accion'>Acciones</th>
								</tr>
							</thead>
					<tbody>";
		
		foreach ($menus->result() as $row){
		    $filas.= "<tr>";
		    	$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->id . "</td>";
	    		$filas.= "<td>" .  $row->titulo . "</td>";
	    		$filas.= "<td> " .   $row->descripcion ."</td>";
	    		$filas.= "<td><div class='cont_accion'>" 
						."<a class='badge badge-info	agrega_item' 	  href='"   . base_url("/panel/menus/agrega_item/$row->id") ."' rel='tooltip' title='Agrega items al menú: <br/>". $row->titulo . "'><i class='icon-plus icon-white'></i></a>"  
						."<a class='badge badge-warning ver_items' href='"   . base_url("/panel/menus/ver_items/$row->id") ."' rel='tooltip' title='Ver items del menú: <br/>". $row->titulo . "'><i class='icon-eye-open icon-white'></i></a>"  
						."<a class='badge badge-success' href='"   . base_url("/panel/menus/edita_menu/$row->id")   ."' rel='tooltip' title='Editar menú:  <br/>". $row->titulo . "'><i class='icon-edit icon-white'></i></a>"  
						."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/menus/borra_menu/$row->id") ."' rel='tooltip' title='Borrar menú: <br/>". $row->titulo . "'><i class='icon-remove icon-white'></i></a>"  
						."</div></td>";
			    $filas.= "</tr>";
		} // End ForEach
		$filas .= "</tbody></table>"; 
		return $filas;
	}//  __get_rows

	




	public function edita_menu($id = 0){
		$menu = $this->menu->get_menu_by_id($id);

		if($menu == FALSE){
			
		}


		$data['head'] = $this->alinecms->get_head('Edición de menus' , TRUE);
		$data['header'] = $this->alinecms->get_header('_4');
		$data['titulo_pagina'] = "Crea un nuevo menu";
		$data['descripcion_pagina'] = "crea un menu de navegación nuevo";
		$data['menus'] = $this->get_tabla_menu();
		$this->load->view('admin/menus/nuevo-menu' , $data);
	}













	public function borra_menu($id=0){
		$result = $this->menu->borrar($id);
		redirect('panel/menus', 'location'); 
	}



} // Fin Controlador Menu