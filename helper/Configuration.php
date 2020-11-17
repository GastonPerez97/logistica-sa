<?php
include_once("helper/MysqlDatabase.php");
include_once("helper/Render.php");
include_once("helper/UrlHelper.php");

include_once("model/UserModel.php");
include_once("model/RoleModel.php");
include_once("model/UserRoleModel.php");

include_once("controller/LoginController.php");
include_once("controller/LogoutController.php");
include_once("controller/RegistrarseController.php");
include_once("controller/HomeController.php");
include_once("controller/UsuariosController.php");

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

    public function getRoleModel(){
        $database = $this->getDatabase();
        return new RoleModel($database);
    }

    public function getUserRoleModel(){
        $database = $this->getDatabase();
        return new UserRoleModel($database);
    }

    public function getLoginController() {
        $userModel = $this->getUserModel();
        $userRoleModel = $this->getUserRoleModel();
        return new LoginController($userModel, $userRoleModel, $this->getRender());
    }

    public function getLogoutController() {
        return new LogoutController($this->getRender());
    }

    public function getRegistrarseController() {
        $userModel = $this->getUserModel();
        return new RegistrarseController($userModel, $this->getRender());
    }

    public function getHomeController() {
        return new HomeController($this->getRender());
    }

    public function getUsuariosController() {
        $userModel = $this->getUserModel();
        $roleModel = $this->getRoleModel();
        $userRoleModel = $this->getUserRoleModel();
        return new UsuariosController($userModel, $roleModel, $userRoleModel, $this->getRender());
    }

}