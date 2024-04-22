<?php
/**
* Gestión del login del usuario
*/
include '../../extra/comprobaciones.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {

   header('location: http://www.espuelas.com');

}else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
   if(checkLogin()){
      echo 'login OK';
   }else{
      echo 'login mal';
   }

}