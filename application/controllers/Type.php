<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ot_hija_model');
        $this->load->model('data/Dao_tipo_ot_hija_model');
        $this->load->model('data/Dao_estado_ot_model');
    }

    //
    public function type_restore($msj = null) {
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
    public function c_getNewStatusByType() {
        $nombre_tipo = $this->input->post('name');
        $estados     = $this->Dao_ot_hija_model->getNewStatusByType($nombre_tipo);
        echo json_encode($estados);
    }

    //guardar tipos con sus estados nuevos
    public function c_save_new_Type() {
        $existe = $this->Dao_tipo_ot_hija_model->get_tipo_ot_hija_by_name($this->input->post('name_type'));
        if ($existe) {
            $msj = 'existen';
            $this->type_restore($msj);
        } else {
            // Inserto el nuevo tipo
            $data_type = array(
                'n_name_tipo'  => $this->input->post('name_type'),
                'i_referencia' => null,
            );
            $id_tipo_nuevo = $this->Dao_tipo_ot_hija_model->insert_new_type($data_type);

            $cant = 0;
            // Inserto los diferentes estados del tipo nuevo
            for ($i = 0; $i < count($this->input->post('name_status')); $i++) {
                $data_status = array(
                    'k_id_tipo'        => $id_tipo_nuevo,
                    'n_name_estado_ot' => $this->input->post('name_status')[$i],
                    'i_orden'          => $this->input->post('jerarquia')[$i],
                );
                $r = $this->Dao_estado_ot_model->insert_new_status($data_status);

                $registro = $this->Dao_ot_hija_model->update_regis_indef_by_estado($id_tipo_nuevo, $this->input->post('name_type'), $this->input->post('name_status')[$i]);
                $cant     = $cant + $registro;
            }

            $msj = ($cant > 0) ? $cant : 'error';
            $this->type_restore($msj);
        }
    }

    // Obtener todos los tipos originales existentes
    public function c_get_list_types() {
        $types = $this->Dao_tipo_ot_hija_model->get_list_types();
        echo json_encode($types);
    }

    // guardar variantes nuevas de Tipos
    public function c_save_type_variant() {
        // vERIFICO QUE EL TIPO NI EXISTA
        $exis = $this->Dao_tipo_ot_hija_model->get_tipo_ot_hija_by_name($this->input->post('name'));
        if (!$exis) {
            // Creo los valores para insertar la variante en tipo_ot
            $data = array(
                'i_referencia' => $this->input->post('id_type'),
                'n_name_tipo'  => $this->input->post('name'),
            );
            // inserto el nuevo registro
            $id_tipo_nuevo = $this->Dao_tipo_ot_hija_model->insert_new_type($data);
            // traigo los registros que tengan el nombre del tipo nuevo
            $registros = $this->Dao_ot_hija_model->get_ot_by_tipo($this->input->post('name'));
            //contadores de actualizados y actualizados nulos
            $act   = 0;
            $nulos = 0;
            // Recorro los registros que vengan con el tipo nuevo
            for ($i = 0; $i < count($registros); $i++) {
                // Obtengo el id del estado con la combinacion de tipo y estado del registro
                $id_estado = $this->Dao_estado_ot_model->get_status_by_idtipo_and_name_status($this->input->post('id_type'), $registros[$i]->estado_orden_trabajo_hija);
                // si existe ese estado...
                if ($id_estado) {
                    // Creo los arreglo para la actualizacion de los registros
                    $up = array(
                        'k_id_register'  => $registros[$i]->k_id_register,
                        'k_id_estado_ot' => $id_estado->k_id_estado_ot,
                    );
                    $res = $this->Dao_ot_hija_model->update_ot_hija($up);
                    // Si se actulizó el registro suma un uno al contador
                    $act++;
                } else {
                    // actualizar el k_id_estado a null
                    $up_null = array(
                        'k_id_register'  => $registros[$i]->k_id_register,
                        'k_id_estado_ot' => null,
                    );
                    $res = $this->Dao_ot_hija_model->update_ot_hija($up_null);
                    $nulos++;
                }

            }
            // Array para retornar los registros afectados
            $respuesta = array(
                'actu'  => $act,
                'nulos' => $nulos,
            );
        } else {
            // Si ya existe el tipo retorno 0 y no hace nada
            $respuesta = array(
                'actu'  => 0,
                'nulos' => 0,
            );
        }
        echo json_encode($respuesta);
    }

    // TABLA DE INCONSISTENCIA
    public function getListOtsUndefined() {
        $UndefinedOts = $this->Dao_ot_hija_model->getAllOtsUndefined();
        echo json_encode($UndefinedOts);
    }

    // tabla de null
    public function c_getListOtsNull() {
        $NullOts = $this->Dao_ot_hija_model->getListOtsNull();
        echo json_encode($NullOts);
    }

    // trae los diferentes tipos de oth que tiene una ot padre|
    public function c_get_types_by_iduser_otp() {
        $otp     = $this->input->post('otp');
        $iduser  = $this->input->post('iduser');
        $general = $this->Dao_tipo_ot_hija_model->get_types_by_iduser_otp($otp, $iduser);

        // print_r($general);
        $tipos = [];

        // ORDENAR POR JERARQUIA DE TIPOS PONIENDO INDICE I_ORDEN Y PASANDO EL TIPO DENTRO DEL ARRAY

        for ($i = 0; $i < count($general); $i++) {
            // caso1: si el tiempo del registro es mayor a 1 estará vencido (predomina el estado 1)
            if ($general[$i]->tiempo > 0) {
                $tipos[$general[$i]->i_orden] = array('tiempo' => 1, 'name' => $general[$i]->n_name_tipo, 'k_id_tipo' => $general[$i]->k_id_tipo);
            }
            // caso2: si el tiempo del registro es 0 o sea (hoy) estará para hoy (predomina el estado 1)
            if ($general[$i]->tiempo == 0) {
                if (!array_key_exists($general[$i]->k_id_tipo, $tipos)) {
                    $tipos[$general[$i]->i_orden] = array('tiempo' => 0, 'name' => $general[$i]->n_name_tipo, 'k_id_tipo' => $general[$i]->k_id_tipo);
                } else {
                    // si es el mismo (hoy) o 1 (vencido) no lo cambia si es -1 (en tiempo) lo cambia a hoy
                    if ($tipos[$general[$i]->i_orden]['tiempo'] == -1) {
                        $tipos[$general[$i]->i_orden] = array('tiempo' => 0, 'name' => $general[$i]->n_name_tipo, 'k_id_tipo' => $general[$i]->k_id_tipo);
                    }
                }
            }

            if ($general[$i]->tiempo < 0) {
                if (!array_key_exists($general[$i]->k_id_tipo, $tipos)) {
                    $tipos[$general[$i]->i_orden] = array('tiempo' => -1, 'name' => $general[$i]->n_name_tipo, 'k_id_tipo' => $general[$i]->k_id_tipo);
                }
            }

        }
        $indices = [];
        foreach ($tipos as $key => $value) {
            array_push($indices, $key);
        }

        rsort($indices);
        $retorno = array(
            'indices' => $indices,
            'tipos'   => $tipos,
        );
        echo json_encode($retorno);
    }

}
