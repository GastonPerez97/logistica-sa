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

    public function getUserByEmailAndPass($email, $pass) {
        $sql = "SELECT * FROM usuario WHERE email = '$email' AND password = '$pass'";
        return $this->database->query($sql);
    }

}