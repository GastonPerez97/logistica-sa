<?php

class QRModel {

    public function generateQROfReportOf($travelId) {
        return "https://fleshly-trials.000webhostapp.com/third-party/phpqrcode/QRGenerator.php?id=$travelId";
    }
}