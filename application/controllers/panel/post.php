<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Clase utilizada para el control y edicion de usuarios del cms AlineCMS
 * @author Roberto Urita Jimenez  @robertuj robertuj@gmail.com 
 * 
 */
class Post extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->alinecms->is_LoggedAdmin()){
			redirect('panel/admin' , 'location');
		}

		$this->load->model('model_post', 'post');
		$this->load->library('form_validation');
	}
			
	public function index($filtro = '',$actualizado = ""){
		$articulos = $this->post->get_posts();
		$data['head'] = $this->alinecms->get_head('Panel de articulos' , TRUE);
		$data['header'] = $this->alinecms->get_header('_2');
		$data['articulos'] = $this->get_tabla_articulos($articulos);
		$this->load->view('admin/post/post',$data);
	}
	
	

	public function crea_articulo(){
		$this->load->helper(array('form','ckeditor'));
		$data['head'] = $this->alinecms->get_head('Panel de articulos' , TRUE);
		$data['header'] = $this->alinecms->get_header('_2');
		$data['titulo_pagina'] = "Crea un nuevo articulo";
		$data['categorias'] = $this->dame_categorias();
		$data['descripcion_pagina'] = "";
		$this->load->view('admin/post/nuevo-post',$data);
	}

	public function guarda_articulo(){
		$this->set_validacion();

		if ($this->form_validation->run() == FALSE){
			$this->crea_articulo();
		}
		else{ 
			$this->post->agrega_articulo();
			redirect('/panel/post', 'location');
		}
	}



	// FABIAN EDICION ARTICULOS BLOG


	public function edita_post($id = 0){
		$articulo = $this->post->get_post_by_id($id);
		$data["row"] = $articulo->row();
		$this->load->helper(array('form','ckeditor'));
		$data['head'] = $this->alinecms->get_head('Edición de artículos' , TRUE);
		$data['header'] = $this->alinecms->get_header('_2');
		$data['titulo_pagina'] = "Edición de contenido de artículos";
		$data['categorias'] = $this->dame_categorias();
		$data['descripcion_pagina'] = "";
		$this->load->view('admin/post/edita-post', $data);
	}

	public function guarda_edicion_articulo(){
		$this->set_edicion_articulo();

		if ($this->form_validation->run() == FALSE){
			$this->crea_articulo();
		}
		else{
			
			$this->post->actualiza_articulo();
			redirect('/panel/post', 'location');
		}
	}

	public function set_edicion_articulo($value='')
	{
		$this->load->library('form_validation');
			$slug_ = $this->input->post('slug');
			$slug_old_ = $this->input->post('slug_old');

			if($slug_ != $slug_old_){
				
				$config = array(
					array(
						'field'   => 'titulo',
						'label'   => 'Titulo',
						'rules'   => 'required|trim|min_length[3]'
					),
					array(
						'field'   => 'slug',
						'label'   => 'Slug',
						'rules'   => 'required|trim|min_length[3]|alpha_dash|is_unique[post.slug]'
					),
					array(
						'field'   => 'contenido',
						'label'   => 'Contenido',
						'rules'   => 'required|trim|min_length[3]'
					)  
	        	);	
			}else{
				
				$config = array(
					array(
						'field'   => 'titulo',
						'label'   => 'Titulo',
						'rules'   => 'required|trim|min_length[3]'
					),
					array(
						'field'   => 'slug',
						'label'   => 'Slug',
						'rules'   => 'required|trim|min_length[3]|alpha_dash'
					),
					array(
						'field'   => 'contenido',
						'label'   => 'Contenido',
						'rules'   => 'required|trim|min_length[3]'
					)  
	        	);
			}

		$this->form_validation->set_rules($config); 
	}





	//FIN EDICION ARTICULOS BLOG







	public function dame_categorias(){
		$categorias = $this->post->get_categorias();
		$Cat = "<select name='categoria'>";
		if($categorias->num_rows > 0 ){
			$Cat .= "<option value='0'>Sin categoría</option>";
			foreach ($categorias->result() as $row) {
				$Cat .= "<option " . set_select('categoria', "$row->id")  ."  value='$row->id'>$row->nombre</option>";
			}
		}else{
			$Cat .= "<option value='0'>No hay categorias creadas</option>";
		}
		$Cat .= "</select>";
		return $Cat;
	}

	public function set_validacion($value='')
	{
		$this->load->library('form_validation');
			$config = array(
				array(
					'field'   => 'titulo',
					'label'   => 'Titulo',
					'rules'   => 'required|trim|min_length[3]'
				),
				array(
					'field'   => 'slug',
					'label'   => 'Slug',
					'rules'   => 'required|trim|min_length[3]|alpha_dash|is_unique[post.slug]'
				),
				array(
					'field'   => 'contenido',
					'label'   => 'Contenido',
					'rules'   => 'required|trim|min_length[3]'
				)  
	        );	
		$this->form_validation->set_rules($config); 
	}

	public function get_tabla_articulos($tblarticulos = ""){
		$filas = '';
		//if($tblarticulos->num_rows() == 0)   $filas = "<tr><td>Actualmente no hay usuarios registrados</td></tr>"; return $filas;
		$filas = "  <table id='tblarticulos' class='table table-striped'>
							<thead>
								<tr>
									<th>Titulo</th>
									<th>Slug</th>
									<th>Autor</th>
									<th>Categorias</th>
									<th>Etiquetas</th>
									<th>Fecha</th>
									<th>Accion</th>
								</tr>
							</thead>
					<tbody>";
		if( $tblarticulos == FALSE ){$filas = "No hay articulos creados."; return $filas;}	

		foreach ($tblarticulos->result() as $row){
		    $filas.= "<tr>";
	    		$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->titulo . "</td>";
	    		$filas.= "<td> " .   $row->slug ."</td>";
	    		$filas.= "<td> " .  $row->nombre . " " . $row->apellidos .  "</td>";
				// Aqui se creara una consulta para multiples categorias
				$filas.= "<td> " .   $row->cnombre ."</td>";
				$filas.= "<td> " .   $row->etiquetas ."</td>";
				$filas.= "<td>".$row->fecha_publicacion."</td>";
				$filas.= "<td><div class='cont_accion'>" 
					."<a class='badge badge-success' href='"   . base_url("/panel/post/edita_post/$row->id_post")   ."' rel='tooltip' title='Editar el articulo:  <br/>". $row->titulo . "'><i class='icon-edit icon-white'></i></a>"  
					."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/post/borrar_post/$row->id_post") ."' rel='tooltip' title='Eliminar el articulo: <br/>". $row->titulo . "'><i class='icon-remove icon-white'></i></a>"  
					."</div></td>";
			    $filas.= "</tr>";
		} // End ForEach
		$filas .= "</tbody></table>"; 
		return $filas;
	}//  __get_rows


	public function panel_paginas(){
		$articulos = $this->post->get_posts("2");
		$data['head'] = $this->alinecms->get_head('Panel de Páginas' , TRUE);
		$data['header'] = $this->alinecms->get_header('_3');
		$data['paginas'] = $this->get_tabla_paginas($articulos);
		$this->load->view('admin/post/paginas',$data);
	}
	
	public function crea_pagina(){
		$this->load->helper(array('form','ckeditor'));
		$data['head'] = $this->alinecms->get_head('Panel de páginas' , TRUE);
		$data['header'] = $this->alinecms->get_header('_3');
		$data['titulo_pagina'] = "Crea una nueva página";
		//$data['categorias'] = $this->dame_categorias();
		$data['descripcion_pagina'] = "";
		$this->load->view('admin/post/nueva-pagina',$data);
	}

	public function guarda_pagina(){
		$this->set_validacion_pagina();

		if ($this->form_validation->run() == FALSE){
			$this->crea_pagina();
		}
		else{ 
			$this->post->agrega_pagina();
			redirect('/panel/post/panel_paginas', 'location');
		}
	}
	public function set_validacion_pagina($value='')
	{
		$this->load->library('form_validation');
			$config = array(
				array(
					'field'   => 'titulo',
					'label'   => 'Titulo',
					'rules'   => 'required|trim|min_length[3]'
				),
				array(
					'field'   => 'slug',
					'label'   => 'Slug',
					'rules'   => 'required|trim|min_length[3]|alpha_dash|is_unique[post.slug]'
				),
				array(
					'field'   => 'contenido',
					'label'   => 'Contenido',
					'rules'   => 'required|trim|min_length[3]'
				)  
	        );	
		$this->form_validation->set_rules($config); 
	}


	public function edita_pagina($id = 0){
		$pagina = $this->post->get_post_by_id($id);
		$data["row"] = $pagina->row();

		$this->load->helper(array('form','ckeditor'));
		$data['head'] = $this->alinecms->get_head('Edicion de páginas' , TRUE);
		$data['header'] = $this->alinecms->get_header('_3');
		$data['titulo_pagina'] = "Edición de contenido de páginas";
		$data['descripcion_pagina'] = "";
		
		$this->load->view('admin/post/edita-pagina',$data);
	}

	public function guarda_edicion_pagina(){
		$this->set_edicion_pagina();

		if ($this->form_validation->run() == FALSE){
			$this->crea_pagina();
		}
		else{ 
			$this->post->actualiza_pagina();
			redirect('/panel/post/panel_paginas', 'location');
		}
	}

	public function set_edicion_pagina($value='')
	{
		$this->load->library('form_validation');
			$slug_ = $this->input->post('slug');
			$slug_old_ = $this->input->post('slug_old');

			if($slug_ != $slug_old_){
				
				$config = array(
					array(
						'field'   => 'titulo',
						'label'   => 'Titulo',
						'rules'   => 'required|trim|min_length[3]'
					),
					array(
						'field'   => 'slug',
						'label'   => 'Slug',
						'rules'   => 'required|trim|min_length[3]|alpha_dash|is_unique[post.slug]'
					),
					array(
						'field'   => 'contenido',
						'label'   => 'Contenido',
						'rules'   => 'required|trim|min_length[3]'
					)  
	        	);	
			}else{
				
				$config = array(
					array(
						'field'   => 'titulo',
						'label'   => 'Titulo',
						'rules'   => 'required|trim|min_length[3]'
					),
					array(
						'field'   => 'slug',
						'label'   => 'Slug',
						'rules'   => 'required|trim|min_length[3]|alpha_dash'
					),
					array(
						'field'   => 'contenido',
						'label'   => 'Contenido',
						'rules'   => 'required|trim|min_length[3]'
					)  
	        	);
			}

			





		$this->form_validation->set_rules($config); 
	}
	

	public function get_tabla_paginas($tblarticulos = ""){
		$filas = '';
		//if($tblarticulos->num_rows() == 0)   $filas = "<tr><td>Actualmente no hay usuarios registrados</td></tr>"; return $filas;
		$filas = "  <table id='tblarticulos' class='table table-striped'>
							<thead>
								<tr>
									<th>Id</th>
									<th>Titulo</th>
									<th>Slug</th>
									<th>Autor</th>
									<th>Categorias</th>
									<th>Etiquetas</th>
									<th>Fecha</th>
									<th>Accion</th>
								</tr>
							</thead>
					<tbody>";
		if( $tblarticulos == FALSE ){$filas = "No hay pagínas creadas."; return $filas;}	

		foreach ($tblarticulos->result() as $row){
		    $filas.= "<tr>";
		    	$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->id_post . "</td>";
	    		$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->titulo . "</td>";
	    			$filas.= "<td> " .   $row->slug ."</td>";
	    		$filas.= "<td> " .  $row->nombre . " " . $row->apellidos .  "</td>";
				// Aqui se creara una consulta para multiples categorias
				$filas.= "<td> " .   $row->cnombre ."</td>";
				$filas.= "<td> " .   $row->etiquetas ."</td>";
				$filas.= "<td>".$row->fecha_publicacion."</td>";
				$filas.= "<td><div class='cont_accion'>" 
					."<a class='badge badge-success' href='"   . base_url("/panel/post/edita_pagina/$row->id_post")   ."' rel='tooltip' title='Editar la página:  <br/>". $row->titulo . "'><i class='icon-edit icon-white'></i></a>"  
					."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/post/borrar_pagina/$row->id_post") ."' rel='tooltip' title='Eliminar la página: <br/>". $row->titulo . "'><i class='icon-remove icon-white'></i></a>"  
					."</div></td>";
			    $filas.= "</tr>";
		} // End ForEach
		$filas .= "</tbody></table>"; 
		return $filas;
	}//  __get_rows
	
	/**
	 * Funcion que borra un usuario 
	 * @var integer $id {Id del usuario a borrar}
	 */
	public function borrar_post($id=0){
		$result = $this->post->borrar_articulo($id);
		redirect('panel/post', 'location'); 
	}
	/**
	 * Funcion que borra un usuario 
	 * @var integer $id {Id del usuario a borrar}
	 */
	public function borrar_pagina($id=0){
		$result = $this->post->borrar_articulo($id);
		redirect('panel/post/panel_paginas', 'location'); 
	}


/**********************************************************************************/
	public function inicia_sesion(){
		$query = $this->usr->verifica_usuario();
		if($query != FALSE){
			$row = $query->row();		
			$newdata = array(
				'id'  => "$row->id",
				'nombre'  => "$row->nombre",
				'apellidos'  => "$row->apellidos",
				'usuario'  => "$row->usuario",
				'pass'  => "$row->pass",
				'email'  => "$row->email",
				'perfil'  => "$row->perfil",  // 1 Admin  || 2 Editor  || 3 Suscriptor
				'logged_in' => TRUE
			);
			$this->session->set_userdata($newdata);
			redirect(base_url('panel/admin'),'refresh');
		}else {
			redirect(base_url('panel/admin/index/fail'),'refresh');
		}
	}// End authenticate function

	public function cerrar_sesion(){
		$this->session->sess_destroy();
		redirect('/','refresh');
	}
	
	
}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */