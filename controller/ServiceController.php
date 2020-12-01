<?php


class ServiceController {

    private $serviceModel;
    private $render;

    public function __construct($serviceModel, $render) {
        $this->render = $render;
        $this->serviceModel = $serviceModel;
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
            echo $this->render->render("view/newServiceView.php");
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }


    public function addNewService() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["encargado"] == 1) {
            $data = array();

    /*    if (!$this->validateNewService()) {
            $data["errorValidate"] = "Ocurrió un error en la validación 
                                        de los datos ingresados, intente nuevamente";
        } else {  */
            $newService = array(
                "numberVehicle" => $_POST["numberVehicle"],
                "serviceDate" => $_POST["serviceDate"],
                "kilometers" => $_POST["kilometers"],
                "mechanic" => $_POST["mechanic"],
                "description" => $_POST["description"],
                "cost" => $_POST["cost"]
            );

            $this->serviceModel->saveNewService($newService);
            $data["correctNewService"] = "Service Registrado Correctamente";
   //   }
        echo $this->render->render("view/newServiceResultView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

 /*   public function validateNewService()
    {
        $numberVehicle = $_POST["numberVehicle"];

        $total = $this->serviceModel->existVehicle($numberVehicle);

        if ($total == 1) {
            return true;
        } else {
            return false;
        }
    }
 */

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

            $newServiceDate = $_POST["serviceDate"];
            $newKilometers = $_POST["kilometers"];
            $newDescription = $_POST["description"];
            $newCost = $_POST["cost"];

            $this->serviceModel->updateServiceById($serviceId, $newServiceDate, $newKilometers, $newDescription, $newCost);
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