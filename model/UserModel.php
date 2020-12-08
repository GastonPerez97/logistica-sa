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
        /*$query = $this->database->prepare("SELECT      us.*,
                                                        dr.numero_licencia,
                                                        dr.id_tipo_licencia
                                            FROM        usuario us
                                            LEFT JOIN   chofer dr ON us.id_usuario = dr.id_usuario
                                            WHERE       us.id_usuario = ?");
        $query->bind_param("i", $userId);
        $query->execute();
        return $query->get_result();*/
        $sql = "SELECT      us.*,
                            dr.numero_licencia,
                            dr.id_tipo_licencia 
                FROM        usuario us
                LEFT JOIN   chofer dr ON us.id_usuario = dr.id_usuario
                WHERE       us.id_usuario = '$userId'";
        //die($this->database->query($sql));
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

    public function getDrivers() {
        $sql = "SELECT id_chofer, numero_licencia, id_tipo_licencia FROM chofer";
        return $this->database->query($sql);
    }
    
    public function assignRolesToUser($userId, $roles) {
        $this->removeRolesOfUser($userId);

        if (in_array("1", $roles)) {
            $sqlAssignRole = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES ('$userId', '1'), ('$userId', '2'), ('$userId', '3'), ('$userId', '4')";
            $this->database->execute($sqlAssignRole);
        } else {
            foreach ($roles as $role) {
                $sqlAssignRole = "INSERT INTO usuario_rol (id_usuario, id_rol) VALUES ('$userId', '$role')";
                $this->database->execute($sqlAssignRole);
            }
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

    public function checkIfEmailAndDniAlreadyExists($email, $dni) {
        $sql = "SELECT * FROM usuario WHERE email = '$email' OR dni = '$dni'";
        $result = $this->database->query($sql);

        if (empty($result)) {
            return false;
        } else {
            return true;
        }
    }

    public function validateRegistration() {
        if (empty($_POST['name']) ||
            empty($_POST['surname']) ||
            empty($_POST['dni']) ||
            empty($_POST['email']) ||
            empty($_POST['pass']) ||
            empty($_POST['birthdate'])) {
            return false;
        } else {
            return true;
        }
    }

}