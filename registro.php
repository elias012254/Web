<?php
// Configura los detalles de la base de datos
$servername = "localhost"; // Cambia esto si tu servidor es diferente
$username = "root"; // Cambia esto según tu configuración
$password = ""; // Cambia esto según tu configuración
$dbname = "usuarios_db"; // Cambia esto por tu nombre de base de datos

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recupera y limpia los datos del formulario
$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
$genero = $_POST['genero'] ?? '';
$usuario = $_POST['usuario'] ?? ''; // Cambiado de correo a usuario
$contraseña = $_POST['password'] ?? ''; // Cambiado de contraseña a password
$numero = $_POST['numero'] ?? ''; // Nuevo campo
$rol = $_POST['puesto'] ?? 'cliente'; // Campo oculto para el rol, con valor predeterminado de "cliente"

// Valida los datos
if (empty($nombre) || empty($apellido) || empty($fecha_nacimiento) || empty($genero) || empty($usuario) || empty($contraseña) || empty($numero)) {
    echo "Todos los campos son obligatorios. Por favor, complete el formulario correctamente.";
    exit;
}

// Prepara y ejecuta la consulta
$stmt = $conn->prepare("INSERT INTO usuario (nombre, apellido, fecha_nacimiento, genero, usuario, password, numero, puesto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $nombre, $apellido, $fecha_nacimiento, $genero, $usuario, $contraseña, $numero, $rol);

if ($stmt->execute()) {
    // Redirige al usuario a la página de inicio de sesión
    header("Location: inicio.html");
    exit;
} else {
    echo "Error al registrar la cuenta: " . $stmt->error;
}

// Cierra la conexión
$stmt->close();
$conn->close();
?>
