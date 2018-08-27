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
            $.post(base_url + '/sede/c_getListoffices_table',
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
            trackChangesHeadquarters.track_changes_office = $('#track_changes_office').DataTable(helper.configTableHeadquarters(data, [

                {title: "Sede", data: "sede"},
                {title: "Ciudad", data: "ciudad"},
                {title: "Departamento", data: "departamento"},
                {title: "Dierección", data: "direccion"},
                {title: "Clasificación", data: "clasificacion"},
                {title: "Tipo de Oficina", data: "tipo_oficina"},
                 {title: "Opc.", data: send.getButtonsSend},
            ]));
        },
        // Datos de configuracion del datatable
        configTableHeadquarters: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    //es para crear los campos para buscar
                    $('#track_changes_office tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    //subir los espacios para buscar la informacion
                    var r = $('#track_changes_office tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#track_changes_office thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#track_changes_office').DataTable();

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

                columnDefs: [{
                        defaultContent: "",
                        targets: -1,
                        orderable: false,
                    }],
                order: [[3, 'asc']],
                drawCallback: onDraw
            }
        },
        getButtonsSend: function (obj) {
            var botones = '<div class="btn-group" style="display: inline-flex;">';
            if (obj.function != 0) {
                if (obj.c_email > 0) {
                    botones += '<a class="btn btn-default btn-xs email_send btn_datatable_cami" title="Historial"><span class="fa fa-fw">' + obj.c_email + '</span></a>';
                } else {
                    botones += '<a class="btn btn-default btn-xs email_send btn_datatable_cami" title="Historial"><span class="fa fa-fw fa-info"></span></a>';
                }
            }
            botones += "</div>";
            return botones;

        },
    };
    trackChangesHeadquarters.init();
});