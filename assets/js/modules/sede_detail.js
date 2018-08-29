$.each(responsable_list, function(i, item) {
	$('#id_responsable').append(`
			<option value="${item.id_responsable}">${item.nombre_responsable}</option>
		`);
});

$.each(causa_list, function(i, item) {
	$('#id_causa').append(`
			<option value="${item.id_causa}">${item.nombre_causa}</option>
		`);
});

function showFormControl(otp, cliente, id_sede){
	$('#myModalLabel').html(`Orden de trabajo ${otp}`);
	document.getElementById("formModal").reset();
	$('#id_ot_padre').val(otp);
	$('#id_sede').val(id_sede);
	$('#n_nombre_cliente').val(cliente);
	$('#mdl-control_cambios').modal('show');
}

