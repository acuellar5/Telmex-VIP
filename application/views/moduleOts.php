<!--*********************  MODULO PESTAÑAS  *********************-->
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#hoy">Actuales <span class="badge badge_cami" id="bdg_hoy">...</span></a></li>
    <li class=""><a data-toggle="tab" href="#total">Total <span class="badge badge_cami" id="bdg_total">...</span></a></li>
    <li class=""><a data-toggle="tab" href="#nuevas">Nuevas <span class="badge badge_cami" id="bdg_nuevas">...</span></a></li>
    <li class=""><a data-toggle="tab" href="#cambio">Cambios <span class="badge badge_cami" id="bdg_cambios">...</span></a></li>
<!--     <li class=""><a data-toggle="tab" href="#dias_15">KickOff 15 Días <span class="badge badge_cami" id="bdg_15">...</span></a></li> -->
</ul>

<!--*********************  CONTENIDO PESTAÑAS  *********************-->
<div class="tab-content" id="contenido_tablas">

    <div id="hoy" class="tab-pane fade in active">
        <h3>Actuales</h3>
        <table id="tablaEditOts" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div id="total" class="tab-pane fade">
        <h3>Total</h3>
        <table id="tabla_total" class='table table-bordered table-striped dataTable_camilo' width='100%'>
            <thead>
            <th>OT Padre</th>
            <th>Id OT Hija</th>
            <th>Nombre Cliente</th>
            <th>Fecha Compromiso</th>
            <th>Fecha Programación</th>
            <th>OT Hija</th>
            <th>Estado OT Hija</th>
            <th>Ingeniero Responsable</th>
            <th>Recurrente</th>
            <th>opc</th>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div id="nuevas" class="tab-pane fade">
        <h3>Nuevas</h3>
        <table id="tablaNewOts" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div id="cambio" class="tab-pane fade">
        <h3>Cambios</h3>
        <table id="tablaChangesOts" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

<!--     <div id="dias_15" class="tab-pane fade">
        <h3>15 Días</h3>
        <table id="tablaFiteenDaysOts" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div> -->

</div>

<!-- Modal editar OTs -->
<div id="modalEditTicket" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" >
    <div class="modal-dialog modal-lg2" style="width: 1100px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h3 class="modal-title" id="myModalLabel">    Orden Ot Hija N <label id="id_ot_modal"></label></h3>
            </div>
            <div class="modal-body">
                <div>
                    <form class="well form-horizontal" id="formModal" action="Templates/c_updateStatusOt" method="post" novalidate="novalidate">
                        <input name="id_orden_trabajo_hija" id="id_orden_trabajo_hija" type="hidden">
                        <input name="estado_orden_trabajo_hija" id="estado_orden_trabajo_hija" type="hidden">
                        <input name="k_id_estado_ot_value" id="k_id_estado_ot_value" type="hidden">
                        <input name="c_email" id="c_email" type="hidden">
                        <fieldset>
                            <div class="widget bg_white m-t-25 display-block">
                                <fieldset class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_cliente_onyx" class="col-md-3 control-label">Id cliente onyx: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                                <input name="id_cliente_onyx" id="id_cliente_onyx" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nombre_cliente" class="col-md-3 control-label">Nombre cliente: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
                                                <input name="n_nombre_cliente" id="n_nombre_cliente" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="grupo_objetivo" class="col-md-3 control-label">Grupo Objetivo: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                <input name="grupo_objetivo" id="grupo_objetivo" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--  fin seccion izquierda form-->

                                <!--  inicio seccion derecha form-->
                                <fieldset>
                                    <div class="form-group">
                                        <label for="segmento" class="col-md-3 control-label">Segmento: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="statusColor"><i class="glyphicon glyphicon-hand-right"></i></span>
                                                <input name="segmento" id="segmento" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nivel_atencion" class="col-md-3 control-label">Nivel Atención: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                                <input name="nivel_atencion" id="nivel_atencion" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="ciudad" class="col-md-3 control-label">ciudad: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                <input name="ciudad" id="ciudad" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>                 
                                </fieldset>
                            </div>
                            <!--  fin seccion derecha form---->

                            <div class="widget bg_white m-t-25 display-block">
                                <fieldset class="col-md-6 control-label">
                                    <div class="form-group">
                                        <label for="departamento" class="col-md-3 control-label">departamento: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="departamento" id="departamento" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="grupo" class="col-md-3 control-label">grupo: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="grupo" id="grupo" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="consultor_comercial" class="col-md-3 control-label">Consultor Comercial: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="consultor_comercial" id="consultor_comercial" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--  fin seccion izquierda form---->

                                <!--  inicio seccion derecha form---->
                                <fieldset>
                                    <div class="form-group">
                                        <label for="grupo2" class="col-md-3 control-label">Grupo 2: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="grupo2" id="grupo2" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="consultor_postventa" class="col-md-3 control-label">Consultor Postventa: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="consultor_postventa" id="consultor_postventa" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="proy_instalacion" class="col-md-3 control-label">Proy Instalacion: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="proy_instalacion" id="proy_instalacion" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="widget bg_white m-t-25 display-block">
                                <fieldset class="col-md-6 control-label">
                                    <div class="form-group">
                                        <label for="ing_responsable" class="col-md-3 control-label">Ingeniero Responsable: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="ing_responsable" id="ing_responsable" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="id_enlace" class="col-md-3 control-label">Id Enlace: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="id_enlace" id="id_enlace" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="alias_enlace" class="col-md-3 control-label">Alias Enlace: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="alias_enlace" id="alias_enlace" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--  fin seccion izquierda form---->

                                <!--  inicio seccion derecha form---->
                                <fieldset>
                                    <div class="form-group">
                                        <label for="orden_trabajo" class="col-md-3 control-label">Orden Trabajo: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="orden_trabajo" id="orden_trabajo" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nro_ot_onyx" class="col-md-3 control-label">Nro Ot Onyx: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="nro_ot_onyx" id="nro_ot_onyx" class="form-control" type="text" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="servicio" class="col-md-3 control-label">Servicio: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="servicio" id="servicio" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="widget bg_white m-t-25 display-block">
                                <fieldset class="col-md-6 control-label">
                                    <div class="form-group">
                                        <label for="familia" class="col-md-3 control-label">Familia: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="familia" id="familia" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="producto" class="col-md-3 control-label">Producto: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="producto" id="producto" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="fecha_creacion" class="col-md-3 control-label">Fecha Creacion: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="fecha_creacion" id="fecha_creacion" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--  fin seccion izquierda form---->

                                <!--  inicio seccion derecha form---->
                                <fieldset>
                                    <div class="form-group">
                                        <label for="tiempo_incidente" class="col-md-3 control-label">Tiempo Incidente: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="tiempo_incidente" id="tiempo_incidente" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="estado_orden_trabajo" class="col-md-3 control-label">Estado Orden Trabajo: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="estado_orden_trabajo" id="estado_orden_trabajo" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tiempo_estado" class="col-md-3 control-label">Tiempo Estado: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="tiempo_estado" id="tiempo_estado" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="widget bg_white m-t-25 display-block">
                                <fieldset class="col-md-6 control-label">
                                    <div class="form-group">
                                        <label for="ano_ingreso_estado" class="col-md-3 control-label">Año Ingreso Estado: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="ano_ingreso_estado" id="ano_ingreso_estado" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="mes_ngreso_estado" class="col-md-3 control-label">Mes Ingreso Estado: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="mes_ngreso_estado" id="mes_ngreso_estado" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="fecha_ingreso_estado" class="col-md-3 control-label">Fecha Ingreso Estado: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="fecha_ingreso_estado" id="fecha_ingreso_estado" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--  fin seccion izquierda form---->

                                <!--  inicio seccion derecha form---->
                                <fieldset>
                                    <div class="form-group">
                                        <label for="usuario_asignado" class="col-md-3 control-label">Usuario Asignado: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="usuario_asignado" id="usuario_asignado" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="grupo_asignado" class="col-md-3 control-label">Grupo Asignado: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="grupo_asignado" id="grupo_asignado" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ingeniero_provisioning" class="col-md-3 control-label">Ingeniero Provisioning: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="ingeniero_provisioning" id="ingeniero_provisioning" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="widget bg_white m-t-25 display-block">
                                <fieldset class="col-md-6 control-label">
                                    <div class="form-group">
                                        <label for="cargo_arriendo" class="col-md-3 control-label">Cargo Arriendo: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="cargo_arriendo" id="cargo_arriendo" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cargo_mensual" class="col-md-3 control-label">Cargo Mensual: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="cargo_mensual" id="cargo_mensual" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="monto_moneda_local_arriendo" class="col-md-3 control-label">Monto Moneda Local Arriendo: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="monto_moneda_local_arriendo" id="monto_moneda_local_arriendo" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--  fin seccion izquierda form---->

                                <!--  inicio seccion derecha form---->
                                <fieldset>
                                    <div class="form-group">
                                        <label for="monto_moneda_local_cargo_mensual" class="col-md-3 control-label">Monto Moneda Local Cargo Mensual: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="monto_moneda_local_cargo_mensual" id="monto_moneda_local_cargo_mensual" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cargo_obra_civil" class="col-md-3 control-label">Cargo Obra Civil: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="cargo_obra_civil" id="cargo_obra_civil" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion" class="col-md-3 control-label">Descripcion: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="descripcion" id="descripcion" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="widget bg_white m-t-25 display-block">
                                <fieldset class="col-md-6 control-label">
                                    <div class="form-group">
                                        <label for="direccion_origen" class="col-md-3 control-label">Dirección Origen: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="direccion_origen" id="direccion_origen" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="ciudad_incidente" class="col-md-3 control-label">ciudad Incidente: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="ciudad_incidente" id="ciudad_incidente" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="direccion_destino" class="col-md-3 control-label">Dirección Destino: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="direccion_destino" id="direccion_destino" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--  fin seccion izquierda form---->

                                <!--  inicio seccion derecha form---->
                                <fieldset>
                                    <div class="form-group">
                                        <label for="ciudad_incidente3" class="col-md-3 control-label">Ciudad Incidente 3: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="ciudad_incidente3" id="ciudad_incidente3" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="fecha_compromiso" class="col-md-3 control-label">Fecha Compromiso: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="fecha_compromiso" id="fecha_compromiso" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_programacion" class="col-md-3 control-label">Fecha Programación: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="fecha_programacion" id="fecha_programacion" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="widget bg_white m-t-25 display-block">
                                <fieldset class="col-md-6 control-label">
                                    <div class="form-group">
                                        <label for="fecha_realizacion" class="col-md-3 control-label">Fecha Realización: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="fecha_realizacion" id="fecha_realizacion" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="resolucion_1" class="col-md-3 control-label">Resolución 1: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="resolucion_1" id="resolucion_1" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="resolucion_2" class="col-md-3 control-label">Resolución 2: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="resolucion_2" id="resolucion_2" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--  fin seccion izquierda form---->

                                <!--  inicio seccion derecha form---->
                                <fieldset>
                                    <div class="form-group">
                                        <label for="resolucion_3" class="col-md-3 control-label">Resolución 3: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="resolucion_3" id="resolucion_3" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="resolucion_4" class="col-md-3 control-label">Resolución 4: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="resolucion_4" id="resolucion_4" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_creacion_ot_hija" class="col-md-3 control-label">Fecha Creación Ot Hija: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="fecha_creacion_ot_hija" id="fecha_creacion_ot_hija" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="widget bg_white m-t-25 display-block">
                                <fieldset class="col-md-6 control-label">
                                    <div class="form-group">
                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Proveedor Ultima Milla: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="proveedor_ultima_milla" id="proveedor_ultima_milla" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="usuario_asignado4" class="col-md-3 control-label">Usuario Asignado 4: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="usuario_asignado4" id="usuario_asignado4" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="resolucion_15" class="col-md-3 control-label">Resolución 15: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="resolucion_15" id="resolucion_15" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--  fin seccion izquierda form---->

                                <!--  inicio seccion derecha form---->
                                <fieldset>
                                    <div class="form-group">
                                        <label for="resolucion_26" class="col-md-3 control-label">Resolución 26: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="resolucion_26" id="resolucion_26" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="resolucion_37" class="col-md-3 control-label">Resolución 37: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="resolucion_37" id="resolucion_37" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="resolucion_48" class="col-md-3 control-label">Resolución 48: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="resolucion_48" id="resolucion_48" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fec_actualizacion_onyx_hija" class="col-md-3 control-label">Fecha Actualizacion Onyx Hija: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="fec_actualizacion_onyx_hija" id="fec_actualizacion_onyx_hija" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="widget bg_white m-t-25 display-block">
                                <fieldset class="col-md-6 control-label">
                                    <div class="form-group">
                                        <label for="ot_hija" class="col-md-3 control-label">Ot Hija: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="ot_hija" id="ot_hija" class="form-control" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </div>


                                </fieldset>
                                <!--  fin seccion izquierda form---->

                                <!--  inicio seccion derecha form---->
                                <fieldset>
                                    <fieldset class="col-md-12 control-label">
                                        <div class="form-group">
                                            <label for="k_id_estado_ot" class="col-md-3 control-label">Estado Orden Trabajo Hija: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                    <select name="k_id_estado_ot" id="k_id_estado_ot" class="form-control llenarEstadosJS">           
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ins_servicio">
                                            <label for="t_servicio" class="col-md-3 control-label">Instalacion De Servicio: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <select class="form-control" id="ins_servicio" class="form-control">
                                                        <option value="">select...</option>
                                                        <option value="1">Internet Dedicado Empresarial</option>
                                                        <option value="2">Internet Dedicado </option>
                                                        <option value="3">MPLS Avanzado Intranet</option>
                                                        <option value="4">MPLS Avanzado Intranet - Varios Puntos</option>
                                                        <option value="5">MPLS Avanzado Intranet con Backup de Ultima Milla - NDS 2</option>
                                                        <option value="6">MPLS Avanzado Intranet con Backup de Ultima Milla y Router - NDS1</option>
                                                        <option value="7">MPLS Avanzado Extranet</option>
                                                        <option value="8">Backend MPLS </option>
                                                        <option value="8">MPLS Avanzado con Componente Datacenter Claro</option>
                                                        <option value="10">MPLS Transaccional 3G</option>
                                                    </select> 

                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                            </div>

                            <div class="widget bg_white m-t-25 display-block">
                                <fieldset class="col-md-12 control-label">
                                    <div class="form-group">
                                        <label for="n_observacion_cierre" class="col-md-3 control-label">Observaciones: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <textarea name="n_observacion_cierre" id="n_observacion_cierre" class="form-control" rows="3" cols="100"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group m-t-40 p-b-40"></div>
                                </fieldset>
                            </div>
                        </fieldset>

                        <!-- ********************************************************formulario plantillas******************************** -->
                        <div id="general"></div>
                        <!-- ********************************************************fin formulario plantillas******************************** -->

                    </form>
                </div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default cerrar" id="mbtnCerrarModal" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
                <?php if (Auth::user()->n_role_user != 'claro'): ?>
                    <button type="submit" form="formModal" class="btn btn-info" id="btnUpdOt"><i class='glyphicon glyphicon-save'></i>&nbsp;Actualizar</button>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>


<!-- MODAL DE HISTORIAL LOG -->
<!-- Modal tabla log -->
<div class="modal fade" id="ModalHistorialLog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove-sign"></span></button>
                <h4 class="modal-title" id="titleEventHistory">Modal Historial</h4>
            </div>
            <div class="modal-body" id="cuerpoModal">
                <div class="container2">
                    <!--*********************  MODULO PESTAÑAS  *********************-->
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab_log">Historial Log</a></li>
                        <li class=""><a data-toggle="tab" href="#tab_log_mail">Historial Mail</a></li>
                    </ul>
                    
                    <!--*********************  CONTENIDO PESTAÑAS  *********************-->
                    <div class="tab-content">
                    
                        <div id="tab_log" class="tab-pane fade in active">
                            <h3>Tabla Log</h3>
                            <table id="tableHistorialLog" class='table table-bordered table-striped  col-sm-12'  width='100%'>
                                <thead>
                                    <th>ORDEN</th>
                                    <th>ANTES</th>
                                    <th>AHORA</th>
                                    <th>COLUMNA CAMBIADA</th>
                                    <th>FECHA MODIFICACION</th>
                                </thead>
                            </table>
                            
                        </div>
                    
                        <div id="tab_log_mail" class="tab-pane fade">
                            <h3>Historial Mail</h3>
                            <table id="table_log_mail" class='table table-bordered table-striped' width='100%'>
                                <thead>
                                    <th>FECHA</th>
                                    <th>CLASE</th>
                                    <th>SERVICIO</th>
                                    <th>ENVIADO POR</th>
                                    <th>DESTINATARIOS</th>
                                    <th>DIRIGIDO A</th>
                                </thead>
                            </table>
                        </div>
                    
                    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <h4 class="foot">Zolid By ZTE Colombia | All Right Reserved</h4>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar  <i class="glyphicon glyphicon-chevron-up"></i></button>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php if (isset($_GET['msj'])): ?>
    <script>
        var urlbase = "<?php echo URL::base(); ?>";
        swal('OK', 'se actualizó correctamente', 'success');
    </script>
<?php endif ?>
