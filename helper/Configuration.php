<?php
include_once("helper/MysqlDatabase.php");
include_once("helper/Render.php");
include_once("helper/UrlHelper.php");

include_once("model/UserModel.php");
include_once("model/ServiceModel.php");
include_once("model/RoleModel.php");
include_once("model/UserRoleModel.php");
include_once("model/TravelModel.php");
include_once("model/TransportUnitModel.php");
include_once("model/ClientModel.php");

include_once("controller/LoginController.php");
include_once("controller/LogoutController.php");
include_once("controller/RegistrarseController.php");
include_once("controller/HomeController.php");
include_once("controller/ServiceController.php");
include_once("controller/UsuariosController.php");
include_once("controller/TravelController.php");
include_once("controller/TransportUnitController.php");
include_once("controller/ClientController.php");
include_once("controller/ReportController.php");

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

    public function getServiceModel(){
        $database = $this->getDatabase();
        return new ServiceModel($database);
    }

    public function getRoleModel(){
        $database = $this->getDatabase();
        return new RoleModel($database);
    }

    public function getUserRoleModel(){
        $database = $this->getDatabase();
        return new UserRoleModel($database);
    }

    public function getTravelModel(){
        $database = $this->getDatabase();
        return new TravelModel($database);
    }
    public function getClientModel(){
        $database = $this->getDatabase();
        return new ClientModel($database);
    }

    public function getTransportUnitModel(){
        $database = $this->getDatabase();
        return new TransportUnitModel($database);
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

    public function getServiceController() {
        $serviceModel = $this->getServiceModel();
        $userRoleModel = $this->getUserRoleModel();
        return new ServiceController($serviceModel, $userRoleModel, $this->getRender());
    }

    public function getReportController() {
        $userRoleModel = $this->getUserRoleModel();
        return new ReportController($userRoleModel, $this->getRender());
    }

    public function getUsuariosController() {
        $userModel = $this->getUserModel();
        $roleModel = $this->getRoleModel();
        $userRoleModel = $this->getUserRoleModel();
        return new UsuariosController($userModel, $roleModel, $userRoleModel, $this->getRender());
    }

    public function getTravelController() {
        $travelModel = $this->getTravelModel();
        $userRoleModel = $this->getUserRoleModel();
        return new TravelController($travelModel, $userRoleModel, $this->getRender());
    }
    public function getClientController() {
        $clientModel = $this->getClientModel();
        $userRoleModel = $this->getUserRoleModel();
        return new ClientController($clientModel, $userRoleModel, $this->getRender());
    }

    public function getTransportUnitController() {
        $transportUnitModel = $this->getTransportUnitModel();
        $userRoleModel = $this->getUserRoleModel();
        return new TransportUnitController($transportUnitModel, $userRoleModel, $this->getRender());
    }

}