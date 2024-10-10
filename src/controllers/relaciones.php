<?php

class Relaciones {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerServidorPorId($id_servidor) {
        try {
            $sql = "SELECT 
                        s.nombre AS servidor_nombre,
                        s.ambiente, 
                        s.ubicacion, 
                        s.SO, 
                        s.CPU, 
                        s.RAM, 
                        s.disco, 
                        s.ip, 
                        s.comentario AS servidor_comentario,
                        v.nombre AS vlan_nombre, 
                        v.numero_vlan, 
                        v.comentario AS vlan_comentario,
                        o.nombre AS owner_nombre, 
                        o.email AS owner_email, 
                        o.telefono AS owner_telefono,
                        r.nombre AS responsable_nombre,
                        r.email AS responsable_email,
                        r.telefono AS responsable_telefono,
                        a.nombre_sistema, 
                        a.area, 
                        a.publicador, 
                        a.url_principal, 
                        a.comentario AS aplicativo_comentario
                    FROM servidor s
                    LEFT JOIN vlan v ON s.id_vlan = v.id
                    LEFT JOIN persona o ON s.id_owner = o.id
                    LEFT JOIN persona r ON s.id_responsable = r.id
                    LEFT JOIN aplicativo a ON s.id = a.id_servidor
                    WHERE s.id = ? LIMIT 1";  // Limitar la consulta a un solo resultado
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_servidor]);
            $servidor = $stmt->fetch(PDO::FETCH_ASSOC); // Cambiado a fetch para un solo registro
    
            if ($servidor) {
                return json_encode($servidor);
            } else {
                return json_encode(['error' => 'No se encontraron datos para el servidor especificado.']);
            }
        } catch (PDOException $e) {
            return json_encode(['error' => 'Error al recuperar los datos del servidor: ' . $e->getMessage()]);
        }
    }
    
    
    
}
