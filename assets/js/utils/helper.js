$(function () {
    helper = {
        init: function () {
            helper.events();            
        },

        //Eventos de la ventana.
        events: function () {
        
        },

        // Muestra un pequeño mensaje (alert) en la parte superior derecha comunicando que se canceló la accion
        miniAlert: function(title='Acción Cancelada', tipo = 'error'){
            const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                toast({
                    type: tipo,
                    title: title
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

        // funcion que retona los datos del usuario que está en session
        // recibe el atributo de la session que se desea retornar
        // si no se le envia un argumento retorna todos los valores
        inSession: function(clave = false){
            let retornar;
            $.post(baseurl + '/User/getSessionValues', 
                {
                    clave: clave
                }
                , 
                function(data) {
                    const res = JSON.parse(data);
                    retornar = res;
            });
            return retornar;
        },

        //llenar automaticamente un formulario
        // se le debe pasar el id del formulario a llenar
        llenar_form: function(id_form){
                let day;
                let mes;
                let flag = 1;

                let select_length;
                let id_select;
                let seleccionar;


            const i_text = document.querySelectorAll(`#${id_form} input[type=text]`);
            const i_date = document.querySelectorAll(`#${id_form} input[type=date]`);
            const i_number = document.querySelectorAll(`#${id_form} input[type=number]`);
            const i_email = document.querySelectorAll(`#${id_form} input[type=email]`);
            const i_text_area = document.querySelectorAll(`#${id_form} textarea`);
            const i_select = document.querySelectorAll(`#${id_form} select`);

            // llenar input tipo text
            i_text.forEach(
                input_text => {
                    input_text.value = `text_${flag}`;
                    flag++;
            });

            // llenar input tipo date
            i_date.forEach(  input_date => {
                day = '0' + parseInt( (Math.random() * 27) + 1)
                mes = '0' + parseInt( (Math.random() * 11) + 1)
                input_date.value = `2018-${mes.slice(-2)}-${day.slice(-2)}`
            });

            flag = 1;
            // llenar input tipo number
            i_number.forEach(
                input_number => {
                    input_number.value = 10000000000 + flag;
                    flag++;
                }
            );

            flag = 1;
            // llenar input tipo email
            i_email.forEach(
                input_email => {
                    input_email.value = `correo_${flag}@correo.com`;
                    flag++;
                }
            );

            flag = 1;
            // llenar input tipo textarea
            i_text_area.forEach(
                input_textarea => {
                    input_textarea.innerHTML = `textArea_${flag}`;
                    flag++;
                }
            );

            // llenar select
            i_select.forEach(input_select =>{
                    id_select = input_select.getAttribute('id');
                    select_length = document.querySelectorAll(`#${id_select} option`).length;
                    seleccionar = parseInt(Math.random() * (select_length - 1)) + 1;
                    document.querySelectorAll(`#${id_select} option`)[seleccionar].setAttribute('selected',true);
                
                }
            );


        },


    };
    helper.init();
});