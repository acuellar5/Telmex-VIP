$(function () {
   /**********************************************INICIO 08 DIAS*********************************************/
   
 vista = {
        init: function () {
            vista.events();
            vista.getListOtsEigtDay();

        },
        //eventos de la ventana.
        events: function () {
           $('#tablaEigtDaysOts').on('click', 'a.btn_email_ko15', vista.email_ko_15);
           $('#contenedor').on('click', 'a.email_send', vista.onClickVerLogTrChanges);
           $('.cerrar').on('click', vista.clear_form);
           $('#bnt_ko').on('click', vista.btn_enviar);
        },
        getListOtsEigtDay: function () {
            //metodo ajax (post)
            $.post(baseurl + '/ReporteActualizacion/getListOtsEigtDay',
                    {
                        //parametros
                        
                    },
                    // funcion que recibe los datos (callback)
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                // s
                                vista.printTable(obj.data);
                                $('#bdg_after8days').html(obj.cant);

                            }
                    );
                },
        printTable: function (data) {
            // nombramos la variable para la tabla y llamamos la configuiracion
            vista.tablaEigtDaysOts = $('#tablaEigtDaysOts').DataTable(vista.configTable(data, [

                {title: "OT Padre", data: "nro_ot_onyx"},
                {title: "ID OT Hija", data: "id_orden_trabajo_hija"},
                {title: "Nombre del Cliente", data: "n_nombre_cliente"},
                {title: "Fecha de Programación", data: "fecha_compromiso"},
                {title: "OT Hija", data: "ot_hija"},
                {title: "Estado orden trabajo Hija", data: "estado_orden_trabajo_hija"},
                {title: "Ingeniero Responsbale", data: "ingeniero"},
                {title: "Opc.", data: vista.getButtons},
   
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    //es para crear los campos para buscar
                    $('#tablaEigtDaysOts tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    //subir los espacios para buscar la informacion
                    var r = $('#tablaEigtDaysOts tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#tablaEigtDaysOts thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable 
                    var table = $('#tablaEigtDaysOts').DataTable();

                    // Apply the search
                    table.columns().every(function () {
                        var that = this;

                        $('input', this.footer()).on('keyup change', function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
                },
                data: data,
                columns: columns,
                //lenguaje del plugin
                /*"language": { 
                 "url": baseurl + "assets/plugins/datatables/lang/es.json"
                 },*/
                columnDefs: [{
                        defaultContent: "",
                        targets: -1,
                        orderable: false,
                    }],
                order: [[3, 'asc']],
                drawCallback: onDraw
            }
        },

        getButtons: function () {
            var botones = "<div class='btn-group-vertical'>"
                    + "<a class='btn btn-default btn-xs btn_email_ko15 btn_datatable_cami' title='Enviar Correo'><span class='fa fa-envelope-o'></span></a>"  
                    + "<a class='btn btn-default btn-xs ver-al btn_datatable_cami email_send' title='Inf. Correos'><span class='fa fa-info'></span></a>"                                   
                    + "</div>";
            return botones;
        },
        /***********************************************FIN PINTAR TABLA GRANDE***********************************************/
        /***********************************************INICIO ENVIAR CORREO MODAL FORMULARIO***********************************************/
        email_ko_15: function (e) {
            var record = vista.tablaEigtDaysOts.row( $(this).parents('tr') ).data();

            $('#formModal #id_orden_trabajo_hija').val(record.id_orden_trabajo_hija);
            $('#formModal #nro_ot_onyx').val(record.nro_ot_onyx);
            $('#formModal #c_email').val(record.c_email);
            $('#modalEmail_15dias #myModalLabel').html(`Orden Ot Hija N ${record.id_orden_trabajo_hija}`);

            $('#modalEmail_15dias').modal('show');
            console.log(record);

        },
        clear_form: function (){
            $('#formModal')[0].reset();
        },
        btn_enviar: function() {
             var msj = false;
                    var response = true;
                    var mail = $('#mail_envio1').val();
                    var expresiones = /\w+@\w+\.+[a-z]/;
                    var inputs = [  $('#nombre'),
                                    $('#ots_nombre'),
                                    $('#ampliacion_enlaces'),
                                    $('#direccion_servicio'),
                                    $('#servicio'),
                                    $('#vista_obra_civil'),
                                    $('#envio_cotizacion_obra_civil'),
                                    $('#aprobacion_cotizacion_obra_civil'),
                                    $('#ejecucion_obra_civil'),
                                    $('#empalmes'),
                                    $('#configuracion'),
                                    $('#equipos'),
                                    $('#ingeniero1_email'),
                                    $('#entrega_servicio'),
                                    $('#ingeniero_implementacion_responsable_cuenta'),
                                    $('#celular'),
                                    $('#mail_envio1')
                                ];
                    inputs.forEach(function(input){
                        if (input.val() == '') {
                            msj = true;
                            input.css("box-shadow", "0 0 5px rgba(253, 1, 1)");
                            return false;
                        }else {
                            input.css("box-shadow", "none");                        
                        }
                    });
                    if (msj) {
                        swal('Error', 'Complete correctamente los campos', 'error');
                        response = false; 
                        return false; 
                    }

                    if (!expresiones.test(mail)) {
                        swal('Error', 'El formato del correo está mal', 'error');
                        response = false;
                        return false;
                    }
                    
                    if(response){
                        swal({
                          title: '¿Esta seguro?',
                          text: 'El correo '+mail+' es correcto',
                          type: 'question',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Si!'
                        }).then((continuar) => {
                          if (continuar.value) {
                            swal(
                              'Enviado!',
                              'El correo se envio correctamente!',
                              'success'
                            )
                            $('#formModal').submit();
                                response = true;
                                setTimeout('document.location.reload()',1500);
                          }else{
                          swal('Error', 'Se he cancelado el envio', 'error');
                        }

                        })
                    }
                return false;
                },
            /*************************************************FIN ENVIAR CORREO*************************************************/

                    //************************************LOG**************************************
                    
                    onClickVerLogTrChanges: function () {
                        var aLinkLog = $(this);
                        var trParent = aLinkLog.parents('tr');
                        var tabla = aLinkLog.parents('table').attr('id');
                        var record;

                        switch(tabla) {
                            case 'tablaEigtDaysOts':
                                record = vista.tablaEigtDaysOts.row(trParent).data();                    
                                break;
                            case 'mail_send_today':
                                record = send.mail_send_today.row(trParent).data();                    
                                break;              
                        }


                        vista.getLogById(record);
                    },




                    getLogById: function(obj){
                        $.post( baseurl + '/Log/getLogById',
                            {
                                id: obj.id_orden_trabajo_hija
                            }, 
                            function(data) {
                            var obj = JSON.parse(data);
                            vista.showModalHistorial(obj);
                            }
                        );            
                    },

                    
                    // Muestra modal detalle historial log por id
                    showModalHistorial: function(obj){
                        $('#ModalHistorialLog').modal('show');
                        // $('#titleEventHistory').html('Historial Cambios de orden ' + obj.log[0].id_ot_hija + '');
                        vista.printTableHistory(obj.log);
                        vista.printTableLogMail(obj.mail);
                    },
                     //pintamos la tabla de log
                    printTableHistory: function(data){
                        // limpio el cache si ya habia pintado otra tabla
                        if(vista.tableModalHistory){
                            //si ya estaba inicializada la tabla la destruyo
                            vista.tableModalHistory.destroy();
                        }
                        ///lleno la tabla con los valores enviados
                        vista.tableModalHistory = $('#tableHistorialLog').DataTable(vista.configTableLog(data,[                                       
                                {data: "id_ot_hija"},
                                {data: "antes"},
                                {data: "ahora"},
                                {data: "columna"},
                                {data: "fecha_mod"}
                            ]));
                    },

                     //pintamos la tabla de log de correos
                    printTableLogMail: function(data){
                        // limpio el cache si ya habia pintado otra tabla
                        if(vista.tableModalLogMail){
                            //si ya estaba inicializada la tabla la destruyo
                            vista.tableModalLogMail.destroy();
                        }
                        ///lleno la tabla con los valores enviados
                        vista.tableModalLogMail = $('#table_log_mail').DataTable(vista.configTableLog(data,[                                       
                                {data: "fecha"},
                                {data: "clase"},
                                {data: "servicio"},
                                {data: "usuario_sesion"},
                                {data: "destinatarios"},
                                {data: "nombre"},
                                {data: vista.getButonsPrint}
                            ]));

                    },

                    configTableLog: function (data, columns, onDraw) {
                    return {
                      data: data,
                      columns: columns,
                      "language": {
                          "url": baseurl + "/assets/plugins/datatables/lang/es.json"
                      },


                        }
                    },

                    //
                    // onClickVerLogMail: function(){
                    //     var tr = $(this).parents('tr');
                    //     var record = vista.tableModalLogMail.row(tr).data();
                    //     console.log(record);

                    //     vista.generarPDF(record);
                    // },

                    // // generar pdf redireccionar
                    // generarPDF: function(data){
                    //     console.log(data);
                    //     $.post(baseurl + '/Templates/generatePDF', 
                    //         {
                    //             data: data
                    //         }, 
                    //         function(data) {
                           
                    //     });


                    //     // window.open('http://ejemplo.com/archivo.pdf', '_blank');
                    // },

                    // creamos los botones para imprimir el correo enviado
                    getButonsPrint: function(obj){
                        // return "<a class='ver-mail btn_datatable_cami'><span class='glyphicon glyphicon-print'></span></a>";

                        var button = '<button class="btn btn-default btn-xs ver-mail btn_datatable_cami" title="ver correo"><span class="fa fa-fw fa-print"></span></button>'
                        return button;

                    },           
                
           };
    vista.init();
});
/***************************************************TABLA EMAILS ENVIADOS HOY*************************************************************/
$(function () {
    send = {
        init: function () {
            send.events();
            send.get_mail_send_today();
            
        },

        //Eventos de la ventana.
        events: function () {
            // $('#mail_send_today').on('click', 'a.email_send', send.onClickVerLogTrChanges);
            // $('#contenido_tablas').on('click', 'a.al', send.onClickVerLogTrChanges);
        
        },
        get_mail_send_today: function () {
            $.post(baseurl + '/ReporteActualizacion/mail_send_today',
                    {
                        //parametros
                        
                    },
                    // funcion que recibe los datos (callback)
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                // s
                                send.printTable_mail(obj.data);
                                $('#bdg_send_today').html(obj.cant);

                            }
                    );
        },
        printTable_mail: function (data) {
            // nombramos la variable para la tabla y llamamos la configuiracion
            send.mail_send_today = $('#mail_send_today').DataTable(send.configTable_mail(data, [

                {title: "OT Padre", data: "nro_ot_onyx"},
                {title: "ID OT Hija", data: "id_orden_trabajo_hija"},
                {title: "Nombre del Cliente", data: "n_nombre_cliente"},
                {title: "Fecha de Programación", data: "fecha_compromiso"},
                {title: "OT Hija", data: "ot_hija"},
                {title: "Estado orden trabajo Hija", data: "estado_orden_trabajo_hija"},
                {title: "Ingeniero Responsbale", data: "ingeniero"},
                {title: "Opc.", data: send.getButtons},

            ]));
        },
         // Datos de configuracion del datatable
        configTable_mail: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    //es para crear los campos para buscar
                    $('#mail_send_today tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    //subir los espacios para buscar la informacion
                    var r = $('#mail_send_today tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#mail_send_today thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable 
                    var table = $('#mail_send_today').DataTable();

                    // Apply the search
                    table.columns().every(function () {
                        var that = this;

                        $('input', this.footer()).on('keyup change', function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
                },
                data: data,
                columns: columns,

                columnDefs: [{
                        defaultContent: "",
                        targets: -1,
                        orderable: false,
                    }],
                order: [[3, 'asc']],
                drawCallback: onDraw
            }
        },
        getButtons: function () {
            var botones = "<div class='btn-group-vertical'>"
                    + "<a class='btn btn-default btn-xs ver-al btn_datatable_cami email_send' title='Inf. Correos'><span class='fa fa-info'></span></a>"                                   
                    + "</div>";
            return botones;
        },
       

         
          
            
            // Muestra modal detalle historial log por id
            showModalHistorial: function(obj){
                $('#ModalHistorialLog').modal('show');
                // $('#titleEventHistory').html('Historial Cambios de orden ' + obj.log[0].id_ot_hija + '');
                send.printTableHistory(obj.log);
                send.printTableLogMail(obj.mail);
            },
             //pintamos la tabla de log
            printTableHistory: function(data){
                // limpio el cache si ya habia pintado otra tabla
                if(send.tableModalHistory){
                    //si ya estaba inicializada la tabla la destruyo
                    send.tableModalHistory.destroy();
                }
                ///lleno la tabla con los valores enviados
                send.tableModalHistory = $('#tableHistorialLog').DataTable(send.configTableLog(data,[                                       
                        {data: "id_ot_hija"},
                        {data: "antes"},
                        {data: "ahora"},
                        {data: "columna"},
                        {data: "fecha_mod"}
                    ]));
            },

             //pintamos la tabla de log de correos
            printTableLogMail: function(data){
                // limpio el cache si ya habia pintado otra tabla
                if(send.tableModalLogMail){
                    //si ya estaba inicializada la tabla la destruyo
                    send.tableModalLogMail.destroy();
                }
                ///lleno la tabla con los valores enviados
                send.tableModalLogMail = $('#table_log_mail').DataTable(send.configTableLog(data,[                                       
                        {data: "fecha"},
                        {data: "clase"},
                        {data: "servicio"},
                        {data: "usuario_sesion"},
                        {data: "destinatarios"},
                        {data: "nombre"},
                        {data: send.getButonsPrint}
                    ]));

            },

            //
            onClickVerLogMail: function(){
                var tr = $(this).parents('tr');
                var record = send.tableModalLogMail.row(tr).data();
                console.log(record);

                send.generarPDF(record);
            },

            // generar pdf redireccionar
            generarPDF: function(data){
                console.log(data);
                $.post(baseurl + '/Templates/generatePDF', 
                    {
                        data: data
                    }, 
                    function(data) {
                   
                });


                // window.open('http://ejemplo.com/archivo.pdf', '_blank');
            },

            // creamos los botones para imprimir el correo enviado
            getButonsPrint: function(obj){
                // return "<a class='ver-mail btn_datatable_cami'><span class='glyphicon glyphicon-print'></span></a>";

                var button = '<button class="btn btn-default btn-xs ver-mail btn_datatable_cami" title="ver correo"><span class="fa fa-fw fa-print"></span></button>'
                return button;

            },



        


    };
    send.init();
});