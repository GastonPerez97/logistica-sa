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

    public function getAvailableDrivers() {

        $sql = "SELECT      ch.id_chofer,
                            us.nombre,
                            us.apellido,
                            ch.numero_licencia,
                            tipo.nombre AS tipo_licencia
                FROM        usuario us
                INNER JOIN  usuario_rol ur ON us.id_usuario = ur.id_usuario
                INNER JOIN  chofer ch ON us.id_usuario = ch.id_usuario
                INNER JOIN  tipo_licencia tipo ON ch.id_tipo_licencia = tipo.id_tipo_licencia
                WHERE       ur.id_rol = 4
                            AND ch.id_chofer NOT IN (
                                SELECT      vc.id_chofer
                                FROM        viaje v
                                INNER JOIN  viaje_chofer vc ON v.id_viaje = vc.id_viaje
                                WHERE       now() BETWEEN fecha_salida_estimada AND fecha_llegada_estimada)";
        return $this->database->query($sql);
    }

    public function getDriverIdOf($userId) {
        $sql = "SELECT id_chofer FROM chofer WHERE id_usuario = '$userId'";
        $result = $this->database->query($sql);
        return $result[0]["id_chofer"];
    }

}