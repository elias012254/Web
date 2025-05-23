<?php
$host = 'localhost';
$user = 'root'; // Cambia esto por tu usuario de MariaDB
$password = ''; // Cambia esto por tu contraseña
$database = 'usuarios_db';

// Conectar a la base de datos
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar reseñas
$sql = "SELECT username, stars, comentario AS comment, fecha AS date, imagen AS profilePic FROM reseñas";
$result = $conn->query($sql);

$reseñas = [];

if ($result->num_rows > 0) {
    // Almacenar resultados en un array
    while ($row = $result->fetch_assoc()) {
        $reseñas[] = $row; // No se necesita codificar la imagen, ya que se usa la ruta
    }
}

$conn->close();

// Devolver resultados en formato JSON
header('Content-Type: application/json');
echo json_encode($reseñas);
?>
