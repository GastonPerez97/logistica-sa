<?php


class ServiceController
{
    private $serviceModel;
    private $render;

    public function __construct($serviceModel, $render) {
        $this->render = $render;
        $this->serviceModel = $serviceModel;
    }

    public function execute() {
        echo $this->render->render("view/serviceView.php");
    }


}