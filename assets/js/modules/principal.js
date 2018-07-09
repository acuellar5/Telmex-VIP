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
                        idTipo: null // parametros que se envian
                    },
                    function (data) {
                        fTiempos.printTableOutTime(data);
                    });


        },
        printTableOutTime: function (data) {
            ///lleno la tabla con los valores enviados
            fTiempos.tablaFueraTiempos = $('#tablaFueraTiempos').DataTable(fTiempos.configTable(data, [
                {title: "OT Padre", data: "nro_ot_onyx"},
                {title: "Id Orden Trabajo Hija", data: "id_orden_trabajo_hija"},
                {title: "Nombre Cliente", data: "nombre_cliente"},
                {title: "Ot Hija", data: "n_name_tipo"},
                {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                {title: "Ingeniero Responsable", data: "ingeniero"},
                {title: "Fecha Creación", data: "fecha_creacion"},
                {title: "Días vencida", data: "tiempo_vencidas"},
                {title: "opc", data: fTiempos.getButtons},
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
            document.getElementById("formModal_detalle").reset();
            $('#title_modal').html('');
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var record = fTiempos.tablaFueraTiempos.row(trParent).data();
            fTiempos.fillFormModal(record);
        },

        fillFormModal: function (registros) {
            $.each(registros, function (i, item) {
                $('#mdl_' + i).val(item);
            });
            $('#title_modal').html('<b>Detalle de la orden  ' + registros.id_orden_trabajo_hija + '</b>');
            $('#Modal_detalle').modal('show');
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
            $('#tablaEnTiempos').on('click', 'a.ver-det', eTiempos.onClickShowModalDet);
        },
        listInTimes: function () {
            $.post(baseurl + '/OtHija/c_getOtsInTimes',
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
                {title: "OT Padre", data: "nro_ot_onyx"},
                {title: "Id Orden Trabajo Hija", data: "id_orden_trabajo_hija"},
                {title: "Nombre Cliente", data: "nombre_cliente"},
                {title: "Ot Hija", data: "n_name_tipo"},
                {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                {title: "Ingeniero Responsable", data: "ingeniero"},
                {title: "Fecha Creación", data: "fecha_creacion"},
                {title: "Días max Entrega", data: eTiempos.getAlertIcon},
                {title: "opc", data: eTiempos.getButtons},
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
                ordering: false,
                columnDefs: [{
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
//                order: [[7, 'asc']],
                drawCallback: onDraw
            }
        },
        getButtons: function (obj) {
            boton = '<div class="btn-group">'
                    + '<a class="btn btn-default btn-xs ver-det btn_datatable_cami" title="Editar Ots"><span class="fa fa-fw fa-eye"></span></a>'
                    + '</div>';
            return boton;
        },
        getAlertIcon: function (obj) {
            color = 'FFFFFF';
            if (obj.tiempo_vencer == -1 || obj.tiempo_vencer == 0) {
                color = 'FFA500';
                obj.tiempo_vencer = (obj.tiempo_vencer == 0) ? 'Hoy' : 'Mañana ';
            } else if (obj.tiempo_vencer == -2) {
                color = 'FFFF00';
            } else if (obj.tiempo_vencer < -2) {
                color = '7CFC00';
            } else if (obj.tiempo_vencer == 'en tiempos') {
                color = '7CFC00';
            }
            boton = '<form class="form-inline">'
                    + '<div class="btn-group col col-md-6">'
                    + obj.tiempo_vencer
                    + '</div>'
                    + '<div class="btn-group col col-md-6">'
                    + '<div class="circulo" style="background: #' + color + ';"></div>'
                    + '</div>'
                    + '</form>';
            return boton;
        },
        onClickShowModalDet: function () {
            document.getElementById("formModal_detalle").reset();
            // imprimir el titulo
            $('#title_modal').html('');
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var record = eTiempos.tablaEnTiempos.row(trParent).data();
//            console.log(record);
            fTiempos.fillFormModal(record);
        },

        fillFormModal: function (registros) {
            $.each(registros, function (i, item) {
                $('#mdl_' + i).val(item);
            });
            $('#title_modal').html('<b>Detalle de la orden  ' + registros.id_orden_trabajo_hija + '</b>');
            $('#Modal_detalle').modal('show');
        }
    };
    eTiempos.init();

    /************************************************FIN NUEVAS************************************************/
    /**********************************************INICIO TODO*********************************************/

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
                {title: "OT Padre", data: "nro_ot_onyx"},
                {title: "Id Orden Trabajo Hija", data: "id_orden_trabajo_hija"},
                {title: "Nombre Cliente", data: "nombre_cliente"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Programación", data: "fecha_programacion"},
                {title: "Ot Hija", data: "ot_hija"},
                {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                {title: "opc", data: todo.getButtons},
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
            document.getElementById("formModal_detalle").reset();
            $('#title_modal').html('');
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var record = todo.tablaTodo.row(trParent).data();
            $('#Modal_detalle').modal('show');
            fTiempos.fillFormModal(record);
        },
        fillFormModal: function (registros) {
            $.each(registros, function (i, item) {
                $('#mdl_' + i).val(item);
            });
            $('#title_modal').html('<b>Detalle de la orden  ' + registros.id_orden_trabajo_hija + '</b>');
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

    /************************************************FIN TODO************************************************/
});

var tabla_cont_out;
function showModalDetResOutTime(idTipo) {
    if (tabla_cont_out) {
        tabla_cont_out.destroy();
    }
    $.post(baseurl + '/OtHija/c_getOtsOutTime',
            {
                idTipo: idTipo // parametros que se envian
            },
            function (data) {
//                todo.printTableAllOts(data['data']);
                tabla_cont_out = $('#tablaDetalleResOutTimes').DataTable(fTiempos.configTable(data, [
                    {title: "OT Padre", data: "nro_ot_onyx"},
                    {title: "Id Orden Trabajo Hija", data: "id_orden_trabajo_hija"},
                    {title: "Nombre Cliente", data: "nombre_cliente"},
                    {title: "Ot Hija", data: "n_name_tipo"},
                    {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                    {title: "Ingeniero Responsable", data: "ingeniero"},
                    {title: "Fecha Creación", data: "fecha_creacion"},
                    {title: "Días vencida", data: "tiempo_vencidas"},
                    {title: "opc", data: fTiempos.getButtons},
                ]));
            });
    $('#Modal_detalle_res_out').modal('show');
}

var tabla_cont_in;
function showModalDetResInTimes(idTipo) {
    if (tabla_cont_in) {
        tabla_cont_in.destroy();
    }
    $.post(baseurl + '/OtHija/c_getOtsInTimes',
            {
                idTipo: idTipo // parametros que se envian
            },
            function (data) {
//                todo.printTableAllOts(data['data']);
                tabla_cont_in = $('#tablaDetalleResInTimes').DataTable(eTiempos.configTable(data, [
                    {title: "OT Padre", data: "nro_ot_onyx"},
                    {title: "Id Orden Trabajo Hija", data: "id_orden_trabajo_hija"},
                    {title: "Nombre Cliente", data: "nombre_cliente"},
                    {title: "Ot Hija", data: "n_name_tipo"},
                    {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                    {title: "Ingeniero Responsable", data: "ingeniero"},
                    {title: "Fecha Creación", data: "fecha_creacion"},
                    {title: "Días max Entrega", data: eTiempos.getAlertIcon},
                    {title: "opc", data: eTiempos.getButtons},
                ]));
            });
    $('#Modal_detalle_res_in').modal('show');
}


