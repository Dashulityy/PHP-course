<?php
include "src/iTariff.php";
include "src/iService.php";
include "src/AbstractTarif.php";
include "src/BasicTarif.php";
include "src/PerHourTarif.php";
include "src/StudentTarif.php";
include "src/DriverService.php";
include "src/GPSService.php";

/** @var iTarif $tarif*/
$tarif = new BasicTarif(5, 60);
//$tarif = new PerHourTarif(5, 62);
//$tarif = new StudentTarif(5, 60);
$tarif->addService(new GPSService());
$tarif->addService(new DriverService());
echo $tarif->calcPrice();