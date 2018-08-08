<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('data/Dao_log_model');
    $this->load->model('data/Dao_log_correo_model');
  }
  
 	// Llama los log por id 
	public function getLogById(){
		$id = $this->input->post('id');
		$data['log'] = $this->Dao_log_model->getLogById($id);
		$data['mail'] = $this->Dao_log_correo_model->getLogMailById($id);
		echo json_encode($data);
	}

}		