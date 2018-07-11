<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_tipo_ot_hija_model extends CI_Model {

    protected $session;

    public function __construct() {
        $this->load->model('dto/TipoOtHijaModel');
    }

    public function getAll() {
        try {
            $tipoOtHija = new TipoOtHijaModel();
            $datos = $tipoOtHija->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getIdTypeByNameType($nombreTipo) {
        try {
            $db = new DB();
            $sql = "SELECT 
                    n_name_tipo,
                    CASE
                        WHEN i_referencia IS NULL THEN k_id_tipo
                        ELSE i_referencia
                    END AS id_tipo
                    FROM tipo_ot_hija WHERE n_name_tipo = '$nombreTipo'";
            $data = $db->select($sql)->get();
//            echo $db->getSql();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($data);
            return $data;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    public function getAllNameType() {
        try {
            $db = new DB();
            $sql = "SELECT n_name_tipo, k_id_tipo
                    FROM tipo_ot_hija";
            $data = $db->select($sql)->get();
//            echo $db->getSql();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($data);
            return $data;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    //
    public function get_tipo_ot_hija_by_name($nombreTipo){
        $query = $this->db->query("
                    SELECT 
                    n_name_tipo,
                    CASE
                        WHEN i_referencia IS NULL THEN k_id_tipo
                        ELSE i_referencia
                    END AS id_tipo
                    FROM tipo_ot_hija WHERE n_name_tipo = '$nombreTipo'"
                );
        return $query->row();

    }

    // Inserta un nuevo tipo a la tabla tipo_ot_hija
    public function insert_new_type($data){
        if ($this->db->insert('tipo_ot_hija',$data)) {
            return $this->db->insert_id();
        }else {
            return false;
        }
        
    }

    // retorna listado de los tipos originales existentes
    public function get_list_types(){
        $query = $this->db->get_where('tipo_ot_hija', array('i_referencia'=>null));
        return $query->result();
    }




}

?>
