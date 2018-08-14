<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_facturacion_ots_model extends CI_Model {

    protected $session;

    public function __construct() {
        
    }

    // trae las ots padre en cierre
    public function getOtpFacturacion() {
        $query = $this->db->query("
            SELECT 
            otp.k_id_ot_padre, otp.n_nombre_cliente, otp.orden_trabajo, otp.servicio, 
            REPLACE(otp.estado_orden_trabajo,'otp_cerrada','Cerrada') AS estado_orden_trabajo, 
            otp.fecha_programacion, otp.fecha_compromiso, otp.fecha_creacion, otp.k_id_user, 
            CONCAT(user.n_name_user, ' ' , user.n_last_name_user) AS ingeniero,
            otp.lista_observaciones, otp.observacion                
            FROM cierre_ots c 
            INNER JOIN ot_padre otp
            ON c.nro_ot_onyx = otp.k_id_ot_padre
            INNER JOIN user 
            ON otp.k_id_user = user.k_id_user 
            WHERE c.estado_zte = 'facturacion' 
            GROUP BY nro_ot_onyx
            ORDER BY otp.k_id_user, c.k_id
        ");

        return $query->result();
    }
    
    public function searchOtpByDate($fdesde, $fhasta) {
        $query = $this->db->query("
            SELECT 
            otp.k_id_ot_padre, otp.n_nombre_cliente, otp.orden_trabajo, otp.servicio, 
            REPLACE(otp.estado_orden_trabajo,'otp_cerrada','Cerrada') AS estado_orden_trabajo, 
            otp.fecha_programacion, otp.fecha_compromiso, otp.fecha_creacion, otp.k_id_user, 
            CONCAT(user.n_name_user, ' ' , user.n_last_name_user) AS ingeniero,
            otp.lista_observaciones, otp.observacion                
            FROM cierre_ots c 
            INNER JOIN ot_padre otp
            ON c.nro_ot_onyx = otp.k_id_ot_padre
            INNER JOIN user 
            ON otp.k_id_user = user.k_id_user 
            WHERE c.estado_zte = 'facturacion' AND
            fecha_actual BETWEEN '$fdesde' AND '$fhasta'
            GROUP BY nro_ot_onyx
            ORDER BY c.fecha_actual DESC
        ");

        return $query->result();
    }

}
