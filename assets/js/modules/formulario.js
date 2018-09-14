$(function () {
    formulario = {
        init: function () {
            formulario.events();
        },

        //Eventos de la ventana.
        events: function () {  	
        },
        //******************* formulario de edicion oth ***************************************//
        onClickShowModalEdit: function () {
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
            formulario.fillFormModal(record);
        },

        //llenamos los input del modal con la informacion a la q le dio click
        //llenamos los input del modal con la informacion a la q le dio click
        fillFormModal: function (data) {
            $.post(baseurl + '/OtHija/c_fillmodals',
                    {
                        idOth: data.id_orden_trabajo_hija// parametros que se envian
                    },
                    function (registro) {

                        // limpiar el formulario...
                        $('#general').html("");
                        $('#k_id_estado_ot').html("");
                        $.each(registro, function (i, item) {
                            $('#' + i).val(item);
                        });


                        $('#k_id_estado_ot_value').val(registro.k_id_estado_ot);

                        $('#id_ot_modal_edit_oth').text(registro.id_orden_trabajo_hija);


                        formulario.fillSelect(registro.k_id_tipo, registro.k_id_estado_ot, registro.i_orden);

                        // $('#k_id_estado_ot option[value="'+registro.k_id_estado_ot+'"]').attr('selected', true);
                        // $(`#k_id_estado_ot option [value= "${registro.k_id_estado_ot}"]`).attr("selected", true);


                        var algo = $('#k_id_estado_ot').val();
                        if (registro.k_id_tipo == 1) {
                            $('#k_id_estado_ot').on('change', function () {
                                // $('')
                                $('#general').html("");
                                if ($('#k_id_estado_ot').val() == 3)
                                {
                                    $('#btnUpdOt').attr('disabled', true);
                                    $('.ins_servicio').show();
                                    $('#ins_servicio').on('change', function () {
                                        formulario.get_eingenieer();

                                        // para llenar inputs de ingeniero 1 en el modal
                                        $('#ingeniero1').on('change', formulario.fill_information);
                                        $('#ingeniero2').on('change', formulario.fill_information);
                                        $('#ingeniero3').on('change', formulario.fill_information);

                                        var otra = $('#ins_servicio').val();
                                        switch (otra) {
                                            case "0":
                                                $('#btnUpdOt').attr('disabled', true);
                                                break
                                            case "1":
                                                $('#formModal').attr('action', 'Templates/c_updateStatusOt/1');
                                                $('#btnUpdOt').attr('disabled', false);
                                                $("#nombre").attr("required", true);
                                                break;
                                            case "2":
                                                $('#formModal').attr('action', 'Templates/c_updateStatusOt/2');
                                                $('#btnUpdOt').attr('disabled', false);
                                                break;
                                            case "3":
                                                $('#formModal').attr('action', 'Templates/c_updateStatusOt/3');
                                                $('#btnUpdOt').attr('disabled', false);
                                                break;
                                            case "4":
                                                $('#formModal').attr('action', 'Templates/c_updateStatusOt/4');
                                                $('#btnUpdOt').attr('disabled', false);
                                                break;
                                            case "5":
                                                $('#formModal').attr('action', 'Templates/c_updateStatusOt/5');
                                                $('#btnUpdOt').attr('disabled', false);
                                                break;
                                            case "6":
                                                $('#formModal').attr('action', 'Templates/c_updateStatusOt/6');
                                                $('#btnUpdOt').attr('disabled', false);
                                                break;
                                            case "7":
                                                $('#formModal').attr('action', 'Templates/c_updateStatusOt/7');
                                                $('#btnUpdOt').attr('disabled', false);
                                                break;
                                            case "8":
                                                $('#formModal').attr('action', 'Templates/c_updateStatusOt/8');
                                                $('#btnUpdOt').attr('disabled', false);
                                                break;
                                            case "9":
                                                $('#formModal').attr('action', 'Templates/c_updateStatusOt/9');
                                                $('#btnUpdOt').attr('disabled', false);
                                                break;
                                            case "10":
                                                $('#formModal').attr('action', 'Templates/c_updateStatusOt/10');
                                                $('#btnUpdOt').attr('disabled', false);
                                                break;

                                        }
                                    });
                                } else {
                                    $('.ins_servicio').hide();
                                    $('#btnUpdOt').attr('disabled', false);
                                }
                            });

                        }
                        $('#ins_servicio').on('change', function () {
                            formulario.selectFormulary(registro.n_nombre_cliente, registro.direccion_destino);
                        });

                        $('.ins_servicio').hide();
                        $('#modalEditTicket').modal('show');
                    });
        },
        //limpia el modal cada vez que se cierra
        clearModal: function () {
            $('#formModal')[0].reset();
            $("label.error").remove();
        },

        selectFormulary: function (nombre_cliente, direccion_destino) {
            $('#general').html("");

            var servicio_val = $("#ins_servicio option:selected").html();
            var toog = true;
            var jmm = $('#general').html("");
            var valServicio = 0;
            valServicio = $('#ins_servicio').val();

            var form = "";
            form += `
                        <div class="widget bg_white m-t-25 display-block cliente" id="seccion_correos">
                            <fieldset class="col-md-6 control-label">
                            <span class="div_Text_Form_modal"><strong>Email al que se dirije el correo: &nbsp;</strong></span>
                            </fieldset>
                            <!-- fin seccion izquierda form-->

                            <!--  inicio seccion derecha form---->
                            <fieldset>
                                <div class="form-group mail_envio">
                                    <label for="mail_envio" class="col-md-3 control-label"> </label>
                                    <div class="col-md-8 selectContainer div_Form_Modals">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="mail_envio" id="mail_envio" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                <span class="btn btn-cami_cool" id="añadir_correo"> Add  <span class="fa fa-plus"></span></span>
                                </div>
                            </fieldset>
                        </div>
                        <div class="widget bg_white m-t-25 display-block cliente">
                            <fieldset class="col-md-6 control-label">
                                <div class="form-group nombre " >
                                    <label for="nombre" class="col-md-3 control-label">Nombre: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="nombre" id="nombre" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group nombre_cliente">
                                    <label for="nombre_cliente" class="col-md-3 control-label">Nombre Cliente: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="nombre_cliente" id="nombre_cliente_val" class="form-control" type="text" value="${nombre_cliente}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!-- fin seccion izquierda form-->

                            <!--  inicio seccion derecha form---->
                            <fieldset>
                                <div class="form-group servicio">
                                    <label for="fecha_creacion_ot_hija" class="col-md-3 control-label">Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="servicio" id="servicio_val" class="form-control" type="text" value="${servicio_val}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group fecha">
                                    <label for="fecha" class="col-md-3 control-label">Fecha: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                            <input name="fecha" id="fecha" class="form-control" type="text" value="${fecha_actual}" readonly>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                            </div>`;



            switch (valServicio) {
                case "0":
                    form = "";
                    toog = false;
                    break;
                case "1":
                    form += ` <div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                              <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" value="${direccion_destino}" >
                                                        </div>
                                                    </div>
                                                </div>                                              
                                                <div class="form-group ancho_banda">
                                                    <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="number" required>
                                                            <span class="input-group-addon">MHz</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group interfaz_grafica">
                                                    <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </fieldset>
                                        </div>   

                                `;

                    break;
                case "2":
                    form += ` <div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                              <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" value="${direccion_destino}" >
                                                        </div>
                                                    </div>
                                                </div>                                              
                                                <div class="form-group ancho_banda">
                                                    <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="number" required>
                                                            <span class="input-group-addon">MHz</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group interfaz_grafica">
                                                    <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </fieldset>
                                        </div>   
                                `;
                    break;
                case "3":
                    form += `
                                <div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                               <div class="form-group existente">
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Existente: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="existente" id="existente" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" value="${direccion_destino}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group nuevo">
                                                    <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="nuevo" id="nuevo" class="form-control" type="text">
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group ancho_banda">
                                                  <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="number" required>
                                                            <span class="input-group-addon">MHz</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>   
                    
                                    `;
                    break;
                case "4":
                    form += ` <div class="widget bg_white m-t-25 display-block cliente">
                                    <fieldset class="col-md-6 control-label">
                                      <div class="form-group direccion_instalacion_des">
                                            <label for="direccion_instalacion_des1" class="col-md-3 style="margin-top: -21px;" control-label">Direccion De Instalacion (Descripcion 1 del servicio): &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="direccion_instalacion_des1" id="direccion_instalacion_des1" class="form-control" type="text" required >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group direccion_instalacion_des">
                                            <label for="direccion_instalacion_des2" class="col-md-3 control-label">Direccion De Instalacion (Descripcion 2 del servicio): &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="direccion_instalacion_des2" id="direccion_instalacion_des2" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </fieldset> 
                                    
                                    <fieldset>
                                        <div class="form-group direccion_instalacion_des">
                                            <label for="direccion_instalacion_des3" class="col-md-3 control-label">Direccion De Instalacion (Descripcion 3 del servicio): &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="direccion_instalacion_des3" id="direccion_instalacion_des3" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group direccion_instalacion_des">
                                            <label for="direccion_instalacion_des4" class="col-md-3 control-label">Direccion De Instalacion (Descripcion 4 del servicio): &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="direccion_instalacion_des4" id="direccion_instalacion_des4" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>  
                                      <div class="widget bg_white m-t-25 display-block cliente">
                                    <fieldset class="col-md-6 control-label">
                                      <div class="form-group ">
                                            <label for="equipos_intalar_camp1" class="col-md-3 control-label">Equipos a Instalar: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="equipos_intalar_camp1" id="equipos_intalar_camp1" class="form-control" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group equipos_instalar">
                                            <label for="equipos_intalar_camp2" class="col-md-3 control-label">Equipos a Instalar: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="equipos_intalar_camp2" id="equipos_intalar_camp2" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset> 
                                    
                                    <fieldset>
                                        <div class="form-group equipos_instalar">
                                            <label for="equipos_intalar_camp3" class="col-md-3 control-label">Equipos a Instalar: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="equipos_intalar_camp3" id="equipos_intalar_camp3" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group fecha_servicio">
                                            <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                                    <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div> 
                                <div class="widget bg_white m-t-25 display-block cliente">
                                    <fieldset class="col-md-6 control-label">
                                      <div class="form-group existente">
                                            <label for="existente" class="col-md-3 control-label">Existente: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="existente" id="existente" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group nuevo">
                                            <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="nuevo" id="nuevo" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset> 
                                    
                                    <fieldset>
                                        <div class="form-group ancho_banda">
                                            <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="ancho_banda" id="ancho_banda" class="form-control" type="number" required>
                                                    <span class="input-group-addon">MHz</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group interfaz_grafica">
                                            <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                </div>
                                            </div>
                                        </div> 
                                    </fieldset>
                                </div> 
                         
                           `;
                    break;
                case "5":
                    form += `<div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                               <div class="form-group existente">
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Existente: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="existente" id="existente" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" value="${direccion_destino}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group nuevo">
                                                    <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="nuevo" id="nuevo" class="form-control" type="text">
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group ancho_banda">
                                                  <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="number" required>
                                                            <span class="input-group-addon">MHz</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>   
                            `;

                    break;
                case "6":
                    form += `<div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                               <div class="form-group existente">
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Existente: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="existente" id="existente" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" value="${direccion_destino}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group nuevo">
                                                    <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="nuevo" id="nuevo" class="form-control" type="text">
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group ancho_banda">
                                                  <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="number" required>
                                                            <span class="input-group-addon">MHz</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>   
                            `;
                    break;
                case "7":
                    form += `<div class="widget bg_white m-t-25 display-block cliente">
                                    <fieldset class="col-md-6 control-label">
                                       <div class="form-group existente">
                                            <label for="proveedor_ultima_milla" class="col-md-3 control-label">Existente: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="existente" id="existente" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group direccion_instalacion">
                                            <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group direccion">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" value="${direccion_destino}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group interfaz_grafica">
                                         <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </fieldset> 
                                    
                                    <fieldset>
                                        <div class="form-group nuevo">
                                            <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="nuevo" id="nuevo" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group ancho_banda">
                                          <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="ancho_banda" id="ancho_banda" class="form-control" type="number" required>
                                                    <span class="input-group-addon">MHz</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group fecha_servicio">
                            <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                    <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>   
                                    `;
                    break;
                case "8":
                    form += `<div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                               <div class="form-group existente">
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Existente: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="existente" id="existente" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" value="${direccion_destino}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group nuevo">
                                                    <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="nuevo" id="nuevo" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group ancho_banda">
                                                  <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="number" required>
                                                            <span class="input-group-addon">MHz</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>   
                                    `;

                    break;
                case "9":
                    form += `<div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                               <div class="form-group existente">
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Existente: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="existente" id="existente" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" value="${direccion_destino}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group nuevo">
                                                    <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="nuevo" id="nuevo" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group ancho_banda">
                                                  <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="number" required>
                                                            <span class="input-group-addon">MHz</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>   
                                    `;
                    break;
                case "10":
                    form += `<div class="widget bg_white m-t-25 display-block cliente">
                                            <fieldset class="col-md-6 control-label">
                                               <div class="form-group existente">
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Existente: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="existente" id="existente" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group direccion_instalacion">
                                                    <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group direccion">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" value="${direccion_destino}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" required >
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </fieldset> 
                                            
                                            <fieldset>
                                                <div class="form-group nuevo">
                                                    <label for="nuevo" class="col-md-3 control-label">Nuevo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="nuevo" id="nuevo" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group ancho_banda">
                                                  <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="number" required>
                                                            <span class="input-group-addon">MHz</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="date" required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>   
                                    `;
                    break;

                default:
            }
            if (toog) {


                form += `             <div class="widget bg_white m-t-25 display-block ">
                                                <fieldset class="col-md-6 control-label">
                                                <div class="form-group ingeniero1">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Ingeniero 1: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <select name="ingeniero1" id="ingeniero1" class="form-control class_fill_eingenieer" type="text" required >
                                                                <option value="">Seleccionar</opction>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero1_tel ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Telefono: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero1_tel" id="ingeniero1_tel" class="form-control class_fill_eingenieer" type="number" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero1 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Email: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero1_email" id="ingeniero1_email" class="form-control class_fill_eingenieer" type="email"required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <!--  fin seccion izquierda form---->

                                                <!--  inicio seccion derecha form---->
                                                <fieldset>
                                                     <div class="form-group ingeniero2 ">
                                                        <label for="ingeniero2" class="col-md-3 control-label">Ingeniero 2: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <select name="ingeniero2" id="ingeniero2" class="form-control class_fill_eingenieer" type="text" >
                                                                <option value="">Seleccionar</opction>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero2 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Telefono: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero2_tel" id="ingeniero2_tel" class="form-control class_fill_eingenieer" type="number" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero2 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Email: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero2_email" id="ingeniero2_email" class="form-control class_fill_eingenieer" type="email" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero3 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Ingeniero 3: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <select name="ingeniero3" id="ingeniero3" class="form-control class_fill_eingenieer" type="text" >
                                                                <option value="">Seleccionar</opction>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero3 ingenieros">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Telefono: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero3_tel" id="ingeniero3_tel" class="form-control class_fill_eingenieer" type="number" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero3 ingenieros">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Email: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero3_email" id="ingeniero3_email" class="form-control class_fill_eingenieer" type="email" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>`;

            }

            $('#general').html(form);

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
        clicOnButton: function () {
            if ($("#k_id_estado_ot").val() == 3) {
                var msj = false;
                var response = true;
                var mail = $('#ingeniero1_email').val();
                var mail1 = $('#mail_envio').val();
                var expresiones = /\w+@\w+\.+[a-z]/;
                var inputs = [$('#nombre'),
                    $('#nombre_cliente_val'),
                    $('#servicio_val'),
                    $('#fecha'),
                    $('#direccion_instalacion'),
                    $('#direccion_instalacion_des1'),
                    $('#ancho_banda'),
                    $('#interfaz_entrega'),
                    $('#equipos_intalar_camp1'),
                    $('#fecha_servicio'),
                    $('#ingeniero1'),
                    $('#ingeniero1_tel'),
                    $('#ingeniero1_email'),
                    $('#mail_envio')
                ];
                inputs.forEach(function (input) {
                    if (input.val() == '') {
                        msj = true;
                        input.css("box-shadow", "0 0 5px rgba(253, 1, 1)");
                        return false;
                    } else {
                        input.css("box-shadow", "none");
                    }
                });
                if (msj) {
                    swal('Error', 'Complete correctamente los campos', 'error');
                    response = false;
                    return false;
                }

                if (!expresiones.test(mail) || !expresiones.test(mail1)) {
                    swal('Error', 'El formato del correo está mal', 'error');
                    return false;
                }

                if (response) {

                    swal({
                        title: "Advertencia",
                        text: '¿El correo  ' + mail1 + '  es el correcto?',
                        icon: "warning",
                        buttons: true,

                        dangerMode: true,
                        buttons: {
                            cancel: "Cancelar!",
                            continuar: {
                                text: "Continuar!",
                                value: "continuar",
                                className: "btn_continuar",
                            },
                        },
                    })
                            .then((continuar) => {
                                if (continuar) {
                                    $('#formModal').submit();
                                    response = true;
                                } else {
                                    swal("¡Cancelaste la operación!", {
                                        icon: "error",
                                        dangerMode: true,
                                    });
                                    response = false;
                                    return false;
                                }
                            });
                }
                return false;
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
        //************ fin formulario de edicion oth ***************//



    };
    formulario.init();
});
