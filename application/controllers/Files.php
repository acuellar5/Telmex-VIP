<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    // Cargar archivos subidos
    public function index() {
        $data['title'] = 'Archivos Subidos';
        // $this->load->view('parts/header', $data);
        $this->load->view('files');
        // $this->load->view('parts/footer');
    }

    // retorna los nombres de los archivos de la carpeta dada
    public function c_getFillName() {
        $files   = [];
        if (is_dir("uploads")) {
            $directorio = opendir("uploads"); //ruta actual
            while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
            {
                if ($archivo != '.' && $archivo != '..') //verificamos si es o no un directorio
                {
                    //enviar el nombre del archivo a nuestro arreglo files
                    array_push($files, $archivo);
                }
            }
        }
        echo json_encode($files);
    }

}

/* End of file Files.php */
/* Location: ./application/controllers/Files.php */