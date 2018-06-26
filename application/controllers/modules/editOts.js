$(function () {
    var ini = {
        timers: [],
        init: function () {
            ini.events();
            ini.listVmAssigned();
        },
        //Eventos de la ventana.
        events: function () {
            //Al darle clic a una fila llama la funcion onClickTrTablaEditOts
            $('#tablaEditOts').on('click', 'tr', ini.onClickTrTablaEditOts);
            $('#k_id_estado_ot').on('change', ini.onChangeTextStateOt);
            $('#btnUpdOt').on('click', ini.onSubmitForm);
        },
        onSubmitForm: function (e) {
        app.stopEvent(e);
        var form = $(this);
//        dom.confirmar("¿Está seguro que desea escalar el ticket?", function () {
            dom.submitDirect($('#formModal'), function (response) {
                if (response.code > 0) {
                    swal("Guardado", "Se guardaron los cambios exitosamente", "success").then(function () {
                            $('#modalEditTicket').modal('hide');
                        });
                } else {
                    swal("Error", "Lo sentimos se ha producido un error", "error");
                }
            });
//        }, function () {
//            swal("Cancelado", "Se ha cancelado la acción", "error");
//        });
    },
        // Capturo los valores de la fila a la que le doy clic
        onChangeTextStateOt: function () {
            var otEstado = $("#k_id_estado_ot option:selected").text().replace('_', '.');
            $('#estado_orden_trabajo_hija').val(otEstado);
        },
        onClickTrTablaEditOts: function () {
            var tr = $(this);
            ini.tr = tr;
            if (ini.tablaEditOts) {
                var registro = ini.tablaEditOts.row(tr).data();
                //si selecciona el header de la tabla no se muestre el modal
                if (registro != undefined) {
                    ini.modalEditar(registro);
                }
            }

        },
        //llama el modal
        modalEditar: function (registro) {
            ini.onChangeTextStateOt;
            $('#k_id_register').val(registro.k_id_register);
            $('#id_cliente_onyx').val(registro.id_cliente_onyx);
            $('#nombre_cliente').val(registro.nombre_cliente);
            $('#grupo_objetivo').val(registro.grupo_objetivo);
            $('#segmento').val(registro.segmento);
            $('#nivel_atencion').val(registro.nivel_atencion);
            $('#ciudad').val(registro.ciudad);
            $('#departamento').val(registro.departamento);
            $('#grupo').val(registro.grupo);
            $('#consultor_comercial').val(registro.consultor_comercial);
            $('#grupo2').val(registro.grupo2);
            $('#consultor_postventa').val(registro.consultor_postventa);
            $('#proy_instalacion').val(registro.proy_instalacion);
            $('#ing_responsable').val(registro.ing_responsable);
            $('#id_enlace').val(registro.id_enlace);
            $('#alias_enlace').val(registro.alias_enlace);
            $('#orden_trabajo').val(registro.orden_trabajo);
            $('#nro_ot_onyx').val(registro.nro_ot_onyx);
            $('#servicio').val(registro.servicio);
            $('#familia').val(registro.familia);
            $('#producto').val(registro.producto);
            $('#fecha_creacion').val(registro.fecha_creacion);
            $('#tiempo_incidente').val(registro.tiempo_incidente);
            $('#estado_orden_trabajo').val(registro.estado_orden_trabajo);
            $('#tiempo_estado').val(registro.tiempo_estado);
            $('#ano_ingreso_estado').val(registro.ano_ingreso_estado);
            $('#mes_ngreso_estado').val(registro.mes_ngreso_estado);
            $('#fecha_ingreso_estado').val(registro.fecha_ingreso_estado);
            $('#usuario_asignado').val(registro.usuario_asignado);
            $('#grupo_asignado').val(registro.grupo_asignado);
            $('#ingeniero_provisioning').val(registro.ingeniero_provisioning);
            $('#cargo_arriendo').val(registro.cargo_arriendo);
            $('#cargo_mensual').val(registro.cargo_mensual);
            $('#monto_moneda_local_arriendo').val(registro.monto_moneda_local_arriendo);
            $('#monto_moneda_local_cargo_mensual').val(registro.monto_moneda_local_cargo_mensual);
            $('#cargo_obra_civil').val(registro.cargo_obra_civil);
            $('#descripcion').val(registro.descripcion);
            $('#direccion_origen').val(registro.direccion_origen);
            $('#ciudad_incidente').val(registro.ciudad_incidente);
            $('#direccion_destino').val(registro.direccion_destino);
            $('#ciudad_incidente3').val(registro.ciudad_incidente3);
            $('#fecha_compromiso').val(registro.fecha_compromiso);
            $('#fecha_programacion').val(registro.fecha_programacion);
            $('#fecha_realizacion').val(registro.fecha_realizacion);
            $('#resolucion_1').val(registro.resolucion_1);
            $('#resolucion_2').val(registro.resolucion_2);
            $('#resolucion_3').val(registro.resolucion_3);
            $('#resolucion_4').val(registro.resolucion_4);
            $('#fecha_creacion_ot_hija').val(registro.fecha_creacion_ot_hija);
            $('#proveedor_ultima_milla').val(registro.proveedor_ultima_milla);
            $('#usuario_asignado4').val(registro.usuario_asignado4);
            $('#resolucion_15').val(registro.resolucion_15);
            $('#resolucion_26').val(registro.resolucion_26);
            $('#resolucion_37').val(registro.resolucion_37);
            $('#resolucion_48').val(registro.resolucion_48);
            $('#ot_hija').val(registro.ot_hija);
            $('#estado_orden_trabajo_hija').val(registro.estado_orden_trabajo_hija);
            $('#fec_actualizacion_onyx_hija').val(registro.fec_actualizacion_onyx_hija);
            $('#k_id_estado_ot option').each(function () {
                $(this).remove();
            });
            for (var j = 0; j < estadosOts.data.length; j++) {
                if (estadosOts.data[j].k_id_tipo == registro.k_id_tipo) {
                    $('#k_id_estado_ot').append($('<option>', {
                        value: estadosOts.data[j].k_id_estado_ot,
                        text: estadosOts.data[j].n_name_estado_ot.replace('.', '_')
                    }));
                }
            }
            $("#k_id_estado_ot option:contains('" + registro.estado_orden_trabajo_hija.replace('.', '_') + "')").attr("selected", true);
            //mostrar modal
            $('#modalEditTicket').modal('show');
        },
        /**
         * Listará las actividades de los usuarios que ingresan al sistema...
         */
        listVmAssigned: function () {
            //Invoca fillTable para configurar la TABLA.
            // ini.fillTable([]);
            //Realiza la petición AJAX para traer los datos...
            var alert = dom.printAlert('Consultando registros, por favor espere.', 'loading', $('#principalAlert'));
            app.post('OtHija/getOtsAssigned')
                    .complete(function () {
                        alert.hide();
                        $('.contentPrincipal').removeClass('hidden');
                    })
                    .success(function (response) {
//                        console.log(response);
                        if (app.successResponse(response)) {
                            ini.fillTable(response.data);
                        } else {
                            ini.fillTable([]);
                        }
                    }).error(function (e) {
                console.error(e);
            }).send();
        },
        //Temporalmente...
        fillNA: function () {
            return "N/A";
        },
        fillTable: function (data) {
            if (ini.tablaEditOts) {
                dom.refreshTable(ini.tablaEditOts, data);
                return;
            }
            ini.tablaEditOts = $('#tablaEditOts').DataTable(dom.configTable(data,
                    [
                        {title: "Id Cliente Onyx", data: "id_cliente_onyx"},
                        {title: "Nombre Cliente", data: "nombre_cliente"},
                        {title: "Fecha Compromiso", data: "fecha_compromiso"},
                        {title: "Fecha Programación", data: "fecha_programacion"},
                        {title: "Id Orden Trabajo Hija", data: "id_orden_trabajo_hija"},
                        {title: "Ot Hija", data: "ot_hija"},
                        {title: "Estado Orden Trabajo Hija", data: "estado_orden_trabajo_hija"},
//                        {title: "Dias", data: "n_days"},
                    ],
                    ));
        }
    };

    ini.init();
});