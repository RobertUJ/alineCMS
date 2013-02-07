<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Clase utilizada para el control y edicion de usuarios del cms AlineCMS
 * @author Roberto Urita Jimenez  @robertuj robertuj@gmail.com 
 * 
 */
class Configuracion extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('model_configuracion', 'configuracion');
		$this->load->library('Configuration');
	}

	public function index(){

		if($this->input->post()){
			$conf = $this->configuracion->dame_configuracion();
			if(!$conf){
				$this->configuracion->agregar_configuracion();
				redirect('panel/admin/','REFRESH');
			}else{
				if((int)$this->input->post('nuevo_logo') != 0){
					$logo = $this->do_upload();
					if(!$logo){
						echo "Problemas al subir la imagen";
					}else{
						if((int)$this->input->post('logo_proporcional') == 1){
							$imagen = $this->dame_proporciones();
						}else{
							$imagen = array('ancho' => $this->input->post('logo_ancho'), 'alto' => $this->input->post('alto'));
						}
						$this->configuracion->editar_configuracion($logo,$imagen);
						redirect('panel/admin/','REFRESH');	
					}
				}else{
					if((int)$this->input->post('logo_proporcional') == 1){
						$imagen = $this->dame_proporciones();
					}else{
						$imagen = array('ancho' => $this->input->post('logo_ancho'), 'alto' => $this->input->post('logo_alto'));
					}
					$this->configuracion->editar_configuracion($this->configuration->logo,$imagen);
					redirect('panel/admin/','REFRESH');
				}
			}
		}
		else{
			// SI NO ENVIA POR POST
			$categorias = $this->configuracion->dame_categorias();
			
			$data['categorias_select'] = $categorias;
			$data['titulo'] = $this->configuration->titulo;
			$data['logo'] = $this->configuration->logo;
			$data['logo_ancho'] = $this->configuration->logo_ancho;
			$data['logo_alto'] = $this->configuration->logo_alto;
			$data['correo_admin'] = $this->configuration->correo_admin;
			$data['nombre_admin'] = $this->configuration->nombre_admin;
			$data['plantilla'] = $this->configuration->plantilla;
			$data['twitter'] = $this->configuration->twitter;
			$data['facebook'] = $this->configuration->facebook;
			$data['google'] = $this->configuration->google;
			$data['num_articulos'] = $this->configuration->no_articulos;
			$data['categorias'] = $this->configuration->categorias;
			$data['head'] = $this->alinecms->get_head('Panel de articulos', TRUE);
			$data['header'] = $this->alinecms->get_header("_5");
			$data['titulo_pagina'] = "Configuración";
			$this->load->view('admin/configuracion', $data);
		}
	}// End configuration function

	public function do_upload(){
		$config['upload_path'] = "assets/img/";
		$config['allowed_types'] = 'jpg|png|gif|jpeg';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('logo')){
			$error = array('error' => $this->upload->display_errors());
			return false;
		}
		else{
			$info = array('upload_data' => $this->upload->data());
			return $info['upload_data']['file_name'];
		}
	}

	public function dame_proporciones(){
		if($this->input->post('logo_ancho') != 0){
			$ancho = $this->input->post('logo_ancho');
			if($this->input->post('nuevo_logo') == 1){
				$ruta_imagen = base_url() . "assets/img/" . $this->input->post('logo');	
			}else{
				$ruta_imagen = base_url() . "assets/img/" . $this->configuration->logo;
			}
			$imagen_datos = getimagesize($ruta_imagen);
			$escala = (int)$ancho/(int)$imagen_datos[0];
			$alto = (int)$imagen_datos[1]*$escala;
			return array('ancho' => $ancho, 'alto' => $alto);
		}else{
			return array('ancho' => 0, 'alto' => 0);
		}

	}

}