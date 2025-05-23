<?php
session_start();

$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "usuarios_db");

// Verificar la conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Preparar la consulta para evitar inyecciones SQL
$query = $conexion->prepare("SELECT usuario, password, puesto FROM usuario WHERE usuario = ? AND password = ?");
$query->bind_param("ss", $usuario, $password);

// Ejecutar la consulta
$query->execute();
$resultado = $query->get_result();

// Verificar si se encontró algún resultado
if ($resultado->num_rows === 1) {
    // Obtener los datos del usuario
    $filas = $resultado->fetch_assoc();

    // Iniciar sesión y redirigir según el puesto
    $_SESSION['usuario'] = $filas['usuario'];
    $_SESSION['puesto'] = $filas['puesto'];

    if ($filas['puesto'] === 'Administrador') {
        header("Location: home.php");
        exit();
    } elseif ($filas['puesto'] === 'Cliente') {
        header("Location: gf.html");
        exit();
    } else {
        // En caso de un puesto no válido, mostrar el formulario de inicio de sesión
        include("inicio.html");
    }
} else {
    // En caso de no encontrar el usuario, mostrar el formulario de inicio de sesión
    include("inicio.html");
}

// Cerrar la conexión
$query->close();
mysqli_close($conexion);
?>
