<?php

class Servidor {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
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

    // Método para actualizar un servidor
    public function actualizar($id, $nombre, $ambiente, $ubicacion, $SO, $CPU, $RAM, $disco, $ip, $comentario ,$id_vlan, $id_owner, $id_responsable) {
        try {
            $sql = "UPDATE servidor 
                    SET nombre = ?, ambiente = ?, ubicacion = ?, SO = ?, CPU = ?, RAM = ?, disco = ?, ip = ?, comentario = ? ,id_vlan = ?, id_owner ,id_responsable = ?
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
