<?php

class LoginController {

    private $userModel;
    private $userRoleModel;
    private $driverModel;
    private $render;

    public function __construct($userModel, $userRoleModel, $driverModel, $render) {
        $this->render = $render;
        $this->userModel = $userModel;
        $this->userRoleModel = $userRoleModel;
        $this->driverModel = $driverModel;
    }

    public function execute() {
        $data = array();

        if (isset($_SESSION["errorLogin"]) && $_SESSION["errorLogin"] === 1) {
            $data["wrongMailOrPass"] = "E-Mail o contraseña incorrecta";
            unset($_SESSION["errorLogin"]);
        }

        if (isset($_SESSION["userNotActive"]) && $_SESSION["userNotActive"] === 1) {
            $data["userNotActive"] = "Tu usuario se encuentra deshabilitado. Contacta a un administrador";
            unset($_SESSION["userNotActive"]);
        }

        echo $this->render->render("view/loginView.php", $data);
    }

    public function validarLogin() {
        $email = $_POST["email"];
        $pass = md5($_POST["pass"]);

        $user = $this->userModel->getUserByEmailAndPass($email, $pass);

        if (empty($user)) {
            $_SESSION["errorLogin"] = 1;
            header("location: /pw2-grupo03");
            exit();
        } else if ($user[0]["activado"] == 0) {
            $_SESSION["userNotActive"] = 1;
            header("location: /pw2-grupo03");
            exit();
        } else {
            $userId = $user[0]["id_usuario"];
            $username = $user[0]["nombre"];

            $_SESSION['loggedIn'] = 1;
            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $userId;
            $_SESSION["roles"] = $this->userRoleModel->getRolesOfUserBy($userId);
            $_SESSION['admin'] = $this->userRoleModel->isAdmin($userId);
            $_SESSION['supervisor'] = $this->userRoleModel->isSupervisor($userId);
            $_SESSION['encargado'] = $this->userRoleModel->isEncargado($userId);
            $_SESSION['chofer'] = $this->userRoleModel->isChofer($userId);

            if ($_SESSION['chofer'] == 1) {
                $_SESSION['driverId'] = $this->driverModel->getDriverIdOf($userId);
            }

            if ($_SESSION['supervisor'] == 1 || $_SESSION['chofer'] == 1) {
                $_SESSION['canSeeViajesBtn'] = 1;
            }

            if ($_SESSION['supervisor'] == 1 || $_SESSION['admin'] == 1 || $_SESSION['encargado'] == 1) {
                $_SESSION['canSeeVehiclePositionBtn'] = 1;
            }

            header("location: /pw2-grupo03/home");
            exit();
        }
    }

}
