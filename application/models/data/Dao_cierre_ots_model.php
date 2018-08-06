<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_cierre_ots_model extends CI_Model {

  	protected $session;

    public function __construct() {
        // $this->load->model('dto/UserModel');
    }


    // se trasladan todos los registros que tienen fecha anterior a la ultima update de data
    public function trasladar_oth($penultima){
        $this->db->query("
            INSERT INTO 
                `telmex_vip`.`cierre_ots` (`id_orden_trabajo_hija`, `k_id_estado_ot`, `nro_ot_onyx`, `grupo_objetivo`, `segmento`, `nivel_atencion`, `ciudad`, `departamento`, `grupo`, `consultor_comercial`, `grupo2`, `consultor_postventa`, `proy_instalacion`, `ing_responsable`, `id_enlace`, `alias_enlace`, `familia`, `producto`, `tiempo_incidente`, `tiempo_estado`, `ano_ingreso_estado`, `mes_ngreso_estado`, `fecha_ingreso_estado`, `usuario_asignado`, `grupo_asignado`, `ingeniero_provisioning`, `cargo_arriendo`, `cargo_mensual`, `monto_moneda_local_arriendo`, `monto_moneda_local_cargo_mensual`, `cargo_obra_civil`, `descripcion`, `direccion_origen`, `ciudad_incidente`, `direccion_destino`, `ciudad_incidente3`, `fecha_realizacion`, `resolucion_1`, `resolucion_2`, `resolucion_3`, `resolucion_4`, `fecha_creacion_ot_hija`, `proveedor_ultima_milla`, `usuario_asignado4`, `resolucion_15`, `resolucion_26`, `resolucion_37`, `resolucion_48`, `ot_hija`, `estado_orden_trabajo_hija`, `fec_actualizacion_onyx_hija`, `tipo_trascurrido`, `fecha_insercion_zolid`, `fecha_actual`, `n_observacion_cierre`, `c_email`) 

            SELECT 
                `id_orden_trabajo_hija`, `k_id_estado_ot`, `nro_ot_onyx`, `grupo_objetivo`, `segmento`, `nivel_atencion`, `ciudad`, `departamento`, `grupo`, `consultor_comercial`, `grupo2`, `consultor_postventa`, `proy_instalacion`, `ing_responsable`, `id_enlace`, `alias_enlace`, `familia`, `producto`, `tiempo_incidente`, `tiempo_estado`, `ano_ingreso_estado`, `mes_ngreso_estado`, `fecha_ingreso_estado`, `usuario_asignado`, `grupo_asignado`, `ingeniero_provisioning`, `cargo_arriendo`, `cargo_mensual`, `monto_moneda_local_arriendo`, `monto_moneda_local_cargo_mensual`, `cargo_obra_civil`, `descripcion`, `direccion_origen`, `ciudad_incidente`, `direccion_destino`, `ciudad_incidente3`, `fecha_realizacion`, `resolucion_1`, `resolucion_2`, `resolucion_3`, `resolucion_4`, `fecha_creacion_ot_hija`, `proveedor_ultima_milla`, `usuario_asignado4`, `resolucion_15`, `resolucion_26`, `resolucion_37`, `resolucion_48`, `ot_hija`, `estado_orden_trabajo_hija`, `fec_actualizacion_onyx_hija`, `tipo_trascurrido`, `fecha_insercion_zolid`, `fecha_actual`, `n_observacion_cierre`, `c_email` 
            FROM ot_hija 
            WHERE fecha_actual = '$penultima'
            ");
        return $this->db->affected_rows();
    }

  
}
