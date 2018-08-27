<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sede extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data/Dao_ot_padre_model');
		$this->load->model('data/Dao_ot_hija_model');
		$this->load->model('data/Dao_log_model');
	}


	// carga en la nueva pestaña las distintas otp  de la sede
	public function otps_sede($id_sede){
		$otp['otp'] = $this->Dao_ot_padre_model->get_otp_by_idsede($id_sede);
		$otp['log'] = $this->Dao_log_model->get_log_by_idsede($id_sede);

		$data['last_time'] = $this->Dao_ot_hija_model->get_last_time_import();
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $data['title'] = 'ots sede';
        $this->load->view('parts/headerF', $data);
        $this->load->view('sede_datail', $otp);
        $this->load->view('parts/footerF');
	}



}
