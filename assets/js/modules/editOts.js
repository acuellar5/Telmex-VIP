$(function () {
    var ini = {
        timers: [],
        init: function () {
            ini.events();
            ini.listVmAssigned();
            ini.ListOtsfiteenDays();
        },
        //Eventos de la ventana.
        events: function () {
            //Al darle clic a una fila llama la funcion onClickTrTablaEditOts
            $('#tablaEditOts').on('click', 'tr', ini.onClickTrTablaEditOts);
            $('#tablaOtsfiteenDays').on('click', 'tr', ini.onClickTrTablaOtsfiteenDays);
            $('#k_id_estado_ot').on('change', ini.onChangeTextStateOt);
            $('#btnUpdOt').on('click', ini.onSubmitForm);
            $('#btnOtsfiteenDays').on('click', ini.showListOtsfiteenDays);
            $('#ins_servicio').on('change', ini.selectFormulary );
            $('.cerrar').on('click', ini.clearModal);
            
        },


        selectFormulary: function () {
                $('#general').html("");
                var toog = true;
                var jmm = $('#general').html("");
                var valServicio = 0;
                    valServicio = $('#ins_servicio').val();
                
                var form = "";
                form += `<div class="widget bg_white m-t-25 display-block cliente">
                            <fieldset class="col-md-6 control-label">
                                <div class="form-group nombre " >
                                    <label for="nombre" class="col-md-3 control-label">Nombre: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="nombre" id="nombre" class="form-control" type="text" >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group nombre_cliente">
                                    <label for="nombre_cliente" class="col-md-3 control-label">Nombre Cliente: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="nombre_cliente" id="nombre_cliente" class="form-control" type="text" >
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
                                            <input name="servicio" id="servicio" class="form-control" type="text" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group fecha">
                                    <label for="fecha" class="col-md-3 control-label">Fecha: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                            <input name="fecha" id="fecha" class="form-control" type="date" >
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                        </div>`;
                    


                switch(valServicio) {
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
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>                                              
                                                <div class="form-group ancho_banda">
                                                    <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" >
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
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="text" >
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
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>                                              
                                                <div class="form-group ancho_banda">
                                                    <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" >
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
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="text" >
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
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Exsistente: &nbsp;</label>
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
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" >
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
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="text" >
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
                                                    <input name="direccion_instalacion_des1" id="direccion_instalacion_des1" class="form-control" type="text" >
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
                                                    <input name="equipos_intalar_camp1" id="equipos_intalar_camp1" class="form-control" type="text" >
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
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div> 
                                <div class="widget bg_white m-t-25 display-block cliente">
                                    <fieldset class="col-md-6 control-label">
                                      <div class="form-group existente">
                                            <label for="existente" class="col-md-3 control-label">Exsistente: &nbsp;</label>
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
                                                    <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group interfaz_grafica">
                                            <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" >
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
                                  <div class="form-group direccion_instalacion">
                                        <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group direccion">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" >
                                            </div>
                                        </div>
                                    </div>                                              
                                    <div class="form-group ancho_banda">
                                        <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" >
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
                                                <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group fecha_servicio">
                                        <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="text" >
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
                                  <div class="form-group direccion_instalacion">
                                        <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group direccion">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" >
                                            </div>
                                        </div>
                                    </div>                                              
                                    <div class="form-group ancho_banda">
                                        <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" >
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
                                                <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group fecha_servicio">
                                        <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="text" >
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
                                            <label for="proveedor_ultima_milla" class="col-md-3 control-label">Exsistente: &nbsp;</label>
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
                                                    <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group interfaz_grafica">
                                         <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" >
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
                                                    <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group fecha_servicio">
                            <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                    <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="text" >
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
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Exsistente: &nbsp;</label>
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
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" >
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
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="text" >
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
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Exsistente: &nbsp;</label>
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
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" >
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
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="text" >
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
                                                    <label for="proveedor_ultima_milla" class="col-md-3 control-label">Exsistente: &nbsp;</label>
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
                                                            <input name="direccion_instalacion" id="direccion_instalacion" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group interfaz_grafica">
                                                 <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                            <input name="interfaz_entrega" id="interfaz_entrega" class="form-control" type="text" >
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
                                                            <input name="ancho_banda" id="ancho_banda" class="form-control" type="text" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group fecha_servicio">
                                    <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                            <input name="fecha_servicio" id="fecha_servicio" class="form-control" type="text" >
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
                                                                <input name="ingeniero1" id="ingeniero1" class="form-control" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero1_tel ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Telefono: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero1_tel" id="ingeniero1_tel" class="form-control" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero1 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Email: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero1_email" id="ingeniero1_email" class="form-control" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <!--  fin seccion izquierda form---->

                                                <!--  inicio seccion derecha form---->
                                                <fieldset>
                                                     <div class="form-group ingeniero2 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Ingeniero 2: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero2" id="ingeniero2" class="form-control" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero2 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Telefono: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero2_tel" id="ingeniero2_tel" class="form-control" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero2 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Email: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero2_email" id="ingeniero2_email" class="form-control" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero3 ">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Ingeniero 3: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero3" id="ingeniero3" class="form-control" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero3 ingenieros">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Telefono: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero3_tel" id="ingeniero3_tel" class="form-control" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ingeniero3 ingenieros">
                                                        <label for="proveedor_ultima_milla" class="col-md-3 control-label">Email: &nbsp;</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                                <input name="ingeniero3_email" id="ingeniero3_email" class="form-control" type="text" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>`;

                }

            $('#general').html(form);;








         },

        //limpia el modal cada vez que se cierra
        clearModal: function(){   
             $('#formModal')[0].reset();
             $("label.error").remove();
        },



        modalSendMailUpdateReport: function () {
            $('#modalSendMailUpdateReport').modal('show');
        },
        onClickTrTablaOtsfiteenDays: function () {
            var tr = $(this);
            ini.tr = tr;
            if (ini.tablaOtsfiteenDays) {
                var registro = ini.tablaOtsfiteenDays.row(tr).data();
                //si selecciona el header de la tabla no se muestre el modal
                if (registro != undefined) {
                    ini.modalSendMailUpdateReport(registro);
                }
            }
        },
        showListOtsfiteenDays: function (e) {
            app.stopEvent(e);
            $('#modalListOtsfiteenDays').modal('show');
        },
        onSubmitForm: function (e) {
            app.stopEvent(e);
            var form = $(this);
//        dom.confirmar("¿Está seguro que desea escalar el ticket?", function () {
            dom.submitDirect($('#formModal'), function (response) {
                if (response.code > 0) {
                    swal("Guardado", "Se guardaron los cambios exitosamente", "success").then(function () {
                        $('#modalEditTicket').modal('hide');
                    });
                } else {
                    swal("Error", "Lo sentimos se ha producido un error", "error");
                }
            });
//        }, function () {
//            swal("Cancelado", "Se ha cancelado la acción", "error");
//        });
        },
        // Capturo los valores de la fila a la que le doy clic
        onChangeTextStateOt: function () {
            var otEstado = $("#k_id_estado_ot option:selected").text().replace('_', '.');
            $('#estado_orden_trabajo_hija').val(otEstado);
        },
        onClickTrTablaEditOts: function () {
            var tr = $(this);
            ini.tr = tr;
            if (ini.tablaEditOts) {
                var registro = ini.tablaEditOts.row(tr).data();
                //si selecciona el header de la tabla no se muestre el modal
                if (registro != undefined) {
                    ini.modalEdit(registro);
                }
            }

        },
        //llama el modal
        modalEdit: function (registro) {
            // console.log(registro);
            ini.onChangeTextStateOt;
            $('#k_id_register').val(registro.k_id_register);
            $('#id_cliente_onyx').val(registro.id_cliente_onyx);
            $('#nombre_cliente').val(registro.nombre_cliente);
            $('#grupo_objetivo').val(registro.grupo_objetivo);
            $('#segmento').val(registro.segmento);
            $('#nivel_atencion').val(registro.nivel_atencion);
            $('#ciudad').val(registro.ciudad);
            $('#departamento').val(registro.departamento);
            $('#grupo').val(registro.grupo);
            $('#consultor_comercial').val(registro.consultor_comercial);
            $('#grupo2').val(registro.grupo2);
            $('#consultor_postventa').val(registro.consultor_postventa);
            $('#proy_instalacion').val(registro.proy_instalacion);
            $('#ing_responsable').val(registro.ing_responsable);
            $('#id_enlace').val(registro.id_enlace);
            $('#alias_enlace').val(registro.alias_enlace);
            $('#orden_trabajo').val(registro.orden_trabajo);
            $('#nro_ot_onyx').val(registro.nro_ot_onyx);
            $('#servicio').val(registro.servicio);
            $('#familia').val(registro.familia);
            $('#producto').val(registro.producto);
            $('#fecha_creacion').val(registro.fecha_creacion);
            $('#tiempo_incidente').val(registro.tiempo_incidente);
            $('#estado_orden_trabajo').val(registro.estado_orden_trabajo);
            $('#tiempo_estado').val(registro.tiempo_estado);
            $('#ano_ingreso_estado').val(registro.ano_ingreso_estado);
            $('#mes_ngreso_estado').val(registro.mes_ngreso_estado);
            $('#fecha_ingreso_estado').val(registro.fecha_ingreso_estado);
            $('#usuario_asignado').val(registro.usuario_asignado);
            $('#grupo_asignado').val(registro.grupo_asignado);
            $('#ingeniero_provisioning').val(registro.ingeniero_provisioning);
            $('#cargo_arriendo').val(registro.cargo_arriendo);
            $('#cargo_mensual').val(registro.cargo_mensual);
            $('#monto_moneda_local_arriendo').val(registro.monto_moneda_local_arriendo);
            $('#monto_moneda_local_cargo_mensual').val(registro.monto_moneda_local_cargo_mensual);
            $('#cargo_obra_civil').val(registro.cargo_obra_civil);
            $('#descripcion').val(registro.descripcion);
            $('#direccion_origen').val(registro.direccion_origen);
            $('#ciudad_incidente').val(registro.ciudad_incidente);
            $('#direccion_destino').val(registro.direccion_destino);
            $('#ciudad_incidente3').val(registro.ciudad_incidente3);
            $('#fecha_compromiso').val(registro.fecha_compromiso);
            $('#fecha_programacion').val(registro.fecha_programacion);
            $('#fecha_realizacion').val(registro.fecha_realizacion);
            $('#resolucion_1').val(registro.resolucion_1);
            $('#resolucion_2').val(registro.resolucion_2);
            $('#resolucion_3').val(registro.resolucion_3);
            $('#resolucion_4').val(registro.resolucion_4);
            $('#fecha_creacion_ot_hija').val(registro.fecha_creacion_ot_hija);
            $('#proveedor_ultima_milla').val(registro.proveedor_ultima_milla);
            $('#usuario_asignado4').val(registro.usuario_asignado4);
            $('#resolucion_15').val(registro.resolucion_15);
            $('#resolucion_26').val(registro.resolucion_26);
            $('#resolucion_37').val(registro.resolucion_37);
            $('#resolucion_48').val(registro.resolucion_48);
            $('#ot_hija').val(registro.ot_hija);
            $('#k_id_tipo').val(registro.k_id_tipo);
            console.log(registro.k_id_tipo); 
            $('#estado_orden_trabajo_hija').val(registro.estado_orden_trabajo_hija);
            $('#fec_actualizacion_onyx_hija').val(registro.fec_actualizacion_onyx_hija);
            $('#k_id_estado_ot option').each(function () {
                $(this).remove();
            });
            for (var j = 0; j < estadosOts.data.length; j++) {
                if (estadosOts.data[j].k_id_tipo == registro.k_id_tipo) {
                    $('#k_id_estado_ot').append($('<option>', {
                        value: estadosOts.data[j].k_id_estado_ot,
                        text: estadosOts.data[j].n_name_estado_ot.replace('.', '_')
                    }));
                }
            }
            $("#k_id_estado_ot option:contains('" + registro.estado_orden_trabajo_hija.replace('.', '_') + "')").attr("selected", true);
            //mostrar modal

            if (registro.k_id_tipo == 1) {
                 $('#k_id_estado_ot').on('change', function(){
                    if ($('#k_id_estado_ot').val() == 3 )
                        {
                            $('.ins_servicio').show();
                            $('#btnUpdOt').attr('disabled', true);
                        }else{
                            $('.ins_servicio').hide();
                            $('#btnUpdOt').attr('disabled', false);
                        }
                 });

            } else {

            }




            $('.ins_servicio').hide();
            $('#modalEditTicket').modal('show');


        },
        /**
         * Listará las actividades de los usuarios que ingresan al sistema...
         */
        listVmAssigned: function () {
            //Invoca fillTable para configurar la TABLA.
            // ini.fillTable([]);
            //Realiza la petición AJAX para traer los datos...
            var alert = dom.printAlert('Consultando registros, por favor espere.', 'loading', $('#principalAlert'));
            app.post('OtHija/getOtsAssigned')
                    .complete(function () {
                        alert.hide();
                        $('.contentPrincipal').removeClass('hidden');
                    })
                    .success(function (response) {
//                        console.log(response);
                        if (app.successResponse(response)) {
                            ini.fillTable(response.data);
                        } else {
                            ini.fillTable([]);
                        }
                    }).error(function (e) {
                console.error(e);
            }).send();
        },
        //Temporalmente...
        fillNA: function () {
            return "N/A";
        },
        fillTable: function (data) {
            if (ini.tablaEditOts) {
                dom.refreshTable(ini.tablaEditOts, data);
                return;
            }
            ini.tablaEditOts = $('#tablaEditOts').DataTable(dom.configTable(data,
                    [
                        {title: "Id Cliente Onyx", data: "id_cliente_onyx"},
                        {title: "Nombre Cliente", data: "nombre_cliente"},
                        {title: "Fecha Compromiso", data: "fecha_compromiso"},
                        {title: "Fecha Programación", data: "fecha_programacion"},
                        {title: "Id Orden Trabajo Hija", data: "id_orden_trabajo_hija"},
                        {title: "Ot Hija", data: "ot_hija"},
                        {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
//                        {title: "Dias", data: "n_days"},
                    ],
                    ));
        },
        ListOtsfiteenDays: function () {
            //Invoca fillTable para configurar la TABLA.
            // ini.fillTable([]);
            //Realiza la petición AJAX para traer los datos...
//            var alert = dom.printAlert('Consultando registros, por favor espere.', 'loading', $('#principalAlert'));
            app.post('OtHija/getOtsFiteenDays')
                    .complete(function () {
//                        alert.hide();
                        $('.contentPrincipal').removeClass('hidden');
                    })
                    .success(function (response) {
//                        console.log(response);
                        $('#countBadge').html(response.count.cont);
                        if (app.successResponse(response.data)) {
                            ini.fillTableOtsfiteenDays(response.data.data);
                        } else {
                            ini.fillTableOtsfiteenDays([]);
                        }
                    }).error(function (e) {
                console.error(e);
            }).send();
        },
        fillTableOtsfiteenDays: function (data) {
            if (ini.tablaOtsfiteenDays) {
                dom.refreshTable(ini.tablaOtsfiteenDays, data);
                return;
            }
            ini.tablaOtsfiteenDays = $('#tablaOtsfiteenDays').DataTable(dom.configTable(data,
                    [
                        {title: "Id Cliente Onyx", data: "id_cliente_onyx"},
                        {title: "Nombre Cliente", data: "nombre_cliente"},
                        {title: "Fecha Compromiso", data: "fecha_compromiso"},
                        {title: "Fecha Programación", data: "fecha_programacion"},
                        {title: "Id Orden Trabajo Hija", data: "id_orden_trabajo_hija"},
                        {title: "Ot Hija", data: "ot_hija"},
                        {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
//                        {title: "Dias", data: "n_days"},
                    ],
                    ));
        }
    };

    ini.init();
});