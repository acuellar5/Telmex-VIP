$(function () {
    var ini = {

        countPrincipal: 1,
        countBackup: 1,
        countPuntoCentral: 1,
        countOtp: 1,
        init: function () {
            ini.events();
        },
        //Eventos de la ventana.
        events: function () {
            $('#btnPrincipal').on('click', ini.showPrincipal);
            $('#markings').on('click', '.addPrincipalCode', ini.addPrincipalCode);
            $('#markings').on('click', '.removeCode', ini.removeCode);
            $('#btnBackup').on('click', ini.showBackup);
            $('#markings').on('click', '.addBackupCode', ini.addBackupCode);
            $('#btnPuntoCentral').on('click', ini.showPuntoCentral);
            $('#markings').on('click', '.addPuntoCentralCode', ini.addPuntoCentralCode);
            $('#btnOtp').on('click', ini.showOtp);
            $('#markings').on('click', '.addOtpCode', ini.addOtpCode);
            $('#btnGenerateMarkings').on('click', ini.generateMarkings);
//            $('#nombre_empresa').on('focusout', ini.showLongNameMessage);
        },
        generateMarkings: function () {
            var name = $('#nombre_empresa').val();
            var transaction = ($("#transaccional").is(':checked')) ? "MPTR " : "IPDP ";
            if (name !== "") {
                ini.generateMarkingsAll('_', '_', '', 'huawei');
                ini.generateMarkingsAll(' - ', ' ', '', 'alcatel');
                ini.generateMarkingsAll(' - ', ' ', transaction, 'interfaz');
                $("#tablaMarcaciones").show();
            } else {
                swal("Recuerde", "Que el nombre de la empresa es obligatorio", "warning");
            }


        },
        generateMarkingsAll: function (principalCodes, separador, prefijo, capa) {
            var BackupCodes = ' ';
            var otpCode = ' ';
            var PuntoCentralCode = '';
            var PuntoDestinoCode = '';
            var nombreEmpresa = (capa == 'huawei') ? $("#nombre_empresa").val().split(" ").join("_").split(".").join("") : $("#nombre_empresa").val();
            var prefijoActual = '';
            var cont = 0;
            var cont2 = 0;
            var difPrefijo = '_';
            var prefijos = [];
            $("input[name='PrincipalCode[]']").each(function (i, item) {
                prefijos[i] = item.value.toUpperCase();
                if (prefijoActual == $(this).val().replace(/[^A-Z a-z]/g, '')) {
                    principalCodes += (cont === 0) ? $(this).val() + ',' : $(this).val().replace(/[^1-9]/g, '') + ',';
                } else {
                    principalCodes += (cont === 0) ? $(this).val() + ',' : '';
                    difPrefijo += $(this).val() + ',';
                    cont++;
                }
                prefijoActual = $(this).val().replace(/[^A-Z a-z]/g, '');
                cont2++;
            });
            $.post(baseurl + "/User/getPrefijo",
                    {
                        pref: prefijos
                    },
                    function (data) {

                        principalCodes = (capa == 'huawei') ? data.huawei_zte : data.alcatel.split(".").join(",").split("_").join("-");
                        $("input[name='BackupCode[]']").each(function () {
                            BackupCodes += $(this).val() + ',';
                        });
                        $("input[name='otpCode[]']").each(function () {
                            otpCode += $(this).val() + ',';
                        });
                        $("input[name='PuntoCentralCode[]']").each(function () {
                            PuntoCentralCode += $(this).val() + ",";
                        });
                        $("input[name='PuntoDestinoCode[]']").each(function () {
                            PuntoDestinoCode += $(this).val() + ",";
                        });

                        var principalCodesCont = $("input[name='PrincipalCode[]']").val();
                        var PuntoCentralCodeCont = $("input[name='PuntoCentralCode[]']").val();
                        var otpCodeCont = $("input[name='otpCode[]']").val();
                        var BackupCodesCont = $("input[name='BackupCode[]']").val();
                        
                        if (principalCodesCont !== "") {
                            var normal = prefijo + nombreEmpresa + ((capa == 'huawei') ? "_" : " - ") + principalCodes;
                            var difPrefijo = nombreEmpresa + ((capa == 'huawei') ? "_" : " - ") + principalCodes;

                            if (BackupCodesCont !== "") {
                                var ppal = prefijo + nombreEmpresa + separador + "PPAL - "  + principalCodes + "(" + BackupCodes.slice(0, -1).trim() + ")";
                                var backup = prefijo + nombreEmpresa + separador + "BACKUP " + principalCodes + ((capa == 'huawei') ? "_" : " - ") + BackupCodes.slice(0, -1).trim();
//                                var ppal = prefijo + nombreEmpresa + ((capa == 'huawei') ? "_" : " - ") + principalCodes;
//                                var backup = prefijo + nombreEmpresa + ((capa == 'huawei') ? "_" : " - ") + principalCodes;
                            }

                            if (otpCodeCont !== "") {
                                var externo = prefijo + nombreEmpresa + separador + "(TE)" + separador + "OT" + separador + otpCode.slice(0, -1).trim() + ((capa == 'huawei') ? "_" : " - ") + principalCodes;
                                var desconexion = prefijo + nombreEmpresa + separador + "(DTSC) " + separador + "OT" + separador + otpCode.slice(0, -1).trim() + principalCodes;
                            }
                            
                            if (otpCodeCont !== "" && BackupCodesCont !== "") {
                                var externoBackup = prefijo + nombreEmpresa + separador + "(TE)" + separador + "OT" + separador + otpCode.slice(0, -1).trim() +  separador + "BACKUP" + separador + principalCodes + ((capa == 'huawei') ? "_" : " - ") + BackupCodes.slice(0, -1).trim();
                            }
                        }

                        if (PuntoCentralCodeCont !== "") {
                            var puntoCentral = prefijo + nombreEmpresa + ((capa == 'huawei') ? "_" : " - ") + ((capa !== 'huawei') ? "'PC" + PuntoDestinoCode.slice(0, -1).replace(/[^0-9]/g, '') + " - " + PuntoCentralCode.slice(0, -1) + "'" : PuntoCentralCode.slice(0, -1));
                        }
                        $("#" + capa + "_normal").val(normal);
                        $("#" + capa + "_ppal").val(((capa !== 'interfaz') ? normal : ppal));
                        $("#" + capa + "_backup").val(((capa !== 'interfaz') ? normal : backup));
                        $("#" + capa + "_externo").val(((capa !== 'interfaz') ? normal : externo));
                        $("#" + capa + "_externoBackup").val(((capa !== 'interfaz') ? normal : externoBackup));
                        $("#" + capa + "_desconexion").val(desconexion);
                        $("#" + capa + "_puntoCentral").val(puntoCentral);
                        $("#" + capa + "_difPrefijo").val(difPrefijo);
//                        console.log(principalCodes);
                    });
        },
        showLongNameMessage: function () {
            var cantLetras = $('#nombre_empresa').val().length;
            if (cantLetras > 20) {
                swal("Lo sentimos", "El nombre de la empresa es muy largo, por favor utilize un acronimo.", "warning").then(function () {
                    $('#nombre_empresa').val('');
                });
            }
        },
        removeCode: function () {
            var btn = $(this);
            var parent = btn.parents('div');
            parent[1].remove();
        },
        showPrincipal: function (e) {
            app.stopEvent(e);
            $(".seccionPrincipal").toggle();
        },
        addPrincipalCode: function () {
            var html = '<div style="margin-left: 186px; width: 100%;" id="group' + ini.countPrincipal + '">'
                    + '<div class="col-sm-8 seccionPrincipal">'
                    + '<input type="text" class="form-control text-transform" name="PrincipalCode[]" placeholder="Principal" maxlength="8" style="margin-top: 10px;">'
                    + '</div>'
                    + '<div class="col-sm-2 seccionPrincipal">'
                    + '<button type="button" class="btn btn-success addPrincipalCode" style="margin: 10px 5px 0px 0px;">+</button>'
                    + '<button type="button" class="btn btn-danger removeCode" style="margin-top: 10px;">-</button>'
                    + '</div>'
                    + '</div>';
            ini.countPrincipal++;
            $("#groupPrincipal").append(html);
        },
        showBackup: function (e) {
            app.stopEvent(e);
            $(".seccionBackup").toggle();
        },
        addBackupCode: function () {
            var html = '<div style="margin-left: 186px; width: 100%;" id="group' + ini.countBackup + '">'
                    + '<div class="col-sm-8 seccionPrincipal">'
                    + '<input type="text" class="form-control text-transform" name="BackupCode[]" placeholder="Backup" maxlength="7" style="margin-top: 10px;">'
                    + '</div>'
                    + '<div class="col-sm-2 seccionPrincipal">'
                    + '<button type="button" class="btn btn-success addBackupCode" style="margin: 10px 5px 0px 0px;">+</button>'
                    + '<button type="button" class="btn btn-danger removeCode" style="margin-top: 10px;">-</button>'
                    + '</div>'
                    + '</div>';
            ini.countBackup++;
            $("#groupBackup").append(html);
        },
        showPuntoCentral: function (e) {
            app.stopEvent(e);
            $(".seccionPuntoCentral").toggle();
        },
        addPuntoCentralCode: function () {
            var html = '<div style="margin-left: 186px; width: 100%;" id="group' + ini.countPuntoCentral + '">'
                    + '<div class="col-sm-4 seccionPrincipal">'
                    + '<input type="text" class="form-control text-transform" name="PuntoDestinoCode[]" placeholder="Punto Destino" maxlength="7" style="margin-top: 10px;">'
                    + '</div>'
                    + '<div class="col-sm-4 seccionPrincipal">'
                    + '<input type="text" class="form-control text-transform" name="PuntoCentralCode[]" placeholder="Punto Central" maxlength="7" style="margin-top: 10px;">'
                    + '</div>'
                    + '<div class="col-sm-2 seccionPrincipal">'
                    + '<button type="button" class="btn btn-success addPuntoCentralCode" style="margin: 10px 5px 0px 0px;">+</button>'
                    + '<button type="button" class="btn btn-danger removeCode" style="margin-top: 10px;">-</button>'
                    + '</div>'
                    + '</div>';
            ini.countPuntoCentral++;
            $("#groupPuntoCentral").append(html);
        },
        showOtp: function (e) {
            app.stopEvent(e);
            $(".seccionOtp").toggle();
        },
        addOtpCode: function () {
            var html = '<div style="margin-left: 186px; width: 100%;" id="group' + ini.countOtp + '">'
                    + '<div class="col-sm-8 seccionOtp">'
                    + '<input type="text" class="form-control text-transform" name="otpCode[]" placeholder="OTP" maxlength="7" style="margin-top: 10px;">'
                    + '</div>'
                    + '<div class="col-sm-2 seccionOtp">'
                    + '<button type="button" class="btn btn-success addOtpCode" style="margin: 10px 5px 0px 0px;">+</button>'
                    + '<button type="button" class="btn btn-danger removeCode" style="margin-top: 10px;">-</button>'
                    + '</div>'
                    + '</div>';
            ini.countOtp++;
            $("#groupOtp").append(html);
        },
        fillNA: function () {
            return "N/A";
        }
    };
    ini.init();
});