<?php


class ServiceController
{
    private $serviceModel;
    private $render;

    public function __construct($serviceModel, $render) {
        $this->render = $render;
        $this->serviceModel = $serviceModel;
    }

    public function execute() {
        echo $this->render->render("view/serviceView.php");
    }

    public function newServiceResult() {
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
        echo $this->render->render("view/newServiceResult.php", $data);
    }

    public function validateNewService() {
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


}