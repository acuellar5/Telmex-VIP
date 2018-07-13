// ****************************SECCION PAREA TIPPOS NUEVOS****************************
function showModalNewType (name){
	$.post( baseurl + '/Type/c_getNewStatusByType', 
		{name: name}, 
		function(data) {
			var obj = JSON.parse(data);
			fillModalNewType(obj, name);
		}
	);
}

var flag = 0;
function fillModalNewType(estados_existentes, name){
	$('#mdl_new_type').modal('show');
	$('#mdl_tbl_title_tipo').html("<strong>" + name + "</strong>");
	$('#mdl_tbl_name_type').val(name);
	$('#mdl_tbl_new_type').html("");
	$.each(estados_existentes, function(i, estado) {

		 $('#mdl_tbl_new_type').append(
		 	`<tr>
				<td><input type="text" name="name_status[]" id="estado_${flag}" class="form-control" value="${estado.estado_orden_trabajo_hija}" readonly></td>
				<td><input type="number" name="jerarquia[]" id="exist${i}" class="form-control jsStatusPlus"></td>
			</tr>`
		);
		 flag++;
	});
}
// Al darle clic a añadir nuevo estadoi del modal
$('#añadir_estado').click(function(){
	$('#mdl_tbl_new_type').append(	
		`<tr id="row${flag}">
			<td><input type="text" name="name_status[]" id="estado_${flag}" class="form-control jsStatusPlus"></td>
			<td>
				<div class="input-group">
					<input type="number" name="jerarquia[]" id="orden_${flag}" class="form-control jsStatusPlus  cssmodificacionin">
					<span class="fa fa-minus btn btn-danger btn_minus btn_red" onclick="removeRow('${flag}')"></span>

				</div>
			</td>
		</tr>`
		);
	flag++;
});

// Remueve la fila seleccionada al darle click
function removeRow(row){
	$(`#row${row}`).remove();
}

function validar_form(){
	var bandera = true;
	var inputs = document.querySelectorAll(".jsStatusPlus");
	inputs.forEach(function(input){
		if (input.value == '') {
			bandera = false;
			 $(`#${input.getAttribute('id')}`).css("box-shadow", "0 0 5px rgba(253, 1, 1)");
		} else {
			$(`#${input.getAttribute('id')}`).css("box-shadow", "none");
		}
	});

	if (!bandera) {
		swal({
			title : 'Recuerda!',
			type : 'error' ,
			html: 'No puede quedar ningun estado vacio y debes darle un orden de jerarquia a los estados <br><br>EJEMPLO: <br><br> Generada  => 1 <br> Cancelada => 2 <br> Cerrada    => 3' ,
			confirmButtonText: '<i class="fa fa-thumbs-up"></i> OK!',
			showCloseButton: true,
			animation: false,
  			customClass: 'animated bounceInDown'
		});
	}
	return bandera;
}

// ****************************SECCION PAREA TIPPOS VARIANTES****************************
function showModalVarianteType(name){
	$.post( baseurl + '/Type/c_get_list_types', 
		{
			// name: name
		}, 
		function(data) {
			var tipos = JSON.parse(data);
			fillModalVarianteType(tipos, name);
	});
}

function fillModalVarianteType(tipos, name){
	$('#mdl_title_name').html(name);
	$('#mdl_variant_type').modal('show');
}

// al darle clic al boton enviar de variantes 
$('#mdl_btn_save_variant').click(function(event) {
	var valor = $('#list_tipos').val();
	var text_sel = $("#list_tipos option:selected").text();
	var name = $('#mdl_title_name').html();
	
	if (valor == '') {
		swal(
			{
				title: "Oops...", 
				text: "Debes seleccionar un tipo de OT para asociar la variante",
				type: "warning"
			}			
		);
	} else {
		swal({
              title: "¿Está Seguro?",
              html: `¿Desea asociar  <b>'${name}'</b> <br> como variante del tipo <b>'${text_sel}'</b>?`,
              type: "question",
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Sí, Asociar!',
              cancelButtonText: 'No, Cancelar!',
        })
            .then((result) => {
                if (result.value) {
                	$.post( baseurl + '/Type/c_save_type_variant',
                	 {
                	 	name: name,
                	 	id_type: valor
                	 }, 
                	 function(data) {
                	 	var obj = JSON.parse(data);
                	 	if (obj.actu > 0) {
		                    alert_reg_restaurados(obj.actu, obj.nulos);		                    
                	 	} 
                	 	if (obj.nulos > 0) {
                	 		alert_reg_restaurados(obj.actu, obj.nulos);
                	 	}
                	 	if (obj.nulos == 0 && obj.actu == 0) {
            	 			swal(
									{
										title: "Oops...", 
										text: "El tipo ya existe en nuestra base de datos",
										type: "error"
									}			
							);
                	 	}                	 	                		
                	});
                } else {
					const toast = swal.mixin({
					  toast: true,
					  position: 'top-end',
					  showConfirmButton: false,
					  timer: 3000
					});
					toast({
					  type: 'error',
					  title: 'Acción Cancelada'
					});
                }
            });
	}
});

// llamar alert de registros restaurados
function alert_reg_restaurados(cant_actu, cant_null){
	swal({
    		title: "¡Genial!<br>" + cant_actu + " Registros restaurados", 
    		html: "¡El Nuevo tipo ha sido asociado!", 
    		type: "success", 
    		confirmButtonText: '<i class="fa fa-thumbs-up"></i> OK!'
    	}).then((resultado) => {
	 		if (cant_null > 0) {
	 			alert_reg_nulos(0, cant_null);
	 		}else{
	 			location.reload(); 
	 		}
        });
}

// Llamar alert de registros nulos
function alert_reg_nulos(cant_actu, cant_null){
	swal(
			{
			  type: 'info',
			  title: "¡Importante!<br> " + cant_null + " Registros se actualizaron a estado nulo ",
			  html: "¡Estos registros existentes quedaron asociados al tipo seleccionado, pero el estado que tenian no estaba asociado con el tipo elegido \n\n<br>, Reparar en modulo <a href='"+baseurl+"/status_restore' target='_blank'><b> STATUS RESTORE </b></a>!",
			  footer: '<a href="'+baseurl+'/status_restore" target="_blank"><strong> STATUS RESTORE </strong></a>',
			  confirmButtonText: '<i class="fa fa-thumbs-up"></i> OK!'
			}).then((resultado) => {
 		 		if (cant_actu > 0) {
 		 			alert_reg_restaurados(cant_actu, 0);

 		 		}else{
 		 			location.reload(); 
 		 		}
		 	 });
}

// *******************************************TABLAS DE INCONSISTENCIAS***************************

$(function(){
	    vista = {
        init: function () {
            vista.events();
        	vista.getListOtsUndefined();
         
        },
          //Eventos de la ventana.
        events: function () {
        	            
        },
        getListOtsUndefined: function(){
    		//metodo ajax (post)
    	    $.post( baseurl + '/Type/getListOtsUndefined', 
    	    	{
    	    		//parametros
    	    		//param1: 'value1'//enviar parametros a la funcion de la ruta
    	    	},
    	    	// funcion que recibe los datos (callback)
    	    	function(data) {
    	    		// convertir el json a objeto de javascript
    	    		var obj = JSON.parse(data);
    	    		// s
    	    		vista.printTable(obj); 
    	    	}
    	    );
    	},	
        printTable: function(data){
    		// nombramos la variable para la tabla y llamamos la configuiracion
    	    vista.tablePorject = $('#table_undefined').DataTable(vista.configTable(data, [

                    {title: "OT Padre", data: "nro_ot_onyx"},
                    {title: "ID Orden trabajo Hija", data: "id_orden_trabajo_hija"},
                    {title: "Nombre del Cliente", data: "nombre_cliente"},
                    {title: "Fecha de Creacion", data: "fecha_creacion"},
                    {title: "Tipo", data: "ot_hija"},
                    {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                   
                ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
              data: data,
              columns: columns,
              //lenguaje del plugin
              /*"language": { 
                  "url": baseurl + "assets/plugins/datatables/lang/es.json"
              },*/
              columnDefs: [{
                      defaultContent: "",
                      targets: -1,
                      orderable: false,
                  }],
              order: [[3, 'asc']],
              drawCallback: onDraw
            }
        },
    };
    vista.init();
});