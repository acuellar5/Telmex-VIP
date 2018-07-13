$(function () {
    hoy = {
        init: function () {
            hoy.events();
            hoy.listOtsCurrent();
            hoy.individualColumnSearching();
        },

        //Eventos de la ventana.
        events: function () {
            
        },
        listOtsCurrent: function () {
            $.post(baseurl + '/OtHija/c_getOtsAssigned',
                    {
                        // clave: 'valor' // parametros que se envian
                    },
                    function (data) {
                        $('#bdg_hoy').html(data['count']);
                        hoy.printTableOtsCurrent(data['data']);
                    });


        },
        printTableOtsCurrent: function (data) {
            ///lleno la tabla con los valores enviados
            hoy.tablaEditOts = $('#tablaEditOts').DataTable(hoy.configTable(data, [
                {title: "OT Padre", data: "nro_ot_onyx"},
                {title: "Id OT Hija", data: "id_orden_trabajo_hija"},
                {title: "Nombre Cliente", data: "nombre_cliente"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Programación", data: "fecha_programacion"},
                {title: "Ot Hija", data: "ot_hija"},
                {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                {title: "Recurrente", data: "MRC"},
                {title: "opc", data: hoy.getButtons},
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    var r = $('#tablaEditOts tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#tablaEditOts thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#tablaEditOts').DataTable();

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
            var botones = '<div class="btn-group" style="display: inline-flex;">';
            botones += '<a class="btn btn-default btn-xs ver-al btn_datatable_cami" title="Editar Ots"><span class="fa fa-fw fa-edit"></span></a>';
            if (obj.function != 0) {                
                botones += '<a class="btn btn-default btn-xs ver-log btn_datatable_cami" title="Historial"><span class="fa fa-fw fa-info"></span></a>';
            }

            botones += '</div>';
            return botones;
        },
        individualColumnSearching: function () {
            $('#tablaEditOts tfoot th').each(function () {
                $(this).html('<input type="text" placeholder="Buscar" />');
            });
        }
    };
    hoy.init();

    /************************************************FIN HOY************************************************/
    /**********************************************INICIO TOTAL*********************************************/
// TABLA TOTAL

    total = {
        init: function () {
            total.events();
            total.getListTotal();
            total.individualColumnSearching();
        },
        //Eventos de la ventana.
        events: function () {
           
        },

        //Primer paso para obtener toda la lista de total
        getListTotal: function () {
            total.tableTotal = $('#tabla_total').DataTable(total.genericCogDataTable("/OtHija/getListTotalOts", "tabla_total"));
        },

        genericCogDataTable: function (url, table) {
            return {
                columns: [
                    {data: "nro_ot_onyx"},
                    {data: "id_orden_trabajo_hija"},
                    {data: "nombre_cliente"},
                    {data: "fecha_compromiso"},
                    {data: "fecha_programacion"},
                    {data: "ot_hija"},
                    {data: "estado_orden_trabajo_hija"},
                    {data: "MRC"},
                    {data: total.getButtons},
                ],
                initComplete: function () {
                    var r = $('#tabla_total tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#tabla_total thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#tabla_total').DataTable();

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
                columnDefs: [{
                        defaultContent: "",
                        //targets: 1, / pARA EL ORDENAMIENTO POR COLUMNAS SI SE DEJA EN 0 NO SE PODRIA ORDENAR POR LA PRIMERA COLUMNA /
                        orderable: false,
                    }],
                order: [[7, 'desc']],
                // drawCallback: onDraw,
                // order: [[0, 'desc']], //ardenaniento
                "bProcessing": true, /*IMPORTANTES PARA TRABAJAR SERVER SIDE PROSSESING*/
                "serverSide": true, /*IMPORTANTES PARA TRABAJAR SERVER SIDE PROSSESING*/


                drawCallback: function (data) {
                    if ($('#bdg_total').html() == "...") {
                        $('#bdg_total').html(data.json.recordsFiltered);                        
                    }
                    
                },
                "ajax": {
                    url: baseurl + '/' + url, // json datasource
                    type: "POST", // type of method  , by default would be get
                    error: function () {  // error handling code
                        $("#employee_grid_processing").css("display", "none");
                    }
                }
            };
        },

        //retorna botones para las opciones de la tabla
        getButtons: function(obj){
            // console.log(obj);
            var botones = '<div class="btn-group" style="display: inline-flex;">';
            botones += '<a class="btn btn-default btn-xs ver-al btn_datatable_cami" title="Editar Ots"><span class="fa fa-fw fa-edit"></span></a>';
            if (obj.function != 0) {                
                botones += '<a class="btn btn-default btn-xs ver-log btn_datatable_cami" title="Historial"><span class="fa fa-fw fa-info"></span></a>';
            }

            botones += '</div>';
            return botones;
        },
        // Datos de configuracion del datatable para log  sin usar (server side prossesing)
        configTableLog: function (data, columns, onDraw) {
            return {
              data: data,
              columns: columns,
              "language": {
                  "url": baseurl + "/assets/plugins/datatables/lang/es.json"
              },

            }
        },
        individualColumnSearching: function () {
            $('#tabla_total tfoot th').each(function () {
                $(this).html('<input type="text" placeholder="Buscar" />');
            });
        } 
    };
    total.init();
    /************************************************FIN TOTAL************************************************/
    /**********************************************INICIO NUEVAS*********************************************/
    nueva = {
        init: function () {
            nueva.events();
            nueva.listOtsNew();
            nueva.individualColumnSearching();
        },

        //Eventos de la ventana.
        events: function () {
        },
        listOtsNew: function () {
            $.post(baseurl + '/OtHija/c_getOtsNew',
                    {
                        // clave: 'valor' // parametros que se envian
                    },
                    function (data) {
                        $('#bdg_nuevas').html(data['count']);
                        nueva.printTableOtsNew(data['data']);
                    });


        },
        printTableOtsNew: function (data) {
            ///lleno la tabla con los valores enviados
            nueva.tablaNewOts = $('#tablaNewOts').DataTable(nueva.configTable(data, [
                {title: "OT Padre", data: "nro_ot_onyx"},
                {title: "Id OT Hija", data: "id_orden_trabajo_hija"},
                {title: "Nombre Cliente", data: "nombre_cliente"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Programación", data: "fecha_programacion"},
                {title: "Ot Hija", data: "ot_hija"},
                {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                {title: "Recurrente", data: "MRC"},
                {title: "opc", data: nueva.getButtons},
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    var r = $('#tablaNewOts tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#tablaNewOts thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#tablaNewOts').DataTable();

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
                select:true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                columnDefs: [{
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[7, 'desc']],
                drawCallback: onDraw
            }
        },
        //retorna botones para las opciones de la tabla
        getButtons: function(obj){
            // console.log(obj);
            var botones = '<div class="btn-group" style="display: inline-flex;">';
            botones += '<a class="btn btn-default btn-xs ver-al btn_datatable_cami" title="Editar Ots"><span class="fa fa-fw fa-edit"></span></a>';
            botones += '</div>';
            return botones;
        },
        individualColumnSearching: function () {
            $('#tablaNewOts tfoot th').each(function () {
                $(this).html('<input type="text" placeholder="Buscar" />');
            });
        }
    };
    nueva.init();

    /************************************************FIN NUEVAS************************************************/
    /**********************************************INICIO CAMBIOS*********************************************/

    cambio = {
        init: function () {
            cambio.events();
            cambio.listOtsChange();
            cambio.individualColumnSearching();
        },

        //Eventos de la ventana.
        events: function () {
        },
        listOtsChange: function () {
            $.post(baseurl + '/OtHija/c_getOtsChange',
                    {
                        // clave: 'valor' // parametros que se envian
                    },
                    function (data) {
                        $('#bdg_cambios').html(data['count']);
                        cambio.printTableOtsChange(data['data']);
                    });


        },
        printTableOtsChange: function (data) {
            ///lleno la tabla con los valores enviados
            cambio.tablaChangesOts = $('#tablaChangesOts').DataTable(cambio.configTable(data, [
                {title: "OT Padre", data: "nro_ot_onyx"},
                {title: "Id OT Hija", data: "id_orden_trabajo_hija"},
                {title: "Nombre Cliente", data: "nombre_cliente"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Programación", data: "fecha_programacion"},
                {title: "Ot Hija", data: "ot_hija"},
                {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                {title: "Recurrente", data: "MRC"},
                {title: "opc", data: cambio.getButtons}
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    var r = $('#tablaChangesOts tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#tablaChangesOts thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#tablaChangesOts').DataTable();

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
                select:true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                columnDefs: [{
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[7, 'desc']],
                drawCallback: onDraw
            }
        },
        //retorna botones para las opciones de la tabla
        getButtons: function(obj){
            // console.log(obj);
            var botones = '<div class="btn-group" style="display: inline-flex;">';
            botones += '<a class="btn btn-default btn-xs ver-al btn_datatable_cami" title="Editar Ots"><span class="fa fa-fw fa-edit"></span></a>';
            if (obj.function != 0) {                
                botones += '<a class="btn btn-default btn-xs ver-log btn_datatable_cami" title="Historial"><span class="fa fa-fw fa-info"></span></a>';
            }

            botones += '</div>';
            return botones;
        },
        individualColumnSearching: function () {
            $('#tablaChangesOts tfoot th').each(function () {
                $(this).html('<input type="text" placeholder="Buscar" />');
            });
        }
    };
    cambio.init();

    /************************************************FIN CAMBIOS************************************************/
    /**********************************************INICIO 15 DIAS*********************************************/

    quinceDias = {
        init: function () {
            quinceDias.events();
            quinceDias.listOtsFiteenDays();
            quinceDias.individualColumnSearching();
        },

        //Eventos de la ventana.
        events: function () {
        },
        listOtsFiteenDays: function () {
            $.post(baseurl + '/OtHija/c_getOtsFiteenDays',
                    {
                        // clave: 'valor' // parametros que se envian
                    },
                    function (data) {
                        // console.log(data);
                        $('#bdg_15').html(data['count']);
                        quinceDias.printTableOtsFiteenDays(data['data']);

                    });


        },
        printTableOtsFiteenDays: function (data) {
            ///lleno la tabla con los valores enviados
            quinceDias.tablaFiteenDaysOts = $('#tablaFiteenDaysOts').DataTable(quinceDias.configTable(data, [
                {title: "OT Padre", data: "nro_ot_onyx"},
                {title: "Id OT Hija", data: "id_orden_trabajo_hija"},
                {title: "Nombre Cliente", data: "nombre_cliente"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Programación", data: "fecha_programacion"},
                {title: "Ot Hija", data: "ot_hija"},
                {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                {title: "Recurrente", data: "MRC"},
                {title: "opc", data: quinceDias.getButtons}
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    var r = $('#tablaFiteenDaysOts tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#tablaFiteenDaysOts thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#tablaFiteenDaysOts').DataTable();

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
                select:true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                columnDefs: [{
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[7, 'desc']],
                drawCallback: onDraw
            }
        },
        //retorna botones para las opciones de la tabla
        getButtons: function(obj){
            // console.log(obj);
            var botones = '<div class="btn-group" style="display: inline-flex;">';
            botones += '<a class="btn btn-default btn-xs ver-al btn_datatable_cami" title="Editar Ots"><span class="fa fa-fw fa-edit"></span></a>';
            if (obj.function != 0) {                
                botones += '<a class="btn btn-default btn-xs ver-log btn_datatable_cami" title="Historial"><span class="fa fa-fw fa-info"></span></a>';
            }

            botones += '</div>';
            return botones;
        },
        individualColumnSearching: function () {
            $('#tablaFiteenDaysOts tfoot th').each(function () {
                $(this).html('<input type="text" placeholder="Buscar" />');
            });
        }
    };
    quinceDias.init();
    //******************************************************** FIN 15 DIAS ********************************************************************//

        eventos = {
            init: function () {
                eventos.events();
                
            },
    
            //Eventos de la ventana.
            events: function () {
                $('#contenido_tablas').on('click', 'a.ver-al', eventos.onClickShowModalEdit);
                $('#contenido_tablas').on('click', 'a.ver-log', eventos.onClickVerLogTrChanges);
                $('#ins_servicio').on('change', eventos.selectFormulary );
                $('.cerrar').on('click', eventos.clearModal);
                $('#btnUpdOt').on('click', eventos.clicOnButton);

            },
            onClickShowModalEdit: function () {
                var aLinkLog = $(this);
                var trParent = aLinkLog.parents('tr');
                var tabla = aLinkLog.parents('table').attr('id');
                var record;
                switch(tabla) {
                    case 'tablaEditOts':
                        record = hoy.tablaEditOts.row(trParent).data();                    
                        break;
                    case 'tabla_total':
                        record = total.tableTotal.row(trParent).data();                    
                        break;
                    case 'tablaNewOts':
                        record = nueva.tablaNewOts.row(trParent).data();                    
                        break;
                    case 'tablaChangesOts':
                        record = cambio.tablaChangesOts.row(trParent).data();                    
                        break;
                    case 'tablaFiteenDaysOts':
                        record = quinceDias.tablaFiteenDaysOts.row(trParent).data();                    
                        break;                
                }
// console.log(record);
                eventos.fillFormModal(record);
                 // console.log(record);
            },

            //llenamos los input del modal con la informacion a la q le dio click
            fillFormModal: function(registro){
                // console.log(registro);
                // limpiar el formulario...
                 $('#general').html("");
                $('#k_id_estado_ot').html("");

                $.each(registro,function(i,item){
                    $('#' + i).val(item);
                }); 
                    $('#id_ot_modal').text(registro.id_orden_trabajo_hija);

                eventos.fillSelect(registro.k_id_tipo, registro.k_id_estado_ot, registro.i_orden);

                // $('#k_id_estado_ot option[value="'+registro.k_id_estado_ot+'"]').attr('selected', true);
                // $(`#k_id_estado_ot option [value= "${registro.k_id_estado_ot}"]`).attr("selected", true);
                // console.log($('#k_id_estado_ot option[value="'+registro.k_id_estado_ot+'"]').attr('selected', true));


                var algo = $('#k_id_estado_ot').val() ;
                if (registro.k_id_tipo == 1) {
                  $('#k_id_estado_ot').on('change', function(){
                    // $('')
                        $('#general').html("");
                        if ($('#k_id_estado_ot').val() == 3 )
                        {
                            $('#btnUpdOt').attr('disabled', true);
                            $('.ins_servicio').show();
                                $('#ins_servicio').on('change', function(){
                                    var otra = $('#ins_servicio').val();
                                    switch (otra) {
                                           case "0":
                                             $('#btnUpdOt').attr('disabled', true);   
                                             break 
                                           case "1":
                                             $('#formModal').attr('action', 'Templates/c_updateStatusOt/1');
                                             $('#btnUpdOt').attr('disabled', false);  
                                             $("#nombre").attr("required", true);
                                             break;
                                           case "2":
                                             $('#formModal').attr('action', 'Templates/c_updateStatusOt/2');
                                             $('#btnUpdOt').attr('disabled', false);
                                             break;
                                           case "3":
                                             $('#formModal').attr('action', 'Templates/c_updateStatusOt/3');
                                             $('#btnUpdOt').attr('disabled', false);
                                             break;
                                           case "4":
                                             $('#formModal').attr('action', 'Templates/c_updateStatusOt/4');
                                             $('#btnUpdOt').attr('disabled', false);
                                             break;
                                           case "5":
                                             $('#formModal').attr('action', 'Templates/c_updateStatusOt/5');
                                             $('#btnUpdOt').attr('disabled', false);
                                             break;
                                           case "6":
                                             $('#formModal').attr('action', 'Templates/c_updateStatusOt/6');
                                             $('#btnUpdOt').attr('disabled', false);
                                             break;
                                           case "7":
                                             $('#formModal').attr('action', 'Templates/c_updateStatusOt/7');
                                             $('#btnUpdOt').attr('disabled', false);
                                             break;
                                           case "8":
                                             $('#formModal').attr('action', 'Templates/c_updateStatusOt/8');
                                             $('#btnUpdOt').attr('disabled', false);
                                             break;
                                           case "9":
                                             $('#formModal').attr('action', 'Templates/c_updateStatusOt/9');
                                             $('#btnUpdOt').attr('disabled', false);
                                             break;
                                           case "10":
                                             $('#formModal').attr('action', 'Templates/c_updateStatusOt/10');
                                             $('#btnUpdOt').attr('disabled', false);
                                             break;
                                       
                                         }
                        });                   
                        }else{
                            $('.ins_servicio').hide();
                            $('#btnUpdOt').attr('disabled', false);
                        }
                    });

                } 

                $('.ins_servicio').hide();
                $('#modalEditTicket').modal('show');
            },
                // updateStatusOt: function(){

                    
                //     var id_orden_trabajo_hija = $('#id_orden_trabajo_hija').val();
                //     var k_id_estado_ot = $('#k_id_estado_ot').val();
                //     var estado_orden_trabajo_hija = $('#estado_orden_trabajo_hija').val();
                //     var fecha_actual = $('#fecha_actual').val();
                //     var estado_mod = $('#estado_mod').val();

                //     $.post( baseurl +"OtHija/c_updateStatusOt",
                //     {
                //         k_id_estado_ot: k_id_estado_ot,
                //         estado_orden_trabajo_hija: estado_orden_trabajo_hija,
                //         fecha_actual: fecha_actual,
                //         estado_mod: estado_mod,
                //     },
                //     function(data){
                //          console.log(data);
                //          var res = JSON.parse(data);
                //          // console.log(res);
                //          if (res == 1) {
                //              swal("Se actualizo correctamente!", "", "success");
                //              setTimeout('document.location.reload()',1500);
                //          }else {
                //            swal("No actualizo correctamente!", "", "error");
                //          }

                //     });
                // },
                //limpia el modal cada vez que se cierra
                clearModal: function(){   
                     $('#formModal')[0].reset();
                     $("label.error").remove();
                },



                  selectFormulary: function () {
                $('#general').html("");
                var toog = true;
                var jmm = $('#general').html("");
                var valServicio = 0;
                    valServicio = $('#ins_servicio').val();
                
                var form = "";
                form += `
                        <div class="widget bg_white m-t-25 display-block cliente">
                            <fieldset class="col-md-6 control-label">
                            <span class="div_Text_Form_modal"><strong>Email al que se dirije el correo: &nbsp;</strong></span>
                            </fieldset>
                            <!-- fin seccion izquierda form-->

                            <!--  inicio seccion derecha form---->
                            <fieldset>
                                <div class="form-group Email_envio">
                                    <label for="Email_envio" class="col-md-3 control-label"> </label>
                                    <div class="col-md-8 selectContainer div_Form_Modals">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="Email_envio" id="Email_envio" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="widget bg_white m-t-25 display-block cliente">
                            <fieldset class="col-md-6 control-label">
                                <div class="form-group nombre " >
                                    <label for="nombre" class="col-md-3 control-label">Nombre: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="nombre" id="nombre" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group nombre_cliente">
                                    <label for="nombre_cliente" class="col-md-3 control-label">Nombre Cliente: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="nombre_cliente" id="nombre_cliente_val" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!-- fin seccion izquierda form-->

                            <!--  inicio seccion derecha form---->
                            <fieldset>
                                <div class="form-group servicio">
                                    <label for="fecha_creacion_ot_hija" class="col-md-3 control-label">Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="servicio" id="servicio_val" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group fecha">
                                    <label for="fecha" class="col-md-3 control-label">Fecha: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                            <input name="fecha" id="fecha" class="form-control" type="date" required>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                            </div>`;
                    


                switch(valServicio) {
                    case "0":
                    form = "";
                    toog = false;
                    break;
                    case "1":
                        form += ` <div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                              <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" required >
                                                        </div>
                                                    </div>
                                                </div>                                              
                                                <div class="form-group ancho_banda">
                                                    <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group interfaz_grafica">
                                                    <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </fieldset>
                                        </div>   

                                `;

                        break;
                    case "2":
                    form += ` <div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                              <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" required >
                                                        </div>
                                                    </div>
                                                </div>                                              
                                                <div class="form-group ancho_banda">
                                                    <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group interfaz_grafica">
                                                    <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </fieldset>
                                        </div>   
                                `;
                        break;
                        case "3":
                        form += `
                                <div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                               <div class="form-group existente">
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Exsistente: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="existente" id="existente" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" required >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group nuevo">
                                                    <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="nuevo" id="nuevo" class="form-control" type="text">
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group ancho_banda">
                                                  <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>   
                    
                                    `;
                        break;
                        case "4":
                        form += ` <div class="widget bg_white m-t-25 display-block cliente">
                                    <fieldset class="col-md-6 control-label">
                                      <div class="form-group direccion_instalacion_des">
                                            <label for="direccion_instalacion_des1" class="col-md-3 style="margin-top: -21px;" control-label">Direccion De Instalacion (Descripcion 1 del servicio): &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="direccion_instalacion_des1" id="direccion_instalacion_des1" class="form-control" type="text" required >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group direccion_instalacion_des">
                                            <label for="direccion_instalacion_des2" class="col-md-3 control-label">Direccion De Instalacion (Descripcion 2 del servicio): &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="direccion_instalacion_des2" id="direccion_instalacion_des2" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </fieldset> 
                                    
                                    <fieldset>
                                        <div class="form-group direccion_instalacion_des">
                                            <label for="direccion_instalacion_des3" class="col-md-3 control-label">Direccion De Instalacion (Descripcion 3 del servicio): &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="direccion_instalacion_des3" id="direccion_instalacion_des3" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group direccion_instalacion_des">
                                            <label for="direccion_instalacion_des4" class="col-md-3 control-label">Direccion De Instalacion (Descripcion 4 del servicio): &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="direccion_instalacion_des4" id="direccion_instalacion_des4" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>  
                                      <div class="widget bg_white m-t-25 display-block cliente">
                                    <fieldset class="col-md-6 control-label">
                                      <div class="form-group ">
                                            <label for="equipos_intalar_camp1" class="col-md-3 control-label">Equipos a Instalar: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="equipos_intalar_camp1" id="equipos_intalar_camp1" class="form-control" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group equipos_instalar">
                                            <label for="equipos_intalar_camp2" class="col-md-3 control-label">Equipos a Instalar: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="equipos_intalar_camp2" id="equipos_intalar_camp2" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset> 
                                    
                                    <fieldset>
                                        <div class="form-group equipos_instalar">
                                            <label for="equipos_intalar_camp3" class="col-md-3 control-label">Equipos a Instalar: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="equipos_intalar_camp3" id="equipos_intalar_camp3" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group fecha_servicio">
                                            <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                    <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div> 
                                <div class="widget bg_white m-t-25 display-block cliente">
                                    <fieldset class="col-md-6 control-label">
                                      <div class="form-group existente">
                                            <label for="existente" class="col-md-3 control-label">Exsistente: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="existente" id="existente" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group nuevo">
                                            <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="nuevo" id="nuevo" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset> 
                                    
                                    <fieldset>
                                        <div class="form-group ancho_banda">
                                            <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group interfaz_grafica">
                                            <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                </div>
                                            </div>
                                        </div> 
                                    </fieldset>
                                </div> 
                         
                           `;
                    break;
                    case "5":
                    form += `<div class="widget bg_white m-t-25 display-block cliente">
                                <fieldset class="col-md-6 control-label">
                                  <div class="form-group direccion_instalacion">
                                        <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group direccion">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" required>
                                            </div>
                                        </div>
                                    </div>                                              
                                    <div class="form-group ancho_banda">
                                        <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset> 
                                
                                <fieldset>
                                    <div class="form-group interfaz_grafica">
                                        <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group fecha_servicio">
                                        <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                            </div>
                                        </div>
                                    </div> 
                                </fieldset>
                            </div>
                            `;

                    break;
                    case "6":
                    form += `<div class="widget bg_white m-t-25 display-block cliente">
                                <fieldset class="col-md-6 control-label">
                                  <div class="form-group direccion_instalacion">
                                        <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group direccion">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" required>
                                            </div>
                                        </div>
                                    </div>                                              
                                    <div class="form-group ancho_banda">
                                        <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset> 
                                
                                <fieldset>
                                    <div class="form-group interfaz_grafica">
                                        <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group fecha_servicio">
                                        <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                            </div>
                                        </div>
                                    </div> 
                                </fieldset>
                            </div>
                            `;
                    break;
                    case "7":
                         form += `<div class="widget bg_white m-t-25 display-block cliente">
                                    <fieldset class="col-md-6 control-label">
                                       <div class="form-group existente">
                                            <label for="proveedor_ultima_milla" class="col-md-3 control-label">Exsistente: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="existente" id="existente" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group direccion_instalacion">
                                            <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group direccion">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group interfaz_grafica">
                                         <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </fieldset> 
                                    
                                    <fieldset>
                                        <div class="form-group nuevo">
                                            <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="nuevo" id="nuevo" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group ancho_banda">
                                          <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group fecha_servicio">
                            <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                    <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>   
                                    `;
                    break;
                    case "8":
                        form += `<div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                               <div class="form-group existente">
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Exsistente: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="existente" id="existente" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group nuevo">
                                                    <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="nuevo" id="nuevo" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group ancho_banda">
                                                  <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>   
                                    `;

                    break;
                    case "9":
                        form += `<div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                               <div class="form-group existente">
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Exsistente: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="existente" id="existente" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" required >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group nuevo">
                                                    <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="nuevo" id="nuevo" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group ancho_banda">
                                                  <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>   
                                    `;
                    break;
                    case "10":
                        form += `<div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                               <div class="form-group existente">
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Exsistente: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="existente" id="existente" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required >
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group nuevo">
                                                    <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="nuevo" id="nuevo" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group ancho_banda">
                                                  <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>   
                                    `;
                    break;

                    default:
                }



                if (toog) {


                    form += `             <div class="widget bg_white m-t-25 display-block ">
                                                <fieldset class="col-md-6 control-label">
                                                <div class="form-group ingeniero1">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Ingeniero 1: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero1" id="ingeniero1" class="form-control" type="text" required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero1_tel ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Telefono: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero1_tel" id="ingeniero1_tel" class="form-control" type="number" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero1 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Email: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero1_email" id="ingeniero1_email" class="form-control" type="email"required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <!--  fin seccion izquierda form---->

                                                <!--  inicio seccion derecha form---->
                                                <fieldset>
                                                     <div class="form-group ingeniero2 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Ingeniero 2: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero2" id="ingeniero2" class="form-control" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero2 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Telefono: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero2_tel" id="ingeniero2_tel" class="form-control" type="number" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero2 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Email: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero2_email" id="ingeniero2_email" class="form-control" type="email" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero3 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Ingeniero 3: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero3" id="ingeniero3" class="form-control" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero3 ingenieros">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Telefono: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero3_tel" id="ingeniero3_tel" class="form-control" type="number" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero3 ingenieros">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Email: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero3_email" id="ingeniero3_email" class="form-control" type="email" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>`;

                }

            $('#general').html(form);

         },

            fillSelect: function(idtipo, val_estado , orden){
                // console.log(idtipo);

              $.ajaxSetup({async:false});
              $.post(baseurl + "/User/c_getStatusByType",
                  {
                    idtipo: idtipo
                  },
                  function (data) {
                    // Decodifica el objeto traido desde el controlador
                    var status = JSON.parse(data);
                    // Pinto el select de estado
                    $.each(status,function(i,item){
                        if (val_estado == item.k_id_estado_ot) {
                            $('.llenarEstadosJS').append('<option value="'+item.k_id_estado_ot+'" selected>'+item.n_name_estado_ot+'</option>');                            
                        }else {
                            if (parseInt(item.i_orden) < parseInt(orden)) {
                                // console.log(item.n_name_estado_ot+  " " + item.i_orden + " orden = " + orden );
                                $('.llenarEstadosJS').append('<option value="'+item.k_id_estado_ot+'" disabled>'+item.n_name_estado_ot+'</option>');                                
                            } else {
                                // console.log(item.n_name_estado_ot+  "  " + item.i_orden + " orden = " + orden );
                                $('.llenarEstadosJS').append('<option value="'+item.k_id_estado_ot+'">'+item.n_name_estado_ot+'</option>');
                            }
                        }
                    }); 
                });

            },
            clicOnButton: function(){
               
                var msj = false;
                var response = true;
                var mail = $('#ingeniero1_email').val();
                var mail1 = $('#Email_envio').val();
                var expresiones = /\w+@\w+\.+[a-z]/;
                var inputs = [  $('#nombre'),
                                $('#nombre_cliente_val'),
                                $('#servicio_val'),
                                $('#fecha'),
                                $('#direccion_instalacion'),
                                $('#direccion_instalacion_des1'),
                                $('#ancho_banda'),
                                $('#interfaz_entrega'),
                                $('#equipos_intalar_camp1'),
                                $('#fecha_servicio'),
                                $('#ingeniero1'),
                                $('#ingeniero1_tel'),
                                $('#ingeniero1_email'),
                                $('#Email_envio')
                            ];
                                
                            
                inputs.forEach(function(input){
                    if (input.val() == '') {
                        msj = true;
                        input.css("box-shadow", "0 0 5px rgba(253, 1, 1)");
                        return false;
                    }else {
                        input.css("box-shadow", "none");                        
                    }
                });
                if (msj) {
                    swal('Error', 'Complete correctamente los campos', 'error');
                    response = false; 
                    return false; 
                }

                if (!expresiones.test(mail) || !expresiones.test(mail1)) {
                    swal('Error', 'El formato del correo está mal', 'error');
                    return false;
                }
                
                if(response){

                    swal({
                        title:"Advertencia",
                        text: '¿El correo  '+mail1+'  es el correcto?',
                        icon: "warning",
                        buttons: true,

                        dangerMode: true,
                        buttons: {
                        cancel: "Cancelar!",
                        continuar: {
                          text: "Continuar!",
                          value: "continuar",
                          className: "btn_continuar",
                        },
                      },
                    })
                    .then((continuar) => {
                        if (continuar) {
                            $('#formModal').submit();
                            response = true;
                        } else {
                            swal("¡Cancelaste la opración!",{
                                icon: "error",
                                dangerMode: true,
                            });
                            response = false;
                            return false;
                        }
                    });
                }
                return false;
            },

            //************************************LOG**************************************

            //
            onClickVerLogTrChanges: function () {
                var aLinkLog = $(this);
                var trParent = aLinkLog.parents('tr');
                var tabla = aLinkLog.parents('table').attr('id');
                var record;

                switch(tabla) {
                    case 'tablaEditOts':
                        record = hoy.tablaEditOts.row(trParent).data();                    
                        break;
                    case 'tabla_total':
                        record = total.tableTotal.row(trParent).data();                    
                        break;
                    case 'tablaNewOts':
                        record = nueva.tablaNewOts.row(trParent).data();                    
                        break;
                    case 'tablaChangesOts':
                        record = cambio.tablaChangesOts.row(trParent).data();                    
                        break;
                    case 'tablaFiteenDaysOts':
                        record = quinceDias.tablaFiteenDaysOts.row(trParent).data();                    
                        break;                
                }


                eventos.getLogById(record);
            },

             //
            getLogById: function(obj){
                $.post( baseurl + '/Log/getLogById', 
                    {
                        id: obj.id_orden_trabajo_hija
                    }, 
                    function(data) {
                    var obj = JSON.parse(data);
                    eventos.showModalHistorial(obj);
                    }
                );            
            },

            
            // Muestra modal detalle historial log por id
            showModalHistorial: function(obj){
                $('#ModalHistorialLog').modal('show');
                $('#titleEventHistory').html('Historial Cambios de orden ' + obj[0].id_ot_hija + '');
                eventos.printTableHistory(obj);
            },
             //pintamos la tabla de log
            printTableHistory: function(data){
                // limpio el cache si ya habia pintado otra tabla
                if(eventos.tableModalHistory){
                    //si ya estaba inicializada la tabla la destruyo
                    eventos.tableModalHistory.destroy();
                }
                ///lleno la tabla con los valores enviados
                eventos.tableModalHistory = $('#tableHistorialLog').DataTable(total.configTableLog(data,[                                       
                        {data: "id_ot_hija"},
                        {data: "antes"},
                        {data: "ahora"},
                        {data: "columna"},
                        {data: "fecha_mod"}
                    ]));
            },

        };
        eventos.init();


});




