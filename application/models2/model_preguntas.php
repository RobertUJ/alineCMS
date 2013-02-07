<?php

class Model_preguntas extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	
	function get_preguntas(){
		$idUsuario = $this->session->userdata('id');
		$strSql = " SELECT p.*,r.idusuario,r.idpregunta,r.resultado,r.fecha FROM preguntas p 
					LEFT JOIN resultados r 
					ON p.id = r.idpregunta
					AND r.idUsuario = $idUsuario
					ORDER BY p.requerimiento;";
		$preguntas = $this->db->query($strSql);
		return $preguntas;
	}

	function get_preguntas_new(){
		$this->db->select('*');
		$this->db->from('preguntas');
		$this->db->join('pregunta_categoria', 'preguntas.idcat = pregunta_categoria.idcat','left');
		$this->db->join('resultados', 'preguntas.id = resultados.idpregunta','left');


		$query = $this->db->get();

		if($query->num_rows == 0) return FALSE;
		
		return $query;
	}
	
	function procesa_preguntas(){
		$fecha = date("y-m-d");
		$limit = 1;
		$idUsuario = $this->session->userdata('id');
		$procesaForm = $this->input->post('procesa');
		$idFolio = 0;
		
		if($procesaForm == 1){
			$data = array(
					'fecha' => $fecha,
					'id_usuario' => $idUsuario
			);
			$this->db->insert('folio', $data); 
			$this->db->select_max('id');
			$query = $this->db->get('folio');
			$idFolio = $query->row('id');
		}

		echo $idFolio;

		foreach($this->input->post() as $variable => $valor){
			$query = $this->db->get_where('resultados', array('idpregunta' => $variable,'idusuario' => $idUsuario ),$limit);
			if($query->num_rows > 0){
			  	$row = $query->row(); 
				$data = array(
					'resultado' => $valor,
					'fecha' =>  $fecha,
					'idFolio' => $idFolio
				);
				$this->db->where('idresultados', $row->idresultados);
				$this->db->update('resultados', $data); 
			}else{
				$data = array(
					'idusuario' => $this->session->userdata('id') ,
					'idpregunta' => $variable ,
					'resultado' => $valor,
					'fecha' =>  $fecha,
					'idFolio' => $idFolio
				);
				if($variable != "" && $variable != 0){
					$query2 = $this->db->insert('resultados', $data); 
					if ($query2 == FALSE) return FALSE;
				}	
			}// Fin Else
		}// Fin For-Each
		return TRUE;
	} // Fin procesa_preguntas



	
	function get_resultados(){
	$IDusuario = $this->session->userdata('id');
	
	$strSql =  "SELECT p.*,r.resultado,r.idusuario,r.idpregunta from resultados r 
				LEFT JOIN preguntas p
				ON p.id = r.idpregunta 
				WHERE r.idusuario = " . $IDusuario ."
				AND r.idpregunta <> 0;";
		return $query = $this->db->query($strSql);

	}

	function get_resultados_new(){
		$this->db->select('*');
		$this->db->from('preguntas');
		$this->db->join('pregunta_categoria', 'preguntas.idcat = pregunta_categoria.idcat','left');
		$this->db->join('resultados', 'preguntas.id = resultados.idpregunta','left');


		$query = $this->db->get();

		if($query->num_rows == 0) return FALSE;
		
		return $query;
	}

	function get_cantidad($respuesta = 0){
		$idusuario = $this->session->userdata('id');
		$strSql = "Select count(idresultados) as cantidad from resultados where idusuario = $idusuario and resultado = $respuesta Limit 1";
		//echo $strSql;
		$query = $this->db->query($strSql);
		$querys = $query->row();
		return $querys->cantidad;
	}

	function get_total_respuetas(){
		$idUsuario = $this->session->userdata('id');
		$this->db->where('idusuario', $idUsuario);
		$this->db->from('resultados');
		return $this->db->count_all_results();
	}

	function get_total_reactivos(){
		return $this->db->count_all_results('preguntas');
	}


	function inserta_pregunta_nueva(){
		$datos['idcat'] = $this->input->post('categoria');
		$datos['pregunta'] = $this->input->post('pregunta');
		$this->db->insert('preguntas', $datos); 
	}

	function inserta_categoria_nueva(){
		$datos['requerimiento'] = $this->input->post('requerimiento');
		$datos['categoria'] = $this->input->post('categoria');
		$this->db->insert('pregunta_categoria', $datos); 
	}

	function get_categorias(){
		$this->db->order_by('requerimiento');
		$query = $this->db->get('pregunta_categoria');
		if($query->num_rows() > 0){
			return $query;
		}else{
			return FALSE;
		}
	}


	function borrar($id=0){
		if($id==0) return TRUE;
		
		$this->db->delete('preguntas', array('id' => $id)); 
		return TRUE;
	} // END BORRAR

	function borrar_cat($id=0){
		if($id==0) return TRUE;
		
		$this->db->delete('pregunta_categoria', array('idcat' => $id)); 
		$this->db->delete('preguntas', array('idcat' => $id)); 
		return TRUE;
	}
		
}

/* End of file Model_usuarios.php */
/* Location: ./application/models/Model_usuarios.php */