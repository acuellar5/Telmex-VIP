// *******************************************TABLAS de OT PADRE ***************************

$(function(){
        vista = {
        init: function () {
            vista.events();
            vista.getListOtsOtPadre();
         
        },
          //Eventos de la ventana.
        events: function () {
                        
        },
        getListOtsOtPadre: function(){
            //metodo ajax (post)
            $.post( baseurl + '/OtPadre/getListOtsOtPadre', 
                {
                    //parametros
                    
                },
                // funcion que recibe los datos 
                function(data) {
                    // convertir el json a objeto de javascript
                    var obj = JSON.parse(data);
                    // s
                    vista.printTable(obj); 
                }
            );
        },  
        printTable: function(data){
            // nombramos la variable para la tabla y llamamos la configuiracion
            vista.tablePorject = $('#table_otPadreList').DataTable(vista.configTable(data, [

                    {title: "Nombre Cliente", data: "n_nombre_cliente"},
                    {title: "Tipo", data: "tipo_ot_padre"},
                    {title: "Servicio", data: "servicio"},
                    {title: "Estado OT Padre", data: "estado_orden_trabajo"},
                    {title: "Fecha Programación", data: "fecha_programacion"},
                    {title: "Fecha Compromiso", data: "fecha_compromiso"},
                    {title: "Fecha Creación", data: "fecha_creacion"},
                    {title: "Ingeniero", data: "ingeniero"},                   
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
              order: [[3, 'asc']],
              drawCallback: onDraw
            }
        },
    };
    vista.init();
});
