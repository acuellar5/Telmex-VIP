// *******************************************TABLAS QUE MUESTRA LA CREACION DE OTH***************************
$(function(){
        creation_oth = {
        init: function () {
            creation_oth.events();
            creation_oth.getListNewOt();
            // creation_oth.showHideTable();
         
        },
          //Eventos de la ventana.
        events: function () {
            // al darle clic al boton crear ot
            $('#btn_new_ot').on('click', creation_oth.showModalNewOtp);
            // calcular estados de oth dependiendo el tipo
            $('#tipo_oth').on('change', creation_oth.getStatusOption);
            // al darle click a editar ot
            $('#oth_new_List').on('click', 'a.edit_ot', creation_oth.showModalEditOT);
        },


        // llena el modal y lo muestra para editar una ot
        showModalEditOT: function(e){
            $('#mdl_form_new_oth').attr('action', baseurl + '/LoadInformation/edit_ot');
            const record = creation_oth.oth_new_List.row($(this).parents('tr')).data();
            $('#tipo_oth').val(record.ot_hija);
            // lenar el select segun ñla opcion
            creation_oth.getStatusOption();
            $('#id_otp').val(record.nro_ot_onyx);
            $('#nombre_cliente').val(record.n_nombre_cliente);
            $('#tipo_otp').val(record.orden_trabajo);
            $('#estado_otp').val(record.estado_orden_trabajo);
            $('#fecha_programacion').val(record.fecha_programacion);
            $('#fecha_compromiso').val(record.fecha_compromiso);
            $('#ing_responsable').val(record.k_id_user);
            $('#id_oth').val(record.id_orden_trabajo_hija);

            setTimeout(function(){
                $('#estado_oth').val(record.estado_orden_trabajo_hija);
            },100);

            $('#modal_new_ot').modal('show');


        },

        // llenar el select de estados oth dependiendo la seleccion de tipo
        getStatusOption: function(e){
            const tipo_sel = $('#tipo_oth').val();
            $.post(baseurl + '/Status/js_ListStatusByType', 
              {
                tipo_sel: tipo_sel
              },
              function(data) {
                var status = JSON.parse(data);

                $('#estado_oth').html("");
                $('#estado_oth').append(`
                    <option value="">Seleccione...</option>
                  `);

                $.each(status, function(i,estado) {
                  $('#estado_oth').append(`
                    <option value="${estado.n_name_estado_ot}">${estado.n_name_estado_ot}</option>
                  `);
                });
            });
        },

        showModalNewOtp:function(){
            // limpiar form
            $("#mdl_form_new_oth")[0].reset();
            $('#mdl_form_new_oth').attr('action', baseurl + '/LoadInformation/create_ot');
            // Mostrar el modal para ingresar una nueva ot
            $('#modal_new_ot').modal('show');

        },
        getListNewOt: function(){
            //metodo ajax (post)
            $.post( baseurl + '/OtHija/c_get_newoth_table', 
                {
                    //parametros
                    //param1: 'value1'//enviar parametros a la funcion de la ruta
                },
                // funcion que recibe los datos (callback)
                function(data) {
                    // convertir el json a objeto de javascript
                    var obj = JSON.parse(data);
                    // s
                    creation_oth.printTable(obj); 
                }
            );
        },  
        printTable: function(data){
            // nombramos la variable para la tabla y llamamos la configuiracion
            creation_oth.oth_new_List = $('#oth_new_List').DataTable(creation_oth.configTable(data, [

                    {title: "ID OTP", data: "nro_ot_onyx"},
                    {title: "Tipo OTP", data: "orden_trabajo"},
                    {title: "Estado OTP", data: "estado_orden_trabajo"},
                    {title: "ID OTH", data: "id_orden_trabajo_hija"},
                    {title: "Tipo OTH", data: "ot_hija"},
                    {title: "Estado OTH", data: "estado_orden_trabajo_hija"},
                    {title: "Nombre Cliente", data: "n_nombre_cliente"},            
                    {title: "Fecha programacion", data: "fecha_programacion"},
                    {title: "Fecha compromiso", data: "fecha_compromiso"},
                    {title: "Ing.Responsable", data: "ingeniero"},
                    {title: "Opc", data: creation_oth.getButtonsNewOTH},
                   
                ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
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
              order: [[1, 'asc']],
              drawCallback: onDraw
            }
        },

        // showHideTable: function (obj) {
        //  $('a.toggle-vis').on( 'click', function (e) {
        //           e.preventDefault();
           
        //           // Get the column API object
        //           var column = oth_new_List.column( $(this).attr('data-column') );
           
        //           // Toggle the visibility
        //           column.visible( ! column.visible() );
        //       } );        
           
        // },

        getButtonsNewOTH: function (obj) {
            // return "<a class='ver-mail btn_datatable_cami'><span class='glyphicon glyphicon-print'></span></a>";
            var button = '<div class="btn-group" style="display: inline-flex;">';
            // Boton para editar las ots
            button ='<a class="btn btn-default btn-xs edit_ot btn_datatable_cami" title="Editar OT"><span class="glyphicon glyphicon-edit"></span></a>';
            

            return button;

        },
    };
    creation_oth.init();
});
