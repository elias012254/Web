<?php
include("config.php");

// Obtener los valores del formulario
$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];

// Establecer la fecha de publicación automáticamente a la fecha actual
$fecha_publicacion = date('Y-m-d');

// Manejo de la imagen
$imagen = $_FILES['imagen']['tmp_name'];
$uploadOk = 1;

// Verificar si hubo algún error durante la carga
if ($_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
    echo '<script language="javascript">';
    echo 'alert("Error al subir el archivo: ' . $_FILES['imagen']['error'] . '");';
    echo 'window.location="regis.php";';
    echo '</script>';
    exit;
}

// Leer el contenido de la imagen
$imagenData = file_get_contents($imagen);

// Insertar los datos en la base de datos
$sql = "INSERT INTO productos(nombre, cantidad, precio, descripcion, imagen, fecha_publicacion)
        VALUES('$nombre', '$cantidad', '$precio', '$descripcion', ?, '$fecha_publicacion')";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("b", $imagenData); // 'b' indica que es un blob

if ($stmt->execute()) {
    echo '<script language="javascript">';
    echo 'alert("Nuevo producto agregado");';
    echo 'window.location="regis.php";';
    echo '</script>';
} else {
    echo '<script language="javascript">';
    echo 'alert("Error al agregar el producto.");';
    echo 'window.location="regis.php";';
    echo '</script>';
}

$stmt->close();
?>
