<!-- ************************************MODULO PARA CREAR LAS OTHS ************************************************************** -->
<h2>Creación de OT</h2>
<!-- ************************************ Boton para crear oth ************************************************************** -->
<a href="#" id="btn_new_ot" class="btn btn-success btn-sm btn_crear_oth"><span class="glyphicon glyphicon-plus"></span> Crear OT</a>
<!-- ************************************ tabla para crear oth ************************************************************** -->
<table id="oth_new_List" class="table table-hover table-bordered table-striped dataTable_camilo" style="width: 100%;">
   	<thead>
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
        </tr>
    </thead>
</table>

<!-- ******************************** Inicio del modal para crear oth ******************************************************* -->

<div id="modal_new_ot" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
	<div class="modal-dialog modal-md">
	    <div class="modal-content">
	    	<!-- header del modal -->
	        <div class="modal-header cssnewtypem">
	            <button type="button" class="close cssicerrar" data-dismiss="modal" aria-label="Close"><img src="<?=URL::to('/assets/images/cerrar (7).png');?>"></img></button>
				<h4 class="modal-title" id="mdl_title_new_type" align="center">Añadir Nuevo OT</h4>
	        </div>
	        <!-- fin header del modal -->
	        <!-- body inicio del modal -->
		    <div class="modal-body ">

		        <form class="well form-horizontal spc_modal_new_ot" id="mdl_form_new_oth" action="<?=URL::to("LoadInformation/create_ot");?>"  method="post" >
					<h4>Nueva OTP</h4>
					<fieldset class="fielset_new_ot_mdl">

						<div class="form-group">
					        <label for="id_otp" class="col-md-3 control-label">OTP:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
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
									    <option value="">Seleccionar...</option>
										<?php foreach ($tipos_otp as $tipo_otp): ?>
											<option value="<?=$tipo_otp->orden_trabajo;?>"><?=$tipo_otp->orden_trabajo;?></option>
										<?php endforeach;?>
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
									    <option value="">Seleccionar...</option>
									    <?php foreach ($estados_otp as $estado_otp): ?>
									    	<option value="<?=$estado_otp->estado_orden_trabajo;?>"><?=$estado_otp->estado_orden_trabajo;?></option>
									    <?php endforeach;?>
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
					                <select class="form-control" id="ing_responsable" name="ing_responsable" required>
									    <option>Seleccionar...</option>
									    <?php foreach ($inenieros as $ingeniero): ?>
									    	<option value="<?=$ingeniero->k_id_user;?>"><?=$ingeniero->ingenieros;?></option>
									    <?php endforeach;?>
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
					                <input name="id_oth" id="id_oth" class="form-control" type="number" required>
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
									    	<option value="<?=$tipo_oth->n_name_tipo;?>"><?=$tipo_oth->n_name_tipo;?></option>
									    <?php endforeach;?>
									</select>
					            </div>
					        </div>
					    </div>

					    <div class="form-group">
					        <label for="estado_oth" class="col-md-3 control-label">Estado OTH:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
					                <select class="form-control" id="estado_oth" name="estado_oth" required>
									    <option value="">Seleccionar...</option>

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

<!-- ******************************** Fin del modal para crear oth *******************************************************-->

<script src="<?=URL::to("assets/plugins/sweetalert2/sweetalert2.all.js");?>"></script>
<?php

$msj = $this->session->flashdata('msj');
// $id_cc = $this->session->flashdata('id');
if ($msj) {
    if ($msj == 'ok') {?>
        <script>
            swal('Correcto',`realizado exitosamente`, 'success');
        </script>
<?php } else {?>
        <script>
            swal('Error',`Se generó un error en el proceso<br><?=$msj;?>`, 'error');
        </script>
<?php }
}
?>





<div id="modal_eliminar1" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
	<div class="modal-dialog modal-md">
	    <div class="modal-content">
	    	<!-- header del modal -->
	        <div class="modal-header cssnewtypem">
	            <button type="button" class="close cssicerrar" data-dismiss="modal" aria-label="Close"><img src="<?=URL::to('/assets/images/cerrar (7).png');?>"></img></button>
				<h4 class="modal-title" id="mdl_title_new_type" align="center">Añadir Nuevo OT</h4>
	        </div>
	        <!-- fin header del modal -->
	        <!-- body inicio del modal -->
		    <div class="modal-body ">

		        <form class="well form-horizontal spc_modal_new_ot" id="mdl_form_new_oth" action="<?=URL::to("LoadInformation/create_ot");?>"  method="post" >





<!-- SERVICIO DE INTERNET -->

		   <!-- Datos basicos de instalacion -->

					<fieldset class="fielset_new_ot_mdl">

						<!-- CIUDAD -->
						<div class="form-group">
					        <label for="ciudad" class="col-md-3 control-label">Ciudad:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="ciudad" id="ciudad" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- DIRECCIÓN: Especificar barrio, piso u oficina -->
					    <div class="form-group">
					        <label for="direccion" class="col-md-3 control-label">Dirección:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="direccion" id="direccion" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TIPO PREDIO: -->
					     <div class="form-group">
					        <label for="tipo_predio" class="col-md-3 control-label">Tipo predio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
					                <select class="form-control" id="tipo_predio" name="tipo_predio">
									    <option>Seleccionar...</option>
									    <option>Edificio</option>
      									<option>Casa</option>

									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NIT del cliente: -->
					    <div class="form-group">
					        <label for="nit_cliente" class="col-md-3 control-label">NIT cliente:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
					                <input name="nit_cliente" id="nit_cliente" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- ALIAS DEL LUGAR (CODIGO DE SERVICIO//CIUDAD//SERVICIO//COMERCIO O SEDE DEL CLIENTE) -->

					    <div class="form-group">
					        <label for="alias_lugar" class="col-md-3 control-label">Alias del lugar:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="alias_lugar" id="alias_lugar" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- OTP -->
						<div class="form-group">
					        <label for="OTP" class="col-md-3 control-label">OTP:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="OTP" id="OTP" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					     <!-- otp_asociadas -->
						<div class="form-group">
					        <label for="otp_asociadas" class="col-md-3 control-label">OTPasociadas:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="otp_asociadas" id="otp_asociadas" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TIPO INTERNET: -->
					     <div class="form-group">
					        <label for="tipo_internet" class="col-md-3 control-label">Tipo internet:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_internet" name="tipo_internet">
									    <option>Seleccionar...</option>
									    <option>INTERNET DEDICADO (Solución Diferenciación de tráfico (Internet / NAP))</option>
      									<option>INTERNET DEDICADO (VLR AGRE -Monitoreo CPE (Gestion Proactiva))</option>
      									<option>INTERNET DEDICADO ADMINISTRADO (VLR AGRE -Monitoreo CPE (Gestion Proactiva))</option>
      									<option>INTERNET EMPRESARIAL</option>
      									<option>INTERNET BANDA ANCHA (Solución FO)</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- ancho_banda -->
						<div class="form-group">
					        <label for="ancho_banda" class="col-md-3 control-label">Ancho de banda:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TIPO INSTALACION: -->
					     <div class="form-group">
					        <label for="tipo_internet" class="col-md-3 control-label">Tipo instalación:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_internet" name="tipo_internet">
									    <option>Seleccionar...</option>
									    <option>Instalar UM con PE</option>
      									<option>Instalar UM con PE sobre OTP de Pymes</option>
      									<option>Instalar UM con CT (No aplica para Internet Dedicado Empresarial)</option>
      									<option>Instalar UM en Datacenter Claro- Implementación</option>
      									<option>UM existente. Requiere Cambio de equipo</option>
      									<option>UM existente. Requiere Adición de equipo</option>
      									<option>UM existente. Solo configuración</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- ID SERVICIO ACTUAL (Aplica para UM Existente) -->
						<div class="form-group">
					        <label for="tipo_instalacion" class="col-md-3 control-label">ID servicio Actual:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="tipo_instalacion" id="tipo_instalacion" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

			<!-- SESION NUMERO 2: INFORMACIÓN  ULTIMA MILLA -->

						<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
					     <div class="form-group">
					        <label for="requiere_instalacion_um" class="col-md-3 control-label">Requiere instalación UM:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_instalacion_um" name="requiere_instalacion_um">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
      									<option>Existente</option>
									</select>
					            </div>
					        </div>
					    </div>

					     <!-- PROVEEDOR: -->
					     <div class="form-group">
					        <label for="proveedor_milla" class="col-md-3 control-label">Proveedor:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="proveedor_milla" name="proveedor_milla">
									    <option>Seleccionar...</option>
									    <option>No aplica</option>
      									<option>Existente</option>
      									<option>Claro</option>
      									<option>Axesat</option>
      									<option>Comcel</option>
      									<option>Tigo</option>
      									<option>Media Commerce</option>
      									<option>Diveo</option>
      									<option>Edatel</option>
      									<option>UNE</option>
      									<option>ETB</option>
      									<option>IBM</option>
      									<option>IFX</option>
      									<option>Level 3 Colombia</option>
      									<option>Mercanet</option>
      									<option>Metrotel</option>
      									<option>Promitel</option>
      									<option>Skynet</option>
      									<option>Telebucaramanga</option>
      									<option>Telecom</option>
      									<option>Terremark</option>
      									<option>Sol Cable Vision</option>
      									<option>Sistelec</option>
      									<option>Opain</option>
      									<option>Airplan - (Información y Tecnologia)</option>
      									<option>TV Azteca</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- MEDIO -->
					    <div class="form-group">
					        <label for="medio_um" class="col-md-3 control-label">Medio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="medio_um" name="medio_um">
									    <option>Seleccionar...</option>
									    <option>No Aplica</option>
									    <option>Existente</option>
									    <option>Fibra</option>
									    <option>Cobre</option>
									    <option>Satelital</option>
									    <option>Radio enlace</option>
									    <option>3G</option>
									    <option>UTP</option>
									</select>
					            </div>
					        </div>
					    </div>


			            <!-- RESPUESTA FACTIBILIDAD BW > =100 MEGAS : -->
			            <div class="form-group">
					        <label for="respuesta_factibilidad" class="col-md-3 control-label">Respuesta factibilidad BW >= 100 MEGAS:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="respuesta_factibilidad" id="respuesta_factibilidad" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

			            <!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
					    <div class="form-group">
					        <label for="tipo_conector" class="col-md-3 control-label">Tipo conector:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_conector" name="tipo_conector">
									    <option>Seleccionar...</option>
									    <option>LC</option>
									    <option>SC</option>
									    <option>ST</option>
									    <option>FC</option>
									</select>
					            </div>
					        </div>
					    </div>

				<!-- 2.ACCESO (Solo Aplica para Canales > = 100 MEGAS   ======= -->

			            <!-- SDS DESTINO (Unifilar): -->
			            <div class="form-group">
					        <label for="sds_destino" class="col-md-3 control-label">SDS destino(unifiliar):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="sds_destino" id="sds_destino" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>


			            <!-- OLT (GPON): -->
			            <div class="form-group">
					        <label for="olt_gpon" class="col-md-3 control-label">OLT(GPON):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="olt_gpon" id="olt_gpon" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

			            <!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
			            <div class="form-group">
			                <label for="tipo_conector" class="col-md-3 control-label">Tipo conector (FO):</label>
			                <div class="col-md-8 selectContainer">
			                    <div class="input-group">
			                        <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_conector" name="tipo_conector">
									    <option>Seleccionar...</option>
									    <option>LC</option>
									    <option>SC</option>
									    <option>ST</option>
									    <option>FC</option>
									</select>
			                    </div>
			                </div>
			            </div>

			            <!-- INTERFACE DE ENTREGA AL CLIENTE: -->
			            <div class="form-group">
			                <label for="interface_entrega_cliente" class="col-md-3 control-label">Interface entrega al cliente:</label>
			                <div class="col-md-8 selectContainer">
			                    <div class="input-group">
			                        <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="interface_entrega_cliente" name="interface_entrega_cliente">
									    <option>Seleccionar...</option>
									    <option>No aplica</option>
									    <option>Ethernet</option>
									    <option>Serial V.35</option>
									    <option>Giga (óptico)</option>
									    <option>Giga Ethernet (Electrico)</option>
									    <option>STM-1</option>
									    <option>RJ45 - 120 OHM</option>
									    <option>G703 BNC</option>
									</select>
			                    </div>
			                </div>
			            </div>

			            <!-- REQUIERE VOC : -->
					     <div class="form-group">
					        <label for="requiere_voc" class="col-md-3 control-label">Requiere VOC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_voc" name="requiere_voc">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
      									<option>No aplica</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- PROGRAMACIÓN DE VOC : -->
					     <div class="form-group">
					        <label for="programacion_voc" class="col-md-3 control-label">Programación de VOC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="programacion_voc" name="programacion_voc">
									    <option>Seleccionar...</option>
									    <option>Programada</option>
      									<option>No requiere programación</option>
      									<option>No programada. Otra ciudad</option>
      									<option>No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
									</select>
					            </div>
					        </div>
					    </div>

		<!-- SESION NUMERO 3: REQUERIMIENTOS PARA ENTREGA DEL SERVICIO -->

						<!-- REQUIERE RFC : -->
					     <div class="form-group">
					        <label for="requiere_rfc" class="col-md-3 control-label">Requiere RFC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_rfc" name="requiere_rfc">
									    <option>Seleccionar...</option>
									    <option>SI => Cliente Critico Punto Central</option>
      									<option>SI => Servicio Critico (Listado)</option>
      									<option>SI => Cliente Critico</option>
      									<option>SI => RFC Estándar Saturación</option>
      									<option>SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

				<!-- EQUIPOS   (VER LISTA COMPLETA): -->

						<!-- Conversor Medio: -->
			            <div class="form-group">
					        <label for="conversor_medio" class="col-md-3 control-label">Conversor Medio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="conversor_medio" id="conversor_medio" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Referencia Router: -->
			            <div class="form-group">
					        <label for="referencia_router" class="col-md-3 control-label">Referencia Router:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="referencia_router" id="referencia_router" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Modulos o Tarjetas: -->
			            <div class="form-group">
					        <label for="modulo_o_tarjeta" class="col-md-3 control-label">Modulos o Tarjetas:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="modulo_o_tarjeta" id="modulo_o_tarjeta" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					   	<!-- Licencias -->
					    <div class="form-group">
					        <label for="licencias" class="col-md-3 control-label">Licencias:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="licencias" id="licencias" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Equipos Adicionale-->
					    <div class="form-group">
					        <label for="equipos_adicionales" class="col-md-3 control-label">Equipos adicionale:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="equipos_adicionales" id="equipos_adicionales" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Consumibles-->
					    <div class="form-group">
					        <label for="consumibles" class="col-md-3 control-label">Consumibles:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="consumibles" id="consumibles" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
					     <div class="form-group">
					        <label for="registro_importacion_carta" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="registro_importacion_carta" name="registro_importacion_carta">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>
		<!-- sesion 3:   DATOS DEL CONTACTO PARA COMUNICACIÓN  -->

						<h5>APRUEBA COSTOS DE OC E INICIO DE FACTURACIÓN DE ORDEN DE TRABAJO</h5>

						<!-- NOMBRE -->
					    <div class="form-group">
					        <label for="nombre_dcc" class="col-md-3 control-label">Nombre:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="nombre_dcc" id="nombre_dcc" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TELEFONO -->
					    <div class="form-group">
					        <label for="telefono_dcc" class="col-md-3 control-label">Telefono:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="telefono_dcc" id="telefono_dcc" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- CELULAR -->
					    <div class="form-group">
					        <label for="celular_dcc" class="col-md-3 control-label">Celular:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="celular_dcc" id="celular_dcc" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- EMAIL -->
					    <div class="form-group">
					        <label for="email_dcc" class="col-md-3 control-label">Email:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="email_dcc" id="email_dcc" class="form-control" type="email" >
					            </div>
					        </div>
					    </div>


					   	<h5>DATOS CONTACTO TÉCNICO</h5>

					   	<!-- NOMBRE -->
					    <div class="form-group">
					        <label for="nombre_dct" class="col-md-3 control-label">Nombre:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="nombre_dct" id="nombre_dct" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TELEFONO -->
					    <div class="form-group">
					        <label for="telefono_dct" class="col-md-3 control-label">Telefono:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="telefono_dct" id="telefono_dct" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- CELULAR -->
					    <div class="form-group">
					        <label for="celular_dct" class="col-md-3 control-label">Celular:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="celular_dct" id="celular_dct" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- EMAIL -->
					    <div class="form-group">
					        <label for="email_dct" class="col-md-3 control-label">Email:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="email_dct" id="email_dct" class="form-control" type="email" >
					            </div>
					        </div>
					    </div>

					    <!-- OBSERVACIONES: LA UM SE ESTA ENTREGANDO SOBRE OT DE TELEFONIA 9722208 -->
					    <div class="form-group">
					        <label for="observaciones_dct" class="col-md-3 control-label">Observaciones:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="observaciones_dct" id="observaciones_dct" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>
		<!-- sesion 4:   KIKOFF TECNICO  -->

						<!-- Ancho de banda Exclusivo NAP  -->
					    <div class="form-group">
					        <label for="ancho_banda_nap" class="col-md-3 control-label">Ancho de banda Exclusivo NAP :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="ancho_banda_nap" id="ancho_banda_nap" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- Ancho de banda de Internet  -->
					    <div class="form-group">
					        <label for="ancho_banda_internet" class="col-md-3 control-label">Ancho de banda de Internet:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="ancho_banda_internet" id="ancho_banda_internet" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- Direcciones IP : -->
					     <div class="form-group">
					        <label for="direccion_ip" class="col-md-3 control-label">Direcciones IP:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="direccion_ip" name="direccion_ip">
									    <option>Seleccionar...</option>
									    <option>Cantidad IPs: 2 - Mascara: /30</option>
      									<option>Cantidad IPs 6 - Mascara: /29</option>
      									<option>Cantidad IPs 14 - Mascara: /28 - Requiere Viabilidad Preventa</option>
      									<option>Cantidad Ips: 30 - Mascara: /27 - Requiere Viabilidad Preventa</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- Activación correo -->
					     <div class="form-group">
					        <label for="activacion_correo" class="col-md-3 control-label">Activación correo:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="activacion_correo" name="activacion_correo">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- Activación WEB Hosting -->
					     <div class="form-group">
					        <label for="activacion_hosting" class="col-md-3 control-label">Activación WEB Hosting:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="activacion_hosting" name="activacion_hosting">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- Dominio existente -->
					     <div class="form-group">
					        <label for="Dominio_existente" class="col-md-3 control-label">Dominio existente:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="Dominio_existente" name="Dominio_existente">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- Dominio a comprar -->
					    <div class="form-group">
					        <label for="dominio_a_comprar" class="col-md-3 control-label">Dominio a comprar:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="dominio_a_comprar" id="dominio_a_comprar" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- Cantidad cuentas de correo-->
					     <div class="form-group">
					        <label for="cantidad_cuentas_correo" class="col-md-3 control-label">Cantidad cuentas de correo:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="cantidad_cuentas_correo" name="cantidad_cuentas_correo">
									    <option>Seleccionar...</option>
									    <option>20</option>
      									<option>40</option>
      									<option>140</option>
      									<option>160</option>
      									<option>200</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- Espacio de correo (GB)-->
					     <div class="form-group">
					        <label for="espacio_correo_gb" class="col-md-3 control-label">Espacio de correo (GB) :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="espacio_correo_gb" name="espacio_correo_gb">
									    <option>Seleccionar...</option>
									    <option>2</option>
      									<option>4</option>
      									<option>14</option>
      									<option>16</option>
      									<option>20</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- Plataforma de WEBHosting :-->
					     <div class="form-group">
					        <label for="pataforma_web_hosting" class="col-md-3 control-label">Plataforma de WEB Hosting ::</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="pataforma_web_hosting" name="pataforma_web_hosting">
									    <option>Seleccionar...</option>
									    <option>Windows</option>
      									<option>Solaris</option>
      									<option>NA</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- WEB Hosting (MB)-->
					    <div class="form-group">
					        <label for="web_hosting_mb" class="col-md-3 control-label">WEB Hosting (MB):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="web_hosting_mb" name="web_hosting_mb">
									    <option>Seleccionar...</option>
									    <option>20</option>
      									<option>40</option>
      									<option>140</option>
      									<option>160</option>
      									<option>200</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- APLICA A ALGUNA PROMOCION VIGENTE (POR FAVOR DOCUMENTAR  NOMBRE DE LA PROMOCION) : -->
					    <div class="form-group">
					        <label for="promocion_vigente_nom" class="col-md-3 control-label">Aplica alguna promocion vigente (nombre promocion):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="promocion_vigente_nom" id="promocion_vigente_nom" class="form-control" type="number" >
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
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
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
									    	<option value="<?=$tipo_oth->n_name_tipo;?>"><?=$tipo_oth->n_name_tipo;?></option>
									    <?php endforeach;?>
									</select>
					            </div>
					        </div>
					    </div>

					    <div class="form-group">
					        <label for="estado_oth" class="col-md-3 control-label">Estado OTH:</label>
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

