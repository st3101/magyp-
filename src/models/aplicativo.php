<?php

class Aplicativo {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function agregar($nombre_sistema, $area, $publicador, $url_principal, $ambiente, $comentario, $web, $url_host, $id_servidor) {
        $sql = "INSERT INTO aplicativo (nombre_sistema, area, publicador, url_principal, ambiente, comentario, web, url_host, id_servidor) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre_sistema, $area, $publicador, $url_principal, $ambiente, $comentario, $web, $url_host, $id_servidor]);
    }

    // Método para actualizar un sistema
    public function actualizar($id, $nombre_sistema, $area, $publicador, $url_principal, $url_secundaria, $ambiente, $comentario, $web, $url_host, $id_servidor, $id_onwer, $id_responsable) {
        $sql = "UPDATE sistema 
                SET nombre_sistema = ?, area = ?, publicador = ?, url_principal = ?, url_secundaria = ?, ambiente = ?, comentarios = ?, web = ?, url_host = ?, id_servidor = ?, id_onwer_persona = ?, id_responsable_persona = ?
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre_sistema, $area, $publicador, $url_principal, $url_secundaria, $ambiente, $comentario, $web, $url_host, $id_servidor, $id_onwer, $id_responsable, $id]);
    }

    // Método para eliminar un sistema
    public function eliminar($id) {
        $sql = "DELETE FROM sistema WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
