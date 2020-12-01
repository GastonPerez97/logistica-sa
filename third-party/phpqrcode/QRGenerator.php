<?php
include('./qrlib.php');

$travelId = $_GET["id"];
QRcode::png("http://localhost/pw2-grupo03/travel/loadData?id=" . $travelId);