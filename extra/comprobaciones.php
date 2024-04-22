<?php 

/**
 * comprobamos que dni y password estan correctamente formados
 * comprobamos si existen en bd
 * si todo correcto devuelve true, si error devuelve false
 */
function checkLogin() {
    if(isset($_POST['dni']) && isset($_POST['password']) && isset($_POST['login'])) {
        $errores = [];
        //filtramos dni primero para eliminar caracteres distintos de números o letras
        $dni = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['dni']);

        $pass = $_POST['password'];

        //chequeamos dni y password
        if(!ckeckDni($dni)) {
            $errores['dni'] = 'mal dni';
        }
        if(!ckeckPass($pass)) {
            $errores['pass'] = 'mal password';
        }

        //si no hay errores ciframos pass
        $passCifrada = cifraPassword($pass);

        //comprobamos credenciales en bd
        $logado = checkCredenciales($dni, $passCifrada);

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
function checkDni($dni){}

/**
 * comprobamos si la password cumple los criterios que exigimos
 * devuelve true si correcto, false si erroneo
 */
function checkPass($pass){}

/**
 * comprobamos si las credenciales son correctas en bd para hacer login
 * devuelve true si correcto, false si erroneo
 */
function checkCredenciales($dni, $pass){}

/**
 * ciframos la contraseña antes de guardarla en bd
 * devuelve la password cifrada
 */
function cifraPassword($pass){}