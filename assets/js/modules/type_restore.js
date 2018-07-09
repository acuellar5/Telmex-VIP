function showModalNewType (name){
	$.post( baseurl + '/Type/c_getNewStatusByType', 
		{name: name}, 
		function(data) {
		var obj = JSON.parse(data);
		console.log(obj);
		fillModalNewType(obj, name);
	});
}

function fillModalNewType(estados_existentes, name){
	$('#mdl_new_type').modal('show');
	$('#mdl_tbl_title_tipo').html("<strong>" + name + "</strong>");
	$('#mdl_tbl_new_type').html("");
	$.each(estados_existentes, function(i, estado) {

		 $('#mdl_tbl_new_type').append(`<tr>
											<td>${estado.estado_orden_trabajo_hija}</td>
											<td><input type="number" name="" id="" required class="form-control"></td>
										</tr>`
		);
	});
}
// Al darle clic a añadir nuevo estadoi del modal
$('#añadir_estado').click(function(){
	$('#mdl_tbl_new_type').append(	`<tr>
										<td><input type="text" name="name_status[]" id="" required class="form-control"></td>
										<td>
											<div class="input-group">
												<input type="number" name="jerarquia[]" id="" required class="form-control">
												<span class="fa fa-minus btn btn-danger"></span>
											</div>
										</td>
									</tr>`
		);
});
