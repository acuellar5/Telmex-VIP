$(function () {
    helper = {
        init: function () {
            helper.events();            
        },

        //Eventos de la ventana.
        events: function () {
        
        },

        // Muestra un pequeño mensaje (alert) en la parte superior derecha comunicando que se canceló la accion
        miniAlertCancel: function(){
            const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                toast({
                    type: 'error',
                    title: 'Acción Cancelada'
                });
        },

        // Función que permite pintar la tabla con los campos de busqueda 
        // Los parametros son: Data que recibe los datos, columns: los números de columns en la tabla, IdTabke: Es el id de la tabla a pintar
        // ordenColumn:posicion para organizar las columnas y el ordenBy: la informacion se va a organizar de forma ascendente
        configTableSearchColumn: function (data, columns, idTable, ordenColumn, ordenBy ="asc" , numeric = 0) {
            
            return {
                initComplete: function () {
                    $('#'+idTable+' tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    var r = $('#'+idTable+' tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#'+idTable+' thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#'+idTable).DataTable();

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
                    "url": base_url + "/assets/plugins/datatables/lang/es.json"
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
                ordering: true,
                columnDefs: [{
                        // targets: -1,
                        // visible: false,
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[ordenColumn, ordenBy]],
                "aoColumnDefs": [
                  { "sType": "numeric", "aTargets": [ numeric ] }
                ],
                
            }
        },


        // funcion para clonar una seccion 
        // recibe que quiere clonar y que quiere añadirlo
        // al clonarlo adiciona un boton menos, por si se quiere usar para remover
        duplicar_seccion: function(que, donde){
            const seccion = que.clone().appendTo(donde);
            seccion.prepend(`<hr>
                    <span class="btn btn-danger f-r remover_seccion" style="margin-top:-40px"><i class="fa fa-minus"></i></span>`);
        },

        // funcion para remover una seccion
        // el elemento q dispara la funcion debe estar contenida en el div a remover
        remover_seccion: function(){
            const padre = $(this).parent('div');
            padre.remove();
        },


    };
    helper.init();
});