<?php

class travelDriverModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function isTravelAssignedToDriver($travelId, $driverId) {
        $sql = "SELECT * FROM viaje_chofer WHERE id_viaje = '$travelId' AND id_chofer = '$driverId'";
        $result = $this->database->query($sql);

        if (empty($result)) {
            return false;
        } else {
            return true;
        }
    }

}