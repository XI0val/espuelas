<?php
include '../extra/session.php';

if(isset($_SESSION['dni'])){
    include 'header.php';
    include "menu.php"; 

    include 'body-home.php';
    
//    include "../ejemplares.php";
    include "footer.php";    
}else{
    header('location: pagina_error.php');
}

// echo 'Home';