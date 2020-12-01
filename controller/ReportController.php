<?php


class ReportController {

    private $render;
    private $reportModel;
    private $travelModel;
    private $userModel;
    private $userRoleModel;

    public function __construct($reportModel, $travelModel, $userModel, $userRoleModel, $render)
    {
        $this->reportModel = $reportModel;
        $this->travelModel = $travelModel;
        $this->userModel = $userModel;
        $this->userRoleModel = $userRoleModel;
        $this->render = $render;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isAdmin()) {
            echo $this->render->render("view/reportView.php");
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function newProforma() {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isAdmin()) {
            $data["clients"] = $this->reportModel->getClients();
            $data["travels"] = $this->travelModel->getTravels();
            echo $this->render->render("view/newProformaView.php", $data);
        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

    public function createProforma() {
        if (isset($_SESSION["loggedIn"]) && $this->userRoleModel->isAdmin()) {
            $newProforma = array(
                "idClient" => $_POST["idClient"],
                "idTravel" => $_POST["idTravel"],
                "expectedViaticos" => $_POST["expectedViaticos"],
                "expectedToll" => $_POST["expectedToll"],
                "expectedExtras" => $_POST["expectedExtras"],
                "expectedHazardCost" => $_POST["expectedHazardCost"],
                "expectedReeferCost" => $_POST["expectedReeferCost"],
                "expectedFeeCost" => $_POST["expectedFeeCost"],
            );
            $this->reportModel->saveNewProforma($newProforma);
            $this->reportModel->generatePdfProforma();

        } else {
            header("location: /pw2-grupo03");
            exit();
        }
    }

}