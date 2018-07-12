<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('data/Dao_ot_hija_model');
    $this->load->model('data/Dao_tipo_ot_hija_model');
    $this->load->model('data/Dao_estado_ot_model');
  }

  //
  public function type_restore($msj = null){
    $data['msj']       = $msj;
    $data['title']     = 'Restaurar Tipos';
    $data['registros'] = $this->Dao_ot_hija_model->getCountsSumary();
    $data['cantidad']  = $this->Dao_ot_hija_model->getCantUndefined();
    $data['tipos']     = $this->Dao_ot_hija_model->getTypeUndefined();
    $data['type_list'] = $this->Dao_tipo_ot_hija_model->get_list_types();
    $this->load->view('parts/headerF', $data);
    $this->load->view('type_restore');
    $this->load->view('parts/footerF');
  }

  //Obtiene los estados por el nombre del tipo
  public function c_getNewStatusByType(){
    $nombre_tipo = $this->input->post('name');
    $estados     = $this->Dao_ot_hija_model->getNewStatusByType($nombre_tipo);
  	echo json_encode($estados);
  }

  //guardar tipos con sus estados nuevos
  public function c_save_new_Type(){
    $existe = $this->Dao_tipo_ot_hija_model->get_tipo_ot_hija_by_name($this->input->post('name_type'));
    if ($existe) {
      $msj = 'existen';
      $this->type_restore($msj);
    } else {      
        // Inserto el nuevo tipo
        $data_type = array(
          'n_name_tipo'  => $this->input->post('name_type'),
          'i_referencia' => null
        );
        $id_tipo_nuevo = $this->Dao_tipo_ot_hija_model->insert_new_type($data_type);

        $cant = 0;      
        // Inserto los diferentes estados del tipo nuevo
        for ($i=0; $i < count($this->input->post('name_status')); $i++) { 
          $data_status = array(
            'k_id_tipo'        => $id_tipo_nuevo,
            'n_name_estado_ot' => $this->input->post('name_status')[$i],
            'i_orden'          => $this->input->post('jerarquia')[$i]
          );
          $r = $this->Dao_estado_ot_model->insert_new_status($data_status);

          $registro = $this->Dao_ot_hija_model->update_regis_indef_by_estado($id_tipo_nuevo, $this->input->post('name_type'), $this->input->post('name_status')[$i]);
          $cant = $cant + $registro;
        }

        $msj = ($cant > 0) ? $cant : 'error';
        $this->type_restore($msj);
    }
  }

  // Obtener todos los tipos originales existentes 
  public function c_get_list_types(){
    $types = $this->Dao_tipo_ot_hija_model->get_list_types();
    echo json_encode($types);
  }

  // guardar variantes nuevas de Tipos
  public function c_save_type_variant(){
    // Creo los valores para insertar la variante en tipo_ot
    $data = array(
      'i_referencia'   => $this->input->post('id_type'),
      'n_name_tipo' => $this->input->post('name')
    );
    // inserto el nuevo registro 
    $id_tipo_nuevo = $this->Dao_tipo_ot_hija_model->insert_new_type($data);
    // traigo los registros que tengan el nombre del tipo nuevo
    $registros     = $this->Dao_ot_hija_model->get_ot_by_tipo($this->input->post('name'));
    //contadores de actualizados y actualizados nulos
    $act   = 0;
    $nulos = 0;
    // Recorro los registros que vengan con el tipo nuevo
    for ($i=0; $i < count($registros); $i++) { 
      // Obtengo el id del estado con la combinacion de tipo y estado del registro
      $id_estado = $this->Dao_estado_ot_model->get_status_by_idtipo_and_name_status($this->input->post('id_type'), $registros[$i]->estado_orden_trabajo_hija);
      // si existe ese estado...
      if ($id_estado) {
        // Creo los arreglo para la actualizacion de los registros 
        $up = array(
          'k_id_register'  => $registros[$i]->k_id_register,
          'k_id_estado_ot' => $id_estado->k_id_estado_ot
        );
        $res = $this->Dao_ot_hija_model->update_ot_hija($up);
        // Si se actulizó el registro suma un uno al contador
        $act++;
      } else {
        // actualizar el k_id_estado a null
        $up_null = array(
          'k_id_register'  => $registros[$i]->k_id_register,
          'k_id_estado_ot' => null
        );
        $res = $this->Dao_ot_hija_model->update_ot_hija($up_null);
        $nulos++;
      }

    }
    // Array para retornar los registros afectados
    $respuesta = array(
      'actu' => $act,
      'nulos' => $nulos
    );
    echo json_encode($respuesta);
  }


  
  
}
