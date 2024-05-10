</style>

    <div class="container bodyHome">
        <nav>
            <ul class="nav__list">
                <!-- MENU UBICACIONES -->
                <li>
                    <a href="#"><img src="../../img/ubicacion.png" width="150" heiht="150" /></a>
                    <ul>
                        <li><a href="home.php?action=uu">Actualizar Ubicación</a></li>
                        <li><a href="home.php?action=uc">Nueva Ubicación</a></li>
                        <li><a href="home.php?action=ud">Eliminar Ubicación</a></li>
                        <li>
                            <a href="">Lista Ubicaciones</a>
                            <ul class="sub-menu">
                                    <?php /* llamada a bd para recuperar lista de ubicaciones */
                                        //$ubicaciones = listaUbicaciones($_SESSION['criador']['id_criador']);
                                        foreach($ubicaciones as $ubicacion){
                                            echo '<li><a href="">' . $ubicacion['nombre'] . '</a></li>';
                                        }
                                    ?>
                            </ul>                            
                        </li>
                    </ul>
                </li>
                <!-- SEPARADOR -->
                <!-- </li><p></p><li> -->
                <!-- MENU ANIMALES -->
                <li>
                    <a href="#"><img src="../../img/caballo.png" width="150" heiht="150" /></a>
                    <ul>
                        <li><a href="home.php?action=ac">Nuevo Animal</a></li>
                        <li>
                            <a href="">Actualizar Animal</a>
                            <ul class="sub-menu" >
                                <?php 
                                        global $animales;
                                        //var_dump($animales);
                                    foreach($animales as $animal){
                                        echo '<li><a href="home.php?action=au&data=' . $animal['id_animal'] . '">' . $animal['nombre'] . '</a></li>';
                                    }
                                ?>
                            </ul>
                        </li>
                        <li><a href="home.php?action=ad">Eliminar Animal</a></li>
                        <li>
                            <a href="">Lista Animales</a>
                            <ul class="sub-menu">
                                    <?php /* llamada a bd para recuperar lista de animales*/
                                        foreach($animales as $animal){
                                            echo '<li><a href="">' . $animal['nombre'] . '</a></li>';
                                        }
                                    ?>
                            </ul>                             
                        </li>
                    </ul>
                </li>
                <!-- SEPARADOR -->
                <!-- </li><p></p><li> -->
                <!-- MENU CRIADOR -->
                <li>
                    <a href="#"><img src="../../img/guaso-perfil.png" width="150" heiht="150" /></a>
                    <ul>
                        <li><a href="home.php?action=cu">Editar perfil</a></li>
                        <li><a href="logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
                <!-- SEPARADOR -->
                <!-- </li><p></p><li>   --> 
                <!-- MENU VACUNAS -->                 
                <li>
                    <a href="#"><img src="../../img/vacuna.png" width="150" heiht="150" /></a>
                    <ul>
                        <li><a href="home.php?action=vc">Nueva vacuna</a></li>
                        <li><a href="home.php?action=vu">Modificar vacuna</a></li>
                        <li><a href="home.php?action=vd">Eliminar vacuna</a></li>
                        <li><a href="home.php?action=vr">Ver vacunas</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- <div class="containerForm"> -->
            
                <!-- AQUI MOSTRAMOS EL FORMULARIO SI SE SOLICITA -->
                <?php 
                if(isset($contenido)){ include $contenido; } 
                if(isset($mensaje)){ echo $mensaje; } 
                ?>

        <!-- </div> --><!-- fin containerform -->
    </div><!-- fin bodyhome -->