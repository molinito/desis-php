<?php
require_once('bd.php');

$sql = "SELECT id, capital FROM regiones ORDER BY capital";
$result = mysqli_query($conn, $sql);

$regiones = array();

// Iterar sobre las filas devueltas
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    $fila = mysqli_fetch_assoc($result);
    array_push($regiones, array('id' => $fila['id'], 'nombre' => $fila['capital']));
}

$json = json_encode($regiones);

// Establecer la cabecera HTTP correspondiente para indicar que la respuesta es en formato JSON
header('Content-Type: application/json');

// Enviar la respuesta en formato JSON
echo $json;
