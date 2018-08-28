<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_log_correo_model extends CI_Model {

  	protected $session;

    public function __construct() {
        // $this->load->model('dto/UserModel');
    }


    // Inserta un registro nuevo a la base de datos
    public function insert_data($data){
    	$this->db->insert('log_correo', $data);
    }

    // Obtiene datos de log_correo por id ot hija
    public function getLogMailById($id){
    	// $query = $this->db->order_by('k_id_tipo ASC, i_orden ASC');
        $query = $this->db->query("
                SELECT 
                CONCAT(u.n_name_user, ' ', u.n_last_name_user) AS usuario_en_sesion,k_id_ot_padre, id_orden_trabajo_hija, clase, destinatarios, usuario_sesion, nombre, nombre_cliente, servicio, fecha, direccion_instalacion, direccion_instalacion_des1, direccion_instalacion_des2, direccion_instalacion_des3, direccion_instalacion_des4, existente, nuevo, ancho_banda, interfaz_entrega, equipos_intalar_camp1, equipos_intalar_camp2, equipos_intalar_camp3, fecha_servicio, ingeniero1, ingeniero1_tel, ingeniero1_email, ingeniero2, ingeniero2_tel, ingeniero2_email, ingeniero3, ingeniero3_tel, ingeniero3_email, ots_nombre, ampliacion_enlaces, vista_obra_civil, envio_cotizacion_obra_civil, aprobacion_cotizacion_obra_civil, ejecucion_obra_civil, empalmes, configuracion, entrega_servicio, direccion_servicio
                FROM 
                log_correo lc
                INNER JOIN user u
                ON lc.usuario_sesion = u.k_id_user
                WHERE 
                LC.id_orden_trabajo_hija = $id
            ");
    	return $query->result();
    }






  
}
