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

  //trae los contadores de cantidades en tiempos y fuera de tiempos y hoy
  public function in_today_out(){
    // header('Content-Type: text/plain');
    $general    = $this->Dao_ot_hija_model->get_ots_times();
    $total_reg          = count($general);
    
    $cont_total_in_otp  = 0; 
    $cont_total_out_otp = 0; 
    $cont_total_hoy_otp = 0;
    $cont_total_otp     = 0;
    
    $ingenieros = [];
    $x = 0;
    for ($i=0; $i < $total_reg; $i++) {
        // CReamos el indice del ingeniero para otp si no existe
        if (!isset($ingenieros[$general[$i]->k_id_user])) {
          $ingenieros[$general[$i]->k_id_user] = [];
          $ingenieros[$general[$i]->k_id_user]['out'] = 0;
          $ingenieros[$general[$i]->k_id_user]['in'] = 0;
          $ingenieros[$general[$i]->k_id_user]['hoy'] = 0;
        }

        // validar si oth está fuera de times 
        if ($general[$i]->tiempo > 0) {
            if (!array_key_exists($general[$i]->k_id_ot_padre, $ingenieros[$general[$i]->k_id_user])) {
              $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = 1;
              $ingenieros[$general[$i]->k_id_user]['out']++; 
              $cont_total_out_otp++;
              $cont_total_otp++;
            } else {
              switch ($ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre]) {
                case '1':
                  
                  break;
                case '0':
                  $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = 1;
                  $ingenieros[$general[$i]->k_id_user]['out']++;
                  $ingenieros[$general[$i]->k_id_user]['hoy']--;
                  $cont_total_out_otp++;
                  $cont_total_hoy_otp--;
                  break;
                case '-1':
                   $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = 1;
                   $ingenieros[$general[$i]->k_id_user]['out']++;
                   $ingenieros[$general[$i]->k_id_user]['in']--;
                   $cont_total_out_otp++;
                   $cont_total_in_otp--;
                  break;
              }
            }
        }
        
        // validar si oth está para now
        if ($general[$i]->tiempo == 0) {
          if (!array_key_exists($general[$i]->k_id_ot_padre, $ingenieros[$general[$i]->k_id_user])) {
              $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = 0;
              $ingenieros[$general[$i]->k_id_user]['hoy']++;
              $cont_total_otp++;
              $cont_total_hoy_otp++;
              
          } else if ($ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] == -1) {

            $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = 0;
            $ingenieros[$general[$i]->k_id_user]['hoy']++;
            $ingenieros[$general[$i]->k_id_user]['in']--;
            $cont_total_hoy_otp++;
            $cont_total_in_otp--;
          }
        }

        if ($general[$i]->tiempo < 0) {
          if (!array_key_exists($general[$i]->k_id_ot_padre, $ingenieros[$general[$i]->k_id_user])) {
            $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = -1;
            $ingenieros[$general[$i]->k_id_user]['in']++;
            $cont_total_in_otp++;
            $cont_total_otp++;
          }
        }
    }

    $retorno = array(
      'cant_otp' => $cont_total_otp,
      'cant_in' => $cont_total_in_otp,
      'cant_hoy' => $cont_total_hoy_otp,
      'cant_out' => $cont_total_out_otp,
      'ing' => $ingenieros
    );

    echo json_encode($retorno);
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
