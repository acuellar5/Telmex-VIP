<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Facturacion_ots extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ot_padre_model');
        $this->load->model('data/Dao_ot_hija_model');
        $this->load->model('data/Dao_facturacion_ots_model');
    }

    public function index() {
        $data['title'] = 'Facturacion';
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $this->load->view('parts/headerF', $data);
        $this->load->view('facturacion_ots');
        $this->load->view('parts/footerF');
    }

    // trae las ots padre en facturacion
    public function c_getOtpFacturacion() {
        $data = $this->Dao_facturacion_ots_model->getOtpFacturacion();
        echo json_encode($data);
    }

}
