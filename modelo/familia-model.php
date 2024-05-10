<?php
require_once 'base-model.php';

 class FamiliaModel extends BaseModel{
    private $id_familia;
    private $nombre;


    function __construct(...$args)
    {
        //creamos objeto conexion del padre
        parent::__construct();

        if (count($args) > 0) {
            if (is_a($args[0], "FamiliaModel")) {//si nos llega un objeto Criador
                $this->id_familia = $args[0]->getidfamilia();
                $this->nombre = $args[0]->getnombre();

            } else {//si es un array
                $this->id_familia = $args[0]["id_familia"];
                $this->nombre = $args[0]["nombre"];
            }
        }
    }

    //getters / setters
    public function getidfamilia()
    {
        return $this->id_familia;
    }    
    public function setidfamilia($id_familia)
    {
        $this->id_familia = $id_familia;
    }
    public function getnombre()
    {
        return $this->nombre;
    }
    public function setnombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * actualización de los datos de una familia
     * $familia = objeto de la clase FamiliaModel con los campos a actualizar
     * se devuelve true o false
     */
    function actualizaFamilia($familia)
    {

        $result = false;

        $sql = "";
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try {

                foreach ($familia as $key => $value) {
                    //solo actualizamos los valores que nos interesan y nunca el id_familia
                    if ($value != null && $key != "id_familia") {
                        $sql = "UPDATE familia SET " . $key . " = ? WHERE id_familia = ?";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$value, $Familia["id_familia"]]);
                    }
                }
                $result = true;

            } catch (Exception $e) {
                echo $e->getMessage();
                $result = false;
            }
            return $result;
        } else {
            echo 'errorDB';
        }
    }


    /**
     * funcion que borra una Familia de la bbdd
     */
    function eliminaFamilia($id_familia)
    {
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try{
                $sql = "Delete from familia where id_familia = ?";
                $stmt = $pdo->prepare($sql);
                return $stmt->execute([$id_familia]);

            }catch(Exception $e){
                echo $e->getMessage();
                $result = false;
            }
        } else {
            echo 'errorDB';

        }
    }

    /**
     * funcion que inserta una Familia de la bbdd
     * se devuelve el id de la Familia creada
     */
    function insertaFamilia($familia)
    {
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try{
                $sql = "INSERT INTO familia VALUES(?, ?)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    null,
                    $datos->getnombre(),
                ]);
                $id_familia = $pdo->lastInsertId();
                return $id_familia;


            }catch(Exception $e){
                echo $e->getMessage();
                $result = false;
            }
        } else {
            echo 'errorDB';

        }
    }

    /**
     * recuperamos los datos de la Familia por su id
     * devolvemos null o array con los datos de la Familia
     */
    function familiaPorId($id_familia)
    {
        
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try{
                $stmt = $pdo->prepare("SELECT * FROM familia where id_familia = :idFamilia");
                $stmt->bindParam(":idFamilia", $id_familia, PDO::PARAM_STR);
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

}