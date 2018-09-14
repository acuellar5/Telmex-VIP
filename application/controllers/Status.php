<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ot_hija_model');
        $this->load->model('data/Dao_tipo_ot_hija_model');
        $this->load->model('data/Dao_estado_ot_model');
    }

    //
    public function status_restore($msj = null) {
        $data['msj'] = $msj;
        $data['title'] = 'Restaurar Estados';
        $data['registros'] = $this->Dao_ot_hija_model->getCountsSumary();
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $data['estados'] = $this->Dao_ot_hija_model->getStatusNull();
        $this->load->view('parts/headerF', $data);
        $this->load->view('status_restore');
        $this->load->view('parts/footerF');
    }

    //Obtiene los estados por el nombre del tipo
    public function c_getNewStatusByType() {
        $nombre_tipo = $this->input->post('name');
        $estados = $this->Dao_ot_hija_model->geStatusByType($nombre_tipo);
        echo json_encode($estados);
    }

    public function save_new_status() {
        $name_type = $this->input->post('name_type');
        $tipoOt = $this->Dao_tipo_ot_hija_model->get_tipo_ot_hija_by_name($this->input->post('name_type'));
        $cant = 0;
        if ($tipoOt) {
            for ($i = 0; $i < count($this->input->post('name_status')); $i++) {

                $estatusOT = $this->Dao_estado_ot_model->getStatusByTypeAndStatusName($tipoOt->id_tipo, $this->input->post('name_status')[$i]);

                if ($estatusOT) {
                    $update = $this->Dao_estado_ot_model->updateStatusById($this->input->post('jerarquia')[$i], $estatusOT->k_id_estado_ot);
                } else {
                    $data_status = array(
                        'k_id_tipo' => $tipoOt->id_tipo,
                        'n_name_estado_ot' => $this->input->post('name_status')[$i],
                        'i_orden' => $this->input->post('jerarquia')[$i]
                    );
                    $idStatus = $this->Dao_estado_ot_model->insert_new_status($data_status);

                    $updateRegis = $this->Dao_ot_hija_model->update_regis_null_by_estado($idStatus, $this->input->post('name_type'), $this->input->post('name_status')[$i]);
                    $cant = $cant + $updateRegis;
                }
            }
            
            $msj = ($cant > 0) ? $cant : 'error';
            $this->status_restore($msj);
        } else {
            $msj = 'No existen';
            $this->status_restore($msj);
        }
    }

    // Obtener todos los tipos originales existentes 
    public function c_get_list_types() {
        $types = $this->Dao_tipo_ot_hija_model->get_list_types();
        echo json_encode($types);
    }
    
    //Obtiene todos los estados existentes y no existentes por el nombre del tipo
    public function c_getAllStatusByType() {
        $nombre_tipo = $this->input->post('name');
        $estados['estados_existen'] = $this->Dao_ot_hija_model->geStatusByType($nombre_tipo);
        $estados['estados_no_existen'] = $this->Dao_ot_hija_model->getStatusByTypeForOth($nombre_tipo);
        echo json_encode($estados);
    }

    // obtener lista de estados por nombre de típo
    public function js_ListStatusByType(){
        $name_type = $this->input->post('tipo_sel');
        $status = $this->Dao_ot_hija_model->geStatusByType($name_type);

        echo json_encode($status);


    }

}
