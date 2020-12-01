<?php


class LoadModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getTypeLoad()
    {
        $sql = "SELECT id_tipo_carga, nombre, descripcion FROM tipo_carga";
        return $this->database->query($sql);
    }

    public function saveNewLoad($newLoad)
    {
        $idTravel = $_POST["idTravel"];
        $idTypeLoad = $_POST["idTypeLoad"];
        $netWeight = $_POST["netWeight"];
        $hazard = $_POST["hazard"];
        $reefer = $_POST["reefer"];
        $temperature = $_POST["temperature"];

        $sql = "INSERT INTO carga (peso, fragil, refrigerada, temperatura, id_tipo_carga, id_viaje)
            VALUES ('$netWeight',  b'$hazard',  b'$reefer', '$temperature','$idTypeLoad', '$idTravel')";

        $this->database->execute($sql);
    }


}