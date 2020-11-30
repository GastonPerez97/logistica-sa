<?php

class QRModel {

    public function generateQROfReportOf($travelId) {
        return "http://localhost/pw2-grupo03/third-party/phpqrcode/QRGenerator.php?id=$travelId";
    }
}