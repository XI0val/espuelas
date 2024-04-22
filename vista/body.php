
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


include "menu.php"; 
include "banner_principal.php";
include "criador/login.html";

include "about.php";

include "ejemplares.php";

include "footer.php";

?>