<?php
include_once("helper/MysqlDatabase.php");
include_once("helper/Render.php");
include_once("helper/UrlHelper.php");

include_once("model/UserModel.php");

include_once("controller/LoginController.php");
include_once("controller/RegistrarseController.php");

include_once('third-party/mustache/src/Mustache/Autoloader.php');
include_once("Router.php");

class Configuration {

    private function getDatabase() {
        $config = $this->getConfig();
        return new MysqlDatabase(
            $config["servername"],
            $config["username"],
            $config["password"],
            $config["dbname"]
        );
    }

    private function getConfig() {
        return parse_ini_file("config/config.ini");
    }

    public function getRender() {
        return new Render('view/partial');
    }

    public function getRouter() {
        return new Router($this);
    }

    public function getUrlHelper() {
        return new UrlHelper();
    }

    public function getUserModel(){
        $database = $this->getDatabase();
        return new UserModel($database);
    }

    public function getLoginController() {
        return new LoginController($this->getRender());
    }

    public function getRegistrarseController() {
        $userModel = $this->getUserModel();
        return new RegistrarseController($userModel, $this->getRender());
    }

}