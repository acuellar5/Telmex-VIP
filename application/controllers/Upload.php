<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('data/Dao_control_cambios_model');
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
    $id_sede = $this->input->post('id_sede');
    $files = $this->Dao_control_cambios_model->c_getFillName($id_sede);


    echo json_encode($files);

  }

  // descargar el archivo seleccionado 
  public function download_file($id_cc){
    $file = $this->Dao_control_cambios_model->getFileCC($id_cc);

    $archivo   = $file['archivo'];
    $nombre    = $file['nombre_archivo'];
    $tipo      = $file['tipo_archivo'];
    $extension = $file['extension_archivo'];

    header("Content-type: $tipo");
    header('Content-disposition: attachment; filename="'.$nombre.'.docx"');
    header("Content-disposition: attachment; filename='$nombre.$extension'");
    // header("Content-Disposition: inline; filename=$nombre.pdf");
    print_r($archivo);
  }



}
