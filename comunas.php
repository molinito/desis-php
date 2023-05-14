<?php
require_once('bd.php');

$region_id = mysqli_real_escape_string($conn, $_GET['region_id']);

$sql = "SELECT c.id, c.comuna ".
       "FROM comunas c inner join provincias p on p.id = c.provincia_id inner join regiones r on r.id = p.region_id ".
       "WHERE r.id = $region_id ".
       "ORDER BY c.comuna";
$result = mysqli_query($conn, $sql);

$regiones = array();

// Iterar sobre las filas devueltas
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    $fila = mysqli_fetch_assoc($result);
    array_push($regiones, array('id' => $fila['id'], 'nombre' => $fila['comuna']));
}

$json = json_encode($regiones);

// Establecer la cabecera HTTP correspondiente para indicar que la respuesta es en formato JSON
header('Content-Type: application/json');

// Enviar la respuesta en formato JSON
echo $json;
