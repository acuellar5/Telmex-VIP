<script src="<?= URL::to("assets/plugins/sweetalert2/sweetalert2.all.js") ?>"></script>
<h3>Enrutamiento OTS</h3>
<table id="tables_cierre" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
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
    </tr>
    </tfoot>
</table>

<!------------------------------------------ MODAL DE ORDENES SELECCIONADAS PARA CIERRE ------------------------------------------>
<div id="mdl_cierre" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                <h3 class="modal-title" id="mdl-title-cierre">ORDENES SELECCIONADAS</h3>
            </div>
            <div class="modal-body">
                <table id="table_selected" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%"></table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="mdl-cierre-eliminar" style="float: left;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Eliminar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i>&nbsp;Cancelar</button>
                <button type="button" class="btn btn-success" id="mdl-cierre-facturacion"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;Facturacion</button>
            </div>
        </div>
    </div>
</div>
<!---------------------------------------- FIN MODAL DE ORDENES SELECCIONADAS PARA CIERRE-------------------------------------- -->