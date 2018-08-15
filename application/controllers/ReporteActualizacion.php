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
        $data['title'] = 'update Report'; // cargar el  titulo en la pestaña de la pagina para otp
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $this->load->view('parts/headerF', $data);
        $this->load->view('reporteActualizacion');
        $this->load->view('parts/footerF');
    }

    // TABLA DE OTS QUE ESTEN CERRADAS Y MAS DE 8 DIAS
    public function getListOtsEigtDay() {
        $otsEigtDay = $this->Dao_ot_hija_model->getListOtsEigtDay();

        $data = array(
            'data' => $otsEigtDay->result(),
            'cant' => $otsEigtDay->num_rows()
        );
        echo json_encode($data);
    }

    //data para los correos enviados 
    public function mail_send_today() {
        $mail_today = $this->Dao_ot_hija_model->send_today();

        $data = array(
            'data' => $mail_today->result(),
            'cant' => $mail_today->num_rows()
        );
        echo json_encode($data);
    }
    
    public function c_getListOtsKickoffCerradas() {
        $otsList = $this->Dao_ot_hija_model->getOtsKickoffCerradas();
        echo json_encode($otsList);
    }

}
