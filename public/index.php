<?php
// Incluir el archivo de conexión a la base de datos
require_once '../config/database.php';

// inclulle las clases 
require_once '../src/models/servidor.php';
require_once '../src/models/vlan.php';
require_once '../src/models/persona.php';
require_once '../src/models/aplicativo.php';

try {
    // Crear una instancia

    #region Vlan
    //$obj = new Vlan($pdo);
    #agregar 
    //$obj->agregar("nombre",0,test);
    #actualizar
    //$obj->actualizar("nombre3",3,"test3",3);
    #eliminar
    //$obj->eliminar(4);
    #endregion
    
    #region Servidor
    // $obj = new Servidor($pdo);

    // $nombre = "servidorNombre";  // Nombre del servidor
    // $ambiente = "desarollo";  // Ambiente (producción, desarrollo, etc.)
    // $ubicacion = "982";  // Ubicación física del servidor
    // $SO = "win 2016";  // Sistema operativo
    // $CPU = "i3";  // Procesador
    // $RAM = 32;  // Memoria en GB
    // $disco = "10TB"; 
    // $ip = "192.168.1.31"; // Dirección IP
    // $comentario = "Esto es un comentario agradable";  // Comentarios generales
    // $id_vlan = 1;
    // $id_owner = 1;
    // $id_responsable = 1;

    // $obj->agregar($nombre,$ambiente,$ubicacion,$SO,$CPU,$RAM,$disco,$ip,$comentario,$id_vlan,$id_owner,$id_responsable);
    #endregion

    #region Persona
    $obj = new Persona($pdo);
    #agregar
    //$obj->agregar("preterminado","preterminado@ejemplo.com","+54 1155071331"); 
    #modificar
    //$obj->actualizar("pordefecto","preterminado@ejemplo.ar","+54 1155071300",1);
    #eliminar
    //$obj->eliminar(2);
    #endregion
    
    #region Aplicativo
    $obj = new Aplicativo($pdo);
    #Agregar
    //$obj->agregar("Sistema de Gestión", "Administración", "Departamento de IT", "https://www.ejemplo.com", "Producción", "Sistema para gestión de inventario.", true, "https://host.ejemplo.com", 9);
    #editar
    #endregion
    if($obj){echo "Funciono";}


} catch (PDOException $e) {
    echo "\n Error al interactuar con la base de datos: " . $e->getMessage();
}
?>

