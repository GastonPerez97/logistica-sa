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

    public function validateUserLogin($user){
        $connection = connect();
        session_start();

        $email = $user["email"];
        $pass = $user["pass"];

        $sql = "SELECT COUNT(*) as contar FROM usuarios 
                WHERE (usuario = '$email' AND clave = '$pass') ";

        $queryExecute = mysqli_query($connection, $sql);

        $searchUsuario = mysqli_fetch_array($queryExecute);
        if ($searchUsuario['count'] > 0) {
            $_SESSION['loggedIn'] = 1;
        } else {
            header("location: loginView.php");
        }
    }

}