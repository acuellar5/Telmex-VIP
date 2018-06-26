<?php

class EstadoOtModel extends Model {

    protected $k_id_estado_ot;
    protected $k_id_tipo;
    protected $n_name_estado_ot;
    protected $i_orden;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "estado_ot";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdEstadoOt($k_id_estado_ot) {
        $this->k_id_estado_ot = $k_id_estado_ot;
    }
    public function getKIdEstadoOt() {
        return $this->k_id_estado_ot;
    }
    public function setKIdTipo($k_id_tipo) {
        $this->k_id_tipo = $k_id_tipo;
    }
    public function getKIdTipo() {
        return $this->k_id_tipo;
    }
    public function setNNameEstadoOt($n_name_estado_ot) {
        $this->n_name_estado_ot = $n_name_estado_ot;
    }
    public function getNNameEstadoOt() {
        return $this->n_name_estado_ot;
    }
    public function setIOrden($i_orden) {
        $this->i_orden = $i_orden;
    }
    public function getIOrden() {
        return $this->i_orden;
    }


}

