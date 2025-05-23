
<?php
include_once('../includes/db.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Čita sirovi JSON string iz tela zahteva
    $json = file_get_contents("php://input");

    // Pretvara JSON u PHP asocijativni niz
    $data = json_decode($json, true);

    // Hvata podatke iz dekodiranog JSON-a
    $ime = $data['ime'];
    $prezime = $data['prezime'];

    $sql = "INSERT INTO users (ime, prezime) VALUES ('$ime', '$prezime')";

    // $conn->query($sql);

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
