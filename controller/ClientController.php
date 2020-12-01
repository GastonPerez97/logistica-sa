<?php


class ClientController {

    private $clientModel;
    private $render;

    public function __construct($clientModel, $render) {
        $this->render = $render;
        $this->clientModel = $clientModel;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data["clients"] = $this->clientModel->getClients();
            echo $this->render->render("view/myClientsView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function newClient() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            echo $this->render->render("view/newClientView.php");
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }


    public function addNewClient() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data = array();

            if (!$this->validateNewClient()) {
                $data["errorValidate"] = "Ocurrió un error en la validación 
                                        de los datos ingresados, intente nuevamente";
            } else {
                $newClient = array(
                    "name" => $_POST["name"],
                    "surname" => $_POST["surname"],
                    "dni" => $_POST["dni"],
                    "email" => $_POST["email"],
                    "phone" => $_POST["phone"],
                );

                $this->clientModel->saveClient($newClient);
                $data["correctNewClient"] = "Cliente registrado correctamente";
            }
            echo $this->render->render("view/newClientResultView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function validateNewClient() {
        if (empty($_POST['name']) ||
            empty($_POST['surname']) ||
            empty($_POST['dni']) ||
            empty($_POST['email']) ||
            empty($_POST['phone'])
           ) {
            return false;
        } else {
            return true;
        }
    }

    public function editClient() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            if (is_numeric($_GET["id"])) {
                $clientId = $_GET["id"];
                $data["client"] = $this->clientModel->getClientById($clientId);

                echo $this->render->render("view/updateClientView.php", $data);
            } else {
                header("location: /pw2-grupo03/client");
                exit();
            }
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function processEditClient() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $clientId = $_POST["idClient"];
            $client = $this->clientModel->getClientById($clientId);

            if ($_POST["name"] != $client[0]["nombre"]) {
                $newName = $_POST["name"];
                $this->clientModel->changeName($clientId, $newName);
            }

            if ($_POST["surname"] != $client[0]["apellido"]) {
                $newSurname = $_POST["surname"];
                $this->clientModel->changeSurname($clientId, $newSurname);
            }

            if ($_POST["dni"] != $client[0]["dni"]) {
                $newDni = $_POST["dni"];
                $this->clientModel->changeDni($clientId, $newDni);
            }

            if ($_POST["email"] != $client[0]["email"]) {
                $newEmail = $_POST["email"];
                $this->clientModel->changeEmail($clientId, $newEmail);
            }

            if ($_POST["phone"] != $client[0]["telefono"]) {
                $newPhone = $_POST["phone"];
                $this->clientModel->changePhone($clientId, $newPhone);
            }

            header("location: /pw2-grupo03/client/editClient?id=$clientId");
            exit();
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function deleteClient() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $clientId = $_GET["id"];

            $this->clientModel->deleteClientById($clientId);

            $_SESSION["clientDeletedOk"] = 1;

            header("location: /pw2-grupo03/client");
            exit();
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }
    
}