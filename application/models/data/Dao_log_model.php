<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_log_model extends CI_Model {

 	protected $session;

    public function __construct() {
    }

    // inserta en tabla Log todos los campos (hay q enviarle a data el arreglo ya creado)
    public function insertLogRow($data){
        //inserta el arreglo
        $this->db->insert('log', $data);
        // capturar error de insercion
        $error = $this->db->error();
        if ($error['message']) {
            print_r($error);
            return "error";
        }

    }

    //Retorna todo el historial de log de un id
    public function getLogById($id){
        $query = $this->db->get_where('log', array('id_ot_hija'=>$id));
        return $query->result();
    }


  
}
