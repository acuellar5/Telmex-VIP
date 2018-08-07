$(function () {
   /**********************************************INICIO 08 DIAS*********************************************/
   
 vista = {
        init: function () {
            vista.events();
            vista.getListOtsEigtDay();

        },
        //Eventos de la ventana.
        events: function () {
           $('#tablaEigtDaysOts').on('click', 'a.btn_email_ko15', vista.email_ko_15);
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
                    + "<a class='btn btn-default btn-xs ver-al btn_datatable_cami' title='Inf. Correos'><span class='fa fa-info'></span></a>"                                   
                    + "</div>";
            return botones;
        },
        email_ko_15: function () {
            $('#modalEmail_15dias').modal('show');
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
                          confirmButtonText: 'no, no, no... bueno si!'
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
                }
                
                
           };
    vista.init();
});
