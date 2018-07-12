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

		 $('#mdl_tbl_new_type').append(`<tr>
											<td><input type="text" name="name_status[]" id="estado_${flag}" class="form-control" value="${estado.estado_orden_trabajo_hija}" readonly></td>
											
											<td><input type="number" name="jerarquia[]" id="exist${i}" class="form-control jsStatusPlus"></td>
										</tr>`
		);
		 flag++;
	});
}
// Al darle clic a añadir nuevo estadoi del modal
$('#añadir_estado').click(function(){
	$('#mdl_tbl_new_type').append(	`<tr id="row${flag}">
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
		swal('Recuerda!','no puede quedar ningun estado vacio y debes darle un orden de jerarquia a los estados EJ: \n\n Generada  => 1 \n Cancelada => 2 \n Cerrada    => 3', 'error');		
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
	// tipos.forEach(function(tipo){
	// 	$('#list_tipos').append(`
	// 		<option value="${tipo.k_id_tipo}">${tipo.n_name_tipo}</option>
	// 	`);
	// });

	$('#mdl_variant_type').modal('show');
}

// al darle clic al boton enviar de variantes 
$('#mdl_btn_save_variant').click(function(event) {

	var valor = $('#list_tipos').val();
	var text_sel = $("#list_tipos option:selected").text();
	var name = $('#mdl_title_name').html();
	if (valor == '') {
		swal("Debes seleccionar un tipo de OT para asociar la variante");
	} else {
		swal({
              title: "Advertencia!",
              text: `¿Desea asociar  '${name}'  como variante del tipo '${text_sel}'?`,
              icon: "warning",
              buttons: true,
              
              dangerMode: true,
              buttons: ["Cancelar!", "Continuar!"],
        })
            .then((continuar) => {
                if (continuar) {
                    swal("¡Genial! ¡El Nuevo tipo ha sido asociado!", {
                        icon: "success",
                    });
                    return true;
                } else {
                    swal("¡Cancelaste la opración!",{
                        icon: "error",
                        dangerMode: true,
                    });
                    return false;
                }
            });
	}
});