<?php
require_once 'base-model.php';

 class AnimalModel extends BaseModel{
    private $id_animal;
    private $nombre;
    private $raza;
    private $fech_nacimiento;
    private $sexo;
    private $esterilizado;
    private $objetivo;
    private $id_familia;
    private $id_ubicacion;
    private $id_criador;


    function __construct(...$args)
    {
        //creamos objeto conexion del padre
        parent::__construct();

        if (count($args) > 0) {
            if (is_a($args[0], "AnimalModel")) {//si nos llega un objeto Criador
                $this->id_animal = $args[0]->getidanimal();
                $this->nombre = $args[0]->getnombre();
                $this->raza = $args[0]->getraza();
                $this->fech_nacimiento = $args[0]->getfechnacimiento();
                $this->sexo = $args[0]->getsexo();
                $this->esterilizado = $args[0]->getesterilizado();
                $this->objetivo = $args[0]->getobjetivo();
                $this->id_familia = $args[0]->getidfamilia();
                $this->id_ubicacion = $args[0]->getidubicacion();
                $this->id_criador = $args[0]->getidcriador();
            } else {//si es un array
                $this->id_animal = $args[0]["id_animal"];
                $this->nombre = $args[0]["nombre"];
                $this->raza = $args[0]["raza"];
                $this->fech_nacimiento = $args[0]["fech_nacimiento"];
                $this->sexo = $args[0]["sexo"];
                $this->esterilizado = $args[0]["esterilizado"];
                $this->objetivo = $args[0]["objetivo"];
                $this->id_familia = $args[0]["id_familia"];
                $this->id_ubicacion = $args[0]["id_ubicacion"];
                $this->id_criador = $args[0]["id_criador"];
            }
        }
    }

    //getters / setters
    public function getidanimal()
    {
        return $this->id_animal;
    }
    public function setidanimal($id_animal)
    {
        $this->id_animal = $id_animal;
    }
    public function getnombre()
    {
        return $this->nombre;
    }
    public function setnombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getraza()
    {
        return $this->raza;
    }
    public function setraza($raza)
    {
        $this->raza = $raza;
    }
    public function getfechnacimiento()
    {
        return $this->fech_nacimiento;
    }
    public function setfechnacimiento($fech_nacimiento)
    {
        $this->fech_nacimiento = $fech_nacimiento;
    }
    public function getsexo()
    {
        return $this->sexo;
    }
    public function setsexo($sexo)
    {
        $this->sexo = $sexo;
    }
    public function getesterilizado()
    {
        return $this->esterilizado;
    }
    public function setesterilizado($esterilizado)
    {
        $this->esterilizado = $esterilizado;
    }
    public function getobjetivo()
    {
        return $this->objetivo;
    }
    public function setobjetivo($objetivo)
    {
        $this->objetivo = $objetivo;
    }
    public function getidfamilia()
    {
        return $this->id_familia;
    }
    public function setidfamilia($id_familia)
    {
        $this->id_familia = $id_familia;
    }
    public function getidubicacion()
    {
        return $this->id_ubicacion;
    }    
    public function setidubicacion($id_ubicacion)
    {
        $this->id_ubicacion = $id_ubicacion;
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
     * actualización de los datos de un animal
     * $animal = objeto de la clase AnimalModel con los campos a actualizar
     * se devuelve true o false
     */
    function actualizaAnimal($animal)
    {

        $result = false;

        $sql = "";
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try {

                foreach ($animal as $key => $value) {
                    //solo actualizamos los valores que nos interesan y nunca el id_animal
                    if ($value != null && $key != "id_animal") {
                        $sql = "UPDATE animal SET " . $key . " = ? WHERE id_animal = ?";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$value, $animal["id_animal"]]);
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
     * funcion que borra un animal de la bbdd
     */
    function eliminaAnimal($id_animal)
    {
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try{
                $sql = "Delete from animal where id_animal = ?";
                $stmt = $pdo->prepare($sql);
                return $stmt->execute([$id_animal]);

            }catch(Exception $e){
                echo $e->getMessage();
                $result = false;
            }
        } else {
            echo 'errorDB';

        }
    }

    /**
     * funcion que inserta un animal de la bbdd 
     * se devuelve el id del animal creado o error
     */
    function insertaAnimal($animal)
    {
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try{
                $sql = "INSERT INTO animal VALUES(?, ?, ?, ?, ?, ?, ?, ?, ? ,?)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    null,
                    $animal->getnombre(),
                    $animal->getraza(),
                    $animal->getfechnacimiento(),
                    $animal->getsexo(),
                    $animal->getesterilizado(),
                    $animal->getobjetivo(),
                    $animal->getidfamilia(),
                    $animal->getidubicacion(),
                    $animal->getidcriador(),
                ]);
                $id_animal = $pdo->lastInsertId();
                return $id_animal;

            }catch(Exception $e){
                echo $e->getMessage();
                return false;
            }
        } else {
            return false;

        }
    }

    /**
     * recuperamos los datos del animal por su id
     * devolvemos null o array con los datos del animal
     */
    function animalPorId($id_animal)
    {
        
        $pdo = $this->getpdo();
        if ($pdo != null) {
            try{
                $stmt = $pdo->prepare("SELECT * FROM animal where id_animal = :idanimal");
                $stmt->bindParam(":idanimal", $id_animal, PDO::PARAM_STR);
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
     * recuperamos la lista de todas las familias de los animales
     */
    function recuperaFamilias() 
    {
        $pdo = $this->getpdo();
        if ($pdo != null) {
            $datos = [];
            try{
                $stmt = $pdo->prepare("SELECT * FROM familia");
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
    /**
     * recuperamos la lista de todos los animales del criador
     */
    function recuperaAnimales($id_criador) 
    {
           $pdo = $this->getpdo();
        if ($pdo != null) {
            $datos = [];
            try{
                $stmt = $pdo->prepare("SELECT * FROM animal where id_criador = :idCriador");
                $stmt->bindParam(":idCriador", $id_criador, PDO::PARAM_STR);
                $stmt->execute();
                while($rows = $stmt->fetch(\PDO::FETCH_ASSOC)){
                    $datos[] = $rows;
                }      
                return $datos;
            }catch(Exception $e){
                echo $e->getMessage();
                return false;
            }
        } else {
            return false;

        }
    }

}