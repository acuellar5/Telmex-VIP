<header>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo" href="<?= URL::to('paginaPrincipal') ?>"><img id="logo" src="<?= URL::to('assets/img/logo2.png'); ?>" /></a>
            </div>
            <!-- Collect the nav links for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="cam">
                        <div>
                            <?php
                            $img = 'assets/img/' . Auth::user()->k_id_user . '.png';
                            if (!file_exists($img)) {
                                $img = 'assets/img/' . Auth::user()->k_id_user . '.PNG';
                                if (!file_exists($img)) {
                                    $img = 'assets/img/' . Auth::user()->n_role_user . '.png';
                                }
                            }
                            ?>
                            <div id="divImg"><img id="imgRol" src="<?= URL::to($img) ?>"/></div>
                            <div id="infoUsu">
                                <span>
                                    Bienvenid@ <?php echo Auth::user()->n_name_user . ' ' . Auth::user()->n_last_name_user; ?><br>
                                    <?php echo Auth::getRole(); ?>
                                </span>
                            </div>
                        </div>
                    </li>
                    <?php
                    if (Auth::user()->n_project == 'Gestion') {
                        ?>
                        <li class="cam"><a style="height: 85px;">Gestión</a>
                            <ul>
                                <li><a href="<?= URL::to('paginaPrincipal'); ?>" style="height: 60px;">Ver OTs</a></li>
                                <li class="cam"><a href="<?= URL::to('editarOts') ?>" style="height: 60px;">Editar Ots</a>
                                <li class="cam"><a href="<?= URL::to('cargarOts') ?>"  ">Cargar Información</a>
                            </ul>
                        </li>
                    <?php
                    }
                    if (Auth::user()->n_project == 'Implementacion') {
                    ?>
                        <li class="cam"><a style="height: 85px;">Implementación Servicios</a>
                            <ul>
                                <li class="cam"><a href="<?= URL::to('generarMarcaciones') ?>" style="height: 60px;">Marcaciones</a>
                                <li class="cam"><a href="<?= URL::to('validadorIp') ?>" style="height: 60px;">Validación IP</a>
                            </ul>
                        </li>
                    <?php } ?>
                    <li class="cam"><a href="<?= URL::to('User/logout') ?>" style="height: 85px;">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>