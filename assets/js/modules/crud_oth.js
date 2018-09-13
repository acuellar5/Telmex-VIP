// *******************************************TABLAS QUE MUESTRA LA CREACION DE OTH***************************

$(function(){
        creation_oth = {
        init: function () {
            creation_oth.events();
            creation_oth.getListNewOt();
         
        },
          //Eventos de la ventana.
        events: function () {
            // al darle clic al boton crear ot
            $('#btn_new_ot').on('click', creation_oth.showModalNewOtp); 
        },

        showModalNewOtp:function(){
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

                    {title: "ID OT", data: "id_orden_trabajo_hija"},
                    {title: "ID OTP", data: "nro_ot_onyx"},
                    {title: "Estado", data: "estado_orden_trabajo_hija"},
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

        getButtonsNewOTH: function (obj) {
            // return "<a class='ver-mail btn_datatable_cami'><span class='glyphicon glyphicon-print'></span></a>";
            var button = '<div class="btn-group" style="display: inline-flex;">';
            // Boton para editar las ots
            button ='<a href="" target="_blank" class="btn btn-default btn-xs btn_datatable_cami" title="Editar OT"><span class="glyphicon glyphicon-edit"></span></a>';
            

            return button;

        },
    };
    creation_oth.init();
});

