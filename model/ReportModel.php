<?php


class ReportModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getClients() {
        $sql = "SELECT * FROM cliente";
        return $this->database->query($sql);
    }

    public function saveNewProforma($newProforma) {
        $idClient = $_POST["idClient"];
        $idTravel = $_POST["idTravel"];
        $expectedViaticos = $_POST["expectedViaticos"];
        $expectedToll = $_POST["expectedToll"];
        $expectedExtras = $_POST["expectedExtras"];
        $expectedHazardCost = $_POST["expectedHazardCost"];
        $expectedReeferCost = $_POST["expectedReeferCost"];
        $expectedFeeCost = $_POST["expectedFeeCost"];
        $actualDate = date("Y-m-d");


        $sql = "INSERT INTO proforma (fecha_carga_proforma, id_cliente, id_viaje, viatico_estimado, peaje_y_pesaje_estimado, extras_estimado, hazard_estimado, reefer_estimado, fee_estimado)
            VALUES ('$actualDate', '$idClient', '$idTravel', '$expectedViaticos','$expectedToll', '$expectedExtras', '$expectedHazardCost', '$expectedReeferCost', '$expectedFeeCost')";

        $this->database->execute($sql);
    }

    public function generatePdfProforma(){
        require('third-party/fpdf/fpdf.php');
        $idProforma = $this->getLastId();
        $valueIdProforma = $idProforma["id"];
        $actualDate = date("Y-m-d");
        $clientName = $this->getClientName($valueIdProforma);
        $valueClientName = $clientName["result"];
        $cuit = $this->getClientCuit($valueIdProforma);
        $valueCuit = $cuit["result"];
        $address = $this->getClientAddress($valueIdProforma);
        $valueAddress = $address["result"];
        $phone = $this->getClientPhone($valueIdProforma);
        $valuePhone = $phone["result"];
        $email = $this->getClientEmail($valueIdProforma);
        $valueEmail = $email["result"];
        $contact1 = $this->getClientContact1($valueIdProforma);
        $valueContact1 = $contact1["result"];
        $contact2 = $this->getClientContact2($valueIdProforma);
        $valueContact2 = $contact2["result"];

        $idTravel = $_POST["idTravel"];
        $origin = $this->getTravelOrigin($valueIdProforma);
        $valueOrigin = $origin["result"];
        $destination = $this->getTravelDestination($valueIdProforma);
        $valueDestination = $destination["result"];
        $uploadDate = $this->getTravelUploadDate($valueIdProforma);
        $valueUploadDate = $uploadDate["result"];

        $typeLoad = $_POST["typeLoad"];
        $netWeight = $_POST["netWeight"];
        $hazard = $_POST["hazard"];
        $imoClass = $_POST["imoClass"];
        $reefer = $_POST["reefer"];
        $temperature = $_POST["temperature"];

        $expectedKilometers = $this->getTravelExpectedKm($valueIdProforma);
        $valueExpectedkm = $expectedKilometers["result"];
        $expectedFuel = $this->getTravelExpectedFuel($valueIdProforma);
        $valueExpectedFuel = $expectedFuel["result"];
        $expectedEtd = $this->getTravelExpectedEtd($valueIdProforma);
        $valueExpectedEtd = $expectedEtd["result"];
        $expectedEta = $this->getTravelExpectedEta($valueIdProforma);
        $valueExpectedEta = $expectedEta["result"];
        $expectedViaticos = $this->getExpectedViaticos($valueIdProforma);
        $valueExpectedViaticos = $expectedViaticos["result"];
        $expectedToll = $this->getExpectedToll($valueIdProforma);
        $valueExpectedToll = $expectedToll["result"];
        $expectedExtras = $this->getExpectedExtras($valueIdProforma);
        $valueExpectedExtras = $expectedExtras["result"];
        $expectedHazardCost = $this->getExpectedHazardCost($valueIdProforma);
        $valueExpectedHazardCost = $expectedHazardCost["result"];
        $expectedReeferCost = $this->getExpectedReeferCost($valueIdProforma);
        $valueExpectedReeferCost  = $expectedReeferCost["result"];
        $expectedFeeCost = $this->getExpectedFeeCost($valueIdProforma);
        $valueExpectedFeeCost  = $expectedFeeCost["result"];

        $driver = $this->getDriverForTravel($valueIdProforma);
        $valueDriver  = $driver["result"];

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(150, 10, utf8_decode("N° $valueIdProforma"), 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Fecha", 1);
        $pdf->Cell(100, 10, "$actualDate", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "", 0, 1);
        $pdf->Cell(50, 10, "Cliente", 0, 1);
        $pdf->Cell(50, 10, utf8_decode("Denominación"), 1, 0);
        $pdf->Cell(100, 10, "$valueClientName", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "CUIT", 1, 0);
        $pdf->Cell(100, 10, "$valueCuit", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, utf8_decode("Dirección"), 1, 0);
        $pdf->Cell(100, 10, "$valueAddress", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, utf8_decode("Teléfono"), 1, 0);
        $pdf->Cell(100, 10, "$valuePhone", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Email", 1, 0);
        $pdf->Cell(100, 10, "$valueEmail", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Contacto 1", 1, 0);
        $pdf->Cell(100, 10, "$valueContact1", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Contacto 2", 1, 0);
        $pdf->Cell(100, 10, "$valueContact2", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "", 0, 1);

        $pdf->Cell(50, 10, "Viaje", 0, 1);
        $pdf->Cell(50, 10, "Origen", 1, 0);
        $pdf->Cell(100, 10, "$valueOrigin", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Destino", 1, 0);
        $pdf->Cell(100, 10, "$valueDestination", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Fecha de Carga", 1, 0);
        $pdf->Cell(100, 10, "$valueUploadDate", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "", 0, 1);

        $pdf->Cell(50, 10, "Carga", 0, 1);
        $pdf->Cell(50, 10, "Tipo", 1, 0);
        $pdf->Cell(100, 10, "$typeLoad", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Peso Neto", 1, 0);
        $pdf->Cell(100, 10, "$netWeight", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Hazard", 1, 0);
        $pdf->Cell(25, 10, "$hazard", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "IMO Class", 1, 0);
        $pdf->Cell(25, 10, "$imoClass", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Reefer", 1, 0);
        $pdf->Cell(25, 10, "$reefer", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "Temperatura", 1, 0);
        $pdf->Cell(25, 10, "$temperature", 1, 0, 'C', 0);

        $pdf->AddPage();
        $pdf->Cell(50, 10, "Costeo", 0, 1);
        $pdf->Cell(50, 10, "", 0, 0);
        $pdf->Cell(50, 10, "Estimado", 0, 0, 'C');
        $pdf->Cell(50, 10, "Real", 0, 1, 'C');
        $pdf->Cell(50, 10, "Kilometros", 1, 0);
        $pdf->Cell(50, 10, "$valueExpectedkm", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Combustible", 1, 0);
        $pdf->Cell(50, 10, "$valueExpectedFuel", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "ETD", 1, 0);
        $pdf->Cell(50, 10, "$valueExpectedEtd", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "ETA", 1, 0);
        $pdf->Cell(50, 10, "$valueExpectedEta", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Viaticos", 1, 0);
        $pdf->Cell(50, 10, "$valueExpectedViaticos", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Peajes y Pesajes", 1, 0);
        $pdf->Cell(50, 10, "$valueExpectedToll", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Extras", 1, 0);
        $pdf->Cell(50, 10, "$valueExpectedExtras", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Hazard", 1, 0);
        $pdf->Cell(50, 10, "$valueExpectedHazardCost", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Reefer", 1, 0);
        $pdf->Cell(50, 10, "$valueExpectedReeferCost", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Fee", 1, 0);
        $pdf->Cell(50, 10, "$valueExpectedFeeCost", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Total", 1, 0);
        $pdf->Cell(50, 10, "", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "", 0, 1);

        $pdf->Cell(50, 10, "Personal", 0, 1);
        $pdf->Cell(50, 10, "Chofer Asignado", 1, 0);
        $pdf->Cell(100, 10, "$valueDriver", 1, 1, 'C', 0);

        $pdf->Output("", "Proforma $valueIdProforma - ID Viaje $idTravel");
    }


    public function getLastId(){
        $sql = "SELECT MAX(id_proforma) AS id FROM proforma";
        return $this->database->fetch_assoc($sql);

    }

    public function getClientName($idProforma){
        $sql = "SELECT denominacion as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getClientCuit($idProforma){
        $sql = "SELECT cuit as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getClientAddress($idProforma){
        $sql = "SELECT direccion as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getClientPhone($idProforma){
        $sql = "SELECT telefono as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getClientEmail($idProforma){
        $sql = "SELECT email as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getClientContact1($idProforma){
        $sql = "SELECT contacto1 as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getClientContact2($idProforma){
        $sql = "SELECT contacto2 as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getTravelOrigin($idProforma){
        $sql = "SELECT origen as result FROM viaje WHERE id_viaje IN (SELECT id_viaje FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getTravelDestination($idProforma){
        $sql = "SELECT destino as result FROM viaje WHERE id_viaje IN (SELECT id_viaje FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getTravelUploadDate($idProforma){
        $sql = "SELECT fecha_salida as result FROM viaje WHERE id_viaje IN (SELECT id_viaje FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getTravelExpectedKm($idProforma){
        $sql = "SELECT kilometros_previstos as result FROM viaje WHERE id_viaje IN (SELECT id_viaje FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getTravelExpectedFuel($idProforma){
        $sql = "SELECT consumo_combustible_previsto as result FROM viaje WHERE id_viaje IN (SELECT id_viaje FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getTravelExpectedEtd($idProforma){
        $sql = "SELECT fecha_salida_estimada as result FROM viaje WHERE id_viaje IN (SELECT id_viaje FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getTravelExpectedEta($idProforma){
        $sql = "SELECT fecha_llegada_estimada as result FROM viaje WHERE id_viaje IN (SELECT id_viaje FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->fetch_assoc($sql);
    }

    public function getExpectedViaticos($idProforma){
        $sql = "SELECT viatico_estimado as result FROM proforma WHERE id_proforma = '$idProforma'";
        return $this->database->fetch_assoc($sql);
    }

    public function getExpectedToll($idProforma){
        $sql = "SELECT peaje_y_pesaje_estimado as result FROM proforma WHERE id_proforma = '$idProforma'";
        return $this->database->fetch_assoc($sql);
    }

    public function getExpectedExtras($idProforma){
        $sql = "SELECT extras_estimado as result FROM proforma WHERE id_proforma = '$idProforma'";
        return $this->database->fetch_assoc($sql);
    }

    public function getExpectedHazardCost($idProforma){
        $sql = "SELECT hazard_estimado as result FROM proforma WHERE id_proforma = '$idProforma'";
        return $this->database->fetch_assoc($sql);
    }

    public function getExpectedReeferCost($idProforma){
        $sql = "SELECT reefer_estimado as result FROM proforma WHERE id_proforma = '$idProforma'";
        return $this->database->fetch_assoc($sql);
    }

    public function getExpectedFeeCost($idProforma){
        $sql = "SELECT fee_estimado as result FROM proforma WHERE id_proforma = '$idProforma'";
        return $this->database->fetch_assoc($sql);
    }

    public function getDriverForTravel($idProforma){
        $sql = "SELECT id_chofer as result FROM viaje_chofer WHERE id_viaje IN (SELECT id_viaje FROM proforma WHERE id_proforma = '$idProforma');";
        return $this->database->fetch_assoc($sql);
    }


}