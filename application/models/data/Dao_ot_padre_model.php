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
				SELECT 
                otp.k_id_ot_padre, otp.n_nombre_cliente, otp.orden_trabajo, 
                otp.servicio, REPLACE(otp.estado_orden_trabajo,'otp_cerrada','Cerrada') AS estado_orden_trabajo, otp.fecha_programacion, 
                otp.fecha_compromiso, otp.fecha_creacion, otp.k_id_user, user.n_name_user,
                CONCAT(user.n_name_user, ' ' , user.n_last_name_user) AS ingeniero,
                otp.lista_observaciones, otp.observacion, SUM(oth.c_email) AS cant_mails
                FROM ot_hija oth 
                INNER JOIN ot_padre otp ON oth.nro_ot_onyx = otp.k_id_ot_padre
                INNER JOIN user ON otp.k_id_user = user.k_id_user 
                $condicion
                GROUP BY nro_ot_onyx
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
				SELECT 
                otp.k_id_ot_padre, otp.n_nombre_cliente, otp.orden_trabajo, 
                otp.servicio, REPLACE(otp.estado_orden_trabajo,'otp_cerrada','Cerrada') AS estado_orden_trabajo, otp.fecha_programacion, 
                otp.fecha_compromiso, otp.fecha_creacion, otp.k_id_user, user.n_name_user,
                CONCAT(user.n_name_user, ' ' , user.n_last_name_user) AS ingeniero,
                otp.lista_observaciones, otp.observacion, SUM(oth.c_email) AS cant_mails
                FROM ot_hija oth 
                INNER JOIN ot_padre otp ON oth.nro_ot_onyx = otp.k_id_ot_padre
                INNER JOIN user ON otp.k_id_user = user.k_id_user
                WHERE otp.fecha_compromiso = CURDATE()
                $condicion
                GROUP BY nro_ot_onyx
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
				SELECT 
                otp.k_id_ot_padre, otp.n_nombre_cliente, otp.orden_trabajo, 
                otp.servicio, REPLACE(otp.estado_orden_trabajo,'otp_cerrada','Cerrada') AS estado_orden_trabajo, otp.fecha_programacion, 
                otp.fecha_compromiso, otp.fecha_creacion, otp.k_id_user, user.n_name_user,
                CONCAT(user.n_name_user, ' ' , user.n_last_name_user) AS ingeniero,
                otp.lista_observaciones, otp.observacion, SUM(oth.c_email) AS cant_mails
                FROM ot_hija oth 
                INNER JOIN ot_padre otp ON oth.nro_ot_onyx = otp.k_id_ot_padre
                INNER JOIN user ON otp.k_id_user = user.k_id_user 
                WHERE otp.fecha_compromiso < CURDATE()
                $condicion
                GROUP BY nro_ot_onyx
    	");
        return $query->result();
    }

    //Inserta la observaciones, usuario que lo hizo y fecha de la vista detalles  
    public function update_new_data($data) {
        if (Auth::user()->n_role_user == 'administrador') {
            $this->db->where('k_id_ot_padre', $data['k_id_ot_padre']);
            $this->db->update('ot_padre', $data);
        } else {
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
                SELECT 
                otp.k_id_ot_padre, otp.n_nombre_cliente, otp.orden_trabajo, 
                otp.servicio, REPLACE(otp.estado_orden_trabajo,'otp_cerrada','Cerrada') AS estado_orden_trabajo, otp.fecha_programacion, 
                otp.fecha_compromiso, otp.fecha_creacion, otp.k_id_user, user.n_name_user,
                CONCAT(user.n_name_user, ' ' , user.n_last_name_user) AS ingeniero,
                otp.lista_observaciones, otp.observacion, SUM(oth.c_email) AS cant_mails
                FROM ot_hija oth 
                INNER JOIN ot_padre otp ON oth.nro_ot_onyx = otp.k_id_ot_padre
                INNER JOIN user ON otp.k_id_user = user.k_id_user 
                WHERE lista_observaciones = '$opcion' 
                $condicion 
                GROUP BY oth.nro_ot_onyx

        ");
        // print_r($this->db->last_query());
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

    //Trae todas las othijas de una otp en especifico
    public function getothofothp($idOtp) {
        $query = $this->db->query("
            SELECT oth.id_orden_trabajo_hija, oth.ot_hija, oth.estado_orden_trabajo_hija, oth.c_email,
                CONCAT('$ ',FORMAT(oth.monto_moneda_local_arriendo + oth.monto_moneda_local_cargo_mensual,2)) AS MRC,
                otp.fecha_compromiso, otp.fecha_programacion
            FROM ot_hija oth
            INNER JOIN ot_padre otp
            ON otp.k_id_ot_padre = oth.nro_ot_onyx
            WHERE oth.nro_ot_onyx = $idOtp
        ");
        return $query->result();
    }
    
    //Trae todas las ot hijas que se encuentren en la tabla cierre de una otp en especifico
    public function getOthOfOtpCierre($idOtp) {
        $query = $this->db->query("
            SELECT cot.id_orden_trabajo_hija, cot.ot_hija, cot.estado_orden_trabajo_hija, cot.c_email,
                CONCAT('$ ',FORMAT(cot.monto_moneda_local_arriendo + cot.monto_moneda_local_cargo_mensual,2)) AS MRC,
                otp.fecha_compromiso, otp.fecha_programacion
            FROM cierre_ots cot
            INNER JOIN ot_padre otp
            ON otp.k_id_ot_padre = cot.nro_ot_onyx
            WHERE cot.nro_ot_onyx = $idOtp
        ");
        return $query->result();
    }

  // eliminar de tabla ot padre, pasar id otp o array con ids otp
  public function deleteById($otp){
      $this->db->where_in('k_id_ot_padre', $otp);
    $this->db->delete('ot_padre');
    if ($this->db->affected_rows() > 0) {
        return $this->db->affected_rows();
    } else {
        return 0;
    }
  }






}
