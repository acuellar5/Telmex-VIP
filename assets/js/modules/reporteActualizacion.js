$(function () {
   /**********************************************INICIO 08 DIAS*********************************************/
   
 vista = {
        init: function () {
            vista.events();
            vista.getListOtsEigtDay();

        },
        //Eventos de la ventana.
        events: function () {

        },
        getListOtsUndefined: function () {
            //metodo ajax (post)
            $.post(baseurl + '/ReporteActulizacion/getListOtsEigtDay',
                    {
                        //parametros
                        
                    },
                    // funcion que recibe los datos (callback)
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                // s
                                vista.printTable(obj);
                            }
                    );
                },
        printTable: function (data) {
            // nombramos la variable para la tabla y llamamos la configuiracion
            vista.tablaEigtDaysOts = $('#tablaEigtDaysOts').DataTable(vista.configTable(data, [

                {title: "OT Padre", data: "nro_ot_onyx"},
                {title: "ID Orden trabajo Hija", data: "id_orden_trabajo_hija"},
                {title: "Nombre del Cliente", data: "nombre_cliente"},
                {title: "Fecha de Creacion", data: "fecha_creacion"},
                {title: "Tipo", data: "ot_hija"},
                {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
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
                order: [[3, 'asc']],
                drawCallback: onDraw
            }
        },
    };
    vista.init();
});