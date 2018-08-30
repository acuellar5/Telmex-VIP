/************************* MOSTRAR MODAL FORMULARIO*************************/
//LISTAR SELECTS
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
// MOSTRAR MODAL
function showFormControl(otp, cliente, id_sede, num_ctrl){
    table_historial(otp);
    $('#myModalLabel').html(`Orden de trabajo ${otp}`);
    document.getElementById("formModal").reset();
    $('#id_ot_padre').val(otp);
    $('#id_sede').val(id_sede);
    $('#bdg_historial').html(num_ctrl);
    $('#numero_control').val(parseInt(num_ctrl) + 1);
    $('#n_nombre_cliente').val(cliente);
    $('#mdl-control_cambios').modal('show');
}

function table_historial(otp){
    $.post(baseurl + '/Sede/getCCByOtp', 
        {otp: otp}, 
        function(obj) {
            var data = JSON.parse(obj);
            print_table_historial(data);
    });
}

function print_table_historial(data){
    if (typeof tabla_Historiales == 'object' ) {
        console.log(typeof tabla_Historiales);
        var tabla = tabla_Historiales;
        tabla.clear().draw();
        tabla.rows.add(data);
        tabla.columns.adjust().draw();
        return;
    }

    tabla_Historiales = $('#tabla_Historial').DataTable(configTableHistorial(data, [
            {title: "responsable", data: "nombre_responsable"},//1
            {title: "causa", data: "nombre_causa"},//2
            {title: "numero control", data: "numero_control"},//3
            {title: "compromiso", data: "fecha_compromiso", visible:false},//4
            {title: "fecha programacion inicial", data: "fecha_programacion_inicial", visible:false},//5
            {title: "nueva fecha programacion", data: "nueva_fecha_programacion", visible:false},//6
            {title: "narrativa escalamiento", data: "narrativa_escalamiento"},//7
            {title: "estado", data: "estado_cc"},//8
            {title: "observaciones", data: "observaciones_cc"},//9
            {title: "faltantes", data: "faltantes"},//10
            {title: "en tiempo", data: "en_tiempos", visible:false},//11
            {title: "creado", data: "fecha_creacion_cc"}//12

        ]));
}

function configTableHistorial(data, columns, onDraw) {
    return {
        initComplete: function () {
            $('#tabla_Historial  tfoot th').each(function () {
                $(this).html('<input type="text" placeholder="Buscar" />');
            });

            var r = $('#tabla_Historial tfoot tr');
            r.find('th').each(function () {
                $(this).css('padding', 8);
            });
            $('#tabla_Historial thead').append(r);
            $('#search_0').css('text-align', 'center');

            // DataTable
            var table = $('#tabla_Historial').DataTable();

            // Apply the search
            table.columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });
        },
        data: data,
        columns: columns,
        "language": {
            "url": baseurl + "/assets/plugins/datatables/lang/es.json",
        },
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'colvisGroup',
                text: 'items',
                className: 'btn',
                show: [ 0,1,2,3,4,5],
                hide: [6,7,8,9,10,11]
            },
            {
                extend: 'colvisGroup',
                text: 'items 2',
                className: 'btn',
                show: [6,7,8,9,10,11],
                hide: [ 0,1,2,3,4,5]
            },
            
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
        searching: false,

        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

        columnDefs: [{
                // targets: -1,
                // visible: false,
                defaultContent: "",
                // targets: -1,
                orderable: false,
            }],
        order: [[0, 'desc']],
        drawCallback: onDraw
    }
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


