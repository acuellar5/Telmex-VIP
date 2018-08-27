<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_user_model');
        $this->load->model('data/Dao_ot_hija_model');
        $this->load->model('data/Dao_estado_ot_model');
    }

    private function validUser($request) {
        return Auth::attempt([
                    "n_mail_user" => $request->username,
                    "n_password" => $request->password,
                    "OR" => [
                        "n_username_user" => $request->username
                    ]
        ]);
    }

    public function loginUser() {
        if (!Auth::check()) {
            $res = $this->validUser($this->request);
        } else {
            $res = true;
        }
        //Comprobamos si el Auth ha encontrado válida las credenciales consultadas...
        if ($res) {
            $this->load->model('data/Dao_cierre_ots_model');

            $data['title'] = '¿Cómo vamos OTP?';
            $data['last_time']  = $this->Dao_ot_hija_model->get_last_time_import();
            $data['cantidad']   = $this->Dao_ot_hija_model->getCantUndefined();
            $data['ingenieros'] = $this->Dao_user_model->get_eng_trabajanding();
            $data['title']      = 'OTP';// cargar el  titulo en la pestaña de la pagina para otp

            if ($this->session->has_userdata('date_min_fact')) {
              $this->session->unset_userdata('date_min_fact');
            }


            $data_session = array(
              'date_min_fact' => $this->Dao_cierre_ots_model->get_date_min_facturada()
            );           
            $this->session->set_userdata($data_session);

            $this->load->view('parts/headerF', $data);
            $this->load->view('moduleOtp');
            $this->load->view('parts/footerF');
        } else {
            $answer['error'] = "error";
            $this->load->view('login', $answer);
        }
    }

    public function principal() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $answer['user'] = Auth::user();
        $this->load->view('principal', $answer);
    }

    public function logout() {
        Auth::logout();
        Redirect::to(URL::to("login"));
    }

    public function comprobarSesion() {
        //Comprobar si existe una sesión...
        if (Auth::check()) {
            $this->json(new Response(EMessages::SESSION_ACTIVE));
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
        }
    }

    public function principalView() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }

          $data['registros'] = $this->Dao_ot_hija_model->getCountsSumary();
          $data['title'] = 'Home';
          $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
          $this->load->view('parts/headerF', $data);
          $this->load->view('principal');
          $this->load->view('parts/footerF');
    }

    public function routingVerification() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        if (Auth::isEvaluador()) {
            $daoEvaluador = new Dao_evaluador_model();
            $this->load->view('principal', ["stadistics" => $daoEvaluador->getAllStadistics()->data]);
        } else {

          $data['title'] = 'VerificacionRouting';
          $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
          $this->load->view('parts/headerF', $data);
          $this->load->view('dataValidation');
          $this->load->view('parts/footerF');
        }
    }

    public function loadInformation() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $data['title']='Cargar OTS';
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $this->load->view('parts/headerF', $data);
        $this->load->view('loadInformation');
        $this->load->view('parts/footerF');
    }

    public function markings() {
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
        $data['title']='Marcaciones';
        $data['cantidad'] = $this->Dao_ot_hija_model->getCantUndefined();
        $this->load->view('parts/headerF', $data);
        $this->load->view('markings');
        $this->load->view('parts/footerF');
    }

    //arma la cadena de trexto de los prefijos
    public function getPrefijo(){

        $prefijos = $this->input->post('pref');
        // header('Content-Type: text/plain');
        // print_r($prefijos);


        for ($i=0; $i < count($prefijos) ; $i++) { 
          if (is_numeric($prefijos[$i][3])) {
            $pref[substr($prefijos[$i], 0, 3)][$i] = substr($prefijos[$i], 3);      
          } else {
            if (is_numeric($prefijos[$i][4])) {
            $pref[substr($prefijos[$i], 0, 4)][$i] = substr($prefijos[$i], 4);
            } else {
              $pref[substr($prefijos[$i], 0, 5)][$i] = substr($prefijos[$i], 5);
            }

          }  
        }

        $j = 0;
        foreach ($pref as $i => $valores) {
            $res[$j] = "$i";
            $j++;
        }


        $data['huawei_zte'] = $this->getDialingHuaweiZte($res, $pref);
        $data['alcatel'] = $this->getDialingAlcatel($res, $pref);


        
        // echo json_encode($data);
        $this->json($data);

  
    }

    //
    private function getDialingHuaweiZte($res, $pref){
        $respuesta = "";
        for($i = 0; $i < count($res); $i++){
          $string[$i] = $res[$i];
          $flag = 0;
          sort($pref[$res[$i]]);
          //RECORRE EL ARREGLO
          for($j = 0; $j < count($pref[$res[$i]]); $j++){

            //VERIFICA SI EL ARREGLO TIENE MAS DE UN ELEMENTO
            if(count($pref[$res[$i]]) != 1){

                  //VERIFICA QUE NO LLEGUE AL ULTIMO ELEMENTO DEL ARREGLO
                  if($j != (count($pref[$res[$i]])-1)){

                        //COMPARA SI EL NUMERO VA PARA UNA SECUENCIA
                        if($pref[$res[$i]][$j+1] == ($pref[$res[$i]][$j]) + 1){

                              if($flag == 0){                                
                                  //NO VIENE DE SECUENCIA Y VA PARA SECUENCIA, PINTA NUMERO -
                                  if (isset($pref[$res[$i]][$j-1])) {
                                      // MODIFICACION PARA COLUMNA 2 Y 3 (CUANDO ES SOLO UN COSECUTIVO AÑADE , EN VEZ DE _)
                                      // if (isset($pref[$res[$i]][$j+2])) {

                                      //     if ($pref[$res[$i]][$j+2] == $pref[$res[$i]][$j] + 2) {
                                            
                                      //       $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j])."_";
                                      //     }else {
                                      //       $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j]).",";
                                            
                                      //     }
                                        
                                      // }else{                                      
                                      //     $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j]).",";
                                      // }



                                    $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j])."_";

                                  }
                                  else {

                                    // if (isset($pref[$res[$i]][$j+2])) {

                                    //     if ($pref[$res[$i]][$j+2] == $pref[$res[$i]][$j] + 2) {
                                          
                                    //        $string[$i] = $string[$i].$pref[$res[$i]][$j]."_";
                                    //     }else {
                                    //        $string[$i] = $string[$i].$pref[$res[$i]][$j].",";
                                          
                                    //     }

                                    // }else{                                      
                                    //    $string[$i] = $string[$i].$pref[$res[$i]][$j].",";
                                    // }


                                    $string[$i] = $string[$i].$pref[$res[$i]][$j]."_";
                                  }
                              } 

                              else {
                                //NO HACE NADA PORQUE VIENE DE SECUENCIA Y SIGUE EN SECUENCIA
                              }
                          $flag = 1;
                        } 

                        else {
                              //VERIFICA SI VIENE DE UNA SECUENCIA
                              if($flag == 0){
                                  //NO VIENE DE SECUENCIA Y NO VA PARA SECUENCIA, NUMERO,
                                  if (isset($pref[$res[$i]][$j-1])) {
                                    $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j]).".";
                                  }
                                  else {
                                    $string[$i] = $string[$i].$pref[$res[$i]][$j].".";
                                  }
                              } 

                              else {
                                //NO VIENE DE SECUENCIA Y NO VA PARA SECUENCIA, NUMERO,
                                  $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j]).".";


                              }
                          $flag = 0;
                        }
                  }

                  else {

                    //COMO ES EL ULTIMO VALOR, SE PINTA EL NUMERO SOLO
                    $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j]);
                  }
            } 

            else {
              // CUANDO SOLO TIENE UN ELEMENTO EL ARRAY DE VALORES (IMPRIME SIN COMA NI OUNTO AL FINAL)
              $string[$i] = $string[$i].$pref[$res[$i]][0];
              // print_r("\n".$pref[$res[$i]][0]);

            }
          }
          if($i != (count($res)-1)){
            $respuesta = $respuesta.$string[$i].".";
          } 
          else {
              $respuesta = $respuesta.$string[$i];
          }
        }

        return $respuesta;

    }

    //
    private function getDialingAlcatel($res, $pref){
          $respuesta = "";
        for($i = 0; $i < count($res); $i++){
          $string[$i] = $res[$i];
          $flag = 0;
          sort($pref[$res[$i]]);
          //RECORRE EL ARREGLO
          for($j = 0; $j < count($pref[$res[$i]]); $j++){

            //VERIFICA SI EL ARREGLO TIENE MAS DE UN ELEMENTO
            if(count($pref[$res[$i]]) != 1){

                  //VERIFICA QUE NO LLEGUE AL ULTIMO ELEMENTO DEL ARREGLO
                  if($j != (count($pref[$res[$i]])-1)){

                        //COMPARA SI EL NUMERO VA PARA UNA SECUENCIA
                        if($pref[$res[$i]][$j+1] == ($pref[$res[$i]][$j]) + 1){

                              if($flag == 0){                                
                                  //NO VIENE DE SECUENCIA Y VA PARA SECUENCIA, PINTA NUMERO -
                                  if (isset($pref[$res[$i]][$j-1])) {
                                      // MODIFICACION PARA COLUMNA 2 Y 3 (CUANDO ES SOLO UN COSECUTIVO AÑADE , EN VEZ DE _)
                                      if (isset($pref[$res[$i]][$j+2])) {

                                          if ($pref[$res[$i]][$j+2] == $pref[$res[$i]][$j] + 2) {
                                            
                                            $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j])."_";
                                          }else {
                                            $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j]).",";
                                            
                                          }
                                        
                                      }else{                                      
                                          $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j]).",";
                                      }



                                    // $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j])."_";

                                  }
                                  else {

                                    if (isset($pref[$res[$i]][$j+2])) {

                                        if ($pref[$res[$i]][$j+2] == $pref[$res[$i]][$j] + 2) {
                                          
                                           $string[$i] = $string[$i].$pref[$res[$i]][$j]."_";
                                        }else {
                                           $string[$i] = $string[$i].$pref[$res[$i]][$j].",";
                                          
                                        }

                                    }else{                                      
                                       $string[$i] = $string[$i].$pref[$res[$i]][$j].",";
                                    }


                                    // $string[$i] = $string[$i].$pref[$res[$i]][$j]."_";
                                  }
                              } 

                              else {
                                //NO HACE NADA PORQUE VIENE DE SECUENCIA Y SIGUE EN SECUENCIA
                              }
                          $flag = 1;
                        } 

                        else {
                              //VERIFICA SI VIENE DE UNA SECUENCIA
                              if($flag == 0){
                                  //NO VIENE DE SECUENCIA Y NO VA PARA SECUENCIA, NUMERO,
                                  if (isset($pref[$res[$i]][$j-1])) {
                                    $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j]).".";
                                  }
                                  else {
                                    $string[$i] = $string[$i].$pref[$res[$i]][$j].".";
                                  }
                              } 

                              else {
                                //NO VIENE DE SECUENCIA Y NO VA PARA SECUENCIA, NUMERO,
                                  $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j]).".";


                              }
                          $flag = 0;
                        }
                  }

                  else {

                    //COMO ES EL ULTIMO VALOR, SE PINTA EL NUMERO SOLO
                    $string[$i] = $string[$i].$this->delecteCoinci($pref[$res[$i]][$j-1], $pref[$res[$i]][$j]);
                  }
            } 

            else {
              // CUANDO SOLO TIENE UN ELEMENTO EL ARRAY DE VALORES (IMPRIME SIN COMA NI OUNTO AL FINAL)
              $string[$i] = $string[$i].$pref[$res[$i]][0];
              // print_r("\n".$pref[$res[$i]][0]);

            }
          }
          if($i != (count($res)-1)){
            $respuesta = $respuesta.$string[$i].".";
          } 
          else {
              $respuesta = $respuesta.$string[$i];
          }
        }

        return $respuesta;
    }



   

    //FUNCIONA
    // RETORNA SOLO LAS COINCIDENCIAS DE SE SEGUNDO NUMERO CON RESPECTO AL PRIMERO 
    //EJEM_ (232, 238) => 8    EJ: (123, 143)
    public function delecteCoinci($num1, $num2){
      $num1 .= "";
      $num2 .= "";
      $flag= 0;
      $string = "";

      while (isset($num1[$flag]) && isset($num2[$flag])) {
        if ($num1[$flag] != $num2[$flag]) {
          return substr($num2, $flag);
          // $string .= $num2[$flag];
        }

        $flag++;
      }
      return $num2;
      
    }

    //retorna a js los estados segun id de tipo
    public function c_getStatusByType(){
      $data = $this->Dao_estado_ot_model->m_getStatusByType($this->input->post('idtipo'));
      echo json_encode($data);

    }




    //
    public function prueba(){
      $exist = $this->Dao_ot_hija_model->getExistIdOtHija();
      header('Content-Type: text/plain');
      print_r($exist);
      
      echo "<br>";
     
    }

  //  TRAE LOS REGISTROS DE LA TABLA DE INCONSISTENCIAS
  public function c_print_table_incons(){
    if (Auth::check()) {
            $data = $this->Dao_ot_hija_model->print_tabl();
            echo json_encode($data);
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
        }
  }
  //cambia el estado de estado_Ver (1) a estado ver (0)
  public function c_hide_inconsistency(){
    $data = array(
      'k_id_inconsistencia' =>$this->input->post('k_id_inconsistencia'),
      'estado_ver' => 0,
       );
    $this->Dao_ot_hija_model->upVerTo_0();
    echo json_encode($data);
  }
  //trae nombre, email y telefono de los ingenieros de la tabla user
  public function c_get_eingenieer(){
    $data = $this->Dao_user_model->fill_with_eingenieer();
    echo json_encode($data);
  }

}

?>
