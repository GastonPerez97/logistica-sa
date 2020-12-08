<?php


class ServiceController {

    private $serviceModel;
    private $transportUnitModel;
    private $userModel;
    private $render;


    public function __construct($serviceModel, $transportUnitModel, $userModel, $render) {
        $this->render = $render;
        $this->serviceModel = $serviceModel;
        $this->transportUnitModel = $transportUnitModel;
        $this->userModel = $userModel;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["encargado"] == 1) {
            $data["services"] = $this->serviceModel->getServices();
            echo $this->render->render("view/serviceView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }


    public function newService() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["encargado"] == 1) {
            $data["vehicles"] = $this->transportUnitModel->getListVehicles();
            $data["mechanics"] = $this->userModel->getMechanics();
            echo $this->render->render("view/newServiceView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }


    public function addNewService() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["encargado"] == 1) {
            $data = array();

            if (isset($_POST["internal"])) {
                $internal = 1;
                $mechanic = $_POST["mechanic"];
            } else {
                $internal = 0;
                $mechanic = "NULL";
            }

            $newService = array(
                "numberVehicle" => $_POST["numberVehicle"],
                "serviceDate" => $_POST["serviceDate"],
                "kilometers" => $_POST["kilometers"],
                "internal" => $internal,
                "mechanic" => $mechanic,
                "description" => $_POST["description"],
                "cost" => $_POST["cost"]
            );

            $this->serviceModel->saveNewService($newService);
            $data["correctNewService"] = "Service Registrado Correctamente";
        echo $this->render->render("view/newServiceResultView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }


    public function editService() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["encargado"] == 1) {
            if (is_numeric($_GET["id"])) {
                $serviceId = $_GET["id"];
                $data["service"] = $this->serviceModel->getServiceById($serviceId);

                echo $this->render->render("view/editServiceView.php", $data);
            } else {
                header("location: /pw2-grupo03/service");
                exit();
            }
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function processEditService() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["encargado"] == 1) {
            $serviceId = $_POST["idService"];
            $service = $this->serviceModel->getServiceById($serviceId);

            $newKilometers = $_POST["kilometers"];
            $newDescription = $_POST["description"];
            $newCost = $_POST["cost"];

            $this->serviceModel->updateServiceById($serviceId, $newKilometers, $newDescription, $newCost);
            $data["correctEditService"] = "Service Editado Correctamente";
            echo $this->render->render("view/newServiceResultView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function deleteService() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["encargado"] == 1) {
            $serviceId = $_GET["id"];

            $this->serviceModel->deleteServiceById($serviceId);

            $_SESSION["serviceDeletedOk"] = 1;

            header("location: /pw2-grupo03/service");
            exit();
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

}