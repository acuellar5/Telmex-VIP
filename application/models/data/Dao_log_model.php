<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_log_model extends CI_Model {

    protected $session;

    public function __construct() {

    }

    // inserta en tabla Log todos los campos (hay q enviarle a data el arreglo ya creado)
    public function insertLogRow($data) {
        //inserta el arreglo
        $this->db->insert('log', $data);
        // capturar error de insercion
        $error = $this->db->error();
        if ($error['message']) {
            print_r($error);
        }
    }

    // inserta en tabla inconsistencia todos los campos (hay q enviarle a data el arreglo ya creado)
    public function insertInconsistenciaRow($data) {
        //inserta el arreglo
        $this->db->insert('inconcistencia', $data);
        // capturar error de insercion
        $error = $this->db->error();
        if ($error['message']) {
            print_r($error);
        }
    }

    //Retorna todo el historial de log de un id
    public function getLogById($id) {
        $query = $this->db->get_where('log', array('id_ot_hija' => $id));
        return $query->result();
    }

    // retorna todo log de contrrol de cambios de una sede
    public function get_log_by_idsede($id_sede) {
        $query = $this->db->query("
                SELECT
                CONCAT('ZCC',cc.id_control_cambios) As control_cambios,
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
                otp.id_sede = $id_sede
            ");
        return $query->result();
    }

    // inserta en tabla uploads la ultima actualizacion de la data
    public function insert_last_update($fecha, $userSession, $peso) {
        $this->db->set("nombre", $userSession);
        $this->db->set("fecha", $fecha);
        $this->db->set("peso", $peso);
        $this->db->insert('uploads');
    }

}
