<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_control_cambios_model extends CI_Model {

	public function __construct(){

	}

	// Retorna un array con la lista de responsables de la tabla responsable_cc
	public function getAllResponsable(){
		$query = $this->db->get('responsable_cc');
		return $query->result();
	}

	// Retorna un array con la lista de todas las causas de la tabla causa_cc
	public function getAllCausa(){
		$query = $this->db->get('causa_cc');
		return $query->result();	
	}

	// Inserta nuevo registrpo en tabla control de cambios
	public function insert_control_cambios($data){
		if ($this->db->insert('control_cambios', $data)) {
			return true;
		} else {
			return false;
		}
	}

	// Retorna los controles de cambio filtrado por ot padre
	public function get_cc_by_otp($otp){
		$query = $this->db->query("
				SELECT 
                cc.id_control_cambios, 
                cc.id_ot_padre, 
                cc.id_responsable, 
                cc.id_causa, 
                cc.numero_control, 
                cc.fecha_compromiso, 
                cc.fecha_programacion_inicial, 
                cc.nueva_fecha_programacion, 
                cc.narrativa_escalamiento, 
                cc.estado_cc, 
                cc.observaciones_cc, 
                cc.faltantes, 
                cc.en_tiempos, 
                cc.fecha_creacion_cc, 
                r.nombre_responsable, 
                c.nombre_causa,
                otp.id_sede
                FROM 
                control_cambios cc 
                INNER JOIN ot_padre otp ON cc.id_ot_padre = otp.k_id_ot_padre 
                INNER JOIN responsable_cc r ON cc.id_responsable = r.id_responsable 
                INNER JOIN causa_cc c ON cc.id_causa = c.id_causa 
                WHERE 
                cc.id_ot_padre = $otp
			");
		return $query->result();
	}


}