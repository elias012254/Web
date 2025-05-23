<?php
include("config.php");

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$genero = $_POST['genero'];
$puesto = $_POST['puesto'];
$numero = $_POST['numero'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];

$sql = "INSERT INTO usuario(nombre, apellido, fecha_nacimiento, genero, puesto, numero, usuario, password)
VALUES('$nombre', '$apellido', '$fecha_nacimiento', '$genero', '$puesto', '$numero', '$usuario', '$password')";
if(mysqli_query($mysqli, $sql)){
    echo '<script language="javascript">';
    echo 'alert("Nuevo usuario agregado");';
    echo 'window.location="home.php";';
    echo '</script>';
   
} else {
    echo '<script language="javascript">';
    echo 'alert("Usuario duplicado!");';
    echo 'window.location="registration.php";';
    echo '</script>';
}
?>