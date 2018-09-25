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
        $data['title'] = '¿Cómo vamos OTP?'; // cargar el  titulo en la pestaña de la pagina para otp
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
                    $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = array('time' => 1, "cliente" => $general[$i]->n_nombre_cliente);
                    $ingenieros[$general[$i]->k_id_user]['out'] ++;
                    $cont_total_out_otp++;
                    $cont_total_otp++;
                } else {
                    switch ($ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre]['time']) {
                        case '1':

                            break;
                        case '0':
                            $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre]['time'] = 1;
                            $ingenieros[$general[$i]->k_id_user]['out'] ++;
                            $ingenieros[$general[$i]->k_id_user]['hoy'] --;
                            $cont_total_out_otp++;
                            $cont_total_hoy_otp--;
                            break;
                        case '-1':
                            $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre]['time'] = 1;
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
                    $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = array('time' => 0, "cliente" => $general[$i]->n_nombre_cliente);
                    $ingenieros[$general[$i]->k_id_user]['hoy'] ++;
                    $cont_total_otp++;
                    $cont_total_hoy_otp++;
                } else if ($ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre]['time'] == -1) {  

                    $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre]['time'] = 0;
                    $ingenieros[$general[$i]->k_id_user]['hoy'] ++;
                    $ingenieros[$general[$i]->k_id_user]['in'] --;
                    $cont_total_hoy_otp++;
                    $cont_total_in_otp--;
                }
            }

            if ($general[$i]->tiempo < 0) {
                if (!array_key_exists($general[$i]->k_id_ot_padre, $ingenieros[$general[$i]->k_id_user])) {
                    $ingenieros[$general[$i]->k_id_user][$general[$i]->k_id_ot_padre] = array('time' => -1, "cliente" => $general[$i]->n_nombre_cliente);;
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
    public function c_getListOtsOtPadre() {
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
    public function c_getListOtsOtPadreHoy() {
        $otPadreList = $this->Dao_ot_padre_model->getListOtsOtPadreHoy();
        echo json_encode($otPadreList);
    }

// TABLA QUE TRAE LA INFORMACION DE OTPADRE QUE TENGAN FECHA DE COMPROMISO VENCIDA
    public function c_getListOtsOtPadreVencidas() {
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

    // TABLA QUE TRAE TODAS LAS OTH DE UNA OTP
    public function c_getOthOfOtp() {
        $idOtp = $this->input->post('idOtp');
        $listotps = $this->Dao_ot_padre_model->getothofothp($idOtp);
        echo json_encode($listotps);
    }
    
    // TABLA QUE TRAE TODAS LAS OTH QUE ESTEN EN LA TABLA CIERRE_OTS DE UNA OTP
    public function c_getOthOfOtpCierre() {
        $idOtp = $this->input->post('idOtp');
        $listotps = $this->Dao_ot_padre_model->getOthOfOtpCierre($idOtp);
        echo json_encode($listotps);
    }

    // TABLA QUE TRAE LA INFORMACION DE OTPADRE
    public function c_getListOtsOtPadreEmail() {
        $otPadreList = $this->Dao_ot_padre_model->getListOtsOtPadreEmail();
        echo json_encode($otPadreList);
    }
    
    //obtine la informacion de los hitos de una otp
    public function c_getHitosOtp() {
        $idOtp = $this->input->post('idOtp');
        $hitosotp = $this->Dao_ot_padre_model->getHitosOtp($idOtp);
        echo json_encode($hitosotp);
    }
    
    //Guarda la informacion de los hitos de una OTP
    public function c_saveHitosOtp() {
        $idOtp = $this->input->post('idOtp');
        $formulario = $this->input->post('formulario');
        $res = $this->Dao_ot_padre_model->saveHitosOtp($idOtp, $formulario);
        echo json_encode($res);
    }
    
    public function c_sendReportUpdate() {
        $template = '';
        $observaciones = '';
        $this->load->helper('camilo');
        $ids_otp = $this->input->post('ids_otp');
        $email = Auth::user()->n_mail_user;
//        $email_cc = ['prfmjhonfredy@gmail.com','jfchaparro33@misena.edu.co','bredi.buitrago@zte.com.cn'];
        foreach ($ids_otp as $idOtp) {
            $hitosotp = $this->Dao_ot_padre_model->getHitosOtp($idOtp);
            $infOtp = $this->Dao_ot_padre_model->getDetailsHitosOTP($idOtp); 
            $observaciones = $hitosotp->observaciones_ko . '<br><br>' .
                            $hitosotp->observaciones_voc . '<br><br>' .
                            $hitosotp->observaciones_voct . '<br><br>' .
                            $hitosotp->observaciones_ec . '<br><br>' .
                            $hitosotp->observaciones_ac . '<br><br>' .
                            $hitosotp->observaciones_sit . '<br><br>' .
                            $hitosotp->observaciones_veoc . '<br><br>' .
                            $hitosotp->observaciones_veoct . '<br><br>' .
                            $hitosotp->observaciones_crc . '<br><br>' .
                            $hitosotp->observaciones_veut;
            $template .= '
                <div dir="ltr">
                    <table border="0" cellpadding="0" cellspacing="0" width="712" style="border-collapse:collapse;box-shadow: rgba(8, 76, 111, 0.5) 6px 7px;">
                        <colgroup><col width="80" style="width:60pt">
                            <col width="252" style="width:189pt">
                            <col width="140" style="width:105pt">
                            <col width="80" span="3" style="width:60pt">
                        </colgroup>
                        <tbody>
                            <tr height="20" style="height:20pt">
                                <td colspan="2" height="20" class="m_-7809522729103588979gmail-xl67" width="332" style="height:15pt;width:249pt;border:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap"><label id="servivio_hito" style="margin-right: 50px; margin-left: 10px;"><strong> OT '. $idOtp .' - '. $infOtp->servicio .' </strong></label></td>
                                <td colspan="2" class="m_-7809522729103588979gmail-xl67" width="220" style="border-left:none;width:165pt;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap"><label id="cliente_hito" style="margin-right: 50px; margin-left: 10px;"><strong> CLIENTE: '. $infOtp->n_nombre_cliente .'</strong></label></td>
                                <td colspan="2" class="m_-7809522729103588979gmail-xl67" width="160" style="border-left:none;width:120pt;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap"><label id="ciudad_hito" style="margin-right: 50px; margin-left: 10px;"><strong> CIUDAD: '. $infOtp->ciudad .' - '. $infOtp->direccion .'</strong></label></td>
                            </tr>
                            <tr height="20" style="height:40pt;background: #084c6f;">
                                <td height="20" class="m_-7809522729103588979gmail-xl65" style="height:15pt;border-top:none;border-right: 0.5pt solid #ffff;border-bottom:0.5pt solid windowtext;border-left:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;</td>
                                <td class="m_-7809522729103588979gmail-xl70" style="border-top:none;border-left:none;text-align:center;vertical-align:middle;border-right: 0.5pt solid #ffff;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color: #ffffff;font-size:11pt;font-family:Calibri,sans-serif;white-space:nowrap;font-weight: bold;">ACTIVIDAD</td>
                                <td class="m_-7809522729103588979gmail-xl70" style="border-top:none;border-left:none;text-align:center;vertical-align:middle;border-right: 0.5pt solid #ffff;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color: #ffffff;font-size:11pt;font-family:Calibri,sans-serif;white-space:nowrap;font-weight: bold;">FECHA COMPROMISO</td>
                                <td class="m_-7809522729103588979gmail-xl70" style="border-top:none;border-left:none;text-align:center;vertical-align:middle;border-right: 0.5pt solid #ffff;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color: #ffffff;font-size:11pt;font-family:Calibri,sans-serif;white-space:nowrap;font-weight: bold;">ESTADO</td>
                                <td colspan="2" class="m_-7809522729103588979gmail-xl70" style="border-left:none;text-align:center;vertical-align:middle;border-top:0.5pt solid windowtext;border-right: 0.5pt solid #ffff;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color: #ffffff;font-size:11pt;font-family:Calibri,sans-serif;white-space:nowrap;font-weight: bold;">OBSERVACIONES</td>
                            </tr>
                            <tr height="20" style="height:15pt">
                                <td height="20" class="m_-7809522729103588979gmail-xl65" style="height:15pt;border-top:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap"><div style="color: #fff; width: 54px; height: 54px; line-height: 52px; font-size: 22px; text-align: center; top: 18px; left: 50%; margin-left: -25px; border: 3px solid #ffffff; z-index: 100; border-top-right-radius: 50%; border-top-left-radius: 50%; border-bottom-right-radius: 50%; border-bottom-left-radius: 50%; margin: 10px; background-color: '. ($hitosotp->actividad_actual == 'KICK OFF' ? '#4bd605':'#7c7c7c') .';">1</div></td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">KICK OFF</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;box-sizing:content-box;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->f_compromiso_ko .'</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->estado_ko .'</td>
                                <td colspan="2" rowspan="10" class="m_-7809522729103588979gmail-xl75" style="border-width:0.5pt;border-style:solid;border-color:windowtext black black windowtext;text-align:left;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $observaciones .'</td>
                            </tr>
                            <tr height="20" style="height:15pt">
                                <td rowspan="2" height="40" class="m_-7809522729103588979gmail-xl67" style="height:30pt;border-top:none;text-align:center;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap"><div style="color: #fff; width: 54px; height: 54px; line-height: 52px; font-size: 22px; text-align: center; top: 18px; left: 50%; margin-left: -25px; border: 3px solid #ffffff; z-index: 100; border-top-right-radius: 50%; border-top-left-radius: 50%; border-bottom-right-radius: 50%; border-bottom-left-radius: 50%; margin: 10px; background-color: '. (($hitosotp->actividad_actual == 'VISITA OBRA CIVIL' || $hitosotp->actividad_actual == 'VISITA OBRA CIVIL TERCEROS') ? '#4bd605':'#7c7c7c') .';">2</div></td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">VISITA OBRA CIVIL</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->f_compromiso_voc .'</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->estado_voc .'</td>
                            </tr>
                            <tr height="20" style="height:15pt">
                                <td height="20" class="m_-7809522729103588979gmail-xl65" style="height:15pt;border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">VISITA OBRA CIVIL TERCEROS</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->f_compromiso_voct .'</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->estado_voct .'</td>
                            </tr>
                            <tr height="20" style="height:15pt">
                                <td height="20" class="m_-7809522729103588979gmail-xl65" style="height:15pt;border-top:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap"><div style="color: #fff; width: 54px; height: 54px; line-height: 52px; font-size: 22px; text-align: center; top: 18px; left: 50%; margin-left: -25px; border: 3px solid #ffffff; z-index: 100; border-top-right-radius: 50%; border-top-left-radius: 50%; border-bottom-right-radius: 50%; border-bottom-left-radius: 50%; margin: 10px; background-color: '. ($hitosotp->actividad_actual == 'ENVIO COTIZACION' ? '#4bd605':'#7c7c7c') .';">3</div></td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">ENVIÓ COTIZACIÓN</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->f_compromiso_ec .'</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->estado_ec .'</td>
                            </tr>
                            <tr height="20" style="height:15pt">
                                <td height="20" class="m_-7809522729103588979gmail-xl65" style="height:15pt;border-top:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap"><div style="color: #fff; width: 54px; height: 54px; line-height: 52px; font-size: 22px; text-align: center; top: 18px; left: 50%; margin-left: -25px; border: 3px solid #ffffff; z-index: 100; border-top-right-radius: 50%; border-top-left-radius: 50%; border-bottom-right-radius: 50%; border-bottom-left-radius: 50%; margin: 10px; background-color: '. ($hitosotp->actividad_actual == 'APROBACION COTIZACION' ? '#4bd605':'#7c7c7c') .';">4</div></td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">APROBACIÓN COTIZACIÓN</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->f_compromiso_ac .'</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->estado_ac .'</td>
                            </tr>
                            <tr height="20" style="height:15pt">
                                <td height="20" class="m_-7809522729103588979gmail-xl65" style="height:15pt;border-top:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap"><div style="color: #fff; width: 54px; height: 54px; line-height: 52px; font-size: 22px; text-align: center; top: 18px; left: 50%; margin-left: -25px; border: 3px solid #ffffff; z-index: 100; border-top-right-radius: 50%; border-top-left-radius: 50%; border-bottom-right-radius: 50%; border-bottom-left-radius: 50%; margin: 10px; background-color: '. ($hitosotp->actividad_actual == 'SOLICITUD INFORMACIÓN TECNICA' ? '#4bd605':'#7c7c7c') .';">5</div></td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">SOLICITUD INFORMACIÓN
                                    TÉCNICA</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->f_compromiso_sit .'</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->estado_sit .'</td>
                            </tr>
                            <tr height="20" style="height:15pt">
                                <td rowspan="2" height="40" class="m_-7809522729103588979gmail-xl73" style="border-bottom:0.5pt solid black;height:30pt;border-top:none;text-align:center;border-right:0.5pt solid windowtext;border-left:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap"><div style="color: #fff; width: 54px; height: 54px; line-height: 52px; font-size: 22px; text-align: center; top: 18px; left: 50%; margin-left: -25px; border: 3px solid #ffffff; z-index: 100; border-top-right-radius: 50%; border-top-left-radius: 50%; border-bottom-right-radius: 50%; border-bottom-left-radius: 50%; margin: 10px; background-color: '. ($hitosotp->actividad_actual == 'VISITA EJECUCION OBRA CIVIL' || $hitosotp->actividad_actual == 'VISITA EJECUCION OBRA CIVIL TERCERO' ? '#4bd605':'#7c7c7c') .';">6</div></td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">VISITA EJECUCIÓN OBRA
                                    CIVIL</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->f_compromiso_veoc .'</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->estado_veoc .'</td>
                            </tr>
                            <tr height="20" style="height:15pt">
                                <td height="20" class="m_-7809522729103588979gmail-xl65" style="height:15pt;border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">VISITA EJECUCIÓN OBRA CIVIL TERCERO</td>
                                <td class="m_-7809522729103588979gmail-xl66" width="140" style="border-top:none;border-left:none;width:105pt;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle">&nbsp;'. $hitosotp->f_compromiso_veoct .'</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->estado_veoct .'</td>
                            </tr>
                            <tr height="20" style="height:15pt">
                                <td height="20" class="m_-7809522729103588979gmail-xl65" style="height:15pt;border-top:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap"><div style="color: #fff; width: 54px; height: 54px; line-height: 52px; font-size: 22px; text-align: center; top: 18px; left: 50%; margin-left: -25px; border: 3px solid #ffffff; z-index: 100; border-top-right-radius: 50%; border-top-left-radius: 50%; border-bottom-right-radius: 50%; border-bottom-left-radius: 50%; margin: 10px; background-color: '. ($hitosotp->actividad_actual == 'CONFIGURACION RED CLARO' ? '#4bd605':'#7c7c7c') .';">7</div></td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">CONFIGURACIÓN RED
                                    CLARO</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->f_compromiso_crc .'</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->estado_crc .'</td>
                            </tr>
                            <tr height="20" style="height:15pt">
                                <td height="20" class="m_-7809522729103588979gmail-xl65" style="height:15pt;border-top:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap"><div style="color: #fff; width: 54px; height: 54px; line-height: 52px; font-size: 22px; text-align: center; top: 18px; left: 50%; margin-left: -25px; border: 3px solid #ffffff; z-index: 100; border-top-right-radius: 50%; border-top-left-radius: 50%; border-bottom-right-radius: 50%; border-bottom-left-radius: 50%; margin: 10px; background-color: '. ($hitosotp->actividad_actual == 'VISITA ENTREGA UM TERCEROS' ? '#4bd605':'#7c7c7c') .';">8</div></td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">VISITA ENTREGA UM
                                    TERCEROS</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->f_compromiso_veut .'</td>
                                <td class="m_-7809522729103588979gmail-xl65" style="border-top:none;border-left:none;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;color:black;font-size:11pt;font-family:Calibri,sans-serif;vertical-align:middle;white-space:nowrap">&nbsp;'. $hitosotp->estado_veut .'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br><br>';
            
        }
        $res = enviarCorreo($template, $email, 'Reporte de actualización');
//        print_r($template);
        echo json_encode($res);
    }
    
    //trae la informacion del cierre de una KO de una otp
    public function c_getProductByOtp() {
        $idOtp = $this->input->post('id_otp');
        $numServicio = $this->input->post('num_servicio');
        $res = $this->Dao_ot_padre_model->getProductByOtp($idOtp, $numServicio);
        echo json_encode($res);
    }

}
