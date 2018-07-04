<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LoadInformation extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_user_model');
        $this->load->model('data/Dao_ot_hija_model');
        $this->load->model('data/Dao_tipo_ot_hija_model');
        $this->load->model('data/Dao_estado_ot_model');
        $this->load->model('data/Dao_log_model');
    }

    public function uploadfile() {
        $request = $this->request;
        $storage = new Storage();
        //Se activa la asignación de un prefijo para nuestro archivo...
        $storage->setPrefix(true);
        //Seteamos las extenciones válidas...
        $storage->setValidExtensions("xlsx", "xls");
        //Subimos el archivo...
        $storage->process($request);
        //Obtenemos el log de los archivos subidos...
        $files = $storage->getFiles();
        $response = null;
        if (count($files) > 0) {
            $project = $files[0];
            $response = new Response(EMessages::SUCCESS, "Se ha subido el archivo correctamente", $project);
        } else {
            $response = new Response(EMessages::ERROR_ACTION, "No se pudo subir el archivo.");
        }
        $this->json($response);
    }

    public function countLinesFile() {
        error_reporting(E_ERROR);
        $request = $this->request;
        $file = $request->file;
        $response = new Response(EMessages::SUCCESS);
        try {
            //Se procesa el archivo de comentarios...
            set_time_limit(-1);
            ini_set('memory_limit', '1500M');
            require_once APPPATH . 'models/bin/PHPExcel-1.8.1/Classes/PHPExcel/Settings.php';
            $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
            $cacheSettings = array(' memoryCacheSize ' => '15MB');
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
            $this->load->model('bin/PHPExcel-1.8.1/Classes/PHPExcel');

            $inputFileType = PHPExcel_IOFactory::identify($file);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objReader->setReadDataOnly(true);

            $objPHPExcel = $objReader->load($file);
//
            $sheet = $objPHPExcel->getSheet(0);
            $row = 1;
            $validator = new Validator();
            while ($validator->required("", $this->getValueCell($sheet, "AW" . $row))) {
                $row++;
            }
            $highestRowSheet1 = $row;

            $lines = [
                "sheet1" => $highestRowSheet1
            ];

            $response->setData($lines);
            $this->json($response);
        } catch (DeplynException $ex) {
            $this->json($ex);
        }
    }




   public function processData() {
        error_reporting(E_ERROR);
        $request = $this->request;
        $response = new Response(EMessages::SUCCESS);
        $file = $request->file;

        //Verificamos si el archivo existe...
        if (file_exists($file)) {
            //Iniciamos el procedimiento de carga de datos...
            set_time_limit(-1);
            ini_set('memory_limit', '1500M');
            require_once APPPATH . 'models/bin/PHPExcel-1.8.1/Classes/PHPExcel/Settings.php';
            require_once APPPATH . 'models/bin/PHPExcel-1.8.1/Classes/PHPExcel/IOFactory.php';
            $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
            $cacheSettings = array(' memoryCacheSize ' => '15MB');
//            if (intval(phpversion()) <= 5) {
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
//            }
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
//            include_once('PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php');
//            $this->load->model('bin/PHPExcel-1.8.1/Classes/PHPExcel/IOFactory.php');

            try {                

                $inputFileType               = PHPExcel_IOFactory::identify($file);
                $objReader                   = PHPExcel_IOFactory::createReader($inputFileType);
                $objReader->setReadDataOnly(true);
                //Leer el archivo...
                $objPHPExcel                 = $objReader->load($file);
                
                //Cambiar el archivo...
                // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExce, $inputFileTypel);
                $objWriter                   = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                
                //Obtenemos la página.
                $sheet                       = $objPHPExcel->getSheet(0);
                //Obtenemos el highestRow...
                $highestRow                  = 0;
                $row                         = $request->index;
                $limit                       = $row + $request->limit;
                $inserts                     = 0;
                $errorInsert                 = [];
                $errorUpdate                 = [];
                $errorNoChange               = [];
                $actualizar                  = 0;
                $actualizados                = 0;
               

                //fecha Actual
                date_default_timezone_set("America/Bogota");
                 $fActual = date('Y-m-d');
                 $list_inges = $this->Dao_user_model->getArrayAllEngineers();

                //Inicializamos un objeto de PHPExcel para escritura...

                //while para recorrer filas del excel...
                while ($this->getValueCell($sheet, 'AW' . $row) > 0 && ($row < $limit)) {
                    $data = array();
                    //valido si el id del excel existe en la base de datos
                    $exist = $this->Dao_ot_hija_model->getExistIdOtHija($this->getValueCell($sheet, 'AW' . $row));
                    // si existe...
                    if ($exist) {
                        $cambioStatusMod = [];
                        $updates = [];

                        $arrayBD =  $exist;


                        // SELECCIONO LAS COLUMNAS DEL EXCEL A COMPARAR
                        $dataExcel = array(
                            // 'usuario_asignado'                 => $this->getValueCell($sheet, 'AB'. $row),
                            'estado_orden_trabajo'             => $this->getValueCell($sheet, 'W'. $row),
                            'tiempo_estado'                    => $this->getValueCell($sheet, 'X'. $row),
                            'descripcion'                      => $this->getValueCell($sheet, 'AJ'. $row),
                            'fecha_compromiso'                 => $this->getDatePHPExcel($sheet, 'AO'. $row),
                            'fecha_programacion'               => $this->getDatePHPExcel($sheet, 'AP'. $row),
                            'fecha_realizacion'                => $this->getDatePHPExcel($sheet, 'AQ'. $row),
                            'estado_orden_trabajo_hija'        => $this->getValueCell($sheet, 'AZ'. $row),
                            'fec_actualizacion_onyx_hija'      => $this->getDatePHPExcel($sheet, 'BF'. $row),
                            'tipo_trascurrido'                 => $this->getValueCell($sheet, 'BG'. $row)
                        );

                        // Se hace la comparacion antes del foreach para el tratamiento de cambio de estados
                        if ($arrayBD['estado_orden_trabajo_hija'] != $dataExcel['estado_orden_trabajo_hija']) {
                            // Se calcula el tipo-estado que viene del excel
                            $nombre_ref = $this->Dao_tipo_ot_hija_model->get_tipo_ot_hija_by_name($this->getValueCell($sheet, 'AV'. $row));
                            $id_estado_camb_excel = $this->Dao_estado_ot_model->getStatusByTypeAndStatusName($nombre_ref->id_tipo, $this->getValueCell($sheet, 'AZ'. $row));
                            // sI EL ORDEN DEL CAMBIO DE ESTADO ES ASCENDENTE SE DEBE EFECTUAR EL CAMBIO
                            if ($arrayBD['i_orden'] < $id_estado_camb_excel->i_orden) {
                                $dataExcel['k_id_estado_ot'] = $id_estado_camb_excel->k_id_estado_ot;
                            // SINO SE DEBE CAPTURAR LA INCONSISTENCIA    
                            } else {
                                $insert_incons = array(
                                    'id_ot_hija' => $arrayBD['id_orden_trabajo_hija'],
                                    'k_id_user'  => $arrayBD['k_id_user'],
                                    'fecha_mod'  => $fActual,
                                    'en_zolid'   => $arrayBD['estado_orden_trabajo_hija'],
                                    'en_excel'   => $dataExcel['estado_orden_trabajo_hija'],
                                    'estado_ver' => 1
                                );
                                 $this->Dao_log_model->insertInconsistenciaRow($insert_incons);
                                
                                unset($dataExcel['estado_orden_trabajo_hija']);
                            }

                        }

                        // Recorro el array de lo q viene en excel
                        foreach ($dataExcel as $key => $value) {
                            // si la celda de db es != a la celda de excel
                            if ($arrayBD[$key] != $dataExcel[$key]) {
                                
                                $insert = array(
                                    'id_ot_hija' => $arrayBD['id_orden_trabajo_hija'],
                                    'antes'      => $arrayBD[$key],
                                    'ahora'      => $dataExcel[$key],
                                    'columna'    => $key,
                                    'fecha_mod'  => $fActual
                                    );

                                $this->Dao_log_model->insertLogRow($insert);
                                //voy creando el arreglo con las modificaciones que hayan
                                $updates[$key] = $dataExcel[$key];                              
                            } 
                           
                            // Si en la comparacion hubo alguna modificacion
                            if (count($updates) >0)  {
                                $updates['estado_mod']            = 1;
                                $updates['fecha_actual']          = $fActual;
                                $updates['id_orden_trabajo_hija'] = $arrayBD['id_orden_trabajo_hija'];
                                $updates['ot_hija']               = $arrayBD['ot_hija'];
                                // $updates['k_id_estado_ot']        = $estadoMod->k_id_estado_ot;
                            }
                            // si son iguales
                             else {
                                if ($arrayBD['estado_mod'] != 2) {
                                    $cambioStatusMod['estado_mod']            = 2;
                                    $cambioStatusMod['fecha_actual']          = $fActual;
                                    $cambioStatusMod['id_orden_trabajo_hija'] = $arrayBD['id_orden_trabajo_hija'];
                                }
                            }
                        }
                        // si no hay ningun cambio
                        if ($cambioStatusMod) {
                            $sinCambios = $this->Dao_ot_hija_model->update_ot_hija_status_mod($cambioStatusMod);
                            // capturo el error si no se actualizo + el id
                            if ($sinCambios != 1) {
                                array_push($errorNoChange, array($sinCambios, $this->getValueCell($sheet, 'AW' . $row) ));
                            }
                        }
                        if ($updates) {
                                $actualizar = $this->Dao_ot_hija_model->update_ot_hija_mod($updates);
                                
                            // Si se actualizó  el estado a sin cambios retorna 1 
                            if ($actualizar === 1) {
                                $actualizados++;
                            }
                            // si retorna error lo captura, + el id 
                            else {
                                 array_push($errorUpdate, array($actualizar, $this->getValueCell($sheet, 'AW' . $row) ));
                            }


                        }
                    }




                    //si no existe lo inserto en la db tabla ot_hija
                    else {

                        $id_estado = $this->get_estado_by_name_ot_hiha($this->getValueCell($sheet, 'AV'. $row), $this->getValueCell($sheet, 'AZ'. $row));                    
                        //LLENO EL ARRAY LETRAS CON LOS VARORES DE LA FILA DEL EXCEL EN LA QUE VA EL WHILE
                        $data = array(
                                'id_orden_trabajo_hija'            => $this->getValueCell($sheet, 'AW'. $row),
                                'k_id_estado_ot'                   => $id_estado->k_id_estado_ot,
                                'k_id_user'                        => $this->cedula_del_inegeniero(str_replace(array("ñ", "Ñ"), 'N',$this->getValueCell($sheet, 'AB'. $row)), $list_inges),
                                'id_cliente_onyx'                  => $this->getValueCell($sheet, 'A'. $row),
                                'nombre_cliente'                   => $this->getValueCell($sheet, 'B'. $row),
                                'grupo_objetivo'                   => $this->getValueCell($sheet, 'C'. $row),
                                'segmento'                         => $this->getValueCell($sheet, 'D'. $row),
                                'nivel_atencion'                   => $this->getValueCell($sheet, 'E'. $row),
                                'ciudad'                           => $this->getValueCell($sheet, 'F'. $row),
                                'departamento'                     => $this->getValueCell($sheet, 'G'. $row),
                                'grupo'                            => $this->getValueCell($sheet, 'H'. $row),
                                'consultor_comercial'              => $this->getValueCell($sheet, 'I'. $row),
                                'grupo2'                           => $this->getValueCell($sheet, 'J'. $row),
                                'consultor_postventa'              => $this->getValueCell($sheet, 'K'. $row),
                                'proy_instalacion'                 => $this->getValueCell($sheet, 'L'. $row),
                                'ing_responsable'                  => $this->getValueCell($sheet, 'M'. $row),
                                'id_enlace'                        => $this->getValueCell($sheet, 'N'. $row),
                                'alias_enlace'                     => $this->getValueCell($sheet, 'O'. $row),
                                'orden_trabajo'                    => $this->getValueCell($sheet, 'P'. $row),
                                'nro_ot_onyx'                      => $this->getValueCell($sheet, 'Q'. $row),
                                'servicio'                         => $this->getValueCell($sheet, 'R'. $row),
                                'familia'                          => $this->getValueCell($sheet, 'S'. $row),
                                'producto'                         => $this->getValueCell($sheet, 'T'. $row),
                                'fecha_creacion'                   => $this->getDatePHPExcel($sheet, 'U'. $row),
                                'tiempo_incidente'                 => $this->getValueCell($sheet, 'V'. $row),
                                'estado_orden_trabajo'             => $this->getValueCell($sheet, 'W'. $row),
                                'tiempo_estado'                    => $this->getValueCell($sheet, 'X'. $row),
                                'ano_ingreso_estado'               => $this->getValueCell($sheet, 'Y'. $row),
                                'mes_ngreso_estado'                => $this->getValueCell($sheet, 'Z'. $row),
                                'fecha_ingreso_estado'             => $this->getDatePHPExcel($sheet, 'AA'. $row),
                                'usuario_asignado'                 => $this->getValueCell($sheet, 'AB'. $row),
                                'grupo_asignado'                   => $this->getValueCell($sheet, 'AC'. $row),
                                'ingeniero_provisioning'           => $this->getValueCell($sheet, 'AD'. $row),
                                'cargo_arriendo'                   => $this->getValueCell($sheet, 'AE'. $row),
                                'cargo_mensual'                    => $this->getValueCell($sheet, 'AF'. $row),
                                'monto_moneda_local_arriendo'      => $this->getValueCell($sheet, 'AG'. $row),
                                'monto_moneda_local_cargo_mensual' => $this->getValueCell($sheet, 'AH'. $row),
                                'cargo_obra_civil'                 => $this->getValueCell($sheet, 'AI'. $row),
                                'descripcion'                      => $this->getValueCell($sheet, 'AJ'. $row),
                                'direccion_origen'                 => $this->getValueCell($sheet, 'AK'. $row),
                                'ciudad_incidente'                 => $this->getValueCell($sheet, 'AL'. $row),
                                'direccion_destino'                => $this->getValueCell($sheet, 'AM'. $row),
                                'ciudad_incidente3'                => $this->getValueCell($sheet, 'AN'. $row),
                                'fecha_compromiso'                 => $this->getDatePHPExcel($sheet, 'AO'. $row),
                                'fecha_programacion'               => $this->getDatePHPExcel($sheet, 'AP'. $row),
                                'fecha_realizacion'                => $this->getDatePHPExcel($sheet, 'AQ'. $row),
                                'resolucion_1'                     => $this->getValueCell($sheet, 'AR'. $row),
                                'resolucion_2'                     => $this->getValueCell($sheet, 'AS'. $row),
                                'resolucion_3'                     => $this->getValueCell($sheet, 'AT'. $row),
                                'resolucion_4'                     => $this->getValueCell($sheet, 'AU'. $row),
                                'ot_hija'                          => $this->getValueCell($sheet, 'AV'. $row),
                                'fecha_creacion_ot_hija'           => $this->getDatePHPExcel($sheet, 'AX'. $row),
                                'proveedor_ultima_milla'           => $this->getValueCell($sheet, 'AY'. $row),
                                'estado_orden_trabajo_hija'        => $this->getValueCell($sheet, 'AZ'. $row),
                                'usuario_asignado4'                => $this->getValueCell($sheet, 'BA'. $row),
                                'resolucion_15'                    => $this->getValueCell($sheet, 'BB'. $row),
                                'resolucion_26'                    => $this->getValueCell($sheet, 'BC'. $row),
                                'resolucion_37'                    => $this->getValueCell($sheet, 'BD'. $row),
                                'resolucion_48'                    => $this->getValueCell($sheet, 'BE'. $row),
                                'fec_actualizacion_onyx_hija'      => $this->getDatePHPExcel($sheet, 'BF'. $row),
                                'tipo_trascurrido'                 => $this->getValueCell($sheet, 'BG'. $row),
                                'fecha_actual'                     => $fActual,
                                'fecha_insercion_zolid'            => $fActual,
                                'estado_mod'                       => 0
                        );

                        //inserto la fila en la base de datos
                        $insert = $this->Dao_ot_hija_model->insert_ot_hija($data);

                        //si retorna 1 se insertó bien y lo sumo en contador
                        if ($insert === 1) {
                            $inserts ++;
                        }
                        // si no se insertó retorno el error y lo guardo en un array multidimencional + el id de la orden
                        else{
                            array_push($errorInsert, array($insert, $this->getValueCell($sheet, 'AW' . $row) ));
                        }
                    }

                    $row++;
                }

                if (($limit - $row) >= 2) {
                    $response->setCode(2);
                }


                $response->setData([
                    "nuevos"                   => $inserts,
                    "Actualizados"             => $actualizados,
                    "No hay cambio"            => ($row - $request->index) - $actualizados - $inserts,
                    "error de insercion"       => $errorInsert,
                    "error al Actualizar"      => $errorUpdate,
                    "error act a sin cambios"  => $errorNoChange,
                    "row"                      => ($row - $request->index),
                    "data"                     => $this->objs
                ]);
            } catch (DeplynException $ex) {
                $response = new Response(EMessages::ERROR, "Error al procesar el archivo.");
            }
        } else {
            $response = new Response(EMessages::ERROR, "No se encontró el archivo " . $file);
        }

        $this->json($response);
        // $this->load->view('viewRF');
     }
 private function getValueCell(&$sheet, $cell) {
        $string = str_replace(array("\n", "\r", "\t"), '', $sheet->getCell($cell)->getValue());
        $string = str_replace(array("_x000D_"), "<br/>", $sheet->getCell($cell)->getValue());
        return $string;
    }

    private function getDatePHPExcel($sheet, $colum) {
        $cell = $sheet->getCell($colum);
        $validator = new Validator();
        $date = DB::NULLED;
        if ($validator->required("", $cell->getValue())) {
            $date = $cell->getValue();
            $date = date("Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($date));
            $date = Hash::addHours($date, 5);
        }
        if ($date == "NULLED") {
            $date = "0000-00-00 00:00:00";
        }
        if ($date == "1970-01-01 00:00:00") {
            $date = "1900-01-02 00:00:00";
        }
        return $date;
    }

     //calcula la cedula de los ingenieros a base del nombre dado en el excel
     private function cedula_del_inegeniero($nombre, $ingenieros){
        $nombreP = strtoupper(str_replace(array("\n", "\r", "\t", ".", " "), '', $nombre));
        for ($i=0; $i < count($ingenieros); $i++) { 
            if ($nombreP == strtoupper(str_replace(array("\n", "\r", "\t", ".", " "), '', $ingenieros[$i]['name']))) {
                return $ingenieros[$i]['id'];
            }
        }

        $this->load->helper('camilo');

        $posible = comparationsNames($ingenieros, $nombre);
        if ($posible) {
            $inge = $this->Dao_user_model->get_user_by_concat_name($posible);
            return $inge->k_id_user;
        } else {
            return '3';
        }           
     }


     //
     private function get_estado_by_name_ot_hiha($name_type, $status){
           
        $id_tipo =  $this->Dao_tipo_ot_hija_model->get_tipo_ot_hija_by_name($name_type);

        if ($id_tipo) {
            $id_estado = $this->Dao_estado_ot_model->get_status_by_idtipo_and_name_status($id_tipo->id_tipo, $status);
        } else {
            $id_estado = $this->Dao_estado_ot_model->get_status_by_idtipo_and_name_status(62, 'indefinido');                            
        }

        return $id_estado;
     }


























}
