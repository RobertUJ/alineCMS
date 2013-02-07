<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Clase utilizada para el control y edicion de usuarios del cms AlineCMS
 * @author Roberto Urita Jimenez  @robertuj robertuj@gmail.com 
 * 
 */
class Preguntas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_preguntas', 'pre');
		$this->load->model('model_usuarios' , 'usr');
		$this->load->library('Alinecms');
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
	}



	public function index(){

		$data['preguntas'] = $this->get_tabla_preguntas();
		$data['head'] = $this->alinecms->get_head('Panel de usuarios',TRUE);
		$data['header'] = $this->alinecms->get_header('_5');
		$this->load->view('admin/preguntas/panel-preguntas',$data);
	}

	public function get_categorias(){
		$query = $this->pre->get_categorias();
		$categorias = "<option value=''>Seleccione una categoria por favor.</value>";
		
		if($query == FALSE){
			$categorias = "<option value=''>Actualmente no hay categorias.</value>";
			return $categorias;
		}

		foreach ($query->result() as $row) {
			$categorias .= "<option value='$row->idcat'>$row->requerimiento | $row->categoria</value>";
		}
		return $categorias;
	}

	public function nueva_pregunta(){
		$data['head'] = $this->alinecms->get_head('Panel de preguntas',TRUE);
		$data['categorias'] = $this->get_categorias();
		$data['header'] = $this->alinecms->get_header('_5');
		$this->load->view('admin/preguntas/nueva-pregunta',$data);
	}
	public function nueva_categoria(){
		$data['categorias'] = $this->get_tabla_cat();
		$data['head'] = $this->alinecms->get_head('Panel de preguntas',TRUE);
		$data['header'] = $this->alinecms->get_header('_5');
		$this->load->view('admin/categorias/nueva-categoria',$data);
	}


	public function crea_pregunta(){
		$this->set_validacion();

		if ($this->form_validation->run() == FALSE){
			$this->nueva_pregunta();
			
		}
		else{
			$this->pre->inserta_pregunta_nueva();
			$data['save_true'] = "Pregunta guardada satisfactoriamente.";
			$data['head'] = $this->alinecms->get_head('Panel de preguntas',TRUE);
			$data['categorias'] = $this->get_categorias();
			$data['header'] = $this->alinecms->get_header('_5');
			$this->load->view('admin/preguntas/nueva-pregunta',$data);
		}

	}

	function set_validacion(){
		$this->form_validation->set_message('is_unique', 'Esta pregunta ya existe');
		$config = array(
               array(
                     'field'   => 'categoria',
                     'label'   => 'Categoria',
                     'rules'   => 'required|trim|min_length[1]'
                  ),
               array(
                     'field'   => 'pregunta',
                     'label'   => 'Pregunta',
                     'rules'   => 'required|trim|min_length[4]|is_unique[preguntas.pregunta]'
                  )
            );

		$this->form_validation->set_rules($config); 
	}

	public function crea_categoria(){
		$this->set_validacion_cat();

		if ($this->form_validation->run() == FALSE){
			$this->nueva_categoria();
		}
		else{
			$this->pre->inserta_categoria_nueva();
			$data['save_true'] = "Categoria guardada satisfactoriamente.";
			$data['categorias'] = $this->get_tabla_cat();
			$data['head'] = $this->alinecms->get_head('Panel de preguntas',TRUE);
			$data['header'] = $this->alinecms->get_header('_5');
			$this->load->view('admin/categorias/nueva-categoria',$data);
		}

	}

	function set_validacion_cat(){
		$this->form_validation->set_message('is_unique', 'El campo %s ya existe');
		$this->form_validation->set_message('decimal', 'El campo %s no es un requerimiento valido (Solo numeros y puntos; Ejemplo: 1.0 | 5.0 | 1.7 | 5.72)');
		
		$config = array(
               array(
                     'field'   => 'requerimiento',
                     'label'   => 'Requerimiento',
                     'rules'   => 'required|trim|min_length[1]|decimal|is_unique[pregunta_categoria.requerimiento]'
                  ),
               array(
                     'field'   => 'categoria',
                     'label'   => 'Categoria',
                     'rules'   => 'required|trim|min_length[4]|is_unique[pregunta_categoria.categoria]'
                  )
            );

		$this->form_validation->set_rules($config); 
	}


	public function get_tabla_preguntas(){
		$consulta = $this->pre->get_preguntas_new();
		$filas = 'No hay preguntas capturadas';

		if($consulta == FALSE)
			return $filas;
				
			

		//if($tblUsuarios->num_rows() == 0)   $filas = "<tr><td>Actualmente no hay usuarios registrados</td></tr>"; return $filas;
		$filas = "  <table id='tblPreguntas' class='table table-striped'>
							<thead>
								<tr>
									<th>#</th>
									<th>Requerimiento</th>
									<th>Categoria</th>
									<th>Pregunta</th>
									<th>Acciones</th>
								</tr>
							</thead>
					<tbody>";
		$cont = 0;


		foreach ($consulta->result() as $row){
			$cont ++;
		    $filas.= "<tr>";
		    	$filas.= "<td>$cont</td>";
	    		$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->requerimiento . "</td>";
	    		$filas.= "<td>" . $row->categoria .  "</td>";
				$filas.= "<td>". $row->pregunta . "</td>";
				$filas.= "<td><div class='cont_accion'>" 
					//."<a class='badge badge-success' href='"   . base_url("/panel/preguntas/edita_usuario/$row->id")   ."' rel='tooltip' title='Editar al usuario:  <br/>". $row->nombre . " " . $row->apellidos . "'><i class='icon-edit icon-white'></i></a>"  
					."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/preguntas/borrar/$row->id") ."' rel='tooltip' title='Eliminar pregunta: <br/>". $row->pregunta . "'><i class='icon-remove icon-white'></i></a>"  
					."</div></td>";
			    $filas.= "</tr>";
		} // End ForEach
		$filas .= "</tbody></table>"; 
		return $filas;
	}//  __get_ tabla preguntas



	public function get_tabla_cat(){
		$consulta = $this->pre->get_categorias();
		$filas = 'No hay categorias capturadas.';

		if($consulta == FALSE)
				return $filas;
		//if($tblUsuarios->num_rows() == 0)   $filas = "<tr><td>Actualmente no hay usuarios registrados</td></tr>"; return $filas;
		$filas = "  <table id='tblPreguntas' class='table table-striped table-bordered table-condensed'>
							<thead>
								<tr>
									<th>#</th>
									<th>Requerimiento</th>
									<th>Categoria</th>
									<th>Acciones</th>
								</tr>
							</thead>
					<tbody>";
		$cont = 0;
		foreach ($consulta->result() as $row){
			$cont ++;
		    $filas.= "<tr>";
		    	$filas.= "<td>$cont</td>";
	    		$filas.= "<td style='font-style:italic;font-weight:bold;'>" .  $row->requerimiento . "</td>";
	    		$filas.= "<td>" . $row->categoria .  "</td>";
				$filas.= "<td><div class='cont_accion'>" 
					//."<a class='badge badge-success' href='"   . base_url("/panel/preguntas/edita_usuario/$row->id")   ."' rel='tooltip' title='Editar al usuario:  <br/>". $row->nombre . " " . $row->apellidos . "'><i class='icon-edit icon-white'></i></a>"  
					."<a class='badge badge-important btndel' 	href='"   . base_url("/panel/preguntas/borrar_cat/$row->idcat") ."' rel='tooltip' title='Eliminar categoria: <br/> ". $row->categoria . "'><i class='icon-remove icon-white'></i></a>"  
					."</div></td>";
			    $filas.= "</tr>";
		} // End ForEach
		$filas .= "</tbody></table>"; 
		return $filas;
	}//  __get_ tabla preguntas


	public function borrar($id = 0){
		$resultado = $this->pre->borrar($id);
		redirect("panel/preguntas", 'location');
	}

	public function borrar_cat($id = 0){
		$resultado = $this->pre->borrar_cat($id);
		redirect("panel/preguntas/nueva_categoria", 'location');
	}


}

/* End of file preguntas.php */
/* Location: ./application/controllers/preguntas.php */