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
 * funcion que solicita borrado de una ubicacion
 * recibe un id_ubicacion para borrar
 */
function borraUbicacion($id_ubicacion){
    $resultDelete = (new UbicacionModel())->eliminaUbicacion($id_ubicacion);
    return $resultDelete;    
}

/**
 * funcion que recupera la lista de ubicaciones de un criador
 */
function listaUbicaciones($id_criador) {
    $resultLista = (new UbicacionModel())->recuperaUbicaciones($id_criador);
    return $resultLista;
}