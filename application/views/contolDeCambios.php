
<!--*********************  Modulo de pestañas para control de cambios  *********************-->
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#track_changes_office">Sedes</a></li>
    <li class=""><a data-toggle="tab" href="#track_changes_OTP">OTP</a></li>
    <li class=""><a data-toggle="tab" href="#track_changes_OTPAll">Control de Cambios</a></li>
</ul>


<!--*********************  Contendio de la pestaña de control de cambios  *********************-->
<div class="tab-content" id=" ">
	<!--*********************  Contendio de la pestaña OTP por sedes *********************-->
    <div id="track_changes_office" class="tab-pane fade in active">
        <h3>Sedes</h3>
        <table id="trackChanges_Office" class="table table-hover table-bordered table-striped dataTable_camilo">            
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th width="1%"></th>
                    <th></th>                    
                </tr>
            </tfoot>
        </table>
    </div>

    <!--*********************  Contendio de la pestaña de OTP *********************-->
    <div id="track_changes_OTP" class="tab-pane fade">
        <h3>OTP</h3>
        <table id="trackChanges_OTP" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th width="1%"></th>
                    <th></th>                    
                </tr>
            </tfoot>
        </table>
    </div>


    <!--*********************  Contendio de la pestaña de Control de Cambio *********************-->
    <div id="track_changes_OTPAll" class="tab-pane fade">
        <h3>Control de Cambio</h3>
        <table id="trackChanges_All" class="table table-hover table-bordered table-striped dataTable_camilo f-s-10" width="100%">
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>              
                    <th></th>              
                    <th></th>              
                </tr>
            </tfoot>
        </table>
    </div>
</div>

</div>

<!-- ==============================================MODAL FORMULARIO + LOG ==============================================-->
<div id="mdl-control_cambios" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h3 class="modal-title" id="myModalLabel">    Orden Ot Hija N <label id="id_ot_modal"></label></h3>
            </div>
            <div class="modal-body">
                <!--*********************  MODULO PESTAÑAS  *********************-->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#form">Formulario</a></li>
                    <li class=""><a data-toggle="tab" href="#log_otp">Hitorial <span class="badge badge_cami" id="bdg_historial">...</span></a></li>
                </ul>
                
                <!--*********************  CONTENIDO PESTAÑAS  *********************-->
                <div class="tab-content">
                
                    <div id="form" class="tab-pane fade in active">
                        <h3>Nuevo Control de Cambio</h3>

                          <form class="well form-horizontal" id="formModal" action="<?= URL::to("sede/insert_control") ?>"  method="post">
                            <fieldset>
                              <div class="widget bg_white m-t-25 display-block">
                                <h2 class="h4 mp clr-98c2d8">
                                  <i class="fa fa-fw fa-question-circle"></i>&nbsp;&nbsp; General
                                </h2>
                                <fieldset class="col-md-6 control-label">
                                  <!-- valores ocultos -->
                                  <input type="hidden" id="id_sede" name="id_sede" value="">

                                  <div class="form-group">
                                    <label for="id_ot_padre" class="col-md-3 control-label">otp:</label>
                                    <div class="col-md-8 selectContainer">
                                      <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-braille" aria-hidden="true"></i></span>
                                        <input name="id_ot_padre" id="id_ot_padre" class="form-control" type="text" readonly="true">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="n_nombre_cliente" class="col-md-3 control-label">Cliente:</label>
                                    <div class="col-md-8 selectContainer">
                                      <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                                        <input name="n_nombre_cliente" id="n_nombre_cliente" class="form-control" type="text" disabled="true">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="numero_control" class="col-md-3 control-label">N° control:</label>
                                    <div class="col-md-8 selectContainer">
                                      <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-contao" aria-hidden="true"></i></span>
                                        <input name="numero_control" id="numero_control" class="form-control" type="text" placeholder="Numero de control" readonly >
                                      </div>
                                    </div>
                                  </div>
                                </fieldset>
                                <!--  fin seccion izquierda form-->
                                <!--  inicio seccion derecha form-->
                                <fieldset>

                                  <div class="form-group">
                                    <label for="id_responsable" class="col-md-3 control-label">Responsable CC:</label>
                                    <div class="col-md-8 selectContainer">
                                      <div class="input-group">
                                        <span class="input-group-addon" id="statusColor"><i class="fa fa-street-view" aria-hidden="true"></i></span>
                                        <select name="id_responsable" id="id_responsable" class="form-control" required>
                                          <option value="">Seleccione</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                  
                                  <div class="form-group">
                                    <label for="id_causa" class="col-md-3 control-label">Causa CC:</label>
                                    <div class="col-md-8 selectContainer">
                                      <div class="input-group">
                                        <span class="input-group-addon" id="statusColor"><i class="fa fa-th-list" aria-hidden="true"></i></span>
                                        <select name="id_causa" id="id_causa" class="form-control" required>
                                          <option value="">Seleccione</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="fecha_compromiso" class="col-md-3 control-label">Compromiso:</label>
                                    <div class="col-md-8 selectContainer">
                                      <div class="input-group">
                                        <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                        <input name="fecha_compromiso" id="fecha_compromiso" class="form-control" type="date" required>
                                      </div>
                                    </div>
                                  </div>

                                </fieldset>
                                <!--  fin seccion derecha form---->
                              </div>

                              <div class="widget bg_white m-t-25 display-block">
                         
                                <fieldset class="col-md-6 control-label">
                                  <div class="form-group">
                                    <label for="fecha_programacion_inicial" class="col-md-3 control-label">Programación Inicial:</label>
                                    <div class="col-md-8 selectContainer">
                                      <div class="input-group">
                                        <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                        <input name="fecha_programacion_inicial" id="fecha_programacion_inicial" class="form-control" type="date" required>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="nueva_fecha_programacion" class="col-md-3 control-label">Nueva Programación:</label>
                                    <div class="col-md-8 selectContainer">
                                      <div class="input-group">
                                        <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
                                        <input name="nueva_fecha_programacion" id="nueva_fecha_programacion" class="form-control" type="date" required>
                                      </div>
                                    </div>
                                  </div>
                                </fieldset>
                                <!--  fin seccion izquierda form---->

                                <!-- inicio seccion derecha form-- -->
                                <fieldset>
                                  <div class="form-group">
                                    <label for="estado_cc" class="col-md-3 control-label">Estado:</label>
                                    <div class="col-md-8 selectContainer">
                                      <div class="input-group">
                                        <span class="input-group-addon" id="statusColor"><i class="fa fa-list" aria-hidden="true"></i></span>
                                        <select name="estado_cc" id="estado_cc" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <option value="NO INICIADO">NO INICIADO</option>
                                            <option value="EJECUTADO">EJECUTADO</option>
                                            <option value="RECHAZADO">RECHAZADO</option>
                                            <option value="PTE. CORRECCION">PTE. CORRECCION</option>
                                            <option value="ESCALADO CLARO">ESCALADO CLARO</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                <!-- FIN REQUERIDOS -->

                                  <div class="form-group">
                                    <label for="observaciones_cc" class="col-md-3 control-label">Observaciones:</label>
                                    <div class="col-md-8 selectContainer">
                                      <div class="input-group">
                                        <span class="input-group-addon" id="statusColor"><i class="fa fa-list" aria-hidden="true"></i></span>
                                        <select name="observaciones_cc" id="observaciones_cc" class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="pte- correccion -se requiere fecha de finalización del pendiente para ajustar">pte- correccion -se requiere fecha de finalización del pendiente para ajustar</option>
                                            <option value="cc- rechazado - sin gestion del ing de es">cc- rechazado - sin gestion del ing de es</option>
                                            <option value="cc- rechazado - corrección no realizada en tiempos">cc- rechazado - corrección no realizada en tiempos</option>
                                            <option value="cc- rechazado - linea de escalamiento fuera de tiempo">cc- rechazado - linea de escalamiento fuera de tiempo</option>
                                            <option value="cc- rechazado - causa no aplica debe ser por cliente">cc- rechazado - causa no aplica debe ser por cliente</option>
                                            <option value="cc- rechazado - tipificación no aplica deacuerdo a la narraiva del escalamiento">cc- rechazado - tipificación no aplica deacuerdo a la narraiva del escalamiento</option>
                                            <option value="cc- rechazado - ot en sia - no requiere cc">cc- rechazado - ot en sia - no requiere cc</option>
                                            <option value="cc- rechazado - se solicitan las mismas fechas de cc anterior">cc- rechazado - se solicitan las mismas fechas de cc anterior</option>
                                            <option value="cc- rechazado - sin linea de escalamiento">cc- rechazado - sin linea de escalamiento</option>
                                            <option value="cc- rechazado - cc duplicado">cc- rechazado - cc duplicado</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </fieldset>
                              </div>

                              <div class="widget bg_white m-t-25 display-block col-md-12 p-r-10pc">
                                <h2 class="h4 mp clr-98c2d8">
                                  <i class="fa fa-fw fa-check"></i>&nbsp;&nbsp; Faltantes
                                </h2>
                                
                                <fieldset class="col-md-6 control-label">
                                    <div class="col-md-6">
                                        <div class="form-check check_cami">
                                            <label>UM
                                                <input id="UM" type="checkbox" name="faltantes[]" value="UM"> <span class="label-text"></span>
                                            </label>
                                        </div>
                                        <div class="form-check check_cami">
                                            <label>CT
                                                <input id="CT" type="checkbox" name="faltantes[]" value="CT"> <span class="label-text"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check check_cami">
                                            <label>Configuración
                                                <input id="Configuración" type="checkbox" name="faltantes[]" value="configuracion"> <span class="label-text"></span>
                                            </label>
                                        </div>
                                        <div class="form-check check_cami">
                                            <label>Equipos
                                                <input id="Equipos" type="checkbox" name="faltantes[]" value="equipos"> <span class="label-text"></span>
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--  fin seccion izquierda form---->

                                <!--  inicio seccion derecha form---->
                                <fieldset class="col-md-6 control-label">
                                    <div class="col-md-4">
                                        <div class="form-check check_cami">
                                            <label>PDT
                                                <input id="PDT" type="checkbox" name="faltantes[]" value="PDT"> <span class="label-text"></span>
                                            </label>
                                        </div>
                                        <div class="form-check check_cami">
                                            <label>Incump f
                                                <input id="Incump fecha" type="checkbox" name="faltantes[]" value="incumplimiento_fecha"> <span class="label-text"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check check_cami">
                                            <label>ES
                                                <input id="ES" type="checkbox" name="faltantes[]" value="ES"> <span class="label-text"></span>
                                            </label>
                                        </div>
                                        <div class="form-check check_cami">
                                            <label>a SIAO
                                                <input id="a SIAO" type="checkbox" name="faltantes[]" value="paso_a_SIAO"> <span class="label-text"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check check_cami">
                                            <label>cupos sat
                                                <input id="cupos saturación" type="checkbox" name="faltantes[]" value="cupos_saturacion"> <span class="label-text"></span>
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                              </div>

                              <div class="widget bg_white m-t-25 display-block col-md-12">
                                <fieldset class="col-md-2 control-label widget m-r-20">
                                     <b>¿en tiempos?</b>
                                    <input type="radio" name="en_tiempos" value="si" id="radio-one" class="form-radio" checked><label for="radio-one">SI</label>
                                    <input type="radio" name="en_tiempos" value="no" id="radio-one" class="form-radio"><label for="radio-one">NO</label>
                                </fieldset>

                                <fieldset class="col-md-19 widget control-label">
                                    <!--********************* TEXT AREA *********************-->
                                    <div class="form-group">
                                        <label for="narrativa_escalamiento" class="col-md-3 control-label">Narrativa de escalamiento:</label>
                                        <div class="col-md-9 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                                                <textarea class="form-control" name="narrativa_escalamiento" id="narrativa_escalamiento" rows="2" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </fieldset>
                              </div>
                            </fieldset>
                            <center >
                                <input type="submit" name="" value="guardar" class="btn-cami_cool m-t-20">
                            </center>
                          </form>

                    </div>
                    
                    <!-- *************************INICIO SEGUNDA PESTAÑA************************* -->
                    <div id="log_otp" class="tab-pane fade">
                        <h3>Hitorial</h3>
                        <table id="tabla_Historial" class='table table-hover table-bordered table-striped dataTable_camilo' width="100%">
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default cerrar" id="mbtnCerrarModal" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= URL::to("assets/plugins/sweetalert2/sweetalert2.all.js") ?>"></script>
<?php 
    $correcto = $this->session->flashdata('ok');
    if ($correcto) {  ?>
        <script>
            swal('Correcto','se inserto Nuevo control de cambios', 'success');

        </script>
<?php } ?>








<div id="modal_file" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
        <h3 class="modal-title" id="modal_title">Evidencias de la sede <strong id="title_sede"></strong></h3>
      </div>
      <div class="modal-body">
          <br>

          <form  autocomplete="off" class="form-inline"  id="formArchivos" enctype="multipart/form-data">
            <center class="div_upload_files">
              <label>Nombre del documento: </label>
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-file" aria-hidden="true"></i>
                </span>
                <input type="hidden" name="mdl_sede" id="mdl_sede" value="">
                <input type="text" id="input_file" name="nombre_archivo" placeholder="Nombre del documento" class="form-control" required="required"/ readonly>
              </div>
              <button class="btn btn-light btn-sm" id="upFile"><i class="fa fa-upload" id="ico-btn-file" aria-hidden="true"></i></button>
              <input type="file" name="archivo" id="getFile" class="hidden"  required="required" accept="*" /><br><br>
              <input type="submit" form="formArchivos" id="smtArchivo" disabled class="btn btn-success btn-sm" value="Agregar" />
              <input type="button" id="clArchivo" class="btn btn-danger btn-sm" value="Limpiar" /><br />
            </center>
          </form>
          <br><br>
        
          <table id="tabla-archivos" class="dataTable_camilo  table-bordered table_files">
            <thead>
              <tr>
                <th class="bg-primary">Descripción del archivo adjunto</th>
                <th class="text-center bg-primary">Acciones</th>
              </tr>
            </thead>
            <tbody>
                
            </tbody>
          </table>
          <br>

      </div>
      <div class="modal-footer">
        <input type="button" data-dismiss="modal" class="btn btn-default btn-sm" value="Cancelar" /><br />
      </div>
    </div>
  </div>
</div>







<script>
    var responsable_list = <?= json_encode($responsable) ?>;
    var causa_list = <?= json_encode($causa) ?>;
</script>
