<?php

class Persona {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function obtenerJson() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM persona");
            $servers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($servers);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Error al recuperar los servidores: ' . $e->getMessage()]);
        }
    }
    
    public function agregar($nombre, $email, $telefono) {
        $sql = "INSERT INTO persona (nombre, email, telefono) 
                VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $email, $telefono]);
    }

    // Método para actualizar una persona
    public function actualizar($nombre, $email, $telefono, $id) {
        $sql = "UPDATE persona 
                SET nombre = ?, email = ?, telefono = ?
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $email, $telefono, $id]);
    }

    // Método para eliminar una persona
    public function eliminar($id) {
        $sql = "DELETE FROM persona WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
