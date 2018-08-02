<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_ot_padre_model extends CI_Model {

    protected $session;

    public function __construct() {
        
    }

    // Retorna registro otp por id de ot padre
    public function exist_otp_by_id($id) {
        $query = $this->db->query("
				SELECT 
				k_id_ot_padre 
				FROM 
				ot_padre
				WHERE
				k_id_ot_padre = $id
			");
        return $query->row();
    }

    // Inserta datos a la tabla otp
    public function insert_data_otp($data_otp) {
        $this->db->insert('ot_padre', $data_otp);
    }

    // Actualiza ot padre
    public function update_ot_padre($data, $id_otp) {
        $this->db->where('k_id_ot_padre', $id_otp);
        $this->db->update('ot_padre', $data);
        // $this->db->last_query();
        $error = $this->db->error();
        if ($error['message']) {
            // print_r($error);
            return $error;
        } else {
            return 1;
        }
    }

    // Retorna ots de ingenieros sin estado cancelada, cerrada ni terminada
    public function get_otp_by_id_user($id) {
        $query = $this->db->query("
				SELECT 
				k_id_ot_padre, estado_orden_trabajo  
				FROM 
				ot_padre
				WHERE
				k_id_user = '$id' AND 
				estado_orden_trabajo != 'otp_cerrada'
		");
        return $query->result();
    }

    // tabla de lista de OTS Padre
    public function getListOtsOtPadre() {
        $condicion = "";
        if (Auth::user()->n_role_user == 'ingeniero') {
            $usuario_session = Auth::user()->k_id_user;
            $condicion = " AND otp.k_id_user = $usuario_session ";
        }
        $query = $this->db->query("
				SELECT otp.k_id_ot_padre, otp.n_nombre_cliente, otp.orden_trabajo, 
				otp.servicio, REPLACE(otp.estado_orden_trabajo,'otp_cerrada','Cerrada') AS estado_orden_trabajo, otp.fecha_programacion, 
				otp.fecha_compromiso, otp.fecha_creacion, otp.k_id_user, user.n_name_user,
				CONCAT(user.n_name_user, ' ' , user.n_last_name_user) AS ingeniero,
                                otp.lista_observaciones, otp.observacion
				FROM ot_padre otp
				INNER JOIN user ON otp.k_id_user = user.k_id_user
                                $condicion
    	");
        return $query->result();
    }

    // tabla que lista las OT Padre que tengan fecha de compromiso para hoy
    public function getListOtsOtPadreHoy() {
        $condicion = "";
        if (Auth::user()->n_role_user == 'ingeniero') {
            $usuario_session = Auth::user()->k_id_user;
            $condicion = " AND otp.k_id_user = $usuario_session ";
        }
        $query = $this->db->query("
				SELECT otp.k_id_ot_padre, otp.n_nombre_cliente, otp.orden_trabajo, 
				otp.servicio, REPLACE(otp.estado_orden_trabajo,'otp_cerrada','Cerrada') AS estado_orden_trabajo, otp.fecha_programacion, 
				otp.fecha_compromiso, otp.fecha_creacion, otp.k_id_user, user.n_name_user,
				CONCAT(user.n_name_user, ' ' , user.n_last_name_user) AS ingeniero,
                                otp.lista_observaciones, otp.observacion
				FROM ot_padre otp
				INNER JOIN user ON otp.k_id_user = user.k_id_user
                                WHERE otp.fecha_compromiso = CURDATE()
                                $condicion
    	");
        return $query->result();
    }

    // tabla que lista las OT Padre que tengan fecha de compromiso vencida
    public function getListOtsOtPadreVencidas() {
        $condicion = "";
        if (Auth::user()->n_role_user == 'ingeniero') {
            $usuario_session = Auth::user()->k_id_user;
            $condicion = " AND otp.k_id_user = $usuario_session ";
        }
        $query = $this->db->query("
				SELECT otp.k_id_ot_padre, otp.n_nombre_cliente, otp.orden_trabajo, 
				otp.servicio, REPLACE(otp.estado_orden_trabajo,'otp_cerrada','Cerrada') AS estado_orden_trabajo, otp.fecha_programacion, 
				otp.fecha_compromiso, otp.fecha_creacion, otp.k_id_user, user.n_name_user,
				CONCAT(user.n_name_user, ' ' , user.n_last_name_user) AS ingeniero,
                                otp.lista_observaciones, otp.observacion
				FROM ot_padre otp
				INNER JOIN user ON otp.k_id_user = user.k_id_user
                                WHERE otp.fecha_compromiso > CURDATE()
                                $condicion
    	");
    	return $query->result();
  }
  //Inserta la observaciones, usuario que lo hizo y fecha de la vista detalles  
  public function update_new_data($data){
        if (Auth::user()->n_role_user == 'administrador') {
            $this->db->where('k_id_ot_padre', $data['k_id_ot_padre']);
            $this->db->update('ot_padre', $data);
        }else{
            $this->db->where('k_id_user', Auth::user()->k_id_user);
            $this->db->where('k_id_ot_padre', $data['k_id_ot_padre']);
            $this->db->update('ot_padre', $data);
        }


        if ($this->db->affected_rows() > 0) {
            // print_r($this->db->last_query());
            return true;
        } else {
            // print_r($this->db->last_query());
            return false;
        }
  }

    // return $query->result();
    // trae otp segun opcion de ot padre
    public function getOtpByOpcList($opcion) {
        $condicion = "";
        if (Auth::user()->n_role_user == 'ingeniero') {
            $usuario_session = Auth::user()->k_id_user;
            $condicion = " AND otp.k_id_user = $usuario_session ";
        }
        $query = $this->db->query("
                SELECT otp.k_id_ot_padre, otp.n_nombre_cliente, otp.orden_trabajo, 
                otp.servicio, otp.estado_orden_trabajo, otp.fecha_programacion, 
                otp.fecha_compromiso, otp.fecha_creacion, otp.k_id_user, user.n_name_user,
                CONCAT(user.n_name_user, ' ' , user.n_last_name_user) AS ingeniero,
                otp.lista_observaciones, otp.observacion
                FROM ot_padre otp
                INNER JOIN user ON otp.k_id_user = user.k_id_user
                                WHERE lista_observaciones = '$opcion' 
                                $condicion
        ");
        return $query->result();
    }
    
    //trae la cantidad de ot hijas en ejecucion de una ot padre
    public function getCantOthInExecutionByIdOtp($idOtp) {
        $query = $this->db->query("
                SELECT COUNT(k_id_register) AS cant
                FROM ot_hija oth
                WHERE nro_ot_onyx = $idOtp
                AND estado_orden_trabajo_hija != 'Cerrada' 
                AND estado_orden_trabajo_hija != 'Cancelada' 
                AND estado_orden_trabajo_hija != '3- Terminada' 
        ");
        return $query->row();
    }
    
//trae las ot hijas en ejecucion de una ot padre
    public function getOthInExecutionByIdOtp($idOtp) {
        $query = $this->db->query("
                SELECT id_orden_trabajo_hija
                FROM ot_hija oth
                WHERE nro_ot_onyx = $idOtp
                AND estado_orden_trabajo_hija != 'Cerrada' 
                AND estado_orden_trabajo_hija != 'Cancelada' 
                AND estado_orden_trabajo_hija != '3- Terminada' 
        ");
        return $query->result();
    }

}
