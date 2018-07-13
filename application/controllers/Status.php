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
  public function status_restore($msj = null){
    $data['msj']       = $msj;
    $data['title']     = 'Restaurar Estados';
    $data['registros'] = $this->Dao_ot_hija_model->getCountsSumary();
    $data['cantidad']  = $this->Dao_ot_hija_model->getCantUndefined();
    $data['estados']     = $this->Dao_ot_hija_model->getStatusNull();
    $this->load->view('parts/headerF', $data);
    $this->load->view('status_restore');
    $this->load->view('parts/footerF');
  }

  //Obtiene los estados por el nombre del tipo
  public function c_getNewStatusByType(){
    $nombre_tipo = $this->input->post('name');
    $estados     = $this->Dao_ot_hija_model->getNewStatusByType($nombre_tipo, 'algo');
    echo json_encode($estados);
  }

  //guardar tipos con sus estados nuevos
  public function save_new_status(){
    $existe = $this->Dao_tipo_ot_hija_model->get_tipo_ot_hija_by_name($this->input->post('name_type'));
    if ($existe) {
         // Inserto el nuevo tipo
//        $data_type = array(
//          'n_name_tipo'  => $this->input->post('name_type'),
//          'i_referencia' => null
//        );
//        $id_tipo_nuevo = $this->Dao_tipo_ot_hija_model->insert_new_type($data_type);
//        $cant = 0;
//
//      
//        // Inserto los diferentes estados del tipo nuevo
//        for ($i=0; $i < count($this->input->post('name_status')); $i++) { 
//          $data_status = array(
//            'k_id_tipo'        => $id_tipo_nuevo,
//            'n_name_estado_ot' => $this->input->post('name_status')[$i],
//            'i_orden'          => $this->input->post('jerarquia')[$i]
//          );
//          $r = $this->Dao_estado_ot_model->insert_new_status($data_status);
//
//          $registro = $this->Dao_ot_hija_model->update_regis_indef_by_estado($id_tipo_nuevo, $this->input->post('name_type'), $this->input->post('name_status')[$i]);
//          $cant = $cant + $registro;
//        }
//
//        $msj = ($cant > 0) ? $cant : 'error';
    } else {      
      $msj = 'No existen';
      $this->status_restore($msj);
    }
  }

  // Obtener todos los tipos originales existentes 
  public function c_get_list_types(){
    $types = $this->Dao_tipo_ot_hija_model->get_list_types();
    echo json_encode($types);
  }


  
  
}
