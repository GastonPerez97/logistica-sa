<?php


class BillController {

    private $billModel;
    private $render;

    public function __construct($billModel, $render) {
        $this->billModel = $billModel;
        $this->render = $render;
    }

    public function execute() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1) {
            $data["bills"] = $this->billModel->getBills();
            echo $this->render->render("view/billsView.php", $data);
        } else {
            header("location: /");
            exit();
        }
    }

    public function viewBill() {
        if (isset($_SESSION["loggedIn"]) && $_SESSION["supervisor"] == 1 && isset($_GET["id"])) {
            $travelId = $_GET["id"];

            if ($this->billModel->checkIfBillExistsOf($travelId)) {
                $this->billModel->generateBillOf($travelId);
            } else {
                header("location: /bill");
                exit();
            }
        } else {
            header("location: /");
            exit();
        }
    }
    
}