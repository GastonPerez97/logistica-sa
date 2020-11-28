<?php


class TravelController {

    private $travelModel;
    private $render;

    public function __construct($travelModel, $render) {
        $this->render = $render;
        $this->travelModel = $travelModel;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["chofer"] == 1) {
            $data["travels"] = $this->travelModel->getTravels();
            echo $this->render->render("view/myTravelsView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function newTravel() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["chofer"] == 1) {
            echo $this->render->render("view/newTravelView.php");
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
                    "departureDate" => $_POST["departureDate"],
                    "estimatedArrivalDate" => $_POST["estimatedArrivalDate"],
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

            if ($_POST["realFuel"] != $travel["realFuel"]) {
                $newRealFuel = $_POST["realFuel"];
                $this->travelModel->changeRealFuel($travelId, $newRealFuel);
            }

            if ($_POST["expectedKilometers"] != $travel["expectedKilometers"]) {
                $newExpectedKilometers = $_POST["expectedKilometers"];
                $this->travelModel->changeExpectedKilometers($travelId, $newExpectedKilometers);
            }

            if ($_POST["realKilometers"] != $travel["realKilometers"]) {
                $newRealKilometers = $_POST["realKilometers"];
                $this->travelModel->changeRealKilometers($travelId, $newRealKilometers);
            }

            if ($_POST["origin"] != $travel["origin"]) {
                $newOrigin = $_POST["origin"];
                $this->travelModel->changeOrigin($travelId, $newOrigin);
            }

            if ($_POST["destination"] != $travel["destination"]) {
                $newDestination = $_POST["destination"];
                $this->travelModel->changeDestination($travelId, $newDestination);
            }

            if ($_POST["departureDate"] != $travel["departureDate"]) {
                $newDepartureDate = $_POST["departureDate"];
                $this->travelModel->changeDepartureDate($travelId, $newDepartureDate);
            }

            if ($_POST["estimatedArrivalDate"] != $travel["estimatedArrivalDate"]) {
                $newEstimatedArrivalDate = $_POST["estimatedArrivalDate"];
                $this->travelModel->changeEstimatedArrivalDate($travelId, $newEstimatedArrivalDate);
            }

            if ($_POST["arrivalDate"] != $travel["arrivalDate"]) {
                $newArrivalDate = $_POST["arrivalDate"];
                $this->travelModel->changeArrivalDate($travelId, $newArrivalDate);
            }

            header("location: /pw2-grupo03/travel/editTravel?id=$travelId");
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

    public function validateNewTravel() {
        if (empty($_POST['expectedFuel']) ||
            empty($_POST['expectedKilometers']) ||
            empty($_POST['origin']) ||
            empty($_POST['destination']) ||
            empty($_POST['departureDate']) ||
            empty($_POST['estimatedArrivalDate'])) {
            return false;
        } else {
            return true;
        }
    }

}