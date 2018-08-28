function showFormControl(otp, cliente){
	$('#myModalLabel').html(`Orden de trabajo ${otp}`);
	document.getElementById("formModal").reset();
	$('#id_ot_padre').val(otp);

	$('#n_nombre_cliente').val(cliente);






	$('#mdl-control_cambios').modal('show');
}

