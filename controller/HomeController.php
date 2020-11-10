<?php

class HomeController {

    private $render;

    public function __construct($render) {
        $this->render = $render;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"])) {
            echo $this->render->render("view/homeView.php");
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

}
