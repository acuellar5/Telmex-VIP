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

function showFormControl(otp, cliente){
	$('#myModalLabel').html(`Orden de trabajo ${otp}`);
	document.getElementById("formModal").reset();
	$('#id_ot_padre').val(otp);
	$('#id_sede').val(id_sede);
	$('#n_nombre_cliente').val(cliente);
	$('#mdl-control_cambios').modal('show');
}


// Funcion para pasar las tablas en php a datatables para control de cambios
$(function () {
	// Configuracion de datatables para la tabla de control de cambios 
    $('#table_log_ctrl_cambios').DataTable({
        initComplete: function () {
            $('#table_log_ctrl_cambios tfoot th').each(function () {
                $(this).html('<input type="text" placeholder="Buscar" />');
            });
            var r = $('#table_log_ctrl_cambios tfoot tr');
            r.find('th').each(function () {
                $(this).css('padding', 8);
            });
            $('#table_log_ctrl_cambios thead').append(r);
            $('#search_0').css('text-align', 'center');

            // DataTable
             tableDetalle = $('#table_log_ctrl_cambios').DataTable();

            // Apply the search
            tableDetalle.columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });
        },
        "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json"
                },
                dom: 'Blfrtip',
                buttons: [
                    {
                        text: 'Excel <span class="fa fa-file-excel-o"></span>',
                        className: 'btn-cami_cool',
                        extend: 'excel',
                        title: 'ZOLID EXCEL',
                        filename: 'zolid ' + fecha_actual
                    },
                    {
                        text: 'Imprimir <span class="fa fa-print"></span>',
                        className: 'btn-cami_cool',
                        extend: 'print',
                        title: 'Reporte Zolid',
                    }
                ],
                select: true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                ordering: true,
                columnDefs: [{
                        // targets: -1,
                        // visible: false,
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[7, 'desc']]
    });


    // Configuracion de datatables para la tabla de otp en control de cambios 

    $('#table_sede_otp').DataTable({
        initComplete: function () {
            $('#table_sede_otp tfoot th').each(function () {
                $(this).html('<input type="text" placeholder="Buscar" />');
            });
            var r = $('#table_sede_otp tfoot tr');
            r.find('th').each(function () {
                $(this).css('padding', 8);
            });
            $('#table_sede_otp thead').append(r);
            $('#search_0').css('text-align', 'center');

            // DataTable
             tableDetalle = $('#table_sede_otp').DataTable();

            // Apply the search
            tableDetalle.columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });
        },
        "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json"
                },
                dom: 'Blfrtip',
                buttons: [
                    {
                        text: 'Excel <span class="fa fa-file-excel-o"></span>',
                        className: 'btn-cami_cool',
                        extend: 'excel',
                        title: 'ZOLID EXCEL',
                        filename: 'zolid ' + fecha_actual
                    },
                    {
                        text: 'Imprimir <span class="fa fa-print"></span>',
                        className: 'btn-cami_cool',
                        extend: 'print',
                        title: 'Reporte Zolid',
                    }
                ],
                select: true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                ordering: true,
                columnDefs: [{
                        // targets: -1,
                        // visible: false,
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[1, 'desc']]
    });



});


