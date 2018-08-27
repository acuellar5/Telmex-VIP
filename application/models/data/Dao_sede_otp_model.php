<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_sede_otp_model extends CI_Model {

    protected $session;

    public function __construct() {
        
    }

    // Retorna los datos de las sedes 
    public function getListoffices_Table() {
        $query = $this->db->query("
                SELECT nombre_sede, ciudad, departamento, direccion, clasificacion, tipo_oficina, id_sede
                FROM sede;
           ");
        return $query->result();
    }
}

