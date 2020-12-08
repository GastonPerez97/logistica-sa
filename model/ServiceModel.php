<?php


class ServiceModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function saveNewService($newService)
    {
        $numberVehicle = $newService["numberVehicle"];
        $serviceDate = $newService["serviceDate"];
        $kilometers = $newService["kilometers"];
        $internal = intval($newService["internal"]);
        $mechanic = $newService["mechanic"];
        $description = $newService["description"];
        $cost = $newService["cost"];

        $sql = "INSERT INTO service (fecha_service, detalle, costo, kilometraje_actual_unidad, interno, id_usuario, id_unidad_de_transporte)
            VALUES ('$serviceDate', '$description', '$cost', '$kilometers', b'$internal', $mechanic, '$numberVehicle')";

        $this->database->execute($sql);
    }

    public function getServices()
    {
        $sql = "SELECT * FROM service";
        return $this->database->query($sql);
    }

    public function getServiceById($serviceId)
    {
        $sql = "SELECT * FROM service WHERE id_service = '$serviceId'";
        return $this->database->query($sql);
    }

    public function updateServiceById($serviceId, $newKilometers, $newDescription, $newCost)
    {
        $sql = "UPDATE service 
                SET kilometraje_actual_unidad = '$newKilometers', detalle = '$newDescription', costo = '$newCost'
                WHERE  id_service = '$serviceId'";
        $this->database->execute($sql);
    }

    public function deleteServiceById($serviceId)
    {
        $sql = "DELETE FROM service WHERE id_service = '$serviceId'";
        $this->database->execute($sql);
    }

}