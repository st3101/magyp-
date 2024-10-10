<?php
// Definir la URL de la API a la que deseas hacer la solicitud
$url = 'http://localhost/ABM/api/api.php?accion=relacion_listar';

// Hacer la solicitud GET a la API
$response = file_get_contents($url);

// Verificar si la respuesta es válida
if ($response === false) {
    echo "Error al conectar con la API";
    exit;
}

// Decodificar la respuesta JSON
$data = json_decode($response, true);

var_dump($data);

/*
// Verificar si la decodificación fue exitosa
if (is_array($data) && !empty($data)) {
    echo '<table border="1" cellpadding="10" cellspacing="0">';
    echo '<thead>
            <tr>
                <th>Servidor Nombre</th>
                <th>Ambiente</th>
                <th>Ubicación</th>
                <th>Sistema Operativo</th>
                <th>CPU</th>
                <th>RAM</th>
                <th>Disco</th>
                <th>IP</th>
                <th>Comentario Servidor</th>
                <th>VLAN Nombre</th>
                <th>VLAN Número</th>
                <th>Comentario VLAN</th>
                <th>Owner Nombre</th>
                <th>Owner Email</th>
                <th>Owner Teléfono</th>
                <th>Responsable Nombre</th>
                <th>Responsable Email</th>
                <th>Responsable Teléfono</th>
                <th>Aplicativo Sistema</th>
                <th>Aplicativo Área</th>
                <th>Aplicativo Publicador</th>
                <th>Aplicativo Principal</th>
                <th>Comentario Aplicativo</th>
            </tr>
          </thead>';
    echo '<tbody>';
    
    foreach ($data as $servidor) {
        // Muestra información del servidor
        echo "<tr>";
        echo "<td>" . htmlspecialchars($servidor['servidor_nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['ambiente']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['ubicacion']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['SO']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['CPU']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['RAM']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['disco']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['ip']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['servidor_comentario']) . "</td>";
        // Muestra información de VLAN
        echo "<td>" . htmlspecialchars($servidor['vlan_nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['numero_vlan']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['vlan_comentario']) . "</td>";
        // Información del owner
        echo "<td>" . htmlspecialchars($servidor['owner_nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['owner_email']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['owner_telefono']) . "</td>";
        // Información del responsable
        echo "<td>" . htmlspecialchars($servidor['responsable_nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['responsable_email']) . "</td>";
        echo "<td>" . htmlspecialchars($servidor['responsable_telefono']) . "</td>";
        
        // Para los aplicativos relacionados
        if (isset($servidor['aplicativos']) && is_array($servidor['aplicativos'])) {
            foreach ($servidor['aplicativos'] as $aplicativo) {
                echo "<tr>";
                echo "<td colspan='18'></td>"; // Celdas vacías para mantener la estructura de la tabla
                echo "<td>" . htmlspecialchars($aplicativo['sistema']) . "</td>";
                echo "<td>" . htmlspecialchars($aplicativo['area']) . "</td>";
                echo "<td>" . htmlspecialchars($aplicativo['publicador']) . "</td>";
                echo "<td>" . htmlspecialchars($aplicativo['principal']) . "</td>";
                echo "<td>" . htmlspecialchars($aplicativo['comentario']) . "</td>";
                echo "</tr>"; // Cierra la fila para cada aplicativo
            }
        }
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo "<p>No se encontraron resultados.</p>";
}
*/