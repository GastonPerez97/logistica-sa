<?php

class UserRoleModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getRolesOfUserBy($userId) {
        $sql = "SELECT UR.id_rol, R.nombre FROM usuario_rol UR JOIN rol R ON UR.id_rol = R.id_rol WHERE id_usuario = '$userId'";
        return $this->database->query($sql);
    }

    public function isAdmin() {
        foreach ($_SESSION["roles"] as $role) {
            if ($role["id_rol"] == 1) {
                return true;
            }
        }

        return false;
    }
}