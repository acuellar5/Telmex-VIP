var vista = {
    urlbase: $('body').attr('data-base'),
    exec: false,
    init: function () {
        vista.events();
    },
    events: function () {
        $('#formFileUpload').on('submit', vista.vistaFile);
//        $('#btnUploadFile').on('click', vista.vistaFile);
    },
    vistaFile: function (e) {
        app.stopEvent(e);
        var form = $(this);
        var button = form.find('button');
        var input = form.find('input:file');
        if (input[0].files.length == 0) {
            input.trigger('click');
            return;
        }
        button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Subiendo...');
        button.prop('disabled', true);
        vista.uploadFile(input[0], button);
    },
    onChangeFile: function (e) {
        if (!e) {
            return;
        }
        var input = e.target;
        vista.uploadFile(input);
    },
    uploadFile: function (input, button) {
        app.uploadFile("Graphics/uploadFile", input, ["xlsx"]["xls"])
                .progress(function (progress) {
                    //Plajear barrita de progreso...
                    button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Subiendo (' + progress + ')...');
                })
                .complete(function (response) {
                    button.html('<span class="fa fa-fw fa-spin fa-refresh"></span> Procesando').prop('disabled', false);
                    if (response.code > 0) {
                        swal("Correcto", "Se ha subido correctamente el archivo, haga clic a continuación en el botón ok para iniciar la lectura y carga del archivo que acaba de subir en el sistema.", "success").then(function () {
                            var alert = dom.printAlert('Cargando la información en el sistema, por favor no cierre esta ventana.', 'vistaing', $('#principalAlert'));
                            vista.processData(response.data, alert);
                            $(input).val('');
                            $(input).parent('form').find('p').html('Procesando archivo, por favor no cierre la ventana.');
                        });
                    } else {
                        swal("Error", response.message, "error");
                    }
                })
                .errorExtension(function (file) {
                    swal("Error", "Extención de archivo no permitida, solo se permiten archivos de extención XLSX y XLS", "error");
                })
                .start();
    },
    limit: 1500,
    indexTemp: 0,
    index: 2,
    linesFile: -1,
    actualProcess: null,
    sleepTime: 2000,
    selec: 0,
    getLinesFile: function (data, callback) {
        app.post('Graphics/countLinesFile', {
            file: data.path
        }).success(function (response) {
            console.log(response);
            var v = app.successResponse(response);
            if (v) {
                vista.linesFile = (parseInt(response.data.sheet1));
                callback();
            } else {
                swal("Error", "No hay lineas que procesar en el archivo.", "error");
            }
        }).error(function (error) {
            console.error(error);
        }).send();
    },
    showProgress: function () {
        var progress = $('#progressProcessImportData');
        progress.removeClass('hidden');
        var i = (vista.indexTemp) + 2;
        $('#lblProgressInformation').removeClass('hidden').html((i) + ' de ' + (vista.linesFile - 2) + ' líneas procesadas.');
        var progressValue = Math.round(((i) / (vista.linesFile - 2)) * 100);
        if (progressValue > 100) {
            progressValue = 100;
        }
        $('#btnUploadFile').html('<i class="fa fa-fw fa-spin fa-refresh"></i> Procesando (' + progressValue + '%)');
//        progress.find('.progress-bar').html(progressValue + '%').css('width', progressValue + '%').attr('title', progressValue + '% de progreso.');
    },
    processData: function (data, alert) {
        vista.actualProcess = 1; //Procesando data...
        if (vista.linesFile < 0) {
            vista.getLinesFile(data, function () {
                vista.processData(data, alert);
            });
            return;
        }

        vista.showProgress();
        app.post('Graphics/processData', {
            file: data.path,
            index: vista.index,
            limit: vista.limit
        })
                .complete(function () {
                })
                .success(function (response) {
                    if (response.code == 2) {
                        swal("Importado", "Se ha importado toda la información del archivo correctamente.", "success")
                                .then(function () {
                                    // location.reload();
                                    window.location.href = vista.urlbase + "/Graphics/view_graphics";
                                });
                        return;
                    }
                    var v = app.validResponse(response);
                    if (v) {
                        vista.index += response.data.row;
                        vista.indexTemp += response.data.row;
                        vista.selec += response.data.seleccionados;
                        console.log(vista.selec);
                        window.setTimeout(function () {
                            vista.processData(data, alert);
                        }, vista.sleepTime);
                    } else {
                        swal("Error", "Lo sentimos, no se pudo procesar el archivo que ha subido.", "error");
                    }
                })
                .error(function (e) {
                    swal("Error", "Lo sentimos se ha producido un error inesperado al procesar el archivo que ha subido.", "error");
                })
                .send();
    },
    fillNA: function () {
        return "Indefinido";
    }
};

$(function () {
    vista.init();
});
