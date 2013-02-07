<?php

class Model_post extends CI_Model {

	var $tabla = "post";

    function __construct()
    {
        parent::__construct();
    }
	

	function get_posts($tipo = "1"){
		$strSql = " SELECT p.id as id_post,p.*,c.nombre as cnombre,c.slug as cslug,u.* 
					FROM post p 
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




	public function agrega_articulo(){
		$id_autor = $this->session->userdata('id');
		$id_categoria = $this->input->post('categoria');
		$titulo = $this->input->post('titulo');
		$slug = $this->input->post('slug');
		$contenido = $this->input->post('contenido');
		$fecha = date("y-m-d");
		$fecha_publicacion = $fecha;
		$fecha_despublicacion = $fecha;
		$estado = 1;
		$etiquetas = $this->input->post('etiquetas');
		$tipo = 1;
		$pag_inicio = $this->input->post('pag_inicio', true);

		$data = array(
			'id_autor' => $id_autor ,
			'id_categoria' => $id_categoria ,
			'titulo' => $titulo ,
			'slug' => $slug ,
			'contenido' => $contenido ,
			'fecha' => $fecha ,
			'fecha_publicacion' => $fecha_publicacion ,
			'fecha_despublicacion' => $fecha_despublicacion ,
			'estado' => $estado ,
			'etiquetas' => $etiquetas ,
			'tipo' => $tipo,
			'pag_inicio' => $pag_inicio
		);

		$this->db->insert('post', $data); 
	}

	public function agrega_pagina(){
		$id_autor = $this->session->userdata('id');
		$id_categoria = $this->input->post('categoria');
		$titulo = $this->input->post('titulo');
		$slug = $this->input->post('slug');
		$contenido = $this->input->post('contenido');
		$fecha = date("y-m-d");
		$fecha_publicacion = $fecha;
		$fecha_despublicacion = "0000-00-00";
		$estado = 1;
		$etiquetas = $this->input->post('etiquetas');
		$tipo = 2;
		$plantilla = $this->input->post('plantilla');

		$data = array(
			'id_autor' => $id_autor ,
			'id_categoria' => $id_categoria ,
			'titulo' => $titulo ,
			'slug' => $slug ,
			'contenido' => $contenido ,
			'fecha' => $fecha ,
			'fecha_publicacion' => $fecha_publicacion ,
			'fecha_despublicacion' => $fecha_despublicacion ,
			'estado' => $estado ,
			'etiquetas' => $etiquetas ,
			'tipo' => $tipo,
			'plantilla' => $plantilla
		);

		$this->db->insert('post', $data); 
	}


	public function actualiza_pagina(){
		$id = $this->input->post('id');
		$id_autor = $this->session->userdata('id');
		$id_categoria = $this->input->post('categoria');
		$titulo = $this->input->post('titulo');
		$slug = $this->input->post('slug');
		$contenido = $this->input->post('contenido');
		$fecha = date("y-m-d");
		$fecha_publicacion = $fecha;
		$fecha_despublicacion = "0000-00-00";
		$estado = 1;
		$etiquetas = $this->input->post('etiquetas');
		$tipo = 2;
		$plantilla = $this->input->post('plantilla');
		$data = array(
			'id_autor' => $id_autor ,
			'titulo' => $titulo ,
			'slug' => $slug ,
			'contenido' => $contenido ,
			'fecha' => $fecha ,
			'fecha_publicacion' => $fecha_publicacion ,
			'fecha_despublicacion' => $fecha_despublicacion ,
			'etiquetas' => $etiquetas ,
			'plantilla' => $plantilla
		);

		$this->db->where('id', $id);
		$this->db->update('post', $data); 
	}

	// FABIAN EDICION ARTICULOS BLOG

	public function actualiza_articulo(){
		$id = $this->input->post('id');
		$id_autor = $this->session->userdata('id');
		$id_categoria = $this->input->post('categoria');
		$titulo = $this->input->post('titulo');
		$slug = $this->input->post('slug');
		$contenido = $this->input->post('contenido');
		$fecha = date("y-m-d");
		$fecha_publicacion = $fecha;
		$fecha_despublicacion = "0000-00-00";
		$estado = 1;
		$etiquetas = $this->input->post('etiquetas');
		$tipo = 1;
		$pag_inicio = $this->input->post('pag_inicio', true);
		$data = array(
			'id_autor' => $id_autor ,
			'titulo' => $titulo ,
			'slug' => $slug ,
			'contenido' => $contenido ,
			'fecha' => $fecha ,
			'fecha_publicacion' => $fecha_publicacion ,
			'fecha_despublicacion' => $fecha_despublicacion ,
			'etiquetas' => $etiquetas ,
			'pag_inicio' => $pag_inicio
		);

		$this->db->where('id', $id);
		$this->db->update('post', $data); 
	}

	// FIN EDICION ARTICULOS BLOG

	function get_post_by_id($id = 0){
		if($id == 0) return FALSE;
		$query = $this->db->get_where('post',array('id' => $id),1);
		if($query->num_rows == 0) return FALSE;
		return $query;
	}


	function get_usuarios($filtro = ''){

		$this->db->order_by('perfil'); 
		if($filtro != ''){
			// $filtro ==  [| 1 = Admin | 2 = Editor | 3 = Suscriptor |] 
			$this->db->where('perfil',$filtro);
		}
		$consulta = $this->db->get('usuarios');
		return $consulta;
	}
	
	function borrar_articulo($id=0){
		if( $id != 0){
			$this->db->where('id', $id);
			$this->db->delete($this->tabla);
		}
		return TRUE;
	}

	function get_perfiles(){
		$strSql = "SELECT perfil,count(id) AS cantidad FROM usuarios GROUP BY perfil"; 
		$result = $this->db->query($strSql);
		return $result;
	}

	function inserta_usuario_nuevo(){
			$nombre = $this->input->post('nombre');
			$apellidos = $this->input->post('apellidos');
			$usuario = $this->input->post('usuario');
			$pass = $this->input->post('pass');
			$email = $this->input->post('email');
			$perfil = $this->input->post('perfil');

			$data = array(
				'nombre' => ucwords($nombre) ,
				'apellidos' => ucwords($apellidos) ,
				'usuario' => strtolower($usuario),
				'usuario' => $usuario ,
				'pass' => md5($pass) ,
				'email' => $email ,
				'perfil' => $perfil 
			);

			$this->db->insert('usuarios', $data); 
	}

	function existe_usuario($tipo = ''){
		$usuario = $this->input->post('usuario');
		if($tipo != ""){
			$id = $this->input->post('id');
			$busca = $this->db->get_where('usuarios', array('id' => $id) , 1);
			$usr = $busca->row();
			$usr_old = $usr->usuario;
			$condiciones = array('usuario' => $usuario, 'usuario !=' => $usr_old);
		}else{
			$condiciones = array('usuario' => $usuario);
		}
		$query = $this->db->get_where('usuarios', $condiciones , 1);
		if( $query->num_rows() > 0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function existe_email($tipo = ''){
		$email = $this->input->post('email');
		if($tipo != ""){
			$id = $this->input->post('id');
			$busca = $this->db->get_where('usuarios', array('id' => $id) , 1);
			$usr = $busca->row();
			$mail_old = $usr->email;
			$condiciones = array('email' => $email, 'email !=' => $mail_old);
		}else{
			$condiciones = array('email' => $email);
		}
		$query = $this->db->get_where('usuarios', $condiciones ,  1);
		if( $query->num_rows() == 1) {
			return TRUE;
		}else{
			return FALSE;
		}
	}


	function get_usuario_by_id($id=0){
		if( ! $id == 0 ){
			$limit = 1;
			$query = $this->db->get_where('usuarios', array('id' => $id), $limit);
			return $query;
		}
	}

	function verifica_usuario(){
		$usuario = $this->input->post('usuario');
		$pass = md5($this->input->post('pass'));
	
		$this->db->where('usuario',$usuario);
		$this->db->where('pass',$pass);
		$this->db->limit(1);
		$query = $this->db->get('usuarios');
		
		if( $query->num_rows() > 0){
			return $query;
		}else return FALSE;
	}


	function guarda_edicion_usuario(){
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre');
			$apellidos = $this->input->post('apellidos');
			$usuario = $this->input->post('usuario');
			
			if( $this->input->post('new_pass') != ""){
				$pass = $this->input->post('new_pass');
				$pass = md5($pass);
			}else{
				$pass = $this->input->post('pass');
			}
			$email = $this->input->post('email');
			$perfil = $this->input->post('perfil');

			$data = array(
				'nombre' => ucwords($nombre) ,
				'apellidos' => ucwords($apellidos) ,
				'usuario' => strtolower($usuario),
				'usuario' => $usuario ,
				'pass' => $pass ,
				'email' => $email ,
				'perfil' => $perfil 
			);
			$this->db->where('id', $id);
			$this->db->update('usuarios', $data); 

	}
		
}

/* End of file Model_usuarios.php */
/* Location: ./application/models/Model_usuarios.php */