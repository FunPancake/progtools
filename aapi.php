<?php
header("Content-Type: application/json");

// Creates Json File
$dataFile = 'users.json';

//Check File Exists
if (file_exists($dataFile)) {
    $jsonData = file_get_contents($dataFile);
    $users = json_decode($jsonData, true);
}

//Display Lists
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($users);


//Add to users list
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $newUser = [
        "id" => count($users) + 1, // increment lists
        "name" => $data['name']
    ];
    $users[] = $newUser;

    // Encode the updated users array to JSON
    $updatedJsonData = json_encode($users, JSON_PRETTY_PRINT);

    // Save the updated JSON data back to the file
    file_put_contents($dataFile, $updatedJsonData);

    echo json_encode($newUser);
}
?>
