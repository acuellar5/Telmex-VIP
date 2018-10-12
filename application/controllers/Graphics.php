<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graphics extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('data/Dao_ot_hija_model');
    $this->load->model('data/Dao_efectividad_model');
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
        $request  = $this->request;
        $file     = $request->file;
        $response = new Response(EMessages::SUCCESS);
        try {
            //Se procesa el archivo de comentarios...
            set_time_limit(-1);
            ini_set('memory_limit', '1500M');
            require_once APPPATH . 'models/bin/PHPExcel-1.8.1/Classes/PHPExcel/Settings.php';
            $cacheMethod   = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
            $cacheSettings = array(' memoryCacheSize ' => '15MB');
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
            $this->load->model('bin/PHPExcel-1.8.1/Classes/PHPExcel');

            $inputFileType = PHPExcel_IOFactory::identify($file);
            $objReader     = PHPExcel_IOFactory::createReader($inputFileType);
            $objReader->setReadDataOnly(true);
            
            $objPHPExcel   = $objReader->load($file);
            //
            $sheet         = $objPHPExcel->getSheet(0);
            $row           = 1;
            $validator     = new Validator();
            while ($validator->required("", $this->getValueCell($sheet, "P" . $row))) {
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
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

            try {

                $inputFileType = PHPExcel_IOFactory::identify($file);
                $objReader     = PHPExcel_IOFactory::createReader($inputFileType);
                $objReader->setReadDataOnly(true);
                //Leer el archivo...
                $objPHPExcel   = $objReader->load($file);
                
                //Cambiar el archivo...
                // $objWriter  = PHPExcel_IOFactory::createWriter($objPHPExce, $inputFileTypel);
                $objWriter     = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                
                //Obtenemos la página.
                $sheet         = $objPHPExcel->getSheet(0);
                //Obtenemos el highestRow...
                $highestRow    = 0;
                $row           = $request->index;
                $limit         = $row + $request->limit;
                $inserts       = 0;
                $errorInsert   = [];

                //fecha Actual
                date_default_timezone_set("America/Bogota");
                $fActual      = date('Y-m-d');
                $fActual_hora = date('Y-m-d H:i:s');

                //Inicializamos un objeto de PHPExcel para escritura...
                //while para recorrer filas del excel...
                // Eliminar informacion de la tabla efectividad
                $trun = $this->Dao_efectividad_model->delete_efectividad_table();
                $validator = new validator();
                while ($validator->required("", $this->getValueCell($sheet, "P" . $row)) && ($row < $limit) ) {
                    // filtrar si es para ZTE
                    if (rtrim(strtolower($this->getValueCell($sheet, "L" . $row))) == 'zte') {
                        // Calcular fecha, ESTADO VOC 1 , efectividad
                        // armar el array para insercion
                        $insert = array(
                            'fecha' => $this->getDatePHPExcel($sheet, 'A' . $row),
                            'estado_voc_1' => $this->get_estado_voc_1($this->getValueCell($sheet, "AC" . $row), $this->getValueCell($sheet, "AF" . $row)) ,// estado curso, Estado VOC Primario
                            'efectividad' => $this->get_efectividad($this->getValueCell($sheet, "AF" . $row), $this->getValueCell($sheet, "AL" . $row)) , // Estado VOC Primario (af), Estado VOC Secundaria(al)
                            'otp_enlace_principal' => $this->getValueCell($sheet, "P" . $row),
                            'fecha_programacion_voc' => $this->getDatePHPExcel($sheet, 'A' . $row),
                            'tipo_sede' => $this->getValueCell($sheet, "E" . $row) ,
                            'aliado' =>   $this->getValueCell($sheet, "L" . $row),
                            'estado_curso' => $this->getValueCell($sheet, "AC" . $row) ,
                            'estado_voc_primario' => $this->getValueCell($sheet, "AF" . $row) ,
                            'causas_visita_perdida_primario' => $this->getValueCell($sheet, "AH" . $row) ,
                        );
                        
                        $ins = $this->Dao_efectividad_model->insert_data_efectividad($insert);

                    }
                    
                    $row++;
                }

                if (($limit - $row) >= 2) {
                    $response->setCode(2);
                }


                $response->setData([
                    "nuevos"                  => $inserts,
                    "error de insercion"      => $errorInsert,
                    "row"                     => ($row - $request->index),
                    "data"                    => $this->objs
                ]);


            } catch (DeplynException $ex) {
                $response = new Response(EMessages::ERROR, "Error al procesar el archivo.");
            }
        } else {
            $response = new Response(EMessages::ERROR, "No se encontró el archivo " . $file);
        }

        $this->json($response);
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

    // 
    private function get_estado_voc_1($estado_curso, $estado_voc_primario){
        if (rtrim($estado_curso) != '' && rtrim($estado_voc_primario) == '' ) {
             return 'curso';
         } else {
            return null;
         }
    }

    //
    private function get_efectividad($estado_voc_primario, $estadovocsecundaria){
        if (rtrim($estado_voc_primario) == 'Realizada' || (rtrim($estado_voc_primario) == '' && rtrim($estadovocsecundaria) == 'Realizada')) {
            return 'efectiva';
        } else {
            return 'no efectiva';
        }
    }

    // carga la vista de las graficas
    public function view_graphics($cliente = 'BBVA'){
        $data['title']='Graficas';
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $this->load->view('parts/headerF', $data);
        $this->load->view('graficas/view_graphics');
        $this->load->view('parts/footerF');
    }

    // cargar la vista de carga de data para las graficas
    public function view_load_graphics(){
        $data['title']='cargar excel';
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $this->load->view('parts/headerF', $data);
        $this->load->view('graficas/view_load_graphics');
        $this->load->view('parts/footerF');
    }

    //
    private function data_graphic_process_all($data){
        $nombres = [];
        $cantidades = [];

        for ($i=0; $i < count($data); $i++) { 
            array_push($nombres, $data[$i]->nombre);
            array_push($cantidades, $data[$i]->cant);
        }

        return array(
            'nombres' => $nombres,
            'cantidades' => $cantidades
        );
    }

    //
    private function data_graphic_process_detail($nombre, $seccion, $fecha){
        $nombres = $this->Dao_efectividad_model->get_names_by_col($nombre, $fecha);
        $secciones = $this->Dao_efectividad_model->get_names_by_col($seccion, $fecha);
        // $res['cantidad'] = count($secciones);
        $res['names'] = [];

        for ($i=0; $i < count($secciones); $i++) { 
            if (!isset($res[$secciones[$i][$seccion]])) {
                $res[$secciones[$i][$seccion]] = [];
            }

            for ($j=0; $j < count($nombres); $j++) {
                // necesario para arrmar los nombres
                if (!in_array($nombres[$j][$nombre], $res['names'])) {
                    array_push($res['names'], $nombres[$j][$nombre]);
                }

                array_push($res[$secciones[$i][$seccion]], $this->Dao_efectividad_model->get_cant_section_in_name($seccion, $secciones[$i][$seccion], $nombre, $nombres[$j][$nombre])->cant);
            }

        }

        return $res;
    }


    // Data para grafica semanal total de torta
    public function get_data_grafics(){
        $torta1 = $this->Dao_efectividad_model->get_estado_voc_vs_tipo_estado();
        $total  = $this->data_graphic_process_all($torta1);
        echo json_encode($total);
    }

    // data para grafica de barras (primeras)
    public function getDataEfectividadSemanal(){
        $div    = $this->data_graphic_process_detail('estado_voc_primario', 'tipo_sede', '2018-10-05');
        echo json_encode($div);        
    }



  
}
