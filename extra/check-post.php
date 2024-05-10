<?php

function checkPost($postData){
    $datos = ['id_criador' => $_SESSION['criador']['id_criador']];
    $error = false;
    switch ($postData['form']) {
        //form alta animal
        case 'ac':
        //form update animal
        case 'au':    
            $datos['id_animal'] = $postData['form'] == 'ac' ? 0 : $_SESSION['datosAnimal']['id_animal'];
            foreach ($postData as $key => $value) {
                //echo ' clave = ' .$key. ' valor = ' .$value;
                if(checkString($key)){
                    switch ($key) {
                        case 'nombre':
                        case 'raza':
                        case 'sexo':
                        case 'esterilizado':
                        case 'objetivo':
                            if(checkString($value)){
                                $datos[$key] = $value;
                            }else{ $error = true;}
                            break;
                        case 'fech_nacimiento':
                            if(checkFecha($value)){
                                $datos[$key] = $value;
                                //$datos[$key] = giraFecha($value);
                            }else{ $error = true;} 
                            break;
                        case 'id_ubicacion':
                        case 'id_familia':
                            if(checkNumerico($value)){
                                $datos[$key] = $value;
                            }else{ $error = true;} 
                        break;
                        default:
                            # code...
                            break;
                    }
                }else{
                    $error = true;
                }
            }
            break;
        //form alta ubicacion
        case 'uc':
            $datos['id_ubicacion'] = 0;            
            if(checkString($postData['nombre'])) {
                $datos['nombre'] = $postData['nombre'];
            }else{
                $error = true;
            }
            break;
        //form borra ubicacion
        case 'ud':
            if(checkNumerico($postData['id_ubicacion'])) {
                $datos['id_ubicacion'] = $postData['id_ubicacion'];
            }else{
                $error = true;
            }  
        //form update ubicacion
        case 'uu':
            if(checkNumerico($postData['id_ubicacion'])) {
                $datos['id_ubicacion'] = $postData['id_ubicacion'];
            }else{
                $error = true;
            }            
            if(checkString($postData['nombre'])) {
                $datos['nombre'] = $postData['nombre'];
            }else{
                $error = true;
            }            
            break;
        //form criador perfil (cambio pass / update foto / update datos)
        case 'cu':
            foreach ($postData as $key => $value) {
                if(checkString($key)){
                    switch ($key) {
                        case 'nombre':
                        case 'primer_apellido':
                        case 'segundo_apellido':
                        case 'dni':
                        case 'ciudad':
                            if(checkString($value)){
                                $datos[$key] = $value;
                            }else{ $error = true;} 
                            break;
                        case 'confoto':
                            //guardamos imagen en la carpeta del criador
                            if(guardaFoto()) {
                                //actualizamos foto en BD
                                $datos['imagen'] = $_SESSION['criador']['imagen'];
                            };
                        default:
                            break;
                    }
                }
            }
            if(isset($_POST['confoto'])){
                //si se ha elegido una foto y es correcta
                if(guardaFoto()) {
                    //actualizamos foto en BD
                    $datosCriador = ['id_criador' => $_SESSION['criador']['id_criador'], 'imagen' => $_SESSION['criador']['imagen']];
                    if(!editaCriador($datosCriador)){
                        $_SESSION['uploadMsj'] = 'No se ha podido guardar la imagen el al base de datos';
                    }
                };
                var_dump($_SESSION);
                header('location: home.php?action=cu');
               }else{
                    
               }                                      
        default:
            $error = true;
            break;
    }
    //si error true se devuelve error, si error flase se devuelven los datos correctos
    return $error ? $error : $datos;
}