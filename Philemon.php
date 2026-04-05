<?php

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

?>