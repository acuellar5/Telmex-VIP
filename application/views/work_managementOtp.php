<!--*********************  MODULO PESTAÑAS  *********************-->
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#total">Total</a></li>
    <li class=""><a data-toggle="tab" href="#hoy">Hoy</a></li>
    <li class=""><a data-toggle="tab" href="#vencidas">Vencida</a></li>
    <li class=""><a data-toggle="tab" href="#por_lista">Por Lista</a></li>
</ul>

<!--*********************  CONTENIDO PESTAÑAS  *********************-->
<div class="tab-content" id="contenido_tablas">

    <div id="total" class="tab-pane fade in active">
        <h3>OT Padre</h3>
        <table id="table_otPadreList" class="table table-hover table-bordered table-striped dataTable_camilo">
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
        <table id="table_otPadreListHoy" class="table table-hover table-bordered table-striped dataTable_camilo">
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
        <table id="table_otPadreListVencidas" class="table table-hover table-bordered table-striped dataTable_camilo">
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
        <table id="table_list_opc" class="table table-hover table-bordered table-striped dataTable_camilo">
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
<div id="modalOthDeOtp" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" >
    <div class="modal-dialog modal-lg2" style="width: 1100px;">
        <div class="modal-content">
            <div class="modal-header csstypesubtitle">
                <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close"><img src="http://localhost/Telmex-VIP//assets/images/cerrar (7).png"></button>
                <h3 class="modal-title" id="myModalLabel"> Orden Ot Hija N <label id="id_ot_modal"></label></h3>
            </div>
            <div class="modal-body">
                <div>
                    <form class="well form-horizontal" id="formModalOTHS" method="post" novalidate="novalidate">
                        <fieldset>
                            <table class="table table-hover table-bordered table-striped dataTable_camilo csstable" id="table_oths_otp"  cellspacing="2"></table>
                        </fieldset>

                    </form>
                </div>
            </div>


            <div class="modal-footer cssnewtypem">
                <button type="button" class="btn btn-default cerrar" id="mbtnCerrarModal" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-------------------------------------- MODAL QUE MUESTRA TODAS LAS OTS HIJA DE LAS OTS PADRES -------------------------->
<script src="<?= URL::to("assets/plugins/sweetalert2/sweetalert2.all.js") ?> "></script>
<!--<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>-->