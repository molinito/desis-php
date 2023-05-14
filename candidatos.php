<?php
require_once('bd.php');

$sql = "SELECT id, nombre_completo FROM candidatos ORDER BY nombre_completo";
$result = mysqli_query($conn, $sql);

$candidatos = array();

// Iterar sobre las filas devueltas
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    $fila = mysqli_fetch_assoc($result);
    array_push($candidatos, array('id' => $fila['id'], 'nombre' => $fila['nombre_completo']));
}

$json = json_encode($candidatos);

// Establecer la cabecera HTTP correspondiente para indicar que la respuesta es en formato JSON
header('Content-Type: application/json');

// Enviar la respuesta en formato JSON
echo $json;
