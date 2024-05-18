<?php

include '../../extra/session.php';
include '../../modelo/animal-model.php';

if(!isset($_SESSION['criador']['dni'])){
    header('Location: ../../index.php');
}

/**
 * función que solicita el alta de un animal
 * convierte el array recibido en un objeto Animal
 * devuelve el resultado de la operación
 */
function altaAnimal($datos) {
    $animalModel = new AnimalModel($datos);
    //print_r($animal);
    $resultAlta = $animalModel->insertaAnimal($animalModel);
    return $resultAlta;
}

/**
 * funcion que solicita actualización de un animal
 * recibe un objeto animal con los datos a actualizar
 */
function editaAnimal($animal){
    $resultUpdate = (new AnimalModel())->actualizaAnimal($animal);
    return $resultUpdate;    
}

/**
 * funcion que solicita borrado de un animal
 * recibe un id_animal para borrar
 */
function borraAnimal($id_animal){
    $resultDelete = (new AnimalModel())->eliminaAnimal($id_animal);
    return $resultDelete;    
}

/**
 * funcion que recupera animal por su id
 * recibe el id_animal que se buscará
 */
function animalPorId($id_animal){
    $resultQuery = (new AnimalModel())->animalPorId($id_animal);
    return $resultQuery;    
}

/**
 * funcion que recupera la lista de ubicaciones de un criador
 */
function listaAnimales($id_criador) {
    $resultLista = (new AnimalModel())->recuperaAnimales($id_criador);
    return $resultLista;
}

/**
 * funcion que recupera la lista de familias de los animales
 */
function listaFamilias() {
    $resultLista = (new AnimalModel())->recuperaFamilias();
    return $resultLista;
}