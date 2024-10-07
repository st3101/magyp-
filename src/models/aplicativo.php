<?php

class Aplicativo {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function listarServidores($conn) {
        try {
            $stmt = $conn->query("SELECT * FROM servers");  
            $servers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($servers);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Error al recuperar los servidores: ' . $e->getMessage()]);
        }
    }


    // Método para agregar un aplicativo
    public function agregar($nombre_sistema, $area, $publicador, $url_principal, $comentario, $web, $url_host, $id_servidor) {
        $sql = "INSERT INTO aplicativo (nombre_sistema, area, publicador, url_principal, comentario, web, url_host, id_servidor) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre_sistema, $area, $publicador, $url_principal, $comentario, $web, $url_host, $id_servidor]);
    }

    // Método para actualizar un aplicativo
    public function actualizar($nombre_sistema, $area, $publicador, $url_principal, $comentario, $web, $url_host, $id_servidor, $id) {
        $sql = "UPDATE aplicativo 
                SET nombre_sistema = ?, area = ?, publicador = ?, url_principal = ? , comentario = ?, web = ?, url_host = ?, id_servidor = ?
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre_sistema, $area, $publicador, $url_principal, $comentario, $web, $url_host, $id_servidor, $id]);
    }

    // Método para eliminar un aplicativo
    public function eliminar($id) {
        $sql = "DELETE FROM aplicativo WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
