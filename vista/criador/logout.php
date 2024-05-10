<?php
include '../../extra/session.php';

//comprobamos que hay sesion antes de eliminarla
if(isset($_SESSION)){
    session_destroy();
    $_SESSION = [];
    header('Location: ../../index.php');
//si no hay sesion se está intentando acceder erroneamente
}else{
    header('location: ../pagina_error.php');
}