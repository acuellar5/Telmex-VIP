$(function () {
    cierre = {
        init: function () {
            cierre.events();
            cierre.list_ot();
        },

        //Eventos de la ventana.
        events: function () {
        	$('#tables_cierre').on('click', 'button#btn_check_all', cierre.selectAll);
        
        },

        // trae las ot 
        list_ot: function(){
            $.post(baseurl + '/cierre_ots/c_getOtsCierre',
            {
                // idTipo: null // parametros que se envian
            },

            function (data) {
            	var obj = JSON.parse(data);
                cierre.printTableCierre(obj);
            });
        },

        printTableCierre: function (data) {
            ///lleno la tabla con los valores enviados
            cierre.tables_cierre = $('#tables_cierre').DataTable(cierre.configTable(data, [
                {title: "Ingeniero", data: "ingeniero"},
                {title: "OTP", data: "k_id_ot_padre"},
                {title: "Cliente", data: "n_nombre_cliente"},
                {title: "Tipo", data: "orden_trabajo"},
                {title: "Servicio", data: "servicio"},
                {title: "Estado OTP", data: "estado_orden_trabajo"},
                {title: "program", data: "fecha_programacion"},
                {title: "comprom", data: "fecha_compromiso"},
                {title: "creación", data: "fecha_creacion"},
                {title: "Lista", data: "lista_observaciones"},
                {title: "Observación", data: "observacion"},
                {title: "<button class='btn_datatable_cami2' title='seleccionar todo' id='btn_check_all' data-check='false'><i class='fa fa-flag-checkered' aria-hidden='true'></i></button>", data: cierre.getButtonsCierre},
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                	$('#tables_cierre  tfoot th').each(function () {
		                $(this).html('<input type="text" placeholder="Buscar" />');
		            });

                    var r = $('#tables_cierre tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#tables_cierre thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#tables_cierre').DataTable();

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
                    select: {
		                rows: {
		                    _: " <b>Tienes %d seleccionadas</b>",
		                    0: " <b>presiona ctrl y selecciona las filas que necesites</b>",
		                    1: " <b>Solo una fila seleccionada</b>"
		                }
		            }
                },
                dom: 'Blfrtip',
                buttons: [
                    {
                        text: 'Excel <span class="fa fa-file-excel-o"></span>',
                        className: 'btn-cami_cool',
                        extend: 'excel',
                        title: 'ZOLID EXCEL',
                        filename: 'zolid ' + fecha_actual,
                    },
                    {
                        text: 'Imprimir <span class="fa fa-print"></span>',
                        className: 'btn-cami_cool',
                        extend: 'print',
                        title: 'Reporte Zolid',
                    },
                    {
                        text: 'Enrutar',
                        className: 'btn-cami_warning',
		                action: cierre.enrutar_otp,
                    },
                ],
                select: true,

                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

                columnDefs: [{
                        // targets: -1,
                        // visible: false,
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[7, 'desc']],
                drawCallback: onDraw
            }
        },

        // obtengo los botones 
        getButtonsCierre: function(obj){
            var botones = "<div class='btn-group'>"
                   ///////////////////////////////////////////////////////////se cambio la linea del boton
                        + "<a class='btn btn-default btn-xs btnoths btn_datatable_cami' title='Ver OTH'><span class='fa fa-fw fa-eye'></span></a>"
                    + "<a class='btn btn-default btn-xs ver-al btn_datatable_cami' title='Editar Ots'><span class='fa fa-fw fa-edit'></span></a>"
                    // + "<a class='btn btn-default btn-xs close-otp btn_datatable_cami' title='Cerrar Otp'><span class='fa fa-fw fa-power-off'></span></a>"
                    + "</div>";
            return botones;
        },

        
        // genero el check general
        checkAll: function(obj){
            return '<input type="checkbox" id="all_check">all';
        },

        // enrutar la orden
        enrutar_otp: function(e){
        	var cosas = cierre.tables_cierre.rows( { selected: true } ).data();// los datos de los elem seleccionados
        	// var cosas = cierre.tables_cierre.rows( { selected: true } ).nodes();// los elementos seleccionados
        	// var cosas = cierre.tables_cierre.rows( { selected: true } ).count();// cuantos filas se seleccionaron
        	// var cosas = cierre.tables_cierre.rows( { selected: true } ).any();// booleanos q indica si hay algo seleccionado

        	// table.rows( { selected: true } ).data();

        	console.log(cosas);

        },

        // selecciona todas las filas de la tabla y  las deselecciona
        selectAll: function(e){
        	if (!$(this).data('check')) {
            	cierre.tables_cierre.rows().select();
        		$(this).data('check', true);
        	} else {
        		$(this).data('check', false);
            	cierre.tables_cierre.rows().deselect();
        	}

        },
    };
    cierre.init();
});