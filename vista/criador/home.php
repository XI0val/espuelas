<?php
include '../../extra/session.php';

if(isset($_SESSION['dni'])){
    echo 'Aqui va la home del user con los iconos etc';
}else{
    header('Refresh:2, ../../index.php');
}