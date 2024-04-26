<?php 
include '../../extra/session.php';
include '../../modelo/criador-model.php';
/**
 * comprobamos que dni y password estan correctamente formados
 * comprobamos si existen en bd
 * si todo correcto devuelve true, si error devuelve false
 */
function checkLogin() {
    if(isset($_POST['dni']) && isset($_POST['password']) && isset($_POST['login']) && $_SESSION === []) {
        $errores = [];
        //filtramos dni primero para eliminar caracteres distintos de números o letras
        $dni = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['dni']);

        $pass = $_POST['password'];

        //chequeamos dni y password
        if(!validaDni($dni)) {
            $errores['dni'] = 'mal dni';
        }
        if(!validaPass($pass)) {
            $errores['pass'] = 'mal password';
        }

        //si no hay errores hasheamos pass
        $passHasheada = hashPassword($pass);

        //comprobamos credenciales en bd
        $logado = checkCredenciales($dni, $pass);

        if($logado) {
            return true;
        }
        
        //no se esta accediendo correctamente
    }else{
        return false;
    }
}


/**
 * comprobamos si el dni está correctamente formado
 * devuelve true si correcto, false si erroneo
 */
function validaDni($dni)
{
    //extraemos parte letra
    $letra = substr($dni, -1);
    //extraemos parte numerdnio
    $numero = substr($dni, 0, strlen($dni) - 1);
    //si es numero y es letra
    if (ctype_digit($numero) && ctype_alpha($letra)) {
        //comprobamos longitud del numero
        if (strlen($numero) >= 7 && strlen($numero) <= 8) {
            //letra en mayusculas
            $letra = strtoupper($letra);
            //extraemos codigo ascii
            $asciiCode = ord($letra);
            //si es a-z o A-Z
            if ($asciiCode >= 65 && $asciiCode <= 90) {
                return checkDni($numero, $letra);
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * se comprueba si letra y números coinciden con la fórmula del dni
 * devuelve true si correcto, false si erroneo
 */
function checkDni($numero, $letra)
{

    //array de letras para el cálculo correcto del dni
    $letras = array('T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T');

    if ($numero < 0 || $numero > 99999999) {
        return false;
    } else {
        $letraCalculada = $letras[$numero % 23];
        if ($letraCalculada != $letra) {
            return false;
        } else {
            return true;
        }
    }
}

/**
 * comprobamos si la password cumple los criterios que exigimos
 * devuelve true si correcto, false si erroneo
 */
function validaPass($pass){
    //comprobamos criterios
    $uppercase = preg_match('@[A-Z]@', $pass);//mayusculas
    $lowercase = preg_match('@[a-z]@', $pass);//minusculas
    $number    = preg_match('@[0-9]@', $pass);//numeros
    //si no clumple
    if (!$uppercase || !$lowercase || !$number || strlen($pass) < 5) {
        return false;
    }else {
        return true;
    }
}

/**
 * comprobamos si las credenciales son correctas en bd para hacer login
 * devuelve true si correcto, false si erroneo
 */
function checkCredenciales($dni, $pass){
    //recuperamos datos del usuario por dni
    $datosCriador = (new CriadorModel())->criadorPorDni($dni);
    if($datosCriador != null){
        //si pass correcta
        if(password_verify($pass, $datosCriador['password'])){
            unset($datosCriador['password']);
            $_SESSION = $datosCriador;
            //print_r(json_encode($_SESSION));
            return true;
        }
    }
    return false;
}

/**
 * hasheamos la contraseña antes de guardarla en bd
 * devuelve la password hasheada
 */
function hashPassword($pass){
    return password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
}