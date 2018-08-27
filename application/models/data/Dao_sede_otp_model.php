<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_sede_otp_model extends CI_Model {

    protected $session;

    public function __construct() {
        
    }

    // Retorna registro otp por id de ot padre
    public function exist_otp_by_id($id) {
        $query = $this->db->query("
                SELECT sede, ciudad, departamento, direccion, clasificacion, tipo_oficina FROM sede;
            ");
        return $query->row();
    }
}

