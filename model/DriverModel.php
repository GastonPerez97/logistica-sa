<?php


class DriverModel {

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

    public function processDriver($userId, $licenceTypeId, $licenceNumber) {

        $query = $this->database->prepare("SELECT       us.id_usuario
                                            FROM        usuario us
                                            INNER JOIN  chofer dr ON us.id_usuario = dr.id_usuario
                                            WHERE       us.id_usuario = ?");
        $query->bind_param("i", $userId);
        $query->execute();
        $queryResult = $query->get_result();

        $user = array();

        while($row = mysqli_fetch_assoc($queryResult)){
            $user["id_usuario"] = $row["id_usuario"];
        }

        if ($user["id_usuario"] != 0) {
            $editDriver = $this->database->prepare("UPDATE       chofer
                                                        SET         numero_licencia = ?, 
                                                                    id_tipo_licencia = ?
                                                        WHERE       id_usuario = ?");

            $editDriver->bind_param("sii", $licenceNumber, $licenceTypeId, $userId);
            $editDriver->execute();

        } else {
            $insertDriver = $this->database->prepare("INSERT INTO chofer
                                            (numero_licencia, id_tipo_licencia, id_usuario)
                                            VALUES (?, ?, ?)");

            $insertDriver->bind_param("isi", $licenceNumber, $licenceTypeId, $userId);
            $insertDriver->execute();
        }
    }

    public function getTypesOfLicence() {
        $sql = "SELECT * FROM tipo_licencia";
        return $this->database->query($sql);
    }

    public function deleteClientById($clientId) {
        $sql = "DELETE FROM cliente WHERE id_cliente = '$clientId'";
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
}