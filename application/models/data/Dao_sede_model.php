<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_sede_model extends CI_Model {

    protected $session;

    public function __construct() {
        
    }

    // Retorna los datos de las sedes 
    public function getListoffices_Table() {
        $query = $this->db->query("

                SELECT id_sede, nombre_sede, ciudad, departamento, direccion, clasificacion, tipo_oficina 
                FROM sede;
           ");
        return $query->result();
    }


    // Retorna los datos de los OTP 
    public function c_getListOTP_Table() {
        $query = $this->db->query("
                SELECT s.nombre_sede, otp.id_sede, otp.k_id_ot_padre, otp.n_nombre_cliente, otp.orden_trabajo, 
                otp.servicio, otp.estado_orden_trabajo 
                FROM ot_padre otp
                INNER JOIN sede s 
                ON otp.id_sede = s.id_sede
                ;              
           ");
        return $query->result();
    }

    // Retorna los datos de la tabla de control de cambio (Modulo Control de Cambio)
    public function c_getListAllCC_Table() {
        $query = $this->db->query("
                SELECT cc.id_ot_padre, resp.nombre_responsable,
                cs.nombre_causa, cc.numero_control, cc.fecha_compromiso,
                cc.fecha_programacion_inicial, cc.nueva_fecha_programacion,
                cc.narrativa_escalamiento, cc.estado_cc, cc.observaciones_cc,
                cc.faltantes, cc.en_tiempos, cc.fecha_creacion_cc
                FROM control_cambios cc
                INNER JOIN responsable_cc resp
                ON cc.id_responsable= resp.id_responsable
                INNER JOIN causa_cc cs
                ON cc.id_causa= cs.id_causa
                ;              
           ");
        return $query->result();
    }

}

