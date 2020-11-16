<?php

class UsuariosController {

    private $userModel;
    private $render;

    public function __construct($userModel, $render) {
        $this->render = $render;
        $this->userModel = $userModel;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"])) {
            echo $this->render->render("view/usersView.php");
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

}
