<?php
include 'extra/session.php';

if(isset($_SESSION['dni'])){
    
    include __DIR__ . '/vista/menu.php'; 
    include __DIR__ . '/vista/criador/body-home.php';
    include __DIR__ . '/vista/footer.php';  
    
    


}else{
    header('location: index.php');
}

// echo 'Home';