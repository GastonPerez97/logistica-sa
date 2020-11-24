<?php


class ReportController {

    private $userRoleModel;
    private $render;

    public function __construct($userRoleModel, $render) {
        $this->render = $render;
        $this->userRoleModel = $userRoleModel;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isAdmin()) {
            echo $this->render->render("view/reportView.php");
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function newProforma() {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isAdmin()) {
            echo $this->render->render("view/newProformaView.php");
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function createProforma() {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isAdmin()) {
            require('fpdf/fpdf.php');
            $idProforma = $_POST["idProforma"];
            $actualDate = $_POST["actualDate"];
            $idTravel = $_POST["idTravel"];
            $denominacion = $_POST["denominacion"];
            $cuit = $_POST["cuit"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $contact1 = $_POST["contact1"];
            $contact2 = $_POST["contact2"];
            $origin = $_POST["origin"];
            $destination = $_POST["destination"];
            $uploadDate = $_POST["uploadDate"];
            $typeLoad = $_POST["typeLoad"];
            $netWeight = $_POST["netWeight"];
            $hazard = $_POST["hazard"];
            $imoClass = $_POST["imoClass"];
            $reefer = $_POST["reefer"];
            $temperature = $_POST["temperature"];
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
            $driver = $_POST["driver"];


            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->AliasNbPages();
            $pdf->SetFont('Arial', '', 16);
            $pdf->Cell(150, 10, utf8_decode("N° $idProforma"), 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "Fecha", 1);
            $pdf->Cell(100, 10, "$actualDate", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "", 0,1);
            $pdf->Cell(50, 10, "Cliente",0,1);
            $pdf->Cell(50, 10, utf8_decode("Denominación"), 1, 0);
            $pdf->Cell(100, 10, "$denominacion", 1, 1, 'C', 0);
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
            $pdf->Cell(50, 10, "", 0,1);

            $pdf->Cell(50, 10, "Viaje",0,1);
            $pdf->Cell(50, 10, "Origen", 1, 0);
            $pdf->Cell(100, 10, "$origin", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "Destino", 1, 0);
            $pdf->Cell(100, 10, "$destination", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "Fecha de Carga", 1, 0);
            $pdf->Cell(100, 10, "$uploadDate", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "", 0,1);

            $pdf->Cell(50, 10, "Carga",0,1);
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
            $pdf->Cell(50, 10, "Costeo",0,1);
            $pdf->Cell(50, 10, "", 0,0);
            $pdf->Cell(50, 10, "Estimado", 0,0, 'C');
            $pdf->Cell(50, 10, "Real", 0,1, 'C');
            $pdf->Cell(50, 10, "Kilometros", 1, 0);
            $pdf->Cell(50, 10, "$expectedKilometers", 1, 0, 'C', 0);
            $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "Combustible", 1, 0);
            $pdf->Cell(50, 10, "$expectedFuel", 1, 0, 'C', 0);
            $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "ETD", 1, 0);
            $pdf->Cell(50, 10, "$expectedEtd", 1, 0, 'C', 0);
            $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "ETA", 1, 0);
            $pdf->Cell(50, 10, "$expectedEta", 1, 0, 'C', 0);
            $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "Viaticos", 1, 0);
            $pdf->Cell(50, 10, "$expectedViaticos", 1, 0, 'C', 0);
            $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "Peajes y Pesajes", 1, 0);
            $pdf->Cell(50, 10, "$expectedToll", 1, 0, 'C', 0);
            $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "Extras", 1, 0);
            $pdf->Cell(50, 10, "$expectedExtras", 1, 0, 'C', 0);
            $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "Hazard", 1, 0);
            $pdf->Cell(50, 10, "$expectedHazardCost", 1, 0, 'C', 0);
            $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "Reefer", 1, 0);
            $pdf->Cell(50, 10, "$expectedReeferCost", 1, 0, 'C', 0);
            $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "Fee", 1, 0);
            $pdf->Cell(50, 10, "$expectedFeeCost", 1, 0, 'C', 0);
            $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "Total", 1, 0);
            $pdf->Cell(50, 10, "", 1, 0, 'C', 0);
            $pdf->Cell(50, 10, "", 1, 1, 'C', 0);
            $pdf->Cell(50, 10, "", 0,1);

            $pdf->Cell(50, 10, "Personal",0,1);
            $pdf->Cell(50, 10, "Chofer Asignado", 1, 0);
            $pdf->Cell(100, 10, "$driver", 1, 1, 'C', 0);

            $pdf->Output("", "Proforma $idProforma - ID Viaje $idTravel");
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

}