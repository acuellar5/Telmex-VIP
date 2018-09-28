<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_email_model extends CI_Model {

    protected $session;

    public function __construct() {
        
    }

    public function h_enviarCorreo($cuerpo, $dirigido, $asunto = 'Sin asunto', $mail_cc = null) {
        $return = array();
        $this->load->library('parser');

        $config = Array(
             'smtp_crypto' => 'tls', //protocolo de encriptado
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'zolid.telmex.vip@gmail.com',
            'smtp_pass' => 'z0l1dTelmex',
            // 'smtp_timeout' => 5, //tiempo de conexion maxima 5 segundos
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'priority' => 1,
        );
        
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('zolid.telmex.vip@gmail.com', 'TELMEX VIP'); // change it to yours
        $this->email->to($dirigido); // change it to yours
        if ($mail_cc) {
            $this->email->cc($mail_cc);
        }
        $this->email->subject($asunto);
        $this->email->message($cuerpo);
        if ($this->email->send()) {
            $return['success'] = true;
            $return['msg'] = 'El correo fue enviado correctamente.';
            return $return;
        } else {
            $return['success'] = false;
            $return['msg'] = 'Hubo un error al momento de enviar el correo, por favor inténtelo nuevamente.';
            show_error($this->email->print_debugger().'dao model');
        }
        
        
    }

}

