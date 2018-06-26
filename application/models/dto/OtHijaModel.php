<?php

class OtHijaModel extends Model {

    protected $k_id_register;
    protected $id_orden_trabajo_hija;
    protected $k_id_estado_ot;
    protected $id_cliente_onyx;
    protected $nombre_cliente;
    protected $grupo_objetivo;
    protected $segmento;
    protected $nivel_atencion;
    protected $ciudad;
    protected $departamento;
    protected $grupo;
    protected $consultor_comercial;
    protected $grupo2;
    protected $consultor_postventa;
    protected $proy_instalacion;
    protected $ing_responsable;
    protected $id_enlace;
    protected $alias_enlace;
    protected $orden_trabajo;
    protected $nro_ot_onyx;
    protected $servicio;
    protected $familia;
    protected $producto;
    protected $fecha_creacion;
    protected $tiempo_incidente;
    protected $estado_orden_trabajo;
    protected $tiempo_estado;
    protected $ano_ingreso_estado;
    protected $mes_ngreso_estado;
    protected $fecha_ingreso_estado;
    protected $usuario_asignado;
    protected $grupo_asignado;
    protected $ingeniero_provisioning;
    protected $cargo_arriendo;
    protected $cargo_mensual;
    protected $monto_moneda_local_arriendo;
    protected $monto_moneda_local_cargo_mensual;
    protected $cargo_obra_civil;
    protected $descripcion;
    protected $direccion_origen;
    protected $ciudad_incidente;
    protected $direccion_destino;
    protected $ciudad_incidente3;
    protected $fecha_compromiso;
    protected $fecha_programacion;
    protected $fecha_realizacion;
    protected $resolucion_1;
    protected $resolucion_2;
    protected $resolucion_3;
    protected $resolucion_4;
    protected $fecha_creacion_ot_hija;
    protected $proveedor_ultima_milla;
    protected $usuario_asignado4;
    protected $resolucion_15;
    protected $resolucion_26;
    protected $resolucion_37;
    protected $resolucion_48;
    protected $ot_hija;
    protected $estado_orden_trabajo_hija;
    protected $fec_actualizacion_onyx_hija;
    protected $fecha_actual;
    protected $n_days;
    protected $observaciones;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "ot_hija";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdRegister($k_id_register) {
        $this->k_id_register = $k_id_register;
    }
    public function getKIdRegister() {
        return $this->k_id_register;
    }
    public function setIdOrdenTrabajoHija($id_orden_trabajo_hija) {
        $this->id_orden_trabajo_hija = $id_orden_trabajo_hija;
    }
    public function getIdOrdenTrabajoHija() {
        return $this->id_orden_trabajo_hija;
    }
    public function setKIdEstadoOt($k_id_estado_ot) {
        $this->k_id_estado_ot = $k_id_estado_ot;
    }
    public function getKIdEstadoOt() {
        return $this->k_id_estado_ot;
    }
    public function setIdClienteOnyx($id_cliente_onyx) {
        $this->id_cliente_onyx = $id_cliente_onyx;
    }
    public function getIdClienteOnyx() {
        return $this->id_cliente_onyx;
    }
    public function setNombreCliente($nombre_cliente) {
        $this->nombre_cliente = $nombre_cliente;
    }
    public function getNombreCliente() {
        return $this->nombre_cliente;
    }
    public function setGrupoObjetivo($grupo_objetivo) {
        $this->grupo_objetivo = $grupo_objetivo;
    }
    public function getGrupoObjetivo() {
        return $this->grupo_objetivo;
    }
    public function setSegmento($segmento) {
        $this->segmento = $segmento;
    }
    public function getSegmento() {
        return $this->segmento;
    }
    public function setNivelAtencion($nivel_atencion) {
        $this->nivel_atencion = $nivel_atencion;
    }
    public function getNivelAtencion() {
        return $this->nivel_atencion;
    }
    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }
    public function getCiudad() {
        return $this->ciudad;
    }
    public function setDepartamento($departamento) {
        $this->departamento = $departamento;
    }
    public function getDepartamento() {
        return $this->departamento;
    }
    public function setGrupo($grupo) {
        $this->grupo = $grupo;
    }
    public function getGrupo() {
        return $this->grupo;
    }
    public function setConsultorComercial($consultor_comercial) {
        $this->consultor_comercial = $consultor_comercial;
    }
    public function getConsultorComercial() {
        return $this->consultor_comercial;
    }
    public function setGrupo2($grupo2) {
        $this->grupo2 = $grupo2;
    }
    public function getGrupo2() {
        return $this->grupo2;
    }
    public function setConsultorPostventa($consultor_postventa) {
        $this->consultor_postventa = $consultor_postventa;
    }
    public function getConsultorPostventa() {
        return $this->consultor_postventa;
    }
    public function setProyInstalacion($proy_instalacion) {
        $this->proy_instalacion = $proy_instalacion;
    }
    public function getProyInstalacion() {
        return $this->proy_instalacion;
    }
    public function setIngResponsable($ing_responsable) {
        $this->ing_responsable = $ing_responsable;
    }
    public function getIngResponsable() {
        return $this->ing_responsable;
    }
    public function setIdEnlace($id_enlace) {
        $this->id_enlace = $id_enlace;
    }
    public function getIdEnlace() {
        return $this->id_enlace;
    }
    public function setAliasEnlace($alias_enlace) {
        $this->alias_enlace = $alias_enlace;
    }
    public function getAliasEnlace() {
        return $this->alias_enlace;
    }
    public function setOrdenTrabajo($orden_trabajo) {
        $this->orden_trabajo = $orden_trabajo;
    }
    public function getOrdenTrabajo() {
        return $this->orden_trabajo;
    }
    public function setNroOtOnyx($nro_ot_onyx) {
        $this->nro_ot_onyx = $nro_ot_onyx;
    }
    public function getNroOtOnyx() {
        return $this->nro_ot_onyx;
    }
    public function setServicio($servicio) {
        $this->servicio = $servicio;
    }
    public function getServicio() {
        return $this->servicio;
    }
    public function setFamilia($familia) {
        $this->familia = $familia;
    }
    public function getFamilia() {
        return $this->familia;
    }
    public function setProducto($producto) {
        $this->producto = $producto;
    }
    public function getProducto() {
        return $this->producto;
    }
    public function setFechaCreacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }
    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }
    public function setTiempoIncidente($tiempo_incidente) {
        $this->tiempo_incidente = $tiempo_incidente;
    }
    public function getTiempoIncidente() {
        return $this->tiempo_incidente;
    }
    public function setEstadoOrdenTrabajo($estado_orden_trabajo) {
        $this->estado_orden_trabajo = $estado_orden_trabajo;
    }
    public function getEstadoOrdenTrabajo() {
        return $this->estado_orden_trabajo;
    }
    public function setTiempoEstado($tiempo_estado) {
        $this->tiempo_estado = $tiempo_estado;
    }
    public function getTiempoEstado() {
        return $this->tiempo_estado;
    }
    public function setAnoIngresoEstado($ano_ingreso_estado) {
        $this->ano_ingreso_estado = $ano_ingreso_estado;
    }
    public function getAnoIngresoEstado() {
        return $this->ano_ingreso_estado;
    }
    public function setMesNgresoEstado($mes_ngreso_estado) {
        $this->mes_ngreso_estado = $mes_ngreso_estado;
    }
    public function getMesNgresoEstado() {
        return $this->mes_ngreso_estado;
    }
    public function setFechaIngresoEstado($fecha_ingreso_estado) {
        $this->fecha_ingreso_estado = $fecha_ingreso_estado;
    }
    public function getFechaIngresoEstado() {
        return $this->fecha_ingreso_estado;
    }
    public function setUsuarioAsignado($usuario_asignado) {
        $this->usuario_asignado = $usuario_asignado;
    }
    public function getUsuarioAsignado() {
        return $this->usuario_asignado;
    }
    public function setGrupoAsignado($grupo_asignado) {
        $this->grupo_asignado = $grupo_asignado;
    }
    public function getGrupoAsignado() {
        return $this->grupo_asignado;
    }
    public function setIngenieroProvisioning($ingeniero_provisioning) {
        $this->ingeniero_provisioning = $ingeniero_provisioning;
    }
    public function getIngenieroProvisioning() {
        return $this->ingeniero_provisioning;
    }
    public function setCargoArriendo($cargo_arriendo) {
        $this->cargo_arriendo = $cargo_arriendo;
    }
    public function getCargoArriendo() {
        return $this->cargo_arriendo;
    }
    public function setCargoMensual($cargo_mensual) {
        $this->cargo_mensual = $cargo_mensual;
    }
    public function getCargoMensual() {
        return $this->cargo_mensual;
    }
    public function setMontoMonedaLocalArriendo($monto_moneda_local_arriendo) {
        $this->monto_moneda_local_arriendo = $monto_moneda_local_arriendo;
    }
    public function getMontoMonedaLocalArriendo() {
        return $this->monto_moneda_local_arriendo;
    }
    public function setMontoMonedaLocalCargoMensual($monto_moneda_local_cargo_mensual) {
        $this->monto_moneda_local_cargo_mensual = $monto_moneda_local_cargo_mensual;
    }
    public function getMontoMonedaLocalCargoMensual() {
        return $this->monto_moneda_local_cargo_mensual;
    }
    public function setCargoObraCivil($cargo_obra_civil) {
        $this->cargo_obra_civil = $cargo_obra_civil;
    }
    public function getCargoObraCivil() {
        return $this->cargo_obra_civil;
    }
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }
    public function setDireccionOrigen($direccion_origen) {
        $this->direccion_origen = $direccion_origen;
    }
    public function getDireccionOrigen() {
        return $this->direccion_origen;
    }
    public function setCiudadIncidente($ciudad_incidente) {
        $this->ciudad_incidente = $ciudad_incidente;
    }
    public function getCiudadIncidente() {
        return $this->ciudad_incidente;
    }
    public function setDireccionDestino($direccion_destino) {
        $this->direccion_destino = $direccion_destino;
    }
    public function getDireccionDestino() {
        return $this->direccion_destino;
    }
    public function setCiudadIncidente3($ciudad_incidente3) {
        $this->ciudad_incidente3 = $ciudad_incidente3;
    }
    public function getCiudadIncidente3() {
        return $this->ciudad_incidente3;
    }
    public function setFechaCompromiso($fecha_compromiso) {
        $this->fecha_compromiso = $fecha_compromiso;
    }
    public function getFechaCompromiso() {
        return $this->fecha_compromiso;
    }
    public function setFechaProgramacion($fecha_programacion) {
        $this->fecha_programacion = $fecha_programacion;
    }
    public function getFechaProgramacion() {
        return $this->fecha_programacion;
    }
    public function setFechaRealizacion($fecha_realizacion) {
        $this->fecha_realizacion = $fecha_realizacion;
    }
    public function getFechaRealizacion() {
        return $this->fecha_realizacion;
    }
    public function setResolucion1($resolucion_1) {
        $this->resolucion_1 = $resolucion_1;
    }
    public function getResolucion1() {
        return $this->resolucion_1;
    }
    public function setResolucion2($resolucion_2) {
        $this->resolucion_2 = $resolucion_2;
    }
    public function getResolucion2() {
        return $this->resolucion_2;
    }
    public function setResolucion3($resolucion_3) {
        $this->resolucion_3 = $resolucion_3;
    }
    public function getResolucion3() {
        return $this->resolucion_3;
    }
    public function setResolucion4($resolucion_4) {
        $this->resolucion_4 = $resolucion_4;
    }
    public function getResolucion4() {
        return $this->resolucion_4;
    }
    public function setFechaCreacionOtHija($fecha_creacion_ot_hija) {
        $this->fecha_creacion_ot_hija = $fecha_creacion_ot_hija;
    }
    public function getFechaCreacionOtHija() {
        return $this->fecha_creacion_ot_hija;
    }
    public function setProveedorUltimaMilla($proveedor_ultima_milla) {
        $this->proveedor_ultima_milla = $proveedor_ultima_milla;
    }
    public function getProveedorUltimaMilla() {
        return $this->proveedor_ultima_milla;
    }
    public function setUsuarioAsignado4($usuario_asignado4) {
        $this->usuario_asignado4 = $usuario_asignado4;
    }
    public function getUsuarioAsignado4() {
        return $this->usuario_asignado4;
    }
    public function setResolucion15($resolucion_15) {
        $this->resolucion_15 = $resolucion_15;
    }
    public function getResolucion15() {
        return $this->resolucion_15;
    }
    public function setResolucion26($resolucion_26) {
        $this->resolucion_26 = $resolucion_26;
    }
    public function getResolucion26() {
        return $this->resolucion_26;
    }
    public function setResolucion37($resolucion_37) {
        $this->resolucion_37 = $resolucion_37;
    }
    public function getResolucion37() {
        return $this->resolucion_37;
    }
    public function setResolucion48($resolucion_48) {
        $this->resolucion_48 = $resolucion_48;
    }
    public function getResolucion48() {
        return $this->resolucion_48;
    }
    public function setOtHija($ot_hija) {
        $this->ot_hija = $ot_hija;
    }
    public function getOtHija() {
        return $this->ot_hija;
    }
    public function setEstadoOrdenTrabajoHija($estado_orden_trabajo_hija) {
        $this->estado_orden_trabajo_hija = $estado_orden_trabajo_hija;
    }
    public function getEstadoOrdenTrabajoHija() {
        return $this->estado_orden_trabajo_hija;
    }
    public function setFecActualizacionOnyxHija($fec_actualizacion_onyx_hija) {
        $this->fec_actualizacion_onyx_hija = $fec_actualizacion_onyx_hija;
    }
    public function getFecActualizacionOnyxHija() {
        return $this->fec_actualizacion_onyx_hija;
    }
    public function setFechaActual($fecha_actual) {
        $this->fecha_actual = $fecha_actual;
    }
    public function getFechaActual() {
        return $this->fecha_actual;
    }
    public function setNDays($n_days) {
        $this->n_days = $n_days;
    }
    public function getNDays() {
        return $this->n_days;
    }
    public function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }
    public function getObservaciones() {
        return $this->observaciones;
    }


}

