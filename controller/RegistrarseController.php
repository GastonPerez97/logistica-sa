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

        if (!$this->userModel->validateRegistration()) {
            $data["errorValidacion"] = "Ocurrió un error en la validación 
                                        de los datos ingresados, intente nuevamente";

            echo $this->render->render("view/resultadoRegistro.php", $data);
        } else if ($this->userModel->checkIfEmailAndDniAlreadyExists($_POST['email'], $_POST['dni'])) {
            $data["emailOrDniAlreadyExists"] = "El E-Mail o DNI que ingresaste ya están en uso, intente con otros";
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
            $data["registroCorrecto"] = "Registrado exitosamente, un administrador deberá activar tu cuenta";

            echo $this->render->render("view/resultadoRegistro.php", $data);
        }
    }

 }
