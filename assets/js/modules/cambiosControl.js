// ****************************SECCION PARAAGREGAR LAS SEDES EN EL MODULO DE CONTROL DE CAMBIO****************************
$(function () {
    trackChangesHeadquarters = {
        init: function () {
            trackChangesHeadquarters.events();
            trackChangesHeadquarters.getListHeadquarters_table();

        },
        //Eventos de la ventana.
        events: function () {

        },
        getListHeadquarters_table: function () {
            //metodo ajax (post)
            $.post(baseurl + '/Sede/c_getListofficesTable',
                    {
                        //parametros

                    },
                    // función que recibe los datos
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                trackChangesHeadquarters.printTable(obj);
                            }
                    );
                },
        printTable: function (data) {
            // nombramos la variable para la tabla y llamamos la configuiracion que se encuentra en /assets/js/modules/helper.js
            trackChangesHeadquarters.trackChanges_Office = $('#trackChanges_Office').DataTable(trackChangesHeadquarters.configTableHeadquarters(data, [

                {title: "ID sede", data: "id_sede"},
                {title: "Nombre de la sede", data: "nombre_sede"},
                {title: "Ciudad", data: "ciudad"},
                {title: "Departamento", data: "departamento"},
                {title: "Dierección", data: "direccion"},
                {title: "Clasificación", data: "clasificacion"},
                {title: "Tipo de Oficina", data: "tipo_oficina"},
                {title: "Opc.", data: trackChangesHeadquarters.getButonsPrintOffice},
            ]));
        },
        // Datos de configuracion del datatable
        configTableHeadquarters: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    $('#trackChanges_Office  tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });

                    var r = $('#trackChanges_Office tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#trackChanges_Office thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#trackChanges_Office').DataTable();

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
        },

        getButonsPrintOffice: function (obj) {
            // return "<a class='ver-mail btn_datatable_cami'><span class='glyphicon glyphicon-print'></span></a>";
            var button = '<div class="btn-group" style="display: inline-flex;">';

            button += '<a href="'+ baseurl +'/Sede/otps_sede/'+obj.id_sede+'" target="_blank" class="btn btn-default btn-xs btn_datatable_cami" title="ver OTP"><span class="glyphicon glyphicon-eye-open"></span></a>';
            button += '<a class="btn btn-default btn-xs btn_datatable_cami" title="Evidencias"><span class="glyphicon glyphicon-file"></span></a>';
            button +='</div>';

            return button;

        },
    };
    trackChangesHeadquarters.init();


// ****************************SECCION PARAAGREGAR LAS SEDES EN EL MODULO DE CONTROL DE CAMBIO****************************

     controlCOTP = {
        init: function () {
            controlCOTP.events();
            controlCOTP.getListHeadquarters_table();

        },
        //Eventos de la ventana.
        events: function () {

        },
        getListHeadquarters_table: function () {
            //metodo ajax (post)
            $.post(baseurl + '/Sede/c_getListOTPTable',
                    {
                        //parametros

                    },
                    // función que recibe los datos
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                controlCOTP.printTable(obj);
                            }
                    );
                },
        printTable: function (data) {
            // nombramos la variable para la tabla y llamamos la configuiracion que se encuentra en /assets/js/modules/helper.js
            controlCOTP.trackChanges_Office = $('#trackChanges_OTP').DataTable(controlCOTP.configTableHeadquarters(data, [

                {title: "Nombre de la Sede", data: "nombre_sede"},
                {title: "ID OTP", data: "k_id_ot_padre"},
                {title: "Nombre Cliente", data: "n_nombre_cliente"},
                {title: "Tipo", data: "orden_trabajo"},
                {title: "Servicio", data: "servicio"},
                {title: "Estado OTP", data: "estado_orden_trabajo"},
                {title: "Opc.", data: controlCOTP.getButonsPrintOTP},
            ]));
        },
        // Datos de configuracion del datatable
        configTableHeadquarters: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    $('#trackChanges_OTP  tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });

                    var r = $('#trackChanges_OTP tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#trackChanges_OTP thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#trackChanges_OTP').DataTable();

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
        },

        getButonsPrintOTP: function (obj) {
            // return "<a class='ver-mail btn_datatable_cami'><span class='glyphicon glyphicon-print'></span></a>";

            var button = '<a class="btn btn-default btn-xs ver-mail btn_datatable_cami" title="ver OTP"><span class="   glyphicon glyphicon-eye-open"></span></a>'
 

            // var button = '<a class="btn btn-default btn-xs ver-mail btn_datatable_cami" title="ver OTP"><span class="   glyphicon glyphicon-eye-open"></span></a>'
            return button;

        },    
    };
    controlCOTP.init();
});