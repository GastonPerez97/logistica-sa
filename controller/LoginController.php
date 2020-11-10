<?php

class LoginController {

    private $userModel;
    private $render;

    public function __construct($userModel, $render) {
        $this->render = $render;
        $this->userModel = $userModel;
    }

    public function execute() {
        echo $this->render->render("view/loginView.php");
    }

    public function validarLogin() {
        $email = $_POST["email"];
        $pass = md5($_POST["pass"]);

        if (empty($this->userModel->getUserByEmailAndPass($email, $pass))) {
            header("location: /pw2-grupo03");
            exit();
        } else {
            $_SESSION['loggedIn'] = 1;
            header("location: /pw2-grupo03/home");
            exit();
        }
    }

}
