<?php
include_once('../includes/db.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['id']) && isset($data['ime']) && isset($data['prezime'])) {
        $stmt = $conn->prepare("UPDATE users SET ime = ?, prezime = ? WHERE id = ?");
        $stmt->bind_param("ssi", $data['ime'], $data['prezime'], $data['id']);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Korisnik uspešno izmenjen."]);
        } else {
            echo json_encode(["success" => false, "message" => "Greška: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Nedostaju podaci."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Zahtev mora biti PUT."]);
}

$conn->close();
?>
