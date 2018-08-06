<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReporteActualizacion extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ot_hija_model');
       
    }

    //CARGAR  LA VISTA PARA REPORTE DE ACTUALIZACION QUE LLEVE MAS DE 8 DIAS
    public function updateReport() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $data['title'] = 'updateReport'; // cargar el  titulo en la pestaña de la pagina para otp
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $this->load->view('parts/headerF', $data);
        $this->load->view('reporteActualizacion');
        $this->load->view('parts/footerF');
    }

    // TABLA DE OTS QUE ESTEN CERRADAS Y MAS DE 8 DIAS
    public function getListOtsEigtDay(){
    $UndefinedOts = $this->Dao_ot_hija_model->getListOtsEigtDaygetListOtsEigtDay();
    echo json_encode($UndefinedOts);
  }

}
