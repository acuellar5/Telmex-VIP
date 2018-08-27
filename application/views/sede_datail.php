<h3 align="center">Detalle de la sede <?= $otp[0]->nombre_sede ?> Cliente <?= $otp[0]->n_nombre_cliente ?></h3>
<!--*********************  MODULO PESTAÑAS  *********************-->
<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#pestana_tabla_otp	">tabla OTP</a></li>
	<li class=""><a data-toggle="tab" href="#pestana_log">control de cambios</a></li>
</ul>

<!--*********************  CONTENIDO PESTAÑAS  *********************-->
<div class="tab-content">

	<div id="pestana_tabla_otp	" class="tab-pane fade in active">
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
		                <a class='btn btn-default btn-xs new_control btn_datatable_cami' title='Nuevo Control de Causa' onclick='showFormControl("<?= $item_otp->k_id_ot_padre ?>, <?= $item_otp->n_nombre_cliente ?>, <?= $item_otp->nombre_sede ?>");'><i class="fa fa-bars" aria-hidden="true"></i></a>
		            </div>
		        </td>		
			</tr>
		<?php endforeach ?>
			<tfoot>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tfoot>
		</table>
	</div>
	<!-- ***********************************************INICIO DE PESTAÑA 2*********************************************** -->
	<div id="pestana_log" class="tab-pane fade">
		<h3>control de cambios</h3>
		<table id="table_log_ctrl_cambios" class='table table-bordered table-striped' width='100%'>
			<thead>
				<th>OTP</th>
				<th>RESPONSABLE</th>
				<th>CAUSA</th>
				<th>NUMERO control</th>
				<th>COMPROMISO</th>
				<th>FECHA PROGRAMACION INICIAL</th>
				<th>NUEVA FECHA PROGRAMACION</th>
				<th>NARRATIVA ESCALAMIENTO</th>
				<th>ESTADO</th>
				<th>OBSERVACIONES</th>
				<th>FALTANTES</th>
				<th>EN_TIEMPOS</th>
				<th>CREADO</th>
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
    <div class="modal-dialog modal-lg2" style="width: 1100px;">
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
						<form class="well form-horizontal" id="formModal" action="" method="post" novalidate="novalidate">
							<fieldset>
								<div class="widget bg_white m-t-25 display-block">
									<fieldset class="col-md-6">
										<div class="form-group">
											<label for="otp" class="col-md-3 control-label">OTP: &nbsp;</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group">
													<input name="otp" id="otp" class="form-control input_mdl_form_control" type="text">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="nombre_cliente" class="col-md-3 control-label">Nombre cliente: &nbsp;</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group">
													<input name="n_nombre_cliente" id="n_nombre_cliente" class="input_mdl_form_control form-control" type="text">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="num_control" class="col-md-3 control-label">Numero de control: &nbsp;</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group">
													<input name="num_control" id="num_control" class="input_mdl_form_control form-control" type="number">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="responsable" class="col-md-3 control-label">Responsable CC: &nbsp;</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group">
													<select name="responsable" class="fill_select_responsable">
														<option value=""></option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="causas" class="col-md-3 control-label">Causas CC: &nbsp;</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group">
													<select name="" class="fill_select_causa">
														<option value=""></option>
													</select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="ciudad" class="col-md-3 control-label">Fecha de compromiso: &nbsp;</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group">
													<input name="ciudad" id="ciudad" class="input_mdl_form_control form-control" type="date">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="departamento" class="col-md-3 control-label">Fecha de programacion inicial : &nbsp;</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group">
													<input name="departamento" id="departamento" class="input_mdl_form_control form-control" type="date">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="grupo" class="col-md-3 control-label">Nueva fecha de programacion: &nbsp;</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group">
													<input name="grupo" id="grupo" class="input_mdl_form_control form-control" type="date">
												</div>
											</div>
										</div>
									</fieldset>
								</div>
								fin seccion izquierda form
								<div class="widget bg_white m-t-25 display-block">
									<fieldset class="col-md-6 control-label">
										<div class="form-group">
											<label for="consultor_comercial" class="col-md-3 control-label">Narrativa de escalamiento: &nbsp;</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group">
													<textarea name="">  </textarea>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="departamento" class="col-md-3 control-label">Estado CC: &nbsp;</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group">
													<select name="" class="select_fech_progr">
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
											<label for="consultor_comercial" class="col-md-3 control-label">Observaciones CC: &nbsp;</label>
											<div class="col-md-8 selectContainer">
												<div class="input-group">
													<select name="" class="select_observaciones">
														<option value="PTE- CORRECCION -SE REQUIERE FECHA DE FINALIZACIÓN DEL PENDIENTE PARA AJUSTAR">PTE- CORRECCION -SE REQUIERE FECHA DE FINALIZACIÓN DEL PENDIENTE PARA AJUSTAR</option>
														<option value="CC- RECHAZADO - SIN GESTION DEL ING DE ES">CC- RECHAZADO - SIN GESTION DEL ING DE ES</option>
														<option value="CC- RECHAZADO - CORRECCIÓN NO REALIZADA EN TIEMPOS">CC- RECHAZADO - CORRECCIÓN NO REALIZADA EN TIEMPOS</option>
														<option value="CC- RECHAZADO - LINEA DE ESCALAMIENTO FUERA DE TIEMPO">CC- RECHAZADO - LINEA DE ESCALAMIENTO FUERA DE TIEMPO</option>
														<option value="CC- RECHAZADO - CAUSA NO APLICA DEBE SER POR CLIENTE">CC- RECHAZADO - CAUSA NO APLICA DEBE SER POR CLIENTE</option>
														<option value="CC- RECHAZADO - TIPIFICACIÓN NO APLICA DEACUERDO A LA NARRAIVA DEL ESCALAMIENTO">CC- RECHAZADO - TIPIFICACIÓN NO APLICA DEACUERDO A LA NARRAIVA DEL ESCALAMIENTO</option>
														<option value="CC- RECHAZADO - OT EN SIA - NO REQUIERE CC">CC- RECHAZADO - OT EN SIA - NO REQUIERE CC</option>
														<option value="CC- RECHAZADO - SE SOLICITAN LAS MISMAS FECHAS DE CC ANTERIOR">CC- RECHAZADO - SE SOLICITAN LAS MISMAS FECHAS DE CC ANTERIOR</option>
														<option value="CC- RECHAZADO - SIN LINEA DE ESCALAMIENTO">CC- RECHAZADO - SIN LINEA DE ESCALAMIENTO</option>
														<option value="CC- RECHAZADO - CC DUPLICADO">CC- RECHAZADO - CC DUPLICADO</option>
													</select>
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
						</form>
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























