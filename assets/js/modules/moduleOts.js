$(function () {
    hoy = {
        init: function () {
            hoy.events();
            hoy.listOtsCurrent();

        },

        //Eventos de la ventana.
        events: function () {
            
        },
        listOtsCurrent: function () {
            $.post(baseurl + '/OtHija/getOtsAssigned',
                    {
                        // clave: 'valor' // parametros que se envian
                    },
                    function (data) {
                        hoy.printTableOtsCurrent(data);
                    });


        },
        printTableOtsCurrent: function (data) {
            ///lleno la tabla con los valores enviados
            hoy.tablaEditOts = $('#tablaEditOts').DataTable(hoy.configTable(data, [
                {title: "Id Cliente Onyx", data: "id_cliente_onyx"},
                {title: "Nombre Cliente", data: "nombre_cliente"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Programación", data: "fecha_programacion"},
                {title: "Id Orden Trabajo Hija", data: "id_orden_trabajo_hija"},
                {title: "Ot Hija", data: "ot_hija"},
                {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                {data: hoy.getButtons},
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
        getButtons: function (obj) {
            boton = '<div class="btn-group">'
                    + '<a class="btn btn-default btn-xs ver-al btn_datatable_cami" title="Editar Ots"><span class="fa fa-fw fa-edit"></span></a>'
                    + '</div>';
            return boton;
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
                    {data: "id_cliente_onyx"},
                    {data: "nombre_cliente"},
                    {data: "fecha_compromiso"},
                    {data: "fecha_programacion"},
                    {data: "id_orden_trabajo_hija"},
                    {data: "ot_hija"},
                    {data: "estado_orden_trabajo_hija"},
                    {data: total.getButtons},
                ],
                "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json"
                },
                columnDefs: [{
                        defaultContent: "",
                        //targets: 1, / pARA EL ORDENAMIENTO POR COLUMNAS SI SE DEJA EN 0 NO SE PODRIA ORDENAR POR LA PRIMERA COLUMNA /
                        orderable: false,
                    }],
                // order: [[0, 'desc']], //ardenaniento
                "bProcessing": true, /*IMPORTANTES PARA TRABAJAR SERVER SIDE PROSSESING*/
                "serverSide": true, /*IMPORTANTES PARA TRABAJAR SERVER SIDE PROSSESING*/


                drawCallback: function () {
                    // vista.runTimers(table);
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
              columnDefs: [{
                      defaultContent: "",
                      // targets: -1,
                      orderable: false,
                  }],
              order: [[0, 'asc']],
              drawCallback: onDraw
            }
        },

    };
    total.init();
    /************************************************FIN TOTAL************************************************/
    /**********************************************INICIO NUEVAS*********************************************/
    nueva = {
        init: function () {
            nueva.events();
            nueva.listOtsNew();

        },

        //Eventos de la ventana.
        events: function () {
        },
        listOtsNew: function () {
            $.post(baseurl + '/OtHija/getOtsNew',
                    {
                        // clave: 'valor' // parametros que se envian
                    },
                    function (data) {
                        nueva.printTableOtsNew(data);
                    });


        },
        printTableOtsNew: function (data) {
            ///lleno la tabla con los valores enviados
            nueva.tablaNewOts = $('#tablaNewOts').DataTable(nueva.configTable(data, [
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
    nueva.init();

    /************************************************FIN NUEVAS************************************************/
    /**********************************************INICIO CAMBIOS*********************************************/

    cambio = {
        init: function () {
            cambio.events();
            cambio.listOtsChange();

        },

        //Eventos de la ventana.
        events: function () {
        },
        listOtsChange: function () {
            $.post(baseurl + '/OtHija/getOtsChange',
                    {
                        // clave: 'valor' // parametros que se envian
                    },
                    function (data) {
                        cambio.printTableOtsChange(data);
                    });


        },
        printTableOtsChange: function (data) {
            ///lleno la tabla con los valores enviados
            cambio.tablaChangesOts = $('#tablaChangesOts').DataTable(cambio.configTable(data, [
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
    cambio.init();

    /************************************************FIN CAMBIOS************************************************/
    /**********************************************INICIO 15 DIAS*********************************************/

    quinceDias = {
        init: function () {
            quinceDias.events();
            quinceDias.listOtsFiteenDays();

        },

        //Eventos de la ventana.
        events: function () {
        },
        listOtsFiteenDays: function () {
            $.post(baseurl + '/OtHija/getOtsFiteenDays',
                    {
                        // clave: 'valor' // parametros que se envian
                    },
                    function (data) {
                        quinceDias.printTableOtsFiteenDays(data.data);
                    });


        },
        printTableOtsFiteenDays: function (data) {
            ///lleno la tabla con los valores enviados
            quinceDias.tablaFiteenDaysOts = $('#tablaFiteenDaysOts').DataTable(quinceDias.configTable(data, [
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
    quinceDias.init();

        eventos = {
            init: function () {
                eventos.events();
                
            },
    
            //Eventos de la ventana.
            events: function () {
                $('#contenido_tablas').on('click', 'a.ver-al', eventos.onClickShowModalEdit);
                $('#contenido_tablas').on('click', 'a.ver-log', eventos.onClickVerLogTrChanges);
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

                eventos.fillFormModal(record);
                // console.log(record);
            },

            //llenamos los input del modal con la informacion a la q le dio click
            fillFormModal: function(registro){
                // limpiar el formulario...
                $('#k_id_estado_ot').html("");
                $.each(registro,function(i,item){
                    $('#' + i).val(item);
                }); 

                $('#modalEditTicket').modal('show');
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




