<?php

class UserModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function saveUser($user)
    {
        $email = $user["email"];
        $dni = $user["dni"];
        $name = $user["name"];
        $surname = $user["surname"];
        $birthdate = $user["birthdate"];
        $pass = $user["pass"];
        $startDate = date("Y-m-d");

        $sql = "INSERT INTO usuario (email, dni, nombre, apellido, birthdate, password, fecha_alta, activado)
                VALUES ('$email', '$dni', '$name', '$surname', '$birthdate', '$pass', '$startDate', b'0')";

        $this->database->execute($sql);
    }

    public function getUserById($userId) {
        $sql = "SELECT * FROM usuario WHERE id_usuario = '$userId'";
        return $this->database->query($sql);
    }

    public function getUserByEmailAndPass($email, $pass) {
        $sql = "SELECT * FROM usuario WHERE email = '$email' AND password = '$pass'";
        return $this->database->query($sql);
    }

    public function getUsers() {
        $sql = "SELECT U.id_usuario, U.nombre, U.apellido, U.email FROM usuario U";
        return $this->database->query($sql);
    }
    
    public function assignRolesToUser($userId, $roles) {
        $this->removeRolesOfUser($userId);

        foreach ($roles as $role) {
            $sqlAssignRole = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES ('$userId', '$role')";
            $this->database->execute($sqlAssignRole);
        }
    }

    public function removeRolesOfUser($userId) {
        $sql = "DELETE FROM usuario_rol WHERE id_usuario = '$userId'";
        $this->database->execute($sql);
    }

    public function changeEmail($userId, $newEmail) {
        $sql = "UPDATE usuario SET email = '$newEmail' WHERE id_usuario = '$userId'";
        $this->database->execute($sql);
    }

    public function activateUser($userId) {
        $sql = "UPDATE usuario SET activado = b'1' WHERE id_usuario = '$userId'";
        $this->database->execute($sql);
    }

    public function deactivateUser($userId) {
        $sql = "UPDATE usuario SET activado = b'0' WHERE id_usuario = '$userId'";
        $this->database->execute($sql);
    }

    public function deleteUserById($userId) {
        $sql = "DELETE FROM usuario WHERE id_usuario = '$userId'";
        $this->database->execute($sql);
    }

}