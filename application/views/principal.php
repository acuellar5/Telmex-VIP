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

<!--*********************  MODULO PESTAÑAS  *********************-->
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#fuera_tiempos">Fuera de Tiempos</a></li>
    <li class=""><a data-toggle="tab" href="#en_tiempos">En Tiempos</a></li>
    <li class=""><a data-toggle="tab" href="#todo">Todo</a></li>
</ul>

<!--*********************  CONTENIDO PESTAÑAS  *********************-->
<div class="tab-content">

    <div id="fuera_tiempos" class="tab-pane fade in active">
        <h3>Fuera de Tiempos</h3>
        <table id="tablaFueraTiempos" class="table table-hover table-striped dataTable_camilo" width="100%"></table>
    </div>

    <div id="en_tiempos" class="tab-pane fade">
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

<div id="Modal_detalle" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" >
    <div class="col-md-12">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                <h3 class="modal-title" id="myModalLabel"></h3>
            </div>
    </div>
    

</div>

