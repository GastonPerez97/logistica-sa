<?php
include('./qrlib.php');

$travelId = $_GET["id"];
QRcode::png("https://fleshly-trials.000webhostapp.com/travel/loadData?id=" . $travelId);