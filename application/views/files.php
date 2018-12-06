<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Files</title>
        <link rel="icon" href="<?= URL::to('assets/img/logo_zte.png'); ?>">
        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="<?= URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?= URL::to('assets/plugins/font-awesome/css/font-awesome.min.css') ?>"/>

        <style type="text/css">
            body{background: url(http://static.pexels.com/wp-content/uploads/2014/07/darkness-dawn-dusk-2073.jpg) ;background-size: 1920px 1000px;}
            .show{position: absolute;top:50%;left:50%;width:150px;height:40px;margin-top:-20px;margin-left:-75px;background:#e74c3c;color:#fff;border-radius:5px;border:0;border-bottom:2px solid#c0392b;cursor:pointer;&:hover{background:#c0392b;}&:active{transform:scale(0.9);}}
            .close{position:absolute;top:0;right:0;width:35px;height:30px;background:#000;color:#fff;cursor:pointer;border:0;}
            .mask{position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(52,73,94,0.8);z-index:50;visibility:hidden;opacity:0;transition:0.7s;}
            .modal{position:fixed;top:50%;left:50%;width:400px;height:300px;margin-left:-200px;margin-top:-150px;background:#bdc3c7;z-index:100;visibility:hidden;opacity:0;transition:0.5s ease-out;transform:translateY(45px);display:flex;justify-content:center;align-items:center;}
            .active{visibility:visible;opacity:1;}
            .active+.modal{visibility:visible;opacity:1;transform:translateY(0);}
            #password{display:block;width:100%;padding:7px 4px;border-radius:0;}
            #validar{margin-top:7px;padding:5px 0px;width:100%;}
            .body-moda{	text-align:center;}
            #tabla-archivos tbody{color: #fff;}
        </style>

    </head>
    <body>
        <div class="mask" role="dialog"></div>
        <div class="modal" role="alert">
            <!-- <button class="close" role="button">X</button> -->
            <div class="body-modal">
                <h3>Ingresa el Password</h3>
                <input type="password" name="" id="password">
                <button id="validar">validar</button>
            </div>
        </div>

        <div id="pt_tbl" align="center">
            <table id="tabla-archivos" class="table table-bordered" style="width: 56%; margin-top: 60px; display: none">
                <thead>
                    <tr>
                        <th style="background: #1f4c6f; color: #fff" >Descripción del archivo adjunto</th>
                        <th style="background: #1f4c6f; color: #fff" class="text-center">Descargar</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="<?= URL::to("assets/plugins/bootstrap/js/bootstrap.min.js") ?>"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
        <script type="text/javascript"> const base_url = "<?php echo URL::base(); ?>";</script>

        <script type="text/javascript" src="<?= URL::to("assets/js/modules/files.js?v=2"); ?>"></script>
    </body>
</html>