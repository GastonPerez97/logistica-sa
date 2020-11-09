<?php

class UserModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function saveUser($user) {
        $email = $user["email"];
        $dni = $user["dni"];
        $fullname = $user["fullname"];
        $birthday = $user["birthday"];
        $pass = $user["pass"];

        $sql = "INSERT INTO usuario (email, dni, nombre, fecha, password)
        VALUES ('$email', '$dni', '$fullname', '$birthday', '$pass')";

        $this->database->execute($sql);
    }

}