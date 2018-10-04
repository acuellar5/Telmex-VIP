<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_producto_model extends CI_Model {

    public function __construct() {

    }

    // insertar en pabla pr_internet
    public function insert_pr_internet($data) {
        if ($this->db->insert('pr_internet', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    // insertar en pabla pr_mpls
    public function insert_pr_mpls($data) {
        if ($this->db->insert('pr_mpls', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    // insertar en pabla pr_novedades
    public function insert_pr_novedades($data) {
        if ($this->db->insert('pr_novedades', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    // insertar en pabla pr_traslado_externo
    public function insert_pr_traslado_externo($data) {
        if ($this->db->insert('pr_traslado_externo', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    // insertar en pabla pr_traslado_interno
    public function insert_pr_traslado_interno($data) {
        if ($this->db->insert('pr_traslado_interno', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    // insertar en pabla pr_telefonia_fija
    public function insert_pr_telefonia_fija($data) {
        if ($this->db->insert('pr_telefonia_fija', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    // insertar en pabla pr_pbx_administrada
    public function insert_pr_pbx_administrada($data) {
        if ($this->db->insert('pr_pbx_administrada', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    // insertar en pabla pr_pbx_administrada
    public function insert_pr_private_line($data) {
        if ($this->db->insert('pr_private_line', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    // insertar en pabla pr_pbx_administrada
    public function insert_pr_lan_administrada($data) {
        if ($this->db->insert('pr_lan_administrada', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

}