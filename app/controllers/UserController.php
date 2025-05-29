<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function index() {
        echo json_encode($this->user->getAll());
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['ime']) || !isset($data['prezime'])) {
            echo json_encode(["success" => false, "message" => "Nedostaju podaci."]);
            return;
        }
        if ($this->user->create($data['ime'], $data['prezime'])) {
            echo json_encode(["success" => true, "message" => "Korisnik dodat."]);
        } else {
            echo json_encode(["success" => false, "message" => "Greška prilikom dodavanja."]);
        }
    }

    public function update() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['id'], $data['ime'], $data['prezime'])) {
            echo json_encode(["success" => false, "message" => "Nedostaju podaci."]);
            return;
        }
        if ($this->user->update($data['id'], $data['ime'], $data['prezime'])) {
            echo json_encode(["success" => true, "message" => "Korisnik izmenjen."]);
        } else {
            echo json_encode(["success" => false, "message" => "Greška prilikom izmene."]);
        }
    }

    public function delete() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['id'])) {
            echo json_encode(["success" => false, "message" => "ID nije poslat."]);
            return;
        }
        if ($this->user->delete($data['id'])) {
            echo json_encode(["success" => true, "message" => "Korisnik obrisan."]);
        } else {
            echo json_encode(["success" => false, "message" => "Greška prilikom brisanja."]);
        }
    }
}
