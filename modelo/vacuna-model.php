<?php
require_once 'base-model.php';

 class VacunaModel extends BaseModel{
    private $id_vacuna;
    private $fech_vacunacion;
    private $nombre;


    function __construct(...$args)
    {
        //creamos objeto conexion del padre
        parent::__construct();

        if (count($args) > 0) {
            if (is_a($args[0], "VacunaModel")) {//si nos llega un objeto Criador
                $this->id_vacuna = $args[0]->getidvacuna();
                $this->fech_vacunacion = $args[0]->getfechvacunacion();
                $this->nombre = $args[0]->getnombre();

            } else {//si es un array
                $this->id_vacuna = $args[0]["id_vacuna"];
                $this->fech_vacunacion = $args[0]["fech_vacunacion"];
                $this->nombre = $args[0]["nombre"];
            }
        }
    }

    //getters / setters
    public function getidvacuna()
    {
        return $this->id_vacuna;
    }    
    public function setidvacuna($id_vacuna)
    {
        $this->id_vacuna = $id_vacuna;
    }
    public function getfechvacunacion()
    {
        return $this->fech_vacunacion;
    }
    public function setfechvacunacion($fech_vacunacion)
    {
        $this->fech_vacunacion = $fech_vacunacion;
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
     * actualización de los datos de una vacuna
     * $vacuna = objeto de la clase VacunaModel con los campos a actualizar
     * se devuelve true o false
     */
    function actualizaVacuna($vacuna)
    {

        $result = false;

        $sql = "";
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try {

                foreach ($vacuna as $key => $value) {
                    //solo actualizamos los valores que nos interesan y nunca el id_vacuna
                    if ($value != null && $key != "id_vacuna") {
                        $sql = "UPDATE vacuna SET " . $key . " = ? WHERE id_vacuna = ?";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$value, $vacuna["id_vacuna"]]);
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
     * funcion que borra una vacuna de la bbdd
     */
    function eliminaVacuna($id_vacuna)
    {
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try{
                $sql = "Delete from vacuna where id_vacuna = ?";
                $stmt = $pdo->prepare($sql);
                return $stmt->execute([$id_vacuna]);

            }catch(Exception $e){
                echo $e->getMessage();
                $result = false;
            }
        } else {
            echo 'errorDB';

        }
    }

    /**
     * funcion que inserta una vacuna de la bbdd
     * se devuelve el id de la vacuna creada
     */
    function insertavacuna($vacuna)
    {
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try{
                $sql = "INSERT INTO vacuna VALUES(?, ?, ?)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    null,
                    $datos->getfechvacunacion(),
                    $datos->getnombre(),
                ]);
                $id_vacuna = $pdo->lastInsertId();
                return $id_vacuna;


            }catch(Exception $e){
                echo $e->getMessage();
                $result = false;
            }
        } else {
            echo 'errorDB';

        }
    }

    /**
     * recuperamos los datos de la vacuna por su id
     * devolvemos null o array con los datos de la vacuna
     */
    function vacunaPorId($id_vacuna)
    {
        
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try{
                $stmt = $pdo->prepare("SELECT * FROM vacuna where id_vacuna = :idvacuna");
                $stmt->bindParam(":idvacuna", $id_vacuna, PDO::PARAM_STR);
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