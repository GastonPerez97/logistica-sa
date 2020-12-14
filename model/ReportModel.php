<?php


class ReportModel {

    private $database;
    private $QRModel;

    public function __construct($QRModel, $database) {
        $this->database = $database;
        $this->QRModel = $QRModel;
    }

    public function getClients() {
        $sql = "SELECT * FROM cliente";
        return $this->database->query($sql);
    }

    public function saveNewProforma($newProforma) {
        $idTravel = $newProforma["idTravel"];
        $expectedViaticos = $newProforma["expectedViaticos"];
        $expectedToll = $newProforma["expectedToll"];
        $expectedExtras = $newProforma["expectedExtras"];
        $expectedHazardCost = $newProforma["expectedHazardCost"];
        $expectedReeferCost = $newProforma["expectedReeferCost"];
        $expectedFeeCost = $newProforma["expectedFeeCost"];
        $actualDate = date("Y-m-d");

        $sql = "INSERT INTO proforma (fecha_carga_proforma, id_viaje, viatico_estimado, peaje_y_pesaje_estimado, extras_estimado, hazard_estimado, reefer_estimado, fee_estimado)
            VALUES ('$actualDate', '$idTravel', '$expectedViaticos','$expectedToll', '$expectedExtras', '$expectedHazardCost', '$expectedReeferCost', '$expectedFeeCost')";

        $this->database->execute($sql);
    }

    public function generatePdfProformaOf($idProforma) {
        require('third-party/fpdf/fpdf.php');
        $actualDate = date("Y-m-d");
        $idTravel = $_POST["idTravel"];
        $origin = $this->getTravelOrigin($idProforma);
        $valueOrigin = $origin["result"];
        $destination = $this->getTravelDestination($idProforma);
        $valueDestination = $destination["result"];
        $uploadDate = $this->getTravelUploadDate($idProforma);
        $valueUploadDate = $uploadDate["result"];


        $clientName = $this->getClientName($idTravel);
        $valueClientName = $clientName["result"];
        $cuit = $this->getClientCuit($idTravel);
        $valueCuit = $cuit["result"];
        $address = $this->getClientAddress($idTravel);
        $valueAddress = $address["result"];
        $phone = $this->getClientPhone($idTravel);
        $valuePhone = $phone["result"];
        $email = $this->getClientEmail($idTravel);
        $valueEmail = $email["result"];
        $contact1 = $this->getClientContact1($idTravel);
        $valueContact1 = $contact1["result"];
        $contact2 = $this->getClientContact2($idTravel);
        $valueContact2 = $contact2["result"];


        $idTypeLoad = $_POST["idTypeLoad"];
        $nameLoad = $this->getNameLoad($idTypeLoad);
        $valueNameLoad = $nameLoad["result"];
        $netWeight = $_POST["netWeight"];

        $imoClass = $_POST["imoClass"];
        $imoClass = $this->getImoClassLoad($imoClass);
        $valueImoClass = $imoClass["result"];

        $hazard = $this->getHazardLoad($idTravel);
        $valueHazard = $hazard["result"];
        if($valueHazard == 0){
            $hazard = 'No';
            $valueImoClass = '-';
        } else{
            $hazard = 'Si';
        }

        $reefer = $this->getReeferLoad($idTravel);
        $valueReefer = $reefer["result"];
        if($valueReefer == 0){
            $reefer = 'No';
        } else{
            $reefer = 'Si';
        }
        $numberTemperature = $_POST["numberTemperature"];

        $expectedKilometers = $this->getTravelExpectedKm($idProforma);
        $valueExpectedkm = $expectedKilometers["result"];
        $expectedFuel = $this->getTravelExpectedFuel($idProforma);
        $valueExpectedFuel = $expectedFuel["result"];
        $expectedEtd = $this->getTravelExpectedEtd($idProforma);
        $valueExpectedEtd = $expectedEtd["result"];
        $formatValueExpectedEtd = date('Y-m-d H:i', strtotime($valueExpectedEtd));
        $expectedEta = $this->getTravelExpectedEta($idProforma);
        $valueExpectedEta = $expectedEta["result"];
        $formatValueExpectedEta = date('Y-m-d H:i', strtotime($valueExpectedEta));
        $expectedViaticos = $this->getExpectedViaticos($idProforma);
        $valueExpectedViaticos = $expectedViaticos["result"];
        $expectedToll = $this->getExpectedToll($idProforma);
        $valueExpectedToll = $expectedToll["result"];
        $expectedExtras = $this->getExpectedExtras($idProforma);
        $valueExpectedExtras = $expectedExtras["result"];
        $expectedHazardCost = $this->getExpectedHazardCost($idProforma);
        $valueExpectedHazardCost = $expectedHazardCost["result"];
        $expectedReeferCost = $this->getExpectedReeferCost($idProforma);
        $valueExpectedReeferCost  = $expectedReeferCost["result"];
        $expectedFeeCost = $this->getExpectedFeeCost($idProforma);
        $valueExpectedFeeCost  = $expectedFeeCost["result"];

        $driver = $this->getDriverForTravel($idProforma);
        $valueDriver  = $driver["result"];

        $totalExpected = ($valueExpectedViaticos + $valueExpectedToll + $valueExpectedExtras + $valueExpectedHazardCost + $valueExpectedReeferCost + $valueExpectedFeeCost);

        $qr = $this->QRModel->generateQROfReportOf($idTravel);

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->Image($qr,161, 0, 50, 0, "png");

        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(150, 10, utf8_decode("N° $idProforma"), 1, 1, 'C', 0);
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
        $pdf->Cell(100, 10, "$valueNameLoad", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Peso Neto", 1, 0);
        $pdf->Cell(100, 10, "$netWeight Kg", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Hazard", 1, 0);
        $pdf->Cell(25, 10, "$hazard", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "IMO Class", 1, 0);
        $pdf->Cell(25, 10, "$valueImoClass", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Reefer", 1, 0);
        $pdf->Cell(25, 10, "$reefer", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "Temperatura", 1, 0);
        $pdf->Cell(25, 10, utf8_decode("$numberTemperature °"), 1, 0, 'C', 0);

        $pdf->AddPage();
        $pdf->Cell(50, 10, "Costeo", 0, 1);
        $pdf->Cell(50, 10, "", 0, 0);
        $pdf->Cell(50, 10, "Estimado", 0, 0, 'C');
        $pdf->Cell(50, 10, "Real", 0, 1, 'C');
        $pdf->Cell(50, 10, "Kilometros", 1, 0);
        $pdf->Cell(50, 10, "$valueExpectedkm KM", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Combustible", 1, 0);
        $pdf->Cell(50, 10, "$valueExpectedFuel L", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "ETD", 1, 0);
        $pdf->Cell(50, 10, "$formatValueExpectedEtd", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "ETA", 1, 0);
        $pdf->Cell(50, 10, "$formatValueExpectedEta", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Viaticos", 1, 0);
        $pdf->Cell(50, 10, "$ $valueExpectedViaticos", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Peajes y Pesajes", 1, 0);
        $pdf->Cell(50, 10, "$ $valueExpectedToll", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Extras", 1, 0);
        $pdf->Cell(50, 10, "$ $valueExpectedExtras", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Hazard", 1, 0);
        $pdf->Cell(50, 10, "$ $valueExpectedHazardCost", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Reefer", 1, 0);
        $pdf->Cell(50, 10, "$ $valueExpectedReeferCost", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Fee", 1, 0);
        $pdf->Cell(50, 10, "$ $valueExpectedFeeCost", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Total", 1, 0);
        $pdf->Cell(50, 10, "$ $totalExpected", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "", 0, 1);

        $pdf->Cell(50, 10, "Personal", 0, 1);
        $pdf->Cell(50, 10, "Chofer Asignado", 1, 0);
        $pdf->Cell(100, 10, "$valueDriver", 1, 1, 'C', 0);

        $pdf->Output("", "Proforma $idProforma - ID Viaje $idTravel");
    }

    public function renderPdfProformaOf($idProforma) {
        require('third-party/fpdf/fpdf.php');
        $proforma = $this->getProformaBy($idProforma);

        $proformaCreationDate = $proforma["fecha_carga_proforma"];
        $clientName = $proforma["denominacion"];
        $cuit = $proforma["cuit"];
        $address = $proforma["direccion"];
        $phone = $proforma["telefono"];
        $email = $proforma["email"];
        $contact1 = $proforma["contacto1"];
        $contact2 = $proforma["contacto2"];

        $idTravel = $proforma["id_viaje"];
        $origin = $proforma["origen"];
        $destination = $proforma["destino"];
        $uploadDate = $proforma["fecha_salida"];

        $nameLoad = $proforma["nombre"];

        $netWeight = $proforma["peso"];
        $reefer = $proforma["refrigerada"];
        $temperature = $proforma["temperatura"];

        $expectedKilometers = $proforma["kilometros_previstos"];
        $expectedFuel = $proforma["consumo_combustible_previsto"];
        $expectedEtd = $proforma["fecha_salida_estimada"];
        $formatExpectedEtd = date('Y-m-d H:i', strtotime($expectedEtd));
        $expectedEta = $proforma["fecha_llegada_estimada"];
        $formatExpectedEta = date('Y-m-d H:i', strtotime($expectedEta));
        $expectedViaticos = $proforma["viatico_estimado"];
        $expectedToll = $proforma["peaje_y_pesaje_estimado"];
        $expectedExtras = $proforma["extras_estimado"];
        $expectedHazardCost = $proforma["hazard_estimado"];
        $expectedReeferCost = $proforma["reefer_estimado"];
        $expectedFeeCost = $proforma["fee_estimado"];

        $realKilometers = $proforma["kilometros_reales"];
        $realFuel = $proforma["consumo_combustible_real"];
        $realEtd = $proforma["fecha_salida"];
        $formatRealEtd = date('Y-m-d H:i', strtotime($realEtd));
        $realEta = $proforma["fecha_llegada"];
        $formatRealEta = date('Y-m-d H:i', strtotime($realEta));
        $realViaticos = $proforma["viatico_real"];
        $realToll = $proforma["peaje_y_pesaje_real"];
        $realExtras = $proforma["extras_real"];
        $realHazardCost = $proforma["hazard_real"];
        $realReeferCost = $proforma["reefer_real"];
        $realFeeCost = $proforma["fee_real"];

        $driver = $proforma["id_chofer"];
        $driverLicenceNumber = $proforma["numero_licencia"];

        $totalExpected = $expectedViaticos
                       + $expectedToll
                       + $expectedExtras
                       + $expectedHazardCost
                       + $expectedReeferCost
                       + $expectedFeeCost;

        $totalReal = $realViaticos
                    + $realToll
                    + $realExtras
                    + $realHazardCost
                    + $realReeferCost
                    + $realFeeCost;

        $qr = $this->QRModel->generateQROfReportOf($idTravel);

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->AliasNbPages();

        $pdf->Image($qr,161, 0, 50, 0, "png");

        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(150, 10, utf8_decode("N° $idProforma"), 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Fecha", 1);
        $pdf->Cell(100, 10, "$proformaCreationDate", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "", 0, 1);
        $pdf->Cell(50, 10, "Cliente", 0, 1);
        $pdf->Cell(50, 10, utf8_decode("Denominación"), 1, 0);
        $pdf->Cell(100, 10, "$clientName", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "CUIT", 1, 0);
        $pdf->Cell(100, 10, "$cuit", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, utf8_decode("Dirección"), 1, 0);
        $pdf->Cell(100, 10, "$address", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, utf8_decode("Teléfono"), 1, 0);
        $pdf->Cell(100, 10, "$phone", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Email", 1, 0);
        $pdf->Cell(100, 10, "$email", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Contacto 1", 1, 0);
        $pdf->Cell(100, 10, "$contact1", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Contacto 2", 1, 0);
        $pdf->Cell(100, 10, "$contact2", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "", 0, 1);

        $pdf->Cell(50, 10, "Viaje", 0, 1);
        $pdf->Cell(50, 10, "Origen", 1, 0);
        $pdf->Cell(100, 10, "$origin", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Destino", 1, 0);
        $pdf->Cell(100, 10, "$destination", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Fecha de Carga", 1, 0);
        $pdf->Cell(100, 10, "$uploadDate", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "", 0, 1);

        $pdf->Cell(50, 10, "Carga", 0, 1);
        $pdf->Cell(50, 10, "Tipo", 1, 0);
        $pdf->Cell(100, 10, "$nameLoad", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Peso Neto", 1, 0);
        $pdf->Cell(100, 10, "$netWeight Kg", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Reefer", 1, 0);
        $pdf->Cell(25, 10, "$reefer", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "Temperatura", 1, 0);
        $pdf->Cell(25, 10, utf8_decode("$temperature °"), 1, 0, 'C', 0);

        $pdf->AddPage();
        $pdf->Cell(50, 10, "Costeo", 0, 1);
        $pdf->Cell(50, 10, "", 0, 0);
        $pdf->Cell(50, 10, "Estimado", 0, 0, 'C');
        $pdf->Cell(50, 10, "Real", 0, 1, 'C');
        $pdf->Cell(50, 10, "Kilometros", 1, 0);
        $pdf->Cell(50, 10, "$expectedKilometers KM", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "$realKilometers KM", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Combustible", 1, 0);
        $pdf->Cell(50, 10, "$expectedFuel L", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "$realFuel L", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "ETD", 1, 0);
        $pdf->Cell(50, 10, "$formatExpectedEtd", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "$formatRealEtd", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "ETA", 1, 0);
        $pdf->Cell(50, 10, "$formatExpectedEta", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "$formatRealEta", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Viaticos", 1, 0);
        $pdf->Cell(50, 10, "$ $expectedViaticos", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "$ $realViaticos", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Peajes y Pesajes", 1, 0);
        $pdf->Cell(50, 10, "$ $expectedToll", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "$ $realToll", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Extras", 1, 0);
        $pdf->Cell(50, 10, "$ $expectedExtras", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "$ $realExtras", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Hazard", 1, 0);
        $pdf->Cell(50, 10, "$ $expectedHazardCost", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "$ $realHazardCost", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Reefer", 1, 0);
        $pdf->Cell(50, 10, "$ $expectedReeferCost", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "$ $realReeferCost", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Fee", 1, 0);
        $pdf->Cell(50, 10, "$ $expectedFeeCost", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "$ $realFeeCost", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Total", 1, 0);
        $pdf->Cell(50, 10, "$" . "$totalExpected", 1, 0, 'C', 0);
        $pdf->Cell(50, 10, "$" . "$totalReal", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "", 0, 1);

        $pdf->Cell(50, 10, "Personal", 0, 1);
        $pdf->Cell(50, 10, "Chofer Asignado", 1, 0);
        $pdf->Cell(100, 10, "$driver", 1, 1, 'C', 0);
        $pdf->Cell(50, 10, "Numero Licencia", 1, 0);
        $pdf->Cell(100, 10, "$driverLicenceNumber", 1, 1, 'C', 0);

        $pdf->Output("", "Proforma $idProforma - ID Viaje $idTravel");
    }

    public function getProformaBy($proformaId) {
        $sql = "SELECT * FROM proforma P JOIN viaje V ON P.id_viaje = V.id_viaje
                         JOIN viaje_chofer VC ON v.id_viaje = VC.id_viaje
                         JOIN chofer CHOFER ON VC.id_chofer = CHOFER.id_chofer
                         JOIN cliente C ON V.id_cliente = C.id_cliente
                         JOIN carga CARGA ON V.id_viaje = CARGA.id_viaje
                         JOIN tipo_carga TC ON CARGA.id_tipo_carga = TC.id_tipo_carga
                WHERE id_proforma = '$proformaId'";

        $result = $this->database->query($sql);
        return $result[0];
    }

    public function getIdProformaOf($travelId) {
        $sql = "SELECT id_proforma FROM proforma WHERE id_viaje = '$travelId'";
        $result = $this->database->query($sql);

        return $result[0]["id_proforma"];
    }

    public function checkIfProformaAlreadyExistsOf($travelId) {
        $sql = "SELECT * FROM proforma WHERE id_viaje = '$travelId'";
        $result = $this->database->query($sql);

        if (empty($result)) {
            return false;
        } else {
            return true;
        }
    }

    public function getLastId(){
        $sql = "SELECT MAX(id_proforma) AS id FROM proforma";
        return $this->database->fetch_assoc($sql);
    }

    public function reportSpendOf($proformaId, $spendData) {
        $spendType = $spendData["spendType"];
        $amount = $spendData["amount"];

        $currentSpendValueSql = "SELECT $spendType FROM proforma WHERE id_proforma = '$proformaId'";
        $result = $this->database->fetch_assoc($currentSpendValueSql);
        $currentSpendValue = $result[$spendType];

        $totalSpendValue = $currentSpendValue + $amount;

        $updateSpendValueSql = "UPDATE proforma SET $spendType = '$totalSpendValue' WHERE id_proforma = '$proformaId'";
        $this->database->execute($updateSpendValueSql);
    }

    public function generatePdfOfServiceRecord(){
        require('third-party/fpdf/fpdfService.php');

        $actualDate = date("Y-m-d");

        $pdf = new FPDF();
        $pdf->AddPage();
        $reportData= $this->serviceReport();
        $maxService = $this->maxService();

        $maxKm = $this->maxKm();
        $valueIdVehicleMaxKm = $maxKm["id_vehiculo"];
        $valueVehicleMaxKm = $maxKm["max"];

        $maxCost = $this->maxCost();
        $valueIdVehicleMaxCost = $maxCost["id_vehiculo"];
        $valueVehicleMaxCost = $maxCost["costo"];


        $pdf->FancyTable($reportData, $maxService, $valueVehicleMaxKm, $valueIdVehicleMaxKm, $valueVehicleMaxCost, $valueIdVehicleMaxCost);

        $pdf->Output("", "Historial de Mantenimiento al $actualDate");
    }

    public function getClientName($idTravel){
        $sql = "SELECT denominacion as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM viaje WHERE id_viaje = '$idTravel')";
        return $this->database->fetch_assoc($sql);
    }

    public function getClientCuit($idTravel){
        $sql = "SELECT cuit as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM viaje WHERE id_viaje = '$idTravel')";
        return $this->database->fetch_assoc($sql);
    }

    public function getClientAddress($idTravel){
        $sql = "SELECT direccion as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM viaje WHERE id_viaje = '$idTravel')";
        return $this->database->fetch_assoc($sql);
    }

    public function getClientPhone($idTravel){
        $sql = "SELECT telefono as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM viaje WHERE id_viaje = '$idTravel')";
        return $this->database->fetch_assoc($sql);
    }

    public function getClientEmail($idTravel){
        $sql = "SELECT email as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM viaje WHERE id_viaje = '$idTravel')";
        return $this->database->fetch_assoc($sql);
    }

    public function getClientContact1($idTravel){
        $sql = "SELECT contacto1 as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM viaje WHERE id_viaje = '$idTravel')";
        return $this->database->fetch_assoc($sql);
    }

    public function getClientContact2($idTravel){
        $sql = "SELECT contacto2 as result FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM viaje WHERE id_viaje = '$idTravel')";
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

    public function getNameLoad($idTypeLoad)
    {
        $sql = "SELECT nombre as result FROM tipo_carga WHERE id_tipo_carga = '$idTypeLoad'";
        return $this->database->fetch_assoc($sql);
    }

    public function getHazardLoad($idTravel)
    {
        $sql = "SELECT peligrosa as result FROM carga WHERE id_viaje = '$idTravel'";
        return $this->database->fetch_assoc($sql);
    }

    public function getImoClassLoad($imoClass)
    {
        $sql = "SELECT descripcion as result FROM tipo_peligro WHERE id_tipo_peligro = '$imoClass'";
        return $this->database->fetch_assoc($sql);
    }

    public function getReeferLoad($idTravel)
    {
        $sql = "SELECT refrigerada as result FROM carga WHERE id_viaje = '$idTravel'";
        return $this->database->fetch_assoc($sql);
    }

    public function getRealViaticos($proformaId){
        $sql = "SELECT viatico_real FROM proforma WHERE id_proforma = '$proformaId'";
        $result = $this->database->fetch_assoc($sql);
        return $result["viatico_real"];
    }

    public function setRealViaticos($proformaId, $newViaticos) {
        $sql = "UPDATE proforma SET viatico_real = '$newViaticos' WHERE id_proforma = '$proformaId'";
        $this->database->execute($sql);
    }

    public function serviceReport() {
        $sql = 'SELECT id_service, fecha_service, id_unidad_de_transporte as vehiculo, kilometraje_actual_unidad as KM, detalle, costo, interno FROM service ORDER BY fecha_service DESC';
        return $this->database->query($sql);
    }

    public function maxService() {
        $sql = 'SELECT se.id_unidad_de_transporte as id_vehiculo, COUNT(se.id_unidad_de_transporte) AS cantidad FROM grupo03.service se group by id_unidad_de_transporte LIMIT 1';
        $result = $this->database->fetch_assoc($sql);
        return $result["id_vehiculo"];
    }

    public function maxKm() {
        $sql = 'SELECT se.id_unidad_de_transporte as id_vehiculo, MAX(se.kilometraje_actual_unidad) as max FROM grupo03.service se';
        return $this->database->fetch_assoc($sql);
    }

    public function maxCost() {
        $sql = 'SELECT se.id_unidad_de_transporte as id_vehiculo, SUM(costo) as costo FROM grupo03.service se group by id_unidad_de_transporte';
        return $this->database->fetch_assoc($sql);
    }

}