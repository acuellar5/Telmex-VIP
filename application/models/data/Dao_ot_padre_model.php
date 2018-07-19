<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_ot_padre_model extends CI_Model {

	protected $session;

	public function __construct() {
	}

	// Retorna registro otp por id de ot padre
	public function exist_otp_by_id($id){
		$query = $this->db->query("
				SELECT 
				k_id_ot_padre 
				FROM 
				ot_padre
				WHERE
				k_id_ot_padre = $id
			");
		return $query->row();
	}

	// Inserta datos a la tabla otp
	public function insert_data_otp($data_otp){
		$this->db->insert('ot_padre', $data_otp);
	}

	// Actualiza ot padre
	public function update_ot_padre($data, $id_otp){
		$this->db->where('k_id_ot_padre', $id_otp);
        $this->db->update('ot_padre', $data);
        // $this->db->last_query();
        $error = $this->db->error();
        if ($error['message']) {
            // print_r($error);
            return $error;
        } else {
            return 1;
        }
	}

	// Retorna ots de ingenieros sin estado cancelada, cerrada ni terminada
	public function get_otp_by_id_user($id){
		$query = $this->db->query("
				SELECT 
				k_id_ot_padre, estado_orden_trabajo  
				FROM 
				ot_padre
				WHERE
				k_id_user = '$id' AND 
				estado_orden_trabajo != 'otp_cerrada'
			");
		return $query->result();
	}
	  
}
