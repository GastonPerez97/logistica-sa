<?php


class NewServiceController
{

    private $newServiceModel;
    private $render;

    public function __construct($newServiceModel, $render) {
        $this->render = $render;
        $this->newServiceModel = $newServiceModel;
    }

    public function execute() {
        echo $this->render->render("view/newServiceView.php");
    }

    public function newServiceResult() {
        $data = array();

        if (!$this->validateNewService()) {
            $data["errorValidate"] = "Ocurrió un error en la validación 
                                        de los datos ingresados, intente nuevamente";

            echo $this->render->render("view/newServiceResult.php", $data);
        } else {
            $newService = array(
                "numberVehicle" => $_POST["numberVehicle"],
                "serviceDate" => $_POST["serviceDate"],
                "kilometers" => $_POST["kilometers"],
                "mechanic" => $_POST["mechanic"],
                "description" => $_POST["description"],
                "cost" => $_POST["cost"]
            );

            $this->userModel->saveNewService($newService);
            $data["correctNewService"] = "Service registrado correctamente";

            echo $this->render->render("view/newServiceResult.php", $data);
        }
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