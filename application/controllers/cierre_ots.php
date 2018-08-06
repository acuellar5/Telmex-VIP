<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cierre_ots extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data/Dao_ot_padre_model');
		$this->load->model('data/Dao_ot_hija_model');
		$this->load->model('data/Dao_cierre_ots_model');
	}



	// carga la vista de enrutamiento de cierres
	public function index(){
		$data['title']='Enrutar';
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $this->load->view('parts/headerF', $data);
        $this->load->view('cierre_ots');
        $this->load->view('parts/footerF');
	}

	// trae las ots padre en cierre
	public function c_getOtsCierre(){
		$data = $this->Dao_cierre_ots_model->getOtpCierre();
		echo json_encode($data);	
	}
  
  
}
