<?php if (!defined('BASEPATH')) exit('No deseo permitir acceso directo a este script');


class MY_Router extends CI_Router {


    function __construct(){
        parent::__construct();
    }

    function _validate_request($segments)
    {
        // Does the requested controller NOT exist?
        if (!file_exists(APPPATH.'controllers/'.$segments[0].".php") && ! file_exists(APPPATH . 'controllers/' . $segments[0] ) )
        {
            $segments = array("paginas","carga",$segments[0]);
        }
        return parent::_validate_request($segments);
    }
    
} 



