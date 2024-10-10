<?php

class Vlan{

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    function obtenerJson() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM vlan");  // 
            $servers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($servers);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Error al recuperar los servidores: ' . $e->getMessage()]);
        }
    }

    public function agregar($nombre,$numero_vlan, $comentario){

        $sql = "INSERT INTO vlan (nombre, numero_vlan, comentario) 
                VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $numero_vlan, $comentario]);
    }

// Método para actualizar un servidor
public function actualizar($nombre, $numero, $comentario, $id) {
    $sql = "UPDATE vlan 
            SET nombre = ?, numero_vlan = ?, comentario = ?
            WHERE id = ?";  
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$nombre, $numero, $comentario, $id]);
}


    // Método para eliminar un servidor
    public function eliminar($id) {
        $sql = "DELETE FROM vlan WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}