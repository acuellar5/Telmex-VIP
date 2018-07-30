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
                {title: "Lista", data: vista.getSelect},
                {title: "Observación", data: vista.getObservaciones},
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
        getSelect: function (obj) {
            var select = "<select class='form-control select2_js_detalles max_width_select' name='lista' style>"
                            + "<option value='EN PROCESOS CIERRE KO'>EN PROCESOS CIERRE KO</option>"
                            + "<option value='ALIADO - PENDIENTE SOLICITAR ENTREGA DEL SERVICIO'>ALIADO - PENDIENTE SOLICITAR ENTREGA DEL SERVICIO</option>"
                            + "<option value='ALIADO - SIN INFORMACIÓN ENTREGADA A TERCEROS PARA INICIAR PROCESO'>ALIADO - SIN INFORMACIÓN ENTREGADA A TERCEROS PARA INICIAR PROCESO</option>"
                            + "<option value='ASIGNADO LIDER TECNICO'>ASIGNADO LIDER TECNICO</option>"
                            + "<option value='CLIENTE - CAMBIO DE ALCANCE (CAMBIO DE TIPO DE SERVICIO)'>CLIENTE - CAMBIO DE ALCANCE (CAMBIO DE TIPO DE SERVICIO)</option>"
                            + "<option value='CLIENTE - CAMBIO DE UBICACIÓN DE ULTIMA MILLA'>CLIENTE - CAMBIO DE UBICACIÓN DE ULTIMA MILLA</option>"
                            + "<option value='CLIENTE - NO APRUEBA COSTOS DE OBRA CIVIL'>CLIENTE - NO APRUEBA COSTOS DE OBRA CIVIL</option>"
                            + "<option value='CLIENTE - NO PERMITE CIERRE DE KO'>CLIENTE - NO PERMITE CIERRE DE KO</option>"
                            + "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO</option>"
                            + "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO - REQUIERE VENTANA'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO - REQUIERE VENTANA</option>"
                            + "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL SURVEY O VISITA O CON TERCERO'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL SURVEY O VISITA O CON TERCERO</option>"
                            + "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL VOC'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL VOC</option>"
                            + "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA  DE ULTIMA MILLA CON TERCERO '>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA  DE ULTIMA MILLA CON TERCERO </option>"
                            + "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EMPALMES'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EMPALMES</option>"
                            + "<option value='CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EOC'>CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EOC</option>"
                            + "<option value='CLIENTE - NO TIENE DEFINIDA LA DIRECCIÓN DONDE VA A QUEDAR UBICADO EL SERVICIO'>CLIENTE - NO TIENE DEFINIDA LA DIRECCIÓN DONDE VA A QUEDAR UBICADO EL SERVICIO</option>"
                            + "<option value='CLIENTE - PROGRAMADA_POSTERIOR '>CLIENTE - PROGRAMADA_POSTERIOR </option>"
                            + "<option value='CLIENTE - SIN CONTRATO FIRMADO'>CLIENTE - SIN CONTRATO FIRMADO</option>" 
                            + "<option value='CLIENTE - SIN DISPONIBILIDAD DE INFRAESTRUCTURA (PLANTA TELEFONICA - LAN DIRECCIONAMIENTO )'>CLIENTE - SIN DISPONIBILIDAD DE INFRAESTRUCTURA (PLANTA TELEFONICA - LAN DIRECCIONAMIENTO )</option>"
                            + "<option value='CLIENTE - SIN FECHA ADECUACIONES EN LA SEDE (ELECTRICAS Y/O FISICA)'>CLIENTE - SIN FECHA ADECUACIONES EN LA SEDE (ELECTRICAS Y/O FISICA)</option>"
                            + "<option value='CLIENTE - SIN FECHA PARA RECIBIR EL SERVICIO'>CLIENTE - SIN FECHA PARA RECIBIR EL SERVICIO</option>"
                            + "<option value='COEX - EN PROCESO DE CONFIGURACIÓN BACKEND'>COEX - EN PROCESO DE CONFIGURACIÓN BACKEND</option>"
                            + "<option value='COEX -ATRASO CONFIGURACIÓN BACKEND'>COEX -ATRASO CONFIGURACIÓN BACKEND</option>"
                            + "<option value='COMERCIAL - ESCALADO ORDEN DE REEMPLAZO'>COMERCIAL - ESCALADO ORDEN DE REEMPLAZO</option>"
                            + "<option value='COMERCIAL - ESCALADO PENDIENTE INGRESO OTS'>COMERCIAL - ESCALADO PENDIENTE INGRESO OTS</option>"
                            + "<option value='CONTROL DE CAMBIOS - RFC NO ESTANDAR EN APROBACIÓN'>CONTROL DE CAMBIOS - RFC NO ESTANDAR EN APROBACIÓN</option>"
                            + "<option value='CSM - Retiro equipos - Renovación de Contrato'>CSM - Retiro equipos - Renovación de Contrato</option>"
                            + "<option value='DATACENTER  CLARO- CABLEADO SIN EJECUTAR'>DATACENTER  CLARO- CABLEADO SIN EJECUTAR</option>"
                            + "<option value='DATACENTER  CLARO- SIN CONSUMIBLES EN DATACENTER'>DATACENTER  CLARO- SIN CONSUMIBLES EN DATACENTER</option>"
                            + "<option value='DATACENTER CLARO- CABLEADO EN CURSO'>DATACENTER CLARO- CABLEADO EN CURSO</option>"
                            + "<option value='ENTREGA - SERVICIO_ENTREGADO_PROCESO DE CIERRE'>ENTREGA - SERVICIO_ENTREGADO_PROCESO DE CIERRE</option>"
                            + "<option value='ENTREGA - SIN DISPONIBILIDAD AGENDA EN VERIFICACIÓN DE RECURSOS'>ENTREGA - SIN DISPONIBILIDAD AGENDA EN VERIFICACIÓN DE RECURSOS</option>"
                            + "<option value='ENTREGA Y/O SOPORTE PROGRAMADO'>ENTREGA Y/O SOPORTE PROGRAMADO</option>"
                            + "<option value='EQUIPOS - DEFECTUOSOS'>EQUIPOS - DEFECTUOSOS</option>"
                            + "<option value='EQUIPOS - EN COMPRAS'>EQUIPOS - EN COMPRAS</option>"
                            + "<option value='ESCALADO_LIDER_IMPLEMENTACIÓN_PASO A PENDIENTE CLIENTE'>ESCALADO_LIDER_IMPLEMENTACIÓN_PASO A PENDIENTE CLIENTE</option>"
                            + "<option value='ESTADO CANCELADO'>ESTADO CANCELADO</option>"
                            + "<option value='ESTADO CANCELADO'>ESTADO CANCELADO</option>" 
                            + "<option value='ESTADO PENDIENTE CLIENTE'>ESTADO PENDIENTE CLIENTE</option>"
                            + "<option value='GPC - CAMBIO DE ALCANCE ORDEN DE PEDIDO'>GPC - CAMBIO DE ALCANCE ORDEN DE PEDIDO</option>"
                            + "<option value='GPC - EN PROCESO DE CANCELACIÓN'>GPC - EN PROCESO DE CANCELACIÓN</option>"
                            + "<option value='GPC - PENDIENTE ACEPTACIÓN CRONOGRAMA POR PARTE DEL CLIENTE'>GPC - PENDIENTE ACEPTACIÓN CRONOGRAMA POR PARTE DEL CLIENTE</option>"
                            + "<option value='GPC - PENDIENTE INFORMACIÓN DEL CLIENTE PARA CONFIGURAR'>GPC - PENDIENTE INFORMACIÓN DEL CLIENTE PARA CONFIGURAR</option>"
                            + "<option value='GPC - SIN ALCANCE PARA FABRICA'>GPC - SIN ALCANCE PARA FABRICA</option>"
                            + "<option value='IMPLEMENTACIÓN - SOLUCIÓN NO ESTANDAR'>IMPLEMENTACIÓN - SOLUCIÓN NO ESTANDAR</option>"
                            + "<option value='INCONVENIENTE TECNICO'>INCONVENIENTE TECNICO</option>"
                            + "<option value='LIDER TECNICO - CAMBIO DE ALCANCE PLAN TECNICO'>LIDER TECNICO - CAMBIO DE ALCANCE PLAN TECNICO</option>"
                            + "<option value='LIDER TECNICO - PENDIENTE PLAN TECNICO'>LIDER TECNICO - PENDIENTE PLAN TECNICO</option>"
                            + "<option value='LIDER TECNICO - SOLUCIÓN NO ESTANDAR'>LIDER TECNICO - SOLUCIÓN NO ESTANDAR</option>"
                            + "<option value='LIDER TECNICO - SOLUCIÓN NO ESTANDAR SIN DEFINICIÓN'>LIDER TECNICO - SOLUCIÓN NO ESTANDAR SIN DEFINICIÓN</option>"
                            + "<option value='PASO A PENDIENTE CLIENTE'>PASO A PENDIENTE CLIENTE</option>"
                            + "<option value='PENDIENTE SOLICITAR ENTREGA DEL SERVICIO'>PENDIENTE SOLICITAR ENTREGA DEL SERVICIO</option>"
                            + "<option value='PLANTA EXTERNA - EN CURSO SIN INCONVENIENTE REPORTADO'>PLANTA EXTERNA - EN CURSO SIN INCONVENIENTE REPORTADO</option>"
                            + "<option value='PLANTA EXTERNA - ERROR EN LA EJECUCIÓN DE EOC'>PLANTA EXTERNA - ERROR EN LA EJECUCIÓN DE EOC</option>"
                            + "<option value='PLANTA EXTERNA - ESCALADO_IFO_RESULTADO DE ACTIVIDAD'>PLANTA EXTERNA - ESCALADO_IFO_RESULTADO DE ACTIVIDAD</option>"
                            + "<option value='PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE DESBORDE'>PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE DESBORDE</option>"
                            + "<option value='PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE PERSONAL'>PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE PERSONAL</option>"
                            + "<option value='PLANTA EXTERNA - ETAPA INTERMEDIA - SIN CONFIRMACIÓN DE PERSONAL PARA EOC Y EMPALMES'>PLANTA EXTERNA - ETAPA INTERMEDIA - SIN CONFIRMACIÓN DE PERSONAL PARA EOC Y EMPALMES</option>"
                            + "<option value='PLANTA EXTERNA - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO'>PLANTA EXTERNA - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO</option>"
                            + "<option value='PLANTA EXTERNA - NO VIABLE EN FACTIBILIDAD POR TERCEROS'>PLANTA EXTERNA - NO VIABLE EN FACTIBILIDAD POR TERCEROS</option>"
                            + "<option value='PLANTA EXTERNA - NO VIABLE EN FO - EN INSTALACIÓN POR HFC'>PLANTA EXTERNA - NO VIABLE EN FO - EN INSTALACIÓN POR HFC</option>"
                            + "<option value='PLANTA EXTERNA - PERMISOS MUNICIPALES - PERMISOS DE ARRENDADOR DE INFRAESTRUCTURA'>PLANTA EXTERNA - PERMISOS MUNICIPALES - PERMISOS DE ARRENDADOR DE INFRAESTRUCTURA</option>"
                            + "<option value='PLANTA EXTERNA - SIN APROBACIÓN DE TENDIDO EXTERNO POR COSTOS'>PLANTA EXTERNA - SIN APROBACIÓN DE TENDIDO EXTERNO POR COSTOS</option>"
                            + "<option value='PREVENTA - NO ES CLARA LA SOLUCIÓN A IMPLEMENTAR'>PREVENTA - NO ES CLARA LA SOLUCIÓN A IMPLEMENTAR</option>"
                            + "<option value='PREVENTA - SIN ID  FACTIBILIDAD PARA TERCEROS'>PREVENTA - SIN ID  FACTIBILIDAD PARA TERCEROS</option>"
                            + "<option value='PROYECTO ÉXITO ANTIGUO'>PROYECTO ÉXITO ANTIGUO</option>" 
                            + "<option value='TERCEROS - EN CURSO SIN INCONVENIENTE REPORTADO'>TERCEROS - EN CURSO SIN INCONVENIENTE REPORTADO</option>"
                            + "<option value='TERCEROS - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO'>TERCEROS - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO</option>"
                            + "<option value='TERCEROS - NO VIABLE - EN PROCESO NOTIFICACIÓN A CLIENTE Y COMERCIAL PARA CANCELACIÓN'>TERCEROS - NO VIABLE - EN PROCESO NOTIFICACIÓN A CLIENTE Y COMERCIAL PARA CANCELACIÓN</option>"
                            + "<option value='TERCEROS - SIN AVANCE SOBRE LA FECHA DE ENTREGA DE ULTIMA MILLA'>TERCEROS - SIN AVANCE SOBRE LA FECHA DE ENTREGA DE ULTIMA MILLA</option>"
                    + "</select>";
            
            return select;
        },
        getObservaciones: function (obj) {
            var textarea = '<textarea rows="2"></textarea>';
            return textarea;
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
                {title: "Lista", data: vista.getSelect},
                {title: "Observación", data: vista.getObservaciones},
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
                {title: "Lista", data: vista.getSelect},
                {title: "Observación", data: vista.getObservaciones},
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
});
