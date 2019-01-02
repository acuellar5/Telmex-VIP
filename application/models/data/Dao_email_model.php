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
            'protocol'    => 'smtp',
            'smtp_host'   => 'smtp.gmail.com',
            'smtp_port'   => 587,
            'smtp_user'   => 'zolid.telmex.vip@gmail.com',
            'smtp_pass'   => 'z0l1dTelmex',
            // 'smtp_timeout' => 5, //tiempo de conexion maxima 5 segundos
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'priority'    => 1,
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
            $return['msg']     = 'El correo fue enviado correctamente.';
        } else {
            $return['success'] = false;
            $return['msg']     = 'Hubo un error al momento de enviar el correo, por favor inténtelo nuevamente.';
            $return['error'] = $this->email->print_debugger();
            // show_error($this->email->print_debugger() . 'dao model');
        }
        return $return;

    }

    // Retorna registro de reporte_automatico por año y semana
    public function get_reporteautomatico_by_week($ano, $semana) {
        $query = $this->db->get_where('reporte_automatico', array('ano' => $ano, 'semana' => $semana));
        return $query->row();
    }

    // Inserta registro en la tabla reporte_automatico
    public function insert_reporte_automatico($data) {
        if ($this->db->insert('reporte_automatico', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }

    }
}