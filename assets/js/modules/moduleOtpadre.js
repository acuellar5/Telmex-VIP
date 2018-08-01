// *******************************************TABLAS de OT PADRE ***************************
$(function () {
    vista = {
        init: function () {
            vista.events();
            vista.getListOtsOtPadre();

        },
        //Eventos de la ventana.
        events: function () {

        },
        getListOtsOtPadre: function () {
            //metodo ajax (post)
            $.post(baseurl + '/OtPadre/getListOtsOtPadre',
                    {
                        //parametros

                    },
                    // funcion que recibe los datos 
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                vista.printTable(obj);
                            }
                    );
                },
        printTable: function (data) {
            // nombramos la variable para la tabla y llamamos la configuiracion
            vista.tablePorject = $('#table_otPadreList').DataTable(vista.configTable(data, [

                {title: "Ot Padre", data: "k_id_ot_padre"},
                {title: "Nombre Cliente", data: "n_nombre_cliente"},
                {title: "Tipo", data: "orden_trabajo"},
                {title: "Servicio", data: "servicio"},
                {title: "Estado OT Padre", data: "estado_orden_trabajo"},
                {title: "Fecha Programación", data: "fecha_programacion"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Creación", data: "fecha_creacion"},
                {title: "Ingeniero", data: "ingeniero"},
                {title: "Lista", data: "lista_observaciones"},
                {title: "Observación", data: "observacion"},
                {title: "Opciones", data: vista.getButtons},
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    $('#table_otPadreList tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    var r = $('#table_otPadreList tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#table_otPadreList thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#table_otPadreList').DataTable();

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
                ordering: false,
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
        getButtons: function (obj) {
            var botones = "<div class='btn-group-vertical'>"
                        + "<a class='btn btn-default btn-xs ver-al btn_datatable_cami' title='Editar Ots'><span class='fa fa-fw fa-edit'></span></a>"
                        + "<a class='btn btn-default btn-xs ver-al btn_datatable_cami' title='Editar Ots'><span class='fa fa-fw fa-edit'></span></a>"
                        + "<a class='btn btn-default btn-xs ver-al btn_datatable_cami' title='Editar Ots'><span class='fa fa-fw fa-edit'></span></a>"
                        + "</div>";
            return botones;
        }
    };
    vista.init();

    /**********************TABLA OT PADRES CON FECHA COMPROMISO EN HOY**************************/
    hoy = {
        init: function () {
            hoy.events();
            hoy.getListOtsOtPadreHoy();

        },
        //Eventos de la ventana.
        events: function () {

        },
        getListOtsOtPadreHoy: function () {
            //metodo ajax (post)
            $.post(baseurl + '/OtPadre/getListOtsOtPadreHoy',
                    {
                        //parametros

                    },
                    // funcion que recibe los datos 
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                hoy.printTable(obj);
                            }
                    );
                },
        printTable: function (data) {
            // nombramos la variable para la tabla y llamamos la configuiracion
            hoy.tablePorjectHoy = $('#table_otPadreListHoy').DataTable(hoy.configTable(data, [

                {title: "Ot Padre", data: "k_id_ot_padre"},
                {title: "Nombre Cliente", data: "n_nombre_cliente"},
                {title: "Tipo", data: "orden_trabajo"},
                {title: "Servicio", data: "servicio"},
                {title: "Estado OT Padre", data: "estado_orden_trabajo"},
                {title: "Fecha Programación", data: "fecha_programacion"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Creación", data: "fecha_creacion"},
                {title: "Ingeniero", data: "ingeniero"},
                {title: "Lista", data: "lista_observaciones"},
                {title: "Observación", data: "observacion"},
                {title: "Opciones", data: vista.getButtons},
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    $('#table_otPadreListHoy tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    var r = $('#table_otPadreListHoy tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#table_otPadreListHoy thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#table_otPadreListHoy').DataTable();

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
                ordering: false,
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
        }
    };
    hoy.init();

    /**********************TABLA OT PADRES CON FECHA COMPROMISO VENCIDA**************************/
    vencidas = {
        init: function () {
            vencidas.events();
            vencidas.getListOtsOtPadreHoy();

        },
        //Eventos de la ventana.
        events: function () {

        },
        getListOtsOtPadreHoy: function () {
            //metodo ajax (post)
            $.post(baseurl + '/OtPadre/getListOtsOtPadreVencidas',
                    {
                        //parametros

                    },
                    // funcion que recibe los datos 
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                vencidas.printTable(obj);
                            }
                    );
                },
        printTable: function (data) {
            // nombramos la variable para la tabla y llamamos la configuiracion
            vencidas.tablePorjectVencidas = $('#table_otPadreListVencidas').DataTable(vencidas.configTable(data, [

                {title: "Ot Padre", data: "k_id_ot_padre"},
                {title: "Nombre Cliente", data: "n_nombre_cliente"},
                {title: "Tipo", data: "orden_trabajo"},
                {title: "Servicio", data: "servicio"},
                {title: "Estado OT Padre", data: "estado_orden_trabajo"},
                {title: "Fecha Programación", data: "fecha_programacion"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Creación", data: "fecha_creacion"},
                {title: "Ingeniero", data: "ingeniero"},
                {title: "Lista", data: "lista_observaciones"},
                {title: "Observación", data: "observacion"},
                {title: "Opciones", data: vista.getButtons},
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    $('#table_otPadreListVencidas tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    var r = $('#table_otPadreListVencidas tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#table_otPadreListVencidas thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#table_otPadreListVencidas').DataTable();

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
                ordering: false,
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
        }
    };
    vencidas.init();

    /**********************TABLA OT PADRES PARA FILTRO POR OPC DE LISTA**************************/
    lista = {
        init: function () {
            lista.events();
            lista.getOtpByOpcListJs();

        },
        //Eventos de la ventana.
        events: function () {
            $('#select_filter').change(lista.cambio_opc);
        },
        getOtpByOpcListJs: function (value = null) {
            //metodo ajax (post)
            var opcion = (value) ? value : "EN PROCESOS CIERRE KO";
            $.post(baseurl + '/OtPadre/c_getOtpByOpcList',
                    {
                        opcion: opcion

                    },
                    // funcion que recibe los datos 
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                lista.printTable(obj);
                            }
                    );
                },

        printTable: function (data) {
            if (lista.tableOpcList) {
                var tabla = lista.tableOpcList;
                tabla.clear().draw();
                tabla.rows.add(data);
                tabla.columns.adjust().draw();
                return;
            }


            // nombramos la variable para la tabla y llamamos la configuiracion
            lista.tableOpcList = $('#table_list_opc').DataTable(lista.configTable(data, [

                {title: "Ot Padre", data: "k_id_ot_padre"},
                {title: "Nombre Cliente", data: "n_nombre_cliente"},
                {title: "Tipo", data: "orden_trabajo"},
                {title: "Servicio", data: "servicio"},
                {title: "Estado OT Padre", data: "estado_orden_trabajo"},
                {title: "Fecha Programación", data: "fecha_programacion"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Creación", data: "fecha_creacion"},
                {title: "Ingeniero", data: "ingeniero"},
                {title: "Lista", data: "lista_observaciones"},
                {title: "Observación", data: "observacion"},
                {title: "Opciones", data: vista.getButtons},
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    $('#table_list_opc tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    var r = $('#table_list_opc tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#table_list_opc thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#table_list_opc').DataTable();

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
                ordering: false,
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

        // cuando se cambia de opcion
        cambio_opc: function () {
            var opcion = $('#select_filter').val();
            lista.getOtpByOpcListJs(opcion);
        },
    };
    lista.init();
});
