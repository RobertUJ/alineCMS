<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/blog
	 *	- or -  
	 * 		http://example.com/index.php/blog/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/blog/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->library('Alinecms');
		$this->load->library('email');
        $this->load->library('Configuration');
		$this->load->model('model_menus', 'menu');
        
	}
		
	public function index(){
		$data['Menu_Principal'] = $this->get_padres_vista(27);
		$data['main_menu'] = $this->load->view('public/helper/main_menu' , $data,True);
		$this->load->view('public/inicio',$data);
	}

	public function error_inicio(){
		$data['head'] = $this->alinecms->get_head('Proceso Presupuesto');
		$data['footer'] = $this->alinecms->get_footer();
		$this->load->view('public/fail_login' ,$data);
	}

	public function pago(){
		echo "Muestra si pago";
		$this->load->view('public/pago.php');
	}
	
	public function registro(){
		$this->load->view('public/registro.php');
	}

	public function registro_paso2($id = 0){
		$data['id_usuario'] = $id;
		$this->load->view('public/registro_paso2', $data);
	}

	public function perfil_usuario(){
		$this->load->view('public/perfil');
	}

	public function ingresar(){
		$data['mensaje_error'] = '';
		$this->load->view('public/ingresar', $data);
	}


	public function get_padres_vista($idMenu = 0, $padre = 0){
        //$this->load->model('model_menus', 'menu');
        // Obtenemos todos los items padre
        $items = $this->menu->get_ItemsMenu_front($idMenu,$padre);

        $nombre_menu = $this->menu->get_nombre_menu($idMenu);

        // Verificamos que exista algun item de menu padre para proseguir con la consulta
        if($items->num_rows == 0 and $padre == 0){
            $elementos = "<ul><li>No hay items de menu en la base de datos.</li></ul>";
            return $elementos;
        }

        // Agregamos los atributos, clases y id al <ul> padre
        if($padre == 0){ 
            $mainMenu = $this->menu->get_mainMenu($idMenu); 
            $classMenu = ""; $idCssMenu =""; $atriMenu ="";
            if(! is_null($mainMenu->clase) ) $classMenu = "class='".$mainMenu->clase."'";
            if(strlen( trim($mainMenu->id_css) ) > 0 ){
                $subId = "id='".$mainMenu->id_css."'";
            }
            if(! is_null($mainMenu->atributos) ) $atriMenu = $mainMenu->atributos;
            $elementos = "<ul ".$classMenu." ".$idCssMenu." ".$atriMenu.">";
        }else{
            $elementos = "<ul class='dropdown-menu'>";
        }
        //$elementos .= "<li class='nav-header'>" . $nombre_menu . "</li>";
        // Recorremos el arbol de elementos padre buscando hijos 
        foreach($items->result() as $row){
            if( $row->is_logged == 'si' && ! $this->session->userdata('logged_in') ) continue;
            
            $hijos = $this->menu->get_hijos($idMenu,$row->idItem);
            
            $subClass =""; $subId = ""; $subAtri = "";
            
            if(! is_null($row->clase) ) $subClass = "class='".$row->clase."'";
            
            if(strlen( trim($row->id_css) ) > 0 ){
                $subId = "id='".$row->id_css."'";
            }

            if(! is_null($row->atri) ) $subAtri = $row->atri;
            $elementos .= "<li ".$subClass." ".$subId." ".$subAtri.">";

            $mhref = "";
            // 1 = Home | 2 = Contact | 3 = Page | 4 = Articulo | 5 = Blog | 6 = URL Externa
            switch ($row->tipo) {
                case 1:
                // Home
                    $mhref = base_url();
                    break;
                case 2:
                // Contacto
                    $mhref = base_url('contacto');
                    break;
                case 3:
                // Pagína
                    $tSlug = $this->menu->slug_actual($row->idpost);
                    $mhref = base_url($tSlug);
                    break;
                case 4:
                // Artículo
                    $tSlug = $this->menu->slug_actual($row->idpost);
                    $mhref = base_url($tSlug);
                    break;
                case 5:
                // Blog
                    $mhref = base_url('blog');
                    break;
                case 6:
                // URL Externa
                    $mhref = $row->url;
                    break;
            }
            if(! $hijos > 0){
                $elementos .= "<a href='$mhref'>" . $row->titulo . "</a>";
            }else{
                $elementos .= "<a class='dropdown-toggle' data-toggle='dropdown' href='$mhref'>" . $row->titulo . "</a>";
            }

            if($hijos > 0){
                $elementos .= $this->get_padres_vista($idMenu,$row->idItem);
            }

            $elementos .= '</li>';  
        } 
        $elementos .='</ul>';
        return $elementos;
    } 


}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */