<?php


class TravelController {

    private $travelModel;
    private $travelDriverModel;
    private $clientModel;
    private $reportModel;
    private $driverModel;
    private $transportUnitModel;
    private $render;

    public function __construct($travelModel, $travelDriverModel, $reportModel, $driverModel, $clientModel, $transportUnitModel, $render) {
        $this->render = $render;
        $this->travelModel = $travelModel;
        $this->travelDriverModel = $travelDriverModel;
        $this->clientModel = $clientModel;
        $this->reportModel = $reportModel;
        $this->driverModel = $driverModel;
        $this->transportUnitModel = $transportUnitModel;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1 ) {
            if (isset($_SESSION["proformaError"])) {
                $data["proformaError"] = "Error: La proforma de este viaje no fue generada todavía";
                unset($_SESSION["proformaError"]);
            }
            $data["travels"] = $this->travelModel->getTravels();
            echo $this->render->render("view/myTravelsView.php", $data);
        }else if (isset($_SESSION["loggedIn"]) && $_SESSION["chofer"] == 1) {
            if (isset($_SESSION["proformaError"])) {
                $data["proformaError"] = "Error: La proforma de este viaje no fue generada todavía";
                unset($_SESSION["proformaError"]);
            }
            $idDriver= $_SESSION["driverId"];
            $data["travels"] = $this->driverModel->getDriverTravels($idDriver);
            echo $this->render->render("view/myTravelsView.php", $data);
        }else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function newTravel() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data["clients"] = $this->clientModel->getClients();
            $data["drivers"] = $this->driverModel->getAvailableDrivers();
            $data["vehicles"] = $this->transportUnitModel->getAvailableVehicles();
            $data["trailers"] = $this->transportUnitModel->getAvailableTrailers();

            echo $this->render->render("view/newTravelView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function addNewTravel() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
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
                    "driverId" => $_POST["idDriver"],
                    "vehicleId" => $_POST["idVehicle"],
                    "trailerId" => $_POST["idTrailer"]
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
                $travel=$this->travelModel->getTravelById($travelId);

                if(is_null($travel[0]["fecha_llegada"])) {
                    $data["travel"] = $travel;

                    $data["travel"] = $this->travelModel->convertDatetimeFromMySQLToHTMLOf($data["travel"]);

                    echo $this->render->render("view/updateTravelView.php", $data);
                }else{
                    $data["errorEditar"]="El viaje ya está finalizado, no se puede editar";
                    $data["travels"] = $this->travelModel->getTravels();
                    echo $this->render->render("view/MyTravelsView.php", $data);
                } } else {
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

            header("location: /pw2-grupo03/travel");
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

            header("location:/pw2-grupo03/travel");
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
                if ($_SESSION["admin"] == 1) {
                    $_SESSION["createProforma"] = 1;

                    header("location: /pw2-grupo03/report/newProforma");
                    exit();
                } else {
                    $_SESSION["proformaError"] = 1;

                    header("location: /pw2-grupo03/travel");
                    exit();
                }
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

            if (isset($_SESSION["proformaError"])) {
                $data["proformaError"] = "La proforma del viaje debe existir para realizar este informe";
                unset($_SESSION["proformaError"]);
            }

            if (isset($_SESSION["spendReportedOk"])) {
                $data["spendReportedOk"] = "El gasto se informó correctamente";
                unset($_SESSION["spendReportedOk"]);
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

            if (!$this->reportModel->checkIfProformaAlreadyExistsOf($data["idTravel"])) {
                $_SESSION["proformaError"] = 1;

                header("location: /pw2-grupo03/travel/loadData?id=" . $data["idTravel"]);
                exit();
            } else {
                echo $this->render->render("view/reportTravelRefuelView.php", $data);
            }
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

            if (!$this->reportModel->checkIfProformaAlreadyExistsOf($travelId)) {
                $_SESSION["proformaError"] = 1;

                header("location: /pw2-grupo03/travel/loadData?id=" . $travelId);
                exit();
            } else {
                $refuelData["place"] = $_POST["place"];
                $refuelData["quantity"] = $_POST["quantity"];
                $refuelData["amount"] = $_POST["amount"];
                $this->travelModel->reportRefuelOf($travelId, $refuelData);

                $_SESSION["refuelReportedOk"] = 1;

                header("location: /pw2-grupo03/travel/loadData?id=$travelId");
                exit();
            }
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

    public function reportSpend() {
        if (isset($_SESSION["loggedIn"])
            && $_SESSION["chofer"] == 1
            && isset($_GET["id"])
            && $this->travelModel->checkIfTravelExistsBy($_GET["id"])
            && $this->travelDriverModel->isTravelAssignedToDriver($_GET["id"], $_SESSION['driverId'])) {

            $data["idTravel"] = $_GET["id"];

            if (!$this->reportModel->checkIfProformaAlreadyExistsOf($data["idTravel"])) {
                $_SESSION["proformaError"] = 1;

                header("location: /pw2-grupo03/travel/loadData?id=" . $data["idTravel"]);
                exit();
            } else {
                echo $this->render->render("view/reportTravelSpendView.php", $data);
            }
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function processSpend() {
        if (isset($_SESSION["loggedIn"])
            && $_SESSION["chofer"] == 1
            && isset($_POST["travelId"])
            && $this->travelModel->validateSpend()
            && $this->travelModel->checkIfTravelExistsBy($_POST["travelId"])
            && $this->travelDriverModel->isTravelAssignedToDriver($_POST["travelId"], $_SESSION['driverId'])) {

            $travelId = $_POST["travelId"];

            if (!$this->reportModel->checkIfProformaAlreadyExistsOf($travelId)) {
                $_SESSION["proformaError"] = 1;

                header("location: /pw2-grupo03/travel/loadData?id=" . $travelId);
                exit();
            } else {
                $proformaId = $this->reportModel->getIdProformaOf($travelId);

                $spendData["spendType"] = $_POST["spendType"];
                $spendData["amount"] = $_POST["amount"];
                $this->reportModel->reportSpendOf($proformaId, $spendData);

                $_SESSION["spendReportedOk"] = 1;

                header("location: /pw2-grupo03/travel/loadData?id=$travelId");
                exit();
            }
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