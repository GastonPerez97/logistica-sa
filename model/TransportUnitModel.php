<?php


class TransportUnitModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getVehicleById($idVehicle)
    {
        $query = $this->database->prepare("SELECT       ut.*,
                                                        v.*,
                                                        m.nombre as marca,
                                                        mo.nombre as modelo,
                                                        tv.nombre as tipo,
                                                        IF(activo = 1, 'Activo', 'Inactivo') as estado_pretty,
                                                        activo as estado
                                            FROM        unidad_de_transporte ut
                                            INNER JOIN  vehiculo v ON ut.id_unidad_de_transporte = v.id_vehiculo
                                            INNER JOIN  marca m ON ut.id_marca = m.id_marca
                                            INNER JOIN  modelo mo ON ut.id_modelo = mo.id_modelo
                                            INNER JOIN  tipo_vehiculo tv ON v.id_tipo_vehiculo = tv.id_tipo_vehiculo
                                            WHERE       ut.id_unidad_de_transporte = ?");
        $query->bind_param("i", $idVehicle);
        $query->execute();
        return $query->get_result();
    }

    public function getTrailerById($idTrailer)
    {
        $query = $this->database->prepare("SELECT       ut.*,
                                                        r.*,
                                                        m.nombre as marca,
                                                        mo.nombre as modelo,
                                                        tr.nombre as tipo,
                                                        IF(activo = 1, 'Activo', 'Inactivo') as estado_pretty,
                                                        activo as estado
                                            FROM        unidad_de_transporte ut
                                            INNER JOIN  remolque r ON ut.id_unidad_de_transporte = r.id_remolque
                                            INNER JOIN  marca m ON ut.id_marca = m.id_marca
                                            INNER JOIN  modelo mo ON ut.id_modelo = mo.id_modelo
                                            INNER JOIN  tipo_remolque tr ON r.id_tipo_remolque = tr.id_tipo_remolque
                                            WHERE       ut.id_unidad_de_transporte = ?");
        $query->bind_param("i", $idTrailer);
        $query->execute();
        return $query->get_result();
    }

    public function saveTransportUnit($newTransportUnit) {
        $patentNumber = $newTransportUnit["patentNumber"];
        $yeorOfProduction = $newTransportUnit["yeorOfProduction"];
        $chassisNumber = $newTransportUnit["chassisNumber"];
        $brand = $newTransportUnit["brand"];
        $model = $newTransportUnit["model"];
        $active = intval($newTransportUnit["active"]);

        $insertTransportUnit = $this->database->prepare("INSERT INTO unidad_de_transporte
                                            (patente, anio_fabricacion, numero_chasis, id_marca, id_modelo, activo)
                                            VALUES (?, ?, ?, ?, ?, ?)");

        $insertTransportUnit->bind_param("sisiii", $patentNumber, $yeorOfProduction, $chassisNumber, $brand, $model, $active);
        $insertTransportUnit->execute();

        $lastId = $this->database->query("SELECT last_insert_id()");

        return $lastId[0]["last_insert_id()"];
    }

    public function saveNewVehicle($newVehicle)
    {
        $idTransportUnit = $newVehicle["idTransporUnit"];
        $engineNumber = $newVehicle["engineNumber"];
        $kilometers = $newVehicle["kilometers"];
        $typeOfVehicle = $newVehicle["typeOfVehicle"];

        $insertVehicle = $this->database->prepare("INSERT INTO vehiculo
                                            (id_vehiculo, numero_motor, kilometraje, id_tipo_vehiculo)
                                            VALUES (?, ?, ?, ?)");

        $insertVehicle->bind_param("isii", $idTransportUnit, $engineNumber, $kilometers, $typeOfVehicle);
        $insertVehicle->execute();
    }

    public function saveNewTrailer($newTrailer)
    {
        $idTransportUnit = $newTrailer["idTransporUnit"];
        $typeOfTrailer = $newTrailer["typeOfTrailer"];

        $insertTrailer = $this->database->prepare("INSERT INTO remolque
                                            (id_remolque, id_tipo_remolque)
                                            VALUES (?, ?)");

        $insertTrailer->bind_param("ii", $idTransportUnit, $typeOfTrailer);
        $insertTrailer->execute();
    }

    public function editTransportUnit($transportUnit) {
        $idTransportUnit = $transportUnit["idTransportUnit"];
        $patentNumber = $transportUnit["patentNumber"];
        $yeorOfProduction = $transportUnit["yeorOfProduction"];
        $chassisNumber = $transportUnit["chassisNumber"];
        $brand = $transportUnit["brand"];
        $model = $transportUnit["model"];
        $active = intval($transportUnit["active"]);

        $editTransportUnit = $this->database->prepare("UPDATE       unidad_de_transporte
                                                        SET         patente = ?, 
                                                                    anio_fabricacion = ?, 
                                                                    numero_chasis = ?, 
                                                                    id_marca = ?, 
                                                                    id_modelo = ?, 
                                                                    activo = ?
                                                        WHERE       id_unidad_de_transporte = ?");

        $editTransportUnit->bind_param("sisiiii", $patentNumber, $yeorOfProduction, $chassisNumber, $brand, $model, $active, $idTransportUnit);
        $editTransportUnit->execute();
    }

    public function editVehicle($vehicle) {
        $idTransportUnit = $vehicle["idTransporUnit"];
        $engineNumber = $vehicle["engineNumber"];
        $kilometers = $vehicle["kilometers"];
        $typeOfVehicle = $vehicle["typeOfVehicle"];

        $editVehicle = $this->database->prepare("UPDATE       vehiculo
                                                    SET         numero_motor = ?,
                                                                kilometraje = ?,
                                                                id_tipo_vehiculo = ?
                                                    WHERE       id_vehiculo = ?");

        $editVehicle->bind_param("siii", $engineNumber, $kilometers, $typeOfVehicle, $idTransportUnit);
        $editVehicle->execute();
    }

    public function editTrailer($trailer) {
        $idTransportUnit = $trailer["idTransporUnit"];
        $typeOfTrailer = $trailer["typeOfTrailer"];

        $editTrailer = $this->database->prepare("UPDATE       remolque
                                                    SET         id_tipo_remolque = ?
                                                    WHERE       id_remolque = ?");

        $editTrailer->bind_param("ii", $typeOfTrailer, $idTransportUnit);
        $editTrailer->execute();
    }

    public function enableTransportUnit($transportUnit)
    {
        $idTransportUnit = $transportUnit["id"];
        $status = $transportUnit["status"];

        $insertTrailer = $this->database->prepare("UPDATE unidad_de_transporte
                                            SET activo = ?
                                            WHERE id_unidad_de_transporte = ?");

        $insertTrailer->bind_param("ii", $status, $idTransportUnit);
        $insertTrailer->execute();
    }

    public function getVehicles()
    {
        $sql = "SELECT      ut.*,
                            v.*,
                            m.nombre as marca,
                            mo.nombre as modelo,
                            tv.nombre as tipo,
                            IF(activo = 1, 'Activo', 'Inactivo') as estado_pretty,
                            activo as estado
                FROM        unidad_de_transporte ut
                INNER JOIN  vehiculo v ON ut.id_unidad_de_transporte = v.id_vehiculo
                INNER JOIN  marca m ON ut.id_marca = m.id_marca
                INNER JOIN  modelo mo ON ut.id_modelo = mo.id_modelo
                INNER JOIN  tipo_vehiculo tv ON v.id_tipo_vehiculo = tv.id_tipo_vehiculo";
        return $this->database->query($sql);
    }

    public function getTypesOfVehicles()
    {
        $sql = "SELECT * FROM tipo_vehiculo";
        return $this->database->query($sql);
    }

    public function getTrailers()
    {
        $sql = "SELECT      ut.*,
                            r.*,
                            m.nombre as marca,
                            mo.nombre as modelo,
                            tr.nombre as tipo,
                            IF(activo = 1, 'Activo', 'Inactivo') as estado_pretty,
                            activo as estado
                FROM        unidad_de_transporte ut
                INNER JOIN  remolque r ON ut.id_unidad_de_transporte = r.id_remolque
                INNER JOIN  marca m ON ut.id_marca = m.id_marca
                INNER JOIN  modelo mo ON ut.id_modelo = mo.id_modelo
                INNER JOIN  tipo_remolque tr ON r.id_tipo_remolque = tr.id_tipo_remolque";
        return $this->database->query($sql);
    }

    public function getTypesOfTrailers()
    {
        $sql = "SELECT * FROM tipo_remolque";
        return $this->database->query($sql);
    }

    public function getBrands()
    {
        $sql = "SELECT * FROM marca";
        return $this->database->query($sql);
    }

    public function getModels()
    {
        $sql = "SELECT * FROM modelo";
        return $this->database->query($sql);
    }

    public function getModelsByBrand($idBrand)
    {
        $query = $this->database->prepare("SELECT * FROM modelo
                                            WHERE id_marca = (?)");
        $query->bind_param("i", $idBrand);
        $query->execute();
        $queryResult = $query->get_result();

        $models = array();

        while($row = mysqli_fetch_assoc($queryResult)){
            $models["id_modelo"] = $row["id_modelo"];
            $models["nombre"] = $row["nombre"];
        }

        return $models;
    }
}