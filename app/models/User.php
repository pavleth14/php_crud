<?php
require_once __DIR__ . '/../core/Database.php';

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function getAll() {
        $result = $this->conn->query("SELECT id, ime, prezime FROM users");
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function create($ime, $prezime) {
        $stmt = $this->conn->prepare("INSERT INTO users (ime, prezime) VALUES (?, ?)");
        $stmt->bind_param("ss", $ime, $prezime);
        return $stmt->execute();
    }

    public function update($id, $ime, $prezime) {
        $stmt = $this->conn->prepare("UPDATE users SET ime = ?, prezime = ? WHERE id = ?");
        $stmt->bind_param("ssi", $ime, $prezime, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
