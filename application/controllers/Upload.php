<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

  function __construct() {
    parent::__construct();
    //->load->model('data/configdb_model');
  }
  public function insertFiles(){
  	$nombre_archivo = $this->input->post('nombre_archivo');
  	$file_name = $_FILES['archivo']['name'];
    $file_size = $_FILES['archivo']['size'];
    $file_tmp = $_FILES['archivo']['tmp_name'];
    $file_type = $_FILES['archivo']['type'];    
    echo "Este es el archivo ".$file_name;

  }
  
  
}
?>