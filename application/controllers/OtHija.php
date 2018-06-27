<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class OtHija extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ot_hija_model');
        $this->load->model('data/Dao_log_model');
        $this->load->model('data/Dao_estado_ot_model');
    }

    public function getOtsAssigned() {
        $response = null;
        if (Auth::check()) {
            $otHijaModel = new Dao_ot_hija_model();
            $res = $otHijaModel->getOtsAssigned();
            $this->json($res);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
    }
    
    public function c_updateStatusOt() {
        //Se comprueba si no hay sesión.
        // print_r($_POST);
        $text_estado = $this->Dao_estado_ot_model->getNameStatusById($this->input->post('k_id_estado_ot'));

        date_default_timezone_set("America/Bogota");
        $fActual = date('Y-m-d');
        $data = array(
            'id_orden_trabajo_hija' => $this->input->post('id_orden_trabajo_hija'),
            'k_id_estado_ot' => $this->input->post('k_id_estado_ot'),
            'estado_orden_trabajo_hija' => $text_estado,
            'fecha_actual' => $fActual,
            'estado_mod' => 1
        );

        $dataLog = array(
            'id_ot_hija' => $this->input->post('id_orden_trabajo_hija'),
            'antes' => $this->input->post('estado_orden_trabajo_hija'),
            'ahora' => $text_estado,
            'columna' => 'estado_orden_trabajo_hija',
            'fecha_mod' => $fActual,
        );
        

        $res = $this->Dao_ot_hija_model->m_updateStatusOt($data, $dataLog); 

         echo json_encode($res);
    }
    
    public function getOtsFiteenDays() {
        $response = null;
        if (Auth::check()) {
            $otHijaModel = new Dao_ot_hija_model();
            $res['data'] = $otHijaModel->getOtsFiteenDays();
            $res['count'] = $otHijaModel->getCountOtsFiteenDays()->data;
            $this->json($res);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
    }

    // Función para traer dinamicamente elementos del datatables con server side prossesing
    public function getListTotalOts(){
        // se configuro el datatables para q envie los parametros por post
        // colum_num se usa para el ordenamiento por columna dependiendo la peticion
        $columm_num = $this->input->post('order')['0']['column'];
        // parametros obtenidos... 
        $parameters = array(
               'start'  => $this->input->post('start'),//start se usa para la paginacion ('desde')
               'length' => $this->input->post('length'),//length para la cantidad ('cuantos')... lo controla el select de mostrar
               'search' => $this->input->post('search')['value'],// search para lo que ingresa el usuario en el buscador
               'order'  => $this->input->post('order')['0']['dir'],// order para el direccionamiento de la ordenada
               'columm' => $this->input->post('columns')[$columm_num]['data']// column es la columna q se le dio click(ordenamiento)
              );

        // hago la consulta al modelo y le envio los parametros
        $result = $this->Dao_ot_hija_model->getAllOtPS($parameters);
        // guardo los registros en la variable resultado
        $resultado  = $result['datos'];
        // y el numero de cantidad total en la var total datos
        $totalDatos = $result['numDataTotal'];
        // guardo el total numerico de registros obtenidos en la consulta filtrada
        $totalDatoObtenido = $resultado->num_rows();

        // se tiene q enviar el arreglo $json_data para que funcione el data tables
        $json_data = array(
            "draw"            => intval($this->input->post('draw')), // necesario para la seguridad de datatables
            "recordsTotal"    => intval($totalDatoObtenido), // total de registros obtenidos con el filtro
            "recordsFiltered" => intval($totalDatos), // total de registros obtenidos sin el filtro
            "data"            => $resultado->result_array() // registros obtenidos en la consulta con el filtro
            );
        echo json_encode($json_data);        
    }
    
    public function getOtsNew() {
        $response = null;
        if (Auth::check()) {
            $otHijaModel = new Dao_ot_hija_model();
            $res = $otHijaModel->getOtsNew();
            $this->json($res);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
    }
    
    public function getOtsChange() {
        $response = null;
        if (Auth::check()) {
            $otHijaModel = new Dao_ot_hija_model();
            $res = $otHijaModel->getOtsChange();
            $this->json($res);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
    }
    
    public function getOtsOutTime() {
        $response = null;
        if (Auth::check()) {
            $otHijaModel = new Dao_ot_hija_model();
            $res = $otHijaModel->getOtsChange();
            $this->json($res);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
    }


   
}
