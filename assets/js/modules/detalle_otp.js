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
             tableDetalle = $('#detalles_oth').DataTable();

            // Apply the search
            tableDetalle.columns().every(function () {
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



$('.button_observaciones').on('click', function () {
    var btn_obs = $(this);
    var tr = btn_obs.parents('tr');
    var id_otp = tr.find('td').eq(0).html();

    swal.mixin({
        input: 'text',
        confirmButtonText: 'Siguiente &rarr;',
        showCancelButton: true,
        progressSteps: ['1', '2'],
        //option group
        onOpen: function(){
        var lista = $('.select-sweet option');
            console.log(lista[1]);
            lista[1].setAttribute("disabled", true);
            lista[1].style.background = "#3085d6";
            lista[1].style.color = "white";
            lista[71].setAttribute("disabled", true);
            lista[71].style.background = "#3085d6";
            lista[71].style.color = "white";
            $.each(lista, function(i, option) {
            if (i < 71 && i > 1) {
                 option.style.background = "#db8181bd";
                 option.style.color = "black";
            }                       
            if (i >= 72 ) {
                 option.style.background = "#add8e6";
                 option.style.color = "black";
            }
            });

                            
        },
    }).queue([
        {
            title: 'Lista',
            text: 'Seleccione una opcion de la lista',
            input: 'select',
            inputClass: 'select-sweet f-s-12',
            inputOptions: {

               'codigos' : '**CODIGOS ANTIGUOS**',
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
                'CLIENTE - PROGRAMADA POSTERIOR ': 'CLIENTE - PROGRAMADA POSTERIOR ',
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
                'ENTREGA - SERVICIO ENTREGADO PROCESO DE CIERRE': 'ENTREGA - SERVICIO ENTREGADO PROCESO DE CIERRE',
                'ENTREGA - SIN DISPONIBILIDAD AGENDA EN VERIFICACIÓN DE RECURSOS': 'ENTREGA - SIN DISPONIBILIDAD AGENDA EN VERIFICACIÓN DE RECURSOS',
                'ENTREGA Y/O SOPORTE PROGRAMADO': 'ENTREGA Y/O SOPORTE PROGRAMADO',
                'EQUIPOS - DEFECTUOSOS': 'EQUIPOS - DEFECTUOSOS',
                'EQUIPOS - EN COMPRAS': 'EQUIPOS - EN COMPRAS',
                'ESCALADO LIDER IMPLEMENTACIÓN PASO A PENDIENTE CLIENTE': 'ESCALADO LIDER IMPLEMENTACIÓN PASO A PENDIENTE CLIENTE',
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
                'PLANTA EXTERNA - ESCALADO IFO RESULTADO DE ACTIVIDAD': 'PLANTA EXTERNA - ESCALADO IFO RESULTADO DE ACTIVIDAD',
                'PLANTA EXTERNA - ESCALADO IFO SOLICITUD DE DESBORDE': 'PLANTA EXTERNA - ESCALADO IFO SOLICITUD DE DESBORDE',
                'PLANTA EXTERNA - ESCALADO IFO SOLICITUD DE PERSONAL': 'PLANTA EXTERNA - ESCALADO IFO SOLICITUD DE PERSONAL',
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
                'TERCEROS - SIN AVANCE SOBRE LA FECHA DE ENTREGA DE ULTIMA MILL': 'TERCEROS - SIN AVANCE SOBRE LA FECHA DE ENTREGA DE ULTIMA MILLA',
                'nuevos' : '**CODIGOS NUEVOS**',
                'CLIENTE - SIN FECHA PARA RECIBIR EL SERVICIO' : 'CLIENTE - SIN FECHA PARA RECIBIR EL SERVICIO',
                'CLIENTE/SIN FECHA ADECUACIONES EN SEDE (ELEC/FIS)' : 'CLIENTE/SIN FECHA ADECUACIONES EN SEDE (ELEC/FIS)',
                'CLIENTE/SIN DISPONIBILIDAD INFRA (PTA TELEF/LAN)' : 'CLIENTE/SIN DISPONIBILIDAD INFRA (PTA TELEF/LAN)',
                'CLIENTE/CAMBIO DE ALCANCE (CBIO  TIPO SERVICIO)' : 'CLIENTE/CAMBIO DE ALCANCE (CBIO  TIPO SERVICIO)',
                'CLIENTE/CAMBIO DE UBICACIÓN DE ULTIMA MILLA' : 'CLIENTE/CAMBIO DE UBICACIÓN DE ULTIMA MILLA',
                'CLIENTE/NO APRUEBA COSTOS DE OBRA CIVIL' : 'CLIENTE/NO APRUEBA COSTOS DE OBRA CIVIL',
                'CLIENTE/NO PERMITE CIERRE DE KO' : 'CLIENTE/NO PERMITE CIERRE DE KO',
                'CLIENTE/SIN DEFINICIÓN DIR DE UBICACIÓN SERVICIO' : 'CLIENTE/SIN DEFINICIÓN DIR DE UBICACIÓN SERVICIO',
                'CLIENTE/NO PERMITE PROG ACT ETAPA INICIAL VOC' : 'CLIENTE/NO PERMITE PROG ACT ETAPA INICIAL VOC',
                'CLIENTE/NO PERMITE PROG ACT ETAPA INTERMEDIA EOC' : 'CLIENTE/NO PERMITE PROG ACT ETAPA INTERMEDIA EOC',
                'CLIENTE/NO PERMITE PROG ACT ETAPA INTERMEDIA EMP' : 'CLIENTE/NO PERMITE PROG ACT ETAPA INTERMEDIA EMP',
                'CLIENTE/NO PERMITE PROG ACT  VOC TERCERO' : 'CLIENTE/NO PERMITE PROG ACT  VOC TERCERO',
                'CLIENTE/NO PERMITE PROG ACT ETAP INTERMEDIA UM TER' : 'CLIENTE/NO PERMITE PROG ACT ETAP INTERMEDIA UM TER',
                'CLIENTE/NO PERMITE PROG ACT ETAPA FINAL ES' : 'CLIENTE/NO PERMITE PROG ACT ETAPA FINAL ES',
                'CLIENTE/NO PERMITE PROG ACT ETAPA FINAL ES REQ VM' : 'CLIENTE/NO PERMITE PROG ACT ETAPA FINAL ES REQ VM',
                'CLIENTE/SIN CONTRATO FIRMADO' : 'CLIENTE/SIN CONTRATO FIRMADO',
                'CLIENTE/PROGRAMADA_PROXIMO PERIODO' : 'CLIENTE/PROGRAMADA_PROXIMO PERIODO',
                'PL_ EXT/PERMISO MUNI - PERMISO ARREND INFRAESTRUC' : 'PL_ EXT/PERMISO MUNI - PERMISO ARREND INFRAESTRUC',
                'PL_ EXT/NO VIABLE EN FACTIBILIDAD POR TERCEROS' : 'PL_ EXT/NO VIABLE EN FACTIBILIDAD POR TERCEROS',
                'PL_ EXT/ETAPA INTERMEDIA/SIN PERSONAL  EOC/EMP' : 'PL_ EXT/ETAPA INTERMEDIA/SIN PERSONAL  EOC/EMP',
                'PL_ EXT/SIN APROBACIÓN COSTOS TENDIDO EXTERNO' : 'PL_ EXT/SIN APROBACIÓN COSTOS TENDIDO EXTERNO',
                'PL_ EXT/NO VIABLE EN FO - EN INSTALACIÓN POR HFC' : 'PL_ EXT/NO VIABLE EN FO - EN INSTALACIÓN POR HFC',
                'PLANTA EXTERNA - ERROR EN LA EJECUCIÓN DE EOC' : 'PLANTA EXTERNA - ERROR EN LA EJECUCIÓN DE EOC',
                'PL_ EXT/INCUMPLIMIENTO FE DE UM/CANCELO/REPR ES' : 'PL_ EXT/INCUMPLIMIENTO FE DE UM/CANCELO/REPR ES',
                'PL_ EXT/EN CURSO SIN INCONVENIENTE REPORTADO' : 'PL_ EXT/EN CURSO SIN INCONVENIENTE REPORTADO',
                'PL_ EXT/ESCALADO_IFO_RESULTADO DE ACTIVIDAD' : 'PL_ EXT/ESCALADO_IFO_RESULTADO DE ACTIVIDAD',
                'PL_ EXT/ESCALADO_IFO_SOLICITUD DE DESBORDE' : 'PL_ EXT/ESCALADO_IFO_SOLICITUD DE DESBORDE',
                'PL_ EXT/ESCALADO_IFO_SOLICITUD DE PERSONAL' : 'PL_ EXT/ESCALADO_IFO_SOLICITUD DE PERSONAL',
                'PLANTA EXTERNA - EN CURSO SOBRE OTP PYMES' : 'PLANTA EXTERNA - EN CURSO SOBRE OTP PYMES',
                'PLANTA EXTERNA - EN CURSO SOBRE OTP ASOCIADA' : 'PLANTA EXTERNA - EN CURSO SOBRE OTP ASOCIADA',
                'TERCEROS/NO VIABLE/EN PROC CANCELACIÓN' : 'TERCEROS/NO VIABLE/EN PROC CANCELACIÓN',
                'TERCEROS/INCUMPLIMIENTO FECHA ENTREGA UM' : 'TERCEROS/INCUMPLIMIENTO FECHA ENTREGA UM',
                'TERCEROS/SIN AVANCE SOBRE LA FECHA ENTREGA UM' : 'TERCEROS/SIN AVANCE SOBRE LA FECHA ENTREGA UM',
                'TERCEROS - EN CURSO SIN INCONVENIENTE REPORTADO' : 'TERCEROS - EN CURSO SIN INCONVENIENTE REPORTADO',
                'ALIADO/SIN INFORM ENTREGADA A TERC PARA INICIAR' : 'ALIADO/SIN INFORM ENTREGADA A TERC PARA INICIAR',
                'PREVENTA - SIN ID  FACTIBILIDAD PARA TERCEROS' : 'PREVENTA - SIN ID  FACTIBILIDAD PARA TERCEROS',
                'PREVENTA - NO ES CLARA LA SOLUCIÓN A IMPLEMENTAR' : 'PREVENTA - NO ES CLARA LA SOLUCIÓN A IMPLEMENTAR',
                'IMPLEMENTACIÓN - SOLUCIÓN NO ESTANDAR' : 'IMPLEMENTACIÓN - SOLUCIÓN NO ESTANDAR',
                'COMERCIAL - ESCALADO ORDEN DE REEMPLAZO' : 'COMERCIAL - ESCALADO ORDEN DE REEMPLAZO',
                'EQUIPOS - EN COMPRAS' : 'EQUIPOS - EN COMPRAS',
                'EQUIPOS - DEFECTUOSOS' : 'EQUIPOS - DEFECTUOSOS',
                'EQUIPOS - SIN CODIGO SAP PARA SOLICITUD DE EQUIPOS' : 'EQUIPOS - SIN CODIGO SAP PARA SOLICITUD DE EQUIPOS',
                'GPC/PENDIENTE INFOR DEL CLIENTE PARA CONFIGURAR' : 'GPC/PENDIENTE INFOR DEL CLIENTE PARA CONFIGURAR',
                'GPC/PENDIENTE ACEPTACIÓN CRONOGRAMA POR CLIENTE' : 'GPC/PENDIENTE ACEPTACIÓN CRONOGRAMA POR CLIENTE',
                'GPC - CAMBIO DE ALCANCE ORDEN DE PEDIDO' : 'GPC - CAMBIO DE ALCANCE ORDEN DE PEDIDO',
                'GPC - EN PROCESO DE CANCELACIÓN' : 'GPC - EN PROCESO DE CANCELACIÓN',
                'GPC/PENDIENTE ACEPTACIÓN CRONOGRAMA POR CLIENTE' : 'GPC/PENDIENTE ACEPTACIÓN CRONOGRAMA POR CLIENTE',
                'GPC - SIN ALCANCE PARA FABRICA' : 'GPC - SIN ALCANCE PARA FABRICA',
                'LIDER TECNICO - PENDIENTE PLAN TECNICO' : 'LIDER TECNICO - PENDIENTE PLAN TECNICO',
                'LIDER TECNICO - CAMBIO DE ALCANCE PLAN TECNICO' : 'LIDER TECNICO - CAMBIO DE ALCANCE PLAN TECNICO',
                'LIDER TECNICO/SOLUCIÓN NO ESTANDAR SIN DEFINICIÓN' : 'LIDER TECNICO/SOLUCIÓN NO ESTANDAR SIN DEFINICIÓN',
                'CONTROL DE CAMBIOS - RFC NO ESTANDAR EN APROBACIÓN' : 'CONTROL DE CAMBIOS - RFC NO ESTANDAR EN APROBACIÓN',
                'COEX - EN PROCESO DE CONFIGURACIÓN BACKEND' : 'COEX - EN PROCESO DE CONFIGURACIÓN BACKEND',
                'COEX -ATRASO CONFIGURACIÓN BACKEND' : 'COEX -ATRASO CONFIGURACIÓN BACKEND',
                'ESCALADO/EN PROCESO PASO A PENDIENTE CLIENTE' : 'ESCALADO/EN PROCESO PASO A PENDIENTE CLIENTE',
                'ENTREGA - SERVICIO_ENTREGADO_PROCESO DE CIERRE' : 'ENTREGA - SERVICIO_ENTREGADO_PROCESO DE CIERRE',
                'ENTREGA/SIN DISPONIBILIDAD AGENDA' : 'ENTREGA/SIN DISPONIBILIDAD AGENDA',
                'ENTREGA Y/O SOPORTE PROGRAMADO' : 'ENTREGA Y/O SOPORTE PROGRAMADO',
                'PENDIENTE SOLICITAR ENTREGA DEL SERVICIO' : 'PENDIENTE SOLICITAR ENTREGA DEL SERVICIO',
                'DATACENTER CLARO- CABLEADO EN CURSO' : 'DATACENTER CLARO- CABLEADO EN CURSO',
                'DATACENTER  CLARO- CABLEADO SIN EJECUTAR' : 'DATACENTER  CLARO- CABLEADO SIN EJECUTAR',
                'DATACENTER  CLARO- SIN CONSUMIBLES EN DATACENTER' : 'DATACENTER  CLARO- SIN CONSUMIBLES EN DATACENTER',
                'EN PROCESO DE PASO A ESTADO PENDIENTE CLIENTE' : 'EN PROCESO DE PASO A ESTADO PENDIENTE CLIENTE',
                'EN PROCESO DE PASO A ESTADO CANCELADO ' : 'EN PROCESO DE PASO A ESTADO CANCELADO ',
                'INCONVENIENTE TECNICO' : 'INCONVENIENTE TECNICO',
                'KO PENDIENTE' : 'KO PENDIENTE',
                'EN CONFIGURACIÓN' : 'EN CONFIGURACIÓN',
                'GPC/CAMBIO DE ALCANCE ORDEN DE PEDIDO' : 'GPC/CAMBIO DE ALCANCE ORDEN DE PEDIDO',
                'GPC/EN PROCESO DE CANCELACIÓN' : 'GPC/EN PROCESO DE CANCELACIÓN',
                'GPC/PENDIENTE INFORM DEL CLIENTE PARA CONFIGURAR' : 'GPC/PENDIENTE INFORM DEL CLIENTE PARA CONFIGURAR',
                'GPC/SIN ALCANCE PARA FABRICA' : 'GPC/SIN ALCANCE PARA FABRICA',
                'ESTADO CANCELADO' : 'ESTADO CANCELADO',
                'ESTADO PENDIENTE CLIENTE' : 'ESTADO PENDIENTE CLIENTE'

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
                                            id: id_otp,
                                            lista: result.value[0],
                                            observacion: result.value[1]
                                        },
                                        function (data) {
                                            var res = JSON.parse(data);
                                            if (res == true) {
                                                swal(
                                                        'Guardado!',
                                                        'Actualizo correctamente los campos',
                                                        'success'
                                                        )
                                                setTimeout("location.reload()", 1500);
                                            } else {
                                                swal('Error',
                                                        'No tiene permiso para esta accíon',
                                                        'error'
                                                        )
                                            }
                                        });
                            } else {
                                swal({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'No se actuallizo ningun campo!',
                                })
                            }
                        })

            } else {
                swal({
                    type: 'error',
                    title: 'Error',
                    text: 'No selecciono ningun registro de la lista',
                })
            }

        }

    });













});
/************************************************************************LOG************************************************************************/
     $('.ver-log').on('click', onClickVerLogTrChanges);

     function onClickVerLogTrChanges(e){
        var tr = tableDetalle.row($(this).parents('tr')).data();

        getLogById(tr);
     }

     function  getLogById(obj){
        $.post( baseurl + '/Log/getLogById',
            {
                id: obj[0]
            },
            function(data) {
            var obj = JSON.parse(data);
            showModalHistorial(obj);
            }
        );
     }
    // Muestra modal detalle historial log por id
    function showModalHistorial(obj){
        $('#ModalHistorialLog').modal('show');
        // $('#titleEventHistory').html('Historial Cambios de orden ' + obj.log[0].id_ot_hija + '');
        printTableHistory(obj.log);
        printTableLogMail(obj.mail);
    }
    function printTableHistory(data){
        // limpio el cache si ya habia pintado otra tabla
    if(typeof tableModalHistory != 'undefined'){
            //si ya estaba inicializada la tabla la destruyo
        tableModalHistory.destroy();
    }
        //lleno la tabla con los valores enviados
        tableModalHistory = $('#tableHistorialLog').DataTable(configTableLog(data,[
                {data: "id_ot_hija"},
                {data: "antes"},
                {data: "ahora"},
                {data: "columna"},
                {data: "fecha_mod"}
            ]));
    }
    //pintamos la tabla de log de correos
    function printTableLogMail(data){
    // limpio el cache si ya habia pintado otra tabla
    if(typeof tableModalLogMail != 'undefined'){
        //si ya estaba inicializada la tabla la destruyo
        tableModalLogMail.destroy();
    }
    //lleno la tabla con los valores enviados
        tableModalLogMail = $('#table_log_mail').DataTable(configTableLog(data,[
                {data: "fecha"},
                {data: "clase"},
                {data: "servicio"},
                {data: "usuario_en_sesion"},
                {data: "destinatarios"},
                {data: "nombre"},
                {data: getButonsPrint}
            ]));

        }
    function configTableLog(data, columns, onDraw) {
        return {
          data: data,
          columns: columns,
          "language": {
              "url": baseurl + "/assets/plugins/datatables/lang/es.json"
          },


            }
        }


        function onClickVerLogMailReporte(){
            var tr = $(this).parents('tr');
            var record = tableModalLogMail.row(tr).data();

            generarPDF(record);
        }

        // generar pdf redireccionar
        function generarPDF(data){
            $.post(baseurl + '/Templates/generatePDF',
                {
                    data: data
                },
                function(data) {
                var plantilla = JSON.parse(data);
                $('body').append(
                        `
                            <form action="${baseurl}/Log/view_email" method="POST" target="_blank" hidden>
                                <textarea name="txt_template" id="txt_template"></textarea>
                                <input type="submit" value="e" id="smt_ver_correo">
                            </form>
                        `
                    );
                $('#txt_template').val(plantilla);
                $('#smt_ver_correo').click();


            });

        }

        // creamos los botones para imprimir el correo enviado
        function getButonsPrint(obj){
            // return "<a class='ver-mail btn_datatable_cami'><span class='glyphicon glyphicon-print'></span></a>";

            var button = '<button class="btn btn-default btn-xs ver-mail btn_datatable_cami" title="ver correo"><span class="fa fa-fw fa-print"></span></button>'
            return button;

        }
