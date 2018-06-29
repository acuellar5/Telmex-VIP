<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_ot_hija_model extends CI_Model {

    protected $session;

    public function __construct() {
        $this->load->model('dto/OtHijaModel');
    }

    public function getAll() {
        try {
            $otHija = new OtHijaModel();
            $datos = $otHija->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function findByOrdenTrabajoHija($idOrdenTrabajoHija) {
        try {
            $db = new DB();
            $sql = "SELECT * FROM ot_hija  WHERE id_orden_trabajo_hija = $idOrdenTrabajoHija  AND fecha_actual = DATE(DATE(NOW())-1)";
            $data = $db->select($sql)->first();
//            echo $db->getSql();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($data);
            return $data;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function insertOtHija($request) {
        try {
            $otHija = new OtHijaModel();
            $datos = $otHija->insert($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getOtsAssigned() {
        try {
            $condicion = "";
            if (Auth::user()->n_role_user == 'ingeniero') {
                $usuario_session = Auth::user()->k_id_user;
                $condicion = "AND k_id_user = $usuario_session";
            }
            $query = $this->db->query("
                SELECT 
                DISTINCT ot.k_id_register, 
                ot.id_orden_trabajo_hija, 
                ot.k_id_estado_ot, 
                ot.k_id_user, 
                ot.id_cliente_onyx, 
                ot.nombre_cliente, 
                ot.grupo_objetivo, 
                ot.segmento, 
                ot.nivel_atencion, 
                ot.ciudad, 
                ot.departamento, 
                ot.grupo, 
                ot.consultor_comercial, 
                ot.grupo2, 
                ot.consultor_postventa, 
                ot.proy_instalacion, 
                ot.ing_responsable, 
                ot.id_enlace, 
                ot.alias_enlace, 
                ot.orden_trabajo, 
                ot.nro_ot_onyx, 
                ot.servicio, 
                ot.familia, 
                ot.producto, 
                DATE_FORMAT(ot.fecha_creacion, '%Y-%m-%d') AS fecha_creacion, 
                ot.tiempo_incidente, 
                ot.estado_orden_trabajo, 
                ot.tiempo_estado, 
                ot.ano_ingreso_estado, 
                ot.mes_ngreso_estado, 
                DATE_FORMAT(ot.fecha_ingreso_estado, '%Y-%m-%d') AS fecha_ingreso_estado, 
                ot.usuario_asignado, 
                ot.grupo_asignado, 
                ot.ingeniero_provisioning, 
                ot.cargo_arriendo, 
                ot.cargo_mensual, 
                ot.monto_moneda_local_arriendo, 
                ot.monto_moneda_local_cargo_mensual, 
                ot.cargo_obra_civil, 
                ot.descripcion, 
                ot.direccion_origen, 
                ot.ciudad_incidente, 
                ot.direccion_destino, 
                ot.ciudad_incidente3, 
                DATE_FORMAT(ot.fecha_compromiso, '%Y-%m-%d') AS fecha_compromiso, 
                DATE_FORMAT(ot.fecha_programacion, '%Y-%m-%d') AS fecha_programacion, 
                DATE_FORMAT(ot.fecha_realizacion, '%Y-%m-%d') AS fecha_realizacion, 
                ot.resolucion_1, 
                ot.resolucion_2, 
                ot.resolucion_3, 
                ot.resolucion_4, 
                DATE_FORMAT(ot.fecha_creacion_ot_hija, '%Y-%m-%d') AS fecha_creacion_ot_hija, 
                ot.proveedor_ultima_milla, 
                ot.usuario_asignado4, 
                ot.resolucion_15, 
                ot.resolucion_26, 
                ot.resolucion_37, 
                ot.resolucion_48, 
                ot.ot_hija, 
                ot.estado_orden_trabajo_hija, 
                DATE_FORMAT(ot.fec_actualizacion_onyx_hija, '%Y-%m-%d') AS fec_actualizacion_onyx_hija, 
                ot.tipo_trascurrido, 
                DATE_FORMAT(ot.fecha_actual, '%Y-%m-%d') AS fecha_actual, 
                ot.estado_mod, 
                e.k_id_tipo, 
                e.n_name_estado_ot, 
                e.i_orden,
                case
                    when l.id_ot_hija IS NULL THEN '0'
                    ELSE 1 
                END AS 'function'
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot 
                LEFT JOIN log l 
                ON ot.id_orden_trabajo_hija = l.id_ot_hija 
                WHERE ot.fecha_actual = CURDATE() 
                $condicion ORDER BY tipo_trascurrido DESC
            ");
            return $query;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }


    //
    public function m_updateStatusOt($data, $dataLog){
        $this->db->where('id_orden_trabajo_hija', $data['id_orden_trabajo_hija']);
        $this->db->update('ot_hija', $data);
        $error = $this->db->error();

        $this->db->insert('log', $dataLog);



            if ($error['message']) {
              return 'error';
            }else{
              return 1;
            }

    }

//     public function updateStatusOt($request) {
//         try {
//             $otHija = new OtHijaModel();
//             $datos = $otHija->where("k_id_register", "=", $request->k_id_register)
//                     ->update([
//                 "observaciones" => $request->observaciones,
//                 "k_id_estado_ot" => $request->k_id_estado_ot,
//                 "estado_orden_trabajo_hija" => $request->estado_orden_trabajo_hija
//             ]);
// //            echo $otHija->getSQL();
//             $response = new Response(EMessages::SUCCESS);
//             $response->setData($datos);
//             return $response;
//         } catch (DeplynException $ex) {
//             return $ex;
//         }
//     }

    public function getOtsFiteenDays() {
        $condicion = "";
        if (Auth::user()->n_role_user == 'ingeniero') {
            $usuario_session = Auth::user()->n_name_user . " " . Auth::user()->n_last_name_user;
            $condicion = "AND usuario_asignado like '%$usuario_session%'";
        }
        $query = $this->db->query("
                SELECT 
                DISTINCT ot.k_id_register, 
                ot.id_orden_trabajo_hija, 
                ot.k_id_estado_ot, 
                ot.k_id_user, 
                ot.id_cliente_onyx, 
                ot.nombre_cliente, 
                ot.grupo_objetivo, 
                ot.segmento, 
                ot.nivel_atencion, 
                ot.ciudad, 
                ot.departamento, 
                ot.grupo, 
                ot.consultor_comercial, 
                ot.grupo2, 
                ot.consultor_postventa, 
                ot.proy_instalacion, 
                ot.ing_responsable, 
                ot.id_enlace, 
                ot.alias_enlace, 
                ot.orden_trabajo, 
                ot.nro_ot_onyx, 
                ot.servicio, 
                ot.familia, 
                ot.producto, 
                DATE_FORMAT(ot.fecha_creacion, '%Y-%m-%d') AS fecha_creacion, 
                ot.tiempo_incidente, 
                ot.estado_orden_trabajo, 
                ot.tiempo_estado, 
                ot.ano_ingreso_estado, 
                ot.mes_ngreso_estado, 
                DATE_FORMAT(ot.fecha_ingreso_estado, '%Y-%m-%d') AS fecha_ingreso_estado, 
                ot.usuario_asignado, 
                ot.grupo_asignado, 
                ot.ingeniero_provisioning, 
                ot.cargo_arriendo, 
                ot.cargo_mensual, 
                ot.monto_moneda_local_arriendo, 
                ot.monto_moneda_local_cargo_mensual, 
                ot.cargo_obra_civil, 
                ot.descripcion, 
                ot.direccion_origen, 
                ot.ciudad_incidente, 
                ot.direccion_destino, 
                ot.ciudad_incidente3, 
                DATE_FORMAT(ot.fecha_compromiso, '%Y-%m-%d') AS fecha_compromiso, 
                DATE_FORMAT(ot.fecha_programacion, '%Y-%m-%d') AS fecha_programacion, 
                DATE_FORMAT(ot.fecha_realizacion, '%Y-%m-%d') AS fecha_realizacion, 
                ot.resolucion_1, 
                ot.resolucion_2, 
                ot.resolucion_3, 
                ot.resolucion_4, 
                DATE_FORMAT(ot.fecha_creacion_ot_hija, '%Y-%m-%d') AS fecha_creacion_ot_hija, 
                ot.proveedor_ultima_milla, 
                ot.usuario_asignado4, 
                ot.resolucion_15, 
                ot.resolucion_26, 
                ot.resolucion_37, 
                ot.resolucion_48, 
                ot.ot_hija, 
                ot.estado_orden_trabajo_hija, 
                DATE_FORMAT(ot.fec_actualizacion_onyx_hija, '%Y-%m-%d') AS fec_actualizacion_onyx_hija, 
                ot.tipo_trascurrido, 
                DATE_FORMAT(ot.fecha_actual, '%Y-%m-%d') AS fecha_actual, 
                DATE_FORMAT(ot.fecha_insercion_zolid, '%Y-%m-%d') AS fecha_insercion_zolid,
                ot.estado_mod, 
                e.k_id_tipo, 
                e.n_name_estado_ot, 
                e.i_orden,
                case
                    when l.id_ot_hija IS NULL THEN '0'
                    ELSE 1 
                END AS 'function'
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot 
                LEFT JOIN log l 
                ON ot.id_orden_trabajo_hija = l.id_ot_hija
                WHERE ADDDATE(ot.fecha_insercion_zolid, INTERVAL 15 DAY) < CURDATE() 
                AND ot.k_id_estado_ot = 1 
                $condicion
            ");
        return $query;

    }

    
    // llama el primer elemento dependiendo el id rf
    public function getExistIdOtHija($id) {
        $query = $this->db->query("
            SELECT 
            ot.id_orden_trabajo_hija,
            ot.usuario_asignado,
            ot.estado_orden_trabajo,
            ot.tiempo_estado,
            ot.descripcion,
            ot.fecha_compromiso,
            ot.fecha_programacion,
            ot.fecha_realizacion,
            ot.estado_orden_trabajo_hija,
            ot.fec_actualizacion_onyx_hija,
            ot.tipo_trascurrido,             
            ot.ot_hija, 
            e.i_orden
            FROM 
            ot_hija ot
            LEFT JOIN estado_ot e
            ON ot.k_id_estado_ot = e.k_id_estado_ot
            WHERE 
            ot.id_orden_trabajo_hija = $id
        ");
        return $query->row_array();
    }

    // inserta en tabla ot_hija todos los campos (hay q enviarle a data el arreglo ya creado)
    public function insert_ot_hija($data) {
        //inserta el arreglo
        $this->db->insert('ot_hija', $data);
        // capturar error de insercion
        $error = $this->db->error();
        if ($error['message']) {
            // print_r($error);
            return $error;
        } else {
            return 1;
        }
    }

    // actualiza en tabla ot_hija enviados los campos (hay q enviarle a data el arreglo ya creado)
    public function update_ot_hija_status_mod($data) {
        $query = $this->db->query("UPDATE ot_hija SET estado_mod = " . $data['estado_mod'] . ", fecha_actual = '".$data['fecha_actual']."'  WHERE id_orden_trabajo_hija = " . $data['id_orden_trabajo_hija'] . ";");

        $error = $this->db->error();
        if ($error['message']) {
            // print_r($error);
            return $error;
        } else {
            return 1;
        }
    }

    public function update_ot_hija_mod($data) {

        $this->db->where('id_orden_trabajo_hija', $data['id_orden_trabajo_hija']);
        $this->db->update('ot_hija', $data);
        // $this->db->last_query();
        $error = $this->db->error();
        if ($error['message']) {
            // print_r($error);
            return $error;
        } else {
            return 1;
        }
    }


    //Consulta controlada para el data tables usado con server side prossesing
    public function getAllOtPS($parameters){
        // reasigno las variables para q sean mas dicientes y manejables
        $start  = $parameters['start'];
        $length = $parameters['length'];
        $search = $parameters['search'];
        $order  = $parameters['order'];
        $columm = $parameters['columm'];

        // Cuando el usuario logueado es un ingeniero... si es admin puede ver todo
        $condicion = "";
        if (Auth::user()->n_role_user == 'ingeniero') {
            $usuario_session = Auth::user()->k_id_user;
            $condicion = ($search)? " AND ot.k_id_user = $usuario_session " : " WHERE ot.k_id_user = $usuario_session ";
        }
        // si el usuario escribio algo en el buscador se concatena el where + lo que debe buscar
        if($search){
            $srch  = "where ot.nombre_cliente LIKE '%".$search."%' OR ";
            $srch .= "ot.id_cliente_onyx LIKE '%".$search."%' OR ";
            $srch .= "ot.fecha_compromiso LIKE '%".$search."%' OR ";
            $srch .= "ot.fecha_programacion LIKE '%".$search."%' OR ";
            $srch .= "ot.id_orden_trabajo_hija LIKE '%".$search."%' OR ";
            $srch .= "ot.ot_hija LIKE '%".$search."%' OR ";
            $srch .= "ot.estado_orden_trabajo_hija LIKE '%".$search."%'";
        } else {
            // Si no escribio nada en el buscador se pasa vacio
            $srch = "";
        }
        // Hago la consulta deseada y le añado where, order by, y limit, dependiendo la peticion que venga en las variables
        $query = $this->db->query("
                SELECT 
                DISTINCT ot.k_id_register, 
                ot.id_orden_trabajo_hija, 
                ot.k_id_estado_ot, 
                ot.k_id_user, 
                ot.id_cliente_onyx, 
                ot.nombre_cliente, 
                ot.grupo_objetivo, 
                ot.segmento, 
                ot.nivel_atencion, 
                ot.ciudad, 
                ot.departamento, 
                ot.grupo, 
                ot.consultor_comercial, 
                ot.grupo2, 
                ot.consultor_postventa, 
                ot.proy_instalacion, 
                ot.ing_responsable, 
                ot.id_enlace, 
                ot.alias_enlace, 
                ot.orden_trabajo, 
                ot.nro_ot_onyx, 
                ot.servicio, 
                ot.familia, 
                ot.producto, 
                DATE_FORMAT(ot.fecha_creacion, '%Y-%m-%d') AS fecha_creacion, 
                ot.tiempo_incidente, 
                ot.estado_orden_trabajo, 
                ot.tiempo_estado, 
                ot.ano_ingreso_estado, 
                ot.mes_ngreso_estado, 
                DATE_FORMAT(ot.fecha_ingreso_estado, '%Y-%m-%d') AS fecha_ingreso_estado, 
                ot.usuario_asignado, 
                ot.grupo_asignado, 
                ot.ingeniero_provisioning, 
                ot.cargo_arriendo, 
                ot.cargo_mensual, 
                ot.monto_moneda_local_arriendo, 
                ot.monto_moneda_local_cargo_mensual, 
                ot.cargo_obra_civil, 
                ot.descripcion, 
                ot.direccion_origen, 
                ot.ciudad_incidente, 
                ot.direccion_destino, 
                ot.ciudad_incidente3, 
                DATE_FORMAT(ot.fecha_compromiso, '%Y-%m-%d') AS fecha_compromiso, 
                DATE_FORMAT(ot.fecha_programacion, '%Y-%m-%d') AS fecha_programacion, 
                DATE_FORMAT(ot.fecha_realizacion, '%Y-%m-%d') AS fecha_realizacion, 
                ot.resolucion_1, 
                ot.resolucion_2, 
                ot.resolucion_3, 
                ot.resolucion_4, 
                DATE_FORMAT(ot.fecha_creacion_ot_hija, '%Y-%m-%d') AS fecha_creacion_ot_hija, 
                ot.proveedor_ultima_milla, 
                ot.usuario_asignado4, 
                ot.resolucion_15, 
                ot.resolucion_26, 
                ot.resolucion_37, 
                ot.resolucion_48, 
                ot.ot_hija, 
                ot.estado_orden_trabajo_hija, 
                DATE_FORMAT(ot.fec_actualizacion_onyx_hija, '%Y-%m-%d') AS fec_actualizacion_onyx_hija, 
                ot.tipo_trascurrido, 
                DATE_FORMAT(ot.fecha_actual, '%Y-%m-%d') AS fecha_actual, 
                ot.estado_mod, 
                e.k_id_tipo, 
                e.n_name_estado_ot, 
                e.i_orden,
                case
                    when l.id_ot_hija IS NULL THEN '0'
                    ELSE 1 
                END AS 'function'
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot 
                LEFT JOIN log l 
                ON ot.id_orden_trabajo_hija = l.id_ot_hija 
                ".$srch." ".$condicion."
                ORDER BY $columm $order
                LIMIT $start, $length 
            ");
        // cant de registros es necesaria para saber cuanto es el total de registros sin filtros existentes en la consulta
        $cant = $this->db->query("
                SELECT count(1) cant 
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot 

                ".$srch." ".$condicion." 
            ");
        // en cantidad solo necesito la cantidad numerica
        $cantidad = $cant->row()->cant;

         // retorno el objeto de la primera consulta entre ellos ->result() y -> num_rows() en la posicion datos y la cantidad total
        $retorno = array(
            "numDataTotal" => $cantidad,
            "datos"        => $query
        );

        return $retorno;
    }
    
    public function getOtsNew() {
        try {
            $db = new DB();
            $condicion = "";
            $usuario_session = Auth::user()->k_id_user;
            if (Auth::user()->n_role_user == 'ingeniero') {
                $condicion = "AND k_id_user = $usuario_session";
            }
            $query = $this->db->query("
                        SELECT oh.*, eo.k_id_tipo , eo.i_orden
                        FROM ot_hija oh
                        INNER JOIN estado_ot eo ON oh.k_id_estado_ot = eo.k_id_estado_ot
                        WHERE estado_mod = 0
                        $condicion ORDER BY tipo_trascurrido DESC
                    ");
            return $query;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    public function getOtsChange() {
        try {
            $db = new DB();
            $condicion = "";
            $usuario_session = Auth::user()->k_id_user;
            if (Auth::user()->n_role_user == 'ingeniero') {
                $condicion = "AND k_id_user = $usuario_session";
            }
            $query = $this->db->query("SELECT oh.*, eo.k_id_tipo, eo.i_orden 
                                FROM ot_hija oh
                                INNER JOIN estado_ot eo ON oh.k_id_estado_ot = eo.k_id_estado_ot
                                WHERE estado_mod = 1
                                $condicion ORDER BY tipo_trascurrido DESC");
            return $query;
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    public function getOtsReportPrincipalAdmin() {
        try {
            $db = new DB();
            $query = $this->db->query("SELECT oth.nombre_cliente, oth.id_cliente_onyx, oth.id_orden_trabajo_hija, 
                                            oth.ot_hija, oth.estado_orden_trabajo_hija, oth.tipo_trascurrido,
                                            CONCAT(user.n_name_user, ' ', user.n_last_name_user) AS ingeniero
                                        FROM ot_hija oth
                                        INNER JOIN user ON user.k_id_user = oth.k_id_user
                                        WHERE oth.fecha_actual = CURDATE()");
            return $query->result();
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    public function getOtsOutTime() {
        try {
            $db = new DB();
            $query = $this->db->query("SELECT oth.id_orden_trabajo_hija, 
                                            oth.k_id_estado_ot, 
                                            oth.k_id_user, 
                                            oth.id_cliente_onyx, 
                                            oth.nombre_cliente, 
                                            oth.grupo_objetivo, 
                                            oth.segmento, 
                                            oth.nivel_atencion, 
                                            oth.ciudad, 
                                            oth.departamento, 
                                            oth.grupo, 
                                            oth.consultor_comercial, 
                                            oth.grupo2, 
                                            oth.consultor_postventa, 
                                            oth.proy_instalacion, 
                                            oth.ing_responsable, 
                                            oth.id_enlace, 
                                            oth.alias_enlace, 
                                            oth.orden_trabajo, 
                                            oth.nro_ot_onyx, 
                                            oth.servicio, 
                                            oth.familia, 
                                            oth.producto, 
                                            DATE_FORMAT(oth.fecha_creacion, '%Y-%m-%d') AS fecha_creacion, 
                                            oth.tiempo_incidente, 
                                            oth.estado_orden_trabajo, 
                                            oth.tiempo_estado, 
                                            oth.ano_ingreso_estado, 
                                            oth.mes_ngreso_estado, 
                                            DATE_FORMAT(oth.fecha_ingreso_estado, '%Y-%m-%d') AS fecha_ingreso_estado, 
                                            oth.usuario_asignado, 
                                            oth.grupo_asignado, 
                                            oth.ingeniero_provisioning, 
                                            oth.cargo_arriendo, 
                                            oth.cargo_mensual, 
                                            oth.monto_moneda_local_arriendo, 
                                            oth.monto_moneda_local_cargo_mensual, 
                                            oth.cargo_obra_civil, 
                                            oth.descripcion, 
                                            oth.direccion_origen, 
                                            oth.ciudad_incidente, 
                                            oth.direccion_destino, 
                                            oth.ciudad_incidente3, 
                                            DATE_FORMAT(oth.fecha_compromiso, '%Y-%m-%d') AS fecha_compromiso, 
                                            DATE_FORMAT(oth.fecha_programacion, '%Y-%m-%d') AS fecha_programacion, 
                                            DATE_FORMAT(oth.fecha_realizacion, '%Y-%m-%d') AS fecha_realizacion, 
                                            oth.resolucion_1, 
                                            oth.resolucion_2, 
                                            oth.resolucion_3, 
                                            oth.resolucion_4, 
                                            DATE_FORMAT(oth.fecha_creacion_ot_hija, '%Y-%m-%d') AS fecha_creacion_ot_hija, 
                                            oth.proveedor_ultima_milla, 
                                            oth.usuario_asignado4, 
                                            oth.resolucion_15, 
                                            oth.resolucion_26, 
                                            oth.resolucion_37, 
                                            oth.resolucion_48, 
                                            oth.ot_hija, 
                                            oth.estado_orden_trabajo_hija, 
                                            DATE_FORMAT(oth.fec_actualizacion_onyx_hija, '%Y-%m-%d') AS fec_actualizacion_onyx_hija, 
                                            oth.tipo_trascurrido, 
                                            DATE_FORMAT(oth.fecha_actual, '%Y-%m-%d') AS fecha_actual, 
                                            oth.estado_mod,
                                            CONCAT(user.n_name_user, ' ', user.n_last_name_user) AS ingeniero,
                                            eot.k_id_tipo,
                                            CASE
                                                WHEN eot.k_id_tipo = 1 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 3 DAY))
                                                WHEN eot.k_id_tipo = 2 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 8 DAY))
                                                WHEN eot.k_id_tipo = 3 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 15 DAY))
                                                WHEN eot.k_id_tipo = 4 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 6 DAY))
                                                WHEN eot.k_id_tipo = 6 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 2 DAY))
                                                WHEN eot.k_id_tipo = 7 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 16 DAY))
                                                WHEN eot.k_id_tipo = 8 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 21 DAY))
                                                WHEN eot.k_id_tipo = 9 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 15 DAY))
                                                WHEN eot.k_id_tipo = 37 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 3 DAY))
                                                WHEN eot.k_id_tipo = 47 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 15 DAY))
                                                WHEN eot.k_id_tipo = 48 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 15 DAY))
                                                WHEN eot.k_id_tipo = 52 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 15 DAY))
                                                WHEN eot.k_id_tipo = 53 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 7 DAY))
                                                WHEN eot.k_id_tipo = 58 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 8 DAY))
                                            END AS tiempo_vencidas
                                        FROM ot_hija oth
                                        INNER JOIN user ON user.k_id_user = oth.k_id_user
                                        INNER JOIN estado_ot eot ON eot.k_id_estado_ot = oth.k_id_estado_ot
                                        WHERE oth.estado_orden_trabajo_hija != 'Cerrada' 
                                            AND oth.estado_orden_trabajo_hija != 'Cancelada' 
                                            AND oth.estado_orden_trabajo_hija != '3- Terminada'
                                            AND ((eot.k_id_tipo = 1 AND ADDDATE(oth.fecha_creacion, INTERVAL 3 DAY) < CURDATE())
                                                    OR (eot.k_id_tipo = 2 AND ADDDATE(oth.fecha_creacion, INTERVAL 8 DAY) < CURDATE())
                                                    OR (eot.k_id_tipo = 3 AND ADDDATE(oth.fecha_creacion, INTERVAL 15 DAY) < CURDATE())
                                                    OR (eot.k_id_tipo = 4 AND ADDDATE(oth.fecha_creacion, INTERVAL 6 DAY) < CURDATE())
                                                    OR (eot.k_id_tipo = 6 AND ADDDATE(oth.fecha_creacion, INTERVAL 2 DAY) < CURDATE())
                                                    OR (eot.k_id_tipo = 7 AND ADDDATE(oth.fecha_creacion, INTERVAL 16 DAY) < CURDATE())
                                                    OR (eot.k_id_tipo = 8 AND ADDDATE(oth.fecha_creacion, INTERVAL 21 DAY) < CURDATE())
                                                    OR (eot.k_id_tipo = 9 AND ADDDATE(oth.fecha_creacion, INTERVAL 15 DAY) < CURDATE())
                                                    OR (eot.k_id_tipo = 37 AND ADDDATE(oth.fecha_creacion, INTERVAL 3 DAY) < CURDATE())
                                                    OR (eot.k_id_tipo = 47 AND ADDDATE(oth.fecha_creacion, INTERVAL 15 DAY) < CURDATE())
                                                    OR (eot.k_id_tipo = 48 AND ADDDATE(oth.fecha_creacion, INTERVAL 15 DAY) < CURDATE())
                                                    OR (eot.k_id_tipo = 52 AND ADDDATE(oth.fecha_creacion, INTERVAL 15 DAY) < CURDATE())
                                                    OR (eot.k_id_tipo = 53 AND ADDDATE(oth.fecha_creacion, INTERVAL 7 DAY) < CURDATE())
                                                    OR (eot.k_id_tipo = 58 AND ADDDATE(oth.fecha_creacion, INTERVAL 8 DAY) < CURDATE()))
                                        ORDER by tiempo_vencidas DESC");
            return $query->result();
        } catch (DeplynException $ex) {
            return $ex;
        }
    }
    
    public function getOtsInTimes() {
        try {
            $db = new DB();
            $query = $this->db->query("SELECT oth.id_orden_trabajo_hija, 
                                            oth.k_id_estado_ot, 
                                            oth.k_id_user, 
                                            oth.id_cliente_onyx, 
                                            oth.nombre_cliente, 
                                            oth.grupo_objetivo, 
                                            oth.segmento, 
                                            oth.nivel_atencion, 
                                            oth.ciudad, 
                                            oth.departamento, 
                                            oth.grupo, 
                                            oth.consultor_comercial, 
                                            oth.grupo2, 
                                            oth.consultor_postventa, 
                                            oth.proy_instalacion, 
                                            oth.ing_responsable, 
                                            oth.id_enlace, 
                                            oth.alias_enlace, 
                                            oth.orden_trabajo, 
                                            oth.nro_ot_onyx, 
                                            oth.servicio, 
                                            oth.familia, 
                                            oth.producto, 
                                            DATE_FORMAT(oth.fecha_creacion, '%Y-%m-%d') AS fecha_creacion, 
                                            oth.tiempo_incidente, 
                                            oth.estado_orden_trabajo, 
                                            oth.tiempo_estado, 
                                            oth.ano_ingreso_estado, 
                                            oth.mes_ngreso_estado, 
                                            DATE_FORMAT(oth.fecha_ingreso_estado, '%Y-%m-%d') AS fecha_ingreso_estado, 
                                            oth.usuario_asignado, 
                                            oth.grupo_asignado, 
                                            oth.ingeniero_provisioning, 
                                            oth.cargo_arriendo, 
                                            oth.cargo_mensual, 
                                            oth.monto_moneda_local_arriendo, 
                                            oth.monto_moneda_local_cargo_mensual, 
                                            oth.cargo_obra_civil, 
                                            oth.descripcion, 
                                            oth.direccion_origen, 
                                            oth.ciudad_incidente, 
                                            oth.direccion_destino, 
                                            oth.ciudad_incidente3, 
                                            DATE_FORMAT(oth.fecha_compromiso, '%Y-%m-%d') AS fecha_compromiso, 
                                            DATE_FORMAT(oth.fecha_programacion, '%Y-%m-%d') AS fecha_programacion, 
                                            DATE_FORMAT(oth.fecha_realizacion, '%Y-%m-%d') AS fecha_realizacion, 
                                            oth.resolucion_1, 
                                            oth.resolucion_2, 
                                            oth.resolucion_3, 
                                            oth.resolucion_4, 
                                            DATE_FORMAT(oth.fecha_creacion_ot_hija, '%Y-%m-%d') AS fecha_creacion_ot_hija, 
                                            oth.proveedor_ultima_milla, 
                                            oth.usuario_asignado4, 
                                            oth.resolucion_15, 
                                            oth.resolucion_26, 
                                            oth.resolucion_37, 
                                            oth.resolucion_48, 
                                            oth.ot_hija, 
                                            oth.estado_orden_trabajo_hija, 
                                            DATE_FORMAT(oth.fec_actualizacion_onyx_hija, '%Y-%m-%d') AS fec_actualizacion_onyx_hija, 
                                            oth.tipo_trascurrido, 
                                            DATE_FORMAT(oth.fecha_actual, '%Y-%m-%d') AS fecha_actual, 
                                            oth.estado_mod,
                                            CONCAT(user.n_name_user, ' ', user.n_last_name_user) AS ingeniero,
                                            eot.k_id_tipo,
                                                CASE
                                                        WHEN eot.k_id_tipo = 1 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 2 DAY))
                                                WHEN eot.k_id_tipo = 2 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 7 DAY))
                                                        WHEN eot.k_id_tipo = 3 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 14 DAY))
                                                        WHEN eot.k_id_tipo = 4 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 5 DAY))
                                                        WHEN eot.k_id_tipo = 6 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 1 DAY))
                                                        WHEN eot.k_id_tipo = 7 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 15 DAY))
                                                        WHEN eot.k_id_tipo = 8 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 20 DAY))
                                                        WHEN eot.k_id_tipo = 9 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 14 DAY))
                                                        WHEN eot.k_id_tipo = 37 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 2 DAY))
                                                WHEN eot.k_id_tipo = 47 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 14 DAY))
                                                        WHEN eot.k_id_tipo = 48 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 14 DAY))
                                                        WHEN eot.k_id_tipo = 52 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 14 DAY))
                                                        WHEN eot.k_id_tipo = 53 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 6 DAY))
                                                        WHEN eot.k_id_tipo = 58 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion, INTERVAL 7 DAY))
                                                        ELSE 0
                                                END AS tiempo_vencer
                                        FROM ot_hija oth
                                        INNER JOIN user ON user.k_id_user = oth.k_id_user
                                        INNER JOIN estado_ot eot ON eot.k_id_estado_ot = oth.k_id_estado_ot
                                        WHERE (oth.estado_orden_trabajo_hija != 'Cerrada') 
                                                AND (oth.estado_orden_trabajo_hija != 'Cancelada') 
                                                AND (oth.estado_orden_trabajo_hija != '3- Terminada')
                                                AND (((eot.k_id_tipo = 1 AND ADDDATE(oth.fecha_creacion, INTERVAL 2 DAY) >= CURDATE())
                                                        OR (eot.k_id_tipo = 2 AND ADDDATE(oth.fecha_creacion, INTERVAL 7 DAY) >= CURDATE())
                                                        OR (eot.k_id_tipo = 3 AND ADDDATE(oth.fecha_creacion, INTERVAL 14 DAY) >= CURDATE())
                                                        OR (eot.k_id_tipo = 4 AND ADDDATE(oth.fecha_creacion, INTERVAL 5 DAY) >= CURDATE())
                                                        OR (eot.k_id_tipo = 6 AND ADDDATE(oth.fecha_creacion, INTERVAL 1 DAY) >= CURDATE())
                                                        OR (eot.k_id_tipo = 7 AND ADDDATE(oth.fecha_creacion, INTERVAL 15 DAY) >= CURDATE())
                                                        OR (eot.k_id_tipo = 8 AND ADDDATE(oth.fecha_creacion, INTERVAL 20 DAY) >= CURDATE())
                                                        OR (eot.k_id_tipo = 9 AND ADDDATE(oth.fecha_creacion, INTERVAL 14 DAY) >= CURDATE())
                                                        OR (eot.k_id_tipo = 37 AND ADDDATE(oth.fecha_creacion, INTERVAL 2 DAY) >= CURDATE())
                                                        OR (eot.k_id_tipo = 47 AND ADDDATE(oth.fecha_creacion, INTERVAL 14 DAY) >= CURDATE())
                                                        OR (eot.k_id_tipo = 48 AND ADDDATE(oth.fecha_creacion, INTERVAL 14 DAY) >= CURDATE())
                                                        OR (eot.k_id_tipo = 52 AND ADDDATE(oth.fecha_creacion, INTERVAL 14 DAY) >= CURDATE())
                                                        OR (eot.k_id_tipo = 53 AND ADDDATE(oth.fecha_creacion, INTERVAL 6 DAY) >= CURDATE())
                                                        OR (eot.k_id_tipo = 58 AND ADDDATE(oth.fecha_creacion, INTERVAL 7 DAY) >= CURDATE()))       
                                                OR (eot.k_id_tipo IN (5,10,11,12,39,41,42,46,49,50,51,54,55,56,57,59,60,61,66)))
                                        ORDER by tiempo_vencer ASC;");
            return $query->result();
        } catch (DeplynException $ex) {
            return $ex;
        }
    }


    //trae conteo para pagina principal (resumen)
    public function getCountsSumary(){
        $query = $this->db->query("
                SELECT 
                COUNT(*) count, t.n_name_tipo,
                SUM(CASE
                    WHEN e.k_id_tipo = 1 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 3 DAY)) < 1 THEN 1 
                    WHEN e.k_id_tipo = 2 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 8 DAY)) < 1 THEN 1
                    WHEN e.k_id_tipo = 3 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 15 DAY)) < 1 THEN 1 
                    WHEN e.k_id_tipo = 4 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 6 DAY)) < 1 THEN 1 
                    WHEN e.k_id_tipo = 6 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 2 DAY)) < 1 THEN 1 
                    WHEN e.k_id_tipo = 7 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 16 DAY)) < 1 THEN 1 
                    WHEN e.k_id_tipo = 8 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 21 DAY)) < 1 THEN 1 
                    WHEN e.k_id_tipo = 9 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 15 DAY)) < 1 THEN 1 
                    WHEN e.k_id_tipo = 37 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 3 DAY)) < 1 THEN 1 
                    WHEN e.k_id_tipo = 47 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 15 DAY)) < 1 THEN 1 
                    WHEN e.k_id_tipo = 48 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 15 DAY)) < 1 THEN 1 
                    WHEN e.k_id_tipo = 52 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 15 DAY)) < 1 THEN 1 
                    WHEN e.k_id_tipo = 53 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 7 DAY)) < 1 THEN 1 
                    WHEN e.k_id_tipo = 58 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 8 DAY)) < 1 THEN 1 
                    ELSE 0
                END) AS en_tiempo, 
                SUM(CASE
                    WHEN e.k_id_tipo = 1 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 3 DAY)) >= 1 THEN 1 
                    WHEN e.k_id_tipo = 2 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 8 DAY)) >= 1 THEN 1
                    WHEN e.k_id_tipo = 3 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 15 DAY)) >= 1 THEN 1 
                    WHEN e.k_id_tipo = 4 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 6 DAY)) >= 1 THEN 1 
                    WHEN e.k_id_tipo = 6 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 2 DAY)) >= 1 THEN 1 
                    WHEN e.k_id_tipo = 7 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 16 DAY)) >= 1 THEN 1 
                    WHEN e.k_id_tipo = 8 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 21 DAY)) >= 1 THEN 1 
                    WHEN e.k_id_tipo = 9 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 15 DAY)) >= 1 THEN 1 
                    WHEN e.k_id_tipo = 37 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 3 DAY)) >= 1 THEN 1 
                    WHEN e.k_id_tipo = 47 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 15 DAY)) >= 1 THEN 1 
                    WHEN e.k_id_tipo = 48 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 15 DAY)) >= 1 THEN 1 
                    WHEN e.k_id_tipo = 52 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 15 DAY)) >= 1 THEN 1 
                    WHEN e.k_id_tipo = 53 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 7 DAY)) >= 1 THEN 1 
                    WHEN e.k_id_tipo = 58 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion, INTERVAL 8 DAY)) >= 1 THEN 1 
                    else 0
                END) AS fuera_tiempo
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e
                ON ot.k_id_estado_ot = e.k_id_estado_ot 
                INNER JOIN tipo_ot_hija t 
                ON e.k_id_tipo = t.k_id_tipo
                WHERE 
                e.n_name_estado_ot <> 'Cancelada' AND
                e.n_name_estado_ot <> 'Cerrada' AND
                e.n_name_estado_ot <> '3- Terminada' 
                GROUP BY e.k_id_tipo;
        ");

        return $query->result();
    }

}

