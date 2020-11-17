<?php

class UsuariosController {

    private $userModel;
    private $roleModel;
    private $userRoleModel;
    private $render;

    public function __construct($userModel, $roleModel, $userRoleModel, $render) {
        $this->render = $render;
        $this->userModel = $userModel;
        $this->roleModel = $roleModel;
        $this->userRoleModel = $userRoleModel;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"])) {
            $data["users"] = $this->userModel->getUsers();

            echo $this->render->render("view/usersView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function editarUsuario() {
        if (isset($_SESSION["loggedIn"])) {
            if (is_numeric($_GET["id"])){
                $userId = $_GET["id"];
                $data["user"] = $this->userModel->getUserById($userId);
                $data["roles"] = $this->roleModel->getRoles();

                echo $this->render->render("view/editUserView.php", $data);
            } else {
                header("location: /pw2-grupo03/usuarios");
                exit();
            }
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function processEditUser() {
        if (isset($_SESSION["loggedIn"])) {
            $userId = $_POST["userId"];
            $user = $this->userModel->getUserById($userId);

            if (!empty($_POST["roles"])) {
                $roles = $_POST["roles"];
                $this->userModel->assignRolesToUser($userId, $roles);
            } else {
                $this->userModel->removeRolesOfUser($userId);
            }

            if ($_POST["email"] != $user["email"]) {
                $newEmail = $_POST["email"];
                $this->userModel->changeEmail($userId, $newEmail);
            }

            if (isset($_POST["active"])) {
                $this->userModel->activateUser($userId);
            } else {
                $this->userModel->deactivateUser($userId);
            }

            $_SESSION["userEditedOk"] = 1;

            header("location: /pw2-grupo03/usuarios/verUsuario?id=$userId");
            exit();
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function verUsuario() {
        if (isset($_SESSION["loggedIn"])) {
            if (is_numeric($_GET["id"])){
                if (isset($_SESSION["userEditedOk"]) && $_SESSION["userEditedOk"] === 1) {
                    $data["userEditedOk"] = "El usuario ha sido editado exitosamente";
                    unset($_SESSION["userEditedOk"]);
                }

                $userId = $_GET["id"];
                $data["user"] = $this->userModel->getUserById($userId);
                $data["rolesOfUser"] = $this->userRoleModel->getRolesOfUserBy($userId);

                echo $this->render->render("view/userView.php", $data);
            } else {
                header("location: /pw2-grupo03/usuarios");
                exit();
            }
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

}
