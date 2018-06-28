$(function () {
    fTiempos = {
        init: function () {
            fTiempos.events();
            fTiempos.listOutTime();
        },

        //Eventos de la ventana.
        events: function () {
            $('#tablaFueraTiempos').on('click', 'a.ver-det', fTiempos.onClickShowModalDet);
        },
        listOutTime: function () {
            $.post(baseurl + '/OtHija/c_getOtsOutTime',
                    {
                        // clave: 'valor' // parametros que se envian
                    },
                    function (data) {
                        fTiempos.printTableOutTime(data);
                    });


        },
        printTableOutTime: function (data) {
            ///lleno la tabla con los valores enviados
            fTiempos.tablaFueraTiempos = $('#tablaFueraTiempos').DataTable(fTiempos.configTable(data, [
                {title: "Id Cliente Onyx", data: "id_cliente_onyx"},
                {title: "Nombre Cliente", data: "nombre_cliente"},
                {title: "Id Orden Trabajo Hija", data: "id_orden_trabajo_hija"},
                {title: "Ot Hija", data: "ot_hija"},
                {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                {title: "Ingeniero Responsable", data: "ingeniero"},
                {title: "Fecha Creación", data: "fecha_creacion"},
                {title: "Días vencida", data: "tiempo_vencidas"},
                {data: fTiempos.getButtons},
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                data: data,
                columns: columns,
                "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json"
                },
                columnDefs: [{
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[7, 'desc']],
                drawCallback: onDraw
            }
        },
        getButtons: function (obj) {
            boton = '<div class="btn-group">'
                    + '<a class="btn btn-default btn-xs ver-det btn_datatable_cami" title="Editar Ots"><span class="fa fa-fw fa-eye"></span></a>'
                    + '</div>';
            return boton;
        },
        onClickShowModalDet: function () {
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var record = fTiempos.tablaEditOts.row(trParent).data();
//            console.log(record);
            $('#modalEditTicket').modal('show');
        }
    };
    fTiempos.init();

    /************************************************FIN HOY************************************************/
    /**********************************************INICIO NUEVAS*********************************************/
    eTiempos = {
        init: function () {
            eTiempos.events();
            eTiempos.listInTimes();
        },

        //Eventos de la ventana.
        events: function () {
        },
        listInTimes: function () {
            $.post(baseurl + '/OtHija/getOtsInTimes',
                    {
                        // clave: 'valor' // parametros que se envian
                    },
                    function (data) {
                        eTiempos.printTableInTimes(data);
                    });
        },
        printTableInTimes: function (data) {
            ///lleno la tabla con los valores enviados
            eTiempos.tablaEnTiempos = $('#tablaEnTiempos').DataTable(eTiempos.configTable(data, [
                {title: "Id Cliente Onyx", data: "id_cliente_onyx"},
                {title: "Nombre Cliente", data: "nombre_cliente"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Programación", data: "fecha_programacion"},
                {title: "Id Orden Trabajo Hija", data: "id_orden_trabajo_hija"},
                {title: "Ot Hija", data: "ot_hija"},
                {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                data: data,
                columns: columns,
                "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json"
                },
                columnDefs: [{
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[0, 'asc']],
                drawCallback: onDraw
            }
        }
    };
    eTiempos.init();

    /************************************************FIN NUEVAS************************************************/
    /**********************************************INICIO CAMBIOS*********************************************/

    todo = {
        init: function () {
            todo.events();
            todo.listAllOts();
        },

        //Eventos de la ventana.
        events: function () {
            $('#tablaTodo').on('click', 'a.ver-det', todo.onClickShowModalDet);
        },
        listAllOts: function () {
            $.post(baseurl + '/OtHija/c_getOtsAssigned',
                    {
                        // clave: 'valor' // parametros que se envian
                    },
                    function (data) {
                        todo.printTableAllOts(data['data']);
                    });
        },
        printTableAllOts: function (data) {
            ///lleno la tabla con los valores enviados
            todo.tablaTodo = $('#tablaTodo').DataTable(todo.configTable(data, [
                {title: "Id Cliente Onyx", data: "id_cliente_onyx"},
                {title: "Nombre Cliente", data: "nombre_cliente"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Programación", data: "fecha_programacion"},
                {title: "Id Orden Trabajo Hija", data: "id_orden_trabajo_hija"},
                {title: "Ot Hija", data: "ot_hija"},
                {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                {title: "Ver Detalle", data: todo.getButtons},
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                data: data,
                columns: columns,
                "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json"
                },
                columnDefs: [{
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[0, 'asc']],
                drawCallback: onDraw
            }
        },
        onClickShowModalDet: function () {
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var record = todo.tablaTodo.row(trParent).data();
            console.log(record);
            $('#Modal_detalle').modal('show');
        },
        getButtons: function (obj) {
            boton = '<div class="btn-group">'
                    + '<a class="btn btn-default btn-xs ver-det btn_datatable_cami" title="Editar Ots"><span class="fa fa-fw fa-eye"></span></a>'
                    + '</div>';
            return boton;
        }
    };
    todo.init();
});




