<?php
include '../../extra/criador-logica.php';

if(isset($_POST) && $_POST["altaCriador"] == "123456665") {
    //var_dump($_POST);
    unset( $_POST["altaCriador"] );
    $_POST['password'] = hashPassword($_POST['password']);
    //var_dump( $_POST );
    $criador = new CriadorModel($_POST);

    $id = $criador->altaCriador($criador);
    echo 'el id creado es: ' .$id;
}