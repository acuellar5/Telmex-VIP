$(function () {


    formulario = {
        flag_img : true,
        init: function () {
            formulario.events();
        },

        //Eventos de la ventana.
        events: function () {
            $('#btn_mostrar_detalle').click(formulario.toggle_info_detail);//toggle info
            $('.cerrar').on('click', formulario.clearModal); // limpiar formulario
            $('#table_oths_otp').on('click', 'a.ver-det', formulario.onClickShowModalEditOTH);
            // funcion para formulario tabs vertical
            $("div.bhoechie-tab-menu>div.list-group>a").on('click', formulario.onClickTab); 

            // funcion para multiselect
            $('.multiselect_forms').multiselect();

            // funcion para duplicar la seccion al darle click al add del form
            $('#formModal').on('click', 'span#añadir_seccion', e => {
                helper.duplicar_seccion($('#seccion_duplidar'), $('#append_aca'));
            });

            // funcion para remover seccion del form con el boton menos
            $('#formModal').on('click', 'span.remover_seccion', helper.remover_seccion);

            //validacion al darle click al boton actualizar del formulario 
            $('#btnUpdOt').on('click', formulario.validarFormulario);
        },

        // formulario tabs vertical
        onClickTab: function (e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab-content").eq(index).addClass("active");
            if ($(this).attr("id") === 'contentAll') {
                $("div.bhoechie-tab-content").addClass("active");
            }
            $('.cmb-control').prop('disabled', false).trigger('selectfilled');
            $('.cmb-factor-riesgo').prop('disabled', false).trigger('selectfilled');
        },

        // show or hide informacion del formulario del modal
        toggle_info_detail: function(){
            $( ".toggle_info_detail" ).toggle( "slow", function() {
                let image = $('#btn_mostrar_detalle img');
                if (formulario.flag_img) {
                    image.attr('src', baseurl + '/assets/images/minus.png');
                    formulario.flag_img = false;
                } else {
                    image.attr('src', baseurl + '/assets/images/plus.png');
                    formulario.flag_img = true;
                }
              });
        },


        //******************* formulario de edicion oth ***************************************//
        onClickShowModalEditOTH: function () {
            var aLinkLog = $(this);
            var trParent = aLinkLog.parents('tr');
            var tabla = aLinkLog.parents('table').attr('id');
            var record;
            switch (tabla) {
                case 'table_otPadreList':
                    record = vista.table_otPadreList.row(trParent).data();
                    break;
                case 'table_otPadreListHoy':
                    record = hoy.table_otPadreListHoy.row(trParent).data();
                    break;
                case 'table_otPadreListVencidas':
                    record = vencidas.table_otPadreListVencidas.row(trParent).data();
                    break;
                case 'table_list_opc':
                    record = lista.tableOpcList.row(trParent).data();
                    break;
                case 'table_otPadreListEmails':
                    record = emails.table_otPadreListEmails.row(trParent).data();
                    break;
                case 'table_oths_otp':
                    record = listoth.table_oths_otp.row(trParent).data();
                    break;
            }

            // mostrar modal y llenar el formulario de info
            formulario.fillFormModalForm(record);
        },

        //llenamos los input del modal con la informacion a la q le dio click
        fillFormModalForm: function (data) {
            $.post(baseurl + '/OtHija/c_fillmodals',
            {
                idOth: data.id_orden_trabajo_hija// parametros que se envian
            },
            function (registro) {
                // limpiar el formulario...
                $('#general_servicio').html("");
                $('#k_id_estado_ot').html("");
                $('#num_servicio').val("");
                // formulario.cambiar_required_linea_base(false)// quitar requerido a form linea base

                $.each(registro, function (i, item) {
                    $('#' + i).val(item);
                });

                // valores calculados
                $('#k_id_estado_ot_value').val(registro.k_id_estado_ot);
                $('#id_ot_modal_edit_oth').text(registro.id_orden_trabajo_hija);

                // ocultar select se servicio y mostrar modal
                $('.ins_servicio').hide();
                $('#modalEditTicket').modal('show');

                // llear el select
                formulario.fillSelect(registro.k_id_tipo, registro.k_id_estado_ot, registro.i_orden);

                // si el tipo de la ot es KO validamos el select por si es cerrado
                if (registro.k_id_tipo == 1) {
                    console.log("registro", registro);

                    $('#k_id_estado_ot').on('change', function () {
                        //argumentos para pasar a los templates 
                        const arg = {otp:registro.k_id_ot_padre};
                        formulario.cierreKickOf(registro.n_nombre_cliente, registro.direccion_destino, arg);
                    });

                }


            });
        },

        // mostrar select de servicios
        cierreKickOf: function(nombre_cliente, direccion_destino, arg){
            $('#general_servicio').html("");
            // si se lecciona la opcion cerrada 
            if ($('#k_id_estado_ot').val() == 3)
            {
                $('#btnUpdOt').attr('disabled', true);
                // mostrar el select de servicios
                $('.ins_servicio').show();
                // al seleccionar uno de los servicios
                $('#ins_servicio').on('change', function(){
                    formulario.cambiarOpcionesForm(nombre_cliente, direccion_destino, arg);
                    $('.multiselect_forms').multiselect();
                });

            } 
            // si no se elige cerrada se resetean todos los valores
            else {
                $('#num_servicio').val("");
                $('.ins_servicio').hide();
                $('#btnUpdOt').attr('disabled', false);
                $('#tabs_form').hide();
                $('#general_servicio').html('');
                $('#ins_servicio').val('');
                // formulario.cambiar_required_linea_base(false); // quitar requerido a linea base

            }
        },

        // al elegir el servicio se llena el formulario correspondiente
        cambiarOpcionesForm: function(nombre_cliente, direccion_destino, arg){
            formulario.get_eingenieer();
            const servicio_seleccionado = $('#ins_servicio').val();
            $('#num_servicio').val(servicio_seleccionado);

            if (servicio_seleccionado == '') {
                $('#tabs_form').hide();
                $('#general_servicio').html('');
                $('#btnUpdOt').attr('disabled', true); // Se desactiva el boton de actualizar

            } else {
                $('#btnUpdOt').attr('disabled', false); // se activa el boton de actualizar
                $('#tabs_form').show();

                const servicio_nombre = $("#ins_servicio option:selected").html();
                const form_servicio = setForm.returnFormularyService(nombre_cliente, direccion_destino, servicio_seleccionado, servicio_nombre);
                const form_producto = setForm.returnFormularyProduct(servicio_seleccionado, arg);
                // pinto el formulario de servicio
                $('#general_servicio').html(form_servicio);
                $('#general_producto').html(form_producto);

                // dejar requeridos los campos de linea base
                // formulario.cambiar_required_linea_base(true);

                formulario.get_eingenieer(); // lenar los selects con los ingenieros actuales
                formulario.llenarInfoIngeniero(); // llena la informacion en los input de los inge seleccionados
                
                
            }


            // switch (servicio_seleccionado) {
            //     case "0":
            //         $('#btnUpdOt').attr('disabled', true);
            //         break
            //     case "1":
            //         $('#formModal').attr('action', 'Templates/c_updateStatusOt/1');
            //         $('#btnUpdOt').attr('disabled', false);
            //         $("#nombre").attr("required", true);
            //         break;
            //     case "2":
            //         $('#formModal').attr('action', 'Templates/c_updateStatusOt/2');
            //         $('#btnUpdOt').attr('disabled', false);
            //         break;
            //     case "3":
            //         $('#formModal').attr('action', 'Templates/c_updateStatusOt/3');
            //         $('#btnUpdOt').attr('disabled', false);
            //         break;
            //     case "4":
            //         $('#formModal').attr('action', 'Templates/c_updateStatusOt/4');
            //         $('#btnUpdOt').attr('disabled', false);
            //         break;
            //     case "5":
            //         $('#formModal').attr('action', 'Templates/c_updateStatusOt/5');
            //         $('#btnUpdOt').attr('disabled', false);
            //         break;
            //     case "6":
            //         $('#formModal').attr('action', 'Templates/c_updateStatusOt/6');
            //         $('#btnUpdOt').attr('disabled', false);
            //         break;
            //     case "7":
            //         $('#formModal').attr('action', 'Templates/c_updateStatusOt/7');
            //         $('#btnUpdOt').attr('disabled', false);
            //         break;
            //     case "8":
            //         $('#formModal').attr('action', 'Templates/c_updateStatusOt/8');
            //         $('#btnUpdOt').attr('disabled', false);
            //         break;
            //     case "9":
            //         $('#formModal').attr('action', 'Templates/c_updateStatusOt/9');
            //         $('#btnUpdOt').attr('disabled', false);
            //         break;
            //     case "10":
            //         $('#formModal').attr('action', 'Templates/c_updateStatusOt/10');
            //         $('#btnUpdOt').attr('disabled', false);
            //         break;

            // }
        },

        //limpia el modal cada vez que se cierra
        clearModal: function () {
            $('#formModal')[0].reset();
            $("label.error").remove();
            $('#num_servicio').val("");
                $('.ins_servicio').hide();
                $('#btnUpdOt').attr('disabled', false);
                $('#tabs_form').hide();
                $('#general_servicio').html('');
                $('#ins_servicio').val('');
        },



        fillSelect: function (idtipo, val_estado, orden) {

            $.ajaxSetup({async: false});
            $.post(baseurl + "/User/c_getStatusByType",
                    {
                        idtipo: idtipo
                    },
                    function (data) {
                        // Decodifica el objeto traido desde el controlador
                        var status = JSON.parse(data);
                        // Pinto el select de estado
                        $.each(status, function (i, item) {
                            if (val_estado == item.k_id_estado_ot) {
                                $('.llenarEstadosJS').append('<option value="' + item.k_id_estado_ot + '" selected>' + item.n_name_estado_ot + '</option>');
                            } else {
                                if (parseInt(item.i_orden) < parseInt(orden)) {
                                    $('.llenarEstadosJS').append('<option value="' + item.k_id_estado_ot + '" disabled>' + item.n_name_estado_ot + '</option>');
                                } else {
                                    $('.llenarEstadosJS').append('<option value="' + item.k_id_estado_ot + '">' + item.n_name_estado_ot + '</option>');
                                }
                            }
                        });
                    });

        },


        // lllenar la informacion del ingeniero seleccionado
        llenarInfoIngeniero: function(){
            $('#ingeniero1').on('change', formulario.fill_information);
            $('#ingeniero2').on('change', formulario.fill_information);
            $('#ingeniero3').on('change', formulario.fill_information);
        },

        // Metodo para validar formularios al darle click en actualizar
        validarFormulario: function () {
            if ($("#k_id_estado_ot").val() == 3) {
                let msj = false;
                // const mail = $('#ingeniero1_email').val();
                // const mail1 = $('#mail_envio').val();
                // const expresiones = /\w+@\w+\.+[a-z]/;

                const inputs =  $('.validar_required');

                $.each(inputs, function(i, input) {
                    if (input.value == '') {
                        msj = true;
                        input.style.boxShadow = "0 0 5px rgba(253, 1, 1)";
                    } else {
                        input.style.boxShadow = "none";
                    }
                });

                if (msj) {
                    helper.miniAlert('!Estos campos son requeridos¡');
                    return false;
                }

                /*validar el formato del correo*/
                // if (!expresiones.test(mail) || !expresiones.test(mail1)) {
                //     swal('Error', 'El formato del correo está mal', 'error');
                //     return false;
                // }

                const email_user = helper.inSession('n_mail_user');

                swal({
                    title: "Desea Guardar?",
                    html: `La información se enviará al correo <br> <b>${email_user}</b>`,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, Continuar!',
                    cancelButtonText: 'Cancelar!',

                }).then((continuar) => {
                    if (continuar.value) {
                        $('#formModal').submit();
                    } else {
                        helper.miniAlert();
                       return false;
                    }
                });
            
            } else {
                $('#formModal').submit();
            }
        },
        //llena el select de ingeniero
        get_eingenieer: function () {
            $.post(baseurl + '/User/c_get_eingenieer', {

            }, function (data) {
                var ingeniero = JSON.parse(data);
                $.each(ingeniero, function (i, item) {
                    $('.class_fill_eingenieer').append('<option data-tel="' + item.telefono + '" data-email="' + item.mail + '" value="' + item.nombre + '" >' + item.nombre + '</option>');
                });

            });

        },
        fill_information: function (event) {
            var ing = event.target.id;
            $('#' + ing + '_tel').val($(this).find(':selected').data('tel'));
            $('#' + ing + '_email').val($(this).find(':selected').data('email'));
        },

        // cambia el required del formulario de linea base segun lo que le pasemos de argumento
        cambiar_required_linea_base: function(bool){
            const inputs = $('#general_linea_base input');
            $.each(inputs, function(i, input) {
                if (bool) {
                    input.setAttribute('required', true);
                } else {
                    input.removeAttribute('required');
                }
            });
        },





        //************ fin formulario de edicion oth ***************//



    };
    formulario.init();
});
