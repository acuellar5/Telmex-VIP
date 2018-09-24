<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ot_hija_model');
        $this->load->model('data/Dao_estado_ot_model');
        $this->load->model('data/Dao_log_correo_model');
        $this->load->model('data/Dao_hito_model');
        $this->load->model('data/Dao_producto_model');
    }

    //
    public function ko_15d($servicio = null) {

        date_default_timezone_set("America/Bogota");
        // $fActual = date('Y-m-d H:i:s');
        $fActual2 = date('Y-m-d');

        $data_template = $this->fill_formulary_ko_15($_POST);
        $template      = $this->correo_ko_15_dias($data_template);
        $data          = $this->dataLogMail();

        // $data = data();

        foreach ($data as $key => $value) {
            if (isset($_POST[$key])) {
                $data[$key] = $_POST[$key];
            }
        }

        $data['k_id_ot_padre']  = $_POST['nro_ot_onyx'];
        $data['destinatarios']  = $_POST['mail_envio'];
        $data['usuario_sesion'] = Auth::user()->k_id_user;
        $data['fecha']          = $fActual2;
        $data['clase']          = 'ko_8d';

        $this->Dao_log_correo_model->insert_data($data);

        $this->enviar_email($template, $_POST, $flag = false);

        $data_oth = array(
            'c_email'               => $_POST['c_email'] + 1,
            'id_orden_trabajo_hija' => $_POST['id_orden_trabajo_hija'],
            'last_send'             => $fActual2,
        );

        $up = $this->Dao_ot_hija_model->update_ot_hija_mod($data_oth);
    }

    public function c_updateStatusOt($servicio = null) {

        /*
        1. formulario linea base guardar en bd tabla linea_base (otp)
        2. formulario producto guardar en bd dependiendo el producto => tabla (producto)
        3. formulario servicio enviar correo plantilla correspondiente, al correo de la persona logueada // faber
        3.1 si se envió se guarda tabla log correo

        3.1.2 si nó ... mensaje no se envio (pasos de como poder enviarlo manualmente)
        3.2 sinó guardo en log_correo no envia nada msj error volver a intentar
        4. Actualizar ot_hija en tabla ot_hija
        4.1 se deben actualizar ots hijas con respecto a linea base
         */

        $pt       = $this->input->post();
        $servicio = $pt['num_servicio'];

        header('Content-Type: text/plain');
        print_r($this->input->post());

        if ($servicio && $this->input->post('k_id_estado_ot') == 3) {
            // 1. formulario linea base guardar en bd tabla linea_base (otp)
            $this->guardar_linea_base($this->input->post());
            // 2. guardar formulario producto
            $this->guardar_producto($this->input->post());
            // 3. enviar correo
            $res_envio = $this->enviar_correo_servicio($pt, $servicio);
            // 3.1 si se envio guardar formulario servicio en log correo.
            if ($res_envio) {
                $this->guardar_servicio($pt);
                // 4. Actualizar ot_hija en tabla ot_hija
                $this->actualizar_oth($pt, true);
            }
            // si no se envia no se guarda el formulario
            else {
                $msj = 'error';
                $this->session->set_flashdata('msj', $msj);
                header('Location: ' . URL::base() . '/managementOtp');
            }

            // $data_template = $this->fill_formulary($servicio, $_POST);
            // switch ($servicio) {
            //        case '1':
            //          $template = $this->internet_dedicado_empresarial($data_template);
            //          break;
            //        case '2':
            //          $template = $this->internet_dedicado($data_template);
            //          break;
            //        case '3':
            //          $template = $this->mpls_avanzado_intranet($data_template);
            //          break;
            //        case '4':
            //          $template = $this->mpls_avanzado_intranet_varios_puntos($data_template);
            //          break;
            //        case '5':
            //          $template = $this->mpls_avanzado_intranet_con_backup_de_ultima_milla_nds2($data_template);
            //          break;
            //        case '6':
            //          $template = $this->mpls_avanzado_intranet_con_backup_de_ultima_milla_y_router_nds1($data_template);
            //          break;
            //        case '7':
            //          $template = $this->avanzado_extranet($data_template);
            //          break;
            //        case '8':
            //          $template = $this->backend_mpls($data_template);
            //          break;
            //        case '9':
            //          $template = $this->mpls_avanzado_componente_datacenter_claro($data_template);
            //          break;
            //        case '10':
            //          $template = $this->mpls_transaccional_3g($data_template);
            //          break;

            // }
            //      // print_r($template);
            //      $this->enviar_email($template, $_POST);

        } else {
            // actualizar el estado
            $this->actualizar_oth($pt);
        }

    }

    // guardar formulario de producto dependiendo el numero del producto
    private function guardar_producto($pt) {
        switch ($pt['num_servicio']) {
        /*formulario Internet*/
        case '1': // internet dedicado empresarial
        case '2': // internet dedicado
            $data_pr = array(
                'id_ot_padre'              => $pt['pr_OTP'],
                'ciudad'                   => $pt['pr_ciudad'],
                'direccion'                => $pt['pr_direccion'],
                'tipo_predio'              => $pt['pr_tipo_predio'],
                'nit_cliente'              => $pt['pr_nit_cliente'],
                'alias_lugar'              => $pt['pr_alias_lugar'],
                'otp_asociada'             => $pt['pr_otp_asociadas'],
                'tipo_internet'            => $pt['pr_tipo_internet'],
                'ancho_banda'              => $pt['pr_ancho_banda'],
                'tipo_instalacion'         => $pt['pr_tipo_instalacion'],
                'servicio_actual'          => $pt['pr_id_servicio_actual'],
                'requiere_um'              => $pt['pr_requiere_instalacion_um'],
                'proveedor'                => $pt['pr_proveedor_milla'],
                'medio'                    => $pt['pr_medio_um'],
                'factibilidad_bw'          => $pt['pr_respuesta_factibilidad'],
                'tipo_conector'            => $pt['pr_tipo_conector'],
                'sds_destino'              => $pt['pr_sds_destino'],
                'olt'                      => $pt['pr_olt_gpon'],
                'interfaz_entrega_cliente' => $pt['pr_interface_entrega_cliente'],
                'requiere_voc'             => $pt['pr_requiere_voc'],
                'programacion_voc'         => $pt['pr_programacion_voc'],
                'requiere_rfc'             => $pt['pr_requiere_rfc'],
                'conversor_medio'          => $pt['pr_conversor_medio'],
                'referencia_router'        => $pt['pr_referencia_router'],
                'modulos_tarjetas'         => $pt['pr_modulo_o_tarjeta'],
                'licencias'                => $pt['pr_licencias'],
                'equipos_adicionales'      => $pt['pr_equipos_adicionales'],
                'consumibles'              => $pt['pr_consumibles'],
                'carta_valorizada'         => $pt['pr_registro_importacion_carta'],
                'nombre_1'                 => $pt['pr_nombre_dcc'],
                'telefono_1'               => $pt['pr_telefono_dcc'],
                'celular_1'                => $pt['pr_celular_dcc'],
                'correo_1'                 => $pt['pr_email_dcc'],
                'nombre_2'                 => $pt['pr_nombre_dct'],
                'telefono_2'               => $pt['pr_telefono_dct'],
                'celular_2'                => $pt['pr_celular_dct'],
                'correo_2'                 => $pt['pr_email_dct'],
                'observaciones'            => $pt['pr_observaciones_dct'],
                'ancho_banda_nap'          => $pt['pr_ancho_banda_nap'],
                'ancho_banda_internet'     => $pt['pr_ancho_banda_internet'],
                'direcciones_ip'           => $pt['pr_direccion_ip'],
                'activacion_correo'        => $pt['pr_activacion_correo'],
                'activacion_web_hosting'   => $pt['pr_activacion_hosting'],
                'dominio_existente'        => $pt['pr_Dominio_existente'],
                'dominio_comprar'          => $pt['pr_dominio_a_comprar'],
                'cant_correos'             => $pt['pr_cantidad_cuentas_correo'],
                'espacio_correo'           => $pt['pr_espacio_correo_gb'],
                'plataforma_web'           => $pt['pr_pataforma_web_hosting'],
                'web_hosting'              => $pt['pr_web_hosting_mb'],
                'promocion'                => $pt['pr_promocion_vigente_nom'],
            );
            $this->Dao_producto_model->insert_pr_internet($data_pr);
            break;
        /*formulario MPLS*/
        case '3': // mpls_avanzado_intranet
        case '4': // mpls_avanzado_intranet_varios_puntos
        case '5': // MPLS Avanzado Intranet con Backup de Ultima Milla - NDS 2
        case '6': // MPLS Avanzado Intranet con Backup de Ultima Milla y Router - NDS1
        case '7': // MPLS Avanzado Extranet
        case '8': // Backend MPLS
        case '9': // MPLS Avanzado con Componente Datacenter Claro
        case '10': // MPLS Transaccional 3G
            $data_pr = array(
                'id_ot_padre_ori'              => $pt['otp_mpls'],
                'ciudad_ori'                   => $pt['pr_ciudad'],
                'direccion_ori'                => $pt['pr_direccion'],
                'tipo_predio_ori'              => $pt['pr_tipo_predio'],
                'nit_cliente_ori'              => $pt['pr_nit_cliente'],
                'alias_lugar_ori'              => $pt['pr_alias_lugar'],
                'otp_asociada_ori'             => $pt['pr_otp_asociadas'],
                'tipo_mpls_ori'                => $pt['pr_tipo_mpls'],
                'ancho_banda_ori'              => $pt['pr_ancho_banda'],
                'tipo_instalacion_ori'         => $pt['pr_tipo_instalacion'],
                'servicio_actual_ori'          => $pt['pr_id_servicio'],
                'servicio_principal_ori'       => $pt['pr_idservicio_prin'],
                'requiere_um_ori'              => $pt['pr_instalacion_um'],
                'um_backup_ori'                => $pt['pr_ultimam_backup'],
                'proveedor_ori'                => $pt['pr_proveedor'],
                'medio_ori'                    => $pt['pr_medio'],
                'factibilidad_bw_ori'          => $pt['pr_resp_factibilidad'],
                'tipo_conector_ori'            => $pt['pr_tipo_conector'],
                'sds_destino_ori'              => $pt['pr_sds_destino'],
                'interfaz_entrega_cliente_ori' => $pt['pr_tipo_conector'],
                'requiere_voc_ori'             => $pt['pr_requiere_voc'],
                'programacion_voc_ori'         => $pt['pr_programacion_voc'],
                'requiere_rfc_ori'             => $pt['pr_requiere_rfc'],
                'conversor_medio_ori'          => $pt['pr_conversor_medio'],
                'referencia_router_ori'        => $pt['pr_referencia_router'],
                'modulos_tarjetas_ori'         => $pt['pr_modulo_tarjeta'],
                'licencias_ori'                => $pt['pr_licencias'],
                'equipos_adicionales_ori'      => $pt['pr_equipos_adicionales'],
                'consumibles_ori'              => $pt['pr_consumibles'],
                'carta_valorizada_ori'         => $pt['pr_importacion_carta'],
                'nombre_1_ori'                 => $pt['pr_nombre_1'],
                'telefono_1_ori'               => $pt['pr_telefono_1'],
                'celular_1_ori'                => $pt['pr_celular_1'],
                'correo_1_ori'                 => $pt['pr_email_1'],
                'observaciones_1_ori'          => $pt['pr_observaciones'],
                'nombre_2_ori'                 => $pt['pr_nombre_2'],
                'telefono_2_ori'               => $pt['pr_telefono_2'],
                'celular_2_ori'                => $pt['celular_dct_mpls'],
                'correo_2_ori'                 => $pt['pr_email_2'],
                'id_ot_padre_des'              => $pt['otp_mpls_pd'],

                'ciudad_des'                   => $pt['pr_ciudad_2'],
                'id_ot_padre_des'              => $pt['otp_mpls_pd'],
                'direccion_des'                => $pt['pr_direccion_2'],
                'tipo_predio_des'              => $pt['pr_tipo_predio_2'],
                'nit_cliente_des'              => $pt['pr_nit_cliente_2'],
                'alias_lugar_des'              => $pt['pr_alias_lugar_2'],
                'otp_asociada_des'             => $pt['pr_otp_asociadas_2'],
                'tipo_mpls_des'                => $pt['pr_tipo_mpls_2'],
                'ancho_banda_des'              => $pt['pr_ancho_banda_2'],
                'tipo_instalacion_des'         => $pt['pr_tipo_instalacion_2'],
                'servicio_actual_des'          => $pt['pr_id_servicio_2'],
                'servicio_principal_des'       => $pt['pr_idservicio_prin_2'],
                'requiere_um_des'              => $pt['pr_instalacion_um_2'],
                'um_backup_des'                => $pt['pr_umilla_backup_2'],
                'proveedor_des'                => $pt['pr_proveedor_2'],
                'medio_des'                    => $pt['pr_medio_2'],
                'factibilidad_bw_des'          => $pt['pr_res_factibilidad_2'],
                'tipo_conector_des'            => $pt['pr_tipo_conector_2'],
                'sds_destino_des'              => $pt['pr_sds_destino_2'],
                'requiere_voc_des'             => $pt['pr_requiere_voc_2'],
                'programacion_voc_des'         => $pt['pr_programacion_voc_2'],
                'requiere_rfc_des'             => $pt['pr_requiere_rfc_2'],
                'conversor_medio_des'          => $pt['pr_conversor_medio_2'],
                'referencia_router_des'        => $pt['pr_referencia_router_2'],
                'modulos_tarjetas_des'         => $pt['pr_modulo_tarjeta_2'],
                'licencias_des'                => $pt['pr_licencias_2'],
                'equipos_adicionales_des'      => $pt['pr_equipos_adicionales_2'],
                'consumibles_des'              => $pt['pr_consumibles_2'],
                'carta_valorizada_des'         => $pt['pr_importacion_carta_2'],
                'nombre_1_des'                 => $pt['pr_nombre_3'],
                'telefono_1_des'               => $pt['pr_telefono_3'],
                'celular_1_des'                => $pt['pr_celular_3'],
                'correo_1_des'                 => $pt['pr_email_3'],
                'nombre_2_des'                 => $pt['pr_nombre_4'],
                'telefono_2_des'               => $pt['pr_telefono_4'],
                'celular_2_des'                => $pt['pr_celular_4'],
                'correo_2_des'                 => $pt['pr_email_4'],
                'observaciones_1_des'          => $pt['pr_observaciones_2'],
                'interfaz_entrega_cliente_des' => $pt['pr_interfaz_entrega_cliente_des'],
            );
            $this->Dao_producto_model->insert_pr_mpls($data_pr);
            break;
        /*FORMULARIO NOVEDADES*/
        case '12': // Cambio de Equipos Servicio
        case '13': // Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
        case '14': // Cambio de Servicio Telefonia Fija Pública Linea SIP a PBX Distribuida Linea SIP
        case '22': // Cambio de Última Milla
        case '23': // Cambio de Equipo
            $data_pr = array(
                'id_ot_padre'                   => $pt['nro_ot_onyx'],
                'ciudad'                        => $pt['pr_ciudad'],
                'ubicacion_actual'              => $pt['pr_direccion_actual'],
                'alias_lugar'                   => $pt['pr_alias_lugar'],
                'otp_asociada'                  => $pt['pr_otp_asociadas'],
                'tipo_novedad'                  => $pt['pr_tipo_novedad'],
                'servicio_modificar'            => $pt['pr_serv_modificar'],
                'ancho_banda'                   => $pt['pr_ancho_banda'],
                'tipo_actividad'                => $pt['pr_tipo_actividad'],
                'servicio_actual'               => $pt['pr_servicio_actual'],
                'liberacion_um'                 => $pt['pr_liberacion_umst_te'],
                'requiere_um'                   => $pt['pr_requiere_instalacion'],
                'proveedor'                     => $pt['pr_proveedor_milla'],
                'medio'                         => $pt['pr_medio_um'],
                'factibilidad_bw'               => $pt['pr_resp_factibilidad'],
                'sds_destino'                   => $pt['pr_sds_destino'],
                'olt'                           => $pt['pr_olt_gpon'],
                'interfaz_entrega_cliente'      => $pt['pr_interface_cliente'],
                'requiere_voc'                  => $pt['pr_requiere_voc'],
                'programacion_voc'              => $pt['pr_programacion_voc'],
                'liberacion_um_fo'              => $pt['pr_liberacion_rumfo'],
                'requiere_ventana_mtto'         => $pt['pr_ventana_mtto'],
                'requiere_rfc'                  => $pt['pr_requiere_rfc'],
                'conversor_medio'               => $pt['pr_conversor_medio'],
                'referencia_router'             => $pt['pr_referencia_router'],
                'modulos_tarjetas'              => $pt['pr_modulo_tarjeta'],
                'licencias'                     => $pt['pr_licencias'],
                'equipos_adicionales'           => $pt['pr_equipos_adicionales'],
                'consumibles'                   => $pt['pr_consumibles'],
                'carta_valorizada'              => $pt['pr_registro_importacion'],
                'nombre_1'                      => $pt['pr_nombre1'],
                'telefono_1'                    => $pt['pr_telefono1'],
                'celular_1'                     => $pt['pr_celular1'],
                'correo_1'                      => $pt['pr_email1'],
                'nombre_2'                      => $pt['pr_nombre2'],
                'telefono_2'                    => $pt['pr_telefono2'],
                'celular_2'                     => $pt['pr_celular2'],
                'correo_2'                      => $pt['pr_email2'],
                'observaciones'                 => $pt['pr_observaciones_pl_te'],
                'equipo_cliente'                => $pt['pr_equipo_cliente'],
                'interfaz_cliente'              => $pt['pr_interfaz_ec'],
                'cant_lineas_basicas'           => $pt['pr_cant_lba'],
                'conformacion_pbx'              => $pt['pr_conformacion_pbx'],
                'cant_did'                      => $pt['pr_cant_did'],
                'cant_canales'                  => $pt['pr_cant_canales'],
                'adicion_lineas_fax'            => $pt['pr_adicion_fax'],
                'adicion_lineas_virtual'        => $pt['pr_adicion_tele'],
                'larga_distancia_nacional'      => $pt['pr_rldnacional'],
                'larga_distancia_internacional' => $pt['pr_rldinternacional'],
                'permisos_moviles'              => $pt['//pr_permisos_moviles'],
                'permisos_local_extendida'      => $pt['pr_rplextendida'],
                'bog_requiere'                  => $pt['pr_requiere_1'],
                'bog_numeracion'                => $pt['pr_numeracion_1'],
                'bog_cantidad'                  => $pt['pr_cant_canales_1'],
                'tun_requiere'                  => $pt['pr_requiere_2'],
                'tun_numeracion'                => $pt['pr_numeracion_2'],
                'tun_cantidad'                  => $pt['pr_cant_canales_2'],
                'vill_requiere'                 => $pt['pr_requiere_3'],
                'vill_numeracion'               => $pt['pr_numeracion_3'],
                'vill_cantidad'                 => $pt['pr_cant_canales_3'],
                'fac_requiere'                  => $pt['pr_requiere_4'],
                'fac_numeracion'                => $pt['pr_numeracion_4'],
                'fac_cantidad'                  => $pt['pr_cant_canales_4'],
                'gir_requiere'                  => $pt['pr_requiere_5'],
                'gir_numeracion'                => $pt['pr_numeracion_5'],
                'gir_cantidad'                  => $pt['pr_cant_canales_5'],
                'yop_requiere'                  => $pt['pr_requiere_6'],
                'yop_numeracion'                => $pt['pr_numeracion_6'],
                'yop_cantidad'                  => $pt['pr_cant_canales_6'],
                'cali_requiere'                 => $pt['pr_requiere_7'],
                'cali_numeracion'               => $pt['pr_numeracion_7'],
                'cali_cantidad'                 => $pt['pr_cant_canales_7'],
                'bave_requiere'                 => $pt['pr_requiere_8'],
                'bave_numeracion'               => $pt['pr_numeracion_8'],
                'bave_cantidad'                 => $pt['pr_cant_canales_8'],
                'pas_requiere'                  => $pt['pr_requiere_9'],
                'pas_numeracion'                => $pt['pr_numeracion_9'],
                'pas_cantidad'                  => $pt['pr_cant_canales_9'],
                'pop_requiere'                  => $pt['pr_requiere_10'],
                'pop_numeracion'                => $pt['pr_numeracion_10'],
                'pop_cantidad'                  => $pt['pr_cant_canales_10'],
                'nei_requiere'                  => $pt['pr_requiere_11'],
                'nei_numeracion'                => $pt['pr_numeracion_11'],
                'nei_cantidad'                  => $pt['pr_cant_canales_11'],
                'med_requiere'                  => $pt['pr_requiere_12'],
                'med_numeracion'                => $pt['pr_numeracion_12'],
                'med_cantidad'                  => $pt['pr_cant_canales_12'],
                'bar_requiere'                  => $pt['pr_requiere_13'],
                'bar_numeracion'                => $pt['pr_numeracion_13'],
                'bar_cantidad'                  => $pt['pr_cant_canales_13'],
                'cart_requiere'                 => $pt['pr_requiere_14'],
                'cart_numeracion'               => $pt['pr_numeracion_14'],
                'cart_cantidad'                 => $pt['pr_cant_canales_14'],
                'stm_requiere'                  => $pt['pr_requiere_15'],
                'stm_numeracion'                => $pt['pr_numeracion_15'],
                'stm_cantidad'                  => $pt['pr_cant_canales_15'],
                'mon_requiere'                  => $pt['pr_requiere_16'],
                'mon_numeracion'                => $pt['pr_numeracion_16'],
                'mon_cantidad'                  => $pt['pr_cant_canales_16'],
                'vall_requiere'                 => $pt['pr_requiere_17'],
                'vall_numeracion'               => $pt['pr_numeracion_17'],
                'vall_cantidad'                 => $pt['pr_cant_canales_17'],
                'sinc_requiere'                 => $pt['pr_requiere_18'],
                'sinc_numeracion'               => $pt['pr_numeracion_18'],
                'sinc_cantidad'                 => $pt['pr_cant_canales_18'],
                'per_requiere'                  => $pt['pr_requiere_19'],
                'per_numeracion'                => $pt['pr_numeracion_19'],
                'per_cantidad'                  => $pt['pr_cant_canales_19'],
                'arme_requiere'                 => $pt['pr_requiere_20'],
                'arme_numeracion'               => $pt['pr_numeracion_20'],
                'arme_cantidad'                 => $pt['pr_cant_canales_20'],
                'man_requiere'                  => $pt['pr_requiere_21'],
                'man_numeracion'                => $pt['pr_numeracion_21'],
                'man_cantidad'                  => $pt['pr_cant_canales_21'],
                'iba_requiere'                  => $pt['pr_requiere_22'],
                'iba_numeracion'                => $pt['pr_numeracion_22'],
                'iba_cantidad'                  => $pt['pr_cant_canales_22'],
                'cuc_requiere'                  => $pt['pr_requiere_23'],
                'cuc_numeracion'                => $pt['pr_numeracion_23'],
                'cuc_cantidad'                  => $pt['pr_cant_canales_23'],
                'buc_requiere'                  => $pt['pr_requiere_24'],
                'buc_numeracion'                => $pt['pr_numeracion_24'],
                'buc_cantidad'                  => $pt['pr_cant_canales_24'],
                'dui_requiere'                  => $pt['pr_requiere_25'],
                'dui_numeracion'                => $pt['pr_numeracion_25'],
                'dui_cantidad'                  => $pt['pr_cant_canales_25'],
                'sog_requiere'                  => $pt['pr_requiere_26'],
                'sog_numeracion'                => $pt['pr_numeracion_26'],
                'sog_cantidad'                  => $pt['pr_cant_canales_26'],
                'flan_requiere'                 => $pt['pr_requiere_27'],
                'flan_numeracion'               => $pt['pr_numeracion_27'],
                'flan_cantidad'                 => $pt['pr_cant_canales_27'],
                'riv_requiere'                  => $pt['pr_requiere_28'],
                'riv_numeracion'                => $pt['pr_numeracion_28'],
                'riv_cantidad'                  => $pt['pr_cant_canales_28'],
                'aipe_requiere'                 => $pt['pr_requiere_29'],
                'aipe_numeracion'               => $pt['pr_numeracion_29'],
                'aipe_cantidad'                 => $pt['pr_cant_canales_29'],
                'leb_requiere'                  => $pt['pr_requiere_30'],
                'leb_numeracion'                => $pt['pr_numeracion_30'],
                'leb_cantidad'                  => $pt['pr_cant_canales_30'],
            );
            $this->Dao_producto_model->insert_pr_novedades($data_pr);
            break;
        /*TRASLADO_EXTERNO*/
        case '15': // Traslado Externo Servicio
            $data_pr = array(
                'id_ot_padre'               => $pt['nro_ot_onyx'],
                'ciudad'                    => $pt['pr_ciudad'],
                'ubicacion_actual'          => $pt['pr_direccion_actual'],
                'ubicacion_traslado'        => $pt['pr_direccion_traslado'],
                'tipo_predio'               => $pt['pr_tipo_predio'],
                'nit_cliente'               => $pt['pr_nit_cliente'],
                'alias_lugar'               => $pt['pr_alias_lugar'],
                'otp_asociada'              => $pt['pr_otp_asociadas'],
                'cant_servicios_trasladar'  => $pt['pr_cntd_servicios'],
                'cod_servicio_trasladar'    => $pt['pr_idservicio_trasladar'],
                'tipo_traslado'             => $pt['pr_tipo_traslado'],
                'tipo_servicio'             => $pt['pr_tipo_servicio'],
                'ancho_banda'               => $pt['pr_ancho_banda'],
                'tipo_actividad'            => $pt['pr_tipo_actividad'],
                'servicio_actual'           => $pt['pr_id_servicio_actual'],
                'requiere_liberacion_um'    => $pt['pr_liberacion_uml'],
                'requiere_um'               => $pt['pr_requiere_instalacion'],
                'proveedor'                 => $pt['pr_proveedor_milla'],
                'medio'                     => $pt['pr_medio'],
                'factibilidad_bw'           => $pt['pr_resp_factibilidad'],
                'sds_destino'               => $pt['pr_sds_destino'],
                'olt'                       => $pt['pr_olt_gpon'],
                'interfaz_entrega_cliente'  => $pt['pr_interface_ecliente'],
                'requiere_voc'              => $pt['pr_requiere_voc'],
                'programacion_voc'          => $pt['pr_programacion_voc'],
                'requiere_liberacion_um_fo' => $pt['pr_liberacion_recursos'],
                'requiere_ventana_mtto'     => $pt['pr_ventana_mtto'],
                'requiere_rfc'              => $pt['pr_requiere_rfc'],
                'conversor_medio'           => $pt['pr_conversor_medio'],
                'referencia_router'         => $pt['pr_referencia_router'],
                'modulos_tarjetas'          => $pt['pr_modulo_o_tarjeta'],
                'licencias'                 => $pt['pr_licencias'],
                'equipos_adicionales'       => $pt['pr_equipos_adicionales'],
                'consumibles'               => $pt['pr_consumibles'],
                'carta_valorizada'          => $pt['pr_registro_importacion'],
                'nombre_1'                  => $pt['pr_nombre_1'],
                'telefono_1'                => $pt['pr_telefono_1'],
                'celular_1'                 => $pt['pr_celular_1'],
                'correo_1'                  => $pt['pr_email_1'],
                'nombre_2'                  => $pt['pr_nombre_2'],
                'telefono_2'                => $pt['pr_telefono_2'],
                'celular_2'                 => $pt['pr_celular_2'],
                'correo_2'                  => $pt['pr_email_2'],
                'observaciones'             => $pt['pr_observaciones_pl_te'],
            );
            $this->Dao_producto_model->insert_pr_traslado_externo($data_pr);
            break;
        /*TRASLADO_INTERNO*/
        case '16': // Traslado Interno Servicio
            $data_pr = array(
                'id_ot_padre'              => $pt['nro_ot_onyx'],
                'ciudad'                   => $pt['pr_ciudad'],
                'ubicacion_actual'         => $pt['pr_direccion'],
                'alias_lugar'              => $pt['pr_alias'],
                'movimiento_interno'       => $pt['pr_movimiento_it'],
                'otp_asociada'             => $pt['pr_otp_as'],
                'cant_servicios_trasladar' => $pt['pr_cantidad_st'],
                'cod_servicios_trasladar'  => $pt['pr_codigo_st'],
                'tipo_traslado'            => $pt['pr_tipo_ti'],
                'tipo_servicio'            => $pt['pr_tipo_s'],
                'ancho_banda'              => $pt['pr_ancho_banda'],
                'tipo_actividad'           => $pt['pr_tipo_acti_ti'],
                'servicio_actual'          => $pt['pr_id_servicio'],
                'requiere_um'              => $pt['pr_requiere_um'],
                'proveedor'                => $pt['pr_proveedor'],
                'medio'                    => $pt['pr_medio'],
                'factibilidad_bw'          => $pt['pr_respuesta'],
                'sds_destino'              => $pt['pr_sds_destino'],
                'olt'                      => $pt['pr_olt'],
                'interfaz_entrega_cliente' => $pt['pr_interface'],
                'requiere_voc'             => $pt['pr_requiere'],
                'programacion_voc'         => $pt['pr_programacion_voc'],
                'requiere_ventana_mtto'    => $pt['pr_requiere_ventana_mtto'],
                'requiere_rfc'             => $pt['pr_requiere_rfc'],
                'conversor_medio'          => $pt['pr_convesor_m'],
                'referencia_router'        => $pt['pr_referencia_r'],
                'modulos_tarjetas'         => $pt['pr_modulos_t'],
                'licencias'                => $pt['pr_licencias'],
                'equipos_adicionales'      => $pt['pr_equipos_a'],
                'consumibles'              => $pt['pr_consumibles'],
                'carta_valorizada'         => $pt['pr_registro_ic'],
                'nombre_1'                 => $pt['pr_nombre1'],
                'telefono_1'               => $pt['pr_telefono1'],
                'celular_1'                => $pt['pr_celular1'],
                'correo_1'                 => $pt['pr_correo1'],
                'nombre_2'                 => $pt['pr_nombre2'],
                'telefono_2'               => $pt['pr_telefono2'],
                'celular_2'                => $pt['pr_celular2'],
                'correo_2'                 => $pt['pr_correo2'],
                'observaciones'            => $pt['pr_observaciones'],
            );
            $this->Dao_producto_model->insert_pr_traslado_interno($data_pr);
            break;
        /*PVX_ADMINISTRADA*/
        case '17': // SOLUCIONES ADMINISTRATIVAS - COMUNICACIONES UNIFICADAS PBX ADMINISTRADA
            $data_pr = array(
                'id_ot_padre' => $pt['pr_otp'],

            );

            /*ciudad               => pr_ciudad
            direccion            => pr_direccion
            tipo_predio          => pr_tipo_predio
            nit_cliente          => pr_nit_cliente
            alias_lugar          => pr_alias_lugar
            otp_asociada         => pr_otp_asociadas
            tipo_pbx             => pr_tipo_pbx
            tipo_instalacion     => pr_tipo_instalacion
            servicio_actual      => pr_id_servicio
            requiere_um          => pr_requiere_instalacion
            proveedor            => pr_proveedor
            medio                => pr_medio_spa
            requiere_voc         => pr_requiere_voc
            programacion_voc     => pr_programacion_voc
            requiere_rfc         => pr_requiere_rfc
            conversor_medio      => pr_conversor_medio
            referencia_router    => pr_referencia_router
            modulos_tarjetas     => pr_modulo_tarjeta
            licencias            => pr_licencias
            equipos_adicionales  => pr_equipos_adicionales

            fuentes_telefonos    => pr_cantidad
            diademas             => pr_fuente_telefono
            araña_conferencia    => pr_diademas
            botoneras            => pr_aranas_conferencias
            modulo_botonera      => pr_botoneras
            fuente_botonera      => pr_expansion_botonera
            consumibles          => pr_fuente_botonera
            carta_valorizada     => pr_consumibles
            nombre_1             => pr_registro_importacion
            telefono_1           => pr_nombre_1
            celular_1            => pr_telefono_1
            correo_1             => pr_celular_1
            nombre_2             => pr_email_1
            telefono_2           => pr_nombre_2
            celular_2            => pr_telefono_2
            correo_2             => pr_celular_2
            observaciones        => pr_email_2
            tel_fija_claro       => pr_observaciones_1
            cantidad_extenciones => pr_telefonia_fija
            cantidad_buzones_voz => pr_cant_extension
            grabacion_voz        => pr_cant_buzonv
            lan_administrada     => pr_incluye_gravacion
            pr_lan_admon
             */

            break;
        /*TELEFONIA FIJA*/
        case '18': // Instalación Servicio Telefonia Fija PBX Distribuida Linea E1
        case '19': // Instalación Servicio Telefonia Fija PBX Distribuida Linea SIP
        case '20': // Instalación Servicio Telefonia Fija PBX Distribuida Linea SIP con Gateway de Voz
        case '21': // Instalación Telefonía Publica Básica - Internet Dedicado
            $data_pr = array(
                'id_ot_padre'                   => $pt['pr_otp'],
                'ciudad'                        => $pt['pr_ciudad'],
                'direccion'                     => $pt['pr_direccion'],
                'tipo_predio'                   => $pt['pr_tipo_predio'],
                'nit_cliente'                   => $pt['pr_nit_cliente'],
                'alias_lugar'                   => $pt['pr_alias_lugar'],
                'otp_asociada'                  => $pt['pr_otp_asociadas'],
                'tipo_telefonia'                => $pt['pr_tipo_telefoniaf'],
                'ancho_banda'                   => $pt['pr_ancho_banda'],
                'tipo_instalacion'              => $pt['pr_tipo_instalacion'],
                'servicio_actual'               => $pt['pr_idservicio_actual'],
                'requiere_um'                   => $pt['pr_requiere_instalacion'],
                'proveedor'                     => $pt['pr_proveedor_milla'],
                'medio'                         => $pt['pr_medio_um'],
                'tipo_conector'                 => $pt['pr_tipo_conector'],
                'interfaz_entrega_cliente'      => $pt['pr_interface_entregac'],
                'requiere_voc'                  => $pt['pr_requiere_voc'],
                'programacion_voc'              => $pt['pr_programacion_voc'],
                'requiere_rfc'                  => $pt['pr_requiere_rfc'],
                'conversor_medio'               => $pt['pr_conversor_medio'],
                'referencia_router'             => $pt['pr_referencia_router'],
                'modulos_tarjetas'              => $pt['pr_modulo_tarjeta'],
                'licencias'                     => $pt['pr_licencias'],
                'equipos_adicionales'           => $pt['pr_equipos_adicionales'],
                'consumibles'                   => $pt['pr_Consumibles'],
                'carta_valorizada'              => $pt['pr_registro_importacion'],
                'nombre_1'                      => $pt['pr_nombre_1'],
                'telefono_1'                    => $pt['pr_telefono_1'],
                'celular_1'                     => $pt['pr_celular_1'],
                'correo_1'                      => $pt['pr_email_1'],
                'nombre_2'                      => $pt['pr_nombre_2'],
                'telefono_2'                    => $pt['pr_telefono_2'],
                'celular_2'                     => $pt['pr_celular_2'],
                'correo_2'                      => $pt['pr_email_2'],
                'observaciones'                 => $pt['pr_observaciones'],
                'activacion_plan'               => $pt['pr_activacion_plan'],
                'equipo_cliente'                => $pt['pr_equipo_cliente'],
                'interfaz_equipo_cliente'       => $pt['pr_interfaz_equipoc'],
                'cantidad_lineas_basicas'       => $pt['pr_cantidad_canales'],
                'conformacion_pbx'              => $pt['pr_conformacion_pbx'],
                'cant_did_solicitados'          => $pt['pr_cantidad_did'],
                'cant_canales'                  => $pt['pr_cantidad_lineas'],
                'num_cabezera_pbx'              => $pt['pr_numero_cabecera'],
                'fax_email'                     => $pt['pr_fax_mail'],
                'telefono_virtual'              => $pt['pr_telefono_virtual'],
                'permisos_larga_distancia'      => $pt['pr_permisos_largad'],
                'larga_distancia_internacional' => $pt['pr_larga_distanciai'],
                'permisos_moviles'              => $pt['pr_permisos_moviles'],
                'permiso_local_extendida'       => $pt['pr_requiere_permisoe'],
                'bog_requiere'                  => $pt['pr_requiere_1'],
                'bog_numeracion'                => $pt['pr_numeracion_1'],
                'bog_cantidad'                  => $pt['pr_cant_canales_1'],
                'tun_requiere'                  => $pt['pr_requiere_2'],
                'tun_numeracion'                => $pt['pr_numeracion_2'],
                'tun_cantidad'                  => $pt['pr_cant_canales_2'],
                'vill_requiere'                 => $pt['pr_requiere_3'],
                'vill_numeracion'               => $pt['pr_numeracion_3'],
                'vill_cantidad'                 => $pt['pr_cant_canales_3'],
                'fac_requiere'                  => $pt['pr_requiere_4'],
                'fac_numeracion'                => $pt['pr_numeracion_4'],
                'fac_cantidad'                  => $pt['pr_cant_canales_4'],
                'gir_requiere'                  => $pt['pr_requiere_5'],
                'gir_numeracion'                => $pt['pr_numeracion_5'],
                'gir_cantidad'                  => $pt['pr_cant_canales_5'],
                'yop_requiere'                  => $pt['pr_requiere_6'],
                'yop_numeracion'                => $pt['pr_numeracion_6'],
                'yop_cantidad'                  => $pt['pr_cant_canales_6'],
                'cali_requiere'                 => $pt['pr_requiere_7'],
                'cali_numeracion'               => $pt['pr_numeracion_7'],
                'cali_cantidad'                 => $pt['pr_cant_canales_7'],
                'bave_requiere'                 => $pt['pr_requiere_8'],
                'bave_numeracion'               => $pt['pr_numeracion_8'],
                'bave_cantidad'                 => $pt['pr_cant_canales_8'],
                'pas_requiere'                  => $pt['pr_requiere_9'],
                'pas_numeracion'                => $pt['pr_numeracion_9'],
                'pas_cantidad'                  => $pt['pr_cant_canales_9'],
                'pop_requiere'                  => $pt['pr_requiere_10'],
                'pop_numeracion'                => $pt['pr_numeracion_10'],
                'pop_cantidad'                  => $pt['pr_cant_canales_10'],
                'nei_requiere'                  => $pt['pr_requiere_11'],
                'nei_numeracion'                => $pt['pr_numeracion_11'],
                'nei_cantidad'                  => $pt['pr_cant_canales_11'],
                'med_requiere'                  => $pt['pr_requiere_12'],
                'med_numeracion'                => $pt['pr_numeracion_12'],
                'med_cantidad'                  => $pt['pr_cant_canales_12'],
                'bar_requiere'                  => $pt['pr_requiere_13'],
                'bar_numeracion'                => $pt['pr_numeracion_13'],
                'bar_cantidad'                  => $pt['pr_cant_canales_13'],
                'cart_requiere'                 => $pt['pr_requiere_14'],
                'cart_numeracion'               => $pt['pr_numeracion_14'],
                'cart_cantidad'                 => $pt['pr_cant_canales_14'],
                'stm_requiere'                  => $pt['pr_requiere_15'],
                'stm_numeracion'                => $pt['pr_numeracion_15'],
                'stm_cantidad'                  => $pt['pr_cant_canales_15'],
                'mon_requiere'                  => $pt['pr_requiere_16'],
                'mon_numeracion'                => $pt['pr_numeracion_16'],
                'mon_cantidad'                  => $pt['pr_cant_canales_16'],
                'vall_requiere'                 => $pt['pr_requiere_17'],
                'vall_numeracion'               => $pt['pr_numeracion_17'],
                'vall_cantidad'                 => $pt['pr_cant_canales_17'],
                'sinc_requiere'                 => $pt['pr_requiere_18'],
                'sinc_numeracion'               => $pt['pr_numeracion_18'],
                'sinc_cantidad'                 => $pt['pr_cant_canales_18'],
                'per_requiere'                  => $pt['pr_requiere_19'],
                'per_numeracion'                => $pt['pr_numeracion_19'],
                'per_cantidad'                  => $pt['pr_cant_canales_19'],
                'arme_requiere'                 => $pt['pr_requiere_20'],
                'arme_numeracion'               => $pt['pr_numeracion_20'],
                'arme_cantidad'                 => $pt['pr_cant_canales_20'],
                'man_requiere'                  => $pt['pr_requiere_21'],
                'man_numeracion'                => $pt['pr_numeracion_21'],
                'man_cantidad'                  => $pt['pr_cant_canales_21'],
                'iba_requiere'                  => $pt['pr_requiere_22'],
                'iba_numeracion'                => $pt['pr_numeracion_22'],
                'iba_cantidad'                  => $pt['pr_cant_canales_22'],
                'cuc_requiere'                  => $pt['pr_requiere_23'],
                'cuc_numeracion'                => $pt['pr_numeracion_23'],
                'cuc_cantidad'                  => $pt['pr_cant_canales_23'],
                'buc_requiere'                  => $pt['pr_requiere_24'],
                'buc_numeracion'                => $pt['pr_numeracion_24'],
                'buc_cantidad'                  => $pt['pr_cant_canales_24'],
                'dui_requiere'                  => $pt['pr_requiere_25'],
                'dui_numeracion'                => $pt['pr_numeracion_25'],
                'dui_cantidad'                  => $pt['pr_cant_canales_25'],
                'sog_requiere'                  => $pt['pr_requiere_26'],
                'sog_numeracion'                => $pt['pr_numeracion_26'],
                'sog_cantidad'                  => $pt['pr_cant_canales_26'],
                'flan_requiere'                 => $pt['pr_requiere_27'],
                'flan_numeracion'               => $pt['pr_numeracion_27'],
                'flan_cantidad'                 => $pt['pr_cant_canales_27'],
                'riv_requiere'                  => $pt['pr_requiere_28'],
                'riv_numeracion'                => $pt['pr_numeracion_28'],
                'riv_cantidad'                  => $pt['pr_cant_canales_28'],
                'aipe_requiere'                 => $pt['pr_requiere_29'],
                'aipe_numeracion'               => $pt['pr_numeracion_29'],
                'aipe_cantidad'                 => $pt['pr_cant_canales_29'],
                'leb_requiere'                  => $pt['pr_requiere_30'],
                'leb_numeracion'                => $pt['pr_numeracion_30'],
                'leb_cantidad'                  => $pt['pr_cant_canales_30'],
            );

            $this->Dao_producto_model->insert_pr_telefonia_fija($data_pr);

            break;

        /*NN HERFANITO*/
        case '11': // Adición Marquillas Aeropuerto el Dorado Opain

            break;
        }
    }

    // guardar linea base en base de datos
    private function guardar_linea_base($pt) {
        $data = array(
            'id_ot_padre'                => $pt['nro_ot_onyx'],
            'fecha_compromiso'           => $pt['lb_fecha_compromiso'],
            'fecha_programacion'         => $pt['lb_fecha_programacion'],
            'fecha_visita_obra_civil'    => $pt['lb_fecha_voc'],
            'fecha_dcoc'                 => $pt['lb_fecha_dcoc'],
            'fecha_aprobacion_coc'       => $pt['lb_fecha_aprobacion_coc'],
            'fecha_ingenieria_detalle'   => $pt['lb_fecha_ingenieria_detalle'],
            'fecha_configuracion'        => $pt['lb_fecha_configuracion'],
            'fecha_ejecucion_obra_civil' => $pt['lb_fecha_ejecucion_obra_civil'],
            'fecha_equipos'              => $pt['lb_fecha_equipos'],
            'fecha_empalmes'             => $pt['lb_fecha_empalmes'],
            'fecha_entrega_servicio'     => $pt['lb_fecha_entrega_servicio'],
        );

        return $this->Dao_hito_model->insert_linea_base($data);

    }

    // enviar correo de servicio retorna respuesta
    private function enviar_correo_servicio($pt, $servicio) {
        // cargar arreglos de la plantilla
        $array_template = $this->fill_formulary($servicio, $pt);

        // crear el template
        /*$template con el switch*/

        // $se_envio = enviar correo

        // retornar

    }

    // guardar el servicio en tabla log_correo
    private function guardar_servicio($pt) {
        ate_default_timezone_set("America/Bogota");
        $fActual       = date('Y-m-d');
        $destinatarios = Auth::user()->n_mail_user;
        // seteo el arreglo de campos vacio
        $dataLogMail = $this->dataLogMail();
        // lleno mi arreglos como corresponda
        foreach ($dataLogMail as $key => $value) {
            if (isset($pt[$key])) {
                $dataLogMail[$key] = $pt[$key];
            }
        }

        // datos llenos manualmente
        $dataLogMail['k_id_ot_padre']  = $pt['nro_ot_onyx'];
        $dataLogMail['clase']          = 'cierre_ko';
        $dataLogMail['destinatarios']  = $destinatarios;
        $dataLogMail['usuario_sesion'] = Auth::user()->k_id_user;
        $dataLogMail['fecha']          = $fActual;

        $this->Dao_log_correo_model->insert_data($dataLogMail);
    }

    // Actualizar la oth del formulario servicio el segundo parametro es por si viene de enviar correo
    private function actualizar_oth($pt, $is_ko_3 = false) {
        date_default_timezone_set("America/Bogota");
        $fActual  = date('Y-m-d H:i:s');
        $fActual2 = date('Y-m-d');

        // si es ko y es parea cambiar a estado cerrada  le aumento 1 a la cantidad de correos enviados de esa ot hija
        $cant_mails  = ($is_ko_3) ? $pt['c_email'] + 1 : $pt['c_email'];
        $text_estado = $this->Dao_estado_ot_model->getNameStatusById($pt['k_id_estado_ot']);

        $data = array(
            'id_orden_trabajo_hija'     => $pt['id_orden_trabajo_hija'],
            'k_id_estado_ot'            => $pt['k_id_estado_ot'],
            'estado_orden_trabajo_hija' => $text_estado,
            'fecha_mod'                 => $fActual,
            'estado_mod'                => 1,
            'n_observacion_cierre'      => $pt['n_observacion_cierre'],
            'c_email'                   => $cant_mails,
            'last_send'                 => $fActual2,
        );

        $dataLog = array(
            'id_ot_hija' => $pt['id_orden_trabajo_hija'],
            'antes'      => $pt['estado_orden_trabajo_hija'],
            'ahora'      => $text_estado,
            'columna'    => 'estado_orden_trabajo_hija',
            'fecha_mod'  => $fActual,
        );

        $res = $this->Dao_ot_hija_model->m_updateStatusOt($data, $dataLog);

        $msj = 'ok';
        $this->session->set_flashdata('msj', $msj);
        header('Location: ' . URL::base() . '/managementOtp');
    }

    //Actualiza el estato (hay que enviarle el post)
    private function update_status($pt, $is_mail = false) {
        date_default_timezone_set("America/Bogota");
        $fActual  = date('Y-m-d H:i:s');
        $fActual2 = date('Y-m-d');

        $cant_mails = $pt['c_email'];
        if ($is_mail) {

            $cant_mails = $pt['c_email'] + 1;

            $destinatarios = $pt['mail_envio'];

            if (isset($pt['mail_cc'])) {
                for ($i = 0; $i < count($pt['mail_cc']); $i++) {
                    $destinatarios .= ", " . $pt['mail_cc'][$i];
                }
            }

            $dataLogMail = $this->dataLogMail();

            foreach ($dataLogMail as $key => $value) {
                if (isset($pt[$key])) {
                    $dataLogMail[$key] = $pt[$key];
                }
            }

            $dataLogMail['k_id_ot_padre']  = $pt['nro_ot_onyx'];
            $dataLogMail['clase']          = 'cierre_ko';
            $dataLogMail['destinatarios']  = $destinatarios;
            $dataLogMail['usuario_sesion'] = Auth::user()->k_id_user;
            $dataLogMail['fecha']          = $fActual2;

            $this->Dao_log_correo_model->insert_data($dataLogMail);
        }

        $text_estado = $this->Dao_estado_ot_model->getNameStatusById($pt['k_id_estado_ot']);

        $data = array(
            'id_orden_trabajo_hija'     => $pt['id_orden_trabajo_hija'],
            'k_id_estado_ot'            => $pt['k_id_estado_ot'],
            'estado_orden_trabajo_hija' => $text_estado,
            'fecha_mod'                 => $fActual,
            'estado_mod'                => 1,
            'n_observacion_cierre'      => $pt['n_observacion_cierre'],
            'c_email'                   => $cant_mails,
            'last_send'                 => $fActual2,
        );

        $dataLog = array(
            'id_ot_hija' => $pt['id_orden_trabajo_hija'],
            'antes'      => $pt['estado_orden_trabajo_hija'],
            'ahora'      => $text_estado,
            'columna'    => 'estado_orden_trabajo_hija',
            'fecha_mod'  => $fActual,
        );

        $res = $this->Dao_ot_hija_model->m_updateStatusOt($data, $dataLog);

        header('Location: ' . URL::base() . '/managementOtp?msj=ok');
    }

    // Arma el pdf para mostrar el correo enviado
    public function generatePDF() {
        $data = $this->input->post('data');

        // print_r("x".$data['servicio']."x");
        // header('Content-Type: text/plain');
        if ($data['clase'] == 'cierre_ko') {
            switch ($data['servicio']) {
            case 'Internet Dedicado Empresarial':
                $template = $this->internet_dedicado_empresarial($data);
                break;
            case 'Internet Dedicado ':
                $template = $this->internet_dedicado($data);
                break;
            case 'MPLS Avanzado Intranet':
                $template = $this->mpls_avanzado_intranet($data);
                break;
            case 'MPLS Avanzado Intranet - Varios Puntos':
                $template = $this->mpls_avanzado_intranet_varios_puntos($data);
                break;
            case 'MPLS Avanzado Intranet con Backup de Ultima Milla - NDS 2':
                $template = $this->mpls_avanzado_intranet_con_backup_de_ultima_milla_nds2($data);
                break;
            case 'MPLS Avanzado Intranet con Backup de Ultima Milla y Router - NDS1':
                $template = $this->mpls_avanzado_intranet_con_backup_de_ultima_milla_y_router_nds1($data);
                break;
            case 'MPLS Avanzado Extranet':
                $template = $this->avanzado_extranet($data);
                break;
            case 'Backend MPLS ':
                $template = $this->backend_mpls($data);
                break;
            case 'MPLS Avanzado con Componente Datacenter Claro':
                $template = $this->mpls_avanzado_componente_datacenter_claro($data);
                break;
            case 'MPLS Transaccional 3G':
                $template = $this->mpls_transaccional_3g($data);
                break;
            }
        } else if ($data['clase'] == 'ko_8d') {
            $template = $this->correo_ko_15_dias($data);

        }
        echo json_encode($template);
    }

    //llena el formulario de kick of 15 dias
    public function fill_formulary_ko_15($pt) {

        $argumentos = array(

            'nombre'                           => $pt['nombre'],
            'ots_nombre'                       => $pt['ots_nombre'],
            'ampliacion_enlaces'               => $pt['ampliacion_enlaces'],
            'direccion_servicio'               => $pt['direccion_servicio'],
            'servicio'                         => $pt['servicio'],
            'vista_obra_civil'                 => $pt['vista_obra_civil'],
            'envio_cotizacion_obra_civil'      => $pt['envio_cotizacion_obra_civil'],
            'aprobacion_cotizacion_obra_civil' => $pt['aprobacion_cotizacion_obra_civil'],
            'ejecucion_obra_civil'             => $pt['ejecucion_obra_civil'],
            'empalmes'                         => $pt['empalmes'],
            'configuracion'                    => $pt['configuracion'],
            'entrega_servicio'                 => $pt['entrega_servicio'],

            // VARIABLES Y CAMPOS REUTILIZADOS DE OTRA PLANTILLA PARA LA BD
            'equipos_intalar_camp1'            => $pt['equipos'],
            'ingeniero1'                       => $pt['ingeniero_implementacion_responsable_cuenta'],
            'ingeniero1_tel'                   => $pt['celular'],
            'ingeniero1_email'                 => $pt['mail_envio'],
        );

        return $argumentos;

    }

    // se llenan los argumentos dependiendo el servicio
    public function fill_formulary($s, $p) {

        switch (true) {
        case ($s == 1 || $s == 2):
            $argumentos = array(
                'nombre'                => $p['nombre'],
                'nombre_cliente'        => $p['nombre_cliente'],
                'servicio'              => $p['servicio'],
                'fecha'                 => $p['fecha'],
                'direccion_instalacion' => $p['direccion_instalacion'],
                'ancho_banda'           => $p['ancho_banda'] . " MHz",
                'interfaz_entrega'      => $p['interfaz_entrega'],
                'fecha_servicio'        => $p['fecha_servicio'],
                'ingeniero1'            => $p['ingeniero1'],
                'ingeniero1_tel'        => $p['ingeniero1_tel'],
                'ingeniero1_email'      => $p['ingeniero1_email'],
                'ingeniero2'            => $p['ingeniero2'],
                'ingeniero2_tel'        => $p['ingeniero2_tel'],
                'ingeniero2_email'      => $p['ingeniero2_email'],
                'ingeniero3'            => $p['ingeniero3'],
                'ingeniero3_tel'        => $p['ingeniero3_tel'],
                'ingeniero3_email'      => $p['ingeniero3_email'],
            );
            break;
        case ($s == 4):
            $argumentos = array(
                'nombre'                     => $p['nombre'],
                'nombre_cliente'             => $p['nombre_cliente'],
                'servicio'                   => $p['servicio'],
                'fecha'                      => $p['fecha'],
                'direccion_instalacion_des1' => $p['direccion_instalacion_des1'],
                'direccion_instalacion_des2' => $p['direccion_instalacion_des2'],
                'direccion_instalacion_des3' => $p['direccion_instalacion_des3'],
                'direccion_instalacion_des4' => $p['direccion_instalacion_des4'],
                'existente'                  => $p['existente'],
                'nuevo'                      => $p['nuevo'],
                'ancho_banda'                => $p['ancho_banda'] . " MHz",
                'interfaz_entrega'           => $p['interfaz_entrega'],
                'equipos_intalar_camp1'      => $p['equipos_intalar_camp1'],
                'equipos_intalar_camp2'      => $p['equipos_intalar_camp2'],
                'equipos_intalar_camp3'      => $p['equipos_intalar_camp3'],
                'fecha_servicio'             => $p['fecha_servicio'],
                'ingeniero1'                 => $p['ingeniero1'],
                'ingeniero1_tel'             => $p['ingeniero1_tel'],
                'ingeniero1_email'           => $p['ingeniero1_email'],
                'ingeniero2'                 => $p['ingeniero2'],
                'ingeniero2_tel'             => $p['ingeniero2_tel'],
                'ingeniero2_email'           => $p['ingeniero2_email'],
                'ingeniero3'                 => $p['ingeniero3'],
                'ingeniero3_tel'             => $p['ingeniero3_tel'],
                'ingeniero3_email'           => $p['ingeniero3_email'],
            );
            break;
        case ($s == 3 || $s == 5 || $s == 6 || $s == 7 || $s == 8 || $s == 9 || $s == 10):
            $argumentos = array(
                'nombre'                => $p['nombre'],
                'nombre_cliente'        => $p['nombre_cliente'],
                'servicio'              => $p['servicio'],
                'fecha'                 => $p['fecha'],
                'direccion_instalacion' => $p['direccion_instalacion'],
                'existente'             => $p['existente'],
                'nuevo'                 => $p['nuevo'],
                'ancho_banda'           => $p['ancho_banda'] . " MHz",
                'interfaz_entrega'      => $p['interfaz_entrega'],
                'fecha_servicio'        => $p['fecha_servicio'],
                'ingeniero1'            => $p['ingeniero1'],
                'ingeniero1_tel'        => $p['ingeniero1_tel'],
                'ingeniero1_email'      => $p['ingeniero1_email'],
                'ingeniero2'            => $p['ingeniero2'],
                'ingeniero2_tel'        => $p['ingeniero2_tel'],
                'ingeniero2_email'      => $p['ingeniero2_email'],
                'ingeniero3'            => $p['ingeniero3'],
                'ingeniero3_tel'        => $p['ingeniero3_tel'],
                'ingeniero3_email'      => $p['ingeniero3_email'],

            );
            break;
        case ($s == 11): //Adición Marquillas Aeropuerto el Dorado Opain
            $argumentos = array(
                'campo1'  => $p['campo1'], // nombre
                'campo2'  => $p['campo2'], // nombre cliente
                'campo3'  => $p['campo3'], // servicio
                'campo4'  => $p['campo4'], // marquillas
                'campo5'  => $p['campo5'], // local
                'campo6'  => $p['campo6'], // internet
                'campo9'  => $p['campo9'], // lineas
                'campo10' => $p['ampo10'], // telefonos
                'campo11' => $p['ampo11'], // mpls
                'campo12' => $p['ampo12'], // bw2
                'campo13' => $p['ampo13'], //  Adición de 6 marquillas:
                'campo14' => $p['ampo14'], //  inicio al Proceso de instalación
                'campo15' => $p['ampo15'], //   INGENIERO IMPLEMENTACIÓN
                'campo16' => $p['ampo16'], //  TELEFONOS DE CONTACTO
                'campo17' => $p['ampo17'], // EMAIL
                'campo18' => $p['ampo18'], //  OTP
            );
            break;
        case ($s == 12): // Cambio de Equipos Servicio
            $argumentos = array(
                'campo1'  => $p['campo1'], // nombre
                'campo2'  => $p['campo2'], // nombre cliente
                'campo3'  => $p['campo3'], // servicio
                'campo4'  => $p['campo4'], // Dirección Sede
                'campo5'  => $p['campo5'], // Existen otros Servicios sobre el CPE (si)
                'campo5'  => $p['campo5'], // Existen otros Servicios sobre el CPE (no)
                'campo6'  => $p['campo6'], // cantidad
                'campo7'  => $p['campo7'], // otp
                'campo8'  => $p['campo8'], // Códigos de Servicio en el CPE a Cambiar
                'campo9'  => $p['campo9'], // Requiere que el Cambio de Equipos para su Servicio se ejecute en horario No Hábil o Fin de Semana (no)
                'campo10' => $p['campo10'], // Fecha de Entrega del Cambio de Equipos  de su Servicio
                'campo11' => $p['campo11'], // INGENIERO IMPLEMENTACIÓN
                'campo12' => $p['campo12'], // TELEFONOS DE CONTACTO
                'campo13' => $p['campo13'], // MAIL
            );
            break;

        case ($s == 13): //Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
            $argumentos = array(
                'campo1'  => $p['campo1']// nombre
                'campo2'  => $p['campo2']// nombre cliente
                'campo3'  => $p['campo3']// servicio
                'campo4'  => $p['campo4']// Dirección Destino
                'campo5'  => $p['campo5']// Cantidad de Líneas Telefónicas Básicas
                'campo6'  => $p['campo6']// Ciudad //marcar (x)
                'campo7'  => $p['campo7']// Cantidad DID
                'campo8'  => $p['campo8']// inicio al Proceso de Cambio  de Servicio
                'campo9'  => $p['campo9']// Fecha de Entrega de su servicio
                'campo10' => $p['campo10']// INGENIERO IMPLEMENTACIÓN
                'campo11' => $p['campo11']// TELEFONOS DE CONTACTO
                'campo12' => $p['campo12'], // EMAIL
            );
            break;
        case ($s == 14): //Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
            $argumentos = array(

            );
            break;
        case ($s == 15): //Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
            $argumentos = array(

            );
            break;
        case ($s == 16): //Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
            $argumentos = array(

            );
            break;
        case ($s == 17): //Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
            $argumentos = array(

            );
            break;
        case ($s == 18): //Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
            $argumentos = array(

            );
            break;
        case ($s == 19): //Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
            $argumentos = array(

            );
            break;
        case ($s == 20): //Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
            $argumentos = array(

            );
            break;
        case ($s == 21): //Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
            $argumentos = array(

            );
            break;
        case ($s == 22): //Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
            $argumentos = array(

            );
            break;
        case ($s == 23): //Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
            $argumentos = array(

            );
            break;

        }

        return $argumentos;
    }

    // setea los campos de log mail como si fuera un objeto
    private function dataLogMail() {

        $data = array(
            'k_id_log_correo' => null, 'k_id_ot_padre' => null, 'id_orden_trabajo_hija' => null, 'clase' => null, 'destinatarios' => null, 'usuario_sesion' => null, 'nombre' => null, 'nombre_cliente' => null, 'servicio' => null, 'fecha' => null, 'direccion_instalacion' => null, 'direccion_instalacion_des1' => null, 'direccion_instalacion_des2' => null, 'direccion_instalacion_des3' => null, 'direccion_instalacion_des4' => null, 'existente' => null, 'nuevo' => null, 'ancho_banda' => null, 'interfaz_entrega' => null, 'equipos_intalar_camp1' => null, 'equipos_intalar_camp2' => null, 'equipos_intalar_camp3' => null, 'fecha_servicio' => null, 'ingeniero1' => null, 'ingeniero1_tel' => null, 'ingeniero1_email' => null, 'ingeniero2' => null, 'ingeniero2_tel' => null, 'ingeniero2_email' => null, 'ingeniero3' => null, 'ingeniero3_tel' => null, 'ingeniero3_email' => null, 'ots_nombre' => null, 'ampliacion_enlaces' => null, 'vista_obra_civil' => null, 'envio_cotizacion_obra_civil' => null, 'aprobacion_cotizacion_obra_civil' => null, 'ejecucion_obra_civil' => null, 'empalmes' => null, 'configuracion' => null, 'entrega_servicio' => null, 'direccion_servicio' => null, 'campo1' => null, 'campo2' => null, 'campo3' => null, 'campo4' => null, 'campo5' => null, 'campo6' => null, 'campo7' => null, 'campo8' => null, 'campo9' => null, 'campo10' => null, 'campo11' => null, 'campo12' => null, 'campo13' => null, 'campo14' => null, 'campo15' => null, 'campo16' => null, 'campo17' => null, 'campo18' => null, 'campo19' => null, 'campo20' => null, 'campo21' => null, 'campo22' => null, 'campo23' => null, 'campo24' => null, 'campo25' => null, 'campo26' => null, 'campo27' => null, 'campo28' => null, 'campo29' => null, 'campo30' => null, 'campo31' => null, 'campo32' => null, 'campo33' => null, 'campo34' => null, 'campo35' => null, 'campo36' => null, 'campo37' => null, 'campo38' => null, 'campo39' => null, 'campo40' => null, 'campo41' => null, 'campo42' => null, 'campo43' => null, 'campo44' => null, 'campo45' => null, 'campo46' => null, 'campo47' => null, 'campo48' => null, 'campo49' => null, 'campo50' => null, 'campo51' => null, 'campo52' => null, 'campo53' => null, 'campo54' => null, 'campo55' => null, 'campo56' => null, 'campo57' => null, 'campo58' => null,
        );

        return $data;

    }

    public function enviar_email($cuerpo, $pt, $flag = true) {
        $email_user = Auth::user()->n_mail_user;
        $correos    = [];
        if (Auth::user()->n_mail_user || Auth::user()->n_mail_user != "") {
            array_push($correos, $email_user);
        }

        if (isset($pt['mail_cc'])) {
            for ($i = 0; $i < count($pt['mail_cc']); $i++) {
                array_push($correos, $pt['mail_cc'][$i]);
            }
        }

        $this->load->library('parser');

        $config = Array(
            // 'smtp_crypto' => 'ssl', //protocolo de encriptado
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'zolid.telmex.vip@gmail.com',
            'smtp_pass' => 'z0l1dTelmex',
            // 'smtp_timeout' => 5, //tiempo de conexion maxima 5 segundos
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'priority'  => 1,
        );
        // $argumentos = $this->_post($this->input->post('servicio'));
        // $cuerpo = $this->internet_dedicado_empresarial($argumentos);

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('zolid.telmex.vip@gmail.com', 'TELMEX VIP'); // change it to yours
        $this->email->to($pt['mail_envio']); // change it to yours
        $this->email->cc($correos, $email_user);
        if ($flag) {
            $this->email->subject("Notificación de Servicio de la orden " . $pt['nro_ot_onyx'] . "-" . $pt['id_orden_trabajo_hija']);
        } else {
            $this->email->subject("Reporte de actualización de la orden " . $pt['nro_ot_onyx'] . "-" . $pt['id_orden_trabajo_hija']);
        }
        $this->email->message($cuerpo);
        if ($this->email->send()) {
            echo "se envio";
            if ($flag) {
                $this->update_status($pt, true);
            } else {
                $this->load->view('principal');
            }
        } else {

            echo ":( Hubo un error en el envio del correo";
        }
    }

    public function internet_dedicado_empresarial($argumentos) {
        return '
          <div dir="ltr"><div class="adM">
          </div>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
          Servicio &nbsp;<b><span style="color:rgb(31,73,125)">' . $argumentos['servicio'] . '</span></b><span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
          los datos de contacto del Ingeniero encargado de la implementación de su
          servicio. Es de suma importancia que sea revisado y nos retroalimente la
          información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
          dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
          contenida en este documento es importante que nos haga llegar sus inquietudes
          ya que el servicio contratado será entregado de acuerdo a la información que
          describimos a continuación. <span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="935" height="639" src="' . URL::base() . '/assets/img/mail_formats/internet_dedicado_empresarial.png"></span></b></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b>' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
          instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
          detalla la secuencia de actividades para llevar a cabo la instalación del
          servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453" src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

          <table class="m_5089500533639821532gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="935" style="width:701.3pt;border-collapse:collapse">
           <tbody><tr style="height:29.05pt">
            <td width="177" valign="top" style="width:132.6pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
            <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
            </span></b></div>
            </td>
            <td width="758" colspan="10" valign="top" style="width:568.7pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
            <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
            </span></b></div>
            </td>
           </tr>
           <tr style="height:8.05pt">
            <td width="178" colspan="2" style="width:133.3pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-family:&quot;Arial Black&quot;,sans-serif">INTERNET DEDICADO
            EMPRESARIAL<span style="color:rgb(31,73,125)"><span></span></span></span></b></p>
            </td>
            <td width="757" colspan="9" valign="top" style="width:568pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;line-height:120%;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:black">DESCRIPCIÓN DE
            LA SOLUCIÓN:</span></i></b><span style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif">Enlace en Fibra Óptica de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif">con direccionamiento público <b>/29</b> (5
            Direcciones IP)</span><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:black">, este direccionamiento
            Publico puede ser configurado directamente sobre los equipos que necesitan
            salida a </span><b><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:rgb(192,0,0)">INTERNET</span></b><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:black">. En caso de que requiera&nbsp; la traslación del
            direccionamiento Publica asignado por Claro a su red privada Interna, es
            necesario que nos informe su red Privada.&nbsp; En caso de que requiera
            asignación de IP de forma centralizada, &nbsp;por favor infórmenos
            respondiendo este correo, &nbsp;con el fin de &nbsp;realizar la configuración
            de DHCP sobre nuestros equipos.<span></span></span></p>
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black">Es
            responsabilidad del <b>CLIENTE</b> enviar esta Información&nbsp; para que </span><b><i><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:rgb(192,0,0)">CLARO</span></i></b><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black">&nbsp; pueda configurar la
            Conectividad de acuerdo a la necesidad.</span><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:8.05pt">
            <td width="178" colspan="2" rowspan="15" style="width:133.3pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
            <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:8pt">
            <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['ancho_banda'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:16.45pt">
            <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:16.4pt">
            <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:10pt;font-family:Arial,sans-serif">99.6 % &nbsp;<span style="color:black"><span></span></span></span></i></b></p>
            </td>
           </tr>
           <tr style="height:16.4pt">
            <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
            </td>
           </tr>
           <tr style="height:16.4pt">
            <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
            </td>
            <td width="347" colspan="6" valign="top" style="width:260.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['fecha_servicio'] . '</span></span></p>
            </td>
            <td width="189" colspan="2" valign="top" style="width:5cm;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
            necesarias para la instalación<span style="color:black"><span></span></span></span></p>
            </td>
           </tr>
           <tr style="height:16.4pt">
            <td width="757" colspan="9" valign="top" style="width:568pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
            LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:8.45pt">
            <td width="221" rowspan="3" valign="top" style="width:166pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
            del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
            </td>
            <td width="177" colspan="3" valign="top" style="width:132.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
            </td>
            <td width="85" valign="top" style="width:63.8pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>
          </span></span></b></p>
            </td>
            <td width="180" colspan="3" valign="top" style="width:134.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
            </td>
            <td width="95" valign="top" style="width:70.9pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
            </td>
           </tr>
           <tr style="height:8.35pt">
            <td width="177" colspan="3" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
            </td>
            <td width="85" valign="top" style="width:63.8pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>
          </span></span></b></p>
            </td>
            <td width="180" colspan="3" rowspan="2" valign="top" style="width:134.65pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
            confirme Horarios)<span></span></span></b></p>
            </td>
            <td width="95" rowspan="2" valign="top" style="width:70.9pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
            </td>
           </tr>
           <tr style="height:5.8pt">
            <td width="177" colspan="3" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
            </td>
            <td width="85" valign="top" style="width:63.8pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
            </td>
           </tr>
           <tr style="height:12.25pt">
            <td width="221" valign="top" style="width:166pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
            Existencia de las siguientes condiciones:<span></span></span></i></b></p>
            </td>
            <td width="85" colspan="2" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm 5.4pt;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
            </td>
            <td width="92" valign="top" style="width:69.2pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
            </td>
            <td width="85" valign="top" style="width:63.8pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
            </td>
            <td width="76" valign="top" style="width:57.35pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
            <td width="103" colspan="2" valign="top" style="width:77.3pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
            equipos:<span></span></span></b></p>
            </td>
            <td width="95" valign="top" style="width:70.9pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
           </tr>
           <tr style="height:12.25pt">
            <td width="221" rowspan="2" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">OPCIÓN DE
            ENTREGA 1:</span></i></b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></p>
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Por favor confirme si va a conectar
            su red LAN con un direccionamiento diferente al público asignado por Claro. <span></span></span></p>
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">En caso de que la respuesta sea <b><u>SI</u></b>
            por favor indíquenos &nbsp;el segmento al cual le debemos configurar NAT.</span><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.2pt">
            <td width="61" valign="top" style="width:45.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:12.2pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">SI:<span></span></span></b></p>
            </td>
            <td width="475" colspan="7" valign="top" style="width:356.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.2pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:6.15pt">
            <td width="221" rowspan="2" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:6.15pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">OPCIÓN DE
            ENTREGA 2:</span></i></b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></p>
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Por favor
            confirme si va a configurar sobre sus máquinas el direccionamiento publico
            asignado por Claro.<span></span></span></i></p>
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:6.15pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">En caso de que la respuesta sea <b><u>NO</u></b>
            por favor indíquenos el pool de direcciones para configurar DHCP y las IPs
            Excluidas</span></i><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.2pt">
            <td width="61" valign="top" style="width:45.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:12.2pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">NO:<span></span></span></b></p>
            </td>
            <td width="475" colspan="7" valign="top" style="width:356.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.2pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
           </tr>
           <tr>
            <td width="177" style="width:132.75pt;padding:0cm"></td>
            <td width="1" style="width:0.75pt;padding:0cm"></td>
            <td width="221" style="width:165.75pt;padding:0cm"></td>
            <td width="61" style="width:45.75pt;padding:0cm"></td>
            <td width="23" style="width:17.25pt;padding:0cm"></td>
            <td width="92" style="width:69pt;padding:0cm"></td>
            <td width="85" style="width:63.75pt;padding:0cm"></td>
            <td width="76" style="width:57pt;padding:0cm"></td>
            <td width="9" style="width:6.75pt;padding:0cm"></td>
            <td width="94" style="width:70.5pt;padding:0cm"></td>
            <td width="95" style="width:71.25pt;padding:0cm"></td>
           </tr>
          </tbody></table>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
          en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="906" height="609" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones.png"></span></b></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
          contactar a:<span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <table class="m_5089500533639821532gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
           <tbody><tr style="height:29.05pt">
            <td width="227" colspan="3" valign="top" style="width:6cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
            <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
            </span></b></div>
            </td>
            <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
            <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
            </span></b></div>
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
            </td>
           </tr>
           <tr style="height:14.3pt">
            <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:14.3pt">
            <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
            </td>
            <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="151" colspan="2" valign="top" style="width:113.2pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
            Contacto:<span></span></span></b></p>
            </td>
            <td width="161" colspan="2" valign="top" style="width:120.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
            </td>
            <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
            </td>
            <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
            </td>
            <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
            Contacto:<span></span></span></b></p>
            </td>
            <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
            </td>
            <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
            </td>
            <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
            </td>
            <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
            Contacto:<span></span></span></b></p>
            </td>
            <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
            </td>
            <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
            </td>
            <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
            </td>
           </tr>
          </tbody></table><div class="yj6qo"></div><div class="adL">


          <br></div></div>

        ';
    }

//
    public function internet_dedicado($argumentos) {
        return '

          <div dir="ltr"><div class="adM">
          </div>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif"> ' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>( ' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
          Servicio &nbsp;<b><span style="color:rgb(31,73,125)"> ' . $argumentos['servicio'] . '</span></b><span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
          los datos de contacto del Ingeniero encargado de la implementación de su
          servicio. Es de suma importancia que sea revisado y nos retroalimente la
          información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
          dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
          contenida en este documento es importante que nos haga llegar sus inquietudes
          ya que el servicio contratado será entregado de acuerdo a la información que
          describimos a continuación. <span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="955" height="662" src="' . URL::base() . '/assets/img/mail_formats/internet_dedicado.png"></span></b></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b> ' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
          instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
          detalla la secuencia de actividades para llevar a cabo la instalación del
          servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453" src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>

          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

          <table class="m_8516412771729688178gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="935" style="width:701.3pt;border-collapse:collapse">
           <tbody><tr style="height:29.05pt">
            <td width="177" valign="top" style="width:132.6pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
            <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
            </span></b></div>
            </td>
            <td width="758" colspan="10" valign="top" style="width:568.7pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
            <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
            </span></b></div>
            </td>
           </tr>
           <tr style="height:8.05pt">
            <td width="178" colspan="2" style="width:133.3pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-family:&quot;Arial Black&quot;,sans-serif">INTERNET DEDICADO <span style="color:rgb(31,73,125)"><span></span></span></span></b></p>
            </td>
            <td width="757" colspan="9" valign="top" style="width:568pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;line-height:120%;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:black">DESCRIPCIÓN DE
            LA SOLUCIÓN:</span></i></b><span style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif">Enlace en Fibra Óptica de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif">con direccionamiento público <b>/29</b> (5
            Direcciones IP)</span><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:black">, este direccionamiento
            Publico puede ser configurado directamente sobre los equipos que necesitan
            salida a </span><b><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:rgb(192,0,0)">INTERNET</span></b><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:black">. En caso de que requiera&nbsp; la traslación del
            direccionamiento Publica asignado por Claro a su red privada Interna, es
            necesario que nos informe su red Privada.&nbsp; En caso de que requiera
            asignación de IP de forma centralizada, &nbsp;por favor infórmenos
            respondiendo este correo, &nbsp;con el fin de &nbsp;realizar la configuración
            de DHCP sobre nuestros equipos.<span></span></span></p>
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black">Es
            responsabilidad del <b>CLIENTE</b> enviar esta Información&nbsp; para que </span><b><i><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:rgb(192,0,0)">CLARO</span></i></b><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black">&nbsp; pueda configurar la
            Conectividad de acuerdo a la necesidad.</span><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:8.05pt">
            <td width="178" colspan="2" rowspan="15" style="width:133.3pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
            <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:8pt">
            <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['ancho_banda'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:16.45pt">
            <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:16.4pt">
            <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:10pt;font-family:Arial,sans-serif">99.6 % &nbsp;<span style="color:black"><span></span></span></span></i></b></p>
            </td>
           </tr>
           <tr style="height:16.4pt">
            <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
            </td>
           </tr>
           <tr style="height:16.4pt">
            <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
            </td>
            <td width="347" colspan="6" valign="top" style="width:260.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['fecha_servicio'] . '</span></span></p>
            </td>
            <td width="189" colspan="2" valign="top" style="width:5cm;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
            necesarias para la instalación<span style="color:black"><span></span></span></span></p>
            </td>
           </tr>
           <tr style="height:16.4pt">
            <td width="757" colspan="9" valign="top" style="width:568pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
            LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:8.45pt">
            <td width="221" rowspan="3" valign="top" style="width:166pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
            del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
            </td>
            <td width="177" colspan="3" valign="top" style="width:132.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
            </td>
            <td width="85" valign="top" style="width:63.8pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
            </td>
            <td width="180" colspan="3" valign="top" style="width:134.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
            </td>
            <td width="95" valign="top" style="width:70.9pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
           </tr>
           <tr style="height:8.35pt">
            <td width="177" colspan="3" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
            </td>
            <td width="85" valign="top" style="width:63.8pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
            </td>
            <td width="180" colspan="3" rowspan="2" valign="top" style="width:134.65pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
            confirme Horarios)<span></span></span></b></p>
            </td>
            <td width="95" rowspan="2" valign="top" style="width:70.9pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
           </tr>
           <tr style="height:5.8pt">
            <td width="177" colspan="3" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
            </td>
            <td width="85" valign="top" style="width:63.8pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
           </tr>
           <tr style="height:12.25pt">
            <td width="221" valign="top" style="width:166pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
            Existencia de las siguientes condiciones:<span></span></span></i></b></p>
            </td>
            <td width="85" colspan="2" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm 5.4pt;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
            </td>
            <td width="92" valign="top" style="width:69.2pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
            <td width="85" valign="top" style="width:63.8pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
            </td>
            <td width="76" valign="top" style="width:57.35pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
            <td width="103" colspan="2" valign="top" style="width:77.3pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
            equipos:<span></span></span></b></p>
            </td>
            <td width="95" valign="top" style="width:70.9pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
           </tr>
           <tr style="height:12.25pt">
            <td width="221" rowspan="2" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">OPCIÓN DE
            ENTREGA 1:</span></i></b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></p>
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Por favor confirme si va a conectar
            su red LAN con un direccionamiento diferente al público asignado por Claro. <span></span></span></p>
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">En caso de que la respuesta sea <b><u>SI</u></b>
            por favor indíquenos &nbsp;el segmento al cual le debemos configurar NAT.</span><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.2pt">
            <td width="61" valign="top" style="width:45.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:12.2pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">SI:<span></span></span></b></p>
            </td>
            <td width="475" colspan="7" valign="top" style="width:356.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.2pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
            </td>
           </tr>
           <tr style="height:6.15pt">
            <td width="221" rowspan="2" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:6.15pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">OPCIÓN DE
            ENTREGA 2:</span></i></b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></p>
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Por favor
            confirme si va a configurar sobre sus máquinas el direccionamiento publico
            asignado por Claro.<span></span></span></i></p>
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></i></b></p>
            </td>
            <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:6.15pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">En caso de que la respuesta sea <b><u>NO</u></b>
            por favor indíquenos el pool de direcciones para configurar DHCP y las IPs
            Excluidas</span></i><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.2pt">
            <td width="61" valign="top" style="width:45.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:12.2pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">NO:<span></span></span></b></p>
            </td>
            <td width="475" colspan="7" valign="top" style="width:356.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.2pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
            </td>
           </tr>
           <tr>
            <td width="177" style="width:132.75pt;padding:0cm"></td>
            <td width="1" style="width:0.75pt;padding:0cm"></td>
            <td width="221" style="width:165.75pt;padding:0cm"></td>
            <td width="61" style="width:45.75pt;padding:0cm"></td>
            <td width="23" style="width:17.25pt;padding:0cm"></td>
            <td width="92" style="width:69pt;padding:0cm"></td>
            <td width="85" style="width:63.75pt;padding:0cm"></td>
            <td width="76" style="width:57pt;padding:0cm"></td>
            <td width="9" style="width:6.75pt;padding:0cm"></td>
            <td width="94" style="width:70.5pt;padding:0cm"></td>
            <td width="95" style="width:71.25pt;padding:0cm"></td>
           </tr>
          </tbody></table>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
          en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="906" height="609" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones.png"></span></b></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
          contactar a:<span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <table class="m_8516412771729688178gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
           <tbody><tr style="height:29.05pt">
            <td width="226" colspan="3" valign="top" style="width:169.7pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
            <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
            </span></b></div>
            </td>
            <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
            <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
            </span></b></div>
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
            </td>
           </tr>
           <tr style="height:14.3pt">
            <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:14.3pt">
            <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
            </td>
            <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="151" colspan="2" valign="top" style="width:113pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
            Contacto:<span></span></span></b></p>
            </td>
            <td width="161" colspan="2" valign="top" style="width:120.5pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
            </td>
            <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
            </td>
            <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
            </td>
            <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
            Contacto:<span></span></span></b></p>
            </td>
            <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
            </td>
            <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
            </td>
            <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
            </td>
            <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
            Contacto:<span></span></span></b></p>
            </td>
            <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
            </td>
            <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
            </td>
            <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
            </td>
           </tr>
          </tbody></table><div class="yj6qo"></div><div class="adL">

          <br></div></div>

          ';
    }

//
    public function mpls_avanzado_intranet($argumentos) {
        return '
          <div dir="ltr"><div class="adM">

        </div>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
        Servicio &nbsp;<b><span style="color:rgb(31,73,125)"> ' . $argumentos['servicio'] . '</span></b><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
        los datos de contacto del Ingeniero encargado de la implementación de su
        servicio. Es de suma importancia que sea revisado y nos retroalimente la
        información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
        dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
        contenida en este documento es importante que nos haga llegar sus inquietudes
        ya que el servicio contratado será entregado de acuerdo a la información que
        describimos a continuación. <span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="967" height="546" src="' . URL::base() . '/assets/img/mail_formats/mlps_avanzado_solucion_intranet.png" ></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b> ' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
        instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
        detalla la secuencia de actividades para llevar a cabo la instalación del
        servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453" src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>

        <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

        <table class="m_-2714967827264337054gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
         <tbody><tr style="height:29.05pt">
          <td width="189" valign="top" style="width:5cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:29.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="189" style="width:5cm;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS AVANZADO
          INTRANET</span></b><b><span style="font-family:&quot;Arial Black&quot;,sans-serif;color:rgb(31,73,125)"><span></span></span></b></p>
          </td>
          <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
          LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
          segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="189" rowspan="17" style="width:5cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
          </td>
          <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
          </td>
          <td width="194" colspan="7" valign="top" style="width:145.8pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['existente'] . '</span></span></b></p>
          </td>
          <td width="53" colspan="2" valign="top" style="width:39.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
          </td>
          <td width="215" colspan="7" valign="top" style="width:161.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['nuevo'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['ancho_banda'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.45pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
          </td>
          <td width="347" colspan="13" valign="top" style="width:260.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['fecha_servicio'] . '</span></span></p>
          </td>
          <td width="189" colspan="5" valign="top" style="width:141.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
          necesarias para la instalación<span style="color:black"><span></span></span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
          LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.45pt">
          <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.6pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
          del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
          </td>
          <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" valign="top" style="width:134.5pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.15pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.35pt">
          <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.5pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
          confirme Horarios)<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.15pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:5.8pt">
          <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:5.8pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:12.25pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
          Existencia de las siguientes condiciones:<span></span></span></i></b></p>
          </td>
          <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
          </td>
          <td width="92" colspan="3" valign="top" style="width:69.1pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
          </td>
          <td width="76" colspan="4" valign="top" style="width:57.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="103" colspan="4" valign="top" style="width:77.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
          equipos:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.15pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:17.65pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:17.65pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:17.6pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la configuración
          de rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:17.6pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="210" colspan="2" rowspan="3" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del
          Contacto Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr>
          <td width="189" style="width:5cm;padding:0cm"></td>
          <td width="1" style="width:1pt;padding:0cm"></td>
          <td width="221" colspan="2" style="width:165.85pt;padding:0cm"></td>
          <td width="61" style="width:45.9pt;padding:0cm"></td>
          <td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
          <td width="92" colspan="3" style="width:69.1pt;padding:0cm"></td>
          <td width="85" colspan="3" style="width:63.75pt;padding:0cm"></td>
          <td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="94" colspan="2" style="width:70.5pt;padding:0cm"></td>
          <td width="95" colspan="2" style="width:71.15pt;padding:0cm"></td>
         </tr>
         <tr>
          <td width="189" style="width:5cm;padding:0cm"></td>
          <td width="1" style="width:0.75pt;padding:0cm"></td>
          <td width="209" style="width:156.75pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="61" style="width:45.75pt;padding:0cm"></td>
          <td width="11" style="width:8.25pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="30" style="width:22.5pt;padding:0cm"></td>
          <td width="50" style="width:37.5pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="73" style="width:54.75pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="47" style="width:35.25pt;padding:0cm"></td>
          <td width="17" style="width:12.75pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="3" style="width:2.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="82" style="width:61.5pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="83" style="width:62.25pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
         </tr>
        </tbody></table>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
        en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="983" height="597" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_mpls.png"></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
        contactar a:<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <table class="m_-2714967827264337054gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
         <tbody><tr style="height:29.05pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          </td>
         </tr>
         <tr style="height:14.3pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:14.3pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="151" colspan="2" valign="top" style="width:113.2pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="161" colspan="2" valign="top" style="width:120.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>   ' . $argumentos['ingeniero3'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>   ' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
          </td>
         </tr>
        </tbody></table><div class="yj6qo"></div><div class="adL">





        <br></div></div>



          ';
    }

//
    public function mpls_avanzado_intranet_varios_puntos($argumentos) {
        return '
        <div dir="ltr"><div class="adM">

        </div>
        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif"> ' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
        Servicio &nbsp;<b><span style="color:rgb(31,73,125)"> ' . $argumentos['servicio'] . '</span></b><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
        los datos de contacto del Ingeniero encargado de la implementación de su
        servicio. Es de suma importancia que sea revisado y nos retroalimente la
        información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
        dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
        contenida en este documento es importante que nos haga llegar sus inquietudes
        ya que el servicio contratado será entregado de acuerdo a la información que
        describimos a continuación. <span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="884" height="473" src="' . URL::base() . '/assets/img/mail_formats/mpls_avanzado_solucion_intranet_varios_puntos.png"></span></b><span lang="ES-CO"><span style="color:black"><span></span></span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b> ' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
        instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
        detalla la secuencia de actividades para llevar a cabo la instalación del
        servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453"src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>

        <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

        <table class="m_8746399538841561701gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
         <tbody><tr style="height:29.05pt">
          <td width="189" valign="top" style="width:141.65pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="747" colspan="20" valign="top" style="width:559.9pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:29.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="189" style="width:141.65pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS AVANZADO
          INTRANET</span></b><b><span style="font-family:&quot;Arial Black&quot;,sans-serif;color:rgb(31,73,125)"><span></span></span></b></p>
          </td>
          <td width="747" colspan="20" valign="top" style="width:559.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
          LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
          segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="189" rowspan="23" style="width:141.65pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino &nbsp;1 del Servicio)<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion_des1'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino &nbsp;2 del Servicio)<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion_des2'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino &nbsp;3 del Servicio)<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion_des3'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino &nbsp;4 del Servicio)<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion_des4'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
          </td>
          <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
          </td>
          <td width="195" colspan="7" valign="top" style="width:145.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['existente'] . '</span></span></b></p>
          </td>
          <td width="53" colspan="2" valign="top" style="width:39.75pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
          </td>
          <td width="215" colspan="7" valign="top" style="width:161.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['nuevo'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['ancho_banda'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.45pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:4.2pt">
          <td width="210" colspan="2" rowspan="4" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:4.2pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:4.2pt"></td>
          <td width="12" rowspan="4" style="width:9pt;padding:0cm;height:4.2pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span>' . $argumentos['equipos_intalar_camp1'] . '</span></p>
          </td>
         </tr>
         <tr style="height:4.1pt">
          <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:4.1pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['equipos_intalar_camp1'] . '</span></span></p>
          </td>
         </tr>
         <tr style="height:4.1pt">
          <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:4.1pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['equipos_intalar_camp2'] . '</span></span></p>
          </td>
         </tr>
         <tr style="height:4.1pt">
          <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:4.1pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['equipos_intalar_camp3'] . '</span></span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
          </td>
          <td width="347" colspan="13" valign="top" style="width:260.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['fecha_servicio'] . '</span></span></p>
          </td>
          <td width="189" colspan="5" valign="top" style="width:141.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
          necesarias para la instalación<span style="color:black"><span></span></span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="747" colspan="20" valign="top" style="width:559.9pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
          LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.45pt">
          <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
          del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
          </td>
          <td width="177" colspan="6" valign="top" style="width:132.7pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" valign="top" style="width:134.5pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.35pt">
          <td width="177" colspan="6" valign="top" style="width:132.7pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.5pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
          confirme Horarios)<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:5.8pt">
          <td width="177" colspan="6" valign="top" style="width:132.7pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:5.8pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:12.25pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
          Existencia de las siguientes condiciones:<span></span></span></i></b></p>
          </td>
          <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
          </td>
          <td width="92" colspan="3" valign="top" style="width:69.25pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
          </td>
          <td width="76" colspan="4" valign="top" style="width:57.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="103" colspan="4" valign="top" style="width:77.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
          equipos:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:17.65pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:17.65pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:17.6pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la
          configuración de rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:17.6pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="210" colspan="2" rowspan="3" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del
          Contacto Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr>
          <td width="189" style="width:141.65pt;padding:0cm"></td>
          <td width="1" style="width:1pt;padding:0cm"></td>
          <td width="221" colspan="2" style="width:165.75pt;padding:0cm"></td>
          <td width="61" style="width:46.05pt;padding:0cm"></td>
          <td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
          <td width="92" colspan="3" style="width:69.1pt;padding:0cm"></td>
          <td width="85" colspan="3" style="width:63.75pt;padding:0cm"></td>
          <td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="94" colspan="2" style="width:70.5pt;padding:0cm"></td>
          <td width="95" colspan="2" style="width:71.2pt;padding:0cm"></td>
         </tr>
         <tr>
          <td width="189" style="width:141.65pt;padding:0cm"></td>
          <td width="1" style="width:1pt;padding:0cm"></td>
          <td width="209" style="width:156.65pt;padding:0cm"></td>
          <td width="12" style="width:9.1pt;padding:0cm"></td>
          <td width="61" style="width:46.05pt;padding:0cm"></td>
          <td width="11" style="width:8.3pt;padding:0cm"></td>
          <td width="12" style="width:9.25pt;padding:0cm"></td>
          <td width="30" style="width:22.5pt;padding:0cm"></td>
          <td width="50" style="width:37.5pt;padding:0cm"></td>
          <td width="12" style="width:9.1pt;padding:0cm"></td>
          <td width="73" style="width:54.75pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="47" style="width:35.25pt;padding:0cm"></td>
          <td width="17" style="width:13pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="3" style="width:2.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="82" style="width:61.5pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="83" style="width:62.2pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
         </tr>
        </tbody></table>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
        en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="991" height="597" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones.png"></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
        contactar a:<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <table class="m_8746399538841561701gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
         <tbody><tr style="height:29.05pt">
          <td width="226" colspan="3" valign="top" style="width:169.7pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          </td>
         </tr>
         <tr style="height:14.3pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:14.3pt">
          <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
          </td>
          <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="151" colspan="2" valign="top" style="width:113pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="161" colspan="2" valign="top" style="width:120.5pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
          </td>
         </tr>
        </tbody></table><div class="yj6qo"></div><div class="adL">

        <br></div></div>

          ';
    }

//
    public function mpls_avanzado_intranet_con_backup_de_ultima_milla_nds2($argumentos) {
        return '
        <div dir="ltr"><div class="adM">

        </div><p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span>De:</span></b>
        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>' . $argumentos['nombre_cliente'] . '</b>con el cual se da inicio al proceso de Instalación del
        Servicio &nbsp;<b><span style="color:rgb(31,73,125">' . $argumentos['servicio'] . '</span></b><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
        los datos de contacto del Ingeniero encargado de la implementación de su
        servicio. Es de suma importancia que sea revisado y nos retroalimente la
        información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
        dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
        contenida en este documento es importante que nos haga llegar sus inquietudes
        ya que el servicio contratado será entregado de acuerdo a la información que
        describimos a continuación. <span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="978" height="591" src="' . URL::base() . '/assets/img/mail_formats/mpls_avanzado_solucion_intranet_con_backup_de_ultima_milla_nds2.png"></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b>' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
        instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
        detalla la secuencia de actividades para llevar a cabo la instalación del
        servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453"  src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>


        <table class="m_937943869150412458gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
         <tbody><tr style="height:29.05pt">
          <td width="189" valign="top" style="width:5cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:29.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="189" style="width:5cm;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS AVANZADO
          INTRANET</span></b><b><span style="font-family:&quot;Arial Black&quot;,sans-serif;color:rgb(31,73,125)"><span></span></span></b></p>
          </td>
          <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
          LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
          segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="189" rowspan="17" style="width:5cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
          </td>
          <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
          </td>
          <td width="194" colspan="7" valign="top" style="width:145.8pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['existente'] . '</span></span></b></p>
          </td>
          <td width="53" colspan="2" valign="top" style="width:39.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
          </td>
          <td width="215" colspan="7" valign="top" style="width:161.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['nuevo'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['ancho_banda'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.45pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
          </td>
          <td width="347" colspan="13" valign="top" style="width:260.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['fecha_servicio'] . '</span></span></p>
          </td>
          <td width="189" colspan="5" valign="top" style="width:141.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
          necesarias para la instalación<span style="color:black"><span></span></span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
          LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.45pt">
          <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.6pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
          del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
          </td>
          <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" valign="top" style="width:134.5pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.15pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.35pt">
          <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.5pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
          confirme Horarios)<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.15pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:5.8pt">
          <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:5.8pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:12.25pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
          Existencia de las siguientes condiciones:<span></span></span></i></b></p>
          </td>
          <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
          </td>
          <td width="92" colspan="3" valign="top" style="width:69.1pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
          </td>
          <td width="76" colspan="4" valign="top" style="width:57.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="103" colspan="4" valign="top" style="width:77.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
          equipos:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.15pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:17.65pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:17.65pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:17.6pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la configuración
          de rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:17.6pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="210" colspan="2" rowspan="3" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del
          Contacto Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr>
          <td width="189" style="width:5cm;padding:0cm"></td>
          <td width="1" style="width:1pt;padding:0cm"></td>
          <td width="221" colspan="2" style="width:165.85pt;padding:0cm"></td>
          <td width="61" style="width:45.9pt;padding:0cm"></td>
          <td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
          <td width="92" colspan="3" style="width:69.1pt;padding:0cm"></td>
          <td width="85" colspan="3" style="width:63.75pt;padding:0cm"></td>
          <td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="94" colspan="2" style="width:70.5pt;padding:0cm"></td>
          <td width="95" colspan="2" style="width:71.15pt;padding:0cm"></td>
         </tr>
         <tr>
          <td width="189" style="width:5cm;padding:0cm"></td>
          <td width="1" style="width:0.75pt;padding:0cm"></td>
          <td width="209" style="width:156.75pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="61" style="width:45.75pt;padding:0cm"></td>
          <td width="11" style="width:8.25pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="30" style="width:22.5pt;padding:0cm"></td>
          <td width="50" style="width:37.5pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="73" style="width:54.75pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="47" style="width:35.25pt;padding:0cm"></td>
          <td width="17" style="width:12.75pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="3" style="width:2.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="82" style="width:61.5pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="83" style="width:62.25pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
         </tr>
        </tbody></table>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
        en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="995" height="647" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_mpls_avanzado_solucion_intranet_con_backup_de_ultima_milla_backup_de_router_nds1.png"></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
        contactar a:<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <table class="m_937943869150412458gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
         <tbody><tr style="height:29.05pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          </td>
         </tr>
         <tr style="height:14.3pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:14.3pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="151" colspan="2" valign="top" style="width:113.2pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="161" colspan="2" valign="top" style="width:120.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
          </td>
         </tr>
        </tbody></table><div class="yj6qo"></div><div class="adL">

        <br></div></div>
          ';
    }

//
    public function mpls_avanzado_intranet_con_backup_de_ultima_milla_y_router_nds1($argumentos) {
        return ' <div dir="ltr"><div class="adM">

        </div>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
        Servicio &nbsp;<b><span style="color:rgb(31,73,125)">' . $argumentos['servicio'] . '</span></b><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
        los datos de contacto del Ingeniero encargado de la implementación de su
        servicio. Es de suma importancia que sea revisado y nos retroalimente la
        información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
        dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
        contenida en este documento es importante que nos haga llegar sus inquietudes
        ya que el servicio contratado será entregado de acuerdo a la información que
        describimos a continuación. <span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="978" height="611" src="' . URL::base() . '/assets/img/mail_formats/mpls_avanzado_solucion_intranet_con_backup_de_ultima_milla_backup_de_router_nds1.png" ></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b>' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
        instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
        detalla la secuencia de actividades para llevar a cabo la instalación del
        servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453" src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></b></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></b></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></b></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></b></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></b></p>

        <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

        <table class="m_-9022856202092309242gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
         <tbody><tr style="height:29.05pt">
          <td width="189" valign="top" style="width:141.6pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="747" colspan="21" valign="top" style="width:559.95pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:29.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="189" style="width:141.6pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS AVANZADO
          INTRANET</span></b><b><span style="font-family:&quot;Arial Black&quot;,sans-serif;color:rgb(31,73,125)"><span></span></span></b></p>
          </td>
          <td width="747" colspan="21" valign="top" style="width:559.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
          LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
          segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="189" rowspan="20" style="width:141.6pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="19" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
          </td>
          <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
          </td>
          <td width="195" colspan="8" valign="top" style="width:145.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['existente'] . '</span></span></b></p>
          </td>
          <td width="53" colspan="2" valign="top" style="width:39.75pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
          </td>
          <td width="215" colspan="7" valign="top" style="width:161.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['nuevo'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="19" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['ancho_banda'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.45pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="19" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="19" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="19" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
          </td>
          <td width="347" colspan="14" valign="top" style="width:260.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['fecha_servicio'] . '</span></span></p>
          </td>
          <td width="189" colspan="5" valign="top" style="width:141.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
          necesarias para la instalación<span style="color:black"><span></span></span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="747" colspan="21" valign="top" style="width:559.95pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
          LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.45pt">
          <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
          del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
          </td>
          <td width="177" colspan="7" valign="top" style="width:132.7pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" valign="top" style="width:134.55pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.35pt">
          <td width="177" colspan="7" valign="top" style="width:132.7pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.55pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
          confirme Horarios)<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:5.8pt">
          <td width="177" colspan="7" valign="top" style="width:132.7pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:5.8pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:12.25pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
          Existencia de las siguientes condiciones:<span></span></span></i></b></p>
          </td>
          <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
          </td>
          <td width="92" colspan="4" valign="top" style="width:69.25pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
          </td>
          <td width="76" colspan="4" valign="top" style="width:57.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="103" colspan="4" valign="top" style="width:77.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
          equipos:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:5.7pt">
          <td width="210" colspan="2" rowspan="4" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:5.7pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
          </td>
          <td width="119" colspan="5" valign="top" style="width:89.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:5.7pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif">IP LAN:<span style="color:black"><span></span></span></span></b></p>
          </td>
          <td width="418" colspan="14" valign="top" style="width:313.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:5.7pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" rowspan="4" style="width:9pt;padding:0cm;height:5.7pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:5.6pt">
          <td width="119" colspan="5" valign="top" style="width:89.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:5.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif">IP ACTIVA:<span style="color:black"><span></span></span></span></b></p>
          </td>
          <td width="418" colspan="14" valign="top" style="width:313.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:5.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
         </tr>
         <tr style="height:5.6pt">
          <td width="119" colspan="5" valign="top" style="width:89.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:5.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif">IP STANDBY:<span style="color:black"><span></span></span></span></b></p>
          </td>
          <td width="418" colspan="14" valign="top" style="width:313.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:5.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
         </tr>
         <tr style="height:5.6pt">
          <td width="119" colspan="5" valign="top" style="width:89.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:5.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif">IP VIRTUAL:<span style="color:black"><span></span></span></span></b></p>
          </td>
          <td width="418" colspan="14" valign="top" style="width:313.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:5.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
         </tr>
         <tr style="height:17.6pt">
          <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la
          configuración de rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="536" colspan="19" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:17.6pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="210" colspan="2" rowspan="3" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del
          Contacto Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="127" colspan="6" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="127" colspan="6" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="127" colspan="6" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr>
          <td width="189" style="width:141.6pt;padding:0cm"></td>
          <td width="1" style="width:1pt;padding:0cm"></td>
          <td width="221" colspan="2" style="width:165.75pt;padding:0cm"></td>
          <td width="61" style="width:46.05pt;padding:0cm"></td>
          <td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
          <td width="92" colspan="4" style="width:69.1pt;padding:0cm"></td>
          <td width="85" colspan="3" style="width:63.8pt;padding:0cm"></td>
          <td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="94" colspan="2" style="width:70.5pt;padding:0cm"></td>
          <td width="95" colspan="2" style="width:71.2pt;padding:0cm"></td>
         </tr>
         <tr>
          <td width="189" style="width:141.6pt;padding:0cm"></td>
          <td width="1" style="width:1pt;padding:0cm"></td>
          <td width="209" style="width:156.65pt;padding:0cm"></td>
          <td width="12" style="width:9.1pt;padding:0cm"></td>
          <td width="61" style="width:46.05pt;padding:0cm"></td>
          <td width="11" style="width:8.3pt;padding:0cm"></td>
          <td width="12" style="width:9.25pt;padding:0cm"></td>
          <td width="30" colspan="2" style="width:22.5pt;padding:0cm"></td>
          <td width="50" style="width:37.5pt;padding:0cm"></td>
          <td width="12" style="width:9.1pt;padding:0cm"></td>
          <td width="73" style="width:54.75pt;padding:0cm"></td>
          <td width="6" style="width:4.55pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="47" style="width:35.25pt;padding:0cm"></td>
          <td width="17" style="width:13pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="3" style="width:2.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="82" style="width:61.5pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="83" style="width:62.2pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
         </tr>
         <tr>
          <td width="189" style="width:5cm;padding:0cm"></td>
          <td width="1" style="width:0.75pt;padding:0cm"></td>
          <td width="209" style="width:156.75pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="61" style="width:45.75pt;padding:0cm"></td>
          <td width="11" style="width:8.25pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="22" style="width:16.5pt;padding:0cm"></td>
          <td width="8" style="width:6pt;padding:0cm"></td>
          <td width="50" style="width:37.5pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="73" style="width:54.75pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="47" style="width:35.25pt;padding:0cm"></td>
          <td width="17" style="width:12.75pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="3" style="width:2.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="82" style="width:61.5pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="83" style="width:62.25pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
         </tr>
        </tbody></table>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
        en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="992" height="635" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_mpls_avanzado_solucion_intranet_con_backup_de_ultima_milla_backup_de_router_nds1.png"></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
        contactar a:<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <table class="m_-9022856202092309242gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
         <tbody><tr style="height:29.05pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          </td>
         </tr>
         <tr style="height:14.3pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:14.3pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="151" colspan="2" valign="top" style="width:113.2pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="161" colspan="2" valign="top" style="width:120.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
          </td>
         </tr>
        </tbody></table><div class="yj6qo"></div><div class="adL">

        <br></div></div>

              ';
    }

//
    public function avanzado_extranet($argumentos) {
        return '

        <div dir="ltr"><div class="adM">

        </div>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
        Servicio &nbsp;<b><span style="color:rgb(31,73,125)<">' . $argumentos['servicio'] . '</span></b><span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
        los datos de contacto del Ingeniero encargado de la implementación de su
        servicio. Es de suma importancia que sea revisado y nos retroalimente la
        información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
        dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
        contenida en este documento es importante que nos haga llegar sus inquietudes
        ya que el servicio contratado será entregado de acuerdo a la información que
        describimos a continuación. <span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="982" height="555" src="' . URL::base() . '/assets/img/mail_formats/mpls_avanzado_solucion_extranet.png"></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b>' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
        instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
        detalla la secuencia de actividades para llevar a cabo la instalación del
        servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453" src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>


        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>

        <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

        <table class="m_3371736464730935837gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
         <tbody><tr style="height:29.05pt">
          <td width="189" valign="top" style="width:5cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:29.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="189" style="width:5cm;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS AVANZADO
          EXTRANET</span></b><b><span style="font-family:&quot;Arial Black&quot;,sans-serif;color:rgb(31,73,125)"><span></span></span></b></p>
          </td>
          <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
          LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
          segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="189" rowspan="17" style="width:5cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.05pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
          </td>
          <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
          </td>
          <td width="194" colspan="7" valign="top" style="width:145.8pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['existente'] . '</span></span></b></p>
          </td>
          <td width="53" colspan="2" valign="top" style="width:39.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
          </td>
          <td width="215" colspan="7" valign="top" style="width:161.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['nuevo'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['ancho_banda'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.45pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
          </td>
          <td width="347" colspan="13" valign="top" style="width:260.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['fecha_servicio'] . '</span></span></p>
          </td>
          <td width="189" colspan="5" valign="top" style="width:141.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
          necesarias para la instalación<span style="color:black"><span></span></span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:16.4pt">
          <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
          LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.45pt">
          <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.6pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
          del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
          </td>
          <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" valign="top" style="width:134.5pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.15pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:8.35pt">
          <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.5pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
          confirme Horarios)<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.15pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:5.8pt">
          <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:5.8pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:12.25pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
          Existencia de las siguientes condiciones:<span></span></span></i></b></p>
          </td>
          <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
          </td>
          <td width="92" colspan="3" valign="top" style="width:69.1pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
          </td>
          <td width="76" colspan="4" valign="top" style="width:57.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="103" colspan="4" valign="top" style="width:77.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
          equipos:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.15pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:17.65pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:17.65pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:17.6pt">
          <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la configuración
          de rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:17.6pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="210" colspan="2" rowspan="3" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del
          Contacto Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr style="height:11.25pt">
          <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
         </tr>
         <tr>
          <td width="189" style="width:5cm;padding:0cm"></td>
          <td width="1" style="width:1pt;padding:0cm"></td>
          <td width="221" colspan="2" style="width:165.85pt;padding:0cm"></td>
          <td width="61" style="width:45.9pt;padding:0cm"></td>
          <td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
          <td width="92" colspan="3" style="width:69.1pt;padding:0cm"></td>
          <td width="85" colspan="3" style="width:63.75pt;padding:0cm"></td>
          <td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="94" colspan="2" style="width:70.5pt;padding:0cm"></td>
          <td width="95" colspan="2" style="width:71.15pt;padding:0cm"></td>
         </tr>
         <tr>
          <td width="189" style="width:5cm;padding:0cm"></td>
          <td width="1" style="width:0.75pt;padding:0cm"></td>
          <td width="209" style="width:156.75pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="61" style="width:45.75pt;padding:0cm"></td>
          <td width="11" style="width:8.25pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="30" style="width:22.5pt;padding:0cm"></td>
          <td width="50" style="width:37.5pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="73" style="width:54.75pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="47" style="width:35.25pt;padding:0cm"></td>
          <td width="17" style="width:12.75pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="3" style="width:2.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="82" style="width:61.5pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="83" style="width:62.25pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
         </tr>
        </tbody></table>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
        en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="984" height="597" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_mpls.png"></span></b></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
        contactar a:<span></span></span></p>

        <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

        <table class="m_3371736464730935837gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
         <tbody><tr style="height:29.05pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          </td>
         </tr>
         <tr style="height:14.3pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:14.3pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="151" colspan="2" valign="top" style="width:113.2pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="161" colspan="2" valign="top" style="width:120.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3'] . '</span></span></b></p>
          </td>
         </tr>
         <tr style="height:12.5pt">
          <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
          </td>
         </tr>
        </tbody></table><div class="yj6qo"></div><div class="adL">





        <br></div></div>

        ';
    }

//
    public function backend_mpls($argumentos) {
        return '
          <div dir="ltr"><div class="adM">



          </div>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
          Servicio &nbsp;<b><span style="color:rgb(31,73,125)"> ' . $argumentos['servicio'] . '</span></b><span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
          los datos de contacto del Ingeniero encargado de la implementación de su
          servicio. Es de suma importancia que sea revisado y nos retroalimente la
          información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
          dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
          contenida en este documento es importante que nos haga llegar sus inquietudes
          ya que el servicio contratado será entregado de acuerdo a la información que
          describimos a continuación. <span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="887" height="522" src="' . URL::base() . '/assets/img/mail_formats/backend_mpls.png"  ></span></b></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b> ' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
          instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
          detalla la secuencia de actividades para llevar a cabo la instalación del
          servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453" src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>

          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

          <table class="m_7738108672524097144gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
           <tbody><tr style="height:29.05pt">
            <td width="189" valign="top" style="width:141.6pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
            <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
            </span></b></div>
            </td>
            <td width="747" colspan="20" valign="top" style="width:559.95pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
            <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
            </span></b></div>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:29.05pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:8.05pt">
            <td width="189" style="width:141.6pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
            <p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:14pt;line-height:115%;font-family:Arial,sans-serif">BACKEND MPLS<span></span></span></i></b></p>
            </td>
            <td width="747" colspan="20" valign="top" style="width:559.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
            LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
            segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:8.05pt">
            <td width="189" rowspan="18" style="width:141.6pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
            <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="18" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:8.05pt">
            <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
            </td>
            <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
            </td>
            <td width="94" colspan="3" valign="top" style="width:70.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['existente'] . '</span></span></b></p>
            </td>
            <td width="154" colspan="6" valign="top" style="width:115.5pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
            </td>
            <td width="215" colspan="7" valign="top" style="width:161.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['nuevo'] . '</span></span></b></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:8pt">
            <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="18" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['ancho_banda'] . '</span></span></b></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:8pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:16.45pt">
            <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="18" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:16.45pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:16.4pt">
            <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="18" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:16.4pt">
            <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
            </td>
            <td width="536" colspan="18" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:16.4pt">
            <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
            </td>
            <td width="347" colspan="13" valign="top" style="width:260.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['fecha_servicio'] . '</span></span></p>
            </td>
            <td width="189" colspan="5" valign="top" style="width:141.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
            necesarias para la instalación<span style="color:black"><span></span></span></span></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:16.4pt">
            <td width="747" colspan="20" valign="top" style="width:559.95pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
            LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:8.45pt">
            <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
            del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
            </td>
            <td width="177" colspan="6" valign="top" style="width:132.7pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
            </td>
            <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
            </td>
            <td width="179" colspan="8" valign="top" style="width:134.55pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
            </td>
            <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:8.45pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:8.35pt">
            <td width="177" colspan="6" valign="top" style="width:132.7pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
            </td>
            <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
            </td>
            <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.55pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
            confirme Horarios)<span></span></span></b></p>
            </td>
            <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:8.35pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:5.8pt">
            <td width="177" colspan="6" valign="top" style="width:132.7pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
            </td>
            <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:5.8pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:12.25pt">
            <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
            Existencia de las siguientes condiciones:<span></span></span></i></b></p>
            </td>
            <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
            </td>
            <td width="92" colspan="3" valign="top" style="width:69.25pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
            <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
            </td>
            <td width="76" colspan="4" valign="top" style="width:57.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
            <td width="103" colspan="4" valign="top" style="width:77.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
            equipos:<span></span></span></b></p>
            </td>
            <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:12.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:17.65pt">
            <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.65pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
            </td>
            <td width="536" colspan="18" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.65pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:17.65pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:11.25pt">
            <td width="210" colspan="2" rowspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:11.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif">La Solución en Datacenter tiene Firewall</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
            </td>
            <td width="167" colspan="5" valign="top" style="width:125.35pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif">Administrado por Claro</span></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
            <td width="369" colspan="13" valign="top" style="width:276.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
            </td>
            <td width="12" rowspan="2" style="width:9pt;padding:0cm;height:11.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:11.25pt">
            <td width="167" colspan="5" valign="top" style="width:125.35pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif">Administrado por Cliente</span></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
            <td width="369" colspan="13" valign="top" style="width:276.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
            </td>
           </tr>
           <tr style="height:11.25pt">
            <td width="210" colspan="2" rowspan="3" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm;height:11.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del
            Contacto Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
            </td>
            <td width="167" colspan="5" valign="top" style="width:125.35pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
            <td width="369" colspan="13" valign="top" style="width:276.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:11.25pt">
            <td width="167" colspan="5" valign="top" style="width:125.35pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
            <td width="369" colspan="13" valign="top" style="width:276.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr style="height:11.25pt">
            <td width="167" colspan="5" valign="top" style="width:125.35pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
            </td>
            <td width="369" colspan="13" valign="top" style="width:276.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
            <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
            </td>
            <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
            </td>
           </tr>
           <tr>
            <td width="189" style="width:141.6pt;padding:0cm"></td>
            <td width="1" style="width:1pt;padding:0cm"></td>
            <td width="221" colspan="2" style="width:165.75pt;padding:0cm"></td>
            <td width="61" style="width:46.05pt;padding:0cm"></td>
            <td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
            <td width="92" colspan="3" style="width:69.1pt;padding:0cm"></td>
            <td width="85" colspan="3" style="width:63.8pt;padding:0cm"></td>
            <td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
            <td width="9" style="width:6.75pt;padding:0cm"></td>
            <td width="94" colspan="2" style="width:70.5pt;padding:0cm"></td>
            <td width="95" colspan="2" style="width:71.2pt;padding:0cm"></td>
           </tr>
           <tr>
            <td width="189" style="width:141.6pt;padding:0cm"></td>
            <td width="1" style="width:1pt;padding:0cm"></td>
            <td width="209" style="width:156.65pt;padding:0cm"></td>
            <td width="12" style="width:9.1pt;padding:0cm"></td>
            <td width="61" style="width:46.05pt;padding:0cm"></td>
            <td width="11" style="width:8.3pt;padding:0cm"></td>
            <td width="12" style="width:9.25pt;padding:0cm"></td>
            <td width="70" style="width:52.65pt;padding:0cm"></td>
            <td width="10" style="width:7.35pt;padding:0cm"></td>
            <td width="12" style="width:9.1pt;padding:0cm"></td>
            <td width="73" style="width:54.75pt;padding:0cm"></td>
            <td width="1" style="width:1pt;padding:0cm"></td>
            <td width="11" style="width:8.05pt;padding:0cm"></td>
            <td width="47" style="width:35.25pt;padding:0cm"></td>
            <td width="17" style="width:13pt;padding:0cm"></td>
            <td width="9" style="width:6.75pt;padding:0cm"></td>
            <td width="3" style="width:2.25pt;padding:0cm"></td>
            <td width="9" style="width:6.75pt;padding:0cm"></td>
            <td width="82" style="width:61.5pt;padding:0cm"></td>
            <td width="12" style="width:9pt;padding:0cm"></td>
            <td width="83" style="width:62.2pt;padding:0cm"></td>
            <td width="12" style="width:9pt;padding:0cm"></td>
           </tr>
           <tr>
            <td width="189" style="width:5cm;padding:0cm"></td>
            <td width="1" style="width:0.75pt;padding:0cm"></td>
            <td width="209" style="width:156.75pt;padding:0cm"></td>
            <td width="12" style="width:9pt;padding:0cm"></td>
            <td width="61" style="width:45.75pt;padding:0cm"></td>
            <td width="11" style="width:8.25pt;padding:0cm"></td>
            <td width="12" style="width:9pt;padding:0cm"></td>
            <td width="70" style="width:52.5pt;padding:0cm"></td>
            <td width="10" style="width:7.5pt;padding:0cm"></td>
            <td width="12" style="width:9pt;padding:0cm"></td>
            <td width="73" style="width:54.75pt;padding:0cm"></td>
            <td width="1" style="width:0.75pt;padding:0cm"></td>
            <td width="11" style="width:8.25pt;padding:0cm"></td>
            <td width="47" style="width:35.25pt;padding:0cm"></td>
            <td width="17" style="width:12.75pt;padding:0cm"></td>
            <td width="9" style="width:6.75pt;padding:0cm"></td>
            <td width="3" style="width:2.25pt;padding:0cm"></td>
            <td width="9" style="width:6.75pt;padding:0cm"></td>
            <td width="82" style="width:61.5pt;padding:0cm"></td>
            <td width="12" style="width:9pt;padding:0cm"></td>
            <td width="83" style="width:62.25pt;padding:0cm"></td>
            <td width="12" style="width:9pt;padding:0cm"></td>
           </tr>
          </tbody></table>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
          en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="868" height="531" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_backend_mpls.png"></span></b></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
          contactar a:<span></span></span></p>

          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

          <table class="m_7738108672524097144gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
           <tbody><tr style="height:29.05pt">
            <td width="227" colspan="3" valign="top" style="width:6cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
            <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
            </span></b></div>
            </td>
            <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
            <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
            </span></b></div>
            <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
            </td>
           </tr>
           <tr style="height:14.3pt">
            <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:14.3pt">
            <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
            <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
            </td>
            <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="151" colspan="2" valign="top" style="width:113.2pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
            Contacto:<span></span></span></b></p>
            </td>
            <td width="161" colspan="2" valign="top" style="width:120.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
            </td>
            <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
            </td>
            <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
            </td>
            <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
            Contacto:<span></span></span></b></p>
            </td>
            <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
            </td>
            <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
            </td>
            <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
            </td>
            <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3'] . '</span></span></b></p>
            </td>
           </tr>
           <tr style="height:12.5pt">
            <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
            Contacto:<span></span></span></b></p>
            </td>
            <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
            </td>
            <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
            </td>
            <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
            <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
            </td>
           </tr>
          </tbody></table><div class="yj6qo"></div><div class="adL">





          <br></div></div>

            ';
    }

//
    public function mpls_avanzado_componente_datacenter_claro($argumentos) {
        return '

          <div dir="ltr"><div class="adM">
          </div>
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="margin:0in 0in 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>' . $argumentos['nombre_cliente'] . '</b>con el cual se da inicio al proceso de Instalación del
          Servicio &nbsp;<b><span style="color:rgb(31,73,125)">' . $argumentos['servicio'] . '</span></b><span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
          los datos de contacto del Ingeniero encargado de la implementación de su
          servicio. Es de suma importancia que sea revisado y nos retroalimente la
          información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
          dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
          contenida en este documento es importante que nos haga llegar sus inquietudes
          ya que el servicio contratado será entregado de acuerdo a la información que
          describimos a continuación. <span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:black"><img src="' . URL::base() . '/assets/img/mail_formats/mpls_avanzado_con_componente_en_datacenter.png" width="885" height="516"></span><span lang="ES-CO"><span></span></span></p>
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b>' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
          instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
          detalla la secuencia de actividades para llevar a cabo la instalación del
          servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span><img src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png" width="717" height="453"></span><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>
          <p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="color:white"><span>&nbsp;</span></span></b></p>
          <table class="m_3929576187344687846gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
          <tbody><tr style="height:29.05pt">
          <td width="189" valign="top" style="width:141.65pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0in 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="747" colspan="20" valign="top" style="width:559.9pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0in 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:29.05pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:8.05pt">
          <td width="189" style="width:141.65pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0in;height:8.05pt">
          <p class="MsoNormal" style="margin:0in 0in 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS AVANZADO COMPONENTE DATACENTER</span></b><b><span lang="ES" style="font-family:&quot;Arial Black&quot;,sans-serif;color:rgb(31,73,125)"><span></span></span></b></p>
          </td>
          <td width="747" colspan="20" valign="top" style="width:559.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0in 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="color:black">DESCRIPCIÓN
          DE LA SOLUCIÓN:</span></i></b><span lang="ES" style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por
          esta razón el <b>Direccionamiento LAN</b> asignado para las sedes a conectar
          no puede estar dentro del mismo segmento o duplicado.</span><b><span lang="ES" style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:8.05pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:8.05pt">
          <td width="189" rowspan="25" style="width:141.65pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0in;height:8.05pt"></td>
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:8.05pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:8.05pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
          </td>
          <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0in 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
          </td>
          <td width="53" colspan="3" valign="top" style="width:40.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['existente'] . '</span></span></b></p>
          </td>
          <td width="194" colspan="6" valign="top" style="width:145.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0in;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
          </td>
          <td width="215" colspan="7" valign="top" style="width:161.4pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['nuevo'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:8.05pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:8pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['ancho_banda'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:8pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:16.45pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:16.45pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="color:black">99.7 %
          &nbsp;- NDS5</span></b><b><i><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:16.4pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:16.4pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
          </td>
          <td width="347" colspan="13" valign="top" style="width:260.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['fecha_servicio'] . '</span></span></p>
          </td>
          <td width="189" colspan="5" valign="top" style="width:141.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
          necesarias para la instalación<span style="color:black"><span></span></span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:16.4pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:16.4pt">
          <td width="747" colspan="20" valign="top" style="width:559.9pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0in 5.4pt;height:16.4pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
          LA INSTALACIÓN DEL SERVICIO</span></b><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:16.4pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:8.45pt">
          <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.7pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0in 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
          del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
          </td>
          <td width="177" colspan="6" valign="top" style="width:132.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0in 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0in;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" valign="top" style="width:134.5pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0in;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0in;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:8.45pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:8.35pt">
          <td width="177" colspan="6" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0in 5.4pt;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0in;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.5pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0in;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
          confirme Horarios)<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0in;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:8.35pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:5.8pt">
          <td width="177" colspan="6" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0in 5.4pt;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0in;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:5.8pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:12.25pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0in 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
          Existencia de las siguientes condiciones:<span></span></span></i></b></p>
          </td>
          <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0in 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
          </td>
          <td width="92" colspan="3" valign="top" style="width:69.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0in;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0in;height:12.25pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:8pt;font-family:Arial,sans-serif">Tomas
          reguladas <span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
          </td>
          <td width="76" colspan="4" valign="top" style="width:57.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0in;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="103" colspan="4" valign="top" style="width:77.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0in;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los equipos:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0in;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:12.25pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:17.65pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:17.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:17.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:17.65pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:17.6pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la configuración de
          rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:17.6pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:0.05in">
          <td width="210" colspan="2" rowspan="8" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:0.05in">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black">Información para Finalizar el Cableado en
          Datacenter Claro</span></i></b><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:0.05in">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Bunker<span style="color:black"><span></span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:0.05in">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" rowspan="8" style="width:9pt;padding:0in;height:0.05in">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          </td>
          </tr>
          <tr style="height:3.4pt">
          <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:3.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Rack<span style="color:black"><span></span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:3.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          </tr>
          <tr style="height:3.4pt">
          <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:3.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Nombre del Equipo<span style="color:black"><span></span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:3.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          </tr>
          <tr style="height:3.4pt">
          <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:3.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Puerto del Equipo<span style="color:black"><span></span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:3.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          </tr>
          <tr style="height:5.65pt">
          <td width="127" colspan="5" rowspan="2" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:5.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Interfaz<span style="color:black"><span></span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:5.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Fastethernet:<b><span style="color:black"><span></span></span></b></span></p>
          </td>
          </tr>
          <tr style="height:5.6pt">
          <td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:5.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Gigaethernet<b><span style="color:black"><span></span></span></b></span></p>
          </td>
          </tr>
          <tr style="height:3.4pt">
          <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:3.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Conector<span style="color:black"><span></span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:3.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          </tr>
          <tr style="height:3.4pt">
          <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:3.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Tipo Fibra/UTP<span style="color:black"><span></span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:3.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          </tr>
          <tr style="height:11.25pt">
          <td width="210" colspan="2" rowspan="3" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in;height:11.25pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del Contacto
          Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:11.25pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:11.25pt">
          <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:11.25pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr style="height:11.25pt">
          <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:11.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0in;height:11.25pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
          </td>
          </tr>
          <tr>
          <td width="189" style="width:141.65pt;padding:0in"></td>
          <td width="1" style="width:1pt;padding:0in"></td>
          <td width="221" colspan="2" style="width:165.8pt;padding:0in"></td>
          <td width="61" style="width:46.05pt;padding:0in"></td>
          <td width="23" colspan="2" style="width:17.55pt;padding:0in"></td>
          <td width="92" colspan="3" style="width:69.05pt;padding:0in"></td>
          <td width="85" colspan="3" style="width:63.8pt;padding:0in"></td>
          <td width="76" colspan="4" style="width:57.25pt;padding:0in"></td>
          <td width="9" style="width:6.75pt;padding:0in"></td>
          <td width="94" colspan="2" style="width:70.45pt;padding:0in"></td>
          <td width="95" colspan="2" style="width:71.2pt;padding:0in"></td>
          </tr>
          <tr>
          <td width="189" style="width:141.65pt;padding:0in"></td>
          <td width="1" style="width:1pt;padding:0in"></td>
          <td width="209" style="width:156.7pt;padding:0in"></td>
          <td width="12" style="width:9.1pt;padding:0in"></td>
          <td width="61" style="width:46.05pt;padding:0in"></td>
          <td width="11" style="width:8.3pt;padding:0in"></td>
          <td width="12" style="width:9.25pt;padding:0in"></td>
          <td width="30" style="width:22.5pt;padding:0in"></td>
          <td width="50" style="width:37.45pt;padding:0in"></td>
          <td width="12" style="width:9.1pt;padding:0in"></td>
          <td width="73" style="width:54.75pt;padding:0in"></td>
          <td width="1" style="width:1pt;padding:0in"></td>
          <td width="11" style="width:8.05pt;padding:0in"></td>
          <td width="47" style="width:35.25pt;padding:0in"></td>
          <td width="17" style="width:13pt;padding:0in"></td>
          <td width="9" style="width:6.75pt;padding:0in"></td>
          <td width="3" style="width:2.25pt;padding:0in"></td>
          <td width="9" style="width:6.75pt;padding:0in"></td>
          <td width="82" style="width:61.45pt;padding:0in"></td>
          <td width="12" style="width:9pt;padding:0in"></td>
          <td width="83" style="width:62.2pt;padding:0in"></td>
          <td width="12" style="width:9pt;padding:0in"></td>
          </tr>
          <tr>
          <td width="189" style="width:141.75pt;padding:0in"></td>
          <td width="1" style="width:0.75pt;padding:0in"></td>
          <td width="209" style="width:156.75pt;padding:0in"></td>
          <td width="12" style="width:9pt;padding:0in"></td>
          <td width="61" style="width:45.75pt;padding:0in"></td>
          <td width="11" style="width:8.25pt;padding:0in"></td>
          <td width="12" style="width:9pt;padding:0in"></td>
          <td width="30" style="width:22.5pt;padding:0in"></td>
          <td width="50" style="width:37.5pt;padding:0in"></td>
          <td width="12" style="width:9pt;padding:0in"></td>
          <td width="73" style="width:54.75pt;padding:0in"></td>
          <td width="1" style="width:0.75pt;padding:0in"></td>
          <td width="11" style="width:8.25pt;padding:0in"></td>
          <td width="47" style="width:35.25pt;padding:0in"></td>
          <td width="17" style="width:12.75pt;padding:0in"></td>
          <td width="9" style="width:6.75pt;padding:0in"></td>
          <td width="3" style="width:2.25pt;padding:0in"></td>
          <td width="9" style="width:6.75pt;padding:0in"></td>
          <td width="82" style="width:61.5pt;padding:0in"></td>
          <td width="12" style="width:9pt;padding:0in"></td>
          <td width="83" style="width:62.25pt;padding:0in"></td>
          <td width="12" style="width:9pt;padding:0in"></td>
          </tr>
          </tbody></table>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
          en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:black"><img src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_mpls_avanzado_con_componente_datacenter_claro.png" width="880" height="533"></span><span lang="ES-CO"><span></span></span></p>
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
          contactar a:<span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
          <table class="m_3929576187344687846gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
          <tbody><tr style="height:29.05pt">
          <td width="226" colspan="3" valign="top" style="width:169.7pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0in 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0in 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white">
            <hr size="2" width="100%" align="center">
          </span></b></div>
          <p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          </td>
          </tr>
          <tr style="height:14.3pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0in 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
          </td>
          </tr>
          <tr style="height:14.3pt">
          <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0in 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
          </td>
          <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1'] . '</span></span></b></p>
          </td>
          </tr>
          <tr style="height:12.5pt">
          <td width="151" colspan="2" valign="top" style="width:113pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0in 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0in 0in 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
            Contacto:<span></span></span></b></p>
          </td>
          <td width="161" colspan="2" valign="top" style="width:120.5pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
            <p class="MsoNormal" style="margin:0in 0in 6pt 0.25in;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
            <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
            <p class="MsoNormal" style="margin:0in 0in 6pt 0.25in;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
          </td>
          </tr>
          <tr style="height:12.5pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0in 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
          </td>
          </tr>
          <tr style="height:12.5pt">
          <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0in 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
            <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2'] . '</span></span></b></p>
          </td>
          </tr>
          <tr style="height:12.5pt">
          <td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0in 5.4pt;height:12.5pt">
            <p class="MsoNormal" style="margin:0in 0in 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
              Contacto:<span></span></span></b></p>
            </td>
            <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
              <p class="MsoNormal" style="margin:0in 0in 6pt 0.25in;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
            </td>
            <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
              <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
            </td>
            <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
              <p class="MsoNormal" style="margin:0in 0in 6pt 0.25in;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
            </td>
          </tr>
          <tr style="height:12.5pt">
            <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0in 5.4pt;height:12.5pt">
              <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
            </td>
          </tr>
          <tr style="height:12.5pt">
            <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0in 5.4pt;height:12.5pt">
              <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
            </td>
            <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0in;height:12.5pt">
              <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3'] . '</span></span></b></p>
            </td>
          </tr>
          <tr style="height:12.5pt">
            <td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0in 5.4pt;height:12.5pt">
              <p class="MsoNormal" style="margin:0in 0in 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
                Contacto:<span></span></span></b></p>
              </td>
              <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0in;height:12.5pt">
                <p class="MsoNormal" style="margin:0in 0in 6pt 0.25in;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
              </td>
              <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0in;height:12.5pt">
                <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
              </td>
              <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0in;height:12.5pt">
                <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
              </td>
            </tr>
            </tbody></table><div class="yj6qo"></div><div class="adL">
          <br></div></div>

          ';
    }

//
    public function mpls_transaccional_3g($argumentos) {

        return '

          <div dir="ltr"><div class="adM">
          </div>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
          Servicio &nbsp;<b><span style="color:rgb(31,73,125)">' . $argumentos['servicio'] . '</span></b><span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
          los datos de contacto del Ingeniero encargado de la implementación de su
          servicio. Es de suma importancia que sea revisado y nos retroalimente la
          información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
          dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
          contenida en este documento es importante que nos haga llegar sus inquietudes
          ya que el servicio contratado será entregado de acuerdo a la información que
          describimos a continuación. <span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:black"><img width="996" height="506" src="' . URL::base() . '/assets/img/mail_formats/mpls_transaccional_solucion_3g.png"></span></p>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b>' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
          instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
          detalla la secuencia de actividades para llevar a cabo la instalación del
          servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span><img  src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"  width="717" height="453"></span><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>
          <table class="m_-1356499913992082838gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
          <tbody><tr style="height:29.05pt">
          <td width="189" valign="top" style="width:141.7pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="746" colspan="20" valign="top" style="width:559.85pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:29.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:8.05pt">
          <td width="189" style="width:141.7pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS
          TRANSACCIONAL 3G<span></span></span></b></p>
          </td>
          <td width="746" colspan="20" valign="top" style="width:559.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
          LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
          segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:8.05pt">
          <td width="189" rowspan="14" style="width:141.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:8.05pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
          </td>
          <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
          </td>
          <td width="194" colspan="7" valign="top" style="width:145.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['existente'] . '</span></span></b></p>
          </td>
          <td width="53" colspan="2" valign="top" style="width:39.75pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
          </td>
          <td width="215" colspan="7" valign="top" style="width:161.4pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['nuevo'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:8pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['ancho_banda'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:16.45pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:16.4pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
          </td>
          <td width="347" colspan="13" valign="top" style="width:260.5pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['fecha_servicio'] . '</span></span></p>
          </td>
          <td width="189" colspan="5" valign="top" style="width:141.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
          necesarias para la instalación<span style="color:black"><span></span></span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:16.4pt">
          <td width="746" colspan="20" valign="top" style="width:559.85pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
          LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:8.45pt">
          <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.7pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
          del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
          </td>
          <td width="177" colspan="6" valign="top" style="width:132.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" valign="top" style="width:134.45pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.45pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:8.35pt">
          <td width="177" colspan="6" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.45pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
          confirme Horarios)<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:8.35pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:5.8pt">
          <td width="177" colspan="6" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:5.8pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:12.25pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
          Existencia de las siguientes condiciones:<span></span></span></i></b></p>
          </td>
          <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
          </td>
          <td width="92" colspan="3" valign="top" style="width:69.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
          </td>
          <td width="76" colspan="4" valign="top" style="width:57.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="103" colspan="4" valign="top" style="width:77.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
          equipos:<span></span></span></b></p>
          </td>
          <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:12.25pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:17.65pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.65pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:17.65pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr style="height:17.6pt">
          <td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la configuración
          de rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
          </td>
          <td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.6pt">
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
          </td>
          <td width="12" style="width:9pt;padding:0cm;height:17.6pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
          </td>
          </tr>
          <tr>
          <td width="189" style="width:141.7pt;padding:0cm"></td>
          <td width="1" style="width:1pt;padding:0cm"></td>
          <td width="221" colspan="2" style="width:165.8pt;padding:0cm"></td>
          <td width="61" style="width:46.05pt;padding:0cm"></td>
          <td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
          <td width="92" colspan="3" style="width:69.05pt;padding:0cm"></td>
          <td width="85" colspan="3" style="width:63.75pt;padding:0cm"></td>
          <td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="94" colspan="2" style="width:70.45pt;padding:0cm"></td>
          <td width="95" colspan="2" style="width:71.2pt;padding:0cm"></td>
          </tr>
          <tr>
          <td width="189" style="width:141.7pt;padding:0cm"></td>
          <td width="1" style="width:1pt;padding:0cm"></td>
          <td width="209" style="width:156.7pt;padding:0cm"></td>
          <td width="12" style="width:9.1pt;padding:0cm"></td>
          <td width="61" style="width:46.05pt;padding:0cm"></td>
          <td width="11" style="width:8.3pt;padding:0cm"></td>
          <td width="12" style="width:9.25pt;padding:0cm"></td>
          <td width="30" style="width:22.5pt;padding:0cm"></td>
          <td width="50" style="width:37.45pt;padding:0cm"></td>
          <td width="12" style="width:9.1pt;padding:0cm"></td>
          <td width="73" style="width:54.75pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="47" style="width:35.25pt;padding:0cm"></td>
          <td width="17" style="width:13pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="3" style="width:2.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="82" style="width:61.45pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="83" style="width:62.2pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          </tr>
          <tr>
          <td width="189" style="width:5cm;padding:0cm"></td>
          <td width="1" style="width:0.75pt;padding:0cm"></td>
          <td width="209" style="width:156.75pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="61" style="width:45.75pt;padding:0cm"></td>
          <td width="11" style="width:8.25pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="30" style="width:22.5pt;padding:0cm"></td>
          <td width="50" style="width:37.5pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="73" style="width:54.75pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="6" style="width:4.5pt;padding:0cm"></td>
          <td width="47" style="width:35.25pt;padding:0cm"></td>
          <td width="17" style="width:12.75pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="3" style="width:2.25pt;padding:0cm"></td>
          <td width="9" style="width:6.75pt;padding:0cm"></td>
          <td width="82" style="width:61.5pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          <td width="83" style="width:62.25pt;padding:0cm"></td>
          <td width="12" style="width:9pt;padding:0cm"></td>
          </tr>
          </tbody></table>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
          en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:black"><img  src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_mpls_transaccional_3g.png"  width="979" height="546"></span></p>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
          contactar a:<span></span></span></p>
          <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
          <table class="m_-1356499913992082838gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
          <tbody><tr style="height:29.05pt">
          <td width="226" colspan="3" valign="top" style="width:169.7pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          </td>
          <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
          <hr size="2" width="100%" align="center">
          </span></b></div>
          <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
          </td>
          </tr>
          <tr style="height:14.3pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
          </td>
          </tr>
          <tr style="height:14.3pt">
          <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
          </td>
          <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1'] . '</span></span></b></p>
          </td>
          </tr>
          <tr style="height:12.5pt">
          <td width="151" colspan="2" valign="top" style="width:113pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="161" colspan="2" valign="top" style="width:120.5pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
          </td>
          </tr>
          <tr style="height:12.5pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
          </td>
          </tr>
          <tr style="height:12.5pt">
          <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2'] . '</span></span></b></p>
          </td>
          </tr>
          <tr style="height:12.5pt">
          <td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
          </td>
          </tr>
          <tr style="height:12.5pt">
          <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          </tr>
          <tr style="height:12.5pt">
          <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
          </td>
          <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3'] . '</span></span></b></p>
          </td>
          </tr>
          <tr style="height:12.5pt">
          <td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
          Contacto:<span></span></span></b></p>
          </td>
          <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
          </td>
          <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
          </td>
          <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
          <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
          </td>
          </tr>
          <tr>
          <td width="149" style="width:111.75pt;padding:0cm"></td>
          <td width="2" style="width:1.5pt;padding:0cm"></td>
          <td width="76" style="width:57pt;padding:0cm"></td>
          <td width="85" style="width:63.75pt;padding:0cm"></td>
          <td width="66" style="width:49.5pt;padding:0cm"></td>
          <td width="217" style="width:162.75pt;padding:0cm"></td>
          </tr>
          </tbody></table>
          <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p><div class="yj6qo"></div><div class="adL">
          <br></div></div>

          ';

    }

    /*--**************************************************************PLANTILLA CORREO KICKOFF 15 DIAS***********************************************************************--*/

    //correo para kick of 15 dias
    public function correo_ko_15_dias($argumentos) {
        return
            '<div class=""><div class="aHl"></div><div id=":m2" tabindex="-1"></div><div id=":md" class="ii gt"><div id=":me" class="a3s aXjCH m164fc5b537463e95"><div dir="ltr"><div class="adM">
              </div><p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">Cordial Saludo Señores,<span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><b><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">' . $argumentos['nombre'] . '<span></span></span></b></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">Comprometidos
              con el servicio y el cumplimiento de sus solicitudes me permito notificar los
              avances de los asuntos en curso.</span><span lang="ES-CO" style="color:windowtext"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">Es de suma
              importancia que sea revisado y nos retroalimente con sus comentarios, ya que al
              término de 2 días hábiles este reporte se dará por aceptado.</span><span lang="ES-CO" style="color:windowtext"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">&nbsp;</span><b><u><span lang="ES-CO" style="font-family:Garamond,serif">OTS
              ' . $argumentos['ots_nombre'] . ' – AMPLIACIÓN ENLACES ' . $argumentos['ampliacion_enlaces'] . ' A 200M</span></u></b><span lang="ES-CO" style="font-size:11pt;color:windowtext"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Garamond,serif">Dirección de servicio: ' . $argumentos['direccion_servicio'] . '</span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif">&nbsp;</span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><b><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">SERVICIO
              ' . $argumentos['servicio'] . '</span></b><span lang="ES-CO" style="color:windowtext"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">Visita Obra Civil: ' . $argumentos['vista_obra_civil'] . ' </span><span lang="ES-CO" style="color:windowtext"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">Envió Cotización Obra Civil: ' . $argumentos['envio_cotizacion_obra_civil'] . '</span><span lang="ES-CO" style="color:windowtext"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">Aprobación Cotización Obra Civil: ' . $argumentos['aprobacion_cotizacion_obra_civil'] . '</span><span lang="ES-CO" style="color:windowtext"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">Ejecución de Obra Civil: ' . $argumentos['ejecucion_obra_civil'] . '</span><span lang="ES-CO" style="color:windowtext"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">Empalmes: ' . $argumentos['empalmes'] . '</span><span lang="ES-CO" style="color:windowtext"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">Configuración: ' . $argumentos['configuracion'] . '</span><span lang="ES-CO" style="color:windowtext"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">Equipos: ' . $argumentos['equipos_intalar_camp1'] . '</span><span lang="ES-CO" style="color:windowtext"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif;color:windowtext">Entrega del servicio: ' . $argumentos['entrega_servicio'] . '</span><span lang="ES-CO" style="color:windowtext"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO">&nbsp;<span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span>&nbsp;</span><b><span lang="ES-CO" style="font-family:Arial,sans-serif">Nivel de Contacto 1:</span></b><span lang="ES-CO" style="font-family:Arial,sans-serif"> Para cualquier duda o
              inquietud sobre el proceso de instalación en Curso.</span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><b><span lang="ES-CO" style="font-family:Arial,sans-serif">Ingeniero
              Implementación Responsable Cuenta:</span></b><span lang="ES-CO" style="font-family:Arial,sans-serif"> </span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif">' . $argumentos['ingeniero1'] . '</span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif">Ingeniero
              Aprovisionamiento Estándar</span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif">Celular: ' . $argumentos['ingeniero1_tel'] . '</span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><b><span lang="ES-CO" style="font-family:Arial,sans-serif">Correo
              electrónico:</span></b><span lang="ES-CO"> </span><span class="m_4874063169434878239gmail-MsoHyperlink" style="color:blue;text-decoration:underline"><b><span lang="ES-CO" style="font-family:Arial,sans-serif"><a href="' . $argumentos['ingeniero1_email'] . '" style="color:blue;text-decoration:underline" target="_blank">' . $argumentos['ingeniero1_email'] . '</a></span></b></span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Calibri,sans-serif">&nbsp;</span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><b><span lang="ES-CO" style="font-family:Arial,sans-serif">&nbsp;Nivel
              de Contacto 2: En caso de que no se obtenga respuesta por parte del Nivel de
              Contacto 1.</span></b><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><b><span lang="ES-CO" style="font-family:Arial,sans-serif">Coordinador
              Estándar: </span></b><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif">Alejandra
              Rendon Calderon &nbsp;</span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif">Teléfono.
              7569858 Ext &nbsp;2008</span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif">Correo
              electrónico</span><span lang="ES-CO">: </span><span class="m_4874063169434878239gmail-MsoHyperlink" style="color:blue;text-decoration:underline"><b><span lang="ES-CO" style="font-family:Arial,sans-serif"><a href="mailto:alejandra.rendon.ext@claro.com.co" style="color:blue;text-decoration:underline" target="_blank">alejandra.rendon.ext@claro.<wbr>com.co</a></span></b></span><span lang="ES-CO" style="color:rgb(31,73,125)"> </span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO">&nbsp;<span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><b><span lang="ES-CO" style="font-family:Arial,sans-serif">Nivel
              de Contacto 3: En caso de que no se obtenga respuesta por parte del Nivel de
              Contacto 2.</span></b><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><b><span lang="ES-CO" style="font-family:Arial,sans-serif">Ingeniero
              Implementación Claro: </span></b><span lang="ES-CO" style="font-family:Arial,sans-serif">Vivian
              Rodriguez</span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif">Ingeniero
              Aprovisionamiento Estándar</span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif">Celular:
              3138892717</span><span lang="ES-CO"><span></span></span></p>

              <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:12pt;font-family:&quot;Times New Roman&quot;,serif;color:black"><span lang="ES-CO" style="font-family:Arial,sans-serif">Correo
              electrónico:</span><span lang="ES-CO" style="color:rgb(31,73,125)"> </span><span class="m_4874063169434878239gmail-MsoHyperlink" style="color:blue;text-decoration:underline"><b><span lang="ES-CO" style="font-family:Arial,sans-serif"><a href="mailto:vivian.rodriguez@claro.com.co" style="color:blue;text-decoration:underline" target="_blank">vivian.rodriguez@claro.com.co</a></span></b></span><span lang="ES-CO"><span></span></span></p><div class="yj6qo"></div><div class="adL">

              <br></div></div><div class="adL">
              </div></div></div><div id=":ly" class="ii gt" style="display:none"><div id=":lx" class="a3s aXjCH undefined"></div></div><div class="hi"></div></div>';

    }

    /************************************************************************ FIN PLANTILLA ******************************************************************************************/
    //cuerpo del correo del modal hitos

}
