<?php
include_once('../includes/db.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Očekujemo da ID dolazi iz POST body
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['id'])) {
        $userId = intval($data['id']);
        $sql = "DELETE FROM users WHERE id = $userId";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["success" => true, "message" => "Korisnik obrisan."]);
        } else {
            echo json_encode(["success" => false, "message" => "Greška pri brisanju."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "ID nije poslat."]);
    }
}

$conn->close();
?>
