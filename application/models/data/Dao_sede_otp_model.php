<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_sede_otp_model extends CI_Model {

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
    public function c_getListOTPTable() {
        $query = $this->db->query("
                SELECT k_id_ot_padre, n_nombre_cliente, orden_trabajo, servicio, estado_orden_trabajo 
                FROM ot_padre;               
           ");
        return $query->result();
    }

}

