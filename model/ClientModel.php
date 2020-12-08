<?php


class ClientModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function saveClient($client) {
        $email = $client["email"];
        $cuit = $client["cuit"];
        $phone = $client["phone"];
        $address = $client["address"];
        $denomination = $client["denomination"];
        $contact1 = $client["contact1"];
        $contact2 = $client["contact2"];

        $sql = "INSERT INTO cliente (email, cuit, telefono, direccion, denominacion, contacto1, contacto2)
                VALUES ('$email', '$cuit', '$phone', '$address', '$denomination', '$contact1', '$contact2')";

        $this->database->execute($sql);
    }

    public function getClients() {
        $sql = "SELECT * FROM cliente";
        return $this->database->query($sql);
    }

    public function getClientById($clientId) {
        $sql = "SELECT * FROM cliente WHERE id_cliente = '$clientId'";
        return $this->database->query($sql);
    }

    public function changeCuit($clientId, $newCuit) {
        $sql = "UPDATE cliente SET cuit = '$newCuit' WHERE id_cliente = '$clientId'";
        $this->database->execute($sql);
    }

    public function changeAddress($clientId, $newAddress) {
        $sql = "UPDATE cliente SET direccion = '$newAddress' WHERE id_cliente = '$clientId'";
        $this->database->execute($sql);
    }

    public function changePhone($clientId, $newPhone) {
        $sql = "UPDATE cliente SET telefono = '$newPhone' WHERE id_cliente = '$clientId'";
        $this->database->execute($sql);
    }

    public function changeDenomination($clientId, $newDenomination) {
        $sql = "UPDATE cliente SET denominacion = '$newDenomination' WHERE id_cliente = '$clientId'";
        $this->database->execute($sql);
    }

    public function changeEmail($clientId, $newEmail) {
        $sql = "UPDATE cliente SET email = '$newEmail' WHERE id_cliente = '$clientId'";
        $this->database->execute($sql);
    }

    public function changeContact1($clientId, $newContact1) {
        $sql = "UPDATE cliente SET contacto1 = '$newContact1' WHERE id_cliente = '$clientId'";
        $this->database->execute($sql);
    }

    public function changeContact2($clientId, $newContact2) {
        $sql = "UPDATE cliente SET contacto2 = '$newContact2' WHERE id_cliente = '$clientId'";
        $this->database->execute($sql);
    }

    public function checkIfAlreadyExists($client) {
        $email = $client["email"];
        $cuit = $client["cuit"];

        $checkEmailSql = "SELECT * FROM cliente WHERE email = '$email'";
        $checkCuitSql = "SELECT * FROM cliente WHERE cuit = '$cuit'";

        $resultEmail = $this->database->query($checkEmailSql);
        $resultCuit = $this->database->query($checkCuitSql);

        if (empty($resultEmail) && empty($resultCuit)) {
            return false;
        } else {
            return true;
        }
    }

    public function validateNewClient() {
        if (empty($_POST['email']) ||
            empty($_POST['cuit']) ||
            empty($_POST['phone']) ||
            empty($_POST['address']) ||
            empty($_POST['denomination']) ||
            empty($_POST['contact1']) ||
            empty($_POST['contact2'])
        ) {
            return false;
        } else {
            return true;
        }
    }

}