<?php
require_once 'base-model.php';

 class CriadorModel extends BaseModel{
    private $id_criador;
    private $nombre;
    private $primer_apellido;
    private $segundo_apellido;
    private $dni;
    private $ciudad;
    private $password;
    private $imagen;


    function __construct(...$args)
    {
        //creamos objeto conexion del padre
        parent::__construct();

        if (count($args) > 0) {
            if (is_a($args[0], "CriadorModel")) {//si nos llega un objeto Criador
                $this->id_criador = 0;
                $this->nombre = $args[0]->getnombre();
                $this->primer_apellido = $args[0]->getprimer_apellido();
                $this->segundo_apellido = $args[0]->getsegundo_apellido();
                $this->dni = $args[0]->getdni();
                $this->ciudad = $args[0]->getciudad();
                $this->password = $args[0]->getpassword();
                $this->imagen = $args[0]->getimagen();
            } else {//si es un array
                $this->id_criador = 0;
                $this->nombre = $args[0]["nombre"];
                $this->primer_apellido = $args[0]["primer_apellido"];
                $this->segundo_apellido = $args[0]["segundo_apellido"];
                $this->dni = $args[0]["dni"];
                $this->ciudad = $args[0]["ciudad"];
                $this->password = $args[0]["password"];
                $this->imagen = $args[0]["imagen"];
            }
        }
    }

    //getters / setters
    public function getidcriador()
    {
        return $this->id_criador;
    }
    public function setidcriador($id_criador)
    {
        $this->id_criador = $id_criador;
    }
    public function getnombre()
    {
        return $this->nombre;
    }
    public function setnombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getprimer_apellido()
    {
        return $this->primer_apellido;
    }
    public function setprimer_apellido($primer_apellido)
    {
        $this->primer_apellido = $primer_apellido;
    }
    public function getsegundo_apellido()
    {
        return $this->segundo_apellido;
    }
    public function setsegundo_apellido($segundo_apellido)
    {
        $this->segundo_apellido = $segundo_apellido;
    }
    public function getpassword()
    {
        return $this->password;
    }
    public function setpassword($password)
    {
        $this->password = $password;
    }
    public function getdni()
    {
        return $this->dni;
    }
    public function setdni($dni)
    {
        $this->dni = $dni;
    }
    public function getciudad()
    {
        return $this->ciudad;
    }
    public function setciudad($ciudad)
    {
        $this->ciudad = $ciudad;
    }
    public function getimagen()
    {
        return $this->imagen;
    }
    public function setimagen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * actualización de los datos de un usuario
     * $datos = array con los campos a actualizar
     * se devuelve true o false
     */
    function actualizaCriador($datos)
    {
        //print_r($datos);

        $correcto = false;

        $sql = "";
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try {

                foreach ($datos as $key => $value) {
                    //solo actualizamos los valores que nos interesan y nunca el id_criador
                    if ($value != null && $key != "id_criador") {
                        $sql = "UPDATE criador SET " . $key . " = ? WHERE id_criador = ?";

                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$value, $datos["id_criador"]]);
                    }
                }

                //actualizamos los valores en $_SESSION para el criador
                foreach ($datos as $key => $value) {
                    if(isset($_SESSION['criador'][$key]) && $key != 'id_criador' && $key != 'imagen'){

                        $_SESSION['criador'][$key] = $value;
                    }
                }
                $correcto = true;

            } catch (Exception $e) {
                echo $e->getMessage();
                $correcto = false;
            }
            return $correcto;
        } else {
            return false;
        }
    }


    /**
     * funcion que borra un usuario de la bbdd
     */
    function eliminaCriador($id_criador)
    {

        $pdo = $this->getpdo();
        if ($pdo != null) {
            $sql = "Delete from criador where id_criador = ?";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([$id_criador]);
        } else {
            echo 'errorDB';

        }
    }

    /**
     * recuperamos los datos de la criador por su dni
     * devolvemos null o array con los datos del criador
     */
    function criadorPorDni($dni)
    {
        
        $pdo = $this->getpdo();
        if ($pdo != null) {

            $stmt = $pdo->prepare("SELECT * FROM criador where dni = :dni");
            $stmt->bindParam(":dni", $dni, PDO::PARAM_STR);
            $stmt->execute();

            $rows = $stmt->rowCount();
            if ($rows === 1) {
                $datos = $stmt->fetch(\PDO::FETCH_ASSOC);//cargamos en datos el resultado
            } else {
                $datos = null;
            }
            return $datos;
        } else {
            echo 'errorDB';

        }
    }

    /**
     * comprueba si existe el dni en cuestión
     */
    function compruebaDni($dni)
    {
        $pdo = $this->getpdo();
        if ($pdo != null) {
            $stmt = $pdo->prepare("SELECT dni FROM criador where dni = :dni");
            $stmt->execute([':dni' => $dni]);
            $rows = $stmt->rowCount();
            return ($rows === 1) ? true : false;
        } else {
            echo 'errorDB';

        }
    }


    /**
     * Inserción de un nuevo criador (SOLO LO EJECUTA EL ADMIN DESDE POSTMAN)
     * Se recibe objeto de la clase CriadorModel 
     * 
     */
    public function altaCriador($criador)
    {

        $pdo = $this->getpdo();
        if ($pdo != null) {
            $sqlp = "INSERT INTO criador VALUES(?, ?, ?, ?, ? ,? ,? ,?)";

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {

                $stmt = $pdo->prepare($sqlp);
                $stmt->execute([
                    null,
                    $criador->getnombre(),
                    $criador->getprimer_apellido(),
                    $criador->getsegundo_apellido(),
                    $criador->getdni(),
                    $criador->getciudad(),
                    $criador->getpassword(),
                    $criador->getimagen()
                ]);
                //devolvemos el id del criador añadido;
                $id_criador = $pdo->lastInsertId();
                return $id_criador;

            } catch (\Exception $e) {
                return $e;//se devuelve error
            }
        } else {
            echo 'errorDB';
        }
    }

 }

 