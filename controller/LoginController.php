<?php

class LoginController {

    private $userModel;
    private $userRoleModel;
    private $render;

    public function __construct($userModel, $userRoleModel, $render) {
        $this->render = $render;
        $this->userModel = $userModel;
        $this->userRoleModel = $userRoleModel;
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

            header("location: /pw2-grupo03/home");
            exit();
        }
    }

}
