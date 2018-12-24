$(function() {
    file = {
        init: function() {
            file.events();
            file.modal();
        },

        //Eventos de la ventana.
        events: function() {
            $('#validar').click(file.validarPassword);
            $("#password").keypress(function(e) {
                if (e.which == 13) {
                    $('#validar').click();
                }
            });
        },

        // Validar password
        validarPassword: function() {
            const date = new Date();
            const d = date.getDate();
            const m = date.getMonth();
            const v = $('#password').val();
            if (v == d + '123' + m + '123') {
                file.closeModal();
                file.getFillName();
                $('#tabla-archivos').show();
            } else {
                alert('Contraseña incorrecta');
            }
        },

        // Obtiene los nombres de los archivos
        getFillName: function() {
            $.post(base_url + '/Files/c_getFillName', {}, function(data) {
                var files = JSON.parse(data);
                $.each(files, function(i, archivo) {
                    $('#tabla-archivos tbody').append(`
                        <tr>
                            <td>${archivo}</td>
                            <td class="text-center"><a href="${base_url}/uploads/${archivo}" class="btn btn-primary btn-xs" target="_blank"><i class="btn_show fa fa-download" aria-hidden="true"></i></a></td>
                        </tr>
                    `);
                });
            });
        },

        // funciones para modal
        modal: function() {
            $(document).ready(function() {
                $(".mask").addClass("active");
            });
        },

        // cierra el modal
        closeModal: function() {
            $(".mask").removeClass("active");
        },

    };
    file.init();
});