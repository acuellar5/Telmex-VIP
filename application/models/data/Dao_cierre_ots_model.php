<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_cierre_ots_model extends CI_Model {

  	protected $session;

    public function __construct() {
        // $this->load->model('dto/UserModel');
    }


    // se trasladan todos los registros que tienen fecha anterior a la ultima update de data
    public function trasladar_oth($penultima){
        $this->db->query("
            INSERT INTO
                `telmex_vip`.`cierre_ots` (`id_orden_trabajo_hija`, `k_id_estado_ot`, `nro_ot_onyx`, `grupo_objetivo`, `segmento`, `nivel_atencion`, `ciudad`, `departamento`, `grupo`, `consultor_comercial`, `grupo2`, `consultor_postventa`, `proy_instalacion`, `ing_responsable`, `id_enlace`, `alias_enlace`, `familia`, `producto`, `tiempo_incidente`, `tiempo_estado`, `ano_ingreso_estado`, `mes_ngreso_estado`, `fecha_ingreso_estado`, `usuario_asignado`, `grupo_asignado`, `ingeniero_provisioning`, `cargo_arriendo`, `cargo_mensual`, `monto_moneda_local_arriendo`, `monto_moneda_local_cargo_mensual`, `cargo_obra_civil`, `descripcion`, `direccion_origen`, `ciudad_incidente`, `direccion_destino`, `ciudad_incidente3`, `fecha_realizacion`, `resolucion_1`, `resolucion_2`, `resolucion_3`, `resolucion_4`, `fecha_creacion_ot_hija`, `proveedor_ultima_milla`, `usuario_asignado4`, `resolucion_15`, `resolucion_26`, `resolucion_37`, `resolucion_48`, `ot_hija`, `estado_orden_trabajo_hija`, `fec_actualizacion_onyx_hija`, `tipo_trascurrido`, `fecha_insercion_zolid`, `fecha_actual`, `n_observacion_cierre`, `c_email`)

            SELECT
                `id_orden_trabajo_hija`, `k_id_estado_ot`, `nro_ot_onyx`, `grupo_objetivo`, `segmento`, `nivel_atencion`, `ciudad`, `departamento`, `grupo`, `consultor_comercial`, `grupo2`, `consultor_postventa`, `proy_instalacion`, `ing_responsable`, `id_enlace`, `alias_enlace`, `familia`, `producto`, `tiempo_incidente`, `tiempo_estado`, `ano_ingreso_estado`, `mes_ngreso_estado`, `fecha_ingreso_estado`, `usuario_asignado`, `grupo_asignado`, `ingeniero_provisioning`, `cargo_arriendo`, `cargo_mensual`, `monto_moneda_local_arriendo`, `monto_moneda_local_cargo_mensual`, `cargo_obra_civil`, `descripcion`, `direccion_origen`, `ciudad_incidente`, `direccion_destino`, `ciudad_incidente3`, `fecha_realizacion`, `resolucion_1`, `resolucion_2`, `resolucion_3`, `resolucion_4`, `fecha_creacion_ot_hija`, `proveedor_ultima_milla`, `usuario_asignado4`, `resolucion_15`, `resolucion_26`, `resolucion_37`, `resolucion_48`, `ot_hija`, `estado_orden_trabajo_hija`, `fec_actualizacion_onyx_hija`, `tipo_trascurrido`, `fecha_insercion_zolid`, `fecha_actual`, `n_observacion_cierre`, `c_email`
            FROM ot_hija
            WHERE fecha_actual <= '$penultima'
            ");
        return $this->db->affected_rows();
    }

    // trae las ots padre en cierre
    public function getOtpCierre(){
        $query = $this->db->query("
            SELECT
            otp.k_id_ot_padre, otp.n_nombre_cliente, otp.orden_trabajo, otp.servicio,
            REPLACE(otp.estado_orden_trabajo,'otp_cerrada','Cerrada') AS estado_orden_trabajo,
            otp.fecha_programacion, otp.fecha_compromiso, otp.fecha_creacion, otp.k_id_user,
            CONCAT(user.n_name_user, ' ' , user.n_last_name_user) AS ingeniero,
            otp.lista_observaciones, otp.observacion
            FROM cierre_ots c
            INNER JOIN ot_padre otp
            ON c.nro_ot_onyx = otp.k_id_ot_padre
            INNER JOIN user
            ON otp.k_id_user = user.k_id_user
            WHERE c.estado_zte = 'pendiente_cierre'
            GROUP BY nro_ot_onyx
            ORDER BY otp.k_id_user, c.k_id
        ");

        return $query->result();

    }

    // eLIMINA LOS REGISTROS DE TABLA CIERRE_OTP PASARLE LAS OTP EN UN ARRAY
    public function eliminar_registros($otp){
        $this->db->where_in('nro_ot_onyx', $otp);
        $this->db->delete('cierre_ots');
        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 0;
        }

    }


    // Cambia el estado de los registros a facturacion, enviarle ot(s) padre
    public function up_to_facturacion($otp, $data){
        $this->db->where_in('nro_ot_onyx', $otp);
        $this->db->update('cierre_ots', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 0;
        }

    }


    // obtiene la fecha de facturacion minima
    public function get_date_min_facturada(){
        $query = $this->db->query("
                    SELECT MIN(fecha_actual) as f_min
                    FROM
                    cierre_ots
                    WHERE
                    estado_zte = 'facturacion'
            ");
        return $query->row()->f_min;
    }

    // Elimina registros con ot_hijas duplicados y deja solo uno
    public function delete_duplicates(){
        $query = $this->db->query("
            DELETE n1
            FROM cierre_ots n1, cierre_ots n2
            WHERE n1.`id_orden_trabajo_hija` = n2.`id_orden_trabajo_hija`
            AND n1.`k_id` < n2.`k_id`;
        ");

        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 0;
        }


    }

    // Funcion para eliminar de cierre las ots que esten activas en oth
    public function delete_actives(){
        $query = $this->db->query("
            DELETE n1
            FROM cierre_ots n1, ot_hija n2
            WHERE n1.id_orden_trabajo_hija = n2.id_orden_trabajo_hija

        ");

        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 0;
        }

    }

    //retorna el detalle de cierre de una otp deacuerdo al tipo de servicio
    public function getDetailsCierreOTP($idOtp) {
        $query = $this->db->query("
            SELECT k_id_log_correo, servicio, k_id_ot_padre
            FROM log_correo
            WHERE k_id_ot_padre in ($idOtp)
            ORDER BY k_id_log_correo DESC
            LIMIT 1
        ");

        return $query->row();

    }

    //retorna la direecion de cierre de una otp dependiendo del servicio
    public function getDirServiceByOtp($idOtp, $servicio) {
        $tabla = '';
        $columWhere = 'id_ot_padre';
        $columQuery = 'direccion';

        switch ($servicio) {
            /* formulario Internet */
            case 'Internet Dedicado Empresarial':
            case 'Internet Dedicado ':
                $tabla = 'pr_internet';
                break;
            /* formulario MPLS */
            case 'MPLS Avanzado Intranet':
            case 'MPLS Avanzado Intranet - Varios Puntos':
            case 'MPLS Avanzado Intranet con Backup de Ultima Milla - NDS 2':
            case 'MPLS Avanzado Intranet con Backup de Ultima Milla y Router - NDS1':
            case 'MPLS Avanzado Extranet':
            case 'Backend MPLS ':
            case 'MPLS Avanzado con Componente Datacenter Claro':
            case 'MPLS Transaccional 3G':
                $tabla = 'pr_mpls';
                $columWhere = 'id_ot_padre_ori';
                $columQuery = 'direccion_des';
                break;
            /* FORMULARIO NOVEDADES */
            case '1Cambio de Equipos Servicio':
            case 'Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1':
            case 'Cambio de Servicio Telefonia Fija Pública Linea SIP a PBX Distribuida Linea SIP':
            case 'Cambio de Última Milla':
            case 'Cambio de Equipo':
                $tabla = 'pr_novedades';
                break;
            /* TRASLADO_EXTERNO */
            case 'Traslado Externo Servicio':
                $tabla = 'pr_traslado_externo';
                break;
            /* TRASLADO_INTERNO */
            case 'Traslado Interno Servicio':
                $tabla = 'pr_traslado_interno';
                break;
            /* PVX_ADMINISTRADA */
            case 'SOLUCIONES ADMINISTRATIVAS - COMUNICACIONES UNIFICADAS PBX ADMINISTRADA':
                $tabla = 'pr_pbx_administrada';
                break;
            /* TELEFONIA FIJA */
            case 'Instalación Servicio Telefonia Fija PBX Distribuida Linea E1':
            case 'Instalación Servicio Telefonia Fija PBX Distribuida Linea SIP':
            case 'Instalación Servicio Telefonia Fija PBX Distribuida Linea SIP con Gateway de Voz':
            case 'Instalación Telefonía Publica Básica - Internet Dedicado':
                $tabla = 'pr_telefonia_fija';
                break;

            /* NN HERFANITO */
            case 'Adición Marquillas Aeropuerto el Dorado Opain':

                break;
        }

        $query = $this->db->query("
            SELECT $columQuery AS dir FROM $tabla WHERE $columWhere = $idOtp
        ");

        return $query->row();
    }


}
