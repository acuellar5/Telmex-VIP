<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sede extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('data/Dao_ot_padre_model');
		$this->load->model('data/Dao_ot_hija_model');
		$this->load->model('data/Dao_log_model');
		$this->load->model('data/Dao_sede_model');
		$this->load->model('data/Dao_control_cambios_model');
	}


	// carga en la nueva pestaña las distintas otp  de la sede
	public function otps_sede($id_sede){
		$otp['otp'] = $this->Dao_ot_padre_model->get_otp_by_idsede($id_sede);
		$otp['log'] = $this->Dao_log_model->get_log_by_idsede($id_sede);
		$otp['responsable'] = $this->Dao_control_cambios_model->getAllResponsable();
		$otp['causa'] = $this->Dao_control_cambios_model->getAllCausa();

        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $data['title'] = 'ots sede';
        $this->load->view('parts/headerF', $data);
        $this->load->view('sede_datail', $otp);
        $this->load->view('parts/footerF');
	}


	// Cargar la vista principal para el modulo de Control de cambios (sede)
	public function index(){
		if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $otp['responsable'] = $this->Dao_control_cambios_model->getAllResponsable();
        $otp['causa'] = $this->Dao_control_cambios_model->getAllCausa();

        $data['title'] = 'Control De Cambios'; // cargar el  titulo en la pestaña de la pagina para sede
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $this->load->view('parts/headerF', $data);
        $this->load->view('contolDeCambios', $otp);
        $this->load->view('parts/footerF');
	}

	//carga el dao para mostrar la tabla de sede en el modulo de control de cambio
    public function c_getListofficesTable() {
        $data = $this->Dao_sede_model->getListoffices_Table();
        echo json_encode($data);
    }

    //carga el dao para mostrar la tabla de OTP para el modulo de control de cambio
    public function c_getListOTPTable() {
        $dataOtp = $this->Dao_sede_model->c_getListOTP_Table();
        echo json_encode($dataOtp);
    }
    
    // inserta un nuevo control de cambio
    public function insert_control(){
        $id_sede = $this->input->post('id_sede');
    	$faltantes_post = $this->input->post('faltantes');
    	$faltantes = "";
    	if ($faltantes_post) {
    		for ($i=0; $i < count($faltantes_post) - 1 ; $i++) { 
	    		$faltantes .= $faltantes_post[$i] . ", ";
    		}
    		$faltantes .= $faltantes_post[$i];
    	}

    	date_default_timezone_set("America/Bogota");
    	$fActual = date('Y-m-d H:i:s');

    	$data = array(
			'id_ot_padre'                => $this->input->post('id_ot_padre'),
			'id_responsable'             => $this->input->post('id_responsable'),
			'id_causa'                   => $this->input->post('id_causa'),
			'numero_control'             => $this->input->post('numero_control'),
			'fecha_compromiso'           => $this->input->post('fecha_compromiso'),
			'fecha_programacion_inicial' => $this->input->post('fecha_programacion_inicial'),
			'nueva_fecha_programacion'   => $this->input->post('nueva_fecha_programacion'),
			'narrativa_escalamiento'     => $this->input->post('narrativa_escalamiento'),
			'estado_cc'                  => $this->input->post('estado_cc'),
			'observaciones_cc'           => $this->input->post('observaciones_cc'),
			'faltantes'                  => $faltantes,
			'en_tiempos'                 => $this->input->post('en_tiempos'),
			'fecha_creacion_cc'          => $fActual
    		);
    	
    	$ins = $this->Dao_control_cambios_model->insert_control_cambios($data);
        $this->session->set_flashdata('ok', 'ok');
        header('location: ' .URL::base()."/Sede/otps_sede/".$id_sede);

    }

    // trae de la tabla control de cambios por id de ot padre
    public function getCCByOtp(){
        $otp = $this->input->post('otp');
        $cc = $this->Dao_control_cambios_model->get_cc_by_otp($otp);
    }

}
