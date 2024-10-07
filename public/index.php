<?php
    // URL de la API
    $url = 'http://localhost/ABM/api/api.php';
    
    $response = file_get_contents($url);

    
    $data = json_decode($response,true);
    
    var_dump($data);
?>