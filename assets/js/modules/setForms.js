$(function () {
    setForm = {
        init: function () {
            setForm.events();
            
        },

        //Eventos de la ventana.
        events: function () {
        },

        // retorna el formulario deseado de servicio
        returnFormularyService: function(nombre_cliente = '', direccion_destino = '', servicio_val, servicio_nombre = ''){
            let form = "";
            // primera seccion, la dejo true porque no se si hay plantillas que no necesite la primera seccion
            if (true) {
            	form += setForm.primeraSeccionServicio(nombre_cliente, servicio_nombre);
            }

            switch(servicio_val){
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
            		form += setForm.adicion_marquillas_aeropuerto_el_dorado_opain(direccion_destino);
            		break;
            	case '12': // Cambio de Equipos Servicio
            		form += setForm.cambio_de_equipos_servicio(direccion_destino);
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
            	form += setForm.ultimaSeccionServicio();
            }

            return form;

        },

        // retorna la primera seccion de los formularios de servicio
        primeraSeccionServicio: function(nombre_cliente, servicio_nombre){
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
					            <label for="fecha" class="col-md-3 control-label">Fecha: &nbsp;</label>
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
        internetDedicadoEmpresarial: function(direccion_destino){
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
        internetDedicado: function(direccion_destino){
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
        mpls_avanzado_intranet: function(direccion_destino){
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
        mpls_avanzado_intranet_varios_puntos: function(){
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
        MPLS_Avanzado_Intranet_con_Backup_de_Ultima_Milla_NDS_2: function(direccion_destino){
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
        MPLS_Avanzado_Intranet_con_Backup_de_Ultima_Milla_y_Router_NDS1: function(direccion_destino){
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
        MPLS_Avanzado_Extranet: function(direccion_destino){
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
        Backend_MPLS: function(direccion_destino){
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
        MPLS_Avanzado_con_Componente_Datacenter_Claro: function(direccion_destino){
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
        MPLS_Transaccional_3G: function(direccion_destino){
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
        ultimaSeccionServicio: function(direccion_destino){
            return `<div class="widget bg_white m-t-25 d-inline-b cliente">
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
					    <!--  fin seccion izquierda form---->
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
					    </fieldset>
					</div>`;
        },

        /*PLANTILLAS DE SERVICIO NUEVAS*/
		
        // opcion de servicio 11
        adicion_marquillas_aeropuerto_el_dorado_opain: function(direccion_destino){
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
				                      <input type="text" name="campo8" id="campo8" class="form-control">
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
				                      <input type="text" name="campo10" id="campo10" class="form-control">
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
				                <label for="campo13" class="col-md-3 control-label">Total Puertos LAN:</label>
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
				              <label for="campo14" class="col-md-3 control-label">otp:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-record"></i></span>
				                      <input type="text" name="campo14" id="campo14" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo15" class="col-md-3 control-label">Parafiscales:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-log-out"></i></span>
				                      <input type="text" name="campo15" id="campo15" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo16" class="col-md-3 control-label">Certificacion Alturas:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
				                        <input type="text" name="campo16" id="campo16" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo17" class="col-md-3 control-label">Cursos Especiales:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
				                        <input type="text" name="campo17" id="campo17" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo18" class="col-md-3 control-label">EPP:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-thumbs-up"></i></span>
				                        <input type="text" name="campo18" id="campo18" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo19" class="col-md-3 control-label">Puertos Voz:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-bullhorn"></i></span>
				                        <input type="text" name="campo19" id="campo19" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo20" class="col-md-3 control-label">Datafono:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
				                      <input type="text" name="campo20" id="campo20" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo21" class="col-md-3 control-label">Puertos Datos:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
				                      <input type="text" name="campo21" id="campo21" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				      </fieldset>
				      <fieldset class="col-md-6">
				            <label for="campo36" class="col-md-10 control-label">Las Marquillas a habilitar se encuentran a más de 1.5 mts de altura?:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo36" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo37">NO</label>
				            </div>				            
				      </fieldset>
				        <h4 class="m-l-10 f-l">Marquillas confirmadas por su Proveedor de Cableado</h4><hr>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo22" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo22" id="campo22" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo23" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo23" id="campo23" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				            <div class="form-group">
				                <label for="campo23" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo23" id="campo23" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo24" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo24" id="campo24" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo25" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo25" id="campo25" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo26" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo26" id="campo26" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				            <div class="form-group">
				                <label for="campo27" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo27" id="campo27" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo28" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo28" id="campo28" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo29" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo29" id="campo29" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo30" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo30" id="campo30" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				            <div class="form-group">
				                <label for="campo31" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo31" id="campo31" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo32" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo32" id="campo32" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo33" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo33" id="campo33" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo34" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo34" id="campo34" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				            <div class="form-group">
				                <label for="campo35" class="col-md-3 control-label"></label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo35" id="campo35" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				                <label for="campo35" class="col-md-3 control-label"></label>
				                <div class="col-md-12 selectContainer">
				                </div>         
				      </fieldset>
				    </div>`;
        },
        // opcion de servicio 12
        cambio_de_equipos_servicio: function(direccion_destino){
            return `
				<div class="widget bg_white m-t-25 d-inline-b cliente">

				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo4" class="col-md-3 control-label">Servicio: &nbsp;</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo4" id="campo4" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo5" class="col-md-3 control-label">Top: &nbsp;</label>
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
				                <label for="campo6" class="col-md-3 control-label">Dirección Sede:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
				                        <input type="text" name="campo6" id="campo6" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT check  *********************-->
				            <label for="campo7" class="col-md-12 control-label">&nbsp; existen otros servicio sobre el cpe: &nbsp;&nbsp;</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo7" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo7">NO</label>
				            </div>
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo8" class="col-md-3 control-label">Cantidad:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
				                      <input type="text" name="campo8" id="campo8" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT DATE  *********************-->
				          <div class="form-group">
				          	<label for="campo9" class="col-md-3 control-label">fecha Inicio: &nbsp;</label>
				          	<div class="col-md-9 selectContainer">
				          		<div class="input-group">
				          			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				          			<input type="date" name="campo9" id="campo9" class="form-control">
				          		</div>
				          	</div>
				          </div>
				          
				          
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT check  *********************-->
				            <label for="campo10" class="col-md-12 control-label">Requiere que el Cambio de Equipos para su Servicio se ejecute en horario No Hábil o Fin de Semana:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo10" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo10">NO</label>
				            </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				         <!--  <div class="form-group">
				              <label for="campo11" class="col-md-3 control-label">borrar:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
				                      <input type="text" name="campo11" id="campo11" class="form-control">
				                  </div>
				              </div>
				          </div> -->
				          
				      </fieldset>
				     
				    </div>	
            `;
        },
        // opcion de servicio 13
        cambio_de_servicio_telefonia_fija_publica_linea_basica_a_linea_e1: function(direccion_destino){
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
				                        <input type="text" name="campo5" id="campo5"  class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>

				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo6" class="col-md-3 control-label">Ciudad (x):</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-dashboard"></i></span>
				                        <input type="text" name="campo6" id="campo6" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo7" class="col-md-3 control-label">Ciudad:</label>
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
				                      <input type="text" name="campo8" id="campo8" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo9" class="col-md-3 control-label">Inicio al Proceso:</label>
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
				              <label for="campo10" class="col-md-3 control-label">Parafiscales:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-sound-5-1"></i></span>
				                      <input type="text" name="campo10" id="campo10" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo11" class="col-md-3 control-label">Certificación Alturas:</label>
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
				                <label for="campo12" class="col-md-3 control-label">Cursos Especiales:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
				                        <input type="text" name="campo12" id="campo12" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo13" class="col-md-3 control-label">EPP:</label>
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
				              <label for="campo14" class="col-md-3 control-label">Rack:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-record"></i></span>
				                      <input type="text" name="campo14" id="campo14" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo15" class="col-md-3 control-label">Tomas Reguladas:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-log-out"></i></span>
				                      <input type="text" name="campo15" id="campo15" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo16" class="col-md-3 control-label">Planta telefonica E1:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
				                        <input type="text" name="campo16" id="campo16" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo17" class="col-md-3 control-label">Larga Distancia Nal:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
				                        <input type="text" name="campo17" id="campo17" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo18" class="col-md-3 control-label">Larga Distancia inter:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-thumbs-up"></i></span>
				                        <input type="text" name="campo18" id="campo18" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo19" class="col-md-3 control-label">Moviles:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-bullhorn"></i></span>
				                        <input type="text" name="campo19" id="campo19" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo20" class="col-md-3 control-label">Local Extendida:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
				                      <input type="text" name="campo20" id="campo20" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo21" class="col-md-3 control-label">Modelo Planta tel.:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
				                      <input type="text" name="campo21" id="campo21" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo22" class="col-md-3 control-label">Versión de Software:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
				                      <input type="text" name="campo22" id="campo22" class="form-control">
				                  </div>
				              </div>
				          </div>

				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo23" class="col-md-3 control-label">Admin de la Planta tel.:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
				                      <input type="text" name="campo23" id="campo23" class="form-control">
				                  </div>
				              </div>
				          </div>		            
				      </fieldset>
				 
				      <fieldset class="col-md-6">
				            <div class="form-group">
				                <label for="campo24" class="col-md-3 control-label">Opción 1: RJ45</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo24" id="campo24" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo25" class="col-md-3 control-label">Opción 2:BNC</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo25" id="campo25" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo26" class="col-md-3 control-label">CRC4</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo26" id="campo26" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo27" class="col-md-3 control-label">NO-CRC4</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo27" id="campo27" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				            <div class="form-group">
				                <label for="campo28" class="col-md-3 control-label">HDB3</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo28" id="campo28" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo29" class="col-md-3 control-label">AMI</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo29" id="campo29" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo30" class="col-md-3 control-label">ISDN PRI-NET5</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo30" id="campo30" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo31" class="col-md-3 control-label">ISDN PRI-QSIG</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo31" id="campo31" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				            <div class="form-group">
				                <label for="campo32" class="col-md-3 control-label">Compilado</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo32" id="campo32" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo33" class="col-md-3 control-label">N° Compilado</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
				                        <input type="text" name="campo33" id="campo33" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT DATE  *********************-->
				            <div class="form-group">
				            	<label for="campo34" class="col-md-3 control-label">Fecha de Entrega de su servicio:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				            			<input type="date" name="campo34" id="campo34" class="form-control">
				            		</div>
				            	</div>
				            </div>
				            
				      </fieldset>
				    </div>
            `;
        },
        // opcion de servicio 14
        cambio_de_servicio_telefonia_fija_publica_linea_sip_a_pbx_distribuida_linea_sip: function(direccion_destino){
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
				                        <input type="text" name="campo5" id="campo5"  class="form-control">
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
				            			<select name="campo6" id="campo6" class="form-control multiselect_forms"  multiple="multiple">
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
											<option value="Santa">Santa Marta</option>
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
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo8" class="col-md-3 control-label">Parafiscales:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
				                      <input type="text" name="campo8" id="campo8" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo9" class="col-md-3 control-label">Certificación Alturas:</label>
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
				              <label for="campo10" class="col-md-3 control-label">Cursos Especiales:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-sound-5-1"></i></span>
				                      <input type="text" name="campo10" id="campo10" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo11" class="col-md-3 control-label">EPP:</label>
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
				                <label for="campo12" class="col-md-3 control-label">Acompañamiento personal mto:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
				                        <input type="text" name="campo12" id="campo12" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo13" class="col-md-3 control-label">Horario Especial:</label>
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
				              <label for="campo14" class="col-md-3 control-label">Rack:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-record"></i></span>
				                      <input type="text" name="campo14" id="campo14" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo15" class="col-md-3 control-label">Tomas Reguladas:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-log-out"></i></span>
				                      <input type="text" name="campo15" id="campo15" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo16" class="col-md-3 control-label">Planta telefonica IP:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
				                        <input type="text" name="campo16" id="campo16" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo17" class="col-md-3 control-label">Modelo Planta Telefónica:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
				                        <input type="text" name="campo17" id="campo17" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo18" class="col-md-3 control-label">Versión de Software:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-thumbs-up"></i></span>
				                        <input type="text" name="campo18" id="campo18" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo19" class="col-md-3 control-label">Admin Planta Telefonia:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-bullhorn"></i></span>
				                        <input type="text" name="campo19" id="campo19" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo20" class="col-md-3 control-label">Fabricante Planta tel:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
				                      <input type="text" name="campo20" id="campo20" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				           <label for="campo36" class="col-md-10 control-label">Requiere una IP Diferente a la asignada por Defecto:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo36" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo37">NO</label>
				            </div>	
				          
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT DATE  *********************-->
				            <div class="form-group">
				            	<label for="campo23" class="col-md-3 control-label">Fecha de Entrega de su servicio:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				            			<input type="date" name="campo23" id="campo23" class="form-control">
				            		</div>
				            	</div>
				            </div>


				      </fieldset>
				 
				    </div>
			`;
        },
        // opcion de servicio 15
        traslado_externo_servicio: function(direccion_destino){
            return `
				<div class="widget bg_white m-t-25 d-inline-b cliente">
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo4" class="col-md-3 control-label">Traslado de Servicio:;</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo4" id="campo4" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo5" class="col-md-3 control-label">Dirección Sede Antigua:</label>
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
				            	<label for="campo6" class="col-md-3 control-label">Dirección Sede Nueva:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				            			<input type="text" name="campo6" id="campo6" class="form-control">
				            		</div>
				            	</div>
				            </div>
				            
				                      
				           <label for="campo7" class="col-md-8 control-label">Existen otros Servicios a Trasladar:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo7" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo7">NO</label>
				            </div>
				            
				            
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo8" class="col-md-3 control-label">Cantidad:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
				                      <input type="text" name="campo8" id="campo8" class="form-control">
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
				          	<label for="campo10" class="col-md-3 control-label">Inicio al proceso: &nbsp;</label>
				          	<div class="col-md-9 selectContainer">
				          		<div class="input-group">
				          			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				          			<input type="date" name="campo10" id="campo10" class="form-control">
				          		</div>
				          	</div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo11" class="col-md-3 control-label">Parafiscales:</label>
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
				                <label for="campo12" class="col-md-3 control-label">Certificacion Alturas:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
				                        <input type="text" name="campo12" id="campo12" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo13" class="col-md-3 control-label">Cursos Especiales:</label>
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
				              <label for="campo14" class="col-md-3 control-label">EPP:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-record"></i></span>
				                      <input type="text" name="campo14" id="campo14" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				          <!--*********************  INPUT TEXT  *********************-->
				          <div class="form-group">
				              <label for="campo15" class="col-md-3 control-label">Acompañamiento personal mto:</label>
				              <div class="col-md-9 selectContainer">
				                  <div class="input-group">
				                      <span class="input-group-addon"><i class="glyphicon glyphicon-log-out"></i></span>
				                      <input type="text" name="campo15" id="campo15" class="form-control">
				                  </div>
				              </div>
				          </div>
				          
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo16" class="col-md-3 control-label">Horario Especial:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
				                        <input type="text" name="campo16" id="campo16" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo17" class="col-md-3 control-label">Rack:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
				                        <input type="text" name="campo17" id="campo17" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo18" class="col-md-3 control-label">Tomas Reguladas:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-thumbs-up"></i></span>
				                        <input type="text" name="campo18" id="campo18" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <label for="campo19" class="col-md-10 control-label">Requiere que el Traslado de su Servicio se ejecute en horario No Hábil o Fin de Semana:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo19" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo19">NO</label>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				          <!--*********************  INPUT DATE  *********************-->
				            <div class="form-group">
				            	<label for="campo20" class="col-md-3 control-label">Fecha de Entrega del Traslado:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				            			<input type="date" name="campo20" id="campo20" class="form-control">
				            		</div>
				            	</div>
				            </div>
				        </fieldset>
				    </div>
            `;
        },
        // opcion de servicio 16
        traslado_interno_servicio: function(direccion_destino){
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
				              <label><input type="checkbox" name="campo5">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo5" checked>NO</label>
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
				            			<input type="text" name="campo6" id="campo6" class="form-control">
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
				              <label><input type="checkbox" name="campo9" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo9">NO</label>
				            </div>
				      </fieldset><hr>
				      <fieldset class="col-md-6">
					        <label for="campo10" class="col-md-12 control-label">Movimiento Equipos - Caja OB - Fibra < 3 Mts:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo10" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo10">NO</label>
				            </div><hr>
				          
				          	<label for="campo11" class="col-md-12 control-label">Movimiento solo de Equipos:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo11" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo11">NO</label>
				            </div>
				          <hr>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <label for="campo12" class="col-md-12 control-label">Movimiento solo de Caja OB – Fibra:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo12" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo12">NO</label>
				            </div>
				            <hr>
				            <label for="campo13" class="col-md-12 control-label">Movimiento Rack:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo13" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo13">NO</label>
				            </div>
				            <hr>
				      </fieldset>
				      <fieldset class="col-md-6">
				          	<label for="campo14" class="col-md-12 control-label">Movimiento ODF:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo14" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo14">NO</label>
				            </div>
				          <hr>
					        <label for="campo15" class="col-md-12 control-label">Determinación en Visita de Obra Civil:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo15" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo15">NO</label>
				            </div>
				          <hr>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo16" class="col-md-3 control-label">Parafiscales:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
				                        <input type="text" name="campo16" id="campo16" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo17" class="col-md-3 control-label">Certificación Alturas:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
				                        <input type="text" name="campo17" id="campo17" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo18" class="col-md-3 control-label">Cursos Especiales:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-thumbs-up"></i></span>
				                        <input type="text" name="campo18" id="campo18" class="form-control">
				                    </div>
				                </div>
				            </div>
				            
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo19" class="col-md-3 control-label">EPP:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-thumbs-up"></i></span>
				                        <input type="text" name="campo19" id="campo19" class="form-control">
				                    </div>
				                </div>
				            </div>
				      </fieldset>
				      <fieldset class="col-md-6">
				          	<!--*********************  INPUT DATE  *********************-->
				            <div class="form-group">
				            	<label for="campo20" class="col-md-3 control-label">Acompañamiento personal de mto:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				            			<input type="date" name="campo20" id="campo20" class="form-control">
				            		</div>
				            	</div>
				            </div>

				            <!--*********************  INPUT DATE  *********************-->
				            <div class="form-group">
				            	<label for="campo21" class="col-md-3 control-label">Horario Especial:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				            			<input type="date" name="campo21" id="campo21" class="form-control">
				            		</div>
				            	</div>
				            </div>
				        </fieldset>
				        <fieldset class="col-md-6">
				          	<!--*********************  INPUT DATE  *********************-->
				            <div class="form-group">
				            	<label for="campo22" class="col-md-3 control-label">Rack:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				            			<input type="date" name="campo22" id="campo22" class="form-control">
				            		</div>
				            	</div>
				            </div>

				            <!--*********************  INPUT DATE  *********************-->
				            <div class="form-group">
				            	<label for="campo23" class="col-md-3 control-label">Tomas reguladas:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				            			<input type="date" name="campo23" id="campo23" class="form-control">
				            		</div>
				            	</div>
				            </div>
				        </fieldset>
				        <fieldset class="col-md-6">
				        	<label for="campo24" class="col-md-12 control-label">Requiere que el Traslado de su Servicio se ejecute en horario No Hábil o Fin de Semana:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo24" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo24">NO</label>
				            </div><hr>

				            <!--*********************  INPUT DATE  *********************-->
				            <div class="form-group">
				            	<label for="campo25" class="col-md-3 control-label">Fecha entraga traslado:</label>
				            	<div class="col-md-9 selectContainer">
				            		<div class="input-group">
				            			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
				            			<input type="date" name="campo25" id="campo25" class="form-control">
				            		</div>
				            	</div>
				            </div>
				        </fieldset>
				    </div>
            `;
        },
        // opcion de servicio 17
        soluciones_administrativas_comunicaciones_unificadas_pbx_administrada: function(direccion_destino){
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
			            <!--*********************  INPUT TEXT  *********************-->
			            <div class="form-group">
			                <label for="campo36" class="col-md-3 control-label">Inicio al Proceso:</label>
			                <div class="col-md-9 selectContainer">
			                    <div class="input-group">
			                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
			                        <input type="date" name="campo36" id="campo36" class="form-control">
			                    </div>
			                </div>
			            </div>

				    </fieldset>
				    <fieldset class="col-md-6">
				    	<!--*********************  INPUT TEXT  *********************-->
				    	<div class="form-group">
				    		<label for="campo5" class="col-md-3 control-label">Telefonia Fija Claro</label>
				    		<div class="col-md-9 selectContainer">
				    			<div class="input-group">
				    				<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
				    				<input type="text" name="campo5" id="campo5" class="form-control" placeholder="Existenete">
				    			</div>
				    		</div>
				    	</div>

				    	<!--*********************  INPUT TEXT  *********************-->
				    	<div class="form-group">
				    		<label for="campo6" class="col-md-3 control-label">Telefonia Fija Claro</label>
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
						<!--*********************  INPUT TEXT  *********************-->
						<div class="form-group">
							<label for="campo7" class="col-md-3 control-label">SIP:</label>
							<div class="col-md-9 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
									<input type="text" name="campo7" id="campo7" class="form-control" placeholder="DID">
								</div>
							</div>
						</div>
						<!--*********************  INPUT TEXT  *********************-->
						<div class="form-group">
							<label for="campo8" class="col-md-3 control-label">SIP:</label>
							<div class="col-md-9 selectContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
									<input type="text" name="campo8" id="campo8" class="form-control" placeholder="Canales">
								</div>
							</div>
						</div>
					</fieldset>
					<fieldset class="col-md-6">
						<!--*********************  INPUT TEXT  *********************-->
						<div class="form-group">
							<label for="campo9" class="col-md-3 control-label">E1:</label>
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
				              <label><input type="checkbox" name="campo11">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo11" checked>NO</label>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo12" class="col-md-3 control-label">Cantidad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo12" id="campo12" class="form-control">
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
				              <label><input type="checkbox" name="campo13">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo13" checked>NO</label>
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
										<input type="text" name="campo14" id="campo14" class="form-control">
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
				              <label><input type="checkbox" name="campo16">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo16" checked>NO</label>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo17" class="col-md-3 control-label">Cantidad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo17" id="campo17" class="form-control">
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
				              <label><input type="checkbox" name="campo20">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo20" checked>NO</label>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo21" class="col-md-3 control-label">Cantidad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo21" id="campo21" class="form-control">
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
				              <label><input type="checkbox" name="campo22">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo22" checked>NO</label>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo23" class="col-md-3 control-label">Cantidad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo23" id="campo23" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<legend class="f-s-15">botoneras</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<label for="campo24" class="col-md-6 control-label">botoneras:</label>
				            <div class="radio col-md-3">
				              <label><input type="checkbox" name="campo24">SI</label>
				            </div>
				            <div class="radio col-md-3">
				              <label><input type="checkbox" name="campo24" checked>NO</label>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo25" class="col-md-3 control-label">Cantidad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo25" id="campo25" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-12">
							<label for="campos26" class="col-md-6 control-label">Incluye Grabación de Voz:</label>
				            <div class="radio col-md-3">
				              <label><input type="checkbox" name="campos26">SI</label>
				            </div>
				            <div class="radio col-md-3">
				              <label><input type="checkbox" name="campos26" checked>NO</label>
				            </div>
						</fieldset>
					</div>

					<legend class="f-s-15">Incluye LAN Administrada</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<label for="campo27" class="col-md-6 control-label">Incluye LAN Administrada: </label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo27">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo27" checked>NO</label>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo28" class="col-md-3 control-label">Cantidad SW:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo28" id="campo28" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo29" class="col-md-3 control-label">Puertos:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo29" id="campo29" class="form-control">
									</div>
								</div>
							</div>
							<label for="campo30" class="col-md-3 control-label">PoE: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo30">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo30" checked>NO</label>
				            </div>
						</fieldset>
					</div>

					<legend class="f-s-15">Telefonos Inalambricos</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<label for="campo31" class="col-md-3 control-label">Telefonos Inalambricos:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo31">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo31" checked>NO</label>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo32" class="col-md-3 control-label">Cantidad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo32" id="campo32" class="form-control">
									</div>
								</div>
							</div>

							<label for="campo33" class="col-md-3 control-label">AP Claro:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo33">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo33" checked>NO</label>
				            </div>
						</fieldset>
					</div>

					<legend class="f-s-15">Tipo de Conectividad</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo34" class="col-md-3 control-label">Existente:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo34" id="campo34" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
				            <!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo35" class="col-md-3 control-label">A Implementar:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
										<input type="text" name="campo35" id="campo35" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<div class="d-inline-b">
					    <fieldset class="col-md-12">
					    	<!--*********************  INPUT TEXT  *********************-->
					    	<div class="form-group">
					    		<label for="campo37" class="col-md-3 control-label"><a title="Documente “SI” si desea restringir las salidas de la Larga Distancia Nacional, Internacional, Móviles y Local Extendida. Documente “NO” si desea dejar los permisos de marcación abiertos (es decir permitir la salida de llamadas a estos destinos)">Restringir Llamadas</a></label>
					    		<div class="col-md-9 selectContainer">
					    			<div class="input-group">
					    				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					    				<input type="text" name="campo37" id="campo37" required class="form-control" placeholder="larga d nal,larga d inter, moviles, local extendida">
					    			</div>
					    		</div>
					    	</div>
					    </fieldset>
				    </div>
					<legend class="f-s-15 m-t-10">INFORMACIÓN IMPORTANTE SERVICIO MPLS <small> (Solo Aplica si estamos en Implementación de este servicio)</small></legend>
					<div class="d-inline-b">
						<fieldset class="col-md-12">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo38" class="col-md-6 control-label">Direccionamiento LAN Asignado a la Sede:</label>
								<div class="col-md-6 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo38" id="campo38" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-12">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo39" class="col-md-6 control-label">Existe algún elemento de red el cual requiere la configuración de rutas para alcanzar el segmento LAN de la sede?:</label>
								<div class="col-md-6 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo39" id="campo39" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<legend class="f-s-15 m-t-10">INFORMACIÓN IMPORTANTE SERVICIO INTERNET <small> (Solo Aplica si estamos en Implementación de este servicio)</small></legend>
					<div class="d-inline-b">
						<h5><b>OPCIONES DE ENTREGA DEL SERVICIO</b></h5>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo40" class="col-md-3 control-label">Opción de Entrega 1:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo40" id="campo40" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo41" class="col-md-3 control-label">Opción de Entrega 2:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo41" id="campo41" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<h5><b>OPCIONES DE ENTREGA DEL SERVICIO</b></h5>
						<fieldset class="col-md-12">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo42" class="col-md-6 control-label"><a title="Por favor confirme si posee elementos de red tales como servidores de correo, webhosting, cámaras, los cuáles requieren que le entreguemos un direccionamiento público o requieren que se les configure  un NAT con el puerto que utiliza el equipo de red y así tener salida al servicio de internet.">confirme si posee elementos de red tales como servidores de correo...</a></label>
								<div class="col-md-6 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo42" id="campo42" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-12">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo43" class="col-md-6 control-label"><a title="Por favor confirme si cuenta con algún elemento de red intermedio (Firewall o Proxy) el cual le permite salida a internet a sus equipos de red LAN. Especifique la IP del elemento de red para configurar ruta estática con el segmento de red publico asignado.">confirme si cuenta con algún elemento de red intermedio ...</a></label>
								<div class="col-md-6 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo43" id="campo43" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<legend class="f-s-15 m-t-10">INFORMACIÓN IMPORTANTE POR USUARIO DE LA PBX ADMINISTRADA</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo44" class="col-md-3 control-label">Ciudad:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo44" id="campo44" class="form-control">
									</div>
								</div>
							</div>
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo45" class="col-md-3 control-label">Sede:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo45" id="campo45" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo46" class="col-md-3 control-label">Extensión Asignada:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo46" id="campo46" class="form-control">
									</div>
								</div>
							</div>
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo47" class="col-md-3 control-label">Usuario:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo47" id="campo47" class="form-control" placeholder="Nombre">
									</div>
								</div>
							</div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo48" class="col-md-3 control-label">Usuario:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo48" id="campo48" class="form-control" placeholder="Apellido">
									</div>
								</div>
							</div>

							<label for="campo49" class="col-md-3 control-label">Extensión Móvil:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo49">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo49" checked>NO</label>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">

							<label for="campo50" class="col-md-3 control-label">Grupo Captura:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo50">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo50" checked>NO</label>
				            </div>
							<!--*********************  INPUT TEXT  *********************-->
							<label for="campo51" class="col-md-3 control-label">Buzón de Voz:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo51">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo51" checked>NO</label>
				            </div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo52" class="col-md-3 control-label">Tipo de Teléfono:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo52" id="campo52" class="form-control" placeholder="Apellido">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT DATE  *********************-->
							<div class="form-group">
								<label for="campo53" class="col-md-3 control-label">Feche entrega Servicio: &nbsp;</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="date" name="campo53" id="campo53" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
            `;
        },
        // opcion de servicio 18
        instalacion_servicio_telefonia_fija_pbx_distribuida_linea_e1: function(direccion_destino){
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
				                        <input type="text" name="campo5" id="campo5" class="form-control">
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
				            			<select name="campo6" id="campo6" class="form-control multiselect_forms"  multiple="multiple">
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
											<option value="campo6 Marta">Santa Marta</option>
											<option value="Armenia">Armenia</option>
											<option value="Duitama">Duitama</option>
											<option value="Lebrija">Lebrija</option>
				            			</select>
				            		</div>
				            	</div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo7" class="col-md-3 control-label">Inicio a la intalacion:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="date" name="campo7" id="campo7" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo8" class="col-md-3 control-label">Parafiscales:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo8" id="campo8" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo9" class="col-md-3 control-label">Certificación Alturas:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo9" id="campo9" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo10" class="col-md-3 control-label">Cursos Especiales:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo10" id="campo10" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo11" class="col-md-3 control-label">EPP:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo11" id="campo11" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo12" class="col-md-3 control-label">Acompañamiento personal mto:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo12" id="campo12" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo13" class="col-md-3 control-label">Horario Especial:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo13" id="campo13" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo14" class="col-md-3 control-label">Rack:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo14" id="campo14" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo15" class="col-md-3 control-label">Tomas reguladas:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo15" id="campo15" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo16" class="col-md-3 control-label">Planta Telefónica E1:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo16" id="campo16" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo17" class="col-md-3 control-label">Modelo Planta Telefónica:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo17" id="campo17" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo18" class="col-md-3 control-label">Versión de Software:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo18" id="campo18" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo19" class="col-md-3 control-label">Administrador Planta Telefónica:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo19" id="campo19" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo20" class="col-md-3 control-label">Opción 1: RJ45:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo20" id="campo20" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo21" class="col-md-3 control-label">Opción 2:BNC:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo21" id="campo21" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo22" class="col-md-3 control-label">CRC4:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo22" id="campo22" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo23" class="col-md-3 control-label">NO-CRC4:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo23" id="campo23" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo24" class="col-md-3 control-label">HDB3:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo24" id="campo24" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo25" class="col-md-3 control-label">AMI:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo25" id="campo25" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo26" class="col-md-3 control-label">ISDN PRI-NET5:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo26" id="campo26" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo27" class="col-md-3 control-label">ISDN PRI-QSIG:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo27" id="campo27" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo28" class="col-md-3 control-label">Compilado:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo28" id="campo28" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo29" class="col-md-3 control-label">No Compilado:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo29" id="campo29" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo30" class="col-md-3 control-label">Fecha Entrega servicio:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="date" name="campo30" id="campo30" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>
				</div>
            `;
        },
        // opcion de servicio 19
        instalacion_servicio_telefonia_fija_pbx_distribuida_linea_sip: function(direccion_destino){
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
				                        <input type="text" name="campo5" id="campo5" class="form-control">
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
				            			<select name="campo6" id="campo6" class="form-control multiselect_forms"  multiple="multiple">
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
											<option value="campo6 Marta">Santa Marta</option>
											<option value="Armenia">Armenia</option>
											<option value="Duitama">Duitama</option>
											<option value="Lebrija">Lebrija</option>
				            			</select>
				            		</div>
				            	</div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo7" class="col-md-3 control-label">Inicio a la intalacion:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="date" name="campo7" id="campo7" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo8" class="col-md-3 control-label">Parafiscales:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo8" id="campo8" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo9" class="col-md-3 control-label">Certificación Alturas:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo9" id="campo9" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo10" class="col-md-3 control-label">Cursos Especiales:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo10" id="campo10" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo11" class="col-md-3 control-label">EPP:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo11" id="campo11" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo12" class="col-md-3 control-label">Acompañamiento personal mto:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo12" id="campo12" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo13" class="col-md-3 control-label">Horario Especial:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo13" id="campo13" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo14" class="col-md-3 control-label">Rack:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo14" id="campo14" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo15" class="col-md-3 control-label">Tomas reguladas:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo15" id="campo15" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo16" class="col-md-3 control-label">Planta Telefónica E1:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo16" id="campo16" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo17" class="col-md-3 control-label">Fabricante Planta Telefónica:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo17" id="campo17" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo18" class="col-md-3 control-label">Modelo Planta Telefónica:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo18" id="campo18" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo19" class="col-md-3 control-label">Versión de Software:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo19" id="campo19" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<label for="campo20" class="col-md-12 control-label">Requiere una IP Diferente a la asignada por Defecto:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo20">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo20" checked>NO</label>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo21" class="col-md-3 control-label">Administrador Planta Telefónica:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo21" id="campo21" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo22" class="col-md-3 control-label">ip a configurar:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo22" id="campo22" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo30" class="col-md-3 control-label">Fecha Entrega servicio:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="date" name="campo30" id="campo30" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>
				</div>
            `;
        },
        // opcion de servicio 20
        instalacion_servicio_telefonia_fija_pbx_distribuida_linea_sip_con_gateway_de_voz: function(direccion_destino){
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
				                        <input type="text" name="campo5" id="campo5" class="form-control">
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
				            			<select name="campo6" id="campo6" class="form-control multiselect_forms"  multiple="multiple">
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
											<option value="campo6 Marta">Santa Marta</option>
											<option value="Armenia">Armenia</option>
											<option value="Duitama">Duitama</option>
											<option value="Lebrija">Lebrija</option>
				            			</select>
				            		</div>
				            	</div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo7" class="col-md-3 control-label">Inicio a la intalacion:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="date" name="campo7" id="campo7" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo8" class="col-md-3 control-label">Parafiscales:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo8" id="campo8" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo9" class="col-md-3 control-label">Certificación Alturas:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo9" id="campo9" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo10" class="col-md-3 control-label">Cursos Especiales:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo10" id="campo10" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo11" class="col-md-3 control-label">EPP:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo11" id="campo11" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo12" class="col-md-3 control-label">Acompañamiento personal mto:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo12" id="campo12" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo13" class="col-md-3 control-label">Horario Especial:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo13" id="campo13" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo14" class="col-md-3 control-label">Rack:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo14" id="campo14" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo15" class="col-md-3 control-label">Tomas reguladas:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo15" id="campo15" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo16" class="col-md-3 control-label">Planta Telefónica IP:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo16" id="campo16" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo17" class="col-md-3 control-label">Fabricante Planta Telefónica:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo17" id="campo17" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo18" class="col-md-3 control-label">Modelo Planta Telefónica:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo18" id="campo18" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo19" class="col-md-3 control-label">Versión de Software:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo19" id="campo19" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<label for="campo20" class="col-md-12 control-label">Requiere una IP Diferente a la asignada por Defecto:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo20">SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo20" checked>NO</label>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo21" class="col-md-3 control-label">Administrador Planta Telefónica:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo21" id="campo21" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo22" class="col-md-3 control-label">ip a configurar:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo22" id="campo22" class="form-control">
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
        instalacion_telefonia_publica_basica_internet_dedicado: function(direccion_destino){
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
				                        <input type="text" name="campo4" id="campo4" class="form-control">
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
				                        <input type="text" name="campo6" id="campo6" class="form-control">
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
				                        <input type="text" name="campo7" id="campo7" class="form-control">
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
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo10" class="col-md-3 control-label">Parafiscales:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo10" id="campo10" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo11" class="col-md-3 control-label">Certificación Alturas:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo11" id="campo11" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo12" class="col-md-3 control-label">Cursos Especiales:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo12" id="campo12" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo13" class="col-md-3 control-label">EPP:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo13" id="campo13" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo14" class="col-md-3 control-label">Acompañamiento personal mto:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo14" id="campo14" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo15" class="col-md-3 control-label">Horario Especial:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo15" id="campo15" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo16" class="col-md-3 control-label">Rack:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo16" id="campo16" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo17" class="col-md-3 control-label">Tomas reguladas:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo17" id="campo17" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo18" class="col-md-3 control-label">Planta Telefónica IP:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo18" id="campo18" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
				    	<fieldset class="col-md-6">
							<div class="form-group">
				                <label for="campo18" class="col-md-3 control-label">Planta Telefónica IP:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo18" id="campo18" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo19" class="col-md-3 control-label">Larga Distancia Nacional:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo19" id="campo19" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo20" class="col-md-3 control-label">Larga Distancia Internacional:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo20" id="campo20" class="form-control">
				                    </div>
				                </div>
				            </div>
				            <!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo21" class="col-md-3 control-label">Moviles:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo21" id="campo21" class="form-control">
				                    </div>
				                </div>
				            </div>
						</fieldset>
						<fieldset class="col-md-6">
				    		<!--*********************  INPUT TEXT  *********************-->
				            <div class="form-group">
				                <label for="campo22" class="col-md-3 control-label">Local Extendida:</label>
				                <div class="col-md-9 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
				                        <input type="text" name="campo22" id="campo22" class="form-control">
				                    </div>
				                </div>
				            </div>				 
						</fieldset>
					</div>

					<legend class="f-s-15 m-t-10">INFORMACIÓN IMPORTANTE SERVICIO INTERNET</legend>
					<div class="d-inline-b">
						<h5><b>OPCIONES DE ENTREGA DEL SERVICIO</b></h5>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo23" class="col-md-3 control-label"><a title="Por favor confirme si va a conectar su red LAN con un direccionamiento diferente al público asignado por Claro. En caso de que la respuesta sea SI por favor indíquenos  el segmento al cual le debemos configurar NAT">Opción de Entrega 1:</a></label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo23" id="campo23" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo24" class="col-md-3 control-label"><a title="Por favor confirme si va a configurar sobre sus máquinas el direccionamiento publico asignado por Claro. En caso de que la respuesta sea NO por favor indíquenos el pool de direcciones para configurar DHCP y las IPs Excluidas">Opción de Entrega 2:</a></label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo24" id="campo24" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-12">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo25" class="col-md-6 control-label"><a title="Por favor confirme si posee elementos de red tales como servidores de correo, webhosting, cámaras, los cuáles requieren que le entreguemos un direccionamiento público o requieren que se les configure  un NAT con el puerto que utiliza el equipo de red y así tener salida al servicio de internet.">confirme si posee elementos de red tales como servidores de correo...</a></label>
								<div class="col-md-6 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo25" id="campo25" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-12">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo26" class="col-md-6 control-label"><a title="Por favor confirme si cuenta con algún elemento de red intermedio (Firewall o Proxy) el cual le permite salida a internet a sus equipos de red LAN. Especifique la IP del elemento de red para configurar ruta estática con el segmento de red publico asignado.">confirme si cuenta con algún elemento de red intermedio ...</a></label>
								<div class="col-md-6 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
										<input type="text" name="campo26" id="campo26" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!--*********************  INPUT DATE  *********************-->
							<div class="form-group">
								<label for="campo27" class="col-md-3 control-label">Fecha entrega servicio: &nbsp;</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="date" name="campo27" id="campo27" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
			`;
        },
        // opcion de servicio 22
        cambio_de_ultima_milla: function(direccion_destino){
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
				              <label><input type="checkbox" name="campo7" checked>SI</label>
				            </div>
				            <div class="radio col-md-6">
				              <label><input type="checkbox" name="campo7">NO</label>
				            </div>							
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<label for="campo8" class="col-md-6 control-label">Requiere Cambio de Última Milla:</label>
				            <div class="radio col-md-6">
				              <label><input type="checkbox" name="campo8" checked>SI</label>
				            </div>
				            <div class="radio col-md-6">
				              <label><input type="checkbox" name="campo8">NO</label>
				            </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- radio button -->
							<label for="campo9" class="col-md-6 control-label">Existen otros Servicios a Modificar:</label>
				            <div class="radio col-md-6">
				              <label><input type="checkbox" name="campo9" checked>SI</label>
				            </div>
				            <div class="radio col-md-6">
				              <label><input type="checkbox" name="campo9">NO</label>
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
										<input type="text" name="campo10[]" id="campo10" class="form-control">
									</div>
								</div>
							</div>
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo11" class="col-md-3 control-label">ID Servicio:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="text" name="campo11[]" id="campo11" class="form-control">
									</div>
								</div>
							</div>
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo12" class="col-md-3 control-label">Dirección Sede:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="text" name="campo12[]" id="campo12" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<label for="campo13" class="col-md-6 control-label">Requiere Cambio de equipos:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo13" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo13">NO</label>
				            </div>	

				            <label for="campo14" class="col-md-6 control-label">Requiere Cambio de UM:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo14" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo14">NO</label>
				            </div>	
						</fieldset>
					</div>
				</div>
				
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo15" class="col-md-3 control-label">inicio al Proceso:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="date" name="campo15" id="campo15" class="form-control">
									</div>
								</div>
							</div>

							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo16" class="col-md-3 control-label">Parafiscales:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="text" name="campo16" id="campo16" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo17" class="col-md-3 control-label">Certificación Alturas:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="text" name="campo17" id="campo17" class="form-control">
									</div>
								</div>
							</div>

							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo18" class="col-md-3 control-label">Cursos Especiales:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="text" name="campo18" id="campo18" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo19" class="col-md-3 control-label">EPP:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-record"></i></span>
										<input type="date" name="campo19" id="campo19" class="form-control">
									</div>
								</div>
							</div>

							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo20" class="col-md-3 control-label">Rack:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="text" name="campo20" id="campo20" class="form-control">
									</div>
								</div>
							</div>

							<!--*********************  INPUT DATE  *********************-->
							<div class="form-group">
								<label for="campo23" class="col-md-3 control-label">Fecha Entrega Ampliación: &nbsp;</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="date" name="campo23" id="campo23" required class="form-control">
									</div>
								</div>
							</div>
							
							
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo21" class="col-md-3 control-label">Tomas reguladas:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="text" name="campo21" id="campo21" class="form-control">
									</div>
								</div>
							</div>

							<label for="campo22" class="col-md-6 control-label">Requiere que el Cambio de Ultima Milla necesario para soportar la ampliación del Servicio, se ejecute en horario No Hábil o Fin de Semana:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo22" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo22">NO</label>
				            </div>	
						</fieldset>
					</div>
				</div>
            `;
        },
        // opcion de servicio 23
        cambio_de_equipo: function(direccion_destino){
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
				              <label><input type="checkbox" name="campo7" checked>SI</label>
				            </div>
				            <div class="radio col-md-6">
				              <label><input type="checkbox" name="campo7">NO</label>
				            </div>							
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-12">
							<!-- radio button -->
							<label for="campo8" class="col-md-6 control-label">Existen otros Servicios a Modificar:</label>
				            <div class="radio col-md-6">
				              <label><input type="checkbox" name="campo8" checked>SI</label>
				            </div>
				            <div class="radio col-md-6">
				              <label><input type="checkbox" name="campo8">NO</label>
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
										<input type="text" name="campo9[]" id="campo9" class="form-control">
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
							<label for="campo12" class="col-md-6 control-label">Requiere Cambio de equipos:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo12" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo12">NO</label>
				            </div>	

						</fieldset>
					</div>
				</div>
				
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo13" class="col-md-3 control-label">inicio al Proceso:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="date" name="campo13" id="campo13" class="form-control">
									</div>
								</div>
							</div>

							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo14" class="col-md-3 control-label">Parafiscales:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="text" name="campo14" id="campo14" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo15" class="col-md-3 control-label">Certificación Alturas:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="text" name="campo15" id="campo15" class="form-control">
									</div>
								</div>
							</div>

							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo16" class="col-md-3 control-label">Cursos Especiales:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="text" name="campo16" id="campo16" class="form-control">
									</div>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo17" class="col-md-3 control-label">EPP:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-record"></i></span>
										<input type="date" name="campo17" id="campo17" class="form-control">
									</div>
								</div>
							</div>

							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo18" class="col-md-3 control-label">Rack:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-hand-right"></i></span>
										<input type="text" name="campo18" id="campo18" class="form-control">
									</div>
								</div>
							</div>

							<!--*********************  INPUT DATE  *********************-->
							<div class="form-group">
								<label for="campo21" class="col-md-3 control-label">Fecha Entrega Ampliación: &nbsp;</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="date" name="campo21" id="campo21" required class="form-control">
									</div>
								</div>
							</div>
							
							
						</fieldset>
						<fieldset class="col-md-6">
							<!--*********************  INPUT TEXT  *********************-->
							<div class="form-group">
								<label for="campo19" class="col-md-3 control-label">Tomas reguladas:</label>
								<div class="col-md-9 selectContainer">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										<input type="text" name="campo19" id="campo19" class="form-control">
									</div>
								</div>
							</div>

							<label for="campo20" class="col-md-6 control-label">Requiere que el Cambio de Ultima Milla necesario para soportar la ampliación del Servicio, se ejecute en horario No Hábil o Fin de Semana:</label>
				            <div class="radio">
				              <label><input type="checkbox" name="campo20" checked>SI</label>
				            </div>
				            <div class="radio">
				              <label><input type="checkbox" name="campo20">NO</label>
				            </div>	
						</fieldset>
					</div>
				</div>
            `;
        },

        /*FIN FORMULARIOS DE SERVICIO*/
        /*****************************************INICIO FORMULARIOS DE PRODUCTO*****************************************/

        // Retorna el formulario de producto segun el servicio seleccionado
        returnFormularyProduct: function(num_servicio, arg){
            let form = "";
            switch(num_servicio){
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
        formProduct_internet: function(otp){
            return `
				<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario de producto <small>SERVICIO DE INTERNET</small></h2>
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<legend class="f-s-15">Datos basicos de instalación</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- CIUDAD -->
							<div class="form-group">
						        <label for="ciudad" class="col-md-3 control-label">Ciudad:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ciudad" id="ciudad" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						    <!-- DIRECCIÓN: Especificar barrio, piso u oficina -->
						    <div class="form-group">
						        <label for="direccion" class="col-md-3 control-label">Dirección:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_direccion" id="direccion" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>						
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- TIPO PREDIO: -->
						     <div class="form-group">
						        <label for="tipo_predio" class="col-md-3 control-label">Tipo predio:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
						                <select class="form-control" id="tipo_predio" name="pr_tipo_predio">
										    <option>Seleccionar...</option>
										    <option>Edificio</option>
												<option>Casa</option>
										    
										</select>
						            </div>
						        </div>
						    </div>	
						    <!-- NIT del cliente: -->
						    <div class="form-group">
						        <label for="nit_cliente" class="col-md-3 control-label">NIT cliente:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
						                <input name="pr_nit_cliente" id="nit_cliente" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
						    <!-- ALIAS DEL LUGAR (CODIGO DE SERVICIO//CIUDAD//SERVICIO//COMERCIO O SEDE DEL CLIENTE) -->
						    <div class="form-group">
						        <label for="alias_lugar" class="col-md-3 control-label">Alias del lugar:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_alias_lugar" id="alias_lugar" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						    <!-- OTP -->
							<div class="form-group">
						        <label for="OTP" class="col-md-3 control-label">OTP:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_OTP" id="OTP" value="${otp}" class="form-control" type="text" disabled>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						     <!-- otp_asociadas -->
							<div class="form-group">
						        <label for="otp_asociadas" class="col-md-3 control-label">OTP asociadas:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_otp_asociadas" id="otp_asociadas" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						    <!-- TIPO INTERNET: -->
						     <div class="form-group">
						        <label for="tipo_internet" class="col-md-3 control-label">Tipo internet:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="tipo_internet" name="pr_tipo_internet">
										    <option>Seleccionar...</option>
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
						        <label for="ancho_banda" class="col-md-3 control-label">Ancho de banda:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ancho_banda" id="ancho_banda" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>		

						    <!-- TIPO INSTALACION: -->
						     <div class="form-group">
						        <label for="tipo_instalacion" class="col-md-3 control-label">Tipo instalación:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="tipo_instalacion" name="pr_tipo_instalacion">
										    <option>Seleccionar...</option>
										    <option>Instalar UM con PE</option>
												<option>Instalar UM con PE sobre OTP de Pymes</option>
												<option>Instalar UM con CT (No aplica para Internet Dedicado Empresarial)</option>
												<option>Instalar UM en Datacenter Claro- Implementación</option>
												<option>UM existente. Requiere Cambio de equipo</option> 	
												<option>UM existente. Requiere Adición de equipo</option> 		
												<option>UM existente. Solo configuración</option> 									    
										</select>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- ID SERVICIO ACTUAL (Aplica para UM Existente) -->
							<div class="form-group">
						        <label for="id_servicio_actual" class="col-md-3 control-label">ID servicio Actual:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_id_servicio_actual" id="id_servicio_actual" class="form-control" type="text" >
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
						        <label for="requiere_instalacion_um" class="col-md-3 control-label">Requiere instalación UM:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="requiere_instalacion_um" name="pr_requiere_instalacion_um">
										    <option>Seleccionar...</option>
										    <option>Si</option>
												<option>No</option>   												
												<option>Existente</option> 	    
										</select>
						            </div>
						        </div>
						    </div>
							
						     <!-- PROVEEDOR: -->
						     <div class="form-group">
						        <label for="proveedor_milla" class="col-md-3 control-label">Proveedor:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="proveedor_milla" name="pr_proveedor_milla">
										    <option>Seleccionar...</option>
										    <option>No aplica</option>
												<option>Existente</option>
												<option>Claro</option>
												<option>Axesat</option>
												<option>Comcel</option> 	
												<option>Tigo</option> 		
												<option>Media Commerce</option> 		
												<option>Diveo</option>
												<option>Edatel</option> 	
												<option>UNE</option> 		
												<option>ETB</option> 	
												<option>IBM</option> 		
												<option>IFX</option> 		
												<option>Level 3 Colombia</option>
												<option>Mercanet</option> 	
												<option>Metrotel</option> 		
												<option>Promitel</option> 		
												<option>Skynet</option> 		
												<option>Telebucaramanga</option>
												<option>Telecom</option> 	
												<option>Terremark</option> 		
												<option>Sol Cable Vision</option> 		
												<option>Sistelec</option>
												<option>Opain</option> 	
												<option>Airplan - (Información y Tecnologia)</option> 		
												<option>TV Azteca</option> 						    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- MEDIO -->
						    <div class="form-group">
						        <label for="medio_um" class="col-md-3 control-label">Medio:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="medio_um" name="pr_medio_um">
										    <option>Seleccionar...</option>
										    <option>No Aplica</option>  									   									
										    <option>Existente</option> 	   
										    <option>Fibra</option>
										    <option>Cobre</option>
										    <option>Satelital</option> 
										    <option>Radio enlace</option>
										    <option>3G</option>
										    <option>UTP</option>
										</select>
						            </div>
						        </div>
						    </div>

						    
				            <!-- RESPUESTA FACTIBILIDAD BW > =100 MEGAS : -->
				            <div class="form-group">
						        <label for="respuesta_factibilidad" class="col-md-3 control-label">Respuesta factibilidad BW >= 100 MEGAS:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_respuesta_factibilidad" id="respuesta_factibilidad" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
				            <!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
						    <div class="form-group">
						        <label for="tipo_conector" class="col-md-3 control-label">Tipo conector:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="tipo_conector" name="pr_tipo_conector">
										    <option>Seleccionar...</option>
										    <option>LC</option>  									   									
										    <option>SC</option> 	   
										    <option>ST</option>
										    <option>FC</option>
										</select>
						            </div>
						        </div>
						    </div>

							<!-- 2.ACCESO (Solo Aplica para Canales > = 100 MEGAS   ======= -->
				            <!-- SDS DESTINO (Unifilar): -->
				            <div class="form-group">
						        <label for="sds_destino" class="col-md-3 control-label">SDS destino(unifiliar):</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_sds_destino" id="sds_destino" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
				            <!-- OLT (GPON): -->
				            <div class="form-group">
						        <label for="olt_gpon" class="col-md-3 control-label">OLT(GPON):</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_olt_gpon" id="olt_gpon" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
				            
							
						</fieldset>
					</div>

					<div class="d-inline-b">

						<fieldset class="col-md-6">
				            <!-- INTERFACE DE ENTREGA AL CLIENTE: -->
				            <div class="form-group">
				                <label for="interface_entrega_cliente" class="col-md-3 control-label">Interface entrega al cliente:</label>
				                <div class="col-md-8 selectContainer">
				                    <div class="input-group">
				                        <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="interface_entrega_cliente" name="pr_interface_entrega_cliente">
										    <option>Seleccionar...</option>
										    <option>No aplica</option>  									   									
										    <option>Ethernet</option> 	   
										    <option>Serial V.35</option>
										    <option>Giga (óptico)</option>
										    <option>Giga Ethernet (Electrico)</option>  						   									
										    <option>STM-1</option> 	   
										    <option>RJ45 - 120 OHM</option>
										    <option>G703 BNC</option>
										</select>
				                    </div>
				                </div>
				            </div>

				            <!-- REQUIERE VOC : -->
						     <div class="form-group">
						        <label for="requiere_voc" class="col-md-3 control-label">Requiere VOC:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="requiere_voc" name="pr_requiere_voc">
										    <option>Seleccionar...</option>
										    <option>Si</option>
												<option>No</option>   												
												<option>No aplica</option> 	    
										</select>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- PROGRAMACIÓN DE VOC : -->
						     <div class="form-group">
						        <label for="programacion_voc" class="col-md-3 control-label">Programación de VOC:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="programacion_voc" name="pr_programacion_voc">
										    <option>Seleccionar...</option>
										    <option>Programada</option>
												<option>No requiere programación</option>   												
												<option>No programada. Otra ciudad</option> 	    
												<option>No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
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
						        <label for="requiere_rfc" class="col-md-3 control-label">Requiere RFC:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="requiere_rfc" name="pr_requiere_rfc">
										    <option>Seleccionar...</option>
										    <option>SI => Cliente Critico Punto Central</option>
												<option>SI => Servicio Critico (Listado)</option>   												
												<option>SI => Cliente Critico</option> 	    
												<option>SI => RFC Estándar Saturación</option>
												<option>SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
												<option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

							<!-- EQUIPOS   (VER LISTA COMPLETA): -->
							<!-- Conversor Medio: -->
				            <div class="form-group">
						        <label for="conversor_medio" class="col-md-3 control-label">Conversor Medio:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_conversor_medio" id="conversor_medio" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- Referencia Router: -->
				            <div class="form-group">
						        <label for="referencia_router" class="col-md-3 control-label">Referencia Router:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_referencia_router" id="referencia_router" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Modulos o Tarjetas: -->
				            <div class="form-group">
						        <label for="modulo_o_tarjeta" class="col-md-3 control-label">Modulos o Tarjetas:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_modulo_o_tarjeta" id="modulo_o_tarjeta" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
						   	<!-- Licencias --> 
						    <div class="form-group">
						        <label for="licencias" class="col-md-3 control-label">Licencias:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_licencias" id="licencias" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Equipos Adicionale--> 
						    <div class="form-group">
						        <label for="equipos_adicionales" class="col-md-3 control-label">Equipos adicionale:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_equipos_adicionales" id="equipos_adicionales" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- Consumibles--> 
						    <div class="form-group">
						        <label for="consumibles" class="col-md-3 control-label">Consumibles:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_consumibles" id="consumibles" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
						     <div class="form-group">
						        <label for="registro_importacion_carta" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="registro_importacion_carta" name="pr_registro_importacion_carta">
										    <option>Seleccionar...</option>
										    <option>Si</option>
												<option>No</option>
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
						        <label for="nombre_dcc" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_nombre_dcc" id="nombre_dcc" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="telefono_dcc" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_telefono_dcc" id="telefono_dcc" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						   
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- CELULAR --> 
						    <div class="form-group">
						        <label for="celular_dcc" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_celular_dcc" id="celular_dcc" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="email_dcc" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_email_dcc" id="email_dcc" class="form-control" type="email" >
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
						        <label for="nombre_dct" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_nombre_dct" id="nombre_dct" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="telefono_dct" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_telefono_dct" id="telefono_dct" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- CELULAR --> 
						    <div class="form-group">
						        <label for="celular_dct" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_celular_dct" id="celular_dct" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="email_dct" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_email_dct" id="email_dct" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						    
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">
						    <!-- OBSERVACIONES: LA UM SE ESTA ENTREGANDO SOBRE OT DE TELEFONIA 9722208 --> 
						    <div class="form-group">
						        <label for="observaciones_dct" class="col-md-3 control-label">Observaciones:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_observaciones_dct" id="observaciones_dct" class="form-control" type="text" >
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
						        <label for="ancho_banda_nap" class="col-md-3 control-label">Ancho de banda Exclusivo NAP :</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ancho_banda_nap" id="ancho_banda_nap" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- Ancho de banda de Internet  --> 
						    <div class="form-group">
						        <label for="ancho_banda_internet" class="col-md-3 control-label">Ancho de banda de Internet:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ancho_banda_internet" id="ancho_banda_internet" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- Direcciones IP : -->
						     <div class="form-group">
						        <label for="direccion_ip" class="col-md-3 control-label">Direcciones IP:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="direccion_ip" name="pr_direccion_ip">
										    <option>Seleccionar...</option>
										    <option>Cantidad IPs: 2 - Mascara: /30</option>
												<option>Cantidad IPs 6 - Mascara: /29</option>
												<option>Cantidad IPs 14 - Mascara: /28 - Requiere Viabilidad Preventa</option>
												<option>Cantidad Ips: 30 - Mascara: /27 - Requiere Viabilidad Preventa</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Activación correo -->
						     <div class="form-group">
						        <label for="activacion_correo" class="col-md-3 control-label">Activación correo:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="activacion_correo" name="pr_activacion_correo">
										    <option>Seleccionar...</option>
										    <option>Si</option>
												<option>No</option>
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
						        <label for="activacion_hosting" class="col-md-3 control-label">Activación WEB Hosting:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="activacion_hosting" name="pr_activacion_hosting">
										    <option>Seleccionar...</option>
										    <option>Si</option>
												<option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Dominio existente -->
						     <div class="form-group">
						        <label for="Dominio_existente" class="col-md-3 control-label">Dominio existente:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="Dominio_existente" name="pr_Dominio_existente">
										    <option>Seleccionar...</option>
										    <option>Si</option>
												<option>No</option>
										</select>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- Dominio a comprar -->
						    <div class="form-group">
						        <label for="dominio_a_comprar" class="col-md-3 control-label">Dominio a comprar:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_dominio_a_comprar" id="dominio_a_comprar" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad cuentas de correo-->
						     <div class="form-group">
						        <label for="cantidad_cuentas_correo" class="col-md-3 control-label">Cantidad cuentas de correo:</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="cantidad_cuentas_correo" name="pr_cantidad_cuentas_correo">
										    <option>Seleccionar...</option>
										    <option>20</option>
												<option>40</option>
												<option>140</option>
												<option>160</option>
												<option>200</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Espacio de correo (GB)-->
						     <div class="form-group">
						        <label for="espacio_correo_gb" class="col-md-3 control-label">Espacio de correo (GB) :</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="espacio_correo_gb" name="pr_espacio_correo_gb">
										    <option>Seleccionar...</option>
										    <option>2</option>
												<option>4</option>
												<option>14</option>
												<option>16</option>
												<option>20</option>
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
						        <label for="pataforma_web_hosting" class="col-md-3 control-label">Plataforma de WEB Hosting ::</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pataforma_web_hosting" name="pr_pataforma_web_hosting">
										    <option>Seleccionar...</option>
										    <option>Windows</option>
												<option>Solaris</option>
												<option>NA</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- WEB Hosting (MB)-->
						    <div class="form-group">
						        <label for="web_hosting_mb" class="col-md-3 control-label">WEB Hosting (MB):</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="web_hosting_mb" name="pr_web_hosting_mb">
										    <option>Seleccionar...</option>
										    <option>20</option>
												<option>40</option>
												<option>140</option>
												<option>160</option>
												<option>200</option>
										</select>
						            </div>
						        </div>
						    </div>
							
						</fieldset>
						<fieldset class="col-md-6">
						    <!-- APLICA A ALGUNA PROMOCION VIGENTE (POR FAVOR DOCUMENTAR  NOMBRE DE LA PROMOCION) : -->
						    <div class="form-group">
						        <label for="promocion_vigente_nom" class="col-md-3 control-label">Aplica alguna promocion vigente (nombre promocion):</label>
						        <div class="col-md-8 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_promocion_vigente_nom" id="promocion_vigente_nom" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
				</div>

            `;
        },

        /*MPLS*/
        formProduct_mpls: function(otp){
            return `
				<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario de producto <small>MPLS</small></h2>
				<!--*********************  MODULO PESTAÑAS  *********************-->
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#mpls_punto_origen">PUNTO DE ORIGEN</a></li>
					<li class=""><a data-toggle="tab" href="#mpls_punto_destino">PUNTO DESTINO</a></li>
				</ul>

				<!--*********************  CONTENIDO PESTAÑAS  *********************-->
				<div class="tab-content">

					<div id="mpls_punto_origen" class="tab-pane fade in active">
						<h3>PUNTO DE ORIGEN</h3>
						<div class="widget bg_white m-t-25 d-inline-b cliente">
							<legend class="f-s-15">Datos básicos de instalacion - origen</legend>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									<!-- CIUDAD -->
									<div class="form-group">
								        <label for="ciudad_mpls" class="col-md-3 control-label">Ciudad:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="ciudad_mpls" id="ciudad_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- DIRECCIÓN:-->
								    <div class="form-group">
								        <label for="direccion_mpls" class="col-md-3 control-label">Dirección:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="direccion_mpls" id="direccion_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- TIPO PREDIO: -->
								     <div class="form-group">
								        <label for="tipo_predio_mpls" class="col-md-3 control-label">Tipo predio:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
								                <select class="form-control" id="tipo_predio_mpls" name="tipo_predio_mpls">
												    <option>Seleccionar...</option>
												    <option>Edificio</option>
				  									<option>Casa</option>
												    
												</select>
								            </div>
								        </div>
								    </div>	

								    <!-- NIT del cliente: -->
								    <div class="form-group">
								        <label for="nit_cliente_mpls" class="col-md-3 control-label">NIT del cliente:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
								                <input name="nit_cliente_mpls" id="nit_cliente_mpls" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									
								    <!-- ALIAS DEL LUGAR  -->
								    <div class="form-group">
								        <label for="alias_lugar_mpls" class="col-md-3 control-label">Alias del lugar:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="alias_lugar_mpls" id="alias_lugar_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- OTP -->
									<div class="form-group">
								        <label for="otp_mpls" class="col-md-3 control-label">OTP:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="otp_mpls" id="otp_mpls" value="${otp}" class="form-control" type="text" disabled>
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									 <!-- otp_asociadas -->
									<div class="form-group">
								        <label for="otp_asociadas_mpls" class="col-md-3 control-label">OTP asociadas:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="otp_asociadas_mpls" id="otp_asociadas_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>


								    <!-- TIPO MPLS: -->
								     <div class="form-group">
								        <label for="tipo_mpls" class="col-md-3 control-label">Tipo MPLS:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="tipo_mpls" name="tipo_mpls">
												    <option>Seleccionar...</option>
												    <option>MPLS Avanzado INTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado INTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado INTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado INTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado INTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)</option> 
				  									<option>MPLS Avanzado EXTRANET NDS6 +  Monitoreo CPE (Gestión Proactiva)</option>	
				  									<option>MPLS Avanzado EXTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)</option>	
				  									<option>MPLS Avanzado EXTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado EXTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado EXTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado EXTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado Solución Punta Backend Triara</option>		
				  									<option>MPLS Avanzado Solución Punta Backend Ortezal</option>
				  									<option>MPLS Avanzado Componente Datacenter (con Punta en Rack de Appliance) </option>
				  									<option>MPLS Avanzado Claro Connect (con Punta Cloud)</option>
				  									<option>MPLS Transaccional - Solución Fibra</option>
				  									<option>MPLS Transaccional - Solución HFC</option>		
				  									<option>MPLS Transaccional - Solución 3G</option>	
				  									<option>IP Data Internacional</option>		
				  									<option>Backup de Ultima Milla Fibra</option>
				  									<option>Backup de Ultima Milla Fibra  + Router</option>    
				  									<option>Backup de Ultima Milla HFC</option>
				  									<option>Backup de Ultima Milla 3G</option>
				  									<option>Backup de Ultima Milla Terceros</option>
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
								        <label for="ancho_banda_mpls" class="col-md-3 control-label">Ancho de banda:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="ancho_banda_mpls" id="ancho_banda_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>		

								    <!-- TIPO INSTALACION: -->
								     <div class="form-group">
								        <label for="tipo_instalacion_mpls" class="col-md-3 control-label">Tipo instalación:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="tipo_instalacion_mpls" name="tipo_instalacion_mpls">
												    <option>Seleccionar...</option>
												    <option>Instalar UM con PE</option>
												    <option>Instalar UM con PE sobre OTP de Pymes</option>
												    <option>Instalar UM con CT</option>
												    <option>Instalar UM con HFC</option>
				  									<option>Instalar UM con 3G</option>
				  									<option>Instalar UM en Datacenter Claro- Implementación</option>
				  									<option>UM existente. Requiere Cambio de equipo</option>
				  									<option>UM existente. Requiere Adición de equipo</option> 	
				  									<option>UM existente. Solo configuración</option> 							    
												</select>
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									 <!-- ID SERVICIO ACTUAL -->
									<div class="form-group">
								        <label for="id_servicio_mpls" class="col-md-3 control-label"><a title="Aplica para UM Existente">ID SERVICIO ACTUAL :</a></label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="id_servicio_mpls" id="id_servicio_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- ID SERVICIO PRINCIPAL (Aplica solo para enlaces Backup):-->
									<div class="form-group">
								        <label for="id_servicio_principal_mpls" class="col-md-3 control-label"><a title="Aplica solo para enlaces Backup">ID SERVICIO PRINCIPAL:</a></label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="id_servicio_principal_mpls" id="id_servicio_principal_mpls" class="form-control" type="text" >
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
								        <label for="requiere_instalacion_um_mpls" class="col-md-3 control-label">¿Esta OT requiere instalacion UM?:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="requiere_instalacion_um_mpls" name="requiere_instalacion_um_mpls">
												    <option>Seleccionar...</option>
												    <option>Si</option>
				  									<option>No</option>   												
				  									<option>Existente</option> 	    
												</select>
								            </div>
								        </div>
								    </div>

								    <!-- ESTA ULTIMA MILLA ES UN BACKUP?: -->
								    <div class="form-group">
								        <label for="ultima_milla_backup_mpls" class="col-md-3 control-label">Esta ultima milla es un backup:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="ultima_milla_backup_mpls" name="ultima_milla_backup_mpls">
												    <option>Seleccionar...</option>
												    <option>Si</option>
				  									<option>No</option>   												
				  									<option>Existente</option> 				    
												</select>
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- PROVEEDOR: -->
								    <div class="form-group">
								        <label for="proveedor_mpls" class="col-md-3 control-label">Proveedor:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="proveedor_mpls" name="proveedor_mpls">
												    <option>Seleccionar...</option>
												    <option>No aplica</option>
				  									<option>Existente</option>
				  									<option>Claro</option>
				  									<option>Axesat</option>
				  									<option>Comcel</option> 	
				  									<option>Tigo</option> 		
				  									<option>Media Commerce</option> 		
				  									<option>Diveo</option>
				  									<option>Edatel</option> 	
				  									<option>UNE</option> 		
				  									<option>ETB</option> 	
				  									<option>IBM</option> 		
				  									<option>IFX</option> 		
				  									<option>Level 3 Colombia</option>
				  									<option>Mercanet</option> 	
				  									<option>Metrotel</option> 		
				  									<option>Promitel</option> 		
				  									<option>Skynet</option> 		
				  									<option>Telebucaramanga</option>
				  									<option>Telecom</option> 	
				  									<option>Terremark</option> 		
				  									<option>Sol Cable Vision</option> 		
				  									<option>Sistelec</option>
				  									<option>Opain</option> 	
				  									<option>Airplan - (Información y Tecnologia)</option> 		
				  									<option>TV Azteca</option> 						    
												</select>
								            </div>
								        </div>
								    </div>

								    <!-- MEDIO -->
								    <div class="form-group">
								        <label for="medio_mpls" class="col-md-3 control-label">Medio:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="medio_mpls" name="medio_mpls">
												    <option>Seleccionar...</option>
												    <option>No Aplica</option> 	   
												    <option>Fibra</option>
												    <option>Cobre</option>
												    <option>HFC</option>
												    <option>Satelital</option> 
												    <option>Radio enlace</option>
												    <option>3G</option>
												    <option>UTP</option>
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
								        <label for="respuesta_factibilidad_mpls" class="col-md-3 control-label">Respuesta factibilidad BW >= 100 MEGAS:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="respuesta_factibilidad_mpls" id="respuesta_factibilidad_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

						            <!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
								    <div class="form-group">
								        <label for="tipo_conector_mpls" class="col-md-3 control-label">Tipo conector:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="tipo_conector_mpls" name="tipo_conector_mpls">
												    <option>Seleccionar...</option>
												    <option>LC</option>  									   									
												    <option>SC</option> 	   
												    <option>ST</option>
												    <option>FC</option>
												</select>
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- ACCESO (Solo Aplica para Canales SDH) : -->
						            <div class="form-group">
								        <label for="sds_destino_mpls" class="col-md-3 control-label">SDS DESTINO (Unifilar):</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="sds_destino_mpls" id="sds_destino_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								    
								    <!-- INTERFACE DE ENTREGA AL CLIENTE: -->
								    <div class="form-group">
								        <label for="tipo_conector_mpls" class="col-md-3 control-label">Interface de entrega al cliente:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="tipo_conector_mpls" name="tipo_conector_mpls">
												    <option>Seleccionar...</option>
												    <option>No aplica</option> 									   									
												    <option>Ethernet</option> 	   
												    <option>Serial V.35</option>
												    <option>Giga (óptico)</option>
												    <option>Giga Ethernet (Electrico)</option>
												    <option>STM-1</option>
												    <option>RJ45 - 120 OHM</option>
												    <option>G703 BNC</option>
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
								        <label for="requiere_voc_mpls" class="col-md-3 control-label">Requiere VOC:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="requiere_voc_mpls" name="requiere_voc_mpls">
												    <option>Seleccionar...</option>
												    <option>Si</option>
				  									<option>No</option>   												
				  									<option>No aplica</option> 	    
												</select>
								            </div>
								        </div>
								    </div>

								    
								</fieldset>
								<fieldset class="col-md-6">
									<!-- PROGRAMACIÓN DE VOC : -->
								     <div class="form-group">
								        <label for="programacion_voc_mpls" class="col-md-3 control-label">Programación de VOC:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="programacion_voc_mpls" name="programacion_voc_mpls">
												    <option>Seleccionar...</option>
												    <option>Programada</option>
				  									<option>No requiere programación</option>   												
				  									<option>No programada. Otra ciudad</option> 	    
				  									<option>No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
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
								        <label for="requiere_rfc_mpls" class="col-md-3 control-label">Requiere RFC:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="requiere_rfc_mpls" name="requiere_rfc_mpls">
												    <option>Seleccionar...</option>
												    <option>SI => Cliente Critico Punto Central</option>
				  									<option>SI => Servicio Critico (Listado)</option>  												
				  									<option>SI => Cliente Critico</option> 	    
				  									<option>SI => RFC Estándar Saturación</option>
				  									<option>SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
				  									<option>No</option>
												</select>
								            </div>
								        </div>
								    </div>

									<!-- Conversor Medio: -->
						            <div class="form-group">
								        <label for="conversor_medio_mpls" class="col-md-3 control-label">Conversor Medio:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="conversor_medio_mpls" id="conversor_medio_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- Referencia Router: -->
						            <div class="form-group">
								        <label for="referencia_router_mpls" class="col-md-3 control-label">Referencia Router:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="referencia_router_mpls" id="referencia_router_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- Modulos o Tarjetas: -->
						            <div class="form-group">
								        <label for="modulo_o_tarjeta_mpls" class="col-md-3 control-label">Modulos o Tarjetas:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="modulo_o_tarjeta_mpls" id="modulo_o_tarjeta_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
										<!-- Licencias --> 
								    <div class="form-group">
								        <label for="licencias_mpls" class="col-md-3 control-label">Licencias:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="licencias_mpls" id="licencias_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- Equipos Adicionale--> 
								    <div class="form-group">
								        <label for="equipos_adicionales_mpls" class="col-md-3 control-label">Equipos adicionale:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="equipos_adicionales_mpls" id="equipos_adicionales_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									 <!-- Consumibles:--> 
								    <div class="form-group">
								        <label for="consumibles_mpls" class="col-md-3 control-label">Consumibles:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="consumibles_mpls" name="consumibles_mpls">
												    <option>Seleccionar...</option>
												    <option>Bandeja</option>
				  									<option>Cables de Poder </option>
				  									<option>Clavijas de Conexión</option>
				  									<option>Accesorios para rackear (Orejas)</option>
				  									<option>No Aplica</option>
												</select>
								            </div>
								        </div>
								    </div>

								    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
								     <div class="form-group">
								        <label for="registro_importacion_carta_mpls" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="registro_importacion_carta_mpls" name="registro_importacion_carta_mpls">
												    <option>Seleccionar...</option>
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
								        <label for="nombre_cot_mpls" class="col-md-3 control-label">Nombre:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="nombre_cot_mpls" id="nombre_cot_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- TELEFONO --> 
								    <div class="form-group">
								        <label for="telefono_cot_mpls" class="col-md-3 control-label">Telefono:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="telefono_cot_mpls" id="telefono_cot_mpls" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- CELULAR --> 
								    <div class="form-group">
								        <label for="celular_cot_mpls" class="col-md-3 control-label">Celular:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="celular_cot_mpls" id="celular_cot_mpls" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>

								    <!-- EMAIL --> 
								    <div class="form-group">
								        <label for="email_cot_mpls" class="col-md-3 control-label">Email:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="email_cot_mpls" id="email_cot_mpls" class="form-control" type="email" >
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
								        <label for="nombre_dct_mpls" class="col-md-3 control-label">Nombre:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="nombre_dct_mpls" id="nombre_dct_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- TELEFONO --> 
								    <div class="form-group">
								        <label for="telefono_dct_mpls" class="col-md-3 control-label">Telefono:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="telefono_dct_mpls" id="telefono_dct_mpls" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									 <!-- CELULAR --> 
								    <div class="form-group">
								        <label for="celular_dct_mpls" class="col-md-3 control-label">Celular:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="celular_dct_mpls" id="celular_dct_mpls" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>

								    <!-- EMAIL --> 
								    <div class="form-group">
								        <label for="email_dct_mpls" class="col-md-3 control-label">Correo electronico:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="email_dct_mpls" id="email_dct_mpls" class="form-control" type="email" >
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
							<div class="d-inline-b">
								<fieldset class="col-md-12">
								    <!-- OBSERVACIONES: --> 
								    <div class="form-group">
								        <label for="observaciones_dct_mpls" class="col-md-3 control-label">Observaciones:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="observaciones_dct_mpls" id="observaciones_dct_mpls" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
						</div>		
					</div>

					<div id="mpls_punto_destino" class="tab-pane fade">
						<h3>PUNTO DESTINO</h3>
						<div class="widget bg_white m-t-25 d-inline-b cliente">
							<legend class="f-s-15">DATOS BÁSICOS DE INSTALACION PUNTO DESTINO</legend>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									<!-- CIUDAD -->
									<div class="form-group">
								        <label for="ciudad_mpls_pd" class="col-md-3 control-label">Ciudad:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="ciudad_mpls_pd" id="ciudad_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- DIRECCIÓN:-->
								    <div class="form-group">
								        <label for="direccion_mpls_pd" class="col-md-3 control-label">Dirección:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="direccion_mpls_pd" id="direccion_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								</fieldset>
								<fieldset class="col-md-6">
									<!-- TIPO PREDIO: -->
								     <div class="form-group">
								        <label for="tipo_predio_mpls_pd" class="col-md-3 control-label">Tipo predio:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
								                <select class="form-control" id="tipo_predio_mpls_pd" name="tipo_predio_mpls_pd">
												    <option>Seleccionar...</option>
												    <option>Edificio</option>
				  									<option>Casa</option>
												    
												</select>
								            </div>
								        </div>
								    </div>	

								    <!-- NIT del cliente: -->
								    <div class="form-group">
								        <label for="nit_cliente_mpls_pd" class="col-md-3 control-label">NIT del cliente:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" ></i></span>
								                <input name="nit_cliente_mpls_pd" id="nit_cliente_mpls_pd" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									<!-- ALIAS DEL LUGAR  -->
								    <div class="form-group">
								        <label for="alias_lugar_mpls_pd" class="col-md-3 control-label">Alias del lugar:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="alias_lugar_mpls_pd" id="alias_lugar_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- OTP -->
									<div class="form-group">
								        <label for="otp_mpls_pd" class="col-md-3 control-label">OTP:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="otp_mpls_pd" id="otp_mpls_pd" class="form-control" type="text" value="${otp}" disabled>
								            </div>
								        </div>
								    </div>
								    
								</fieldset>
								<fieldset class="col-md-6">
									 <!-- otp_asociadas -->
									<div class="form-group">
								        <label for="otp_asociadas_mpls_pd" class="col-md-3 control-label">OTP asociadas:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="otp_asociadas_mpls_pd" id="otp_asociadas_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>


								    <!-- TIPO MPLS: -->
								     <div class="form-group">
								        <label for="tipo_mpls_pd" class="col-md-3 control-label">Tipo MPLS:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="tipo_mpls_pd" name="tipo_mpls_pd">
												    <option>Seleccionar...</option>
												    <option>MPLS Avanzado INTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado INTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado INTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado INTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado INTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)</option> 
				  									<option>MPLS Avanzado EXTRANET NDS6 +  Monitoreo CPE (Gestión Proactiva)</option>	
				  									<option>MPLS Avanzado EXTRANET NDS5 +  Monitoreo CPE (Gestión Proactiva)</option>	
				  									<option>MPLS Avanzado EXTRANET NDS4 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado EXTRANET NDS3 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado EXTRANET NDS2 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado EXTRANET NDS1 +  Monitoreo CPE (Gestión Proactiva)</option>
				  									<option>MPLS Avanzado Solución Punta Backend Triara</option>		
				  									<option>MPLS Avanzado Solución Punta Backend Ortezal</option>
				  									<option>MPLS Avanzado Componente Datacenter (con Punta en Rack de Appliance) </option>
				  									<option>MPLS Avanzado Claro Connect (con Punta Cloud)</option>
				  									<option>MPLS Transaccional - Solución Fibra</option>
				  									<option>MPLS Transaccional - Solución HFC</option>		
				  									<option>MPLS Transaccional - Solución 3G</option>	
				  									<option>IP Data Internacional</option>		
				  									<option>Backup de Ultima Milla Fibra</option>
				  									<option>Backup de Ultima Milla Fibra  + Router</option>    
				  									<option>Backup de Ultima Milla HFC</option>
				  									<option>Backup de Ultima Milla 3G</option>
				  									<option>Backup de Ultima Milla Terceros</option>
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
								        <label for="ancho_banda_mpls_pd" class="col-md-3 control-label">Ancho de banda:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="ancho_banda_mpls_pd" id="ancho_banda_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>		

								    <!-- TIPO INSTALACION: -->
								     <div class="form-group">
								        <label for="tipo_instalacion_mpls_pd" class="col-md-3 control-label">Tipo instalación:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="tipo_instalacion_mpls_pd" name="tipo_instalacion_mpls_pd">
												    <option>Seleccionar...</option>
												    <option>Instalar UM con PE</option>
												    <option>Instalar UM con PE sobre OTP de Pymes</option>
												    <option>Instalar UM con CT</option>
												    <option>Instalar UM con HFC</option>
				  									<option>Instalar UM con 3G</option>
				  									<option>Instalar UM en Datacenter Claro- Implementación</option>
				  									<option>UM existente. Requiere Cambio de equipo</option>
				  									<option>UM existente. Requiere Adición de equipo</option> 	
				  									<option>UM existente. Solo configuración</option> 							    
												</select>
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									
								    <!-- ID SERVICIO ACTUAL -->
									<div class="form-group">
								        <label for="id_servicio_mpls_pd" class="col-md-3 control-label"><a title="Aplica para UM Existente">ID SERVICIO ACTUAL:</a></label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="id_servicio_mpls_pd" id="id_servicio_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- ID SERVICIO PRINCIPAL (Aplica solo para enlaces Backup):-->
									<div class="form-group">
								        <label for="id_servicio_principal_mpls_pd" class="col-md-3 control-label"><a title="Aplica solo para enlaces Backup">ID SERVICIO PRINCIPAL:</a></label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="id_servicio_principal_mpls_pd" id="id_servicio_principal_mpls_pd" class="form-control" type="text" >
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
								        <label for="requiere_instalacion_um_mpls_pd" class="col-md-3 control-label">¿Esta OT requiere instalacion UM?:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="requiere_instalacion_um_mpls_pd" name="requiere_instalacion_um_mpls_pd">
												    <option>Seleccionar...</option>
												    <option>Si</option>
				  									<option>No</option>   												    
												</select>
								            </div>
								        </div>
								    </div>

								    <!-- ESTA ULTIMA MILLA ES UN BACKUP?: -->
								    <div class="form-group">
								        <label for="ultima_milla_backup_mpls_pd" class="col-md-3 control-label">Esta ultima milla es un backup:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="ultima_milla_backup_mpls_pd" name="ultima_milla_backup_mpls_pd">
												    <option>Seleccionar...</option>
												    <option>Si</option>
				  									<option>No</option>   					    
												</select>
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- PROVEEDOR: -->
								    <div class="form-group">
								        <label for="proveedor_mpls_pd" class="col-md-3 control-label">Proveedor:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="proveedor_mpls_pd" name="proveedor_mpls_pd">
												    <option>Seleccionar...</option>
												    <option>No aplica</option>
				  									<option>Existente</option>
				  									<option>Claro</option>
				  									<option>Axesat</option>
				  									<option>Comcel</option> 	
				  									<option>Tigo</option> 		
				  									<option>Media Commerce</option> 		
				  									<option>Diveo</option>
				  									<option>Edatel</option> 	
				  									<option>UNE</option> 		
				  									<option>ETB</option> 	
				  									<option>IBM</option> 		
				  									<option>IFX</option> 		
				  									<option>Level 3 Colombia</option>
				  									<option>Mercanet</option> 	
				  									<option>Metrotel</option> 		
				  									<option>Promitel</option> 		
				  									<option>Skynet</option> 		
				  									<option>Telebucaramanga</option>
				  									<option>Telecom</option> 	
				  									<option>Terremark</option> 		
				  									<option>Sol Cable Vision</option> 		
				  									<option>Sistelec</option>
				  									<option>Opain</option> 	
				  									<option>Airplan - (Información y Tecnologia)</option> 		
				  									<option>TV Azteca</option> 						    
												</select>
								            </div>
								        </div>
								    </div>

								    <!-- MEDIO -->
								    <div class="form-group">
								        <label for="medio_mpls_pd" class="col-md-3 control-label">Medio:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="medio_mpls_pd" name="medio_mpls_pd">
												    <option>Seleccionar...</option>
												    <option>No Aplica</option> 	   
												    <option>Fibra</option>
												    <option>Cobre</option>
												    <option>HFC</option>
												    <option>Satelital</option> 
												    <option>Radio enlace</option>
												    <option>3G</option>
												    <option>UTP</option>
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
								        <label for="respuesta_factibilidad_mpls_pd" class="col-md-3 control-label">Respuesta factibilidad BW > 100 MEGAS:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="respuesta_factibilidad_mpls_pd" id="respuesta_factibilidad_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

						            <!-- TIPO DE CONECTOR *** (Aplica para FO Claro): -->
								    <div class="form-group">
								        <label for="tipo_conector_mpls_pd" class="col-md-3 control-label">Tipo conector:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="tipo_conector_mpls_pd" name="tipo_conector_mpls_pd">
												    <option>Seleccionar...</option>
												    <option>LC</option>  									   									
												    <option>SC</option> 	   
												    <option>ST</option>
												    <option>FC</option>
												</select>
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- ACCESO (Solo Aplica para Canales SDH) : -->
						            <div class="form-group">
								        <label for="sds_destino_mpls_pd" class="col-md-3 control-label">SDS DESTINO (Unifilar):</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="sds_destino_mpls_pd" id="sds_destino_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								    
								    <!-- INTERFACE DE ENTREGA AL CLIENTE: -->
								    <div class="form-group">
								        <label for="tipo_conector_mpls_pd" class="col-md-3 control-label">Interface de entrega al cliente:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="tipo_conector_mpls_pd" name="tipo_conector_mpls_pd">
												    <option>Seleccionar...</option>
												    <option>No aplica</option> 									   									
												    <option>Ethernet</option> 	   
												    <option>Serial V.35</option>
												    <option>Giga (óptico)</option>
												    <option>Giga Ethernet (Electrico)</option>
												    <option>STM-1</option>
												    <option>RJ45 - 120 OHM</option>
												    <option>G703 BNC</option>
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
								        <label for="requiere_voc_mpls_pd" class="col-md-3 control-label">Requiere VOC:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="requiere_voc_mpls_pd" name="requiere_voc_mpls_pd">
												    <option>Seleccionar...</option>
												    <option>Si</option>
				  									<option>No</option>    
												</select>
								            </div>
								        </div>
								    </div>

								</fieldset>
								<fieldset class="col-md-6">
									<!-- PROGRAMACIÓN DE VOC : -->
								     <div class="form-group">
								        <label for="programacion_voc_mpls_pd" class="col-md-3 control-label">Programación de VOC:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="programacion_voc_mpls_pd" name="programacion_voc_mpls_pd">
												    <option>Seleccionar...</option>
												    <option>Programada</option>
				  									<option>No requiere programación</option>   												
				  									<option>No programada. Otra ciudad</option> 	    
				  									<option>No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
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
								        <label for="requiere_rfc_mpls_pd" class="col-md-3 control-label">Requiere RFC:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="requiere_rfc_mpls_pd" name="requiere_rfc_mpls_pd">
												    <option>Seleccionar...</option>
												    <option>SI => Cliente Critico Punto Central</option>
				  									<option>SI => Servicio Critico (Listado)</option>  												
				  									<option>SI => Cliente Critico</option> 	    
				  									<option>SI => RFC Estándar Saturación</option>
				  									<option>SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
				  									<option>No</option>
												</select>
								            </div>
								        </div>
								    </div>

									<!-- EQUIPOS   (VER LISTA COMPLETA): -->
									
									<!-- Conversor Medio: -->
						            <div class="form-group">
								        <label for="conversor_medio_mpls_pd" class="col-md-3 control-label">Conversor Medio:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="conversor_medio_mpls_pd" id="conversor_medio_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- Referencia Router: -->
						            <div class="form-group">
								        <label for="referencia_router_mpls_pd" class="col-md-3 control-label">Referencia Router:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="referencia_router_mpls_pd" id="referencia_router_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- Modulos o Tarjetas: -->
						            <div class="form-group">
								        <label for="modulo_o_tarjeta_mpls_pd" class="col-md-3 control-label">Modulos o Tarjetas:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="modulo_o_tarjeta_mpls_pd" id="modulo_o_tarjeta_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
							<div class="d-inline-b">
								<fieldset class="col-md-6">
									<!-- Licencias --> 
								    <div class="form-group">
								        <label for="licencias_mpls_pd" class="col-md-3 control-label">Licencias:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="licencias_mpls_pd" id="licencias_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- Equipos Adicionale--> 
								    <div class="form-group">
								        <label for="equipos_adicionales_mpls_pd" class="col-md-3 control-label">Equipos adicionale:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="equipos_adicionales_mpls_pd" id="equipos_adicionales_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- Consumibles:--> 
								    <div class="form-group">
								        <label for="consumibles_mpls_pd" class="col-md-3 control-label">Consumibles:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="consumibles_mpls_pd" name="consumibles_mpls_pd">
												    <option>Seleccionar...</option>
												    <option>Bandeja</option>
				  									<option>Cables de Poder </option>
				  									<option>Clavijas de Conexión</option>
				  									<option>Accesorios para rackear (Orejas)</option>
				  									<option>No Aplica</option>
												</select>
								            </div>
								        </div>
								    </div>

								    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
								     <div class="form-group">
								        <label for="registro_importacion_carta_mpls_pd" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <select class="form-control" id="registro_importacion_carta_mpls_pd" name="registro_importacion_carta_mpls_pd">
												    <option>Seleccionar...</option>
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
								        <label for="nombre_cot_mpls_pd" class="col-md-3 control-label">Nombre:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="nombre_cot_mpls_pd" id="nombre_cot_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- TELEFONO --> 
								    <div class="form-group">
								        <label for="telefono_cot_mpls_pd" class="col-md-3 control-label">Telefono:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="telefono_cot_mpls_pd" id="telefono_cot_mpls_pd" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- CELULAR --> 
								    <div class="form-group">
								        <label for="celular_cot_mpls_pd" class="col-md-3 control-label">Celular:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="celular_cot_mpls_pd" id="celular_cot_mpls_pd" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>

								    <!-- EMAIL --> 
								    <div class="form-group">
								        <label for="email_cot_mpls_pd" class="col-md-3 control-label">Email:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="email_cot_mpls_pd" id="email_cot_mpls_pd" class="form-control" type="email" >
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
								        <label for="nombre_dct_mpls_pd" class="col-md-3 control-label">Nombre:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="nombre_dct_mpls_pd" id="nombre_dct_mpls_pd" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>

								    <!-- TELEFONO --> 
								    <div class="form-group">
								        <label for="telefono_dct_mpls_pd" class="col-md-3 control-label">Telefono:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="telefono_dct_mpls_pd" id="telefono_dct_mpls_pd" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>
								</fieldset>
								<fieldset class="col-md-6">
									<!-- CELULAR --> 
								    <div class="form-group">
								        <label for="celular_dct_mpls_pd" class="col-md-3 control-label">Celular:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="celular_dct_mpls_pd" id="celular_dct_mpls_pd" class="form-control" type="number" >
								            </div>
								        </div>
								    </div>

								    <!-- EMAIL --> 
								    <div class="form-group">
								        <label for="email_dct_mpls_pd" class="col-md-3 control-label">Correo electronico:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="email_dct_mpls_pd" id="email_dct_mpls_pd" class="form-control" type="email" >
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
							<div class="d-inline-b">
								<fieldset class="col-md-12">
									<!-- OBSERVACIONES: --> 
								    <div class="form-group">
								        <label for="observaciones_dct_mpls_" class="col-md-3 control-label">Observaciones:</label>
								        <div class="col-md-9 selectContainer">
								            <div class="input-group">
								                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
								                <input name="observaciones_dct_mpls_" id="observaciones_dct_mpls_" class="form-control" type="text" >
								            </div>
								        </div>
								    </div>
								</fieldset>
							</div>
						</div>
					</div>

				</div>
            `;
        },

        /*NOVEDADES*/
        formProduct_novedades: function(){
            return `
				<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario de producto <small>NOVEDADES</small></h2>
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					<legend class="f-s-15">DATOS BASICOS DE INSTALACIÓN</legend>
					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- CIUDAD -->
							<div class="form-group">
						        <label for="pr_ciudad" class="col-md-3 control-label">Ciudad:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ciudad" id="pr_ciudad" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- DIRECCIÓN UBICACIÓN ACTUAL DEL SERVICIO:-->
						    <div class="form-group">
						        <label for="pr_direccion_actual" class="col-md-3 control-label">Dirección ubicación actual del servicio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_direccion_actual" id="pr_direccion_actual" class="form-control" type="text" >
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
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_alias_lugar" id="pr_alias_lugar" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>


						    <!-- otp_asociadas -->
							<div class="form-group">
						        <label for="pr_otp_asociadas" class="col-md-3 control-label">OTP asociadas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_otp_asociadas" id="pr_otp_asociadas" class="form-control" type="text" >
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
										    <option>Seleccionar...</option>
										    <option>Cambio de BW < 100 MEGAS</option>
	      									<option>Cambio de BW > 100 MEGAS</option>
	      									<option>Cambio de Servicio Internet BA a Internet Empresarial</option>
	      									<option>Cambio de Servicio Internet BA a Internet Dedicado</option>
	      									<option>Cambio de Servicio Internet Empresarial a Internet Dedicado</option>
	      									<option>Cambio de Servicio Internet Dedicado a Empresarial</option>
	      									<option>Cambio de Servicio MPLS Avanzado a Internet Dedicado</option>
	      									<option>Cambio de Servicio MPLS Avanzado a Internet BA</option>
	      									<option>Cambio de Servicio MPLS Avanzado Intranet a Extranet</option>
	      									<option>Cambio de Servicio MPLS Avanzado Extranet a Intranet</option>
	      									<option>Cambio de Servicio MPLS Avanzado MPLS Avanzado a PL Ethernet</option>
	      									<option>Cambio de Servicio MPLS Avanzado PL Ethernet a MPLS Avanzado</option>
	      									<option>Cambio de Servicio de Private Line Service a PL Ethernet</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea Análoga a Linea SIP ((Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea Análoga a Linea SIP (Centralizada)</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea Análoga a Linea E1 - R2</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea Análoga a Linea E1 - PRI</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) a  Linea SIP (Centralizado)</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) a  Linea E1 R2</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) a  Linea E1 PRI</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco) a  Linea Análoga</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea E1-R2 a Linea SIP (Centralizada)</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea E1-PRI a Linea SIP (Centralizada)</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea E1-R2 a Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea E1-PRI a Linea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea E1-R2 a Linea Análoga</option>
	      									<option>Cambio de Servicio Telefonia Pública Linea E1-PRI a Linea Análoga</option>
	      									<option>Cambio de Servicio Telefonia Pública a PBX Distribuida</option>
	      									<option>Adición / Retiro  de números - Adición Canales</option>
	      									<option>Adición / Retiro  de números - Adición DID</option>
	      									<option>Adición / Retiro  de números - Retiro Canales</option>
	      									<option>Adición / Retiro  de números - Retiro DID</option>
	      									<option>Adición de  Extensiones (teléfonos)</option>
	      									<option>Retiro de  Extensiones (teléfonos)</option>
	      									<option>Cambio NDS</option>
	      									<option>Adición de equipos</option>
	      									<option>Retiro de equipos</option>
	      									<option>Cambio de equipos</option>
	      									<option>Cambio Tipo de Acceso, Servicio y Ampliación</option>
	      									<option>Novedad Solución Administrada - Videoconferencia Administrada</option>
	      									<option>Novedad Solución Administrada - Videoseguridad Administrada</option>
	      									<option>Novedad Solución Administrada - LAN Administrada</option>
	      									<option>Novedad Solución Administrada - Hotspot</option>
	      									<option>Novedad Solución Administrada - WI - FI</option>
	      									<option>Novedad Solución Administrada - Grabación de Voz</option>
	      									<option>Cambio Tipo de Acceso (Migración)</option>
	      									<option>($) Cambio Tipo de Acceso con Costo</option>
	      								</select>
						            </div>
						        </div>
						    </div>	

						    <!-- TIPO DE SERVICIO A MODIFICAR: -->
						     <div class="form-group">
						        <label for="pr_serv_modificar" class="col-md-3 control-label">Tipo de servicio a modificar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_serv_modificar" name="pr_serv_modificar">
										    <option>Seleccionar...</option>
										    <option>Internet Dedicado con diferenciación de tráfico (Internet / NAP)</option>
	      									<option>Internet Dedicado + Monitoreo CPE (Gestion Proactiva)</option>
	      									<option>Internet Dedicado Administrado + Monitoreo CPE (Gestion Proactiva)</option>
	      									<option>Internet Dedicado Empresarial</option>
	      									<option>Internet  Banda ancha FO</option>
	      									<option>MPLS Avanzado Intranet  + Monitoreo CPE (Gestión Proactiva)</option>
	      									<option>MPLS Avanzado Extranet  + Monitoreo CPE (Gestión Proactiva)</option>
	      									<option>MPLS Avanzado con Punta Backend</option>
	      									<option>MPLS Avanzado con Punta en Rack de Appliance (Componente Datacenter)</option>
	      									<option>MPLS Avanzado con Punta Claro Connect</option>
	      									<option>MPLS Transaccional</option>
	      									<option>Telefonia Pública - Líneas Análogas</option>
	      									<option>Telefonia Pública - Líneas E1 - R2</option>
	      									<option>Telefonia Pública - Líneas E1 - PRI</option>
	      									<option>Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
	      									<option>Telefonia Pública - Línea SIP (Centralizado)</option>
	      									<option>PBX Distribuida - Línea SIP  (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
	      									<option>PBX Distribuida - Línea SIP  (Centralizado)</option>
	      									<option>PBX Distribuida  Linea E1 -R2</option>
	      									<option>PBX Distribuida  Linea E1 -PRI</option>
	      									<option>Telefonia Corporativa</option>
	      									<option>Local - P2P</option>
	      									<option>Local - P2MP</option>
	      									<option>Nacional - P2P</option>
	      									<option>Nacional - P2MP</option>
	      									<option>VPRN</option>
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
						        <label for="pr_tipo_actividad" class="col-md-3 control-label">Tipo de actividad:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_actividad" name="pr_tipo_actividad">
										    <option>Seleccionar...</option>
										    <option>Instalar UM con PE</option>
	      									<option>Instalar UM con CT</option> 												
	      									<option>Instalar UM con HFC</option> 	    
	      									<option>Instalar UM con 3G</option>
	      									<option>Instalar UM en Datacenter Claro- Cableado</option>
	      									<option>Cambio de Nodo</option>
	      									<option>Cambio de Plataforma</option>
	      									<option>No requiere Cambio de UM</option>
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
						        <label for="pr_liberacion_umst_te" class="col-md-3 control-label">Requiere liberación de recursos ultima milla sede antigua(proveedor tercero):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_liberacion_umst_te" name="pr_liberacion_umst_te">
										    <option>Seleccionar...</option>
										    <option>SI - Generar Tarea de Desconexión Tercero al finalizar el Cambio Tipo de Acceso</option>
	      									<option>NO - Recursos de UM Propia en Sede Antigua</option> 
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
						        <label for="pr_requiere_instalacion" class="col-md-3 control-label">¿requiere instalacion de UM?:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_requiere_instalacion" name="pr_requiere_instalacion">
										    <option>Seleccionar...</option>
										    <option>Si</option>
	      									<option>No</option>   	    
										</select>
						            </div>
						        </div>
						    </div>
							
							<!-- PROVEEDOR: -->
						    <div class="form-group">
						        <label for="pr_proveedor_milla" class="col-md-3 control-label">Proveedor:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_proveedor_milla" name="pr_proveedor_milla">
										    <option>Seleccionar...</option>
										    <option>Claro</option>
	      									<option>Axesat</option>
	      									<option>Comcel</option> 	
	      									<option>Tigo</option>       											
	      									<option>Media Commerce</option> 		
	      									<option>Diveo</option>
	      									<option>Edatel</option> 	
	      									<option>UNE</option> 		
	      									<option>ETB</option> 	
	      									<option>IBM</option> 		
	      									<option>IFX</option> 		
	      									<option>Level 3 Colombia</option>
	      									<option>Mercanet</option> 	
	      									<option>Metrotel</option> 		
	      									<option>Promitel</option> 		
	      									<option>Skynet</option> 		
	      									<option>Telebucaramanga</option>
	      									<option>Telecom</option> 	
	      									<option>Terremark</option> 		
	      									<option>Sol Cable Vision</option> 		
	      									<option>Sistelec</option>
	      									<option>Opain</option> 	
	      									<option>Airplan - (Información y Tecnologia)</option> 		
	      									<option>TV Azteca</option> 						    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- MEDIO -->
						    <div class="form-group">
						        <label for="pr_medio_um" class="col-md-3 control-label">Medio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_medio_um" name="pr_medio_um">
										    <option>Seleccionar...</option>
										    <option>No Aplica</option>     
										    <option>Fibra</option>
										    <option>Cobre</option>
										    <option>Satelital</option> 
										    <option>Radio enlace</option>
										    <option>3G</option>
										    <option>UTP</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- RESPUESTA FACTIBILIDAD BW >100 MEGAS: -->
						    <div class="form-group">
						        <label for="pr_resp_factibilidad" class="col-md-3 control-label">Respuesta factibilidad BW > 100 Megas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_resp_factibilidad" id="pr_resp_factibilidad" class="form-control" type="text" >
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
						        <label for="pr_sds_destino" class="col-md-3 control-label">SDS DESTINO (Unifilar):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_sds_destino" id="pr_sds_destino" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- OLT (GPON): -->
						     <div class="form-group">
						        <label for="pr_olt_gpon" class="col-md-3 control-label">OLT(GPON):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_olt_gpon" id="pr_olt_gpon" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- INTERFACE DE ENTREGA AL CLIENTE:-->
						    <div class="form-group">
						        <label for="pr_interface_cliente" class="col-md-3 control-label">Interface de entrega al cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_interface_cliente" name="pr_interface_cliente">
										    <option>Seleccionar...</option>
										    <option>No aplica</option>     
										    <option>Ethernet</option>
										    <option>Serial V.35</option>
										    <option>Giga (óptico)</option> 
										    <option>Giga Ethernet (Electrico)</option>
										    <option>STM-1</option>
										    <option>RJ45 - 120 OHM</option>
										    <option>G703 BNC</option>
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
										    <option>Seleccionar...</option>
										    <option>Si</option>
	      									<option>No</option> 	    
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
										    <option>Seleccionar...</option>
										    <option>Programada</option>
	      									<option>No requiere programación</option>   												
	      									<option>No programada. Otra ciudad</option> 	    
	      									<option>No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
										</select>
						            </div>
						        </div>
						    </div>

						</fieldset>
						<fieldset class="col-md-6">
						    <!-- REQUIERE LIBERACIÓN DE RECURSOS DE ULTIMA MILLA (FO) EN SEDE ANTIGUA -->
						     <div class="form-group">
						        <label for="pr_liberacion_rumfo" class="col-md-3 control-label">Requiere liberación de recursos de ultima milla (FO) sede antigua:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_liberacion_rumfo" name="pr_liberacion_rumfo">
										    <option>Seleccionar...</option>
										    <option>SI - Generar Tarea para Retirar recursos de Ultima Milla en Sede Antigua</option>
	      									<option>NO - Cliente no requiere liberación de Consumibles FO</option>   	
	      									<option>NA</option>
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
						        <label for="pr_ventana_mtto" class="col-md-3 control-label">Requiere ventana de MTTO:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_ventana_mtto" name="pr_ventana_mtto">
										    <option>Seleccionar...</option>
										    <option>Si</option>
	      									<option>No</option> 
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
										    <option>Seleccionar...</option>
										    <option>SI => Cliente Critico Punto Central</option>
	      									<option>SI => Servicio Critico (Listado)</option> 
	      									<option>SI => Cliente Critico</option>
	      									<option>SI => RFC Estándar Saturación</option>
	      									<option>SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
	      									<option>No</option>
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
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
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
						        <label for="pr_modulo_tarjeta" class="col-md-3 control-label">Modulos o Tarjetas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_modulo_tarjeta" id="pr_modulo_tarjeta" class="form-control" type="text" >
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
										    <option>Seleccionar...</option>
										    <option>Bandeja</option>
	      									<option>Cables de Poder </option>
	      									<option>Clavijas de Conexión</option>
	      									<option>Accesorios para rackear (Orejas)</option>
	      									<option>No Aplica</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- REGISTRO DE IMPORTACIÓN Y CARTA VALORIZADA: -->
						     <div class="form-group">
						        <label for="pr_registro_importacion" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_registro_importacion" name="pr_registro_importacion">
										    <option>Seleccionar...</option>
										    <option>Si</option>
	      									<option>No</option>
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
						        <label for="pr_nombre1" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre1" id="pr_nombre1" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="pr_telefono1" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono1" id="pr_telefono1" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							 <!-- CELULAR --> 
						    <div class="form-group">
						        <label for="pr_celular1" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular1" id="pr_celular1" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="pr_email1" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_email1" id="pr_email1" class="form-control" type="email" >
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
						        <label for="pr_nombre2" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre2" id="pr_nombre2" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO --> 
						    <div class="form-group">
						        <label for="pr_telefono2" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono2" id="pr_telefono2" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- CELULAR --> 
						    <div class="form-group">
						        <label for="pr_celular2" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular2" id="pr_celular2" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- EMAIL --> 
						    <div class="form-group">
						        <label for="pr_email2" class="col-md-3 control-label">Correo electronico:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_email2" id="pr_email2" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
					<div class="d-inline-b">
						<fieldset class="col-md-12">
							<!-- OBSERVACIONES: --> 
						    <div class="form-group">
						        <label for="observaciones_pl_te" class="col-md-3 control-label">Observaciones:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="observaciones_pl_te" id="observaciones_pl_te" class="form-control" type="text" >
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
										    <option>Seleccionar...</option>
										    <option>Teléfonos analogos</option>
	      									<option>Planta E1</option>
										</select>
						            </div>
						        </div>
						    </div>
						    
						    <!-- Interfaz Equipos Cliente: -->
						    <div class="form-group">
						        <label for="pr_interfaz_ec" class="col-md-3 control-label">Interfaz Equipos Cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_interfaz_ec" name="pr_interfaz_ec">
										    <option>Seleccionar...</option>
	      									<option>FXS</option>
										    <option>RJ11</option>
	      									<option>RJ45</option>
	      									<option>RJ48</option>
	      									<option>BNC</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- Cantidad Lineas Básicas a Adicionar (Solo Telefonia Pública Líneas Análogas): --> 
						    <div class="form-group">
						        <label for="pr_cant_lba" class="col-md-3 control-label"><a title="(Solo Telefonia Pública Líneas Análogas)">Cantidad Lineas Básicas a Adicionar:</a></label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_lba" id="pr_cant_lba" class="form-control" type="text" >
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
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
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
						                <input name="pr_cant_did" id="pr_cant_did" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad Canales a Adicionar: --> 
						    <div class="form-group">
						        <label for="pr_cant_canales" class="col-md-3 control-label">Cantidad Canales a Adicionar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales" id="pr_cant_canales" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							<!-- Adición de Lineas de FAX TO MAIL: -->
						    <div class="form-group">
						        <label for="pr_adicion_fax" class="col-md-3 control-label">Adición de Lineas de FAX TO MAIL:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_adicion_fax" name="pr_adicion_fax">
										    <option>Seleccionar...</option>
	      									<option>Si</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Adición de Lineas TELEFONO VIRTUAL: -->
						    <div class="form-group">
						        <label for="pr_adicion_tele" class="col-md-3 control-label">Adición de Lineas TELEFONO VIRTUAL:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_adicion_tele" name="pr_adicion_tele">
										    <option>Seleccionar...</option>
	      									<option>Si</option>
										    <option>No</option>
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
						        <label for="pr_rldnacional" class="col-md-3 control-label">Requiere Permisos para Larga Distancia Nacional:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_rldnacional" name="pr_rldnacional">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										    <option>No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
										</select>
						            </div>
						        </div>
						    </div>


						    <!-- Requiero Larga  Para Distancia  Internacional: -->
						    <div class="form-group">
						        <label for="pr_rldinternacional" class="col-md-3 control-label">Requiero Larga  Para Distancia  Internacional:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_rldinternacional" name="pr_rldinternacional">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										    <option>No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>
						<fieldset class="col-md-6">
							 <!-- Requiere Permisos para Local Extendida: -->
						    <div class="form-group">
						        <label for="pr_rplextendida" class="col-md-3 control-label">Requiere Permisos para Local Extendida:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_rplextendida" name="pr_rplextendida">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										    <option>No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
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
						        <label for="pr_requiere_1" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_1" name="pr_requiere_1">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_numeracion_1" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_numeracion_1" name="pr_numeracion_1">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cant_canales_1" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales_1" id="pr_cant_canales_1" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Tunja</legend>
								<div class="form-group">
						        <label for="pr_requiere_2" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_2" name="pr_requiere_2">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_numeracion_2" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_numeracion_2" name="pr_numeracion_2">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cant_canales_2" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales_2" id="pr_cant_canales_2" class="form-control" type="text" >
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
							        <label for="pr_requiere_3" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_3" name="pr_requiere_3">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_3" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_3" name="pr_numeracion_3">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_3" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_3" id="pr_cant_canales_3" class="form-control" type="text" >
							            </div>
							        </div>
							    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Facatativa</legend>
								<div class="form-group">
						        <label for="pr_requiere_4" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_4" name="pr_requiere_4">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_4" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_4" name="pr_numeracion_4">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_4" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_4" id="pr_cant_canales_4" class="form-control" type="text" >
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
						        <label for="pr_requiere_5" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_5" name="pr_requiere_5">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_numeracion_5" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_numeracion_5" name="pr_numeracion_5">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cant_canales_5" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales_5" id="pr_cant_canales_5" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Yopal</legend>
								<div class="form-group">
						        <label for="pr_requiere_6" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_6" name="pr_requiere_6">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_numeracion_6" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_numeracion_6" name="pr_numeracion_6">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cant_canales_6" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales_6" id="pr_cant_canales_6" class="form-control" type="text" >
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
						        <label for="pr_requiere_7" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_7" name="pr_requiere_7">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_numeracion_7" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_numeracion_7" name="pr_numeracion_7">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cant_canales_7" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales_7" id="pr_cant_canales_7" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Buenaventura</legend>
								 <div class="form-group">
						        <label for="pr_requiere_8" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_8" name="pr_requiere_8">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_numeracion_8" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_numeracion_8" name="pr_numeracion_8">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cant_canales_8" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales_8" id="pr_cant_canales_8" class="form-control" type="text" >
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
						        <label for="pr_requiere_9" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_9" name="pr_requiere_9">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_numeracion_9" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_numeracion_9" name="pr_numeracion_9">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cant_canales_9" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales_9" id="pr_cant_canales_9" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Popayán</legend>
								<div class="form-group">
						        <label for="pr_requiere_10" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_10" name="pr_requiere_10">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_numeracion_10" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_numeracion_10" name="pr_numeracion_10">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cant_canales_10" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales_10" id="pr_cant_canales_10" class="form-control" type="text" >
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
						        <label for="pr_requiere_11" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_11" name="pr_requiere_11">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_numeracion_11" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_numeracion_11" name="pr_numeracion_11">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cant_canales_11" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales_11" id="pr_cant_canales_11" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Medellín</legend>
								<div class="form-group">
						        <label for="pr_requiere_12" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_12" name="pr_requiere_12">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_numeracion_12" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_numeracion_12" name="pr_numeracion_12">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cant_canales_12" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales_12" id="pr_cant_canales_12" class="form-control" type="text" >
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
						        <label for="pr_requiere_13" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_13" name="pr_requiere_13">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_numeracion_13" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_numeracion_13" name="pr_numeracion_13">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cant_canales_13" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales_13" id="pr_cant_canales_13" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							</div>
						</fieldset>
						<fieldset class="col-md-6">
							<div class="widget bg_white m-t-25 d-inline-b cliente">
								<legend class="f-s-15">Cartagena</legend>
								<div class="form-group">
						        <label for="pr_requiere_14" class="col-md-3 control-label">Requiere:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_14" name="pr_requiere_14">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- NUMERACIÓN ASIGNADA EN TAB -->
						    <div class="form-group">
						        <label for="pr_numeracion_14" class="col-md-3 control-label">Numeración asignada en TAB :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_numeracion_14" name="pr_numeracion_14">
										    <option>Seleccionar...</option>
	      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
										    <option>No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Cantidad DID -->
						    <div class="form-group">
						        <label for="pr_cant_canales_14" class="col-md-3 control-label">Cantidad DID:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cant_canales_14" id="pr_cant_canales_14" class="form-control" type="text" >
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
							        <label for="pr_requiere_15" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_15" name="pr_requiere_15">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_15" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_15" name="pr_numeracion_15">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_15" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_15" id="pr_cant_canales_15" class="form-control" type="text" >
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
							        <label for="pr_requiere_16" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_16" name="pr_requiere_16">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_16" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_16" name="pr_numeracion_16">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_16" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_16" id="pr_cant_canales_16" class="form-control" type="text" >
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
							        <label for="pr_requiere_17" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_17" name="pr_requiere_17">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_17" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_17" name="pr_numeracion_17">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_17" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_17" id="pr_cant_canales_17" class="form-control" type="text" >
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
							        <label for="pr_requiere_18" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_18" name="pr_requiere_18">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_18" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_18" name="pr_numeracion_18">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_18" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_18" id="pr_cant_canales_18" class="form-control" type="text" >
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
							        <label for="pr_requiere_19" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_19" name="pr_requiere_19">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_19" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_19" name="pr_numeracion_19">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_19" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_19" id="pr_cant_canales_19" class="form-control" type="text" >
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
							        <label for="pr_requiere_20" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_20" name="pr_requiere_20">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_20" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_20" name="pr_numeracion_20">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_20" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_20" id="pr_cant_canales_20" class="form-control" type="text" >
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
							        <label for="pr_requiere_21" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_21" name="pr_requiere_21">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_21" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_21" name="pr_numeracion_21">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_21" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_21" id="pr_cant_canales_21" class="form-control" type="text" >
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
							        <label for="pr_requiere_22" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_22" name="pr_requiere_22">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_22" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_22" name="pr_numeracion_22">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_22" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_22" id="pr_cant_canales_22" class="form-control" type="text" >
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
							        <label for="pr_requiere_23" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_23" name="pr_requiere_23">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_23" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_23" name="pr_numeracion_23">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_23" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_23" id="pr_cant_canales_23" class="form-control" type="text" >
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
							        <label for="pr_requiere_24" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_24" name="pr_requiere_24">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_24" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_24" name="pr_numeracion_24">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_24" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_24" id="pr_cant_canales_24" class="form-control" type="text" >
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
							        <label for="pr_requiere_25" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_25" name="pr_requiere_25">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_25" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_25" name="pr_numeracion_25">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_25" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_25" id="pr_cant_canales_25" class="form-control" type="text" >
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
							        <label for="pr_requiere_26" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_26" name="pr_requiere_26">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_26" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_26" name="pr_numeracion_26">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_26" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_26" id="pr_cant_canales_26" class="form-control" type="text" >
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
							        <label for="pr_requiere_27" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_27" name="pr_requiere_27">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_27" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_27" name="pr_numeracion_27">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_27" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_27" id="pr_cant_canales_27" class="form-control" type="text" >
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
							        <label for="pr_requiere_28" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_28" name="pr_requiere_28">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_28" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_28" name="pr_numeracion_28">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_28" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_28" id="pr_cant_canales_28" class="form-control" type="text" >
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
							        <label for="pr_requiere_29" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_29" name="pr_requiere_29">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_29" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_29" name="pr_numeracion_29">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_29" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_29" id="pr_cant_canales_29" class="form-control" type="text" >
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
							        <label for="pr_requiere_30" class="col-md-3 control-label">Requiere:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_requiere_30" name="pr_requiere_30">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- NUMERACIÓN ASIGNADA EN TAB -->
							    <div class="form-group">
							        <label for="pr_numeracion_30" class="col-md-3 control-label">Numeración asignada en TAB :</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
							                <select class="form-control" id="pr_numeracion_30" name="pr_numeracion_30">
											    <option>Seleccionar...</option>
		      									<option>SI (Debe esta firmado por el Cliente en el Survey o AOS)</option>
											    <option>No</option>
											</select>
							            </div>
							        </div>
							    </div>

							    <!-- Cantidad DID -->
							    <div class="form-group">
							        <label for="pr_cant_canales_30" class="col-md-3 control-label">Cantidad DID:</label>
							        <div class="col-md-9 selectContainer">
							            <div class="input-group">
							                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
							                <input name="pr_cant_canales_30" id="pr_cant_canales_30" class="form-control" type="text" >
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
        formProduct_traslado_externo: function(otp){
            return `
				<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario de producto <small>TRASLADO EXTERNO</small></h2>
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
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ciudad" id="pr_ciudad" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- DIRECCIÓN UBICACIÓN ACTUAL DEL SERVICIO:-->
						    <div class="form-group">
						        <label for="pr_direccion_actual" class="col-md-3 control-label">Dirección actual del servicio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_direccion_actual" id="pr_direccion_actual" class="form-control" type="text" >
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
						                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
						                <select class="form-control" id="pr_tipo_predio" name="pr_tipo_predio">
										    <option>Seleccionar...</option>
										    <option>Edificio</option>
	      									<option>Casa</option>									    
										</select>
						            </div>
						        </div>
						    </div>

							<!-- DIRECCIÓN DONDE SE TRASLADARA EL SERVICIO:-->
						    <div class="form-group">
						        <label for="pr_direccion_traslado" class="col-md-3 control-label">Dirección donde se trasladará servicio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_direccion_traslado" id="pr_direccion_traslado" class="form-control" type="text" >
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
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_alias_lugar" id="pr_alias_lugar" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- OTP -->
							<div class="form-group">
						        <label for="pr_otp" class="col-md-3 control-label">OTP:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_otp" id="pr_otp" class="form-control" type="text" value="${otp}" disabled>
						            </div>
						        </div>
						    </div>

						    <!-- OTP_ASOCIADAS -->
							<div class="form-group">
						        <label for="pr_otp_asociadas" class="col-md-3 control-label">OTP asociadas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_otp_asociadas" id="pr_otp_asociadas" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- CANTIDAD DE SERVICIOS A TRASLADAR: -->
							<div class="form-group">
						        <label for="pr_cntd_servicios" class="col-md-3 control-label">Cantidad de servicios a trasladar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cntd_servicios" id="pr_cntd_servicios" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- CODIGOS DE SERVICIO  A TRASLADAR: -->
							<div class="form-group">
						        <label for="pr_idservicio_trasladar" class="col-md-3 control-label">Códigos de servicio a trasladar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_idservicio_trasladar" id="pr_idservicio_trasladar" class="form-control" type="text" >
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
										    <option>Seleccionar...</option>
										    <option>Estándar - Se recogen equipos en Sede Antigua y se llevan a sede Nueva</option>
												<option>Paralelo - Se habilitan Nuevos Recursos de UM, Equipos, Config</option>
											</select>
								    </div>
								</div>
							</div>	

							<!--TIPO DE SERVICIO: -->
							<div class="form-group">
								<label for=pr_"tipo_servicie" class="col-md-3 control-label">Tipo de servicio:</label>
								<div class="col-md-9 selectContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								        <select class="form-control" id=pr_"tipo_servicie" name="pr_tipo_servicio">
										    <option>Seleccionar...</option>
										    <option>Internet Dedicado con diferenciación de tráfico (Internet / NAP)</option>
												<option>Internet Dedicado + Monitoreo CPE (Gestion Proactiva)</option>
												<option>Internet Dedicado Administrado + Monitoreo CPE (Gestion Proactiva)</option>
												<option>Internet Dedicado Empresarial</option>
												<option>Internet  Banda ancha FO</option>
												<option>MPLS Avanzado Intranet  + Monitoreo CPE (Gestión Proactiva)</option>
												<option>MPLS Avanzado Extranet  + Monitoreo CPE (Gestión Proactiva)</option>
												<option>MPLS Avanzado con Punta Backend</option>
												<option>MPLS Avanzado con Punta en Rack de Appliance (Componente Datacenter)</option>
												<option>MPLS Avanzado con Punta Claro Connect</option>
												<option>MPLS Transaccional</option>
												<option>Telefonia Pública - Líneas Análogas</option>
												<option>Telefonia Pública - Líneas E1 - R2</option>
												<option>Telefonia Pública - Líneas E1 - PRI</option>
												<option>Telefonia Pública - Línea SIP (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
												<option>Telefonia Pública - Línea SIP (Centralizado)</option>
												<option>PBX Distribuida - Línea SIP  (Troncal IP Ethernet con Audiocodec o GW Cisco)</option>
												<option>PBX Distribuida - Línea SIP  (Centralizado)</option>
												<option>PBX Distribuida  Linea E1 -R2</option>
												<option>PBX Distribuida  Linea E1 -PRI</option>
												<option>Telefonia Corporativa</option>
												<option>Local - P2P</option>
												<option>Local - P2MP</option>
												<option>Nacional - P2P</option>
												<option>Nacional - P2MP</option>
												<option>VPRN</option>
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
										    <option>Seleccionar...</option>
										    <option>Instalar UM con PE</option>
	      									<option>Instalar UM con PE sobre OTP de Pymes</option> 												
	      									<option>Instalar UM con CT</option> 	    
	      									<option>Instalar UM con HFC</option>
	      									<option>Instalar UM con 3G</option>
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- ID SERVICIO ACTUAL (Aplica para UM Existente): -->
							<div class="form-group">
						        <label for="pr_id_servicio_actual" class="col-md-3 control-label">ID servicio actual (Aplica UM Existente):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_id_servicio_actual" id="pr_id_servicio_actual" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- REQUIERE LIBERACIÓN DE RECURSOS DE ULTIMA MILLA SEDE ANTIGUA(PROVEEDOR TERCERO) -->
						     <div class="form-group">
						        <label for="pr_liberacion_uml" class="col-md-3 control-label">Requiere liberación recursos ult.milla sede antigua(proveedor tercero):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_liberacion_uml" name="pr_liberacion_uml">
										    <option>Seleccionar...</option>
										    <option>SI - Generar Tarea de Desconexión Tercero al finalizar el Traslado</option>
	      									<option>NO - Recursos de UM Propia en Sede Antigua</option> 
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
						        <label for="pr_requiere_instalacion" class="col-md-3 control-label">¿Esta requiere instalacion de UM?:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_requiere_instalacion" name="pr_requiere_instalacion">
										    <option>Seleccionar...</option>
										    <option>Si</option>
	      									<option>No</option>   	    
										</select>
						            </div>
						        </div>
						    </div>
							
							<!-- PROVEEDOR: -->
						    <div class="form-group">
						        <label for="pr_proveedor_milla" class="col-md-3 control-label">Proveedor:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_proveedor_milla" name="pr_proveedor_milla">
										    <option>Seleccionar...</option>
										    <option>No aplica</option>
	      									<option>Existente</option>
	      									<option>Claro</option>
	      									<option>Axesat</option>
	      									<option>Comcel</option> 	
	      									<option>Tigo</option> 		
	      									<option>Media Commerce</option> 		
	      									<option>Diveo</option>
	      									<option>Edatel</option> 	
	      									<option>UNE</option> 		
	      									<option>ETB</option> 	
	      									<option>IBM</option> 		
	      									<option>IFX</option> 		
	      									<option>Level 3 Colombia</option>
	      									<option>Mercanet</option> 	
	      									<option>Metrotel</option> 		
	      									<option>Promitel</option> 		
	      									<option>Skynet</option> 		
	      									<option>Telebucaramanga</option>
	      									<option>Telecom</option> 	
	      									<option>Terremark</option> 		
	      									<option>Sol Cable Vision</option> 		
	      									<option>Sistelec</option>
	      									<option>Opain</option> 	
	      									<option>Airplan - (Información y Tecnologia)</option> 		
	      									<option>TV Azteca</option> 						    
										</select>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							
							<!-- RESPUESTA FACTIBILIDAD BW >100 MEGAS: -->
						    <div class="form-group">
						        <label for="pr_resp_factibilidad" class="col-md-3 control-label">Respuesta factibilidad BW > 100 Megas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_resp_factibilidad" id="pr_resp_factibilidad" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

							<!-- MEDIO -->
						    <div class="form-group">
						        <label for="pr_medio" class="col-md-3 control-label">Medio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_medio" name="pr_medio">
										    <option>Seleccionar...</option>
										    <option>No Aplica</option>     
										    <option>Fibra</option>
										    <option>Cobre</option>
										    <option>Satelital</option> 
										    <option>Radio enlace</option>
										    <option>3G</option>
										    <option>UTP</option>
										</select>
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
						        <label for="pr_sds_destino" class="col-md-3 control-label">SDS DESTINO (Unifilar):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_sds_destino" id="pr_sds_destino" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- OLT (GPON): -->
						    <div class="form-group">
						        <label for="pr_olt_gpon" class="col-md-3 control-label">OLT (GPON):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_olt_gpon" id="pr_olt_gpon" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- INTERFACE DE ENTREGA AL CLIENTE:-->
						    <div class="form-group">
						        <label for="pr_interface_ecliente" class="col-md-3 control-label">Interface de entrega al cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_interface_ecliente" name="pr_interface_ecliente">
										    <option>Seleccionar...</option>
										    <option>No Aplica</option>     
										    <option>Ethernet</option>
										    <option>Serial V.35</option>
										    <option>Giga (óptico)</option> 
										    <option>Giga Ethernet (Electrico)</option>
										    <option>STM-1</option>
										    <option>RJ45 - 120 OHM</option>
										    <option>G703 BNC</option>
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
										    <option>Seleccionar...</option>
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
										    <option>Seleccionar...</option>
										    <option>Programada</option>
											<option>No requiere programación</option>   												
											<option>No programada. Otra ciudad</option> 	    
											<option>No programada. Cliente solicita ser contactado en fecha posterior y/o con otro contacto</option>
										</select>
								    </div>
								</div>
							</div>							
						</fieldset>

						<fieldset class="col-md-6">
							<!-- REQUIERE LIBERACIÓN DE RECURSOS DE ULTIMA MILLA (FO) EN SEDE ANTIGUA -->
							<div class="form-group">
								<label for="pr_liberacion_recursos" class="col-md-3 control-label">Requiere liberación de recursos de ultima milla (FO) sede antigua:</label>
								<div class="col-md-9 selectContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								        <select class="form-control" id="pr_liberacion_recursos" name="pr_liberacion_recursos">
										    <option>Seleccionar...</option>
										    <option>SI - Generar Tarea para Retirar recursos de Ultima Milla en Sede Antigua</option>
												<option>NO - Cliente no requiere liberación de Consumibles FO</option>   	
												<option>NA</option>
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
								<label for="pr_ventana_mtto" class="col-md-3 control-label">Requiere ventana de MTTO:</label>
								<div class="col-md-9 selectContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								        <select class="form-control" id="pr_ventana_mtto" name="pr_ventana_mtto">
										    <option>Seleccionar...</option>
										    <option>Si</option>
											<option>No</option> 
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
										    <option>Seleccionar...</option>
										    <option>SI => Cliente Critico Punto Central</option>
												<option>SI => Servicio Critico (Listado)</option> 
												<option>SI => Cliente Critico</option>
												<option>SI => RFC Estándar Saturación</option>
												<option>SI => Cliente Critico Punto Central - RFC Estándar Saturación</option>
												<option>No</option>
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
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
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
						        <label for="pr_modulo_o_tarjeta" class="col-md-3 control-label">Modulos o Tarjetas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_modulo_o_tarjeta" id="pr_modulo_o_tarjeta" class="form-control" type="text" >
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
										    <option>Seleccionar...</option>
										    <option>Bandeja</option>
	      									<option>Cables de Poder </option>
	      									<option>Clavijas de Conexión</option>
	      									<option>Accesorios para rackear (Orejas)</option>
	      									<option>No Aplica</option>
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
								<label for="pr_registro_importacion" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
								<div class="col-md-9 selectContainer">
								    <div class="input-group">
								        <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
								        <select class="form-control" id="pr_registro_importacion" name="pr_registro_importacion">
										    <option>Seleccionar...</option>
										    <option>Si</option>
												<option>No</option>
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
						        <label for="pr_email_1" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_email_1" id="pr_email_1" class="form-control" type="email" >
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
						        <label for="pr_email_2" class="col-md-3 control-label">Correo electronico:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_email_2" id="pr_email_2" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-12">
							<!-- OBSERVACIONES: --> 
						    <div class="form-group">
						        <label for="observaciones_pl_te" class="col-md-3 control-label">Observaciones:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="observaciones_pl_te" id="observaciones_pl_te" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>
				</div>
            `;
        },

        /*TRASLADO INTERNO*/
        formProduct_traslado_interno: function(){
        	return `
        		<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario de producto <small>TRASLADO INTERNO</small></h2>
				<div class="widget bg_white m-t-25 d-inline-b cliente">
					
					<legend class="f-s-15">DATOS BASICOS</legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- CIUDAD -->
							<div class="form-group">
						        <label for="pr_ciudad" class="col-md-3 control-label">Ciudad:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ciudad" id="pr_ciudad" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- DIRECCIÓN UBICACIÓN ACTUAL DEL SERVICIO :-->
						    <div class="form-group">
						        <label for="pr_direccion" class="col-md-3 control-label">Dirección actual del servicio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_direccion" id="pr_direccion" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- ALIAS DEL LUGAR : -->
						    <div class="form-group">
						        <label for="pr_alias" class="col-md-3 control-label">Alias del lugar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
						                <input type="text" name="pr_alias" id="pr_alias" class="form-control">
						            </div>
						        </div>
						    </div>	

						    <!-- MOVIMIENTO INTERNO REQUERIDO : -->
						    <div class="form-group">
						        <label for="pr_movimiento_it" class="col-md-3 control-label">Movimiento interno requerido:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
										<select name="pr_movimiento_it" id="pr_movimiento_it" class="form-control">
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
						        <label for="pr_otp_as" class="col-md-3 control-label">OTP asociadas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_otp_as" id="pr_otp_as" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- CANTIDAD DE SERVICIOS A TRASLADAR : -->
							<div class="form-group">
						        <label for="pr_cantidad_st" class="col-md-3 control-label">Cantidad servicios a trasladar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cantidad_st" id="pr_cantidad_st" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- CODIGOS DE SERVICIO  A TRASLADAR : -->
							<div class="form-group">
						        <label for="pr_codigo_st" class="col-md-3 control-label">Códigos servicio  a trasladar:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_codigo_st" id="pr_codigo_st" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>


						    <!-- TIPO DE TRASLADO INTERNO : -->
						    <div class="form-group">
						        <label for="pr_tipo_ti" class="col-md-3 control-label">Tipo traslado interno:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_ti" name="pr_tipo_ti">
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
						        <label for="pr_tipo_s" class="col-md-3 control-label">Tipo servicio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_s" name="pr_tipo_s">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ancho_banda" id="pr_ancho_banda" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- TIPO DE ACTIVIDAD : -->
						    <div class="form-group">
						        <label for="tipo_acti_ti" class="col-md-3 control-label">Tipo de actividad :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="tipo_acti_ti" name="tipo_acti_ti">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_id_servicio" class="col-md-3 control-label">Id servicio actual (Aplica para UM Existente):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_id_servicio" id="pr_id_servicio" class="form-control" type="text" >
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
											<option value="Seleccionar...">Seleccionar...</option>
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
											<option value="Seleccionar...">Seleccionar...</option>
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

							<!-- RESPUESTA FACTIBILIDAD BW > 100 MEGAS : -->
				            <div class="form-group">
						        <label for="pr_respuesta" class="col-md-3 control-label">Respuesta factibilidad BW > 100 Megas :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_respuesta" id="pr_respuesta" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

							<!-- MEDIO -->
						    <div class="form-group">
						        <label for="pr_medio" class="col-md-3 control-label">Medio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_medio" name="pr_medio">
										    <option="Seleccionar...">Seleccionar...</option>
										    <option="No Aplica">No Aplica</option>
										    <option="FIBRA">FIBRA</option>
										    <option="COBRE">COBRE</option> 
										    <option="SATELITAL">SATELITAL</option>
										    <option="RADIO ENLACE">RADIO ENLACE</option>
										    <option="3G">3G</option>
										    <option="UTP">UTP</option>
										</select>
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
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_olt" id="pr_olt" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- INTERFACE DE ENTREGA AL CLIENTE: -->
						    <div class="form-group">
						        <label for="pr_interface" class="col-md-3 control-label">Interface de entrega al cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_interface" name="pr_interface">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_requiere" class="col-md-3 control-label">REQUIERE VOC:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
										<select type="text" name="pr_requiere" id="pr_requiere" class="form-control">
											<option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_requiere" class="col-md-3 control-label">Programación VOC:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-altt" ></i></span>
										<select type="text" name="pr_requiere" id="pr_requiere" class="form-control">
											<option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_requiere" class="col-md-3 control-label">Requiere ventana MTTO:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
										<select type="text" name="pr_requiere" id="pr_requiere" class="form-control">
											<option value="Seleccionar...">Seleccionar...</option>
											<option value="si">si</option>
											<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- REQUIERE RFC : -->
						    <div class="form-group">
						        <label for="pr_requiere" class="col-md-3 control-label">Requiere RFC:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
										<select type="text" name="pr_requiere" id="pr_requiere" class="form-control">
											<option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_convesor_m" class="col-md-3 control-label">Convesor medio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_convesor_m" id="pr_convesor_m" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Referencia Router  -->
				            <div class="form-group">
						        <label for="pr_referencia_r" class="col-md-3 control-label">Referencia Router :</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_referencia_r" id="pr_referencia_r" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- MODULOS O TARJETAS  -->
				            <div class="form-group">
						        <label for="pr_modululos_t" class="col-md-3 control-label">Modulos o Tarjetas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_modululos_t" id="pr_modululos_t" class="form-control" type="text" >
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
						        <label for="pr_equipos_a" class="col-md-3 control-label">Equipos adicionales:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_equipos_a" id="pr_equipos_a" class="form-control" type="text" >
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
											<option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_registro_ic" class="col-md-3 control-label">Registro de importacion y carta valorizada:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select name="pr_registro_ic" id="pr_registro_ic" class="form-control">
						                	<option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_nombre1" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre1" id="pr_nombre1" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO:--> 
						    <div class="form-group">
						        <label for="pr_telefono1" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono1" id="pr_telefono1" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- CELULAR :  --> 
						    <div class="form-group">
						        <label for="pr_celular1" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular1" id="pr_celular1" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
							<!-- CORREO ELECTRONICO:  -->
				            <div class="form-group">
						        <label for="pr_correo1" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input type="text" name="pr_correo1" id="pr_correo1" class="form-control">
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
						        <label for="pr_nombre1" class="col-md-3 control-label">Nombre:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
						                <input name="pr_nombre2" id="pr_nombre2" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO:--> 
						    <div class="form-group">
						        <label for="pr_telefono2" class="col-md-3 control-label">Telefono:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_telefono2" id="pr_telefono2" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">
							<!-- CELULAR :  --> 
						    <div class="form-group">
						        <label for="pr_celular2" class="col-md-3 control-label">Celular:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_celular2" id="pr_celular2" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							
							<!-- CORREO ELECTRONICO:  -->
				            <div class="form-group">
						        <label for="pr_correo2" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input type="text" name="pr_correo2" id="pr_correo2" class="form-control">
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>					
				</div>
        	`;
        },

        /*PBX ADMINISTRADA*/
        formProduct_pvx_administrada: function(otp){
        	return `
        		<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario de producto <small>SERVICIO PBX ADMINISTRADA</small></h2>
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
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_otp" class="col-md-3 control-label">OTP:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_otp" id="pr_otp" class="form-control" type="text" value="${otp}" disabled>
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- otp_asociadas -->
							<div class="form-group">
						        <label for="pr_otp_asociadas" class="col-md-3 control-label">OTP asociadas:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_otp_asociadas" id="pr_otp_asociadas" class="form-control" type="text" >
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
										    <option value="Seleccionar...">Seleccionar...</option>
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
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_id_servicio" class="col-md-3 control-label">ID servicio actual (Aplica para UM Existente):</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_id_servicio" id="pr_id_servicio" class="form-control" type="text" >
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
						        <label for="pr_requiere_instalacion" class="col-md-3 control-label">¿Requiere instalacion UM?</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_instalacion" name="pr_requiere_instalacion">
										    <option value="Seleccionar...">Seleccionar...</option>
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
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_medio_spa" class="col-md-3 control-label">Medio:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_medio_spa" name="pr_medio_spa">
										    <option value="Seleccionar...">Seleccionar...</option>
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
										    <option value="Seleccionar...">Seleccionar...</option>
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
										    <option value="Seleccionar...">Seleccionar...</option>
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
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_modulo_tarjeta" class="col-md-3 control-label">Modulos o Tarjetas:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_modulo_tarjeta" id="pr_modulo_tarjeta" class="form-control" type="text" >
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

					<div class="d-inline-b">
						<fieldset class="col-md-6">
							<!-- Cantidad:--> 
						    <div class="form-group">
						        <label for="pr_cantidad" class="col-md-3 control-label">Cantidad:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-sort-by-order-alt" ></i></span>
						                <input name="pr_cantidad" id="pr_cantidad" class="form-control" type="number" >
						            </div>
						        </div>
						    </div>

						    <!-- Fuentes de Teléfonos:--> 
						    <div class="form-group">
						        <label for="pr_fuente_telefono" class="col-md-3 control-label">Fuentes de Teléfonos:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <input name="pr_fuente_telefono" id="pr_fuente_telefono" class="form-control" type="text" >
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
						        <label for="pr_aranas_conferencias" class="col-md-3 control-label">Arañas de Conferencia:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-volume-up" ></i></span>
						                <input name="pr_aranas_conferencias" id="pr_aranas_conferencias" class="form-control" type="text" >
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
						        <label for="pr_expansion_botonera" class="col-md-3 control-label">Modulo Expansión Botonera:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-record" ></i></span>
						                <input name="pr_expansion_botonera" id="pr_expansion_botonera" class="form-control" type="text" >
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
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_registro_importacion" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list" ></i></span>
						                <select class="form-control" id="pr_registro_importacion" name="pr_registro_importacion">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_email_1" class="col-md-3 control-label">Email:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_email_1" id="pr_email_1" class="form-control" type="email" >
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
						        <label for="pr_email_2" class="col-md-3 control-label">Email:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_email_2" id="pr_email_2" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						

							<!-- OBSERVACIONES: --> 
							<div class="form-group">
						        <label for="pr_observaciones_1" class="col-md-2 control-label">Observaciones:</label>
						        <div class="col-md-10 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_observaciones_1" id="pr_observaciones_1" class="form-control" type="text" >
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
						        <label for="pr_telefonia_fija" class="col-md-3 control-label">Telefonia fija claro:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <select class="form-control" id="pr_telefonia_fija" name="pr_telefonia_fija">
										    <option>Seleccionar...</option>
										    <option>Existente</option>
	      									<option>A implementar</option>    
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- CANTIDAD DE EXTENSIONES: --> 
						    <div class="form-group">
						        <label for="pr_cant_extension" class="col-md-3 control-label">Cantidad de extensiones:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" ></i></span>
						                <input name="pr_cant_extension" id="pr_cant_extension" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- CANTIDAD DE BUZONES VOZ --> 
						    <div class="form-group">
						        <label for="pr_cant_buzonv" class="col-md-3 control-label">Cantidad de buzones de voz:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_cant_buzonv" name="pr_cant_buzonv">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_incluye_gravacion" class="col-md-3 control-label">Incluye grabación de voz:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_incluye_gravacion" name="pr_incluye_gravacion">
						                	<option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_lan_admon" class="col-md-3 control-label">Incluye LAN administrada:</label>
						        <div class="ol-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_lan_admon" name="pr_lan_admon">
						                	<option>Seleccionar...</option>
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
        formProduct_telefonia_fija: function(otp){
        	return `
        		<h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Formulario de producto <small>SERVICIO TELEFONIA FIJA</small></h2>
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
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ciudad" id="pr_ciudad" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- DIRECCIÓN -->
						    <div class="form-group">
						        <label for="pr_direccion" class="col-md-3 control-label">Dirección:</label>
						        <div class="col-md-9 selectContainer">
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
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="fa fa-home" ></i></span>
						                <select class="form-control" id="pr_tipo_predio" name="pr_tipo_predio">
										    <option>Seleccionar...</option>
										    <option>Edificio</option>
	      									<option>Casa</option>
										    
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
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
						                <input name="pr_alias_lugar" id="pr_alias_lugar" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- OTP -->
							<div class="form-group">
						        <label for="pr_otp" class="col-md-3 control-label">OTP:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
						                <input name="pr_otp" id="pr_otp" class="form-control" type="text" disables value="${otp}">
						            </div>
						        </div>
						    </div>
						</fieldset>

						<fieldset class="col-md-6">

							<!-- otp_asociadas -->
							<div class="form-group">
						        <label for="pr_otp_asociadas" class="col-md-3 control-label">OTP asociadas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_otp_asociadas" id="pr_otp_asociadas" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- TIPO DE TELEFONIA FIJA: -->
						    <div class="form-group">
						        <label for="pr_tipo_telefoniaf" class="col-md-3 control-label">Tipo telefonia fija:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_tipo_telefoniaf" name="pr_tipo_telefoniaf">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_ancho_banda" id="pr_ancho_banda" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>		

						    <!-- TIPO INSTALACION: -->
						     <div class="form-group">
						        <label for="pr_tipo_instalacion" class="col-md-3 control-label">Tipo instalación:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_tipo_instalacion" name="pr_tipo_instalacion">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_idservicio_actual" class="col-md-3 control-label">ID servicio Actual(Aplica para UM Existente):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_idservicio_actual" id="pr_idservicio_actual" class="form-control" type="text" >
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
						        <label for="pr_requiere_instalacion" class="col-md-3 control-label">¿Requiere instalación UM?</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_requiere_instalacion" name="pr_requiere_instalacion">
										    <option value="Seleccionar...">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>   												
	      									<option value="Existente">Existente</option> 	    
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- PROVEEDOR: -->
						    <div class="form-group">
						        <label for="pr_proveedor_milla" class="col-md-3 control-label">Proveedor:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_proveedor_milla" name="pr_proveedor_milla">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_medio_um" class="col-md-3 control-label">Medio:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_medio_um" name="pr_medio_um">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_tipo_conector" class="col-md-3 control-label">Tipo conector (Aplica para FO Claro):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_tipo_conector" name="pr_tipo_conector">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_interface_entregac" class="col-md-3 control-label">Interface de entrega al cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" ></i></span>
						                <select class="form-control" id="pr_interface_entregac" name="pr_interface_entregac">
										    <option value="Seleccionar...">Seleccionar...</option>
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
										    <option value="Seleccionar...">Seleccionar...</option>
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
										    <option value="Seleccionar...">Seleccionar...</option>
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
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_requiere_rfc" name="pr_requiere_rfc">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_referencia_router" id="pr_referencia_router" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Modulos o Tarjetas: -->
				            <div class="form-group">
						        <label for="pr_modulo_tarjeta" class="col-md-3 control-label">Modulos o Tarjetas:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_modulo_tarjeta" id="pr_modulo_tarjeta" class="form-control" type="text" >
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
						        <label for="pr_Consumibles" class="col-md-3 control-label">Consumibles:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_Consumibles" name="pr_Consumibles">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_registro_importacion" class="col-md-3 control-label">Registro importación y carta valorizada:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_registro_importacion" name="pr_registro_importacion">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-altt" ></i></span>
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
						        <label for="pr_email_1" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_email_1" id="pr_email_1" class="form-control" type="email" >
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
						        <label for="pr_email_2" class="col-md-3 control-label">Email:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
						                <input name="pr_email_2" id="pr_email_2" class="form-control" type="email" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- OBSERVACIONES:  --> 
						    <div class="form-group">
						        <label for="pr_observaciones" class="col-md-3 control-label">Observaciones:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_observaciones" id="pr_observaciones" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<!-- Sexta sesion: KIKOFF TECNICO  -->
					<legend class="f-s-15">KIKOFF TECNICO </legend>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- Activación de PLAN LD CON COSTO (0 $): -->
						    <div class="form-group">
						        <label for="pr_activacion_plan" class="col-md-3 control-label">Activación de PLAN LD CON COSTO (0 $):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_activacion_plan" name="pr_activacion_plan">
										    <option value="Seleccionar...">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

							<!-- Equipo Cliente: -->
						     <div class="form-group">
						        <label for="pr_equipo_cliente" class="col-md-3 control-label">Equipo Cliente ::</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_equipo_cliente" name="pr_equipo_cliente">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_interfaz_equipoc" class="col-md-3 control-label">Interfaz Equipos Cliente:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_interfaz_equipoc" name="pr_interfaz_equipoc">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_cantidad_lineas" class="col-md-3 control-label">Cantidad Lineas Básicas (Solo Telefonia Pública Líneas Análogas):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cantidad_lineas" id="pr_cantidad_lineas" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
						</fieldset>
					</div>

					<div class="d-inline-b">
						<fieldset class="col-md-6">

							<!-- Conformación PBX (Solo Telefonia Pública Líneas Análogas)  --> 
						    <div class="form-group">
						        <label for="pr_conformacion_pbx" class="col-md-3 control-label">Conformación PBX (Solo Telefonia Pública Líneas Análogas):</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_conformacion_pbx" id="pr_conformacion_pbx" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>


						    <!-- Cantidad de DID Solicitados  --> 
						    <div class="form-group">
						        <label for="pr_cantidad_did" class="col-md-3 control-label">Cantidad de DID Solicitados:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cantidad_did" id="pr_cantidad_did" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>
							</fieldset>

						<fieldset class="col-md-6">

							<!-- Cantidad Canales: -->
						    <div class="form-group">
						        <label for="pr_cantidad_canales" class="col-md-3 control-label">Cantidad Canales:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <input name="pr_cantidad_canales" id="pr_cantidad_canales" class="form-control" type="text" >
						            </div>
						        </div>
						    </div>

						    <!-- Numero Cabecera PBX: -->
						    <div class="form-group">
						        <label for="pr_numero_cabecera" class="col-md-3 control-label">Numero Cabecera PBX:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_numero_cabecera" name="pr_numero_cabecera">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_fax_mail" class="col-md-3 control-label">Fax to mail:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-print" ></i></span>
						                <select class="form-control" id="pr_fax_mail" name="pr_fax_mail">
										    <option value="Seleccionar...">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- TELEFONO VIRTUAL: -->
						    <div class="form-group">
						        <label for="pr_telefono_virtual" class="col-md-3 control-label">Telefono virtual:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <select class="form-control" id="pr_telefono_virtual" name="pr_telefono_virtual">
										    <option value="Seleccionar...">Seleccionar...</option>
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
						        <label for="pr_permisos_largad" class="col-md-3 control-label">Requiere Permisos para Larga Distancia Nacional:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_permisos_largad" name="pr_permisos_largad">
										    <option value="Seleccionar...">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
	      									<option value="No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff">No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Requiero Larga  Para Distancia  Internacional: -->
						    <div class="form-group">
						        <label for="pr_larga_distanciai" class="col-md-3 control-label">Requiero Larga  Para Distancia  Internacional:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-edit" ></i></span>
						                <select class="form-control" id="pr_larga_distanciai" name="pr_larga_distanciai">
										    <option value="Seleccionar...">Seleccionar...</option>
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
										    <option value="Seleccionar...">Seleccionar...</option>
										    <option value="Si">Si</option>
	      									<option value="No">No</option>
	      									<option value="No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff">No hay Survey Adjunto - En espera de Respuesta a reporte de Inicio de Kickoff</option>
										</select>
						            </div>
						        </div>
						    </div>

						    <!-- Requiere Permisos para Local Extendida: -->
						    <div class="form-group">
						        <label for="pr_requiere_permisoe" class="col-md-3 control-label">Requiere Permisos para Local Extendida:</label>
						        <div class="col-md-9 selectContainer">
						            <div class="input-group">
						                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone" ></i></span>
						                <select class="form-control" id="pr_requiere_permisoe" name="pr_requiere_permisoe">
										    <option value="Seleccionar...">Seleccionar...</option>
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

				</div>
        	`;
        }

    };
    setForm.init();
});