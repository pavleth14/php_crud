<?php
include_once('../includes/db.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT id, ime, prezime FROM users";
    $result = $conn->query($sql);

    $users = [];

    if ($result && $result->num_rows > 0) {        
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    echo json_encode($users);
}

$conn->close();
?>
