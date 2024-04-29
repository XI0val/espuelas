<?php
include 'extra/session.php'; // Incluye el archivo de sesión

// Verifica si el usuario está logueado
if (!isset($_SESSION['dni'])) {
    // Si no está logueado muesta:
include "vista/header.php"; 
include "vista/menu.php"; 
include "vista/banner_principal.php";
include "vista/criador/login.html";
include "vista/about.php";
include "vista/ejemplares.php";
include "vista/footer.php"; 
} else {
    // Si está logueado, redirige a home.php
    header('Location: vista/criador/home.php');
    exit(); 
}

// include "vista/footer.php";
?>




