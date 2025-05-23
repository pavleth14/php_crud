<?php
include_once('../includes/db.php');

// CORS i headeri
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Proveri da li je zahtev PUT
if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    // Čitanje raw JSON podataka iz tela zahteva
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['id']) && isset($data['ime']) && isset($data['prezime'])) {
        $id = intval($data['id']);
        $ime = $conn->real_escape_string($data['ime']);
        $prezime = $conn->real_escape_string($data['prezime']);

        // SQL upit za izmenu korisnika
        $sql = "UPDATE users SET ime = '$ime', prezime = '$prezime' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["success" => true, "message" => "Korisnik uspešno izmenjen."]);
        } else {
            echo json_encode(["success" => false, "message" => "Greška pri izmeni korisnika: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Nedostaju podaci."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Zahtev mora biti PUT."]);
}

$conn->close();
?>
