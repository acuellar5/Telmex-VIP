$(function () {
    setForm = {
        init: function () {
            setForm.events();
            
        },

        //Eventos de la ventana.
        events: function () {
        },

        // retorna el formulario deseado
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
					                    <input name="mail_envio" id="mail_envio" class="form-control" type="text" required>
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
					</div>`;
        },

        // ultima seccion de servicios
        ultimaSeccionServicio: function(direccion_destino){
            return `<div class="widget bg_white m-t-25 display-block cliente">
					    <fieldset class="col-md-6 control-label">
					        <div class="form-group ingeniero1">
					            <label for="proveedor_ultima_milla" class="col-md-3 control-label">Ingeniero 1: &nbsp;</label>
					            <div class="col-md-8 selectContainer">
					                <div class="input-group">
					                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
					                    <select name="ingeniero1" id="ingeniero1" class="form-control class_fill_eingenieer" type="text" required >
					                        <option value="">Seleccionar</option>
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
					                        <option value="">Seleccionar</option>
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
					                        <option value="">Seleccionar</option>
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
        },










    };
    setForm.init();
});