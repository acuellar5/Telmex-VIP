$(function () {
    cierre = {
        init: function () {
            cierre.events();
            cierre.list_ot();
        },

        //Eventos de la ventana.
        events: function () {
        	$('#tables_cierre').on('click', 'button#btn_check_all', cierre.selectAll);
        	$('#table_selected').on('click', 'img.quitar_fila', cierre.quitarFila);
        	$('#mdl_cierre').on('click', 'button#mdl-cierre-eliminar', cierre.eliminarRegistros);

        },

        // trae las ot 
        list_ot: function(){
            $.post(baseurl + '/cierre_ots/c_getOtsCierre',
            {
                // idTipo: null // parametros que se envian
            },

            function (data) {
            	var obj = JSON.parse(data);
                cierre.printTableCierre(obj);
            });
        },

        printTableCierre: function (data) {
            ///lleno la tabla con los valores enviados
            cierre.tables_cierre = $('#tables_cierre').DataTable(cierre.configTable(data, [
                {title: "Ingeniero", data: "ingeniero"},
                {title: "OTP", data: "k_id_ot_padre"},
                {title: "Cliente", data: "n_nombre_cliente"},
                {title: "Tipo", data: "orden_trabajo"},
                {title: "Servicio", data: "servicio"},
                {title: "Estado OTP", data: "estado_orden_trabajo"},
                {title: "program", data: "fecha_programacion"},
                {title: "comprom", data: "fecha_compromiso"},
                {title: "creación", data: "fecha_creacion"},
                {title: "Lista", data: "lista_observaciones"},
                {title: "Observación", data: "observacion"},
                {title: "<button class='btn_datatable_cami2' title='seleccionar todo' id='btn_check_all' data-check='false'><i class='fa fa-flag-checkered' aria-hidden='true'></i></button>", data: cierre.getButtonsCierre},
            ]));
        },
        // Datos de configuracion del datatable
        configTable: function (data, columns, onDraw) {
            return {
                initComplete: function () {
                	$('#tables_cierre  tfoot th').each(function () {
		                $(this).html('<input type="text" placeholder="Buscar" />');
		            });

                    var r = $('#tables_cierre tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#tables_cierre thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#tables_cierre').DataTable();

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
                    select: {
		                rows: {
		                    _: " <b>Tienes %d seleccionadas</b>",
		                    0: " <b>presiona ctrl y selecciona las filas que necesites</b>",
		                    1: " <b>Solo una fila seleccionada</b>"
		                }
		            }
                },
                dom: 'Blfrtip',
                buttons: [
                    {
                        text: 'Excel <span class="fa fa-file-excel-o"></span>',
                        className: 'btn-cami_cool',
                        extend: 'excel',
                        title: 'ZOLID EXCEL',
                        filename: 'zolid ' + fecha_actual,
                    },
                    {
                        text: 'Imprimir <span class="fa fa-print"></span>',
                        className: 'btn-cami_cool',
                        extend: 'print',
                        title: 'Reporte Zolid',
                    },
                    {
                        text: 'Enrutar <span class="fa fa-code-fork" aria-hidden="true"></span>',
                        className: 'btn-cami_warning',
		                action: cierre.enrutar_otp,
                    },
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
                order: [[7, 'desc']],
                drawCallback: onDraw
            }
        },

        // obtengo los botones 
        getButtonsCierre: function(obj){
            var botones = "<div class='btn-group'>"
                        + "<a class='btn btn-default btn-xs btnoths btn_datatable_cami' title='Ver OTH'><span class='fa fa-fw fa-eye'></span></a>"
                    + "</div>";
            return botones;
        },

        
        // genero el check general
        checkAll: function(obj){
            return '<input type="checkbox" id="all_check">all';
        },

        // enrutar la orden
        enrutar_otp: function(e){
        	// var cosas = cierre.tables_cierre.rows( { selected: true } ).nodes();// los elementos seleccionados
        	// var cosas = cierre.tables_cierre.rows( { selected: true } ).count();// cuantos filas se seleccionaron
        	// table.rows( { selected: true } ).data();
        	let hay_sel = cierre.tables_cierre.rows( { selected: true } ).any();// booleanos q indica si hay algo seleccionado
        	var seleccionadas = cierre.tables_cierre.rows( { selected: true } ).data();// los datos de los elem seleccionados
        	if (hay_sel) {
        		cierre.modalSeleccionadas(seleccionadas);
        		$('#mdl_cierre').modal('show');

        	} else {
        		const toast = swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        toast({
                            type: 'error',
                            title: 'No seleccionaste ninguna fila!'
                        });
        	}

        },

        //
        modalSeleccionadas: function(data){
        	if (cierre.table_selected) {
                var tabla = cierre.table_selected;
                tabla.clear().draw();
                tabla.rows.add(data);
                tabla.columns.adjust().draw();
                return;
            }

        	cierre.table_selected = $('#table_selected').DataTable(cierre.configTableSelect(data, [
                {title: "Ingeniero", data: "ingeniero"},
                {title: "OTP", data: "k_id_ot_padre"},
                {title: "Cliente", data: "n_nombre_cliente"},
                {title: "Tipo", data: "orden_trabajo"},
                {title: "Servicio", data: "servicio"},
                {title: "Estado OTP", data: "estado_orden_trabajo"},
                {title: "Lista", data: "lista_observaciones"},
                {title: "Observación", data: "observacion"},
                {title: "Quitar", data: cierre.getButtonQuitar},

            ]));
            
        },

        configTableSelect: function (data, columns, onDraw) {
            return {
                data: data,
                columns: columns,
                "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json"
                },
                columnDefs: [{
                        defaultContent: "",
                        targets: -1,
                        orderable: false,
                    }],
                order: [[3, 'asc']],
                drawCallback: onDraw
            }
        },

        // selecciona todas las filas de la tabla y  las deselecciona
        selectAll: function(e){
        	if (!$(this).data('check')) {
            	cierre.tables_cierre.rows().select();
        		$(this).data('check', true);
        	} else {
        		$(this).data('check', false);
            	cierre.tables_cierre.rows().deselect();
        	}

        },

        // retorna el boton para quitar registro
        getButtonQuitar: function(obj){
            const button = `<img src="${baseurl}/assets/images/minus.png" alt="quitar" class="quitar_fila"/>`;
            return button;
        },

        // elimina la fila 
        quitarFila: function(e){
            cierre.table_selected.row( $(this).parents('tr') ).remove().draw();
        },

        // Eliminar todos los registros
        eliminarRegistros: function(e){
        	var registro;
        	var e_rows = cierre.table_selected.rows().nodes();
            var rows = cierre.table_selected.rows().data();
            let cont = rows.length;
            let otp = [];
            $.each(rows, function(i, item) {
            	otp.push(item.k_id_ot_padre);
            });

            if (cont > 0) {
            	cierre.confirmDelete(cont, otp);
            }


        },

       // confirmar la eliminacion
       confirmDelete: function(cont, otp, e_rows){
           swal({
            title: "¿Está Seguro?",
            html: `Se eliminaran  <b>'${cont}'</b> registros <br> <b>¿continuar?</b>`,
            type: "question",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#ccc',
            confirmButtonText: 'Sí, Eliminar!',
            cancelButtonText: 'No, Cancelar!',
        })
                .then((result) => {
                    if (result.value) {
                        $.post(baseurl + '/cierre_ots/c_eliminar_registros',
                                {
                                    otp: otp
                                },
                                function (data) {
                                    var obj = JSON.parse(data);
                                    swal('OK!', `Se eliminaron <b>${obj.del_otp}</b> OT Padre y<br> ${obj.del} OT hija de la plataforma.`, 'success'); 
                                    $('#mdl-cierre-cerrar').click();
                                    var seleccionadas = cierre.tables_cierre.rows( { selected: true } ).nodes();
                                    // console.log(seleccionadas);
                                    $.each(seleccionadas, function(i, item) {
                                    	cierre.tables_cierre.row( item ).remove().draw();
                                    });



                                });
                    } else {
                        const toast = swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        toast({
                            type: 'error',
                            title: 'Acción Cancelada'
                        });
                    }
                });
       },



    };
    cierre.init();
});