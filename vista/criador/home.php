<?php
include '../../extra/session.php';

if(isset($_SESSION['dni'])){
    include '../header.php';
    include "../menu.php"; 

    include '../body.php';
    
//    include "../ejemplares.php";
    include "../footer.php";    
}else{
    header('Refresh:2, ../../index.php');
}

// echo 'Home';