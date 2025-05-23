
<?php
include_once('../includes/db.php');

// Uključivanje izveštaja o greškama
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');  // Postavi tip sadržaja na JSON

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT * FROM users";  // sve iz baze, moze i samo ime i prezime iz baze
    $result = $conn->query($sql);  

    // Priprema niz za odgovarajući JSON format
    $users = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $users[] = [
                'id' => $row['id'],         // Dodaj id
                'ime' => $row['ime'],       // Dodaj ime
                'prezime' => $row['prezime'] // Dodaj prezime
            ];
        }
    }   

    echo json_encode($users);  // Vraća JSON podatke u traženom formatu
}

$conn->close();
?>
