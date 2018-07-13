// ****************************SECCION PARA AGREGAR ESTADOS A UN TIPO DE ESTADO****************************
function showModalNewType(name) {
    $.post(baseurl + '/Status/c_getNewStatusByType',
            {name: name},
            function (data) {
                var obj = JSON.parse(data);
                fillModalNewType(obj, name);
            }
    );
}

var flag = 0;
function fillModalNewType(estados_existentes, name) {
    $('#mdl_new_type').modal('show');
    $('#mdl_tbl_title_tipo').html("<strong>" + name + "</strong>");
    $('#mdl_tbl_name_type').val(name);

    $('#mdl_tbl_new_type').html("");
    $.each(estados_existentes, function (i, estado) {

        $('#mdl_tbl_new_type').append('<tr>'
                                            + '<td><input type="text" name="name_status[]" id="estado_' + flag + '" class="form-control" value="' + estado.n_name_estado_ot + '" readonly></td>'
                                            + '<td><input type="number" name="jerarquia[]" id="exist' + i + '" class="form-control jsStatusPlus"></td>'
                                        + '</tr>'
                );
        flag++;
    });
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
