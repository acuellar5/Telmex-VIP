<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OtPadre extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('data/Dao_user_model');
    $this->load->model('data/Dao_ot_padre_model');
    $this->load->model('data/Dao_ot_hija_model');

  }


  // carga la vista para como vamos ot padre
  public function view_otp(){
    if (!Auth::check()) {
            Redirect::to(URL::base());
        }
    $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
    $data['ingenieros'] = $this->Dao_user_model->get_eng_trabajanding();
  	$data['title'] = 'OTP';// cargar el  titulo en la pestaña de la pagina para otp
  	$this->load->view('parts/headerF', $data);
  	$this->load->view('moduleOtp');
  	$this->load->view('parts/footerF');
  }
  public function managementOtp() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $data['title'] ='Work Management OTP';
        $this->load->view('parts/headerF', $data);
        $this->load->view('work_managementOtp');
        $this->load->view('parts/footerF');
    }

  // Retorna las ot padres de un ingeniero
  public function c_get_otp_by_id_user(){
    $inge_id = $this->input->post('iduser');
    $ots = $this->Dao_ot_padre_model->get_otp_by_id_user($inge_id);
    echo json_encode($ots);

  }
  
  // TABLA QUE TRAE LA INFORMACION DE OTPADRE
  public function getListOtsOtPadre(){
    $otPadreList = $this->Dao_ot_padre_model->getListOtsOtPadre();
    echo json_encode($otPadreList);
    
  }

}
