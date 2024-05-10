<?php
if(!defined('HOST')) {
    define('HOST', 'localhost');
}
if(!defined('DBNAME')) {
    define('DBNAME', 'criadero');
}
if(!defined('USER')) {
    define('USER', 'root');
}
if(!defined('PASSWORD')) {
    define('PASSWORD', '');
}
if(!defined('IMAGEN_SIN_FOTO')) {
    define('IMAGEN_SIN_FOTO', '../../img/sinfoto.png');
}
if(!defined('OPCIONES_CRIADOR')) {
    define('OPCIONES_CRIADOR', 
    [
        'uc'=> 'formularios/form_nueva_ubicacion.html',
        'uu'=> 'formularios/form_edit_ubicacion.php',
        'ud'=> 'formularios/form_delete_ubicacion.php',
        'ac'=> 'formularios/form_nuevo_animal.php',
        'ad'=> 'formularios/form_delete_animal.php',
        'au'=> 'formularios/form_edit_animal.php',
        'cu'=> 'formularios/form_edit_criador.php',
    ]);
}
if(!defined('RAZAS')) {
    define('RAZAS', 
    [
        1 => 'Chileno', 
        2 => 'Hereford'
    ]);
}