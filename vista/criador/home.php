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
    if(count($_GET) === 2 && isset($_SESSION['criador']['dni'])) {
       
        if(preg_match("/^[a-z]{2}$/", $_GET['action']) && preg_match("/^[1-9]+$/", $_GET['data'])){
            //solicitud para actualizar un animal
            if($_GET['action'] === 'au'){
                //recuperamos datos del animal desde bd
                $result = animalPorId($_GET['data']);
                //si la funcion nos devuelve un array con datos
                if(is_array($result) && count($result) > 8){
                    $_SESSION['datosAnimal'] = limpiaEspacios($result);
                    $contenido = OPCIONES_CRIADOR[$_GET['action']];
                }else{
                    echo 'error al recuperar los datos del animal';
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
                    case 'ac':
                        $result = altaAnimal($respuesta);
                        $mensaje = $result != false ? 'Añadido animal con id ' .$result : ' no se ha podido añadir el animal';
                        break;
                    case 'au': //animal update
                        $result = editaAnimal($respuesta);
                        $mensaje = $result != false ? 'Editado animal correctamente' : 'no se ha podido editar el animal';
                        break;
                    case 'uc': //animal create
                        $result = altaUbicacion($respuesta);
                        $mensaje = $result > 0 ? 'Se ha creado la ubicación correctamente' : 'no se ha podido crear la ubicación';
                        break;
                    case 'ud': //ubicacion delete
                        $result = borraUbicacion($respuesta['id_ubicacion']);
                        $mensaje = $result ? 'Se ha eliminado la ubicación correctamente' : 'no se ha podido eliminar la ubicación';
                        break;
                    case 'uu': //ubicacion update
                        $result = editaUbicacion($respuesta);
                        $mensaje = $result > 0 ? 'Se ha creado la ubicación correctamente' : 'no se ha podido crear la ubicación';
                        break;
                    case 'cu': //criador update perfil
                        $result = editaCriador($respuesta);
                        $mensaje = $result ? 'Se ha modificado el perfil correctamente' : 'no se ha podido realizar la operación';
                        header('location: home.php?action=cu');
                        break;    
                    case 'cp': //criador update password
                        var_dump($_POST);
                        break;    
                    default:
                        # code...
                        break;
                }

            }else{
                $mensaje = ' no se ha podido realizar la operación';
            }

    }

}

include '../header.php';
include 'menu-criador.php';
include "../footer.php"; 