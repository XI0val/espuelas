
<?php
// include "conexion/conexionbd.php";
// $query = $connection->prepare("SELECT * FROM criador ");

// $query->execute();

// if ($query->rowCount() > 0) {

//     echo '<p style=font-size:40px; class="error"> Se encontro usuario</p>';

// }else{
//     echo '<p style=font-size:14px; class="error">Something went wrong!</p>';
// }
 
?> 

 <!-- Header/ menu / banners/ contenido /  footer -->

<?php

session_start();

// Comprueba si el usuario está logeado
$logged_in = isset($_SESSION['user_id']);

// Incluye el menú y el banner principal independientemente del estado de logueo

include "menu.php";

// Incluye el cuerpo de la página según el estado de logueo
if ($logged_in) {
    // Si el usuario está logeado, incluye las secciones que deseas mostrar cuando el usuario está logeado
    include "vista/home.php"; // O cualquier otra sección que desees mostrar cuando el usuario está logeado
} else {
    // Si el usuario no está logeado, incluye la vista de login
    include "criador/login.html";
    include "banner_principal.php";
    include "about.php";
    include "ejemplares.php";
}

// Incluye otras secciones de la página, independientemente del estado de logueo


// Incluye el pie de página
include "footer.php";







?>