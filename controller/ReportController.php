<?php

class ReportController {

    private $render;
    private $reportModel;
    private $travelModel;
    private $userModel;
    private $loadModel;
    private $billModel;

    public function __construct($reportModel, $travelModel, $userModel, $loadModel, $billModel, $render) {
        $this->reportModel = $reportModel;
        $this->travelModel = $travelModel;
        $this->userModel = $userModel;
        $this->loadModel = $loadModel;
        $this->billModel = $billModel;
        $this->render = $render;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["admin"] == 1) {
            if (isset($_SESSION["proformaAlreadyCreated"])) {
                $data["proformaAlreadyCreated"] = "Error: La proforma de ese viaje ya está creada. Podés consultarla en Viajes.";
                unset($_SESSION["proformaAlreadyCreated"]);

                echo $this->render->render("view/reportView.php", $data);
            } else {
                echo $this->render->render("view/reportView.php");
            }
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function newProforma() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["admin"] == 1) {
            $data["clients"] = $this->reportModel->getClients();
            $data["travels"] = $this->travelModel->getTravels();
            $data["typeLoad"] = $this->loadModel->getTypeLoad();
            $data["typeDanger"] = $this->loadModel->getTypeDangerOfLoad();
            echo $this->render->render("view/newProformaView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function createProforma() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["admin"] == 1) {
            if (!$this->reportModel->checkIfProformaAlreadyExistsOf($_POST["idTravel"])) {
                $newProforma = array(
                    "idTravel" => $_POST["idTravel"],
                    "expectedViaticos" => $_POST["expectedViaticos"],
                    "expectedToll" => $_POST["expectedToll"],
                    "expectedExtras" => $_POST["expectedExtras"],
                    "expectedHazardCost" => $_POST["expectedHazardCost"],
                    "expectedReeferCost" => $_POST["expectedReeferCost"],
                    "expectedFeeCost" => $_POST["expectedFeeCost"],
                );

                $this->reportModel->saveNewProforma($newProforma);

                $newLoad = array(
                    "idTravel" => $_POST["idTravel"],
                    "idTypeLoad" => $_POST["idTypeLoad"],
                    "netWeight" => $_POST["netWeight"],
                    "imoClass" => $_POST["imoClass"],
                );

                isset($_POST["hazard"]) ?  $newLoad["hazard"] = $_POST["hazard"] : $newLoad["hazard"] = 0;

                if (isset($_POST["reefer"]) && isset($_POST["numberTemperature"])) {
                    $newLoad["reefer"] = $_POST["reefer"];
                    $newLoad["numberTemperature"] = $_POST["numberTemperature"];
                } else {
                    $newLoad["reefer"] = 0;
                    $newLoad["numberTemperature"] = 0;
                }

                $this->loadModel->saveNewLoad($newLoad);

                $billData = array(
                    "travelId" => $_POST["idTravel"],
                    "billDate" => date("Y-m-d"),
                );

                $this->billModel->createBillOf($billData);

                $idProforma = $this->reportModel->getIdProformaOf($_POST["idTravel"]);
                $this->reportModel->generatePdfProformaOf($idProforma);
            } else {
                $_SESSION["proformaAlreadyCreated"] = 1;

                header("location: /pw2-grupo03/report");
                exit();
            }
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

}