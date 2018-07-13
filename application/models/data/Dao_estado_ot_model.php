<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_estado_ot_model extends CI_Model {

    protected $session;

    public function __construct() {
        $this->load->model('dto/EstadoOtModel');
    }

    public function getAll() {
        try {
            $estadoOt = new EstadoOtModel();
            $datos = $estadoOt->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getStatusByTypeOtAndStatusName($idTipo, $estadoNombre1, $estadoNombre2) {
        try {
            $db = new DB();
            $sql = "SELECT * FROM estado_ot WHERE k_id_tipo = $idTipo AND 
                    (n_name_estado_ot = '$estadoNombre1' OR n_name_estado_ot = '$estadoNombre2')";
            $data = $db->select($sql)->get();
//            echo $db->getSql();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($data);
            return $data;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    // Retorna un registro buscado por idtipo y nombre de estado
    public function get_status_by_idtipo_and_name_status($idTipo, $nombre){
        $query = $this->db->query("
            SELECT * 
            FROM estado_ot 
            WHERE 
            k_id_tipo = $idTipo 
            AND 
            (
                n_name_estado_ot = '$nombre' 
            );"
        );
        return $query->row();

    }

    //retorna a js los estados segun id de tipo
    public function m_getStatusByType($idtipo){
        $query = $this->db->order_by('k_id_tipo ASC, i_orden ASC');
        $query = $this->db->get_where('estado_ot', array('k_id_tipo'=>$idtipo));
        return $query->result();
    }

    //trae el nombre del estado por su id
    public function getNameStatusById($id){
        $query = $this->db->query("
                SELECT 
                n_name_estado_ot 
                FROM
                estado_ot 
                WHERE
                k_id_estado_ot = $id
            ");
        return $query->row()->n_name_estado_ot;
    }

    //
    public function getStatusByTypeAndStatusName($id_tipo, $name_status){
        $query = $this->db->query("
                    SELECT 
                    * 
                    FROM 
                    estado_ot e

                    INNER JOIN tipo_ot_hija t
                    ON e.k_id_tipo = t.k_id_tipo

                    WHERE 
                    t.k_id_tipo = '$id_tipo' AND
                    e.n_name_estado_ot = '$name_status'
                    ;
            ");
        // print_r($this->db->last_query());
        return $query->row();
    }

    //Inserta en la tabla estado_ot nuevos estados
    public function insert_new_status($data){
        if ($this->db->insert('estado_ot',$data)) {
            return $this->db->insert_id();;
        }else {
            return false;
        }
    }
    
    public function updateStatusById($orden, $id){
        $sql = "UPDATE estado_ot 
                SET i_orden = $orden
                WHERE k_id_estado_ot = $id";
        if ($this->db->query($sql)) {
            return true;
        }else {
            return false;
        }
    }

}

?>
