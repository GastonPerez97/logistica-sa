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
        $expectedKilometers = $_POST["expectedKilometers"];
        $expectedFuel = $_POST["expectedFuel"];
        $expectedEtd = $_POST["expectedEtd"];
        $expectedEta = $_POST["expectedEta"];
        $expectedViaticos = $_POST["expectedViaticos"];
        $expectedToll = $_POST["expectedToll"];
        $expectedExtras = $_POST["expectedExtras"];
        $expectedHazardCost = $_POST["expectedHazardCost"];
        $expectedReeferCost = $_POST["expectedReeferCost"];
        $expectedFeeCost = $_POST["expectedFeeCost"];
        $actualDate = date("Y-m-d");


        $sql = "INSERT INTO proforma (fecha_carga_proforma, id_cliente, id_viaje, kilometraje_estimado, combustible_estimado, etd_estimado, eta_estimado, viatico_estimado, peaje_y_pesaje_estimado, extras_estimado, hazard_estimado, reefer_estimado, fee_estimado)
            VALUES ('$actualDate', '$idClient', '$idTravel', '$expectedKilometers', '$expectedFuel', '$expectedEtd', '$expectedEta', '$expectedViaticos','$expectedToll', '$expectedExtras', '$expectedHazardCost', '$expectedReeferCost', '$expectedFeeCost')";

        $this->database->execute($sql);
    }

    public function getLastId(){
        $sql = "SELECT MAX(id_proforma) AS id FROM proforma";
        return $this->database->query($sql);
    }

    public function getCompanyName($idProforma){
        $sql = "SELECT denominacion FROM cliente WHERE id_cliente IN (SELECT id_cliente FROM proforma WHERE id_proforma = '$idProforma')";
        return $this->database->query($sql);
    }


}