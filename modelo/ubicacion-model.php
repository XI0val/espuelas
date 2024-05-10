<?php
require_once 'base-model.php';

 class UbicacionModel extends BaseModel{
    private $id_ubicacion;
    private $nombre;
    private $id_criador;


    function __construct(...$args)
    {
        //creamos objeto conexion del padre
        parent::__construct();

        if (count($args) > 0) {
            if (is_a($args[0], "UbicacionModel")) {//si nos llega un objeto Criador
                $this->id_ubicacion = $args[0]->getidubicacion();
                $this->nombre = $args[0]->getnombre();
                $this->id_criador = $args[0]->getidcriador();
            } else {//si es un array
                $this->id_ubicacion = $args[0]["id_ubicacion"];
                $this->nombre = $args[0]["nombre"];
                $this->id_criador = $args[0]["id_criador"];
            }
        }
    }

    //getters / setters
    public function getidubicacion()
    {
        return $this->id_ubicacion;
    }    
    public function setidubicacion($id_ubicacion)
    {
        $this->id_ubicacion = $id_ubicacion;
    }
    public function getnombre()
    {
        return $this->nombre;
    }
    public function setnombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getidcriador()
    {
        return $this->id_criador;
    }    
    public function setidcriador($id_criador)
    {
        $this->id_criador = $id_criador;
    }

    /**
     * actualización de los datos de una ubicacion
     * $ubicacion = objeto de la clase UbicacionModel con los campos a actualizar
     * se devuelve true o false
     */
    function actualizaUbicacion($ubicacion)
    {

        $result = false;

        $sql = "";
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try {

                foreach ($ubicacion as $key => $value) {
                    //solo actualizamos los valores que nos interesan y nunca el id_ubicacion
                    if ($value != null && $key != "id_ubicacion") {
                        $sql = "UPDATE ubicacion SET " . $key . " = ? WHERE id_ubicacion = ?";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$value, $ubicacion->getidubicacion()]);
                    }
                }
                $result = '¡Actualización correcta!';

            } catch (Exception $e) {
                $result = $e->getMessage();
            }
            return $result;
        } else {
            return 'sin acceso a BD';
        }
    }


    /**
     * funcion que borra una ubicacion de la bbdd
     */
    function eliminaUbicacion($id_ubicacion)
    {
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try{
                $sql = "Delete from ubicacion where id_ubicacion = ?";
                $stmt = $pdo->prepare($sql);
                return $stmt->execute([$id_ubicacion]);

            }catch(Exception $e){
                $result = $e->getMessage();
                return false;
            }
        } else {
            return false;

        }
    }

    /**
     * funcion que inserta una ubicacion de la bbdd
     * se recibe un objeto Ubicacion
     * se devuelve el id de la ubicacion creada
     */
    function insertaUbicacion($ubicacion)
    {
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try{
                $sql = "INSERT INTO ubicacion VALUES(?, ?, ?)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    null,
                    $ubicacion->getnombre(),
                    $ubicacion->getidcriador(),
                ]);
                $id_ubicacion = $pdo->lastInsertId();
                return $id_ubicacion;


            }catch(Exception $e){
                echo $e->getMessage();
                $result = false;
            }
        } else {
            echo 'errorDB';

        }
    }

    /**
     * recuperamos los datos de la ubicacion por su id
     * devolvemos null o array con los datos de la ubicacion
     */
    function ubicacionPorId($id_ubicacion)
    {
        
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try{
                $stmt = $pdo->prepare("SELECT * FROM ubicacion where id_ubicacion = :idCriador");
                $stmt->bindParam(":idCriador", $id_ubicacion, PDO::PARAM_STR);
                $stmt->execute();
        
                $rows = $stmt->rowCount();
                if ($rows === 1) {
                    $datos = $stmt->fetch(\PDO::FETCH_ASSOC);//cargamos en datos el resultado
                } else {
                    $datos = null;
                }
                return $datos;
            }catch(Exception $e){
                echo $e->getMessage();
                $result = false;
            }
        } else {
            echo 'errorDB';

        }
    }

    /**
     * recupera la lista de ubicaciones de un criador
     */
    function recuperaUbicaciones($id_criador) {
        $pdo = $this->getpdo();
        if ($pdo != null) {
            $datos = [];
            try{
                $stmt = $pdo->prepare("SELECT * FROM ubicacion where id_criador = :idCriador");
                $stmt->bindParam(":idCriador", $id_criador, PDO::PARAM_STR);
                $stmt->execute();
                while($rows = $stmt->fetch(\PDO::FETCH_ASSOC)){
                    $datos[] = $rows;
                }      
                return $datos;
            }catch(Exception $e){
                echo $e->getMessage();
                $result = false;
            }
        } else {
            echo 'errorDB';

        }
    }
}