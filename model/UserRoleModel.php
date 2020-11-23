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

    public function hasRole($roleId) {
        foreach ($_SESSION["roles"] as $role) {
            if ($role["id_rol"] == $roleId) {
                return true;
            }
        }

        return false;
    }

    public function isAdmin() {
        return $this->hasRole(1);
    }

    public function isSupervisor() {
        return $this->hasRole(2);
    }

    public function isEncargado() {
        return $this->hasRole(3);
    }

    public function isChofer() {
        return $this->hasRole(4);
    }

}