<?php
include '../../extra/session.php';
include '../../extra/definiciones.php';
include '../../extra/ubicacion-logica.php';
include '../../extra/animal-logica.php';
include '../../extra/criador-logica.php';
include '../../extra/utils.php';
include '../../extra/check-post.php';


//variable que contendrá la ruta del form a mostrar
$contenido;

//variable que contendrá el msj a mostrar
$mensaje;

//variable que guaradará la imagen elegida en el perfil
$resUpload = 'nada';

$ubicacion_nombre ='';

//si no estamos logados nos echa al index
if(!isset($_SESSION['criador']['dni'])){
    header('Location: ../../index.php');
    die('cuidaooo');
}

//si se recibe petición GET para mostrar formulario
if($_SERVER['REQUEST_METHOD'] === 'GET'){

    //si existe sesion y solo se envia un parametro
    if(count($_GET) === 1 && isset($_SESSION['criador']['dni'])) {
        $opcion = $_GET['action'];
        //comprobamos el parametro
            if(preg_match("/^[a-z]{2}$/", $opcion)){
                //comprobamos en el array de opciones si existe la opcion solicitada
                if(isset(OPCIONES_CRIADOR[$opcion])){
                    //si existe cargamos en $contenido el form solicitado
                    $contenido = OPCIONES_CRIADOR[$opcion];
                }else{
                    $contenido ='';
                }
                
                
            }else{
                header('Location: ../../index.php');
            }
        
    }
    //si existe sesion y se envian dos parametros
    if(count($_GET) === 2 && isset($_SESSION['criador']['dni'])) {
        //si la accion esta formada por dos letras y data es numerico
        if(preg_match("/^[a-z]{2}$/", $_GET['action']) && preg_match("/^[1-9]+$/", $_GET['data'])){
            //solicitud para actualizar un animal
            if($_GET['action'] === 'au'){
                //recuperamos datos del animal desde bd
                $result = animalPorId($_GET['data']);
                //si la funcion nos devuelve un array con datos
                //var_dump($result);
                if(is_array($result) && count($result) > 8){
                    $_SESSION['datosAnimal'] = limpiaEspacios($result);


                    $contenido = OPCIONES_CRIADOR[$_GET['action']];
                }else{
                    echo 'error al recuperar los datos del animal';
                }
            }
            if($_GET['action'] === 'uu'){
                //recuperamos datos de la ubicación desde bd
                $result = ubicacionPorId($_GET['data']);
                //si la funcion nos devuelve un array con datos
                if(is_array($result) && count($result) > 4){
                    $_SESSION['datosUbicacion'] = limpiaEspacios($result);
                    $contenido = OPCIONES_CRIADOR[$_GET['action']];
                }else{
                    echo 'error al recuperar los datos de la ubicación';
                }
            }
            if($_GET['action'] === 'um'){                
                //recuperamos datos de la ubicación desde bd
                $result = ubicacionPorId($_GET['data']);
                //si la funcion nos devuelve un array con datos
                if(is_array($result) && count($result) > 4){
                    $_SESSION['datosUbicacion'] = limpiaEspacios($result);
                    
                    $mapa = '<div class="div">'.$_SESSION['datosUbicacion']['nombre'].' </div>
                    <div id="map" style="width:500px; height: 500px; margin-left: auto; margin-right: auto;">
                    </div>';
                }else{
                    echo 'error al recuperar los datos de la ubicación';
                }
              
            }

        }
    }      
    
}

//si se recibe petición POST para mostrar formulario
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['criador']['dni'])){
    //si nos llegan datos de un form
    if(isset($_POST['form']) && preg_match("/^[a-z]{2}$/", $_POST['form'])){
        //var_dump($_POST);
            $respuesta = checkPost($_POST);
            if(is_array($respuesta)){
                switch ($_POST['form']) {
                    case 'ac'://animal create

                        //si hemos enviado los datos del form(nombre, sexo, raza...)
                        if(!isset($respuesta['imagen']) && isset($respuesta['nombre'])){
                            //print_r($respuesta);
                            $ok = mueveFoto($respuesta);
                            print_r($ok);
                            if($ok){

                                $respuesta['imagen'] = $_SESSION['datosAnimal']['imagen'];
/*                                 $result = altaAnimal($respuesta);
                                 $mensaje = $result != false ? 'Añadido animal con id ' .$result : ' no se ha podido añadir el animal'; */
                            }
                        }else{
                            header('location: home.php?action=ac');
                        }
                        break;
                    case 'au': //animal update
                        $result = editaAnimal($respuesta);
                        $mensaje = $result != false ? 'Editado animal correctamente' : 'no se ha podido editar el animal';
                        break;
                    case 'ad': //animal delete
                        $result = borraAnimal($respuesta);
                        $mensaje = $result != false ? 'Eliminado animal correctamente' : 'no se ha podido eliminar el animal';
                        break;
                    case 'ud': //ubicacion delete
                        $result = borraUbicacion($respuesta['id_ubicacion']);
                        $mensaje = $result;
                        break;
                    case 'uc': //ubicacion create
                        $result = altaUbicacion($respuesta);
                        $mensaje = $result > 0 ? 'Se ha creado la ubicación correctamente' : 'no se ha podido crear la ubicación';
                        break;
                    case 'uu': //ubicacion update
                        $result = editaUbicacion($respuesta);
                        $mensaje = $result > 0 ? 'Se ha creado la ubicación correctamente' : 'no se ha podido crear la ubicación';
                        break;
                    case 'cu': //criador update perfil
                    case 'pu': //criador update password
                        //var_dump($respuesta);   
                        $result = editaCriador($respuesta);
                        $mensaje = $result ? 'Se ha modificado el perfil correctamente' : 'no se ha podido realizar la operación';                        
                        break;    
                    default:
                        # code...
                        break;
                }

            }else{
                $mensaje = $respuesta;
                //var_dump($_POST);
            }

    }

}

include 'header-home.php';
include 'body-home.php';
include 'menu-criador.php';
include "footer-home.php"; 