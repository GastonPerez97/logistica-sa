<?php


class TransportUnitController {

    private $transportUnitModel;
    private $render;

    public function __construct($transportUnitModel, $render) {
        $this->render = $render;
        $this->transportUnitModel = $transportUnitModel;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data["vehicles"] = $this->transportUnitModel->getVehicles();
            $data["trailers"] = $this->transportUnitModel->getTrailers();
            echo $this->render->render("view/transportUnitView.php", $data);
        } else {
            header("location: /");
            exit();
        }
    }

    public function enableTransportUnit() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data = array();

            $status = $_GET["actualState"];
            $status == 1 ? $status = 0 : $status = 1;

            $transportUnit = array(
                "id" => $_GET["id"],
                "status" => $status
            );

            $this->transportUnitModel->enableTransportUnit($transportUnit);

            $data["vehicles"] = $this->transportUnitModel->getVehicles();
            $data["trailers"] = $this->transportUnitModel->getTrailers();
            echo $this->render->render("view/transportUnitView.php", $data);

        } else {
            header("location: /");
            exit();
        }
    }

    public function editTransportUnit() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data = array();

            $type = $_GET["type"];
            $idTransportUnit = $_GET["id"];

            $data["brands"] = $this->transportUnitModel->getBrands();
            $data["models"] = $this->transportUnitModel->getModels();

            if ($type == 0) {
                $data["typesOfVehicles"] = $this->transportUnitModel->getTypesOfVehicles();
                $data["vehicle"] = $this->transportUnitModel->getVehicleById($idTransportUnit);
                echo $this->render->render("view/editVehicleView.php", $data);
            } else {
                $data["typesOfTrailers"] = $this->transportUnitModel->getTypesOfTrailers();
                $data["trailer"] = $this->transportUnitModel->getTrailerById($idTransportUnit);
                echo $this->render->render("view/editTrailerView.php", $data);
            }

        } else {
            header("location: /");
            exit();
        }
    }

    public function editVehicle() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data = array();

            $transportUnit = array(
                "idTransportUnit" => $_POST["idTransportUnit"],
                "patentNumber" => $_POST["patentNumber"],
                "yeorOfProduction" => $_POST["yeorOfProduction"],
                "chassisNumber" => $_POST["chassisNumber"],
                "brand" => $_POST["brand"],
                "model" => $_POST["model"],
                "active" => $_POST["active"]
            );

            $this->transportUnitModel->editTransportUnit($transportUnit);

            $vehicle = array(
                "engineNumber" => $_POST["engineNumber"],
                "kilometers" => $_POST["kilometers"],
                "typeOfVehicle" => $_POST["typeOfVehicle"],
                "idTransporUnit" => $_POST["idTransportUnit"]
            );

            $this->transportUnitModel->editVehicle($vehicle);

            $data["vehicles"] = $this->transportUnitModel->getVehicles();
            $data["trailers"] = $this->transportUnitModel->getTrailers();
            echo $this->render->render("view/transportUnitView.php", $data);

        } else {
            header("location: /");
            exit();
        }
    }

    public function editTrailer() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data = array();

            $transportUnit = array(
                "idTransportUnit" => $_POST["idTransportUnit"],
                "patentNumber" => $_POST["patentNumber"],
                "yeorOfProduction" => $_POST["yeorOfProduction"],
                "chassisNumber" => $_POST["chassisNumber"],
                "brand" => $_POST["brand"],
                "model" => $_POST["model"],
                "active" => $_POST["active"]
            );

            $this->transportUnitModel->editTransportUnit($transportUnit);

            $trailer = array(
                "typeOfTrailer" => $_POST["typeOfTrailer"],
                "idTransporUnit" => $_POST["idTransportUnit"]
            );

            $this->transportUnitModel->editTrailer($trailer);

            $data["vehicles"] = $this->transportUnitModel->getVehicles();
            $data["trailers"] = $this->transportUnitModel->getTrailers();
            echo $this->render->render("view/transportUnitView.php", $data);

        } else {
            header("location: /");
            exit();
        }
    }

    public function newVehicle() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data["typesOfVehicles"] = $this->transportUnitModel->getTypesOfVehicles();
            $data["brands"] = $this->transportUnitModel->getBrands();
            $data["models"] = $this->transportUnitModel->getModels();
            echo $this->render->render("view/newVehicleView.php", $data);
        } else {
            header("location: /");
            exit();
        }
    }

    public function newVehiclePost() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data = array();

            $newTransportUnit = array(
                "patentNumber" => $_POST["patentNumber"],
                "yeorOfProduction" => $_POST["yeorOfProduction"],
                "chassisNumber" => $_POST["chassisNumber"],
                "brand" => $_POST["brand"],
                "model" => $_POST["model"],
                "active" => $_POST["active"]
            );

            $idTransporUnit = $this->transportUnitModel->saveTransportUnit($newTransportUnit);

            $newVehicle = array(
                "engineNumber" => $_POST["engineNumber"],
                "kilometers" => $_POST["kilometers"],
                "typeOfVehicle" => $_POST["typeOfVehicle"],
                "idTransporUnit" => $idTransporUnit
            );

            $this->transportUnitModel->saveNewVehicle($newVehicle);

            $data["typesOfVehicles"] = $this->transportUnitModel->getTypesOfVehicles();
            $data["brands"] = $this->transportUnitModel->getBrands();
            $data["models"] = $this->transportUnitModel->getModels();
            $data["successMessage"] = "Vehículo Registrado Correctamente";

            echo $this->render->render("view/newVehicleView.php", $data);

        } else {
            header("location: /");
            exit();
        }
    }

    public function newTrailer() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data["typesOfTrailers"] = $this->transportUnitModel->getTypesOfTrailers();
            $data["brands"] = $this->transportUnitModel->getBrands();
            $data["models"] = $this->transportUnitModel->getModels();
            echo $this->render->render("view/newTrailerView.php", $data);
        } else {
            header("location: /");
            exit();
        }
    }

    public function newTrailerPost() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data = array();

            $newTransportUnit = array(
                "patentNumber" => $_POST["patentNumber"],
                "yeorOfProduction" => $_POST["yeorOfProduction"],
                "chassisNumber" => $_POST["chassisNumber"],
                "brand" => $_POST["brand"],
                "model" => $_POST["model"],
                "active" => $_POST["active"]
            );

            $idTransporUnit = $this->transportUnitModel->saveTransportUnit($newTransportUnit);

            $newTrailer = array(
                "typeOfTrailer" => $_POST["typeOfTrailer"],
                "idTransporUnit" => $idTransporUnit
            );

            $this->transportUnitModel->saveNewTrailer($newTrailer);

            $data["typesOfTrailers"] = $this->transportUnitModel->getTypesOfTrailers();
            $data["brands"] = $this->transportUnitModel->getBrands();
            $data["models"] = $this->transportUnitModel->getModels();
            $data["successMessage"] = "Trailer Registrado Correctamente";

            echo $this->render->render("view/newTrailerView.php", $data);

        } else {
            header("location: /");
            exit();
        }
    }

    public function getModels() {
        $models = $this->transportUnitModel->getModelsByBrand($_GET["idBrand"]);
        header('Content-Type: application/json; charset=utf-8');

        return json_encode($models, JSON_FORCE_OBJECT);
    }

    public function getVehiclePosition() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["canSeeVehiclePositionBtn"] == 1) {
            $data["transportUnits"] = $this->transportUnitModel->getTransportUnitsWithPosition();
            echo $this->render->render("view/getVehiclePositionView.php", $data);
        } else {
            header("location: /");
            exit();
        }
    }
}