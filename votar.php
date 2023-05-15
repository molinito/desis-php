<?php
require_once('bd.php');

// Obtener/ validar los datos del formulario
$nombre_apellido = mysqli_real_escape_string($conn, $_POST['nombre_apellido']);
$alias = mysqli_real_escape_string($conn, $_POST['alias']);
// Validar longitud del alias
if (strlen($alias) < 5) {
    // El alias no cumple con la longitud mínima
    enviar_error_json("El alias debe tener al menos 5 caracteres");
    exit;
}

// Validar que el alias contenga letras y números
if (!preg_match("/[a-zA-Z]/", $alias) || !preg_match("/[0-9]/", $alias)) {
    // El alias no contiene letras y números
    enviar_error_json("El alias debe contener letras y números");
    exit;
}
$rut = mysqli_real_escape_string($conn, $_POST['rut']);
/*validar el RUT de acuerdo al formato de Chile, ejemplo 12.345.678-K ó 12.345.678-9 */
if (!preg_match("/^[0-9]{1,2}\.[0-9]{3}\.[0-9]{3}-[0-9kK]{1}$/", $rut)) {
    enviar_error_json("El RUT ingresado no es válido");
    exit;
}

$email = mysqli_real_escape_string($conn, $_POST['email']);
// Validar el correo electrónico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // El correo electrónico no es válido
    enviar_error_json("El correo electrónico ingresado no es válido");
    exit;
}
$comuna_id = mysqli_real_escape_string($conn, $_POST['comuna_id']);
$candidato_id = mysqli_real_escape_string($conn, $_POST['candidato_id']);


if (!isset($_POST['medios'])) {
    enviar_error_json('Por favor incluya al menos dos valores para el campo "Como se enteró de nosotros"');
    exit;
}

if (count($_POST['medios']) < 2) {
    enviar_error_json('Por favor incluya al menos dos valores para el campo "Como se enteró de nosotros"');
    exit;
}

$medios = implode(",", $_POST['medios']);

// Validar la duplicación de votos por RUT
$sql = "SELECT COUNT(*) AS total FROM votos WHERE rut = '$rut'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['total'] > 0) {
    enviar_error_json("Ya existe un voto con el RUT ingresado");
    exit;
}

// Insertar los datos en la tabla de votos
$sql = "INSERT INTO votos (comuna_id, candidato_id, fecha, nombre_apellido, alias, rut, email, medios) VALUES ('$comuna_id', '$candidato_id', NOW(), '$nombre_apellido', '$alias', '$rut', '$email', '$medios')";

try {
    mysqli_query($conn, $sql);
    enviar_resultado_json("El voto se ha guardado correctamente");
} catch (Exception $e) {
    # enviar_error_json("Error al guardar el voto: " . mysqli_error($conn));
    enviar_error_json("Error al guardar el voto: " . $e->getMessage());
    exit;
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);

function enviar_resultado_json($mensaje) {
    // Crear un arreglo con el mensaje de error
    $error = array("mensaje" => $mensaje);

    // Convertir el arreglo a formato JSON
    $json = json_encode($error);

    // Establecer la cabecera HTTP correspondiente para indicar que la respuesta es en formato JSON
    header('Content-Type: application/json');

    // Enviar la respuesta en formato JSON
    echo $json;
}

function enviar_error_json($mensaje_error) {
    // Establecer el código de respuesta HTTP
    http_response_code(400);

    // Crear un arreglo con el mensaje de error
    $error = array("error" => $mensaje_error);

    // Convertir el arreglo a formato JSON
    $json_error = json_encode($error);

    // Establecer la cabecera HTTP correspondiente para indicar que la respuesta es en formato JSON
    header('Content-Type: application/json');

    // Enviar la respuesta en formato JSON
    echo $json_error;
}
