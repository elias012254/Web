<?php
include("config.php");

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$materno = $_POST['materno'];
$correo = $_POST['correo'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "UPDATE usuarios SET nombre='$nombre', apellido='$paterno', fecha_nacimiento='$materno', Correo_electronico='$correo', usuario='$username', password='$password'
WHERE usuario='$id'";
if(mysqli_query($mysqli, $sql)){
    echo '<script language="javascript">';
    echo 'alert("Registro actualizado exitósamente");';
    echo 'window.location="users.php";';
    echo '</script>';
   
} else {
    echo '<script language="javascript">';
    echo 'alert("Error en proceso de actualización de registro!");';
    echo 'window.location="users.php";';
    echo '</script>';
}
?>