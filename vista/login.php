<?php
/**
* Gestión del login del usuario
*/
include '../extra/session.php';

include '../extra/criador-logica.php';

$home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/GAHEMOR-WEB/home.php';
$index_url = 'http://' . $_SERVER['HTTP_HOST'] . '/GAHEMOR-WEB/index.php';
$error_url = 'http://' . $_SERVER['HTTP_HOST'] . '/GAHEMOR-WEB/vista/pagina_error.php';

//solo aceptamos llamadas post en esta pagina
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if(checkLogin()){
         header('location:'.$home_url);
      }else{
         session_destroy();
         header('location:'.$error_url);
         
      
      }

}else{
   header('location:'.$index_url);
}