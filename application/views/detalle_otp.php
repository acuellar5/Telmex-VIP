<h3 align="center">Tabla de Detalles OTP ING: <?= $registros['otp'][0]->nombre ?></h3>

<table id="detalles_otp" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
	<thead>
		<th>OTP</th>
		<th>Nombre cliente</th>
		<th>Tipo OTP</th>
		<th>Servicio</th>
		<th>Estado OTP</th>
		<th>Programado</th>
		<th>Compromiso</th>
		<th>Creacion</th>
		<th>Ciudad</th>
		<th>Recurrente</th>
		<th>Lista</th>
		<th>Observacion</th>
	</thead>
<?php 
//$registros
for ($i=0; $i < count($registros['otp']); $i++) { 
	echo "<tr>";
		echo "<td>".$registros['otp'][$i]->k_id_ot_padre."</td>";
		echo "<td>".$registros['otp'][$i]->n_nombre_cliente."</td>";
		echo "<td>".$registros['otp'][$i]->orden_trabajo."</td>";
		echo "<td>".$registros['otp'][$i]->servicio."</td>";
		echo "<td>".$registros['otp'][$i]->estado_orden_trabajo."</td>";
		echo "<td>".$registros['otp'][$i]->fecha_programacion."</td>";
		echo "<td>".$registros['otp'][$i]->fecha_compromiso."</td>";
		echo "<td>".$registros['otp'][$i]->fecha_creacion."</td>";
		echo "<td>".$registros['otp'][$i]->ciudad."</td>";
		echo "<td>".$registros['otp'][$i]->recurrente."</td>";
		echo "<td><select class='form-control'>";					
                    echo "<option value='EN PROCESOS CIERRE KO'>EN PROCESOS CIERRE KO</option>"; 
                    echo "<option value='ALIADO - PENDIENTE SOLICITAR ENTREGA DEL SERVICIO'>ALIADO - PENDIENTE SOLICITAR ENTREGA DEL SERVICIO</option>"; 
                    echo "<option value='ALIADO - SIN INFORMACIÓN ENTREGADA A TERCEROS PARA INICIAR PROCESO'>ALIADO - SIN INFORMACIÓN ENTREGADA A TERCEROS PARA INICIAR PROCESO</option>"; 
                    echo "<option value='ASIGNADO LIDER TECNICO'>ASIGNADO LIDER TECNICO</option>"; 
                    echo "<option value='CLIENTE - CAMBIO DE ALCANCE (CAMBIO DE TIPO DE SERVICIO)'>CLIENTE - CAMBIO DE ALCANCE (CAMBIO DE TIPO DE SERVICIO)</option>"; 
                    echo "<option value='CLIENTE - CAMBIO DE UBICACIÓN DE ULTIMA MILLA'>CLIENTE - CAMBIO DE UBICACIÓN DE ULTIMA MILLA</option>"; 
                    echo "<option value='CLIENTE - NO APRUEBA COSTOS DE OBRA CIVIL'>CLIENTE - NO APRUEBA COSTOS DE OBRA CIVIL</option>"; 
                    echo "<option value='CLIENTE - NO PERMITE CIERRE DE KO'>CLIENTE - NO PERMITE CIERRE DE KO</option>"; 
                    echo "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO</option>"; 
                    echo "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO - REQUIERE VENTANA'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO - REQUIERE VENTANA</option>"; 
                    echo "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL SURVEY O VISITA O CON TERCERO'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL SURVEY O VISITA O CON TERCERO</option>"; 
                    echo "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL VOC'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL VOC</option>"; 
                    echo "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA  DE ULTIMA MILLA CON TERCERO '>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA  DE ULTIMA MILLA CON TERCERO </option>"; 
                    echo "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EMPALMES'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EMPALMES</option>"; 
                    echo "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EOC'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EOC</option>"; 
                    echo "<option value='CLIENTE - NO TIENE DEFINIDA LA DIRECCIÓN DONDE VA A QUEDAR UBICADO EL SERVICIO'>CLIENTE - NO TIENE DEFINIDA LA DIRECCIÓN DONDE VA A QUEDAR UBICADO EL SERVICIO</option>"; 
                    echo "<option value='CLIENTE - PROGRAMADA_POSTERIOR '>CLIENTE - PROGRAMADA_POSTERIOR </option>"; 
                    echo "<option value='CLIENTE - SIN CONTRATO FIRMADO'>CLIENTE - SIN CONTRATO FIRMADO</option>"; 
                    echo "<option value='CLIENTE - SIN DISPONIBILIDAD DE INFRAESTRUCTURA (PLANTA TELEFONICA - LAN DIRECCIONAMIENTO )'>CLIENTE - SIN DISPONIBILIDAD DE INFRAESTRUCTURA (PLANTA TELEFONICA - LAN DIRECCIONAMIENTO )</option>"; 
                    echo "<option value='CLIENTE - SIN FECHA ADECUACIONES EN LA SEDE (ELECTRICAS Y/O FISICA)'>CLIENTE - SIN FECHA ADECUACIONES EN LA SEDE (ELECTRICAS Y/O FISICA)</option>"; 
                    echo "<option value='CLIENTE - SIN FECHA PARA RECIBIR EL SERVICIO'>CLIENTE - SIN FECHA PARA RECIBIR EL SERVICIO</option>"; 
                    echo "<option value='COEX - EN PROCESO DE CONFIGURACIÓN BACKEND'>COEX - EN PROCESO DE CONFIGURACIÓN BACKEND</option>"; 
                    echo "<option value='COEX -ATRASO CONFIGURACIÓN BACKEND'>COEX -ATRASO CONFIGURACIÓN BACKEND</option>"; 
                    echo "<option value='COMERCIAL - ESCALADO ORDEN DE REEMPLAZO'>COMERCIAL - ESCALADO ORDEN DE REEMPLAZO</option>"; 
                    echo "<option value='COMERCIAL - ESCALADO PENDIENTE INGRESO OTS'>COMERCIAL - ESCALADO PENDIENTE INGRESO OTS</option>"; 
                    echo "<option value='CONTROL DE CAMBIOS - RFC NO ESTANDAR EN APROBACIÓN'>CONTROL DE CAMBIOS - RFC NO ESTANDAR EN APROBACIÓN</option>"; 
                    echo "<option value='CSM - Retiro equipos - Renovación de Contrato'>CSM - Retiro equipos - Renovación de Contrato</option>"; 
                    echo "<option value='DATACENTER  CLARO- CABLEADO SIN EJECUTAR'>DATACENTER  CLARO- CABLEADO SIN EJECUTAR</option>"; 
                    echo "<option value='DATACENTER  CLARO- SIN CONSUMIBLES EN DATACENTER'>DATACENTER  CLARO- SIN CONSUMIBLES EN DATACENTER</option>"; 
                    echo "<option value='DATACENTER CLARO- CABLEADO EN CURSO'>DATACENTER CLARO- CABLEADO EN CURSO</option>"; 
                    echo "<option value='ENTREGA - SERVICIO_ENTREGADO_PROCESO DE CIERRE'>ENTREGA - SERVICIO_ENTREGADO_PROCESO DE CIERRE</option>"; 
                    echo "<option value='ENTREGA - SIN DISPONIBILIDAD AGENDA EN VERIFICACIÓN DE RECURSOS'>ENTREGA - SIN DISPONIBILIDAD AGENDA EN VERIFICACIÓN DE RECURSOS</option>"; 
                    echo "<option value='ENTREGA Y/O SOPORTE PROGRAMADO'>ENTREGA Y/O SOPORTE PROGRAMADO</option>"; 
                    echo "<option value='EQUIPOS - DEFECTUOSOS'>EQUIPOS - DEFECTUOSOS</option>"; 
                    echo "<option value='EQUIPOS - EN COMPRAS'>EQUIPOS - EN COMPRAS</option>"; 
                    echo "<option value='ESCALADO_LIDER_IMPLEMENTACIÓN_PASO A PENDIENTE CLIENTE'>ESCALADO_LIDER_IMPLEMENTACIÓN_PASO A PENDIENTE CLIENTE</option>"; 
                    echo "<option value='ESTADO CANCELADO'>ESTADO CANCELADO</option>"; 
                    echo "<option value='ESTADO CANCELADO'>ESTADO CANCELADO</option>"; 
                    echo "<option value='ESTADO PENDIENTE CLIENTE'>ESTADO PENDIENTE CLIENTE</option>"; 
                    echo "<option value='GPC - CAMBIO DE ALCANCE ORDEN DE PEDIDO'>GPC - CAMBIO DE ALCANCE ORDEN DE PEDIDO</option>"; 
                    echo "<option value='GPC - EN PROCESO DE CANCELACIÓN'>GPC - EN PROCESO DE CANCELACIÓN</option>"; 
                    echo "<option value='GPC - PENDIENTE ACEPTACIÓN CRONOGRAMA POR PARTE DEL CLIENTE'>GPC - PENDIENTE ACEPTACIÓN CRONOGRAMA POR PARTE DEL CLIENTE</option>"; 
                    echo "<option value='GPC - PENDIENTE INFORMACIÓN DEL CLIENTE PARA CONFIGURAR'>GPC - PENDIENTE INFORMACIÓN DEL CLIENTE PARA CONFIGURAR</option>"; 
                    echo "<option value='GPC - SIN ALCANCE PARA FABRICA'>GPC - SIN ALCANCE PARA FABRICA</option>"; 
                    echo "<option value='IMPLEMENTACIÓN - SOLUCIÓN NO ESTANDAR'>IMPLEMENTACIÓN - SOLUCIÓN NO ESTANDAR</option>"; 
                    echo "<option value='INCONVENIENTE TECNICO'>INCONVENIENTE TECNICO</option>"; 
                    echo "<option value='LIDER TECNICO - CAMBIO DE ALCANCE PLAN TECNICO'>LIDER TECNICO - CAMBIO DE ALCANCE PLAN TECNICO</option>"; 
                    echo "<option value='LIDER TECNICO - PENDIENTE PLAN TECNICO'>LIDER TECNICO - PENDIENTE PLAN TECNICO</option>"; 
                    echo "<option value='LIDER TECNICO - SOLUCIÓN NO ESTANDAR'>LIDER TECNICO - SOLUCIÓN NO ESTANDAR</option>"; 
                    echo "<option value='LIDER TECNICO - SOLUCIÓN NO ESTANDAR SIN DEFINICIÓN'>LIDER TECNICO - SOLUCIÓN NO ESTANDAR SIN DEFINICIÓN</option>"; 
                    echo "<option value='PASO A PENDIENTE CLIENTE'>PASO A PENDIENTE CLIENTE</option>"; 
                    echo "<option value='PENDIENTE SOLICITAR ENTREGA DEL SERVICIO'>PENDIENTE SOLICITAR ENTREGA DEL SERVICIO</option>"; 
                    echo "<option value='PLANTA EXTERNA - EN CURSO SIN INCONVENIENTE REPORTADO'>PLANTA EXTERNA - EN CURSO SIN INCONVENIENTE REPORTADO</option>"; 
                    echo "<option value='PLANTA EXTERNA - ERROR EN LA EJECUCIÓN DE EOC'>PLANTA EXTERNA - ERROR EN LA EJECUCIÓN DE EOC</option>"; 
                    echo "<option value='PLANTA EXTERNA - ESCALADO_IFO_RESULTADO DE ACTIVIDAD'>PLANTA EXTERNA - ESCALADO_IFO_RESULTADO DE ACTIVIDAD</option>"; 
                    echo "<option value='PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE DESBORDE'>PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE DESBORDE</option>"; 
                    echo "<option value='PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE PERSONAL'>PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE PERSONAL</option>"; 
                    echo "<option value='PLANTA EXTERNA - ETAPA INTERMEDIA - SIN CONFIRMACIÓN DE PERSONAL PARA EOC Y EMPALMES'>PLANTA EXTERNA - ETAPA INTERMEDIA - SIN CONFIRMACIÓN DE PERSONAL PARA EOC Y EMPALMES</option>"; 
                    echo "<option value='PLANTA EXTERNA - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO'>PLANTA EXTERNA - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO</option>"; 
                    echo "<option value='PLANTA EXTERNA - NO VIABLE EN FACTIBILIDAD POR TERCEROS'>PLANTA EXTERNA - NO VIABLE EN FACTIBILIDAD POR TERCEROS</option>"; 
                    echo "<option value='PLANTA EXTERNA - NO VIABLE EN FO - EN INSTALACIÓN POR HFC'>PLANTA EXTERNA - NO VIABLE EN FO - EN INSTALACIÓN POR HFC</option>"; 
                    echo "<option value='PLANTA EXTERNA - PERMISOS MUNICIPALES - PERMISOS DE ARRENDADOR DE INFRAESTRUCTURA'>PLANTA EXTERNA - PERMISOS MUNICIPALES - PERMISOS DE ARRENDADOR DE INFRAESTRUCTURA</option>"; 
                    echo "<option value='PLANTA EXTERNA - SIN APROBACIÓN DE TENDIDO EXTERNO POR COSTOS'>PLANTA EXTERNA - SIN APROBACIÓN DE TENDIDO EXTERNO POR COSTOS</option>"; 
                    echo "<option value='PREVENTA - NO ES CLARA LA SOLUCIÓN A IMPLEMENTAR'>PREVENTA - NO ES CLARA LA SOLUCIÓN A IMPLEMENTAR</option>"; 
                    echo "<option value='PREVENTA - SIN ID  FACTIBILIDAD PARA TERCEROS'>PREVENTA - SIN ID  FACTIBILIDAD PARA TERCEROS</option>"; 
                    echo "<option value='PROYECTO ÉXITO ANTIGUO'>PROYECTO ÉXITO ANTIGUO</option>"; 
                    echo "<option value='TERCEROS - EN CURSO SIN INCONVENIENTE REPORTADO'>TERCEROS - EN CURSO SIN INCONVENIENTE REPORTADO</option>"; 
                    echo "<option value='TERCEROS - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO'>TERCEROS - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO</option>"; 
                    echo "<option value='TERCEROS - NO VIABLE - EN PROCESO NOTIFICACIÓN A CLIENTE Y COMERCIAL PARA CANCELACIÓN'>TERCEROS - NO VIABLE - EN PROCESO NOTIFICACIÓN A CLIENTE Y COMERCIAL PARA CANCELACIÓN</option>"; 
                    echo "<option value='TERCEROS - SIN AVANCE SOBRE LA FECHA DE ENTREGA DE ULTIMA MILLA'>TERCEROS - SIN AVANCE SOBRE LA FECHA DE ENTREGA DE ULTIMA MILLA</option>"; 
				echo "</select></td>";
		echo "<td><textarea rows='1'></textarea></td>";
	echo "</tr>";
			
}
?>
</table>













































































<h3 align="center">Tabla de Detalles OTH</h3>
<table id="detalles_oth" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
	<thead>
		<th>OTH</th>
		<th>Tipo OTH</th>
		<th>Estado OTH</th>
		<th>Creación OTH</th>
		<th>Ingeniero</th>
		<th>Detalle</th>
	</thead>
<?php 
//$registros
for ($i=0; $i < count($registros['oth']); $i++) { 
	echo "<tr>";
		echo "<td>".$registros['oth'][$i]->id_orden_trabajo_hija."</td>";
		echo "<td>".$registros['oth'][$i]->ot_hija."</td>";
		echo "<td>".$registros['oth'][$i]->estado_orden_trabajo_hija."</td>";
		echo "<td>".$registros['oth'][$i]->fecha_creacion_ot_hija."</td>";
		echo "<td>".$registros['oth'][$i]->nombre."</td>";
                echo "<td>
                        <div class='btn-group'>
                            <a class='btn btn-default btn-xs ver-det btn_datatable_cami' title='Detalle Ot' onclick='showModalDetalles(" . $registros['oth'][$i]->id_orden_trabajo_hija . ");'><span class='fa fa-fw fa-eye'></span></a>
                        </div>
                    </td>";
	echo "</tr>";
			
}
?>
<tfoot>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
</tfoot>
</table>

<!-- ****************************MODAL DE DETALLE ************************************************ -->
<div id="Modal_detalle" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="col-md-12">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                <h3 class="modal-title" id="title_modal" align="center"></h3>
            </div>
            <div>
                <div class="modal-body">
                    <form class="well form-horizontal" id="formModal_detalle" action=""  method="post">
                        <fieldset>
                            <!-- PRIMERA SESSION -->
                            <fieldset class="col-md-3 sessionmodal">

                                <div class="form-group col-md-12">
                                    <label for="id_cliente_onyx" class="col-md-12 control-label ubicacionLetra" >ID Cliente Onyx: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="k_id_estado_ot" id="mdl_k_id_estado_ot" class="form-control ubicacionLetra"disabled="true" type="text" required >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nombre_cliente" class="col-md-12 control-label ubicacionLetra">Nombre Cliente: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group ubicacionLetra">
                                            <textarea name="n_nombre_cliente" id="mdl_n_nombre_cliente" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="nombre_cliente" id="mdl_nombre_cliente" class="form-control"  disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="grupo_objetivo" class="col-md-12 control-label ubicacionLetra" >Grupo Objetivo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="grupo_objetivo" id="mdl_grupo_objetivo" class="form-control tamanioletra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="segmento" class="col-md-12 control-label ubicacionLetra">Segmento: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="segmento" id="mdl_segmento" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nivel_atencion" class="col-md-12 control-label ubicacionLetra" style="text-align: left;" >Nivel atención: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="nivel_atencion" id="mdl_nivel_atencion" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="ciudad" class="col-md-12 control-label ubicacionLetra" style="text-align: left;" >Ciudad: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="ciudad" id="mdl_ciudad" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="departamento" class="col-md-12 control-label ubicacionLetra" style="text-align: left;" >Departamento: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="departamento" id="mdl_departamento" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="grupo" class="col-md-12 control-label ubicacionLetra">Grupo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="grupo" id="mdl_grupo" rows="1" cols="29" class="form-control csstextarea ubicacionLetra" disabled="true">
                                            </textarea>
                                            <!-- <input name="grupo" id="grupo" class="form-control" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="consultor_comercial" class="col-md-12 control-label ubicacionLetra">Consultor Comercial: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="consultor_comercial" id="mdl_consultor_comercial" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="consultor_comercial" id="mdl_consultor_comercial" class="form-control" disabled="true"  minlength="3" type="text" required> -->
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="grupo2" class="col-md-12 control-label ubicacionLetra">Grupo 2: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="grupo2" id="mdl_grupo2" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="consultor_postventa" class="col-md-12 control-label ubicacionLetra">Consultor Postventa: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="consultor_postventa" id="mdl_consultor_postventa" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="proy_instalacion" class="col-md-12 control-label ubicacionLetra">Proy. Instalación: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="proy_instalacion" id="mdl_proy_instalacion" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="proy_instalacion" id="proy_instalacion" class="form-control" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="ing_responsable" class="col-md-12 control-label ubicacionLetra">Ing. Responsable: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="ing_responsable" id="mdl_ing_responsable" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="id_enlace" class="col-md-12 control-label ubicacionLetra">ID Enlace: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="id_enlace" id="mdl_id_enlace" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="alias_enlace" class="col-md-12 control-label ubicacionLetra">Alias Enlace: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">                                           
                                            <textarea name="alias_enlace" id="mdl_alias_enlace" rows="2" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="alias_enlace" id="mdl_alias_enlace" class="form-control" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                            </fieldset>


                            <!-- SEGUNDA SESSION -->
                            <fieldset class="col-md-3 sessionmodal" x;">


                                      <div class="form-group col-md-12">
                                    <label for="orden_trabajo" class="col-md-12 control-label ubicacionLetra">Orden Trabajo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="estado_orden_trabajo" id="mdl_estado_orden_trabajo" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="orden_trabajo" id="mdl_orden_trabajo" class="form-control" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nro_ot_onyx" class="col-md-12 control-label ubicacionLetra">Num. Ot Onyx: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="nro_ot_onyx" id="mdl_nro_ot_onyx" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="servicio" class="col-md-12 control-label ubicacionLetra">Servicio: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="servicio" id="mdl_servicio" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="servicio" id="mdl_servicio" class="form-control" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="familia" class="col-md-12 control-label ubicacionLetra">Familia: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="familia" id="mdl_familia" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="producto" class="col-md-12 control-label ubicacionLetra">Producto: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="producto" id="mdl_producto" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fecha_creacion" class="col-md-12 control-label ubicacionLetra">Fecha creación: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="fecha_creacion" id="mdl_fecha_creacion" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="tiempo_incidente" class="col-md-12 control-label ubicacionLetra">Tiempo Incidente: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="tiempo_incidente" id="mdl_tiempo_incidente" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="estado_orden_trabajo" class="col-md-12 control-label ubicacionLetra">Estado Orden Trabajo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="orden_trabajo" id="mdl_orden_trabajo" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="tiempo_estado" class="col-md-12 control-label ubicacionLetra">Tiempo Estado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="tiempo_estado" id="mdl_tiempo_estado" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="ano_ingreso_estado" class="col-md-12 control-label ubicacionLetra">Año Ingreso Estado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="ano_ingreso_estado" id="mdl_ano_ingreso_estado" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="mes_ngreso_estado" class="col-md-12 control-label ubicacionLetra">Mes Ingreso Estado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="mes_ngreso_estado" id="mdl_mes_ngreso_estado" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fecha_ingreso_estado" class="col-md-12 control-label ubicacionLetra">Fecha Ingreso Estado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">                                         
                                            <input name="fecha_ingreso_estado" id="mdl_fecha_ingreso_estado" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="usuario_asignado" class="col-md-12 control-label ubicacionLetra">Usuario Asignado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="usuario_asignado" id="mdl_usuario_asignado" rows="2" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                           <!--  <input name="usuario_asignado" id="mdl_usuario_asignado" class="form-control" minlength="5" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="grupo_asignado" class="col-md-12 control-label ubicacionLetra">Grupo Asignado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">                                           
                                            <input name="grupo_asignado" id="mdl_grupo_asignado" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="ingeniero_provisioning" class="col-md-12 control-label ubicacionLetra">Ingeniero Provisioning: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">  
                                            <textarea name="ingeniero_provisioning" id="mdl_ingeniero_provisioning" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="ingeniero_provisioning" id="mdl_ingeniero_provisioning" class="form-control" minlength="3" disabled="true" type="text" required>-->
                                        </div> 
                                    </div>
                                </div>


                            </fieldset>

                            <!-- TERCERA SESSION -->
                            <fieldset class="col-md-3 sessionmodal" x;">


                                      <div class="form-group col-md-12">
                                    <label for="cargo_arriendo" class="col-md-12 control-label ubicacionLetra">Cargo Arriendo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="cargo_arriendo" id="mdl_cargo_arriendo" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="cargo_mensual" class="col-md-12 control-label ubicacionLetra">Cargo Mensual: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="cargo_mensual" id="mdl_cargo_mensual" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="monto_moneda_local_arriendo" class="col-md-12 control-label ubicacionLetra">Monto Moneda Local Arriendo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="monto_moneda_local_arriendo" id="mdl_monto_moneda_local_arriendo" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="monto_moneda_local_cargo_mensual" class="col-md-12 control-label ubicacionLetra">Monto Moneda Local Cargo Mensual: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="monto_moneda_local_cargo_mensual" id="mdl_monto_moneda_local_cargo_mensual" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="cargo_obra_civil" class="col-md-12 control-label ubicacionLetra">Cargo Obra Civil: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="cargo_obra_civil" id="mdl_cargo_obra_civil" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="descripcion" class="col-md-12 control-label ubicacionLetra">Descripción: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="descripcion" id="mdl_descripcion" rows="4" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="descripcion" id="mdl_descripcion" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="direccion_origen" class="col-md-12 control-label ubicacionLetra">Dirección Origen: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="direccion_origen" id="mdl_direccion_origen" rows="2" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>
                                            <!-- <input name="direccion_origen" id="mdl_direccion_origen" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="ciudad_incidente" class="col-md-12 control-label ubicacionLetra">Ciudad Incidente: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="ciudad_incidente" id="mdl_ciudad_incidente" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="direccion_destino" class="col-md-12 control-label ubicacionLetra">Dirección Destino: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">  
                                            <textarea name="direccion_destino" id="mdl_direccion_destino" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>                                
                                            <!-- <input name="direccion_destino" id="mdl_direccion_destino" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="ciudad_incidente3" class="col-md-12 control-label ubicacionLetra">Ciudad Incidente 3: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="ciudad_incidente3" id="mdl_ciudad_incidente3" class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fecha_compromiso" class="col-md-12 control-label ubicacionLetra">Fecha Compromiso: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">                                           
                                            <input name="fecha_compromiso" id="mdl_fecha_compromiso" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fecha_programacion" class="col-md-12 control-label ubicacionLetra">Fecha Programación: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">                                           
                                            <input name="fecha_programacion" id="mdl_fecha_programacion" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fecha_realizacion" class="col-md-12 control-label ubicacionLetra">Fecha Realización: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="fecha_realizacion" id="mdl_fecha_realizacion" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="resolucion_1" class="col-md-12 control-label ubicacionLetra">Resolución 1: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="resolucion_1" id="mdl_resolucion_1" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>

                            <!-- CUARTA SESSION -->
                            <fieldset class="col-md-3 sessionmodal" >


                                <div class="form-group col-md-12">
                                    <label for="resolucion_2" class="col-md-12 control-label ubicacionLetra">Resolución 2: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_2" id="mdl_resolucion_2" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>     
                                            <!-- <input name="resolucion_2" id="mdl_resolucion_2" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="resolucion_3" class="col-md-12 control-label ubicacionLetra">Resolución 3: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_3" id="mdl_resolucion_3" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>     
                                            <!-- <input name="resolucion_3" id="mdl_resolucion_3" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="resolucion_4" class="col-md-12 control-label ubicacionLetra">Resolución 4: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_4" id="mdl_resolucion_4" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>     
                                            <!-- <input name="resolucion_4" id="mdl_resolucion_4" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="ot_hija" class="col-md-12 control-label ubicacionLetra">OT Hija: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="ot_hija" id="mdl_ot_hija" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="estado_orden_trabajo_hija" class="col-md-12 control-label ubicacionLetra">Estado Orden Trabajo Hija: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="estado_orden_trabajo_hija" id="mdl_estado_orden_trabajo_hija" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="fecha_creacion_ot_hija" class="col-md-12 control-label ubicacionLetra">Fecha creacion OT Hija: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="fecha_creacion_ot_hija" id="mdl_fecha_creacion_ot_hija" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="proveedor_ultima_milla" class="col-md-12 control-label ubicacionLetra">Proveedor Ultima Milla: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="proveedor_ultima_milla" id="mdl_proveedor_ultima_milla" rows="2" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>   
                                            <!-- <input name="proveedor_ultima_milla" id="mdl_proveedor_ultima_milla" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div> 


                                <div class="form-group col-md-12">
                                    <label for="usuario_asignado4" class="col-md-12 control-label ubicacionLetra">Usuario Asignado 4: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">                                         
                                            <textarea name="usuario_asignado4" id="mdl_usuario_asignado4" rows="2" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>  
                                            <!-- <input name="usuario_asignado4" id="mdl_usuario_asignado4" class="form-control ubicacionLetra" minlength="3" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="resolucion_15" class="col-md-12 control-label ubicacionLetra">Resolución 15: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_15" id="mdl_resolucion_15" rows="2" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>  
                                            <!-- <input name="resolucion_15" id="mdl_resolucion_15" class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="resolucion_26" class="col-md-12 control-label ubicacionLetra">Resolución 26: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_26" id="mdl_resolucion_26" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>  
                                            <!-- <input name="resolucion_26" id="mdl_resolucion_26" class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="resolucion_37" class="col-md-12 control-label ubicacionLetra">Resolución 37: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_37" id="mdl_resolucion_37" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>  
                                            <!-- <input name="resolucion_37" id="mdl_resolucion_37" class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="resolucion_48" class="col-md-12 control-label ubicacionLetra">Resolución 48: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <textarea name="resolucion_48" id="mdl_resolucion_48" rows="1" cols="29" class="form-control csstextarea tamanioletra" disabled="true">
                                            </textarea>  <!-- <input name="resolucion_48" id="mdl_resolucion_48" class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fec_actualizacion_onyx_hija" class="col-md-12 control-label ubicacionLetra">Fecha Actualización Onyx Hija: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="fec_actualizacion_onyx_hija" id="mdl_fec_actualizacion_onyx_hija"  class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="Tipo_transcurrido" class="col-md-12 control-label ubicacionLetra">Tiempo transcurrido: &nbsp;</label>
                                    <div class="col-md-12 selectContainer">
                                        <div class="input-group">
                                            <input name="tipo_trascurrido" id="mdl_tipo_trascurrido"  class="form-control ubicacionLetra" minlength="5" disabled="true" type="text" required>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>

                        </fieldset>
                    </form>
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id=CerrarModalDetalle" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cerrar</button>
            </div>
        </div>
    </div> 
</div>
