<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Clase utilizada para el control y edicion de usuarios del cms AlineCMS
 * @author Roberto Urita Jimenez  @robertuj robertuj@gmail.com 
 * 
 */
class Menus extends CI_Controller {

	var $elementos = "";

	public function __construct(){
		parent::__construct();
		if(!$this->alinecms->is_LoggedAdmin()){
			redirect('/' , 'location');
		}
		$this->load->model('model_post', 'post');
		$this->load->model('model_menus', 'menu');
		$this->load->library('form_validation');
		$this->elementos = "";
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
		$data['paginas'] = $this->get_paginas_menus();
		$this->load->view('admin/menus/nuevo-menu' , $data);
	}

	public function get_paginas_menus(){
		$this->load->model('model_post');
		$paginas = $this->model_post->get_posts(2);
		$cadena_option = "";
		if($paginas->num_rows == 0) return $cadena_option;
		foreach ($paginas->result() as $row) {
			$cadena_option .= "<option value='$row->id_post'>$row->titulo</option>";	
		}
		return $cadena_option;
	}

	public function guarda_menu(){
		$this->set_validacion_menu();

		if ($this->form_validation->run() == FALSE){
			$this->edita_menu();
		}
		else{ 
			$this->menu->agrega_menu();
			redirect('/panel/menus', 'location');
		}
	}

	public function guarda_edicion_menu(){
		$this->set_validacion_menu();
		if($this->form_validation->run() == FALSE){
			$this->crea_edicion_menu();
		}else{
			$this->menu->agrega_menu_editado();
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
		$filas = "  <table id='tblMenus' class='table table-striped table-bordered table-condensed'>
							<thead>
								<tr>
									<th>#</th>
									<th>Titulo</th>
									<th>Descripción</th>
									<th>ID</th>
									<th>Clases</th>
								</tr>
							</thead>
					<tbody>";
		foreach ($menus->result() as $row){
		    $filas.= "<tr>";
		    	$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->id . "</td>";
	    		$filas.= "<td>" .  $row->titulo . "</td>";
	    		$filas.= "<td> " .   $row->descripcion ."</td>";
	    		$filas.= "<td> " .   $row->id_css ."</td>";
	    		$filas.= "<td> " .   $row->clase ."</td>";
	    				
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
		$filas = "  <table id='tblMenus' class='table table-striped  table-bordered '>
							<thead>
								<tr>
									<th>#</th>
									<th>Titulo</th>
									<th class='cont_accion'>Acciones</th>
								</tr>
							</thead>
					<tbody>";
		foreach ($menus->result() as $row){
		    $filas.= "<tr title='$row->descripcion'>";
		    	$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->id . "</td>";
	    		$filas.= "<td>" .  $row->titulo . "</td>";
	    		$filas.= "<td><div class='cont_accion'>" 
						."<a class='badge badge-info	agrega_item' 	  href='"   . base_url("/panel/menus/agrega_item/$row->id") ."' rel='tooltip' title='Agrega items al menú: <br/>". $row->titulo . "'><i class='icon-plus icon-white'></i></a>"  
						."<a class='badge badge-warning ver_items' href='"   . base_url("/panel/menus/ver_items/$row->id") ."' rel='tooltip' title='Ver items del menú: <br/>". $row->titulo . "'><i class='icon-eye-open icon-white'></i></a>"  
						."<a class='badge badge-success' href='"   . base_url("/panel/menus/edita_menu/$row->id")   ."' rel='tooltip' title='Editar menú:  <br/>". $row->titulo . "'><i class='icon-edit icon-white'></i></a>"  
						."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/menus/borra_menu/$row->id") ."' rel='tooltip' title='Borrar menú: <br/>". $row->titulo . "'><i class='icon-remove icon-white'></i></a>"  
						."</div></td>";
			    $filas.= "</tr>";
		}
		$filas .= "</tbody></table>"; 
		return $filas;
	}

	public function edita_menu($id = 0){
		$menu = $this->menu->get_menu_by_id($id);
		if($menu == FALSE){
			
		}
		$ids_post = substr($menu->row('id_post'), 1, -1);
		$data = array(
					"titulo_menu" => $menu->row('titulo'),
					"descripcion" => $menu->row('descripcion'),
					"id_css" => $menu->row('id_css'),
					"clase" => $menu->row('clase'),
					"atributos" => $menu->row('atributos'),
					"id_post" => $ids_post
				);
		$data['id_menu'] = $id;
		$data['head'] = $this->alinecms->get_head('Edición de menus' , TRUE);
		$data['header'] = $this->alinecms->get_header('_4');
		$data['titulo_pagina'] = "Edita menu";
		$data['descripcion_pagina'] = "edita un menu de navegación";
		$data['menus'] = $this->get_tabla_menu();
		$data['paginas'] = $this->get_paginas_menus();
		$this->load->view('admin/menus/edita_menu' , $data);
	}

	public function borra_menu($id=0){
		$result = $this->menu->borrar($id);
		redirect('panel/menus', 'location'); 
	}

	public function agrega_item($idMenu=0){
		$data['head'] = $this->alinecms->get_head('Edición de menus' , TRUE);
		$data['header'] = $this->alinecms->get_header('_4');
		$data['titulo_pagina'] = "Crea un nuevo item de menu";
		$data['descripcion_pagina'] = "crea un nuevo item para un menu de navegación";
		$data['menu_id'] = $idMenu;
		$data['padres'] = $this->get_padres($idMenu,'0');
		$this->load->view('admin/menus/agrega_items' , $data);
	}

	public function get_padres($idMenu = 0, $padre = 0,$idPadre2 = 0){
		// Obtenemos todos los items padre
		$items = $this->menu->get_ItemsMenu($idMenu,$padre);  
		$elementos = "<ul>";
			$clase_extra = "";
			if($idPadre2 == 0){
				$clase_extra="padre_sel";
			}
		if($padre == 0){ $elementos = "00. <a class='clPadre $clase_extra' idItem='0' href='#'>  El elemento es padre</a><ul id='menuPadres' class=''>";}
		// Verificamos que exista algun item de menu padre para proseguir con la consulta
		if($items->num_rows == 0 and $padre == 0){
			$elementos = "<ul class='nav nav-pills nav-stacked'><li idItem='0' class='item_menu_' idItem='0'>No hay items de menu en la base de datos.</li></ul><br/>";
			return $elementos;
		}
		// Recorremos el arbol de elementos padre buscando hijos 
		foreach($items->result() as $row){
			$hijos = $this->menu->get_hijos($idMenu,$row->idItem);
			if($padre == 0){
			
					$clase_extra = "";

					if($idPadre2 == $row->idItem && $idPadre2 != 0){
						$clase_extra="padre_sel";
					}
					
					$elementos .= "<li class='soyPadre'> <a idItem='". $row->idItem. "' class='clPadre ".$clase_extra."' href='#'>" . $row->titulo . "</a>";
			}else{
			
					$clase_extra = "";

					if($idPadre2 == $row->idItem && $idPadre2 != 0){
						$clase_extra="padre_sel";
					}

				$elementos .= "<li><a idItem='". $row->idItem. "' class='clPadre ".$clase_extra."' href='#'>" . $row->titulo . "</a>";
			}
			$elementos .= '</li>';	
			if($hijos > 0){
				$elementos .= $this->get_padres($idMenu,$row->idItem);
			}
		} 
		$elementos .='</ul>';
		return $elementos;
	} 

	public function crea_item_menu(){
		$this->menu->crea_item_menu();
		echo "1";
	}

	public function edita_item_menu(){
		$this->menu->edita_item_menu($idItem);
	}

	public function ver_items($idMenu=0){
		$menus = $this->get_padres_vista($idMenu,0);
		echo $menus;
	}

	public function get_padres_vista($idMenu = 0, $padre = 0){
		//echo "IdMenu --> $idMenu <br/>";
		//echo "Padre --> $padre <br/>";
		// Obtenemos todos los items padre
		$items = $this->menu->get_ItemsMenu($idMenu,$padre);  
		$elementos = "<ul>";
		if($padre == 0){ $elementos = "<ul id='menuPadres' class=''>";}
		// Verificamos que exista algun item de menu padre para proseguir con la consulta
		if($items->num_rows == 0 and $padre == 0){
			$elementos = "<ul class='nav nav-pills nav-stacked'><li idItem='0' class='item_menu_' idItem='0'>No hay items de menu en la base de datos.</li></ul><br/>";
			return $elementos;
		}
		// Recorremos el arbol de elementos padre buscando hijos 
		foreach($items->result() as $row){
			$hijos = $this->menu->get_hijos($idMenu,$row->idItem);
			$estilo = "";
			if ($row->estado == 1) {$estilo = "color:gray";}
			$iconito = "icon-thumbs-up";
			$color="";
			if($row->estado == 0){$iconito = "icon-thumbs-down";$color="style='color:gray;'";}
			if($padre == 0){
				$elementos .= "  <li class='soyPadre'>
								 <div class='cont_items_first'>
								 	<a $color idItem='". $row->idItem. "' class='clPadre' href='#'>" . $row->titulo . "</a>	
								 	<div  class='cont_act'>
									 	<a estado='".$row->estado."' title='Activar/Desactivar Item' class='item_link act_activar' href='". base_url('panel/menus/activa/') . "/". $row->idItem . "'><i class='$iconito'></i></a>  
										<a title='Editar Item' class='item_link act_editar' href='". base_url('panel/menus/edita_item/') . "/". $row->idItem . "'><i class='icon-pencil'></i></a>
										<a title='Eliminar Item' class='item_link act_eliminar' href='". base_url('panel/menus/elimina_item/') . "/". $row->idItem . "'><i class='icon-remove-sign'></i></a> 
									</div>
								 </div>" ;
			}else{
				$elementos .= " <li>
								<div class='cont_items_first'>
									<a $color idItem='". $row->idItem. "' class='clPadre' href='#'>" . $row->titulo . "</a>	
									<div class='cont_act'>
										<a estado='".$row->estado."' title='Activar/Desactivar Item' class='item_link act_activar' href='". base_url('panel/menus/activa/') . "/". $row->idItem . 		"'><i class='$iconito'></i></a>
										<a title='Editar Item' class='item_link act_editar' href='". base_url('panel/menus/edita_item/') . "/". $row->idItem . 		"'><i class='icon-pencil'></i></a>
										<a title='Eliminar Item' class='item_link act_eliminar' href='". base_url('panel/menus/elimina_item/') . "/". $row->idItem . 	"'><i class='icon-remove-sign'></i></a> 
									</div>									
								</div>";
			}
			$elementos .= '</li>';	
			if($hijos > 0){
				$elementos .= $this->get_padres_vista($idMenu,$row->idItem);
			}
		} 
		$elementos .='</ul>';
		return $elementos;
	} 

	public function get_paginas($tipo = 1){
		$this->load->model('model_post');
		$articulos = $this->model_post->get_posts($tipo);
		$data['articulos'] = $this->get_tabla_articulos($articulos);
		echo $data['articulos'];
	}

	public function get_tabla_articulos($tblarticulos = ""){
		$filas = '';
		$filas = "  <table id='tblarticulos' class='table table-striped table-bordered table-condensed'>
							<thead>
								<tr>
									<th>Titulo</th>
									<th>Slug</th>
									<th>Categorias</th>
									<th>Fecha</th>
									<th style='text-align:center;'>Accion</th>
								</tr>
							</thead>
					<tbody>";
		if( $tblarticulos == FALSE ){$filas = "No hay articulos creados."; return $filas; }	
		foreach ($tblarticulos->result() as $row){
			if(is_null($row->cnombre)) $row->cnombre = "Sin Categoria";
		    $filas.= "<tr class='btnSeltr' id='mf_". $row->id_post ."' idpost='".$row->id_post."' >";
	    		$filas.= "<td>" .  $row->titulo . "</td>";
	    		$filas.= "<td> " .  $row->slug 			."</td>";
	    		$filas.= "<td> " .   $row->cnombre   	."</td>";
				$filas.= "<td>".$row->fecha_publicacion	."</td>";
				$filas.= "<td><div class='cont_accion'>" 
					//."<a class='badge badge-success' href='#' rel='tooltip' title='Seleccionar este elemento: ". $row->titulo . "'><i class='icon-eye-open icon-white'></i></a>"  
					."<a id_post='". $row->id_post ."' class='badge btnSel' href='#' rel='tooltip' title='Seleccionar esta página: ". $row->titulo . "'><i class='icon-asterisk icon-white'></i></a>"  
					."</div></td>";
			    $filas.= "</tr>";
		}
		$filas .= "</tbody></table>"; 
		return $filas;
	}

// ITEMS MENU FUNCIONES 

	// Edicion de elementos del menu
	public function edita_item($id=0){
		$data['row']  = $this->menu->get_datos_item($id);
		$data['head'] = $this->alinecms->get_head('Edición de menus' , TRUE);
		$data['header'] = $this->alinecms->get_header('_4');
		$data['titulo_pagina'] = "Crea un nuevo item de menu";
		$data['descripcion_pagina'] = "crea un nuevo item para un menu de navegación";
		$data['menu_id'] = $this->menu->get_id_item_menu($id);
		$padre = $this->menu->get_padre_item_menu($id);
		$data['padres'] = $this->get_padres($data['menu_id'],'0',$padre);
		$this->load->view('admin/menus/edita_item', $data);
	}

	public function borrar_item(){
		$idItem = $this->input->post('id');
		$this->menu->borra_item($idItem);
	}

	public function activa_item(){
		$this->menu->activa_item();
	}
}