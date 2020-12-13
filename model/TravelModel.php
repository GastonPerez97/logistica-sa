<?php


class TravelModel {

    private $reportModel;
    private $database;

    public function __construct($reportModel, $database) {
        $this->database = $database;
        $this->reportModel = $reportModel;
    }

    public function saveTravel($travel) {
        $expectedFuel = $travel["expectedFuel"];
        $expectedKilometers = $travel["expectedKilometers"];
        $origin = $travel["origin"];
        $destination = $travel["destination"];
        $estimatedArrivalDate = $travel["estimatedArrivalDate"];
        $estimatedDepartureDate = $travel["estimatedDepartureDate"];
        $driverId = $travel["driverId"];
        $idClient = $travel["idClient"];

        $insertTravel = $this->database->prepare("INSERT INTO viaje
                                            (consumo_combustible_previsto, kilometros_previstos, origen, destino, 
                                            fecha_llegada_estimada, fecha_salida_estimada, id_cliente)
                                            VALUES (?, ?, ?, ?, ?, ?, ?)");

        $insertTravel->bind_param("ddssssi", $expectedFuel, $expectedKilometers, $origin, $destination, $estimatedArrivalDate, $estimatedDepartureDate, $idClient);
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
        $sql = "SELECT * FROM viaje V JOIN viaje_chofer VC ON V.id_viaje = VC.id_viaje
                                      JOIN chofer C ON VC.id_chofer = C.id_chofer
                                      JOIN usuario U ON C.id_usuario = U.id_usuario";
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

    public function getRealFuelOf($travelId) {
        $sql = "SELECT consumo_combustible_real FROM viaje WHERE id_viaje = '$travelId'";
        $result = $this->database->fetch_assoc($sql);
        return $result["consumo_combustible_real"];
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
    public function changeEstimatedDepartureDate($travelId, $newEstimatedDepartureDate)
    {
        $sql = "UPDATE viaje SET fecha_salida_estimada = '$newEstimatedDepartureDate' WHERE  id_viaje = '$travelId'";
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

        $currentFuel = $this->getRealFuelOf($travelId);
        $totalFuel = $currentFuel + $quantity;
        $this->changeRealFuel($travelId, $totalFuel);

        $proformaId = $this->reportModel->getIdProformaOf($travelId);
        $currentViatico = $this->reportModel->getRealViaticos($proformaId);
        $totalViatico = $currentViatico + $amount;
        $this->reportModel->setRealViaticos($proformaId, $totalViatico);
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

        $transportUnitId = $this->getTransportUnitIdOf($travelId);
        $transportUnitIdResult = $transportUnitId[0]["id_unidad_de_transporte"];

        $sql = "UPDATE unidad_de_transporte SET posicion_actual = 'http://www.google.com/maps/place/$lat,$long'
                                                    WHERE id_unidad_de_transporte = '$transportUnitIdResult'";
        $this->database->execute($sql);
    }

    public function getTransportUnitIdOf($travelId) {
        $sql = "SELECT id_unidad_de_transporte FROM viaje_unidad_de_transporte WHERE id_viaje = '$travelId'";
        return $this->database->query($sql);
    }

    public function convertDatetimeFromMySQLToHTMLOf($travelArray) {
        is_null($travelArray[0]["fecha_salida"]) ? $travelArray[0]["fecha_salida"] = ""
            : $travelArray[0]["fecha_salida"] = date("Y-m-d\TH:i:s", strtotime($travelArray[0]["fecha_salida"]));

        is_null($travelArray[0]["fecha_salida_estimada"]) ? $travelArray[0]["fecha_salida_estimada"] = ""
            : $travelArray[0]["fecha_salida_estimada"] = date("Y-m-d\TH:i:s", strtotime($travelArray[0]["fecha_salida_estimada"]));

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

    public function validateSpend() {
        if ((!empty($_POST["spendType"]) && !empty($_POST["amount"]))
            && (($_POST["spendType"] == "viatico_real"
            || $_POST["spendType"] == "peaje_y_pesaje_real"
            || $_POST["spendType"] == "extras_real"
            || $_POST["spendType"] == "hazard_real"
            || $_POST["spendType"] == "reefer_real"
            || $_POST["spendType"] == "fee_real"))) {

            return true;
        } else {
            return false;
        }
    }

}