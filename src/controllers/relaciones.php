<?php

class Relaciones {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listarTodosJson() {
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
                        a.nombre_sistema AS aplicativo_sistema, 
                        a.area AS aplicativo_area, 
                        a.publicador AS aplicativo_publicador, 
                        a.url_principal AS aplicativo_principal, 
                        a.comentario AS aplicativo_comentario
                    FROM servidor s
                    LEFT JOIN vlan v ON s.id_vlan = v.id
                    LEFT JOIN persona o ON s.id_owner = o.id
                    LEFT JOIN persona r ON s.id_responsable = r.id
                    LEFT JOIN aplicativo a ON s.id = a.id_servidor";
    
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            
            // Inicializar el array para almacenar los servidores
            $servidores = [];
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $servidor_nombre = $row['servidor_nombre'];
                
                // Si el servidor no está en el array, lo agregamos
                if (!isset($servidores[$servidor_nombre])) {
                    $servidores[$servidor_nombre] = [
                        'servidor_nombre' => $row['servidor_nombre'],
                        'ambiente' => $row['ambiente'],
                        'ubicacion' => $row['ubicacion'],
                        'SO' => $row['SO'],
                        'CPU' => $row['CPU'],
                        'RAM' => $row['RAM'],
                        'disco' => $row['disco'],
                        'ip' => $row['ip'],
                        'servidor_comentario' => $row['servidor_comentario'],
                        'vlan_nombre' => $row['vlan_nombre'],
                        'numero_vlan' => $row['numero_vlan'],
                        'vlan_comentario' => $row['vlan_comentario'],
                        'owner_nombre' => $row['owner_nombre'],
                        'owner_email' => $row['owner_email'],
                        'owner_telefono' => $row['owner_telefono'],
                        'responsable_nombre' => $row['responsable_nombre'],
                        'responsable_email' => $row['responsable_email'],
                        'responsable_telefono' => $row['responsable_telefono'],
                        'aplicativos' => [] // Inicializa un array para los aplicativos
                    ];
                }
    
                // Agrega el aplicativo a la lista de aplicativos del servidor
                $servidores[$servidor_nombre]['aplicativos'][] = [
                    'sistema' => $row['aplicativo_sistema'],
                    'area' => $row['aplicativo_area'],
                    'publicador' => $row['aplicativo_publicador'],
                    'principal' => $row['aplicativo_principal'],
                    'comentario' => $row['aplicativo_comentario']
                ];
            }
    
            // Convertir el array de servidores a formato JSON para la respuesta
            return json_encode(array_values($servidores));
    
        } catch (Exception $e) {
            return json_encode(['error' => 'Error al obtener datos: ' . $e->getMessage()]);
        }
    }
    
    public function obtenerServidorConAplicativos($id_servidor) {
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
                        a.nombre_sistema AS aplicativo_sistema, 
                        a.area AS aplicativo_area, 
                        a.publicador AS aplicativo_publicador, 
                        a.url_principal AS aplicativo_principal, 
                        a.comentario AS aplicativo_comentario
                    FROM servidor s
                    LEFT JOIN vlan v ON s.id_vlan = v.id
                    LEFT JOIN persona o ON s.id_owner = o.id
                    LEFT JOIN persona r ON s.id_responsable = r.id
                    LEFT JOIN aplicativo a ON s.id = a.id_servidor
                    WHERE s.id = ?"; // Asegúrate de filtrar por el ID del servidor
        
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_servidor]);
            $servidor = $stmt->fetchAll(PDO::FETCH_ASSOC); // Cambia fetch a fetchAll para obtener todos los resultados
    
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
