<!--*********************  MODULO PESTAÑAS  *********************-->
<ul class="nav nav-tabs" id="pestania">
    <li tabla="table_otPadreList" class="active"><a data-toggle="tab" href="#total">Total</a></li>
    <li tabla="table_otPadreListHoy" class=""><a data-toggle="tab" href="#hoy">Hoy</a></li>
    <li tabla="table_otPadreListVencidas" class=""><a data-toggle="tab" href="#vencidas">Vencida</a></li>
    <li tabla="table_list_opc" class=""><a data-toggle="tab" href="#por_lista">Por Lista</a></li>
    <li tabla="table_otPadreListEmails" class=""><a data-toggle="tab" href="#lista_email">Cant emails</a></li>
</ul>

<!--*********************  CONTENIDO PESTAÑAS  *********************-->
<div class="tab-content" id="contenido_tablas">

    <div id="total" class="tab-pane fade in active">
        <h3>OT Padre</h3>
        <table id="table_otPadreList" class="table table-hover table-bordered table-striped dataTable_camilo" style="width: 100%;">
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
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div id="hoy" class="tab-pane fade">
        <h3>hoy</h3>
        <table id="table_otPadreListHoy" class="table table-hover table-bordered table-striped dataTable_camilo" style="width: 100%;">
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
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div id="vencidas" class="tab-pane fade">
        <h3>Vencidas</h3>
        <table id="table_otPadreListVencidas" class="table table-hover table-bordered table-striped dataTable_camilo" style="width: 100%;">
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
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div id="por_lista" class="tab-pane fade">

        <div align="center">
            <select class='btn-cami_cool' name='opc_lista' id="select_filter">
                <option value='EN PROCESOS CIERRE KO'>EN PROCESOS CIERRE KO</option>
                <option value='ALIADO - PENDIENTE SOLICITAR ENTREGA DEL SERVICIO'>ALIADO - PENDIENTE SOLICITAR ENTREGA DEL SERVICIO</option>
                <option value='ALIADO - SIN INFORMACIÓN ENTREGADA A TERCEROS PARA INICIAR PROCESO'>ALIADO - SIN INFORMACIÓN ENTREGADA A TERCEROS PARA INICIAR PROCESO</option>
                <option value='ASIGNADO LIDER TECNICO'>ASIGNADO LIDER TECNICO</option>
                <option value='CLIENTE - CAMBIO DE ALCANCE (CAMBIO DE TIPO DE SERVICIO)'>CLIENTE - CAMBIO DE ALCANCE (CAMBIO DE TIPO DE SERVICIO)</option>
                <option value='CLIENTE - CAMBIO DE UBICACIÓN DE ULTIMA MILLA'>CLIENTE - CAMBIO DE UBICACIÓN DE ULTIMA MILLA</option>
                <option value='CLIENTE - NO APRUEBA COSTOS DE OBRA CIVIL'>CLIENTE - NO APRUEBA COSTOS DE OBRA CIVIL</option>
                <option value='CLIENTE - NO PERMITE CIERRE DE KO'>CLIENTE - NO PERMITE CIERRE DE KO</option>
                <option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO</option>
                <option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO - REQUIERE VENTANA'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO - REQUIERE VENTANA</option>
                <option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL SURVEY O VISITA O CON TERCERO'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL SURVEY O VISITA O CON TERCERO</option>
                <option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL VOC'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL VOC</option>
                <option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA  DE ULTIMA MILLA CON TERCERO '>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA  DE ULTIMA MILLA CON TERCERO </option>
                <option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EMPALMES'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EMPALMES</option>
                <option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EOC'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EOC</option>
                <option value='CLIENTE - NO TIENE DEFINIDA LA DIRECCIÓN DONDE VA A QUEDAR UBICADO EL SERVICIO'>CLIENTE - NO TIENE DEFINIDA LA DIRECCIÓN DONDE VA A QUEDAR UBICADO EL SERVICIO</option>
                <option value='CLIENTE - PROGRAMADA_POSTERIOR '>CLIENTE - PROGRAMADA_POSTERIOR </option>
                <option value='CLIENTE - SIN CONTRATO FIRMADO'>CLIENTE - SIN CONTRATO FIRMADO</option> 
                <option value='CLIENTE - SIN DISPONIBILIDAD DE INFRAESTRUCTURA (PLANTA TELEFONICA - LAN DIRECCIONAMIENTO )'>CLIENTE - SIN DISPONIBILIDAD DE INFRAESTRUCTURA (PLANTA TELEFONICA - LAN DIRECCIONAMIENTO )</option>
                <option value='CLIENTE - SIN FECHA ADECUACIONES EN LA SEDE (ELECTRICAS Y/O FISICA)'>CLIENTE - SIN FECHA ADECUACIONES EN LA SEDE (ELECTRICAS Y/O FISICA)</option>
                <option value='CLIENTE - SIN FECHA PARA RECIBIR EL SERVICIO'>CLIENTE - SIN FECHA PARA RECIBIR EL SERVICIO</option>
                <option value='COEX - EN PROCESO DE CONFIGURACIÓN BACKEND'>COEX - EN PROCESO DE CONFIGURACIÓN BACKEND</option>
                <option value='COEX -ATRASO CONFIGURACIÓN BACKEND'>COEX -ATRASO CONFIGURACIÓN BACKEND</option>
                <option value='COMERCIAL - ESCALADO ORDEN DE REEMPLAZO'>COMERCIAL - ESCALADO ORDEN DE REEMPLAZO</option>
                <option value='COMERCIAL - ESCALADO PENDIENTE INGRESO OTS'>COMERCIAL - ESCALADO PENDIENTE INGRESO OTS</option>
                <option value='CONTROL DE CAMBIOS - RFC NO ESTANDAR EN APROBACIÓN'>CONTROL DE CAMBIOS - RFC NO ESTANDAR EN APROBACIÓN</option>
                <option value='CSM - Retiro equipos - Renovación de Contrato'>CSM - Retiro equipos - Renovación de Contrato</option>
                <option value='DATACENTER  CLARO- CABLEADO SIN EJECUTAR'>DATACENTER  CLARO- CABLEADO SIN EJECUTAR</option>
                <option value='DATACENTER  CLARO- SIN CONSUMIBLES EN DATACENTER'>DATACENTER  CLARO- SIN CONSUMIBLES EN DATACENTER</option>
                <option value='DATACENTER CLARO- CABLEADO EN CURSO'>DATACENTER CLARO- CABLEADO EN CURSO</option>
                <option value='ENTREGA - SERVICIO_ENTREGADO_PROCESO DE CIERRE'>ENTREGA - SERVICIO_ENTREGADO_PROCESO DE CIERRE</option>
                <option value='ENTREGA - SIN DISPONIBILIDAD AGENDA EN VERIFICACIÓN DE RECURSOS'>ENTREGA - SIN DISPONIBILIDAD AGENDA EN VERIFICACIÓN DE RECURSOS</option>
                <option value='ENTREGA Y/O SOPORTE PROGRAMADO'>ENTREGA Y/O SOPORTE PROGRAMADO</option>
                <option value='EQUIPOS - DEFECTUOSOS'>EQUIPOS - DEFECTUOSOS</option>
                <option value='EQUIPOS - EN COMPRAS'>EQUIPOS - EN COMPRAS</option>
                <option value='ESCALADO_LIDER_IMPLEMENTACIÓN_PASO A PENDIENTE CLIENTE'>ESCALADO_LIDER_IMPLEMENTACIÓN_PASO A PENDIENTE CLIENTE</option>
                <option value='ESTADO CANCELADO'>ESTADO CANCELADO</option>
                <option value='ESTADO PENDIENTE CLIENTE'>ESTADO PENDIENTE CLIENTE</option>
                <option value='GPC - CAMBIO DE ALCANCE ORDEN DE PEDIDO'>GPC - CAMBIO DE ALCANCE ORDEN DE PEDIDO</option>
                <option value='GPC - EN PROCESO DE CANCELACIÓN'>GPC - EN PROCESO DE CANCELACIÓN</option>
                <option value='GPC - PENDIENTE ACEPTACIÓN CRONOGRAMA POR PARTE DEL CLIENTE'>GPC - PENDIENTE ACEPTACIÓN CRONOGRAMA POR PARTE DEL CLIENTE</option>
                <option value='GPC - PENDIENTE INFORMACIÓN DEL CLIENTE PARA CONFIGURAR'>GPC - PENDIENTE INFORMACIÓN DEL CLIENTE PARA CONFIGURAR</option>
                <option value='GPC - SIN ALCANCE PARA FABRICA'>GPC - SIN ALCANCE PARA FABRICA</option>
                <option value='IMPLEMENTACIÓN - SOLUCIÓN NO ESTANDAR'>IMPLEMENTACIÓN - SOLUCIÓN NO ESTANDAR</option>
                <option value='INCONVENIENTE TECNICO'>INCONVENIENTE TECNICO</option>
                <option value='LIDER TECNICO - CAMBIO DE ALCANCE PLAN TECNICO'>LIDER TECNICO - CAMBIO DE ALCANCE PLAN TECNICO</option>
                <option value='LIDER TECNICO - PENDIENTE PLAN TECNICO'>LIDER TECNICO - PENDIENTE PLAN TECNICO</option>
                <option value='LIDER TECNICO - SOLUCIÓN NO ESTANDAR'>LIDER TECNICO - SOLUCIÓN NO ESTANDAR</option>
                <option value='LIDER TECNICO - SOLUCIÓN NO ESTANDAR SIN DEFINICIÓN'>LIDER TECNICO - SOLUCIÓN NO ESTANDAR SIN DEFINICIÓN</option>
                <option value='PASO A PENDIENTE CLIENTE'>PASO A PENDIENTE CLIENTE</option>
                <option value='PENDIENTE SOLICITAR ENTREGA DEL SERVICIO'>PENDIENTE SOLICITAR ENTREGA DEL SERVICIO</option>
                <option value='PLANTA EXTERNA - EN CURSO SIN INCONVENIENTE REPORTADO'>PLANTA EXTERNA - EN CURSO SIN INCONVENIENTE REPORTADO</option>
                <option value='PLANTA EXTERNA - ERROR EN LA EJECUCIÓN DE EOC'>PLANTA EXTERNA - ERROR EN LA EJECUCIÓN DE EOC</option>
                <option value='PLANTA EXTERNA - ESCALADO_IFO_RESULTADO DE ACTIVIDAD'>PLANTA EXTERNA - ESCALADO_IFO_RESULTADO DE ACTIVIDAD</option>
                <option value='PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE DESBORDE'>PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE DESBORDE</option>
                <option value='PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE PERSONAL'>PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE PERSONAL</option>
                <option value='PLANTA EXTERNA - ETAPA INTERMEDIA - SIN CONFIRMACIÓN DE PERSONAL PARA EOC Y EMPALMES'>PLANTA EXTERNA - ETAPA INTERMEDIA - SIN CONFIRMACIÓN DE PERSONAL PARA EOC Y EMPALMES</option>
                <option value='PLANTA EXTERNA - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO'>PLANTA EXTERNA - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO</option>
                <option value='PLANTA EXTERNA - NO VIABLE EN FACTIBILIDAD POR TERCEROS'>PLANTA EXTERNA - NO VIABLE EN FACTIBILIDAD POR TERCEROS</option>
                <option value='PLANTA EXTERNA - NO VIABLE EN FO - EN INSTALACIÓN POR HFC'>PLANTA EXTERNA - NO VIABLE EN FO - EN INSTALACIÓN POR HFC</option>
                <option value='PLANTA EXTERNA - PERMISOS MUNICIPALES - PERMISOS DE ARRENDADOR DE INFRAESTRUCTURA'>PLANTA EXTERNA - PERMISOS MUNICIPALES - PERMISOS DE ARRENDADOR DE INFRAESTRUCTURA</option>
                <option value='PLANTA EXTERNA - SIN APROBACIÓN DE TENDIDO EXTERNO POR COSTOS'>PLANTA EXTERNA - SIN APROBACIÓN DE TENDIDO EXTERNO POR COSTOS</option>
                <option value='PREVENTA - NO ES CLARA LA SOLUCIÓN A IMPLEMENTAR'>PREVENTA - NO ES CLARA LA SOLUCIÓN A IMPLEMENTAR</option>
                <option value='PREVENTA - SIN ID  FACTIBILIDAD PARA TERCEROS'>PREVENTA - SIN ID  FACTIBILIDAD PARA TERCEROS</option>
                <option value='PROYECTO ÉXITO ANTIGUO'>PROYECTO ÉXITO ANTIGUO</option> 
                <option value='TERCEROS - EN CURSO SIN INCONVENIENTE REPORTADO'>TERCEROS - EN CURSO SIN INCONVENIENTE REPORTADO</option>
                <option value='TERCEROS - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO'>TERCEROS - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO</option>
                <option value='TERCEROS - NO VIABLE - EN PROCESO NOTIFICACIÓN A CLIENTE Y COMERCIAL PARA CANCELACIÓN'>TERCEROS - NO VIABLE - EN PROCESO NOTIFICACIÓN A CLIENTE Y COMERCIAL PARA CANCELACIÓN</option>
                <option value='TERCEROS - SIN AVANCE SOBRE LA FECHA DE ENTREGA DE ULTIMA MILLA'>TERCEROS - SIN AVANCE SOBRE LA FECHA DE ENTREGA DE ULTIMA MILLA</option>
            </select>
        </div>
        <table id="table_list_opc" class="table table-hover table-bordered table-striped dataTable_camilo" style="width: 100%;">
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
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div id="lista_email" class="tab-pane fade">
        <h3>Por cantidad de emails enviados</h3>
        <table id="table_otPadreListEmails" class="table table-hover table-bordered table-striped dataTable_camilo" style="width: 100%;">
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
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!------------------------------------------ MODAL QUE MUESTRA TODAS LAS OTS HIJA DE LAS OTS PADRES -------------------------->
<div id="modalOthDeOtp" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" style="overflow: auto">
    <div class="modal-dialog modal-lg" width='100%'>
        <div class="modal-content">
            <div class="modal-header csstypesubtitle">
                <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close"><img src="http://localhost/Telmex-VIP//assets/images/cerrar (7).png"></button>
                <h3 class="modal-title" id="myModalLabel"> Orden Ot Hija N <label id="id_ot_modal"></label></h3>
            </div>
            <div class="modal-body">                
                <form class="well form-horizontal" id="formModalOTHS" method="post" novalidate="novalidate">

                    <table class="table table-hover table-bordered  dataTable_camilo table-striped  " id="table_oths_otp"  cellspacing="2"></table>
                </form>                
            </div>


            <div class="modal-footer cssnewtypem">
                <button type="button" class="btn btn-default cerrar" id="mbtnCerrarModal" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal tabla log -->
<div class="modal fade" id="ModalHistorialLog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header csstypesubtitle">
                <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove-sign"></span></button>
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
                                <th>opc</th>
                                </thead>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal-footer cssnewtypem">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar  <i class="glyphicon glyphicon-chevron-up"></i></button>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------ MODAL QUE MUESTRA LOS HITOS DE UNA OT PADRES -------------------------->
<div id="modalHitosOtp" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" style="overflow: auto">
    <div class="modal-dialog modal-lg" width='100%'>
        <div class="modal-content">
            <div class="modal-header csstypesubtitle">
                <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close"><img src="http://localhost/Telmex-VIP//assets/images/cerrar (7).png"></button>
                <h3 class="modal-title" id="myModalLabelHitos"> Orden Ot Hija N <label id="id_ot_modal"></label></h3>
            </div>
            <div class="modal-body">                
                <form class="well form-horizontal" id="formModalHitosOTP" method="post" novalidate="novalidate">
                    <div class="form-group col-md-6">
                        <label for="email">Actividad Actual:</label>
                        <select name="actividad_actual" id="actividad_actual" class="form-control">
                            <option value="">SELECCIONE...</option>
                            <option value="KICK OFF">KICK OFF</option>
                            <option value="VISITA OBRA CIVIL">VISITA OBRA CIVIL</option>
                            <option value="VISITA OBRA CIVIL TERCEROS">VISITA OBRA CIVIL TERCEROS</option>
                            <option value="ENVIO COTIZACION">ENVIO COTIZACION</option>
                            <option value="APROBACION COTIZACION">APROBACION COTIZACION</option>
                            <option value="SOLICITUD INFORMACIÓN TECNICA">SOLICITUD INFORMACIÓN TECNICA</option>
                            <option value="VISITA EJECUCION OBRA CIVIL">VISITA EJECUCION OBRA CIVIL</option>
                            <option value="VISITA EJECUCION OBRA CIVIL TERCERO">VISITA EJECUCION OBRA CIVIL TERCERO</option>
                            <option value="CONFIGURACION RED CLARO">CONFIGURACION RED CLARO</option>
                            <option value="VISITA ENTREGA UM TERCEROS">VISITA ENTREGA UM TERCEROS</option>
                        </select>
                    </div>
                    <table class="table table-hover table-bordered  dataTable_camilo table-striped  ">
                        <tr>
                            <td><label id="servivio_hito"></label></td>
                            <td><label id="cliente_hito"></label></td>
                            <td><label id="ciudad_hito"></label></td>
                        </tr>
                    </table>
                    <table class="table table-hover table-bordered  dataTable_camilo table-striped  " id="table_hitos_otp"  cellspacing="2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ACTIVIDAD</th>
                                <th>FECHA COMPROMISO </th>
                                <th>ESTADO</th>
                                <th>OBSERVACIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <ul class="timeline timeline-jhon">
                                        <li class="timeline-item">

                                            <div class="timeline-badge" id="act_ko">1</div>

                                        </li>
                                    </ul>
                                </td>
                                <td>KICK OFF</td>
                                <td>
                                    <input type="date" name="f_compromiso" id="f_compromiso_ko" class="form-control">
                                </td>
                                <td>
                                    <select name="estado" id="estado_ko" class="form-control">
                                        <option value="" >SELECCIONE...</option>
                                        <option value="EJECUTADA" >EJECUTADA</option>
                                        <option value="ENVIADA" >ENVIADA</option>
                                        <option value="APROBADA" >APROBADA</option>
                                        <option value="CONFIGURADO" >CONFIGURADO</option>
                                        <option value="PENDIENTE" >PENDIENTE</option>
                                        <option value="CERRADA" >CERRADA</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="observaciones" id="observaciones_ko" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">
                                    <ul class="timeline timeline-jhon">
                                        <li class="timeline-item">

                                            <div class="timeline-badge" id="act_voc">2</div>

                                        </li>
                                    </ul>
                                </td>
                                <td>VISITA OBRA CIVIL</td>
                                <td>
                                    <input type="date" name="f_compromiso" id="f_compromiso_voc" class="form-control">
                                </td>
                                <td>
                                    <select name="estado" id="estado_voc" class="form-control">
                                        <option value="" >SELECCIONE...</option>
                                        <option value="EJECUTADA" >EJECUTADA</option>
                                        <option value="ENVIADA" >ENVIADA</option>
                                        <option value="APROBADA" >APROBADA</option>
                                        <option value="CONFIGURADO" >CONFIGURADO</option>
                                        <option value="PENDIENTE" >PENDIENTE</option>
                                        <option value="CERRADA" >CERRADA</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="observaciones" id="observaciones_voc" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>VISITA OBRA CIVIL TERCEROS</td>
                                <td>
                                    <input type="date" name="f_compromiso" id="f_compromiso_voct" class="form-control">
                                </td>
                                <td>
                                    <select name="estado" id="estado_voct" class="form-control">
                                        <option value="" >SELECCIONE...</option>
                                        <option value="EJECUTADA" >EJECUTADA</option>
                                        <option value="ENVIADA" >ENVIADA</option>
                                        <option value="APROBADA" >APROBADA</option>
                                        <option value="CONFIGURADO" >CONFIGURADO</option>
                                        <option value="PENDIENTE" >PENDIENTE</option>
                                        <option value="CERRADA" >CERRADA</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="observaciones" id="observaciones_voct" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="timeline timeline-jhon">
                                        <li class="timeline-item">

                                            <div class="timeline-badge" id="act_ec">3</div>

                                        </li>
                                    </ul>
                                </td>
                                <td>ENVIO COTIZACION</td>
                                <td>
                                    <input type="date" name="f_compromiso" id="f_compromiso_ec" class="form-control">
                                </td>
                                <td>
                                    <select name="estado" id="estado_ec" class="form-control">
                                        <option value="" >SELECCIONE...</option>
                                        <option value="EJECUTADA" >EJECUTADA</option>
                                        <option value="ENVIADA" >ENVIADA</option>
                                        <option value="APROBADA" >APROBADA</option>
                                        <option value="CONFIGURADO" >CONFIGURADO</option>
                                        <option value="PENDIENTE" >PENDIENTE</option>
                                        <option value="CERRADA" >CERRADA</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="observaciones" id="observaciones_ec" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="timeline timeline-jhon">
                                        <li class="timeline-item">

                                            <div class="timeline-badge" id="act_ac">4</div>

                                        </li>
                                    </ul>
                                </td>
                                <td>APROBACION COTIZACION</td>
                                <td>
                                    <input type="date" name="f_compromiso" id="f_compromiso_ac" class="form-control">
                                </td>
                                <td>
                                    <select name="estado" id="estado_ac" class="form-control">
                                        <option value="" >SELECCIONE...</option>
                                        <option value="EJECUTADA" >EJECUTADA</option>
                                        <option value="ENVIADA" >ENVIADA</option>
                                        <option value="APROBADA" >APROBADA</option>
                                        <option value="CONFIGURADO" >CONFIGURADO</option>
                                        <option value="PENDIENTE" >PENDIENTE</option>
                                        <option value="CERRADA" >CERRADA</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="observaciones" id="observaciones_ac" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="timeline timeline-jhon">
                                        <li class="timeline-item">

                                            <div class="timeline-badge" id="act_sit">5</div>

                                        </li>
                                    </ul>
                                </td>
                                <td>SOLICITUD INFORMACIÓN TECNICA</td>
                                <td>
                                    <input type="date" name="f_compromiso" id="f_compromiso_sit" class="form-control">
                                </td>
                                <td>
                                    <select name="estado" id="estado_sit" class="form-control">
                                        <option value="" >SELECCIONE...</option>
                                        <option value="EJECUTADA" >EJECUTADA</option>
                                        <option value="ENVIADA" >ENVIADA</option>
                                        <option value="APROBADA" >APROBADA</option>
                                        <option value="CONFIGURADO" >CONFIGURADO</option>
                                        <option value="PENDIENTE" >PENDIENTE</option>
                                        <option value="CERRADA" >CERRADA</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="observaciones" id="observaciones_sit" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">
                                    <ul class="timeline timeline-jhon">
                                        <li class="timeline-item">

                                            <div class="timeline-badge" id="act_veoc">6</div>

                                        </li>
                                    </ul>
                                </td>
                                <td>VISITA EJECUCION OBRA CIVIL</td>
                                <td>
                                    <input type="date" name="f_compromiso" id="f_compromiso_veoc" class="form-control">
                                </td>
                                <td>
                                    <select name="estado" id="estado_veoc" class="form-control">
                                        <option value="" >SELECCIONE...</option>
                                        <option value="EJECUTADA" >EJECUTADA</option>
                                        <option value="ENVIADA" >ENVIADA</option>
                                        <option value="APROBADA" >APROBADA</option>
                                        <option value="CONFIGURADO" >CONFIGURADO</option>
                                        <option value="PENDIENTE" >PENDIENTE</option>
                                        <option value="CERRADA" >CERRADA</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="observaciones" id="observaciones_veoc" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>VISITA EJECUCION OBRA CIVIL TERCERO</td>
                                <td>
                                    <input type="date" name="f_compromiso" id="f_compromiso_veoct" class="form-control">
                                </td>
                                <td>
                                    <select name="estado" id="estado_veoct" class="form-control">
                                        <option value="" >SELECCIONE...</option>
                                        <option value="EJECUTADA" >EJECUTADA</option>
                                        <option value="ENVIADA" >ENVIADA</option>
                                        <option value="APROBADA" >APROBADA</option>
                                        <option value="CONFIGURADO" >CONFIGURADO</option>
                                        <option value="PENDIENTE" >PENDIENTE</option>
                                        <option value="CERRADA" >CERRADA</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="observaciones" id="observaciones_veoct" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="timeline timeline-jhon">
                                        <li class="timeline-item">

                                            <div class="timeline-badge" id="act_crc">7</div>

                                        </li>
                                    </ul>
                                </td>
                                <td>CONFIGURACION RED CLARO</td>
                                <td>
                                    <input type="date" name="f_compromiso" id="f_compromiso_crc" class="form-control">
                                </td>
                                <td>
                                    <select name="estado" id="estado_crc" class="form-control">
                                        <option value="" >SELECCIONE...</option>
                                        <option value="EJECUTADA" >EJECUTADA</option>
                                        <option value="ENVIADA" >ENVIADA</option>
                                        <option value="APROBADA" >APROBADA</option>
                                        <option value="CONFIGURADO" >CONFIGURADO</option>
                                        <option value="PENDIENTE" >PENDIENTE</option>
                                        <option value="CERRADA" >CERRADA</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="observaciones" id="observaciones_crc" rows="2"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="timeline timeline-jhon">
                                        <li class="timeline-item">

                                            <div class="timeline-badge" id="act_veut">8</div>

                                        </li>
                                    </ul>
                                </td>
                                <td>VISITA ENTREGA UM TERCEROS</td>
                                <td>
                                    <input type="date" name="f_compromiso" id="f_compromiso_veut" class="form-control">
                                </td>
                                <td>
                                    <select name="estado" id="estado_veut" class="form-control">
                                        <option value="" >SELECCIONE...</option>
                                        <option value="EJECUTADA" >EJECUTADA</option>
                                        <option value="ENVIADA" >ENVIADA</option>
                                        <option value="APROBADA" >APROBADA</option>
                                        <option value="CONFIGURADO" >CONFIGURADO</option>
                                        <option value="PENDIENTE" >PENDIENTE</option>
                                        <option value="CERRADA" >CERRADA</option>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="observaciones" id="observaciones_veut" rows="2"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer cssnewtypem">
                <button type="button" class="btn btn-default cerrar" id="mbtnCerrarModal" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
                <button type="button" class="btn btn-success" id="btnGuardarModalHitos"><i class='glyphicon glyphicon-save'></i>&nbsp;Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-------------------------------------- MODAL QUE MUESTRA TODAS LAS OTS HIJA DE LAS OTS PADRES -------------------------->

<!------------------------------------------ Modal editar OTs hijas ------------------------------------------>
<div id="modalEditTicket" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" >
    <div class="modal-dialog modal-lg2" style="width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h3 class="modal-title" id="myModalLabelEditOth">    Orden Ot Hija N <label id="id_ot_modal_edit_oth"></label></h3>
            </div>
            <div class="modal-body">
                <button class="btn m-b-10" id="btn_mostrar_detalle"> ver detalle &nbsp;<img src="<?= URL::to('assets/images/plus.png'); ?>" data-simbol="plus" class="rigth"></span></button>

                <div>
                    <form class="well form-horizontal f-s-12" id="formModal" action="Templates/c_updateStatusOt" method="post" novalidate="novalidate">
                        <input name="id_orden_trabajo_hija" id="id_orden_trabajo_hija" type="hidden">
                        <input name="estado_orden_trabajo_hija" id="estado_orden_trabajo_hija" type="hidden">
                        <input name="k_id_estado_ot_value" id="k_id_estado_ot_value" type="hidden">
                        <input name="c_email" id="c_email" type="hidden">
                        <input name="num_servicio" id="num_servicio">

                        <fieldset>
                            <div class="toggle_info_detail" style="display: none">
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


                            </div>
                            <div>
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
                                    </fieldset>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Tabs vertical -->
                        <div class="widget bg_white m-t-25 display-block" id="tabs_form" style="display: none">
                            <section class="content container-fluid p-t-0">
                                <div class="container autoheight">
                                    <div class="row">
                                        <div class="col-xs-11 bhoechie-tab-container">
                                            <div class="col-xs-2 bhoechie-tab-menu">
                                                <div class="list-group">
                                                    <a href="#" class="list-group-item active text-center">
                                                        <h2 class="glyphicon glyphicon-list"></h2><br/>Producto
                                                    </a>
                                                    <a href="#" class="list-group-item text-center">
                                                        <h2 class="glyphicon glyphicon-folder-open"></h2><br/>Servicio
                                                    </a>
                                                    <a href="#" class="list-group-item text-center" id="contentAll">
                                                        <h2 class="glyphicon glyphicon-eye-open"></h2><br/>Ver Todo
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-xs-9 bhoechie-tab" >

                                                <!-- tab1  -->
                                                <div class="bhoechie-tab-content active" id="contentTab1">
                                                    <h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario de producto</h2>
                                                    <!-- llenar con formulario de producto -->
                                                    <div id="general_producto"></div>

                                                    
                                                </div>



                                                <!--tab 2 -->
                                                <div class="bhoechie-tab-content" id="contentTab2">
                                                    <h2 class="h4"><i class="fa fa-dot-circle-o"></i> Formulario de servicio</h2>
                                                    <!-- llenar esta seccion con el form de servicio -->
                                                    <div id="general_servicio"></div>
                                                    






                                                </div>

                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

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
<!------------------------------------------ Fin Modal editar OTs -------------------------------------->

<!------------------------------------------ modal ordenes seleccionadas ------------------------------->
<div id="mdl_cierre" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                <h3 class="modal-title" id="mdl-title-cierre"></h3>
            </div>
            <div class="modal-body">
                <table id="table_selected" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%"></table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="mdl-cierre-cerrar" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;Cancelar</button>
                <button type="button" class="btn btn-success" id="mdl-cierre-facturacion"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>&nbsp;Enviar correo</button>
            </div>
        </div>
    </div>
</div>




                    


<script src="<?= URL::to("assets/plugins/sweetalert2/sweetalert2.all.js") ?> "></script>
<!--<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>-->
<?php if (isset($_GET['msj'])): ?>
    <script>
        var urlbase = "<?php echo URL::base(); ?>";
        swal('OK', 'se actualizó correctamente', 'success');
    </script>
<?php endif ?>
