<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_producto_model extends CI_Model {

	public function __construct(){

	}

	// insertar en pabla pr_internet
	public function insert_pr_internet($data){
		if ($this->db->insert('pr_internet', $data)) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

}