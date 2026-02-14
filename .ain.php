<?php
include("../config.php");

$speed = floatval($_POST['speed']);

$status = "NORMAL";

if ($speed > 80) {
    $status = "OVER_SPEED";
} elseif ($speed < 30) {
    $status = "LOW_SPEED";
}

$car_id = "UNKNOWN"; // will be replaced by ML later

$stmt = $conn->prepare("INSERT INTO car_records (car_id, speed, status) VALUES (?, ?, ?)");
$stmt->bind_param("sds", $car_id, $speed, $status);
$stmt->execute();
?>
