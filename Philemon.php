<?php
include'philemon.html';

// File to store data


$file = "data.json";

// Create your file 
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

// Get request type
$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    $motion = $data['motion'] ?? "unknown";
    $time = date("Y-m-d H:i:s");

    $entry = [
        "motion" => $motion,
        "time" => $time
    ];

    // Save latest data
    file_put_contents($file, json_encode($entry));

    echo json_encode([
        "status" => "success",
        "message" => "Data received"
    ]);
}


if ($method == "GET") {

    $data = json_decode(file_get_contents($file), true);

    echo json_encode($data);
}


$file = "data.json";

// Handle button clicks
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $motion = "none";

    if (isset($_POST['on'])) {
        $motion = "detected";
    }

    if (isset($_POST['off'])) {
        $motion = "none";
    }

    $data = [
        "motion" => $motion,
        "time" => date("Y-m-d H:i:s")
    ];

    file_put_contents($file, json_encode($data));
}

?>