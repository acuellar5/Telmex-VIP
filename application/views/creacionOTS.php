<!-- ************************************MODULO PARA CREAR LAS OTHS ************************************************************** --> 
<h2>Creación de OT</h2>
<!-- ************************************ Boton para crear oth ************************************************************** -->
<a href="#" id="btn_new_ot" class="btn btn-success btn-sm btn_crear_oth"><span class="glyphicon glyphicon-plus"></span> Crear OT</a>
<!-- ************************************ tabla para crear oth ************************************************************** -->

<!-- ************************************ ELIMINAR EL SIGUIENTE BOTON ES DE PRUEBA ************************************************************** -->
<a href="#" id="boton_eliminar" class="btn btn-success btn-sm btn_crear_oth"><span class="glyphicon glyphicon-plus"></span> eliminar BTN</a>
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
									    <option value="">Seleccionar...</option>
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

<!-- ******************************** Fin del modal para crear oth *******************************************************-->

<script src="<?= URL::to("assets/plugins/sweetalert2/sweetalert2.all.js") ?>"></script>
<?php 
    $msj = $this->session->flashdata('msj');
    // $id_cc = $this->session->flashdata('id');
if ($msj) {
    if ($msj == 'ok') {  ?>
        <script>
            swal('Correcto',`realizado exitosamente`, 'success');
        </script>
<?php } 

else {  ?>
        <script>
            swal('Error',`Se generó un error en el proceso<br><?= $msj ?>`, 'error');
        </script>
<?php } 
}
?>












<!-- 
ELIMINAR MODAL ES DE PRUEBA
 -->



<div id="modal_eliminar1" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
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
									    	<option value="<?= $tipo_oth->n_name_tipo ?>"><?= $tipo_oth->n_name_tipo ?></option>
									    <?php endforeach ?>
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

<!-- 3333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333  -->


<div id="modal_eliminar2" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
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





<!-- TELEFONIA FIJA -->
		   
		   <!-- SERVICIOS DE TELEFONIA FIJA -->

					<fieldset class="fielset_new_ot_mdl">
						<h5>DATOS BÁSICOS DE INSTALACION</h5>

						<!-- CIUDAD -->
						<div class="form-group">
					        <label for="ciudad_tf" class="col-md-3 control-label">Ciudad:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="ciudad_tf" id="ciudad_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- DIRECCIÓN -->
					    <div class="form-group">
					        <label for="direccion_tf" class="col-md-3 control-label">Dirección:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="direccion_tf" id="direccion_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TIPO PREDIO: -->
					     <div class="form-group">
					        <label for="tipo_predio_tf" class="col-md-3 control-label">Tipo predio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
					                <select class="form-control" id="tipo_predio_tf" name="tipo_predio_tf">
									    <option>Seleccionar...</option>
									    <option>Edificio</option>
      									<option>Casa</option>
									    
									</select>
					            </div>
					        </div>
					    </div>	

					    <!-- NIT del cliente: -->
					    <div class="form-group">
					        <label for="nit_cliente_tf" class="col-md-3 control-label">NIT cliente:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
					                <input name="nit_cliente_tf" id="nit_cliente_tf" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- ALIAS DEL LUGAR (CODIGO DE SERVICIO//CIUDAD//SERVICIO//COMERCIO O SEDE DEL CLIENTE) -->

					    <div class="form-group">
					        <label for="alias_lugar_tf" class="col-md-3 control-label">Alias del lugar:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="alias_lugar_tf" id="alias_lugar_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- OTP -->
						<div class="form-group">
					        <label for="otp_tf" class="col-md-3 control-label">OTP:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="otp_tf" id="otp_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					     <!-- otp_asociadas -->
						<div class="form-group">
					        <label for="otp_asociadas_tf" class="col-md-3 control-label">OTP asociadas:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="otp_asociadas_tf" id="otp_asociadas_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TIPO DE TELEFONIA FIJA: -->
					     <div class="form-group">
					        <label for="tipo_telefonia_fija_tf" class="col-md-3 control-label">Tipo telefonia fija:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_telefonia_fija_tf" name="tipo_telefonia_fija_tf">
									    <option>Seleccionar...</option>
									    <option>Telefonia Pública - Líneas Análogas</option>
      									<option>Telefonia Pública - Líneas E1 - R2</option>
      									<option>Telefonia Pública - Líneas E1 - PRI</option>
      									<option>Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
      									<option>Telefonia Pública - Línea SIP (Centralizado)</option> 		
      									<option>PBX Distribuida - Línea SIP  (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
      									<option>PBX Distribuida - Línea SIP  (Centralizado)</option> 		
      									<option>PBX Distribuida  Linea E1 -R2</option> 		
      									<option>PBX Distribuida  Linea E1 -PRI</option>
      									<option>Telefonia Corporativa</option> 								    
									</select>
					            </div>
					        </div>
					    </div>	

					    <!-- ancho_banda -->
						<div class="form-group">
					        <label for="ancho_banda_tf" class="col-md-3 control-label">Ancho de banda:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="ancho_banda_tf" id="ancho_banda_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>		

					    <!-- TIPO INSTALACION: -->
					     <div class="form-group">
					        <label for="tipo_instalacion_tf" class="col-md-3 control-label">Tipo instalación:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_instalacion_tf" name="tipo_instalacion_tf">
									    <option>Seleccionar...</option>
									    <option>Instalar UM con PE</option>
      									<option>Instalar UM con PE sobre OTP de Pymes</option>
      									<option>Instalar UM con CT (Solo Acceso Fibra)</option>
      									<option>Instalar UM en Datacenter Claro- Cableado</option>
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
					        <label for="id_servicio_actual_tf" class="col-md-3 control-label">ID servicio Actual(Aplica para UM Existente):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="id_servicio_actual_tf" id="id_servicio_actual_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

			<!-- SESION NUMERO 2: INFORMACIÓN  ULTIMA MILLA -->
						<h5>INFORMACIÓN  ULTIMA MILLA</h5>
						<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
					     <div class="form-group">
					        <label for="requiere_instalacion_um_tf" class="col-md-3 control-label">Requiere instalación UM:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_instalacion_um_tf" name="requiere_instalacion_um_tf">
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
					        <label for="proveedor_milla_tf" class="col-md-3 control-label">Proveedor:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="proveedor_milla_tf" name="proveedor_milla_tf">
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
					        <label for="medio_um_tf" class="col-md-3 control-label">Medio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="medio_um_tf" name="medio_um_tf">
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

					    <!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
					    <div class="form-group">
					        <label for="tipo_conector_fo_tf" class="col-md-3 control-label">Tipo conector (Aplica para FO Claro):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_conector_fo_tf" name="tipo_conector_fo_tf">
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
					        <label for="interface_entrega_cliente_tf" class="col-md-3 control-label">Interface de entrega al cliente:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="interface_entrega_cliente_tf" name="interface_entrega_cliente_tf">
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

					    <!-- REQUIERE VOC: -->
					    <div class="form-group">
					        <label for="requiere_voc_tf" class="col-md-3 control-label">Requiere VOC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_voc_tf" name="requiere_voc_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>  									   									
									    <option>No</option> 	   
									    
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- PROGRAMACIÓN DE VOC: -->
					    <div class="form-group">
					        <label for="programacion_voc_tf" class="col-md-3 control-label">Programación de VOC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="programacion_voc_tf" name="programacion_voc_tf">
									    <option>Seleccionar...</option>
									    <option>Programada</option>  									   									
									    <option>No requiere programación</option> 	   
									    <option>No programada. Otra ciudad</option>
									    <option>No programada. Cliente solicita ser contactado en fecha </option> 	 
									    
									</select>
					            </div>
					        </div>
					    </div>
				
		<!-- SESION NUMERO 2: REQUERIMIENTOS PARA ENTREGA DEL SERVICIO -->
						<h5>REQUERIMIENTOS PARA ENTREGA DEL SERVICIO </h5>
						<!-- REQUIERE RFC : -->
					     <div class="form-group">
					        <label for="requiere_rfc_tf" class="col-md-3 control-label">Requiere RFC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_rfc_tf" name="requiere_rfc_tf">
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

				<!-- EQUIPOS : -->
						<h4>Equipos</h4>
						<!-- Conversor Medio: -->
			            <div class="form-group">
					        <label for="conversor_medio_tf" class="col-md-3 control-label">Conversor Medio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="conversor_medio_tf" id="conversor_medio_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Referencia Router: -->
			            <div class="form-group">
					        <label for="referencia_router_tf" class="col-md-3 control-label">Referencia Router:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="referencia_router_tf" id="referencia_router_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Modulos o Tarjetas: -->
			            <div class="form-group">
					        <label for="modulo_o_tarjeta_tf" class="col-md-3 control-label">Modulos o Tarjetas:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="modulo_o_tarjeta_tf" id="modulo_o_tarjeta_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					   	<!-- Licencias --> 
					    <div class="form-group">
					        <label for="licencias_tf" class="col-md-3 control-label">Licencias:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="licencias_tf" id="licencias_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Equipos Adicionale--> 
					    <div class="form-group">
					        <label for="equipos_adicionales_tf" class="col-md-3 control-label">Equipos adicionale:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="equipos_adicionales_tf" id="equipos_adicionales_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Consumibles--> 
					    <div class="form-group">
					        <label for="Consumibles_tf" class="col-md-3 control-label">Consumibles:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="Consumibles_tf" name="Consumibles_tf">
									    <option>Seleccionar...</option>
									    <option>Bandeja</option>
      									<option>Cables de poder</option>
      									<option>Clavijas de conexión</option>
      									<option>Accesorios para rackear (Orejas)</option>
      									<option>Balum</option>
      									<option>No aplica</option>
									</select>
					            </div>
					        </div>
					    </div

					    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
					     <div class="form-group">
					        <label for="registro_importacion_carta_tf" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="registro_importacion_carta_tf" name="registro_importacion_carta_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					     <!-- DATOS DEL CONTACTO PARA COMUNICACIÓN  -->
		<!-- sesion 3:   DATOS DEL CONTACTO PARA COMUNICACIÓN  -->

						<h5>APRUEBA COSTOS DE OC Y CIERRE DE ORDEN DE TRABAJO</h5>
						
						<!-- NOMBRE --> 
					    <div class="form-group">
					        <label for="nombre_cot_tf" class="col-md-3 control-label">Nombre:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="nombre_cot_tf" id="nombre_cot_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TELEFONO --> 
					    <div class="form-group">
					        <label for="telefono_cot_tf" class="col-md-3 control-label">Telefono:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="telefono_cot_tf" id="telefono_cot_tf" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- CELULAR --> 
					    <div class="form-group">
					        <label for="celular_cot_tf" class="col-md-3 control-label">Celular:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="celular_cot_tf" id="celular_cot_tf" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- EMAIL --> 
					    <div class="form-group">
					        <label for="email_cot_tf" class="col-md-3 control-label">Email:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="email_cot_tf" id="email_cot_tf" class="form-control" type="email" >
					            </div>
					        </div>
					    </div>

			<!-- DATOS CLIENTE: TÉCNICO -->
					   	<h5>DATOS CLIENTE: TÉCNICO</h5>

					   	<!-- NOMBRE --> 
					    <div class="form-group">
					        <label for="nombre_dct_tf" class="col-md-3 control-label">Nombre:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="nombre_dct_tf" id="nombre_dct_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TELEFONO --> 
					    <div class="form-group">
					        <label for="telefono_dct_tf" class="col-md-3 control-label">Telefono:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="telefono_dct_tf" id="telefono_dct_tf" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- CELULAR --> 
					    <div class="form-group">
					        <label for="celular_dct_tf" class="col-md-3 control-label">Celular:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="celular_dct_tf" id="celular_dct_tf" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- EMAIL --> 
					    <div class="form-group">
					        <label for="email_dct_tf" class="col-md-3 control-label">Email:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="email_dct_tf" id="email_dct_tf" class="form-control" type="email" >
					            </div>
					        </div>
					    </div>

					    <!-- OBSERVACIONES:  --> 
					    <div class="form-group">
					        <label for="observaciones_dct_tf" class="col-md-3 control-label">Observaciones:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="observaciones_dct_tf" id="observaciones_dct_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>
		
		<!-- sesion :   KIKOFF TECNICO  -->
						
						<h4>KIKOFF TECNICO</h4>
						<!-- Activación de PLAN LD CON COSTO (0 $): -->
					    <div class="form-group">
					        <label for="activacion_plan_ld_tf" class="col-md-3 control-label">Activación de PLAN LD CON COSTO (0 $):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="activacion_plan_ld_tf" name="activacion_plan_ld_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

						<!-- Equipo Cliente: -->
					     <div class="form-group">
					        <label for="equipo_cliente_tf" class="col-md-3 control-label">Equipo Cliente ::</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="equipo_cliente_tf" name="equipo_cliente_tf">
									    <option>Seleccionar...</option>
									    <option>Teléfonos analogos</option>
      									<option>Planta E1</option>
      									<option>Planta IP</option>
									</select>
					            </div>
					        </div>
					    </div>


					    <!-- Interfaz Equipos Cliente: -->
					     <div class="form-group">
					        <label for="interfaz_equipo_cliente_tf" class="col-md-3 control-label">Interfaz Equipos Cliente:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="interfaz_equipo_cliente_tf" name="interfaz_equipo_cliente_tf">
									    <option>Seleccionar...</option>
									    <option>FXS</option>
      									<option>RJ11</option>
      									<option>RJ45</option>
      									<option>RJ48</option>
      									<option>BNC </option>	
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- Cantidad Lineas Básicas (Solo Telefonia Pública Líneas Análogas):  --> 
					    <div class="form-group">
					        <label for="cantidad_lineas_tf" class="col-md-3 control-label">Cantidad Lineas Básicas (Solo Telefonia Pública Líneas Análogas):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="cantidad_lineas_tf" id="cantidad_lineas_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>
					    
					    <!-- Conformación PBX (Solo Telefonia Pública Líneas Análogas)  --> 
					    <div class="form-group">
					        <label for="conformacion_pbx_tf" class="col-md-3 control-label">Conformación PBX (Solo Telefonia Pública Líneas Análogas):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="conformacion_pbx_tf" id="conformacion_pbx_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>


					    <!-- Cantidad de DID Solicitados  --> 
					    <div class="form-group">
					        <label for="cantidad_did_tf" class="col-md-3 control-label">Cantidad de DID Solicitados:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="cantidad_did_tf" id="cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Cantidad Canales: -->
					    <div class="form-group">
					        <label for="cantidad_canales_tf" class="col-md-3 control-label">Cantidad Canales:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="cantidad_canales_tf" id="cantidad_canales_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Numero Cabecera PBX: -->
					    <div class="form-group">
					        <label for="numero_cabecera_pbs_tf" class="col-md-3 control-label">Numero Cabecera PBX:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="numero_cabecera_pbs_tf" name="numero_cabecera_pbs_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- FAX TO MAIL: -->
					    <div class="form-group">
					        <label for="fax_mail_tf" class="col-md-3 control-label">Fax to mail:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="fax_mail_tf" name="fax_mail_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- TELEFONO VIRTUAL: -->
					    <div class="form-group">
					        <label for="telefono_virtual_tf" class="col-md-3 control-label">Telefono virtual:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="telefono_virtual_tf" name="telefono_virtual_tf">
									    <option>Seleccionar...</option>
									    <option>SI (SOLICITAR LICENCIA A LIDER TECNICO GRUPO ASE)</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- Requiere Permisos para Larga Distancia Nacional:: -->
					    <div class="form-group">
					        <label for="permisos_larga_distancia_tf" class="col-md-3 control-label">Requiere Permisos para Larga Distancia Nacional:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="permisos_larga_distancia_tf" name="permisos_larga_distancia_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
      									<option>No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- Requiero Larga  Para Distancia  Internacional: -->
					    <div class="form-group">
					        <label for="larga_distancia_internacional_tf" class="col-md-3 control-label">Requiero Larga  Para Distancia  Internacional:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="larga_distancia_internacional_tf" name="larga_distancia_internacional_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
      									<option>No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
									</select>
					            </div>
					        </div>
					    </div>


					    <!-- Requiere Permisos para Móviles:-->
					    <div class="form-group">
					        <label for="permisos_moviles_tf" class="col-md-3 control-label">Requiere Permisos para Móviles:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="permisos_moviles_tf" name="permisos_moviles_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
      									<option>No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- Requiere Permisos para Local Extendida: -->
					    <div class="form-group">
					        <label for="requiere_permiso_extendida_tf" class="col-md-3 control-label">Requiere Permisos para Local Extendida:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_permiso_extendida_tf" name="requiere_permiso_extendida_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
      									<option>No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN SOLO DILIGENCIAR PARA LA OPCIÓN  PBX -->
					    <h4>NUMERACIÓN SOLO DILIGENCIAR PARA LA OPCIÓN  PBX</h4>
					    <h5>Ciudad: Bogotá</h5>

					    <!-- Bogota: -->
					    <div class="form-group">
					        <label for="bogota_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="bogota_tf" name="bogota_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="bogota_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="bogota_numeracion_tab_tf" name="bogota_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="bogota_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="bogota_cantidad_did_tf" id="bogota_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TUNJA -->

					    <h5>Ciudad: Tunja</h5>

					    <div class="form-group">
					        <label for="tunja_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tunja_tf" name="tunja_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="tunja_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tunja_numeracion_tab_tf" name="tunja_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="tunja_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="tunja_cantidad_did_tf" id="tunja_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>


					    <!-- Villavicencio -->

					    <h5>Ciudad: Villavicencio</h5>

		
					    <div class="form-group">
					        <label for="Villavicencio_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="Villavicencio_tf" name="Villavicencio_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="Villavicencio_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="Villavicencio_numeracion_tab_tf" name="Villavicencio_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="Villavicencio_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="Villavicencio_cantidad_did_tf" id="Villavicencio_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>


					     <!-- Facatativa -->

					    <h5>Ciudad: Facatativa</h5>

					    <div class="form-group">
					        <label for="facatativa_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="facatativa_tf" name="facatativa_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="facatativa_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="facatativa_numeracion_tab_tf" name="facatativa_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="facatativa_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="facatativa_cantidad_did_tf" id="facatativa_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>


					     <!-- Girardot -->

					    <h5>Ciudad: Girardot</h5>

					    <div class="form-group">
					        <label for="girardot_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="girardot_tf" name="girardot_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="girardot_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="girardot_numeracion_tab_tf" name="girardot_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="girardot_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="girardot_cantidad_did_tf" id="girardot_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

	    				<!-- Yopal -->

					    <h5>Ciudad: Yopal</h5>

					    <div class="form-group">
					        <label for="yopal_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="yopal_tf" name="yopal_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="yopal_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="yopal_numeracion_tab_tf" name="yopal_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="yopal_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="yopal_cantidad_did_tf" id="yopal_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Cali -->

					    <h5>Ciudad: Cali</h5>

					    <div class="form-group">
					        <label for="cali_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="cali_tf" name="cali_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="cali_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="cali_numeracion_tab_tf" name="cali_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="cali_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="cali_cantidad_did_tf" id="cali_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Buenaventura -->

					    <h5>Ciudad: Buenaventura</h5>

					    <div class="form-group">
					        <label for="buenaventura_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="buenaventura_tf" name="buenaventura_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="buenaventura_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="buenaventura_numeracion_tab_tf" name="buenaventura_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="buenaventura_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="buenaventura_cantidad_did_tf" id="buenaventura_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					     <!-- Pasto -->

					    <h5>Ciudad: Pasto</h5>

					    <div class="form-group">
					        <label for="pasto_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="pasto_tf" name="pasto_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="pasto_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="pasto_numeracion_tab_tf" name="pasto_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="pasto_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pasto_cantidad_did_tf" id="pasto_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Popayán -->

					    <h5>Ciudad: Popayán</h5>

					    <div class="form-group">
					        <label for="popayan_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="popayan_tf" name="popayan_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="popayan_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="popayan_numeracion_tab_tf" name="popayan_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="popayan_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="popayan_cantidad_did_tf" id="popayan_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Neiva -->

					    <h5>Ciudad: Neiva</h5>

					    <div class="form-group">
					        <label for="neiva_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="neiva_tf" name="neiva_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="neiva_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="neiva_numeracion_tab_tf" name="neiva_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="neiva_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="neiva_cantidad_did_tf" id="neiva_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Medellín -->

					    <h5>Ciudad: Medellín</h5>

					    <div class="form-group">
					        <label for="medellin_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="medellin_tf" name="medellin_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="medellin_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="medellin_numeracion_tab_tf" name="medellin_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="medellin_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="medellin_cantidad_did_tf" id="medellin_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>


					    <!-- Barranquilla -->

					    <h5>Ciudad: Barranquilla</h5>

					    <div class="form-group">
					        <label for="barranquilla_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="barranquilla_tf" name="barranquilla_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="barranquilla_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="barranquilla_numeracion_tab_tf" name="barranquilla_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="barranquilla_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="barranquilla_cantidad_did_tf" id="barranquilla_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Cartagena -->

					    <h5>Ciudad: Cartagena</h5>

					    <div class="form-group">
					        <label for="cartagena_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="cartagena_tf" name="cartagena_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="cartagena_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="cartagena_numeracion_tab_tf" name="cartagena_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="cartagena_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="cartagena_cantidad_did_tf" id="cartagena_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Santa Marta -->

					    <h5>Ciudad: Santa Marta</h5>

					    <div class="form-group">
					        <label for="santa_marta_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="santa_marta_tf" name="santa_marta_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="santa_marta_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="santa_marta_numeracion_tab_tf" name="santa_marta_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="santa_marta_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="santa_marta_cantidad_did_tf" id="santa_marta_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Montería -->

					    <h5>Ciudad: Montería</h5>

					    <div class="form-group">
					        <label for="monteria_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="monteria_tf" name="monteria_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="monteria_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="monteria_numeracion_tab_tf" name="monteria_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="monteria_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="monteria_cantidad_did_tf" id="monteria_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Valledupar -->

					    <h5>Ciudad: Valledupar</h5>

					    <div class="form-group">
					        <label for="valledupar_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="valledupar_tf" name="valledupar_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="valledupar_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="valledupar_numeracion_tab_tf" name="valledupar_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="valledupar_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="valledupar_cantidad_did_tf" id="valledupar_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Sincelejo -->

					    <h5>Ciudad: Sincelejo</h5>

					    <div class="form-group">
					        <label for="sincelejo_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="sincelejo_tf" name="sincelejo_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="sincelejo_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="sincelejo_numeracion_tab_tf" name="sincelejo_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="sincelejo_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="sincelejo_cantidad_did_tf" id="sincelejo_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!--Pereira -->

					    <h5>Ciudad: Pereira</h5>

					    <div class="form-group">
					        <label for="pereira_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="pereira_tf" name="pereira_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="pereira_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="pereira_numeracion_tab_tf" name="pereira_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="pereira_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pereira_cantidad_did_tf" id="pereira_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Armenia -->

					    <h5>Ciudad: Armenia</h5>

					    <div class="form-group">
					        <label for="armenia_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="armenia_tf" name="armenia_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="armenia_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="armenia_numeracion_tab_tf" name="armenia_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="armenia_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="armenia_cantidad_did_tf" id="armenia_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Manizales -->

					    <h5>Ciudad: Manizales</h5>

					    <div class="form-group">
					        <label for="manizales_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="manizales_tf" name="manizales_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="manizales_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="manizales_numeracion_tab_tf" name="manizales_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="manizales_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="manizales_cantidad_did_tf" id="manizales_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Pereira:Ibague -->

					    <h5>Ciudad: Ibaué</h5>

					    <div class="form-group">
					        <label for="ibague_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="ibague_tf" name="ibague_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="ibague_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="ibague_numeracion_tab_tf" name="ibague_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="ibague_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="ibague_cantidad_did_tf" id="ibague_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Cucutá: -->

					    <h5>Ciudad: Cucutá</h5>

					    <div class="form-group">
					        <label for="cucuta_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="cucuta_tf" name="cucuta_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="cucuta_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="cucuta_numeracion_tab_tf" name="cucuta_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="cucuta_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="cucuta_cantidad_did_tf" id="cucuta_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>


					    <!-- Bucaramanga: -->

					    <h5>Ciudad: Bucaramanga</h5>

					    <div class="form-group">
					        <label for="bucaramanga_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="bucaramanga_tf" name="bucaramanga_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="bucaramanga_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="bucaramanga_numeracion_tab_tf" name="bucaramanga_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="bucaramanga_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="bucaramanga_cantidad_did_tf" id="bucaramanga_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Duitama: -->

					    <h5>Ciudad: Duitama</h5>

					    <div class="form-group">
					        <label for="duitama_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="duitama_tf" name="duitama_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="duitama_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="duitama_numeracion_tab_tf" name="duitama_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="duitama_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="duitama_cantidad_did_tf" id="duitama_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					     <!-- Sogamoso: -->

					    <h5>Ciudad: Sogamoso</h5>

					    <div class="form-group">
					        <label for="sogamoso_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="sogamoso_tf" name="sogamoso_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="sogamoso_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="sogamoso_numeracion_tab_tf" name="sogamoso_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="sogamoso_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="sogamoso_cantidad_did_tf" id="sogamoso_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Flandes: -->

					    <h5>Ciudad: Flandes</h5>

					    <div class="form-group">
					        <label for="flandes_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="flandes_tf" name="flandes_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="flandes_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="flandes_numeracion_tab_tf" name="flandes_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="flandes_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="flandes_cantidad_did_tf" id="flandes_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>


					    <!-- Rivera: -->

					    <h5>Ciudad: Rivera</h5>

					    <div class="form-group">
					        <label for="rivera_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="rivera_tf" name="rivera_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="rivera_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="rivera_numeracion_tab_tf" name="rivera_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="rivera_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="rivera_cantidad_did_tf" id="rivera_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Aipe: -->

					    <h5>Ciudad: Aipe</h5>

					    <div class="form-group">
					        <label for="aipe_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="aipe_tf" name="aipe_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="aipe_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="aipe_numeracion_tab_tf" name="aipe_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="aipe_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="aipe_cantidad_did_tf" id="aipe_cantidad_did_tf" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Lebrija: -->

					    <h5>Ciudad: Lebrija</h5>

					    <div class="form-group">
					        <label for="lebrija_tf" class="col-md-3 control-label">Requiere:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="lebrija_tf" name="lebrija_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- NUMERACIÓN ASIGNADA EN TAB: -->
					    <div class="form-group">
					        <label for="lebrija_numeracion_tab_tf" class="col-md-3 control-label">Numeración asignada en TAB:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="lebrija_numeracion_tab_tf" name="lebrija_numeracion_tab_tf">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>NO - Escalar a Soporte Comercial</option>
      									<option>No Requiere</option>
									</select>
					            </div>
					        </div>
					    </div>
					    
					    <!-- CANTIDAD DID -->
					    <div class="form-group">
					        <label for="lebrija_cantidad_did_tf" class="col-md-3 control-label">Cantidad DID:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="lebrija_cantidad_did_tf" id="lebrija_cantidad_did_tf" class="form-control" type="text" >
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

<!-- 44444444444444444444444444444444444444444444444 quedo bien -->



<div id="modal_eliminar3" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
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





<!-- PUNTO ORIGEN MPLS  -->
		   
		   <!-- DATOS BÁSICOS DE INSTALACION   ORIGEN -->

					<fieldset class="fielset_new_ot_mdl">
						
						<h4>DATOS BÁSICOS DE INSTALACION   ORIGEN</h4>
						<!-- CIUDAD -->
						<div class="form-group">
					        <label for="ciudad_mpls" class="col-md-3 control-label">Ciudad:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="ciudad_mpls" id="ciudad_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- DIRECCIÓN:-->
					    <div class="form-group">
					        <label for="direccion_mpls" class="col-md-3 control-label">Dirección:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="direccion_mpls" id="direccion_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TIPO PREDIO: -->
					     <div class="form-group">
					        <label for="tipo_predio_mpls" class="col-md-3 control-label">Tipo predio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
					                <select class="form-control" id="tipo_predio_mpls" name="tipo_predio_mpls">
									    <option>Seleccionar...</option>
									    <option>Edificio</option>
      									<option>Casa</option>
									    
									</select>
					            </div>
					        </div>
					    </div>	

					    <!-- NIT del cliente: -->
					    <div class="form-group">
					        <label for="nit_cliente_mpls" class="col-md-3 control-label">NIT del cliente:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
					                <input name="nit_cliente_mpls" id="nit_cliente_mpls" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>


					    <!-- ALIAS DEL LUGAR  -->
					    <div class="form-group">
					        <label for="alias_lugar_mpls" class="col-md-3 control-label">Alias del lugar:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="alias_lugar_mpls" id="alias_lugar_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- OTP -->
						<div class="form-group">
					        <label for="otp_mpls" class="col-md-3 control-label">OTP:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="otp_mpls" id="otp_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					     <!-- otp_asociadas -->
						<div class="form-group">
					        <label for="otp_asociadas_mpls" class="col-md-3 control-label">OTP asociadas:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="otp_asociadas_mpls" id="otp_asociadas_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>


					    <!-- TIPO MPLS: -->
					     <div class="form-group">
					        <label for="tipo_mpls" class="col-md-3 control-label">Tipo MPLS:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_mpls" name="tipo_mpls">
									    <option>Seleccionar...</option>
									    <option>MPLS Avanzado INTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado INTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado INTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado INTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado INTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)</option> 
      									<option>MPLS Avanzado EXTRANET NDS6 +  Monitoreo CPE (Gestión Proactiva)</option>	
      									<option>MPLS Avanzado EXTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)</option>	
      									<option>MPLS Avanzado EXTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado EXTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado EXTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado EXTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado Solución Punta Backend Triara</option>		
      									<option>MPLS Avanzado Solución Punta Backend Ortezal</option>
      									<option>MPLS Avanzado Componente Datacenter (con Punta en Rack de Appliance) </option>
      									<option>MPLS Avanzado Claro Connect (con Punta Cloud)</option>
      									<option>MPLS Transaccional - Solución Fibra</option>
      									<option>MPLS Transaccional - Solución HFC</option>		
      									<option>MPLS Transaccional - Solución 3G</option>	
      									<option>IP Data Internacional</option>		
      									<option>Backup de Ultima Milla Fibra</option>
      									<option>Backup de Ultima Milla Fibra  + Router</option>    
      									<option>Backup de Ultima Milla HFC</option>
      									<option>Backup de Ultima Milla 3G</option>
      									<option>Backup de Ultima Milla Terceros</option>
									</select>
					            </div>
					        </div>
					    </div>	

					    <!-- ancho_banda -->
						<div class="form-group">
					        <label for="ancho_banda_mpls" class="col-md-3 control-label">Ancho de banda:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="ancho_banda_mpls" id="ancho_banda_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>		

					    <!-- TIPO INSTALACION: -->
					     <div class="form-group">
					        <label for="tipo_instalacion_mpls" class="col-md-3 control-label">Tipo instalación:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_instalacion_mpls" name="tipo_instalacion_mpls">
									    <option>Seleccionar...</option>
									    <option>Instalar UM con PE</option>
									    <option>Instalar UM con PE sobre OTP de Pymes</option>
									    <option>Instalar UM con CT</option>
									    <option>Instalar UM con HFC</option>
      									<option>Instalar UM con 3G</option>
      									<option>Instalar UM en Datacenter Claro- Implementación</option>
      									<option>UM existente. Requiere Cambio de equipo</option>
      									<option>UM existente. Requiere Adición de equipo</option> 	
      									<option>UM existente. Solo configuración</option> 							    
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- ID SERVICIO ACTUAL -->
						<div class="form-group">
					        <label for="id_servicio_mpls" class="col-md-3 control-label">ID SERVICIO ACTUAL (Aplica para UM Existente):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="id_servicio_mpls" id="id_servicio_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- ID SERVICIO PRINCIPAL (Aplica solo para enlaces Backup):-->
						<div class="form-group">
					        <label for="id_servicio_principal_mpls" class="col-md-3 control-label">ID SERVICIO PRINCIPAL (Aplica solo para enlaces Backup):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="id_servicio_principal_mpls" id="id_servicio_principal_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>
			<!-- SESION NUMERO 2: INFORMACIÓN  ULTIMA MILLA  ORIGEN O PC-->
						<h4>INFORMACIÓN  ULTIMA MILLA  ORIGEN O PC</h4>

						<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
					     <div class="form-group">
					        <label for="requiere_instalacion_um_mpls" class="col-md-3 control-label">¿Esta OT requiere instalacion UM?:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_instalacion_um_mpls" name="requiere_instalacion_um_mpls">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>   												
      									<option>Existente</option> 	    
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- ESTA ULTIMA MILLA ES UN BACKUP?: -->
					    <div class="form-group">
					        <label for="ultima_milla_backup_mpls" class="col-md-3 control-label">Esta ultima milla es un backup:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="ultima_milla_backup_mpls" name="ultima_milla_backup_mpls">
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
					        <label for="proveedor_mpls" class="col-md-3 control-label">Proveedor:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="proveedor_mpls" name="proveedor_mpls">
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
					        <label for="medio_mpls" class="col-md-3 control-label">Medio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="medio_mpls" name="medio_mpls">
									    <option>Seleccionar...</option>
									    <option>No Aplica</option> 	   
									    <option>Fibra</option>
									    <option>Cobre</option>
									    <option>HFC</option>
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
					        <label for="respuesta_factibilidad_mpls" class="col-md-3 control-label">Respuesta factibilidad BW >= 100 MEGAS:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="respuesta_factibilidad_mpls" id="respuesta_factibilidad_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

			            <!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
					    <div class="form-group">
					        <label for="tipo_conector_mpls" class="col-md-3 control-label">Tipo conector:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_conector_mpls" name="tipo_conector_mpls">
									    <option>Seleccionar...</option>
									    <option>LC</option>  									   									
									    <option>SC</option> 	   
									    <option>ST</option>
									    <option>FC</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- ACCESO (Solo Aplica para Canales SDH) : -->
					    <h5>ACCESO (Solo Aplica para Canales > 100 MEGAS :</h5>
			            <div class="form-group">
					        <label for="sds_destino_mpls" class="col-md-3 control-label">SDS DESTINO (Unifilar):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="sds_destino_mpls" id="sds_destino_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>
					    
					    <!-- INTERFACE DE ENTREGA AL CLIENTE: -->
					    <div class="form-group">
					        <label for="tipo_conector_mpls" class="col-md-3 control-label">Interface de entrega al cliente:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_conector_mpls" name="tipo_conector_mpls">
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
					        <label for="requiere_voc_mpls" class="col-md-3 control-label">Requiere VOC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_voc_mpls" name="requiere_voc_mpls">
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
					        <label for="programacion_voc_mpls" class="col-md-3 control-label">Programación de VOC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="programacion_voc_mpls" name="programacion_voc_mpls">
									    <option>Seleccionar...</option>
									    <option>Programada</option>
      									<option>No requiere programación</option>   												
      									<option>No programada. Otra ciudad</option> 	    
      									<option>No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
									</select>
					            </div>
					        </div>
					    </div>

		<!-- SESION NUMERO 3: REQUERIMIENTOS PARA ENTREGA DEL SERVICIO ORIGEN -->
						<h4>REQUERIMIENTOS PARA ENTREGA DEL SERVICIO ORIGEN</h4>
						<!-- REQUIERE RFC : -->
					     <div class="form-group">
					        <label for="requiere_rfc_mpls" class="col-md-3 control-label">Requiere RFC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_rfc_mpls" name="requiere_rfc_mpls">
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
						
						<h5>EQUIPOS  (VER LISTA COMPLETA):</h5>
						<!-- Conversor Medio: -->
			            <div class="form-group">
					        <label for="conversor_medio_mpls" class="col-md-3 control-label">Conversor Medio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="conversor_medio_mpls" id="conversor_medio_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Referencia Router: -->
			            <div class="form-group">
					        <label for="referencia_router_mpls" class="col-md-3 control-label">Referencia Router:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="referencia_router_mpls" id="referencia_router_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Modulos o Tarjetas: -->
			            <div class="form-group">
					        <label for="modulo_o_tarjeta_mpls" class="col-md-3 control-label">Modulos o Tarjetas:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="modulo_o_tarjeta_mpls" id="modulo_o_tarjeta_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					   	<!-- Licencias --> 
					    <div class="form-group">
					        <label for="licencias_mpls" class="col-md-3 control-label">Licencias:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="licencias_mpls" id="licencias_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Equipos Adicionale--> 
					    <div class="form-group">
					        <label for="equipos_adicionales_mpls" class="col-md-3 control-label">Equipos adicionale:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="equipos_adicionales_mpls" id="equipos_adicionales_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Consumibles:--> 
					    <div class="form-group">
					        <label for="consumibles_mpls" class="col-md-3 control-label">Consumibles:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="consumibles_mpls" name="consumibles_mpls">
									    <option>Seleccionar...</option>
									    <option>Bandeja</option>
      									<option>Cables de Poder </option>
      									<option>Clavijas de Conexión</option>
      									<option>Accesorios para rackear (Orejas)</option>
      									<option>No Aplica</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
					     <div class="form-group">
					        <label for="registro_importacion_carta_mpls" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="registro_importacion_carta_mpls" name="registro_importacion_carta_mpls">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>
		<!-- sesion 4:   DATOS DEL CONTACTO PARA COMUNICACIÓN  -->

						<h5>APRUEBA COSTOS DE OC Y CIERRE DE ORDEN DE TRABAJO</h5>
						
						<!-- NOMBRE --> 
					    <div class="form-group">
					        <label for="nombre_cot_mpls" class="col-md-3 control-label">Nombre:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="nombre_cot_mpls" id="nombre_cot_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TELEFONO --> 
					    <div class="form-group">
					        <label for="telefono_cot_mpls" class="col-md-3 control-label">Telefono:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="telefono_cot_mpls" id="telefono_cot_mpls" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- CELULAR --> 
					    <div class="form-group">
					        <label for="celular_cot_mpls" class="col-md-3 control-label">Celular:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="celular_cot_mpls" id="celular_cot_mpls" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- EMAIL --> 
					    <div class="form-group">
					        <label for="email_cot_mpls" class="col-md-3 control-label">Email:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="email_cot_mpls" id="email_cot_mpls" class="form-control" type="email" >
					            </div>
					        </div>
					    </div>

					 
					   	<h5>DATOS CLIENTE: TÉCNICO</h5>

					   	<!-- NOMBRE --> 
					    <div class="form-group">
					        <label for="nombre_dct_mpls" class="col-md-3 control-label">Nombre:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="nombre_dct_mpls" id="nombre_dct_mpls" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TELEFONO --> 
					    <div class="form-group">
					        <label for="telefono_dct_mpls" class="col-md-3 control-label">Telefono:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="telefono_dct_mpls" id="telefono_dct_mpls" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- CELULAR --> 
					    <div class="form-group">
					        <label for="celular_dct_mpls" class="col-md-3 control-label">Celular:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="celular_dct_mpls" id="celular_dct_mpls" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- EMAIL --> 
					    <div class="form-group">
					        <label for="email_dct_mpls" class="col-md-3 control-label">Correo electronico:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="email_dct_mpls" id="email_dct_mpls" class="form-control" type="email" >
					            </div>
					        </div>
					    </div>

					    <!-- OBSERVACIONES: --> 
					    <div class="form-group">
					        <label for="observaciones_dct_mpls" class="col-md-3 control-label">Observaciones:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="observaciones_dct_mpls" id="observaciones_dct_mpls" class="form-control" type="text" >
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


<!-- 6666666666666666666666666666666666666666666666666 33333333333333333333333333333333333333333366 punto destino -->

<div id="modal_eliminar5" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
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





<!-- PUNTO DESTINO MPLS  -->
		   
		   <!-- DATOS BÁSICOS DE INSTALACION   ORIGEN -->

					<fieldset class="fielset_new_ot_mdl">
						
						<h4>DATOS BÁSICOS DE INSTALACION PUNTO DESTINO</h4>
						<!-- CIUDAD -->
						<div class="form-group">
					        <label for="ciudad_mpls_pd" class="col-md-3 control-label">Ciudad:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="ciudad_mpls_pd" id="ciudad_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- DIRECCIÓN:-->
					    <div class="form-group">
					        <label for="direccion_mpls_pd" class="col-md-3 control-label">Dirección:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="direccion_mpls_pd" id="direccion_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TIPO PREDIO: -->
					     <div class="form-group">
					        <label for="tipo_predio_mpls_pd" class="col-md-3 control-label">Tipo predio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
					                <select class="form-control" id="tipo_predio_mpls_pd" name="tipo_predio_mpls_pd">
									    <option>Seleccionar...</option>
									    <option>Edificio</option>
      									<option>Casa</option>
									    
									</select>
					            </div>
					        </div>
					    </div>	

					    <!-- NIT del cliente: -->
					    <div class="form-group">
					        <label for="nit_cliente_mpls_pd" class="col-md-3 control-label">NIT del cliente:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
					                <input name="nit_cliente_mpls_pd" id="nit_cliente_mpls_pd" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>


					    <!-- ALIAS DEL LUGAR  -->
					    <div class="form-group">
					        <label for="alias_lugar_mpls_pd" class="col-md-3 control-label">Alias del lugar:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="alias_lugar_mpls_pd" id="alias_lugar_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- OTP -->
						<div class="form-group">
					        <label for="otp_mpls_pd" class="col-md-3 control-label">OTP:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="otp_mpls_pd" id="otp_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					     <!-- otp_asociadas -->
						<div class="form-group">
					        <label for="otp_asociadas_mpls_pd" class="col-md-3 control-label">OTP asociadas:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="otp_asociadas_mpls_pd" id="otp_asociadas_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>


					    <!-- TIPO MPLS: -->
					     <div class="form-group">
					        <label for="tipo_mpls_pd" class="col-md-3 control-label">Tipo MPLS:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_mpls_pd" name="tipo_mpls_pd">
									    <option>Seleccionar...</option>
									    <option>MPLS Avanzado INTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado INTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado INTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado INTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado INTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)</option> 
      									<option>MPLS Avanzado EXTRANET NDS6 +  Monitoreo CPE (Gestión Proactiva)</option>	
      									<option>MPLS Avanzado EXTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)</option>	
      									<option>MPLS Avanzado EXTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado EXTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado EXTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado EXTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado Solución Punta Backend Triara</option>		
      									<option>MPLS Avanzado Solución Punta Backend Ortezal</option>
      									<option>MPLS Avanzado Componente Datacenter (con Punta en Rack de Appliance) </option>
      									<option>MPLS Avanzado Claro Connect (con Punta Cloud)</option>
      									<option>MPLS Transaccional - Solución Fibra</option>
      									<option>MPLS Transaccional - Solución HFC</option>		
      									<option>MPLS Transaccional - Solución 3G</option>	
      									<option>IP Data Internacional</option>		
      									<option>Backup de Ultima Milla Fibra</option>
      									<option>Backup de Ultima Milla Fibra  + Router</option>    
      									<option>Backup de Ultima Milla HFC</option>
      									<option>Backup de Ultima Milla 3G</option>
      									<option>Backup de Ultima Milla Terceros</option>
									</select>
					            </div>
					        </div>
					    </div>	

					    <!-- ancho_banda -->
						<div class="form-group">
					        <label for="ancho_banda_mpls_pd" class="col-md-3 control-label">Ancho de banda:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="ancho_banda_mpls_pd" id="ancho_banda_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>		

					    <!-- TIPO INSTALACION: -->
					     <div class="form-group">
					        <label for="tipo_instalacion_mpls_pd" class="col-md-3 control-label">Tipo instalación:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_instalacion_mpls_pd" name="tipo_instalacion_mpls_pd">
									    <option>Seleccionar...</option>
									    <option>Instalar UM con PE</option>
									    <option>Instalar UM con PE sobre OTP de Pymes</option>
									    <option>Instalar UM con CT</option>
									    <option>Instalar UM con HFC</option>
      									<option>Instalar UM con 3G</option>
      									<option>Instalar UM en Datacenter Claro- Implementación</option>
      									<option>UM existente. Requiere Cambio de equipo</option>
      									<option>UM existente. Requiere Adición de equipo</option> 	
      									<option>UM existente. Solo configuración</option> 							    
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- ID SERVICIO ACTUAL -->
						<div class="form-group">
					        <label for="id_servicio_mpls_pd" class="col-md-3 control-label">ID SERVICIO ACTUAL (Aplica para UM Existente):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="id_servicio_mpls_pd" id="id_servicio_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- ID SERVICIO PRINCIPAL (Aplica solo para enlaces Backup):-->
						<div class="form-group">
					        <label for="id_servicio_principal_mpls_pd" class="col-md-3 control-label">ID SERVICIO PRINCIPAL (Aplica solo para enlaces Backup):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="id_servicio_principal_mpls_pd" id="id_servicio_principal_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>
			<!-- SESION NUMERO 2: INFORMACIÓN  ULTIMA MILLA DESTINO  -->
						<h4>INFORMACIÓN  ULTIMA MILLA DESTINO</h4>

						<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
					     <div class="form-group">
					        <label for="requiere_instalacion_um_mpls_pd" class="col-md-3 control-label">¿Esta OT requiere instalacion UM?:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_instalacion_um_mpls_pd" name="requiere_instalacion_um_mpls_pd">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>   												    
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- ESTA ULTIMA MILLA ES UN BACKUP?: -->
					    <div class="form-group">
					        <label for="ultima_milla_backup_mpls_pd" class="col-md-3 control-label">Esta ultima milla es un backup:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="ultima_milla_backup_mpls_pd" name="ultima_milla_backup_mpls_pd">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>   					    
									</select>
					            </div>
					        </div>
					    </div>


					    <!-- PROVEEDOR: -->
					    <div class="form-group">
					        <label for="proveedor_mpls_pd" class="col-md-3 control-label">Proveedor:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="proveedor_mpls_pd" name="proveedor_mpls_pd">
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
					        <label for="medio_mpls_pd" class="col-md-3 control-label">Medio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="medio_mpls_pd" name="medio_mpls_pd">
									    <option>Seleccionar...</option>
									    <option>No Aplica</option> 	   
									    <option>Fibra</option>
									    <option>Cobre</option>
									    <option>HFC</option>
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
					        <label for="respuesta_factibilidad_mpls_pd" class="col-md-3 control-label">Respuesta factibilidad BW > 100 MEGAS:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="respuesta_factibilidad_mpls_pd" id="respuesta_factibilidad_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

			            <!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
					    <div class="form-group">
					        <label for="tipo_conector_mpls_pd" class="col-md-3 control-label">Tipo conector:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_conector_mpls_pd" name="tipo_conector_mpls_pd">
									    <option>Seleccionar...</option>
									    <option>LC</option>  									   									
									    <option>SC</option> 	   
									    <option>ST</option>
									    <option>FC</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- ACCESO (Solo Aplica para Canales SDH) : -->
					    <h5>ACCESO (Solo Aplica para Canales > 100 MEGAS :</h5>
			            <div class="form-group">
					        <label for="sds_destino_mpls_pd" class="col-md-3 control-label">SDS DESTINO (Unifilar):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="sds_destino_mpls_pd" id="sds_destino_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>
					    
					    <!-- INTERFACE DE ENTREGA AL CLIENTE: -->
					    <div class="form-group">
					        <label for="tipo_conector_mpls_pd" class="col-md-3 control-label">Interface de entrega al cliente:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_conector_mpls_pd" name="tipo_conector_mpls_pd">
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
					        <label for="requiere_voc_mpls_pd" class="col-md-3 control-label">Requiere VOC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_voc_mpls_pd" name="requiere_voc_mpls_pd">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>    
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- PROGRAMACIÓN DE VOC : -->
					     <div class="form-group">
					        <label for="programacion_voc_mpls_pd" class="col-md-3 control-label">Programación de VOC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="programacion_voc_mpls_pd" name="programacion_voc_mpls_pd">
									    <option>Seleccionar...</option>
									    <option>Programada</option>
      									<option>No requiere programación</option>   												
      									<option>No programada. Otra ciudad</option> 	    
      									<option>No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
									</select>
					            </div>
					        </div>
					    </div>

		<!-- SESION NUMERO 3: REQUERIMIENTOS PARA ENTREGA DEL SERVICIO  DESTINO -->
						<h4>REQUERIMIENTOS PARA ENTREGA DEL SERVICIO  DESTINO</h4>
						<!-- REQUIERE RFC : -->
					     <div class="form-group">
					        <label for="requiere_rfc_mpls_pd" class="col-md-3 control-label">Requiere RFC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_rfc_mpls_pd" name="requiere_rfc_mpls_pd">
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
						
						<h5>EQUIPOS  (VER LISTA COMPLETA):</h5>
						<!-- Conversor Medio: -->
			            <div class="form-group">
					        <label for="conversor_medio_mpls_pd" class="col-md-3 control-label">Conversor Medio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="conversor_medio_mpls_pd" id="conversor_medio_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Referencia Router: -->
			            <div class="form-group">
					        <label for="referencia_router_mpls_pd" class="col-md-3 control-label">Referencia Router:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="referencia_router_mpls_pd" id="referencia_router_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Modulos o Tarjetas: -->
			            <div class="form-group">
					        <label for="modulo_o_tarjeta_mpls_pd" class="col-md-3 control-label">Modulos o Tarjetas:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="modulo_o_tarjeta_mpls_pd" id="modulo_o_tarjeta_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					   	<!-- Licencias --> 
					    <div class="form-group">
					        <label for="licencias_mpls_pd" class="col-md-3 control-label">Licencias:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="licencias_mpls_pd" id="licencias_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Equipos Adicionale--> 
					    <div class="form-group">
					        <label for="equipos_adicionales_mpls_pd" class="col-md-3 control-label">Equipos adicionale:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="equipos_adicionales_mpls_pd" id="equipos_adicionales_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Consumibles:--> 
					    <div class="form-group">
					        <label for="consumibles_mpls_pd" class="col-md-3 control-label">Consumibles:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="consumibles_mpls_pd" name="consumibles_mpls_pd">
									    <option>Seleccionar...</option>
									    <option>Bandeja</option>
      									<option>Cables de Poder </option>
      									<option>Clavijas de Conexión</option>
      									<option>Accesorios para rackear (Orejas)</option>
      									<option>No Aplica</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
					     <div class="form-group">
					        <label for="registro_importacion_carta_mpls_pd" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="registro_importacion_carta_mpls_pd" name="registro_importacion_carta_mpls_pd">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>
		<!-- sesion 4:  DATOS DEL CONTACTO PARA COMUNICACIÓN   -->

						<h5>APRUEBA COSTOS DE OC Y CIERRE DE ORDEN DE TRABAJO</h5>
						
						<!-- NOMBRE --> 
					    <div class="form-group">
					        <label for="nombre_cot_mpls_pd" class="col-md-3 control-label">Nombre:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="nombre_cot_mpls_pd" id="nombre_cot_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TELEFONO --> 
					    <div class="form-group">
					        <label for="telefono_cot_mpls_pd" class="col-md-3 control-label">Telefono:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="telefono_cot_mpls_pd" id="telefono_cot_mpls_pd" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- CELULAR --> 
					    <div class="form-group">
					        <label for="celular_cot_mpls_pd" class="col-md-3 control-label">Celular:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="celular_cot_mpls_pd" id="celular_cot_mpls_pd" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- EMAIL --> 
					    <div class="form-group">
					        <label for="email_cot_mpls_pd" class="col-md-3 control-label">Email:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="email_cot_mpls_pd" id="email_cot_mpls_pd" class="form-control" type="email" >
					            </div>
					        </div>
					    </div>

					 
					   	<h5>DATOS CLIENTE: TÉCNICO</h5>

					   	<!-- NOMBRE --> 
					    <div class="form-group">
					        <label for="nombre_dct_mpls_pd" class="col-md-3 control-label">Nombre:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="nombre_dct_mpls_pd" id="nombre_dct_mpls_pd" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TELEFONO --> 
					    <div class="form-group">
					        <label for="telefono_dct_mpls_pd" class="col-md-3 control-label">Telefono:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="telefono_dct_mpls_pd" id="telefono_dct_mpls_pd" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- CELULAR --> 
					    <div class="form-group">
					        <label for="celular_dct_mpls_pd" class="col-md-3 control-label">Celular:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="celular_dct_mpls_pd" id="celular_dct_mpls_pd" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- EMAIL --> 
					    <div class="form-group">
					        <label for="email_dct_mpls_pd" class="col-md-3 control-label">Correo electronico:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="email_dct_mpls_pd" id="email_dct_mpls_pd" class="form-control" type="email" >
					            </div>
					        </div>
					    </div>

					    <!-- OBSERVACIONES: --> 
					    <div class="form-group">
					        <label for="observaciones_dct_mpls_" class="col-md-3 control-label">Observaciones:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="observaciones_dct_mpls_" id="observaciones_dct_mpls_" class="form-control" type="text" >
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

<!-- 3333333333333333333333333333333 PLANTILLA PRIVATE LINE 33333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333-->

<div id="modal_eliminar6" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
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





<!-- PRIVATE LINE PUNTO DE ORIGEN -->
		   
		   <!-- DATOS BÁSICOS DE INSTALACION   ORIGEN -->

					<fieldset class="fielset_new_ot_mdl">
						<H3>PRIVATE LINE</H3>
						<h4>DATOS BÁSICOS DE INSTALACION ORIGEN  </h4>
						<!-- CIUDAD -->
						<div class="form-group">
					        <label for="ciudad_pl_po" class="col-md-3 control-label">Ciudad:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="ciudad_pl_po" id="ciudad_pl_po" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- DIRECCIÓN:-->
					    <div class="form-group">
					        <label for="direccion_pl_po" class="col-md-3 control-label">Dirección:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="direccion_pl_po" id="direccion_pl_po" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TIPO PREDIO: -->
					     <div class="form-group">
					        <label for="tipo_predio_pl_po" class="col-md-3 control-label">Tipo predio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
					                <select class="form-control" id="tipo_predio_pl_po" name="tipo_predio_pl_po">
									    <option>Seleccionar...</option>
									    <option>Edificio</option>
      									<option>Casa</option>									    
									</select>
					            </div>
					        </div>
					    </div>	

					    <!-- NIT del cliente: -->
					    <div class="form-group">
					        <label for="nit_cliente_pl_po" class="col-md-3 control-label">NIT del cliente:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
					                <input name="nit_cliente_pl_po" id="nit_cliente_pl_po" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>


					    <!-- ALIAS DEL LUGAR  -->
					    <div class="form-group">
					        <label for="alias_lugar_pl_po" class="col-md-3 control-label">Alias del lugar:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="alias_lugar_pl_po" id="alias_lugar_pl_po" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- OTP -->
						<div class="form-group">
					        <label for="otp_pl_po" class="col-md-3 control-label">OTP:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="otp_pl_po" id="otp_pl_po" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					     <!-- otp_asociadas -->
						<div class="form-group">
					        <label for="otp_asociadas_pl_po" class="col-md-3 control-label">OTP asociadas:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="otp_asociadas_pl_po" id="otp_asociadas_pl_po" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>


					    <!-- TIPO PRIVATE LINE: -->
					     <div class="form-group">
					        <label for="tipo_pl_po" class="col-md-3 control-label">Tipo PRIVATE LINE:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_pl_po" name="tipo_pl_po">
									    <option>Seleccionar...</option>
									    <option>Local - P2P</option>
      									<option>Local - P2MP</option>
      									<option>Nacional - P2P</option>
      									<option>Nacional - P2MP</option>
      									<option>VPRN</option> 
      									<option>Private Line Service (SDH)</option>						
									</select>
					            </div>
					        </div>
					    </div>	

					    <!-- ancho_banda -->
						<div class="form-group">
					        <label for="ancho_banda_pl_po" class="col-md-3 control-label">Ancho de banda:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="ancho_banda_pl_po" id="ancho_banda_pl_po" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>		

					    <!-- TIPO INSTALACION: -->
					     <div class="form-group">
					        <label for="tipo_instalacion_pl_po" class="col-md-3 control-label">Tipo instalación:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_instalacion_pl_po" name="tipo_instalacion_pl_po">
									    <option>Seleccionar...</option>
									    <option>Instalar UM con PE</option>
									    <option>Instalar UM con CT (No Estándar - Requiere Validación Solución No Estándar)</option>
									    <option>Instalar UM en Datacenter Claro- Cableado</option>
									    <option>Instalar UM en Datacenter Claro- Implementación</option>
      									<option>Instalar UM en Datacenter Tercero</option>
      									<option>UM existente. Requiere Cambio de equipo</option>					    
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- ID SERVICIO ACTUAL -->
						<div class="form-group">
					        <label for="id_servicio_pl_po" class="col-md-3 control-label">ID SERVICIO ACTUAL (Aplica para UM Existente):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="id_servicio_pl_po" id="id_servicio_pl_po" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    
			<!-- SESION NUMERO 2: INFORMACIÓN  ULTIMA MILLA DESTINO  -->
						<h4>INFORMACIÓN ULTIMA MILLA</h4>

						<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
					     <div class="form-group">
					        <label for="requiere_instalacion_pl_po" class="col-md-3 control-label">¿Esta OT requiere instalacion UM?:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_instalacion_pl_po" name="requiere_instalacion_pl_po">
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
					        <label for="proveedor_pl_po" class="col-md-3 control-label">Proveedor:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="proveedor_pl_po" name="proveedor_pl_po">
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
					        <label for="medio_pl_po" class="col-md-3 control-label">Medio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="medio_pl_po" name="medio_pl_po">
									    <option>Seleccionar...</option>
									    <option>No Aplica</option> 	   
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

					    
			            <!-- RESPUESTA FACTIBILIDAD BW > 300 MEGAS : -->
			            <div class="form-group">
					        <label for="respuesta_factibilidad_pl_po" class="col-md-3 control-label">Respuesta factibilidad BW > 300 MEGAS:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="respuesta_factibilidad_pl_po" id="respuesta_factibilidad_pl_po" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

			            <!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
					    <div class="form-group">
					        <label for="tipo_conector_pl_po" class="col-md-3 control-label">Tipo conector:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_conector_pl_po" name="tipo_conector_pl_po">
									    <option>Seleccionar...</option>
									    <option>LC</option>  									   									
									    <option>SC</option> 	   
									    <option>ST</option>
									    <option>FC</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- ACCESO (Solo Aplica para Canales SDH): -->
					    <h5>ACCESO (Solo Aplica para Canales SDH):</h5>
			            <div class="form-group">
					        <label for="sds_destino_pl_po" class="col-md-3 control-label">SDS DESTINO (Unifilar):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="sds_destino_pl_po" id="sds_destino_pl_po" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>
					    
					    <!-- INTERFACE DE ENTREGA AL CLIENTE: -->
					    <div class="form-group">
					        <label for="interface_entrega_cliente_pl_po" class="col-md-3 control-label">Interface de entrega al cliente:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="interface_entrega_cliente_pl_po" name="interface_entrega_cliente_pl_po">
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
					        <label for="requiere_voc_pl_po" class="col-md-3 control-label">Requiere VOC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_voc_pl_po" name="requiere_voc_pl_po">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>    
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- PROGRAMACIÓN DE VOC : -->
					     <div class="form-group">
					        <label for="programacion_voc_pl_po" class="col-md-3 control-label">Programación de VOC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="programacion_voc_pl_po" name="programacion_voc_pl_po">
									    <option>Seleccionar...</option>
									    <option>Programada</option>
      									<option>No requiere programación</option>   												
      									<option>No programada. Otra ciudad</option> 	    
      									<option>No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
									</select>
					            </div>
					        </div>
					    </div>

		<!-- SESION NUMERO 3: REQUERIMIENTOS PARA ENTREGA DEL SERVICIO  DESTINO -->
						<h4>REQUERIMIENTOS PARA ENTREGA DEL SERVICIO  DESTINO</h4>

						<!-- REQUIERE RFC : -->
					     <div class="form-group">
					        <label for="requiere_rfc_pl_po" class="col-md-3 control-label">Requiere RFC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="requiere_rfc_pl_po" name="requiere_rfc_pl_po">
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
						
						<h5>EQUIPOS (VER LISTA COMPLETA):</h5>
						<!-- Conversor Medio: -->
			            <div class="form-group">
					        <label for="conversor_medio_pl_po" class="col-md-3 control-label">Conversor Medio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="conversor_medio_pl_po" id="conversor_medio_pl_po" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    
					    <!-- Equipos Adicionale--> 
					    <div class="form-group">
					        <label for="equipos_adicionales_pl_po" class="col-md-3 control-label">Equipos adicionale:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="equipos_adicionales_pl_po" id="equipos_adicionales_pl_po" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- Consumibles:--> 
					    <div class="form-group">
					        <label for="consumibles_pl_po" class="col-md-3 control-label">Consumibles:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="consumibles_pl_po" name="consumibles_pl_po">
									    <option>Seleccionar...</option>
									    <option>Bandeja</option>
      									<option>Cables de Poder </option>
      									<option>Clavijas de Conexión</option>
      									<option>Accesorios para rackear (Orejas)</option>
      									<option>No Aplica</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
					     <div class="form-group">
					        <label for="registro_importacion_carta_pl_po" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="registro_importacion_carta_pl_po" name="registro_importacion_carta_pl_po">
									    <option>Seleccionar...</option>
									    <option>Si</option>
      									<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- MODO TRANSMISIÓN ENTREGA CANAL -->
					     <div class="form-group">
					        <label for="modo_transmision_pl_po" class="col-md-3 control-label">Modo transmisión entrega canal:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="modo_transmision_pl_po" name="modo_transmision_pl_po">
									    <option>Seleccionar...</option>
									    <option>Troncal - Especifique VLAN</option>
      									<option>Acceso (Null)</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- CANTIDAD MACS : -->
					     <div class="form-group">
					        <label for="cantidad_macs_pl_po" class="col-md-3 control-label">Cantidad MACS:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="cantidad_macs_pl_po" name="cantidad_macs_pl_po">
									    <option>Seleccionar...</option>
									    <option>0 - 250 Estándar</option>
      									<option>250 en Adelante - Solicitar autorización a CORE</option>
									</select>
					            </div>
					        </div>
					    </div>


		<!-- sesion 4:  DATOS DEL CONTACTO PARA COMUNICACIÓN   -->

						<h5>APRUEBA COSTOS DE OC Y CIERRE DE ORDEN DE TRABAJO</h5>
					
						<!-- NOMBRE --> 
					    <div class="form-group">
					        <label for="nombre_cot_pl_po" class="col-md-3 control-label">Nombre:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="nombre_cot_pl_po" id="nombre_cot_pl_po" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TELEFONO --> 
					    <div class="form-group">
					        <label for="telefono_cot_pl_po" class="col-md-3 control-label">Telefono:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="telefono_cot_pl_po" id="telefono_cot_pl_po" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- CELULAR --> 
					    <div class="form-group">
					        <label for="celular_cot_pl_po" class="col-md-3 control-label">Celular:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="celular_cot_pl_po" id="celular_cot_pl_po" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- EMAIL --> 
					    <div class="form-group">
					        <label for="email_cot_pl_po" class="col-md-3 control-label">Email:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="email_cot_pl_po" id="email_cot_pl_po" class="form-control" type="email" >
					            </div>
					        </div>
					    </div>

					 
					   	<h5>DATOS CLIENTE: TÉCNICO</h5>

					   	<!-- NOMBRE --> 
					    <div class="form-group">
					        <label for="nombre_dct_pl_po" class="col-md-3 control-label">Nombre:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="nombre_dct_pl_po" id="nombre_dct_pl_po" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TELEFONO --> 
					    <div class="form-group">
					        <label for="telefono_dct_pl_po" class="col-md-3 control-label">Telefono:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="telefono_dct_pl_po" id="telefono_dct_pl_po" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- CELULAR --> 
					    <div class="form-group">
					        <label for="celular_dct_pl_po" class="col-md-3 control-label">Celular:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="celular_dct_pl_po" id="celular_dct_pl_po" class="form-control" type="number" >
					            </div>
					        </div>
					    </div>

					    <!-- EMAIL --> 
					    <div class="form-group">
					        <label for="email_dct_pl_po" class="col-md-3 control-label">Correo electronico:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="email_dct_pl_po" id="email_dct_pl_po" class="form-control" type="email" >
					            </div>
					        </div>
					    </div>

					    <!-- OBSERVACIONES: --> 
					    <div class="form-group">
					        <label for="observaciones_pl_po" class="col-md-3 control-label">Observaciones:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="observaciones_pl_po" id="observaciones_pl_po" class="form-control" type="text" >
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

<!-- 3333333333333333333333333333333333333333333333333333333333333 PRIVATE LINE  PUNTA DATACENTER 33333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333 -->

<div id="modal_eliminar" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
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





<!-- TRASLADO INTERNO -->
		   
		   <!-- DATOS BÁSICOS -->

					<fieldset class="fielset_new_ot_mdl">
						<H3>Datos básicos </H3>
						<!-- CIUDAD -->
						<div class="form-group">
					        <label for="pr_ciudad" class="col-md-3 control-label">Ciudad:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_ciudad" id="pr_ciudad" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- DIRECCIÓN UBICACIÓN ACTUAL DEL SERVICIO :-->
					    <div class="form-group">
					        <label for="pr_direccion" class="col-md-3 control-label">Dirección ubicación actual del servicio :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_direccion" id="pr_direccion" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- ALIAS DEL LUGAR : -->
					     <div class="form-group">
					        <label for="pr_alias" class="col-md-3 control-label">Alias del lugar :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
					                <input type="text" name="pr_alias" id="pr_alias" class="form-control">
					            </div>
					        </div>
					    </div>	

					    <!-- MOVIMIENTO INTERNO REQUERIDO : -->
					    <div class="form-group">
					        <label for="pr_movimiento_it" class="col-md-3 control-label">Movimiento interno requerido :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
									<select name="pr_movimiento_it" id="pr_movimiento_it" class="form-control">
										<option value="">Movimiento Equipos - Caja OB - Fibra  > 3 Mt</option>
										<option value="">Movimiento Equipos - Caja OB - Fibra  < 3 Mt</option>
										<option value="">Movimiento solo de Equipos</option>
										<option value="">Movimiento solo de Caja OB - Fibra</option>
										<option value="">Movimiento Rack</option>
										<option value="">Movimiento ODF</option>
										<option value="">Determinación en Visita de Obra Civil</option>
									</select>
					            </div>
					        </div>
					    </div>


					    <!-- OTP ASOCIADAS :  -->
					    <div class="form-group">
					        <label for="pr_otp_as" class="col-md-3 control-label">Otp asociadas :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_otp_as" id="pr_otp_as" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- CANTIDAD DE SERVICIOS A TRASLADAR : -->
						<div class="form-group">
					        <label for="pr_cantidad_st" class="col-md-3 control-label">Cantidad de servicios a trasladar :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_cantidad_st" id="pr_cantidad_st" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					     <!-- CODIGOS DE SERVICIO  A TRASLADAR : -->
						<div class="form-group">
					        <label for="pr_codigo_st" class="col-md-3 control-label">Codigos de servicio  a trasladar :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_codigo_st" id="pr_codigo_st" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>


					    <!-- TIPO DE TRASLADO INTERNO : -->
					     <div class="form-group">
					        <label for="pr_tipo_ti" class="col-md-3 control-label">Tipo de traslado interno :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="pr_tipo_ti" name="pr_tipo_ti">
									    <option>Seleccionar...</option>
									    <option>Estándar - El movimiento se realiza durante la EOC y OB</option>
      									<option>Paralelo - Se habilitan Nuevos Recursos de UM, Equipos, Config</option>
									</select>
					            </div>
					        </div>
					    </div>	


					    <!-- TIPO SERVICIO: -->
					     <div class="form-group">
					        <label for="pr_tipo_s" class="col-md-3 control-label">Tipo servicio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="pr_tipo_s" name="pr_tipo_s">
									    <option>Seleccionar...</option>
									    <option>Internet Dedicado con diferenciación de tráfico (Internet / NAP)</option>
      									<option>Internet Dedicado + Monitoreo CPE (Gestion Proactiva)</option>
      									<option>Internet Dedicado Administrado + Monitoreo CPE (Gestion Proactiva)</option>
      									<option>Internet Dedicado Empresarial</option>
      									<option>Internet  Banda ancha FO</option>
      									<option>MPLS Avanzado Intranet  + Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado Extranet  + Monitoreo CPE (Gestión Proactiva)</option>
      									<option>MPLS Avanzado con Punta Backend</option>
      									<option>MPLS Avanzado con Punta en Rack de Appliance (Componente Datacenter)</option>
      									<option>MPLS Avanzado con Punta Claro Connect</option>
      									<option>MPLS Transaccional</option>
      									<option>Telefonia Pública - Líneas Análogas</option>
      									<option>Telefonia Pública - Líneas E1 - R2</option>
      									<option>Telefonia Pública - Líneas E1 - PRI</option>
      									<option>Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
      									<option>Telefonia Pública - Línea SIP (Centralizado)</option>
      									<option>PBX Distribuida  Linea E1 -R2</option>
      									<option>PBX Distribuida  Linea E1 -PRI</option>
      									<option>Telefonia Corporativa</option>
      									<option>Local - P2P</option>
      									<option>Local - P2MP</option>
      									<option>Nacional - P2P</option>
      									<option>Nacional - P2MP</option>
      									<option>VPRN</option>
									</select>
					            </div>
					        </div>
					    </div>	

					    <!-- ancho_banda -->
						<div class="form-group">
					        <label for="pr_ancho_banda" class="col-md-3 control-label">Ancho de banda:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_ancho_banda" id="pr_ancho_banda" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>		

					    <!-- TIPO DE ACTIVIDAD : -->
					     <div class="form-group">
					        <label for="tipo_acti_ti" class="col-md-3 control-label">Tipo de actividad :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="tipo_acti_ti" name="tipo_acti_ti">
									    <option>Seleccionar...</option>
									    <option>Traslado Interno - Ejecutar de acuerdo a Visita de Cotización</option>
									    <option>OTP Legalización - Traslado Punto Central u Origen</option>
      									<option>Traslado Interno - En Datacenter Claro</option>
      									<option>Traslado Interno - En Datacenter Tercero</option>					    
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- ID SERVICIO ACTUAL (Aplica para UM Existente) : -->
						<div class="form-group">
					        <label for="pr_id_servicio" class="col-md-3 control-label">Id servicio actual (Aplica para UM Existente) :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_id_servicio" id="pr_id_servicio" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    
			<!-- SESION NUMERO 2:  INFORMACIÓN  ULTIMA MILLA  -->

						<h4>INFORMACIÓN  ULTIMA MILLA </h4>

					    <!-- ¿esta ot requiere instalacion de  um?--> 
					    <div class="form-group">
					        <label for="pr_requiere_um" class="">¿Esta ot requiere instalacion de  um? :</label>
					        <div class="">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
									<select name="pr_requiere_um" id="pr_requiere_um" class="form-control">
										<option value="">Seleccionar...</option>
										<option value="">SI</option>
										<option value="">NO</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- Proveedor --> 
					    <div class="form-group">
					        <label for="pr_proveedor" class="">Proveedor:</label>
					        <div class="">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
									<select name="pr_proveedor" id="pr_proveedor" class="form-control">
										<option value="">Seleccionar...</option>
										<option value="">No aplica</option>
										<option value="">Claro</option>
										<option value="">Axesat</option>
										<option value="">Comcel</option>
										<option value="">Tigo</option>
										<option value="">Media Commerce</option>
										<option value="">Diveo</option>
										<option value="">Edatel</option>
										<option value="">UNE</option>
										<option value="">ETB</option>
										<option value="">IBM</option>
										<option value="">IFX</option>
										<option value="">Level 3 Colombia</option>
										<option value="">Mercanet</option>
										<option value="">Metrotel</option>
										<option value="">Promitel</option>
										<option value="">Skynet</option>
										<option value="">Telebucaramanga</option>
										<option value="">Telecom</option>
										<option value="">Terremark</option>
										<option value="">Sol Cable Vision</option>
										<option value="">Sistelec</option>
										<option value="">Opain</option>
										<option value="">Airplan - (Información y Tecnologia)</option>
										<option value="">TV Azteca</option>
									</select>
					            </div>
					        </div>
					    </div>


					    <!-- MEDIO -->
					    <div class="form-group">
					        <label for="pr_medio" class="col-md-3 control-label">Medio:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="pr_medio" name="pr_medio">
									    <option>Seleccionar...</option>
									    <option>No Aplica</option> 	   
									    <option>FIBRA</option>
									    <option>COBRE</option> 
									    <option>SATELITAL</option>
									    <option>RADIO ENLACE</option>
									    <option>3G</option>
									    <option>UTP</option>
									</select>
					            </div>
					        </div>
					    </div>

					    
			            <!-- RESPUESTA FACTIBILIDAD BW > 100 MEGAS : -->
			            <div class="form-group">
					        <label for="pr_respuesta" class="col-md-3 control-label">Respuesta factibilidad BW > 100 Megas :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_respuesta" id="pr_respuesta" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- ACCESO (Solo Aplica para Canales > 100 MEGAS -->
					    <h5>ACCESO (Solo Aplica para Canales > 100 MEGAS</h5>

			            <div class="form-group">
					        <label for="pr_sds_destino" class="col-md-3 control-label">SDS DESTINO (Unifilar):</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_sds_destino" id="pr_sds_destino" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- OLT (GPON) : -->
			            <div class="form-group">
					        <label for="pr_olt" class="col-md-3 control-label">OLT (GPON) :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_olt" id="pr_olt" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>
					    
					    <!-- INTERFACE DE ENTREGA AL CLIENTE: -->
					    <div class="form-group">
					        <label for="pr_interface" class="col-md-3 control-label">Interface de entrega al cliente:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select class="form-control" id="pr_interface" name="pr_interface">
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

					    <!-- REQUIERE VOC: -->
					    <div class="form-group">
					        <label for="pr_requiere" class="col-md-3 control-label">REQUIERE VOC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
									<select type="text" name="pr_requiere" id="pr_requiere" class="form-control">
										<option>Seleccionar...</option>
										<option>Si</option>
										<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- PROGRAMACIÓN DE VOC: -->
					    <div class="form-group">
					        <label for="pr_requiere" class="col-md-3 control-label">PROGRAMACIÓN DE VOC:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
									<select type="text" name="pr_requiere" id="pr_requiere" class="form-control">
										<option>Seleccionar...</option>
										<option>Programada</option>
										<option>No requiere programación</option>
										<option>No programada. Otra ciudad</option>
										<option>No programada. Otra ciudad</option>
									</select>
					            </div>
					        </div>
					    </div>

		<!-- SESION NUMERO 3: REQUERIMIENTOS PARA ENTREGA DEL SERVICIO  DESTINO -->
						<h4>REQUERIMIENTOS PARA ENTREGA DEL SERVICIO</h4>



					    <!-- REQUIERE VENTANA DE MTTO : -->
					    <div class="form-group">
					        <label for="pr_requiere" class="col-md-3 control-label">REQUIERE VENTANA DE MTTO :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
									<select type="text" name="pr_requiere" id="pr_requiere" class="form-control">
										<option>Seleccionar...</option>
										<option>si</option>
										<option>No</option>
									</select>
					            </div>
					        </div>
					    </div>

					    <!-- REQUIERE RFC : -->
					    <div class="form-group">
					        <label for="pr_requiere" class="col-md-3 control-label">REQUIERE RFC :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
									<select type="text" name="pr_requiere" id="pr_requiere" class="form-control">
										<option>Seleccionar...</option>
										<option>SI => Cliente Critico Punto Central</option>
										<option>SI => Servicio Critico (Listado)</option>
										<option>SI => Cliente Critico</option>
										<option>SI => RFC Estándar Saturación</option>
										<option>SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
										<option>NO</option>
									</select>
					            </div>
					        </div>
					    </div>

						<h4>Equipos</h4>

						<!-- Conversor Medio :-->
					     <div class="form-group">
					        <label for="pr_conversor_m" class="col-md-3 control-label">Conversor Medio :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input type="text" name="pr_conversor_m" id="pr_conversor_m">
					            </div>
					        </div>
					    </div>

						<!-- Referencia Router : -->
					     <div class="form-group">
					        <label for="pr_referencia_r" class="col-md-3 control-label">Referencia Router :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input type="text" name="pr_referencia_r" id="pr_referencia_r">
					            </div>
					        </div>
					    </div>

						<!-- Modulos o Tarjetas : -->
					     <div class="form-group">
					        <label for="pr_modululos_t" class="col-md-3 control-label">Modulos o Tarjetas :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input type="text" name="pr_modululos_t" id="pr_modululos_t">
					            </div>
					        </div>
					    </div>

						<!-- Equipos Adicionales: -->
					     <div class="form-group">
					        <label for="pr_equipos_a" class="col-md-3 control-label">Equipos Adicionales:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input type="text" name="pr_equipos_a" id="pr_equipos_a">
					            </div>
					        </div>
					    </div>

					    <!-- TOMAS REGULADAS REQUERIDAS  -->
			            <div class="form-group">
					        <label for="pr_consumibles" class="col-md-3 control-label">Consumibles:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select name="pr_consumibles" id="pr_consumibles" class="form-control">
					                	<option value="">Bandeja</option>
					                	<option value="">Cables de Poder </option>
					                	<option value="">Clavijas de Conexión</option>
					                	<option value="">Accesorios para rackear (Orejas)</option>
					                	<option value="">No Aplica</option>
					                </select>
					            </div>
					        </div>
					    </div>

					    <!-- TOMAS REGULADAS REQUERIDAS  -->
			            <div class="form-group">
					        <label for="pr_registro_ic" class="col-md-3 control-label">REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <select name="pr_registro_ic" id="pr_registro_ic" class="form-control">
					                	<option value="">SI</option>
					                	<option value="">NO</option>
					                </select>
					            </div>
					        </div>
					    </div>

						<h4>Aprueba costos de oc y cierre de orden de trabajo</h4>
					    <!-- nombre--> 
					    <div class="form-group">
					        <label for="pr_nombre1" class="col-md-3 control-label">NOMBRE :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_nombre1" id="pr_nombre1" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TELEFONO:--> 
					    <div class="form-group">
					        <label for="pr_telefono1" class="col-md-3 control-label">TELEFONO:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_telefono1" id="pr_telefono1" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

						<!-- CELULAR :  --> 
					    <div class="form-group">
					        <label for="pr_celular1" class="col-md-3 control-label">CELULAR :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_celular1" id="pr_celular1" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>
						
						<!-- CORREO ELECTRONICO:  -->
			            <div class="form-group">
					        <label for="pr_correo1" class="col-md-3 control-label">CORREO ELECTRONICO:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input type="text" name="pr_correo1" id="pr_correo1" class="form-control">
					            </div>
					        </div>
					    </div>
						
						<h4>DATOS CLIENTE: TÉCNICO</h4>
						
					    <!-- nombre--> 
					    <div class="form-group">
					        <label for="pr_nombre1" class="col-md-3 control-label">NOMBRE :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_nombre2" id="pr_nombre2" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

					    <!-- TELEFONO:--> 
					    <div class="form-group">
					        <label for="pr_telefono2" class="col-md-3 control-label">TELEFONO:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_telefono2" id="pr_telefono2" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>

						<!-- CELULAR :  --> 
					    <div class="form-group">
					        <label for="pr_celular2" class="col-md-3 control-label">CELULAR :</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input name="pr_celular2" id="pr_celular2" class="form-control" type="text" >
					            </div>
					        </div>
					    </div>
						
						<!-- CORREO ELECTRONICO:  -->
			            <div class="form-group">
					        <label for="pr_correo2" class="col-md-3 control-label">CORREO ELECTRONICO:</label>
					        <div class="col-md-8 selectContainer">
					            <div class="input-group">
					                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
					                <input type="text" name="pr_correo2" id="pr_correo2" class="form-control">
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