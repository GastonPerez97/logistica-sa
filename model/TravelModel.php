<?php


class TravelModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function saveTravel($travel) {

        $expectedFuel = $travel["expectedFuel"];
        $expectedKilometers = $travel["expectedKilometers"];
        $origin = $travel["origin"];
        $destination = $travel["destination"];
        $departureDate = $travel["departureDate"];
        $estimatedArrivalDate = $travel["estimatedArrivalDate"];
        $estimatedDepartureDate = $travel["estimatedDepartureDate"];
        $driverId = $travel["driverId"];

        $insertTravel = $this->database->prepare("INSERT INTO viaje
                                            (consumo_combustible_previsto, kilometros_previstos, origen, destino, 
                                            fecha_salida, fecha_llegada_estimada, fecha_salida_estimada)
                                            VALUES (?, ?, ?, ?, ?, ?, ?)");

        $insertTravel->bind_param("ddsssss", $expectedFuel, $expectedKilometers, $origin, $destination, $departureDate, $estimatedArrivalDate, $estimatedDepartureDate);
        $insertTravel->execute();

        $lastId = $this->database->query("SELECT last_insert_id()");
        $travelId = $lastId[0]["last_insert_id()"];

        $insertDriver = $this->database->prepare("INSERT INTO viaje_chofer
                                                    (id_viaje, id_chofer)
                                                    VALUES (?, ?)");

        $insertDriver->bind_param("ii", $travelId, $driverId);
        $insertDriver->execute();
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

    public function reportDetourOf($travelId, $detourData) {
        $time = $detourData["time"];
        $reason = $detourData["reason"];

        $sqlDesvio = "INSERT INTO desvio (tiempo, razon) VALUES ('$time', '$reason')";
        $this->database->execute($sqlDesvio);

        $lastId = $this->database->query("SELECT last_insert_id()");
        $desvioId = $lastId[0]["last_insert_id()"];

        $sqlViajeDesvio = "INSERT INTO viaje_desvio (id_viaje, id_desvio) VALUES ('$travelId', '$desvioId')";

        $this->database->execute($sqlViajeDesvio);
    }

    public function reportRefuelOf($travelId, $detourData) {
        $place = $detourData["place"];
        $quantity = $detourData["quantity"];
        $amount = $detourData["amount"];

        $sqlCargaCombustible = "INSERT INTO carga_combustible (lugar, cantidad, importe) VALUES ('$place', '$quantity', '$amount')";
        $this->database->execute($sqlCargaCombustible);

        $lastId = $this->database->query("SELECT last_insert_id()");
        $cargaCombustibleId = $lastId[0]["last_insert_id()"];

        $sqlViajeCargaCombustible = "INSERT INTO viaje_carga_combustible (id_viaje, id_carga_combustible) VALUES ('$travelId', '$cargaCombustibleId')";

        $this->database->execute($sqlViajeCargaCombustible);
    }

    public function reportPositionOf($travelId, $positionData) {
        $lat = $positionData["lat"];
        $long = $positionData["long"];

        $sqlPosicion = "INSERT INTO posicion (latitud, longitud) VALUES ('$lat', '$long')";
        $this->database->execute($sqlPosicion);

        $lastId = $this->database->query("SELECT last_insert_id()");
        $posicionId = $lastId[0]["last_insert_id()"];

        $sqlViajePosicion = "INSERT INTO viaje_posicion (id_viaje, id_posicion) VALUES ('$travelId', '$posicionId')";

        $this->database->execute($sqlViajePosicion);
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

    public function validateNewDetour() {
        if (empty($_POST["time"]) || empty($_POST["reason"])) {
            return false;
        } else {
            return true;
        }
    }

    public function checkIfTravelExistsBy($id) {
        $sql = "SELECT * FROM viaje WHERE id_viaje = '$id'";
        $result = $this->database->query($sql);

        if (empty($result)) {
            return false;
        } else {
            return true;
        }
    }

    public function validateNewRefuel() {
        if (empty($_POST["place"]) || empty($_POST["quantity"]) || empty($_POST["amount"])) {
            return false;
        } else {
            return true;
        }
    }

    public function validateNewPosition() {
        if (empty($_GET["lat"]) || empty($_GET["long"])) {
            return false;
        } else {
            return true;
        }
    }

}