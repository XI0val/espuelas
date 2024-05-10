<?php
include '../../extra/definiciones.php';
class Conexiondb
{
    private static $instance = NULL;

    public static function conectar()
    {
        try {

            if (!isset(self::$instance)) {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                self::$instance = new PDO(
                    'mysql:host=' . HOST . ';dbname=' . DBNAME, 
                    USER, 
                    PASSWORD, 
                    $pdo_options);
            }
            return self::$instance;

        } catch (PDOException $e) {
            echo 'error de conexión a bd: ' . $e;
        }
    }

}

// define('USER', 'xioval');

// define('PASSWORD', 'ainihon');

// define('HOST', 'localhost');

// define('DATABASE', 'criadero');
// try {

//     $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);

// } catch (PDOException $e) {

//     exit("Error: " . $e->getMessage());

// }
    
?>