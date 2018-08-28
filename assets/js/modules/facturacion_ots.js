$(function () {
    billing = {
        init: function () {
            billing.events();
            billing.listOtpFacturacion();
        },

        //Eventos de la ventana.
        events: function () {
            $('#tables_billing').on('click', 'a.btnoths', billing.onClickShowModalOthFacturacion);
            $('#table_oths_otp').on('click', 'a.ver-det', billing.onClickShowModalDetFacturacion);
            $('#table_oths_otp').on('click', 'a.ver-log', billing.onClickShowEmailOthFacturacion);
        },

        // trae las ot padres que esten en estado facturacion 
        listOtpFacturacion: function () {
            $.post(baseurl + '/Facturacion_ots/c_getOtpFacturacion',
                    {
                        // idTipo: null // parametros que se envian
                    },
                    function (data) {
                        var obj = JSON.parse(data);
                        billing.printTableFacturacion(obj);
                    });
        },

        printTableFacturacion: function (data) {
            ///lleno la tabla con los valores enviados
            billing.tables_billing = $('#tables_billing').DataTable(billing.configTableFacturacion(data, [
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
                {title: "Opc", data: billing.getButtonsFacturacion},
            ]));
        },
        // Datos de configuracion del datatable
        configTableFacturacion: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    $('#tables_billing  tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });

                    var r = $('#tables_billing tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#tables_billing thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#tables_billing').DataTable();

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
                order: [[7, 'desc']],
                drawCallback: onDraw
            }
        },

        // obtengo los botones 
        getButtonsFacturacion: function (obj) {
            var botones = "<div class='btn-group'>"
                    + "<a class='btn btn-default btn-xs btnoths btn_datatable_cami' title='Ver OTH'><span class='fa fa-fw fa-eye'></span></a>"
                    + "</div>";
            return botones;
        },
        onClickShowModalOthFacturacion: function () {
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var record = billing.tables_billing.row(trParent).data();

            billing.getOthOfOtpFacturacion(record);
            // resetea el formulario y lo deja vacio
            document.getElementById("formModalOTHS").reset();
            //pinta el titulo del modal y cambia dependiendo de la otp seleccionada
            $('#myModalLabel').html('<strong> Lista OTH de la OTP N.' + record.k_id_ot_padre + '</strong>');
            $('#modalOthDeOtp').modal('show');
        },
        getOthOfOtpFacturacion: function (obj) {
            //metodo ajax (post)
            $.post(baseurl + '/OtPadre/c_getOthOfOtpCierre',
                    {
                        idOtp: obj.k_id_ot_padre
                    },
                    // funcion que recibe los datos 
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                billing.printTableOthFacturacion(obj);
                            }
                    );
        },
        printTableOthFacturacion: function (data) {
            //funcion para limpiar el modal 
            if (billing.table_oths_otp) {
                var tabla = billing.table_oths_otp;
                tabla.clear().draw();
                tabla.rows.add(data);
                tabla.columns.adjust().draw();
                return;
            }

            // nombramos la variable para la tabla y llamamos la configuiracion
            billing.table_oths_otp = $('#table_oths_otp').DataTable(billing.configTableSmall(data, [

                {title: "OTH", data: "id_orden_trabajo_hija"},
                {title: "Tipo OTH", data: "ot_hija"},
                {title: "Estado OTH", data: "estado_orden_trabajo_hija"},
                {title: "Recurrente", data: "MRC"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Programacion", data: "fecha_programacion"},
                {title: "Opc", data: billing.getButtonsOthFacturacion},
            ]));
        },
        // Datos de configuracion del datatable
        configTableSmall: function (data, columns, onDraw) {
            return {
                data: data,
                columns: columns,
                //lenguaje del plugin
                /*"language": { 
                 "url": baseurl + "assets/plugins/datatables/lang/es.json"
                 },*/
                columnDefs: [{
                        defaultContent: "",
                        targets: -1,
                        orderable: false,
                    }],
                order: [[0, 'asc']],
                drawCallback: onDraw
            }
        },
        getButtonsOthFacturacion: function (obj) {
            var botones = '<div class="btn-group" style="display: inline-flex;">';
            botones += '<a class="btn btn-default btn-xs ver-det btn_datatable_cami" title="Ver Detalle Oth"><span class="fa fa-fw fa-eye"></span></a>';
            if (obj.function != 0) {
                if (obj.c_email > 0) {
                    botones += '<a class="btn btn-default btn-xs ver-log btn_datatable_cami" title="Historial"><span class="fa fa-fw">' + obj.c_email + '</span></a>';
                } else {
                    botones += '<a class="btn btn-default btn-xs ver-log btn_datatable_cami" title="Historial"><span class="fa fa-fw fa-info"></span></a>';
                }
            }

            botones += '</div>';
            return botones;
        },
        onClickShowModalDetFacturacion: function () {
            document.getElementById("formModal_detalle").reset();
            $('#title_modal').html('');
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var record = billing.table_oths_otp.row(trParent).data();
            billing.fillFormModalDetFacturacion(record);
        },
        fillFormModalDetFacturacion: function (registros) {
            $.post(baseurl + '/OtHija/c_fillmodalsCierre',
                    {
                        idOth: registros.id_orden_trabajo_hija // parametros que se envian
                    },
                    function (data) {
                       $.each(data, function (i, item) {
                            $('#mdl_' + i).val(item);
                        }); 
                    });
            $('#title_modal').html('<b>Detalle de la orden  ' + registros.id_orden_trabajo_hija + '</b>');
            $('#Modal_detalle').modal('show');
        },
        onClickShowEmailOthFacturacion: function (obj) {
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var record = billing.table_oths_otp.row(trParent).data();
            $.post(baseurl + '/Log/getLogById',
                    {
                        id: record.id_orden_trabajo_hija
                    },
                    function (data) {
                        var obj = JSON.parse(data);
                        billing.showModalHistorialFacturacion(obj, record.id_orden_trabajo_hija);
                    }
            );
        },
        // Muestra modal detalle historial log por id
        showModalHistorialFacturacion: function (obj, idOth) {
            $('#ModalHistorialLog').modal('show');
            $('#titleEventHistory').html('Historial Cambios de orden ' + idOth + '');
            billing.printTableHistoryFacturacion(obj.log);
            billing.printTableLogMailFacturacion(obj.mail);
        },
        //pintamos la tabla de log
        printTableHistoryFacturacion: function (data) {
            // limpio el cache si ya habia pintado otra tabla
            if (billing.tableModalHistory) {
                //si ya estaba inicializada la tabla la destruyo
                billing.tableModalHistory.destroy();
            }
            ///lleno la tabla con los valores enviados
            billing.tableModalHistory = $('#tableHistorialLog').DataTable(billing.configTableSmall(data, [
                {data: "id_ot_hija"},
                {data: "antes"},
                {data: "ahora"},
                {data: "columna"},
                {data: "fecha_mod"}
            ]));
        },

        //pintamos la tabla de log de correos
        printTableLogMailFacturacion: function (data) {
            // limpio el cache si ya habia pintado otra tabla
            if (billing.tableModalLogMail) {
                //si ya estaba inicializada la tabla la destruyo
                billing.tableModalLogMail.destroy();
            }
            ///lleno la tabla con los valores enviados
            billing.tableModalLogMail = $('#table_log_mail').DataTable(billing.configTableSmall(data, [
                {data: "fecha"},
                {data: "clase"},
                {data: "servicio"},
                {data: "usuario_sesion"},
                {data: "destinatarios"},
                {data: "nombre"},
                {data: billing.getButonsPrintFacturacion}
            ]));

        },
        getButonsPrintFacturacion: function (obj) {
            var button = '<button class="btn btn-default btn-xs ver-mail btn_datatable_cami" title="ver correo"><span class="fa fa-fw fa-print"></span></button>'
            return button;

        },
    };
    billing.init();
});