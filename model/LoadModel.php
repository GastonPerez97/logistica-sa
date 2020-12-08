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

    public function getTypeDangerOfLoad()
    {
        $sql = "SELECT * FROM tipo_peligro";
        return $this->database->query($sql);
    }

    public function saveNewLoad($newLoad)
    {
        $idTravel = $newLoad["idTravel"];
        $idTypeLoad = $newLoad["idTypeLoad"];
        $netWeight = $newLoad["netWeight"];
        $hazard = $newLoad["hazard"];
        $imoClass = $newLoad["imoClass"];
        $reefer = $newLoad["reefer"];
        $numberTemperature = $newLoad["numberTemperature"];

        if ($hazard!=1){
            $hazard = 0;
        }
        if ($reefer!=1){
            $reefer = 0;
        }
        if($reefer == 0){
            $numberTemperature = 0;
        }


        $sql = "INSERT INTO carga (peso, peligrosa, id_tipo_peligro, refrigerada, temperatura, id_tipo_carga, id_viaje)
            VALUES ('$netWeight',  b'$hazard', '$imoClass' , b'$reefer', '$numberTemperature','$idTypeLoad', '$idTravel')";

        $this->database->execute($sql);
    }


}