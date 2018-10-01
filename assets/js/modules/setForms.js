$(function() {
    setForm = {
        init: function() {
            setForm.events();

        },

        //Eventos de la ventana.
        events: function() {},

        // retorna el formulario deseado de servicio
        returnFormularyService: function(nombre_cliente = '', direccion_destino = '', servicio_val, servicio_nombre = '', arg) {
            let form = "";
            // primera seccion, la dejo true porque no se si hay plantillas que no necesite la primera seccion
            if (true) {
                form += setForm.primeraSeccionServicio(nombre_cliente, servicio_nombre);
            }

            switch (servicio_val) {
                case '1': // internet dedicado empresarial
                    form += setForm.internetDedicadoEmpresarial(direccion_destino);
                    break;
                case '2': // internet dedicado 
                    form += setForm.internetDedicado(direccion_destino);
                    break;
                case '3': // mpls_avanzado_intranet
                    form += setForm.mpls_avanzado_intranet(direccion_destino);
                    break;
                case '4': // mpls_avanzado_intranet_varios_puntos
                    form += setForm.mpls_avanzado_intranet_varios_puntos();
                    break;
                case '5': // MPLS Avanzado Intranet con Backup de Ultima Milla - NDS 2
                    form += setForm.MPLS_Avanzado_Intranet_con_Backup_de_Ultima_Milla_NDS_2(direccion_destino);
                    break;
                case '6': // MPLS Avanzado Intranet con Backup de Ultima Milla y Router - NDS1
                    form += setForm.MPLS_Avanzado_Intranet_con_Backup_de_Ultima_Milla_y_Router_NDS1(direccion_destino);
                    break;
                case '7': // MPLS Avanzado Extranet
                    form += setForm.MPLS_Avanzado_Extranet(direccion_destino);
                    break;
                case '8': // Backend MPLS 
                    form += setForm.Backend_MPLS(direccion_destino);
                    break;
                case '9': // MPLS Avanzado con Componente Datacenter Claro
                    form += setForm.MPLS_Avanzado_con_Componente_Datacenter_Claro(direccion_destino);
                    break;
                case '10': // MPLS Transaccional 3G
                    form += setForm.MPLS_Transaccional_3G(direccion_destino);
                    break;
                    /*plantillas nuevas*/
                case '11': // Adición Marquillas Aeropuerto el Dorado Opain
                    form += setForm.adicion_marquillas_aeropuerto_el_dorado_opain(direccion_destino, arg.otp);
                    break;
                case '12': // Cambio de Equipos Servicio
                    form += setForm.cambio_de_equipos_servicio(direccion_destino, arg.otp);
                    break;
                case '13': // Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
                    form += setForm.cambio_de_servicio_telefonia_fija_publica_linea_basica_a_linea_e1(direccion_destino);
                    break;
                case '14': // Cambio de Servicio Telefonia Fija Pública Linea SIP a PBX Distribuida Linea SIP
                    form += setForm.cambio_de_servicio_telefonia_fija_publica_linea_sip_a_pbx_distribuida_linea_sip(direccion_destino);
                    break;
                case '15': // Traslado Externo Servicio
                    form += setForm.traslado_externo_servicio(direccion_destino);
                    break;
                case '16': // Traslado Interno Servicio
                    form += setForm.traslado_interno_servicio(direccion_destino);
                    break;
                case '17': // SOLUCIONES ADMINISTRATIVAS - COMUNICACIONES UNIFICADAS PBX ADMINISTRADA
                    form += setForm.soluciones_administrativas_comunicaciones_unificadas_pbx_administrada(direccion_destino);
                    break;
                case '18': // Instalación Servicio Telefonia Fija PBX Distribuida Linea E1
                    form += setForm.instalacion_servicio_telefonia_fija_pbx_distribuida_linea_e1(direccion_destino);
                    break;
                case '19': // Instalación Servicio Telefonia Fija PBX Distribuida Linea SIP
                    form += setForm.instalacion_servicio_telefonia_fija_pbx_distribuida_linea_sip(direccion_destino);
                    break;
                case '20': // Instalación Servicio Telefonia Fija PBX Distribuida Linea SIP con Gateway de Voz
                    form += setForm.instalacion_servicio_telefonia_fija_pbx_distribuida_linea_sip_con_gateway_de_voz(direccion_destino);
                    break;
                case '21': // Instalación Telefonía Publica Básica - Internet Dedicado
                    form += setForm.instalacion_telefonia_publica_basica_internet_dedicado(direccion_destino);
                    break;
                case '22': // Cambio de Última Milla
                    form += setForm.cambio_de_ultima_milla(direccion_destino);
                    break;
                case '23': // Cambio de Equipo
                    form += setForm.cambio_de_equipo(direccion_destino);
                    break;

            }

            if (true) {
                form += setForm.ultimaSeccionServicio(servicio_val);
            }

            return form;

        },

        // retorna la primera seccion de los formularios de servicio
        primeraSeccionServicio: function(nombre_cliente, servicio_nombre) {
            // comentariada la seccion de elegir a quien va dirigido
            return `
					<!-- <div class="widget bg_white m-t-25 display-block cliente" id="seccion_correos">
					    <fieldset class="col-md-6 control-label">
					        <span class="div_Text_Form_modal"><strong>Email al que se dirije el correo: &nbsp;</strong></span>
					    </fieldset>
					    <fieldset>
					        <div class="form-group mail_envio">
					            <label for="mail_envio" class="col-md-3 control-label"> </label>
					            <div class="col-md-8 selectContainer div_Form_Modals">
					                <div class="input-group">
					                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					                    <input name="mail_envio" id="mail_envio" class="form-control validar_required" type="text">
					                </div>
					            </div>
					            <span class="btn btn-cami_cool" id="añadir_correo"> Add  <span class="fa fa-plus"></span></span>
					        </div>
					    </fieldset>
					</div>  -->
					<div class="widget bg_white m-t-25 display-block cliente">
					    <fieldset class="col-md-6 control-label">
					        <div class="form-group nombre " >
					            <label for="nombre" class="col-md-3 control-label">Nombre: &nbsp;</label>
					            <div class="col-md-8 selectContainer">
					                <div class="input-group">
					                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					                    <input name="nombre" id="nombre" class="form-control validar_required" type="text">
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
					                    <input name="servicio" id="servicio_val" class="form-control" type="text" value="${servicio_nombre}" readonly>
					                </div>
					            </div>
					        </div>
					        <div class="form-group fecha">
					            <label for="fecha" class="col-md-3 control-label">Fecha Inicio: &nbsp;</label>
					            <div class="col-md-8 selectContainer">
					                <div class="input-group">
					                    <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
					                    <input name="fecha" id="fecha" class="form-control" type="text" value="${fecha_actual}" readonly>
					                </div>
					            </div>
					        </div>
					    </fieldset>
					</div>
            	`;
        },

        // opcion servicio 1
        internetDedicadoEmpresarial: function(direccion_destino) {
            return `<div class="widget bg_white m-t-25 display-block cliente">
					  <fieldset class="col-md-6 control-label">
					    <div class="form-group direccion_instalacion">
					      <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group direccion">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					          <input name="direccion_instalacion" id="direccion_instalacion" class="form-control validar_required" type="text" value="${direccion_destino}" >
					        </div>
					      </div>
					    </div>
					    <div class="form-group ancho_banda">
					      <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					          <input name="ancho_banda" id="ancho_banda" class="form-control validar_required" type="number">
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
					          <input name="interfaz_entrega" id="interfaz_entrega" class="form-control validar_required" type="text">
					        </div>
					      </div>
					    </div>
					    <div class="form-group fecha_servicio">
					      <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
					          <input name="fecha_servicio" id="fecha_servicio" class="form-control validar_required" type="date">
					        </div>
					      </div>
					    </div>
					  </fieldset>
					</div>`;
        },

        // opcion servicio 2
        internetDedicado: function(direccion_destino) {
            return `<div class="widget bg_white m-t-25 display-block cliente">
					  <fieldset class="col-md-6 control-label">
					    <div class="form-group direccion_instalacion">
					      <label for="direccion_instalacion" class="col-md-3 control-label">Direccion De Instalacion: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group direccion">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					          <input name="direccion_instalacion" id="direccion_instalacion" class="form-control validar_required" type="text" value="${direccion_destino}" >
					        </div>
					      </div>
					    </div>
					    <div class="form-group ancho_banda">
					      <label for="ancho_banda" class="col-md-3 control-label">Ancho de Banda: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					          <input name="ancho_banda" id="ancho_banda" class="form-control validar_required" type="number">
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
					          <input name="interfaz_entrega" id="interfaz_entrega" class="form-control validar_required" type="text">
					        </div>
					      </div>
					    </div>
					    <div class="form-group fecha_servicio">
					      <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
					          <input name="fecha_servicio" id="fecha_servicio" class="form-control validar_required" type="date">
					        </div>
					      </div>
					    </div>
					  </fieldset>
					</div>`;
        },

        // opcion servicio 3
        mpls_avanzado_intranet: function(direccion_destino) {
            return `<div class="widget bg_white m-t-25 display-block cliente">
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
					          <input name="direccion_instalacion" id="direccion_instalacion" class="form-control validar_required" type="text" value="${direccion_destino}" >
					        </div>
					      </div>
					    </div>
					    <div class="form-group interfaz_grafica">
					      <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					          <input name="interfaz_entrega" id="interfaz_entrega" class="form-control validar_required validar_required" type="text" >
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
					          <input name="ancho_banda" id="ancho_banda" class="form-control validar_required" type="number" >
					          <span class="input-group-addon">MHz</span>
					        </div>
					      </div>
					    </div>
					    <div class="form-group fecha_servicio">
					      <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
					          <input name="fecha_servicio" id="fecha_servicio" class="form-control validar_required" type="date" >
					        </div>
					      </div>
					    </div>
					  </fieldset>
					</div>`;
        },

        // opcion servicio 4
        mpls_avanzado_intranet_varios_puntos: function() {
            return `<div class="widget bg_white m-t-25 display-block cliente">
					  <fieldset class="col-md-6 control-label">
					    <div class="form-group direccion_instalacion_des">
					      <label for="direccion_instalacion_des1" class="col-md-3 style="margin-top: -21px;" control-label">Direccion De Instalacion (Descripcion 1 del servicio): &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					          <input name="direccion_instalacion_des1" id="direccion_instalacion_des1" class="form-control validar_required" type="text" >
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
					          <input name="equipos_intalar_camp1" id="equipos_intalar_camp1" class="form-control validar_required" type="text">
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
					          <input name="fecha_servicio" id="fecha_servicio" class="form-control validar_required" type="date">
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
					          <input name="ancho_banda" id="ancho_banda" class="form-control validar_required" type="number">
					          <span class="input-group-addon">MHz</span>
					        </div>
					      </div>
					    </div>
					    <div class="form-group interfaz_grafica">
					      <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					          <input name="interfaz_entrega" id="interfaz_entrega" class="form-control validar_required" type="text">
					        </div>
					      </div>
					    </div>
					  </fieldset>
					</div>`;
        },

        // opcion servicio 5
        MPLS_Avanzado_Intranet_con_Backup_de_Ultima_Milla_NDS_2: function(direccion_destino) {
            return `<div class="widget bg_white m-t-25 display-block cliente">
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
					          <input name="direccion_instalacion" id="direccion_instalacion" class="form-control validar_required" type="text" value="${direccion_destino}" >
					        </div>
					      </div>
					    </div>
					    <div class="form-group interfaz_grafica">
					      <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					          <input name="interfaz_entrega" id="interfaz_entrega" class="form-control validar_required" type="text">
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
					          <input name="ancho_banda" id="ancho_banda" class="form-control validar_required" type="number">
					          <span class="input-group-addon">MHz</span>
					        </div>
					      </div>
					    </div>
					    <div class="form-group fecha_servicio">
					      <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
					          <input name="fecha_servicio" id="fecha_servicio" class="form-control validar_required" type="date">
					        </div>
					      </div>
					    </div>
					  </fieldset>
					</div>`;
        },

        // opcion servicio 6
        MPLS_Avanzado_Intranet_con_Backup_de_Ultima_Milla_y_Router_NDS1: function(direccion_destino) {
            return `<div class="widget bg_white m-t-25 display-block cliente">
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
					          <input name="direccion_instalacion" id="direccion_instalacion" class="form-control validar_required" type="text" value="${direccion_destino}" >
					        </div>
					      </div>
					    </div>
					    <div class="form-group interfaz_grafica">
					      <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					          <input name="interfaz_entrega" id="interfaz_entrega" class="form-control validar_required" type="text">
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
					          <input name="ancho_banda" id="ancho_banda" class="form-control validar_required" type="number">
					          <span class="input-group-addon">MHz</span>
					        </div>
					      </div>
					    </div>
					    <div class="form-group fecha_servicio">
					      <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
					          <input name="fecha_servicio" id="fecha_servicio" class="form-control validar_required" type="date">
					        </div>
					      </div>
					    </div>
					  </fieldset>
					</div>`;
        },

        // opcion servicio 7
        MPLS_Avanzado_Extranet: function(direccion_destino) {
            return `<div class="widget bg_white m-t-25 display-block cliente">
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
					          <input name="direccion_instalacion" id="direccion_instalacion" class="form-control validar_required" type="text" value="${direccion_destino}">
					        </div>
					      </div>
					    </div>
					    <div class="form-group interfaz_grafica">
					      <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					          <input name="interfaz_entrega" id="interfaz_entrega" class="form-control validar_required" type="text">
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
					          <input name="ancho_banda" id="ancho_banda" class="form-control validar_required" type="number">
					          <span class="input-group-addon">MHz</span>
					        </div>
					      </div>
					    </div>
					    <div class="form-group fecha_servicio">
					      <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
					          <input name="fecha_servicio" id="fecha_servicio" class="form-control validar_required" type="date">
					        </div>
					      </div>
					    </div>
					  </fieldset>
					</div>`;
        },

        // opcion servicio 8
        Backend_MPLS: function(direccion_destino) {
            return `<div class="widget bg_white m-t-25 display-block cliente">
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
					          <input name="direccion_instalacion" id="direccion_instalacion" class="form-control validar_required" type="text" value="${direccion_destino}">
					        </div>
					      </div>
					    </div>
					    <div class="form-group interfaz_grafica">
					      <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					          <input name="interfaz_entrega" id="interfaz_entrega" class="form-control validar_required" type="text">
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
					          <input name="ancho_banda" id="ancho_banda" class="form-control validar_required" type="number">
					          <span class="input-group-addon">MHz</span>
					        </div>
					      </div>
					    </div>
					    <div class="form-group fecha_servicio">
					      <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
					          <input name="fecha_servicio" id="fecha_servicio" class="form-control validar_required" type="date">
					        </div>
					      </div>
					    </div>
					  </fieldset>
					</div>`;
        },

        // opcion servicio 9
        MPLS_Avanzado_con_Componente_Datacenter_Claro: function(direccion_destino) {
            return `<div class="widget bg_white m-t-25 display-block cliente">
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
					          <input name="direccion_instalacion" id="direccion_instalacion" class="form-control validar_required" type="text" value="${direccion_destino}" >
					        </div>
					      </div>
					    </div>
					    <div class="form-group interfaz_grafica">
					      <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					          <input name="interfaz_entrega" id="interfaz_entrega" class="form-control validar_required" type="text">
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
					          <input name="ancho_banda" id="ancho_banda" class="form-control validar_required" type="number">
					          <span class="input-group-addon">MHz</span>
					        </div>
					      </div>
					    </div>
					    <div class="form-group fecha_servicio">
					      <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
					          <input name="fecha_servicio" id="fecha_servicio" class="form-control validar_required" type="date">
					        </div>
					      </div>
					    </div>
					  </fieldset>
					</div>`;
        },

        // opcion servicio 10
        MPLS_Transaccional_3G: function(direccion_destino) {
            return `<div class="widget bg_white m-t-25 display-block cliente">
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
					          <input name="direccion_instalacion" id="direccion_instalacion" class="form-control validar_required" type="text" value="${direccion_destino}">
					        </div>
					      </div>
					    </div>
					    <div class="form-group interfaz_grafica">
					      <label for="interfaz_entrega" class="col-md-3 control-label">Interfaz de Entrega: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					          <input name="interfaz_entrega" id="interfaz_entrega" class="form-control validar_required" type="text">
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
					          <input name="ancho_banda" id="ancho_banda" class="form-control validar_required" type="number">
					          <span class="input-group-addon">MHz</span>
					        </div>
					      </div>
					    </div>
					    <div class="form-group fecha_servicio">
					      <label for="fecha_servicio" class="col-md-3 control-label">Fecha de Entrega de Servicio: &nbsp;</label>
					      <div class="col-md-8 selectContainer">
					        <div class="input-group">
					          <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
					          <input name="fecha_servicio" id="fecha_servicio" class="form-control validar_required" type="date">
					        </div>
					      </div>
					    </div>
					  </fieldset>
					</div>`;
        },

        // ultima seccion de servicios
        ultimaSeccionServicio: function(num_service) {
            let cadena = '';
             cadena += `<div class="widget bg_white m-t-25 d-inline-b cliente">
					    <fieldset class="col-md-6">
					        <div class="form-group ingeniero1">
					            <label for="proveedor_ultima_milla" class="col-md-3 control-label">Ingeniero 1: &nbsp;</label>
					            <div class="col-md-9 selectContainer">
					                <div class="input-group">
					                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					                    <select name="ingeniero1" id="ingeniero1" class="form-control class_fill_eingenieer validar_required" type="text">
					                        <option value="">Seleccionar</option>
					                    </select>
					                </div>
					            </div>
					        </div>
					        <div class="form-group ingeniero1_tel ">
					            <label for="proveedor_ultima_milla" class="col-md-3 control-label">Telefono: &nbsp;</label>
					            <div class="col-md-9 selectContainer">
					                <div class="input-group">
					                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					                    <input name="ingeniero1_tel" id="ingeniero1_tel" class="form-control class_fill_eingenieer validar_required" type="number">
					                </div>
					            </div>
					        </div>
					        <div class="form-group ingeniero1 ">
					            <label for="proveedor_ultima_milla" class="col-md-3 control-label">Email: &nbsp;</label>
					            <div class="col-md-9 selectContainer">
					                <div class="input-group">
					                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					                    <input name="ingeniero1_email" id="ingeniero1_email" class="form-control class_fill_eingenieer validar_required" type="email">
					                </div>
					            </div>
					        </div>
					    </fieldset>
					    <!--  fin seccion izquierda form---->`;
					if (num_service < 10) {				
					
					   cadena += `
					   <!--  inicio seccion derecha form---->
					    <fieldset class="col-md-6">
					        <div class="form-group ingeniero2 ">
					            <label for="ingeniero2" class="col-md-3 control-label">Ingeniero 2: &nbsp;</label>
					            <div class="col-md-9 selectContainer">
					                <div class="input-group">
					                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					                    <select name="ingeniero2" id="ingeniero2" class="form-control class_fill_eingenieer" type="text" >
					                        <option value="">Seleccionar</option>
					                    </select>
					                </div>
					            </div>
					        </div>


					        <div class="form-group ingeniero2 ">
					            <label for="proveedor_ultima_milla" class="col-md-3 control-label">Telefono: &nbsp;</label>
					            <div class="col-md-9 selectContainer">
					                <div class="input-group">
					                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					                    <input name="ingeniero2_tel" id="ingeniero2_tel" class="form-control class_fill_eingenieer" type="number" >
					                </div>
					            </div>
					        </div>

					        <div class="form-group ingeniero2 ">
					            <label for="proveedor_ultima_milla" class="col-md-3 control-label">Email: &nbsp;</label>
					            <div class="col-md-9 selectContainer">
					                <div class="input-group">
					                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					                    <input name="ingeniero2_email" id="ingeniero2_email" class="form-control class_fill_eingenieer" type="email" >
					                </div>
					            </div>
					        </div>

					        <div class="form-group ingeniero3 ">
					            <label for="proveedor_ultima_milla" class="col-md-3 control-label">Ingeniero 3: &nbsp;</label>
					            <div class="col-md-9 selectContainer">
					                <div class="input-group">
					                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					                    <select name="ingeniero3" id="ingeniero3" class="form-control class_fill_eingenieer" type="text" >
					                        <option value="">Seleccionar</option>
					                    </select>
					                </div>
					            </div>
					        </div>

					        <div class="form-group ingeniero3 ingenieros">
					            <label for="proveedor_ultima_milla" class="col-md-3 control-label">Telefono: &nbsp;</label>
					            <div class="col-md-9 selectContainer">
					                <div class="input-group">
					                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					                    <input name="ingeniero3_tel" id="ingeniero3_tel" class="form-control class_fill_eingenieer" type="number" >
					                </div>
					            </div>
					        </div>

					        <div class="form-group ingeniero3 ingenieros">
					            <label for="proveedor_ultima_milla" class="col-md-3 control-label">Email: &nbsp;</label>
					            <div class="col-md-9 selectContainer">
					                <div class="input-group">
					                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					                    <input name="ingeniero3_email" id="ingeniero3_email" class="form-control class_fill_eingenieer" type="email" >
					                </div>
					            </div>
					        </div>
					    </fieldset>`;
					}
					
					cadena += `</div>`;
					return cadena;
        },

        /*PLANTILLAS DE SERVICIO NUEVAS*/

        // opcion de servicio 11
        adicion_marquillas_aeropuerto_el_dorado_opain: function(direccion_destino, otp) {
            return `<div class="widget bg_white m-t-25 d-inline-b cliente">

				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo4" class="col-md-3 control-label">Marquillas: &nbsp;</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo4" id="campo4" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo5" class="col-md-3 control-label">Local: &nbsp;</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				                        <input type="text" name="campo5" id="campo5"  class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>

				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo6" class="col-md-3 control-label">Internet:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
				                        <input type="text" name="campo6" id="campo6" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo7" class="col-md-3 control-label">BW:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
				                        <input type="text" name="campo7" id="campo7" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo8" class="col-md-3 control-label">Telefonia:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
				                      <input type="number" name="campo8" id="campo8" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo9" class="col-md-3 control-label">#Lineas:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-sound-5-1"></i></span>
				                      <input type="text" name="campo9" id="campo9" class="form-control">
				                  </div>
				              </div>
				          </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo10" class="col-md-3 control-label">#Telefonos:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-sound-5-1"></i></span>
				                      <input type="number" name="campo10" id="campo10" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo11" class="col-md-3 control-label">MPLS:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
				                      <input type="text" name="campo11" id="campo11" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo12" class="col-md-3 control-label">BW2:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
				                        <input type="text" name="campo12" id="campo12" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo13" class="col-md-3 control-label"><a title="Adición de 6 marquillas"> Total Puertos LAN:</a></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-sound-7-1"></i></span>
				                        <input type="text" name="campo13" id="campo13" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo18" class="col-md-3 control-label">otp:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-record"></i></span>
				                      <input type="text" name="campo18" value="${otp}" id="campo18" class="form-control" readonly>
				                  </div>
				              </div>
				          </div>

				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo19" class="col-md-3 control-label">Fecha entrega:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				                      <input type="date" name="campo19" id="campo19" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				      </fieldset>
				    </div>`;
        },
        // opcion de servicio 12
        cambio_de_equipos_servicio: function(direccion_destino, otp) {
            return `
				<div class="widget bg_white m-t-25 d-inline-b cliente">

				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo7" class="col-md-3 control-label">OTP: &nbsp;</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo7" value="${otp}" id="campo7" class="form-control" readonly>
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo10" class="col-md-3 control-label">Fecha Entrega:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				                        <input type="date" name="campo10" id="campo10"  class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>

				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo4" class="col-md-3 control-label">Dirección Sede:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
				                        <input type="text" name="campo4" id="campo4" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT check  *********************-->
				            <label for="campo5" class="col-md-12 control-label">&nbsp; existen otros servicio sobre el cpe: &nbsp;&nbsp;</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo5" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo5">NO</label>
				            </div>
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo6" class="col-md-3 control-label">Cantidad:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
				                      <input type="number" name="campo6" id="campo6" class="form-control">
				                  </div>
				              </div>
				          </div>
				          

				          <!--*********************  INPUT DATE  *********************-->
				          <div class="form-group">
				          	<label for="campo8" class="col-md-3 control-label">Códigos de servicio en el CPE:</label>
				          	<div class="col-md-9 selectContainer">
				          		<div class="input-group">
				          			<span class="input-group-addon"><i class="glyphicon glyphicon-record"></i></span>
				          			<input type="text" name="campo8" id="campo8" class="form-control">
				          		</div>
				          	</div>
				          </div>
				          
				          
				      </fieldset>
				    
				     
				    </div>	
            `;
        },
        // opcion de servicio 13
        cambio_de_servicio_telefonia_fija_publica_linea_basica_a_linea_e1: function(direccion_destino) {
            return `
				<div class="widget bg_white m-t-25 d-inline-b cliente">

				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo4" class="col-md-3 control-label">Dirección Destino: &nbsp;</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo4" id="campo4" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo5" class="col-md-3 control-label">Cant Lineas Basicas: &nbsp;</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				                        <input type="number" name="campo5" id="campo5"  class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>

				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo6" class="col-md-3 control-label">Cant Ciudad:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
				                        <input type="number" name="campo6" id="campo6" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo7" class="col-md-3 control-label">Nombre Ciudades:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
				                        <input type="text" name="campo7" id="campo7" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo8" class="col-md-3 control-label">Cant DID:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
				                      <input type="number" name="campo8" id="campo8" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo9" class="col-md-3 control-label">Inicio al Proceso:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				                      <input type="date" name="campo9" id="campo9" class="form-control">
				                  </div>
				              </div>
				          </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT DATE  *********************-->
				            <div class="form-group">
				            	<label for="campo10" class="col-md-3 control-label">Fecha de Entrega de su servicio:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				            			<input type="date" name="campo10" id="campo10" class="form-control">
				            		</div>
				            	</div>
				            </div>
				            
				      </fieldset>
				    </div>
            `;
        },
        // opcion de servicio 14
        cambio_de_servicio_telefonia_fija_publica_linea_sip_a_pbx_distribuida_linea_sip: function(direccion_destino) {
            return `<div class="widget bg_white m-t-25 d-inline-b cliente">
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo4" class="col-md-3 control-label">Dirección Destino: &nbsp;</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo4" id="campo4" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo5" class="col-md-3 control-label">Cant de DID: &nbsp;</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				                        <input type="number" name="campo5" id="campo5"  class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>

				      <fieldset class="col-md-6">
				            <!--*********************  SELECT  *********************-->
				            <div class="form-group">
				            	<label for="campo6" class="col-md-3 control-label">Ciudad : &nbsp;</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
				            			<select name="campo6[]" id="campo6" class="form-control multiselect_forms"  multiple="multiple">
											<option value="Bogota">Bogota</option>
											<option value="Tunja">Tunja</option>
											<option value="Villavicencio">Villavicencio</option>
											<option value="Facatativá">Facatativá</option>
											<option value="Girardot">Girardot</option>
											<option value="Yopal">Yopal</option>
											<option value="Cali">Cali</option>
											<option value="Buenaventura">Buenaventura</option>
											<option value="Pasto">Pasto</option>
											<option value="Popayán">Popayán</option>
											<option value="Neiva">Neiva</option>
											<option value="Medellín">Medellín</option>
											<option value="Barranquilla">Barranquilla</option>
											<option value="Cartagena">Cartagena</option>
											<option value="Santa_Marta">Santa Marta</option>
											<option value="Montería">Montería</option>
											<option value="Valledupar">Valledupar</option>
											<option value="Sincelejo">Sincelejo</option>
											<option value="Pereira">Pereira</option>
											<option value="Armenia">Armenia</option>
											<option value="Manizales">Manizales</option>
											<option value="Ibagué">Ibagué</option>
											<option value="Cúcuta">Cúcuta</option>
											<option value="Bucaramanga">Bucaramanga</option>
											<option value="Duitama">Duitama</option>
											<option value="Sogamoso">Sogamoso</option>
											<option value="Flandes">Flandes</option>
											<option value="Rivera">Rivera</option>
											<option value="Aipe">Aipe</option>
											<option value="Lebrija">Lebrija</option>
				            			</select>
				            		</div>
				            	</div>
				            </div>
				            
				            <!--*********************  INPUT DATE  *********************-->
				            <div class="form-group">
				            	<label for="campo7" class="col-md-3 control-label">Inicio al Proceso: &nbsp;</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				            			<input type="date" name="campo7" id="campo7" class="form-control">
				            		</div>
				            	</div>
				            </div>
				            
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT DATE  *********************-->
				            <div class="form-group">
				            	<label for="campo11" class="col-md-3 control-label">Fecha de Entrega de su servicio:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				            			<input type="date" name="campo11" id="campo11" class="form-control">
				            		</div>
				            	</div>
				            </div>


				      </fieldset>
				 
				    </div>
			`;
        },
        // opcion de servicio 15
        traslado_externo_servicio: function(direccion_destino) {
            return `
				<div class="widget bg_white m-t-25 d-inline-b cliente">
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo4" class="col-md-3 control-label">Dirección Sede Antigua:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				                        <input type="text" name="campo4" id="campo4"  class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>

				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				            	<label for="campo5" class="col-md-3 control-label">Dirección Sede Nueva:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				            			<input type="text" name="campo5" id="campo5" class="form-control">
				            		</div>
				            	</div>
				            </div>
				            
				                      
				           <label for="campo6" class="col-md-8 control-label">Existen otros Servicios a Trasladar:</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo6" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo6">NO</label>
				            </div>
				            
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo7" class="col-md-3 control-label">Cantidad:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
				                      <input type="number" name="campo7" id="campo7" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo9" class="col-md-3 control-label">Códigos Servicios a Trasladar:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-sound-5-1"></i></span>
				                      <input type="text" name="campo9" id="campo9" class="form-control">
				                  </div>
				              </div>
				          </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT DATE  *********************-->
				          <div class="form-group">
				          	<label for="campo8" class="col-md-3 control-label">Inicio al proceso: &nbsp;</label>
				          	<div class="col-md-9 selectContainer">
				          		<div class="input-group">
				          			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				          			<input type="date" name="campo8" id="campo8" class="form-control">
				          		</div>
				          	</div>
				          </div>
				         
				      </fieldset>
				     
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT DATE  *********************-->
				            <div class="form-group">
				            	<label for="campo10" class="col-md-3 control-label">Fecha de Entrega del Traslado:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				            			<input type="date" name="campo10" id="campo10" class="form-control">
				            		</div>
				            	</div>
				            </div>
				        </fieldset>
				    </div>
            `;
        },
        // opcion de servicio 16
        traslado_interno_servicio: function(direccion_destino) {
            return `
				<div class="widget bg_white m-t-25 d-inline-b cliente">
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo4" class="col-md-3 control-label">Dirección Sede:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo4" id="campo4" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <label for="campo5" class="col-md-12 control-label">Existen otros Servicios a Trasladar:</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo5">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo5" checked>NO</label>
				            </div>
				            <hr>
				            
				      </fieldset>

				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				            	<label for="campo6" class="col-md-3 control-label">Cantidad de otros servicios a Trasladar:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				            			<input type="number" name="campo6" id="campo6" class="form-control">
				            		</div>
				            	</div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				            	<label for="campo7" class="col-md-3 control-label">Codigos de servicio a Trasladar:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				            			<input type="text" name="campo7" id="campo7" class="form-control">
				            		</div>
				            	</div>
				            </div>
				                   
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo8" class="col-md-3 control-label">Traslado de Servicio:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
				                      <input type="text" name="campo8" id="campo8" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				           <label for="campo9" class="col-md-12 control-label">Movimiento Equipos - Caja OB - Fibra > 3 Mts:</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo9" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo9">NO</label>
				            </div>
				      </fieldset><hr>
				      <fieldset class="col-md-6">
					        <label for="campo10" class="col-md-12 control-label">Movimiento Equipos - Caja OB - Fibra < 3 Mts:</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo10" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo10">NO</label>
				            </div><hr>
				          
				          	<label for="campo11" class="col-md-12 control-label">Movimiento solo de Equipos:</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo11" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo11">NO</label>
				            </div>
				          <hr>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <label for="campo12" class="col-md-12 control-label">Movimiento solo de Caja OB – Fibra:</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo12" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo12">NO</label>
				            </div>
				            <hr>
				            <label for="campo13" class="col-md-12 control-label">Movimiento Rack:</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo13" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo13">NO</label>
				            </div>
				            <hr>
				      </fieldset>
				      <fieldset class="col-md-6">
				          	<label for="campo14" class="col-md-12 control-label">Movimiento ODF:</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo14" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo14">NO</label>
				            </div>
				          <hr>
					        <label for="campo15" class="col-md-12 control-label">Determinación en Visita de Obra Civil:</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo15" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo15">NO</label>
				            </div>
				          <hr>
				      </fieldset>
				     
				        <fieldset class="col-md-6">
				            <!--*********************  INPUT DATE  *********************-->
				            <div class="form-group">
				            	<label for="campo17" class="col-md-3 control-label">Fecha entraga traslado:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				            			<input type="date" name="campo17" id="campo17" class="form-control">
				            		</div>
				            	</div>
				            </div>
				        </fieldset>
				    </div>
            `;
        },
        // opcion de servicio 17
        soluciones_administrativas_comunicaciones_unificadas_pbx_administrada: function(direccion_destino) {
            return `
				<div class="widget bg_white m-t-25 d-inline-b cliente">
				    <fieldset class="col-md-6">
						<!--*********************  INPUT TEXT  *********************-->
			            <div class="form-group">
			                <label for="campo4" class="col-md-3 control-label">Dirección Destino:</label>
			                <div class="col-md-9 selectContainer">
			                    <div class="input-group">
			                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
			                        <input type="text" name="campo4" id="campo4" class="form-control">
			                    </div>
			                </div>
			            </div>

				    </fieldset>
				    <fieldset class="col-md-6">
				    	<legend class="f-s-15">Telefonia Fija Claro</legend>
				    	<!--*********************  INPUT TEXT  *********************-->
				    	<div class="form-group">
				    		<label for="campo5" class="col-md-3 control-label">Existente</label>
				    		<div class="col-md-9 selectContainer">
				    			<div class="input-group">
				    				<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
				    				<input type="number" name="campo5" id="campo5" class="form-control" placeholder="Existenete">
				    			</div>
				    		</div>
				    	</div>

				    	<!--*********************  INPUT TEXT  *********************-->
				    	<div class="form-group">
				    		<label for="campo6" class="col-md-3 control-label">A Implementar</label>
				    		<div class="col-md-9 selectContainer">
				    			<div class="input-group">
				    				<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
				    				<input type="text" name="campo6" id="campo6" class="form-control" placeholder="A Implementar">
				    			</div>
				    		</div>
				    	</div>
				    </fieldset>
				</div>
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<legend class="f-s-15">Tipo de Telefonia Fija Claro</legend>
					<fieldset class="col-md-6">
						<legend class="f-s-15">SIP</legend>
						<!--*********************  INPUT TEXT  *********************-->
						<div class="form-group">
							<label for="campo7" class="col-md-3 control-label">DID:</label>
							<div class="col-md-9 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
									<input type="text" name="campo7" id="campo7" class="form-control" placeholder="DID">
								</div>
							</div>
						</div>
						<!--*********************  INPUT TEXT  *********************-->
						<div class="form-group">
							<label for="campo8" class="col-md-3 control-label">Canales:</label>
							<div class="col-md-9 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
									<input type="text" name="campo8" id="campo8" class="form-control" placeholder="Canales">
								</div>
							</div>
						</div>
					</fieldset>
					<fieldset class="col-md-6">
						<legend class="f-s-15">E1</legend>
						<!--*********************  INPUT TEXT  *********************-->
						<div class="form-group">
							<label for="campo9" class="col-md-3 control-label">DID:</label>
							<div class="col-md-9 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
									<input type="text" name="campo9" id="campo9" class="form-control" placeholder="DID">
								</div>
							</div>
						</div>
						<!--*********************  INPUT TEXT  *********************-->
						<div class="form-group">
							<label for="campo10" class="col-md-3 control-label">E1:</label>
							<div class="col-md-9 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
									<input type="text" name="campo10" id="campo10" class="form-control" placeholder="E1">
								</div>
							</div>
						</div>
					</fieldset>
					<legend class="f-s-15">Buzones de voz</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<label for="campo11" class="col-md-3 control-label">Buzones de boz:</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo11">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo11" checked>NO</label>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo12" class="col-md-3 control-label">Cantidad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="number" name="campo12" id="campo12" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<legend class="f-s-15">Hardphones</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<label for="campo13" class="col-md-3 control-label">Hardphones: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo13">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo13" checked>NO</label>
				            </div>
				            <hr>
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo14" class="col-md-3 control-label">Cantidad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="number" name="campo14" id="campo14" class="form-control">
									</div>
								</div>
							</div>
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo15" class="col-md-3 control-label">Tipo:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo15" id="campo15" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<legend class="f-s-15">Softphones</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<label for="campo16" class="col-md-3 control-label">Softphones: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo16">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo16" checked>NO</label>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo17" class="col-md-3 control-label">Cantidad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="number" name="campo17" id="campo17" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo18" class="col-md-3 control-label">PC:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo18" id="campo18" class="form-control">
									</div>
								</div>
							</div>
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo19" class="col-md-3 control-label">Celular:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo19" id="campo19" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<legend class="f-s-15">Diademas</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<label for="campo20" class="col-md-3 control-label">Diademas :</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo20">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo20" checked>NO</label>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo21" class="col-md-3 control-label">Cantidad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="number" name="campo21" id="campo21" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<legend class="f-s-15">Arañas de Conferencia</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<label for="campo22" class="col-md-3 control-label">Arañas de Conferencia:</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo22">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo22" checked>NO</label>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo36" class="col-md-3 control-label">Cantidad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="number" name="campo36" id="campo36" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<legend class="f-s-15">botoneras</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<label for="campo23" class="col-md-6 control-label">botoneras:</label>
				            <div class="radio col-md-3">
				              <label><input type="radio" value="SI" name="campo23">SI</label>
				            </div>
				            <div class="radio col-md-3">
				              <label><input type="radio" value="NO" name="campo23" checked>NO</label>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo24" class="col-md-3 control-label">Cantidad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="number" name="campo24" id="campo24" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-12">
							<label for="campo25" class="col-md-6 control-label">Incluye Grabación de Voz:</label>
				            <div class="radio col-md-3">
				              <label><input type="radio" value="SI" name="campo25">SI</label>
				            </div>
				            <div class="radio col-md-3">
				              <label><input type="radio" value="NO" name="campo25" checked>NO</label>
				            </div>
						</fieldset>
					</div>

					<legend class="f-s-15">Incluye LAN Administrada</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<label for="campo26" class="col-md-6 control-label">Incluye LAN Administrada: </label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo26">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo26" checked>NO</label>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo27" class="col-md-3 control-label">Cantidad SW:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="number" name="campo27" id="campo27" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo28" class="col-md-3 control-label">Puertos SW:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo28" id="campo28" class="form-control">
									</div>
								</div>
							</div>
							<label for="campo29" class="col-md-3 control-label">PoE: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo29">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo29" checked>NO</label>
				            </div>
						</fieldset>
					</div>

					<legend class="f-s-15">Telefonos Inalambricos</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<label for="campo30" class="col-md-3 control-label">Telefonos Inalambricos:</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo30">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo30" checked>NO</label>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo31" class="col-md-3 control-label">Cantidad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="number" name="campo31" id="campo31" class="form-control">
									</div>
								</div>
							</div>

							<label for="campo32" class="col-md-3 control-label">AP Claro:</label>
				            <div class="radio">
				              <label><input type="radio" value="SI" name="campo32">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="NO" name="campo32" checked>NO</label>
				            </div>
						</fieldset>
					</div>

					<legend class="f-s-15">Tipo de Conectividad</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo33" class="col-md-3 control-label">Existente:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo33" id="campo33" class="form-control">
									</div>
								</div>
							</div>

							<label for="campo32" class="col-md-3 control-label">Tipo Conectividad:</label>
				            <div class="radio">
				              <label><input type="radio" value="MPLS" name="campo35">MPLS</label>
				            </div>
				            <div class="radio">
				              <label><input type="radio" value="Internet" name="campo35" checked>Internet</label>
				            </div>
							
							
						</fieldset>
						<fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo34" class="col-md-3 control-label">A Implementar:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo34" id="campo34" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT DATE  *********************-->
							<div class="form-group">
								<label for="campo41" class="col-md-3 control-label">Feche entrega Servicio: &nbsp;</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="date" name="campo41" id="campo41" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
				
            `;
        },
        // opcion de servicio 18
        instalacion_servicio_telefonia_fija_pbx_distribuida_linea_e1: function(direccion_destino) {
            return `
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo4" class="col-md-3 control-label">Dirección Destino:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo4" id="campo4" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo5" class="col-md-3 control-label">Cant DID por Ciudad:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="number" name="campo5" id="campo5" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  SELECT  *********************-->
				            <div class="form-group">
				            	<label for="campo6" class="col-md-3 control-label">Ciudad : &nbsp;</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
				            			<select name="campo6[]" id="campo6" class="form-control multiselect_forms"  multiple="multiple">
											<option value="Bogota">Bogota</option>
											<option value="Yopal">Yopal</option>
											<option value="Neiva">Neiva</option>
											<option value="Montería">Montería</option>
											<option value="Manizales">Manizales</option>
											<option value="Sogamoso">Sogamoso</option>
											<option value="Tunja">Tunja</option>
											<option value="Cali">Cali</option>
											<option value="Medellín">Medellín</option>
											<option value="Valledupar">Valledupar</option>
											<option value="Ibagué">Ibagué</option>
											<option value="Flandes">Flandes</option>
											<option value="Villavicencio">Villavicencio</option>
											<option value="Buenaventura">Buenaventura</option>
											<option value="Barranquilla">Barranquilla</option>
											<option value="Sincelejo">Sincelejo</option>
											<option value="Cúcuta">Cúcuta</option>
											<option value="Rivera">Rivera</option>
											<option value="Facatativá">Facatativá</option>
											<option value="Pasto">Pasto</option>
											<option value="Cartagena">Cartagena</option>
											<option value="Pereira">Pereira</option>
											<option value="Bucaramanga">Bucaramanga</option>
											<option value="Aipe">Aipe</option>
											<option value="Girardot">Girardot</option>
											<option value="Popayán">Popayán</option>
											<option value="Santa_Marta">Santa Marta</option>
											<option value="Armenia">Armenia</option>
											<option value="Duitama">Duitama</option>
											<option value="Lebrija">Lebrija</option>
				            			</select>
				            		</div>
				            	</div>
				            </div>

				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo8" class="col-md-3 control-label">Fecha Entrega servicio:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="date" name="campo8" id="campo8" class="form-control">
				                    </div>
				                </div>
				            </div>
				           
						</fieldset>
					</div>

		
				</div>
            `;
        },
        // opcion de servicio 19
        instalacion_servicio_telefonia_fija_pbx_distribuida_linea_sip: function(direccion_destino) {
            return `
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo4" class="col-md-3 control-label">Dirección Destino:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo4" id="campo4" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo5" class="col-md-3 control-label">Cant DID por Ciudad:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="number" name="campo5" id="campo5" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  SELECT  *********************-->
				            <div class="form-group">
				            	<label for="campo6" class="col-md-3 control-label">Ciudad : &nbsp;</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
				            			<select name="campo6[]" id="campo6" class="form-control multiselect_forms"  multiple="multiple">
											<option value="Bogota">Bogota</option>
											<option value="Yopal">Yopal</option>
											<option value="Neiva">Neiva</option>
											<option value="Montería">Montería</option>
											<option value="Manizales">Manizales</option>
											<option value="Sogamoso">Sogamoso</option>
											<option value="Tunja">Tunja</option>
											<option value="Cali">Cali</option>
											<option value="Medellín">Medellín</option>
											<option value="Valledupar">Valledupar</option>
											<option value="Ibagué">Ibagué</option>
											<option value="Flandes">Flandes</option>
											<option value="Villavicencio">Villavicencio</option>
											<option value="Buenaventura">Buenaventura</option>
											<option value="Barranquilla">Barranquilla</option>
											<option value="Sincelejo">Sincelejo</option>
											<option value="Cúcuta">Cúcuta</option>
											<option value="Rivera">Rivera</option>
											<option value="Facatativá">Facatativá</option>
											<option value="Pasto">Pasto</option>
											<option value="Cartagena">Cartagena</option>
											<option value="Pereira">Pereira</option>
											<option value="Bucaramanga">Bucaramanga</option>
											<option value="Aipe">Aipe</option>
											<option value="Girardot">Girardot</option>
											<option value="Popayán">Popayán</option>
											<option value="Santa_Marta">Santa Marta</option>
											<option value="Armenia">Armenia</option>
											<option value="Duitama">Duitama</option>
											<option value="Lebrija">Lebrija</option>
				            			</select>
				            		</div>
				            	</div>
				            </div>

				            <div class="form-group">
				                <label for="campo8" class="col-md-3 control-label">Fecha Entrega servicio:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="date" name="campo8" id="campo8" class="form-control">
				                    </div>
				                </div>
				            </div>
				           
						</fieldset>
					</div>
				</div>
            `;
        },
        // opcion de servicio 20
        instalacion_servicio_telefonia_fija_pbx_distribuida_linea_sip_con_gateway_de_voz: function(direccion_destino) {
            return `
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo4" class="col-md-3 control-label">Dirección Destino:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo4" id="campo4" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo5" class="col-md-3 control-label">Cant DID por Ciudad:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="number" name="campo5" id="campo5" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  SELECT  *********************-->
				            <div class="form-group">
				            	<label for="campo6" class="col-md-3 control-label">Ciudad : &nbsp;</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
				            			<select name="campo6[]" id="campo6" class="form-control multiselect_forms"  multiple="multiple">
											<option value="Bogota">Bogota</option>
											<option value="Yopal">Yopal</option>
											<option value="Neiva">Neiva</option>
											<option value="Montería">Montería</option>
											<option value="Manizales">Manizales</option>
											<option value="Sogamoso">Sogamoso</option>
											<option value="Tunja">Tunja</option>
											<option value="Cali">Cali</option>
											<option value="Medellín">Medellín</option>
											<option value="Valledupar">Valledupar</option>
											<option value="Ibagué">Ibagué</option>
											<option value="Flandes">Flandes</option>
											<option value="Villavicencio">Villavicencio</option>
											<option value="Buenaventura">Buenaventura</option>
											<option value="Barranquilla">Barranquilla</option>
											<option value="Sincelejo">Sincelejo</option>
											<option value="Cúcuta">Cúcuta</option>
											<option value="Rivera">Rivera</option>
											<option value="Facatativá">Facatativá</option>
											<option value="Pasto">Pasto</option>
											<option value="Cartagena">Cartagena</option>
											<option value="Pereira">Pereira</option>
											<option value="Bucaramanga">Bucaramanga</option>
											<option value="Aipe">Aipe</option>
											<option value="Girardot">Girardot</option>
											<option value="Popayán">Popayán</option>
											<option value="Santa_Marta">Santa Marta</option>
											<option value="Armenia">Armenia</option>
											<option value="Duitama">Duitama</option>
											<option value="Lebrija">Lebrija</option>
				            			</select>
				            		</div>
				            	</div>
				            </div>
				             <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo23" class="col-md-3 control-label">Fecha Entrega servicio:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="date" name="campo23" id="campo23" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
						</fieldset>
					</div>
				</div>
            `;
        },
        // opcion de servicio 21
        instalacion_telefonia_publica_basica_internet_dedicado: function(direccion_destino) {
            return `<div class="widget bg_white m-t-25 d-inline-b cliente">
					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo3" class="col-md-3 control-label">Dirección Destino:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo3" id="campo3" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo4" class="col-md-3 control-label">Cant Lineas Basicas:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="number" name="campo4" id="campo4" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo5" class="col-md-3 control-label">OTP Internet Dedicado:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo5" id="campo5" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo6" class="col-md-3 control-label">OTP Telefonia:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="number" name="campo6" id="campo6" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo7" class="col-md-3 control-label">Ancho de Banda:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="number" name="campo7" id="campo7" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo8" class="col-md-3 control-label">Interfaz de Entrega:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo8" id="campo8" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo9" class="col-md-3 control-label">Interfaz de Entrega:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo9" id="campo9" class="form-control">
				                    </div>
				                </div>
				            </div>

				            <!--*********************  INPUT DATE  *********************-->
							<div class="form-group">
								<label for="campo11" class="col-md-3 control-label">Fecha entrega servicio: &nbsp;</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="date" name="campo11" id="campo11" class="form-control">
									</div>
								</div>
							</div>
				           
						</fieldset>
					</div>
				</div>
			`;
        },
        // opcion de servicio 22
        cambio_de_ultima_milla: function(direccion_destino) {
            return `
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo4" class="col-md-3 control-label">Dirección Sede:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo4" id="campo4" class="form-control">
									</div>
								</div>
							</div>
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo5" class="col-md-3 control-label">BW Actual:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="text" name="campo5" id="campo5" class="form-control">
									</div>
								</div>
							</div>							
						</fieldset>

						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo6" class="col-md-3 control-label">BW Nuevo:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo6" id="campo6" class="form-control">
									</div>
								</div>
							</div>

							<label for="campo7" class="col-md-6 control-label">Requiere Cambio de equipo:</label>
				            <div class="radio col-md-6">
				              <label><input type="radio" value="SI" name="campo7" checked>SI</label>
				            </div>
				            <div class="radio col-md-6">
				              <label><input type="radio" value="NO" name="campo7">NO</label>
				            </div>							
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<label for="campo8" class="col-md-6 control-label">Requiere Cambio de Última Milla:</label>
				            <div class="radio col-md-6">
				              <label><input type="radio" value="SI" name="campo8" checked>SI</label>
				            </div>
				            <div class="radio col-md-6">
				              <label><input type="radio" value="NO" name="campo8">NO</label>
				            </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- radio button -->
							<label for="campo9" class="col-md-6 control-label">Existen otros Servicios a Modificar:</label>
				            <div class="radio col-md-6">
				              <label><input type="radio" value="SI" name="campo9" checked>SI</label>
				            </div>
				            <div class="radio col-md-6">
				              <label><input type="radio" value="NO" name="campo9">NO</label>
				            </div>
						</fieldset>
					</div>

				</div>
				<!-- seccion que puede aumentar -->
				<div class="widget bg_white m-t-25 d-inline-b cliente" id="append_aca">
					<legend class="f-s-15">SERVICIOS A MODIFICAR: <span class="btn btn-success f-r" id="añadir_seccion"> Add  <i class="fa fa-plus"></i></span></legend>
					<div class="d-inline-b" id="seccion_duplidar">
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo10" class="col-md-3 control-label">OTP:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="number" name="campo10[]" id="campo10" class="form-control" required>
									</div>
								</div>
							</div>
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo11" class="col-md-3 control-label">ID Servicio:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="number" name="campo11[]" id="campo11" class="form-control">
									</div>
								</div>
							</div>
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo12" class="col-md-3 control-label">Dirección Sede:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="text" name="campo12[]" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  SELECT  *********************-->
							<div class="form-group">
								<label for="campo13[]" class="col-md-3 control-label">Requiere Cambio de equipos:</label>
								<div class="col-md-8 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<select name="campo13[]" class="form-control" required>
											<option value="SI">SI</option>
											<option value="NO">NO</option>
										</select>
									</div>
								</div>
							</div>
				            <!--*********************  SELECT  *********************-->
							<div class="form-group">
								<label for="campo14[]" class="col-md-3 control-label">Requiere Cambio de UM:</label>
								<div class="col-md-8 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<select name="campo14[]" class="form-control" required>
											<option value="SI">SI</option>
											<option value="NO">NO</option>
										</select>
									</div>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
				
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							
							<!--*********************  INPUT DATE  *********************-->
							<div class="form-group">
								<label for="campo16" class="col-md-3 control-label">Fecha Entrega Ampliación: &nbsp;</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="date" name="campo16" id="campo16" required class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
            `;
        },
        // opcion de servicio 23
        cambio_de_equipo: function(direccion_destino) {
            return `
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo4" class="col-md-3 control-label">Dirección Sede:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo4" id="campo4" class="form-control">
									</div>
								</div>
							</div>
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo5" class="col-md-3 control-label">BW Actual:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="text" name="campo5" id="campo5" class="form-control">
									</div>
								</div>
							</div>							
						</fieldset>

						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo6" class="col-md-3 control-label">BW Nuevo:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo6" id="campo6" class="form-control">
									</div>
								</div>
							</div>

							<label for="campo7" class="col-md-6 control-label">Requiere Cambio de equipo:</label>
				            <div class="radio col-md-6">
				              <label><input type="radio" value="SI" name="campo7" checked>SI</label>
				            </div>
				            <div class="radio col-md-6">
				              <label><input type="radio" value="NO" name="campo7">NO</label>
				            </div>							
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-12">
							<!-- radio button -->
							<label for="campo8" class="col-md-6 control-label">Existen otros Servicios a Modificar:</label>
				            <div class="radio col-md-6">
				              <label><input type="radio" value="SI" name="campo8" checked>SI</label>
				            </div>
				            <div class="radio col-md-6">
				              <label><input type="radio" value="NO" name="campo8">NO</label>
				            </div>
						</fieldset>
					</div>

				</div>
				<!-- seccion que puede aumentar -->
				<div class="widget bg_white m-t-25 d-inline-b cliente" id="append_aca">
					<legend class="f-s-15">SERVICIOS A MODIFICAR: <span class="btn btn-success f-r" id="añadir_seccion"> Add  <i class="fa fa-plus"></i></span></legend>
					<div class="d-inline-b" id="seccion_duplidar">
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo9" class="col-md-3 control-label">OTP:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="number" name="campo9[]" id="campo9" class="form-control">
									</div>
								</div>
							</div>
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo10" class="col-md-3 control-label">ID Servicio:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="text" name="campo10[]" id="campo10" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo11" class="col-md-3 control-label">Dirección Sede:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="text" name="campo11[]" id="campo11" class="form-control">
									</div>
								</div>
							</div>
							<!--*********************  SELECT  *********************-->
							<div class="form-group">
								<label for="campo12[]" class="col-md-3 control-label">Requiere Cambio de equipos:</label>
								<div class="col-md-8 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<select name="campo12[]" class="form-control" required>
											<option value="SI">SI</option>
											<option value="NO">NO</option>
										</select>
									</div>
								</div>
							</div>

						</fieldset>
				
						<fieldset class="col-md-6">
							<!--*********************  INPUT DATE  *********************-->
							<div class="form-group">
								<label for="campo14" class="col-md-3 control-label">Fecha Entrega Ampliación: &nbsp;</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="date" name="campo14" id="campo14" required class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
            `;
        },

        /*FIN FORMULARIOS DE SERVICIO*/
        /*****************************************INICIO FORMULARIOS DE PRODUCTO*****************************************/

        // Retorna el formulario de producto segun el servicio seleccionado
        returnFormularyProduct: function(num_servicio, arg = []) {
            let form = "";
            switch (num_servicio) {
                /*formulario Internet*/
                case '1': // internet dedicado empresarial
                case '2': // internet dedicado 
                    form += setForm.formProduct_internet(arg.otp);
                    break;
                    /*formulario MPLS*/
                case '3': // mpls_avanzado_intranet
                case '4': // mpls_avanzado_intranet_varios_puntos
                case '5': // MPLS Avanzado Intranet con Backup de Ultima Milla - NDS 2
                case '6': // MPLS Avanzado Intranet con Backup de Ultima Milla y Router - NDS1
                case '7': // MPLS Avanzado Extranet
                case '8': // Backend MPLS 
                case '9': // MPLS Avanzado con Componente Datacenter Claro
                case '10': // MPLS Transaccional 3G
                    form += setForm.formProduct_mpls(arg.otp);
                    break;
                    /*FORMULARIO NOVEDADES*/
                case '12': // Cambio de Equipos Servicio
                case '13': // Cambio de Servicio Telefonia Fija Pública Linea Basica a Linea E1
                case '14': // Cambio de Servicio Telefonia Fija Pública Linea SIP a PBX Distribuida Linea SIP
                case '22': // Cambio de Última Milla
                case '23': // Cambio de Equipo
                    form += setForm.formProduct_novedades();
                    break;
                    /*TRASLADO_EXTERNO*/
                case '15': // Traslado Externo Servicio
                    form += setForm.formProduct_traslado_externo(arg.otp);
                    break;
                    /*TRASLADO_INTERNO*/
                case '16': // Traslado Interno Servicio
                    form += setForm.formProduct_traslado_interno();
                    break;
                    /*PVX_ADMINISTRADA*/
                case '17': // SOLUCIONES ADMINISTRATIVAS - COMUNICACIONES UNIFICADAS PBX ADMINISTRADA
                    form += setForm.formProduct_pvx_administrada(arg.otp);
                    break;
                    /*TELEFONIA FIJA*/
                case '18': // Instalación Servicio Telefonia Fija PBX Distribuida Linea E1
                case '19': // Instalación Servicio Telefonia Fija PBX Distribuida Linea SIP
                case '20': // Instalación Servicio Telefonia Fija PBX Distribuida Linea SIP con Gateway de Voz
                case '21': // Instalación Telefonía Publica Básica - Internet Dedicado
                    form += setForm.formProduct_telefonia_fija(arg.otp);
                    break;

                    /*NN HERFANITO*/
                case '11': // Adición Marquillas Aeropuerto el Dorado Opain

                    break;
            }
            return form;
        },

        /*INTERNET*/
        formProduct_internet: function(otp) { 
            return `
				<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario Cierre de Kickoff  <small>SERVICIO DE INTERNET</small></h2>
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<legend class="f-s-15">Datos basicos de instalación</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- CIUDAD -->
							<div class="form-group">
						        <label for="pr_ciudad" class="col-md-3 control-label">Ciudad:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ciudad" id="pr_ciudad" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						    <!-- DIRECCIÓN: Especificar barrio, piso u oficina -->
						    <div class="form-group">
						        <label for="pr_direccion" class="col-md-3 control-label">Dirección:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_direccion" id="pr_direccion" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>						
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- TIPO PREDIO: -->
						     <div class="form-group">
						        <label for="pr_tipo_predio" class="col-md-3 control-label">Tipo predio:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
						                <select class="form-control" id="pr_tipo_predio" name="pr_tipo_predio">
										    <option value="">Seleccionar...</option>
										    <option value="Edificio">Edificio</option>
											<option value="Casa">Casa</option>
										    
										</select>
						            </div>
						        </div>
						    </div>	
						    <!-- NIT del cliente: -->
						    <div class="form-group">
						        <label for="pr_nit_cliente" class="col-md-3 control-label">NIT cliente:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
						                <input name="pr_nit_cliente" id="pr_nit_cliente" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
						    <!-- ALIAS DEL LUGAR (CODIGO DE SERVICIO//CIUDAD//SERVICIO//COMERCIO O SEDE DEL CLIENTE) -->
						    <div class="form-group">
						        <label for="pr_alias_lugar" class="col-md-3 control-label">Alias del lugar:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
						                <input name="pr_alias_lugar" id="pr_alias_lugar" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						    <!-- OTP -->
							<div class="form-group">
						        <label for="pr_id_ot_padre" class="col-md-3 control-label">OTP:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_id_ot_padre" id="pr_id_ot_padre" value="${otp}" class="form-control" type="text" readonly>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						     <!-- otp_asociadas -->
							<div class="form-group">
						        <label for="pr_otp_asociada" class="col-md-3 control-label">OTP asociadas:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_otp_asociada" id="pr_otp_asociada" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						    <!-- TIPO INTERNET: -->
						     <div class="form-group">
						        <label for="pr_tipo_internet" class="col-md-3 control-label">Tipo internet:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_tipo_internet" name="pr_tipo_internet">
										    <option value="">Seleccionar...</option>
										    <option>INTERNET DEDICADO (Solución Diferenciación de tráfico (Internet / NAP))</option>
												<option>INTERNET DEDICADO (VLR AGRE -Monitoreo CPE (Gestion Proactiva))</option>
												<option>INTERNET DEDICADO ADMINISTRADO (VLR AGRE -Monitoreo CPE (Gestion Proactiva))</option>
												<option>INTERNET EMPRESARIAL</option>
												<option>INTERNET BANDA ANCHA (Solución FO)</option> 									    
										</select>
						            </div>
						        </div>
						    </div>	
							
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
						    <!-- ancho_banda -->
							<div class="form-group">
						        <label for="pr_ancho_banda" class="col-md-3 control-label">Ancho de banda:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ancho_banda" id="pr_ancho_banda" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>		

						    <!-- TIPO INSTALACION: -->
						     <div class="form-group">
						        <label for="pr_tipo_instalacion" class="col-md-3 control-label">Tipo instalación:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_tipo_instalacion" name="pr_tipo_instalacion">
										    <option value="">Seleccionar...</option>
										    <option value="Instalar UM con PE">Instalar UM con PE</option>
											<option value="Instalar UM con PE sobre OTP de Pymes">Instalar UM con PE sobre OTP de Pymes</option>
											<option value="Instalar UM con CT (No aplica para Internet Dedicado Empresarial)">Instalar UM con CT (No aplica para Internet Dedicado Empresarial)</option>
											<option value="Instalar UM en Datacenter Claro- Implementación">Instalar UM en Datacenter Claro- Implementación</option>
											<option value="UM existente. Requiere Cambio de equipo">UM existente. Requiere Cambio de equipo</option> 	
											<option value="UM existente. Requiere Adición de equipo">UM existente. Requiere Adición de equipo</option> 		
											<option value="UM existente. Solo configuración">UM existente. Solo configuración</option> 									    
										</select>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- ID SERVICIO ACTUAL (Aplica para UM Existente) -->
							<div class="form-group">
						        <label for="pr_servicio_actual" class="col-md-3 control-label">ID servicio Actual:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_servicio_actual" id="pr_servicio_actual" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
					</div>
					
					<legend class="f-s-15">Información Última Milla</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
						     <div class="form-group">
						        <label for="pr_requiere_um" class="col-md-3 control-label">Requiere instalación UM:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_requiere_um" name="pr_requiere_um">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
											<option value="No">No</option>   												
											<option value="Existente">Existente</option> 	    
										</select>
						            </div>
						        </div>
						    </div>
							
						     <!-- PROVEEDOR: -->
						     <div class="form-group">
						        <label for="pr_proveedor" class="col-md-3 control-label">Proveedor:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_proveedor" name="pr_proveedor">
										    <option value="">Seleccionar...</option>
										    <option value="No aplica">No aplica</option>
											<option value="Existente">Existente</option>
											<option value="Claro">Claro</option>
											<option value="Axesat">Axesat</option>
											<option value="Comcel">Comcel</option> 	
											<option value="Tigo">Tigo</option> 		
											<option value="Media Commerce">Media Commerce</option> 		
											<option value="Diveo">Diveo</option>
											<option value="Edatel">Edatel</option> 	
											<option value="UNE">UNE</option> 		
											<option value="ETB">ETB</option> 	
											<option value="IBM">IBM</option> 		
											<option value="IFX">IFX</option> 		
											<option value="Level 3 Colombia">Level 3 Colombia</option>
											<option value="Mercanet">Mercanet</option> 	
											<option value="Metrotel">Metrotel</option> 		
											<option value="Promitel">Promitel</option> 		
											<option value="Skynet">Skynet</option> 		
											<option value="Telebucaramanga">Telebucaramanga</option>
											<option value="Telecom">Telecom</option> 	
											<option value="Terremark">Terremark</option> 		
											<option value="Sol Cable Vision">Sol Cable Vision</option> 		
											<option value="Sistelec">Sistelec</option>
											<option value="Opain">Opain</option> 	
											<option value="Airplan - (Información y Tecnologia)">Airplan - (Información y Tecnologia)</option> 		
											<option value="TV Azteca">TV Azteca</option> 						    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- MEDIO -->
						    <div class="form-group">
						        <label for="pr_medio" class="col-md-3 control-label">Medio:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_medio" name="pr_medio">
										    <option value="">Seleccionar...</option>
										    <option value="No Aplica">No Aplica</option>  									   									
										    <option value="Existente">Existente</option> 	   
										    <option value="Fibra">Fibra</option>
										    <option value="Cobre">Cobre</option>
										    <option value="Satelital">Satelital</option> 
										    <option value="Radio enlace">Radio enlace</option>
										    <option value="3G">3G</option>
										    <option value="UTP">UTP</option>
										</select>
						            </div>
						        </div>
						    </div>

						    
				            <!-- RESPUESTA FACTIBILIDAD BW > =100 MEGAS : -->
				            <div class="form-group">
						        <label for="pr_factibilidad_bw" class="col-md-3 control-label">Respuesta factibilidad BW >= 100 MEGAS:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_factibilidad_bw" id="pr_factibilidad_bw" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
				            <!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
						    <div class="form-group">
						        <label for="pr_tipo_conector" class="col-md-3 control-label">Tipo conector:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_tipo_conector" name="pr_tipo_conector">
										    <option value="">Seleccionar...</option>
										    <option value="LC">LC</option>  									   									
										    <option value="SC">SC</option> 	   
										    <option value="ST">ST</option>
										    <option value="FC">FC</option>
										</select>
						            </div>
						        </div>
						    </div>

							<!-- 2.ACCESO (Solo Aplica para Canales > = 100 MEGAS   ======= -->
				            <!-- SDS DESTINO (Unifilar): -->
				            <div class="form-group">
						        <label for="pr_sds_destino" class="col-md-3 control-label">SDS destino(unifiliar):</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_sds_destino" id="pr_sds_destino" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
				            <!-- OLT (GPON): -->
				            <div class="form-group">
						        <label for="pr_olt" class="col-md-3 control-label">OLT(GPON):</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_olt" id="pr_olt" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>	            
							
						</fieldset>
					</div>

					<div class="d-inline-b">

						<fieldset class="col-md-6">
				            <!-- INTERFACE DE ENTREGA AL CLIENTE: -->
				            <div class="form-group">
				                <label for="pr_interfaz_entrega_cliente" class="col-md-3 control-label">Interface entrega al cliente:</label>
				                <div class="col-md-8 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_interfaz_entrega_cliente" name="pr_interfaz_entrega_cliente">
										    <option value="">Seleccionar...</option>
										    <option value="No aplica">No aplica</option>  									   									
										    <option value="Ethernet">Ethernet</option> 	   
										    <option value="Serial V.35">Serial V.35</option>
										    <option value="Giga (óptico)">Giga (óptico)</option>
										    <option value="Giga Ethernet (Electrico)">Giga Ethernet (Electrico)</option>  						   									
										    <option value="STM-1">STM-1</option> 	   
										    <option value="RJ45 - 120 OHM">RJ45 - 120 OHM</option>
										    <option value="G703 BNC">G703 BNC</option>
										</select>
				                    </div>
				                </div>
				            </div>

				            <!-- REQUIERE VOC : -->
						     <div class="form-group">
						        <label for="pr_requiere_voc" class="col-md-3 control-label">Requiere VOC:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_voc" name="pr_requiere_voc">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
											<option value="No">No</option>   												
											<option value="No aplica">No aplica</option> 	    
										</select>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- PROGRAMACIÓN DE VOC : -->
						     <div class="form-group">
						        <label for="pr_programacion_voc" class="col-md-3 control-label">Programación de VOC:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_programacion_voc" name="pr_programacion_voc">
										    <option value="">Seleccionar...</option>
										    <option value="Programada">Programada</option>
											<option value="No requiere programación">No requiere programación</option>   												
											<option value="No programada. Otra ciudad">No programada. Otra ciudad</option> 	    
											<option value="No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto">No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
										</select>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
					</div>

					<legend class="f-s-15">Requerimientos Para Entrega del Servicio</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- REQUIERE RFC : -->
						     <div class="form-group">
						        <label for="pr_requiere_rfc" class="col-md-3 control-label">Requiere RFC:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_rfc" name="pr_requiere_rfc">
										    <option value="">Seleccionar...</option>
										    <option value="SI => Cliente Critico Punto Central">SI => Cliente Critico Punto Central</option>
											<option value="SI => Servicio Critico (Listado)">SI => Servicio Critico (Listado)</option>   												
											<option value="SI => Cliente Critico">SI => Cliente Critico</option> 	    
											<option value="SI => RFC Estándar Saturación">SI => RFC Estándar Saturación</option>
											<option value="SI => Cliente Critico Punto Central - RFC Estándar Saturación">SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
											<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

							<!-- EQUIPOS   (VER LISTA COMPLETA): -->
							<!-- Conversor Medio: -->
				            <div class="form-group">
						        <label for="pr_conversor_medio" class="col-md-3 control-label">Conversor Medio:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_conversor_medio" id="pr_conversor_medio" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- Referencia Router: -->
				            <div class="form-group">
						        <label for="pr_referencia_router" class="col-md-3 control-label">Referencia Router:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_referencia_router" id="pr_referencia_router" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Modulos o Tarjetas: -->
				            <div class="form-group">
						        <label for="pr_modulos_tarjetas" class="col-md-3 control-label">Modulos o Tarjetas:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_modulos_tarjetas" id="pr_modulos_tarjetas" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
						   	<!-- Licencias --> 
						    <div class="form-group">
						        <label for="pr_licencias" class="col-md-3 control-label">Licencias:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_licencias" id="pr_licencias" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Equipos Adicionale--> 
						    <div class="form-group">
						        <label for="pr_equipos_adicionales" class="col-md-3 control-label">Equipos adicionale:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_equipos_adicionales" id="pr_equipos_adicionales" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- Consumibles--> 
						    <div class="form-group">
						        <label for="pr_consumibles" class="col-md-3 control-label">Consumibles:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_consumibles" id="pr_consumibles" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
						     <div class="form-group">
						        <label for="pr_carta_valorizada" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_carta_valorizada" name="pr_carta_valorizada">
										  	<option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
											<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>
						   
						</fieldset>
					</div>

					<h3> DATOS DEL CONTACTO PARA COMUNICACIÓN</h3>
					<legend class="f-s-15">Aprueba Costos de oc e Inicio de Facturación de Orden de Trabajo</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- NOMBRE --> 
						    <div class="form-group">
						        <label for="pr_nombre_1" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre_1" id="pr_nombre_1" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="pr_telefono_1" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono_1" id="pr_telefono_1" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						   
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- CELULAR --> 
						    <div class="form-group">
						        <label for="pr_celular_1" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular_1" id="pr_celular_1" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="pr_correo_1" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_correo_1" id="pr_correo_1" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						   
						</fieldset>
					</div>

					<legend class="f-s-15">Datos Contacto Técnico</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
						   	<!-- NOMBRE --> 
						    <div class="form-group">
						        <label for="pr_nombre_2" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre_2" id="pr_nombre_2" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="pr_telefono_2" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono_2" id="pr_telefono_2" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- CELULAR --> 
						    <div class="form-group">
						        <label for="pr_celular_2" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular_2" id="pr_celular_2" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="pr_correo_2" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_correo_2" id="pr_correo_2" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						    
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

						    <!-- OBSERVACIONES: LA UM SE ESTA ENTREGANDO SOBRE OT DE TELEFONIA 9722208 --> 
						    <div class="form-group">
						        <label for="pr_observaciones" class="col-md-3 control-label">Observaciones:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <textarea  name="pr_observaciones" id="pr_observaciones" class="form-control" ></textarea>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
					</div>

					<legend class="f-s-15"> Kikoff Técnico</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
						
							<!-- Ancho de banda Exclusivo NAP  --> 
						    <div class="form-group">
						        <label for="pr_ancho_banda_nap" class="col-md-3 control-label">Ancho de banda Exclusivo NAP :</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ancho_banda_nap" id="pr_ancho_banda_nap" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- Ancho de banda de Internet  --> 
						    <div class="form-group">
						        <label for="pr_ancho_banda_internet" class="col-md-3 control-label">Ancho de banda de Internet:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ancho_banda_internet" id="pr_ancho_banda_internet" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- Direcciones IP : -->
						     <div class="form-group">
						        <label for="pr_direcciones_ip" class="col-md-3 control-label">Direcciones IP:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_direcciones_ip" name="pr_direcciones_ip">
										    <option value="">Seleccionar...</option>
										    <option value="Cantidad IPs: 2 - Mascara: /30">Cantidad IPs: 2 - Mascara: /30</option>
											<option value="Cantidad IPs 6 - Mascara: /29">Cantidad IPs 6 - Mascara: /29</option>
											<option value="Cantidad IPs 14 - Mascara: /28 - Requiere Viabilidad Preventa">Cantidad IPs 14 - Mascara: /28 - Requiere Viabilidad Preventa</option>
											<option value="Cantidad Ips: 30 - Mascara: /27 - Requiere Viabilidad Preventa">Cantidad Ips: 30 - Mascara: /27 - Requiere Viabilidad Preventa</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Activación correo -->
						     <div class="form-group">
						        <label for="pr_activacion_correo" class="col-md-3 control-label">Activación correo:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_activacion_correo" name="pr_activacion_correo">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
											<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
						    <!-- Activación WEB Hosting -->
						     <div class="form-group">
						        <label for="pr_activacion_web_hosting" class="col-md-3 control-label">Activación WEB Hosting:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_activacion_web_hosting" name="pr_activacion_web_hosting">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
											<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Dominio existente -->
						     <div class="form-group">
						        <label for="pr_dominio_existente" class="col-md-3 control-label">Dominio existente:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_dominio_existente" name="pr_dominio_existente">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
											<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- Dominio a comprar -->
						    <div class="form-group">
						        <label for="pr_dominio_comprar" class="col-md-3 control-label">Dominio a comprar:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_dominio_comprar" id="pr_dominio_comprar" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad cuentas de correo-->
						     <div class="form-group">
						        <label for="pr_cant_correos" class="col-md-3 control-label">Cantidad cuentas de correo:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_cant_correos" name="pr_cant_correos">
										    <option value="">Seleccionar...</option>
										    <option value="20">20</option>
											<option value="40">40</option>
											<option value="140">140</option>
											<option value="160">160</option>
											<option value="200">200</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Espacio de correo (GB)-->
						     <div class="form-group">
						        <label for="pr_espacio_correo" class="col-md-3 control-label">Espacio de correo (GB) :</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_espacio_correo" name="pr_espacio_correo">
										    <option value="">Seleccionar...</option>
										    <option value="2">2</option>
											<option value="4">4</option>
											<option value="14">14</option>
											<option value="16">16</option>
											<option value="20">20</option>
										</select>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
						    <!-- Plataforma de WEBHosting :-->
						     <div class="form-group">
						        <label for="pr_plataforma_web" class="col-md-3 control-label">Plataforma de WEB Hosting ::</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_plataforma_web" name="pr_plataforma_web">
										    <option value="">Seleccionar...</option>
										   	<option value="Windows">Windows</option>
											<option value="Solaris">Solaris</option>
											<option value="NA">NA</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- WEB Hosting (MB)-->
						    <div class="form-group">
						        <label for="pr_web_hosting" class="col-md-3 control-label">WEB Hosting (MB):</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_web_hosting" name="pr_web_hosting">
										    <option value="">Seleccionar...</option>
										    <option value="20">20</option>
											<option value="40">40</option>
											<option value="140">140</option>
											<option value="160">160</option>
											<option value="200">200</option>
										</select>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- APLICA A ALGUNA PROMOCION VIGENTE (POR FAVOR DOCUMENTAR  NOMBRE DE LA PROMOCION) : -->
						    <div class="form-group">
						        <label for="pr_promocion" class="col-md-3 control-label">Aplica alguna promocion vigente (nombre promocion):</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_promocion" id="pr_promocion" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
				</div>

            `;
        },

        /*MPLS*/
        formProduct_mpls: function(otp) {
            return `
            	<legend class="f-s-15"><strong>¿Es un cliente nuevo?</strong>
            		<div class="btn-cami_cool max-w_border-n">
            		 	<span>NO</span><label class="switch">
						  <input id="checking" type="checkbox" >
						  <div class="slider round"></div>
						</label>
						<span>SI</span>
					</div>
            	</legend>
				<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario Cierre de Kickoff  <small>MPLS</small></h2>
				<!--*********************  MODULO PESTAÑAS  *********************-->
				<ul class="nav nav-tabs">
					<li class="active" id=""><a data-toggle="tab" href="#mpls_punto_destino" id="pestana_punto_destino">PUNTO DESTINO</a></li>
					<li class="" id="pestana_puto_origen" style="display: none"><a data-toggle="tab" href="#mpls_punto_origen">PUNTO DE ORIGEN</a></li>
				</ul>

				<!--*********************  CONTENIDO PESTAÑAS  *********************-->
				<div class="tab-content">

					<div id="mpls_punto_destino" class="tab-pane fade in active">
						<h3>PUNTO DESTINO</h3>
						<div class="widget bg_white m-t-25 d-inline-b cliente">
							<legend class="f-s-15">DATOS BÁSICOS DE INSTALACION PUNTO DESTINO</legend>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									<!-- CIUDAD -->
									<div class="form-group">
								        <label for="pr_ciudad_des" class="col-md-3 control-label">Ciudad:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-globe" ></i></span>
								                <input name="pr_ciudad_des" id="pr_ciudad_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- DIRECCIÓN:-->
								    <div class="form-group">
								        <label for="pr_direccion_des" class="col-md-3 control-label">Dirección:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
								                <input name="pr_direccion_des" id="pr_direccion_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								</fieldset>
								<fieldset class="col-md-6">
									<!-- TIPO PREDIO: -->
								     <div class="form-group">
								        <label for="pr_tipo_predio_des" class="col-md-3 control-label">Tipo predio:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
								                <select class="form-control" id="pr_tipo_predio_des" name="pr_tipo_predio_des">
												    <option value="">Seleccionar...</option>
												    <option value="Edificio">Edificio</option>
				  									<option value="Casa">Casa</option>
												    
												</select>
								            </div>
								        </div>
								    </div>	

								    <!-- NIT del cliente: -->
								    <div class="form-group">
								        <label for="pr_nit_cliente_des" class="col-md-3 control-label">NIT del cliente:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
								                <input name="pr_nit_cliente_des" id="pr_nit_cliente_des" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									<!-- ALIAS DEL LUGAR  -->
								    <div class="form-group">
								        <label for="pr_alias_lugar_des" class="col-md-3 control-label">Alias del lugar:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-globe" ></i></span>
								                <input name="pr_alias_lugar_des" id="pr_alias_lugar_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- OTP -->
									<div class="form-group">
								        <label for="pr_id_ot_padre_des" class="col-md-3 control-label">OTP:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="pr_id_ot_padre_des" id="pr_id_ot_padre_des" class="form-control" type="text" value="${otp}" readonly>

								            </div>
								        </div>
								    </div>
								    
								</fieldset>
								<fieldset class="col-md-6">
									 <!-- otp_asociadas -->
									<div class="form-group">
								        <label for="pr_otp_asociada_des" class="col-md-3 control-label">OTP asociadas:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="pr_otp_asociada_des" id="pr_otp_asociada_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>


								    <!-- TIPO MPLS: -->
								     <div class="form-group">
								        <label for="pr_tipo_mpls_des" class="col-md-3 control-label">Tipo MPLS:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								                <select class="form-control" id="pr_tipo_mpls_des" name="pr_tipo_mpls_des">
												    <option value="">Seleccionar...</option>
												    <option value="MPLS Avanzado INTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado INTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option value="MPLS Avanzado INTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado INTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option value="MPLS Avanzado INTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado INTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option value="MPLS Avanzado INTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado INTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option value="MPLS Avanzado INTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado INTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)</option> 
				  									<option value="MPLS Avanzado EXTRANET NDS6 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado EXTRANET NDS6 +  Monitoreo CPE (Gestión Proactiva)</option>	
				  									<option value="MPLS Avanzado EXTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado EXTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)</option>	
				  									<option value="MPLS Avanzado EXTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado EXTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option value="MPLS Avanzado EXTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado EXTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option value="MPLS Avanzado EXTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado EXTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option value="MPLS Avanzado EXTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado EXTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option value="MPLS Avanzado Solución Punta Backend Triara">MPLS Avanzado Solución Punta Backend Triara</option>		
				  									<option value="MPLS Avanzado Solución Punta Backend Ortezal">MPLS Avanzado Solución Punta Backend Ortezal</option>
				  									<option value="MPLS Avanzado Componente Datacenter (con Punta en Rack de Appliance) ">MPLS Avanzado Componente Datacenter (con Punta en Rack de Appliance) </option>
				  									<option value="MPLS Avanzado Claro Connect (con Punta Cloud)">MPLS Avanzado Claro Connect (con Punta Cloud)</option>
				  									<option value="MPLS Transaccional - Solución Fibra">MPLS Transaccional - Solución Fibra</option>
				  									<option value="MPLS Transaccional - Solución HFC">MPLS Transaccional - Solución HFC</option>		
				  									<option value="MPLS Transaccional - Solución 3G">MPLS Transaccional - Solución 3G</option>	
				  									<option value="IP Data Internacional">IP Data Internacional</option>		
				  									<option value="Backup de Ultima Milla Fibra">Backup de Ultima Milla Fibra</option>
				  									<option value="Backup de Ultima Milla Fibra  + Router">Backup de Ultima Milla Fibra  + Router</option>    
				  									<option value="Backup de Ultima Milla HFC">Backup de Ultima Milla HFC</option>
				  									<option value="Backup de Ultima Milla 3G">Backup de Ultima Milla 3G</option>
				  									<option value="Backup de Ultima Milla Terceros">Backup de Ultima Milla Terceros</option>
												</select>
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									<!-- ancho_banda -->
									<div class="form-group">
								        <label for="pr_ancho_banda_des" class="col-md-3 control-label">Ancho de banda:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
								                <input name="pr_ancho_banda_des" id="pr_ancho_banda_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>		

								    <!-- TIPO INSTALACION: -->
								     <div class="form-group">
								        <label for="pr_tipo_instalacion_des" class="col-md-3 control-label">Tipo instalación:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								                <select class="form-control" id="pr_tipo_instalacion_des" name="pr_tipo_instalacion_des">
												    <option value="">Seleccionar...</option>
												    <option value="Instalar UM con PE">Instalar UM con PE</option>
												    <option value="Instalar UM con PE sobre OTP de Pymes">Instalar UM con PE sobre OTP de Pymes</option>
												    <option value="Instalar UM con CT">Instalar UM con CT</option>
												    <option value="Instalar UM con HFC">Instalar UM con HFC</option>
				  									<option value="Instalar UM con 3G">Instalar UM con 3G</option>
				  									<option value="Instalar UM en Datacenter Claro- Implementación">Instalar UM en Datacenter Claro- Implementación</option>
				  									<option value="UM existente. Requiere Cambio de equipo">UM existente. Requiere Cambio de equipo</option>
				  									<option value="UM existente. Requiere Adición de equipo">UM existente. Requiere Adición de equipo</option> 	
				  									<option value="UM existente. Solo configuración">UM existente. Solo configuración</option> 							    
												</select>
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									
								    <!-- ID SERVICIO ACTUAL -->
									<div class="form-group">
								        <label for="pr_servicio_actual_des" class="col-md-3 control-label"><a title="Aplica para UM Existente">ID SERVICIO ACTUAL:</a></label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
								                <input name="pr_servicio_actual_des" id="pr_servicio_actual_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- ID SERVICIO PRINCIPAL (Aplica solo para enlaces Backup):-->
									<div class="form-group">
								        <label for="pr_servicio_principal_des" class="col-md-3 control-label"><a title="Aplica solo para enlaces Backup">ID SERVICIO PRINCIPAL:</a></label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
								                <input name="pr_servicio_principal_des" id="pr_servicio_principal_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
							<legend class="f-s-15">INFORMACIÓN  ULTIMA MILLA DESTINO</legend>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
								     <div class="form-group">
								        <label for="pr_requiere_um_des" class="col-md-3 control-label">¿Esta OT requiere instalacion UM?:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								                <select class="form-control" id="pr_requiere_um_des" name="pr_requiere_um_des">
												    <option value="">Seleccionar...</option>
												    <option value="Si">Si</option>
				  									<option value="No">No</option>   												    
												</select>
								            </div>
								        </div>
								    </div>

								    <!-- ESTA ULTIMA MILLA ES UN BACKUP?: -->
								    <div class="form-group">
								        <label for="pr_um_backup_des" class="col-md-3 control-label">Esta ultima milla es backup:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								                <select class="form-control" id="pr_um_backup_des" name="pr_um_backup_des">
												    <option value="">Seleccionar...</option>
												    <option value="Si">Si</option>
				  									<option value="No">No</option>   					    
												</select>
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- PROVEEDOR: -->
								    <div class="form-group">
								        <label for="pr_proveedor_des" class="col-md-3 control-label">Proveedor:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								                <select class="form-control" id="pr_proveedor_des" name="pr_proveedor_des">
												    <option value="Seleccionar...</option>">Seleccionar...</option>
												    <option value="No aplica">No aplica</option>
				  									<option value="Existente">Existente</option>
				  									<option value="Claro">Claro</option>
				  									<option value="Axesat">Axesat</option>
				  									<option value="Comcel">Comcel</option> 	
				  									<option value="Tigo">Tigo</option> 		
				  									<option value="Media Commerce">Media Commerce</option> 		
				  									<option value="Diveo">Diveo</option>
				  									<option value="Edatel">Edatel</option> 	
				  									<option value="UNE">UNE</option> 		
				  									<option value="ETB">ETB</option> 	
				  									<option value="IBM">IBM</option> 		
				  									<option value="IFX">IFX</option> 		
				  									<option value="Level 3 Colombia">Level 3 Colombia</option>
				  									<option value="Mercanet">Mercanet</option> 	
				  									<option value="Metrotel">Metrotel</option> 		
				  									<option value="Promitel">Promitel</option> 		
				  									<option value="Skynet">Skynet</option> 		
				  									<option value="Telebucaramanga">Telebucaramanga</option>
				  									<option value="Telecom">Telecom</option> 	
				  									<option value="Terremark">Terremark</option> 		
				  									<option value="Sol Cable Vision">Sol Cable Vision</option> 		
				  									<option value="Sistelec">Sistelec</option>
				  									<option value="Opain">Opain</option> 	
				  									<option value="Airplan - (Información y Tecnologia)">Airplan - (Información y Tecnologia)</option> 		
				  									<option value="TV Azteca">TV Azteca</option> 						    
												</select>
								            </div>
								        </div>
								    </div>

								    <!-- MEDIO -->
								    <div class="form-group">
								        <label for="pr_medio_des" class="col-md-3 control-label">Medio:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								                <select class="form-control" id="pr_medio_des" name="pr_medio_des">
												    <option value="">Seleccionar...</option>
												    <option value="No Aplica">No Aplica</option> 	   
												    <option value="Fibra">Fibra</option>
												    <option value="Cobre">Cobre</option>
												    <option value="HFC">HFC</option>
												    <option value="Satelital">Satelital</option> 
												    <option value="Radio enlace">Radio enlace</option>
												    <option value="3G">3G</option>
												    <option value="UTP">UTP</option>
												</select>
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									<!-- RESPUESTA FACTIBILIDAD BW > =100 MEGAS : -->
						            <div class="form-group">
								        <label for="pr_factibilidad_bw_des" class="col-md-3 control-label">Respuesta factibilidad BW > 100 MEGAS:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="pr_factibilidad_bw_des" id="pr_factibilidad_bw_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

						            <!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
								    <div class="form-group">
								        <label for="pr_tipo_conector_des" class="col-md-3 control-label">Tipo conector:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								                <select class="form-control" id="pr_tipo_conector_des" name="pr_tipo_conector_des">
												    <option value="">Seleccionar...</option>
												    <option value="LC">LC</option>  									   									
												    <option value="SC">SC</option> 	   
												    <option value="ST">ST</option>
												    <option value="FC">FC</option>
												</select>
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- ACCESO (Solo Aplica para Canales SDH) : -->
						            <div class="form-group">
								        <label for="pr_sds_destino_des" class="col-md-3 control-label">SDS destino (Unifilar):</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
								                <input name="pr_sds_destino_des" id="pr_sds_destino_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								    
								    <!-- INTERFACE DE ENTREGA AL CLIENTE: -->
								    <div class="form-group">
								        <label for="pr_interfaz_entrega_cliente_des" class="col-md-3 control-label">Interface de entrega al cliente:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								                <select class="form-control" id="pr_interfaz_entrega_cliente_des" name="pr_interfaz_entrega_cliente_des">
												    <option value="">Seleccionar...</option>
												    <option value="No aplica">No aplica</option> 									   									
												    <option value="Ethernet">Ethernet</option> 	   
												    <option value="Serial V.35">Serial V.35</option>
												    <option value="Giga (óptico)">Giga (óptico)</option>
												    <option value="Giga Ethernet (Electrico)">Giga Ethernet (Electrico)</option>
												    <option value="STM-1">STM-1</option>
												    <option value="RJ45 - 120 OHM">RJ45 - 120 OHM</option>
												    <option value="G703 BNC">G703 BNC</option>
												</select>
								            </div>
								        </div>
								    </div>

								</fieldset>
							</div>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									
									<!-- REQUIERE VOC : -->
								     <div class="form-group">
								        <label for="pr_requiere_voc_des" class="col-md-3 control-label">Requiere VOC:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								                <select class="form-control" id="pr_requiere_voc_des" name="pr_requiere_voc_des">
												    <option value="">Seleccionar...</option>
												    <option value="Si">Si</option>
				  									<option value="No">No</option>    
												</select>
								            </div>
								        </div>
								    </div>

								</fieldset>
								<fieldset class="col-md-6">
									<!-- PROGRAMACIÓN DE VOC : -->
								     <div class="form-group">
								        <label for="pr_programacion_voc_des" class="col-md-3 control-label">Programación de VOC:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								                <select class="form-control" id="pr_programacion_voc_des" name="pr_programacion_voc_des">
												    <option value="">Seleccionar...</option>
												    <option value="Programada">Programada</option>
				  									<option value="No requiere programación">No requiere programación</option>   												
				  									<option value="No programada. Otra ciudad">No programada. Otra ciudad</option> 	    
				  									<option value="No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto">No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
												</select>
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>

							<legend class="f-s-15">REQUERIMIENTOS PARA ENTREGA DEL SERVICIO  DESTINO</legend>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									<!-- REQUIERE RFC : -->
								     <div class="form-group">
								        <label for="pr_requiere_rfc_des" class="col-md-3 control-label">Requiere RFC:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								                <select class="form-control" id="pr_requiere_rfc_des" name="pr_requiere_rfc_des">
												    <option value="">Seleccionar...</option>
												    <option value="SI => Cliente Critico Punto Central">SI => Cliente Critico Punto Central</option>
				  									<option value="SI => Servicio Critico (Listado)">SI => Servicio Critico (Listado)</option>  												
				  									<option value="SI => Cliente Critico">SI => Cliente Critico</option> 	    
				  									<option value="SI => RFC Estándar Saturación">SI => RFC Estándar Saturación</option>
				  									<option value="SI => Cliente Critico Punto Central - RFC Estándar Saturación">SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
				  									<option value="No">No</option>
												</select>
								            </div>
								        </div>
								    </div>

									<!-- EQUIPOS   (VER LISTA COMPLETA): -->
									
									<!-- Conversor Medio: -->
						            <div class="form-group">
								        <label for="pr_conversor_medio_des" class="col-md-3 control-label">Conversor Medio:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="pr_conversor_medio_des" id="pr_conversor_medio_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- Referencia Router: -->
						            <div class="form-group">
								        <label for="pr_referencia_router_des" class="col-md-3 control-label">Referencia Router:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="pr_referencia_router_des" id="pr_referencia_router_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- Modulos o Tarjetas: -->
						            <div class="form-group">
								        <label for="pr_modulos_tarjetas_des" class="col-md-3 control-label">Modulos o Tarjetas:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="pr_modulos_tarjetas_des" id="pr_modulos_tarjetas_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									<!-- Licencias --> 
								    <div class="form-group">
								        <label for="pr_licencias_des" class="col-md-3 control-label">Licencias:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="pr_licencias_des" id="pr_licencias_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- Equipos Adicionale--> 
								    <div class="form-group">
								        <label for="pr_equipos_adicionales_des" class="col-md-3 control-label">Equipos adicionale:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="pr_equipos_adicionales_des" id="pr_equipos_adicionales_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- Consumibles:--> 
								    <div class="form-group">
								        <label for="pr_consumibles_des" class="col-md-3 control-label">Consumibles:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								                <select class="form-control" id="pr_consumibles_des" name="pr_consumibles_des">
												    <option value="">Seleccionar...</option>
												    <option value="Bandeja">Bandeja</option>
				  									<option value="Cables de Poder ">Cables de Poder </option>
				  									<option value="Clavijas de Conexión">Clavijas de Conexión</option>
				  									<option value="Accesorios para rackear (Orejas)">Accesorios para rackear (Orejas)</option>
				  									<option value="No Aplica">No Aplica</option>
												</select>
								            </div>
								        </div>
								    </div>

								    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
								     <div class="form-group">
								        <label for="pr_carta_valorizada_des" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								                <select class="form-control" id="pr_carta_valorizada_des" name="pr_carta_valorizada_des">
												    <option value="">Seleccionar...</option>
												    <option value="Si">Si</option>
				  									<option value="No">No</option>
												</select>
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>

							<legend class="f-s-15">APRUEBA COSTOS DE OC Y CIERRE DE ORDEN DE TRABAJO</legend>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									<!-- NOMBRE --> 
								    <div class="form-group">
								        <label for="pr_nombre_1_des" class="col-md-3 control-label">Nombre:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
								                <input name="pr_nombre_1_des" id="pr_nombre_1_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- TELEFONO --> 
								    <div class="form-group">
								        <label for="pr_telefono_1_des" class="col-md-3 control-label">Telefono:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
								                <input name="pr_telefono_1_des" id="pr_telefono_1_des" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- CELULAR --> 
								    <div class="form-group">
								        <label for="pr_celular_1_des" class="col-md-3 control-label">Celular:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
								                <input name="pr_celular_1_des" id="pr_celular_1_des" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>

								    <!-- EMAIL --> 
								    <div class="form-group">
								        <label for="pr_correo_1_des" class="col-md-3 control-label">Email:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
								                <input name="pr_correo_1_des" id="pr_correo_1_des" class="form-control" type="email" >
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>

							<legend class="f-s-15">DATOS CLIENTE: TÉCNICO</legend>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									<!-- NOMBRE --> 
								    <div class="form-group">
								        <label for="pr_nombre_2_des" class="col-md-3 control-label">Nombre:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
								                <input name="pr_nombre_2_des" id="pr_nombre_2_des" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- TELEFONO --> 
								    <div class="form-group">
								        <label for="pr_telefono_2_des" class="col-md-3 control-label">Telefono:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
								                <input name="pr_telefono_2_des" id="pr_telefono_2_des" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- CELULAR --> 
								    <div class="form-group">
								        <label for="pr_celular_2_des" class="col-md-3 control-label">Celular:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
								                <input name="pr_celular_2_des" id="pr_celular_2_des" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>

								    <!-- EMAIL --> 
								    <div class="form-group">
								        <label for="pr_correo_2_des" class="col-md-3 control-label">Correo electronico:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
								                <input name="pr_correo_2_des" id="pr_correo_2_des" class="form-control" type="email" >
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
							<div class="d-inline-b">
								<fieldset class="col-md-12">
									<!-- OBSERVACIONES: --> 
								    <div class="form-group">
								        <label for="pr_observaciones_1_des" class="col-md-3 control-label">Observaciones:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <textarea name="pr_observaciones_1_des" id="pr_observaciones_1_des" class="form-control"></textarea>

								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
						</div>
					</div>
					<div id="mpls_punto_origen" class="tab-pane fade"></div>


				</div>
            `;
        },

        //MPLS FORMULARIO DE ORIGEN
        formProduct_mpls_form_origen: function() {
            return `
				<div id="seccion_mpls_ori">
					<h3>PUNTO DE ORIGEN</h3>
					<div class="widget bg_white m-t-25 d-inline-b cliente">
						<legend class="f-s-15">Datos básicos de instalacion - origen</legend>
						<div class="d-inline-b">
							<fieldset class="col-md-6">
								<!-- CIUDAD -->
								<div class="form-group">
							        <label for="pr_ciudad_ori" class="col-md-3 control-label">Ciudad:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="mundo glyphicon glyphicon-globe" ></i></span>
							                <input name="pr_ciudad_ori" id="pr_ciudad_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>

							    <!-- DIRECCIÓN:-->
							    <div class="form-group">
							        <label for="pr_direccion_ori" class="col-md-3 control-label">Dirección:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="posi glyphicon glyphicon-map-marker" ></i></span>
							                <input name="pr_direccion_ori" id="pr_direccion_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>
							</fieldset>
							<fieldset class="col-md-6">
								<!-- TIPO PREDIO: -->
							     <div class="form-group">
							        <label for="pr_tipo_predio_ori" class="col-md-3 control-label">Tipo predio:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
							                <select class="form-control" id="pr_tipo_predio_ori" name="pr_tipo_predio_ori">
											    <option value="">Seleccionar...</option>
											    <option value="Edificio">Edificio</option>
			  									<option value="Casa">Casa</option>
											    
											</select>
							            </div>
							        </div>
							    </div>	

							    <!-- NIT del cliente: -->
							    <div class="form-group">
							        <label for="pr_nit_cliente_ori" class="col-md-3 control-label">NIT del cliente:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
							                <input name="pr_nit_cliente_ori" id="pr_nit_cliente_ori" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</fieldset>
						</div>
						<div class="d-inline-b">
							<fieldset class="col-md-6">
								
							    <!-- ALIAS DEL LUGAR  -->
							    <div class="form-group">
							        <label for="pr_alias_lugar_ori" class="col-md-3 control-label">Alias del lugar:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-globe" ></i></span>
							                <input name="pr_alias_lugar_ori" id="pr_alias_lugar_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>

							</fieldset>
							<fieldset class="col-md-6">
								 <!-- otp_asociadas -->
								<div class="form-group">
							        <label for="pr_otp_asociada_ori" class="col-md-3 control-label">OTP asociadas:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_otp_asociada_ori" id="pr_otp_asociada_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>


							    <!-- TIPO MPLS: -->
							     <div class="form-group">
							        <label for="pr_tipo_mpls_ori" class="col-md-3 control-label">Tipo MPLS:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_tipo_mpls_ori" name="pr_tipo_mpls_ori">
											    <option value="">Seleccionar...</option>
											    <option value="MPLS Avanzado INTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado INTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)</option>
			  									<option value="MPLS Avanzado INTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado INTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)</option>
			  									<option value="MPLS Avanzado INTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado INTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)</option>
			  									<option value="MPLS Avanzado INTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado INTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)</option>
			  									<option value="MPLS Avanzado INTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado INTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)</option> 
			  									<option value="MPLS Avanzado EXTRANET NDS6 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado EXTRANET NDS6 +  Monitoreo CPE (Gestión Proactiva)</option>	
			  									<option value="MPLS Avanzado EXTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado EXTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)</option>	
			  									<option value="MPLS Avanzado EXTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado EXTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)</option>
			  									<option value="MPLS Avanzado EXTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado EXTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)</option>
			  									<option value="MPLS Avanzado EXTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado EXTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)</option>
			  									<option value="MPLS Avanzado EXTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado EXTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)</option>
			  									<option value="MPLS Avanzado Solución Punta Backend Triara">MPLS Avanzado Solución Punta Backend Triara</option>		
			  									<option value="MPLS Avanzado Solución Punta Backend Ortezal">MPLS Avanzado Solución Punta Backend Ortezal</option>
			  									<option value="MPLS Avanzado Componente Datacenter (con Punta en Rack de Appliance) ">MPLS Avanzado Componente Datacenter (con Punta en Rack de Appliance) </option>
			  									<option value="MPLS Avanzado Claro Connect (con Punta Cloud)">MPLS Avanzado Claro Connect (con Punta Cloud)</option>
			  									<option value="MPLS Transaccional - Solución Fibra">MPLS Transaccional - Solución Fibra</option>
			  									<option value="MPLS Transaccional - Solución HFC">MPLS Transaccional - Solución HFC</option>		
			  									<option value="MPLS Transaccional - Solución 3G">MPLS Transaccional - Solución 3G</option>	
			  									<option value="IP Data Internacional">IP Data Internacional</option>		
			  									<option value="Backup de Ultima Milla Fibra">Backup de Ultima Milla Fibra</option>
			  									<option value="Backup de Ultima Milla Fibra  + Router">Backup de Ultima Milla Fibra  + Router</option>    
			  									<option value="Backup de Ultima Milla HFC">Backup de Ultima Milla HFC</option>
			  									<option value="Backup de Ultima Milla 3G">Backup de Ultima Milla 3G</option>
			  									<option value="Backup de Ultima Milla Terceros">Backup de Ultima Milla Terceros</option>
											</select>
							            </div>
							        </div>
							    </div>
							</fieldset>
						</div>
						<div class="d-inline-b">
							<fieldset class="col-md-6">
								<!-- ancho_banda -->
								<div class="form-group">
							        <label for="pr_ancho_banda_ori" class="col-md-3 control-label">Ancho de banda:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
							                <input name="pr_ancho_banda_ori" id="pr_ancho_banda_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>		

							    <!-- TIPO INSTALACION: -->
							     <div class="form-group">
							        <label for="pr_tipo_instalacion_ori" class="col-md-3 control-label">Tipo instalación:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_tipo_instalacion_ori" name="pr_tipo_instalacion_ori">
											    <option value="">Seleccionar...</option>
											    <option value="Instalar UM con PE">Instalar UM con PE</option>
											    <option value="Instalar UM con PE sobre OTP de Pymes">Instalar UM con PE sobre OTP de Pymes</option>
											    <option value="Instalar UM con CT">Instalar UM con CT</option>
											    <option value="Instalar UM con HFC">Instalar UM con HFC</option>
			  									<option value="Instalar UM con 3G">Instalar UM con 3G</option>
			  									<option value="Instalar UM en Datacenter Claro- Implementación">Instalar UM en Datacenter Claro- Implementación</option>
			  									<option value="UM existente. Requiere Cambio de equipo">UM existente. Requiere Cambio de equipo</option>
			  									<option value="UM existente. Requiere Adición de equipo">UM existente. Requiere Adición de equipo</option> 	
			  									<option value="UM existente. Solo configuración">UM existente. Solo configuración</option> 							    
											</select>
							            </div>
							        </div>
							    </div>
							</fieldset>
							<fieldset class="col-md-6">
								 <!-- ID SERVICIO ACTUAL -->
								<div class="form-group">
							        <label for="pr_servicio_actual_ori" class="col-md-3 control-label"><a title="Aplica para UM Existente">ID servicio actual:</a></label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
							                <input name="pr_servicio_actual_ori" id="pr_servicio_actual_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>

							    <!-- ID SERVICIO PRINCIPAL (Aplica solo para enlaces Backup):-->
								<div class="form-group">
							        <label for="pr_servicio_principal_ori" class="col-md-3 control-label"><a title="Aplica solo para enlaces Backup">ID servicio principal:</a></label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
							                <input name="pr_servicio_principal_ori" id="pr_servicio_principal_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>
							</fieldset>
						</div>
						<legend class="f-s-15">INFORMACIÓN  ULTIMA MILLA  ORIGEN O PC</legend>
						<div class="d-inline-b">
							<fieldset class="col-md-6">
								<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
							     <div class="form-group">
							        <label for="pr_requiere_um_ori" class="col-md-3 control-label">¿la OT requiere instalación UM?</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_um_ori" name="pr_requiere_um_ori">
											    <option value="">Seleccionar...</option>
											    <option value="Si">Si</option>
			  									<option value="No">No</option>   												
			  									<option value="Existente">Existente</option> 	    
											</select>
							            </div>
							        </div>
							    </div>


							    <!-- ESTA ULTIMA MILLA ES UN BACKUP?: -->
							    <div class="form-group">
							        <label for="pr_um_backup_ori" class="col-md-3 control-label">Esta última milla es un backup:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_um_backup_ori" name="pr_um_backup_ori">
											    <option value="">Seleccionar...</option>
											    <option value="Si">Si</option>
			  									<option value="No">No</option>   												
			  									<option value="Existente">Existente</option> 				    
											</select>
							            </div>
							        </div>
							    </div>								    
							</fieldset>
							<fieldset class="col-md-6">
								
								<!-- PROVEEDOR: -->
							    <div class="form-group">
							        <label for="pr_proveedor_ori" class="col-md-3 control-label">Proveedor:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_proveedor_ori" name="pr_proveedor_ori">
											    <option value="">Seleccionar...</option>
											    <option value="No aplica">No aplica</option>
			  									<option value="Existente">Existente</option>
			  									<option value="Claro">Claro</option>
			  									<option value="Axesat">Axesat</option>
			  									<option value="Comcel">Comcel</option> 	
			  									<option value="Tigo">Tigo</option> 		
			  									<option value="Media Commerce">Media Commerce</option> 		
			  									<option value="Diveo">Diveo</option>
			  									<option value="Edatel">Edatel</option> 	
			  									<option value="UNE">UNE</option> 		
			  									<option value="ETB">ETB</option> 	
			  									<option value="IBM">IBM</option> 		
			  									<option value="IFX">IFX</option> 		
			  									<option value="Level 3 Colombia">Level 3 Colombia</option>
			  									<option value="Mercanet">Mercanet</option> 	
			  									<option value="Metrotel">Metrotel</option> 		
			  									<option value="Promitel">Promitel</option> 		
			  									<option value="Skynet">Skynet</option> 		
			  									<option value="Telebucaramanga">Telebucaramanga</option>
			  									<option value="Telecom">Telecom</option> 	
			  									<option value="Terremark">Terremark</option> 		
			  									<option value="Sol Cable Vision">Sol Cable Vision</option> 		
			  									<option value="Sistelec">Sistelec</option>
			  									<option value="Opain">Opain</option> 	
			  									<option value="Airplan - (Información y Tecnologia)">Airplan - (Información y Tecnologia)</option> 		
			  									<option value="TV Azteca">TV Azteca</option> 						    
											</select>
							            </div>
							        </div>
							    </div>


							    <!-- MEDIO -->
							    <div class="form-group">
							        <label for="pr_medio_ori" class="col-md-3 control-label">Medio:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_medio_ori" name="pr_medio_ori">
											    <option value="">Seleccionar...</option>
											    <option value="No Aplica">No Aplica</option> 	   
											    <option value="Fibra">Fibra</option>
											    <option value="Cobre">Cobre</option>
											    <option value="HFC">HFC</option>
											    <option value="Satelital">Satelital</option> 
											    <option value="Radio enlace">Radio enlace</option>
											    <option value="3G">3G</option>
											    <option value="UTP">UTP</option>
											</select>
							            </div>
							        </div>
							    </div>
							</fieldset>
						</div>
						<div class="d-inline-b">
							<fieldset class="col-md-6">
								<!-- RESPUESTA FACTIBILIDAD BW > =100 MEGAS : -->
					            <div class="form-group">
							        <label for="pr_factibilidad_bw_ori" class="col-md-3 control-label">Respuesta factibilidad BW >= 100 MEGAS:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_factibilidad_bw_ori" id="pr_factibilidad_bw_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>


					            <!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
							    <div class="form-group">
							        <label for="pr_tipo_conector_ori" class="col-md-3 control-label">INTERFACE DE ENTREGA AL CLIENTE:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_tipo_conector_ori" name="pr_tipo_conector_ori">
											    <option value="">Seleccionar...</option>
											    <option value="No aplica">No aplica</option>  									   									
											    <option value="Ethernet ">Ethernet </option> 	   
											    <option value="Serial V.35">Serial V.35</option>
											    <option value="Giga ethernet (electronico)">Giga ethernet (electronico)</option>
											    <option value="STM-1">STM-1</option>
											    <option value="RJ45-120 OHM">RJ45-120 OHM</option>
											    <option value="G703 BNC">G703 BNC</option>
											</select>
							            </div>
							        </div>
							    </div>
							</fieldset>
							<fieldset class="col-md-6">
								<!-- ACCESO (Solo Aplica para Canales SDH) : -->
					            <div class="form-group">
							        <label for="pr_sds_destino_ori" class="col-md-3 control-label">SDS destino (Unifilar):</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
							                <input name="pr_sds_destino_ori" id="pr_sds_destino_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>
							    
							    <!-- INTERFACE DE ENTREGA AL CLIENTE: -->
							    <div class="form-group">
							        <label for="pr_interfaz_entrega_cliente_ori" class="col-md-3 control-label">Interface de entrega al cliente:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_interfaz_entrega_cliente_ori" name="pr_interfaz_entrega_cliente_ori">
											    <option value="">Seleccionar...</option>
											    <option value="No aplica">No aplica</option> 									   									
											    <option value="Ethernet">Ethernet</option> 	   
											    <option value="Serial V.35">Serial V.35</option>
											    <option value="Giga (óptico)">Giga (óptico)</option>
											    <option value="Giga Ethernet (Electrico)">Giga Ethernet (Electrico)</option>
											    <option value="STM-1">STM-1</option>
											    <option value="RJ45 - 120 OHM">RJ45 - 120 OHM</option>
											    <option value="G703 BNC">G703 BNC</option>
											</select>
							            </div>
							        </div>
							    </div>
							</fieldset>
						</div>
						<div class="d-inline-b">
							<fieldset class="col-md-6">
								<!-- REQUIERE VOC : -->
							     <div class="form-group">
							        <label for="pr_requiere_voc_ori" class="col-md-3 control-label">Requiere VOC:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_voc_ori" name="pr_requiere_voc_ori">
											    <option value="">Seleccionar...</option>
											    <option value="Si">Si</option>
			  									<option value="No">No</option>   												
			  									<option value="No aplica">No aplica</option> 	    
											</select>
							            </div>
							        </div>
							    </div>

							    
							</fieldset>
							<fieldset class="col-md-6">
								<!-- PROGRAMACIÓN DE VOC : -->
							     <div class="form-group">
							        <label for="pr_programacion_voc_ori" class="col-md-3 control-label">Programación de VOC:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_programacion_voc_ori" name="pr_programacion_voc_ori">
											    <option value="">Seleccionar...</option>
											    <option value="Programada">Programada</option>
			  									<option value="No requiere programación">No requiere programación</option>   												
			  									<option value="No programada. Otra ciudad">No programada. Otra ciudad</option> 	    
			  									<option value="No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto">No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
											</select>
							            </div>
							        </div>
							    </div>
							</fieldset>
						</div>

						<legend class="f-s-15">REQUERIMIENTOS PARA ENTREGA DEL SERVICIO ORIGEN</legend>
						<div class="d-inline-b">
							<fieldset class="col-md-6">
								<!-- REQUIERE RFC : -->
							     <div class="form-group">
							        <label for="pr_requiere_rfc_ori" class="col-md-3 control-label">Requiere RFC:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_rfc_ori" name="pr_requiere_rfc_ori">
											    <option value="">Seleccionar...</option>
											    <option value="SI => Cliente Critico Punto Central">SI => Cliente Critico Punto Central</option>
			  									<option value="SI => Servicio Critico (Listado)">SI => Servicio Critico (Listado)</option>  												
			  									<option value="SI => Cliente Critico">SI => Cliente Critico</option> 	    
			  									<option value="SI => RFC Estándar Saturación">SI => RFC Estándar Saturación</option>
			  									<option value="SI => Cliente Critico Punto Central - RFC Estándar Saturación">SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
			  									<option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

								<!-- Conversor Medio: -->
					            <div class="form-group">
							        <label for="pr_conversor_medio_ori" class="col-md-3 control-label">Conversor Medio:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_conversor_medio_ori" id="pr_conversor_medio_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>
							</fieldset>
							<fieldset class="col-md-6">
								<!-- Referencia Router: -->
					            <div class="form-group">
							        <label for="pr_referencia_router_ori" class="col-md-3 control-label">Referencia Router:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
							                <input name="pr_referencia_router_ori" id="pr_referencia_router_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>

							    <!-- Modulos o Tarjetas: -->
					            <div class="form-group">
							        <label for="pr_modulos_tarjetas_ori" class="col-md-3 control-label">Modulos o Tarjetas:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_modulos_tarjetas_ori" id="pr_modulos_tarjetas_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>
							</fieldset>
						</div>
						<div class="d-inline-b">
							<fieldset class="col-md-6">
									<!-- Licencias --> 
							    <div class="form-group">
							        <label for="pr_licencias_ori" class="col-md-3 control-label">Licencias:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_licencias_ori" id="pr_licencias_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>

							    <!-- Equipos Adicionale--> 
							    <div class="form-group">
							        <label for="pr_equipos_adicionales_ori" class="col-md-3 control-label">Equipos adicionale:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_equipos_adicionales_ori" id="pr_equipos_adicionales_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>
							</fieldset>
							<fieldset class="col-md-6">
								 <!-- Consumibles:--> 
							    <div class="form-group">
							        <label for="pr_consumibles_ori" class="col-md-3 control-label">Consumibles:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_consumibles_ori" name="pr_consumibles_ori">
											    <option value="">Seleccionar...</option>
											    <option value="Bandeja">Bandeja</option>
			  									<option value="Cables de Poder ">Cables de Poder </option>
			  									<option value="Clavijas de Conexión">Clavijas de Conexión</option>
			  									<option value="Accesorios para rackear (Orejas)">Accesorios para rackear (Orejas)</option>
			  									<option value="No Aplica">No Aplica</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
							     <div class="form-group">
							        <label for="pr_carta_valorizada_ori" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_carta_valorizada_ori" name="pr_carta_valorizada_ori">
											    <option value="">Seleccionar...</option>
											    <option>Si</option>
			  									<option>No</option>
											</select>
							            </div>
							        </div>
							    </div>
							</fieldset>
						</div>

						<legend class="f-s-15">APRUEBA COSTOS DE OC Y CIERRE DE ORDEN DE TRABAJO</legend>
						<div class="d-inline-b">
							<fieldset class="col-md-6">
								<!-- NOMBRE --> 
							    <div class="form-group">
							        <label for="pr_nombre_1_ori" class="col-md-3 control-label">Nombre:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
							                <input name="pr_nombre_1_ori" id="pr_nombre_1_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>

							    <!-- TELEFONO --> 
							    <div class="form-group">
							        <label for="pr_telefono_1_ori" class="col-md-3 control-label">Telefono:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
							                <input name="pr_telefono_1_ori" id="pr_telefono_1_ori" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</fieldset>
							<fieldset class="col-md-6">
								<!-- CELULAR --> 
							    <div class="form-group">
							        <label for="pr_celular_1_ori" class="col-md-3 control-label">Celular:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone glyphicon-edit" ></i></span>
							                <input name="pr_celular_1_ori" id="pr_celular_1_ori" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>

							    <!-- EMAIL --> 
							    <div class="form-group">
							        <label for="pr_correo_1_ori" class="col-md-3 control-label">Email:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
							                <input name="pr_correo_1_ori" id="pr_correo_1_ori" class="form-control" type="email" >
							            </div>
							        </div>
							    </div>
							</fieldset>
						</div>

						<legend class="f-s-15">DATOS CLIENTE: TÉCNICO</legend>
						<div class="d-inline-b">
							<fieldset class="col-md-6">
								<!-- NOMBRE --> 
							    <div class="form-group">
							        <label for="pr_nombre_2_ori" class="col-md-3 control-label">Nombre:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
							                <input name="pr_nombre_2_ori" id="pr_nombre_2_ori" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>

							    <!-- TELEFONO --> 
							    <div class="form-group">
							        <label for="pr_telefono_2_ori" class="col-md-3 control-label">Telefono:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
							                <input name="pr_telefono_2_ori" id="pr_telefono_2_ori" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</fieldset>
							<fieldset class="col-md-6">
								 <!-- CELULAR --> 
							    <div class="form-group">
							        <label for="pr_celular_2_ori" class="col-md-3 control-label">Celular:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
							                <input name="pr_celular_2_ori" id="pr_celular_2_ori" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>

							    <!-- EMAIL --> 
							    <div class="form-group">
							        <label for="pr_correo_2_ori" class="col-md-3 control-label">Email:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
							                <input name="pr_correo_2_ori" id="pr_correo_2_ori" class="form-control" type="email" >
							            </div>
							        </div>
							    </div>
							</fieldset>
						</div>
						<div class="d-inline-b">
							<fieldset class="col-md-12">
							    <!-- OBSERVACIONES: --> 
							    <div class="form-group">
							        <label for="pr_observaciones_1_ori" class="col-md-3 control-label">Observaciones:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <textarea name="pr_observaciones_1_ori" id="pr_observaciones_1_ori" class="form-control" ></textarea>
							            </div>
							        </div>
							    </div>
							</fieldset>
						</div>
					</div>		
				</div>

            `;
        },

        /*NOVEDADES*/
        formProduct_novedades: function() {
            return `
				<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario Cierre de Kickoff  <small>NOVEDADES</small></h2>
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<legend class="f-s-15">DATOS BASICOS DE INSTALACIÓN</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- CIUDAD -->
							<div class="form-group">
						        <label for="pr_ciudad" class="col-md-3 control-label">Ciudad:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-globe" ></i></span>
						                <input name="pr_ciudad" id="pr_ciudad" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- DIRECCIÓN UBICACIÓN ACTUAL DEL SERVICIO:-->
						    <div class="form-group">
						        <label for="pr_ubicacion_actual" class="col-md-3 control-label">Dirección ubicación actual del servicio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
						                <input name="pr_ubicacion_actual" id="pr_ubicacion_actual" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- ALIAS DEL LUGAR:-->
						    <div class="form-group">
						        <label for="pr_alias_lugar" class="col-md-3 control-label">Alias del lugar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
						                <input name="pr_alias_lugar" id="pr_alias_lugar" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>


						    <!-- otp_asociadas -->
							<div class="form-group">
						        <label for="pr_otp_asociada" class="col-md-3 control-label">OTP asociadas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_otp_asociada" id="pr_otp_asociada" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- TIPO DE NOVEDAD: -->
						     <div class="form-group">
						        <label for="pr_tipo_novedad" class="col-md-3 control-label">Tipo de novedad:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_novedad" name="pr_tipo_novedad">
										    <option value="">Seleccionar...</option>
										    <option value="Cambio de BW < 100 MEGAS">Cambio de BW < 100 MEGAS</option>
	      									<option value="Cambio de BW > 100 MEGAS">Cambio de BW > 100 MEGAS</option>
	      									<option value="Cambio de Servicio Internet BA a Internet Empresarial">Cambio de Servicio Internet BA a Internet Empresarial</option>
	      									<option value="Cambio de Servicio Internet BA a Internet Dedicado">Cambio de Servicio Internet BA a Internet Dedicado</option>
	      									<option value="Cambio de Servicio Internet Empresarial a Internet Dedicado">Cambio de Servicio Internet Empresarial a Internet Dedicado</option>
	      									<option value="Cambio de Servicio Internet Dedicado a Empresarial">Cambio de Servicio Internet Dedicado a Empresarial</option>
	      									<option value="Cambio de Servicio MPLS Avanzado a Internet Dedicado">Cambio de Servicio MPLS Avanzado a Internet Dedicado</option>
	      									<option value="Cambio de Servicio MPLS Avanzado a Internet BA">Cambio de Servicio MPLS Avanzado a Internet BA</option>
	      									<option value="Cambio de Servicio MPLS Avanzado Intranet a Extranet">Cambio de Servicio MPLS Avanzado Intranet a Extranet</option>
	      									<option value="Cambio de Servicio MPLS Avanzado Extranet a Intranet">Cambio de Servicio MPLS Avanzado Extranet a Intranet</option>
	      									<option value="Cambio de Servicio MPLS Avanzado MPLS Avanzado a PL Ethernet">Cambio de Servicio MPLS Avanzado MPLS Avanzado a PL Ethernet</option>
	      									<option value="Cambio de Servicio MPLS Avanzado PL Ethernet a MPLS Avanzado">Cambio de Servicio MPLS Avanzado PL Ethernet a MPLS Avanzado</option>
	      									<option value="Cambio de Servicio de Private Line Service a PL Ethernet">Cambio de Servicio de Private Line Service a PL Ethernet</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea Análoga a Linea SIP ((Troncal IP Ethernet con Audiocodec o GW Cisco)">Cambio de Servicio Telefonia Pública Linea Análoga a Linea SIP ((Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea Análoga a Linea SIP (Centralizada)">Cambio de Servicio Telefonia Pública Linea Análoga a Linea SIP (Centralizada)</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea Análoga a Linea E1 - R2">Cambio de Servicio Telefonia Pública Linea Análoga a Linea E1 - R2</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea Análoga a Linea E1 - PRI">Cambio de Servicio Telefonia Pública Linea Análoga a Linea E1 - PRI</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) a  Linea SIP (Centralizado)">Cambio de Servicio Telefonia Pública Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) a  Linea SIP (Centralizado)</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) a  Linea E1 R2">Cambio de Servicio Telefonia Pública Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) a  Linea E1 R2</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) a  Linea E1 PRI">Cambio de Servicio Telefonia Pública Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) a  Linea E1 PRI</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) a  Linea Análoga">Cambio de Servicio Telefonia Pública Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) a  Linea Análoga</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea E1-R2 a Linea SIP (Centralizada)">Cambio de Servicio Telefonia Pública Linea E1-R2 a Linea SIP (Centralizada)</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea E1-PRI a Linea SIP (Centralizada)">Cambio de Servicio Telefonia Pública Linea E1-PRI a Linea SIP (Centralizada)</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea E1-R2 a Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)">Cambio de Servicio Telefonia Pública Linea E1-R2 a Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea E1-PRI a Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)">Cambio de Servicio Telefonia Pública Linea E1-PRI a Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea E1-R2 a Linea Análoga">Cambio de Servicio Telefonia Pública Linea E1-R2 a Linea Análoga</option>
	      									<option value="Cambio de Servicio Telefonia Pública Linea E1-PRI a Linea Análoga">Cambio de Servicio Telefonia Pública Linea E1-PRI a Linea Análoga</option>
	      									<option value="Cambio de Servicio Telefonia Pública a PBX Distribuida">Cambio de Servicio Telefonia Pública a PBX Distribuida</option>
	      									<option value="Adición / Retiro  de números - Adición Canales">Adición / Retiro  de números - Adición Canales</option>
	      									<option value="Adición / Retiro  de números - Adición DID">Adición / Retiro  de números - Adición DID</option>
	      									<option value="Adición / Retiro  de números - Retiro Canales">Adición / Retiro  de números - Retiro Canales</option>
	      									<option value="Adición / Retiro  de números - Retiro DID">Adición / Retiro  de números - Retiro DID</option>
	      									<option value="Adición de  Extensiones (teléfonos)">Adición de  Extensiones (teléfonos)</option>
	      									<option value="Retiro de  Extensiones (teléfonos)">Retiro de  Extensiones (teléfonos)</option>
	      									<option value="Cambio NDS">Cambio NDS</option>
	      									<option value="Adición de equipos">Adición de equipos</option>
	      									<option value="Retiro de equipos">Retiro de equipos</option>
	      									<option value="Cambio de equipos">Cambio de equipos</option>
	      									<option value="Cambio Tipo de Acceso, Servicio y Ampliación">Cambio Tipo de Acceso, Servicio y Ampliación</option>
	      									<option value="Novedad Solución Administrada - Videoconferencia Administrada">Novedad Solución Administrada - Videoconferencia Administrada</option>
	      									<option value="Novedad Solución Administrada - Videoseguridad Administrada">Novedad Solución Administrada - Videoseguridad Administrada</option>
	      									<option value="Novedad Solución Administrada - LAN Administrada">Novedad Solución Administrada - LAN Administrada</option>
	      									<option value="Novedad Solución Administrada - Hotspot">Novedad Solución Administrada - Hotspot</option>
	      									<option value="Novedad Solución Administrada - WI - FI">Novedad Solución Administrada - WI - FI</option>
	      									<option value="Novedad Solución Administrada - Grabación de Voz">Novedad Solución Administrada - Grabación de Voz</option>
	      									<option value="Cambio Tipo de Acceso (Migración)">Cambio Tipo de Acceso (Migración)</option>
	      									<option value="($) Cambio Tipo de Acceso con Costo">($) Cambio Tipo de Acceso con Costo</option>
	      								</select>
						            </div>
						        </div>
						    </div>	

						    <!-- TIPO DE SERVICIO A MODIFICAR: -->
						     <div class="form-group">
						        <label for="pr_servicio_modificar" class="col-md-3 control-label">Tipo de servicio a modificar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_servicio_modificar" name="pr_servicio_modificar">
										    <option value="">Seleccionar...</option>
										    <option value="Internet Dedicado con diferenciación de tráfico (Internet / NAP)">Internet Dedicado con diferenciación de tráfico (Internet / NAP)</option>
	      									<option value="Internet Dedicado + Monitoreo CPE (Gestion Proactiva)">Internet Dedicado + Monitoreo CPE (Gestion Proactiva)</option>
	      									<option value="Internet Dedicado Administrado + Monitoreo CPE (Gestion Proactiva)">Internet Dedicado Administrado + Monitoreo CPE (Gestion Proactiva)</option>
	      									<option value="Internet Dedicado Empresarial">Internet Dedicado Empresarial</option>
	      									<option value="Internet  Banda ancha FO">Internet  Banda ancha FO</option>
	      									<option value="MPLS Avanzado Intranet  + Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado Intranet  + Monitoreo CPE (Gestión Proactiva)</option>
	      									<option value="MPLS Avanzado Extranet  + Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado Extranet  + Monitoreo CPE (Gestión Proactiva)</option>
	      									<option value="MPLS Avanzado con Punta Backend">MPLS Avanzado con Punta Backend</option>
	      									<option value="MPLS Avanzado con Punta en Rack de Appliance (Componente Datacenter)">MPLS Avanzado con Punta en Rack de Appliance (Componente Datacenter)</option>
	      									<option value="MPLS Avanzado con Punta Claro Connect">MPLS Avanzado con Punta Claro Connect</option>
	      									<option value="MPLS Transaccional">MPLS Transaccional</option>
	      									<option value="Telefonia Pública - Líneas Análogas">Telefonia Pública - Líneas Análogas</option>
	      									<option value="Telefonia Pública - Líneas E1 - R2">Telefonia Pública - Líneas E1 - R2</option>
	      									<option value="Telefonia Pública - Líneas E1 - PRI">Telefonia Pública - Líneas E1 - PRI</option>
	      									<option value="Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)">Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
	      									<option value="Telefonia Pública - Línea SIP (Centralizado)">Telefonia Pública - Línea SIP (Centralizado)</option>
	      									<option value="PBX Distribuida - Línea SIP  (Troncal IP Ethernet con Audiocodec o GW Cisco)">PBX Distribuida - Línea SIP  (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
	      									<option value="PBX Distribuida - Línea SIP  (Centralizado)">PBX Distribuida - Línea SIP  (Centralizado)</option>
	      									<option value="PBX Distribuida  Linea E1 -R2">PBX Distribuida  Linea E1 -R2</option>
	      									<option value="PBX Distribuida  Linea E1 -PRI">PBX Distribuida  Linea E1 -PRI</option>
	      									<option value="Telefonia Corporativa">Telefonia Corporativa</option>
	      									<option value="Local - P2P">Local - P2P</option>
	      									<option value="Local - P2MP">Local - P2MP</option>
	      									<option value="Nacional - P2P">Nacional - P2P</option>
	      									<option value="Nacional - P2MP">Nacional - P2MP</option>
	      									<option value="VPRN">VPRN</option>
	      								</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- ANCHO DE BANDA : -->
							<div class="form-group">
						        <label for="pr_ancho_banda" class="col-md-3 control-label">Ancho de banda:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ancho_banda" id="pr_ancho_banda" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						   	 

							<!-- TIPO DE ACTIVIDAD: -->
						     <div class="form-group">
						        <label for="pr_tipo_actividad" class="col-md-3 control-label">Tipo actividad:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_actividad" name="pr_tipo_actividad">
										    <option value="">Seleccionar...</option>
										    <option value="Instalar UM con PE">Instalar UM con PE</option>
	      									<option value="Instalar UM con CT">Instalar UM con CT</option> 												
	      									<option value="Instalar UM con HFC">Instalar UM con HFC</option> 	    
	      									<option value="Instalar UM con 3G">Instalar UM con 3G</option>
	      									<option value="Instalar UM en Datacenter Claro- Cableado">Instalar UM en Datacenter Claro- Cableado</option>
	      									<option value="Cambio de Nodo">Cambio de Nodo</option>
	      									<option value="Cambio de Plataforma">Cambio de Plataforma</option>
	      									<option value="No requiere Cambio de UM">No requiere Cambio de UM</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- ID SERVICIO ACTUAL (Aplica para UM Existente): -->
							<div class="form-group">
						        <label for="pr_servicio_actual" class="col-md-3 control-label">ID servicio actual (Aplica para UM Existente):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_servicio_actual" id="pr_servicio_actual" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						   
						</fieldset>
						<fieldset class="col-md-6">
							 <!-- REQUIERE LIBERACIÓN DE RECURSOS DE ULTIMA MILLA SEDE ANTIGUA(PROVEEDOR TERCERO) -->
						    <div class="form-group">
						        <label for="pr_liberacion_um" class="col-md-3 control-label">Requiere liberación de recursos ultima milla sede antigua(proveedor tercero):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_liberacion_um" name="pr_liberacion_um">
										    <option value="">Seleccionar...</option>
										    <option value="SI - Generar Tarea de Desconexión Tercero al finalizar el Cambio Tipo de Acceso">SI - Generar Tarea de Desconexión Tercero al finalizar el Cambio Tipo de Acceso</option>
	      									<option value="NO - Recursos de UM Propia en Sede Antigua">NO - Recursos de UM Propia en Sede Antigua</option> 
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
					<legend class="f-s-15">Información ultima milla</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
						     <div class="form-group">
						        <label for="pr_requiere_um" class="col-md-3 control-label">¿requiere instalacion UM?:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_um" name="pr_requiere_um">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>   	    
										</select>
						            </div>
						        </div>
						    </div>
							
							<!-- PROVEEDOR: -->
						    <div class="form-group">
						        <label for="pr_proveedor" class="col-md-3 control-label">Proveedor:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_proveedor" name="pr_proveedor">
										    <option value="">Seleccionar...</option>
										    <option value="Claro">Claro</option>
	      									<option value="Axesat">Axesat</option>
	      									<option value="Comcel">Comcel</option> 	
	      									<option value="Tigo">Tigo</option>       											
	      									<option value="Media Commerce">Media Commerce</option> 		
	      									<option value="Diveo">Diveo</option>
	      									<option value="Edatel">Edatel</option> 	
	      									<option value="UNE">UNE</option> 		
	      									<option value="ETB">ETB</option> 	
	      									<option value="IBM">IBM</option> 		
	      									<option value="IFX">IFX</option> 		
	      									<option value="Level 3 Colombia">Level 3 Colombia</option>
	      									<option value="Mercanet">Mercanet</option> 	
	      									<option value="Metrotel">Metrotel</option> 		
	      									<option value="Promitel">Promitel</option> 		
	      									<option value="Skynet">Skynet</option> 		
	      									<option value="Telebucaramanga">Telebucaramanga</option>
	      									<option value="Telecom">Telecom</option> 	
	      									<option value="Terremark">Terremark</option> 		
	      									<option value="Sol Cable Vision">Sol Cable Vision</option> 		
	      									<option value="Sistelec">Sistelec</option>
	      									<option value="Opain">Opain</option> 	
	      									<option value="Airplan - (Información y Tecnologia)">Airplan - (Información y Tecnologia)</option> 		
	      									<option value="TV Azteca">TV Azteca</option> 						    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- MEDIO -->
						    <div class="form-group">
						        <label for="pr_medio" class="col-md-3 control-label">Medio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_medio" name="pr_medio">
										    <option value="">Seleccionar...</option>
										    <option value="No Aplica">No Aplica</option>     
										    <option value="Fibra">Fibra</option>
										    <option value="Cobre">Cobre</option>
										    <option value="Satelital">Satelital</option> 
										    <option value="Radio enlace">Radio enlace</option>
										    <option value="3G">3G</option>
										    <option value="UTP">UTP</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- RESPUESTA FACTIBILIDAD BW >100 MEGAS: -->
						    <div class="form-group">
						        <label for="pr_factibilidad_bw" class="col-md-3 control-label">Respuesta factibilidad BW > 100 Megas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_factibilidad_bw" id="pr_factibilidad_bw" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<legend class="f-s-15">ACCESO (Solo Aplica para Canales > 100 MEGAS</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- SDS DESTINO (Unifilar): -->
						     <div class="form-group">
						        <label for="pr_sds_destino" class="col-md-3 control-label">SDS destino (Unifilar):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
						                <input name="pr_sds_destino" id="pr_sds_destino" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- OLT (GPON): -->
						     <div class="form-group">
						        <label for="pr_olt" class="col-md-3 control-label">OLT(GPON):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_olt" id="pr_olt" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- INTERFACE DE ENTREGA AL CLIENTE:-->
						    <div class="form-group">
						        <label for="pr_interfaz_entrega_cliente" class="col-md-3 control-label">Interface de entrega al cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_interfaz_entrega_cliente" name="pr_interfaz_entrega_cliente">
										    <option value="">Seleccionar...</option>
										    <option value="No aplica">No aplica</option>     
										    <option value="Ethernet">Ethernet</option>
										    <option value="Serial V.35">Serial V.35</option>
										    <option value="Giga (óptico)">Giga (óptico)</option> 
										    <option value="Giga Ethernet (Electrico)">Giga Ethernet (Electrico)</option>
										    <option value="STM-1">STM-1</option>
										    <option value="RJ45 - 120 OHM">RJ45 - 120 OHM</option>
										    <option value="G703 BNC">G703 BNC</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- REQUIERE VOC : -->
						     <div class="form-group">
						        <label for="pr_requiere_voc" class="col-md-3 control-label">Requiere VOC:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_voc" name="pr_requiere_voc">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option> 	    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- PROGRAMACIÓN DE VOC : -->
						     <div class="form-group">
						        <label for="pr_programacion_voc" class="col-md-3 control-label">Programación de VOC:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_programacion_voc" name="pr_programacion_voc">
										    <option value="">Seleccionar...</option>
										    <option value="Programada">Programada</option>
	      									<option value="No requiere programación">No requiere programación</option>   												
	      									<option value="No programada. Otra ciudad">No programada. Otra ciudad</option> 	    
	      									<option value="No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto">No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
										</select>
						            </div>
						        </div>
						    </div>

						</fieldset>
						<fieldset class="col-md-6">
						    <!-- REQUIERE LIBERACIÓN DE RECURSOS DE ULTIMA MILLA (FO) EN SEDE ANTIGUA -->
						     <div class="form-group">
						        <label for="pr_liberacion_um_fo" class="col-md-3 control-label">Requiere liberación de recursos de ultima milla (FO) sede antigua:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_liberacion_um_fo" name="pr_liberacion_um_fo">
										    <option value="">Seleccionar...</option>
										    <option value="SI - Generar Tarea para Retirar recursos de Ultima Milla en Sede Antigua">SI - Generar Tarea para Retirar recursos de Ultima Milla en Sede Antigua</option>
	      									<option value="NO - Cliente no requiere liberación de Consumibles FO">NO - Cliente no requiere liberación de Consumibles FO</option>   	
	      									<option value="NA">NA</option>
										</select>
						            </div>
						        </div>
						    </div>							
						</fieldset>
					</div>

					<legend class="f-s-15">REQUERIMIENTOS PARA ENTREGA DEL SERVICIO</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- REQUIERE VENTANA DE MTTO -->
						     <div class="form-group">
						        <label for="pr_requiere_ventana_mtto" class="col-md-3 control-label">Requiere ventana de MTTO:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_ventana_mtto" name="pr_requiere_ventana_mtto">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option> 
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- REQUIERE RFC:-->
						     <div class="form-group">
						        <label for="pr_requiere_rfc" class="col-md-3 control-label">Requiere RFC:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_rfc" name="pr_requiere_rfc">
										    <option value="">Seleccionar...</option>
										    <option value="SI => Cliente Critico Punto Central">SI => Cliente Critico Punto Central</option>
	      									<option value="SI => Servicio Critico (Listado)">SI => Servicio Critico (Listado)</option> 
	      									<option value="SI => Cliente Critico">SI => Cliente Critico</option>
	      									<option value="SI => RFC Estándar Saturación">SI => RFC Estándar Saturación</option>
	      									<option value="SI => Cliente Critico Punto Central - RFC Estándar Saturación">SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
	      									<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- Conversor Medio: -->
				            <div class="form-group">
						        <label for="pr_conversor_medio" class="col-md-3 control-label">Conversor Medio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_conversor_medio" id="pr_conversor_medio" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Referencia Router: -->
				            <div class="form-group">
						        <label for="pr_referencia_router" class="col-md-3 control-label">Referencia Router:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
						                <input name="pr_referencia_router" id="pr_referencia_router" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- Modulos o Tarjetas: -->
				            <div class="form-group">
						        <label for="pr_modulos_tarjetas" class="col-md-3 control-label">Modulos o Tarjetas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_modulos_tarjetas" id="pr_modulos_tarjetas" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Licencias --> 
						    <div class="form-group">
						        <label for="pr_licencias" class="col-md-3 control-label">Licencias:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_licencias" id="pr_licencias" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- Equipos Adicionale--> 
						    <div class="form-group">
						        <label for="pr_equipos_adicionales" class="col-md-3 control-label">Equipos adicionale:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_equipos_adicionales" id="pr_equipos_adicionales" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Consumibles:--> 
						    <div class="form-group">
						        <label for="pr_consumibles" class=" ">Consumibles:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_consumibles" name="pr_consumibles">
										    <option value="">Seleccionar...</option>
										    <option value="Bandeja">Bandeja</option>
	      									<option value="Cables de Poder ">Cables de Poder </option>
	      									<option value="Clavijas de Conexión">Clavijas de Conexión</option>
	      									<option value="Accesorios para rackear (Orejas)">Accesorios para rackear (Orejas)</option>
	      									<option value="No Aplica">No Aplica</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
						     <div class="form-group">
						        <label for="pr_carta_valorizada" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_carta_valorizada" name="pr_carta_valorizada">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<legend class="f-s-15">DATOS DEL CONTACTO PARA COMUNICACIÓN<small>APRUEBA COSTOS DE OC Y CIERRE DE ORDEN DE TRABAJO</small></legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- NOMBRE --> 
						    <div class="form-group">
						        <label for="pr_nombre_1" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre_1" id="pr_nombre_1" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="pr_telefono_1" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono_1" id="pr_telefono_1" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							 <!-- CELULAR --> 
						    <div class="form-group">
						        <label for="pr_celular_1" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular_1" id="pr_celular_1" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="pr_correo_1" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_correo_1" id="pr_correo_1" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<legend class="f-s-15">DATOS CLIENTE: TÉCNICO</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
								<!-- NOMBRE --> 
						    <div class="form-group">
						        <label for="pr_nombre_2" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre_2" id="pr_nombre_2" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="pr_telefono_2" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono_2" id="pr_telefono_2" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- CELULAR --> 
						    <div class="form-group">
						        <label for="pr_celular_2" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular_2" id="pr_celular_2" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="pr_correo_2" class="col-md-3 control-label">Correo electronico:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_correo_2" id="pr_correo_2" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-12">
							<!-- OBSERVACIONES: --> 
						    <div class="form-group">
						        <label for="pr_observaciones" class="col-md-3 control-label">Observaciones:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <textarea name="pr_observaciones" id="pr_observaciones" class="form-control"></textarea>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<legend class="f-s-15">KIKOFF TECNICO  SOLO PARA CAMBIOS DE TELEFONIA</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- Equipo Cliente : -->
						    <div class="form-group">
						        <label for="pr_equipo_cliente" class="col-md-3 control-label">Equipo cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_equipo_cliente" name="pr_equipo_cliente">
										    <option value="">Seleccionar...</option>
										    <option value="Teléfonos analogos">Teléfonos analogos</option>
	      									<option value="Planta E1">Planta E1</option>
										</select>
						            </div>
						        </div>
						    </div>
						    
						    <!-- Interfaz Equipos Cliente: -->
						    <div class="form-group">
						        <label for="pr_interfaz_cliente" class="col-md-3 control-label">Interfaz Equipos Cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_interfaz_cliente" name="pr_interfaz_cliente">
										    <option value="s">Seleccionar...</option>
	      									<option value="FXS">FXS</option>
										    <option value="RJ11">RJ11</option>
	      									<option value="RJ45">RJ45</option>
	      									<option value="RJ48">RJ48</option>
	      									<option value="BNC">BNC</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- Cantidad Lineas Básicas a Adicionar (Solo Telefonia Pública Líneas Análogas): --> 
						    <div class="form-group">
						        <label for="pr_cant_lineas_basicas" class="col-md-3 control-label"><a title="(Solo Telefonia Pública Líneas Análogas)">Cantidad Lineas Básicas a Adicionar:</a></label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_lineas_basicas" id="pr_cant_lineas_basicas" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Conformación PBX (Solo Telefonia Pública Líneas Análogas): -->
						    <div class="form-group">
						        <label for="pr_conformacion_pbx" class="col-md-3 control-label"><a title="(Solo Telefonia Pública Líneas Análogas)">Conformación PBX:</a></label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_conformacion_pbx" name="pr_conformacion_pbx">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							 <!-- Cantidad Lineas Básicas a Adicionar (Solo Telefonia Pública Líneas Análogas): --> 
						    <div class="form-group">
						        <label for="pr_cant_did" class="col-md-3 control-label">Cantidad de DID a Adicionar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_did" id="pr_cant_did" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad Canales a Adicionar: --> 
						    <div class="form-group">
						        <label for="pr_cant_canales" class="col-md-3 control-label">Cantidad Canales a Adicionar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales" id="pr_cant_canales" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- Adición de Lineas de FAX TO MAIL: -->
						    <div class="form-group">
						        <label for="pr_adicion_lineas_fax" class="col-md-3 control-label">Adición de Lineas de FAX TO MAIL:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_adicion_lineas_fax" name="pr_adicion_lineas_fax">
										    <option value="">Seleccionar...</option>
	      									<option>Si</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Adición de Lineas TELEFONO VIRTUAL: -->
						    <div class="form-group">
						        <label for="pr_adicion_lineas_virtual" class="col-md-3 control-label">Adición de Lineas TELEFONO VIRTUAL:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_adicion_lineas_virtual" name="pr_adicion_lineas_virtual">
										    <option value="">Seleccionar...</option>
	      									<option value="Si">Si</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<legend class="f-s-15">Cambio de Telefonia Pública a PBX Distribuida</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							 <!-- Requiere Permisos para Larga Distancia Nacional: -->
						    <div class="form-group">
						        <label for="pr_larga_distancia_nacional" class="col-md-3 control-label">Requiere Permisos para Larga Distancia Nacional:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_larga_distancia_nacional" name="pr_larga_distancia_nacional">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										    <option value="No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff">No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
										</select>
						            </div>
						        </div>
						    </div>


						    <!-- Requiero Larga  Para Distancia  Internacional: -->
						    <div class="form-group">
						        <label for="pr_larga_distancia_internacional" class="col-md-3 control-label">Requiero Larga Para Distancia Internacional:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_larga_distancia_internacional" name="pr_larga_distancia_internacional">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										    <option value="No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff">No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							
							<!-- Requiere Permisos para Móviles: -->
						    <div class="form-group">
						        <label for="pr_permisos_moviles" class="col-md-3 control-label">Requiere Permisos para Móviles:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_permisos_moviles" name="pr_permisos_moviles">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										    <option value="No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff">No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Requiere Permisos para Local Extendida: -->
						    <div class="form-group">
						        <label for="pr_permisos_local_extendida" class="col-md-3 control-label">Requiere Permisos para Local Extendida:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_permisos_local_extendida" name="pr_permisos_local_extendida">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										    <option value="No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff">No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<legend class="f-s-15">NUMERACIÓN SOLO DILIGENCIAR PARA LA OPCIÓN  PBX DISTRIBUIDO</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Bogotá</legend>
								<div class="form-group">
						        <label for="pr_bog_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_bog_requiere" name="pr_bog_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_bog_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_bog_numeracion" name="pr_bog_numeracion">
										    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
										/select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_bog_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_bog_cantidad" id="pr_bog_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Tunja</legend>
								<div class="form-group">
						        <label for="pr_tun_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tun_requiere" name="pr_tun_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_tun_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tun_numeracion" name="pr_tun_numeracion">
										    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
										/select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_tun_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
						                <input name="pr_tun_cantidad" id="pr_tun_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Villavicencio</legend>
								<div class="form-group">
							        <label for="pr_vill_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_vill_requiere" name="pr_vill_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_vill_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_vill_numeracion" name="pr_vill_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_vill_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_vill_cantidad" id="pr_vill_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Facatativa</legend>
								<div class="form-group">
						        <label for="pr_fac_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_fac_requiere" name="pr_fac_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_fac_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_fac_numeracion" name="pr_fac_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_fac_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_fac_cantidad" id="pr_fac_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Girardot</legend>
								<div class="form-group">
						        <label for="pr_gir_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_gir_requiere" name="pr_gir_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_gir_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_gir_numeracion" name="pr_gir_numeracion">
										    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
										/select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_gir_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_gir_cantidad" id="pr_gir_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Yopal</legend>
								<div class="form-group">
						        <label for="pr_yop_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_yop_requiere" name="pr_yop_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_yop_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_yop_numeracion" name="pr_yop_numeracion">
										    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
										/select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_yop_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_yop_cantidad" id="pr_yop_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">cali</legend>
								<div class="form-group">
						        <label for="pr_cali_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_cali_requiere" name="pr_cali_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_cali_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_cali_numeracion" name="pr_cali_numeracion">
										    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
										/select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cali_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cali_cantidad" id="pr_cali_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Buenaventura</legend>
								 <div class="form-group">
						        <label for="pr_bave_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_bave_requiere" name="pr_bave_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_bave_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_bave_numeracion" name="pr_bave_numeracion">
										    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
										/select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_bave_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_bave_cantidad" id="pr_bave_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Pasto</legend>
								<div class="form-group">
						        <label for="pr_pas_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_pas_requiere" name="pr_pas_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_pas_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_pas_numeracion" name="pr_pas_numeracion">
										    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
										/select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_pas_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_pas_cantidad" id="pr_pas_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Popayán</legend>
								<div class="form-group">
						        <label for="pr_pop_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_pop_requiere" name="pr_pop_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_pop_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_pop_numeracion" name="pr_pop_numeracion">
										    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
										/select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_pop_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_pop_cantidad" id="pr_pop_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Neiva</legend>
								<div class="form-group">
						        <label for="pr_nei_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_nei_requiere" name="pr_nei_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_nei_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_nei_numeracion" name="pr_nei_numeracion">
										    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
										/select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_nei_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_nei_cantidad" id="pr_nei_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Medellín</legend>
								<div class="form-group">
						        <label for="pr_med_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_med_requiere" name="pr_med_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_med_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_med_numeracion" name="pr_med_numeracion">
										    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
										/select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_med_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_med_cantidad" id="pr_med_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Barranquilla</legend>
								 <div class="form-group">
						        <label for="pr_bar_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_bar_requiere" name="pr_bar_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_bar_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_bar_numeracion" name="pr_bar_numeracion">
										    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
										/select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_bar_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_bar_cantidad" id="pr_bar_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Cartagena</legend>
								<div class="form-group">
						        <label for="pr_cart_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_cart_requiere" name="pr_cart_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_cart_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_cart_numeracion" name="pr_cart_numeracion">
										    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
										/select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cart_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cart_cantidad" id="pr_cart_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Santa Marta: -->
							    <legend class="f-s-15"> Santa Marta </legend>
							    <div class="form-group">
							        <label for="pr_stm_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_stm_requiere" name="pr_stm_requiere">
											    <option value="">Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_stm_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_stm_numeracion" name="pr_stm_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_stm_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_stm_cantidad" id="pr_stm_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Monteria: -->
							    <legend class="f-s-15"> Monteria </legend>
							    <div class="form-group">
							        <label for="pr_mon_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_mon_requiere" name="pr_mon_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_mon_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_mon_numeracion" name="pr_mon_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_mon_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_mon_cantidad" id="pr_mon_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Valledupar: -->
							    <legend class="f-s-15"> Valledupar </legend>
							    <div class="form-group">
							        <label for="pr_vall_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_vall_requiere" name="pr_vall_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_vall_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_vall_numeracion" name="pr_vall_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_vall_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_vall_cantidad" id="pr_vall_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Sincelejo: -->
							    <legend class="f-s-15"> Sincelejo </legend>
							    <div class="form-group">
							        <label for="pr_sinc_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_sinc_requiere" name="pr_sinc_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    	<option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_sinc_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_sinc_numeracion" name="pr_sinc_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_sinc_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_sinc_cantidad" id="pr_sinc_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Pereira: -->
							    <legend class="f-s-15"> Pereira: </legend>
							    <div class:="form-group">
							        <label for="pr_per_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_per_requiere" name="pr_per_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    	<option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_per_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_per_numeracion" name="pr_per_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_per_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_per_cantidad" id="pr_per_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Armenia: -->
							    <legend class="f-s-15"> Armenia: </legend>
							    <div class:="form-group">
							        <label for="pr_arme_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_arme_requiere" name="pr_arme_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    	<option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_arme_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_arme_numeracion" name="pr_arme_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_arme_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_arme_cantidad" id="pr_arme_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Manizalez: -->
							    <legend class="f-s-15"> Manizalez: </legend>
							    <div class:="form-group">
							        <label for="pr_man_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_man_requiere" name="pr_man_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										        <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_man_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_man_numeracion" name="pr_man_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_man_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_man_cantidad" id="pr_man_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Ibaué: -->
							    <legend class="f-s-15"> Ibaué: </legend>
							    <div class:="form-group">
							        <label for="pr_iba_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_iba_requiere" name="pr_iba_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_iba_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_iba_numeracion" name="pr_iba_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_iba_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_iba_cantidad" id="pr_iba_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Cucutá: -->
							    <legend class="f-s-15"> Cucutá: </legend>
							    <div class:="form-group">
							        <label for="pr_cuc_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_cuc_requiere" name="pr_cuc_requiere">
											    <option value="">Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_cuc_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_cuc_numeracion" name="pr_cuc_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cuc_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cuc_cantidad" id="pr_cuc_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Bucaramanga: -->
							    <legend class="f-s-15"> Bucaramanga: </legend>
							    <div class:="form-group">
							        <label for="pr_buc_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_buc_requiere" name="pr_buc_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_buc_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_buc_numeracion" name="pr_buc_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_buc_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_buc_cantidad" id="pr_buc_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Duitama : -->
							    <legend class="f-s-15"> Duitama : </legend>
							    <div class:="form-group">
							        <label for="pr_dui_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_dui_requiere" name="pr_dui_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_dui_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_dui_numeracion" name="pr_dui_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_dui_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_dui_cantidad" id="pr_dui_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Sogamoso: -->
							    <legend class="f-s-15"> Sogamoso: </legend>
							    <div class:="form-group">
							        <label for="pr_sog_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_sog_requiere" name="pr_sog_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_sog_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_sog_numeracion" name="pr_sog_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_sog_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_sog_cantidad" id="pr_sog_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Flandes: -->
							    <legend class="f-s-15"> Flandes: </legend>
							    <div class:="form-group">
							        <label for="pr_flan_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_flan_requiere" name="pr_flan_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_flan_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_flan_numeracion" name="pr_flan_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_flan_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_flan_cantidad" id="pr_flan_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Rivera: -->
							    <legend class="f-s-15"> Rivera: </legend>
							    <div class:="form-group">
							        <label for="pr_riv_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_riv_requiere" name="pr_riv_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_riv_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_riv_numeracion" name="pr_riv_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_riv_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_riv_cantidad" id="pr_riv_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Aipe -->
							    <legend class="f-s-15"> Aipe </legend>
							    <div class:="form-group">
							        <label for="pr_aipe_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_aipe_requiere" name="pr_aipe_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_aipe_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_aipe_numeracion" name="pr_aipe_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_aipe_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_aipe_cantidad" id="pr_aipe_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Lebrija: -->
							    <legend class="f-s-15"> Lebrija: </legend>
							    <div class:="form-group">
							        <label for="pr_leb_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_leb_requiere" name="pr_leb_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI (Debe esta firmado por el Cliente en el Survey o AOS)">SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_leb_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_leb_numeracion" name="pr_leb_numeracion">
											    <option value="">Seleccionar...</option>
												<option value="SI">SI</option>
												<option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
												<option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_leb_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_leb_cantidad" id="pr_leb_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>
				</div>
            `;
        },

        /*TRASLADO EXTERNO*/
        formProduct_traslado_externo: function(otp) {
            return `
				<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario Cierre de Kickoff  <small>TRASLADO EXTERNO</small></h2>
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<!-- Primera sesion --> 
					<legend class="f-s-15">DATOS BASICOS</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
						
							<!-- CIUDAD -->
							<div class="form-group">
						        <label for="pr_ciudad" class="col-md-3 control-label">Ciudad:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-globe" ></i></span>
						                <input name="pr_ciudad" id="pr_ciudad" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- DIRECCIÓN UBICACIÓN ACTUAL DEL SERVICIO:-->
						    <div class="form-group">
						        <label for="pr_ubicacion_actual" class="col-md-3 control-label">Dirección actual del servicio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
						                <input name="pr_ubicacion_actual" id="pr_ubicacion_actual" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- DIRECCIÓN DONDE SE TRASLADARA EL SERVICIO:-->
						    <div class="form-group">
						        <label for="pr_ubicacion_traslado" class="col-md-3 control-label">Dirección donde se trasladará servicio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
						                <input name="pr_ubicacion_traslado" id="pr_ubicacion_traslado" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TIPO PREDIO: -->
						    <div class="form-group">
						        <label for="pr_tipo_predio" class="col-md-3 control-label">Tipo predio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
						                <select class="form-control" id="pr_tipo_predio" name="pr_tipo_predio">
										    <option value="">Seleccionar...</option>
										    <option value="Edificio">Edificio</option>
	      									<option value="Casa">Casa</option>									    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>		
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- NIT del cliente: -->
						    <div class="form-group">
						        <label for="pr_nit_cliente" class="col-md-3 control-label">NIT del cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
						                <input name="pr_nit_cliente" id="pr_nit_cliente" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>


						    <!-- ALIAS DEL LUGAR  -->
						    <div class="form-group">
						        <label for="pr_alias_lugar" class="col-md-3 control-label">Alias del lugar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
						                <input name="pr_alias_lugar" id="pr_alias_lugar" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- OTP -->
							<div class="form-group">
						        <label for="pr_id_ot_padre" class="col-md-3 control-label">OTP:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_id_ot_padre" id="pr_id_ot_padre" class="form-control" type="text" value="${otp}" readonly>
						            </div>
						        </div>
						    </div>

						    <!-- OTP_ASOCIADAS -->
							<div class="form-group">
						        <label for="pr_otp_asociada" class="col-md-3 control-label">OTP asociadas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_otp_asociada" id="pr_otp_asociada" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- CANTIDAD DE SERVICIOS A TRASLADAR: -->
							<div class="form-group">
						        <label for="pr_cant_servicios_trasladar" class="col-md-3 control-label">Cantidad de servicios a trasladar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
						                <input name="pr_cant_servicios_trasladar" id="pr_cant_servicios_trasladar" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- CODIGOS DE SERVICIO  A TRASLADAR: -->
							<div class="form-group">
						        <label for="pr_cod_servicio_trasladar" class="col-md-3 control-label">Códigos de servicio a trasladar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
						                <input name="pr_cod_servicio_trasladar" id="pr_cod_servicio_trasladar" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- TIPO DE TRASLADO EXTERNO: -->
							<div class="form-group">
								<label for="pr_tipo_traslado" class="col-md-3 control-label">Tipo de traslado externo:</label>
								<div class="col-md-9 selectContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								        <select class="form-control" id="pr_tipo_traslado" name="pr_tipo_traslado">
										    <option value="">Seleccionar...</option>
										    <option value="Estándar - Se recogen equipos en Sede Antigua y se llevan a sede Nueva">Estándar - Se recogen equipos en Sede Antigua y se llevan a sede Nueva</option>
											<option value="Paralelo - Se habilitan Nuevos Recursos de UM, Equipos, Config">Paralelo - Se habilitan Nuevos Recursos de UM, Equipos, Config</option>
										</select>
								    </div>
								</div>
							</div>	

							<!--TIPO DE SERVICIO: -->
							<div class="form-group">
								<label for="pr_tipo_servicio" class="col-md-3 control-label">Tipo de servicio:</label>
								<div class="col-md-9 selectContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								        <select class="form-control" id="pr_tipo_servicio" name="pr_tipo_servicio">
										    <option value="">Seleccionar...</option>
										    <option value="Internet Dedicado con diferenciación de tráfico (Internet / NAP)">Internet Dedicado con diferenciación de tráfico (Internet / NAP)</option>
											<option value="Internet Dedicado + Monitoreo CPE (Gestion Proactiva)">Internet Dedicado + Monitoreo CPE (Gestion Proactiva)</option>
											<option value="Internet Dedicado Administrado + Monitoreo CPE (Gestion Proactiva)">Internet Dedicado Administrado + Monitoreo CPE (Gestion Proactiva)</option>
											<option value="Internet Dedicado Empresarial">Internet Dedicado Empresarial</option>
											<option value="Internet  Banda ancha FO">Internet  Banda ancha FO</option>
											<option value="MPLS Avanzado Intranet  + Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado Intranet  + Monitoreo CPE (Gestión Proactiva)</option>
											<option value="MPLS Avanzado Extranet  + Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado Extranet  + Monitoreo CPE (Gestión Proactiva)</option>
											<option value="MPLS Avanzado con Punta Backend">MPLS Avanzado con Punta Backend</option>
											<option value="MPLS Avanzado con Punta en Rack de Appliance (Componente Datacenter)">MPLS Avanzado con Punta en Rack de Appliance (Componente Datacenter)</option>
											<option value="MPLS Avanzado con Punta Claro Connect">MPLS Avanzado con Punta Claro Connect</option>
											<option value="MPLS Transaccional">MPLS Transaccional</option>
											<option value="Telefonia Pública - Líneas Análogas">Telefonia Pública - Líneas Análogas</option>
											<option value="Telefonia Pública - Líneas E1 - R2">Telefonia Pública - Líneas E1 - R2</option>
											<option value="Telefonia Pública - Líneas E1 - PRI">Telefonia Pública - Líneas E1 - PRI</option>
											<option value="Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)">Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
											<option value="Telefonia Pública - Línea SIP (Centralizado)">Telefonia Pública - Línea SIP (Centralizado)</option>
											<option value="PBX Distribuida - Línea SIP  (Troncal IP Ethernet con Audiocodec o GW Cisco)">PBX Distribuida - Línea SIP  (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
											<option value="PBX Distribuida - Línea SIP  (Centralizado)">PBX Distribuida - Línea SIP  (Centralizado)</option>
											<option value="PBX Distribuida  Linea E1 -R2">PBX Distribuida  Linea E1 -R2</option>
											<option value="PBX Distribuida  Linea E1 -PRI">PBX Distribuida  Linea E1 -PRI</option>
											<option value="Telefonia Corporativa">Telefonia Corporativa</option>
											<option value="Local - P2P">Local - P2P</option>
											<option value="Local - P2MP">Local - P2MP</option>
											<option value="Nacional - P2P">Nacional - P2P</option>
											<option value="Nacional - P2MP">Nacional - P2MP</option>
											<option value="VPRN">VPRN</option>
											</select>
								    </div>
								</div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- ANCHO DE BANDA : -->
							<div class="form-group">
						        <label for="pr_ancho_banda" class="col-md-3 control-label">Ancho de banda:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ancho_banda" id="pr_ancho_banda" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
					    

							<!-- TIPO DE ACTIVIDAD: -->
						     <div class="form-group">
						        <label for="pr_tipo_actividad" class="col-md-3 control-label">Tipo de actividad:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_actividad" name="pr_tipo_actividad">
										    <option value="">Seleccionar...</option>
										    <option value="Instalar UM con PE">Instalar UM con PE</option>
	      									<option value="Instalar UM con PE sobre OTP de Pymes">Instalar UM con PE sobre OTP de Pymes</option> 												
	      									<option value="Instalar UM con CT">Instalar UM con CT</option> 	    
	      									<option value="Instalar UM con HFC">Instalar UM con HFC</option>
	      									<option value="Instalar UM con 3G">Instalar UM con 3G</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- ID SERVICIO ACTUAL (Aplica para UM Existente): -->
							<div class="form-group">
						        <label for="pr_servicio_actual" class="col-md-3 control-label">ID servicio actual (Aplica UM Existente):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_servicio_actual" id="pr_servicio_actual" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- REQUIERE LIBERACIÓN DE RECURSOS DE ULTIMA MILLA SEDE ANTIGUA(PROVEEDOR TERCERO) -->
						     <div class="form-group">
						        <label for="pr_requiere_liberacion_um" class="col-md-3 control-label">Requiere liberación recursos ult.milla sede antigua(proveedor tercero):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_liberacion_um" name="pr_requiere_liberacion_um">
										    <option value="">Seleccionar...</option>
										    <option value="SI - Generar Tarea de Desconexión Tercero al finalizar el Traslado">SI - Generar Tarea de Desconexión Tercero al finalizar el Traslado</option>
	      									<option value="NO - Recursos de UM Propia en Sede Antigua">NO - Recursos de UM Propia en Sede Antigua</option> 
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<!-- Segunda sesion --> 
					<legend class="f-s-15">INFORMACIÓN ULTIMA MILLA</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
						    <div class="form-group">
						        <label for="pr_requiere_um" class="col-md-3 control-label">¿Esta requiere instalacion de UM?:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_requiere_um" name="pr_requiere_um">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>   	    
										</select>
						            </div>
						        </div>
						    </div>
							
							<!-- PROVEEDOR: -->
						    <div class="form-group">
						        <label for="pr_proveedor" class="col-md-3 control-label">Proveedor:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_proveedor" name="pr_proveedor">
										    <option value="">Seleccionar...</option>
										    <option value="No aplica">No aplica</option>
	      									<option value="Existente">Existente</option>
	      									<option value="Claro">Claro</option>
	      									<option value="Axesat">Axesat</option>
	      									<option value="Comcel">Comcel</option> 	
	      									<option value="Tigo">Tigo</option> 		
	      									<option value="Media Commerce">Media Commerce</option> 		
	      									<option value="Diveo">Diveo</option>
	      									<option value="Edatel">Edatel</option> 	
	      									<option value="UNE">UNE</option> 		
	      									<option value="ETB">ETB</option> 	
	      									<option value="IBM">IBM</option> 		
	      									<option value="IFX">IFX</option> 		
	      									<option value="Level 3 Colombia">Level 3 Colombia</option>
	      									<option value="Mercanet">Mercanet</option> 	
	      									<option value="Metrotel">Metrotel</option> 		
	      									<option value="Promitel">Promitel</option> 		
	      									<option value="Skynet">Skynet</option> 		
	      									<option value="Telebucaramanga">Telebucaramanga</option>
	      									<option value="Telecom">Telecom</option> 	
	      									<option value="Terremark">Terremark</option> 		
	      									<option value="Sol Cable Vision">Sol Cable Vision</option> 		
	      									<option value="Sistelec">Sistelec</option>
	      									<option value="Opain">Opain</option> 	
	      									<option value="Airplan - (Información y Tecnologia)">Airplan - (Información y Tecnologia)</option> 		
	      									<option value="TV Azteca">TV Azteca</option> 						    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							

							<!-- MEDIO -->
						    <div class="form-group">
						        <label for="pr_medio" class="col-md-3 control-label">Medio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_medio" name="pr_medio">
										    <option value="">Seleccionar...</option>
										    <option value="No Aplica">No Aplica</option>     
										    <option value="Fibra">Fibra</option>
										    <option value="Cobre">Cobre</option>
										    <option value="Satelital">Satelital</option> 
										    <option value="Radio enlace">Radio enlace</option>
										    <option value="3G">3G</option>
										    <option value="UTP">UTP</option>
										</select>
						            </div>
						        </div>
						    </div>					


							<!-- RESPUESTA FACTIBILIDAD BW >100 MEGAS: -->
						    <div class="form-group">
						        <label for="pr_factibilidad_bw" class="col-md-3 control-label">Respuesta factibilidad BW > 100 Megas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_factibilidad_bw" id="pr_factibilidad_bw" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>							
						    
						</fieldset>
					</div>

					<!-- 2.1. Acceso que solo aplica para clientes  > 100 megas -->
					<legend class="f-s-15">ACCESO (Solo Aplica para Canales > 100 MEGAS:</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- SDS DESTINO (Unifilar): -->
						    <div class="form-group">
						        <label for="pr_sds_destino" class="col-md-3 control-label">SDS destino (Unifilar):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_sds_destino" id="pr_sds_destino" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- OLT (GPON): -->
						    <div class="form-group">
						        <label for="pr_olt" class="col-md-3 control-label">OLT (GPON):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_olt" id="pr_olt" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- INTERFACE DE ENTREGA AL CLIENTE:-->
						    <div class="form-group">
						        <label for="pr_interfaz_entrega_cliente" class="col-md-3 control-label">Interface de entrega al cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_interfaz_entrega_cliente" name="pr_interfaz_entrega_cliente">
										    <option value="">Seleccionar...</option>
										    <option value="No Aplica">No Aplica</option>     
										    <option value="Ethernet">Ethernet</option>
										    <option value="Serial V.35">Serial V.35</option>
										    <option value="Giga (óptico)">Giga (óptico)</option> 
										    <option value="Giga Ethernet (Electrico)">Giga Ethernet (Electrico)</option>
										    <option value="STM-1">STM-1</option>
										    <option value="RJ45 - 120 OHM">RJ45 - 120 OHM</option>
										    <option value="G703 BNC">G703 BNC</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- REQUIERE VOC : -->
						    <div class="form-group">
						        <label for="pr_requiere_voc" class="col-md-3 control-label">Requiere VOC:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_voc" name="pr_requiere_voc">
										    <option value="">Seleccionar...</option>
										    <option>Si</option>
	      									<option>No</option>   												
	      									<option>No aplica</option> 	    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- PROGRAMACIÓN DE VOC : -->
							<div class="form-group">
								<label for="pr_programacion_voc" class="col-md-3 control-label">Programación de VOC:</label>
								<div class="col-md-9 selectContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								        <select class="form-control" id="pr_programacion_voc" name="pr_programacion_voc">
										    <option value="">Seleccionar...</option>
										    <option value="Programada">Programada</option>
											<option value="No requiere programación">No requiere programación</option>   												
											<option value="No programada. Otra ciudad">No programada. Otra ciudad</option> 	    
											<option value="No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto">No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
										</select>
								    </div>
								</div>
							</div>							
						</fieldset>

						<fieldset class="col-md-6">
							<!-- REQUIERE LIBERACIÓN DE RECURSOS DE ULTIMA MILLA (FO) EN SEDE ANTIGUA -->
							<div class="form-group">
								<label for="pr_requiere_liberacion_um_fo" class="col-md-3 control-label">Requiere liberación de recursos de ultima milla (FO) sede antigua:</label>
								<div class="col-md-9 selectContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								        <select class="form-control" id="pr_requiere_liberacion_um_fo" name="pr_requiere_liberacion_um_fo">
										    <option value="">Seleccionar...</option>
										    <option value="SI - Generar Tarea para Retirar recursos de Ultima Milla en Sede Antigua">SI - Generar Tarea para Retirar recursos de Ultima Milla en Sede Antigua</option>
											<option value="NO - Cliente no requiere liberación de Consumibles FO">NO - Cliente no requiere liberación de Consumibles FO</option>   	
											<option value="NA">NA</option>
										</select>
								    </div>
								</div>
							</div>
						</fieldset>
					</div>

					<!-- Tercera sesion: Requerimientos para la entrega del servicio  -->
					<legend class="f-s-15">REQUERIMIENTOS PARA ENTREGA DEL SERVICIO:</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- REQUIERE VENTANA DE MTTO -->
							<div class="form-group">
								<label for="pr_requiere_ventana_mtto" class="col-md-3 control-label">Requiere ventana de MTTO:</label>
								<div class="col-md-9 selectContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								        <select class="form-control" id="pr_requiere_ventana_mtto" name="pr_requiere_ventana_mtto">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
											<option value="No">No</option> 
										</select>
								    </div>
								</div>
							</div>

							<!-- REQUIERE RFC:-->
							<div class="form-group">
								<label for="pr_requiere_rfc" class="col-md-3 control-label">Requiere RFC:</label>
								<div class="col-md-9 selectContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								        <select class="form-control" id="pr_requiere_rfc" name="pr_requiere_rfc">
										    <option value="">Seleccionar...</option>
										    <option value="SI => Cliente Critico Punto Central">SI => Cliente Critico Punto Central</option>
											<option value="SI => Servicio Critico (Listado)">SI => Servicio Critico (Listado)</option> 
											<option value="SI => Cliente Critico">SI => Cliente Critico</option>
											<option value="SI => RFC Estándar Saturación">SI => RFC Estándar Saturación</option>
											<option value="SI => Cliente Critico Punto Central - RFC Estándar Saturación">SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
											<option value="No">No</option>
										</select>
								    </div>
								</div>
							</div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- Conversor Medio: -->
							<div class="form-group">
						        <label for="pr_conversor_medio" class="col-md-3 control-label">Conversor Medio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_conversor_medio" id="pr_conversor_medio" class="form-control" type="text" >
						            </div>
						        </div>
					    	</div>

						    <!-- Referencia Router: -->
				            <div class="form-group">
						        <label for="pr_referencia_router" class="col-md-3 control-label">Referencia Router:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
						                <input name="pr_referencia_router" id="pr_referencia_router" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- Modulos o Tarjetas: -->
				            <div class="form-group">
						        <label for="pr_modulos_tarjetas" class="col-md-3 control-label">Modulos o Tarjetas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_modulos_tarjetas" id="pr_modulos_tarjetas" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Licencias --> 
						    <div class="form-group">
						        <label for="pr_licencias" class="col-md-3 control-label">Licencias:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_licencias" id="pr_licencias" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- Equipos Adicionale--> 
						    <div class="form-group">
						        <label for="pr_equipos_adicionales" class="col-md-3 control-label">Equipos adicionale:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_equipos_adicionales" id="pr_equipos_adicionales" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Consumibles:--> 
						    <div class="form-group">
						        <label for="pr_consumibles" class="col-md-3 control-label">Consumibles:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_consumibles" name="pr_consumibles">
										    <option value="">Seleccionar...</option>
										    <option value="Bandeja">Bandeja</option>
	      									<option value="Cables de Poder ">Cables de Poder </option>
	      									<option value="Clavijas de Conexión">Clavijas de Conexión</option>
	      									<option value="Accesorios para rackear (Orejas)">Accesorios para rackear (Orejas)</option>
	      									<option value="No Aplica">No Aplica</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						

						<fieldset class="col-md-6">

							<!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
							<div class="form-group">
								<label for="pr_carta_valorizada" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
								<div class="col-md-9 selectContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								        <select class="form-control" id="pr_carta_valorizada" name="pr_carta_valorizada">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
											<option value="No">No</option>
										</select>
								    </div>
								</div>
							</div>
						</fieldset>
					</div>

					<!-- Cuarta sesion: DATOS DEL CONTACTO PARA COMUNICACIÓN -->
					<legend class="f-s-15"> DATOS DEL CONTACTO PARA COMUNICACIÓN:</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- NOMBRE --> 
						    <div class="form-group">
						        <label for="pr_nombre_1" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre_1" id="pr_nombre_1" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="pr_telefono_1" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono_1" id="pr_telefono_1" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							
							<!-- CELULAR --> 
						    <div class="form-group">
						        <label for="pr_celular_1" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular_1" id="pr_celular_1" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="pr_correo_1" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_correo_1" id="pr_correo_1" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<!-- Quinta sesion:DATOS CLIENTE: TÉCNICO -->
					<legend class="f-s-15">DATOS CLIENTE: TÉCNICO:</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- NOMBRE --> 
						    <div class="form-group">
						        <label for="pr_nombre_2" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre_2" id="pr_nombre_2" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="pr_telefono_2" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono_2" id="pr_telefono_2" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- CELULAR --> 
						    <div class="form-group">
						        <label for="pr_celular_2" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular_2" id="pr_celular_2" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="pr_correo_2" class="col-md-3 control-label">Correo electronico:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_correo_2" id="pr_correo_2" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-12">
							<!-- OBSERVACIONES: --> 
						    <div class="form-group">
						        <label for="pr_observaciones" class="col-md-3 control-label">Observaciones:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <textarea name="pr_observaciones" id="pr_observaciones" class="form-control" ></textarea>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
				</div>
            `;
        },

        /*TRASLADO INTERNO*/
        formProduct_traslado_interno: function() {
            return `
        		<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario Cierre de Kickoff  <small>TRASLADO INTERNO</small></h2>
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					
					<legend class="f-s-15">DATOS BASICOS</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- CIUDAD -->
							<div class="form-group">
						        <label for="pr_ciudad" class="col-md-3 control-label">Ciudad:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-globe" ></i></span>
						                <input name="pr_ciudad" id="pr_ciudad" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- DIRECCIÓN UBICACIÓN ACTUAL DEL SERVICIO :-->
						    <div class="form-group">
						        <label for="pr_ubicacion_actual" class="col-md-3 control-label">Dirección actual del servicio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
						                <input name="pr_ubicacion_actual" id="pr_ubicacion_actual" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- ALIAS DEL LUGAR : -->
						    <div class="form-group">
						        <label for="pr_alias_lugar" class="col-md-3 control-label">Alias del lugar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
						                <input type="text" name="pr_alias_lugar" id="pr_alias_lugar" class="form-control">
						            </div>
						        </div>
						    </div>	

						    <!-- MOVIMIENTO INTERNO REQUERIDO : -->
						    <div class="form-group">
						        <label for="pr_movimiento_interno" class="col-md-3 control-label">Movimiento interno requerido:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
										<select name="pr_movimiento_interno" id="pr_movimiento_interno" class="form-control">
											<option value="">Seleccionar...</option>
											<option value="Movimiento Equipos - Caja OB - Fibra  > 3 Mt">Movimiento Equipos - Caja OB - Fibra  > 3 Mt</option>
											<option value="Movimiento Equipos - Caja OB - Fibra  < 3 Mt">Movimiento Equipos - Caja OB - Fibra  < 3 Mt</option>
											<option value="Movimiento solo de Equipos">Movimiento solo de Equipos</option>
											<option value="Movimiento solo de Caja OB - Fibra">Movimiento solo de Caja OB - Fibra</option>
											<option value="Movimiento Rack">Movimiento Rack</option>
											<option value="Movimiento ODF">Movimiento ODF</option>
											<option value="Determinación en Visita de Obra Civil">Determinación en Visita de Obra Civil</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- OTP ASOCIADAS :  -->
						    <div class="form-group">
						        <label for="pr_otp_asociada" class="col-md-3 control-label">OTP asociadas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
						                <input name="pr_otp_asociada" id="pr_otp_asociada" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- CANTIDAD DE SERVICIOS A TRASLADAR : -->
							<div class="form-group">
						        <label for="pr_cant_servicios_trasladar" class="col-md-3 control-label">Cantidad servicios a trasladar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
						                <input name="pr_cant_servicios_trasladar" id="pr_cant_servicios_trasladar" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- CODIGOS DE SERVICIO  A TRASLADAR : -->
							<div class="form-group">
						        <label for="pr_cod_servicios_trasladar" class="col-md-3 control-label">Códigos servicio a trasladar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
						                <input name="pr_cod_servicios_trasladar" id="pr_cod_servicios_trasladar" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>


						    <!-- TIPO DE TRASLADO INTERNO : -->
						    <div class="form-group">
						        <label for="pr_tipo_traslado" class="col-md-3 control-label">Tipo traslado interno:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_traslado" name="pr_tipo_traslado">
										    <option value="Seleccionar">Seleccionar...</option>
										    <option value="Estándar - El movimiento se realiza durante la EOC y OB">Estándar - El movimiento se realiza durante la EOC y OB</option>
	      									<option value="Paralelo - Se habilitan Nuevos Recursos de UM, Equipos, Config">Paralelo - Se habilitan Nuevos Recursos de UM, Equipos, Config</option>
										</select>
						            </div>
						        </div>
						    </div>	
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- TIPO SERVICIO: -->
						    <div class="form-group">
						        <label for="pr_tipo_servicio" class="col-md-3 control-label">Tipo servicio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_servicio" name="pr_tipo_servicio">
										    <option value="">Seleccionar...</option>
										    <option value="Internet Dedicado con diferenciación de tráfico (Internet / NAP)">Internet Dedicado con diferenciación de tráfico (Internet / NAP)</option>
	      									<option value="Internet Dedicado + Monitoreo CPE (Gestion Proactiva)">Internet Dedicado + Monitoreo CPE (Gestion Proactiva)</option>
	      									<option value="Internet Dedicado Administrado + Monitoreo CPE (Gestion Proactiva)">Internet Dedicado Administrado + Monitoreo CPE (Gestion Proactiva)</option>
	      									<option value="Internet Dedicado Empresarial">Internet Dedicado Empresarial</option>
	      									<option value="Internet  Banda ancha FO">Internet  Banda ancha FO</option>
	      									<option value="MPLS Avanzado Intranet  + Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado Intranet  + Monitoreo CPE (Gestión Proactiva)</option>
	      									<option value="MPLS Avanzado Extranet  + Monitoreo CPE (Gestión Proactiva)">MPLS Avanzado Extranet  + Monitoreo CPE (Gestión Proactiva)</option>
	      									<option value="MPLS Avanzado con Punta Backend">MPLS Avanzado con Punta Backend</option>
	      									<option value="MPLS Avanzado con Punta en Rack de Appliance (Componente Datacenter)">MPLS Avanzado con Punta en Rack de Appliance (Componente Datacenter)</option>
	      									<option value="MPLS Avanzado con Punta Claro Connect">MPLS Avanzado con Punta Claro Connect</option>
	      									<option value="MPLS Transaccional">MPLS Transaccional</option>
	      									<option value="Telefonia Pública - Líneas Análogas">Telefonia Pública - Líneas Análogas</option>
	      									<option value="Telefonia Pública - Líneas E1 - R2">Telefonia Pública - Líneas E1 - R2</option>
	      									<option value="Telefonia Pública - Líneas E1 - PRI">Telefonia Pública - Líneas E1 - PRI</option>
	      									<option value="Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)">Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
	      									<option value="Telefonia Pública - Línea SIP (Centralizado)">Telefonia Pública - Línea SIP (Centralizado)</option>
	      									<option value="PBX Distribuida  Linea E1 -R2">PBX Distribuida  Linea E1 -R2</option>
	      									<option value="PBX Distribuida  Linea E1 -PRI">PBX Distribuida  Linea E1 -PRI</option>
	      									<option value="Telefonia Corporativa">Telefonia Corporativa</option>
	      									<option value="Local - P2P">Local - P2P</option>
	      									<option value="Local - P2MP">Local - P2MP</option>
	      									<option value="Nacional - P2P">Nacional - P2P</option>
	      									<option value="Nacional - P2MP">Nacional - P2MP</option>
	      									<option value="VPRN">VPRN</option>
										</select>
						            </div>
						        </div>
						    </div>	

						    <!-- ANCHO DE BANDA -->
							<div class="form-group">
						        <label for="pr_ancho_banda" class="col-md-3 control-label">Ancho de banda:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
						                <input name="pr_ancho_banda" id="pr_ancho_banda" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- TIPO DE ACTIVIDAD : -->
						    <div class="form-group">
						        <label for="pr_tipo_actividad" class="col-md-3 control-label">Tipo de actividad:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_actividad" name="pr_tipo_actividad">
										    <option value="">Seleccionar...</option>
										    <option value="Traslado Interno - Ejecutar de acuerdo a Visita de Cotización">Traslado Interno - Ejecutar de acuerdo a Visita de Cotización</option>
										    <option value="OTP Legalización - Traslado Punto Central u Origen">OTP Legalización - Traslado Punto Central u Origen</option>
	      									<option value="Traslado Interno - En Datacenter Claro">Traslado Interno - En Datacenter Claro</option>
	      									<option value="Traslado Interno - En Datacenter Tercero">Traslado Interno - En Datacenter Tercero</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- ID SERVICIO ACTUAL (Aplica para UM Existente) : -->
							<div class="form-group">
						        <label for="pr_servicio_actual" class="col-md-3 control-label">Id servicio actual (Aplica para UM Existente):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_servicio_actual" id="pr_servicio_actual" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<!-- Sesion segunda: INFORMACIÓN  ULTIMA MILLA -->
					<legend class="f-s-15">INFORMACIÓN  ULTIMA MILLA</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- ¿esta ot requiere instalacion de  um?--> 
						    <div class="form-group">
						        <label for="pr_requiere_um" class="col-md-3 control-label">¿Esta OT requiere instalacion UM? :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
										<select name="pr_requiere_um" id="pr_requiere_um" class="form-control">
											<option value="">Seleccionar...</option>
											<option value="SI">SI</option>
											<option value="NO">NO</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Proveedor --> 
						    <div class="form-group">
						        <label for="pr_proveedor" class="col-md-3 control-label">Proveedor:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
										<select name="pr_proveedor" id="pr_proveedor" class="form-control">
											<option value="">Seleccionar...</option>
											<option value="No aplica">No aplica</option>
											<option value="Claro">Claro</option>
											<option value="Axesat">Axesat</option>
											<option value="Comcel">Comcel</option>
											<option value="Tigo">Tigo</option>
											<option value="Media Commerce">Media Commerce</option>
											<option value="Diveo">Diveo</option>
											<option value="Edatel">Edatel</option>
											<option value="UNE">UNE</option>
											<option value="ETB">ETB</option>
											<option value="IBM">IBM</option>
											<option value="IFX">IFX</option>
											<option value="Level 3 Colombia">Level 3 Colombia</option>
											<option value="Mercanet">Mercanet</option>
											<option value="Metrotel">Metrotel</option>
											<option value="Promitel">Promitel</option>
											<option value="Skynet">Skynet</option>
											<option value="Telebucaramanga">Telebucaramanga</option>
											<option value="Telecom">Telecom</option>
											<option value="Terremark">Terremark</option>
											<option value="Sol Cable Vision">Sol Cable Vision</option>
											<option value="Sistelec">Sistelec</option>
											<option value="Opain">Opain</option>
											<option value="Airplan - (Información y Tecnologia)">Airplan - (Información y Tecnologia)</option>
											<option value="TV Azteca">TV Azteca</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- MEDIO -->
						    <div class="form-group">
						        <label for="pr_medio" class="col-md-3 control-label">Medio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_medio" name="pr_medio">
										    <option value="">Seleccionar...</option>
										    <option value="No Aplica">No Aplica</option>
										    <option value="FIBRA">FIBRA</option>
										    <option value="COBRE">COBRE</option> 
										    <option value="SATELITAL">SATELITAL</option>
										    <option value="RADIO ENLACE">RADIO ENLACE</option>
										    <option value="3G">3G</option>
										    <option value="UTP">UTP</option>
										</select>
						            </div>
						        </div>
						    </div>

							<!-- RESPUESTA FACTIBILIDAD BW > 100 MEGAS : -->
				            <div class="form-group">
						        <label for="pr_factibilidad_bw" class="col-md-3 control-label">Respuesta factibilidad BW > 100 Megas :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_factibilidad_bw" id="pr_factibilidad_bw" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>											    
				            
						</fieldset>
					</div>

					<!-- 2.1. ACCESO (Solo Aplica para Canales > 100 MEGAS -->
					<legend class="f-s-15">ACCESO (Solo Aplica para Canales > 100 MEGAS</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- SDS DESTINO -->
							<div class="form-group">
						        <label for="pr_sds_destino" class="col-md-3 control-label">SDS DESTINO (Unifilar):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_sds_destino" id="pr_sds_destino" class="form-control" type="text" >
						            </div>
						        </div>
					    	</div>

						    <!-- OLT (GPON) : -->
				            <div class="form-group">
						        <label for="pr_olt" class="col-md-3 control-label">OLT (GPON):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
						                <input name="pr_olt" id="pr_olt" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- INTERFACE DE ENTREGA AL CLIENTE: -->
						    <div class="form-group">
						        <label for="pr_interfaz_entrega_cliente" class="col-md-3 control-label">Interface de entrega al cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_interfaz_entrega_cliente" name="pr_interfaz_entrega_cliente">
										    <option value="">Seleccionar...</option>
										    <option value="No aplica">No aplica</option>						   									
										    <option value="Ethernet">Ethernet</option>
										    <option value="Serial V.35">Serial V.35</option>
										    <option value="Giga (óptico)">Giga (óptico)</option>
										    <option value="Giga Ethernet (Electrico)">Giga Ethernet (Electrico)</option>
										    <option value="STM-1">STM-1</option>
										    <option value="RJ45 - 120 OHM">RJ45 - 120 OHM</option>
										    <option value="G703 BNC">G703 BNC</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- REQUIERE VOC: -->
						    <div class="form-group">
						        <label for="pr_requiere_voc" class="col-md-3 control-label">REQUIERE VOC:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
										<select type="text" name="pr_requiere_voc" id="pr_requiere_voc" class="form-control">
											<option value="">Seleccionar...</option>
											<option value="Si">Si</option>
											<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- PROGRAMACIÓN DE VOC: -->
						    <div class="form-group">
						        <label for="pr_programacion_voc" class="col-md-3 control-label">Programación VOC:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-altt" ></i></span>
										<select type="text" name="pr_programacion_voc" id="pr_programacion_voc" class="form-control">
											<option value="">Seleccionar...</option>
											<option value="Programada">Programada</option>
											<option value="No requiere programación">No requiere programación</option>
											<option value="No programada. Otra ciudad">No programada. Otra ciudad</option>
											<option value="No programada. Otra ciudad">No programada. Otra ciudad</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<!-- 2.1. ACCESO (Solo Aplica para Canales > 100 MEGAS -->
					<legend class="f-s-15">REQUERIMIENTOS PARA ENTREGA DEL SERVICIO</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- REQUIERE VENTANA DE MTTO : -->
						    <div class="form-group">
						        <label for="pr_requiere_ventana_mtto" class="col-md-3 control-label">Requiere ventana MTTO:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
										<select type="text" name="pr_requiere_ventana_mtto" id="pr_requiere_ventana_mtto" class="form-control">
											<option value="">Seleccionar...</option>
											<option value="si">si</option>
											<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- REQUIERE RFC : -->
						    <div class="form-group">
						        <label for="pr_requiere_rfc" class="col-md-3 control-label">Requiere RFC:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
										<select type="text" name="pr_requiere_rfc" id="pr_requiere_rfc" class="form-control">
											<option value="">Seleccionar...</option>
											<option value="SI => Cliente Critico Punto Central">SI => Cliente Critico Punto Central</option>
											<option value="SI => Servicio Critico (Listado)">SI => Servicio Critico (Listado)</option>
											<option value="SI => Cliente Critico">SI => Cliente Critico</option>
											<option value="SI => RFC Estándar Saturación">SI => RFC Estándar Saturación</option>
											<option value="SI => Cliente Critico Punto Central - RFC Estándar Saturación">SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
											<option value="NO">NO</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- Conversor Medio: -->
				            <div class="form-group">
						        <label for="pr_conversor_medio" class="col-md-3 control-label">Convesor medio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_conversor_medio" id="pr_conversor_medio" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Referencia Router  -->
				            <div class="form-group">
						        <label for="pr_referencia_router" class="col-md-3 control-label">Referencia Router :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_referencia_router" id="pr_referencia_router" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- MODULOS O TARJETAS  -->
				            <div class="form-group">
						        <label for="pr_modulos_tarjetas" class="col-md-3 control-label">Modulos o Tarjetas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_modulos_tarjetas" id="pr_modulos_tarjetas" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- LICENCIAS  -->
				            <div class="form-group">
						        <label for="pr_licencias" class="col-md-3 control-label">Licencias:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_licencias" id="pr_licencias" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>						    						
						</fieldset>

						<fieldset class="col-md-6">
							
							<!-- Equipos Adicionales: -->
				            <div class="form-group">
						        <label for="pr_equipos_adicionales" class="col-md-3 control-label">Equipos adicionales:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_equipos_adicionales" id="pr_equipos_adicionales" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						  
						    <!-- Consumibles: -->
						    <div class="form-group">
						        <label for="pr_consumibles" class="col-md-3 control-label">Consumibles:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
										<select type="text" name="pr_consumibles" id="pr_consumibles" class="form-control">
											<option value="">Seleccionar...</option>
											<option value="Bandeja">Bandeja</option>
											<option value="Cables de Poder">Cables de Poder</option>
											<option value="Clavijas de Conexión">Clavijas de Conexión</option>
											<option value="Accesorios para rackear (Orejas)">Accesorios para rackear (Orejas)</option>
											<option value="No Aplica">No Aplica</option>
										</select>
						            </div>
						        </div>
						    </div>						    
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA  -->
				            <div class="form-group">
						        <label for="pr_carta_valorizada" class="col-md-3 control-label">Registro de importacion y carta valorizada:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select name="pr_carta_valorizada" id="pr_carta_valorizada" class="form-control">
						                	<option value="">Seleccionar...</option>
						                	<option value="SI">SI</option>
						                	<option value="NO">NO</option>
						                </select>
						            </div>
						        </div>
						    </div>
						</fieldset>						
					</div>

					<legend class="f-s-15">DATOS DEL CONTACTO PARA COMUNICACIÓN</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- nombre--> 
						    <div class="form-group">
						        <label for="pr_nombre_1" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre_1" id="pr_nombre_1" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO:--> 
						    <div class="form-group">
						        <label for="pr_telefono_1" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono_1" id="pr_telefono_1" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- CELULAR :  --> 
						    <div class="form-group">
						        <label for="pr_celular_1" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular_1" id="pr_celular_1" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
							<!-- CORREO ELECTRONICO:  -->
				            <div class="form-group">
						        <label for="pr_correo_1" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input type="text" name="pr_correo_1" id="pr_correo_1" class="form-control">
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>


					<legend class="f-s-15">DATOS DEL CONTACTO PARA COMUNICACIÓN</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- nombre--> 
						    <div class="form-group">
						        <label for="pr_nombre_2" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre_2" id="pr_nombre_2" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO:--> 
						    <div class="form-group">
						        <label for="pr_telefono_2" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono_2" id="pr_telefono_2" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- CELULAR :  --> 
						    <div class="form-group">
						        <label for="pr_celular_2" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular_2" id="pr_celular_2" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
							<!-- CORREO ELECTRONICO:  -->
				            <div class="form-group">
						        <label for="pr_correo_2" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input type="text" name="pr_correo_2" id="pr_correo_2" class="form-control">
						            </div>
						        </div>
						    </div>
						</fieldset>

						<div class="d-inline-b">
							<fieldset class="col-md-6">
								<!-- OBSERVACIONES :  --> 
							    <div class="form-group">
							        <label for="pr_observaciones" class="col-md-3 control-label">Observaciones:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
							                <textarea name="pr_observaciones" id="pr_observaciones" class="form-control"></textarea>
							            </div>
							        </div>
							    </div>
							</fieldset>
						</div>


					</div>					
				</div>
        	`;
        },

        /*PBX ADMINISTRADA*/
        formProduct_pvx_administrada: function(otp) {
            return `
        		<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario Cierre de Kickoff  <small>SERVICIO PBX ADMINISTRADA</small></h2>
				<div class="widget bg_white m-t-25 d-inline-b cliente">

					<!-- Primera sesion --> 
					<legend class="f-s-15">DATOS BÁSICOS DE INSTALACION</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- CIUDAD -->
							<div class="form-group">
						        <label for="pr_ciudad" class="col-md-3 control-label">Ciudad:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ciudad" id="pr_ciudad" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- DIRECCIÓN:-->
						    <div class="form-group">
						        <label for="pr_direccion" class="col-md-3 control-label">Dirección:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_direccion" id="pr_direccion" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							
							<!-- TIPO PREDIO: -->
						    <div class="form-group">
						        <label for="pr_tipo_predio" class="col-md-3 control-label">Tipo predio:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_predio" name="pr_tipo_predio">
										    <option value="">Seleccionar...</option>
										    <option value="Edificio">Edificio</option>
	      									<option value="Casa">Casa</option>
										</select>
						            </div>
						        </div>
						    </div>	

						    <!-- NIT del cliente: -->
						    <div class="form-group">
						        <label for="pr_nit_cliente" class="col-md-3 control-label">NIT cliente:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
						                <input name="pr_nit_cliente" id="pr_nit_cliente" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							
							<!-- ALIAS DEL LUGAR  -->
						    <div class="form-group">
						        <label for="pr_alias_lugar" class="col-md-3 control-label">Alias del lugar:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_alias_lugar" id="pr_alias_lugar" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- OTP -->
							<div class="form-group">
						        <label for="pr_id_ot_padre" class="col-md-3 control-label">OTP:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_id_ot_padre" id="pr_id_ot_padre" class="form-control" type="text" value="${otp}" readonly>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- otp_asociadas -->
							<div class="form-group">
						        <label for="pr_otp_asociada" class="col-md-3 control-label">OTP asociadas:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_otp_asociada" id="pr_otp_asociada" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>


						    <!-- TIPO DE PBX ADMINISTRADA: -->
						     <div class="form-group">
						        <label for="pr_tipo_pbx" class="col-md-3 control-label">Tipo PBX administrada:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_pbx" name="pr_tipo_pbx">
										    <option value="">Seleccionar...</option>
										    <option value="Estándar">Estándar</option>
	      									<option value="No Estándar">No Estándar</option>						
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- TIPO INSTALACION: -->
						    <div class="form-group">
						        <label for="pr_tipo_instalacion" class="col-md-3 control-label">Tipo instalación:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_instalacion" name="pr_tipo_instalacion">
										    <option value="">Seleccionar...</option>
										    <option value="Instalar UM con PE">Instalar UM con PE</option>
										    <option value="Instalar UM con PE sobre OTP de Pymes">Instalar UM con PE sobre OTP de Pymes</option>
										    <option value="Instalar UM con CT (No aplica para Internet Dedicado Empresarial)">Instalar UM con CT (No aplica para Internet Dedicado Empresarial)</option>
										    <option value="Instalar UM en Datacenter Claro- Implementación">Instalar UM en Datacenter Claro- Implementación</option>
	      									<option value="UM existente. Requiere Cambio de equipo">UM existente. Requiere Cambio de equipo</option>
	      									<option value="UM existente. Requiere Adición de equipo">UM existente. Requiere Adición de equipo</option>	
	      									<option value="UM existente. Solo configuración">UM existente. Solo configuración</option>				    
										</select>
						            </div>
						        </div>
						    </div>
						    
						</fieldset>

						<fieldset class="col-md-6">

							<!-- ID SERVICIO ACTUAL -->
							<div class="form-group">
						        <label for="pr_servicio_actual" class="col-md-3 control-label">ID servicio actual (Aplica para UM Existente):</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_servicio_actual" id="pr_servicio_actual" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<!-- Segunda sesion --> 
					<legend class="f-s-15">INFORMACIÓN ULTIMA MILLA </legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
						
							<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
						    <div class="form-group">
						        <label for="pr_requiere_um" class="col-md-3 control-label">¿Requiere instalacion UM?</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_um" name="pr_requiere_um">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>   
	      									<option value="Existe">Existe</option>												    
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- PROVEEDOR: -->
						    <div class="form-group">
						        <label for="pr_proveedor" class="col-md-3 control-label">Proveedor:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_proveedor" name="pr_proveedor">
										    <option value="">Seleccionar...</option>
										    <option value="No aplica">No aplica</option>
	      									<option value="Existente">Existente</option>
	      									<option value="Claro">Claro</option>
	      									<option value="Axesat">Axesat</option>
	      									<option value="Comcel">Comcel</option> 	
	      									<option value="Tigo">Tigo</option> 		
	      									<option value="Media Commerce">Media Commerce</option> 		
	      									<option value="Diveo">Diveo</option>
	      									<option value="Edatel">Edatel</option> 	
	      									<option value="UNE">UNE</option> 		
	      									<option value="ETB">ETB</option> 	
	      									<option value="IBM">IBM</option> 		
	      									<option value="IFX">IFX</option> 		
	      									<option value="Level 3 Colombia">Level 3 Colombia</option>
	      									<option value="Mercanet">Mercanet</option> 	
	      									<option value="Metrotel">Metrotel</option> 		
	      									<option value="Promitel">Promitel</option> 		
	      									<option value="Skynet">Skynet</option> 		
	      									<option value="Telebucaramanga">Telebucaramanga</option>
	      									<option value="Telecom">Telecom</option> 	
	      									<option value="Terremark">Terremark</option> 		
	      									<option value="Sol Cable Vision">Sol Cable Vision</option> 		
	      									<option value="Sistelec">Sistelec</option>
	      									<option value="Opain">Opain</option> 	
	      									<option value="Airplan - (Información y Tecnologia)">Airplan - (Información y Tecnologia)</option> 		
	      									<option value="TV Azteca">TV Azteca</option> 						    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- MEDIO -->
						    <div class="form-group">
						        <label for="pr_medio" class="col-md-3 control-label">Medio:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_medio" name="pr_medio">
										    <option value="">Seleccionar...</option>
										    <option value="No Aplica">No Aplica</option> 	   
										    <option value="Fibra">Fibra</option>
										    <option value="Cobre">Cobre</option>
										    <option value="Satelital">Satelital</option> 
										    <option value="Radio enlace">Radio enlace</option>
										    <option value="3G">3G</option>
										    <option value="UTP">UTP</option>
										</select>
						            </div>
						        </div>
						    </div>
						    				
				            <!-- REQUIERE VOC : -->
						    <div class="form-group">
						        <label for="pr_requiere_voc" class="col-md-3 control-label">Requiere VOC:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_voc" name="pr_requiere_voc">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">

						<fieldset class="col-md-6">

							<!-- PROGRAMACIÓN DE VOC : -->
						    <div class="form-group">
						        <label for="pr_programacion_voc" class="col-md-3 control-label">Programación de VOC:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_programacion_voc" name="pr_programacion_voc">
										    <option value="">Seleccionar...</option>
										    <option value="Programada">Programada</option>
	      									<option value="No requiere programación">No requiere programación</option>   												
	      									<option value="No programada. Otra ciudad">No programada. Otra ciudad</option> 	    
	      									<option value="No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto">No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<!-- Tercera sesion --> 
					<legend class="f-s-15">REQUERIMIENTOS PARA ENTREGA DEL SERVICIO </legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- REQUIERE RFC : -->
						    <div class="form-group">
						        <label for="pr_requiere_rfc" class="col-md-3 control-label">Requiere RFC:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_rfc" name="pr_requiere_rfc">
										    <option value="">Seleccionar...</option>
										    <option value="SI => Cliente Critico Punto Central">SI => Cliente Critico Punto Central</option>
	      									<option value="SI => Servicio Critico (Listado)">SI => Servicio Critico (Listado)</option>  							
	      									<option value="SI => Cliente Critico">SI => Cliente Critico</option>
	      									<option value="SI => RFC Estándar Saturación">SI => RFC Estándar Saturación</option>
	      									<option value="SI => Cliente Critico Punto Central - RFC Estándar Saturación">SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
	      									<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Conversor Medio: -->
				            <div class="form-group">
						        <label for="pr_conversor_medio" class="col-md-3 control-label">Conversor Medio:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_conversor_medio" id="pr_conversor_medio" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- Referencia Router: -->
							<div class="form-group">
						        <label for="pr_referencia_router" class="col-md-3 control-label">Referencia Router:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_referencia_router" id="pr_referencia_router" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
				            
						    
						    <!-- Modulos o Tarjetas: -->
						    <div class="form-group">
						        <label for="pr_modulos_tarjetas" class="col-md-3 control-label">Modulos o Tarjetas:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_modulos_tarjetas" id="pr_modulos_tarjetas" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
				            
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- Licencias --> 
							<div class="form-group">
						        <label for="pr_licencias" class="col-md-3 control-label">Licencias:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_licencias" id="pr_licencias" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>						    
						</fieldset>

						<fieldset class="col-md-6">
							<!-- Equipos Adicionale--> 
						    <div class="form-group">
						        <label for="pr_equipos_adicionales" class="col-md-3 control-label">Equipos adicionale:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_equipos_adicionales" id="pr_equipos_adicionales" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>


					<!-- 3.1 sesion: TELEFONOS --> 
					<legend class="f-s-15">TELEFONOS </legend>
					<div id="aca_ref_cant" class="widget bg_white m-t-25 d-inline-b cliente m-b-20">
						<span class="btn btn-success f-r" id="añadir_seccion_ref_cant"> Add  <i class="fa fa-plus"></i></span>
						<div class="d-inline-b" id="duplicar_ref_cant">
							<fieldset class="col-md-6">
								<!--*********************  INPUT TEXT  *********************-->
								<div class="form-group">
									<label for="pr_referencia" class="col-md-3 control-label">Referencia: &nbsp;</label>
									<div class="col-md-9 selectContainer">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
											<input type="text" name="pr_referencia[]" id="pr_referencia" class="form-control">
										</div>
									</div>
								</div>
							</fieldset>
							<fieldset class="col-md-6">
								<!-- Cantidad:--> 
							    <div class="form-group">
							        <label for="pr_cantidad" class="col-md-3 control-label">Cantidad:</label>
							        <div class="ol-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order-alt" ></i></span>
							                <input name="pr_cantidad[]" id="pr_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
															
							</fieldset>
						</div>

					</div>

					<div class="d-inline-b">

						<fieldset class="col-md-6">

						    <!-- Fuentes de Teléfonos:--> 
						    <div class="form-group">
						        <label for="pr_fuentes_telefonos" class="col-md-3 control-label">Fuentes de Teléfonos:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_fuentes_telefonos" id="pr_fuentes_telefonos" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- Diademas:--> 
						    <div class="form-group">
						        <label for="pr_diademas" class="col-md-3 control-label">Diademas:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-headphones" ></i></span>
						                <input name="pr_diademas" id="pr_diademas" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Arañas de Conferencia:--> 
						    <div class="form-group">
						        <label for="pr_araña_conferencia" class="col-md-3 control-label">Arañas de Conferencia:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-volume-up" ></i></span>
						                <input name="pr_araña_conferencia" id="pr_araña_conferencia" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- Botoneras:--> 
						    <div class="form-group">
						        <label for="pr_botoneras" class="col-md-3 control-label">Botoneras:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-record" ></i></span>
						                <input name="pr_botoneras" id="pr_botoneras" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Modulo Expansión Botonera:--> 
						    <div class="form-group">
						        <label for="pr_modulo_botonera" class="col-md-3 control-label">Modulo Expansión Botonera:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-record" ></i></span>
						                <input name="pr_modulo_botonera" id="pr_modulo_botonera" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- Fuente Botonera: -->
						    <div class="form-group">
						        <label for="pr_fuente_botonera" class="col-md-3 control-label">Fuente Botonera:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-record" ></i></span>
						                <input name="pr_fuente_botonera" id="pr_fuente_botonera" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Consumibles:--> 
						    <div class="form-group">
						        <label for="pr_consumibles" class="col-md-3 control-label">Consumibles:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list" ></i></span>
						                <select class="form-control" id="pr_consumibles" name="pr_consumibles">
										    <option value="">Seleccionar...</option>
										    <option value="Bandeja">Bandeja</option>
	      									<option value="Cables de Poder ">Cables de Poder </option>
	      									<option value="Clavijas de Conexión">Clavijas de Conexión</option>
	      									<option value="Accesorios para rackear (Orejas)">Accesorios para rackear (Orejas)</option>
	      									<option value="No Aplica">No Aplica</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
							<div class="form-group">
						        <label for="pr_carta_valorizada" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list" ></i></span>
						                <select class="form-control" id="pr_carta_valorizada" name="pr_carta_valorizada">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						</fieldset>
					</div>

					<!-- Cuarta sesion: DATOS DEL CONTACTO PARA COMUNICACIÓN  --> 
					<legend class="f-s-15">DATOS DEL CONTACTO PARA COMUNICACIÓN</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- NOMBRE --> 
						    <div class="form-group">
						        <label for="pr_nombre_1" class="col-md-3 control-label">Nombre:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre_1" id="pr_nombre_1" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="pr_telefono_1" class="col-md-3 control-label">Telefono:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono_1" id="pr_telefono_1" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- CELULAR --> 
						    <div class="form-group">
						        <label for="pr_celular_1" class="col-md-3 control-label">Celular:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular_1" id="pr_celular_1" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="pr_correo_1" class="col-md-3 control-label">Email:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_correo_1" id="pr_correo_1" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<!-- Quinta sesion: DATOS CONTACTO TÉCNICO  --> 
					<legend class="f-s-15">DATOS CONTACTO TÉCNICO</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- NOMBRE --> 
						    <div class="form-group">
						        <label for="pr_nombre_2" class="col-md-3 control-label">Nombre:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre_2" id="pr_nombre_2" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="pr_telefono_2" class="col-md-3 control-label">Telefono:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono_2" id="pr_telefono_2" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- CELULAR --> 
						    <div class="form-group">
						        <label for="pr_celular_2" class="col-md-3 control-label">Celular:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular_2" id="pr_celular_2" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="pr_correo_2" class="col-md-3 control-label">Email:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_correo_2" id="pr_correo_2" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						

							<!-- OBSERVACIONES: --> 
							<div class="form-group">
						        <label for="pr_observaciones" class="col-md-2 control-label">Observaciones:</label>
						        <div class="col-md-10 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <textarea name="pr_observaciones" id="pr_observaciones" class="form-control" ></textarea>
						            </div>
						        </div>
						    </div>
						
					</div>

					<!-- Sexta sesion: DATOS CONTACTO TÉCNICO  --> 
					<legend class="f-s-15">KIKOFF TECNICO</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- TELEFONIA FIJA CLARO: --> 
						    <div class="form-group">
						        <label for="pr_tel_fija_claro" class="col-md-3 control-label">Telefonia fija claro:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <select class="form-control" id="pr_tel_fija_claro" name="pr_tel_fija_claro">
										    <option value="">Seleccionar...</option>
										    <option>Existente</option>
	      									<option>A implementar</option>    
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- CANTIDAD DE EXTENSIONES: --> 
						    <div class="form-group">
						        <label for="pr_cantidad_extenciones" class="col-md-3 control-label">Cantidad de extensiones:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_cantidad_extenciones" id="pr_cantidad_extenciones" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- CANTIDAD DE BUZONES VOZ --> 
						    <div class="form-group">
						        <label for="pr_cantidad_buzones_voz" class="col-md-3 control-label">Cantidad de buzones de voz:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_cantidad_buzones_voz" name="pr_cantidad_buzones_voz">
										    <option value="">Seleccionar...</option>
										    <option value="Cantidad IPs: 2 - Mascara: /30">Cantidad IPs: 2 - Mascara: /30</option>
	      									<option value="Cantidad IPs 6 - Mascara: /29">Cantidad IPs 6 - Mascara: /29</option>
	      									<option value="Cantidad IPs 14 - Mascara: /28 - Requiere Viabilidad Preventa">Cantidad IPs 14 - Mascara: /28 - Requiere Viabilidad Preventa</option>    
	      									<option value="Cantidad Ips: 30 - Mascara: /27 - Requiere Viabilidad Preventa">Cantidad Ips: 30 - Mascara: /27 - Requiere Viabilidad Preventa</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- INCLUYE GRABACIÓN DE VOZ: --> 
						    <div class="form-group">
						        <label for="pr_grabacion_voz" class="col-md-3 control-label">Incluye grabación de voz:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_grabacion_voz" name="pr_grabacion_voz">
						                	<option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- INCLUYE LAN ADMINISTRADA: --> 
						    <div class="form-group">
						        <label for="pr_lan_administrada" class="col-md-3 control-label">Incluye LAN administrada:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_lan_administrada" name="pr_lan_administrada">
						                	<option value="">Seleccionar...</option>
										    <option>Si</option>
	      									<option>No</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
				</div>
        	`;
        },

        // TELEFONIA FIJA
        formProduct_telefonia_fija: function(otp) {
            return `
        		<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario Cierre de Kickoff  <small>SERVICIO TELEFONIA FIJA</small></h2>
				<div class="widget bg_white m-t-25 d-inline-b cliente">

					<!-- Primera sesion: datos basicos de instalacion -->
					<legend class="f-s-15">DATOS BÁSICOS DE INSTALACION</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- CIUDAD -->
							<div class="form-group">
						        <label for="pr_ciudad" class="col-md-3 control-label">Ciudad:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-globe" ></i></span>
						                <input name="pr_ciudad" id="pr_ciudad" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- DIRECCIÓN -->
						    <div class="form-group">
						        <label for="pr_direccion" class="col-md-3 control-label">Dirección:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker	" ></i></span>
						                <input name="pr_direccion" id="pr_direccion" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- TIPO PREDIO: -->
						    <div class="form-group">
						        <label for="pr_tipo_predio" class="col-md-3 control-label">Tipo predio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_predio" name="pr_tipo_predio">
										    <option value="">Seleccionar...</option>
										    <option value="Edificio">Edificio</option>
	      									<option value="Casa">Casa</option>										    
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NIT del cliente: -->
						    <div class="form-group">
						        <label for="pr_nit_cliente" class="col-md-3 control-label">NIT cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
						                <input name="pr_nit_cliente" id="pr_nit_cliente" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							
							<!-- ALIAS DEL LUGAR (CODIGO DE SERVICIO//CIUDAD//SERVICIO//COMERCIO O SEDE DEL CLIENTE) -->
						    <div class="form-group">
						        <label for="pr_alias_lugar" class="col-md-3 control-label">Alias del lugar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
						                <input name="pr_alias_lugar" id="pr_alias_lugar" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- OTP -->
							<div class="form-group">
						        <label for="pr_id_ot_padre" class="col-md-3 control-label">OTP:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
						                <input name="pr_id_ot_padre" id="pr_id_ot_padre" class="form-control" type="number" readonly value="${otp}">
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- otp_asociadas -->
							<div class="form-group">
						        <label for="pr_otp_asociada" class="col-md-3 control-label">OTP asociadas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_otp_asociada" id="pr_otp_asociada" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TIPO DE TELEFONIA FIJA: -->
						    <div class="form-group">
						        <label for="pr_tipo_telefonia" class="col-md-3 control-label">Tipo telefonia fija:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_telefonia" name="pr_tipo_telefonia">
										    <option value="">Seleccionar...</option>
										    <option value="Telefonia Pública - Líneas Análogas">Telefonia Pública - Líneas Análogas</option>
	      									<option value="Telefonia Pública - Líneas E1 - R2">Telefonia Pública - Líneas E1 - R2</option>
	      									<option value="Telefonia Pública - Líneas E1 - PRI">Telefonia Pública - Líneas E1 - PRI</option>
	      									<option value="Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)">Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
	      									<option value="Telefonia Pública - Línea SIP (Centralizado)">Telefonia Pública - Línea SIP (Centralizado)</option> 		
	      									<option value="PBX Distribuida - Línea SIP  (Troncal IP Ethernet con Audiocodec o GW Cisco)">PBX Distribuida - Línea SIP  (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
	      									<option value="PBX Distribuida - Línea SIP  (Centralizado)">PBX Distribuida - Línea SIP  (Centralizado)</option> 		
	      									<option value="PBX Distribuida  Linea E1 -R2">PBX Distribuida  Linea E1 -R2</option> 		
	      									<option value="PBX Distribuida  Linea E1 -PRI">PBX Distribuida  Linea E1 -PRI</option>
	      									<option value="Telefonia Corporativa">Telefonia Corporativa</option> 								    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- ancho_banda -->
							<div class="form-group">
						        <label for="pr_ancho_banda" class="col-md-3 control-label">Ancho de banda:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
						                <input name="pr_ancho_banda" id="pr_ancho_banda" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>		

						    <!-- TIPO INSTALACION: -->
						     <div class="form-group">
						        <label for="pr_tipo_instalacion" class="col-md-3 control-label">Tipo instalación:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_instalacion" name="pr_tipo_instalacion">
										    <option value="">Seleccionar...</option>
										    <option value="Instalar UM con PE">Instalar UM con PE</option>
	      									<option value="Instalar UM con PE sobre OTP de Pymes">Instalar UM con PE sobre OTP de Pymes</option>
	      									<option value="Instalar UM con CT (Solo Acceso Fibra)">Instalar UM con CT (Solo Acceso Fibra)</option>
	      									<option value="Instalar UM en Datacenter Claro- Cableado">Instalar UM en Datacenter Claro- Cableado</option>
	      									<option value="Instalar UM en Datacenter Claro- Implementación">Instalar UM en Datacenter Claro- Implementación</option>
	      									<option value="UM existente. Requiere Cambio de equipo">UM existente. Requiere Cambio de equipo</option> 	
	      									<option value="UM existente. Requiere Adición de equipo">UM existente. Requiere Adición de equipo</option>
	      									<option value="UM existente. Solo configuración">UM existente. Solo configuración</option> 							    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- ID SERVICIO ACTUAL (Aplica para UM Existente) -->
							<div class="form-group">
						        <label for="pr_servicio_actual" class="col-md-3 control-label">ID servicio Actual(Aplica para UM Existente):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
						                <input name="pr_servicio_actual" id="pr_servicio_actual" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<!-- Segunda sesion: INFORMACIÓN  ULTIMA MILLA -->
					<legend class="f-s-15">INFORMACIÓN  ULTIMA MILLA</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
						    <div class="form-group">
						        <label for="pr_requiere_um" class="col-md-3 control-label">¿Requiere instalación UM?</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_um" name="pr_requiere_um">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>   												
	      									<option value="Existente">Existente</option> 	    
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- PROVEEDOR: -->
						    <div class="form-group">
						        <label for="pr_proveedor" class="col-md-3 control-label">Proveedor:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_proveedor" name="pr_proveedor">
										    <option value="">Seleccionar...</option>
										    <option value="No aplica">No aplica</option>
	      									<option value="Existente">Existente</option>
	      									<option value="Claro">Claro</option>
	      									<option value="Axesat">Axesat</option>
	      									<option value="Comcel">Comcel</option> 	
	      									<option value="Tigo">Tigo</option> 		
	      									<option value="Media Commerce">Media Commerce</option> 		
	      									<option value="Diveo">Diveo</option>
	      									<option value="Edatel">Edatel</option> 	
	      									<option value="UNE">UNE</option> 		
	      									<option value="ETB">ETB</option> 	
	      									<option value="IBM">IBM</option> 		
	      									<option value="IFX">IFX</option> 		
	      									<option value="Level 3 Colombia">Level 3 Colombia</option>
	      									<option value="Mercanet">Mercanet</option> 	
	      									<option value="Metrotel">Metrotel</option> 		
	      									<option value="Promitel">Promitel</option> 		
	      									<option value="Skynet">Skynet</option> 		
	      									<option value="Telebucaramanga">Telebucaramanga</option>
	      									<option value="Telecom">Telecom</option> 	
	      									<option value="Terremark">Terremark</option> 		
	      									<option value="Sol Cable Vision">Sol Cable Vision</option> 		
	      									<option value="Sistelec">Sistelec</option>
	      									<option value="Opain">Opain</option> 	
	      									<option value="Airplan - (Información y Tecnologia)">Airplan - (Información y Tecnologia)</option> 		
	      									<option value="TV Azteca">TV Azteca</option> 						    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- MEDIO -->
						    <div class="form-group">
						        <label for="pr_medio" class="col-md-3 control-label">Medio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_medio" name="pr_medio">
										    <option value="">Seleccionar...</option>
										    <option value="No Aplica">No Aplica</option>  									   									
										    <option value="Existente">Existente</option> 	   
										    <option value="Fibra">Fibra</option>
										    <option value="Cobre">Cobre</option>
										    <option value="Satelital">Satelital</option> 
										    <option value="Radio enlace">Radio enlace</option>
										    <option value="3G">3G</option>
										    <option value="UTP">UTP</option>
										</select>
						            </div>
						        </div>
						    </div>

							<!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
						    <div class="form-group">
						        <label for="pr_tipo_conector" class="col-md-3 control-label">Tipo conector(Aplica FO Claro):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_conector" name="pr_tipo_conector">
										    <option value="">Seleccionar...</option>
										    <option value="LC">LC</option>  									   									
										    <option value="SC">SC</option> 	   
										    <option value="ST">ST</option>
										    <option value="FC">FC</option>
										</select>
						            </div>
						        </div>
						    </div>
											    
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- INTERFACE DE ENTREGA AL CLIENTE: -->
						    <div class="form-group">
						        <label for="pr_interfaz_entrega_cliente" class="col-md-3 control-label">Interface de entrega al cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_interfaz_entrega_cliente" name="pr_interfaz_entrega_cliente">
										    <option value="">Seleccionar...</option>
										    <option value="No aplica">No aplica</option>  									   									
										    <option value="Ethernet">Ethernet</option> 	   
										    <option value="Serial V.35">Serial V.35</option>
										    <option value="Giga (óptico)">Giga (óptico)</option>
										    <option value="Giga Ethernet (Electrico)">Giga Ethernet (Electrico)</option>		   									
										    <option value="STM-1">STM-1</option> 	   
										    <option value="RJ45 - 120 OHM">RJ45 - 120 OHM</option>
										    <option value="G703 BNC">G703 BNC</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- REQUIERE VOC: -->
						    <div class="form-group">
						        <label for="pr_requiere_voc" class="col-md-3 control-label">Requiere VOC:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_voc" name="pr_requiere_voc">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>  									   									
										    <option value="No">No</option> 	  										    
										</select>
						            </div>
						        </div>
						    </div>

						</fieldset>

						<fieldset class="col-md-6">

							<!-- PROGRAMACIÓN DE VOC: -->
						    <div class="form-group">
						        <label for="pr_programacion_voc" class="col-md-3 control-label">Programación de VOC:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_programacion_voc" name="pr_programacion_voc">
										    <option value="">Seleccionar...</option>
										    <option value="Programada">Programada</option>  									   									
										    <option value="No requiere programación">No requiere programación</option> 	   
										    <option value="No programada. Otra ciudad">No programada. Otra ciudad</option>
										    <option value="No programada. Cliente solicita ser contactado en fecha ">No programada. Cliente solicita ser contactado en fecha </option> 	 										    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<!-- Tercera sesion: REQUERIMIENTOS PARA ENTREGA DEL SERVICIO -->
					<legend class="f-s-15">REQUERIMIENTOS PARA ENTREGA DEL SERVICIO</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- REQUIERE RFC : -->
						    <div class="form-group">
						        <label for="pr_requiere_rfc" class="col-md-3 control-label">Requiere RFC:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_rfc" name="pr_requiere_rfc">
										    <option value="">Seleccionar...</option>
										    <option value="SI => Cliente Critico Punto Central">SI => Cliente Critico Punto Central</option>
	      									<option value="SI => Servicio Critico (Listado)">SI => Servicio Critico (Listado)</option>							
	      									<option value="SI => Cliente Critico">SI => Cliente Critico</option> 	    
	      									<option value="SI => RFC Estándar Saturación">SI => RFC Estándar Saturación</option>
	      									<option value="SI => Cliente Critico Punto Central - RFC Estándar Saturación">SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
	      									<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Conversor Medio: -->
				            <div class="form-group">
						        <label for="pr_conversor_medio" class="col-md-3 control-label">Conversor Medio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_conversor_medio" id="pr_conversor_medio" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- Referencia Router: -->
				            <div class="form-group">
						        <label for="pr_referencia_router" class="col-md-3 control-label">Referencia Router:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_referencia_router" id="pr_referencia_router" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Modulos o Tarjetas: -->
				            <div class="form-group">
						        <label for="pr_modulos_tarjetas" class="col-md-3 control-label">Modulos o Tarjetas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_modulos_tarjetas" id="pr_modulos_tarjetas" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- Licencias --> 
						    <div class="form-group">
						        <label for="pr_licencias" class="col-md-3 control-label">Licencias:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_licencias" id="pr_licencias" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Equipos Adicionale--> 
						    <div class="form-group">
						        <label for="pr_equipos_adicionales" class="col-md-3 control-label">Equipos adicionale:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_equipos_adicionales" id="pr_equipos_adicionales" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- Consumibles--> 
						    <div class="form-group">
						        <label for="pr_consumibles" class="col-md-3 control-label">Consumibles:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_consumibles" name="pr_consumibles">
										    <option value="">Seleccionar...</option>
										    <option value="Bandeja">Bandeja</option>
	      									<option value="Cables de poder">Cables de poder</option>
	      									<option value="Clavijas de conexión">Clavijas de conexión</option>
	      									<option value="Accesorios para rackear (Orejas)">Accesorios para rackear (Orejas)</option>
	      									<option value="Balum">Balum</option>
	      									<option value="No aplica">No aplica</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA -->
						    <div class="form-group">
						        <label for="pr_carta_valorizada" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_carta_valorizada" name="pr_carta_valorizada">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<!-- Cuarta sesion: DATOS DEL CONTACTO PARA COMUNICACIÓN  -->
					<legend class="f-s-15">DATOS DEL CONTACTO PARA COMUNICACIÓN </legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- NOMBRE --> 
						    <div class="form-group">
						        <label for="pr_nombre_1" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre_1" id="pr_nombre_1" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="pr_telefono_1" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="fijo glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono_1" id="pr_telefono_1" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- CELULAR --> 
						    <div class="form-group">
						        <label for="pr_celular_1" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular_1" id="pr_celular_1" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="pr_correo_1" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_correo_1" id="pr_correo_1" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<!-- Quinta sesion: DATOS CLIENTE: TÉCNICO  -->
					<legend class="f-s-15">DATOS CLIENTE: TÉCNICO </legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- NOMBRE --> 
						    <div class="form-group">
						        <label for="pr_nombre_2" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre_2" id="pr_nombre_2" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="pr_telefono_2" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono_2" id="pr_telefono_2" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- CELULAR --> 
						    <div class="form-group">
						        <label for="pr_celular_2" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular_2" id="pr_celular_2" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="pr_correo_2" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_correo_2" id="pr_correo_2" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						

							<!-- OBSERVACIONES:  --> 
						    <div class="form-group">
						        <label for="pr_observaciones" class="col-md-2 control-label">Observaciones:</label>
						        <div class="col-md-10 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <textarea name="pr_observaciones" id="pr_observaciones" class="form-control"></textarea>
						            </div>
						        </div>
						    </div>
				
					</div>

					<!-- Sexta sesion: KIKOFF TECNICO  -->
					<legend class="f-s-15">KIKOFF TECNICO </legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- Activación de PLAN LD CON COSTO (0 $): -->
						    <div class="form-group">
						        <label for="pr_activacion_plan" class="col-md-3 control-label">Activación plan LD con costo(0 $):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_activacion_plan" name="pr_activacion_plan">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

							<!-- Equipo Cliente: -->
						     <div class="form-group">
						        <label for="pr_equipo_cliente" class="col-md-3 control-label">Equipo Cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_equipo_cliente" name="pr_equipo_cliente">
										    <option value="">Seleccionar...</option>
										    <option value="Teléfonos analogos">Teléfonos analogos</option>
	      									<option value="Planta E1">Planta E1</option>
	      									<option value="Planta IP">Planta IP</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- Interfaz Equipos Cliente: -->
						    <div class="form-group">
						        <label for="pr_interfaz_equipo_cliente" class="col-md-3 control-label">Interfaz equipos cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_interfaz_equipo_cliente" name="pr_interfaz_equipo_cliente">
										    <option value="">Seleccionar...</option>
										    <option value="FXS">FXS</option>
	      									<option value="RJ11">RJ11</option>
	      									<option value="RJ45">RJ45</option>
	      									<option value="RJ48">RJ48</option>
	      									<option value="BNC ">BNC </option>	
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad Lineas Básicas (Solo Telefonia Pública Líneas Análogas):  --> 
						    <div class="form-group">
						        <label for="pr_cantidad_lineas_basicas" class="col-md-3 control-label">Cantidad Lineas Básicas(Telef. Pública Líneas Análogas):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cantidad_lineas_basicas" id="pr_cantidad_lineas_basicas" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>						    

						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- Conformación PBX (Solo Telefonia Pública Líneas Análogas)  --> 
						    <div class="form-group">
						        <label for="pr_conformacion_pbx" class="col-md-3 control-label">Confirmación PBX(Telef. Pública Líneas Análogas):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_conformacion_pbx" id="pr_conformacion_pbx" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>


						    <!-- Cantidad de DID Solicitados  --> 
						    <div class="form-group">
						        <label for="pr_cant_did_solicitados" class="col-md-3 control-label">Cantidad DID Solicitados:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_did_solicitados" id="pr_cant_did_solicitados" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							</fieldset>

						<fieldset class="col-md-6">

							
							<!-- Cantidad Canales: -->
						    <div class="form-group">
						        <label for="pr_cant_canales" class="col-md-3 control-label">Cantidad Canales:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
						                <input name="pr_cant_canales" id="pr_cant_canales" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						    <!-- Numero Cabecera PBX: -->
						    <div class="form-group">
						        <label for="pr_num_cabezera_pbx" class="col-md-3 control-label">Número Cabecera PBX:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_num_cabezera_pbx" name="pr_num_cabezera_pbx">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- FAX TO MAIL: -->
						    <div class="form-group">
						        <label for="pr_fax_email" class="col-md-3 control-label">Fax to mail:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-print" ></i></span>
						                <select class="form-control" id="pr_fax_email" name="pr_fax_email">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO VIRTUAL: -->
						    <div class="form-group">
						        <label for="pr_telefono_virtual" class="col-md-3 control-label">Teléfono virtual:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
						                <select class="form-control" id="pr_telefono_virtual" name="pr_telefono_virtual">
										    <option value="">Seleccionar...</option>
										    <option value="SI (SOLICITAR LICENCIA A LIDER TECNICO GRUPO ASE)">SI (SOLICITAR LICENCIA A LIDER TECNICO GRUPO ASE)</option>
	      									<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- Requiere Permisos para Larga Distancia Nacional:: -->
						    <div class="form-group">
						        <label for="pr_permisos_larga_distancia" class="col-md-3 control-label">Requiere Permisos Larga Distancia Nacional:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_permisos_larga_distancia" name="pr_permisos_larga_distancia">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
	      									<option value="No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff">No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Requiero Larga  Para Distancia  Internacional: -->
						    <div class="form-group">
						        <label for="pr_larga_distancia_internacional" class="col-md-3 control-label">Requiero Larga para Distancia Internacional:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_larga_distancia_internacional" name="pr_larga_distancia_internacional">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
	      									<option value="No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff">No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- Requiere Permisos para Móviles:-->
						    <div class="form-group">
						        <label for="pr_permisos_moviles" class="col-md-3 control-label">Requiere Permisos para Móviles:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <select class="form-control" id="pr_permisos_moviles" name="pr_permisos_moviles">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
	      									<option value="No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff">No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Requiere Permisos para Local Extendida: -->
						    <div class="form-group">
						        <label for="pr_permiso_local_extendida" class="col-md-3 control-label">Requiere Permisos para Local Extendida:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <select class="form-control" id="pr_permiso_local_extendida" name="pr_permiso_local_extendida">
										    <option value="">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
	      									<option value="No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff">No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
						</fieldset>
					</div>

					<!-- Septima sesion: NUMERACIÓN SOLO DILIGENCIAR PARA LA OPCIÓN  PBX DISTRIBUIDO  -->
					<legend class="f-s-15">NUMERACIÓN SOLO DILIGENCIAR PARA LA OPCIÓN  PBX DISTRIBUIDO </legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25  d-inline-b cliente">
								<legend class="f-s-15">Bogotá</legend>
								<div class="form-group">
						        <label for="pr_bog_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_bog_requiere" name="pr_bog_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_bog_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_bog_numeracion" name="pr_bog_numeracion">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
										    <option value="No Requiere">No Requiere</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_bog_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_bog_cantidad" id="pr_bog_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Tunja</legend>
								<div class="form-group">
						        <label for="pr_tun_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tun_requiere" name="pr_tun_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_tun_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tun_numeracion" name="pr_tun_numeracion">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
										    <option value="No Requiere">No Requiere</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_tun_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_tun_cantidad" id="pr_tun_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Villavicencio</legend>
								<div class="form-group">
							        <label for="pr_vill_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_vill_requiere" name="pr_vill_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_vill_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_vill_numeracion" name="pr_vill_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_vill_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_vill_cantidad" id="pr_vill_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Facatativa</legend>
								<div class="form-group">
						        <label for="pr_fac_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_fac_requiere" name="pr_fac_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_fac_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_fac_numeracion" name="pr_fac_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_fac_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_fac_cantidad" id="pr_fac_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Girardot</legend>
								<div class="form-group">
						        <label for="pr_gir_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_gir_requiere" name="pr_gir_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_gir_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_gir_numeracion" name="pr_gir_numeracion">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
										    <option value="No Requiere">No Requiere</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_gir_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_gir_cantidad" id="pr_gir_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Yopal</legend>
								<div class="form-group">
						        <label for="pr_yop_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_yop_requiere" name="pr_yop_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_yop_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_yop_numeracion" name="pr_yop_numeracion">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
										    <option value="No Requiere">No Requiere</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_yop_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_yop_cantidad" id="pr_yop_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">cali</legend>
								<div class="form-group">
						        <label for="pr_cali_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_cali_requiere" name="pr_cali_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_cali_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_cali_numeracion" name="pr_cali_numeracion">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
										    <option value="No Requiere">No Requiere</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cali_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cali_cantidad" id="pr_cali_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Buenaventura</legend>
								 <div class="form-group">
						        <label for="pr_bave_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_bave_requiere" name="pr_bave_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_bave_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_bave_numeracion" name="pr_bave_numeracion">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
										    <option value="No Requiere">No Requiere</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_bave_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_bave_cantidad" id="pr_bave_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Pasto</legend>
								<div class="form-group">
						        <label for="pr_pas_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_pas_requiere" name="pr_pas_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_pas_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_pas_numeracion" name="pr_pas_numeracion">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
										    <option value="No Requiere">No Requiere</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_pas_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_pas_cantidad" id="pr_pas_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Popayán</legend>
								<div class="form-group">
						        <label for="pr_pop_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_pop_requiere" name="pr_pop_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_pop_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_pop_numeracion" name="pr_pop_numeracion">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
										    <option value="No Requiere">No Requiere</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_pop_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_pop_cantidad" id="pr_pop_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Neiva</legend>
								<div class="form-group">
						        <label for="pr_nei_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_nei_requiere" name="pr_nei_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_nei_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_nei_numeracion" name="pr_nei_numeracion">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
										    <option value="No Requiere">No Requiere</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_nei_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_nei_cantidad" id="pr_nei_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Medellín</legend>
								<div class="form-group">
						        <label for="pr_med_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_med_requiere" name="pr_med_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_med_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_med_numeracion" name="pr_med_numeracion">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
										    <option value="No Requiere">No Requiere</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_med_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_med_cantidad" id="pr_med_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Barranquilla</legend>
								 <div class="form-group">
						        <label for="pr_bar_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_bar_requiere" name="pr_bar_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_bar_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_bar_numeracion" name="pr_bar_numeracion">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
										    <option value="No Requiere">No Requiere</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_bar_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_bar_cantidad" id="pr_bar_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Cartagena</legend>
								<div class="form-group">
						        <label for="pr_cart_requiere" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_cart_requiere" name="pr_cart_requiere">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_cart_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_cart_numeracion" name="pr_cart_numeracion">
										    <option value="">Seleccionar...</option>
	      									<option value="SI">SI</option>
										    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
										    <option value="No Requiere">No Requiere</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cart_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cart_cantidad" id="pr_cart_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Santa Marta: -->
							    <legend class="f-s-15"> Santa Marta </legend>
							    <div class="form-group">
							        <label for="pr_stm_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_stm_requiere" name="pr_stm_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_stm_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_stm_numeracion" name="pr_stm_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_stm_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_stm_cantidad" id="pr_stm_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Monteria: -->
							    <legend class="f-s-15"> Monteria </legend>
							    <div class="form-group">
							        <label for="pr_mon_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_mon_requiere" name="pr_mon_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_mon_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_mon_numeracion" name="pr_mon_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_mon_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_mon_cantidad" id="pr_mon_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Valledupar: -->
							    <legend class="f-s-15"> Valledupar </legend>
							    <div class="form-group">
							        <label for="pr_vall_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_vall_requiere" name="pr_vall_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_vall_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_vall_numeracion" name="pr_vall_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_vall_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_vall_cantidad" id="pr_vall_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Sincelejo: -->
							    <legend class="f-s-15"> Sincelejo </legend>
							    <div class="form-group">
							        <label for="pr_sinc_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_sinc_requiere" name="pr_sinc_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_sinc_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_sinc_numeracion" name="pr_sinc_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_sinc_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_sinc_cantidad" id="pr_sinc_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Pereira: -->
							    <legend class="f-s-15"> Pereira </legend>
							    <div class="form-group">
							        <label for="pr_per_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_per_requiere" name="pr_per_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_per_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_per_numeracion" name="pr_per_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_per_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_per_cantidad" id="pr_per_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Armenia: -->
							    <legend class="f-s-15"> Armenia </legend>
							    <div class="form-group">
							        <label for="pr_arme_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_arme_requiere" name="pr_arme_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_arme_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_arme_numeracion" name="pr_arme_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_arme_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_arme_cantidad" id="pr_arme_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Manizalez: -->
							    <legend class="f-s-15"> Manizalez: </legend>
							    <div class:="form-group">
							        <label for="pr_man_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_man_requiere" name="pr_man_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_man_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_man_numeracion" name="pr_man_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_man_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_man_cantidad" id="pr_man_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Ibaué: -->
							    <legend class="f-s-15"> Ibaué: </legend>
							    <div class:="form-group">
							        <label for="pr_iba_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_iba_requiere" name="pr_iba_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_iba_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_iba_numeracion" name="pr_iba_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_iba_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_iba_cantidad" id="pr_iba_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Cucutá: -->
							    <legend class="f-s-15"> Cucutá: </legend>
							    <div class:="form-group">
							        <label for="pr_cuc_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_cuc_requiere" name="pr_cuc_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_cuc_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_cuc_numeracion" name="pr_cuc_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cuc_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cuc_cantidad" id="pr_cuc_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Bucaramanga: -->
							    <legend class="f-s-15"> Bucaramanga: </legend>
							    <div class:="form-group">
							        <label for="pr_buc_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_buc_requiere" name="pr_buc_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_buc_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_buc_numeracion" name="pr_buc_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_buc_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_buc_cantidad" id="pr_buc_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Duitama : -->
							    <legend class="f-s-15"> Duitama : </legend>
							    <div class:="form-group">
							        <label for="pr_dui_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_dui_requiere" name="pr_dui_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_dui_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_dui_numeracion" name="pr_dui_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_dui_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_dui_cantidad" id="pr_dui_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Sogamoso: -->
							    <legend class="f-s-15"> Sogamoso: </legend>
							    <div class:="form-group">
							        <label for="pr_sog_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_sog_requiere" name="pr_sog_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_sog_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_sog_numeracion" name="pr_sog_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_sog_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_sog_cantidad" id="pr_sog_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Flandes: -->
							    <legend class="f-s-15"> Flandes: </legend>
							    <div class:="form-group">
							        <label for="pr_flan_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_flan_requiere" name="pr_flan_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_flan_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_flan_numeracion" name="pr_flan_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_flan_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_flan_cantidad" id="pr_flan_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Rivera: -->
							    <legend class="f-s-15"> Rivera: </legend>
							    <div class:="form-group">
							        <label for="pr_riv_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_riv_requiere" name="pr_riv_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_riv_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_riv_numeracion" name="pr_riv_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_riv_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_riv_cantidad" id="pr_riv_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Aipe -->
							    <legend class="f-s-15"> Aipe </legend>
							    <div class:="form-group">
							        <label for="pr_aipe_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_aipe_requiere" name="pr_aipe_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_aipe_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_aipe_numeracion" name="pr_aipe_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_aipe_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_aipe_cantidad" id="pr_aipe_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
							    <!-- Lebrija: -->
							    <legend class="f-s-15"> Lebrija: </legend>
							    <div class:="form-group">
							        <label for="pr_leb_requiere" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_leb_requiere" name="pr_leb_requiere">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="No">No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_leb_numeracion" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_leb_numeracion" name="pr_leb_numeracion">
											    <option value="">Seleccionar...</option>
		      									<option value="SI">SI</option>
											    <option value="NO - Escalar a Soporte Comercial">NO - Escalar a Soporte Comercial</option>
											    <option value="No Requiere">No Requiere</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_leb_cantidad" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_leb_cantidad" id="pr_leb_cantidad" class="form-control" type="number" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
					</div>
				</div>
        	`;
        }

        //PUNTA DATACENTER NO TIENE NADA QUE LO DISPARE
        //     formProduct_punta_datacenter: function(otp){
        //     	return `
        //     		<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario Cierre de Kickoff  <small>PUNTO DATACENTER</small></h2>
        // <div class="widget bg_white m-t-25 d-inline-b cliente">
        // 	<legend class="f-s-15">DATOS BÁSICOS DE INSTALACION </legend>
        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- CIUDAD -->
        // 			<div class="form-group">
        // 		        <label for="pr_ciudad" class="col-md-3 control-label">Ciudad:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-globe" ></i></span>
        // 		                <input name="pr_ciudad" id="pr_ciudad" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- DIRECCIÓN:-->
        // 		    <div class="form-group">
        // 		        <label for="pr_direccion" class="col-md-3 control-label">Dirección:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
        // 		                <input name="pr_direccion" id="pr_direccion" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- TIPO PREDIO: -->
        // 		    <div class="form-group">
        // 		        <label for="pr_tipo_predio" class="col-md-3 control-label">Tipo predio:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
        // 		                <select class="form-control" id="pr_tipo_predio" name="pr_tipo_predio">
        // 						    <option value="">Seleccionar...</option>
        // 						    <option value="Edificio">Edificio</option>
        //    						<option value="Casa">Casa</option>									    
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- NIT del cliente: -->
        // 		    <div class="form-group">
        // 		        <label for="pr_nit_cliente" class="col-md-3 control-label">NIT del cliente:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
        // 		                <input name="pr_nit_cliente" id="pr_nit_cliente" class="form-control" type="number" >
        // 		            </div>
        // 		        </div>
        // 		    </div>							    
        // 		</fieldset>
        // 	</div>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- ALIAS DEL LUGAR  -->
        // 		    <div class="form-group">
        // 		        <label for="pr_alias_lugar" class="col-md-3 control-label">Alias del lugar:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
        // 		                <input name="pr_alias_lugar" id="pr_alias_lugar" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- OTP -->
        // 			<div class="form-group">
        // 		        <label for="pr_otp" class="col-md-3 control-label">OTP:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
        // 		                <input name="pr_otp" id="pr_otp" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- otp_asociadas -->
        // 			<div class="form-group">
        // 		        <label for="pr_otp_asociada" class="col-md-3 control-label">OTP asociadas:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_otp_asociada" id="pr_otp_asociada" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		     <!-- TIPO DE SERIVICIO: -->
        // 		    <div class="form-group">
        // 		        <label for="pr_tipo_servicio" class="col-md-3 control-label">Tipo de servicio:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 		                <select class="form-control" id="pr_tipo_servicio" name="pr_tipo_servicio">
        // 						    <option value="">Seleccionar...</option>
        // 						    <option value="MPLS Avanzado Intranet con Punta en Rack de Appliance (Componente Datacenter)">MPLS Avanzado Intranet con Punta en Rack de Appliance (Componente Datacenter)</option>
        //    									<option value="MPLS Avanzado Extranet con Punta en Rack de Appliance (Componente Datacenter)">MPLS Avanzado Extranet con Punta en Rack de Appliance (Componente Datacenter)</option>
        //    									<option value="MPLS Transaccional con Punta en Rack de Appliance">MPLS Transaccional con Punta en Rack de Appliance</option>
        //    									<option value="PL Ethernet Local - P2P con Punta en Rack de Appliance">PL Ethernet Local - P2P con Punta en Rack de Appliance</option>
        //    									<option value="PL Ethernet Local - P2MP con Punta en Rack de Appliance">PL Ethernet Local - P2MP con Punta en Rack de Appliance</option> 
        //    									<option value="PL Ethernet Nacional - P2P con Punta en Rack de Appliance">PL Ethernet Nacional - P2P con Punta en Rack de Appliance</option>						
        //    									<option value="PL Ethernet Nacional - P2MP con Punta en Rack de Appliance">PL Ethernet Nacional - P2MP con Punta en Rack de Appliance</option>						
        //    									<option value="PL Ethernet - VPRN con Punta en Rack de Appliance">PL Ethernet - VPRN con Punta en Rack de Appliance</option>	
        //    									<option value="Telefonia Pública - Líneas Análogas con Punta en Rack de Appliance">Telefonia Pública - Líneas Análogas con Punta en Rack de Appliance</option>						
        //    									<option value="Telefonia Pública - Líneas E1 - R2 con Punta en Rack de Appliance">Telefonia Pública - Líneas E1 - R2 con Punta en Rack de Appliance</option>						
        //    									<option value="Telefonia Pública - Líneas E1 - PRI con Punta en Rack de Appliance">Telefonia Pública - Líneas E1 - PRI con Punta en Rack de Appliance</option>						
        //    									<option value="Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) con Punta en Rack de Appliance">Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) con Punta en Rack de Appliance</option>		
        //    									<option value="PBX Distribuida - Línea SIP  (Troncal IP Ethernet con Audiocodec o GW Cisco) con Punta en Rack de Appliance">PBX Distribuida - Línea SIP  (Troncal IP Ethernet con Audiocodec o GW Cisco) con Punta en Rack de Appliance</option>		
        //    									<option value="PBX Distribuida - Línea SIP  (Centralizado) con Punta en Rack de Appliance">PBX Distribuida - Línea SIP  (Centralizado) con Punta en Rack de Appliance</option>				
        //    									<option value="PBX Distribuida  Linea E1 -R2 con Punta en Rack de Appliance">PBX Distribuida  Linea E1 -R2 con Punta en Rack de Appliance</option>						
        //    									<option value="PBX Distribuida  Linea E1 -PRI con Punta en Rack de Appliance">PBX Distribuida  Linea E1 -PRI con Punta en Rack de Appliance</option>						
        //    									<option value="Telefonia Corporativa con Punta en Rack de Appliance">Telefonia Corporativa con Punta en Rack de Appliance</option>	
        //    									<option value="Migración Topologia Backend a Rack de Appliance">Migración Topologia Backend a Rack de Appliance</option>			
        //    									<option value="Migración Claro Connect a Rack de Appliance">Migración Claro Connect a Rack de Appliance</option>						
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>	

        // 		</fieldset>
        // 	</div>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- ancho_banda -->
        // 			<div class="form-group">
        // 		        <label for="pr_ancho_banda" class="col-md-3 control-label">Ancho de banda:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
        // 		                <input name="pr_ancho_banda" id="pr_ancho_banda" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- TIPO INSTALACION: -->
        // 		    <div class="form-group">
        // 		        <label for="pr_tipo_instalacion" class="col-md-3 control-label">Tipo instalación:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 		                <select class="form-control" id="pr_tipo_instalacion" name="pr_tipo_instalacion">
        // 						    <option value="">Seleccionar...</option>
        // 						    <option value="Instalar UM en Datacenter Claro- Cableado">Instalar UM en Datacenter Claro- Cableado</option>
        // 						    <option value="Instalar UM en Datacenter Claro- Implementación">Instalar UM en Datacenter Claro- Implementación</option>
        //    									<option value="UM existente. Requiere Cambio de equipo">UM existente. Requiere Cambio de equipo</option>
        //    									<option value="UM existente. Requiere Adición de equipo">UM existente. Requiere Adición de equipo</option>					    
        //    									<option value="UM existente. Solo configuración">UM existente. Solo configuración</option>					    
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- ID SERVICIO ACTUAL -->
        // 			<div class="form-group">
        // 		        <label for="pr_id_servicio_actual" class="col-md-3 control-label">ID SERVICIO ACTUAL(Aplica para UM Existente):</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
        // 		                <input name="pr_id_servicio_actual" id="pr_id_servicio_actual" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		</fieldset>
        // 	</div>

        // 	<legend class="f-s-15">DATOS BÁSICOS DE INSTALACION </legend>	

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- NOMBRE --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_nombre_1" class="col-md-3 control-label">Nombre:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
        // 		                <input name="pr_nombre_1" id="pr_nombre_1" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- TELEFONO --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_telefono_1" class="col-md-3 control-label">Telefono:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
        // 		                <input name="pr_telefono_1" id="pr_telefono_1" class="form-control" type="number" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- CELULAR --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_celular_1" class="col-md-3 control-label">Celular:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
        // 		                <input name="pr_celular_1" id="pr_celular_1" class="form-control" type="number" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- EMAIL --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_email_1" class="col-md-3 control-label">Email:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
        // 		                <input name="pr_email_1" id="pr_email_1" class="form-control" type="email" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<legend class="f-s-15">REQUERIMIENTOS PARA ENTREGA DEL SERVICIO</legend>	

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- REQUIERE RFC:--> 
        // 		    <div class="form-group">
        // 		        <label for="pr_crequiere_rfc" class="col-md-3 control-label">Requiere RFC:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 						<select name="pr_crequiere_rfc" id="pr_crequiere_rfc">
        // 							<option value="">Seleccionar...</option>
        // 							<option value="SI => Cliente Critico Punto Central">SI => Cliente Critico Punto Central</option>
        // 							<option value="SI => Servicio Critico (Listado)">SI => Servicio Critico (Listado)</option>
        // 							<option value="SI => Cliente Critico">SI => Cliente Critico</option>
        // 							<option value="SI => RFC Estándar Saturación">SI => RFC Estándar Saturación</option>
        // 							<option value="SI => Cliente Critico Punto Central - RFC Estándar Saturación">SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
        // 							<option value="No">No</option>
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- Conversor Medio: -->
        //             <div class="form-group">
        // 		        <label for="pr_conversor_medio" class="col-md-3 control-label">Conversor Medio:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_conversor_medio" id="pr_conversor_medio" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- Referencia Router: -->
        //             <div class="form-group">
        // 		        <label for="pr_referencia_router" class="col-md-3 control-label">Referencia Router:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
        // 		                <input name="pr_referencia_router" id="pr_referencia_router" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- Modulos o Tarjetas: -->
        //             <div class="form-group">
        // 		        <label for="pr_modulo_tarjeta" class="col-md-3 control-label">Modulos o Tarjetas:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_modulo_tarjeta" id="pr_modulo_tarjeta" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>								
        // 		</fieldset>
        // 	</div>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- Licencias --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_licencias" class="col-md-3 control-label">Licencias:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_licencias" id="pr_licencias" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- Equipos Adicionale--> 
        // 		    <div class="form-group">
        // 		        <label for="pr_equipos_adicionales" class="col-md-3 control-label">Equipos adicionale:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_equipos_adicionales" id="pr_equipos_adicionales" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- Consumibles--> 
        // 		    <div class="form-group">
        // 		        <label for="pr_consumibles" class="col-md-3 control-label">Consumibles:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 						<select name="pr_consumibles" id="pr_consumibles">
        // 							<option value="">Seleccionar...</option>
        // 							<option value="Bandeja">Bandeja</option>
        // 							<option value="Cables de Poder">Cables de Poder</option>
        // 							<option value="Clavijas de Conexión">Clavijas de Conexión</option>
        // 							<option value="Accesorios para rackear (Orejas)">Accesorios para rackear (Orejas)</option>
        // 							<option value="No Aplica">No Aplica</option>
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA:--> 
        // 		    <div class="form-group">
        // 		        <label for="pr_registro_carta" class="col-md-3 control-label">Registro de importación y carta valorizada:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 						<select name="pr_registro_carta" id="pr_registro_carta">
        // 							<option value="">Seleccionar...</option>
        // 							<option value="SI">SI</option>
        // 							<option value="NO">NO</option>
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<legend class="f-s-15">INFORMACIÓN  ULTIMA MILLA </legend>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- ¿esta ot requiere instalacion de  um?--> 
        // 		    <div class="form-group">
        // 		        <label for="pr_requiere_um" class="col-md-3 control-label">¿esta ot requiere instalacion de  um?</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 						<select name="pr_requiere_um" id="pr_requiere_um">
        // 							<option value="">Seleccionar...</option>
        // 							<option value="SI">SI</option>
        // 							<option value="NO">NO</option>
        // 							<option value="Existente">Existente</option>
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- Proveedor --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_proveedor" class="col-md-3 control-label">Proveedor</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 						<select name="pr_proveedor" id="pr_proveedor">
        // 							<option value="">Seleccionar...</option>
        // 							<option value="No aplica">No aplica</option>
        // 							<option value="Existente">Existente</option>
        // 							<option value="Axesat">Axesat</option>
        // 							<option value="Comcel">Comcel</option>
        // 							<option value="Tigo">Tigo</option>
        // 							<option value="Media Commerce">Media Commerce</option>
        // 							<option value="Diveo">Diveo</option>
        // 							<option value="Edatel">Edatel</option>
        // 							<option value="UNE">UNE</option>
        // 							<option value="ETB">ETB</option>
        // 							<option value="IBM">IBM</option>
        // 							<option value="IFX">IFX</option>
        // 							<option value="Level 3 Colombia">Level 3 Colombia</option>
        // 							<option value="Mercanet">Mercanet</option>
        // 							<option value="Metrotel">Metrotel</option>
        // 							<option value="Promitel">Promitel</option>
        // 							<option value="Skynet">Skynet</option>
        // 							<option value="Telebucaramanga">Telebucaramanga</option>
        // 							<option value="Telecom">Telecom</option>
        // 							<option value="Terremark">Terremark</option>
        // 							<option value="Sol Cable Vision">Sol Cable Vision</option>
        // 							<option value="Sistelec">Sistelec</option>
        // 							<option value="Opain">Opain</option>
        // 							<option value="Airplan - (Información y Tecnologia)">Airplan - (Información y Tecnologia)</option>
        // 							<option value="TV Azteca">TV Azteca</option>
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- MEDIO -->
        // 		    <div class="form-group">
        // 		        <label for="pr_medio" class="col-md-3 control-label">Medio:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 		                <select class="form-control" id="pr_medio" name="pr_medio">
        // 						    <option value="">Seleccionar...</option>
        // 						    <option value="No Aplica">No Aplica</option> 	   
        // 						    <option value="Existente">Existente</option>
        // 						    <option value="FIBRA">FIBRA</option>
        // 						    <option value="COBRE">COBRE</option> 
        // 						    <option value="SATELITAL">SATELITAL</option>
        // 						    <option value="RADIO ENLACE">RADIO ENLACE</option>
        // 						    <option value="3G">3G</option>
        // 						    <option value="UTP">UTP</option>
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- RESPUESTA FACTIBILIDAD BW > 100 MEGAS : -->
        //             <div class="form-group">
        // 		        <label for="pr_resp_factivilidad" class="col-md-3 control-label">Respuesta factibilidad BW > 100 Megas :</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_resp_factivilidad" id="pr_resp_factivilidad" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
        // 		    <div class="form-group">
        // 		        <label for="pr_tipo_conector" class="col-md-3 control-label">TIPO DE CONECTOR (Aplica para FO Claro):</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 		                <select class="form-control" id="pr_tipo_conector" name="pr_tipo_conector">
        // 						    <option value="">Seleccionar...</option>
        // 						    <option value="LC">LC</option>  								   									
        // 						    <option value="SC">SC</option> 	   
        // 						    <option value="ST">ST</option>
        // 						    <option value="FC">FC</option>
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- SDS DESTINO (Unifilar) -->
        // 			<div class="form-group">
        // 		        <label for="pr_sds_destino" class="col-md-3 control-label">SDS destino (Unifilar):</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_sds_destino" id="pr_sds_destino" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- OLT (GPON) : -->
        //             <div class="form-group">
        // 		        <label for="pr_olt" class="col-md-3 control-label">OLT (GPON) :</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_olt" id="pr_olt" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- INTERFACE DE ENTREGA AL CLIENTE: -->
        // 		    <div class="form-group">
        // 		        <label for="pr_interface_e_cliente" class="col-md-3 control-label">Interface de entrega al cliente:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 		                <select class="form-control" id="pr_interface_e_cliente" name="pr_interface_e_cliente">
        // 						    <option value="">Seleccionar...</option>
        // 						    <option value="No aplica">No aplica</option> 		   									
        // 						    <option value="Ethernet">Ethernet</option> 	   
        // 						    <option value="Serial V.35">Serial V.35</option>
        // 						    <option value="Giga (óptico)">Giga (óptico)</option>
        // 						    <option value="Giga Ethernet (Electrico)">Giga Ethernet (Electrico)</option>
        // 						    <option value="STM-1">STM-1</option>
        // 						    <option value="RJ45 - 120 OHM">RJ45 - 120 OHM</option>
        // 						    <option value="G703 BNC">G703 BNC</option>
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- OBSERVACIONES -->
        // 		    <div class="form-group">
        // 		        <label for="pr_observacion" class="col-md-3 control-label">Observaciones</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 						<textarea name="pr_observacion" id="pr_observacion"></textarea>
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		</fieldset>
        // 	</div>

        // 	<legend class="f-s-15">INFORMACIÓN DE CONEXIÓN  EN DATACENTER IMPLEMENTACIÓN </legend>

        // 	<legend class="f-s-15">PUNTO A - Equipo de acceso: Alcatel Triara</legend>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- equipo acceso : -->
        // 		    <div class="form-group">
        // 		        <label for="pr_equipos_1" class="col-md-3 control-label">Equipo de Acceso:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input type="text" name="pr_equipos_1" id="pr_equipos_1">
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- Puerto Equipo de Acceso: -->
        // 		    <div class="form-group">
        // 		        <label for="pr_puerto_1" class="col-md-3 control-label">Puerto Equipo de Acceso:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input type="text" name="pr_puerto_1" id="pr_puerto_1">
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- Tipo de Interface : -->
        // 		    <div class="form-group">
        // 		        <label for="pr_tipo_interface_1" class="col-md-3 control-label">Tipo de Interface :</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input type="text" name="pr_tipo_interface_1" id="pr_tipo_interface_1">
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<legend class="f-s-15">PUNTO B Equipo Claro - Rack: Appliance</legend>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- Equipo Claro: -->
        //             <div class="form-group">
        // 		        <label for="pr_equipo_c" class="col-md-3 control-label">Equipo Claro:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-wrench" ></i></span>
        // 		                <input name="pr_equipo_c" id="pr_equipo_c" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- Conector WAN: -->
        //             <div class="form-group">
        // 		        <label for="pr_conector_wan" class="col-md-3 control-label">Conector WAN:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-option-horizontal" ></i></span>
        // 		                <input name="pr_conector_wan" id="pr_conector_wan" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- Puerto LAN:  -->
        //             <div class="form-group">
        // 		        <label for="pr_puerto_lan" class="col-md-3 control-label">Puerto LAN: </label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-option-horizontal" ></i></span>
        // 		                <input name="pr_puerto_lan" id="pr_puerto_lan" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- Conector LAN:  -->
        //             <div class="form-group">
        // 		        <label for="pr_conector_lan" class="col-md-3 control-label">Conector LAN:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_conector_lan" id="pr_conector_lan" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- TOMAS REGULADAS REQUERIDAS  -->
        //             <div class="form-group">
        // 		        <label for="pr_tomas_r" class="col-md-3 control-label">TOMAS REGULADAS REQUERIDAS</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 		                <select name="pr_tomas_r" id="pr_tomas_r" class="form-control">
        // 		                	<option value=""></option>
        // 		                	<option value=""></option>
        // 		                	<option value=""></option>
        // 		                	<option value=""></option>					                	
        // 		                </select>
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<legend class="f-s-15">PUNTO C Equipo Cliente - Rack y Unidad de conexión:</legend>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- Equipos de conexion--> 
        // 		    <div class="form-group">
        // 		        <label for="pr_equipos_conexion" class="col-md-3 control-label">Equipo de conexión:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-wrench" ></i></span>
        // 		                <input name="pr_equipos_conexion" id="pr_equipos_conexion" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- Puerto Cliente--> 
        // 		    <div class="form-group">
        // 		        <label for="pr_puerto_cliente" class="col-md-3 control-label">Puerto Cliente</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_puerto_cliente" id="pr_puerto_cliente" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- Tipo de Interface  --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_tipo_interface" class="col-md-3 control-label">Tipo de Interface :</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_tipo_interface" id="pr_tipo_interface" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- TOMAS REGULADAS REQUERIDAS  -->
        //             <div class="form-group">
        // 		        <label for="pr_tomas_reguladas_2" class="col-md-3 control-label">Tomas reguladas requeridas</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <select name="pr_tomas_reguladas_2" id="pr_tomas_reguladas_2" class="form-control">
        // 		                	<option value=""></option>
        // 		                	<option value=""></option>
        // 		                	<option value=""></option>
        // 		                	<option value=""></option>					                	
        // 		                </select>
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- TOTAL UNIDADES DE RACK  -->
        //             <div class="form-group">
        // 		        <label for="pr_total_u" class="col-md-3 control-label">TOTAL UNIDADES DE RACK</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <select name="pr_total_u" id="pr_total_u" class="form-control">
        // 		                	<option value=""></option>
        // 		                	<option value=""></option>
        // 		                	<option value=""></option>
        // 		                	<option value=""></option>

        // 		                </select>
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>						
        // </div>
        //     	`;
        //     }

        //PRIVATE LINE NO TIENE NADA QUE LO DISPARE
        //     formProduct_private_line: function(otp){
        //     	return `
        //     	<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario Cierre de Kickoff  <small>PRIVATE LINE</small></h2>
        // <!--*********************  MODULO PESTAÑAS  *********************-->
        // <ul class="nav nav-tabs">
        // 	<li class="active"><a data-toggle="tab" href="#mpls_punto_origen_pl">PUNTO DE ORIGEN</a></li>
        // 	<li class=""><a data-toggle="tab" href="#mpls_punto_destino_pl">PUNTO DESTINO</a></li>
        // </ul>

        // <!--*********************  CONTENIDO PESTAÑAS  *********************-->
        // <div class="tab-content">

        // 	<!--*********************  PUNTO DE ORIGEN  *********************-->
        // 	<div id="mpls_punto_origen_pl" class="tab-pane fade in active">
        // 		<h3>PUNTO DE ORIGEN</h3>
        // 		<div class="widget bg_white m-t-25 d-inline-b cliente">
        // 			<legend class="f-s-15">DATOS BÁSICOS DE INSTALACION ORIGEN </legend>
        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- CIUDAD -->
        // 					<div class="form-group">
        // 				        <label for="pr_ciudad_o" class="col-md-3 control-label">Ciudad:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-globe" ></i></span>
        // 				                <input name="pr_ciudad_o" id="pr_ciudad_o" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- DIRECCIÓN:-->
        // 				    <div class="form-group">
        // 				        <label for="pr_direccion_o" class="col-md-3 control-label">Dirección:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
        // 				                <input name="pr_direccion_o" id="pr_direccion_o" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- TIPO PREDIO: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_tipo_predio_o" class="col-md-3 control-label">Tipo predio:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
        // 				                <select class="form-control" id="pr_tipo_predio_o" name="pr_tipo_predio_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Edificio">Edificio</option>
        //      									<option value="Casa">Casa</option>									    
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- NIT del cliente: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_nit_cliente_o" class="col-md-3 control-label">NIT del cliente:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
        // 				                <input name="pr_nit_cliente_o" id="pr_nit_cliente_o" class="form-control" type="number" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- ALIAS DEL LUGAR  -->
        // 				    <div class="form-group">
        // 				        <label for="pr_alias_lugar_o" class="col-md-3 control-label">Alias del lugar:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
        // 				                <input name="pr_alias_lugar_o" id="pr_alias_lugar_o" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- OTP -->
        // 					<div class="form-group">
        // 				        <label for="pr_otp_o" class="col-md-3 control-label">OTP:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
        // 				                <input name="pr_otp_o" id="pr_otp_o" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- otp_asociadas -->
        // 					<div class="form-group">
        // 				        <label for="pr_otp_asociadas_o" class="col-md-3 control-label">OTP asociadas:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 				                <input name="pr_otp_asociadas_o" id="pr_otp_asociadas_o" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- TIPO PRIVATE LINE: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_tipo_private_o" class="col-md-3 control-label">Tipo PRIVATE LINE:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_tipo_private_o" name="pr_tipo_private_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Local - P2P">Local - P2P</option>
        //      									<option value="Local - P2MP">Local - P2MP</option>
        //      									<option value="Nacional - P2P">Nacional - P2P</option>
        //      									<option value="Nacional - P2MP">Nacional - P2MP</option>
        //      									<option value="VPRN">VPRN</option> 
        //      									<option value="Private Line Service (SDH)">Private Line Service (SDH)</option>			
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- ancho_banda -->
        // 					<div class="form-group">
        // 				        <label for="pr_ancho_banda_o" class="col-md-3 control-label">Ancho de banda:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
        // 				                <input name="pr_ancho_banda_o" id="pr_ancho_banda_o" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- TIPO INSTALACION: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_tipo_instalacion_o" class="col-md-3 control-label">Tipo instalación:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_tipo_instalacion_o" name="pr_tipo_instalacion_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Instalar UM con PE">Instalar UM con PE</option>
        // 								    <option value="Instalar UM con CT (No Estándar - Requiere Validación Solución No Estándar)">Instalar UM con CT (No Estándar - Requiere Validación Solución No Estándar)</option>
        // 								    <option value="Instalar UM en Datacenter Claro- Cableado">Instalar UM en Datacenter Claro- Cableado</option>
        // 								    <option value="Instalar UM en Datacenter Claro- Implementación">Instalar UM en Datacenter Claro- Implementación</option>
        //      									<option value="Instalar UM en Datacenter Tercero">Instalar UM en Datacenter Tercero</option>
        //      									<option value="UM existente. Requiere Cambio de equipo">UM existente. Requiere Cambio de equipo</option>					    
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- ID SERVICIO ACTUAL -->
        // 					<div class="form-group">
        // 				        <label for="pr_id_servicio_actual_o" class="col-md-3 control-label">ID SERVICIO ACTUAL (Aplica para UM Existente):</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 				                <input name="pr_id_servicio_actual_o" id="pr_id_servicio_actual_o" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<legend class="f-s-15">INFORMACIÓN  ULTIMA MILLA </legend>
        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_requiere_um_o" class="col-md-3 control-label">¿Esta OT requiere instalacion UM?:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_requiere_um_o" name="pr_requiere_um_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Si">Si</option>
        //      									<option value="No">No</option>   	
        //      									<option value="Existente">Existente</option>											    
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- PROVEEDOR: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_proveedor_o" class="col-md-3 control-label">Proveedor:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_proveedor_o" name="pr_proveedor_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="No aplica">No aplica</option>
        //      									<option value="Existente">Existente</option>
        //      									<option value="Claro">Claro</option>
        //      									<option value="Axesat">Axesat</option>
        //      									<option value="Comcel">Comcel</option> 	
        //      									<option value="Tigo">Tigo</option> 		
        //      									<option value="Media Commerce">Media Commerce</option> 		
        //      									<option value="Diveo">Diveo</option>
        //      									<option value="Edatel">Edatel</option> 	
        //      									<option value="UNE">UNE</option> 		
        //      									<option value="ETB">ETB</option> 	
        //      									<option value="IBM">IBM</option> 		
        //      									<option value="IFX">IFX</option> 		
        //      									<option value="Level 3 Colombia">Level 3 Colombia</option>
        //      									<option value="Mercanet">Mercanet</option> 	
        //      									<option value="Metrotel">Metrotel</option> 		
        //      									<option value="Promitel">Promitel</option> 		
        //      									<option value="Skynet">Skynet</option> 		
        //      									<option value="Telebucaramanga">Telebucaramanga</option>
        //      									<option value="Telecom">Telecom</option> 	
        //      									<option value="Terremark">Terremark</option> 		
        //      									<option value="Sol Cable Vision">Sol Cable Vision</option> 		
        //      									<option value="Sistelec">Sistelec</option>
        //      									<option value="Opain">Opain</option> 	
        //      									<option value="Airplan - (Información y Tecnologia)">Airplan - (Información y Tecnologia)</option> 		
        //      									<option value="TV Azteca">TV Azteca</option> 						    
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- MEDIO -->
        // 				    <div class="form-group">
        // 				        <label for="pr_medio_o" class="col-md-3 control-label">Medio:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_medio_o" name="pr_medio_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="No Aplica">No Aplica</option> 	   
        // 								    <option value="Fibra">Fibra</option>
        // 								    <option value="Cobre">Cobre</option>
        // 								    <option value="Satelital">Satelital</option> 
        // 								    <option value="Radio enlace">Radio enlace</option>
        // 								    <option value="3G">3G</option>
        // 								    <option value="UTP">UTP</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- RESPUESTA FACTIBILIDAD BW > 300 MEGAS : -->
        // 		            <div class="form-group">
        // 				        <label for="pr_resp_factibilidad_o" class="col-md-3 control-label">Respuesta factibilidad BW > 300 MEGAS:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 				                <input name="pr_resp_factibilidad_o" id="pr_resp_factibilidad_o" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
        // 				    <div class="form-group">
        // 				        <label for="pr_tipo_conector_o" class="col-md-3 control-label">Tipo conector:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_tipo_conector_o" name="pr_tipo_conector_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="LC">LC</option>  									   									
        // 								    <option value="SC">SC</option> 	   
        // 								    <option value="ST">ST</option>
        // 								    <option value="FC">FC</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- SDS destino(Unifilar) -->
        // 					<div class="form-group">
        // 				        <label for="pr_sds_destino_o" class="col-md-3 control-label">SDS destino(Unifilar):</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
        // 				                <input name="pr_sds_destino_o" id="pr_sds_destino_o" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- INTERFACE DE ENTREGA AL CLIENTE: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_interface_entrega_o" class="col-md-3 control-label">Interface de entrega al cliente:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_interface_entrega_o" name="pr_interface_entrega_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="No aplica">No aplica</option>						   									
        // 								    <option value="Ethernet">Ethernet</option> 	   
        // 								    <option value="Serial V.35">Serial V.35</option>
        // 								    <option value="Giga (óptico)">Giga (óptico)</option>
        // 								    <option value="Giga Ethernet (Electrico)">Giga Ethernet (Electrico)</option>
        // 								    <option value="STM-1">STM-1</option>
        // 								    <option value="RJ45 - 120 OHM">RJ45 - 120 OHM</option>
        // 								    <option value="G703 BNC">G703 BNC</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- REQUIERE VOC : -->
        // 				    <div class="form-group">
        // 				        <label for="pr_requiere_voc_o" class="col-md-3 control-label">Requiere VOC:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_requiere_voc_o" name="pr_requiere_voc_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Si">Si</option>
        //      									<option value="No">No</option>    
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- PROGRAMACIÓN DE VOC : -->
        // 				    <div class="form-group">
        // 				        <label for="pr_programacion_voc_o" class="col-md-3 control-label">Programación de VOC:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_programacion_voc_o" name="pr_programacion_voc_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Programada">Programada</option>
        //      									<option value="No requiere programación">No requiere programación</option> 									
        //      									<option value="No programada. Otra ciudad">No programada. Otra ciudad</option> 	    
        //      									<option value="No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto">No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<legend class="f-s-15">REQUERIMIENTOS PARA ENTREGA DEL SERVICIO</legend>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- REQUIERE RFC : -->
        // 				    <div class="form-group">
        // 				        <label for="pr_requiere_rfc_o" class="col-md-3 control-label">Requiere RFC:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_requiere_rfc_o" name="pr_requiere_rfc_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="SI => Cliente Critico Punto Central">SI => Cliente Critico Punto Central</option>
        //      									<option value="SI => Servicio Critico (Listado)">SI => Servicio Critico (Listado)</option>  	
        //      									<option value="SI => Cliente Critico">SI => Cliente Critico</option> 	    
        //      									<option value="SI => RFC Estándar Saturación">SI => RFC Estándar Saturación</option>
        //      									<option value="SI => Cliente Critico Punto Central - RFC Estándar Saturación">SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
        //      									<option value="No">No</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- CONVESOR MEDIO: -->
        // 		            <div class="form-group">
        // 				        <label for="pr_conversor_medio_o" class="col-md-3 control-label">Conversor Medio:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 				                <input name="pr_conversor_medio_o" id="pr_conversor_medio_o" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- Equipos Adicionale--> 
        // 				    <div class="form-group">
        // 				        <label for="pr_equipos_adicional_o" class="col-md-3 control-label">Equipos adicionale:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-plus" ></i></span>
        // 				                <input name="pr_equipos_adicional_o" id="pr_equipos_adicional_o" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- Consumibles:--> 
        // 				    <div class="form-group">
        // 				        <label for="pr_consumibles_o" class="col-md-3 control-label">Consumibles:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_consumibles_o" name="pr_consumibles_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Bandeja">Bandeja</option>
        //      									<option value="Cables de Poder ">Cables de Poder </option>
        //      									<option value="Clavijas de Conexión">Clavijas de Conexión</option>
        //      									<option value="Accesorios para rackear (Orejas)">Accesorios para rackear (Orejas)</option>
        //      									<option value="No Aplica">No Aplica</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_reg_importacion_o" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_reg_importacion_o" name="pr_reg_importacion_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Si">Si</option>
        //      									<option value="No">No</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- MODO TRANSMISIÓN ENTREGA CANAL -->
        // 				    <div class="form-group">
        // 				        <label for="pr_modo_transmision_o" class="col-md-3 control-label">Modo transmisión entrega canal:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_modo_transmision_o" name="pr_modo_transmision_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Troncal - Especifique VLAN">Troncal - Especifique VLAN</option>
        //      									<option value="Acceso (Null)">Acceso (Null)</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- CANTIDAD MACS : -->
        // 				    <div class="form-group">
        // 				        <label for="pr_ctd_macs_o" class="col-md-3 control-label">Cantidad MACS:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-modal-window" ></i></span>
        // 				                <select class="form-control" id="pr_ctd_macs_o" name="pr_ctd_macs_o">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="0 - 250 Estándar">0 - 250 Estándar</option>
        //      									<option value="250 en Adelante - Solicitar autorización a CORE">250 en Adelante - Solicitar autorización a CORE</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<legend class="f-s-15">DATOS DEL CONTACTO PARA COMUNICACIÓN </legend>
        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- NOMBRE --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_nombre_1" class="col-md-3 control-label">Nombre:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
        // 				                <input name="pr_nombre_1" id="pr_nombre_1" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- TELEFONO --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_telefono_1" class="col-md-3 control-label">Telefono:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
        // 				                <input name="pr_telefono_1" id="pr_telefono_1" class="form-control" type="number" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- CELULAR --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_celular_1" class="col-md-3 control-label">Celular:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
        // 				                <input name="pr_celular_1" id="pr_celular_1" class="form-control" type="number" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- EMAIL --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_email_1" class="col-md-3 control-label">Email:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
        // 				                <input name="pr_email_1" id="pr_email_1" class="form-control" type="email" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<legend class="f-s-15">DATOS CLIENTE: TÉCNICO</legend>
        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- NOMBRE --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_nombre_2" class="col-md-3 control-label">Nombre:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
        // 				                <input name="pr_nombre_2" id="pr_nombre_2" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- TELEFONO --> 
        // 				    <div class="form-group">
        // 				        <label for="telefono_dct_pl_po" class="col-md-3 control-label">Telefono:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
        // 				                <input name="telefono_dct_pl_po" id="telefono_dct_pl_po" class="form-control" type="number" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- CELULAR --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_celular_2" class="col-md-3 control-label">Celular:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
        // 				                <input name="pr_celular_2" id="pr_celular_2" class="form-control" type="number" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- EMAIL --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_email_2" class="col-md-3 control-label">Email:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
        // 				                <input name="pr_email_2" id="pr_email_2" class="form-control" type="email" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">
        // 					<!-- OBSERVACIONES: --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_observaciones_1" class="col-md-3 control-label">Observaciones:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 				                <textarea name="pr_observaciones_1" id="pr_observaciones_1" class="form-control"></textarea>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>
        // 		</div>
        // 	</div>

        // 	<!--*********************  PUNTO DESTINO   *********************-->
        // 	<div id="mpls_punto_destino_pl" class="tab-pane fade">
        // 		<h3>PUNTO DESTINO</h3>
        // 		<div class="widget bg_white m-t-25 d-inline-b cliente">
        // 			<legend class="f-s-15">DATOS BÁSICOS DE INSTALACION DESTINO</legend>
        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- CIUDAD -->
        // 					<div class="form-group">
        // 				        <label for="pr_ciudad_d" class="col-md-3 control-label">Ciudad:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-globe" ></i></span>
        // 				                <input name="pr_ciudad_d" id="pr_ciudad_d" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- DIRECCIÓN:-->
        // 				    <div class="form-group">
        // 				        <label for="pr_direccion_d" class="col-md-3 control-label">Dirección:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
        // 				                <input name="pr_direccion_d" id="pr_direccion_d" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- TIPO PREDIO: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_tipo_predio_d" class="col-md-3 control-label">Tipo predio:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
        // 				                <select class="form-control" id="pr_tipo_predio_d" name="pr_tipo_predio_d">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Edificio">Edificio</option>
        //      							<option value="Casa">Casa</option>									    
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>	

        // 				    <!-- NIT del cliente: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_nit_cliente_d" class="col-md-3 control-label">NIT del cliente:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
        // 				                <input name="pr_nit_cliente_d" id="pr_nit_cliente_d" class="form-control" type="number" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- ALIAS DEL LUGAR  -->
        // 				    <div class="form-group">
        // 				        <label for="pr_alias_lugar_d" class="col-md-3 control-label">Alias del lugar:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
        // 				                <input name="pr_alias_lugar_d" id="pr_alias_lugar_d" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- OTP -->
        // 					<div class="form-group">
        // 				        <label for="pr_otp_d" class="col-md-3 control-label">OTP:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
        // 				                <input name="pr_otp_d" id="pr_otp_d" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- otp_asociadas -->
        // 					<div class="form-group">
        // 				        <label for="pr_otp_asociado_d" class="col-md-3 control-label">OTP asociadas:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
        // 				                <input name="pr_otp_asociado_d" id="pr_otp_asociado_d" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- TIPO PRIVATE LINE: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_tipo_pl_d" class="col-md-3 control-label">Tipo PRIVATE LINE:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 				                <select class="form-control" id="pr_tipo_pl_d" name="pr_tipo_pl_d">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Local - P2P">Local - P2P</option>
        //      									<option value="Local - P2MP">Local - P2MP</option>
        //      									<option value="Nacional - P2P">Nacional - P2P</option>
        //      									<option value="Nacional - P2MP">Nacional - P2MP</option>
        //      									<option value="VPRN">VPRN</option> 
        //      									<option value="Private Line Service (SDH)">Private Line Service (SDH)</option>						
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>	
        // 				</fieldset>
        // 			</div>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">
        // 					<!-- ancho_banda -->
        // 					<div class="form-group">
        // 				        <label for="pr_ancho_banda_d" class="col-md-3 control-label">Ancho de banda:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
        // 				                <input name="pr_ancho_banda_d" id="pr_ancho_banda_d" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>		

        // 				    <!-- TIPO INSTALACION: -->
        // 				     <div class="form-group">
        // 				        <label for="pr_tipo_instalacion_d" class="col-md-3 control-label">Tipo instalación:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_tipo_instalacion_d" name="pr_tipo_instalacion_d">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Instalar UM con PE">Instalar UM con PE</option>
        // 								    <option value="Instalar UM con CT (No Estándar - Requiere Validación Solución No Estándar)">Instalar UM con CT (No Estándar - Requiere Validación Solución No Estándar)</option>
        // 								    <option value="Instalar UM en Datacenter Claro- Cableado">Instalar UM en Datacenter Claro- Cableado</option>
        // 								    <option value="Instalar UM en Datacenter Claro- Implementación">Instalar UM en Datacenter Claro- Implementación</option>
        //      									<option value="Instalar UM en Datacenter Tercero">Instalar UM en Datacenter Tercero</option>
        //      									<option value="UM existente. Requiere Cambio de equipo">UM existente. Requiere Cambio de equipo</option>					    
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- ID SERVICIO ACTUAL -->
        // 					<div class="form-group">
        // 				        <label for="pr_idservicio_act_d" class="col-md-3 control-label">ID SERVICIO ACTUAL(Aplica para UM Existente):</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 				                <input name="pr_idservicio_act_d" id="pr_idservicio_act_d" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<legend class="f-s-15">NFORMACIÓN  ULTIMA MILLA</legend>
        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- ¿ESTA OT REQUIERE INSTALACION DE  UM?: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_requiere_instalacion_d" class="col-md-3 control-label">¿Esta OT requiere instalacion UM?:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_requiere_instalacion_d" name="pr_requiere_instalacion_d">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Si">Si</option>
        //      									<option value="No">No</option>   												    
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- PROVEEDOR: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_proveedor_d" class="col-md-3 control-label">Proveedor:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_proveedor_d" name="pr_proveedor_d">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="No aplica">No aplica</option>
        //      									<option value="Existente">Existente</option>
        //      									<option value="Claro">Claro</option>
        //      									<option value="Axesat">Axesat</option>
        //      									<option value="Comcel">Comcel</option> 	
        //      									<option value="Tigo">Tigo</option> 		
        //      									<option value="Media Commerce">Media Commerce</option> 		
        //      									<option value="Diveo">Diveo</option>
        //      									<option value="Edatel">Edatel</option> 	
        //      									<option value="UNE">UNE</option> 		
        //      									<option value="ETB">ETB</option> 	
        //      									<option value="IBM">IBM</option> 		
        //      									<option value="IFX">IFX</option> 		
        //      									<option value="Level 3 Colombia">Level 3 Colombia</option>
        //      									<option value="Mercanet">Mercanet</option> 	
        //      									<option value="Metrotel">Metrotel</option> 		
        //      									<option value="Promitel">Promitel</option> 		
        //      									<option value="Skynet">Skynet</option> 		
        //      									<option value="Telebucaramanga">Telebucaramanga</option>
        //      									<option value="Telecom">Telecom</option> 	
        //      									<option value="Terremark">Terremark</option> 		
        //      									<option value="Sol Cable Vision">Sol Cable Vision</option> 		
        //      									<option value="Sistelec">Sistelec</option>
        //      									<option value="Opain">Opain</option> 	
        //      									<option value="Airplan - (Información y Tecnologia)">Airplan - (Información y Tecnologia)</option>	
        //      									<option value="TV Azteca">TV Azteca</option> 						    
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">
        // 					<!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
        // 				    <div class="form-group">
        // 				        <label for="pr_tipo_conector_d" class="col-md-3 control-label">Tipo conector(Aplica para FO Claro):</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_tipo_conector_d" name="pr_tipo_conector_d">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="LC">LC</option>							   									
        // 								    <option value="SC">SC</option> 	   
        // 								    <option value="ST">ST</option>
        // 								    <option value="FC">FC</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- ACCESO (Solo Aplica para Canales SDH): -->
        // 				    SDS DESTINO
        // 		            <div class="form-group">
        // 				        <label for="pr_sds_destino" class="col-md-3 control-label">SDS destino (Unifilar):</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
        // 				                <input name="pr_sds_destino" id="pr_sds_destino" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- INTERFACE DE ENTREGA AL CLIENTE: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_inter_entrega_cd" class="col-md-3 control-label">Interface de entrega al cliente:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_inter_entrega_cd" name="pr_inter_entrega_cd">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="No aplica">No aplica</option>					   									
        // 								    <option value="Ethernet">Ethernet</option> 	   
        // 								    <option value="Serial V.35">Serial V.35</option>
        // 								    <option value="Giga (óptico)">Giga (óptico)</option>
        // 								    <option value="Giga Ethernet (Electrico)">Giga Ethernet (Electrico)</option>
        // 								    <option value="STM-1">STM-1</option>
        // 								    <option value="RJ45 - 120 OHM">RJ45 - 120 OHM</option>
        // 								    <option value="G703 BNC">G703 BNC</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 			        <!-- REQUIERE VOC : -->
        // 				    <div class="form-group">
        // 				        <label for="pr_requiere_voc_d" class="col-md-3 control-label">Requiere VOC:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_requiere_voc_d" name="pr_requiere_voc_d">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Si">Si</option>
        //      									<option value="No">No</option>    
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- PROGRAMACIÓN DE VOC : -->
        // 				    <div class="form-group">
        // 				        <label for="pr_programacion_d" class="col-md-3 control-label">Programación de VOC:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 				                <select class="form-control" id="pr_programacion_d" name="pr_programacion_d">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Programada">Programada</option>
        //      									<option value="No requiere programación">No requiere programación</option>							
        //      									<option value="No programada. Otra ciudad">No programada. Otra ciudad</option> 	    
        //      									<option value="No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto">No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<legend class="f-s-15">REQUERIMIENTOS PARA ENTREGA DEL SERVICIO</legend>
        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- REQUIERE RFC : -->
        // 				    <div class="form-group">
        // 				        <label for="pr_requiere_rfc_d" class="col-md-3 control-label">Requiere RFC:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_requiere_rfc_d" name="pr_requiere_rfc_d">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="SI => Cliente Critico Punto Central">SI => Cliente Critico Punto Central</option>
        //      									<option value="SI => Servicio Critico (Listado)">SI => Servicio Critico (Listado)</option>
        //      									<option value="SI => Cliente Critico">SI => Cliente Critico</option>
        //      									<option value="SI => RFC Estándar Saturación">SI => RFC Estándar Saturación</option>
        //      									<option value="SI => Cliente Critico Punto Central - RFC Estándar Saturación">SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
        //      									<option value="No">No</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- Conversor Medio: -->
        // 		            <div class="form-group">
        // 				        <label for="pr_conversor_medio_d" class="col-md-3 control-label">Conversor Medio:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
        // 				                <input name="pr_conversor_medio_d" id="pr_conversor_medio_d" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- Equipos Adicionale--> 
        // 				    <div class="form-group">
        // 				        <label for="pr_equipos_adicionales_d" class="col-md-3 control-label">Equipos adicionale:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 				                <input name="pr_equipos_adicionales_d" id="pr_equipos_adicionales_d" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- Consumibles:--> 
        // 				    <div class="form-group">
        // 				        <label for="pr_consumibles_d" class="col-md-3 control-label">Consumibles:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 				                <select class="form-control" id="pr_consumibles_d" name="pr_consumibles_d">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="Bandeja">Bandeja</option>
        //      									<option value="Cables de Poder ">Cables de Poder </option>
        //      									<option value="Clavijas de Conexión">Clavijas de Conexión</option>
        //      									<option value="Accesorios para rackear (Orejas)">Accesorios para rackear (Orejas)</option>
        //      									<option value="No Aplica">No Aplica</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
        // 				    <div class="form-group">
        // 				        <label for="pr_registro_importacion_carta" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 				                <select class="form-control" id="pr_registro_importacion_carta" name="pr_registro_importacion_carta">
        // 								    <option>Seleccionar...</option>
        // 								    <option>Si</option>
        //      									<option>No</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- MODO TRANSMISIÓN ENTREGA CANAL -->
        // 				    <div class="form-group">
        // 				        <label for="pr_modo_transmision" class="col-md-3 control-label">Modo transmisión entrega canal:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 				                <select class="form-control" id="pr_modo_transmision" name="pr_modo_transmision">
        // 								    <option>Seleccionar...</option>
        // 								    <option>Troncal - Especifique VLAN</option>
        //      									<option>Acceso (Null)</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- CANTIDAD MACS : -->
        // 				    <div class="form-group">
        // 				        <label for="pr_cantidad_macs_d" class="col-md-3 control-label">Cantidad MACS:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-modal-window" ></i></span>
        // 				                <select class="form-control" id="pr_cantidad_macs_d" name="pr_cantidad_macs_d">
        // 								    <option value="">Seleccionar...</option>
        // 								    <option value="0 - 250 Estándar">0 - 250 Estándar</option>
        //      									<option value="250 en Adelante - Solicitar autorización a CORE">250 en Adelante - Solicitar autorización a CORE</option>
        // 								</select>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<legend class="f-s-15">DATOS DEL CONTACTO PARA COMUNICACIÓN</legend>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- NOMBRE --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_nombre_3" class="col-md-3 control-label">Nombre:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
        // 				                <input name="pr_nombre_3" id="pr_nombre_3" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- TELEFONO --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_telefono_3" class="col-md-3 control-label">Telefono:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
        // 				                <input name="pr_telefono_3" id="pr_telefono_3" class="form-control" type="number" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- CELULAR --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_celular_3" class="col-md-3 control-label">Celular:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
        // 				                <input name="pr_celular_3" id="pr_celular_3" class="form-control" type="number" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- EMAIL --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_email_3" class="col-md-3 control-label">Email:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
        // 				                <input name="pr_email_3" id="pr_email_3" class="form-control" type="email" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<legend class="f-s-15">DATOS CLIENTE: TÉCNICO</legend>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- NOMBRE --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_nombre_4" class="col-md-3 control-label">Nombre:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
        // 				                <input name="pr_nombre_4" id="pr_nombre_4" class="form-control" type="text" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- TELEFONO --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_telefono_4" class="col-md-3 control-label">Telefono:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
        // 				                <input name="pr_telefono_4" id="pr_telefono_4" class="form-control" type="number" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>

        // 				<fieldset class="col-md-6">

        // 					<!-- CELULAR --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_celular_4" class="col-md-3 control-label">Celular:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
        // 				                <input name="pr_celular_4" id="pr_celular_4" class="form-control" type="number" >
        // 				            </div>
        // 				        </div>
        // 				    </div>

        // 				    <!-- EMAIL --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_email_4" class="col-md-3 control-label">Correo electronico:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
        // 				                <input name="pr_email_4" id="pr_email_4" class="form-control" type="email" >
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>

        // 			<div class="d-inline-b">
        // 				<fieldset class="col-md-6">

        // 					<!-- OBSERVACIONES: --> 
        // 				    <div class="form-group">
        // 				        <label for="pr_observaciones_2" class="col-md-3 control-label">Observaciones:</label>
        // 				        <div class="col-md-9 selectContainer">
        // 				            <div class="input-group">
        // 				                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 				                <textarea name="pr_observaciones_2" id="pr_observaciones_2" class="form-control"></textarea>
        // 				            </div>
        // 				        </div>
        // 				    </div>
        // 				</fieldset>
        // 			</div>
        // 		</div>
        // 	</div>
        // </div>
        //     	`;
        //     }

        //LAN ADMINISTRADA NO TIENE NADA QUE LO DISPARE
        //     formProduct_LAN_ADMINISTRADA: function(otp){
        //     	return `
        //     	<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario Cierre de Kickoff  <small>LAN ADMINISTRADA</small></h2>
        // <div class="widget bg_white m-t-25 d-inline-b cliente">

        // 	<legend class="f-s-15">DATOS BÁSICOS DE INSTALACION</legend>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- CIUDAD -->
        // 			<div class="form-group">
        // 		        <label for="pr_ciudad" class="col-md-3 control-label">Ciudad:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-globe" ></i></span>
        // 		                <input name="pr_ciudad" id="pr_ciudad" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- DIRECCIÓN:-->
        // 		    <div class="form-group">
        // 		        <label for="pr_direccion" class="col-md-3 control-label">Dirección:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker" ></i></span>
        // 		                <input name="pr_direccion" id="pr_direccion" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- TIPO PREDIO: -->
        // 		    <div class="form-group">
        // 		        <label for="pr_tipo_predio" class="col-md-3 control-label">Tipo predio:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 					<span class="input-group-addon"><i class="fa fa-home" ></i></span>
        // 		                <select class="form-control" id="pr_tipo_predio" name="pr_tipo_predio">
        // 						    <option value="">Seleccionar...</option>
        // 						    <option value="Edificio">Edificio</option>
        //    									<option value="Casa">Casa</option>									    
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>	

        // 		    <!-- NIT del cliente: -->
        // 		    <div class="form-group">
        // 		        <label for="pr_nit_cliente" class="col-md-3 control-label">NIT del cliente:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
        // 		                <input name="pr_nit_cliente" id="pr_nit_cliente" class="form-control" type="number" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- ALIAS DEL LUGAR  -->
        // 		    <div class="form-group">
        // 		        <label for="pr_alias_lugar" class="col-md-3 control-label">Alias del lugar:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_alias_lugar" id="pr_alias_lugar" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- OTP -->
        // 			<div class="form-group">
        // 		        <label for="pr_otp" class="col-md-3 control-label">OTP:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order" ></i></span>
        // 		                <input name="pr_otp" id="pr_otp" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- otp_asociadas -->
        // 			<div class="form-group">
        // 		        <label for="pr_otp_asociadas" class="col-md-3 control-label">OTP asociadas:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_otp_asociadas" id="pr_otp_asociadas" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- TOPOLOGIA:: -->
        // 		    <div class="form-group">
        // 		        <label for="pr_topologia" class="col-md-3 control-label">Topología:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 		                <select class="form-control" id="pr_topologia" name="pr_topologia">
        // 						    <option value="">Seleccionar...</option>
        // 						    <option value="INTERNET DEDICADO (Solución Diferenciación de tráfico (Internet / NAP))">INTERNET DEDICADO (Solución Diferenciación de tráfico (Internet / NAP))</option>
        //    									<option value="INTERNET DEDICADO (VLR AGRE -Monitoreo CPE (Gestion Proactiva))">INTERNET DEDICADO (VLR AGRE -Monitoreo CPE (Gestion Proactiva))</option>	
        //    									<option value="INTERNET DEDICADO ADMINISTRADO (VLR AGRE -Monitoreo CPE (Gestion Proactiva))">INTERNET DEDICADO ADMINISTRADO (VLR AGRE -Monitoreo CPE (Gestion Proactiva))</option>
        //    									<option value="INTERNET EMPRESARIAL">INTERNET EMPRESARIAL</option>					
        //    									<option value="INTERNET BANDA ANCHA (Solución FO)">INTERNET BANDA ANCHA (Solución FO)</option>
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- ID SERVICIO ACTUAL -->
        // 			<div class="form-group">
        // 		        <label for="pr_id_servicio" class="col-md-3 control-label">ID SERVICIO ACTUAL(Aplica para UM Existente):</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_id_servicio" id="pr_id_servicio" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<legend class="f-s-15">REQUERIMIENTOS PARA ENTREGA DEL SERVICIO </legend>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- REQUIERE RFC : -->
        // 		    <div class="form-group">
        // 		        <label for="pr_requiere_res" class="col-md-3 control-label">Requiere RFC:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 		                <select class="form-control" id="pr_requiere_res" name="pr_requiere_res">
        // 						    <option value="">Seleccionar...</option>
        // 						    <option value="SI => Cliente Critico Punto Central">SI => Cliente Critico Punto Central</option>
        //    									<option value="SI => Servicio Critico (Listado)">SI => Servicio Critico (Listado)</option>  												
        //    									<option value="SI => Cliente Critico">SI => Cliente Critico</option> 	    
        //    									<option value="SI => RFC Estándar Saturación">SI => RFC Estándar Saturación</option>
        //    									<option value="SI => Cliente Critico Punto Central - RFC Estándar Saturación">SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
        //    									<option value="No">No</option>
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- Conversor Medio: -->
        //             <div class="form-group">
        // 		        <label for="pr_conversor_medio" class="col-md-3 control-label">Conversor Medio:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_conversor_medio" id="pr_conversor_medio" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- Referencia Router: -->
        //             <div class="form-group">
        // 		        <label for="pr_referencia_router" class="col-md-3 control-label">Referencia Router:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_referencia_router" id="pr_referencia_router" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- Modulos o Tarjetas: -->
        //             <div class="form-group">
        // 		        <label for="pr_modulo_tarjeta" class="col-md-3 control-label">Modulos o Tarjetas:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_modulo_tarjeta" id="pr_modulo_tarjeta" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- Licencias --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_licencias" class="col-md-3 control-label">Licencias:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_licencias" id="pr_licencias" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- Equipos Adicionale--> 
        // 		    <div class="form-group">
        // 		        <label for="pr_equipos_adicionales" class="col-md-3 control-label">Equipos adicionale:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-modal-window" ></i></span>
        // 		                <input name="pr_equipos_adicionales" id="pr_equipos_adicionales" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- Consumibles:--> 
        // 		    <div class="form-group">
        // 		        <label for="pr_consumibles" class="col-md-3 control-label">Consumibles:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 		                <select class="form-control" id="pr_consumibles" name="pr_consumibles">
        // 						    <option value="">Seleccionar...</option>
        // 						    <option value="Bandeja">Bandeja</option>
        //    									<option value="Cables de Poder ">Cables de Poder </option>
        //    									<option value="Clavijas de Conexión">Clavijas de Conexión</option>
        //    									<option value="Accesorios para rackear (Orejas)">Accesorios para rackear (Orejas)</option>
        //    									<option value="No Aplica">No Aplica</option>
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
        // 		     <div class="form-group">
        // 		        <label for="pr_registro_importacion" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
        // 		                <select class="form-control" id="pr_registro_importacion" name="pr_registro_importacion">
        // 						    <option value="">Seleccionar...</option>
        // 						    <option value="Si">Si</option>
        //    									<option value="No">No</option>
        // 						</select>
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<legend class="f-s-15">DATOS DEL CONTACTO PARA COMUNICACIÓN </legend>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- NOMBRE --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_nombre1" class="col-md-3 control-label">Nombre:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
        // 		                <input name="pr_nombre1" id="pr_nombre1" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- TELEFONO --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_telefono1" class="col-md-3 control-label">Telefono:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
        // 		                <input name="pr_telefono1" id="pr_telefono1" class="form-control" type="number" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- CELULAR --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_celular1" class="col-md-3 control-label">Celular:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
        // 		                <input name="pr_celular1" id="pr_celular1" class="form-control" type="number" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- EMAIL --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_email1" class="col-md-3 control-label">Email:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
        // 		                <input name="pr_email1" id="pr_email1" class="form-control" type="email" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<legend class="f-s-15">DATOS CONTACTO TÉCNICO</legend>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- NOMBRE --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_nombre2" class="col-md-3 control-label">Nombre:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
        // 		                <input name="pr_nombre2" id="pr_nombre2" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- TELEFONO --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_telefono2" class="col-md-3 control-label">Telefono:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
        // 		                <input name="pr_telefono2" id="pr_telefono2" class="form-control" type="number" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>

        // 		<fieldset class="col-md-6">

        // 			<!-- CELULAR --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_celular2" class="col-md-3 control-label">Celular:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
        // 		                <input name="pr_celular2" id="pr_celular2" class="form-control" type="number" >
        // 		            </div>
        // 		        </div>
        // 		    </div>

        // 		    <!-- EMAIL --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_email2" class="col-md-3 control-label">Correo electronico:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
        // 		                <input name="pr_email2" id="pr_email2" class="form-control" type="email" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- OBSERVACIONES: --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_observaciones" class="col-md-3 control-label">Observaciones:</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <textarea name="pr_observaciones" id="pr_observaciones" class="form-control"></textarea>
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>

        // 	<legend class="f-s-15">KIKOFF TECNICO</legend>

        // 	<div class="d-inline-b">
        // 		<fieldset class="col-md-6">

        // 			<!-- TIPO PROTOCOLO (STP, RSTP, VTP, DTP) --> 
        // 		    <div class="form-group">
        // 		        <label for="pr_tipo_protocolo" class="col-md-3 control-label">Tipo protocolo(STP, RSTP, VTP, DTP):</label>
        // 		        <div class="col-md-9 selectContainer">
        // 		            <div class="input-group">
        // 		                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
        // 		                <input name="pr_tipo_protocolo" id="pr_tipo_protocolo" class="form-control" type="text" >
        // 		            </div>
        // 		        </div>
        // 		    </div>
        // 		</fieldset>
        // 	</div>
        // </div>
        //     	`;
        //     }
    };
    setForm.init();
});
