<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_ot_hija_model');
        $this->load->model('data/Dao_estado_ot_model');
    }

//


    public function c_updateStatusOt($servicio = null) {
      // header('Content-Type: text/plain');
      // print_r($this->input->post());
      if ($servicio && $this->input->post('k_id_estado_ot') == 3) {
        $data_template = $this->fill_formulary($servicio, $_POST);
        switch ($servicio) {
               case '1':
                 $template = $this->internet_dedicado_empresarial($data_template);
                 break;
               case '2':
                 $template = $this->internet_dedicado($data_template);
                 break;
               case '3':
                 $template = $this->mpls_avanzado_intranet($data_template);
                 break;
               case '4':
                 $template = $this->mpls_avanzado_intranet_varios_puntos($data_template);
                 break;
               case '5':
                 $template = $this->mpls_avanzado_intranet_con_backup_de_ultima_milla_nds2($data_template);
                 break;
               case '6':
                 $template = $this->mpls_avanzado_intranet_con_backup_de_ultima_milla_y_router_nds1($data_template);
                 break;
               case '7':
                 $template = $this->avanzado_extranet($data_template);
                 break;
               case '8':
                 $template = $this->backend_mpls($data_template);
                 break;
               case '9':
                 $template = $this->mpls_avanzado_componente_datacenter_claro($data_template);
                 break;
               case '10':
                 $template = $this->mpls_transaccional_3g($data_template);
                 break;
           
             }  
             // print_r($template);   
             $this->enviar_email($template, $_POST);

      } else {  
        $this->update_status($_POST);
      }
        

    }

    //Actualiza el estato (hay que enviarle el post)
    private function update_status($pt){
        $text_estado = $this->Dao_estado_ot_model->getNameStatusById($pt['k_id_estado_ot']);

        date_default_timezone_set("America/Bogota");
        $fActual = date('Y-m-d');
        $data = array(
            'id_orden_trabajo_hija' => $pt['id_orden_trabajo_hija'],
            'k_id_estado_ot' => $pt['k_id_estado_ot'],
            'estado_orden_trabajo_hija' => $text_estado,
            'fecha_actual' => $fActual,
            'estado_mod' => 1,
            'n_observacion_cierre' => $pt['n_observacion_cierre']
        );

        $dataLog = array(
            'id_ot_hija' => $pt['id_orden_trabajo_hija'],
            'antes' => $pt['estado_orden_trabajo_hija'],
            'ahora' => $text_estado,
            'columna' => 'estado_orden_trabajo_hija',
            'fecha_mod' => $fActual,
        );


        $destinatarios = $pt['mail_envio'];
        if (isset($pt['mail_cc'])) {
          for ($i=0; $i < count($pt['mail_cc']); $i++) { 
            $destinatarios .= "";
          }
        }



        $dataLogMail = array(
            'k_id_ot_padre'              => $pt['nro_ot_onyx'],
            'id_orden_trabajo_hija'      => null,
            'clase'                      => null,
            'destinatarios'              => null,
            'usuario_sesion'             => null,
            'nombre'                     => null,
            'nombre_cliente'             => null,
            'servicio'                   => null,
            'fecha'                      => null,
            'direccion_instalacion'      => null,
            'direccion_instalacion_des1' => null,
            'direccion_instalacion_des2' => null,
            'direccion_instalacion_des3' => null,
            'existente'                  => null,
            'nuevo'                      => null,
            'ancho_banda'                => null,
            'interfaz_entrega'           => null,
            'equipos_intalar_camp1'      => null,
            'equipos_intalar_camp2'      => null,
            'equipos_intalar_camp3'      => null,
            'fecha_servicio'             => null,
            'ingeniero1'                 => null,
            'ingeniero1_tel'             => null,
            'ingeniero1_email'           => null,
            'ingeniero2'                 => null,
            'ingeniero2_tel'             => null,
            'ingeniero2_email'           => null,
            'ingeniero3'                 => null,
            'ingeniero3_tel'             => null,
            'ingeniero3_email'           => null
               
             );
               

        header('Content-Type: text/plain');
        print_r($pt);



        // $res = $this->Dao_ot_hija_model->m_updateStatusOt($data, $dataLog); 

        // header('Location: ' . URL::base() . '/editarOts?msj=ok');
    }


    // se llenan los argumentos dependiendo el servicio
    public function fill_formulary($s, $p) {

      switch (true) {
        case ($s == 1 || $s == 2):
            $argumentos = array(
                'nombre' => $p['nombre'],
                'nombre_cliente' => $p['nombre_cliente'],
                'servicio' => $p['servicio'],
                'fecha' => $p['fecha'],
                'direccion_instalacion' => $p['direccion_instalacion'],
                'ancho_banda' => $p['ancho_banda'] . " MHz",
                'interfaz_entrega' => $p['interfaz_entrega'],
                'fecha_servicio' => $p['fecha_servicio'],
                'ingeniero1' => $p['ingeniero1'],
                'ingeniero1_tel' => $p['ingeniero1_tel'],
                'ingeniero1_email' => $p['ingeniero1_email'],
                'ingeniero2' => $p['ingeniero2'],
                'ingeniero2_tel' => $p['ingeniero2_tel'],
                'ingeniero2_email' => $p['ingeniero2_email'],
                'ingeniero3' => $p['ingeniero3'],
                'ingeniero3_tel' => $p['ingeniero3_tel'],
                'ingeniero3_email' => $p['ingeniero3_email']
            );          
          break;
        case ($s == 4):
            $argumentos = array(
                'nombre' => $p['nombre'],
                'nombre_cliente' => $p['nombre_cliente'],
                'servicio' => $p['servicio'],
                'fecha' => $p['fecha'],
                'direccion_instalacion_des1' => $p['direccion_instalacion_des1'],
                'direccion_instalacion_des2' => $p['direccion_instalacion_des2'],
                'direccion_instalacion_des3' => $p['direccion_instalacion_des3'],
                'existente' => $p['existente'],
                'nuevo' => $p['nuevo'],
                'ancho_banda' => $p['ancho_banda']. " MHz",
                'interfaz_entrega' => $p['interfaz_entrega'],
                'equipos_intalar_camp1' => $p['equipos_intalar_camp1'],
                'equipos_intalar_camp2' => $p['equipos_intalar_camp2'],
                'equipos_intalar_camp3' => $p['equipos_intalar_camp3'],
                'fecha_servicio' => $p['fecha_servicio'],
                'ingeniero1' => $p['ingeniero1'],
                'ingeniero1_tel' => $p['ingeniero1_tel'],
                'ingeniero1_email' => $p['ingeniero1_email'],
                'ingeniero2' => $p['ingeniero2'],
                'ingeniero2_tel' => $p['ingeniero2_tel'],
                'ingeniero2_email' => $p['ingeniero2_email'],
                'ingeniero3' => $p['ingeniero3'],
                'ingeniero3_tel' => $p['ingeniero3_tel'],
                'ingeniero3_email' => $p['ingeniero3_email'] 
            );
          break;
        case ($s == 3 || $s == 5 || $s == 6 || $s == 7 || $s == 8 || $s == 9 || $s == 10 ):
            $argumentos = array(
                'nombre' => $p['nombre'],
                'nombre_cliente' => $p['nombre_cliente'],
                'servicio' => $p['servicio'],
                'fecha' => $p['fecha'],
                'direccion_instalacion' => $p['direccion_instalacion'],
                'existente' => $p['existente'],
                'nuevo' => $p['nuevo'],
                'ancho_banda' => $p['ancho_banda']. " MHz",
                'interfaz_entrega' => $p['interfaz_entrega'],
                'fecha_servicio' => $p['fecha_servicio'],
                'ingeniero1' => $p['ingeniero1'],
                'ingeniero1_tel' => $p['ingeniero1_tel'],
                'ingeniero1_email' => $p['ingeniero1_email'],
                'ingeniero2' => $p['ingeniero2'],
                'ingeniero2_tel' => $p['ingeniero2_tel'],
                'ingeniero2_email' => $p['ingeniero2_email'],
                'ingeniero3' => $p['ingeniero3'],
                'ingeniero3_tel' => $p['ingeniero3_tel'],
                'ingeniero3_email' => $p['ingeniero3_email']
                
            );
          break;
      }
      return $argumentos;
    }

//
    public function enviar_email($cuerpo , $pt) {
      $email_user = Auth::user()->n_mail_user;
      $correos = [];
      if (Auth::user()->n_mail_user || Auth::user()->n_mail_user != "") {
        array_push($correos, $email_user);
      }

      if (isset($pt['mail_cc'])) {
        for ($i=0; $i < count($pt['mail_cc']); $i++) { 
          array_push($correos, $pt['mail_cc'][$i]);
        }
      }

        $this->load->library('parser');

        $config = Array(
            // 'smtp_crypto' => 'ssl', //protocolo de encriptado
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'zolid.telmex.vip@gmail.com',
            'smtp_pass' => 'z0l1dTelmex',
            // 'smtp_timeout' => 5, //tiempo de conexion maxima 5 segundos
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'priority' => 1,
        );
        // $argumentos = $this->_post($this->input->post('servicio'));
        // $cuerpo = $this->internet_dedicado_empresarial($argumentos);
        $asunto = 'esta es la prueba';

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('zolid.telmex.vip@gmail.com', 'TELMEX VIP'); // change it to yours
        $this->email->to($pt['mail_envio']); // change it to yours
        $this->email->cc($correos);
        $this->email->subject("Notificación de Servicio de la orden ". $pt['nro_ot_onyx'] . "-". $pt['id_orden_trabajo_hija'] );
        $this->email->message($cuerpo);
        if($this->email->send())
          { echo "se envio";
            $this->update_status($pt);
          }else{

            echo ":( Hubo un error en el envio del correo";
          }
    }

    public function internet_dedicado_empresarial($argumentos) {
        return ' 
<div dir="ltr"><div class="adM">
</div>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
Servicio &nbsp;<b><span style="color:rgb(31,73,125)">' . $argumentos['servicio'] . '</span></b><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
los datos de contacto del Ingeniero encargado de la implementación de su
servicio. Es de suma importancia que sea revisado y nos retroalimente la
información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
contenida en este documento es importante que nos haga llegar sus inquietudes
ya que el servicio contratado será entregado de acuerdo a la información que
describimos a continuación. <span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="935" height="639" src="' . URL::base() . '/assets/img/mail_formats/internet_dedicado_empresarial.png"></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b>' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
detalla la secuencia de actividades para llevar a cabo la instalación del
servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453" src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

<table class="m_5089500533639821532gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="935" style="width:701.3pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="177" valign="top" style="width:132.6pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="758" colspan="10" valign="top" style="width:568.7pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="178" colspan="2" style="width:133.3pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-family:&quot;Arial Black&quot;,sans-serif">INTERNET DEDICADO
  EMPRESARIAL<span style="color:rgb(31,73,125)"><span></span></span></span></b></p>
  </td>
  <td width="757" colspan="9" valign="top" style="width:568pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;line-height:120%;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:black">DESCRIPCIÓN DE
  LA SOLUCIÓN:</span></i></b><span style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif">Enlace en Fibra Óptica de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif">con direccionamiento público <b>/29</b> (5
  Direcciones IP)</span><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:black">, este direccionamiento
  Publico puede ser configurado directamente sobre los equipos que necesitan
  salida a </span><b><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:rgb(192,0,0)">INTERNET</span></b><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:black">. En caso de que requiera&nbsp; la traslación del
  direccionamiento Publica asignado por Claro a su red privada Interna, es
  necesario que nos informe su red Privada.&nbsp; En caso de que requiera
  asignación de IP de forma centralizada, &nbsp;por favor infórmenos
  respondiendo este correo, &nbsp;con el fin de &nbsp;realizar la configuración
  de DHCP sobre nuestros equipos.<span></span></span></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black">Es
  responsabilidad del <b>CLIENTE</b> enviar esta Información&nbsp; para que </span><b><i><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:rgb(192,0,0)">CLARO</span></i></b><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black">&nbsp; pueda configurar la
  Conectividad de acuerdo a la necesidad.</span><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="178" colspan="2" rowspan="15" style="width:133.3pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
  <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:8pt">
  <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['ancho_banda'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:16.45pt">
  <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:10pt;font-family:Arial,sans-serif">99.6 % &nbsp;<span style="color:black"><span></span></span></span></i></b></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
  </td>
  <td width="347" colspan="6" valign="top" style="width:260.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['fecha_servicio'] . '</span></span></p>
  </td>
  <td width="189" colspan="2" valign="top" style="width:5cm;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
  necesarias para la instalación<span style="color:black"><span></span></span></span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="757" colspan="9" valign="top" style="width:568pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
  LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:8.45pt">
  <td width="221" rowspan="3" valign="top" style="width:166pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
  del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
  </td>
  <td width="177" colspan="3" valign="top" style="width:132.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
  </td>
  <td width="85" valign="top" style="width:63.8pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>
</span></span></b></p>
  </td>
  <td width="180" colspan="3" valign="top" style="width:134.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
  </td>
  <td width="95" valign="top" style="width:70.9pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
  </td>
 </tr>
 <tr style="height:8.35pt">
  <td width="177" colspan="3" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
  </td>
  <td width="85" valign="top" style="width:63.8pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>
</span></span></b></p>
  </td>
  <td width="180" colspan="3" rowspan="2" valign="top" style="width:134.65pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
  confirme Horarios)<span></span></span></b></p>
  </td>
  <td width="95" rowspan="2" valign="top" style="width:70.9pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
  </td>
 </tr>
 <tr style="height:5.8pt">
  <td width="177" colspan="3" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
  </td>
  <td width="85" valign="top" style="width:63.8pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
  </td>
 </tr>
 <tr style="height:12.25pt">
  <td width="221" valign="top" style="width:166pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
  Existencia de las siguientes condiciones:<span></span></span></i></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
  </td>
  <td width="92" valign="top" style="width:69.2pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
  </td>
  <td width="85" valign="top" style="width:63.8pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
  </td>
  <td width="76" valign="top" style="width:57.35pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="103" colspan="2" valign="top" style="width:77.3pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
  equipos:<span></span></span></b></p>
  </td>
  <td width="95" valign="top" style="width:70.9pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
 </tr>
 <tr style="height:12.25pt">
  <td width="221" rowspan="2" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">OPCIÓN DE
  ENTREGA 1:</span></i></b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></p>
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Por favor confirme si va a conectar
  su red LAN con un direccionamiento diferente al público asignado por Claro. <span></span></span></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">En caso de que la respuesta sea <b><u>SI</u></b>
  por favor indíquenos &nbsp;el segmento al cual le debemos configurar NAT.</span><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.2pt">
  <td width="61" valign="top" style="width:45.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:12.2pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">SI:<span></span></span></b></p>
  </td>
  <td width="475" colspan="7" valign="top" style="width:356.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.2pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:6.15pt">
  <td width="221" rowspan="2" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:6.15pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">OPCIÓN DE
  ENTREGA 2:</span></i></b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></p>
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Por favor
  confirme si va a configurar sobre sus máquinas el direccionamiento publico
  asignado por Claro.<span></span></span></i></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:6.15pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">En caso de que la respuesta sea <b><u>NO</u></b>
  por favor indíquenos el pool de direcciones para configurar DHCP y las IPs
  Excluidas</span></i><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.2pt">
  <td width="61" valign="top" style="width:45.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:12.2pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">NO:<span></span></span></b></p>
  </td>
  <td width="475" colspan="7" valign="top" style="width:356.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.2pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
 </tr>
 <tr>
  <td width="177" style="width:132.75pt;padding:0cm"></td>
  <td width="1" style="width:0.75pt;padding:0cm"></td>
  <td width="221" style="width:165.75pt;padding:0cm"></td>
  <td width="61" style="width:45.75pt;padding:0cm"></td>
  <td width="23" style="width:17.25pt;padding:0cm"></td>
  <td width="92" style="width:69pt;padding:0cm"></td>
  <td width="85" style="width:63.75pt;padding:0cm"></td>
  <td width="76" style="width:57pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="94" style="width:70.5pt;padding:0cm"></td>
  <td width="95" style="width:71.25pt;padding:0cm"></td>
 </tr>
</tbody></table>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="906" height="609" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones.png"></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
contactar a:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<table class="m_5089500533639821532gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="151" colspan="2" valign="top" style="width:113.2pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="161" colspan="2" valign="top" style="width:120.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
  </td>
 </tr>
</tbody></table><div class="yj6qo"></div><div class="adL">


<br></div></div>

';
    }

//
    public function internet_dedicado($argumentos) {
        return '  

  <div dir="ltr"><div class="adM">
</div>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif"> ' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>( ' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
Servicio &nbsp;<b><span style="color:rgb(31,73,125)"> ' . $argumentos['servicio'] . '</span></b><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
los datos de contacto del Ingeniero encargado de la implementación de su
servicio. Es de suma importancia que sea revisado y nos retroalimente la
información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
contenida en este documento es importante que nos haga llegar sus inquietudes
ya que el servicio contratado será entregado de acuerdo a la información que
describimos a continuación. <span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="955" height="662" src="' . URL::base() . '/assets/img/mail_formats/internet_dedicado.png"></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b> ' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
detalla la secuencia de actividades para llevar a cabo la instalación del
servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453" src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>

<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

<table class="m_8516412771729688178gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="935" style="width:701.3pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="177" valign="top" style="width:132.6pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="758" colspan="10" valign="top" style="width:568.7pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="178" colspan="2" style="width:133.3pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-family:&quot;Arial Black&quot;,sans-serif">INTERNET DEDICADO <span style="color:rgb(31,73,125)"><span></span></span></span></b></p>
  </td>
  <td width="757" colspan="9" valign="top" style="width:568pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;line-height:120%;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:black">DESCRIPCIÓN DE
  LA SOLUCIÓN:</span></i></b><span style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif">Enlace en Fibra Óptica de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif">con direccionamiento público <b>/29</b> (5
  Direcciones IP)</span><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:black">, este direccionamiento
  Publico puede ser configurado directamente sobre los equipos que necesitan
  salida a </span><b><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:rgb(192,0,0)">INTERNET</span></b><span lang="ES-CO" style="font-size:10pt;line-height:120%;font-family:Arial,sans-serif;color:black">. En caso de que requiera&nbsp; la traslación del
  direccionamiento Publica asignado por Claro a su red privada Interna, es
  necesario que nos informe su red Privada.&nbsp; En caso de que requiera
  asignación de IP de forma centralizada, &nbsp;por favor infórmenos
  respondiendo este correo, &nbsp;con el fin de &nbsp;realizar la configuración
  de DHCP sobre nuestros equipos.<span></span></span></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black">Es
  responsabilidad del <b>CLIENTE</b> enviar esta Información&nbsp; para que </span><b><i><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:rgb(192,0,0)">CLARO</span></i></b><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black">&nbsp; pueda configurar la
  Conectividad de acuerdo a la necesidad.</span><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="178" colspan="2" rowspan="15" style="width:133.3pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
  <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:8pt">
  <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['ancho_banda'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:16.45pt">
  <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:10pt;font-family:Arial,sans-serif">99.6 % &nbsp;<span style="color:black"><span></span></span></span></i></b></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="221" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
  </td>
  <td width="347" colspan="6" valign="top" style="width:260.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['fecha_servicio'] . '</span></span></p>
  </td>
  <td width="189" colspan="2" valign="top" style="width:5cm;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
  necesarias para la instalación<span style="color:black"><span></span></span></span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="757" colspan="9" valign="top" style="width:568pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
  LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:8.45pt">
  <td width="221" rowspan="3" valign="top" style="width:166pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
  del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
  </td>
  <td width="177" colspan="3" valign="top" style="width:132.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
  </td>
  <td width="85" valign="top" style="width:63.8pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="180" colspan="3" valign="top" style="width:134.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
  </td>
  <td width="95" valign="top" style="width:70.9pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
 </tr>
 <tr style="height:8.35pt">
  <td width="177" colspan="3" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
  </td>
  <td width="85" valign="top" style="width:63.8pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="180" colspan="3" rowspan="2" valign="top" style="width:134.65pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
  confirme Horarios)<span></span></span></b></p>
  </td>
  <td width="95" rowspan="2" valign="top" style="width:70.9pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
 </tr>
 <tr style="height:5.8pt">
  <td width="177" colspan="3" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
  </td>
  <td width="85" valign="top" style="width:63.8pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
 </tr>
 <tr style="height:12.25pt">
  <td width="221" valign="top" style="width:166pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
  Existencia de las siguientes condiciones:<span></span></span></i></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
  </td>
  <td width="92" valign="top" style="width:69.2pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="85" valign="top" style="width:63.8pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
  </td>
  <td width="76" valign="top" style="width:57.35pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="103" colspan="2" valign="top" style="width:77.3pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
  equipos:<span></span></span></b></p>
  </td>
  <td width="95" valign="top" style="width:70.9pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
 </tr>
 <tr style="height:12.25pt">
  <td width="221" rowspan="2" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">OPCIÓN DE
  ENTREGA 1:</span></i></b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></p>
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Por favor confirme si va a conectar
  su red LAN con un direccionamiento diferente al público asignado por Claro. <span></span></span></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">En caso de que la respuesta sea <b><u>SI</u></b>
  por favor indíquenos &nbsp;el segmento al cual le debemos configurar NAT.</span><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.2pt">
  <td width="61" valign="top" style="width:45.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:12.2pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">SI:<span></span></span></b></p>
  </td>
  <td width="475" colspan="7" valign="top" style="width:356.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.2pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr style="height:6.15pt">
  <td width="221" rowspan="2" valign="top" style="width:166pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:6.15pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">OPCIÓN DE
  ENTREGA 2:</span></i></b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></p>
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Por favor
  confirme si va a configurar sobre sus máquinas el direccionamiento publico
  asignado por Claro.<span></span></span></i></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></i></b></p>
  </td>
  <td width="536" colspan="8" valign="top" style="width:402pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:6.15pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">En caso de que la respuesta sea <b><u>NO</u></b>
  por favor indíquenos el pool de direcciones para configurar DHCP y las IPs
  Excluidas</span></i><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.2pt">
  <td width="61" valign="top" style="width:45.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:12.2pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">NO:<span></span></span></b></p>
  </td>
  <td width="475" colspan="7" valign="top" style="width:356.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.2pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr>
  <td width="177" style="width:132.75pt;padding:0cm"></td>
  <td width="1" style="width:0.75pt;padding:0cm"></td>
  <td width="221" style="width:165.75pt;padding:0cm"></td>
  <td width="61" style="width:45.75pt;padding:0cm"></td>
  <td width="23" style="width:17.25pt;padding:0cm"></td>
  <td width="92" style="width:69pt;padding:0cm"></td>
  <td width="85" style="width:63.75pt;padding:0cm"></td>
  <td width="76" style="width:57pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="94" style="width:70.5pt;padding:0cm"></td>
  <td width="95" style="width:71.25pt;padding:0cm"></td>
 </tr>
</tbody></table>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="906" height="609" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones.png"></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
contactar a:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<table class="m_8516412771729688178gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="226" colspan="3" valign="top" style="width:169.7pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
  </td>
  <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="151" colspan="2" valign="top" style="width:113pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="161" colspan="2" valign="top" style="width:120.5pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
  </td>
 </tr>
</tbody></table><div class="yj6qo"></div><div class="adL">

<br></div></div>

';
    }

//
    public function mpls_avanzado_intranet($argumentos) {
        return '


  <div dir="ltr"><div class="adM">




</div>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
Servicio &nbsp;<b><span style="color:rgb(31,73,125)"> ' . $argumentos['servicio'] . '</span></b><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
los datos de contacto del Ingeniero encargado de la implementación de su
servicio. Es de suma importancia que sea revisado y nos retroalimente la
información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
contenida en este documento es importante que nos haga llegar sus inquietudes
ya que el servicio contratado será entregado de acuerdo a la información que
describimos a continuación. <span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="967" height="546" src="' . URL::base() . '/assets/img/mail_formats/mlps_avanzado_solucion_intranet.png" ></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b> ' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
detalla la secuencia de actividades para llevar a cabo la instalación del
servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453" src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>

<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

<table class="m_-2714967827264337054gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="189" valign="top" style="width:5cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:29.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="189" style="width:5cm;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS AVANZADO
  INTRANET</span></b><b><span style="font-family:&quot;Arial Black&quot;,sans-serif;color:rgb(31,73,125)"><span></span></span></b></p>
  </td>
  <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
  LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
  segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="189" rowspan="17" style="width:5cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
  </td>
  <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
  </td>
  <td width="194" colspan="7" valign="top" style="width:145.8pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['existente'] . '</span></span></b></p>
  </td>
  <td width="53" colspan="2" valign="top" style="width:39.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
  </td>
  <td width="215" colspan="7" valign="top" style="width:161.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['nuevo'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['ancho_banda'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.45pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
  </td>
  <td width="347" colspan="13" valign="top" style="width:260.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['fecha_servicio'] . '</span></span></p>
  </td>
  <td width="189" colspan="5" valign="top" style="width:141.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
  necesarias para la instalación<span style="color:black"><span></span></span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
  LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.45pt">
  <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.6pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
  del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
  </td>
  <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="179" colspan="8" valign="top" style="width:134.5pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" valign="top" style="width:71.15pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.35pt">
  <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.5pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
  confirme Horarios)<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.15pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:5.8pt">
  <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:12.25pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
  Existencia de las siguientes condiciones:<span></span></span></i></b></p>
  </td>
  <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
  </td>
  <td width="92" colspan="3" valign="top" style="width:69.1pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
  </td>
  <td width="76" colspan="4" valign="top" style="width:57.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="103" colspan="4" valign="top" style="width:77.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
  equipos:<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" valign="top" style="width:71.15pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:17.65pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.65pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.65pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:17.65pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:17.6pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la configuración
  de rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:17.6pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="210" colspan="2" rowspan="3" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del
  Contacto Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width="189" style="width:5cm;padding:0cm"></td>
  <td width="1" style="width:1pt;padding:0cm"></td>
  <td width="221" colspan="2" style="width:165.85pt;padding:0cm"></td>
  <td width="61" style="width:45.9pt;padding:0cm"></td>
  <td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
  <td width="92" colspan="3" style="width:69.1pt;padding:0cm"></td>
  <td width="85" colspan="3" style="width:63.75pt;padding:0cm"></td>
  <td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="94" colspan="2" style="width:70.5pt;padding:0cm"></td>
  <td width="95" colspan="2" style="width:71.15pt;padding:0cm"></td>
 </tr>
 <tr>
  <td width="189" style="width:5cm;padding:0cm"></td>
  <td width="1" style="width:0.75pt;padding:0cm"></td>
  <td width="209" style="width:156.75pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="61" style="width:45.75pt;padding:0cm"></td>
  <td width="11" style="width:8.25pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="30" style="width:22.5pt;padding:0cm"></td>
  <td width="50" style="width:37.5pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="73" style="width:54.75pt;padding:0cm"></td>
  <td width="6" style="width:4.5pt;padding:0cm"></td>
  <td width="6" style="width:4.5pt;padding:0cm"></td>
  <td width="47" style="width:35.25pt;padding:0cm"></td>
  <td width="17" style="width:12.75pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="3" style="width:2.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="82" style="width:61.5pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="83" style="width:62.25pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
 </tr>
</tbody></table>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="983" height="597" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_mpls.png"></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
contactar a:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<table class="m_-2714967827264337054gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="151" colspan="2" valign="top" style="width:113.2pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="161" colspan="2" valign="top" style="width:120.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>   ' . $argumentos['ingeniero3'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>   ' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
  </td>
 </tr>
</tbody></table><div class="yj6qo"></div><div class="adL">





<br></div></div>
  


  ';
    }

//
    public function mpls_avanzado_intranet_varios_puntos($argumentos) {
        return '
  
 
  
  <div dir="ltr"><div class="adM">

</div>
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif"> ' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
Servicio &nbsp;<b><span style="color:rgb(31,73,125)"> ' . $argumentos['servicio'] . '</span></b><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
los datos de contacto del Ingeniero encargado de la implementación de su
servicio. Es de suma importancia que sea revisado y nos retroalimente la
información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
contenida en este documento es importante que nos haga llegar sus inquietudes
ya que el servicio contratado será entregado de acuerdo a la información que
describimos a continuación. <span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="884" height="473" src="' . URL::base() . '/assets/img/mail_formats/mpls_avanzado_solucion_intranet_varios_puntos.png"></span></b><span lang="ES-CO"><span style="color:black"><span></span></span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b> ' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
detalla la secuencia de actividades para llevar a cabo la instalación del
servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453"src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>

<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

<table class="m_8746399538841561701gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="189" valign="top" style="width:141.65pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="747" colspan="20" valign="top" style="width:559.9pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:29.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="189" style="width:141.65pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS AVANZADO
  INTRANET</span></b><b><span style="font-family:&quot;Arial Black&quot;,sans-serif;color:rgb(31,73,125)"><span></span></span></b></p>
  </td>
  <td width="747" colspan="20" valign="top" style="width:559.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
  LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
  segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="189" rowspan="23" style="width:141.65pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino &nbsp;1 del Servicio)<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion_des1'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino &nbsp;2 del Servicio)<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion_des2'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino &nbsp;3 del Servicio)<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion_des3'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino &nbsp;4 del Servicio)<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion_des4'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
  </td>
  <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
  </td>
  <td width="195" colspan="7" valign="top" style="width:145.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['existente'] . '</span></span></b></p>
  </td>
  <td width="53" colspan="2" valign="top" style="width:39.75pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
  </td>
  <td width="215" colspan="7" valign="top" style="width:161.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['nuevo'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['ancho_banda'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.45pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:4.2pt">
  <td width="210" colspan="2" rowspan="4" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:4.2pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:4.2pt"></td>
  <td width="12" rowspan="4" style="width:9pt;padding:0cm;height:4.2pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span>' . $argumentos['equipos_intalar_camp1'] . '</span></p>
  </td>
 </tr>
 <tr style="height:4.1pt">
  <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:4.1pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['equipos_intalar_camp1'] . '</span></span></p>
  </td>
 </tr>
 <tr style="height:4.1pt">
  <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:4.1pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['equipos_intalar_camp2'] . '</span></span></p>
  </td>
 </tr>
 <tr style="height:4.1pt">
  <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:4.1pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['equipos_intalar_camp3'] . '</span></span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
  </td>
  <td width="347" colspan="13" valign="top" style="width:260.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['fecha_servicio'] . '</span></span></p>
  </td>
  <td width="189" colspan="5" valign="top" style="width:141.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
  necesarias para la instalación<span style="color:black"><span></span></span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="747" colspan="20" valign="top" style="width:559.9pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
  LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.45pt">
  <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
  del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
  </td>
  <td width="177" colspan="6" valign="top" style="width:132.7pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="179" colspan="8" valign="top" style="width:134.5pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.35pt">
  <td width="177" colspan="6" valign="top" style="width:132.7pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.5pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
  confirme Horarios)<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:5.8pt">
  <td width="177" colspan="6" valign="top" style="width:132.7pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:12.25pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
  Existencia de las siguientes condiciones:<span></span></span></i></b></p>
  </td>
  <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
  </td>
  <td width="92" colspan="3" valign="top" style="width:69.25pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
  </td>
  <td width="76" colspan="4" valign="top" style="width:57.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="103" colspan="4" valign="top" style="width:77.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
  equipos:<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:17.65pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.65pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.65pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:17.65pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:17.6pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la
  configuración de rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:17.6pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="210" colspan="2" rowspan="3" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del
  Contacto Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width="189" style="width:141.65pt;padding:0cm"></td>
  <td width="1" style="width:1pt;padding:0cm"></td>
  <td width="221" colspan="2" style="width:165.75pt;padding:0cm"></td>
  <td width="61" style="width:46.05pt;padding:0cm"></td>
  <td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
  <td width="92" colspan="3" style="width:69.1pt;padding:0cm"></td>
  <td width="85" colspan="3" style="width:63.75pt;padding:0cm"></td>
  <td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="94" colspan="2" style="width:70.5pt;padding:0cm"></td>
  <td width="95" colspan="2" style="width:71.2pt;padding:0cm"></td>
 </tr>
 <tr>
  <td width="189" style="width:141.65pt;padding:0cm"></td>
  <td width="1" style="width:1pt;padding:0cm"></td>
  <td width="209" style="width:156.65pt;padding:0cm"></td>
  <td width="12" style="width:9.1pt;padding:0cm"></td>
  <td width="61" style="width:46.05pt;padding:0cm"></td>
  <td width="11" style="width:8.3pt;padding:0cm"></td>
  <td width="12" style="width:9.25pt;padding:0cm"></td>
  <td width="30" style="width:22.5pt;padding:0cm"></td>
  <td width="50" style="width:37.5pt;padding:0cm"></td>
  <td width="12" style="width:9.1pt;padding:0cm"></td>
  <td width="73" style="width:54.75pt;padding:0cm"></td>
  <td width="6" style="width:4.5pt;padding:0cm"></td>
  <td width="6" style="width:4.5pt;padding:0cm"></td>
  <td width="47" style="width:35.25pt;padding:0cm"></td>
  <td width="17" style="width:13pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="3" style="width:2.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="82" style="width:61.5pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="83" style="width:62.2pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
 </tr>
</tbody></table>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="991" height="597" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones.png"></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
contactar a:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<table class="m_8746399538841561701gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="226" colspan="3" valign="top" style="width:169.7pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
  </td>
  <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="151" colspan="2" valign="top" style="width:113pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="161" colspan="2" valign="top" style="width:120.5pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
  </td>
 </tr>
</tbody></table><div class="yj6qo"></div><div class="adL">

<br></div></div>
  
  ';
    }

//
    public function mpls_avanzado_intranet_con_backup_de_ultima_milla_nds2($argumentos) {
        return '
  



  <div dir="ltr"><div class="adM">

</div><p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span>De:</span></b>
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>' . $argumentos['nombre_cliente'] . '</b>con el cual se da inicio al proceso de Instalación del
Servicio &nbsp;<b><span style="color:rgb(31,73,125">' . $argumentos['servicio'] . '</span></b><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
los datos de contacto del Ingeniero encargado de la implementación de su
servicio. Es de suma importancia que sea revisado y nos retroalimente la
información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
contenida en este documento es importante que nos haga llegar sus inquietudes
ya que el servicio contratado será entregado de acuerdo a la información que
describimos a continuación. <span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="978" height="591" src="' . URL::base() . '/assets/img/mail_formats/mpls_avanzado_solucion_intranet_con_backup_de_ultima_milla_nds2.png"></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b>' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
detalla la secuencia de actividades para llevar a cabo la instalación del
servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453"  src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>


<table class="m_937943869150412458gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="189" valign="top" style="width:5cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:29.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="189" style="width:5cm;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS AVANZADO
  INTRANET</span></b><b><span style="font-family:&quot;Arial Black&quot;,sans-serif;color:rgb(31,73,125)"><span></span></span></b></p>
  </td>
  <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
  LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
  segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="189" rowspan="17" style="width:5cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
  </td>
  <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
  </td>
  <td width="194" colspan="7" valign="top" style="width:145.8pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['existente'] . '</span></span></b></p>
  </td>
  <td width="53" colspan="2" valign="top" style="width:39.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
  </td>
  <td width="215" colspan="7" valign="top" style="width:161.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['nuevo'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['ancho_banda'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.45pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
  </td>
  <td width="347" colspan="13" valign="top" style="width:260.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['fecha_servicio'] . '</span></span></p>
  </td>
  <td width="189" colspan="5" valign="top" style="width:141.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
  necesarias para la instalación<span style="color:black"><span></span></span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
  LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.45pt">
  <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.6pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
  del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
  </td>
  <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="179" colspan="8" valign="top" style="width:134.5pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" valign="top" style="width:71.15pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.35pt">
  <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.5pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
  confirme Horarios)<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.15pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:5.8pt">
  <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:12.25pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
  Existencia de las siguientes condiciones:<span></span></span></i></b></p>
  </td>
  <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
  </td>
  <td width="92" colspan="3" valign="top" style="width:69.1pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
  </td>
  <td width="76" colspan="4" valign="top" style="width:57.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="103" colspan="4" valign="top" style="width:77.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
  equipos:<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" valign="top" style="width:71.15pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:17.65pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.65pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.65pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:17.65pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:17.6pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la configuración
  de rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:17.6pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="210" colspan="2" rowspan="3" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del
  Contacto Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width="189" style="width:5cm;padding:0cm"></td>
  <td width="1" style="width:1pt;padding:0cm"></td>
  <td width="221" colspan="2" style="width:165.85pt;padding:0cm"></td>
  <td width="61" style="width:45.9pt;padding:0cm"></td>
  <td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
  <td width="92" colspan="3" style="width:69.1pt;padding:0cm"></td>
  <td width="85" colspan="3" style="width:63.75pt;padding:0cm"></td>
  <td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="94" colspan="2" style="width:70.5pt;padding:0cm"></td>
  <td width="95" colspan="2" style="width:71.15pt;padding:0cm"></td>
 </tr>
 <tr>
  <td width="189" style="width:5cm;padding:0cm"></td>
  <td width="1" style="width:0.75pt;padding:0cm"></td>
  <td width="209" style="width:156.75pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="61" style="width:45.75pt;padding:0cm"></td>
  <td width="11" style="width:8.25pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="30" style="width:22.5pt;padding:0cm"></td>
  <td width="50" style="width:37.5pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="73" style="width:54.75pt;padding:0cm"></td>
  <td width="6" style="width:4.5pt;padding:0cm"></td>
  <td width="6" style="width:4.5pt;padding:0cm"></td>
  <td width="47" style="width:35.25pt;padding:0cm"></td>
  <td width="17" style="width:12.75pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="3" style="width:2.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="82" style="width:61.5pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="83" style="width:62.25pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
 </tr>
</tbody></table>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="995" height="647" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_mpls_avanzado_solucion_intranet_con_backup_de_ultima_milla_backup_de_router_nds1.png"></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
contactar a:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<table class="m_937943869150412458gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="151" colspan="2" valign="top" style="width:113.2pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="161" colspan="2" valign="top" style="width:120.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
  </td>
 </tr>
</tbody></table><div class="yj6qo"></div><div class="adL">

<br></div></div>
  ';
    }

//
    public function mpls_avanzado_intranet_con_backup_de_ultima_milla_y_router_nds1($argumentos) {
        return ' <div dir="ltr"><div class="adM">

</div>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
Servicio &nbsp;<b><span style="color:rgb(31,73,125)">' . $argumentos['servicio'] . '</span></b><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
los datos de contacto del Ingeniero encargado de la implementación de su
servicio. Es de suma importancia que sea revisado y nos retroalimente la
información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
contenida en este documento es importante que nos haga llegar sus inquietudes
ya que el servicio contratado será entregado de acuerdo a la información que
describimos a continuación. <span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="978" height="611" src="' . URL::base() . '/assets/img/mail_formats/mpls_avanzado_solucion_intranet_con_backup_de_ultima_milla_backup_de_router_nds1.png" ></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b>' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
detalla la secuencia de actividades para llevar a cabo la instalación del
servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453" src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></b></p>

<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

<table class="m_-9022856202092309242gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="189" valign="top" style="width:141.6pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="747" colspan="21" valign="top" style="width:559.95pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:29.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="189" style="width:141.6pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS AVANZADO
  INTRANET</span></b><b><span style="font-family:&quot;Arial Black&quot;,sans-serif;color:rgb(31,73,125)"><span></span></span></b></p>
  </td>
  <td width="747" colspan="21" valign="top" style="width:559.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
  LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
  segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="189" rowspan="20" style="width:141.6pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="19" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
  </td>
  <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
  </td>
  <td width="195" colspan="8" valign="top" style="width:145.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['existente'] . '</span></span></b></p>
  </td>
  <td width="53" colspan="2" valign="top" style="width:39.75pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
  </td>
  <td width="215" colspan="7" valign="top" style="width:161.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['nuevo'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="19" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['ancho_banda'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.45pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="19" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="19" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="19" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
  </td>
  <td width="347" colspan="14" valign="top" style="width:260.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['fecha_servicio'] . '</span></span></p>
  </td>
  <td width="189" colspan="5" valign="top" style="width:141.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
  necesarias para la instalación<span style="color:black"><span></span></span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="747" colspan="21" valign="top" style="width:559.95pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
  LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.45pt">
  <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
  del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
  </td>
  <td width="177" colspan="7" valign="top" style="width:132.7pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="179" colspan="8" valign="top" style="width:134.55pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.35pt">
  <td width="177" colspan="7" valign="top" style="width:132.7pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.55pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
  confirme Horarios)<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:5.8pt">
  <td width="177" colspan="7" valign="top" style="width:132.7pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:12.25pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
  Existencia de las siguientes condiciones:<span></span></span></i></b></p>
  </td>
  <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
  </td>
  <td width="92" colspan="4" valign="top" style="width:69.25pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
  </td>
  <td width="76" colspan="4" valign="top" style="width:57.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="103" colspan="4" valign="top" style="width:77.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
  equipos:<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:5.7pt">
  <td width="210" colspan="2" rowspan="4" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:5.7pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
  </td>
  <td width="119" colspan="5" valign="top" style="width:89.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:5.7pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif">IP LAN:<span style="color:black"><span></span></span></span></b></p>
  </td>
  <td width="418" colspan="14" valign="top" style="width:313.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:5.7pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" rowspan="4" style="width:9pt;padding:0cm;height:5.7pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:5.6pt">
  <td width="119" colspan="5" valign="top" style="width:89.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:5.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif">IP ACTIVA:<span style="color:black"><span></span></span></span></b></p>
  </td>
  <td width="418" colspan="14" valign="top" style="width:313.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:5.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr style="height:5.6pt">
  <td width="119" colspan="5" valign="top" style="width:89.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:5.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif">IP STANDBY:<span style="color:black"><span></span></span></span></b></p>
  </td>
  <td width="418" colspan="14" valign="top" style="width:313.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:5.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr style="height:5.6pt">
  <td width="119" colspan="5" valign="top" style="width:89.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:5.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif">IP VIRTUAL:<span style="color:black"><span></span></span></span></b></p>
  </td>
  <td width="418" colspan="14" valign="top" style="width:313.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:5.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr style="height:17.6pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la
  configuración de rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="536" colspan="19" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:17.6pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="210" colspan="2" rowspan="3" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del
  Contacto Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="127" colspan="6" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="127" colspan="6" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="127" colspan="6" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.1pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width="189" style="width:141.6pt;padding:0cm"></td>
  <td width="1" style="width:1pt;padding:0cm"></td>
  <td width="221" colspan="2" style="width:165.75pt;padding:0cm"></td>
  <td width="61" style="width:46.05pt;padding:0cm"></td>
  <td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
  <td width="92" colspan="4" style="width:69.1pt;padding:0cm"></td>
  <td width="85" colspan="3" style="width:63.8pt;padding:0cm"></td>
  <td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="94" colspan="2" style="width:70.5pt;padding:0cm"></td>
  <td width="95" colspan="2" style="width:71.2pt;padding:0cm"></td>
 </tr>
 <tr>
  <td width="189" style="width:141.6pt;padding:0cm"></td>
  <td width="1" style="width:1pt;padding:0cm"></td>
  <td width="209" style="width:156.65pt;padding:0cm"></td>
  <td width="12" style="width:9.1pt;padding:0cm"></td>
  <td width="61" style="width:46.05pt;padding:0cm"></td>
  <td width="11" style="width:8.3pt;padding:0cm"></td>
  <td width="12" style="width:9.25pt;padding:0cm"></td>
  <td width="30" colspan="2" style="width:22.5pt;padding:0cm"></td>
  <td width="50" style="width:37.5pt;padding:0cm"></td>
  <td width="12" style="width:9.1pt;padding:0cm"></td>
  <td width="73" style="width:54.75pt;padding:0cm"></td>
  <td width="6" style="width:4.55pt;padding:0cm"></td>
  <td width="6" style="width:4.5pt;padding:0cm"></td>
  <td width="47" style="width:35.25pt;padding:0cm"></td>
  <td width="17" style="width:13pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="3" style="width:2.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="82" style="width:61.5pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="83" style="width:62.2pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
 </tr>
 <tr>
  <td width="189" style="width:5cm;padding:0cm"></td>
  <td width="1" style="width:0.75pt;padding:0cm"></td>
  <td width="209" style="width:156.75pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="61" style="width:45.75pt;padding:0cm"></td>
  <td width="11" style="width:8.25pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="22" style="width:16.5pt;padding:0cm"></td>
  <td width="8" style="width:6pt;padding:0cm"></td>
  <td width="50" style="width:37.5pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="73" style="width:54.75pt;padding:0cm"></td>
  <td width="6" style="width:4.5pt;padding:0cm"></td>
  <td width="6" style="width:4.5pt;padding:0cm"></td>
  <td width="47" style="width:35.25pt;padding:0cm"></td>
  <td width="17" style="width:12.75pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="3" style="width:2.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="82" style="width:61.5pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="83" style="width:62.25pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
 </tr>
</tbody></table>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="992" height="635" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_mpls_avanzado_solucion_intranet_con_backup_de_ultima_milla_backup_de_router_nds1.png"></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
contactar a:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<table class="m_-9022856202092309242gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="151" colspan="2" valign="top" style="width:113.2pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="161" colspan="2" valign="top" style="width:120.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
  </td>
 </tr>
</tbody></table><div class="yj6qo"></div><div class="adL">

<br></div></div>
  
  ';
    }

//
    public function avanzado_extranet($argumentos) {
        return '
    
<div dir="ltr"><div class="adM">

</div>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
Servicio &nbsp;<b><span style="color:rgb(31,73,125)<">' . $argumentos['servicio'] . '</span></b><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
los datos de contacto del Ingeniero encargado de la implementación de su
servicio. Es de suma importancia que sea revisado y nos retroalimente la
información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
contenida en este documento es importante que nos haga llegar sus inquietudes
ya que el servicio contratado será entregado de acuerdo a la información que
describimos a continuación. <span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="982" height="555" src="' . URL::base() . '/assets/img/mail_formats/mpls_avanzado_solucion_extranet.png"></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b>' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
detalla la secuencia de actividades para llevar a cabo la instalación del
servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453" src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>


<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>

<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

<table class="m_3371736464730935837gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="189" valign="top" style="width:5cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:29.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="189" style="width:5cm;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS AVANZADO
  EXTRANET</span></b><b><span style="font-family:&quot;Arial Black&quot;,sans-serif;color:rgb(31,73,125)"><span></span></span></b></p>
  </td>
  <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
  LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
  segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="189" rowspan="17" style="width:5cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
  </td>
  <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
  </td>
  <td width="194" colspan="7" valign="top" style="width:145.8pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['existente'] . '</span></span></b></p>
  </td>
  <td width="53" colspan="2" valign="top" style="width:39.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
  </td>
  <td width="215" colspan="7" valign="top" style="width:161.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['nuevo'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['ancho_banda'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.45pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
  </td>
  <td width="347" colspan="13" valign="top" style="width:260.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['fecha_servicio'] . '</span></span></p>
  </td>
  <td width="189" colspan="5" valign="top" style="width:141.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
  necesarias para la instalación<span style="color:black"><span></span></span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="746" colspan="20" valign="top" style="width:559.55pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
  LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.45pt">
  <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.6pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
  del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
  </td>
  <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="179" colspan="8" valign="top" style="width:134.5pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" valign="top" style="width:71.15pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.35pt">
  <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.5pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
  confirme Horarios)<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.15pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:5.8pt">
  <td width="177" colspan="6" valign="top" style="width:132.55pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:12.25pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
  Existencia de las siguientes condiciones:<span></span></span></i></b></p>
  </td>
  <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
  </td>
  <td width="92" colspan="3" valign="top" style="width:69.1pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.75pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
  </td>
  <td width="76" colspan="4" valign="top" style="width:57.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="103" colspan="4" valign="top" style="width:77.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
  equipos:<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" valign="top" style="width:71.15pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:17.65pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.65pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.65pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:17.65pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:17.6pt">
  <td width="210" colspan="2" valign="top" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la configuración
  de rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:401.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.6pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:17.6pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="210" colspan="2" rowspan="3" style="width:157.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del
  Contacto Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="127" colspan="5" valign="top" style="width:94.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="409" colspan="13" valign="top" style="width:307.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width="189" style="width:5cm;padding:0cm"></td>
  <td width="1" style="width:1pt;padding:0cm"></td>
  <td width="221" colspan="2" style="width:165.85pt;padding:0cm"></td>
  <td width="61" style="width:45.9pt;padding:0cm"></td>
  <td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
  <td width="92" colspan="3" style="width:69.1pt;padding:0cm"></td>
  <td width="85" colspan="3" style="width:63.75pt;padding:0cm"></td>
  <td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="94" colspan="2" style="width:70.5pt;padding:0cm"></td>
  <td width="95" colspan="2" style="width:71.15pt;padding:0cm"></td>
 </tr>
 <tr>
  <td width="189" style="width:5cm;padding:0cm"></td>
  <td width="1" style="width:0.75pt;padding:0cm"></td>
  <td width="209" style="width:156.75pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="61" style="width:45.75pt;padding:0cm"></td>
  <td width="11" style="width:8.25pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="30" style="width:22.5pt;padding:0cm"></td>
  <td width="50" style="width:37.5pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="73" style="width:54.75pt;padding:0cm"></td>
  <td width="6" style="width:4.5pt;padding:0cm"></td>
  <td width="6" style="width:4.5pt;padding:0cm"></td>
  <td width="47" style="width:35.25pt;padding:0cm"></td>
  <td width="17" style="width:12.75pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="3" style="width:2.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="82" style="width:61.5pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="83" style="width:62.25pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
 </tr>
</tbody></table>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="984" height="597" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_mpls.png"></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
contactar a:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<table class="m_3371736464730935837gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="151" colspan="2" valign="top" style="width:113.2pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="161" colspan="2" valign="top" style="width:120.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
  </td>
 </tr>
</tbody></table><div class="yj6qo"></div><div class="adL">





<br></div></div>

';
    }

//
    public function backend_mpls($argumentos) {
        return '
<div dir="ltr"><div class="adM">



</div>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
Servicio &nbsp;<b><span style="color:rgb(31,73,125)"> ' . $argumentos['servicio'] . '</span></b><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
los datos de contacto del Ingeniero encargado de la implementación de su
servicio. Es de suma importancia que sea revisado y nos retroalimente la
información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
contenida en este documento es importante que nos haga llegar sus inquietudes
ya que el servicio contratado será entregado de acuerdo a la información que
describimos a continuación. <span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="887" height="522" src="' . URL::base() . '/assets/img/mail_formats/backend_mpls.png"  ></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b> ' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
detalla la secuencia de actividades para llevar a cabo la instalación del
servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span><img width="717" height="453" src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"></span></b><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>

<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>

<table class="m_7738108672524097144gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="189" valign="top" style="width:141.6pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="747" colspan="20" valign="top" style="width:559.95pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:29.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="189" style="width:141.6pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:14pt;line-height:115%;font-family:Arial,sans-serif">BACKEND MPLS<span></span></span></i></b></p>
  </td>
  <td width="747" colspan="20" valign="top" style="width:559.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
  LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
  segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="189" rowspan="18" style="width:141.6pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.05pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
  </td>
  <td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
  </td>
  <td width="94" colspan="3" valign="top" style="width:70.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['existente'] . '</span></span></b></p>
  </td>
  <td width="154" colspan="6" valign="top" style="width:115.5pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
  </td>
  <td width="215" colspan="7" valign="top" style="width:161.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['nuevo'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.05pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['ancho_banda'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.45pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
  </td>
  <td width="347" colspan="13" valign="top" style="width:260.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span> ' . $argumentos['fecha_servicio'] . '</span></span></p>
  </td>
  <td width="189" colspan="5" valign="top" style="width:141.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
  necesarias para la instalación<span style="color:black"><span></span></span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:16.4pt">
  <td width="747" colspan="20" valign="top" style="width:559.95pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
  LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:16.4pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.45pt">
  <td width="210" colspan="2" rowspan="3" valign="top" style="width:157.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
  del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
  </td>
  <td width="177" colspan="6" valign="top" style="width:132.7pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="179" colspan="8" valign="top" style="width:134.55pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.45pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:8.35pt">
  <td width="177" colspan="6" valign="top" style="width:132.7pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="179" colspan="8" rowspan="2" valign="top" style="width:134.55pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
  confirme Horarios)<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" rowspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:8.35pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:5.8pt">
  <td width="177" colspan="6" valign="top" style="width:132.7pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:5.8pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:12.25pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
  Existencia de las siguientes condiciones:<span></span></span></i></b></p>
  </td>
  <td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
  </td>
  <td width="92" colspan="3" valign="top" style="width:69.25pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
  </td>
  <td width="76" colspan="4" valign="top" style="width:57.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="103" colspan="4" valign="top" style="width:77.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
  equipos:<span></span></span></b></p>
  </td>
  <td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:12.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:17.65pt">
  <td width="210" colspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.65pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
  </td>
  <td width="536" colspan="18" valign="top" style="width:402.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.65pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:17.65pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="210" colspan="2" rowspan="2" valign="top" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif">La Solución en Datacenter tiene Firewall</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="167" colspan="5" valign="top" style="width:125.35pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif">Administrado por Claro</span></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="369" colspan="13" valign="top" style="width:276.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" rowspan="2" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="167" colspan="5" valign="top" style="width:125.35pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif">Administrado por Cliente</span></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="369" colspan="13" valign="top" style="width:276.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="210" colspan="2" rowspan="3" style="width:157.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del
  Contacto Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
  </td>
  <td width="167" colspan="5" valign="top" style="width:125.35pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="369" colspan="13" valign="top" style="width:276.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="167" colspan="5" valign="top" style="width:125.35pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="369" colspan="13" valign="top" style="width:276.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="height:11.25pt">
  <td width="167" colspan="5" valign="top" style="width:125.35pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
  </td>
  <td width="369" colspan="13" valign="top" style="width:276.95pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
  </td>
  <td width="12" style="width:9pt;padding:0cm;height:11.25pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width="189" style="width:141.6pt;padding:0cm"></td>
  <td width="1" style="width:1pt;padding:0cm"></td>
  <td width="221" colspan="2" style="width:165.75pt;padding:0cm"></td>
  <td width="61" style="width:46.05pt;padding:0cm"></td>
  <td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
  <td width="92" colspan="3" style="width:69.1pt;padding:0cm"></td>
  <td width="85" colspan="3" style="width:63.8pt;padding:0cm"></td>
  <td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="94" colspan="2" style="width:70.5pt;padding:0cm"></td>
  <td width="95" colspan="2" style="width:71.2pt;padding:0cm"></td>
 </tr>
 <tr>
  <td width="189" style="width:141.6pt;padding:0cm"></td>
  <td width="1" style="width:1pt;padding:0cm"></td>
  <td width="209" style="width:156.65pt;padding:0cm"></td>
  <td width="12" style="width:9.1pt;padding:0cm"></td>
  <td width="61" style="width:46.05pt;padding:0cm"></td>
  <td width="11" style="width:8.3pt;padding:0cm"></td>
  <td width="12" style="width:9.25pt;padding:0cm"></td>
  <td width="70" style="width:52.65pt;padding:0cm"></td>
  <td width="10" style="width:7.35pt;padding:0cm"></td>
  <td width="12" style="width:9.1pt;padding:0cm"></td>
  <td width="73" style="width:54.75pt;padding:0cm"></td>
  <td width="1" style="width:1pt;padding:0cm"></td>
  <td width="11" style="width:8.05pt;padding:0cm"></td>
  <td width="47" style="width:35.25pt;padding:0cm"></td>
  <td width="17" style="width:13pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="3" style="width:2.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="82" style="width:61.5pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="83" style="width:62.2pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
 </tr>
 <tr>
  <td width="189" style="width:5cm;padding:0cm"></td>
  <td width="1" style="width:0.75pt;padding:0cm"></td>
  <td width="209" style="width:156.75pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="61" style="width:45.75pt;padding:0cm"></td>
  <td width="11" style="width:8.25pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="70" style="width:52.5pt;padding:0cm"></td>
  <td width="10" style="width:7.5pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="73" style="width:54.75pt;padding:0cm"></td>
  <td width="1" style="width:0.75pt;padding:0cm"></td>
  <td width="11" style="width:8.25pt;padding:0cm"></td>
  <td width="47" style="width:35.25pt;padding:0cm"></td>
  <td width="17" style="width:12.75pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="3" style="width:2.25pt;padding:0cm"></td>
  <td width="9" style="width:6.75pt;padding:0cm"></td>
  <td width="82" style="width:61.5pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
  <td width="83" style="width:62.25pt;padding:0cm"></td>
  <td width="12" style="width:9pt;padding:0cm"></td>
 </tr>
</tbody></table>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black"><img width="868" height="531" src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_backend_mpls.png"></span></b></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
contactar a:<span></span></span></p>

<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>

<table class="m_7738108672524097144gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
 <tbody><tr style="height:29.05pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  <div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
  </span></b></div>
  <p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:14.3pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="151" colspan="2" valign="top" style="width:113.2pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="161" colspan="2" valign="top" style="width:120.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="227" colspan="3" valign="top" style="width:6cm;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="368" colspan="3" valign="top" style="width:276.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3'] . '</span></span></b></p>
  </td>
 </tr>
 <tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:162.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
  <p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span> ' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
  </td>
 </tr>
</tbody></table><div class="yj6qo"></div><div class="adL">





<br></div></div>

  ';
    }

//
    public function mpls_avanzado_componente_datacenter_claro($argumentos) {
        return '  

<div dir="ltr"><div class="adM">
</div>
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="margin:0in 0in 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>' . $argumentos['nombre_cliente'] . '</b>con el cual se da inicio al proceso de Instalación del
Servicio &nbsp;<b><span style="color:rgb(31,73,125)">' . $argumentos['servicio'] . '</span></b><span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
los datos de contacto del Ingeniero encargado de la implementación de su
servicio. Es de suma importancia que sea revisado y nos retroalimente la
información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
contenida en este documento es importante que nos haga llegar sus inquietudes
ya que el servicio contratado será entregado de acuerdo a la información que
describimos a continuación. <span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:black"><img src="' . URL::base() . '/assets/img/mail_formats/mpls_avanzado_con_componente_en_datacenter.png" width="885" height="516"></span><span lang="ES-CO"><span></span></span></p>
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b>' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
detalla la secuencia de actividades para llevar a cabo la instalación del
servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span><img src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png" width="717" height="453"></span><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>
<p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="color:white"><span>&nbsp;</span></span></b></p>
<table class="m_3929576187344687846gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
<tbody><tr style="height:29.05pt">
<td width="189" valign="top" style="width:141.65pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0in 5.4pt;height:29.05pt">
<p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
<div class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white">
<hr size="2" width="100%" align="center">
</span></b></div>
</td>
<td width="747" colspan="20" valign="top" style="width:559.9pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0in 5.4pt;height:29.05pt">
<p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
<div class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white">
<hr size="2" width="100%" align="center">
</span></b></div>
</td>
<td width="12" style="width:9pt;padding:0in;height:29.05pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:8.05pt">
<td width="189" style="width:141.65pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0in;height:8.05pt">
<p class="MsoNormal" style="margin:0in 0in 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS AVANZADO COMPONENTE DATACENTER</span></b><b><span lang="ES" style="font-family:&quot;Arial Black&quot;,sans-serif;color:rgb(31,73,125)"><span></span></span></b></p>
</td>
<td width="747" colspan="20" valign="top" style="width:559.9pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0in 5.4pt;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="color:black">DESCRIPCIÓN
DE LA SOLUCIÓN:</span></i></b><span lang="ES" style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por
esta razón el <b>Direccionamiento LAN</b> asignado para las sedes a conectar
no puede estar dentro del mismo segmento o duplicado.</span><b><span lang="ES" style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:8.05pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:8.05pt">
<td width="189" rowspan="25" style="width:141.65pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0in;height:8.05pt"></td>
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:8.05pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:8.05pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
</td>
<td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0in 5.4pt;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
</td>
<td width="53" colspan="3" valign="top" style="width:40.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['existente'] . '</span></span></b></p>
</td>
<td width="194" colspan="6" valign="top" style="width:145.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0in;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
</td>
<td width="215" colspan="7" valign="top" style="width:161.4pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['nuevo'] . '</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:8.05pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:8pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:8pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:8pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['ancho_banda'] . '</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:8pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:16.45pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:16.45pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:16.45pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:16.45pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:16.4pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="color:black">99.7 %
&nbsp;- NDS5</span></b><b><i><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:16.4pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:16.4pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:16.4pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:16.4pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
</td>
<td width="347" colspan="13" valign="top" style="width:260.55pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['fecha_servicio'] . '</span></span></p>
</td>
<td width="189" colspan="5" valign="top" style="width:141.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
necesarias para la instalación<span style="color:black"><span></span></span></span></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:16.4pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:16.4pt">
<td width="747" colspan="20" valign="top" style="width:559.9pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0in 5.4pt;height:16.4pt">
<p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
LA INSTALACIÓN DEL SERVICIO</span></b><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:16.4pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:8.45pt">
<td width="210" colspan="2" rowspan="3" valign="top" style="width:157.7pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0in 5.4pt;height:8.45pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
</td>
<td width="177" colspan="6" valign="top" style="width:132.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0in 5.4pt;height:8.45pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
</td>
<td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0in;height:8.45pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
<td width="179" colspan="8" valign="top" style="width:134.5pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0in;height:8.45pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
</td>
<td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0in;height:8.45pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:8.45pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:8.35pt">
<td width="177" colspan="6" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0in 5.4pt;height:8.35pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
</td>
<td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0in;height:8.35pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
<td width="179" colspan="8" rowspan="2" valign="top" style="width:134.5pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0in;height:8.35pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
confirme Horarios)<span></span></span></b></p>
</td>
<td width="95" colspan="2" rowspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0in;height:8.35pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:8.35pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:5.8pt">
<td width="177" colspan="6" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0in 5.4pt;height:5.8pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
</td>
<td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0in;height:5.8pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:5.8pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:12.25pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0in 5.4pt;height:12.25pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
Existencia de las siguientes condiciones:<span></span></span></i></b></p>
</td>
<td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0in 5.4pt;height:12.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
</td>
<td width="92" colspan="3" valign="top" style="width:69.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0in;height:12.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
</td>
<td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0in;height:12.25pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:8pt;font-family:Arial,sans-serif">Tomas
reguladas <span></span></span></i></b></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
</td>
<td width="76" colspan="4" valign="top" style="width:57.3pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0in;height:12.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
</td>
<td width="103" colspan="4" valign="top" style="width:77.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0in;height:12.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los equipos:<span></span></span></b></p>
</td>
<td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0in;height:12.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:12.25pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:17.65pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:17.65pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:17.65pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:17.65pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:17.6pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:17.6pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la configuración de
rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:17.6pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:17.6pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:0.05in">
<td width="210" colspan="2" rowspan="8" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in 5.4pt;height:0.05in">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black">Información para Finalizar el Cableado en
Datacenter Claro</span></i></b><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
</td>
<td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:0.05in">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Bunker<span style="color:black"><span></span></span></span></b></p>
</td>
<td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:0.05in">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
<td width="12" rowspan="8" style="width:9pt;padding:0in;height:0.05in">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
</td>
</tr>
<tr style="height:3.4pt">
<td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:3.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Rack<span style="color:black"><span></span></span></span></b></p>
</td>
<td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:3.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
</tr>
<tr style="height:3.4pt">
<td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:3.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Nombre del Equipo<span style="color:black"><span></span></span></span></b></p>
</td>
<td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:3.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
</tr>
<tr style="height:3.4pt">
<td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:3.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Puerto del Equipo<span style="color:black"><span></span></span></span></b></p>
</td>
<td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:3.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
</tr>
<tr style="height:5.65pt">
<td width="127" colspan="5" rowspan="2" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:5.65pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Interfaz<span style="color:black"><span></span></span></span></b></p>
</td>
<td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:5.65pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Fastethernet:<b><span style="color:black"><span></span></span></b></span></p>
</td>
</tr>
<tr style="height:5.6pt">
<td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:5.6pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Gigaethernet<b><span style="color:black"><span></span></span></b></span></p>
</td>
</tr>
<tr style="height:3.4pt">
<td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:3.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Conector<span style="color:black"><span></span></span></span></b></p>
</td>
<td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:3.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
</tr>
<tr style="height:3.4pt">
<td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:3.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Tipo Fibra/UTP<span style="color:black"><span></span></span></span></b></p>
</td>
<td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:3.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
</tr>
<tr style="height:11.25pt">
<td width="210" colspan="2" rowspan="3" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0in;height:11.25pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Datos del Contacto
Autorizado para recibir los reportes de Gestión Proactiva del CPE</span></i></b><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
</td>
<td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:11.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Correo Electrónico</span></i></b><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
</td>
<td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:11.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:11.25pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:11.25pt">
<td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:11.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Envió Quincenal</span></i></b><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
</td>
<td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:11.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:11.25pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr style="height:11.25pt">
<td width="127" colspan="5" valign="top" style="width:95.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:11.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif">Envió Mensual</span></i></b><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
</td>
<td width="409" colspan="13" valign="top" style="width:307pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:11.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0in;height:11.25pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;<span></span></span></p>
</td>
</tr>
<tr>
<td width="189" style="width:141.65pt;padding:0in"></td>
<td width="1" style="width:1pt;padding:0in"></td>
<td width="221" colspan="2" style="width:165.8pt;padding:0in"></td>
<td width="61" style="width:46.05pt;padding:0in"></td>
<td width="23" colspan="2" style="width:17.55pt;padding:0in"></td>
<td width="92" colspan="3" style="width:69.05pt;padding:0in"></td>
<td width="85" colspan="3" style="width:63.8pt;padding:0in"></td>
<td width="76" colspan="4" style="width:57.25pt;padding:0in"></td>
<td width="9" style="width:6.75pt;padding:0in"></td>
<td width="94" colspan="2" style="width:70.45pt;padding:0in"></td>
<td width="95" colspan="2" style="width:71.2pt;padding:0in"></td>
</tr>
<tr>
<td width="189" style="width:141.65pt;padding:0in"></td>
<td width="1" style="width:1pt;padding:0in"></td>
<td width="209" style="width:156.7pt;padding:0in"></td>
<td width="12" style="width:9.1pt;padding:0in"></td>
<td width="61" style="width:46.05pt;padding:0in"></td>
<td width="11" style="width:8.3pt;padding:0in"></td>
<td width="12" style="width:9.25pt;padding:0in"></td>
<td width="30" style="width:22.5pt;padding:0in"></td>
<td width="50" style="width:37.45pt;padding:0in"></td>
<td width="12" style="width:9.1pt;padding:0in"></td>
<td width="73" style="width:54.75pt;padding:0in"></td>
<td width="1" style="width:1pt;padding:0in"></td>
<td width="11" style="width:8.05pt;padding:0in"></td>
<td width="47" style="width:35.25pt;padding:0in"></td>
<td width="17" style="width:13pt;padding:0in"></td>
<td width="9" style="width:6.75pt;padding:0in"></td>
<td width="3" style="width:2.25pt;padding:0in"></td>
<td width="9" style="width:6.75pt;padding:0in"></td>
<td width="82" style="width:61.45pt;padding:0in"></td>
<td width="12" style="width:9pt;padding:0in"></td>
<td width="83" style="width:62.2pt;padding:0in"></td>
<td width="12" style="width:9pt;padding:0in"></td>
</tr>
<tr>
<td width="189" style="width:141.75pt;padding:0in"></td>
<td width="1" style="width:0.75pt;padding:0in"></td>
<td width="209" style="width:156.75pt;padding:0in"></td>
<td width="12" style="width:9pt;padding:0in"></td>
<td width="61" style="width:45.75pt;padding:0in"></td>
<td width="11" style="width:8.25pt;padding:0in"></td>
<td width="12" style="width:9pt;padding:0in"></td>
<td width="30" style="width:22.5pt;padding:0in"></td>
<td width="50" style="width:37.5pt;padding:0in"></td>
<td width="12" style="width:9pt;padding:0in"></td>
<td width="73" style="width:54.75pt;padding:0in"></td>
<td width="1" style="width:0.75pt;padding:0in"></td>
<td width="11" style="width:8.25pt;padding:0in"></td>
<td width="47" style="width:35.25pt;padding:0in"></td>
<td width="17" style="width:12.75pt;padding:0in"></td>
<td width="9" style="width:6.75pt;padding:0in"></td>
<td width="3" style="width:2.25pt;padding:0in"></td>
<td width="9" style="width:6.75pt;padding:0in"></td>
<td width="82" style="width:61.5pt;padding:0in"></td>
<td width="12" style="width:9pt;padding:0in"></td>
<td width="83" style="width:62.25pt;padding:0in"></td>
<td width="12" style="width:9pt;padding:0in"></td>
</tr>
</tbody></table>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:black"><img src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_mpls_avanzado_con_componente_datacenter_claro.png" width="880" height="533"></span><span lang="ES-CO"><span></span></span></p>
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
contactar a:<span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
<table class="m_3929576187344687846gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
<tbody><tr style="height:29.05pt">
<td width="226" colspan="3" valign="top" style="width:169.7pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0in 5.4pt;height:29.05pt">
<p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
<div class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
</span></b></div>
</td>
<td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0in 5.4pt;height:29.05pt">
<p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
<div class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white">
  <hr size="2" width="100%" align="center">
</span></b></div>
<p class="MsoNormal" align="center" style="text-align:center;margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
</td>
</tr>
<tr style="height:14.3pt">
<td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0in 5.4pt;height:14.3pt">
<p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
</td>
</tr>
<tr style="height:14.3pt">
<td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0in 5.4pt;height:14.3pt">
<p class="MsoNormal" style="margin:0in 0in 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
</td>
<td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in 5.4pt;height:14.3pt">
<p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1'] . '</span></span></b></p>
</td>
</tr>
<tr style="height:12.5pt">
<td width="151" colspan="2" valign="top" style="width:113pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0in 5.4pt;height:12.5pt">
<p class="MsoNormal" style="margin:0in 0in 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
  Contacto:<span></span></span></b></p>
</td>
<td width="161" colspan="2" valign="top" style="width:120.5pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
  <p class="MsoNormal" style="margin:0in 0in 6pt 0.25in;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
</td>
<td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
  <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
</td>
<td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
  <p class="MsoNormal" style="margin:0in 0in 6pt 0.25in;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
</td>
</tr>
<tr style="height:12.5pt">
<td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0in 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
</td>
</tr>
<tr style="height:12.5pt">
<td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0in 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
</td>
<td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
  <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2'] . '</span></span></b></p>
</td>
</tr>
<tr style="height:12.5pt">
<td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0in 5.4pt;height:12.5pt">
  <p class="MsoNormal" style="margin:0in 0in 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
    Contacto:<span></span></span></b></p>
  </td>
  <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
    <p class="MsoNormal" style="margin:0in 0in 6pt 0.25in;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
  </td>
  <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
    <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
  </td>
  <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0in;height:12.5pt">
    <p class="MsoNormal" style="margin:0in 0in 6pt 0.25in;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
  </td>
</tr>
<tr style="height:12.5pt">
  <td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0in 5.4pt;height:12.5pt">
    <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
</tr>
<tr style="height:12.5pt">
  <td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0in 5.4pt;height:12.5pt">
    <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES" style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
  </td>
  <td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0in;height:12.5pt">
    <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3'] . '</span></span></b></p>
  </td>
</tr>
<tr style="height:12.5pt">
  <td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0in 5.4pt;height:12.5pt">
    <p class="MsoNormal" style="margin:0in 0in 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
      Contacto:<span></span></span></b></p>
    </td>
    <td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0in;height:12.5pt">
      <p class="MsoNormal" style="margin:0in 0in 6pt 0.25in;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
    </td>
    <td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0in;height:12.5pt">
      <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
    </td>
    <td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0in;height:12.5pt">
      <p class="MsoNormal" style="margin:0in 0in 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
    </td>
  </tr>
  </tbody></table><div class="yj6qo"></div><div class="adL">
<br></div></div>

';
    }

//
    public function mpls_transaccional_3g($argumentos) {
        return '

  <div dir="ltr"><div class="adM">
</div>
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="margin:0cm 0cm 10pt;text-align:justify;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;line-height:115%;font-family:Arial,sans-serif">Cordial Saludo Señor(a)<span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">' . $argumentos['nombre'] . '</span></b><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif"><span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">A continuación se remite </span><span style="font-size:12pt;font-family:Arial,sans-serif">&nbsp;el reporte de Inicio de Actividades para <b>(' . $argumentos['nombre_cliente'] . ')&nbsp; </b>con el cual se da inicio al proceso de Instalación del
Servicio &nbsp;<b><span style="color:rgb(31,73,125)">' . $argumentos['servicio'] . '</span></b><span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Este documento&nbsp; contiene las definiciones del servicio a instalar y
los datos de contacto del Ingeniero encargado de la implementación de su
servicio. Es de suma importancia que sea revisado y nos retroalimente la
información que le solicitamos en el mismo. Si tiene alguna duda o inquietud no
dude en contactarnos.&nbsp; Si no está de acuerdo con alguna información
contenida en este documento es importante que nos haga llegar sus inquietudes
ya que el servicio contratado será entregado de acuerdo a la información que
describimos a continuación. <span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">SERVICIO A INSTALAR<span></span></span></b></p>
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:black"><img width="996" height="506" src="' . URL::base() . '/assets/img/mail_formats/mpls_transaccional_solucion_3g.png"></span></p>
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">A partir de hoy (<b>' . $argumentos['fecha'] . '</b>) &nbsp;se da inicio al Proceso de
instalación del Servicio<span style="color:rgb(31,73,125)">. </span>A continuación se
detalla la secuencia de actividades para llevar a cabo la instalación del
servicio.<span style="color:rgb(31,73,125)"><span></span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span><img  src="' . URL::base() . '/assets/img/mail_formats/actividades_para_la_instalacion_de_su_servicio.png"  width="717" height="453"></span><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif;color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif">CARACTERISTICAS DEL SERVICIO CONTRATADO<span></span></span></b></p>
<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:white"><span>&nbsp;</span></span></b></p>
<table class="m_-1356499913992082838gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="947" style="width:710.55pt;border-collapse:collapse">
<tbody><tr style="height:29.05pt">
<td width="189" valign="top" style="width:141.7pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">ENTREGABLE<span></span></span></b></p>
<div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
<hr size="2" width="100%" align="center">
</span></b></div>
</td>
<td width="746" colspan="20" valign="top" style="width:559.85pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">DISEÑO ORIGINAL<span></span></span></b></p>
<div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
<hr size="2" width="100%" align="center">
</span></b></div>
</td>
<td width="12" style="width:9pt;padding:0cm;height:29.05pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:8.05pt">
<td width="189" style="width:141.7pt;border-top:none;border-left:1pt solid rgb(192,0,0);border-bottom:none;border-right:1pt solid rgb(192,0,0);padding:0cm;height:8.05pt">
<p class="MsoNormal" style="margin:0cm 0cm 10pt;line-height:115%;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:14pt;line-height:115%;font-family:&quot;Arial Black&quot;,sans-serif;color:black">MPLS
TRANSACCIONAL 3G<span></span></span></b></p>
</td>
<td width="746" colspan="20" valign="top" style="width:559.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm 5.4pt;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="color:black">DESCRIPCIÓN DE LA SOLUCIÓN:</span></i></b><span style="font-family:Arial,sans-serif">Enlace de Nivel 3 o capa 3 </span><span lang="ES-CO" style="font-family:Arial,sans-serif">por esta razón el <b>Direccionamiento
LAN</b> asignado para las sedes a conectar no puede estar dentro del mismo
segmento o duplicado.</span><b><span style="font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:8.05pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:8.05pt">
<td width="189" rowspan="14" style="width:141.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm;height:8.05pt"></td>
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Destino del Servicio)<span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['direccion_instalacion'] . '</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:8.05pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:8.05pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Dirección de Instalación<span></span></span></i></b></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">(Punto Central)<span></span></span></i></b></p>
</td>
<td width="74" colspan="2" valign="top" style="width:55.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm 5.4pt;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Existente<span></span></span></b></p>
</td>
<td width="194" colspan="7" valign="top" style="width:145.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['existente'] . '</span></span></b></p>
</td>
<td width="53" colspan="2" valign="top" style="width:39.75pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(231,230,230);padding:0cm;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Nuevo<span></span></span></b></p>
</td>
<td width="215" colspan="7" valign="top" style="width:161.4pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:8.05pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['nuevo'] . '</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:8.05pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:8pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:8pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Ancho de Banda<span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:8pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['ancho_banda'] . '</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:8pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:16.45pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.45pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Interfaz de Entrega<span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.45pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['interfaz_entrega'] . '</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:16.45pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:16.4pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Disponibilidad<span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:black">99.7 % &nbsp;- NDS5</span></b><b><i><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:16.4pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:16.4pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Equipos a Instalar<span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:10pt;font-family:Arial,sans-serif;color:black">Conversor de Medio + Router<span></span></span></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:16.4pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:16.4pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black">Fecha de Entrega de Servicio<span></span></span></i></b></p>
</td>
<td width="347" colspan="13" valign="top" style="width:260.5pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>' . $argumentos['fecha_servicio'] . '</span></span></p>
</td>
<td width="189" colspan="5" valign="top" style="width:141.65pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:16.4pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:8pt;font-family:Arial,sans-serif">sujeta a cambios derivados del cumplimiento de las actividades
necesarias para la instalación<span style="color:black"><span></span></span></span></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:16.4pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:16.4pt">
<td width="746" colspan="20" valign="top" style="width:559.85pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:16.4pt">
<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN IMPORTANTE PARA
LA INSTALACIÓN DEL SERVICIO</span></b><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span></span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:16.4pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:8.45pt">
<td width="210" colspan="2" rowspan="3" valign="top" style="width:157.7pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:rgb(217,217,217);padding:0cm 5.4pt;height:8.45pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Para las Visitas
del Personal de Claro en su sede se requiere:<span></span></span></i></b></p>
</td>
<td width="177" colspan="6" valign="top" style="width:132.65pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.45pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Parafiscales:<span></span></span></b></p>
</td>
<td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
<td width="179" colspan="8" valign="top" style="width:134.45pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Certificación de Alturas:<span></span></span></b></p>
</td>
<td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:none;border-bottom:none;border-left:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.45pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:8.45pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:8.35pt">
<td width="177" colspan="6" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:8.35pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">EPP:<span></span></span></b></p>
</td>
<td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
<td width="179" colspan="8" rowspan="2" valign="top" style="width:134.45pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:white;padding:0cm;height:8.35pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Cursos especiales:<span></span></span></b></p>
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">(Por favor
confirme Horarios)<span></span></span></b></p>
</td>
<td width="95" colspan="2" rowspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm;height:8.35pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:8.35pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:5.8pt">
<td width="177" colspan="6" valign="top" style="width:132.65pt;border-top:1pt solid windowtext;border-left:none;border-bottom:none;border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:5.8pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Acompañamiento personal mantenimiento:<span></span></span></b></p>
</td>
<td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid windowtext;background:white;padding:0cm;height:5.8pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:5.8pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:12.25pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.25pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Confirme la
Existencia de las siguientes condiciones:<span></span></span></i></b></p>
</td>
<td width="85" colspan="3" valign="top" style="width:63.45pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm 5.4pt;height:12.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Rack:<span></span></span></b></p>
</td>
<td width="92" colspan="3" valign="top" style="width:69.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
</td>
<td width="85" colspan="2" valign="top" style="width:63.85pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">Tomas reguladas <span></span></span></i></b></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:8pt;font-family:Arial,sans-serif">(V N-T&lt; 1 V)</span></i></b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span></span></span></p>
</td>
<td width="76" colspan="4" valign="top" style="width:57.25pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
</td>
<td width="103" colspan="4" valign="top" style="width:77.2pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-CO" style="font-size:8pt;font-family:Arial,sans-serif;color:black">Requiere Bandeja para la instalación de los
equipos:<span></span></span></b></p>
</td>
<td width="95" colspan="2" valign="top" style="width:71.2pt;border-top:1pt solid windowtext;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid windowtext;background:white;padding:0cm;height:12.25pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:12.25pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:17.65pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.65pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span style="font-size:9pt;font-family:Arial,sans-serif">Direccionamiento LAN Asignado a la Sede:<span style="color:black"><span></span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.65pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:17.65pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr style="height:17.6pt">
<td width="210" colspan="2" valign="top" style="width:157.7pt;border-top:none;border-left:none;border-bottom:1pt solid windowtext;border-right:1pt solid rgb(192,0,0);background:rgb(217,217,217);padding:0cm 5.4pt;height:17.6pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><i><span lang="ES-CO" style="font-size:9pt;font-family:Arial,sans-serif;color:black">Existe algún elemento de red el cual requiere la configuración
de rutas para alcanzar el segmento LAN de la sede?</span></i></b><b><i><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span></span></span></i></b></p>
</td>
<td width="536" colspan="18" valign="top" style="width:402.15pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:17.6pt">
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><span>&nbsp;</span></span></b></p>
</td>
<td width="12" style="width:9pt;padding:0cm;height:17.6pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO">&nbsp;</span></p>
</td>
</tr>
<tr>
<td width="189" style="width:141.7pt;padding:0cm"></td>
<td width="1" style="width:1pt;padding:0cm"></td>
<td width="221" colspan="2" style="width:165.8pt;padding:0cm"></td>
<td width="61" style="width:46.05pt;padding:0cm"></td>
<td width="23" colspan="2" style="width:17.55pt;padding:0cm"></td>
<td width="92" colspan="3" style="width:69.05pt;padding:0cm"></td>
<td width="85" colspan="3" style="width:63.75pt;padding:0cm"></td>
<td width="76" colspan="4" style="width:57.25pt;padding:0cm"></td>
<td width="9" style="width:6.75pt;padding:0cm"></td>
<td width="94" colspan="2" style="width:70.45pt;padding:0cm"></td>
<td width="95" colspan="2" style="width:71.2pt;padding:0cm"></td>
</tr>
<tr>
<td width="189" style="width:141.7pt;padding:0cm"></td>
<td width="1" style="width:1pt;padding:0cm"></td>
<td width="209" style="width:156.7pt;padding:0cm"></td>
<td width="12" style="width:9.1pt;padding:0cm"></td>
<td width="61" style="width:46.05pt;padding:0cm"></td>
<td width="11" style="width:8.3pt;padding:0cm"></td>
<td width="12" style="width:9.25pt;padding:0cm"></td>
<td width="30" style="width:22.5pt;padding:0cm"></td>
<td width="50" style="width:37.45pt;padding:0cm"></td>
<td width="12" style="width:9.1pt;padding:0cm"></td>
<td width="73" style="width:54.75pt;padding:0cm"></td>
<td width="6" style="width:4.5pt;padding:0cm"></td>
<td width="6" style="width:4.5pt;padding:0cm"></td>
<td width="47" style="width:35.25pt;padding:0cm"></td>
<td width="17" style="width:13pt;padding:0cm"></td>
<td width="9" style="width:6.75pt;padding:0cm"></td>
<td width="3" style="width:2.25pt;padding:0cm"></td>
<td width="9" style="width:6.75pt;padding:0cm"></td>
<td width="82" style="width:61.45pt;padding:0cm"></td>
<td width="12" style="width:9pt;padding:0cm"></td>
<td width="83" style="width:62.2pt;padding:0cm"></td>
<td width="12" style="width:9pt;padding:0cm"></td>
</tr>
<tr>
<td width="189" style="width:5cm;padding:0cm"></td>
<td width="1" style="width:0.75pt;padding:0cm"></td>
<td width="209" style="width:156.75pt;padding:0cm"></td>
<td width="12" style="width:9pt;padding:0cm"></td>
<td width="61" style="width:45.75pt;padding:0cm"></td>
<td width="11" style="width:8.25pt;padding:0cm"></td>
<td width="12" style="width:9pt;padding:0cm"></td>
<td width="30" style="width:22.5pt;padding:0cm"></td>
<td width="50" style="width:37.5pt;padding:0cm"></td>
<td width="12" style="width:9pt;padding:0cm"></td>
<td width="73" style="width:54.75pt;padding:0cm"></td>
<td width="6" style="width:4.5pt;padding:0cm"></td>
<td width="6" style="width:4.5pt;padding:0cm"></td>
<td width="47" style="width:35.25pt;padding:0cm"></td>
<td width="17" style="width:12.75pt;padding:0cm"></td>
<td width="9" style="width:6.75pt;padding:0cm"></td>
<td width="3" style="width:2.25pt;padding:0cm"></td>
<td width="9" style="width:6.75pt;padding:0cm"></td>
<td width="82" style="width:61.5pt;padding:0cm"></td>
<td width="12" style="width:9pt;padding:0cm"></td>
<td width="83" style="width:62.25pt;padding:0cm"></td>
<td width="12" style="width:9pt;padding:0cm"></td>
</tr>
</tbody></table>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></b></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">La <b><i>Fecha de inicio de Facturación</i></b> corresponde a la fecha
en que Claro entrega el Servicio y es aceptado a satisfacción.<span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="font-size:12pt;font-family:Arial,sans-serif">Por favor tenga en cuenta las siguientes recomendaciones:<span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span style="color:black"><img  src="' . URL::base() . '/assets/img/mail_formats/recomendaciones_mpls_transaccional_3g.png"  width="979" height="546"></span></p>
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="font-size:12pt;font-family:Arial,sans-serif">Durante todo el Proceso de Instalación puede
contactar a:<span></span></span></p>
<p class="MsoNormal" style="text-align:justify;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-MX" style="color:rgb(31,73,125)"><span>&nbsp;</span></span></p>
<table class="m_-1356499913992082838gmail-MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="595" style="width:446.15pt;border-collapse:collapse">
<tbody><tr style="height:29.05pt">
<td width="226" colspan="3" valign="top" style="width:169.7pt;border:1pt solid rgb(192,0,0);background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">INFORMACIÓN CONTACTO<span></span></span></b></p>
<div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif;color:white">
<hr size="2" width="100%" align="center">
</span></b></div>
</td>
<td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:none;background:rgb(192,0,0);padding:0cm 5.4pt;height:29.05pt">
<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
<div class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white">
<hr size="2" width="100%" align="center">
</span></b></div>
<p class="MsoNormal" align="center" style="text-align:center;margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:12pt;font-family:Arial,sans-serif;color:white"><span>&nbsp;</span></span></b></p>
</td>
</tr>
<tr style="height:14.3pt">
<td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:14.3pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 1<span></span></span></b></p>
</td>
</tr>
<tr style="height:14.3pt">
<td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:14.3pt">
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:<span></span></span></b></p>
</td>
<td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm 5.4pt;height:14.3pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1'] . '</span></span></b></p>
</td>
</tr>
<tr style="height:12.5pt">
<td width="151" colspan="2" valign="top" style="width:113pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
Contacto:<span></span></span></b></p>
</td>
<td width="161" colspan="2" valign="top" style="width:120.5pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_tel'] . '</span></span></b></p>
</td>
<td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
</td>
<td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero1_email'] . '</span></span></b></p>
</td>
</tr>
<tr style="height:12.5pt">
<td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 2<span></span></span></b></p>
</td>
</tr>
<tr style="height:12.5pt">
<td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
</td>
<td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2'] . '</span></span></b></p>
</td>
</tr>
<tr style="height:12.5pt">
<td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:white;padding:0cm 5.4pt;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
Contacto:<span></span></span></b></p>
</td>
<td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_tel'] . '</span></span></b></p>
</td>
<td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
</td>
<td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);background:white;padding:0cm;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero2_email'] . '</span></span></b></p>
</td>
</tr>
<tr style="height:12.5pt">
<td width="595" colspan="6" valign="top" style="width:446.15pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;background:rgb(217,217,217);padding:0cm 5.4pt;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">NIVEL 3</span></b><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif"><span></span></span></b></p>
</td>
</tr>
<tr style="height:12.5pt">
<td width="226" colspan="3" valign="top" style="width:169.7pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span style="font-size:10pt;font-family:Arial,sans-serif">INGENIERO:</span></b><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span></span></span></b></p>
</td>
<td width="369" colspan="3" valign="top" style="width:276.45pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3'] . '</span></span></b></p>
</td>
</tr>
<tr style="height:12.5pt">
<td width="149" valign="top" style="width:111.5pt;border-right:1pt solid rgb(192,0,0);border-bottom:1pt solid rgb(192,0,0);border-left:1pt solid rgb(192,0,0);border-top:none;padding:0cm 5.4pt;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif">Teléfono
Contacto:<span></span></span></b></p>
</td>
<td width="163" colspan="3" valign="top" style="width:122pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt 18pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_tel'] . '</span></span></b></p>
</td>
<td width="66" valign="top" style="width:49.6pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:9pt;font-family:Arial,sans-serif">Email:<span></span></span></b></p>
</td>
<td width="217" valign="top" style="width:163.05pt;border-top:none;border-left:none;border-bottom:1pt solid rgb(192,0,0);border-right:1pt solid rgb(192,0,0);padding:0cm;height:12.5pt">
<p class="MsoNormal" style="margin:0cm 0cm 6pt;text-align:justify;font-size:11pt;font-family:Calibri,sans-serif"><b><span lang="ES-MX" style="font-size:10pt;font-family:Arial,sans-serif"><span>' . $argumentos['ingeniero3_email'] . '</span></span></b></p>
</td>
</tr>
<tr>
<td width="149" style="width:111.75pt;padding:0cm"></td>
<td width="2" style="width:1.5pt;padding:0cm"></td>
<td width="76" style="width:57pt;padding:0cm"></td>
<td width="85" style="width:63.75pt;padding:0cm"></td>
<td width="66" style="width:49.5pt;padding:0cm"></td>
<td width="217" style="width:162.75pt;padding:0cm"></td>
</tr>
</tbody></table>
<p class="MsoNormal" style="margin:0cm 0cm 0.0001pt;font-size:11pt;font-family:Calibri,sans-serif"><span lang="ES-CO"><span>&nbsp;</span></span></p><div class="yj6qo"></div><div class="adL">
<br></div></div>

';
    }

}