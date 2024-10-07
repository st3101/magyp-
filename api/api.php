<?php

include '../config/database.php';
include '../src/models/vlan.php';
include '../src/models/persona.php';
include '../src/models/servidor.php';
include '../src/models/aplicativo.php';

$method = $_SERVER['REQUEST_METHOD'];

$servidor = new Servidor($pdo);

switch ($method) {
    case 'GET':
        $servidor->listarServidores();
        break;
    default:
        echo json_encode(['error' => 'Método no soportado']);
    break;
}