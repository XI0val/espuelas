<?php

include '../../extra/sesion.php';

include '../../extra/comprobaciones.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {

   //header('location: http://www.espuelas.com');

}else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if(checkLogin()){
         header('location: home.php');
      }else{
         session_destroy();
         header('location: ../../index.php');
      }

}
