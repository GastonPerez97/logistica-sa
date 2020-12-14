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

            if (!$this->clientModel->validateNewClient()) {
                $data["errorValidate"] = "Ocurrió un error en la validación 
                                        de los datos ingresados, intente nuevamente";
            } else {
                $newClient = array(
                    "email" => $_POST["email"],
                    "cuit" => $_POST["cuit"],
                    "phone" => $_POST["phone"],
                    "address" => $_POST["address"],
                    "denomination" => $_POST["denomination"],
                    "contact1" => $_POST["contact1"],
                    "contact2" => $_POST["contact2"],
                );

                if (!$this->clientModel->checkIfAlreadyExists($newClient)) {
                    $this->clientModel->saveClient($newClient);
                    $data["correctNewClient"] = "Cliente registrado correctamente";
                } else {
                    $data["errorValidate"] = "Error: El cliente ya se encuentra registrado";
                }
            }

            echo $this->render->render("view/newClientResultView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
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

            if ($_POST["cuit"] != $client[0]["cuit"]) {
                $newCuit = $_POST["cuit"];
                $this->clientModel->changeCuit($clientId, $newCuit);
            }

            if ($_POST["address"] != $client[0]["direccion"]) {
                $newAddress = $_POST["address"];
                $this->clientModel->changeAddress($clientId, $newAddress);
            }

            if ($_POST["denomination"] != $client[0]["denominacion"]) {
                $newDenomination = $_POST["denomination"];
                $this->clientModel->changeDenomination($clientId, $newDenomination);
            }

            if ($_POST["email"] != $client[0]["email"]) {
                $newEmail = $_POST["email"];
                $this->clientModel->changeEmail($clientId, $newEmail);
            }

            if ($_POST["phone"] != $client[0]["telefono"]) {
                $newPhone = $_POST["phone"];
                $this->clientModel->changePhone($clientId, $newPhone);
            }

            if ($_POST["contact1"] != $client[0]["contacto1"]) {
                $newContact1 = $_POST["contact1"];
                $this->clientModel->changeContact1($clientId, $newContact1);
            }

            if ($_POST["contact2"] != $client[0]["contacto2"]) {
                $newContact2 = $_POST["contact2"];
                $this->clientModel->changeContact2($clientId, $newContact2);
            }

            header("location: /pw2-grupo03/client");
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }
    
}