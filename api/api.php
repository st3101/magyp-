<?php

use LDAP\Result;

include '../config/database.php';
include '../src/controllers/relaciones.php';

include '../src/models/vlan.php';
include '../src/models/persona.php';
include '../src/models/servidor.php';
include '../src/models/aplicativo.php';

// Obtener el método de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

$servidor = new Servidor($pdo);
$persona = new Persona($pdo);
$vlan = new Vlan($pdo);
$aplicativo = new Aplicativo($pdo);
$relaciones = new Relaciones($pdo);



if ($method == 'GET' && isset($_GET['id_servidor'])) {
    $id_servidor = $_GET['id_servidor'];
    $resultado = $relaciones->obtenerServidorPorId($id_servidor);  // Llamar a la función
} else {
    echo json_encode(['error' => 'Método o parámetros no soportados']);
}

echo $resultado;