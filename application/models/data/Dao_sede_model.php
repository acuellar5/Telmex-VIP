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

}

