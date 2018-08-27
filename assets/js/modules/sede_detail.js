	
function showFormControl(otp, cliente, sede){
	$('#myModalLabel').html(`Orden de trabajo ${otp}, Cliente ${cliente}, Sede ${sede}`);
	$('#mdl-control_cambios').modal('show');
}

