<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_sede_model extends CI_Model {

    protected $session;

    public function __construct() {
        
    }

    // Retorna los datos de las sedes 
    public function getListoffices_Table() {
        $query = $this->db->query("
                SELECT s.id_sede, 
                s.nombre_sede, 
                s.ciudad, 
                s.departamento, 
                s.direccion, 
                s.clasificacion, 
                s.tipo_oficina,
                    (
                        SELECT COUNT(1) 
                        FROM 
                        control_cambios cc
                        INNER JOIN ot_padre otp 
                        ON cc.id_ot_padre = otp.k_id_ot_padre
                        Where s.id_sede = otp.id_sede
                    ) AS num_ctrl_camb, 
                    (
                        SELECT COUNT(1) FROM ot_padre otpa 
                        WHERE otpa.id_sede = s.id_sede
                    ) AS cant_otp 
                FROM sede s
           ");
        return $query->result();
    }


    // Retorna los datos de los OTP 
    public function c_getListOTP_Table() {
        $query = $this->db->query("
                SELECT s.nombre_sede, 
                otp.id_sede, 
                otp.k_id_ot_padre, 
                otp.n_nombre_cliente, 
                otp.orden_trabajo , 
                otp.servicio, 
                otp.estado_orden_trabajo,
                (
                    SELECT COUNT(*) FROM control_cambios cc
                    WHERE cc.id_ot_padre = otp.k_id_ot_padre
                ) AS num_ctrl

                FROM ot_padre otp
                INNER JOIN sede s 
                ON otp.id_sede = s.id_sede 
           ");
        return $query->result();
    }

    // Retorna los datos de la tabla de control de cambio (Modulo Control de Cambio)
    public function c_getListAllCC_Table() {
        $query = $this->db->query("
                SELECT CONCAT('ZCC',cc.id_control_cambios) As id_control_cambios, cc.id_ot_padre, resp.nombre_responsable,
                cs.nombre_causa, cc.numero_control, cc.fecha_compromiso,
                cc.fecha_programacion_inicial, cc.nueva_fecha_programacion,
                cc.narrativa_escalamiento, cc.estado_cc, cc.observaciones_cc,
                cc.faltantes, cc.en_tiempos, cc.fecha_creacion_cc, s.nombre_sede
                FROM control_cambios cc
                INNER JOIN responsable_cc resp
                ON cc.id_responsable= resp.id_responsable
                INNER JOIN causa_cc cs
                ON cc.id_causa= cs.id_causa
                INNER JOIN ot_padre otp 
                ON cc.id_ot_padre = otp.k_id_ot_padre
                INNER JOIN sede s 
                ON otp.id_sede = s.id_sede  
                ;              
           ");
        return $query->result();
    }

    // Retorna el listados de nombres y ids de las sedes 
    public function get_list_sedes(){
        $query = $this->db->select('id_sede, nombre_sede')
                            ->order_by('nombre_sede', 'ASC')
                            ->get('sede');

        return $query->result();

    }

    // Retorna el listado de ot padres que tienen sede
    public function get_list_otps_sedes(){
        $query = $this->db
                    ->select('k_id_ot_padre')
                    ->join('sede s', 'otp.id_sede = s.id_sede', 'inner')
                    ->get('ot_padre otp');
        return $query->result();

    }

    // selecciona otp por id o ids de sedes 
    public function get_ots_by_idsede($ots){
        $query = $this->db
                    ->select('k_id_ot_padre')
                    ->where_in('id_sede', $ots)
                    ->get('ot_padre');


        return $query->result();

    }

}

