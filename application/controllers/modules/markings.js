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
            $('#nombre_empresa').on('focusout', ini.showLongNameMessage);
        },
        generateMarkings: function () {
            ini.generateMarkingsAll('_', '_', '', 'huawei');
            ini.generateMarkingsAll(' - ', ' ', '', 'alcatel');
            ini.generateMarkingsAll(' - ', ' ', 'IPDP ', 'interfaz');
            $("#tablaMarcaciones").show();
        },
        generateMarkingsAll: function (principalCodes, separador, prefijo, capa) {
            var BackupCodes = ' ';
            var otpCode = ' ';
            var PuntoCentralCode = '';
            var nombreEmpresa = (capa == 'huawei') ? $("#nombre_empresa").val().split(" ").join("_") : $("#nombre_empresa").val();
            var prefijoActual = '';
            var x = 0;
            var difPrefijo = '_';
            $("input[name='PrincipalCode[]']").each(function () {
                if (prefijoActual == $(this).val().replace(/[^A-Z a-z]/g, '')) {
                    principalCodes += (x === 0) ? $(this).val() + ',' : $(this).val().replace(/[^1-9]/g, '') + ',';
                } else {
                    principalCodes += (x === 0) ? $(this).val() + ',' : '';
                    difPrefijo += $(this).val() + ',';
                    x++;
                }

                prefijoActual = $(this).val().replace(/[^A-Z a-z]/g, '');
            });
            $("input[name='BackupCode[]']").each(function () {
                BackupCodes += $(this).val() + ',';
            });
            $("input[name='otpCode[]']").each(function () {
                otpCode += $(this).val() + ',';
            });
            $("input[name='PuntoCentralCode[]']").each(function () {
                PuntoCentralCode += "'" + $(this).val() + "',";
            });
            var normal = prefijo + nombreEmpresa + principalCodes.slice(0, -1);
            var ppal = prefijo + nombreEmpresa + separador + "PPAL" + principalCodes.slice(0, -1) + "(" + BackupCodes.slice(0, -1) + ")";
            var backup = prefijo + nombreEmpresa + separador + "BACKUP" + principalCodes.slice(0, -1) + ((capa == 'huawei') ? "_" : " - ") + BackupCodes.slice(0, -1);
            var externo = prefijo + nombreEmpresa + separador + "(TE)" + separador + "OT" + separador + otpCode.slice(0, -1) + principalCodes.slice(0, -1);
            var externoBackup = prefijo + nombreEmpresa + separador + "(TE)" + separador + "OT" + separador + otpCode.slice(0, -1) + separador + "BACKUP" + principalCodes.slice(0, -1) + ((capa == 'huawei') ? "_" : " - ") + BackupCodes.slice(0, -1);
            var desconexion = prefijo + nombreEmpresa + separador + "(DTSC)" + separador + "OT" + separador + otpCode.slice(0, -1) + principalCodes.slice(0, -1);
            var puntoCentral = prefijo + nombreEmpresa + ((capa == 'huawei') ? "_" : " - ") + PuntoCentralCode.slice(0, -1);
            var difPrefijo = nombreEmpresa + difPrefijo.slice(0, -1);
            $("#" + capa + "_normal").val(normal);
            $("#" + capa + "_ppal").val(ppal);
            $("#" + capa + "_backup").val(backup);
            $("#" + capa + "_externo").val(externo);
            $("#" + capa + "_externoBackup").val(externoBackup);
            $("#" + capa + "_desconexion").val(desconexion);
            $("#" + capa + "_puntoCentral").val(puntoCentral);
            $("#" + capa + "_difPrefijo").val(difPrefijo);
        },
        showLongNameMessage: function () {
//            var cantLetras = $('#nombre_empresa').val().length;
//            if (cantLetras > 20) {
//                swal("Lo sentimos", "El nombre de la empresa es muy largo, por favor utilize un acronimo.", "warning").then(function () {
//                    $('#nombre_empresa').val('');
//                });
//            }
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
                    + '<input type="text" class="form-control" name="PrincipalCode[]" placeholder="Principal" style="margin-top: 10px;">'
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
                    + '<input type="text" class="form-control" name="BackupCode[]" placeholder="Backup" style="margin-top: 10px;">'
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
                    + '<div class="col-sm-8 seccionPrincipal">'
                    + '<input type="text" class="form-control" name="PuntoCentralCode[]" placeholder="Punto Central" style="margin-top: 10px;">'
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
                    + '<input type="text" class="form-control" name="otpCode[]" placeholder="OTP" style="margin-top: 10px;">'
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