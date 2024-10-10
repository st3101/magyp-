<?php

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

// echo  $_GET["accion"] ."\n";
// echo $_GET['id_servidor'];

if (isset($method)) {
    switch ($method) {
        case 'GET':
            if (isset($_GET['accion'])) {
                switch ($_GET['accion']) {
                    case 'relacion_listar':
                        $data = $relaciones->listarTodosJson();
                        break;
                    case 'relacion_byid':
                        if (isset($_GET['id_servidor'])) {
                            $data = $relaciones->obtenerServidorConAplicativos($_GET['id_servidor']);
                        } else {
                            $data = json_encode(['error' => 'Falta el parámetro id_servidor']);
                        }
                        break;
                    case 'servidor_listar':
                        $data = $servidor->listarTodosJson();
                        break;
                    case 'servidor_byid':
                        if (isset($_GET['id_servidor'])){
                            $data = $servidor->obtenerPorID($_GET['id_servidor']);
                        }else {
                            $data = json_encode(['error' => 'Falta el parámetro id_servidor']);
                        }
                        break;
                    case 'vlan_listar':
                         $data = $vlan->obtenerTodoJson();
                         break;
                    case 'vlan_byid':
                        if(isset($_GET['id_vlan'])){
                            $data = $vlan->obtenerPorId($_GET["id_vlan"]);
                        }
                        break;
                    default:
                        $data = json_encode(['error' => 'Acción no soportada']);
                        break;
                    }


            } else {
                $data = json_encode(['error' => 'No se especificó ninguna acción']);
            }
            break;
        
        case 'POST':
            // Código para manejar POST
            break;

        default:
            $data = json_encode(['error' => 'Método HTTP no soportado']);
            break;
    }
}

// Imprimir resultado
if (isset($data)) {
    echo $data;
}


