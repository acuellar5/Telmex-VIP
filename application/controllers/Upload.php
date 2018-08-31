<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

  function __construct() {
    parent::__construct();
    //->load->model('data/configdb_model');
  }
  public function insertFiles(){
    $nombre_archivo = $this->input->post('nombre_archivo');
  	$nombre_carpeta = $this->input->post('mdl_sede');
  	$file_name = $_FILES['archivo']['name'];
    $file_size = $_FILES['archivo']['size'];
    $file_tmp = $_FILES['archivo']['tmp_name'];
    $file_type = $_FILES['archivo']['type'];    


    
    if (!is_dir("uploads/$nombre_carpeta")) {
      mkdir("uploads/$nombre_carpeta");
    } 
    echo json_encode(rename("$file_tmp","uploads/$nombre_carpeta/$nombre_archivo"));

  }

  // retorna los nombres de los archivos de la carpeta dada
  public function c_getFillName(){
    $files = [];
    $carpeta = $this->input->post('carpeta');

    if (is_dir("uploads/$carpeta")) {
      $directorio = opendir("uploads/$carpeta"); //ruta actual
      while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
      {
          if ($archivo != '.' && $archivo != '..')//verificamos si es o no un directorio
          {
             //enviar el nombre del archivo a nuestro arreglo files
            array_push($files, $archivo);
          }
          
      }
    }

    echo json_encode($files);



  }



}
