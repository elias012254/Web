<?php
   
    if(isset($_POST['search']))
    {
        $valueToSearh = $_POST['valueToSearh'];
        $query = "SELECT * FROM usuario WHERE nombre LIKE '%".$valueToSearh."%' OR apellido LIKE '%".$valueToSearh."%'";
        $result = filterRecord($query);
    }
    else
    {
        $query = "SELECT *FROM usuario";
        $result = filterRecord($query);
    }
   
    function filterRecord($query)
    {
        include("config.php");
        $filter_result = mysqli_query($mysqli, $query);
        return $filter_result;
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="CSS/mystyle.css" />
<link rel="stylesheet" type="text/css" href="css/cabeceras.css">
<link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
</head>
<body>

<header>
<div class="top-bar">
    <div class="menu">
    <ul>
    <li><a href="home.php"><i class="fa fa-home"></i></a></li>
    <li><a href="users.php"><i class="fa fa-user"></i></a></li>
    <li><a class="active" href="registration.php"><i class="fa fa-registered"></i></a></li>
    <li><a href="products.php"><i class="fa fa-cog"></i></a></li> <!-- Nueva opción -->
    <li><a href="regis.php"><i class="fa fa-question-circle"></i></a></li> <!-- Nueva opción -->
    <li><a href="logout.php"><i class="fa fa-power-off"></i></a></li>
    </ul>
</div>
<div class="logo">
                <img src="Imagenes/logo.png">
                <div class="company-name">
                    <p class="name">Four/Twenty</p>
                    <p class="corporation">CORPORATION</p>
                </div>
            </div>
</div>
</header>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"&gt;>
<h2>Registrados Usuarios</h2>
<hr/>

<div class="container">

<form action="" method="POST">
<center><input type="search" name="valueToSearh" placeholder="Búsqueda">
<button type="submit" class="signupbtn" name="search" >Buscar</button></center>
</form>
<br />
<?php


echo "<table border='1'>
<tr>
<th>Nombre</th>
<th>Apellido</th>
<th>Fecha de Nacimiento</th>
<th>Genero</th>
<th>Puesto</th>
<th>Numero</th>
<th>Correo Electrónico</th>
<th>Contraseña</th>
<th>Actualizar</th>
<th>Eliminar</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['nombre'] . "</td>";
echo "<td>" . $row['apellido'] . "</td>";
echo "<td>" . $row['fecha_nacimiento'] . "</td>";
echo "<td>" . $row['genero'] . "</td>";
echo "<td>" . $row['puesto'] . "</td>";
echo "<td>" . $row['numero'] . "</td>";
echo "<td>" . $row['usuario'] . "</td>";
echo "<td>" . $row['password'] . "</td>";
echo "<td><a href='edit.php?id=".$row['usuario']."'><img src='./imagenes/editar.png' alt='Edit'></a></td>";
echo "<td><a href='delete.php?id=".$row['usuario']."'><img src='./imagenes/eliminar.png' alt='Delete'></a></td>";

echo "</tr>";
}
echo "</table>";

?>

</body>
</html>
