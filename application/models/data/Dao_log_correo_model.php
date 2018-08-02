<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_log_correo_model extends CI_Model {

  	protected $session;

    public function __construct() {
        // $this->load->model('dto/UserModel');
    }


    // Inserta un registro nuevo a la base de datos
    public function insert_data($data){
    	$this->db->insert('log_correo', $data);
    }






  
}
