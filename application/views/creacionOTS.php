<!-- ************************************MODULO PARA CREAR LAS OTHS ************************************************************** --> 
<h2>Creación de OT</h2>
<!-- ************************************ Boton para crear oth ************************************************************** -->
<a href="#" id="btn_new_ot" class="btn btn-success btn-sm btn_crear_oth"><span class="glyphicon glyphicon-plus"></span> Crear OT</a>
<!-- ************************************ tabla para crear oth ************************************************************** -->
<table id="oth_new_List" class="table table-hover table-bordered table-striped dataTable_camilo" style="width: 100%;">
   
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

</table>

<!-- ******************************** Inicio del modal para crear oth ******************************************************* -->

<div id="modal_new_ot" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
	<div class="modal-dialog modal-md">
	    <div class="modal-content">
	    	<!-- header del modal -->
	        <div class="modal-header cssnewtypem">
	            <button type="button" class="close cssicerrar" data-dismiss="modal" aria-label="Close"><img src="<?= URL::to('/assets/images/cerrar (7).png') ?>"></img></button>
				<h4 class="modal-title" id="mdl_title_new_type" align="center">Añadir Nuevo OT</h4>
	        </div>
	        <!-- fin header del modal -->
	        <!-- body inicio del modal -->
		    <div class="modal-body ">
		    	
		        <form class="well form-horizontal spc_modal_new_ot" id="mdl_form_new_oth" action="<?= URL::to("LoadInformation/create_ot") ?>"  method="post" >
					<h4>Nueva OTP</h4>
					<fieldset class="fielset_new_ot_mdl">
						
						<div class="form-group">
					        <label for="id_otp" class="col-md-3 control-label">OTP:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-braille" ></i></span>
					                <input name="id_otp" id="id_otp" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <div class="form-group">
					        <label for="nombre_cliente" class="col-md-3 control-label">Nombre Cliente:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
					                <input name="nombre_cliente" id="nombre_cliente" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <div class="form-group">
					        <label for="tipo_otp" class="col-md-3 control-label">Tipo OTP:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
					                <select class="form-control" id="tipo_otp" name="tipo_otp">
									    <option>Seleccionar...</option>
										<?php foreach ($tipos_otp as $tipo_otp): ?>
											<option value="<?= $tipo_otp->orden_trabajo ?>"><?= $tipo_otp->orden_trabajo ?></option>	
										<?php endforeach ?>
									</select>
					            </div>
					        </div>
					    </div>

					    <div class="form-group">
					        <label for="estado_otp" class="col-md-3 control-label">Estado OTP:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
					                <select class="form-control" id="estado_otp" name="estado_otp">
									    <option>Seleccionar...</option>
									    <?php foreach ($estados_otp as $estado_otp): ?>
									    	<option value="<?= $estado_otp->estado_orden_trabajo ?>"><?= $estado_otp->estado_orden_trabajo ?></option>
									    <?php endforeach ?>
									</select>
					            </div>
					        </div>
					    </div>

					    <div class="form-group">
			                <label for="fecha_programacion" class="col-md-3 control-label">Fecha Programación:</label>
			                <div class="col-md-8 selectContainer">
			                    <div class="input-group">
			                        <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
			                        <input name="fecha_programacion" id="fecha_programacion" class="form-control" type="date" required>
			                    </div>
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="fecha_compromiso" class="col-md-3 control-label">Fecha Compromiso:</label>
			                <div class="col-md-8 selectContainer">
			                    <div class="input-group">
			                        <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
			                        <input name="fecha_compromiso" id="fecha_compromiso" class="form-control" type="date" required>
			                    </div>
			                </div>
			            </div>

			            <div class="form-group">
					        <label for="ing_responsable" class="col-md-3 control-label">Ing. Responsable:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
					                <select class="form-control" id="ing_responsable" name="ing_responsable">
									    <option>Seleccionar...</option>
									    <?php foreach ($inenieros as $ingeniero): ?>
									    	<option value="<?= $ingeniero->k_id_user ?>"><?= $ingeniero->ingenieros ?></option>
									    <?php endforeach ?>
									</select>
					            </div>
					        </div>
					    </div>

					</fieldset>						
					<!-- SECCION PARA OTH -->
					<fieldset class="fielset_new_ot_mdl">
						<div class="form-group">
					        <label for="id_oth" class="col-md-3 control-label">OTH:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-braille" ></i></span>
					                <input name="id_oth" id="id_oth" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>
					  

					    <div class="form-group">
					        <label for="tipo_oth" class="col-md-3 control-label">Tipo OTH:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
					                <select class="form-control" id="tipo_oth" name="tipo_oth">
									    <option>Seleccionar...</option>
									    <?php foreach ($tipos_oth as $tipo_oth): ?>
									    	<option value="<?= $tipo_oth->n_name_tipo ?>"><?= $tipo_oth->n_name_tipo ?></option>
									    <?php endforeach ?>
									</select>
					            </div>
					        </div>
					    </div>

					    <div class="form-group">
					        <label for="estado_oth" class="col-md-3 control-label">Estado OTP:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
					                <select class="form-control" id="estado_oth" name="estado_oth">
									    <option>Seleccionar...</option>
									    
									</select>
					            </div>
					        </div>
					    </div>				    

				    </fieldset>
				</form>
			</div>
		    <!-- body fin del modal -->
	    </div>
	    <!-- footer del modal -->
	    <div class="modal-footer cssnewtypem">
			<button type="button" class="btn btn-default" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
			<button type="submit" class="btn btn-success" id="mdl_save_new_ot" form="mdl_form_new_oth"><i class='glyphicon glyphicon-send'></i>&nbsp;Guardar</button>
		</div>
	</div>
</div>

<!-- ******************************** Fin del modal para crear oth *******************************************************