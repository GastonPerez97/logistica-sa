<?php

class UsuariosController {

    private $userModel;
    private $roleModel;
    private $userRoleModel;
    private $driverModel;
    private $render;

    public function __construct($userModel, $roleModel, $userRoleModel, $driverModel, $render) {
        $this->render = $render;
        $this->userModel = $userModel;
        $this->roleModel = $roleModel;
        $this->userRoleModel = $userRoleModel;
        $this->driverModel = $driverModel;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["admin"] == 1) {
            if (isset($_SESSION["userDeletedOk"]) && $_SESSION["userDeletedOk"] === 1) {
                $data["userDeletedOk"] = "El usuario ha sido eliminado exitosamente";
                unset($_SESSION["userDeletedOk"]);
            }

            $data["users"] = $this->userModel->getUsers();

            echo $this->render->render("view/usersView.php", $data);
        } else {
            header("location: /");
            exit();
        }
    }

    public function editarUsuario() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["admin"] == 1) {
            if (is_numeric($_GET["id"])){
                $userId = $_GET["id"];
                $data["user"] = $this->userModel->getUserById($userId);
                $data["roles"] = $this->roleModel->getRoles();
                $data["typesOfLicence"] = $this->driverModel->getTypesOfLicence();

                $userRoles = $this->userRoleModel->getRolesOfUserBy($userId);

                foreach ($userRoles as $userRole) {
                    if ($userRole["id_rol"] == 1) {
                        $data["roles"][0]["checked"] = "checked";
                    }

                    if ($userRole["id_rol"] == 2) {
                        $data["roles"][1]["checked"] = "checked";
                    }

                    if ($userRole["id_rol"] == 3) {
                        $data["roles"][2]["checked"] = "checked";
                    }

                    if ($userRole["id_rol"] == 4) {
                        $data["roles"][3]["checked"] = "checked";
                    }
                    if ($userRole["id_rol"] == 5) {
                        $data["roles"][4]["checked"] = "checked";
                    }
                }

                echo $this->render->render("view/editUserView.php", $data);
            } else {
                header("location: /usuarios");
                exit();
            }
        } else {
            header("location: /");
            exit();
        }
    }

    public function processEditUser() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["admin"] == 1) {
            $userId = $_POST["userId"];
            $user = $this->userModel->getUserById($userId);

            if (!empty($_POST["roles"])) {
                $roles = $_POST["roles"];
                $this->userModel->assignRolesToUser($userId, $roles);
            } else {
                $this->userModel->removeRolesOfUser($userId);
            }

            if ($_POST["email"] != $user[0]["email"]) {
                $newEmail = $_POST["email"];
                $this->userModel->changeEmail($userId, $newEmail);
            }

            if (isset($_POST["active"])) {
                $this->userModel->activateUser($userId);
            } else {
                $this->userModel->deactivateUser($userId);
            }

            if ((isset($_POST["licenceType"]) && $_POST["licenceType"] != "") &&
                (isset($_POST["licenceNumber"]) && $_POST["licenceNumber"] != "")) {
                $licenceTypeId = $_POST["licenceType"];
                $licenceNumber = $_POST["licenceNumber"];
                $this->driverModel->processDriver($userId, $licenceTypeId, $licenceNumber);
            }

            $_SESSION["userEditedOk"] = 1;

            header("location: /usuarios/verUsuario?id=$userId");
            exit();
        } else {
            header("location: /");
            exit();
        }
    }

    public function verUsuario() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["admin"] == 1) {
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
                header("location: /usuarios");
                exit();
            }
        } else {
            header("location: /");
            exit();
        }
    }

}
