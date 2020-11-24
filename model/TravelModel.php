<?php


class TravelModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function saveTravel($travel){

    $expectedFuel = $travel["expectedFuel"];
    $expectedKilometers = $travel["expectedKilometers"];
    $origin = $travel["origin"];
    $destination = $travel["destination"];
    $departureDate = $travel["departureDate"];
    $estimatedArrivalDate = $travel["estimatedArrivalDate"];

    $sql = "INSERT INTO viaje (consumo_combustible_previsto, kilometros_previstos, origen, destino,  fecha_salida ,  fecha_llegada_estimada)
                VALUES ('$expectedFuel', '$expectedKilometers', '$origin', '$destination', '$departureDate', '$estimatedArrivalDate')";

    $this->database->execute($sql);

    }

    public function getTravels()
    {
        $sql = "SELECT * FROM viaje";
        return $this->database->query($sql);
    }

    public function getTravelById($travelId)
    {
        $sql = "SELECT * FROM viaje WHERE id_viaje = '$travelId'";
        return $this->database->query($sql);
    }

    public function changeExpectedFuel($travelId, $newExpectedFuel)
    {
        $sql = "UPDATE viaje SET consumo_combustible_previsto = '$newExpectedFuel' WHERE  id_viaje = '$travelId'";
        $this->database->execute($sql);
    }

    public function changeRealFuel($travelId, $newRealFuel)
    {
        $sql = "UPDATE viaje SET consumo_combustible_real = '$newRealFuel' WHERE  id_viaje = '$travelId'";
        $this->database->execute($sql);
    }

    public function changeExpectedKilometers($travelId, $newExpectedKilometers)
    {
        $sql = "UPDATE viaje SET kilometros_previstos = '$newExpectedKilometers' WHERE  id_viaje = '$travelId'";
        $this->database->execute($sql);
    }

    public function changeRealKilometers($travelId, $newRealKilometers)
    {
        $sql = "UPDATE viaje SET kilometros_reales = '$newRealKilometers' WHERE  id_viaje = '$travelId'";
        $this->database->execute($sql);
    }

    public function changeOrigin($travelId, $newOrigin)
    {
        $sql = "UPDATE viaje SET origen = '$newOrigin' WHERE  id_viaje = '$travelId'";
        $this->database->execute($sql);
    }

    public function changeDestination($travelId, $newDestination)
    {
        $sql = "UPDATE viaje SET destino = '$newDestination' WHERE  id_viaje = '$travelId'";
        $this->database->execute($sql);
    }

    public function changeDepartureDate($travelId, $newDepartureDate)
    {
        $sql = "UPDATE viaje SET fecha_salida = '$newDepartureDate' WHERE  id_viaje = '$travelId'";
        $this->database->execute($sql);
    }

    public function changeEstimatedArrivalDate($travelId, $newEstimatedArrivalDate)
    {
        $sql = "UPDATE viaje SET fecha_llegada_estimada = '$newEstimatedArrivalDate' WHERE  id_viaje = '$travelId'";
        $this->database->execute($sql);
    }

    public function changeArrivalDate($travelId, $newArrivalDate)
    {
        $sql = "UPDATE viaje SET fecha_llegada = '$newArrivalDate' WHERE  id_viaje = '$travelId'";
        $this->database->execute($sql);
    }



    public function deleteTravelById($travelId)
    {
        $sql = "DELETE FROM viaje WHERE id_viaje = '$travelId'";
        $this->database->execute($sql);
    }

    public function convertDatetimeFromMySQLToHTMLOf($travelArray) {
        is_null($travelArray[0]["fecha_salida"]) ? $travelArray[0]["fecha_salida"] = ""
            : $travelArray[0]["fecha_salida"] = date("Y-m-d\TH:i:s", strtotime($travelArray[0]["fecha_salida"]));

        is_null($travelArray[0]["fecha_llegada"]) ? $travelArray[0]["fecha_llegada"] = ""
            : $travelArray[0]["fecha_llegada"] = date("Y-m-d\TH:i:s", strtotime($travelArray[0]["fecha_llegada"]));

        is_null($travelArray[0]["fecha_llegada_estimada"]) ? $travelArray[0]["fecha_llegada_estimada"] = ""
            : $travelArray[0]["fecha_llegada_estimada"] = date("Y-m-d\TH:i:s", strtotime($travelArray[0]["fecha_llegada_estimada"]));

        return $travelArray;
    }

}