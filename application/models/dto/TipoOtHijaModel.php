<?php

class TipoOtHijaModel extends Model {

    protected $k_id_tipo;
    protected $n_name_tipo;
    protected $i_referencia;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "tipo_ot_hija";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdTipo($k_id_tipo) {
        $this->k_id_tipo = $k_id_tipo;
    }
    public function getKIdTipo() {
        return $this->k_id_tipo;
    }
    public function setNNameTipo($n_name_tipo) {
        $this->n_name_tipo = $n_name_tipo;
    }
    public function getNNameTipo() {
        return $this->n_name_tipo;
    }
    public function setIReferencia($i_referencia) {
        $this->i_referencia = $i_referencia;
    }
    public function getIReferencia() {
        return $this->i_referencia;
    }


}

