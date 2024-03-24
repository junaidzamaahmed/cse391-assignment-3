<?php
$sn = "localhost";
$un = "root";
$pw = "";
$dbname = "car_workshop";

$conn =  mysqli_connect($sn, $un, $pw, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$prefix = str_contains(__DIR__, "dashboard") ? "../" : "/car_workshop/";
