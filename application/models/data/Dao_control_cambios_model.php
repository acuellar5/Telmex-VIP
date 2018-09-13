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
			return $this->db->insert_id();
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

	// Actualiza tabla de control de cambios ref = id:control_cambios
	public function update_control_cambios($data, $id_control){
		$this->db->where('id_control_cambios', $id_control);
        $this->db->update('control_cambios', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->affected_rows();
        } else {
            return 0;
        }
	}

	// Obtener todos los archivos de los controlers dependiendo el id de la sede
	public function c_getFillName($id_sede){
		$query = $this->db->query("
				SELECT 
				id_control_cambios,id_ot_padre,nombre_archivo  
				FROM control_cambios cc 
				INNER JOIN ot_padre otp 
				ON cc.id_ot_padre = otp.k_id_ot_padre
				WHERE otp.id_sede = '$id_sede'
			");
		return $query->result();
	}

	// trae el archivo a descargar segun el control de cambios
	public function getFileCC($id_cc){
		$query = $this->db->query("
			SELECT archivo, nombre_archivo, tipo_archivo, extension_archivo FROM control_cambios WHERE id_control_cambios = '$id_cc'
			");
		return $query->row_array();
	}


}