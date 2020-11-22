<?php


class ServiceController
{
    private $serviceModel;
    private $render;

    public function __construct($serviceModel, $render)
    {
        $this->render = $render;
        $this->serviceModel = $serviceModel;
    }

    public function execute()
    {
        $data["services"] = $this->serviceModel->getServices();
        echo $this->render->render("view/serviceView.php", $data);
    }


    public function newService()
    {
        echo $this->render->render("view/newServiceView.php");
    }


    public function addNewService()
    {
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

    public function editService()
    {
        if (is_numeric($_GET["id"])) {
            $serviceId = $_GET["id"];
            $data["service"] = $this->serviceModel->getServiceById($serviceId);

            echo $this->render->render("view/editServiceView.php", $data);
        } else {
            header("location: /pw2-grupo03/service");
            exit();
        }
    }

    public function processEditService()
    {
        $serviceId = $_POST["idService"];
        $service = $this->serviceModel->getServiceById($serviceId);

        $newServiceDate = $_POST["serviceDate"];
        $newKilometers = $_POST["kilometers"];
        $newDescription = $_POST["description"];
        $newCost = $_POST["cost"];

        $this->serviceModel->updateServiceById($serviceId, $newServiceDate, $newKilometers, $newDescription, $newCost);
        $data["correctEditService"] = "Service Editado Correctamente";
        echo $this->render->render("view/newServiceResultView.php", $data);

    }

    public function deleteService()
    {
        $serviceId = $_GET["id"];

        $this->serviceModel->deleteServiceById($serviceId);

        $_SESSION["serviceDeletedOk"] = 1;

        header("location: /pw2-grupo03/service");
        exit();
    }


}