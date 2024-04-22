<?php
//include 'session/session.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (!isset($_SESSION['timeout'])) {
        $_SESSION['timeout'] = time();
    } else if (time() - $_SESSION['timeout'] > 1800) {
        session_regenerate_id(true);
        //echo ('regenerado id');  // change session ID for the current session and invalidate old session ID
        $_SESSION['timeout'] = time();  // update creation time
    }
}
include "vista/criador/login.html";
?>


<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> <!--<![endif]-->


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Gahemor Criaderos</title>
    <meta name="description" content="Gaemor Criaderos de caballo chileno">
    <meta name="author" content="Gaemor">
    <meta name="keywords" content="Gaemor Criaderos de caballo chileno">

    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="http://www.espuelas.com/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet" href="css/animate.css">


    <link rel="stylesheet" type="text/css" href="http://www.espuelas.com/custom-css/hoja.css">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="../js/script.js"></script>
    <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

</head>


<body>
    <div class="wrapper">
    <!-- FIN CODIGO HEADER -->

        <!-- CODIGO MENU -->
        <div class="container">

            <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
                <div class="container">
                    <a class="navbar-brand" href="#">Web Zone</a>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <div class="mx-auto"></div>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#nosotros">Nosotros</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Ejemplares</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Dónde estamos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Contacto</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">..</a>
                            </li>
                                <?php
                                    if (!isset($_SESSION['dni'])) {
                                        echo '<li class="nav-item"><button id="btn-modal" class="btn-login">
                                        <i class="fa-brands fa-jenkins"></i></button></li>';
                                    }
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- FIN CODIGO MENU -->

        <!-- CODIGO BANNER PRINCIPAL -->
        <div class="carousel">
            <div class="list">
                <div class="item">
                <img src="img/ejempli-image.jpg" alt="">
                    <div class="content">
                        <div class="nombre">Corcel</div>
                        <div class="titulo">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
                    </div>
                </div>

                <div class="item">
                <img src="img/ejemplo1.png" alt="">
                    <div class="content">
                        <div class="nombre">Corcel</div>
                        <div class="titulo">Los Angeles</div>
                    </div>
                </div>
                <div class="item">
                <img src="img/ejemplo2.jpg" alt="">
                    <div class="content">
                        <div class="nombre">Corcel</div>
                        <div class="titulo">Los Angenles</div>
                    </div>
                </div>
            </div>


            <div class="thumbnail">
                <div class="item">
                    <img src="img/ejemplo1.png" alt="">
                    <div class="content">
                        <div class="nombre">Slider</div>
                        <div class="des">Descripcion</div>
                    </div>
                </div>
                <div class="item">
                    <img src="img/ejemplo2.jpg" alt="">
                    <div class="content">
                        <div class="nombre">Slider</div>
                        <div class="des">Descripcion</div>
                    </div>
                </div>

                <div class="item">
                    <img src="img/ejempli-image.jpg" alt="">
                    <div class="content">
                        <div class="nombre">Slider</div>
                        <div class="des">Descripcion</div>
                    </div>
                </div>
            </div>


            <div class="flecha">
                <button id="prev"> < </button>
                <button id="next"> > </button>
            </div>
            <div class="time"></div>
        </div> 

        <!-- FIN CODIGO BANNER PRINCIPAL -->

        <!-- CODIGO ABOUT -->
         <div class="container">
            <div class="row">
                <section class="first hidden">
                <img id="img-ini " class="img-fluid img-ini" src="../img/presentacion.png" alt="">
                </section>

                <div class="container-fluid hidden">
                    <div class="row">
                    <div class="col-lg-4 col-md-4 col-12  img_one wow fadeInLeft">
                        <img class="img-fluid iright " id="img-right"  src="../img/right-img.jpeg" alt="">
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 txt text-center  title animate">
                        <span style="--i:1;">G</span>
                        <span style="--i:2;">A</span>
                        <span style="--i:3;">H</span>
                        <span style="--i:4;">E</span>
                        <span style="--i:5;">M</span>
                        <span style="--i:6;">O</span>
                        <span style="--i:7;">R</span>

                    </div>
                    <div class="col-md-4 col-lg-4 col-12  img_two wow slideInDown">
                        <img class="img-fluid ileft " id="img-left" src="../img/right-img.jpeg" alt="">
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <section  class="" id="nosotros">
            <div class="parallax-1  wow fadeInUp" >
            <h2>Sobre Nosotros</h2>
            <div class="parallax-inner">
            </div>
            </div>
            <br>

            <div class="container section2 ">
            <div class="row">
            <div class="col-6 col-lg-6 col-md-6 wow slideInLeft " >
                <p class="introduccion "  >Nuestro pequeño criadero, Gahemor,  no es tan antiguo como las tierras  en el que se encuentra .
                    Heredé  de mi padre la pasión  por la tierra, la naturaleza y los animales ,especialmente  los caballos .
                    Él a su vez lo había heredado de sus abuelos que compraron estas hermosas  tierras a principios  del 1900,en la comuna de Santa Bárbara, dejando este legado a hijos y nietos .
                    Mi padre empezó  su pequeño criadero con unos cuantos caballos que nos acompañaron en los rodeos de mi infancia ,más  tarde llegué  a ser su "collera"
                    en aquellos días de  apasionantes rodeos en las  medialunas cercanas .
                    Después  de su muerte, continúe con la  pasión  por este deporte ,  creando mi propio criadero y también   como un homenaje a su memoria.
                    Mi comienzo fue comprando una yegua preñada y después  de 14 años lidiando con no pocas dificultades, cuento actualmente con 8 ejemplares a los que
                    dedico una buena parte de mi tiempo y entusiasmo para mantenerlos en óptimas  condiciones. </p>
            </div>
            <div class="col-lg-6 col-md-6 col-6 wow zoomInRight">
                <img class="img-fluid about-img " id="parallax-img" src="../img/right-img.jpeg" alt="">
            </div>
            </div>
            </div>
            <br>
        </section> 
        <!-- FIN CODIGO ABOUT -->

        <!-- CODIGO EJEMPLARES -->
         <section  class="" id="ejemplares">

        <div class="parallax-1 img_animals wow fadeInUp" >
            <h2>Ejemplares</h2>
            <div class="parallax-inner">
            </div>
        </div>
        <br>

        <div class="container section2 ">
            <div class="row">
                <div class="col-6 col-lg-6 col-md-6 wow slideInLeft " >
                    <p class="introduccion "  >Nuestro pequeño criadero, Gahemor,  no es tan antiguo como las tierras  en el que se encuentra .
                    Heredé  de mi padre la pasión  por la tierra, la naturaleza y los animales ,especialmente  los caballos .
                    Él a su vez lo había heredado de sus abuelos que compraron estas hermosas  tierras a principios  del 1900,en la comuna de Santa Bárbara, dejando este legado a hijos y nietos .
                    Mi padre empezó  su pequeño criadero con unos cuantos caballos que nos acompañaron en los rodeos de mi infancia ,más  tarde llegué  a ser su "collera"
                    en aquellos días de  apasionantes rodeos en las  medialunas cercanas .
                    Después  de su muerte, continúe con la  pasión  por este deporte ,  creando mi propio criadero y también   como un homenaje a su memoria.
                    Mi comienzo fue comprando una yegua preñada y después  de 14 años lidiando con no pocas dificultades, cuento actualmente con 8 ejemplares a los que
                    dedico una buena parte de mi tiempo y entusiasmo para mantenerlos en óptimas  condiciones. </p>
                </div>
                <div class="col-lg-6 col-md-6 col-6 wow zoomInRight">
                    <img class="img-fluid about-img " id="parallax-img" src="../img/right-img.jpeg" alt="">
                </div>
            </div>
        </div>
        <br>

        </section>
        <!-- FIN CODIGO EJEMPLARES -->

        <!-- CODIGO FOOTER -->
        <footer class="w-100" style="background-color:#d8d8d8; ">
            <!-- Grid container -->
            <div class="container p-4">

            <div class="rounded-circle bg-white shadow-1-strong d-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 150px; height: 150px;">
                    <img src="https://mdbootstrap.com/img/Photos/new-templates/animal-shelter/logo.png" height="70" alt=""
                        loading="lazy" />
                    </div>
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 Copyright:
            <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->


        <script src="../js/script.js"></script>
        <script src="js/carousel.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/plugins.js"></script>
        <script src="fonts/js/all.js"></script>
        <script type="text/javascript"></script>

    </div>  <!--fin wrapper -->
</body>
</html>