<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sede extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data/Dao_ot_hija_model');
		$this->load->model('data/Dao_sede_otp_model');
	}


	// Cargar la vista principal para el modulo de Control de cambios (sede)
	public function index(){
		if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $data['title'] = 'ControlDeCambios'; // cargar el  titulo en la pestaña de la pagina para sede
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $this->load->view('parts/headerF', $data);
        $this->load->view('contolDeCambios');
        $this->load->view('parts/footerF');
	}

	//carga el dao para mostrar la tabla de sede en el modulo de control de cambio
    public function c_getListofficesTable() {
        $data = $this->Dao_sede_otp_model->getListoffices_Table();
        echo json_encode($data);
    }
    

}
