<style type="text/css">
	input[type="checkbox"], input[type="radio"]{
	position: absolute;
	right: 9000px;
}

/*Check box*/
input[type="checkbox"] + .label-text:before{
	content: "\f096";
	font-family: "FontAwesome";
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	line-height: 1;
	-webkit-font-smoothing:antialiased;
	width: 1em;
	display: inline-block;
	margin-right: 5px;
}

input[type="checkbox"]:checked + .label-text:before{
	content: "\f14a";
	color: #2980b9;
	animation: effect 250ms ease-in;
}

input[type="checkbox"]:disabled + .label-text{
	color: #aaa;
}

input[type="checkbox"]:disabled + .label-text:before{
	content: "\f0c8";
	color: #ccc;
}

/*Radio box*/

input[type="radio"] + .label-text:before{
	content: "\f10c";
	font-family: "FontAwesome";
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	line-height: 1;
	-webkit-font-smoothing:antialiased;
	width: 1em;
	display: inline-block;
	margin-right: 5px;
}

input[type="radio"]:checked + .label-text:before{
	content: "\f192";
	color: #8e44ad;
	animation: effect 250ms ease-in;
}

input[type="radio"]:disabled + .label-text{
	color: #aaa;
}

input[type="radio"]:disabled + .label-text:before{
	content: "\f111";
	color: #ccc;
}

/*Radio Toggle*/

.toggle input[type="radio"] + .label-text:before{
	content: "\f204";
	font-family: "FontAwesome";
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	line-height: 1;
	-webkit-font-smoothing:antialiased;
	width: 1em;
	display: inline-block;
	margin-right: 10px;
}

.toggle input[type="radio"]:checked + .label-text:before{
	content: "\f205";
	color: #16a085;
	animation: effect 250ms ease-in;
}

.toggle input[type="radio"]:disabled + .label-text{
	color: #aaa;
}

.toggle input[type="radio"]:disabled + .label-text:before{
	content: "\f204";
	color: #ccc;
}


@keyframes effect{
	0%{transform: scale(0);}
	25%{transform: scale(1.3);}
	75%{transform: scale(1.4);}
	100%{transform: scale(1);}
}

</style>


<h3 align="center">Detalle de la sede <b><?= $otp[0]->nombre_sede ?></b>  :  Cliente <b><?= $otp[0]->n_nombre_cliente ?></b></h3>
<!--*********************  MODULO PESTAÑAS  *********************-->
<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#pestana_tabla_otp">tabla OTP</a></li>
	<li class=""><a data-toggle="tab" href="#pestana_log">control de cambios</a></li>
</ul>

<!--*********************  CONTENIDO PESTAÑAS  *********************-->
<div class="tab-content">

	<div id="pestana_tabla_otp" class="tab-pane fade in active">
		<h3>tabla OTP</h3>
		<!-- INICIO TABLA DE OTP DE UNA SEDE -->
		<table id="table_sede_otp" class="table datatables_detalles table-hover table-bordered table-striped dataTable_camilo" width="100%">
			<thead>
				<th>OTP</th>
				<th>TIPO</th>
				<th>SERVICIO</th>
				<th>ESTADO</th>
				<th>OPC</th>
			</thead>
		<?php foreach ($otp as $item_otp): ?>
			<tr>
				<td><?= $item_otp->k_id_ot_padre ?></td>
				<td><?= $item_otp->orden_trabajo ?></td>
				<td><?= $item_otp->servicio ?></td>
				<td><?= $item_otp->estado_orden_trabajo ?></td>		
				<td><div class='btn-group'>
		                <a class='btn btn-default btn-xs new_control btn_datatable_cami' title='Nuevo Control de Causa' onclick='showFormControl("<?= $item_otp->k_id_ot_padre ?>");'><i class="fa fa-bars" aria-hidden="true"></i></a>
		            </div>
		        </td>		
			</tr>
		<?php endforeach ?>
		</table>
	</div>
	<!-- ***********************************************INICIO DE PESTAÑA 2*********************************************** -->
	<div id="pestana_log" class="tab-pane fade">
		<h3>control de cambios</h3>
		<table id="table_log_ctrl_cambios" class="table datatables_detalles table-hover table-bordered table-striped dataTable_camilo" width="100%">
			<thead>
				<th>otp</th>
				<th>responsable</th>
				<th>causa</th>
				<th>numero control</th>
				<th>compromiso</th>
				<th>fecha programacion inicial</th>
				<th>nueva fecha programacion</th>
				<th>narrativa escalamiento</th>
				<th>estado</th>
				<th>observaciones</th>
				<th>faltantes</th>
				<th>en_tiempos</th>
				<th>creado</th>
			</thead>
		<?php foreach ($log as $item_log): ?>
			<tr>
				<th><?=$item_log->id_ot_padre ?></th>
				<th><?=$item_log->nombre_responsable ?></th>
				<th><?=$item_log->nombre_causa ?></th>
				<th><?=$item_log->numero_control ?></th>
				<th><?=$item_log->fecha_compromiso ?></th>
				<th><?=$item_log->fecha_programacion_inicial ?></th>
				<th><?=$item_log->nueva_fecha_programacion ?></th>
				<th><?=$item_log->narrativa_escalamiento ?></th>
				<th><?=$item_log->estado_cc ?></th>
				<th><?=$item_log->observaciones_cc ?></th>
				<th><?=$item_log->faltantes ?></th>
				<th><?=$item_log->en_tiempos ?></th>
				<th><?=$item_log->fecha_creacion_cc ?></th>
			</tr>
		<?php endforeach ?>
			<tfoot>
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
				<th></th>
			</tfoot>
		</table>
	</div>

</div>


<!-- MODAL FORMULARIO + LOG -->
<div id="mdl-control_cambios" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h3 class="modal-title" id="myModalLabel">    Orden Ot Hija N <label id="id_ot_modal"></label></h3>
            </div>
            <div class="modal-body">
				<!--*********************  MODULO PESTAÑAS  *********************-->
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#form">Formulario</a></li>
					<li class=""><a data-toggle="tab" href="#log_otp">Hitorial</a></li>
				</ul>
				
				<!--*********************  CONTENIDO PESTAÑAS  *********************-->
				<div class="tab-content">
				
					<div id="form" class="tab-pane fade in active">
						<h3>Formulario</h3>

				          <form class="well form-horizontal" id="formModal" action=""  method="post" data-action="FOR_UPDATE" novalidate="novalidate">
				            <fieldset>
				              <div class="widget bg_white m-t-25 display-block">
				                <h2 class="h4 mp">
				                  <i class="fa fa-fw fa-question-circle"></i>&nbsp;&nbsp; General
				                </h2>
				                <fieldset class="col-md-6 control-label">
				                  <!-- valores ocultos -->
				                  <!-- <input type="hidden" id="mtxtTicket" value=""> -->

				                  <div class="form-group">
				                    <label for="id_ot_padre" class="col-md-3 control-label">otp:</label>
				                    <div class="col-md-8 selectContainer">
				                      <div class="input-group">
				                        <span class="input-group-addon"><i class="fa fa-braille" aria-hidden="true"></i></span>
				                        <input name="id_ot_padre" id="id_ot_padre" class="form-control" type="text" readonly="true">
				                      </div>
				                    </div>
				                  </div>

				                  <div class="form-group">
				                    <label for="n_nombre_cliente" class="col-md-3 control-label">Cliente:</label>
				                    <div class="col-md-8 selectContainer">
				                      <div class="input-group">
				                        <span class="input-group-addon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
				                        <input name="n_nombre_cliente" id="n_nombre_cliente" class="form-control" type="text" disabled="true">
				                      </div>
				                    </div>
				                  </div>

				                  <div class="form-group">
				                    <label for="numero_control" class="col-md-3 control-label">N° control:</label>
				                    <div class="col-md-8 selectContainer">
				                      <div class="input-group">
				                        <span class="input-group-addon"><i class="fa fa-contao" aria-hidden="true"></i></span>
				                        <input name="numero_control" id="numero_control" class="form-control" type="text">
				                      </div>
				                    </div>
				                  </div>
				                </fieldset>
				                <!--  fin seccion izquierda form-->
				                <!--  inicio seccion derecha form-->
				                <fieldset>

				                  <div class="form-group">
				                    <label for="id_responsable" class="col-md-3 control-label">Responsable CC:</label>
				                    <div class="col-md-8 selectContainer">
				                      <div class="input-group">
				                        <span class="input-group-addon" id="statusColor"><i class="fa fa-street-view" aria-hidden="true"></i></span>
				                        <select name="id_responsable" id="id_responsable" class="form-control">
				                          <option value="">Seleccione</option>
				                        </select>
				                      </div>
				                    </div>
				                  </div>

				                  
				                  <div class="form-group">
				                    <label for="id_causa" class="col-md-3 control-label">Causa CC:</label>
				                    <div class="col-md-8 selectContainer">
				                      <div class="input-group">
				                        <span class="input-group-addon" id="statusColor"><i class="fa fa-th-list" aria-hidden="true"></i></span>
				                        <select name="id_causa" id="id_causa" class="form-control">
				                          <option value="">Seleccione</option>
				                        </select>
				                      </div>
				                    </div>
				                  </div>

				                  <div class="form-group">
				                    <label for="fecha_compromiso" class="col-md-3 control-label">Compromiso:</label>
				                    <div class="col-md-8 selectContainer">
				                      <div class="input-group">
				                        <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
				                        <input name="fecha_compromiso" id="fecha_compromiso" class="form-control" type="date">
				                      </div>
				                    </div>
				                  </div>

				                </fieldset>
				                <!--  fin seccion derecha form---->
				              </div>

				              <div class="widget bg_white m-t-25 display-block">
				         
				                <fieldset class="col-md-6 control-label">
				                  <div class="form-group">
				                    <label for="fecha_programacion_inicial" class="col-md-3 control-label">Programación Inicial:</label>
				                    <div class="col-md-8 selectContainer">
				                      <div class="input-group">
				                        <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
				                        <input name="fecha_programacion_inicial" id="fecha_programacion_inicial" class="form-control" type="date">
				                      </div>
				                    </div>
				                  </div>

				                  <div class="form-group">
				                    <label for="nueva_fecha_programacion" class="col-md-3 control-label">Nueva Programación:</label>
				                    <div class="col-md-8 selectContainer">
				                      <div class="input-group">
				                        <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
				                        <input name="nueva_fecha_programacion" id="nueva_fecha_programacion" class="form-control" type="date">
				                      </div>
				                    </div>
				                  </div>
				                </fieldset>
				                <!--  fin seccion izquierda form---->

				                <!--  inicio seccion derecha form---->
				                <fieldset>
				                  <div class="form-group">
				                    <label for="estado_cc" class="col-md-3 control-label">Estado:</label>
				                    <div class="col-md-8 selectContainer">
				                      <div class="input-group">
				                        <span class="input-group-addon" id="statusColor"><i class="fa fa-list" aria-hidden="true"></i></span>
				                        <select name="estado_cc" id="estado_cc" class="form-control">
					                        <option value="">Seleccione</option>
					                        <option value="NO INICIADO">NO INICIADO</option>
											<option value="EJECUTADO">EJECUTADO</option>
											<option value="RECHAZADO">RECHAZADO</option>
											<option value="PTE. CORRECCION">PTE. CORRECCION</option>
											<option value="ESCALADO CLARO">ESCALADO CLARO</option>
				                        </select>
				                      </div>
				                    </div>
				                  </div>

				                  <div class="form-group">
				                    <label for="observaciones_cc" class="col-md-3 control-label">Observaciones:</label>
				                    <div class="col-md-8 selectContainer">
				                      <div class="input-group">
				                        <span class="input-group-addon" id="statusColor"><i class="fa fa-list" aria-hidden="true"></i></span>
				                        <select name="observaciones_cc" id="observaciones_cc" class="form-control">
					                        <option value="pte- correccion -se requiere fecha de finalización del pendiente para ajustar">pte- correccion -se requiere fecha de finalización del pendiente para ajustar</option>
											<option value="cc- rechazado - sin gestion del ing de es">cc- rechazado - sin gestion del ing de es</option>
											<option value="cc- rechazado - corrección no realizada en tiempos">cc- rechazado - corrección no realizada en tiempos</option>
											<option value="cc- rechazado - linea de escalamiento fuera de tiempo">cc- rechazado - linea de escalamiento fuera de tiempo</option>
											<option value="cc- rechazado - causa no aplica debe ser por cliente">cc- rechazado - causa no aplica debe ser por cliente</option>
											<option value="cc- rechazado - tipificación no aplica deacuerdo a la narraiva del escalamiento">cc- rechazado - tipificación no aplica deacuerdo a la narraiva del escalamiento</option>
											<option value="cc- rechazado - ot en sia - no requiere cc">cc- rechazado - ot en sia - no requiere cc</option>
											<option value="cc- rechazado - se solicitan las mismas fechas de cc anterior">cc- rechazado - se solicitan las mismas fechas de cc anterior</option>
											<option value="cc- rechazado - sin linea de escalamiento">cc- rechazado - sin linea de escalamiento</option>
											<option value="cc- rechazado - cc duplicado">cc- rechazado - cc duplicado</option>
				                        </select>
				                      </div>
				                    </div>
				                  </div>
				                </fieldset>
				              </div>

				              <div class="widget bg_white m-t-25 display-block col-md-12 text_aling">
				                
				                <fieldset class="col-md-6 control-label">
				                	<div class="col-md-6">
					                	<div class="form-check">
											<label>
												<input type="checkbox" name="check" checked> <span class="label-text">UM</span>
											</label>
										</div>
										<div class="form-check">
											<label>
												<input type="checkbox" name="check"> <span class="label-text">CT</span>
											</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-check">
											<label>
												<input type="checkbox" name="check"> <span class="label-text">Configuración</span>
											</label>
										</div>
										<div class="form-check">
											<label>
												<input type="checkbox" name="check" disabled> <span class="label-text">Equipos</span>
											</label>
										</div>
									</div>
				                </fieldset>
				                <!--  fin seccion izquierda form---->

				                <!--  inicio seccion derecha form---->
				                <fieldset class="col-md-6 control-label">
				                	<div class="col-md-6">
					                	<div class="form-check">
											<label>
												<input type="checkbox" name="check" checked> <span class="label-text">PDT</span>
											</label>
										</div>
										<div class="form-check">
											<label>
												<input type="checkbox" name="check"> <span class="label-text">Incump fecha</span>
											</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-check">
											<label>
												<input type="checkbox" name="check"> <span class="label-text">cupos saturación</span>
											</label>
										</div>
										<div class="form-check">
											<label>
												<input type="checkbox" name="check" disabled> <span class="label-text">ES</span>
											</label>
										</div>
										<div class="form-check">
											<label>
												<input type="checkbox" name="check" disabled> <span class="label-text">SIAO</span>
											</label>
										</div>
									</div>
				                </fieldset>
				              </div>

				              <div class="widget bg_white m-t-25 display-block">
				                <div class="form-group" id="formCenter">
				                  <!-- <label for="mtxtObservaciones" class="col-md-3 control-label">Observaciones: &nbsp;</label> -->
				                  <div class="col-md-10 selectContainer">
				                    <div class="input-group">
				                      <span class="input-group-addon"><i class='glyphicon glyphicon-edit'></i></span>
				                      <input name="mtxtObservaciones" id="mtxtObservaciones" class="form-control" type="text" placeholder="Observaciones">
				                    </div>
				                  </div>
				                </div>                
				              </div>




				              <!-- espacio para adicionar tecnicos -->
				              <div class="widget bg_white m-t-25 display-block">

				                <fieldset class="col-md-6 control-label" id="fieldsetIT">
				                  <div id="newItSeccion"></div>

				                </fieldset>
				                <!--  fin seccion izquierda form---->

				                <!--  inicio seccion derecha form---->
				                <fieldset id="fieldsetAA">
				                  <span class="mg-20"><b> Añadir Técnico </b></span>
				                  <div id="newAASeccion"></div>
				                </fieldset>

				              </div>

				            </fieldset>
				          </form>





						<!-- <form class="well form-horizontal" id="formModal" action="" method="post" novalidate="novalidate">
							<fieldset>
								
								
										<div class="form-group">
											<label for="consultor_comercial" class="col-md-3 control-label">Narrativa de escalamiento: &nbsp;</label>
											<div class="col-md-6 selectContainer ">
												<div class="input-group">
													<textarea name="" class="form-control">  </textarea>
												</div>
											</div>
										</div>

										
										<div class="form-group">
											<label for="grupo" class="col-md-3 control-label">Faltantes para ES: &nbsp;</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group text_aling">
													<fieldset>
														<div>
															<input type="radio" id="UM" value="UM" />
															<label for="UM">UM</label>
														</div>
														<div>
															<input type="radio" id="CT" value="CT" />
															<label for="CT">CT</label>
														</div>
														<div>
															<input type="radio" id="CONGIGURACIÓN" value="CONGIGURACIÓN" m/>
															<label for="CONGIGURACIÓN">CONGIGURACIÓN</label>
														</div>
														<div>
															<input type="radio" id="EQUIPOS" value="EQUIPOS"/>
															<label for="EQUIPOS">EQUIPOS</label>
														</div>
														<div>
															<input type="radio" id="PDT" value="PDT" />
															<label for="PDT">PDT</label>
														</div>
														<div>
															<input type="radio" id="INCUMPulMIENTO FECHA" value="INCUMPulMIENTO FECHA" />
															<label for="INCUMPulMIENTO FECHA">INCUMPulMIENTO FECHA</label>
														</div>
														<div>
															<input type="radio" id="CUPOS SATURACIÓN" value="CUPOS SATURACIÓN" />
															<label for="CUPOS SATURACIÓN">CUPOS SATURACIÓN</label>
														</div>
														<div>
															<input type="radio" id="ES" value="ES" />
															<label for="ES">ES</label>
														</div>
														<div>
															<input type="radio" id="PASO A SIAO" value="PASO A SIAO" />
															<label for="PASO A SIAO">PASO A SIAO</label>
														</div>
													</fieldset>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="consultor_comercial" class="col-md-3 control-label">¿CC En tiempos?: &nbsp;</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group ">
													<select name="" class="select_cc_tiempos">
														<option value="">SI</option>
														<option value="">NO</option>
													</select>
												</div>
											</div>
										</div>
									</fieldset>
								</div>
							</fieldset>
						</form> -->
					</div>
					
					<!-- *************************INICIO SEGUNDA PESTAÑA************************* -->
					<div id="log_otp" class="tab-pane fade">
						<h3>Hitorial</h3>
						<!-- cxamilo -->
						<table id="tableServicios" class='table table-bordered table-striped' width='100%'></table>



					</div>
				
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























