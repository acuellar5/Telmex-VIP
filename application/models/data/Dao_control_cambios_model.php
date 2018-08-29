<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_control_cambios_model extends CI_Model {

	public function __construct(){

	}

	// Retorna un array con la lista de responsables de la tabla responsable_cc
	public function getAllResponsable(){
		$query = $this->db->get('responsable_cc');
		return $query->result();
	}

	// Retorna un array con la lista de todas las causas de la tabla causa_cc
	public function getAllCausa(){
		$query = $this->db->get('causa_cc');
		return $query->result();	
	}

	// Inserta nuevo registrpo en tabla control de cambios
	public function insert_control_cambios($data){
		if ($this->db->insert('control_cambios', $data)) {
			return true;
		} else {
			return false;
		}
	}


}