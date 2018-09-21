<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_hito_model extends CI_Model {

	public function __construct(){

	}

	// Inserta informacion a tabla de linea base
	public function insert_linea_base($data){
		if ($this->db->insert('linea_base', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

}