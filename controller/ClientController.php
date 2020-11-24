<?php


class ClientController
{

    private $clientModel;
    private $userRoleModel;
    private $render;

    public function __construct($clientModel, $userRoleModel, $render) {
        $this->render = $render;
        $this->clientModel = $clientModel;
        $this->userRoleModel = $userRoleModel;
    }

    public function execute()
    {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isAdmin()) {
            $data["clients"] = $this->clientModel->getClients();
            echo $this->render->render("view/myClientsView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function newClient()
    {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isAdmin()) {
            echo $this->render->render("view/newClientView.php");
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }


    public function addNewClient()
    {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isAdmin()) {
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

    public function validateNewTravel()
    {
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

    public function editClient()
    {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isAdmin()) {
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

    public function processEditClient()
    {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isAdmin()) {
            $clientId = $_POST["id_cliente"];
            $client = $this->clientModel->getClientById($clientId);

            if ($_POST["name"] != $client["name"]) {
                $newName = $_POST["name"];
                $this->clientModel->changeName($clientId, $newName);
            }

            if ($_POST["surname"] != $client["surname"]) {
                $newSurname = $_POST["surname"];
                $this->clientModel->changeSurname($clientId, $newSurname);
            }

            if ($_POST["dni"] != $client["dni"]) {
                $newDni = $_POST["dni"];
                $this->clientModel->changeDni($clientId, $newDni);
            }

            if ($_POST["email"] != $client["email"]) {
                $newEmail = $_POST["email"];
                $this->clientModel->changeEmail($clientId, $newEmail);
            }

            if ($_POST["phone"] != $client["phone"]) {
                $newPhone = $_POST["phone"];
                $this->clientModel->changeOrigin($clientId, $newPhone);
            }



            header("location: /pw2-grupo03/client/editClient?id=$clientId");
            exit();
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function deleteClient()
    {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isAdmin()) {
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