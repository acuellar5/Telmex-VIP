<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class OtHija extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ot_hija_model');
        $this->load->model('data/Dao_log_model');
        $this->load->model('data/Dao_estado_ot_model');
    }


    public function editOts() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $data['title']='Editar OTS';
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $this->load->view('parts/headerF', $data);
        $this->load->view('moduleOts');
        $this->load->view('parts/footerF');
    }

    // Selecciona todas las ots actuales
    public function c_getOtsAssigned() {
        $response = null;
        if (Auth::check()) {
            ini_set('memory_limit', '-1');
            $otHijaModel = new Dao_ot_hija_model();
            $data = $otHijaModel->getOtsAssigned();
            $res['data'] = $data->result();
            $res['count'] = $data->num_rows();
            $this->json($res);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
    }

    
    public function c_getOtsFiteenDays() {
        $response = null;
        if (Auth::check()) {
            $data = $this->Dao_ot_hija_model->getOtsFiteenDays();
            // $otHijaModel = new Dao_ot_hija_model();
            $res['data'] = $data->result();
            $res['count'] = $data->num_rows();
            $this->json($res);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
    }

    // Función para traer dinamicamente elementos del datatables con server side prossesing
    public function getListTotalOts(){
        ini_set('memory_limit', '-1');
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

        $col_names = ['ot.nro_ot_onyx', 'ot.id_orden_trabajo_hija', 'ot.nombre_cliente', 'ot.fecha_compromiso', 'ot.fecha_programacion', 'ot.ot_hija', 'ot.estado_orden_trabajo_hija', 'CONCAT("$" ,FORMAT(ot.monto_moneda_local_arriendo + ot.monto_moneda_local_cargo_mensual,2))', 'ot.usuario_asignado'];
        $search_col = ""; 
        $cant_colum = count($this->input->post('columns'));

        for ($i=0; $i < $cant_colum; $i++) { 
            if ($this->input->post('columns')[$i]['search']['value'] !== "") {
                $search_col .= " AND (". $col_names[$i] ." LIKE '%".$this->input->post('columns')[$i]['search']['value']."%') ";
            }
        }

        // hago la consulta al modelo y le envio los parametros
        $result = $this->Dao_ot_hija_model->getAllOtPS($parameters, $search_col);
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
    
    public function c_getOtsNew() {
        $response = null;
        if (Auth::check()) {
            ini_set('memory_limit', '-1');
            $otHijaModel = new Dao_ot_hija_model();
            $data = $otHijaModel->getOtsNew();
            $res['data'] = $data->result();
            $res['count'] = $data->num_rows();

            $this->json($res);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
    }
    
    public function c_getOtsChange() {
        $response = null;
        if (Auth::check()) {
            $otHijaModel = new Dao_ot_hija_model();
            $data = $otHijaModel->getOtsChange();
            $res['data'] = $data->result();
            $res['count'] = $data->num_rows();
            $this->json($res);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
    }
    
    public function c_getOtsOutTime() {
        $response = null;
        if (Auth::check()) {
            $idTipo = $this->input->post('idTipo');
            $otHijaModel = new Dao_ot_hija_model();
            $res = $otHijaModel->getOtsOutTime($idTipo);
            $this->json($res);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
    }

    public function c_getOtsInTimes() {
        $response = null;
        if (Auth::check()) {
            $idTipo = $this->input->post('idTipo');
            $otHijaModel = new Dao_ot_hija_model();
            $res = $otHijaModel->getOtsInTimes($idTipo);
            $this->json($res);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }
    }



    /**************************************************************************************************************/
    /*************************ACOSTUMBRENSE A COMENTAR TODAS LAS FUNCIONES QUE HAGAN PUTOS*************************/
    /**************************************************************************************************************/
}
