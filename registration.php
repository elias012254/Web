
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
<h2>Registrarse</h2>
<hr/>
<form action="register.php" method="POST">
  <div class="container">
    <input type="text" placeholder="Nombre" name="nombre" required>
    <input type="text" placeholder="Apellido" name="apellido" required>
    <input type="date" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" required>
    <select name="genero" required>
                        <option value="" disabled selected>Género</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
    <input type="tel" name="numero" placeholder="Número Telefónico" required>
    <input type="email" name="usuario" placeholder="Correo Electrónico" required>
    <input type="password" placeholder="Nueva Contraseña" name="password" required>
    <input type="password" placeholder="Repetir Contraseña" name="psw-repeat" required>
    <div class="clearfix">
      <button type="submit" class="signupbtn">Registrarse</button>

      <center><button type="reset" class="cancelbtn">Cancelar</button></center>
    </div>
  </div>
</form>