<?php

include '../../extra/session.php';
include '../../modelo/ubicacion-model.php';



if(!isset($_SESSION['criador']['dni'])){
    header('Location: ../../index.php');
}

/**
 * función que solicita el alta de una ubicación
 * convierte el array recibido en un objeto Ubicacion
 * devuelve el resultado de la operación
 */
function altaUbicacion($datos) {
    $ubicacionModel = new UbicacionModel($datos);
    //print_r($ubicacion);
    $resultAlta = $ubicacionModel->insertaUbicacion($ubicacionModel);
    return $resultAlta;
}

/**
 * funcion que solicita actualización de una ubicacion
 * recibe un objeto ubicacion con los datos a actualizar
 */
function editaUbicacion($ubicacion){
    $resultUpdate = (new UbicacionModel())->actualizaUbicacion($ubicacion);
    return $resultUpdate;    
}

/**
 * funcion que recupera una ubicacion por su id
 * recibe un array con los datos de la ubicación 
 */
function ubicacionPorId($id_ubicacion){
    $result = (new UbicacionModel())->ubicacionPorId($id_ubicacion);
    return $result;    
}

/**
 * funcion que solicita borrado de una ubicacion
 * recibe un id_ubicacion para borrar
 */
function borraUbicacion($id_ubicacion){
    //comprobamos si quedan animales en la ubicacion
    $animales = (new AnimalModel())->animalesPorUbicacion($id_ubicacion);
    if(is_numeric($animales) && $animales === 0){
        $resultDelete = (new UbicacionModel())->eliminaUbicacion($id_ubicacion);
        return $resultDelete ? 'Ubicación eliminada correctamente' : $resultDelete; 
    }  else {
        return 'Aún quedan animales!!, debes borrarlos antes de eliminar la ubicación.';
    }
}

/**
 * funcion que recupera la lista de ubicaciones de un criador
 */
function listaUbicaciones($id_criador) {
    $resultLista = (new UbicacionModel())->recuperaUbicaciones($id_criador);
    return $resultLista;
}