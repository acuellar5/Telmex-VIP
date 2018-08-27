<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_user_model extends CI_Model {

    protected $session;

    public function __construct() {
        // $this->load->model('dto/UserModel');
    }

    public function getAll() {
        try {
            $user = new UserModel();
            $datos = $user->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getAllEngineers() {
        try {
            $db = new DB();
            $sql = "SELECT UPPER(CONCAT(n_name_user, ' ', n_last_name_user)) ingenieros
                FROM user WHERE n_role_user = 'ingeniero'";
            $data = $db->select($sql)->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($data);
            return $data;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    // Retorna un array con el listado de los ingenieros array = ['pepitp perez', 'alan brito delgado'....]
    public function getArrayAllEngineers(){
        $query = $this->db->query("
                SELECT 
                CONCAT(n_name_user, ' ', n_last_name_user) AS name, 
                k_id_user AS id
                FROM user WHERE n_role_user = 'ingeniero'
            ");
        $ingenieros = [];
        for ($i=0; $i < count($query->result_array()); $i++) { 
            $ingenieros[$i]['name'] = $query->result_array()[$i]['name'];
            $ingenieros[$i]['id'] = $query->result_array()[$i]['id'];
        }
        return $ingenieros;
    }

    //trae el usuario donde el usuario sea la concatenacion de nombre y apellido
    public function get_user_by_concat_name($name_lastname){
        $query = $this->db->query("
                SELECT k_id_user
                FROM 
                user 
                WHERE CONCAT_WS(' ', n_name_user, n_last_name_user) 
                LIKE '%$name_lastname';
            ");
        return $query->row();
    }
    // retorna lista de ingenieros
    public function fill_with_eingenieer(){
        $query =$this->db->query("    
                SELECT 
                CONCAT(n_name_user, ' ', n_last_name_user) AS nombre, 
                n_mail_user AS mail, 
                cell_phone AS telefono  
                FROM user
                WHERE 
                n_role_user = 'ingeniero' AND n_group = 'GESTION OTS ESTANDAR';                        
                                ");
        return $query->result();
    }

    // retorna ingenieros con ots asignadas
    public function get_eng_trabajanding(){
        $query = $this->db->query("
                    SELECT 
                    DISTINCT otp.k_id_user, CONCAT(u.n_name_user, ' ', u.n_last_name_user) AS nombre
                    FROM 
                    ot_padre otp
                    INNER JOIN
                    user u
                    ON u.k_id_user = otp.k_id_user
                ;");
        return $query->result();
    }


}
