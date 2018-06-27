<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--   ICONO PAGINA    -->
  <link rel="icon" href="<?= URL::to('assets/img/logo_zte.png'); ?>">
  <!-- STYLES HEADER FOOTER  -->
  <link rel="stylesheet" type="text/css" href="<?= URL::to('assets/css/styles_header.css'); ?>">
  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="<?= URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') ?>"/>
  <link rel="stylesheet" href="<?= URL::to('assets/plugins/font-awesome/css/font-awesome.min.css') ?>"/>

  <!-- STYLES DATATABLES CAMILO -->
  <link rel="stylesheet" type="text/css" href="<?= URL::to('assets/css/datatables_camilo.css'); ?>">
  <!-- STYLES MODULES PRINCIPAL -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <!-- STYLES  FOOTER  -->
  <link rel="stylesheet" type="text/css" href="<?= URL::to('assets/css/styles_footer.css'); ?>">

  <script scr="<?= URL::to("assets/plugins/sweetalert-master/dist/sweetalert.min.js") ?>" ></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- **********************************************VISTA VALIDADOR IP *********************************************-->
  <?php if ($this->uri->segment(1) == 'validadorIp'): ?>
        <!-- ASSESTS 2 -->
        <link rel="stylesheet" type="text/css" href="<?= URL::to('assets/css/main.css') ?>">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?= URL::to('assets/css/util.css') ?>">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?= URL::to('assets/vendor/css-hamburgers/hamburgers.min.css') ?>">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?= URL::to('assets/vendor/animsition/css/animsition.min.css') ?>">
        <!--==============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?= URL::to('assets/vendor/select2/select2.min.css') ?>">

  <?php endif ?>
    <?php if ($this->uri->segment(1) == 'editarOts' || $this->uri->segment(1) == 'paginaPrincipal') { ?>
        <link rel="stylesheet" href="<?= URL::to('assets/css/styleModalCami.css?v=' . time()) ?>" />
        <link rel="stylesheet" href="<?= URL::to('assets/css/helper-class.css?v=1.0') ?>">

  <?php } ?>
</head>

<body style="padding: 0;" data-base="<?= URL::base() ?>" >  
  <div class="telmexVIP_header ">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid menu_nav_header" >
        <div class="navbar-header">          
          <a class="navbar-brand" href="<?= URL::to('paginaPrincipal') ?>">
            <img class="logo_header" src="<?= URL::to('assets/img/LogoZTENav.png'); ?>"> 
          </a>
        </div>        

        <ul class="nav navbar-nav menu_nav_header">
            <li class="active"><a class="home" href="<?= URL::to('paginaPrincipal') ?>">Home</a></li>
              <?php
              if (Auth::user()->n_project == 'Gestion') {
                ?>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Gestión<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?= URL::to('editarOts') ?>">Ver OTS</a></li>
                    <li><a href="<?= URL::to('cargarOts') ?>">Cargar incormación</a></li>
                  </ul>
                </li>
              <?php
              }
              if (Auth::user()->n_project == 'Implementacion') {
                ?>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Implementación Servicios <span class="caret"></span></a>
                  <ul class="dropdown-menu tamaniomin">
                    <li><a href="<?= URL::to('generarMarcaciones') ?>">Marcaciones</a></li>
                    <li><a href="<?= URL::to('validadorIp') ?>" ">Validación IP</a></li>
                  </ul>
                </li>
              <?php } ?>
           <!--  <li><a href="#">agendamiento</a></li> -->   
           <!--  <li><a href="#">facturacion</a></li> -->
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span><b> Bienvenido </b> <?php echo Auth::user()->n_last_name_user; ?><br>
              </a>
          </li>
          <li><a href="<?= URL::to('User/logout') ?>"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
        </ul>
      </div>
    </nav>
  </div>
  <div class="container" style="min-height: 518px;">
  