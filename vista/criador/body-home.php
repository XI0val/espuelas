<div class='bodyHome '>

<nav class="navbar barra-user bg-dark">
  <!-- Navbar content -->
  <div class="row">
    <div class="col-3 col-md-3 col-xs-6">
  <a class="navbar-brand" href="#"> <img class="img-fluid logotipo"   src="../../img/logotipo-web.png" alt="">  </a> 
  </div>
  
   <div class="col-5 col-md-4 col-xs-3 text-center wow pulse">
    <!--Si la sesion esta iniciada:  -->
    <?php if (isset($_SESSION['criador'])) { 
    
     echo' <h1 class="welcome" > Bienvenido '.$_SESSION["criador"]["nombre"] .'</h1><hr class="wow slideInLeft underlineh text-center"></div> <div class="col-2 col-md-3 col-xs-6"><img class="img-fluid img-usuario" src="'.elegirFoto() .'" alt=""></div>';
   }else{
    echo "Hola desconocido";
   }?>
   
   <div class="col-3 col-md-2 col-xs-3">
    <a href="">
    <img  class="img-fluid logo-out"    src="../../img/home-img/salir.png" alt="logotipo de salir de la pagina">
    </a>
   </div>
   
</div>
</nav>

</div>
<?php 
function elegirFoto(){
    if(empty($_SESSION["criador"]["imagen"])){
        return IMAGEN_SIN_FOTO;
    }else {
        return $_SESSION["criador"]["imagen"];
    }
    

}