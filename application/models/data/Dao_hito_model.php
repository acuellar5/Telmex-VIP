<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_hito_model extends CI_Model {

    public function __construct() {

    }

    // Inserta informacion a tabla de linea base
    public function insert_linea_base($data) {
        if ($this->db->insert('linea_base', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

	// retorna hito segun su otpadre... pueden pasar varias otp 
	public function get_hito_by_otps($otps){
		$query = $this->db->select('*')
                    ->from('hitos')
                    ->where_in('id_ot_padre', $otps)
                    ->get();

        return $query->result();
	}

	// Eliminar hitos segun su ot_padre
	public function eliminar_hito($otps){
		$this->db->where_in('id_ot_padre', $otps);
        $this->db->delete('hitos');
        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 0;
        }
	}

}

