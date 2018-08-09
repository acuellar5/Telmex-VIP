// ****************************SECCION PARA AGREGAR ESTADOS A UN TIPO DE ESTADO****************************
function showModalNewType(name, nameStatus) {
    $.post(baseurl + '/Status/c_getAllStatusByType',
            {name: name},
            function (data) {
                var obj = JSON.parse(data);
                fillModalNewType(obj, name, nameStatus);
            }
    );
}

var flag = 0;
function fillModalNewType(estados_existentes, name, nameStatus) {
    $('#mdl_tbl_title_tipo').html("<strong>" + name + "</strong>");
    $('#mdl_tbl_name_type').val(name);
    $('#mdl_tbl_new_type').html("");
    var estados = [];
    $.each(estados_existentes.estados_existen, function (i, estado) {
        estados.push(estado.n_name_estado_ot);
        $('#mdl_tbl_new_type').append('<tr>'
                                            + '<td><input type="text" name="name_status[]" id="estado_' + flag + '" class="form-control" value="' + estado.n_name_estado_ot + '" readonly></td>'
                                            + '<td><input type="number" name="jerarquia[]" id="exist' + i + '" class="form-control "></td>'
                                        + '</tr>'
                );
        flag++;
    });
    
    $.each(estados_existentes.estados_no_existen, function (i, estado) {
        if (jQuery.inArray( estado.estado_orden_trabajo_hija, estados) === -1) {
            $('#mdl_tbl_new_type').append('<tr>'
                                            + '<td><input type="text" name="name_status[]" id="estado_' + flag + '" class="form-control" value="' + estado.estado_orden_trabajo_hija + '" readonly></td>'
                                            + '<td><input type="number" name="jerarquia[]" id="exist' + i + '" class="form-control "></td>'
                                        + '</tr>'
                );
            flag++;
        }
    });
    
    $('#mdl_new_type').modal('show');
}
// Al darle clic a añadir nuevo estadoi del modal
$('#añadir_estado').click(function () {
    $('#mdl_tbl_new_type').append('<tr id="row'+flag+'">'
                                    + '<td><input type="text" name="name_status[]" id="estado_${flag}" class="form-control jsStatusPlus"></td>'
                                    + '<td>'
                                        + '<div class="input-group">'
                                                + '<input type="number" name="jerarquia[]" id="orden_'+flag+'" class="form-control jsStatusPlus  cssmodificacionin">'
                                                + '<span class="fa fa-minus btn btn-danger btn_minus btn_red" onclick="removeRow('+flag+')"></span>'
                                        + '</div>'
                                    + '</td>'
                                + '</tr>'
            );
    flag++;
});

// Remueve la fila seleccionada al darle click
function removeRow(row) {
    $('#row' + row).remove();
}

function validar_form() {
    var bandera = true;
    var inputs = document.querySelectorAll(".jsStatusPlus");
    inputs.forEach(function (input) {
        if (input.value == '') {
            bandera = false;
            $(`#${input.getAttribute('id')}`).css("box-shadow", "0 0 5px rgba(253, 1, 1)");
        } else {
            $(`#${input.getAttribute('id')}`).css("box-shadow", "none");
        }
    });

    if (!bandera) {
        swal('Recuerda!', 'no puede quedar ningun estado vacio y debes darle un orden de jerarquia a los estados EJ: \n\n Generada  => 1 \n Cancelada => 2 \n Cerrada    => 3', 'error');
    }
    return bandera;

}
// *******************************************TABLAS DE TIPO NULL***************************

$(function(){
        vista = {
        init: function () {
            vista.events();
            vista.getListOtsNull();
         
        },
          //Eventos de la ventana.
        events: function () {
                        
        },
        getListOtsNull: function(){
            //metodo ajax (post)
            $.post( baseurl + '/Type/getListOtsNull', 
                {
                    //parametros
                    //param1: 'value1'//enviar parametros a la funcion de la ruta
                },
                // funcion que recibe los datos (callback)
                function(data) {
                    // convertir el json a objeto de javascript
                    var obj = JSON.parse(data);
                    // s
                    vista.printTable(obj); 
                }
            );
        },  
        printTable: function(data){
            // nombramos la variable para la tabla y llamamos la configuiracion
            vista.tablePorject = $('#table_null').DataTable(vista.configTable(data, [

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

