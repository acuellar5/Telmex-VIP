<div class="container autoheight p-t-20 m-t-20">
    <form class= 'well form-horizontal' id='markings' name='markings'>
        <fieldset>
            <div class="row">
                <div class="col col-md-12 p-t-40">
                    <input type="hidden" value="<?= Auth::getRole() ?>" id="rol">
                    <div class="form-group">
                        <label for="nombre_empresa" class="col-sm-2 control-label">NOMBRE EMPRESA</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-transform" id="nombre_empresa" name="nombre_empresa" placeholder="Nombre Empresa">
                            <div class="checkbox">
                                <label><input type="checkbox" id="transaccional">Transaccional</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">CODIGOS DE SERVICIO</label>
                    </div>
                    <div class="form-group">
                        <button type="button" id="btnPrincipal" class="btn btn-primary col-sm-2 btnMarcaciones">Principal</button>
                        <div id="groupPrincipal">
                            <div class="col-sm-8 seccionPrincipal" style="display: none;">
                                <input type="text" class="form-control text-transform" name="PrincipalCode[]" placeholder="Principal" maxlength="8">
                            </div>
                            <div class="col-sm-2 seccionPrincipal" style="display: none;">
                                <button type="button" class="btn btn-success addPrincipalCode">+</button>
                                <!--<button type="button" class="btn btn-danger" id="removePrincipalCode">-</button>-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" id="btnBackup" class="btn btn-primary col-sm-2 btnMarcaciones">Backup</button>
                        <div id="groupBackup">
                            <div class="col-sm-8 seccionBackup" style="display: none;">
                                <input type="text" class="form-control text-transform" name="BackupCode[]" placeholder="Backup" maxlength="8">
                            </div>
                            <div class="col-sm-2 seccionBackup" style="display: none;">
                                <button type="button" class="btn btn-success addBackupCode">+</button>
                                <!--<button type="button" class="btn btn-danger">-</button>-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" id="btnPuntoCentral" class="btn btn-primary col-sm-2 btnMarcaciones">Punto Central</button>
                        <div id="groupPuntoCentral">
                            <div class="col-sm-4 seccionPuntoCentral" style="display: none;">
                                <input type="text" class="form-control text-transform" name="PuntoDestinoCode[]" placeholder="Punto Destino" maxlength="8">
                            </div>
                            <div class="col-sm-4 seccionPuntoCentral" style="display: none;">
                                <input type="text" class="form-control text-transform" name="PuntoCentralCode[]" placeholder="Punto Central" maxlength="8">
                            </div>
                            <div class="col-sm-2 seccionPuntoCentral" style="display: none;">
                                <button type="button" class="btn btn-success addPuntoCentralCode">+</button>
                                <!--<button type="button" class="btn btn-danger">-</button>-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" id="btnOtp" class="btn btn-primary col-sm-2 btnMarcaciones">OTP</button>
                        <div id="groupOtp">
                            <div class="col-sm-8 seccionOtp" style="display: none;">
                                <input type="text" class="form-control text-transform" name="otpCode[]" placeholder="OTP" maxlength="8">
                            </div>
                            <div class="col-sm-2 seccionOtp" style="display: none;">
                                <button type="button" class="btn btn-success addOtpCode">+</button>
                                <!--<button type="button" class="btn btn-danger">-</button>-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-10">
                            <button type="button" class="btn btn-success" id="btnGenerateMarkings">Generar Marcaciones</button>
                        </div>
                    </div>
                    <br/>
                </div>

                <table class="table table-hover table-striped" style="display: none;" id="tablaMarcaciones">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Capa 2 HUAWEI ZTE</th>
                            <th>Capa 2 ALCATEL</th>
                            <th>Capa 3 INTERFAZ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tdMarcaciones">NORMAL</td>
                            <td><input type="text" class="form-control text-transform" id="huawei_normal"></td>
                            <td><input type="text" class="form-control text-transform" id="alcatel_normal"></td>
                            <td><input type="text" class="form-control text-transform" id="interfaz_normal"></td>
                        </tr>
                        <tr>
                            <td>PPAL CON BACKUP</td>
                            <td><input type="text" class="form-control text-transform" id="huawei_ppal"></td>
                            <td><input type="text" class="form-control text-transform" id="alcatel_ppal"></td>
                            <td><input type="text" class="form-control text-transform" id="interfaz_ppal"></td>
                        </tr>
                        <tr>
                            <td>BACKUP</td>
                            <td><input type="text" class="form-control text-transform" id="huawei_backup"></td>
                            <td><input type="text" class="form-control text-transform" id="alcatel_backup"></td>
                            <td><input type="text" class="form-control text-transform" id="interfaz_backup"></td>
                        </tr>
                        <tr>
                            <td>TRASLADO EXTERNO</td>
                            <td><input type="text" class="form-control text-transform" id="huawei_externo"></td>
                            <td><input type="text" class="form-control text-transform" id="alcatel_externo"></td>
                            <td><input type="text" class="form-control text-transform" id="interfaz_externo"></td>
                        </tr>
                        <tr>
                            <td>TRASLADO EXTERNO BACKUP</td>
                            <td><input type="text" class="form-control text-transform" id="huawei_externoBackup"></td>
                            <td><input type="text" class="form-control text-transform" id="alcatel_externoBackup"></td>
                            <td><input type="text" class="form-control text-transform" id="interfaz_externoBackup"></td>
                        </tr>
<!--                                <tr>
                            <td>DESCONEXION TEMPORAL</td>
                            <td><input type="text" class="form-control text-transform" id="huawei_desconexion"></td>
                            <td><input type="text" class="form-control text-transform" id="alcatel_desconexion"></td>
                            <td><input type="text" class="form-control text-transform" id="interfaz_desconexion"></td>
                        </tr>-->
                        <tr>
                            <td>PUNTO CENTRAL</td>
                            <td><input type="text" class="form-control text-transform" id="huawei_puntoCentral"></td>
                            <td><input type="text" class="form-control text-transform" id="alcatel_puntoCentral"></td>
                            <td><input type="text" class="form-control text-transform" id="interfaz_puntoCentral"></td>
                        </tr>
                        <tr>
                            <td>DOS O MAS SERV DIF PREFIJO</td>
                            <td><input type="text" class="form-control text-transform" id="huawei_difPrefijo"></td>
                            <td><input type="text" class="form-control text-transform" id="alcatel_difPrefijo"></td>
                            <td><input type="text" class="form-control text-transform" id="interfaz_difPrefijo"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </form>
</div>
       
    
        <script type="text/javascript"> var baseurl = "<?= URL::base() ?>";</script>
        
