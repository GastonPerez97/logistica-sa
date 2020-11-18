<?php

class RegistrarseController {

    private $userModel;
    private $render;

    public function __construct($userModel, $render) {
        $this->render = $render;
        $this->userModel = $userModel;
    }

    public function execute() {
        echo $this->render->render("view/registerView.php");
    }

    public function resultadoRegistro() {
        $data = array();

        if (!$this->validateRegistration()) {
            $data["errorValidacion"] = "Ocurrió un error en la validación 
                                        de los datos ingresados, intente nuevamente";

            echo $this->render->render("view/resultadoRegistro.php", $data);
        } else {
            $user = array(
                "email" => $_POST["email"],
                "dni" => $_POST["dni"],
                "name" => $_POST["name"],
                "surname" => $_POST["surname"],
                "birthdate" => $_POST["birthdate"],
                "pass" => md5($_POST["pass"])
            );

            $this->userModel->saveUser($user);
            $data["registroCorrecto"] = "Registrado exitosamente, ya podés iniciar sesión";

            echo $this->render->render("view/resultadoRegistro.php", $data);
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
