<?php

class RoleModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getRoles() {
        $sql = "SELECT id_rol, nombre, descripcion FROM rol";
        return $this->database->query($sql);
    }
}