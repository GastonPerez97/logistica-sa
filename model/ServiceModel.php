<?php


class ServiceModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function saveNewService($newService)
    {
        $numberVehicle = $newService["numberVehicle"];
        $serviceDate = $newService["serviceDate"];
        $kilometers = $newService["kilometers"];
        $mechanic = $newService["mechanic"];
        $description = $newService["description"];
        $cost = $newService["cost"];


        $sql = "INSERT INTO service (fecha_service, detalle, costo, kilometraje_actual_unidad, interno, id_usuario, id_vehiculo)
            VALUES ('$serviceDate', '$description', '$cost', '$kilometers', b'0', '$mechanic', '$numberVehicle')";

        $this->database->execute($sql);
    }

    public function getServices() {
        $sql = "SELECT * FROM service";
        return $this->database->query($sql);
    }

}