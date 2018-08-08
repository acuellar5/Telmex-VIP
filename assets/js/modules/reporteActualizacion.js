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
        getListOtsEigtDay: function () {
            //metodo ajax (post)
            $.post(baseurl + '/ReporteActualizacion/getListOtsEigtDay',
                    {
                        //parametros
                        
                    },
                    // funcion que recibe los datos (callback)
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                // s
                                vista.printTable(obj.data);
                                $('#bdg_after8days').html(obj.cant);

                            }
                    );
                },
        printTable: function (data) {
            // nombramos la variable para la tabla y llamamos la configuiracion
            vista.tablaEigtDaysOts = $('#tablaEigtDaysOts').DataTable(vista.configTable(data, [

                {title: "OT Padre", data: "nro_ot_onyx"},
                {title: "ID OT Hija", data: "id_orden_trabajo_hija"},
                {title: "Nombre del Cliente", data: "n_nombre_cliente"},
                {title: "Fecha de Programación", data: "fecha_compromiso"},
                {title: "OT Hija", data: "ot_hija"},
                {title: "Estado orden trabajo Hija", data: "estado_orden_trabajo_hija"},
                {title: "Ingeniero Responsbale", data: "ingeniero"},
                {title: "Opc.", data: vista.getButtons},
   
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    //es para crear los campos para buscar
                    $('#tablaEigtDaysOts tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    //subir los espacios para buscar la informacion
                    var r = $('#tablaEigtDaysOts tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#tablaEigtDaysOts thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable 
                    var table = $('#tablaEigtDaysOts').DataTable();

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

        getButtons: function () {
            var botones = "<div class='btn-group-vertical'>"
                    + "<a class='btn btn-default btn-xs ver-al btn_datatable_cami' title='Enviar Correo'><span class='fa fa-envelope-o'></span></a>"  
                    + "<a class='btn btn-default btn-xs ver-al btn_datatable_cami' title='Inf. Correos'><span class='fa fa-info'></span></a>"                                   
                    + "</div>";
            return botones;
        }
    };
    vista.init();
});