<?php
// Conexión a la base de datos (ajustar según tu configuración)
$conn = new mysqli('localhost', 'root', '', 'usuarios_db');

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los productos (esto es solo un ejemplo, ajusta según tu base de datos)
$sql = "SELECT * FROM productos"; // Usar "imagen" en lugar de "imagen_url"
$result = $conn->query($sql);

// Arreglo para almacenar los productos
$productos = [];

while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

// Cerrar la conexión a la base de datos
$conn->close();

// Devolver los productos en formato JSON
echo json_encode(['items' => $productos]);
?>
