<?php
include 'conexionbd.php';
class BaseModel
{
    private $bd;

    public function __construct()
    {

        $this->bd = new Conexiondb();
    }

    public function getpdo()
    {
        return $this->bd->conectar();
    }
}