<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/mystyle.css" />
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
<h2>Registrar Producto</h2>
<hr/>
<form action="register2.php" method="POST" enctype="multipart/form-data">
  <div class="container">
    <input type="text" placeholder="Nombre" name="nombre" required>
    <input type="number" placeholder="Cantidad" name="cantidad" required>
    <input type="text" placeholder="Precio" name="precio" required>
    <input type="text" placeholder="Descripción" name="descripcion" required>
    <input type="file" name="imagen" required>
    <input type="hidden" name="fecha_publicacion" value="<?php echo date('Y-m-d'); ?>">
    <div class="clearfix">
      <button type="submit" class="signupbtn">Registrar</button>
      <center><button type="reset" class="cancelbtn">Cancelar</button></center>
    </div>
  </div>
</form>
</body>
</html>
