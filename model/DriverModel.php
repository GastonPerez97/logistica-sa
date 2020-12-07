<?php


class DriverModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    private function insertDriver($userId, $licenceTypeId, $licenceNumber) {
        $insertDriver = $this->database->prepare("INSERT INTO chofer
                                            (numero_licencia, id_tipo_licencia, id_usuario)
                                            VALUES (?, ?, ?)");

        $insertDriver->bind_param("isi", $licenceNumber, $licenceTypeId, $userId);
        $insertDriver->execute();
    }

    private function updateDriver($userId, $licenceTypeId, $licenceNumber) {
        $editDriver = $this->database->prepare("UPDATE       chofer
                                                SET         numero_licencia = ?, 
                                                            id_tipo_licencia = ?
                                                WHERE       id_usuario = ?");

        $editDriver->bind_param("sii", $licenceNumber, $licenceTypeId, $userId);
        $editDriver->execute();
    }

    public function processDriver($userId, $licenceTypeId, $licenceNumber) {

        $query = $this->database->prepare("SELECT       us.id_usuario
                                            FROM        usuario us
                                            INNER JOIN  chofer dr ON us.id_usuario = dr.id_usuario
                                            WHERE       us.id_usuario = ?");
        $query->bind_param("i", $userId);
        $query->execute();
        $queryResult = $query->get_result();

        //die(var_dump(mysqli_fetch_assoc($queryResult)["id_usuario"]));

        $user["id_usuario"] = mysqli_fetch_assoc($queryResult)["id_usuario"];

        if ($user["id_usuario"] != 0) {
            $this->updateDriver($userId, $licenceTypeId, $licenceNumber);
        } else {
            $this->insertDriver($userId, $licenceTypeId, $licenceNumber);
        }
    }

    public function getTypesOfLicence() {
        $sql = "SELECT * FROM tipo_licencia";
        return $this->database->query($sql);
    }

}