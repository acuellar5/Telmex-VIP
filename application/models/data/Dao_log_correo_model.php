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

    // Obtiene datos de log_correo por id ot hija
    public function getLogMailById($id){
    	// $query = $this->db->order_by('k_id_tipo ASC, i_orden ASC');
    	$query = $this->db->get_where('log_correo', array('id_orden_trabajo_hija' => $id));
//        echo $this->db->last_query();
    	return $query->result();
    }






  
}
