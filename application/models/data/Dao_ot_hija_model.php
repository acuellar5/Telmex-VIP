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

    public function getOtsAssigned($parameters, $search_col) { 
        $start = $parameters['start'];
        $length = $parameters['length'];
        $search = $parameters['search'];
        $limit_start_length = ($length == -1) ? "" : "LIMIT $start, $length";
        $condicion = "";
        if (Auth::user()->n_role_user == 'ingeniero') {
            $usuario_session = Auth::user()->k_id_user;
            $condicion = " AND otp.k_id_user = $usuario_session ";
        }
        if($search){
            $srch  = "AND (otp.n_nombre_cliente LIKE '%".$search."%' OR ";
            $srch .= "ot.nro_ot_onyx LIKE '%".$search."%' OR ";
            $srch .= "otp.fecha_compromiso LIKE '%".$search."%' OR ";
            $srch .= "otp.fecha_programacion LIKE '%".$search."%' OR ";
            $srch .= "ot.id_orden_trabajo_hija LIKE '%".$search."%' OR ";
            $srch .= "ot.ot_hija LIKE '%".$search."%' OR ";
            $srch .= "ot.usuario_asignado LIKE '%".$search."%' OR ";
            $srch .= "CONCAT('$ ',FORMAT(ot.monto_moneda_local_arriendo + ot.monto_moneda_local_cargo_mensual,2)) LIKE '%".$search."%' OR ";
            $srch .= "ot.estado_orden_trabajo_hija LIKE '%".$search."%')";

        } else {
            $srch = "";
        }
        $query = $this->db->query("
                SELECT
                DISTINCT ot.k_id_register, 
                otp.k_id_ot_padre AS nro_ot_onyx,
                ot.id_orden_trabajo_hija,
                otp.n_nombre_cliente AS nombre_cliente,
                otp.fecha_compromiso,
                otp.fecha_programacion,
                ot.ot_hija,
                ot.estado_orden_trabajo_hija,
                ot.usuario_asignado AS ingeniero,
                CONCAT('$ ',FORMAT(ot.monto_moneda_local_arriendo + ot.monto_moneda_local_cargo_mensual,2)) AS MRC,
                CASE
                    WHEN l.id_ot_hija IS NULL THEN '0'
                    ELSE 1 
                END AS 'function'
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot 
                INNER JOIN ot_padre otp 
                ON otp.k_id_ot_padre = ot.nro_ot_onyx 
                LEFT JOIN log l 
                ON ot.id_orden_trabajo_hija = l.id_ot_hija 
                WHERE ot.fecha_actual = CURDATE()  
                $condicion 
                $srch
                $condicion
                $search_col
                ORDER BY tipo_trascurrido DESC

                $limit_start_length 
            ");
        $last_query = $this->db->last_query();
        $cant = $this->db->query("
                SELECT count(1) cant 
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot
                INNER JOIN ot_padre otp 
                ON otp.k_id_ot_padre = ot.nro_ot_onyx 
                WHERE ot.fecha_actual = CURDATE() 
                $condicion 
                $srch
                $search_col
                ORDER BY tipo_trascurrido DESC
            ");
        $cantidad = $cant->row()->cant;
        $retorno = array(
            "query" => $last_query,
            "numDataTotal" => $cantidad,
            "datos" => $query
        );
        return $retorno;
    
    }

    //
    public function m_updateStatusOt($data, $dataLog) {
        $this->db->where('id_orden_trabajo_hija', $data['id_orden_trabajo_hija']);
        $this->db->update('ot_hija', $data);
        $error = $this->db->error();

        $this->db->insert('log', $dataLog);



        if ($error['message']) {
            return 'error';
        } else {
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
                //                     WHERE ADDDATE(ot.fecha_insercion_zolid, INTERVAL 15 DAY) <= CURDATE() 
                // AND ot.k_id_estado_ot = 1 
    public function getOtsFiteenDays($parameters, $search_col) {
        $start = $parameters['start'];
        $length = $parameters['length'];
        $search = $parameters['search'];
        $limit_start_length = ($length == -1) ? "" : "LIMIT $start, $length";
        $condicion = "";
        if (Auth::user()->n_role_user == 'ingeniero') {
            $usuario_session = Auth::user()->k_id_user;
            $condicion = " AND otp.k_id_user = $usuario_session ";
        }
        if($search){
            $srch  = "AND (otp.n_nombre_cliente LIKE '%".$search."%' OR ";
            $srch .= "ot.nro_ot_onyx LIKE '%".$search."%' OR ";
            $srch .= "otp.fecha_compromiso LIKE '%".$search."%' OR ";
            $srch .= "otp.fecha_programacion LIKE '%".$search."%' OR ";
            $srch .= "ot.id_orden_trabajo_hija LIKE '%".$search."%' OR ";
            $srch .= "ot.ot_hija LIKE '%".$search."%' OR ";
            $srch .= "ot.usuario_asignado LIKE '%".$search."%' OR ";
            $srch .= "CONCAT('$ ',FORMAT(ot.monto_moneda_local_arriendo + ot.monto_moneda_local_cargo_mensual,2)) LIKE '%".$search."%' OR ";
            $srch .= "ot.estado_orden_trabajo_hija LIKE '%".$search."%')";

        } else {
            $srch = "";
        }
        $query = $this->db->query("
                SELECT 
                DISTINCT ot.k_id_register, 
                otp.k_id_ot_padre AS nro_ot_onyx,
                ot.id_orden_trabajo_hija,
                otp.n_nombre_cliente AS nombre_cliente,
                otp.fecha_compromiso,
                otp.fecha_programacion,
                ot.ot_hija,
                ot.estado_orden_trabajo_hija,
                ot.usuario_asignado AS ingeniero,
                CONCAT('$ ',FORMAT(ot.monto_moneda_local_arriendo + ot.monto_moneda_local_cargo_mensual,2)) AS MRC,
                CASE
                    WHEN l.id_ot_hija IS NULL THEN '0'
                    ELSE 1 
                END AS 'function'
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot 
                INNER JOIN ot_padre otp 
                ON otp.k_id_ot_padre = ot.nro_ot_onyx 
                LEFT JOIN log l 
                ON ot.id_orden_trabajo_hija = l.id_ot_hija 
                WHERE ADDDATE(ot.fecha_insercion_zolid, INTERVAL 15 DAY) <= CURDATE() 
                AND ot.k_id_estado_ot = 1 
                $srch
                $condicion
                $search_col
                $limit_start_length 
            ");
        $last_query = $this->db->last_query();
        $cant = $this->db->query("
                SELECT count(1) cant 
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot 
                INNER JOIN ot_padre otp 
                ON otp.k_id_ot_padre = ot.nro_ot_onyx
                WHERE ADDDATE(ot.fecha_insercion_zolid, INTERVAL 15 DAY) <= CURDATE() 
                AND ot.k_id_estado_ot = 1 
                $srch
                $condicion
                $search_col
            ");
        $cantidad = $cant->row()->cant;
        $retorno = array(
            "query" => $last_query,
            "numDataTotal" => $cantidad,
            "datos" => $query
        );
        return $retorno;
    
    }

    // llama el primer elemento dependiendo el id rf
    public function getExistIdOtHija($id) {
        $query = $this->db->query("
            SELECT 
            ot.id_orden_trabajo_hija,
            ot.k_id_estado_ot,
            otp.k_id_user,
            ot.usuario_asignado,
            otp.estado_orden_trabajo,
            ot.tiempo_estado,
            ot.descripcion,
            otp.fecha_compromiso,
            otp.fecha_programacion,
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
            INNER JOIN ot_padre otp 
            ON ot.nro_ot_onyx = otp.k_id_ot_padre
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
        $query = $this->db->query("UPDATE ot_hija SET estado_mod = " . $data['estado_mod'] . ", fecha_actual = '" . $data['fecha_actual'] . "'  WHERE id_orden_trabajo_hija = " . $data['id_orden_trabajo_hija'] . ";");

        $error = $this->db->error();
        if ($error['message']) {
            // print_r($error);
            return $error;
        } else {
            return 1;
        }
    }

    // Actualiza ot 
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
    public function     getAllOtPS($parameters, $search_col){

        // reasigno las variables para q sean mas dicientes y manejables
        $start = $parameters['start'];
        $length = $parameters['length'];
        $search = $parameters['search'];
        // $order = $parameters['order'];
        // $columm = $parameters['columm'];

        // Cuando le da all genera un -1
        $limit_start_length = ($length == -1) ? "" : "LIMIT $start, $length";
        // $order_by = ($columm == 'function') ? "" : "ORDER BY $columm $order";


        // Cuando el usuario logueado es un ingeniero... si es admin puede ver todo
        $condicion = "";
        if (Auth::user()->n_role_user == 'ingeniero') {
            $usuario_session = Auth::user()->k_id_user;
            $condicion = " AND otp.k_id_user = $usuario_session ";
        }
        // si el usuario escribio algo en el buscador se concatena el where + lo que debe buscar
        if($search){
            $srch  = "AND (otp.n_nombre_cliente LIKE '%".$search."%' OR ";
            $srch .= "ot.nro_ot_onyx LIKE '%".$search."%' OR ";
            $srch .= "otp.fecha_compromiso LIKE '%".$search."%' OR ";
            $srch .= "otp.fecha_programacion LIKE '%".$search."%' OR ";
            $srch .= "ot.id_orden_trabajo_hija LIKE '%".$search."%' OR ";
            $srch .= "ot.ot_hija LIKE '%".$search."%' OR ";
            $srch .= "ot.usuario_asignado LIKE '%".$search."%' OR ";
            $srch .= "CONCAT('$ ',FORMAT(ot.monto_moneda_local_arriendo + ot.monto_moneda_local_cargo_mensual,2)) LIKE '%".$search."%' OR ";
            $srch .= "ot.estado_orden_trabajo_hija LIKE '%".$search."%')";

        } else {
            // Si no escribio nada en el buscador se pasa vacio
            $srch = "";
        }
        // Hago la consulta deseada y le añado where, order by, y limit, dependiendo la peticion que venga en las variables
        $query = $this->db->query("
                SELECT 
                DISTINCT ot.k_id_register, 
                otp.k_id_ot_padre AS nro_ot_onyx,
                ot.id_orden_trabajo_hija,
                otp.n_nombre_cliente AS nombre_cliente,
                otp.fecha_compromiso,
                otp.fecha_programacion,
                ot.ot_hija,
                ot.estado_orden_trabajo_hija,
                ot.usuario_asignado AS ingeniero,
                CONCAT('$ ',FORMAT(ot.monto_moneda_local_arriendo + ot.monto_moneda_local_cargo_mensual,2)) AS MRC,
                CASE
                    WHEN l.id_ot_hija IS NULL THEN '0'
                    ELSE 1 
                END AS 'function'
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot
                INNER JOIN ot_padre otp 
                ON otp.k_id_ot_padre = ot.nro_ot_onyx 
                LEFT JOIN log l 
                ON ot.id_orden_trabajo_hija = l.id_ot_hija 
                WHERE 1 = 1 
                $srch
                $condicion
                $search_col
                $limit_start_length 
            ");
        // Para imprimir la consulta
        $last_query = $this->db->last_query();
        // cant de registros es necesaria para saber cuanto es el total de registros sin filtros existentes en la consulta
        $cant = $this->db->query("
                SELECT count(1) cant 
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot 
                INNER JOIN ot_padre otp 
                ON otp.k_id_ot_padre = ot.nro_ot_onyx 
                WHERE 1 = 1 
                $srch
                $condicion
                $search_col
            ");
        // en cantidad solo necesito la cantidad numerica
        $cantidad = $cant->row()->cant;


        // retorno el objeto de la primera consulta entre ellos ->result() y -> num_rows() en la posicion datos y la cantidad total
        $retorno = array(
            "query" => $last_query,
            "numDataTotal" => $cantidad,
            "datos" => $query
        );

        return $retorno;
    }

    public function getOtsNew($parameters, $search_col) {
        $start = $parameters['start'];
        $length = $parameters['length'];
        $search = $parameters['search'];
        $limit_start_length = ($length == -1) ? "" : "LIMIT $start, $length";
        $condicion = "";
        if (Auth::user()->n_role_user == 'ingeniero') {
            $usuario_session = Auth::user()->k_id_user;
            $condicion = " AND otp.k_id_user = $usuario_session ";
        }
        if($search){
            $srch  = "AND (otp.n_nombre_cliente LIKE '%".$search."%' OR ";
            $srch .= "ot.nro_ot_onyx LIKE '%".$search."%' OR ";
            $srch .= "otp.fecha_compromiso LIKE '%".$search."%' OR ";
            $srch .= "otp.fecha_programacion LIKE '%".$search."%' OR ";
            $srch .= "ot.id_orden_trabajo_hija LIKE '%".$search."%' OR ";
            $srch .= "ot.ot_hija LIKE '%".$search."%' OR ";
            $srch .= "ot.usuario_asignado LIKE '%".$search."%' OR ";
            $srch .= "CONCAT('$ ',FORMAT(ot.monto_moneda_local_arriendo + ot.monto_moneda_local_cargo_mensual,2)) LIKE '%".$search."%' OR ";
            $srch .= "ot.estado_orden_trabajo_hija LIKE '%".$search."%')";

        } else {
            $srch = "";
        }
        $query = $this->db->query("
                SELECT 
                DISTINCT ot.k_id_register, 
                otp.k_id_ot_padre AS nro_ot_onyx,
                ot.id_orden_trabajo_hija,
                otp.n_nombre_cliente AS nombre_cliente,
                otp.fecha_compromiso,
                otp.fecha_programacion,
                ot.ot_hija,
                ot.estado_orden_trabajo_hija,
                ot.usuario_asignado AS ingeniero,
                CONCAT('$ ',FORMAT(ot.monto_moneda_local_arriendo + ot.monto_moneda_local_cargo_mensual,2)) AS MRC,
                CASE
                        WHEN l.id_ot_hija IS NULL THEN '0'
                        ELSE 1 
                END AS 'function'
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot 
                INNER JOIN ot_padre otp 
                ON otp.k_id_ot_padre = ot.nro_ot_onyx
                LEFT JOIN log l 
                ON ot.id_orden_trabajo_hija = l.id_ot_hija 
                WHERE estado_mod = 0 
                $srch
                $condicion
                $search_col
                $limit_start_length 
            ");
        $last_query = $this->db->last_query();
        $cant = $this->db->query("
                SELECT count(1) cant 
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot 
                INNER JOIN ot_padre otp 
                ON otp.k_id_ot_padre = ot.nro_ot_onyx
                WHERE estado_mod = 0 
                $srch
                $condicion
                $search_col
            ");
        $cantidad = $cant->row()->cant;
        $retorno = array(
            "query" => $last_query,
            "numDataTotal" => $cantidad,
            "datos" => $query
        );
        return $retorno;
    }

                                // -- WHERE estado_mod = 1
    public function getOtsChange($parameters, $search_col) {
        $start = $parameters['start'];
        $length = $parameters['length'];
        $search = $parameters['search'];
        $limit_start_length = ($length == -1) ? "" : "LIMIT $start, $length";
        $condicion = "";
        if (Auth::user()->n_role_user == 'ingeniero') {
            $usuario_session = Auth::user()->k_id_user;
            $condicion = " AND otp.k_id_user = $usuario_session ";
        }
        if($search){
            $srch  = "AND (otp.n_nombre_cliente LIKE '%".$search."%' OR ";
            $srch .= "ot.nro_ot_onyx LIKE '%".$search."%' OR ";
            $srch .= "otp.fecha_compromiso LIKE '%".$search."%' OR ";
            $srch .= "otp.fecha_programacion LIKE '%".$search."%' OR ";
            $srch .= "ot.id_orden_trabajo_hija LIKE '%".$search."%' OR ";
            $srch .= "ot.ot_hija LIKE '%".$search."%' OR ";
            $srch .= "ot.usuario_asignado LIKE '%".$search."%' OR ";
            $srch .= "CONCAT('$ ',FORMAT(ot.monto_moneda_local_arriendo + ot.monto_moneda_local_cargo_mensual,2)) LIKE '%".$search."%' OR ";
            $srch .= "ot.estado_orden_trabajo_hija LIKE '%".$search."%')";

        } else {
            $srch = "";
        }
        $query = $this->db->query("
                SELECT 
                DISTINCT ot.k_id_register, 
                otp.k_id_ot_padre AS nro_ot_onyx,
                ot.id_orden_trabajo_hija,
                otp.n_nombre_cliente AS nombre_cliente,
                otp.fecha_compromiso,
                otp.fecha_programacion,
                ot.ot_hija,
                ot.estado_orden_trabajo_hija,
                ot.usuario_asignado AS ingeniero,
                CONCAT('$ ',FORMAT(ot.monto_moneda_local_arriendo + ot.monto_moneda_local_cargo_mensual,2)) AS MRC,
                CASE
                        WHEN l.id_ot_hija IS NULL THEN '0'
                        ELSE 1 
                END AS 'function'
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot
                INNER JOIN ot_padre otp 
                ON otp.k_id_ot_padre = ot.nro_ot_onyx
                LEFT JOIN log l 
                ON ot.id_orden_trabajo_hija = l.id_ot_hija 
                WHERE estado_mod = 1 
                $srch
                $condicion
                $search_col
                $limit_start_length 
            ");
        $last_query = $this->db->last_query();
        $cant = $this->db->query("
                SELECT count(1) cant 
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e 
                ON ot.k_id_estado_ot = e.k_id_estado_ot 
                INNER JOIN ot_padre otp 
                ON otp.k_id_ot_padre = ot.nro_ot_onyx
                WHERE estado_mod = 1 
                $srch
                $condicion
                $search_col 
            ");
        $cantidad = $cant->row()->cant;
        $retorno = array(
            "query" => $last_query,
            "numDataTotal" => $cantidad,
            "datos" => $query
        );
        return $retorno;
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

    public function getOtsOutTime($idTipo) {
        try {
            $db = new DB();
            $condicion = "";
            $usuario_session = Auth::user()->k_id_user;
            if (Auth::user()->n_role_user == 'ingeniero') {
                $condicion .= " AND otp.k_id_user = $usuario_session";
            }
            if ($idTipo) {
                $condicion .= " AND eot.k_id_tipo = $idTipo";
            }
            $query = $this->db->query("SELECT 
                                        oth.k_id_estado_ot,
                                        oth.nro_ot_onyx,
                                        oth.id_orden_trabajo_hija,
                                        otp.n_nombre_cliente AS nombre_cliente,
                                        tot.n_name_tipo,
                                        oth.estado_orden_trabajo_hija,
                                        CONCAT(user.n_name_user, ' ', user.n_last_name_user) AS ingeniero,
                                        DATE_FORMAT(otp.fecha_creacion, '%Y-%m-%d') AS fecha_creacion,
                                        CONCAT('$ ',FORMAT(monto_moneda_local_arriendo + monto_moneda_local_cargo_mensual,2)) AS MRC,
                                        CASE
                                            WHEN eot.k_id_tipo = 1 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 3 DAY))
                                            WHEN eot.k_id_tipo = 2 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 8 DAY))
                                            WHEN eot.k_id_tipo = 3 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY))
                                            WHEN eot.k_id_tipo = 4 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 6 DAY))
                                            WHEN eot.k_id_tipo = 6 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 2 DAY))
                                            WHEN eot.k_id_tipo = 7 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 16 DAY))
                                            WHEN eot.k_id_tipo = 8 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 21 DAY))
                                            WHEN eot.k_id_tipo = 9 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY))
                                            WHEN eot.k_id_tipo = 37 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 3 DAY))
                                            WHEN eot.k_id_tipo = 47 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY))
                                            WHEN eot.k_id_tipo = 48 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY))
                                            WHEN eot.k_id_tipo = 52 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY))
                                            WHEN eot.k_id_tipo = 53 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 7 DAY))
                                            WHEN eot.k_id_tipo = 58 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 8 DAY))
                                        END AS tiempo_vencidas
                                        FROM ot_hija oth
                                        INNER JOIN estado_ot eot ON eot.k_id_estado_ot = oth.k_id_estado_ot
                                        INNER JOIN tipo_ot_hija tot ON tot.k_id_tipo = eot.k_id_tipo
                                        INNER JOIN ot_padre otp ON otp.k_id_ot_padre = oth.nro_ot_onyx
                                        INNER JOIN user ON user.k_id_user = otp.k_id_user
                                        WHERE oth.estado_orden_trabajo_hija != 'Cerrada' 
                                        AND oth.estado_orden_trabajo_hija != 'Cancelada' 
                                        AND oth.estado_orden_trabajo_hija != '3- Terminada'
                                        AND ((eot.k_id_tipo = 1 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 3 DAY) <= CURDATE())
                                            OR (eot.k_id_tipo = 2 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 8 DAY) <= CURDATE())
                                            OR (eot.k_id_tipo = 3 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY) <= CURDATE())
                                            OR (eot.k_id_tipo = 4 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 6 DAY) <= CURDATE())
                                            OR (eot.k_id_tipo = 6 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 2 DAY) <= CURDATE())
                                            OR (eot.k_id_tipo = 7 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 16 DAY) <= CURDATE())
                                            OR (eot.k_id_tipo = 8 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 21 DAY) <= CURDATE())
                                            OR (eot.k_id_tipo = 9 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY) <= CURDATE())
                                            OR (eot.k_id_tipo = 37 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 3 DAY) <= CURDATE())
                                            OR (eot.k_id_tipo = 47 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY) <= CURDATE())
                                            OR (eot.k_id_tipo = 48 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY) <= CURDATE())
                                            OR (eot.k_id_tipo = 52 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY) <= CURDATE())
                                            OR (eot.k_id_tipo = 53 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 7 DAY) <= CURDATE())
                                            OR (eot.k_id_tipo = 58 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 8 DAY) <= CURDATE()))
                                        $condicion
                                        ORDER by tiempo_vencidas DESC");
            return $query->result();
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    public function getOtsInTimes($idTipo) {
        try {
            $db = new DB();
            $condicion = "";
            $usuario_session = Auth::user()->k_id_user;
            if (Auth::user()->n_role_user == 'ingeniero') {
                $condicion .= " AND otp.k_id_user = $usuario_session";
            }
            if ($idTipo) {
                $condicion .= " AND eot.k_id_tipo = $idTipo";
            }
            $query = $this->db->query("SELECT 
                                    oth.nro_ot_onyx,
                                    oth.id_orden_trabajo_hija,
                                    otp.n_nombre_cliente AS nombre_cliente,
                                    tot.n_name_tipo,
                                    oth.estado_orden_trabajo_hija,
                                    CONCAT(user.n_name_user, ' ', user.n_last_name_user) AS ingeniero,
                                    DATE_FORMAT(otp.fecha_creacion, '%Y-%m-%d') AS fecha_creacion,
                                    CONCAT('$ ',FORMAT(monto_moneda_local_arriendo + monto_moneda_local_cargo_mensual,2)) AS MRC,
                                    oth.k_id_estado_ot,
                                    CASE
                                        WHEN eot.k_id_tipo = 1 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 2 DAY))
                                        WHEN eot.k_id_tipo = 2 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 7 DAY))
                                        WHEN eot.k_id_tipo = 3 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY))
                                        WHEN eot.k_id_tipo = 4 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 5 DAY))
                                        WHEN eot.k_id_tipo = 6 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 1 DAY))
                                        WHEN eot.k_id_tipo = 7 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY))
                                        WHEN eot.k_id_tipo = 8 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 20 DAY))
                                        WHEN eot.k_id_tipo = 9 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY))
                                        WHEN eot.k_id_tipo = 37 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 2 DAY))
                                        WHEN eot.k_id_tipo = 47 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY))
                                        WHEN eot.k_id_tipo = 48 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY))
                                        WHEN eot.k_id_tipo = 52 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY))
                                        WHEN eot.k_id_tipo = 53 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 6 DAY))
                                        WHEN eot.k_id_tipo = 58 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 7 DAY))
                                        ELSE 'en tiempos'
                                    END AS tiempo_vencer
                                    FROM ot_hija oth
                                    INNER JOIN estado_ot eot ON eot.k_id_estado_ot = oth.k_id_estado_ot
                                    INNER JOIN tipo_ot_hija tot ON tot.k_id_tipo = eot.k_id_tipo
                                    INNER JOIN ot_padre otp ON otp.k_id_ot_padre = oth.nro_ot_onyx
                                    INNER JOIN user ON user.k_id_user = otp.k_id_user
                                    WHERE (oth.estado_orden_trabajo_hija != 'Cerrada') 
                                            AND (oth.estado_orden_trabajo_hija != 'Cancelada') 
                                            AND (oth.estado_orden_trabajo_hija != '3- Terminada')
                                            AND (((eot.k_id_tipo = 1 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 2 DAY) >= CURDATE())
                                                OR (eot.k_id_tipo = 2 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 7 DAY) >= CURDATE())
                                                OR (eot.k_id_tipo = 3 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY) >= CURDATE())
                                                OR (eot.k_id_tipo = 4 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 5 DAY) >= CURDATE())
                                                OR (eot.k_id_tipo = 6 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 1 DAY) >= CURDATE())
                                                OR (eot.k_id_tipo = 7 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY) >= CURDATE())
                                                OR (eot.k_id_tipo = 8 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 20 DAY) >= CURDATE())
                                                OR (eot.k_id_tipo = 9 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY) >= CURDATE())
                                                OR (eot.k_id_tipo = 37 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 2 DAY) >= CURDATE())
                                                OR (eot.k_id_tipo = 47 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY) >= CURDATE())
                                                OR (eot.k_id_tipo = 48 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY) >= CURDATE())
                                                OR (eot.k_id_tipo = 52 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY) >= CURDATE())
                                                OR (eot.k_id_tipo = 53 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 6 DAY) >= CURDATE())
                                                OR (eot.k_id_tipo = 58 AND ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 7 DAY) >= CURDATE()))       
                                            OR (eot.k_id_tipo IN (5,10,11,12,39,41,42,46,49,50,51,54,55,56,57,59,60,61,62,66)))
                                            $condicion
                                        ORDER BY LENGTH(tiempo_vencer),tiempo_vencer ASC");
            return $query->result();
        } catch (DeplynException $ex) {
            return $ex;
        }
    }

    //trae conteo para pagina principal (resumen)
    public function getCountsSumary() {
        $condicion = "";
        $usuario_session = Auth::user()->k_id_user;
        if (Auth::user()->n_role_user == 'ingeniero') {
            $condicion = "AND otp.k_id_user = $usuario_session";
        }
        $query = $this->db->query("
                SELECT 
                COUNT(1) count, t.n_name_tipo,
                SUM(CASE
                        WHEN e.k_id_tipo = 1 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 2 DAY)) < 1 THEN 1 
                        WHEN e.k_id_tipo = 2 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 7 DAY)) < 1 THEN 1
                        WHEN e.k_id_tipo = 3 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 14 DAY)) < 1 THEN 1 
                        WHEN e.k_id_tipo = 4 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 5 DAY)) < 1 THEN 1 
                        WHEN e.k_id_tipo = 6 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 1 DAY)) < 1 THEN 1 
                        WHEN e.k_id_tipo = 7 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 15 DAY)) < 1 THEN 1 
                        WHEN e.k_id_tipo = 8 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 20 DAY)) < 1 THEN 1 
                        WHEN e.k_id_tipo = 9 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 14 DAY)) < 1 THEN 1 
                        WHEN e.k_id_tipo = 37 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 2 DAY)) < 1 THEN 1 
                        WHEN e.k_id_tipo = 47 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 14 DAY)) < 1 THEN 1 
                        WHEN e.k_id_tipo = 48 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 14 DAY)) < 1 THEN 1 
                        WHEN e.k_id_tipo = 52 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 14 DAY)) < 1 THEN 1 
                        WHEN e.k_id_tipo = 53 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 6 DAY)) < 1 THEN 1 
                        WHEN e.k_id_tipo = 58 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 7 DAY)) < 1 THEN 1 
                        ELSE 0
                END) AS en_tiempo, 
                SUM(CASE
                        WHEN e.k_id_tipo = 1 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 3 DAY)) >= 0 THEN 1 
                        WHEN e.k_id_tipo = 2 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 8 DAY)) >= 0 THEN 1
                        WHEN e.k_id_tipo = 3 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 15 DAY)) >= 0 THEN 1 
                        WHEN e.k_id_tipo = 4 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 6 DAY)) >= 0 THEN 1 
                        WHEN e.k_id_tipo = 6 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 2 DAY)) >= 0 THEN 1 
                        WHEN e.k_id_tipo = 7 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 16 DAY)) >= 0 THEN 1 
                        WHEN e.k_id_tipo = 8 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 21 DAY)) >= 0 THEN 1 
                        WHEN e.k_id_tipo = 9 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 15 DAY)) >= 0 THEN 1 
                        WHEN e.k_id_tipo = 37 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 3 DAY)) >= 0 THEN 1 
                        WHEN e.k_id_tipo = 47 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 15 DAY)) >= 0 THEN 1 
                        WHEN e.k_id_tipo = 48 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 15 DAY)) >= 0 THEN 1 
                        WHEN e.k_id_tipo = 52 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 15 DAY)) >= 0 THEN 1 
                        WHEN e.k_id_tipo = 53 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 7 DAY)) >= 0 THEN 1 
                        WHEN e.k_id_tipo = 58 AND DATEDIFF(CURDATE(),ADDDATE(ot.fecha_creacion_ot_hija, INTERVAL 8 DAY)) >= 0 THEN 1 
                        else 0
                END) AS fuera_tiempo, e.k_id_tipo
                FROM 
                ot_hija ot
                INNER JOIN estado_ot e
                ON ot.k_id_estado_ot = e.k_id_estado_ot 
                INNER JOIN tipo_ot_hija t 
                ON e.k_id_tipo = t.k_id_tipo
                INNER JOIN ot_padre otp 
                ON otp.k_id_ot_padre = ot.nro_ot_onyx
                WHERE 
                ot.estado_orden_trabajo_hija <> 'Cancelada' AND
                ot.estado_orden_trabajo_hija <> 'Cerrada' AND
                ot.estado_orden_trabajo_hija <> '3- Terminada' 
                $condicion
                GROUP BY e.k_id_tipo
        ");

        return $query->result();
    }

    //Retorna la cantidad de registros irregulares en un array
    public function getCantUndefined() {
        $data['indefinidos'] = $this->getCantIndefinidos();
        $data['nulos'] = $this->getCantNull();
        $data['new_types'] = $this->cant_new_types();
        $data['new_status'] = $this->cant_new_status();
        return $data;
    }

    //Retorna la cantidad de registros con estado indefinido 
    public function getCantIndefinidos() {
        $query = $this->db->query("
            SELECT 
            COUNT(1) AS cant 
            FROM 
            ot_hija
            where 
            k_id_estado_ot = 189
        ");

        return $query->row()->cant;
    }

    //Retorna la cantidad de registros con estado nulo
    public function getCantNull() {
        $query = $this->db->query("
            SELECT 
            COUNT(1) AS cant 
            FROM 
            ot_hija
            where
            k_id_estado_ot  IS NULL
        ");

        return $query->row()->cant;
    }

    //Retorna cantidad de tipos nuevos en el sistema
    public function cant_new_types() {
        $query = $this->db->query("
            SELECT 
            count(distinct ot_hija) AS cant 
            FROM   
            ot_hija 
            WHERE 
            k_id_estado_ot = 189
        ");

        return $query->row()->cant;
    }

    //Retorna cantidad de estados nuevos en el sistema
    public function cant_new_status() {
        $query = $this->db->query("
            SELECT 
            COUNT(DISTINCT(CONCAT(ot_hija, estado_orden_trabajo_hija))) AS cant 
            FROM 
            ot_hija 
            WHERE 
            k_id_estado_ot is NULL 
        ");

        return $query->row()->cant;
    }

    ////Retorna la cantidad de registros con estado indefinido 
    public function getTypeUndefined() {
        $query = $this->db->query("
            SELECT 
            ot_hija , count(ot_hija) as cant
            FROM   
            ot_hija 
            WHERE 
            k_id_estado_ot = 189
            group by ot_hija
        ");
        return $query->result();
    }

    //retorna estados por nombre de tipo
    public function getNewStatusByType($name, $isNull = null) {
        $condicion = "";
        if (!$isNull) {
            $condicion = "k_id_estado_ot = 189 AND";
        }

        $query = $this->db->query("
                SELECT distinct estado_orden_trabajo_hija 
                FROM 
                ot_hija
                WHERE
                $condicion  
                ot_hija = '$name'
            ");
        return $query->result();
    }

    //trae registros estado indefinido por nombre de estado y ot_hija (tipo)
    public function update_regis_indef_by_estado($id_type, $type, $name_status) {
        $query = $this->db->query("
                SELECT 
                k_id_estado_ot 
                FROM 
                estado_ot
                where 
                n_name_estado_ot = '$name_status' and 
                k_id_tipo = '$id_type'
            ");
        if ($query->row()->k_id_estado_ot) {

            $id_estado_ot = $query->row()->k_id_estado_ot;

            $where = array(
                'k_id_estado_ot' => '189',
                'estado_orden_trabajo_hija' => $name_status,
                'ot_hija' => $type
            );

            $data = array(
                'k_id_estado_ot' => $id_estado_ot
            );

            $this->db->where($where);
            $this->db->update('ot_hija', $data);

            // print_r($this->db->last_query());
            $afectados = $this->db->affected_rows();

            return $afectados;
        } else {
            return 0;
        }
    }

    ////Retorna la cantidad de registros con estado nulo
    public function getStatusNull() {
        $query = $this->db->query("
            SELECT ot_hija, estado_orden_trabajo_hija, count(ot_hija) as cant
            FROM ot_hija 
            WHERE k_id_estado_ot is null
            GROUP BY ot_hija
        ");
        return $query->result();
    }

    // retorna las ot por nombre del tipo (ot_hija) 
    public function get_ot_by_tipo($name_type) {
        $query = $this->db->get_where('ot_hija', array('ot_hija' => $name_type));
        return $query->result();
    }

    //Trae los datos de la tabla inconsistencias 
    public function print_tabl() {
        $query = $this->db->query("
            SELECT o.nro_ot_onyx AS ot_padre, o.id_orden_trabajo_hija AS ot_hija,
            o.nombre_cliente AS cliente, o.orden_trabajo AS trabajo, 
            o.servicio AS servicio, o.fecha_creacion AS fecha_creacion,
            o.ot_hija AS tipo, o.estado_orden_trabajo_hija AS estado,
            concat(u.n_name_user, ' ', u.n_last_name_user) AS nombre_usuario,
            i.fecha_mod AS fecha_modificacion, i.en_zolid AS zolid,
            i.en_excel AS excel, i.k_id_inconsistencia AS id_inc
            FROM inconcistencia i
            INNER JOIN user u 
            ON i.k_id_user = u.k_id_user
            INNER JOIN ot_hija o
            ON o.id_orden_trabajo_hija = i.id_ot_hija
            WHERE estado_ver = 1
            ;
            ");
        return $query->result();
    }

    // Actualizar tabla ot por id register
    public function update_ot_hija($data) {
        $this->db->where('k_id_register', $data['k_id_register']);
        $this->db->update('ot_hija', $data);

        $error = $this->db->error();

        if ($error['message']) {
            return 1;
        } else {
            return 0;
        }
    }

    public function geStatusByType($name) {
        $query = $this->db->query("
                SELECT et.n_name_estado_ot 
                FROM estado_ot et
                INNER JOIN tipo_ot_hija toh ON toh.k_id_tipo = et.k_id_tipo OR toh.i_referencia = et.k_id_tipo
                WHERE toh.n_name_tipo = '$name'
            ");
        return $query->result();
    }

    //trae registros estado null por nombre de estado y ot_hija (tipo)
    public function update_regis_null_by_estado($id_estado_ot, $type, $name_status) {
        $where = array(
            'k_id_estado_ot' => null,
            'estado_orden_trabajo_hija' => $name_status,
            'ot_hija' => $type
        );

        $data = array(
            'k_id_estado_ot' => $id_estado_ot
        );

        $this->db->where($where);
        $this->db->update('ot_hija', $data);
        // print_r($this->db->last_query());
        $afectados = $this->db->affected_rows();

        return $afectados;
    }

    public function getAllOtsUndefined() {
        $query = $this->db->query("
            SELECT oth.nro_ot_onyx, 
            oth.id_orden_trabajo_hija, 
            otp.n_nombre_cliente AS nombre_cliente, 
            oth.ot_hija, 
            oth.estado_orden_trabajo_hija, 
            otp.fecha_creacion 
            FROM ot_hija oth
            INNER JOIN ot_padre otp
            ON otp.k_id_ot_padre = oth.nro_ot_onyx
            WHERE oth.k_id_estado_ot = '189'
    ");
        return $query->result();
    }
    
// trae las ot hijas que tengan estado en NULL
    public function getListOtsNull(){
    $query = $this->db->query("
        SELECT oth.nro_ot_onyx, 
        oth.id_orden_trabajo_hija, 
        otp.n_nombre_cliente AS nombre_cliente, 
        oth.ot_hija, 
        oth.estado_orden_trabajo_hija, 
        otp.fecha_creacion 
        FROM ot_hija oth
        INNER JOIN ot_padre otp
        ON otp.k_id_ot_padre = oth.nro_ot_onyx
        WHERE oth.k_id_estado_ot IS NULL
    ");
    return $query->result();
  }
  //actualiza la columna ver a 0
  public function upVerTo_0(){
        $this->db->where('k_id_inconsistencia', $data['k_id_inconsistencia']);
        $this->db->update('inconcistencia', $data);
  }

    // obtiene toda la informacion de una ot hija y otp por id de oth
    public function getothija($idOth){
    $query = $this->db->query("
        
        SELECT e.k_id_tipo, e.i_orden, oth.id_orden_trabajo_hija, oth.k_id_estado_ot,otp.id_cliente_onyx, otp.n_nombre_cliente, oth.grupo_objetivo, oth.segmento, 
        oth.nivel_atencion, oth.ciudad, oth.departamento, oth.grupo,
        oth.consultor_comercial, oth.grupo2, oth.consultor_postventa, 
        oth.proy_instalacion, oth.ing_responsable, oth.id_enlace, 
        oth.alias_enlace, otp.servicio, otp.orden_trabajo,
        oth.familia, oth.producto, otp.fecha_creacion, oth.tiempo_incidente,
        otp.estado_orden_trabajo, oth.tiempo_estado, oth.ano_ingreso_estado,
        oth.mes_ngreso_estado, oth.fecha_ingreso_estado, oth.usuario_asignado,
        oth.grupo_asignado, oth.ingeniero_provisioning, oth.cargo_arriendo,
        oth.cargo_mensual, oth.monto_moneda_local_arriendo, oth.cargo_obra_civil,
        oth.monto_moneda_local_cargo_mensual, oth.descripcion, oth.direccion_origen,
        oth.ciudad_incidente, oth.direccion_destino, oth.ciudad_incidente3,
        otp.fecha_compromiso, otp.fecha_programacion, oth.fecha_realizacion,
        oth.resolucion_1, oth.resolucion_2, oth.resolucion_3, oth.resolucion_4, 
        oth.ot_hija, oth.estado_orden_trabajo_hija, oth.fecha_creacion_ot_hija,
        oth.usuario_asignado4, oth.resolucion_15, oth.resolucion_26, oth.resolucion_37,
        oth.resolucion_48, oth.fec_actualizacion_onyx_hija, oth.tipo_trascurrido, 
        oth.nro_ot_onyx, otp.k_id_ot_padre, oth.proveedor_ultima_milla
        FROM ot_hija oth
        INNER JOIN ot_padre otp ON oth.nro_ot_onyx= otp.k_id_ot_padre
        INNER JOIN estado_ot e ON oth.k_id_estado_ot = e.k_id_estado_ot 
        WHERE oth.id_orden_trabajo_hija = $idOth
    ");
    return $query->row();
  }


  //retorna oth filtradas por id usuario, una otpadre, y un idtipo
  public function get_oth_by_iduser_otp_idtipo($iduser, $otp, $idtipo){
      $query = $this->db->query("
            SELECT 
            oth.id_orden_trabajo_hija, oth.k_id_estado_ot, e.n_name_estado_ot, oth.fecha_creacion_ot_hija, 
            
            CASE
                WHEN e.k_id_tipo = 1 then  DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 2 DAY)) 
                
                WHEN e.k_id_tipo = 2 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 7 DAY))
                WHEN e.k_id_tipo = 3 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY)) 
                WHEN e.k_id_tipo = 4 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 5 DAY)) 
                WHEN e.k_id_tipo = 6 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 1 DAY)) 
                WHEN e.k_id_tipo = 7 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY)) 
                WHEN e.k_id_tipo = 8 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 20 DAY)) 
                WHEN e.k_id_tipo = 9 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY)) 
                WHEN e.k_id_tipo = 37 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 2 DAY)) 
                WHEN e.k_id_tipo = 47 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY)) 
                WHEN e.k_id_tipo = 48 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY)) 
                WHEN e.k_id_tipo = 52 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY)) 
                WHEN e.k_id_tipo = 53 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 6 DAY)) 
                WHEN e.k_id_tipo = 58 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 7 DAY))  
            ELSE -999
            END as tiempo

            FROM 
            ot_hija oth
            INNER JOIN 
            ot_padre otp
            ON oth.nro_ot_onyx = otp.k_id_ot_padre 
            INNER JOIN 
            estado_ot e 
            ON oth.k_id_estado_ot = e.k_id_estado_ot 
            WHERE 
            otp.k_id_user = '$iduser' AND 
            oth.nro_ot_onyx = '$otp' AND 
            e.k_id_tipo = '$idtipo'        
        ");
      return $query->result();
  }

  // trae otp filtradas por los argumentos
  public function get_oth_where($iduser, $otp, $idtipo, $oth){
    $where = "";
    $where .= ($iduser)? "AND otp.k_id_user = '$iduser' " : "";
    $where .= ($otp) ? " AND oth.nro_ot_onyx = '$otp' " : "";
    $where .= ($idtipo) ? " AND e.k_id_tipo = '$idtipo'" : "";
    $where .= ($oth) ? " AND oth.id_orden_trabajo_hija = '$oth'" : "";

      $query = $this->db->query("
             SELECT 
            oth.id_orden_trabajo_hija, oth.ot_hija, oth.estado_orden_trabajo_hija, oth.fecha_creacion_ot_hija,
            CONCAT(u.n_name_user,' ' , u.n_last_name_user) AS nombre
            FROM 
            ot_hija oth
            INNER JOIN ot_padre otp 
            ON oth.nro_ot_onyx = otp.k_id_ot_padre
            INNER JOIN estado_ot e 
            ON oth.k_id_estado_ot = e.k_id_estado_ot 
            INNER JOIN user u 
            ON otp.k_id_user = u.k_id_user
            WHERE 1=1 
            $where
        ");


    $where2 = ""; 
    $where2 .= ($iduser)? "AND otp.k_id_user = '$iduser' " : "";
    $where2 .= ($otp) ? " AND otp.k_id_ot_padre = '$otp' " : "";

    $query2 = $this->db->query("
            SELECT otp.k_id_ot_padre, otp.n_nombre_cliente, otp.lista_observaciones, otp.observacion, 
                        otp.orden_trabajo, otp.servicio, 
                        otp.estado_orden_trabajo,  otp.fecha_programacion,
                        otp.fecha_compromiso, otp.fecha_creacion, oth.ciudad,
                        CONCAT('$ ',FORMAT(oth.monto_moneda_local_arriendo + oth.monto_moneda_local_cargo_mensual,2)) AS recurrente,
                        u.k_id_user, CONCAT(u.n_name_user,' ' , u.n_last_name_user) AS nombre
                        FROM 
                        ot_padre otp
                        INNER JOIN ot_hija oth
                        ON otp.k_id_ot_padre = oth.nro_ot_onyx
                        INNER JOIN user u 
                        ON otp.k_id_user = u.k_id_user 
                        $where2
                        GROUP BY otp.k_id_ot_padre 
        ");





      $data = array(
          'oth' => $query->result(),
          'otp' => $query2->result()
      );
      
      return $data;
  }


    //retorna las oths y si estan en tiempo omite canceladas cerradas y terminadas
    public function get_ots_times(){
        $query = $this->db->query("
                SELECT 
                u.k_id_user,
                -- CONCAT(u.n_name_user, ' ', u.n_last_name_user) AS nombre,
                otp.k_id_ot_padre,
                -- e.k_id_tipo, 
                -- t.n_name_tipo, 
                t.i_orden, 
                oth.id_orden_trabajo_hija, 
                -- e.k_id_estado_ot, 
                -- e.n_name_estado_ot, 
                -- oth.fecha_creacion_ot_hija, 
                CASE
                    WHEN e.k_id_tipo = 1 then  DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 2 DAY)) 
                    
                    WHEN e.k_id_tipo = 2 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 7 DAY))
                    WHEN e.k_id_tipo = 3 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY)) 
                    WHEN e.k_id_tipo = 4 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 5 DAY)) 
                    WHEN e.k_id_tipo = 6 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 1 DAY)) 
                    WHEN e.k_id_tipo = 7 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 15 DAY)) 
                    WHEN e.k_id_tipo = 8 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 20 DAY)) 
                    WHEN e.k_id_tipo = 9 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY)) 
                    WHEN e.k_id_tipo = 37 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 2 DAY)) 
                    WHEN e.k_id_tipo = 47 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY)) 
                    WHEN e.k_id_tipo = 48 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY)) 
                    WHEN e.k_id_tipo = 52 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 14 DAY)) 
                    WHEN e.k_id_tipo = 53 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 6 DAY)) 
                    WHEN e.k_id_tipo = 58 THEN DATEDIFF(CURDATE(),ADDDATE(oth.fecha_creacion_ot_hija, INTERVAL 7 DAY))  
                ELSE -999
                END as tiempo
                FROM 
                ot_hija oth
                INNER JOIN ot_padre otp 
                ON oth.nro_ot_onyx = otp.k_id_ot_padre
                INNER JOIN estado_ot e 
                ON oth.k_id_estado_ot = e.k_id_estado_ot 
                INNER JOIN tipo_ot_hija t 
                ON e.k_id_tipo = t.k_id_tipo 
                INNER JOIN user u 
                ON otp.k_id_user = u.k_id_user
                where 
                oth.estado_orden_trabajo_hija <> 'Cancelada' AND
                oth.estado_orden_trabajo_hija <> 'Cerrada' AND
                oth.estado_orden_trabajo_hija <> '3- Terminada'
                order by t.i_orden desc,k_id_ot_padre
            ");
        return $query->result();
    }


    // Retorna fecha/hora ultimo excel cargado
    public function get_last_time_import(){
        $query = $this->db->query("
                SELECT 
                MAX(fecha_insercion_zolid) AS last_time  
                FROM 
                ot_hija;
            ");
        return $query->row();
    }



    /*     * *********************************************************************************************************** */
    /*     * ***********************ACOSTUMBRENSE A COMENTAR TODAS LAS FUNCIONES QUE HAGAN PUTOS************************ */
    /*     * *********************************************************************************************************** */
}
