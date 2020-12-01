<?php

class ReportController {

    private $render;
    private $reportModel;
    private $travelModel;
    private $userModel;
    private $loadModel;

    public function __construct($reportModel, $travelModel, $userModel, $loadModel, $render) {
        $this->reportModel = $reportModel;
        $this->travelModel = $travelModel;
        $this->userModel = $userModel;
        $this->loadModel = $loadModel;
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
                    "idClient" => $_POST["idClient"],
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
                    "hazard" => $_POST["hazard"],
                    "reefer" => $_POST["reefer"],
                    "temperature" => $_POST["temperature"],
                );

                $this->loadModel->saveNewLoad($newLoad);

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