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
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
	            <h3 class="modal-title" id="myModalLabel"></h3>
	        </div>
	        <!-- fin header del modal -->
	        <!-- body inicio del modal -->
		    <div class="modal-body ">
		    	<tr>
					<td colspan="2" align="center" id="" class="csstypesubtitle"><b>Nueva OTP</b></td>
				</tr>
		        <form class="well form-horizontal" id="mdl_form_new_type" action=""  method="post" >
					
						<fieldset >
						
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
						        <label for="tipo_otp" class="col-md-3 control-label">Tipo:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <select class="form-control" id="tipo_otp" name="tipo_otp">
										    <option>Seleccionar...</option>
										    <option>2</option>
										    <option>3</option>
										    <option>4</option>
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
										    <option>2</option>
										    <option>3</option>
										    <option>4</option>
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
	        <button type="button" class="btn btn-primary">Guardar</button>
	        <button type="button" class="btn btn-primary">Cancelar</button>
	    </div>
	</div>
</div>

<!-- ******************************** Fin del modal para crear oth *******************************************************