<?php
    //antes de mostrar le menu cargaremos los datos actualizados
    $ubicaciones = listaUbicaciones($_SESSION['criador']['id_criador']);

    $animales = listaAnimales($_SESSION['criador']['id_criador']);
   
    $familias = listaFamilias();
    //var_dump($_SESSION);
?>

<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDE5zSl0JCMktXTnLPpJ45uFPg_XNHWTRU&callback=initMap">
</script>
<script>
    let map;

    async function initMap() {
    //@ts-ignore
    const { Map } = await google.maps.importLibrary("maps");

    map = new Map(document.getElementById("map"), {
        center: { 
            lat: 
            <?php echo $_SESSION['datosUbicacion']['latitud']?>, 
            lng: 
            <?php echo $_SESSION['datosUbicacion']['longitud']?>, 
        },
         zoom: 14,
    });
    }

    initMap();
</script>

<script>
  (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
    key: "AIzaSyDE5zSl0JCMktXTnLPpJ45uFPg_XNHWTRU",
    // Add other bootstrap parameters as needed, using camel case.
    // Use the 'v' parameter to indicate the version to load (alpha, beta, weekly, etc.)
  });
</script>

<style type="text/css">



</style>

    <div class="container bodyMenu">
        <nav>
        <div class="row">
            <ul class="nav__list">
             
                <!-- MENU UBICACIONES -->
                <div class="col-3 col-md-3 wow fadeIn">
                <li>
                    <a href="#"><img class="img-fluid" src="../../img/home-img/ubicacion.jpg" width="150" heiht="150" /></a>
                    <ul>
                        <li><a href="home.php?action=uc">Nueva Ubicación</a></li>
                        <li>
                            <a href="home.php?action=uu">Actualizar Ubicación</a>
                            <ul class="sub-menu" >
                                <?php 
                                        global $ubicaciones;
                                        if(count($ubicaciones) > 0){
                                            foreach($ubicaciones as $ubicacion){
                                                echo '<li><a href="home.php?action=uu&data=' . $ubicacion['id_ubicacion'] . '">' . $ubicacion['nombre'] . '</a></li>';
                                            }
                                        }else{
                                            echo '<li><a href="">' . 'Añade alguna ubicación!' . '</a></li>';
                                        }
                                    
                                ?>
                            </ul>
                        </li>

                        <li><a href="home.php?action=ud">Eliminar Ubicación</a></li>
                        <li>
                            <a href="">Lista Ubicaciones</a>
                            <ul class="sub-menu">
                                    <?php if(count($ubicaciones) > 0){
                                            foreach($ubicaciones as $ubicacion){
                                                echo '<li><a href="home.php?action=um&data=' . $ubicacion['id_ubicacion'] . '">' . $ubicacion['nombre'] . '</a></li>';
                                            }
                                        }else{
                                            echo '<li><a href="">' . 'Añade alguna ubicación!' . '</a></li>';
                                        }
                                    ?>
                            </ul>                            
                        </li>
                    </ul>
                </li>
                </div>
                <!-- SEPARADOR -->
                <!-- </li><p></p><li> -->

                <!-- MENU ANIMALES -->
                <div class="col-3 wow fadeIn">
                <li>
                    <a href="#"><img class="img-fluid"src="../../img/home-img/caballo.jpg" width="150" heiht="150" /></a>
                    <ul>
                        <li><a href="home.php?action=ac">Nuevo Animal</a></li>
                        <li>
                            <a href="">Actualizar Animal</a>
                            <ul class="sub-menu" >
                                <?php 
                                        global $animales;
                                        if(count($animales) > 0){
                                            foreach($animales as $animal){
                                                echo '<li><a href="home.php?action=au&data=' . $animal['id_animal'] . '">' . $animal['nombre'] . '</a></li>';
                                            }
                                        }else{
                                            echo '<li><a href="">' . 'Añade algún animal!' . '</a></li>';
                                        }
                                    
                                ?>
                            </ul>
                        </li>
                        <li><a href="home.php?action=ad">Eliminar Animal</a></li>
                        <li>
                            <a href="">Lista Animales</a>
                            <ul class="sub-menu">
                                    <?php /* llamada a bd para recuperar lista de animales*/
                                        if(count($animales) > 0){
                                            foreach($animales as $animal){
                                                echo '<li><a href="">' . $animal['nombre'] . '</a></li>';
                                            }
                                        }else{
                                            echo '<li><a href="">' . 'Añade algún animal!' . '</a></li>';
                                        }                                    
                                    ?>
                            </ul>                             
                        </li>
                    </ul>
                </li>
                </div>

                <!-- SEPARADOR -->
                <!-- </li><p></p><li> -->
                <!-- MENU CRIADOR -->
                <div class="col-3 wow fadeIn">
                <li>
                    <a href="#"><img class="img-fluid" src="../../img/home-img/criador.jpg" width="150" heiht="150" /></a>
                    <ul>
                        <li><a href="home.php?action=cu">Editar perfil</a></li>
                        <li><a href="logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
                </div>
                <!-- SEPARADOR -->
                <!-- </li><p></p><li>   --> 
                    
                <!-- MENU VACUNAS --> 
                
                <div class="col-3 wow fadeIn">
                <li>
                    <a href="#"><img class="img-fluid" src="../../img/home-img/vacuna.jpg" width="150" heiht="150" /></a>
                    <ul>
                        <li><a href="home.php?action=vc">Nueva vacuna</a></li>
                        <li><a href="home.php?action=vu">Modificar vacuna</a></li>
                        <li><a href="home.php?action=vd">Eliminar vacuna</a></li>
                        <li><a href="home.php?action=vr">Ver vacunas</a></li>
                    </ul>
                </li>
                
            </ul>
            </div>

                <!-- </div> fin row -->
        </nav>

        <!-- <div class="containerForm"> -->
            
                <!-- AQUI MOSTRAMOS EL FORMULARIO SI SE SOLICITA -->
                <?php 
                if(isset($contenido)){ include $contenido; } 
                if(isset($mensaje)){ echo $mensaje; } 
                if(isset($mapa)){ echo $mapa; } 
                ?>

        <!-- </div> --><!-- fin containerform -->


    </div><!-- fin bodyhome -->
   