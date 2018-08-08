



<!--*********************  MODULO PESTAÑAS  *********************-->
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#after8days">KickOff 8 Días <span class="badge badge_cami" id="bdg_after8days">...</span></a></li>
</ul>
<!--******************************************  CONTENIDO PESTAÑAS  *********************************************************-->

<div class="tab-content" id="contenido_tablas">

	<div id="after8days" class="tab-pane fade in active">
        <h3>8 Días</h3>
        <table id="tablaEigtDaysOts" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
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
                </tr>
            </tfoot>
        </table>
    </div>

</div>







<!-- <button id="btn_email_ko15">UN BOTON X</button> -->
<div id="modalEmail_15dias" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" >
    <div class="modal-dialog modal-lg2" style="width: 1100px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h3 class="modal-title" id="myModalLabel">    Orden Ot Hija N <label id="id_ot_modal"></label></h3>
            </div>
            <div class="modal-body">
                <div>
                    <form class="well form-horizontal" id="formModal" action="Templates/ko_15d" method="post" novalidate="novalidate">
                        <fieldset>
                            <input value="" name="id_orden_trabajo_hija" id="id_orden_trabajo_hija" hidden>
                            <input value="" name="nro_ot_onyx" id="nro_ot_onyx" hidden>
                            <input value="" name="c_email" id="c_email" hidden>
                            <div class="widget bg_white m-t-25 display-block">
                                <fieldset class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre" class="col-md-3 control-label">Nombre: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input name="nombre" id="nombre" class="form-control" required type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ots_nombre" class="col-md-3 control-label">Nombre OTS: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input name="ots_nombre" id="ots_nombre" class="form-control" required type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ampliacion_enlaces" class="col-md-3 control-label">Ampliacion enlaces: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input name="ampliacion_enlaces" id="ampliacion_enlaces" class="form-control" required type="text">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--  fin seccion izquierda form-->
                                <!--  inicio seccion derecha form-->
                                <fieldset>
                                    <div class="form-group">
                                        <label for="direccion_servicio" class="col-md-3 control-label">Direccion servicio: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="statusColor"><i class="glyphicon glyphicon-user"></i></span>
                                                <input name="direccion_servicio" id="direccion_servicio" class="form-control" required type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="servicio" class="col-md-3 control-label">Servicio: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input name="servicio" id="servicio" class="form-control" required type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="vista_obra_civil" class="col-md-3 control-label">Obra civil: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input name="vista_obra_civil" id="vista_obra_civil" class="form-control" required type="text">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <!--  fin seccion derecha form---->
                            <!--  inicio seccion izquierda form---->
                            <fieldset class="col-md-6">
                                <div class="form-group">
                                    <label for="envio_cotizacion_obra_civil" class="col-md-3 control-label">Envio cotizacion obra civil: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input name="envio_cotizacion_obra_civil" id="envio_cotizacion_obra_civil" class="form-control" required type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="aprobacion_cotizacion_obra_civil" class="col-md-3 control-label">Aprobacion cotizacion obra civil: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input name="aprobacion_cotizacion_obra_civil" id="aprobacion_cotizacion_obra_civil" class="form-control" required type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ejecucion_obra_civil" class="col-md-3 control-label">Ejecucion obra civil : &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input name="ejecucion_obra_civil" id="ejecucion_obra_civil" class="form-control" required type="text">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--  fin seccion izquierda form-->
                            <!--  inicio seccion derecha form-->
                            <fieldset>
                                <div class="form-group">
                                    <label for="empalmes" class="col-md-3 control-label">Empalmes: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="statusColor"><i class="glyphicon glyphicon-user"></i></span>
                                            <input name="empalmes" id="empalmes" class="form-control" required type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="configuracion" class="col-md-3 control-label">Configuracion: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input name="configuracion" id="configuracion" class="form-control" required type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="equipos" class="col-md-3 control-label">Equipos: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input name="equipos" id="equipos" class="form-control" required type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="entrega_servicio" class="col-md-3 control-label">Entrega servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input name="entrega_servicio" id="entrega_servicio" class="form-control" required type="text">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </fieldset>
                        <fieldset>
                            <!--  fin seccion derecha form---->
                            <!--  inicio seccion izquierda form---->
                            <fieldset class="col-md-6">
                                <div class="form-group">
                                    <label for="ingeniero_implementacion_responsable_cuenta" class="col-md-3 control-label">Ingeniero Implementación Responsable Cuenta: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input name="ingeniero_implementacion_responsable_cuenta" id="ingeniero_implementacion_responsable_cuenta" class="form-control" required type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="celular" class="col-md-3 control-label">Celular : &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                            <input name="celular" id="celular" class="form-control" required type="number">
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <label for="mail_envio" class="col-md-3 control-label">Email: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="statusColor"><i class="glyphicon glyphicon-user"></i></span>
                                                <input name="mail_envio" id="mail_envio1" class="form-control" required type="text">
                                            </div>
                                        </div>
                                    </div>
                            </fieldset>
                            <!--  fin seccion izquierda form-->
                            <!--  inicio seccion derecha form-->
                            <fieldset>
                            </fieldset>
                        </div>
                    </div>
                    <!--  fin seccion derecha form---->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default cerrar" id="mbtnCerrarModal" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
                        <?php if (Auth::user()->n_role_user != 'claro'): ?>
                        <button type="submit" form="formModal" class="btn btn-info" id="bnt_ko"><i class='glyphicon glyphicon-send'></i>&nbsp;Enviar</button>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
</form>
</div>
</div>

<script src="<?= URL::to("assets/plugins/sweetalert2/sweetalert2.all.js") ?>"></script>