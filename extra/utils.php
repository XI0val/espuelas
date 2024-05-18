<?php

/***
 * acepta solo a-z, 1-9, guion medio(-) y guion bajo(_)
 * devuelve true si correcto, false si incorrecto
 */
function checkString($string){
    return preg_match("/^[\w\s-]+$/", $string);
}
/***
 * acepta fecha en formato AAAA-MM-DD
 * devuelve true si correcto, false si incorrecto
 */
function checkFecha($date){
    if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
        return true;
    } else {
        return false;
    }
}

/**
 * acepta una coordenada que contenga numeros, punto y guion si es negativo
 */
function checkCoordenada($coordenada) {
    if(preg_match("/^[\d\.\-?]+$/",$coordenada)) {
        return true;
    } else {
        return false;
    }
}


function checkNumerico($numero){
    return preg_match("/^[1-9]+$/", $numero);
}

/**
 * funcion que gira la fecha 
 * de dmaaa a aaaamd o viceversa
 */
function giraFecha($fecha){
    $partesFecha = explode("-", $fecha);
    $nuevaFecha = $partesFecha[2] . '-' . $partesFecha[1]. '-' . $partesFecha[0];
    return $nuevaFecha;

}

/**
 * limpia espacios de una string o array (delante y detrás)
 */
function limpiaEspacios($data) {
    $resultado = is_array($data) ? [] : '';
    if(is_array($data)){
        foreach($data as $key => $value) {
            $resultado[$key] = trim($value);
        }
    }else{
       $resultado = trim($data);
    }
    return $resultado;
}

/**
 * mueve una foto del directorio temporal a /imagenes
 */
function mueveFoto($datos) {
    $pathTemp = $_SESSION['datosAnimal']['imagen'];
    $partes = explode('/', $pathTemp);
    if($partes[0] === 'temporal'){
        $nuevoPath = 'imagenes/' . $datos['nombre'] . '/' . $partes[1];
        return $nuevoPath . ' y ' .$pathTemp;
       if (rename($pathTemp, $nuevoPath)) {
            //borramos el temporal
            return 'chupiguay';
/*             removeDir($pathTemp);
            $_SESSION['datosAnimal']['imagen'] = $nuevoPath;
            return true;  */
        } else {
            //error al mover la foto al server
            return 'error';
        }       
    }else{
        return false;
    }
}


function removeDir(string $dir): void {
    $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($it,
                 RecursiveIteratorIterator::CHILD_FIRST);
    foreach($files as $file) {
        if ($file->isDir()){
            rmdir($file->getPathname());
        } else {
            unlink($file->getPathname());
        }
    }
    rmdir($dir);
}


/**
 * miramos si en $_FILES se subió una foto
 * si se subió y es correcta la guardamos en el disco duro
 */
function guardaFoto($objeto) {

   $resultado = false;
    $SESSION['uploadMsj'] = '';
    // miramos si se subió un archivo sin errores
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {

        // Tamaño máximo permitido en bytes (5 MB)
        $tamanoMaximo = 5 * 1024 * 1024;

        // Tipos de archivo permitidos (jpg y png)
        $tiposPermitidos = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

        // comprobaremos el tipo MIME real del archivo
        $finfo = new finfo(FILEINFO_MIME_TYPE);

        // Obtenemos el tipo MIME real
        $tipoReal = $finfo->file($_FILES['imagen']['tmp_name']);


       
        // Validamos tamaño y tipo del archivo
         if ($_FILES['imagen']['size'] <= $tamanoMaximo && in_array($tipoReal, $tiposPermitidos)) {
            // guardamos el archivo
            $pathTemporal = $_FILES['imagen']['tmp_name'];

            $nombre = $objeto === 'criador' 
            ? $_SESSION['criador']["nombre"] . '_' . $_SESSION['criador']["primer_apellido"] . "-id-" . $_SESSION['criador']["id_criador"]
            : (isset($_SESSION['datosAnimal']["nombre"]) ? isset($_SESSION['datosAnimal']["nombre"]) : 'animal');

            $path = isset($_SESSION['datosAnimal']["nombre"]) ? "imagenes/" . $nombre : "temporal";
            $nombreFoto =  $objeto === 'criador'
            ? 'fotoPerfilCriador.' . substr($tipoReal, 6)
            : 'fotoPerfilAnimal.' . substr($tipoReal, 6);

            //ruta directorio del server donde se subira la imagen
            if (!file_exists($path)) {
                mkdir($path);
            }
            $pathDestino = $path . '/' . $nombreFoto;

            //intentamos subir foto
            if (move_uploaded_file($pathTemporal, $pathDestino)) {
                //guardamos la ruta de la imagen
                if($objeto === 'criador'){
                    $_SESSION['criador']['imagen'] = $pathDestino;
                } else {
                    $_SESSION['datosAnimal']['imagen'] = $pathDestino;
                }
                $_SESSION['uploadMsj'] = "La imagen se subió correctamente.";
                $resultado = true;

            } else {
                //error al mover la foto al server
                $_SESSION['uploadMsj'] = "Error al guardar la imagen elegida.";
            }
            
    
        } else {
            $_SESSION['uploadMsj'] = "Error: El archivo no cumple con los requisitos de tamaño o tipo.";
        } 
    } else {
        $_SESSION['uploadMsj'] = "Error al subir el archivo.";
    }
    return $resultado;
}

function clean_data($data) {
    /* trim whitespace */
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}