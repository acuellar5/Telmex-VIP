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

    //retorna los tipos de ot hija que tiene una otp por id de usuario
    public function get_types_by_iduser_otp($otp, $iduser){
        $query = $this->db->query("
                SELECT 
                oth.id_orden_trabajo_hija, oth.nro_ot_onyx, e.k_id_tipo, t.n_name_tipo
                FROM 
                ot_hija oth
                INNER JOIN 
                ot_padre otp
                ON oth.nro_ot_onyx = otp.k_id_ot_padre 
                INNER JOIN 
                estado_ot e 
                ON oth.k_id_estado_ot = e.k_id_estado_ot 
                INNER JOIN 
                tipo_ot_hija t 
                ON e.k_id_tipo = t.k_id_tipo 
                WHERE 
                otp.k_id_user = '$iduser' AND 
                oth.nro_ot_onyx = '$otp' 
                GROUP BY t.n_name_tipo  
            ");
        return $query->result();
    }




}

?>
