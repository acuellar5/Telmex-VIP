<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('data/Dao_log_model');
  }
  
 	// Llama los log por id 
	public function getLogById(){
		$id = $this->input->post('id');
		$data = $this->Dao_log_model->getLogById($id);
		echo json_encode($data);
	}

}		