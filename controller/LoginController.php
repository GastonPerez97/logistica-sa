<?php

class LoginController
{

    private $render;

    public function __construct($render) {
        $this->render = $render;
    }

    public function execute() {
        echo $this->render->render("view/loginView.php");
    }

    public function validateUser() {
        $user = array(
            "email" => $_POST["email"],
            "pass" => md5($_POST["pass"])
        );

        $this->userModel->validateUserLogin($user);

        echo $this->render->render("view/homeView.php");
    }


}
