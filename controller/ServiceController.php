<?php


class ServiceController
{
    private $serviceModel;
    private $userRoleModel;
    private $render;

    public function __construct($serviceModel, $userRoleModel, $render)
    {
        $this->render = $render;
        $this->serviceModel = $serviceModel;
        $this->userRoleModel = $userRoleModel;
    }

    public function execute()
    {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isEncargado()) {
            $data["services"] = $this->serviceModel->getServices();
            echo $this->render->render("view/serviceView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }


    public function newService()
    {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isEncargado()) {
            echo $this->render->render("view/newServiceView.php");
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }


    public function addNewService()
    {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isEncargado()) {
            $data = array();

            if (!$this->validateNewService()) {
                $data["errorValidate"] = "Ocurrió un error en la validación 
                                        de los datos ingresados, intente nuevamente";
            } else {
                $newService = array(
                    "numberVehicle" => $_POST["numberVehicle"],
                    "serviceDate" => $_POST["serviceDate"],
                    "kilometers" => $_POST["kilometers"],
                    "mechanic" => $_POST["mechanic"],
                    "description" => $_POST["description"],
                    "cost" => $_POST["cost"]
                );

                $this->serviceModel->saveNewService($newService);
                $data["correctNewService"] = "Service registrado correctamente";
            }
            echo $this->render->render("view/newServiceResultView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function validateNewService()
    {
        if (empty($_POST['numberVehicle']) ||
            empty($_POST['serviceDate']) ||
            empty($_POST['kilometers']) ||
            empty($_POST['mechanic']) ||
            empty($_POST['description']) ||
            empty($_POST['cost'])) {
            return false;
        } else {
            return true;
        }
    }

    public function editService()
    {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isEncargado()) {
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

    public function processEditService()
    {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isEncargado()) {
            $serviceId = $_POST["idService"];
            $service = $this->serviceModel->getServiceById($serviceId);

            if ($_POST["serviceDate"] != $service["fecha_service"]) {
                $newsServiceDate = $_POST["serviceDate"];
                $this->serviceModel->changeServiceDate($serviceId, $newsServiceDate);
            }

            if ($_POST["kilometers"] != $service["kilometraje_actual_unidad"]) {
                $newKilometers = $_POST["kilometers"];
                $this->serviceModel->changeKilometers($serviceId, $newKilometers);
            }

            if ($_POST["description"] != $service["detalle"]) {
                $newDescription = $_POST["description"];
                $this->serviceModel->changeDescription($serviceId, $newDescription);
            }

            if ($_POST["cost"] != $service["costo"]) {
                $newCost = $_POST["cost"];
                $this->serviceModel->changeCost($serviceId, $newCost);
            }

            header("location: /pw2-grupo03/service/editService?id=$serviceId");
            exit();
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function deleteService()
    {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isEncargado()) {
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