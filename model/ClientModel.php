<?php


class ClientModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function saveClient($client){

        $name = $client["name"];
        $surname = $client["surname"];
        $dni = $client["dni"];
        $email = $client["email"];
        $phone = $client["phone"];

        $sql = "INSERT INTO cliente (email, dni, telefono, nombre, apellido)
                VALUES ('$email', '$dni', '$phone', '$name', '$surname')";

        $this->database->execute($sql);

    }

    public function getClients()
    {
        $sql = "SELECT * FROM cliente";
        return $this->database->query($sql);
    }

    public function getClientById($clientId)
    {
        $sql = "SELECT * FROM cliente WHERE id_cliente = '$clientId'";
        return $this->database->query($sql);
    }

    public function changeName($clientId, $newName)
    {
        $sql = "UPDATE cliente SET nombre = '$newName' WHERE  id_cliente = '$clientId'";
        $this->database->execute($sql);
    }

    public function changeSurname($clientId, $newSurname)
    {
        $sql = "UPDATE cliente SET apellido = '$newSurname' WHERE  id_cliente = '$clientId'";
        $this->database->execute($sql);
    }

    public function changeDni($clientId, $newDni)
    {
        $sql = "UPDATE cliente SET dni = '$newDni' WHERE  id_cliente = '$clientId'";
        $this->database->execute($sql);
    }

    public function changeEmail($clientId, $newEmail)
    {
        $sql = "UPDATE cliente SET email = '$newEmail' WHERE  id_cliente = '$clientId'";
        $this->database->execute($sql);
    }

    public function changePhone($clientId, $newPhone)
    {
        $sql = "UPDATE cliente SET telefono = '$newPhone' WHERE  id_cliente = '$clientId'";
        $this->database->execute($sql);
    }

        public function deleteClientById($clientId)
    {
        $sql = "DELETE FROM cliente WHERE id_cliente = '$clientId'";
        $this->database->execute($sql);
    }


}