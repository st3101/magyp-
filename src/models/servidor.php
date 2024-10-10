<?php

class Servidor {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Listar servidores sin pasar $conn, usa $this->pdo
    function obtenerJson() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM servidor");  // Usamos $this->pdo aquí
            $servers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($servers);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Error al recuperar los servidores: ' . $e->getMessage()]);
        }
    }

    // Método para agregar un servidor
    public function agregar($nombre, $ambiente, $ubicacion, $SO, $CPU, $RAM, $disco, $ip, $comentario, $id_vlan ,$id_owner, $id_responsable) {
        try {
            $sql = "INSERT INTO servidor (nombre, ambiente, ubicacion, SO, CPU, RAM, disco, ip, comentario, id_vlan, id_owner, id_responsable) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$nombre, $ambiente, $ubicacion, $SO, $CPU, $RAM, $disco ,$ip, $comentario, $id_vlan ,$id_owner, $id_responsable]);
        } catch (PDOException $e) {
            echo "Error al agregar el servidor: " . $e->getMessage();
            return false;
        }
    }

    // Método para actualizar un servidor (arreglado el error en la sintaxis)
    public function actualizar($id, $nombre, $ambiente, $ubicacion, $SO, $CPU, $RAM, $disco, $ip, $comentario ,$id_vlan, $id_owner, $id_responsable) {
        try {
            $sql = "UPDATE servidor 
                    SET nombre = ?, ambiente = ?, ubicacion = ?, SO = ?, CPU = ?, RAM = ?, disco = ?, ip = ?, comentario = ?, id_vlan = ?, id_owner = ?, id_responsable = ?
                    WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$nombre, $ambiente, $ubicacion, $SO, $CPU, $RAM, $disco, $ip, $comentario, $id_vlan, $id_owner, $id_responsable, $id]);
        } catch (PDOException $e) {
            echo "Error al actualizar el servidor: " . $e->getMessage();
            return false;
        }
    }

    // Método para eliminar un servidor
    public function eliminar($id) {
        try {
            $sql = "DELETE FROM servidor WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error al eliminar el servidor: " . $e->getMessage();
            return false;
        }
    }
}
