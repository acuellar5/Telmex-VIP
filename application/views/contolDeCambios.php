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
                    <th></th>
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
                    <th class="tamanoColumOpc"></th>                    
                </tr>
            </tfoot>
        </table>
    </div>

    <!--*********************  Contendio de la pestaña de Control de Cambio *********************-->
    <div id="track_changes_OTPAll" class="tab-pane fade">
        <h3>OTP</h3>
        <table id="trackChangesAll" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="tamanoColumOpc"></th>                    
                </tr>
            </tfoot>
        </table>
    </div>
</div>