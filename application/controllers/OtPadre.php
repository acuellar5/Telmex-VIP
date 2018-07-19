<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OtPadre extends CI_Controller {

  function __construct() {
    parent::__construct();

  }


  // index de OTP
  public function view_otp(){
    if (!Auth::check()) {
            Redirect::to(URL::base());
        }
  	$data['title'] = 'OTP';// cargar el  titulo en la pestaña de la pagina para otp
  	$this->load->view('parts/headerF', $data);
  	$this->load->view('moduleOtp');
  	$this->load->view('parts/footerF');
  }
  public function managementOtp() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $data['title']='Work Management OTP';
        $this->load->view('parts/headerF', $data);
        $this->load->view('work_managementOtp');
        $this->load->view('parts/footerF');
    }
  
}
