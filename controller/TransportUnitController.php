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
            header("location: /pw2-grupo03");
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
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function newVehiclePost() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data = array();

            $newVehicle = array(
                "patentNumber" => $_POST["patentNumber"],
                "yeorOfProduction" => $_POST["yeorOfProduction"],
                "engineNumber" => $_POST["engineNumber"],
                "chassisNumber" => $_POST["chassisNumber"],
                "kilometers" => $_POST["kilometers"],
                "typeOfVehicle" => $_POST["typeOfVehicle"],
                "brand" => $_POST["brand"],
                "model" => $_POST["model"]
            );

            $this->transportUnitModel->saveNewVehicle($newVehicle);
            $data["typesOfVehicles"] = $this->transportUnitModel->getTypesOfVehicles();
            $data["brands"] = $this->transportUnitModel->getBrands();
            $data["models"] = $this->transportUnitModel->getModels();
            $data["successMessage"] = "Vehículo Registrado Correctamente";
            echo $this->render->render("view/newVehicleView.php", $data);

        } else {
            header("location: /pw2-grupo03");
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
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function newTrailerPost() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data = array();

            $newTrailer = array(
                "patentNumber" => $_POST["patentNumber"],
                "yeorOfProduction" => $_POST["yeorOfProduction"],
                "chassisNumber" => $_POST["chassisNumber"],
                "typeOfTrailer" => $_POST["typeOfTrailer"],
                "brand" => $_POST["brand"],
                "model" => $_POST["model"]
            );

            $this->transportUnitModel->saveNewTrailer($newTrailer);
            $data["typesOfTrailers"] = $this->transportUnitModel->getTypesOfTrailers();
            $data["brands"] = $this->transportUnitModel->getBrands();
            $data["models"] = $this->transportUnitModel->getModels();
            $data["successMessage"] = "Trailer Registrado Correctamente";

            echo $this->render->render("view/newTrailerView.php", $data);

        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function getModels() {
        $data["models"] = $this->transportUnitModel->getModelsByBrand($_POST["idBrand"]);
        return json_encode($data);
    }
}