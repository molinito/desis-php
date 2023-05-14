<?php
// Conexión a la base de datos
$conn = mysqli_connect('localhost', 'root', '', 'votacion');

// Verificar la conexión
if (!$conn) {
    die('Error de conexión: ' . mysqli_connect_error());
}
