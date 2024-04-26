<?php
/**
* Gestión del login del usuario
*/
include '../../extra/session.php';

include '../../extra/criador-logica.php';

//solo aceptamos llamadas post en esta pagina
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if(checkLogin()){
         header('location: home.php');
      }else{
         session_destroy();
         header('location: ../../index.php');
      }

}else{
   header('location: ../pagina_error.php');
}