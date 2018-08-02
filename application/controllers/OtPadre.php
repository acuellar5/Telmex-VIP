<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class OtPadre extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_user_model');
        $this->load->model('data/Dao_ot_padre_model');
        $this->load->model('data/Dao_ot_hija_model');
    }

    // carga la vista para como vamos ot padre
    public function view_otp() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $data['last_time'] = $this->Dao_ot_hija_model->get_last_time_import();
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $data['ingenieros'] = $this->Dao_user_model->get_eng_trabajanding();
        $data['title'] = 'OTP'; // cargar el  titulo en la pestaña de la pagina para otp
        $this->load->view('parts/headerF', $data);
        $this->load->view('moduleOtp');
        $this->load->view('parts/footerF');
    }

    //trae los contadores de cantidades en tiempos y fuera de tiempos y hoy
    public function in_today_out() {
        // header('Content-Type: text/plain');
        $general = $this->Dao_ot_hija_model->get_ots_times();
        $total_reg = count($general);

        $cont_total_in_otp = 0;
        $cont_total_out_otp = 0;
        $cont_total_hoy_otp = 0;
        $cont_total_otp = 0;

        $ingenieros = [];
        $x = 0;
        for ($i = 0; $i < $total_reg; $i++) {
            // CReamos el indice del ingeniero para otp si no existe
            if (!isset($ingenieros[$general[$i]->k_id_user])) {
                $ingenieros[$general[$i]->k_id_user] = [];
                $ingenieros[$general[$i]->k_id_user]['out'] = 0;
                $ingenieros[$general[$i]->k_id_user]['in'] = 0;
                $ingenieros[$general[$i]->k_id_user]['hoy'] = 0;
            }

            // validar si oth está fuera de times 
            if ($general[$i]->tiempo > 0) {
                if (!array_key_exists($general[$i]->k_id_ot_padre, $ingenieros[$general[$i]->k_id_user])) {
                    $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = 1;
                    $ingenieros[$general[$i]->k_id_user]['out'] ++;
                    $cont_total_out_otp++;
                    $cont_total_otp++;
                } else {
                    switch ($ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre]) {
                        case '1':

                            break;
                        case '0':
                            $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = 1;
                            $ingenieros[$general[$i]->k_id_user]['out'] ++;
                            $ingenieros[$general[$i]->k_id_user]['hoy'] --;
                            $cont_total_out_otp++;
                            $cont_total_hoy_otp--;
                            break;
                        case '-1':
                            $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = 1;
                            $ingenieros[$general[$i]->k_id_user]['out'] ++;
                            $ingenieros[$general[$i]->k_id_user]['in'] --;
                            $cont_total_out_otp++;
                            $cont_total_in_otp--;
                            break;
                    }
                }
            }

            // validar si oth está para now
            if ($general[$i]->tiempo == 0) {
                if (!array_key_exists($general[$i]->k_id_ot_padre, $ingenieros[$general[$i]->k_id_user])) {
                    $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = 0;
                    $ingenieros[$general[$i]->k_id_user]['hoy'] ++;
                    $cont_total_otp++;
                    $cont_total_hoy_otp++;
                } else if ($ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] == -1) {

                    $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = 0;
                    $ingenieros[$general[$i]->k_id_user]['hoy'] ++;
                    $ingenieros[$general[$i]->k_id_user]['in'] --;
                    $cont_total_hoy_otp++;
                    $cont_total_in_otp--;
                }
            }

            if ($general[$i]->tiempo < 0) {
                if (!array_key_exists($general[$i]->k_id_ot_padre, $ingenieros[$general[$i]->k_id_user])) {
                    $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = -1;
                    $ingenieros[$general[$i]->k_id_user]['in'] ++;
                    $cont_total_in_otp++;
                    $cont_total_otp++;
                }
            }

            $ingenieros[$general[$i]->k_id_user]['all'] = $ingenieros[$general[$i]->k_id_user]['in'] + $ingenieros[$general[$i]->k_id_user]['hoy'] + $ingenieros[$general[$i]->k_id_user]['out'];

            if ($ingenieros[$general[$i]->k_id_user]['out'] > 0) {
                $ingenieros[$general[$i]->k_id_user]['color'] = "btn_red";
            } else if ($ingenieros[$general[$i]->k_id_user]['hoy'] > 0) {
                $ingenieros[$general[$i]->k_id_user]['color'] = "btn_orange";
            } else {
                $ingenieros[$general[$i]->k_id_user]['color'] = "btn_green";
            }
        }


        // Seccion para el tratamiento de la grafica ppalo

        $grafics = [];

        $grafics['g_inges'] = [];
        $grafics['g_in'] = [];
        $grafics['g_hoy'] = [];
        $grafics['g_out'] = [];
        $grafics['g_all'] = [];
        $n_i = []; // nombre ingeniero
        // print_r($ingenieros);

        $array_list_inge = $this->Dao_user_model->get_eng_trabajanding();
        // print_r($array_list_inge);
        for ($i = 0; $i < count($array_list_inge); $i++) {
            $n_i[$array_list_inge[$i]->k_id_user] = $array_list_inge[$i]->nombre;
        }



        foreach ($ingenieros as $cc => $value) {
            array_push($grafics['g_inges'], $n_i[$cc]);
            array_push($grafics['g_in'], $value['in']);
            array_push($grafics['g_hoy'], $value['hoy']);
            array_push($grafics['g_out'], $value['out']);
            array_push($grafics['g_all'], $value['all']);
        }



        $retorno = array(
            'cant_otp' => $cont_total_otp,
            'cant_in' => $cont_total_in_otp,
            'cant_hoy' => $cont_total_hoy_otp,
            'cant_out' => $cont_total_out_otp,
            'ing' => $ingenieros,
            'grafics' => $grafics
        );

        echo json_encode($retorno);
    }

    public function managementOtp() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $data['title'] = 'Work Management OTP';
        $this->load->view('parts/headerF', $data);
        $this->load->view('work_managementOtp');
        $this->load->view('parts/footerF');
    }

    // Retorna las ot padres de un ingeniero
    public function c_get_otp_by_id_user() {
        $inge_id = $this->input->post('iduser');
        $ots = $this->Dao_ot_padre_model->get_otp_by_id_user($inge_id);
        echo json_encode($ots);
    }

    // TABLA QUE TRAE LA INFORMACION DE OTPADRE
    public function getListOtsOtPadre() {
        $otPadreList = $this->Dao_ot_padre_model->getListOtsOtPadre();
        echo json_encode($otPadreList);
    }

    //inserta los datos (lista y observaciones )de la vista detalles
    public function update_data() {

        $fecha_actual = new DateTime();
        $ingeniero = Auth::user()->k_id_user;
        $data = array(
            'k_id_ot_padre' => $this->security->xss_clean(strip_tags($this->input->post('id'))),
            'lista_observaciones' => $this->security->xss_clean(strip_tags($this->input->post('lista'))),
            'observacion' => $this->security->xss_clean(strip_tags($this->input->post('observacion'))),
            'fecha_actualizacion' => $fecha_actual->format('Y-m-d'),
            'usuario_actualizacion' => $ingeniero
        );

        // print_r($data);


        $res = $this->Dao_ot_padre_model->update_new_data($data);

        echo json_encode($res);
    }

    // TABLA QUE TRAE LA INFORMACION DE OTPADRE QUE TENGAN FECHA DE COMPROMISO PARA HOY
    public function getListOtsOtPadreHoy() {
        $otPadreList = $this->Dao_ot_padre_model->getListOtsOtPadreHoy();
        echo json_encode($otPadreList);
    }

// TABLA QUE TRAE LA INFORMACION DE OTPADRE QUE TENGAN FECHA DE COMPROMISO VENCIDA
    public function getListOtsOtPadreVencidas() {
        $otPadreList = $this->Dao_ot_padre_model->getListOtsOtPadreVencidas();
        echo json_encode($otPadreList);
    }

    // Trae registro otp por opcion de lista
    public function c_getOtpByOpcList() {
        $opcion = $this->input->post('opcion');
        $otPadreList = $this->Dao_ot_padre_model->getOtpByOpcList($opcion);

        echo json_encode($otPadreList);
    }

    // valida si es posible cerrar la ot padre
    public function c_closeOtp() {
        $respuesta = [];
        $idOtp = $this->input->post('idOtp');
        $cantOthAbiertas = $this->Dao_ot_padre_model->getCantOthInExecutionByIdOtp($idOtp);
        if ($cantOthAbiertas->cant == 0) {
            $data = array(
                'estado_orden_trabajo' => 'otp_cerrada',
            );

            $this->db->where('k_id_ot_padre', $idOtp);
            
            if ($this->db->update('ot_padre', $data)) {
                $respuesta['response'] = 'success';
            }
        } else {
            $respuesta['response'] = 'error';
            $respuesta['cant_oth_abiertas'] = $cantOthAbiertas->cant;
            $respuesta['oth_abiertas'] = $this->Dao_ot_padre_model->getOthInExecutionByIdOtp($idOtp);
        }
//
        echo json_encode($respuesta);
    }

}
