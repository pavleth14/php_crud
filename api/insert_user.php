<?php
include_once('../includes/db.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents("php://input");
    $data = json_decode($json, true);

    if (isset($data['ime']) && isset($data['prezime'])) {
        $stmt = $conn->prepare("INSERT INTO users (ime, prezime) VALUES (?, ?)");
        $stmt->bind_param("ss", $data['ime'], $data['prezime']);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Korisnik dodat."]);
        } else {
            echo json_encode(["success" => false, "message" => "Greška: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Nedostaju podaci."]);
    }
}
$conn->close();
?>
