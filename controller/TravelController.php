<?php


class TravelController {

    private $travelModel;
    private $travelDriverModel;
    private $clientModel;
    private $reportModel;
    private $driverModel;
    private $render;

    public function __construct($travelModel, $travelDriverModel, $reportModel, $driverModel, $clientModel, $render) {
        $this->render = $render;
        $this->travelModel = $travelModel;
        $this->travelDriverModel = $travelDriverModel;
        $this->clientModel = $clientModel;
        $this->reportModel = $reportModel;
        $this->driverModel = $driverModel;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["chofer"] == 1) {
            if (isset($_SESSION["proformaError"])) {
                $data["proformaError"] = "Error: La proforma de este viaje no fue generada todavía";
                unset($_SESSION["proformaError"]);
            }

            $data["travels"] = $this->travelModel->getTravels();
            echo $this->render->render("view/myTravelsView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function newTravel() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["chofer"] == 1) {
            $data["clients"] = $this-> clientModel->getClients();
            $data["drivers"] = $this->driverModel->getAvailableDrivers();
          
            echo $this->render->render("view/newTravelView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function addNewTravel() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["chofer"] == 1) {
            $data = array();

            if (!$this->validateNewTravel()) {
                $data["errorValidate"] = "Ocurrió un error en la validación 
                                        de los datos ingresados, intente nuevamente";
            } else {
                $newTravel = array(
                    "expectedFuel" => $_POST["expectedFuel"],
                    "expectedKilometers" => $_POST["expectedKilometers"],
                    "origin" => $_POST["origin"],
                    "destination" => $_POST["destination"],
                    "estimatedDepartureDate" => $_POST["estimatedDepartureDate"],
                    "estimatedArrivalDate" => $_POST["estimatedArrivalDate"],
                    "idClient" => $_POST ["idClient"],
                    "estimatedDepartureDate" => $_POST["estimatedDepartureDate"],
                    "driverId" => $_POST["idDriver"]
                );

                $this->travelModel->saveTravel($newTravel);
                $data["correctNewTravel"] = "Viaje registrado correctamente";
            }
            echo $this->render->render("view/newTravelResultView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function editTravel() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["chofer"] == 1) {
            if (is_numeric($_GET["id"])) {
                $travelId = $_GET["id"];
                $data["travel"] = $this->travelModel->getTravelById($travelId);

                $data["travel"] = $this->travelModel->convertDatetimeFromMySQLToHTMLOf($data["travel"]);

                echo $this->render->render("view/updateTravelView.php", $data);
            } else {
                header("location: /pw2-grupo03/travel");
                exit();
            }
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function processEditTravel() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["chofer"] == 1) {
            $travelId = $_POST["id_viaje"];
            $travel = $this->travelModel->getTravelById($travelId);

            if ($_POST["expectedFuel"] != $travel["expectedFuel"]) {
                $newExpectedFuel = $_POST["expectedFuel"];
                $this->travelModel->changeExpectedFuel($travelId, $newExpectedFuel);
            }



            if ($_POST["expectedKilometers"] != $travel["expectedKilometers"]) {
                $newExpectedKilometers = $_POST["expectedKilometers"];
                $this->travelModel->changeExpectedKilometers($travelId, $newExpectedKilometers);
            }



            if ($_POST["origin"] != $travel["origin"]) {
                $newOrigin = $_POST["origin"];
                $this->travelModel->changeOrigin($travelId, $newOrigin);
            }

            if ($_POST["destination"] != $travel["destination"]) {
                $newDestination = $_POST["destination"];
                $this->travelModel->changeDestination($travelId, $newDestination);
            }

            if ($_POST["estimatedDepartureDate"] != $travel["estimatedDepartureDate"]) {
                $newEstimatedDepartureDate = $_POST["estimatedDepartureDate"];
                $this->travelModel->changeEstimatedDepartureDate($travelId, $newEstimatedDepartureDate);
            }

            if ($_POST["estimatedArrivalDate"] != $travel["estimatedArrivalDate"]) {
                $newEstimatedArrivalDate = $_POST["estimatedArrivalDate"];
                $this->travelModel->changeEstimatedArrivalDate($travelId, $newEstimatedArrivalDate);
            }


            header("location: /pw2-grupo03/travel/editTravel?id=$travelId");
            exit();
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }
    public function finalizeTravel() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["chofer"] == 1) {
            if (is_numeric($_GET["id"])) {
                $travelId = $_GET["id"];
                $data["travel"] = $this->travelModel->getTravelById($travelId);

                $data["travel"] = $this->travelModel->convertDatetimeFromMySQLToHTMLOf($data["travel"]);

                echo $this->render->render("view/finalizeTravelView.php", $data);
            } else {
                header("location: /pw2-grupo03/travel");
                exit();
            }
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }
    public function processFinalizeTravel()
    {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["chofer"] == 1) {
            $travelId = $_POST["id_viaje"];
            $travel = $this->travelModel->getTravelById($travelId);
            if ($_POST["realFuel"] != $travel["realFuel"]) {
                $newRealFuel = $_POST["realFuel"];
                $this->travelModel->changeRealFuel($travelId, $newRealFuel);
            }
            if ($_POST["realKilometers"] != $travel["realKilometers"]) {
                $newRealKilometers = $_POST["realKilometers"];
                $this->travelModel->changeRealKilometers($travelId, $newRealKilometers);
            }
            if ($_POST["departureDate"] != $travel["departureDate"]) {
                $newDepartureDate = $_POST["departureDate"];
                $this->travelModel->changeDepartureDate($travelId, $newDepartureDate);
            }

            if ($_POST["arrivalDate"] != $travel["arrivalDate"]) {
                $newArrivalDate = $_POST["arrivalDate"];
                $this->travelModel->changeArrivalDate($travelId, $newArrivalDate);
            }

            header("location: /pw2-grupo03/travel/finalizeTravel?id=$travelId");
            exit();
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
        }

    public function deleteTravel() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["chofer"] == 1) {
            $travelId = $_GET["id"];

            $this->travelModel->deleteTravelById($travelId);

            $_SESSION["travelDeletedOk"] = 1;

            header("location: /pw2-grupo03/travel");
            exit();
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function viewProforma() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["chofer"] == 1 && isset($_GET["id"])) {
            $travelId = $_GET["id"];

            if ($this->reportModel->checkIfProformaAlreadyExistsOf($travelId)) {
                $idProforma = $this->reportModel->getIdProformaOf($travelId);
                $this->reportModel->renderPdfProformaOf($idProforma);
            } else {
                $_SESSION["proformaError"] = 1;

                header("location: /pw2-grupo03/travel");
                exit();
            }
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function loadData() {
        if (isset($_SESSION["loggedIn"])
            && $_SESSION["chofer"] == 1
            && isset($_GET["id"])
            && $this->travelModel->checkIfTravelExistsBy($_GET["id"])
            && $this->travelDriverModel->isTravelAssignedToDriver($_GET["id"], $_SESSION['driverId'])) {

            if (isset($_SESSION["detourReportedOk"])) {
                $data["detourReportedOk"] = "El desvío se informó correctamente";
                unset($_SESSION["detourReportedOk"]);
            }

            if (isset($_SESSION["refuelReportedOk"])) {
                $data["refuelReportedOk"] = "La carga de combustible se informó correctamente";
                unset($_SESSION["refuelReportedOk"]);
            }

            if (isset($_SESSION["positionReportedOk"])) {
                $data["positionReportedOk"] = "La posición actual se informó correctamente";
                unset($_SESSION["positionReportedOk"]);
            }

            $data["idTravel"] = $_GET["id"];
            echo $this->render->render("view/loadTravelDataView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function reportDetour() {
        if (isset($_SESSION["loggedIn"])
            && $_SESSION["chofer"] == 1
            && isset($_GET["id"])
            && $this->travelModel->checkIfTravelExistsBy($_GET["id"])
            && $this->travelDriverModel->isTravelAssignedToDriver($_GET["id"], $_SESSION['driverId'])) {

            $data["idTravel"] = $_GET["id"];
            echo $this->render->render("view/reportTravelDetourView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function processDetour() {
        if (isset($_SESSION["loggedIn"])
            && $_SESSION["chofer"] == 1
            && isset($_POST["travelId"])
            && $this->travelModel->validateNewDetour()
            && $this->travelModel->checkIfTravelExistsBy($_POST["travelId"])
            && $this->travelDriverModel->isTravelAssignedToDriver($_POST["travelId"], $_SESSION['driverId'])) {

            $travelId = $_POST["travelId"];

            $detourData["time"] = $_POST["time"];
            $detourData["reason"] = $_POST["reason"];

            $this->travelModel->reportDetourOf($travelId, $detourData);

            $_SESSION["detourReportedOk"] = 1;

            header("location: /pw2-grupo03/travel/loadData?id=$travelId");
            exit();
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function reportRefuel() {
        if (isset($_SESSION["loggedIn"])
            && $_SESSION["chofer"] == 1
            && isset($_GET["id"])
            && $this->travelModel->checkIfTravelExistsBy($_GET["id"])
            && $this->travelDriverModel->isTravelAssignedToDriver($_GET["id"], $_SESSION['driverId'])) {

            $data["idTravel"] = $_GET["id"];
            echo $this->render->render("view/reportTravelRefuelView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function processRefuel() {
        if (isset($_SESSION["loggedIn"])
            && $_SESSION["chofer"] == 1
            && isset($_POST["travelId"])
            && $this->travelModel->validateNewRefuel()
            && $this->travelModel->checkIfTravelExistsBy($_POST["travelId"])
            && $this->travelDriverModel->isTravelAssignedToDriver($_POST["travelId"], $_SESSION['driverId'])) {

            $travelId = $_POST["travelId"];

            $refuelData["place"] = $_POST["place"];
            $refuelData["quantity"] = $_POST["quantity"];
            $refuelData["amount"] = $_POST["amount"];

            $this->travelModel->reportRefuelOf($travelId, $refuelData);

            $_SESSION["refuelReportedOk"] = 1;

            header("location: /pw2-grupo03/travel/loadData?id=$travelId");
            exit();
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function reportPosition() {
        if (isset($_SESSION["loggedIn"])
            && $_SESSION["chofer"] == 1
            && isset($_GET["id"])
            && $this->travelModel->validateNewPosition()
            && $this->travelModel->checkIfTravelExistsBy($_GET["id"])
            && $this->travelDriverModel->isTravelAssignedToDriver($_GET["id"], $_SESSION['driverId'])) {

            $travelId = $_GET["id"];

            $positionData["lat"] = $_GET["lat"];
            $positionData["long"] = $_GET["long"];

            $this->travelModel->reportPositionOf($travelId, $positionData);

            $_SESSION["positionReportedOk"] = 1;

            header("location: /pw2-grupo03/travel/loadData?id=$travelId");
            exit();
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function validateNewTravel() {
        if (empty($_POST['expectedFuel']) ||
            empty($_POST['expectedKilometers']) ||
            empty($_POST['origin']) ||
            empty($_POST['destination']) ||
            empty($_POST['estimatedDepartureDate']) ||
            empty($_POST['estimatedArrivalDate'])||
        empty($_POST["idClient"])) {
            return false;
        } else {
            return true;
        }
    }

}