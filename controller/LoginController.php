<?php

class LoginController {

    private $userModel;
    private $render;

    public function __construct($userModel, $render) {
        $this->render = $render;
        $this->userModel = $userModel;
    }

    public function execute() {
        $data = array();

        if (isset($_SESSION["errorLogin"]) && $_SESSION["errorLogin"] === 1) {
            $data["wrongMailOrPass"] = "E-Mail o contraseña incorrecta";
            unset($_SESSION["errorLogin"]);
        }

        echo $this->render->render("view/loginView.php", $data);
    }

    public function validarLogin() {
        $email = $_POST["email"];
        $pass = md5($_POST["pass"]);

        if (empty($this->userModel->getUserByEmailAndPass($email, $pass))) {
            $_SESSION["errorLogin"] = 1;
            header("location: /pw2-grupo03");
            exit();
        } else {
            $_SESSION['loggedIn'] = 1;
            header("location: /pw2-grupo03/home");
            exit();
        }
    }

}
