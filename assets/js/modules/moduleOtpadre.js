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
            $.post(baseurl + '/OtPadre/c_getListOtsOtPadre',
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
            vista.table_otPadreList = $('#table_otPadreList').DataTable(vista.configTable(data, [

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
                {title: "Observaciónes dejadas", data: vista.getObservacionTotal},
                {title: "Opc", data: vista.getButtonsOTP},
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
                    },
                    {
                        text: '<span class="fa fa-envelope-o" aria-hidden="true"></span> Reporte Actualización',
                        className: 'btn-cami_cool btn-rpt_act',
                        action: eventos.otp_seleccionadas,
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
                order: [[7, 'desc']],
                drawCallback: onDraw
            }
        },

        // observacion con funcion de mostrar mas
        getObservacionTotal: function (obj) {

            if (typeof obj.observacion == 'string') {
                var array_cadena = obj.observacion.split(" ");
                var cadena = "";
                if (array_cadena.length > 10) {

                    for (var i = 0; i < 10; i++) {
                        cadena += array_cadena[i] + " ";
                    }


                    // console.log("cadena", cadena);

                    return `<div class="tooltipo">${cadena} <img class="rigth" style="width:15px; margin-left:96%;" src="${baseurl}/assets/images/plus.png">
                              <span class="tooltiptext">${obj.observacion}</span>
                            </div>
                            `;

                }
            }
            return obj.observacion;
        },

        getButtonsOTP: function (obj) {
            var span = '';
            var title = '';
            if (obj.cant_mails != 0) {
                span = "<span class='fa fa-fw '>" + obj.cant_mails + "</span>";
                title = (obj.cant_mails == 1) ? obj.cant_mails + " correo enviado" : obj.cant_mails + " correos enviados";
            } else {
                span = "<span class='fa fa-fw fa-eye'></span>";
                title = "ver OT Hijas";
            }

            var botones = "<div class='btn-group-vertical'>"
                    ///////////////////////////////////////////////////////////se cambio la linea del boton
                    + "<a class='btn btn-default btn-xs btnoths btn_datatable_cami' title='" + title + "'>" + span + "</a>"
                    + "<a class='btn btn-default btn-xs edit-otp btn_datatable_cami' title='Editar Ots'><span class='glyphicon glyphicon-save'></span></a>"
                    + "<a class='btn btn-default btn-xs hitos-otp btn_datatable_cami' data-btn='hito' title='Hitos Ots'><span class='glyphicon glyphicon-header'></span></a>"
//                    + "<a class='btn btn-default btn-xs close-otp btn_datatable_cami' data-btn='close' title='Cerrar Otp'><span class='fa fa-fw fa-power-off'></span></a>"
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
            $.post(baseurl + '/OtPadre/c_getListOtsOtPadreHoy',
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
            hoy.table_otPadreListHoy = $('#table_otPadreListHoy').DataTable(hoy.configTable(data, [

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
                {title: "Observaciónes dejadas", data: "observacion"},
                {title: "Opciones", data: vista.getButtonsOTP},
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
                    },
                    {
                        text: '<span class="fa fa-envelope-o" aria-hidden="true"></span> Reporte Actualización',
                        className: 'btn-cami_cool btn-rpt_act',
                        action: eventos.otp_seleccionadas,
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
            vencidas.getListOtsOtPadreVencidas();

        },
        //Eventos de la ventana.
        events: function () {

        },
        getListOtsOtPadreVencidas: function () {
            //metodo ajax (post)
            $.post(baseurl + '/OtPadre/c_getListOtsOtPadreVencidas',
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
            vencidas.table_otPadreListVencidas = $('#table_otPadreListVencidas').DataTable(vencidas.configTable(data, [

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
                {title: "Observaciónes dejadas", data: "observacion"},
                {title: "Opciones", data: vista.getButtonsOTP},
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
                    },
                    {
                        text: '<span class="fa fa-envelope-o" aria-hidden="true"></span> modalHitosOtp',
                        className: 'btn-cami_cool btn-rpt_act',
                        action: eventos.otp_seleccionadas,
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
                {title: "Observaciónes dejadas", data: "observacion"},
                {title: "Opciones", data: vista.getButtonsOTP},
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
                    },
                    {
                        text: '<span class="fa fa-envelope-o" aria-hidden="true"></span> Reporte Actualización',
                        className: 'btn-cami_cool btn-rpt_act',
                        action: eventos.otp_seleccionadas,
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

    // *******************************************EVENTOS ***************************
    eventos = {
        init: function () {
            eventos.events();
        },

        //Eventos de la ventana.
        events: function () {
            $('#contenido_tablas').on('click', 'a.close-otp', eventos.onClickBtnCloseOtp);
            $('#contenido_tablas').on('click', 'a.edit-otp', eventos.onClickBtnEditOtp);
            $('#table_oths_otp').on('click', 'a.ver-log', eventos.onClickShowEmailOth);
            $('#ModalHistorialLog').on('click', 'button.ver-mail', eventos.onClickVerLogMailOTP);// ver detalles de correo btn impresora
            // $('#table_oths_otp').on('click', 'a.ver-det', formulario.onClickShowModalEdit);
            // correccion scroll modal sobre modal
            $('#Modal_detalle').on("hidden.bs.modal", eventos.modal_sobre_modal);
            $('#ModalHistorialLog').on("hidden.bs.modal", eventos.modal_sobre_modal);
            $('#contenido_tablas').on('click', 'a.hitos-otp', eventos.onClickBtnCloseOtp);
            $('#btnGuardarModalHitos').on('click', eventos.onClickSaveHitosOtp);// ver detalles de correo btn impresora
            $('#table_selected').on('click', 'img.quitar_fila', eventos.quitarFila);
            $('#mdl-enviar-reporte').on('click', eventos.onClickSendReportUpdate);

        },

        // funcion para correcion modal sobre modal
        modal_sobre_modal: function (event) {
            if ($('.modal:visible').length) {
                $('body').addClass('modal-open');
            }
        },

        onClickBtnCloseOtp: function (e) {
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var tabla = aLinkLog.parents('table').attr('id');
            var record;
            switch (tabla) {
                case 'table_otPadreList':
                    record = vista.table_otPadreList.row(trParent).data();
                    break;
                case 'table_otPadreListHoy':
                    record = hoy.table_otPadreListHoy.row(trParent).data();
                    break;
                case 'table_otPadreListVencidas':
                    record = vencidas.table_otPadreListVencidas.row(trParent).data();
                    break;
                case 'table_list_opc':
                    record = lista.tableOpcList.row(trParent).data();
                    break;
                case 'table_otPadreListEmails':
                    record = emails.table_otPadreListEmails.row(trParent).data();
                    break;
            }

            var btn_clas = e.currentTarget;


            switch (btn_clas.dataset.btn) {
                case 'close':
                    eventos.closeOtp(record);
                    break;

                case 'hito':
                    eventos.showModalHitosOthp(record);
                    break;
            }

//            eventos.closeOtp(record);
        },

        closeOtp: function (data) {
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
            })

            swalWithBootstrapButtons({
                title: 'Advertencia',
                text: 'Esta seguro que desea cerrar la OT Padre ' + data.k_id_ot_padre,
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Continuar!',
                cancelButtonText: 'Cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.post(baseurl + '/OtPadre/c_closeOtp',
                            {
                                idOtp: data.k_id_ot_padre// parametros que se envian
                            },
                            function (data) {
                                var registro = JSON.parse(data);
                                if (registro.response == 'success') {
                                    swalWithBootstrapButtons(
                                            'OT padre Cerrada!',
                                            '',
                                            'success'
                                            )
                                } else {
                                    var oth = "";
                                    $.each(registro.oth_abiertas, function (i, item) {
                                        oth += item.id_orden_trabajo_hija + "<br>";
                                    });
                                    swalWithBootstrapButtons(
                                            "No es posible cerrar la OT padre",
                                            "La OT padre tiene " + registro.cant_oth_abiertas + " OT hijas abiertas, por favor cierre las siguientes OT hijas para poder cerrar la OT padre: \n" + oth,
                                            "error"
                                            );
                                    response = false;
                                    return false;
                                }
                            });
                } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                        ) {
                    swalWithBootstrapButtons(
                            '¡Cancelaste la operación!',
                            '',
                            'error'
                            )
                }
            });
        },
        onClickBtnEditOtp: function () {
            var btn_obs = $(this);
            var tr = btn_obs.parents('tr');
            var id_otp = tr.find('td').eq(0).html();

            swal.mixin({
                input: 'text',
                confirmButtonText: 'Siguiente &rarr;',
                showCancelButton: true,
                progressSteps: ['1', '2']
            }).queue([
                {
                    title: 'Lista',
                    text: 'Seleccione una opcion de la lista',
                    input: 'select',
                    inputClass: 'algo',
                    inputOptions: {

                        'EN PROCESOS CIERRE KO': 'EN PROCESOS CIERRE KO',
                        'ALIADO - PENDIENTE SOLICITAR ENTREGA DEL SERVICIO': 'ALIADO - PENDIENTE SOLICITAR ENTREGA DEL SERVICIO',
                        'ALIADO - SIN INFORMACIÓN ENTREGADA A TERCEROS PARA INICIAR PROCESO': 'ALIADO - SIN INFORMACIÓN ENTREGADA A TERCEROS PARA INICIAR PROCESO',
                        'ASIGNADO LIDER TECNICO': 'ASIGNADO LIDER TECNICO',
                        'CLIENTE - CAMBIO DE ALCANCE (CAMBIO DE TIPO DE SERVICIO)': 'CLIENTE - CAMBIO DE ALCANCE (CAMBIO DE TIPO DE SERVICIO)',
                        'CLIENTE - CAMBIO DE UBICACIÓN DE ULTIMA MILLA': 'CLIENTE - CAMBIO DE UBICACIÓN DE ULTIMA MILLA',
                        'CLIENTE - NO APRUEBA COSTOS DE OBRA CIVIL': 'CLIENTE - NO APRUEBA COSTOS DE OBRA CIVIL',
                        'CLIENTE - NO PERMITE CIERRE DE KO': 'CLIENTE - NO PERMITE CIERRE DE KO',
                        'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO',
                        'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO - REQUIERE VENTANA': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO - REQUIERE VENTANA',
                        'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL SURVEY O VISITA O CON TERCERO': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL SURVEY O VISITA O CON TERCERO',
                        'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL VOC': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL VOC',
                        'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA  DE ULTIMA MILLA CON TERCERO ': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA  DE ULTIMA MILLA CON TERCERO ',
                        'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EMPALMES': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EMPALMES',
                        'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EOC': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EOC',
                        'CLIENTE - NO TIENE DEFINIDA LA DIRECCIÓN DONDE VA A QUEDAR UBICADO EL SERVICIO': 'CLIENTE - NO TIENE DEFINIDA LA DIRECCIÓN DONDE VA A QUEDAR UBICADO EL SERVICIO',
                        'CLIENTE - PROGRAMADA POSTERIOR ': 'CLIENTE - PROGRAMADA POSTERIOR ',
                        'CLIENTE - SIN CONTRATO FIRMADO': 'CLIENTE - SIN CONTRATO FIRMADO',
                        'CLIENTE - SIN DISPONIBILIDAD DE INFRAESTRUCTURA (PLANTA TELEFONICA - LAN DIRECCIONAMIENTO )': 'CLIENTE - SIN DISPONIBILIDAD DE INFRAESTRUCTURA (PLANTA TELEFONICA - LAN DIRECCIONAMIENTO )',
                        'CLIENTE - SIN FECHA ADECUACIONES EN LA SEDE (ELECTRICAS Y/O FISICA)': 'CLIENTE - SIN FECHA ADECUACIONES EN LA SEDE (ELECTRICAS Y/O FISICA)',
                        'CLIENTE - SIN FECHA PARA RECIBIR EL SERVICIO': 'CLIENTE - SIN FECHA PARA RECIBIR EL SERVICIO',
                        'COEX - EN PROCESO DE CONFIGURACIÓN BACKEND': 'COEX - EN PROCESO DE CONFIGURACIÓN BACKEND',
                        'COEX -ATRASO CONFIGURACIÓN BACKEND': 'COEX -ATRASO CONFIGURACIÓN BACKEND',
                        'COMERCIAL - ESCALADO ORDEN DE REEMPLAZO': 'COMERCIAL - ESCALADO ORDEN DE REEMPLAZO',
                        'COMERCIAL - ESCALADO PENDIENTE INGRESO OTS': 'COMERCIAL - ESCALADO PENDIENTE INGRESO OTS',
                        'CONTROL DE CAMBIOS - RFC NO ESTANDAR EN APROBACIÓN': 'CONTROL DE CAMBIOS - RFC NO ESTANDAR EN APROBACIÓN',
                        'CSM - Retiro equipos - Renovación de Contrato': 'CSM - Retiro equipos - Renovación de Contrato',
                        'DATACENTER  CLARO- CABLEADO SIN EJECUTAR': 'DATACENTER  CLARO- CABLEADO SIN EJECUTAR',
                        'DATACENTER  CLARO- SIN CONSUMIBLES EN DATACENTER': 'DATACENTER  CLARO- SIN CONSUMIBLES EN DATACENTER',
                        'DATACENTER CLARO- CABLEADO EN CURSO': 'DATACENTER CLARO- CABLEADO EN CURSO',
                        'ENTREGA - SERVICIO ENTREGADO PROCESO DE CIERRE': 'ENTREGA - SERVICIO ENTREGADO PROCESO DE CIERRE',
                        'ENTREGA - SIN DISPONIBILIDAD AGENDA EN VERIFICACIÓN DE RECURSOS': 'ENTREGA - SIN DISPONIBILIDAD AGENDA EN VERIFICACIÓN DE RECURSOS',
                        'ENTREGA Y/O SOPORTE PROGRAMADO': 'ENTREGA Y/O SOPORTE PROGRAMADO',
                        'EQUIPOS - DEFECTUOSOS': 'EQUIPOS - DEFECTUOSOS',
                        'EQUIPOS - EN COMPRAS': 'EQUIPOS - EN COMPRAS',
                        'ESCALADO LIDER IMPLEMENTACIÓN PASO A PENDIENTE CLIENTE': 'ESCALADO LIDER IMPLEMENTACIÓN PASO A PENDIENTE CLIENTE',
                        'ESTADO CANCELADO': 'ESTADO CANCELADO',
                        'ESTADO PENDIENTE CLIENTE': 'ESTADO PENDIENTE CLIENTE',
                        'GPC - CAMBIO DE ALCANCE ORDEN DE PEDIDO': 'GPC - CAMBIO DE ALCANCE ORDEN DE PEDIDO',
                        'GPC - EN PROCESO DE CANCELACIÓN': 'GPC - EN PROCESO DE CANCELACIÓN',
                        'GPC - PENDIENTE ACEPTACIÓN CRONOGRAMA POR PARTE DEL CLIENTE': 'GPC - PENDIENTE ACEPTACIÓN CRONOGRAMA POR PARTE DEL CLIENTE',
                        'GPC - PENDIENTE INFORMACIÓN DEL CLIENTE PARA CONFIGURAR': 'GPC - PENDIENTE INFORMACIÓN DEL CLIENTE PARA CONFIGURAR',
                        'GPC - SIN ALCANCE PARA FABRICA': 'GPC - SIN ALCANCE PARA FABRICA',
                        'IMPLEMENTACIÓN - SOLUCIÓN NO ESTANDAR': 'IMPLEMENTACIÓN - SOLUCIÓN NO ESTANDAR',
                        'INCONVENIENTE TECNICO': 'INCONVENIENTE TECNICO',
                        'LIDER TECNICO - CAMBIO DE ALCANCE PLAN TECNICO': 'LIDER TECNICO - CAMBIO DE ALCANCE PLAN TECNICO',
                        'LIDER TECNICO - PENDIENTE PLAN TECNICO': 'LIDER TECNICO - PENDIENTE PLAN TECNICO',
                        'LIDER TECNICO - SOLUCIÓN NO ESTANDAR': 'LIDER TECNICO - SOLUCIÓN NO ESTANDAR',
                        'LIDER TECNICO - SOLUCIÓN NO ESTANDAR SIN DEFINICIÓN': 'LIDER TECNICO - SOLUCIÓN NO ESTANDAR SIN DEFINICIÓN',
                        'PASO A PENDIENTE CLIENTE': 'PASO A PENDIENTE CLIENTE',
                        'PENDIENTE SOLICITAR ENTREGA DEL SERVICIO': 'PENDIENTE SOLICITAR ENTREGA DEL SERVICIO',
                        'PLANTA EXTERNA - EN CURSO SIN INCONVENIENTE REPORTADO': 'PLANTA EXTERNA - EN CURSO SIN INCONVENIENTE REPORTADO',
                        'PLANTA EXTERNA - ERROR EN LA EJECUCIÓN DE EOC': 'PLANTA EXTERNA - ERROR EN LA EJECUCIÓN DE EOC',
                        'PLANTA EXTERNA - ESCALADO IFO RESULTADO DE ACTIVIDAD': 'PLANTA EXTERNA - ESCALADO IFO RESULTADO DE ACTIVIDAD',
                        'PLANTA EXTERNA - ESCALADO IFO SOLICITUD DE DESBORDE': 'PLANTA EXTERNA - ESCALADO IFO SOLICITUD DE DESBORDE',
                        'PLANTA EXTERNA - ESCALADO IFO SOLICITUD DE PERSONAL': 'PLANTA EXTERNA - ESCALADO IFO SOLICITUD DE PERSONAL',
                        'PLANTA EXTERNA - ETAPA INTERMEDIA - SIN CONFIRMACIÓN DE PERSONAL PARA EOC Y EMPALMES': 'PLANTA EXTERNA - ETAPA INTERMEDIA - SIN CONFIRMACIÓN DE PERSONAL PARA EOC Y EMPALMES',
                        'PLANTA EXTERNA - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO': 'PLANTA EXTERNA - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO',
                        'PLANTA EXTERNA - NO VIABLE EN FACTIBILIDAD POR TERCEROS': 'PLANTA EXTERNA - NO VIABLE EN FACTIBILIDAD POR TERCEROS',
                        'PLANTA EXTERNA - NO VIABLE EN FO - EN INSTALACIÓN POR HFC': 'PLANTA EXTERNA - NO VIABLE EN FO - EN INSTALACIÓN POR HFC',
                        'PLANTA EXTERNA - PERMISOS MUNICIPALES - PERMISOS DE ARRENDADOR DE INFRAESTRUCTURA': 'PLANTA EXTERNA - PERMISOS MUNICIPALES - PERMISOS DE ARRENDADOR DE INFRAESTRUCTURA',
                        'PLANTA EXTERNA - SIN APROBACIÓN DE TENDIDO EXTERNO POR COSTOS': 'PLANTA EXTERNA - SIN APROBACIÓN DE TENDIDO EXTERNO POR COSTOS',
                        'PREVENTA - NO ES CLARA LA SOLUCIÓN A IMPLEMENTAR': 'PREVENTA - NO ES CLARA LA SOLUCIÓN A IMPLEMENTAR',
                        'PREVENTA - SIN ID  FACTIBILIDAD PARA TERCEROS': 'PREVENTA - SIN ID  FACTIBILIDAD PARA TERCEROS',
                        'PROYECTO ÉXITO ANTIGUO': 'PROYECTO ÉXITO ANTIGUO',
                        'TERCEROS - EN CURSO SIN INCONVENIENTE REPORTADO': 'TERCEROS - EN CURSO SIN INCONVENIENTE REPORTADO',
                        'TERCEROS - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO': 'TERCEROS - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO',
                        'TERCEROS - NO VIABLE - EN PROCESO NOTIFICACIÓN A CLIENTE Y COMERCIAL PARA CANCELACIÓN': 'TERCEROS - NO VIABLE - EN PROCESO NOTIFICACIÓN A CLIENTE Y COMERCIAL PARA CANCELACIÓN',
                        'TERCEROS - SIN AVANCE SOBRE LA FECHA DE ENTREGA DE ULTIMA MILL': 'TERCEROS - SIN AVANCE SOBRE LA FECHA DE ENTREGA DE ULTIMA MILLA'
                    },
                    inputPlaceholder: 'Seleccione...',
                    showCancelButton: true
                },
                {
                    title: 'Observaciones',
                    text: '¿Desea guardar observaciones?',
                    input: 'textarea',
                    // inputClass: 'algo' ,
                    confirmButtonText: 'Guardar!',
                    inputOptions: {

                    },
                    inputPlaceholder: 'Observaciones...',
                    showCancelButton: true
                },
            ]).then((result) => {
                if (result.value) {
                    if (!result.value[0] == "") {

                        swal({
                            title: 'Desea guardar?',
                            text: "Se actualizará esta informacion en esta OTP",
                            type: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Guardar!'
                        }).then((result1) => {
                            if (result1.value) {
                                $.post(baseurl + '/OtPadre/update_data',
                                        {
                                            // clave: 'valor' // parametros que se envian
                                            id: id_otp,
                                            lista: result.value[0],
                                            observacion: result.value[1]
                                        },
                                        function (data) {
                                            var res = JSON.parse(data);
                                            if (res == true) {
                                                swal(
                                                        'Guardado!',
                                                        'Actualizo correctamente los campos',
                                                        'success'
                                                        )
                                                setTimeout("location.reload()", 1500);
                                            } else {
                                                swal('Error',
                                                        'No tiene permiso para esta accíon',
                                                        'error'
                                                        )
                                            }
                                        });
                            } else {
                                swal({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'No se actuallizo ningun campo!',
                                })
                            }
                        })
                    } else {
                        swal({
                            type: 'error',
                            title: 'Error',
                            text: 'No selecciono ningun registro de la lista',
                        })
                    }
                }

            })
        },
        onClickShowEmailOth: function (obj) {
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var record = listoth.table_oths_otp.row(trParent).data();
            $.post(baseurl + '/Log/getLogById',
                    {
                        id: record.id_orden_trabajo_hija
                    },
                    function (data) {
                        var obj = JSON.parse(data);
                        eventos.showModalHistorial(obj, record.id_orden_trabajo_hija);
                    }
            );
        },
        // Muestra modal detalle historial log por id
        showModalHistorial: function (obj, id_orden_trabajo_hija) {
            $('#ModalHistorialLog').modal('show');
            $('#titleEventHistory').html('Historial Cambios de orden ' + id_orden_trabajo_hija + '');
            eventos.printTableHistory(obj.log);
            eventos.printTableLogMail(obj.mail);
        },
        //pintamos la tabla de log
        printTableHistory: function (data) {
            // limpio el cache si ya habia pintado otra tabla
            if (eventos.tableModalHistory) {
                //si ya estaba inicializada la tabla la destruyo
                eventos.tableModalHistory.destroy();
            }
            ///lleno la tabla con los valores enviados
            eventos.tableModalHistory = $('#tableHistorialLog').DataTable(listoth.configTable(data, [
                {data: "id_ot_hija"},
                {data: "antes"},
                {data: "ahora"},
                {data: "columna"},
                {data: "fecha_mod"}
            ]));
        },

        //pintamos la tabla de log de correos
        printTableLogMail: function (data) {
            // limpio el cache si ya habia pintado otra tabla
            if (eventos.tableModalLogMail) {
                //si ya estaba inicializada la tabla la destruyo
                eventos.tableModalLogMail.destroy();
            }
            ///lleno la tabla con los valores enviados
            eventos.tableModalLogMail = $('#table_log_mail').DataTable(listoth.configTable(data, [
                {data: "fecha"},
                {data: "clase"},
                {data: "servicio"},
                {data: "usuario_en_sesion"},
                {data: "destinatarios"},
                {data: "nombre"},
                {data: eventos.getButonsPrint}
            ]));

        },
        // creamos los botones para imprimir el correo enviado
        getButonsPrint: function (obj) {
            var button = '<button class="btn btn-default btn-xs ver-mail btn_datatable_cami" title="ver correo"><span class="fa fa-fw fa-print"></span></button>'
            return button;

        },

        onClickVerLogMailOTP: function () {
            var tr = $(this).parents('tr');
            var record = eventos.tableModalLogMail.row(tr).data();

            eventos.generarPDF(record);
        },

        // generar pdf redireccionar
        generarPDF: function (data) {
            $.post(baseurl + '/Templates/generatePDF',
                    {
                        data: data
                    },
                    function (data) {
                        var plantilla = JSON.parse(data);
                        $('body').append(
                                `
                            <form action="${baseurl}/Log/view_email" method="POST" target="_blank" hidden>
                                <textarea name="txt_template" id="txt_template"></textarea>
                                <input type="submit" value="e" id="smt_ver_correo">
                            </form>
                        `
                                );
                        $('#txt_template').val(plantilla);
                        $('#smt_ver_correo').click();


                    });

        },

        onClickShowModalDetEvent: function () {
            document.getElementById("formModal_detalle").reset();
            $('#title_modal').html('');
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var record = listoth.table_oths_otp.row(trParent).data();
            eventos.fillFormModalDetEvent(record);
        },
        fillFormModalDetEvent: function (registros) {
            $.post(baseurl + '/OtHija/c_fillmodals',
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
        // Muestra los hitos de la ot padre seleccionada
        showModalHitosOthp: function (data) {
            // resetea el formulario y lo deja vacio
            document.getElementById("formModalHitosOTP").reset();
            $.post(baseurl + '/OtPadre/c_getHitosOtp',
                    {
                        idOtp: data.k_id_ot_padre
                    },
                    function (data) {
                        var obj = JSON.parse(data);

                        $(".timeline-badge").css("background-color", "#7c7c7c");
                        if (obj !== null) {

                            switch (obj.actividad_actual) {
                                case "KICK OFF":
                                    $("#act_ko").css("background-color", "#4bd605");
                                    break;

                                case "VISITA OBRA CIVIL":
                                    $("#act_voc").css("background-color", "#4bd605");
                                    break;

                                case "VISITA OBRA CIVIL TERCEROS":
                                    $("#act_voc").css("background-color", "#4bd605");
                                    break;

                                case "ENVIO COTIZACION":
                                    $("#act_ec").css("background-color", "#4bd605");
                                    break;

                                case "APROBACION COTIZACION":
                                    $("#act_ac").css("background-color", "#4bd605");
                                    break;

                                case "SOLICITUD INFORMACIÓN TECNICA":
                                    $("#act_sit").css("background-color", "#4bd605");
                                    break;

                                case "VISITA EJECUCION OBRA CIVIL":
                                    $("#act_veoc").css("background-color", "#4bd605");
                                    break;

                                case "VISITA EJECUCION OBRA CIVIL TERCERO":
                                    $("#act_veoc").css("background-color", "#4bd605");
                                    break;

                                case "CONFIGURACION RED CLARO":
                                    $("#act_crc").css("background-color", "#4bd605");
                                    break;

                                case "VISITA ENTREGA UM TERCEROS":
                                    $("#act_veut").css("background-color", "#4bd605");
                                    break;
                            }

                            $.each(obj, function (i, item) {
                                $('#' + i).val(item);
                            });
                        }
                    });

            //pinta el titulo del modal y cambia dependiendo de la otp seleccionada
            $('#myModalLabelHitos').html('<strong> Hitos de la OTP N.<span id="otpHIto">' + data.k_id_ot_padre + '</span></strong>');
            $('#servivio_hito').html('<strong> OT ' + data.k_id_ot_padre + ' - ' + data.servicio + '</strong>');
            $('#cliente_hito').html('<strong> CLIENTE: ' + data.n_nombre_cliente + '</strong>');
            $('#ciudad_hito').html('<strong> CIUDAD: BARRANQUILLA - Vía Cordialidad # 8E1 - 238</strong>');
            $('#modalHitosOtp').modal('show');
        },
        // Muestra los hitos de la ot padre seleccionada
        onClickSaveHitosOtp: function () {
            var vacios = 0;
            $('.fechas_hitos').each(function () {
                if ($(this).val() == '') {
                    vacios++;
                }
            });

            if (vacios == 0) {
                $.post(baseurl + '/OtPadre/c_saveHitosOtp',
                        {
                            idOtp: $('#otpHIto').html(),
                            formulario: $("#formModalHitosOTP").serializeArray()
                        },
                        function (data) {
                            var obj = JSON.parse(data);
                            if (obj.response == 'success') {
                                swal({
                                    position: 'top-end',
                                    type: 'success',
                                    title: obj.msg,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#modalHitosOtp').modal('toggle');
                                location.reload();
                            } else {
                                swal(
                                        'Error',
                                        obj.msg,
                                        'error'
                                        )
                            }

                        });
            } else {
                swal(
                    'Recuerde!',
                    'Para poder Guardar la información debe diligenciar todas las fechas de compromiso',
                    'warning'
                );
            }


        },
        // muestra las otp seleccionadas dependiendo la tabla
        otp_seleccionadas: function () {
            var tabla = $('ul#pestania').find('li.active').attr('tabla');
            ;
            var record;
            switch (tabla) {
                case 'table_otPadreList':
                    record = vista.table_otPadreList;
                    break;
                case 'table_otPadreListHoy':
                    record = hoy.table_otPadreListHoy;
                    break;
                case 'table_otPadreListVencidas':
                    record = vencidas.table_otPadreListVencidas;
                    break;
                case 'table_list_opc':
                    record = lista.tableOpcList;
                    break;
                case 'table_otPadreListEmails':
                    record = emails.table_otPadreListEmails;
                    break;
            }

            let hay_sel = record.rows({selected: true}).any();// booleanos q indica si hay algo seleccionado
            var seleccionadas = record.rows({selected: true}).data();// los datos de los elem seleccionados
            if (hay_sel) {
                eventos.modalSeleccionadas(seleccionadas);

                var cuantas = record.rows({selected: true}).count();
                $('#mdl-title-cierre').html(`<b>${cuantas}</b> ORDENES SELECCIONADAS`);

                $('#mdl_cierre').modal('show');

            } else {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000
                });
                toast({
                    type: 'error',
                    title: 'No seleccionaste ninguna fila!'
                });
            }

        },
        modalSeleccionadas: function (data) {
            if (eventos.table_selected) {
                var tabla = eventos.table_selected;
                tabla.clear().draw();
                tabla.rows.add(data);
                tabla.columns.adjust().draw();
                return;
            }

            eventos.table_selected = $('#table_selected').DataTable(eventos.configTableSelect(data, [
                {title: "Ingeniero", data: "ingeniero"},
                {title: "OTP", data: "k_id_ot_padre"},
                {title: "Cliente", data: "n_nombre_cliente"},
                {title: "Tipo", data: "orden_trabajo"},
                {title: "Servicio", data: "servicio"},
                {title: "Estado OTP", data: "estado_orden_trabajo"},
                {title: "Lista", data: "lista_observaciones"},
                {title: "Observación", data: "observacion"},
                {title: "Quitar", data: eventos.getButtonQuitar},
            ]));

        },

        configTableSelect: function (data, columns, onDraw) {
            return {
                data: data,
                columns: columns,
                "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json"
                },
                columnDefs: [{
                        defaultContent: "",
                        targets: -1,
                        orderable: false,
                    }],
                order: [[3, 'asc']],
                drawCallback: onDraw,
                "createdRow": function (row, data, dataIndex) {
                    if (data["id_hitos"] == null) {
                        $(row).css("background-color", "#ff000087");
                    }
                },
            }
        },
        // retorna el boton para quitar registro
        getButtonQuitar: function (obj) {
            const button = `<img src="${baseurl}/assets/images/minus.png" alt="quitar" class="quitar_fila"/>`;
            return button;
        },
        // elimina la fila 
        quitarFila: function (e) {
            eventos.table_selected.row($(this).parents('tr')).remove().draw();// remover de la tabla modal
            var cuantas = eventos.table_selected.rows().count();
            $('#mdl-title-cierre').html(`<b>${cuantas}</b> ORDENES SELECCIONADAS`);

        },
        //Envia el reporte de actualizacion dependiendo de las OTP seleccionadas
        onClickSendReportUpdate: function () {
            var tableSelected = eventos.table_selected.rows().data();
            var ids_otp = [];
            var flag = true;
            tableSelected.each(function (otp) {
                ids_otp.push(otp.k_id_ot_padre);
//                console.log(otp.id_hitos);
                if (otp.id_hitos === null) {
                    flag = false;
                }
            });

            if (flag) {
                $.post(baseurl + '/OtPadre/c_sendReportUpdate',
                        {
                            ids_otp: ids_otp
                        },
                        function (data) {
                            var obj = JSON.parse(data);
                            swal(
                                (obj.success) ? 'Correo enviado' : 'Error',
                                obj.msg,
                                (obj.success) ? 'success' : 'error'
                            );
                        });
            } else {
                swal(
                    'Recuerde!',
                    'No se puede enviar el email sin haber diligenciado los hitos de los registros marcados en rojo',
                    'warning'
                );
            }


//            console.log(ids_otp);
        }

    };
    eventos.init();

// ******************************************TABLA QUE TRAER TODAS LAS OTHS DE UNA OTP SELECCIONADA ***************************

    listoth = {

        init: function () {
            listoth.events();
            //listoth.getothofothp();
        },
        //Eventos de la ventana.
        events: function () {
            // al darle clic al boton de opciones traiga el modal
            $('#contenido_tablas').on('click', 'a.btnoths', listoth.onClickShowModal);

        },

        onClickShowModal: function () {
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var tabla = aLinkLog.parents('table').attr('id');
            var record;
            switch (tabla) {
                case 'table_otPadreList':
                    record = vista.table_otPadreList.row(trParent).data();
                    break;
                case 'table_otPadreListHoy':
                    record = hoy.table_otPadreListHoy.row(trParent).data();
                    break;
                case 'table_otPadreListVencidas':
                    record = vencidas.table_otPadreListVencidas.row(trParent).data();
                    break;
                case 'table_list_opc':
                    record = lista.tableOpcList.row(trParent).data();
                    break;
                case 'table_otPadreListEmails':
                    record = emails.table_otPadreListEmails.row(trParent).data();
                    break;
            }

            listoth.showModalOthDeOthp(record);
        },

        getothofothp: function (obj) {
            //metodo ajax (post)
            $.post(baseurl + '/OtPadre/c_getOthOfOtp',
                    {
                        idOtp: obj.k_id_ot_padre
                    },
                    // funcion que recibe los datos
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                listoth.printTable(obj);
                            }
                    );
                },

        // Muestra modal con todas las ots hija de la otp seleccionada
        showModalOthDeOthp: function (data) {
            listoth.getothofothp(data);
            // resetea el formulario y lo deja vacio
            document.getElementById("formModalOTHS").reset();
            //pinta el titulo del modal y cambia dependiendo de la otp seleccionada
            $('#myModalLabel').html('<strong> Lista OTH de la OTP N.' + data.k_id_ot_padre + '</strong>');
            $('#modalOthDeOtp').modal('show');
        },
        //pintar tabla
        printTable: function (data) {
            //funcion para limpiar el modal
            if (listoth.table_oths_otp) {
                var tabla = listoth.table_oths_otp;
                tabla.clear().draw();
                tabla.rows.add(data);
                tabla.columns.adjust().draw();
                return;
            }

            // nombramos la variable para la tabla y llamamos la configuiracion
            listoth.table_oths_otp = $('#table_oths_otp').DataTable(listoth.configTable(data, [

                {title: "OTH", data: "id_orden_trabajo_hija"},
                {title: "Tipo OTH", data: "ot_hija"},
                {title: "Estado OTH", data: "estado_orden_trabajo_hija"},
                {title: "Recurrente", data: "MRC"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Programacion", data: "fecha_programacion"},
                {title: "Opc", data: listoth.getButtonsOth},
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
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
        getButtonsOth: function (obj) {
            var botones = '<div class="btn-group" style="display: inline-flex;">';
            botones += '<a class="btn btn-default btn-xs ver-det btn_datatable_cami" title="Editar Oth"><span class="fa fa-fw fa-edit"></span></a>';
            if (obj.function != 0) {
                if (obj.c_email > 0) {
                    botones += '<a class="btn btn-default btn-xs ver-log btn_datatable_cami" title="Historial"><span class="fa fa-fw">' + obj.c_email + '</span></a>';
                } else {
                    botones += '<a class="btn btn-default btn-xs ver-log btn_datatable_cami" title="Historial"><span class="fa fa-fw fa-info"></span></a>';
                }
            }

            botones += '</div>';
            return botones;
        }
    };
    listoth.init();

    //*********************************** lista las  ot padres con emails enviados
    emails = {
        init: function () {
            emails.events();
            emails.getListOtsOtPadreEmail();

        },
        //Eventos de la ventana.
        events: function () {

        },
        getListOtsOtPadreEmail: function () {
            //metodo ajax (post)
            $.post(baseurl + '/OtPadre/c_getListOtsOtPadreEmail',
                    {
                        //parametros

                    },
                    // funcion que recibe los datos
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                emails.printTableEmail(obj);
                            }
                    );
                },
        printTableEmail: function (data) {
            // nombramos la variable para la tabla y llamamos la configuiracion
            emails.table_otPadreListEmails = $('#table_otPadreListEmails').DataTable(emails.configTableEmail(data, [
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
                {title: "Observaciónes dejadas", data: "observacion"},
                {title: "Opc", data: vista.getButtonsOTP},
            ]));
        },
        // Datos de configuracion del datatable
        configTableEmail: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    $('#table_otPadreListEmails tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    var r = $('#table_otPadreListEmails tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#table_otPadreListEmails thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#table_otPadreListEmails').DataTable();

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
                    },
                    {
                        text: '<span class="fa fa-envelope-o" aria-hidden="true"></span> Reporte Actualización',
                        className: 'btn-cami_cool btn-rpt_act',
                        action: eventos.otp_seleccionadas,
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
                order: [[11, 'desc']],
                drawCallback: onDraw
            }
        }
    };
    emails.init();

});
