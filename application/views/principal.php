<?php if (Auth::user()->n_project == 'Gestion') { ?>
    <!--        <div>
                <script type='text/javascript' src='http://181.49.46.6/javascripts/api/viz_v1.js'></script><div class='tableauPlaceholder' style='width: 100%; height: 619px;'><object class='tableauViz' width='100%' height='619' style='display:none;'><param name='host_url' value='http%3A%2F%2F181.49.46.6%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='TVIPInstalaciones&#47;EstadodeOTs' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='showAppBanner' value='false' /><param name='filter' value='iframeSizedToWindow=true' /></object></div>
            </div>-->
    <div class="col col-md-6" style="background: red; height: 300px;"></div>
    <div class="col col-md-6" style="background: blue; height: 300px;"></div>
    <div class="col col-md-12">
        <h1>Resumen</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ot Hija</th>
                    <th>Plan de trabajo</th>
                    <th>En Tiempos</th>
                    <th>Fuera de tiempos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                </tr>
                <tr>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                </tr>
                <tr>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                    <td>...</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col col-md-12">
        <h1>Detalles</h1>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#fueraTiempos">Fuera de tiempos</a></li>
            <li class=""><a data-toggle="tab" href="#enTiempos">En Tiempos</a></li>
            <li class=""><a data-toggle="tab" href="#todo">Todo</a></li>
        </ul>
        <div id="fueraTiempos" class="tab-pane fade">
            <h3>Fuera de tiempos</h3>
            <table id="tablaFueraTiempos" class="table table-hover table-striped dataTable_camilo" width="100%"></table>
        </div>
        <div id="enTiempos" class="tab-pane fade">
            <h3>En Tiempos</h3>
            <table id="tablaEnTiempos" class="table table-hover table-striped dataTable_camilo" width="100%"></table>
        </div>
        <div id="todo" class="tab-pane fade">
            <h3>Todo</h3>
            <table id="tablaTodo" class="table table-hover table-striped dataTable_camilo" width="100%"></table>
        </div>
    </div>
    <?php
}
if (Auth::user()->n_project == 'Implementacion') {
    ?>
    <!--Header section  -->
    <div class="css_imagen8" style="width: 100%; height: 91%; padding: 0 !important; margin: 0; top: 53px; left: 0; right: 0; position: absolute;">
        <img  style="width: 100%; height: 100%;" src="<?= URL::to('assets/img/img8.png') ?>">
    </div>
    <div class="col-md-9 col-sm-9">
        <div style="height: 400px;"></div>
        <h1 class="head-main">&nbsp;ZTE</h1>
        <span class="head-sub-main">Implementación de servicios -  </span>
        <img class="m-b-25" src="<?= URL::to('assets/img/logoClaro.png') ?>" width="100"/>
        <div class="head-last"><!--texto aca--> </div>
    </div>

<?php } ?>

<!-- ***************************************MODAL DE DETALLE ***************************************************************** -->
<div id="Modal_detalle" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" >
    <div class="col-md-12">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div>
                <div class="modal-body">
                    <form class="well form-horizontal" id="formModal_detalle" action=""  method="post">
                        <fieldset>
                            <!-- PRIMERA SESSION -->
                            <fieldset class="col-md-3 sessionmodal"style="margin-right: 3px;">

                                <div class="form-group col-md-12">
                                    <label for="id_cliente_onyx" class="col-md-7 control-label">ID cliente onyx: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            
                                            <input name="k_id_estado_ot" id="mdl_k_id_estado_ot" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                 </div> 

                                <div class="form-group col-md-12">
                                    <label for="nombre_cliente" class="col-md-7 control-label">Nombre cliente: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                           
                                            <input name="nombre_cliente" id="mdl_nombre_cliente" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="grupo_objetivo" class="col-md-7 control-label">Grupo objetivo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <input name="grupo_objetivo" id="mdl_grupo_objetivo" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                 </div> 

                                <div class="form-group col-md-12">
                                    <label for="segmento" class="col-md-5 control-label">Segmento: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                                            <input name="segmento" id="mdl_segmento" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group col-md-12">
                                    <label for="nivel_atencion" class="col-md-7 control-label">Nivel atención: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                                            <input name="nivel_atencion" id="mdl_nivel_atencion" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                 </div> 

                                <div class="form-group col-md-12">
                                    <label for="ciudad" class="col-md-7 control-label">Ciudad: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                            <input name="ciudad" id="mdl_ciudad" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="departamento" class="col-md-7 control-label">Departamento: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                            <input name="departamento" id="mdl_departamento" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                 </div> 

                                <div class="form-group col-md-12">
                                    <label for="grupo" class="col-md-7 control-label">Grupo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-equalizer"></i></span>
                                            <input name="grupo" id="mdl_grupo" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="consultor_comercial" class="col-md-7 control-label">Consultor Comercial: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                            <input name="consultor_comercial" id="mdl_consultor_comercial" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                 </div> 

                                <div class="form-group col-md-12">
                                    <label for="grupo2" class="col-md-7 control-label">Grupo 2: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                                            <input name="grupo2" id="mdl_grupo2" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="consultor_postventa" class="col-md-7 control-label">Consultor Postventa: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                            <input name="consultor_postventa" id="mdl_consultor_postventa   " class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="proy_instalacion" class="col-md-7 control-label">Proy Instalación: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                                            <input name="proy_instalacion" id="mdl_proy_instalacion" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="ing_responsable" class="col-md-7 control-label">Ing. Responsable: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                           
                                            <input name="ing_responsable" id="mdl_ing_responsable" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                 </div> 

                                <div class="form-group col-md-12">
                                    <label for="id_enlace" class="col-md-7 control-label">ID Enlace: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                                            <input name="id_enlace" id="mdl_id_enlace" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>

                            <!-- SEGUNDA SESSION -->
                            <fieldset class="col-md-3 sessionmodal" style="margin-left: 2px; margin-right: 3px;">
                              <div class="form-group col-md-12">
                                <div class="form-group col-md-12">
                                    <label for="alias_enlace" class="col-md-7 control-label">Alias enlace: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                           
                                            <input name="alias_enlace" id="mdl_alias_enlace" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                 </div> 

                                <div class="form-group col-md-12">
                                    <label for="orden_trabajo" class="col-md-7 control-label">Orden trabajo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                           
                                            <input name="orden_trabajo" id="mdl_orden_trabajo" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nro_ot_onyx" class="col-md-7 control-label">Num. ot onyx: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-record"></i></span>
                                            <input name="nro_ot_onyx" id="mdl_nro_ot_onyx" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                 </div> 

                                <div class="form-group col-md-12">
                                    <label for="servicio" class="col-md-7 control-label">Servicio: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                                            <input name="servicio" id="mdl_servicio" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group col-md-12">
                                    <label for="familia" class="col-md-7 control-label">Familia: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                                            <input name="familia" id="mdl_familia" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                 </div> 

                                <div class="form-group col-md-12">
                                    <label for="producto" class="col-md-7 control-label">Producto: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                            <input name="producto" id="producto" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fecha_creacion" class="col-md-7 control-label">Fecha creación: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                            <input name="fecha_creacion" id="mdl_fecha_creacion" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                 </div> 

                                <div class="form-group col-md-12">
                                    <label for="tiempo_incidente" class="col-md-7 control-label">Tiempo Incidente: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-equalizer"></i></span>
                                            <input name="tiempo_incidente" id="mdl_tiempo_incidente" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="estado_orden_trabajo" class="col-md-7 control-label">Estado Orden Trabajo: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                            <input name="estado_orden_trabajo" id="mdl_estado_orden_trabajo" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                 </div> 

                                <div class="form-group col-md-12">
                                    <label for="tiempo_estado" class="col-md-7 control-label">Tiempo Estado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                                            <input name="tiempo_estado" id="mdl_tiempo_estado" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="ano_ingreso_estado" class="col-md-7 control-label">Año Ingreso Estado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                                            <input name="ano_ingreso_estado" id="mdl_ano_ingreso_estado" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div> 

                                <div class="form-group col-md-12">
                                    <label for="mes_ngreso_estado" class="col-md-7 control-label">Mes Ingreso Estado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                                            <input name="mes_ngreso_estado" id="mdl_mes_ngreso_estado" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="fecha_ingreso_estado" class="col-md-7 control-label">Fecha Ingreso Estado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                           
                                            <input name="fecha_ingreso_estado" id="mdl_fecha_ingreso_estado" class="form-control" minlength="3" type="text" required>
                                        </div>
                                    </div>
                                 </div> 

                                <div class="form-group col-md-12">
                                    <label for="usuario_asignado" class="col-md-7 control-label">Usuario Asignado: &nbsp;</label>
                                    <div class="col-md-12 selectContainer"style="margin-top: 20px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                                            <input name="usuario_asignado" id="mdl_usuario_asignado" class="form-control" minlength="5" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                  
                              </div>  
                            </fieldset>

                            <!-- TERCER SESSION -->
                            <fieldset class="col-md-3">
                              <div class="form-group col-md-12">
                                
                                  
                              </div>  
                            </fieldset>

                            <!-- CUARTA SESSION -->
                            <fieldset class="col-md-3">
                              <div class="form-group col-md-12">
                                <label>H444 </label>
                                  
                              </div>  
                            </fieldset>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

