<?php
   
    if(isset($_POST['search']))
    {
        $valueToSearh = $_POST['valueToSearh'];
        $query = "SELECT * FROM productos WHERE id LIKE '%".$valueToSearh."%' OR nombre LIKE '%".$valueToSearh."%'";
        $result = filterRecord($query);
    }
    else
    {
        $query = "SELECT *FROM productos";
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<h2>Productos Registrados</h2>
<hr/>

<div class="container">

<form action="" method="POST">
<center><input type="search" name="valueToSearch" placeholder="Búsqueda">
<button type="submit" class="signupbtn" name="search">Buscar</button></center>
</form>
<br />
<?php

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Cantidad</th>
<th>Precio</th>
<th>Descripción</th>
<th>Imagen</th>
<th>Fecha de Publicación</th>
<th>Actualizar</th>
<th>Eliminar</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nombre'] . "</td>";
    echo "<td>" . $row['cantidad'] . "</td>";
    echo "<td>" . $row['precio'] . "</td>";
    echo "<td>" . $row['descripcion'] . "</td>";
    echo "<td><img src='" . $row['imagen'] . "' alt='Imagen' style='width:50px;height:50px;'></td>";
    echo "<td>" . $row['fecha_publicacion'] . "</td>";
    echo "<td><a href='edit.php?id=".$row['id']."'><img src='./imagenes/editar.png' alt='Edit'></a></td>";
    echo "<td><a href='delete.php?id=".$row['id']."'><img src='./imagenes/eliminar.png' alt='Delete'></a></td>";
    echo "</tr>";
}
echo "</table>";

?>

</body>
</html>
