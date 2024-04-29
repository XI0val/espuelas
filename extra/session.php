<?php
if(session_status() === PHP_SESSION_NONE){
   session_start();
/*     if (!isset($_SESSION['timeout'])) {
        $_SESSION['timeout'] = time();
    } else if (time() - $_SESSION['timeout'] > 1800) {
        session_regenerate_id(true);
        //echo ('regenerado id');  // change session ID for the current session and invalidate old session ID
        $_SESSION['timeout'] = time();  // update creation time
    } */   
}