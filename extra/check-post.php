<?php

function checkPost($postData){
    $datos = ['id_criador' => $_SESSION['criador']['id_criador']];
    $error = false;
    $msjError = 'No se ha podido realizar la operación.';
    switch ($postData['form']) {
        //form alta animal
        case 'ac':
            //$datos['imagen'] = IMAGEN_SIN_FOTO_ANIMAL;
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
                        case 'confoto':
                            //guardamos imagen en la carpeta del criador
                            if(guardaFoto('animal')) {
                                //actualizamos foto en BD
                                $datos['imagen'] = $_SESSION['datosAnimal']['imagen'];
                                $error = false;
                            }else{
                                echo 'el error esta al guardar la foto';
                                $error = true;  
                            };                        
                        default:
                            # code...
                            break;
                    }
                }else{
                    $error = true;
                }
            }
            break;
        //form borra animal
        case 'ad':
            if(checkNumerico($postData['id_animal'])) {
                $datos['id_animal'] = $postData['id_animal'];
            }else{
                $error = true;
            }  
            break;            
        //form alta ubicacion
        case 'uc':
        //form update ubicacion
        case 'uu':
            $datos['id_ubicacion'] = $postData['form'] == 'uc' ? 0 : $_SESSION['datosUbicacion']['id_ubicacion'];
            foreach ($postData as $key => $value) {
                if(checkString($key)){
                    switch ($key) {
                        case 'latitud':
                        case 'longitud':
                            if(checkCoordenada($value)){
                                $datos[$key] = $value;
                            }else{ 
                                $error = true;
                            }
                            break;
                        case 'nombre':
                            if(checkString($value)){
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
            //form borra ubicacion
            case 'ud':
                if(checkNumerico($postData['id_ubicacion'])) {
                    $datos['id_ubicacion'] = $postData['id_ubicacion'];
                }else{
                    $error = true;
                }    
        //form criador perfil (update foto / update datos)
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
                            if(guardaFoto('criador')) {
                                //actualizamos foto en BD
                                $datos['imagen'] = $_SESSION['criador']['imagen'];
                                $error = false;
                                //var_dump($datosCriador);
                                //if(!editaCriador($datos)){
                                    //$_SESSION['uploadMsj'] = 'No se ha podido guardar la imagen el al base de datos';
                                //}
                            }else{
                                echo 'el error esta al guardar la foto';
                                $error = true;  
                            };
                        default:
                            break;
                    }
                }else{
                    $error = true;
                }
            }
            break;
        case 'pu': //form cambio password
            //si las passwords cumplen la directiva de seguridad
            if(validaPass($postData['pass']) && validaPass($postData['pass2'])){
                //si son iguales
                $passwords = [$postData['pass'], $postData['pass2']];
                if(comparaPasswords($passwords)){
                    //si es correcto encriptamos y guardamos la pass para actualizar el criador
                    $datos['password'] = hashPassword($postData['pass']);
                }else{
                    $error = true; $msjError = 'Las contraseñas no coinciden!';
                }
            }else{
                $error = true; $msjError = 'Las contraseñas no cumplen las condiciones!';
            }
            break;
        default:
        $error = true;
            break;
    }
    //print_r($_POST);
    //si error true se devuelve error, si error flase se devuelven los datos correctos
    return $error ? $msjError : $datos;
}