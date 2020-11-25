<?php


class TransportUnitModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function saveNewVehicle($newService)
    {
        $patentNumber = $newService["patentNumber"];
        $yeorOfProduction = $newService["yeorOfProduction"];
        $engineNumber = $newService["engineNumber"];
        $chassisNumber = $newService["chassisNumber"];
        $kilometers = $newService["kilometers"];
        $typeOfVehicle = $newService["typeOfVehicle"];
        $brand = $newService["brand"];
        $model = $newService["model"];

        $posicion = "";

        $insertTransportUnit = $this->database->prepare("INSERT INTO unidad_de_transporte
                                            (patente, posicion_actual, anio_fabricacion, numero_chasis, id_marca, id_modelo)
                                            VALUES (?, ?, ?, ?, ?, ?)");

        $insertTransportUnit->bind_param("ssisii", $patentNumber, $posicion, $yeorOfProduction, $chassisNumber, $brand, $model);
        $insertTransportUnit->execute();

        $lastId = $this->database->query("SELECT last_insert_id()");

        $insertVehicle = $this->database->prepare("INSERT INTO vehiculo
                                            (id_vehiculo, numero_motor, kilometraje, id_tipo_vehiculo)
                                            VALUES (?, ?, ?, ?)");

        $insertVehicle->bind_param("isii", $lastId[0]["last_insert_id()"], $engineNumber, $kilometers, $typeOfVehicle);
        $insertVehicle->execute();
    }

    public function saveNewTrailer($newTrailer)
    {
        $patentNumber = $newTrailer["patentNumber"];
        $yeorOfProduction = $newTrailer["yeorOfProduction"];
        $chassisNumber = $newTrailer["chassisNumber"];
        $typeOfTrailer = $newTrailer["typeOfTrailer"];
        $brand = $newTrailer["brand"];
        $model = $newTrailer["model"];

        $posicion = "";

        $insertTransportUnit = $this->database->prepare("INSERT INTO unidad_de_transporte
                                            (patente, posicion_actual, anio_fabricacion, numero_chasis, id_marca, id_modelo)
                                            VALUES (?, ?, ?, ?, ?, ?)");

        $insertTransportUnit->bind_param("ssisii", $patentNumber, $posicion, $yeorOfProduction, $chassisNumber, $brand, $model);
        $insertTransportUnit->execute();

        $lastId = $this->database->query("SELECT last_insert_id()");

        $insertTrailer = $this->database->prepare("INSERT INTO remolque
                                            (id_remolque, id_tipo_remolque)
                                            VALUES (?, ?)");

        $insertTrailer->bind_param("ii", $lastId[0]["last_insert_id()"], $typeOfTrailer);
        $insertTrailer->execute();

    }

    public function getVehicles()
    {
        $sql = "SELECT      ut.*,
                            v.*,
                            m.nombre as marca,
                            mo.nombre as modelo,
                            tv.nombre as tipo
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
                            tr.nombre as tipo   
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
        return $query->get_result();
    }
}