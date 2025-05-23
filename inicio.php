<?php
// Conexión a la base de datos (ajustar según tu configuración)
$conn = new mysqli('localhost', 'root', '', 'usuarios_db');

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los productos con ID entre 40 y 48
$sql = "SELECT * FROM productos WHERE id BETWEEN 40 AND 48";
$result = $conn->query($sql);

// Mostrar los productos
while ($row = $result->fetch_assoc()) {
    echo '<div class="gallery-item">';
    echo '<a href="producto.php?id=' . $row['id'] . '">';
    
    // Suponiendo que la columna 'imagen_url' contiene la ruta de la imagen (ej. 'Imagenes/image1.jpg')
    $imagePath = $row['imagen']; // Asumiendo que 'imagen_url' es la columna con el nombre o ruta de la imagen

    // Mostrar la imagen con el enlace al producto
    echo '<img src="' . $imagePath . '" alt="' . $row['nombre'] . '">';
    echo '</a>';
    echo '</div>';
}

// Cerrar la conexión
$conn->close();
?>
