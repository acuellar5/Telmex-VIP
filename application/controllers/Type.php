<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('data/Dao_ot_hija_model');
  }

  //
  public function type_restore(){
  	$data['title'] = 'Restaurar Tipos';
    $data['registros'] = $this->Dao_ot_hija_model->getCountsSumary();
    $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
    $data['tipos'] = $this->Dao_ot_hija_model->getTypeUndefined();
    $this->load->view('parts/headerF', $data);
    $this->load->view('type_restore');
    $this->load->view('parts/footerF');
  }


  
  
}
