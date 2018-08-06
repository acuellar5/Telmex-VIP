$(function () {
   /**********************************************INICIO 08 DIAS*********************************************/
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
            // $.post(baseurl + '/OtHija/c_getOtsFiteenDays',
            //         {
            //             // clave: 'valor' // parametros que se envian
            //         },
            //         function (data) {
            //             $('#bdg_15').html(data['count']);
            //             quinceDias.printTableOtsFiteenDays(data['data']);

            //         });
            quinceDias.tablaFiteenDaysOts = $('#tablaFiteenDaysOts').DataTable(quinceDias.printTableOtsFiteenDays("/OtHija/c_getOtsFiteenDays", "tablaFiteenDaysOts"));


        },
        printTableOtsFiteenDays: function (url, table) {
            ///lleno la tabla con los valores enviados


            return {
                columns: [
                    {title: "OT Padre", data: "nro_ot_onyx"},
                    {title: "Id OT Hija", data: "id_orden_trabajo_hija"},
                    {title: "Nombre Cliente", data: "nombre_cliente"},
                    {title: "Fecha Compromiso", data: "fecha_compromiso"},
                    {title: "Fecha Programación", data: "fecha_programacion"},
                    {title: "Ot Hija", data: "ot_hija"},
                    {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
                    {title: "Ingeniero Responsable", data: "ingeniero"},
                    {title: "Recurrente", data: "MRC"},
                    {title: "opc", data: quinceDias.getButtons}
                ],
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
                // lenguaje
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
                        targets: 0,
                        orderable: false,
                    }],
                ordering: false,
                // order: [[8, 'desc']],
                // drawCallback: onDraw,
                // order: [[0, 'desc']], //ardenaniento
                "bProcessing": true, /*IMPORTANTES PARA TRABAJAR SERVER SIDE PROSSESING*/
                "serverSide": true, /*IMPORTANTES PARA TRABAJAR SERVER SIDE PROSSESING*/


                drawCallback: function (data) {
                    if ($('#bdg_15').html() == "...") {
                        $('#bdg_15').html(data.json.recordsFiltered);                        
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
            var botones = '<div class="btn-group" style="display: inline-flex;">';
            botones += '<a class="btn btn-default btn-xs ver-al btn_datatable_cami" title="Editar Ots"><span class="fa fa-fw fa-edit"></span></a>';
            if (obj.function != 0) {                
                if (obj.c_email > 0) {
                    botones += '<a class="btn btn-default btn-xs ver-log btn_datatable_cami" title="Historial"><span class="fa fa-fw">'+ obj.c_email +'</span></a>';
                } else {
                    botones += '<a class="btn btn-default btn-xs ver-log btn_datatable_cami" title="Historial"><span class="fa fa-fw fa-info"></span></a>';
                }
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
});

