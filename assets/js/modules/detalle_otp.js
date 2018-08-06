        $(function () {
            $('.select2_js_detalles').select2();
            $('#detalles_otp').DataTable();
            $('#detalles_oth').DataTable({
                initComplete: function () {
                    $('#detalles_oth tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    var r = $('#detalles_oth tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#detalles_oth thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#detalles_oth').DataTable();

                    // Apply the search
                    table.columns().every(function () {
                        var that = this;

                        $('input', this.footer()).on('keyup change', function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
                }
            });
        });

        function showModalDetalles(idOth) {
            document.getElementById("formModal_detalle").reset();
            $('#title_modal').html('');
            $.post(baseurl + '/OtHija/c_fillmodals',
            {
                        idOth: idOth // parametros que se envian
                    },
                    function (data) {
                        $.each(data, function (i, item) {
                            $('#mdl_' + i).val(item);
                        });
                    });
            $('#title_modal').html('<b>Detalle de la orden  ' + idOth + '</b>');
            $('#Modal_detalle').modal('show');
        }



        $('.button_observacion').on('click', function(){
            var btn_obs = $(this);
            var tr = btn_obs.parents('tr');
            var id_otp = tr.find('td').eq(0).html();

            swal.mixin({
              input: 'text',
              confirmButtonText: 'Siguiente &rarr;',
              showCancelButton: true,
              progressSteps: ['1', '2']
          }).queue([
          {
            title: 'Lista',
            text: 'Seleccione una opcion de la lista',
            input: 'select',
            inputClass: 'algo' ,
            inputOptions: {

               'EN PROCESOS CIERRE KO': 'EN PROCESOS CIERRE KO',
               'ALIADO - PENDIENTE SOLICITAR ENTREGA DEL SERVICIO': 'ALIADO - PENDIENTE SOLICITAR ENTREGA DEL SERVICIO',
               'ALIADO - SIN INFORMACIÓN ENTREGADA A TERCEROS PARA INICIAR PROCESO': 'ALIADO - SIN INFORMACIÓN ENTREGADA A TERCEROS PARA INICIAR PROCESO',
               'ASIGNADO LIDER TECNICO': 'ASIGNADO LIDER TECNICO',
               'CLIENTE - CAMBIO DE ALCANCE (CAMBIO DE TIPO DE SERVICIO)': 'CLIENTE - CAMBIO DE ALCANCE (CAMBIO DE TIPO DE SERVICIO)',
               'CLIENTE - CAMBIO DE UBICACIÓN DE ULTIMA MILLA': 'CLIENTE - CAMBIO DE UBICACIÓN DE ULTIMA MILLA',
               'CLIENTE - NO APRUEBA COSTOS DE OBRA CIVIL': 'CLIENTE - NO APRUEBA COSTOS DE OBRA CIVIL',
               'CLIENTE - NO PERMITE CIERRE DE KO': 'CLIENTE - NO PERMITE CIERRE DE KO',
               'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO',
               'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO - REQUIERE VENTANA': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA FINAL DE ENTREGA DEL SERVICIO - REQUIERE VENTANA',
               'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL SURVEY O VISITA O CON TERCERO': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL SURVEY O VISITA O CON TERCERO',
               'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL VOC': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INICIAL VOC',
               'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA  DE ULTIMA MILLA CON TERCERO ': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA  DE ULTIMA MILLA CON TERCERO ',
               'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EMPALMES': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EMPALMES',
               'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EOC': 'CLIENTE - NO PERMITE PROGRAMAR ACTIVIDAD ETAPA INTERMEDIA EOC',
               'CLIENTE - NO TIENE DEFINIDA LA DIRECCIÓN DONDE VA A QUEDAR UBICADO EL SERVICIO': 'CLIENTE - NO TIENE DEFINIDA LA DIRECCIÓN DONDE VA A QUEDAR UBICADO EL SERVICIO',
               'CLIENTE - PROGRAMADA_POSTERIOR ': 'CLIENTE - PROGRAMADA_POSTERIOR ',
               'CLIENTE - SIN CONTRATO FIRMADO': 'CLIENTE - SIN CONTRATO FIRMADO',
               'CLIENTE - SIN DISPONIBILIDAD DE INFRAESTRUCTURA (PLANTA TELEFONICA - LAN DIRECCIONAMIENTO )': 'CLIENTE - SIN DISPONIBILIDAD DE INFRAESTRUCTURA (PLANTA TELEFONICA - LAN DIRECCIONAMIENTO )',
               'CLIENTE - SIN FECHA ADECUACIONES EN LA SEDE (ELECTRICAS Y/O FISICA)': 'CLIENTE - SIN FECHA ADECUACIONES EN LA SEDE (ELECTRICAS Y/O FISICA)',
               'CLIENTE - SIN FECHA PARA RECIBIR EL SERVICIO': 'CLIENTE - SIN FECHA PARA RECIBIR EL SERVICIO',
               'COEX - EN PROCESO DE CONFIGURACIÓN BACKEND': 'COEX - EN PROCESO DE CONFIGURACIÓN BACKEND',
               'COEX -ATRASO CONFIGURACIÓN BACKEND': 'COEX -ATRASO CONFIGURACIÓN BACKEND',
               'COMERCIAL - ESCALADO ORDEN DE REEMPLAZO': 'COMERCIAL - ESCALADO ORDEN DE REEMPLAZO',
               'COMERCIAL - ESCALADO PENDIENTE INGRESO OTS': 'COMERCIAL - ESCALADO PENDIENTE INGRESO OTS',
               'CONTROL DE CAMBIOS - RFC NO ESTANDAR EN APROBACIÓN': 'CONTROL DE CAMBIOS - RFC NO ESTANDAR EN APROBACIÓN',
               'CSM - Retiro equipos - Renovación de Contrato': 'CSM - Retiro equipos - Renovación de Contrato',
               'DATACENTER  CLARO- CABLEADO SIN EJECUTAR': 'DATACENTER  CLARO- CABLEADO SIN EJECUTAR',
               'DATACENTER  CLARO- SIN CONSUMIBLES EN DATACENTER': 'DATACENTER  CLARO- SIN CONSUMIBLES EN DATACENTER',
               'DATACENTER CLARO- CABLEADO EN CURSO': 'DATACENTER CLARO- CABLEADO EN CURSO',
               'ENTREGA - SERVICIO_ENTREGADO_PROCESO DE CIERRE': 'ENTREGA - SERVICIO_ENTREGADO_PROCESO DE CIERRE',
               'ENTREGA - SIN DISPONIBILIDAD AGENDA EN VERIFICACIÓN DE RECURSOS': 'ENTREGA - SIN DISPONIBILIDAD AGENDA EN VERIFICACIÓN DE RECURSOS',
               'ENTREGA Y/O SOPORTE PROGRAMADO': 'ENTREGA Y/O SOPORTE PROGRAMADO',
               'EQUIPOS - DEFECTUOSOS': 'EQUIPOS - DEFECTUOSOS',
               'EQUIPOS - EN COMPRAS': 'EQUIPOS - EN COMPRAS',
               'ESCALADO_LIDER_IMPLEMENTACIÓN_PASO A PENDIENTE CLIENTE': 'ESCALADO_LIDER_IMPLEMENTACIÓN_PASO A PENDIENTE CLIENTE',
               'ESTADO CANCELADO': 'ESTADO CANCELADO',
               'ESTADO PENDIENTE CLIENTE': 'ESTADO PENDIENTE CLIENTE',
               'GPC - CAMBIO DE ALCANCE ORDEN DE PEDIDO': 'GPC - CAMBIO DE ALCANCE ORDEN DE PEDIDO',
               'GPC - EN PROCESO DE CANCELACIÓN': 'GPC - EN PROCESO DE CANCELACIÓN',
               'GPC - PENDIENTE ACEPTACIÓN CRONOGRAMA POR PARTE DEL CLIENTE': 'GPC - PENDIENTE ACEPTACIÓN CRONOGRAMA POR PARTE DEL CLIENTE',
               'GPC - PENDIENTE INFORMACIÓN DEL CLIENTE PARA CONFIGURAR': 'GPC - PENDIENTE INFORMACIÓN DEL CLIENTE PARA CONFIGURAR',
               'GPC - SIN ALCANCE PARA FABRICA': 'GPC - SIN ALCANCE PARA FABRICA',
               'IMPLEMENTACIÓN - SOLUCIÓN NO ESTANDAR': 'IMPLEMENTACIÓN - SOLUCIÓN NO ESTANDAR',
               'INCONVENIENTE TECNICO': 'INCONVENIENTE TECNICO',
               'LIDER TECNICO - CAMBIO DE ALCANCE PLAN TECNICO': 'LIDER TECNICO - CAMBIO DE ALCANCE PLAN TECNICO',
               'LIDER TECNICO - PENDIENTE PLAN TECNICO': 'LIDER TECNICO - PENDIENTE PLAN TECNICO',
               'LIDER TECNICO - SOLUCIÓN NO ESTANDAR': 'LIDER TECNICO - SOLUCIÓN NO ESTANDAR',
               'LIDER TECNICO - SOLUCIÓN NO ESTANDAR SIN DEFINICIÓN': 'LIDER TECNICO - SOLUCIÓN NO ESTANDAR SIN DEFINICIÓN',
               'PASO A PENDIENTE CLIENTE': 'PASO A PENDIENTE CLIENTE',
               'PENDIENTE SOLICITAR ENTREGA DEL SERVICIO': 'PENDIENTE SOLICITAR ENTREGA DEL SERVICIO',
               'PLANTA EXTERNA - EN CURSO SIN INCONVENIENTE REPORTADO': 'PLANTA EXTERNA - EN CURSO SIN INCONVENIENTE REPORTADO',
               'PLANTA EXTERNA - ERROR EN LA EJECUCIÓN DE EOC': 'PLANTA EXTERNA - ERROR EN LA EJECUCIÓN DE EOC',
               'PLANTA EXTERNA - ESCALADO_IFO_RESULTADO DE ACTIVIDAD': 'PLANTA EXTERNA - ESCALADO_IFO_RESULTADO DE ACTIVIDAD',
               'PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE DESBORDE': 'PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE DESBORDE',
               'PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE PERSONAL': 'PLANTA EXTERNA - ESCALADO_IFO_SOLICITUD DE PERSONAL',
               'PLANTA EXTERNA - ETAPA INTERMEDIA - SIN CONFIRMACIÓN DE PERSONAL PARA EOC Y EMPALMES': 'PLANTA EXTERNA - ETAPA INTERMEDIA - SIN CONFIRMACIÓN DE PERSONAL PARA EOC Y EMPALMES',
               'PLANTA EXTERNA - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO': 'PLANTA EXTERNA - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO',
               'PLANTA EXTERNA - NO VIABLE EN FACTIBILIDAD POR TERCEROS': 'PLANTA EXTERNA - NO VIABLE EN FACTIBILIDAD POR TERCEROS',
               'PLANTA EXTERNA - NO VIABLE EN FO - EN INSTALACIÓN POR HFC': 'PLANTA EXTERNA - NO VIABLE EN FO - EN INSTALACIÓN POR HFC',
               'PLANTA EXTERNA - PERMISOS MUNICIPALES - PERMISOS DE ARRENDADOR DE INFRAESTRUCTURA': 'PLANTA EXTERNA - PERMISOS MUNICIPALES - PERMISOS DE ARRENDADOR DE INFRAESTRUCTURA',
               'PLANTA EXTERNA - SIN APROBACIÓN DE TENDIDO EXTERNO POR COSTOS': 'PLANTA EXTERNA - SIN APROBACIÓN DE TENDIDO EXTERNO POR COSTOS',
               'PREVENTA - NO ES CLARA LA SOLUCIÓN A IMPLEMENTAR': 'PREVENTA - NO ES CLARA LA SOLUCIÓN A IMPLEMENTAR',
               'PREVENTA - SIN ID  FACTIBILIDAD PARA TERCEROS': 'PREVENTA - SIN ID  FACTIBILIDAD PARA TERCEROS',
               'PROYECTO ÉXITO ANTIGUO': 'PROYECTO ÉXITO ANTIGUO',
               'TERCEROS - EN CURSO SIN INCONVENIENTE REPORTADO': 'TERCEROS - EN CURSO SIN INCONVENIENTE REPORTADO',
               'TERCEROS - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO': 'TERCEROS - INCUMPLIMIENTO EN LA FECHA DE ENTREGA DE ULTIMA MILLA - SE CANCELO O REPROGRAMO ENTREGA DE SERVICIO',
               'TERCEROS - NO VIABLE - EN PROCESO NOTIFICACIÓN A CLIENTE Y COMERCIAL PARA CANCELACIÓN': 'TERCEROS - NO VIABLE - EN PROCESO NOTIFICACIÓN A CLIENTE Y COMERCIAL PARA CANCELACIÓN',
               'TERCEROS - SIN AVANCE SOBRE LA FECHA DE ENTREGA DE ULTIMA MILL': 'TERCEROS - SIN AVANCE SOBRE LA FECHA DE ENTREGA DE ULTIMA MILLA'
           },
           inputPlaceholder: 'Seleccione...',
           showCancelButton: true
       },

       {
        title: 'Observaciones',
        text: '¿Desea guardar observaciones?',
        input: 'textarea',
            // inputClass: 'algo' ,
            confirmButtonText: 'Guardar!',
            inputOptions: {


            },
            inputPlaceholder: 'Observaciones...',
            showCancelButton: true
        },




        ]).then((result) => {


          if (result.value) {

              if (!result.value[0] == "") {

                swal({
                   title: 'Desea guardar?',
                   text: "Se actualizará esta informacion en esta OTP",
                   type: 'question',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Guardar!'
               })        
                .then((result1) => {
                   if (result1.value) {
                    $.post(baseurl + '/OtPadre/update_data',
                        {
                            // clave: 'valor' // parametros que se envian
                            id   : id_otp,
                            lista: result.value[0],
                            observacion: result.value[1]
                        },
                        function (data) {
                            var res = JSON.parse(data); 
                            console.log(res);                      
                    if (res == true) {
                     swal(
                       'Guardado!',
                       'Actualizo correctamente los campos',
                       'success'
                       )
                     setTimeout("location.reload()", 1500); 
                 }else{
                  swal('Error',
                     'No tiene permiso para esta accíon',
                     'error' 
                     )  
              }
         });   
          }else{
              swal({
                type: 'error',
                title: 'Oops...',
                text: 'No se actuallizo ningun campo!',
            })
          }
      })

            }else{
                swal({
                  type: 'error',
                  title: 'Error',
                  text: 'No selecciono ningun registro de la lista',
              })
            }

        }

    })

    });
