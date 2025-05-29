<?php
require_once __DIR__ . '/../app/controllers/UserController.php';

$controller = new UserController();

// Parsiraj URI putanju (npr. /delete, /update, itd.)
$requestUri = $_SERVER['REQUEST_URI'];
$uri = parse_url($requestUri, PHP_URL_PATH);

// Ukloni folder ako koristiš kao podfolder (prilagodi ako se zove drugačije)
$uri = str_replace('/vezba/public', '', $uri);

$method = $_SERVER['REQUEST_METHOD'];

switch ($uri) {
    case '/':
        if ($method === 'GET') {
            $controller->index();
        } elseif ($method === 'POST') {
            $controller->store();
        } else {
            echo json_encode(["success" => false, "message" => "Nepodržana metoda za rutu /"]);
        }
        break;

    case '/delete':
        if ($method === 'POST') {
            $controller->delete();
        } else {
            echo json_encode(["success" => false, "message" => "Metoda nije POST za /delete"]);
        }
        break;

    case '/update':
        if ($method === 'PUT') {
            $controller->update();
        } else {
            echo json_encode(["success" => false, "message" => "Metoda nije PUT za /update"]);
        }
        break;

    default:
        echo json_encode(["success" => false, "message" => "Nepoznata ruta."]);
        break;
}
