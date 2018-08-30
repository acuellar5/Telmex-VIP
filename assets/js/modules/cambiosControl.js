/************************* MOSTRAR MODAL FORMULARIO*************************/
//LISTAR SELECTS
$.each(responsable_list, function(i, item) {
    $('#id_responsable').append(`
            <option value="${item.id_responsable}">${item.nombre_responsable}</option>
        `);
});

$.each(causa_list, function(i, item) {
    $('#id_causa').append(`
            <option value="${item.id_causa}">${item.nombre_causa}</option>
        `);
});
// MOSTRAR MODAL
function showFormControl(otp, cliente, id_sede, num_ctrl){
    table_historial(otp);
    $('#myModalLabel').html(`Orden de trabajo ${otp}`);
    document.getElementById("formModal").reset();
    $('#id_ot_padre').val(otp);
    $('#id_sede').val(id_sede);
    $('#bdg_historial').html(num_ctrl);
    $('#numero_control').val(parseInt(num_ctrl) + 1);
    $('#n_nombre_cliente').val(cliente);
    $('#mdl-control_cambios').modal('show');
}

function table_historial(otp){
    $.post(baseurl + '/Sede/getCCByOtp', 
        {otp: otp}, 
        function(obj) {
            var data = JSON.parse(obj);
            print_table_historial(data);
    });
}

function print_table_historial(data){
    if (typeof tabla_Historiales == 'object' ) {
        var tabla = tabla_Historiales;
        tabla.clear().draw();
        tabla.rows.add(data);
        tabla.columns.adjust().draw();
        return;
    }

    tabla_Historiales = $('#tabla_Historial').DataTable(configTableHistorial(data, [
            {title: "responsable", data: "nombre_responsable"},//1
            {title: "causa", data: "nombre_causa"},//2
            {title: "numero control", data: "numero_control"},//3
            {title: "compromiso", data: "fecha_compromiso", visible:false},//4
            {title: "fecha programacion inicial", data: "fecha_programacion_inicial", visible:false},//5
            {title: "nueva fecha programacion", data: "nueva_fecha_programacion", visible:false},//6
            {title: "narrativa escalamiento", data: getNarrativaTotalLog2},//7
            {title: "estado", data: "estado_cc"},//8
            {title: "observaciones", data: "observaciones_cc"},//9
            {title: "faltantes", data: "faltantes"},//10
            {title: "en tiempo", data: "en_tiempos", visible:false},//11
            {title: "creado", data: "fecha_creacion_cc"}//12

        ]));
}

function getNarrativaTotalLog2(obj){

    // console.log(obj);
            if (typeof obj.narrativa_escalamiento == 'string') {
                var array_cadena = obj.narrativa_escalamiento.split(" ");
                var cadena = "";
                if (array_cadena.length > 10) {

                    for (var i = 0; i < 10; i++) {
                        cadena += array_cadena[i] + " ";
                    }


                    // console.log("cadena", cadena);

                    return `<div class="tooltipo">${cadena} <img class="rigth" style="width:15px; margin-left:96%;" src="${baseurl}/assets/images/plus.png">
                              <span class="tooltiptext">${obj.narrativa_escalamiento}</span>
                            </div>
                            `;

                }
            }
            return obj.narrativa_escalamiento;
}
function configTableHistorial(data, columns, onDraw) {
    return {
        initComplete: function () {
            $('#tabla_Historial  tfoot th').each(function () {
                $(this).html('<input type="text" placeholder="Buscar" />');
            });

            var r = $('#tabla_Historial tfoot tr');
            r.find('th').each(function () {
                $(this).css('padding', 8);
            });
            $('#tabla_Historial thead').append(r);
            $('#search_0').css('text-align', 'center');

            // DataTable
            var table = $('#tabla_Historial').DataTable();

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
        "language": {
            "url": baseurl + "/assets/plugins/datatables/lang/es.json",
        },
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'colvisGroup',
                className: 'btn',
                text: 'items',
                show: [ 0,1,2,3,4,5],
                hide: [6,7,8,9,10,11]
            },
            {
                extend: 'colvisGroup',
                className: 'btn',
                text: 'items 2',
                show: [6,7,8,9,10,11],
                hide: [ 0,1,2,3,4,5]
            },
            
            {
                text: 'Excel <span class="fa fa-file-excel-o"></span>',
                className: 'btn-cami_cool',
                extend: 'excel',
                title: 'ZOLID EXCEL',
                filename: 'zolid ' + fecha_actual
            },
            {
                text: 'Imprimir <span class="fa fa-print"></span>',
                className: 'btn-cami_cool',
                extend: 'print',
                title: 'Reporte Zolid',
            }
        ],
        select: true,
        searching: false,

        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

        columnDefs: [{
                // targets: -1,
                // visible: false,
                defaultContent: "",
                // targets: -1,
                orderable: false,
            }],
        order: [[0, 'desc']],
        drawCallback: onDraw
    }
}




// ****************************SECCION PARA AGREGAR LAS SEDES EN EL MODULO DE CONTROL DE CAMBIO****************************
$(function () {
    trackChangesHeadquarters = {
        init: function () {
            trackChangesHeadquarters.events();
            trackChangesHeadquarters.getListHeadquarters_table();
        },
        //Eventos de la ventana.
        events: function () {

        },
        getListHeadquarters_table: function () {
            //metodo ajax (post)
            $.post(baseurl + '/Sede/c_getListofficesTable',
                    {
                        //parametros

                    },
                    // función que recibe los datos
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                trackChangesHeadquarters.printTable(obj);
                            }
                    );
                },
        printTable: function (data) {
            // nombramos la variable para la tabla y llamamos la configuiracion que se encuentra en /assets/js/modules/helper.js
            trackChangesHeadquarters.trackChanges_Office = $('#trackChanges_Office').DataTable(trackChangesHeadquarters.configTableHeadquarters(data, [

                {title: "ID sede", data: "id_sede"},
                {title: "Nombre de la sede", data: "nombre_sede"},
                {title: "Ciudad", data: "ciudad"},
                {title: "Departamento", data: "departamento"},
                {title: "Dierección", data: "direccion"},
                {title: "Clasificación", data: "clasificacion"},
                {title: "Cant Ctrl Camb", data: "num_ctrl_camb"},
                {title: "Opc.", data: trackChangesHeadquarters.getButonsPrintOffice},
            ]));
        },
        // Datos de configuracion del datatable
        configTableHeadquarters: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    $('#trackChanges_Office  tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });

                    var r = $('#trackChanges_Office tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#trackChanges_Office thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#trackChanges_Office').DataTable();

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
                "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json",
                },
                dom: 'Blfrtip',
                buttons: [
                    {
                        text: 'Excel <span class="fa fa-file-excel-o"></span>',
                        className: 'btn-cami_cool',
                        extend: 'excel',
                        title: 'ZOLID EXCEL',
                        filename: 'zolid ' + fecha_actual
                    },
                    {
                        text: 'Imprimir <span class="fa fa-print"></span>',
                        className: 'btn-cami_cool',
                        extend: 'print',
                        title: 'Reporte Zolid',
                    }
                ],
                select: true,

                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

                columnDefs: [{
                        // targets: -1,
                        // visible: false,
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[0, 'desc']],
                drawCallback: onDraw
            }
        },

        getButonsPrintOffice: function (obj) {
            var button = '<div class="btn-group" style="display: inline-flex;">';

            button += '<a href="'+ baseurl +'/Sede/otps_sede/'+obj.id_sede+'" target="_blank" class="btn btn-default btn-xs btn_datatable_cami" title="cantidad OTP"><span class="glyphicon">'+obj.cant_otp+'</span></a>';
            button += '<a class="btn btn-default btn-xs btn_datatable_cami btn_file" title="Evidencias"><span class="glyphicon glyphicon-file"></span></a>';
            button +='</div>';

            return button;

        },
    };
    trackChangesHeadquarters.init();


// ****************************SECCION PARAAGREGAR LAS SEDES EN EL MODULO DE CONTROL DE CAMBIO****************************

     controlCOTP = {
        init: function () {
            controlCOTP.events();
            controlCOTP.getListHeadquarters_table();

        },
        //Eventos de la ventana.
        events: function () {

        },
        getListHeadquarters_table: function () {
            //metodo ajax (post)
            $.post(baseurl + '/Sede/c_getListOTPTable',
                    {
                        //parametros

                    },
                    // función que recibe los datos
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                controlCOTP.printTable(obj);
                            }
                    );
                },
        printTable: function (data) {
            // nombramos la variable para la tabla y llamamos la configuiracion que se encuentra en /assets/js/modules/helper.js
            controlCOTP.trackChanges_Office = $('#trackChanges_OTP').DataTable(controlCOTP.configTableHeadquarters(data, [

                {title: "Nombre de la Sede", data: "nombre_sede"},
                {title: "ID OTP", data: "k_id_ot_padre"},
                {title: "Nombre Cliente", data: "n_nombre_cliente"},
                {title: "Tipo", data: "orden_trabajo"},
                {title: "Servicio", data: "servicio"},
                {title: "Estado OTP", data: "estado_orden_trabajo"},
                {title: "Cant Ctrl Camb", data: "num_ctrl"},
                {title: "Opc.", data: controlCOTP.getButonsPrintOTP},
            ]));
        },
        // Datos de configuracion del datatable
        configTableHeadquarters: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    $('#trackChanges_OTP  tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });

                    var r = $('#trackChanges_OTP tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#trackChanges_OTP thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#trackChanges_OTP').DataTable();

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
                "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json",
                },
                dom: 'Blfrtip',
                buttons: [
                    {
                        text: 'Excel <span class="fa fa-file-excel-o"></span>',
                        className: 'btn-cami_cool',
                        extend: 'excel',
                        title: 'ZOLID EXCEL',
                        filename: 'zolid ' + fecha_actual
                    },
                    {
                        text: 'Imprimir <span class="fa fa-print"></span>',
                        className: 'btn-cami_cool',
                        extend: 'print',
                        title: 'Reporte Zolid',
                    }
                ],
                select: true,

                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

                columnDefs: [{
                        // targets: -1,
                        // visible: false,
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[0, 'desc']],
                drawCallback: onDraw
            }
        },

        getButonsPrintOTP: function (obj) {
            var button = `<a class="btn btn-default btn-xs btn_datatable_cami" title="ver OTP" onclick="showFormControl('${obj.k_id_ot_padre}', '${obj.n_nombre_cliente}', '${obj.id_sede}', '${obj.num_ctrl}')"><i class="fa fa-bars" aria-hidden="true"></i></a>`
            return button;

        },    
    };
    controlCOTP.init();

// ****************************SECCION DE MODULO DE CONTROL DE CAMBIO ****************************

     controlCambioAll = {
        init: function () {
            controlCambioAll.events();
            controlCambioAll.getListAllCc_table();

        },
        //Eventos de la ventana.
        events: function () {

        },
        getListAllCc_table: function () {
            //metodo ajax (post)
            $.post(baseurl + '/Sede/c_getList_All_Table',
                    {
                        //parametros

                    },
                    // función que recibe los datos
                            function (data) {
                                // convertir el json a objeto de javascript
                                var obj = JSON.parse(data);
                                controlCambioAll.printTable(obj);
                            }
                    );
                },
        printTable: function (data) {
            // nombramos la variable para la tabla y llamamos la configuiracion que se encuentra en /assets/js/modules/helper.js
            controlCambioAll.trackChanges_All = $('#trackChanges_All').DataTable(controlCambioAll.configTableHeadquarters(data, [

                {title: "ID OTP", data: "id_ot_padre"},
                {title: "Responsable", data: "nombre_responsable"},
                {title: "Causa", data: "nombre_causa"},
                {title: "N° Control", data: "numero_control"},
                {title: "Fecha Compromiso", data: "fecha_compromiso"},
                {title: "Fecha Programación Inicial", data: "fecha_programacion_inicial"},
                {title: "Nueva Programación", data: "nueva_fecha_programacion"},
                {title: "Narrativa Escalamiento", data: controlCambioAll.getNarrativaTotal},
                {title: "Estado", data: "estado_cc"},
                {title: "Observaciones", data: "observaciones_cc"},
                {title: "Faltantes", data: "faltantes"},
                {title: "En tiem", data: "en_tiempos"},
                {title: "Creada", data: "fecha_creacion_cc"},
            ]));
        },
        // Datos de configuracion del datatable
        configTableHeadquarters: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                    $('#trackChanges_All  tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });

                    var r = $('#trackChanges_All tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#trackChanges_All thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#trackChanges_All').DataTable();

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
                "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json",
                },
                dom: 'Blfrtip',
                buttons: [
                    {
                        text: 'Excel <span class="fa fa-file-excel-o"></span>',
                        className: 'btn-cami_cool',
                        extend: 'excel',
                        title: 'ZOLID EXCEL',
                        filename: 'zolid ' + fecha_actual
                    },
                    {
                        text: 'Imprimir <span class="fa fa-print"></span>',
                        className: 'btn-cami_cool',
                        extend: 'print',
                        title: 'Reporte Zolid',
                    }
                ],
                select: true,

                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

                columnDefs: [{
                        // targets: -1,
                        // visible: false,
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[1, 'desc']],
                drawCallback: onDraw
            }
        },
        
        // observacion con funcion de mostrar mas
        getNarrativaTotal: function (obj) {
            // console.log(obj);
            if (typeof obj.narrativa_escalamiento == 'string') {
                var array_cadena = obj.narrativa_escalamiento.split(" ");
                var cadena = "";
                if (array_cadena.length > 10) {

                    for (var i = 0; i < 10; i++) {
                        cadena += array_cadena[i] + " ";
                    }


                    // console.log("cadena", cadena);

                    return `<div class="tooltipo">${cadena} <img class="rigth" style="width:15px; margin-left:96%;" src="${baseurl}/assets/images/plus.png">
                              <span class="tooltiptext">${obj.narrativa_escalamiento}</span>
                            </div>
                            `;

                }
            }
            return obj.narrativa_escalamiento;
        },
   
    };
    controlCambioAll.init();
});




// subir archivos
$(function () {
    upload = {
        init: function () {
            upload.events();
        },

        //Eventos de la ventana.
        events: function () {
          $("#upFile").on("click", upload.clic_on_button);
          $("#getFile").on("change", upload.style_icon);
          $("#clArchivo").on("click", upload.clArchivo);
          $("form").on("submit", upload.submit_form);
          $('#getFile').on("change", upload.get_Name);
          $('#trackChanges_Office').on("click", 'a.btn_file', upload.show_mdl_file);
        },
        clic_on_button: function (){
          $('#getFile').click();
          return false;
        },
        style_icon: function () {
         $("#upFile").removeClass("btn-light");
          $("#upFile").addClass("btn-primary");
          $("#ico-btn-file").removeClass("fa-upload");
          $("#ico-btn-file").addClass("fa-check");
         $("#upFile").attr('disabled', true);
          
            return false;
        },
        clArchivo: function(){
          $("#upFile").addClass("btn-light");
          $("#upFile").removeClass("btn-primary");
         $("#ico-btn-file").addClass("fa-upload");
          $("#ico-btn-file").removeClass("fa-check");
         $("#upFile").attr('disabled', false);
        },
        submit_form: function(e){
          e.preventDefault(); 
             
              var datos = $(this).serializeArray(); //datos serializados
              var archivos = new FormData($("#formArchivos")[0]);

              //agergaremos los datos serializados al objecto archivos
              $.each(datos,function(key,input){
                archivos.append(input.name,input.value);
              });
              
              $.ajax({
               type:'post', 
               url: baseurl+'/Upload/insertFiles' ,
               data:archivos, //enviamos archivos
               contentType:false,
               processData:false
             }).done(function(valor){
               alert(valor);
               // location.reload();  
               
             }).fail(function(data){
                alert("Error");
                
             });
        },
        get_Name: function(){
            var archivo = $('#getFile').val();
            var nombre = archivo.substring(archivo.lastIndexOf("\\")+1); 
            $('#input_file').val(nombre);
        },
        show_mdl_file: function(){
            $('#modal_file').modal('show');
        },
    };
    upload.init();
});