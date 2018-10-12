<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cierre_ots extends CI_Controller {
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
	// ELimina registros de cierre_ots y ot_ padre
	public function c_eliminar_registros(){
		$delete_otp = 0;
		$otp    = $this->input->post('otp');
		$delete = $this->Dao_cierre_ots_model->eliminar_registros($otp); // cantidad de registros eliminados en cierre_ots
		if ($delete) {
			// Eliminar en ot padre
			$delete_otp = $this->Dao_ot_padre_model->deleteById($otp);
		}
		$ret = array(
			'del' => $delete,
			'del_otp' => $delete_otp
		);
		echo json_encode($ret);
	}
	// Se envia los registros a facturacion (estado)
	public function c_enviar_a_facturacion(){
		$fActual = date('Y-m-d H:i:s');
		$otp = $this->input->post('otp');
		$data = array(
			'estado_zte' => 'facturacion',
			'fecha_actual' => $fActual
		);
		
		$up = $this->Dao_cierre_ots_model->up_to_facturacion($otp, $data);
		echo json_encode($up);
	}
  
  
}