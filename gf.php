<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Four/Twenty - Tienda de Licores</title>
    <link rel="stylesheet" href="CSS/cabeceras.css">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="top-bar">
            <div class="menu">
                <ul>
                    <li><a href="tienda.html">Tienda</a></li>
                    <li><a href="catalogo.html">Catálogo</a></li>
                    <li><a href="ticket.php">tickets</a></li>
                    <li><a href="ayuda.html">Ayuda</a></li>
                </ul>
            </div>
            <div class="logo">
                <img src="Imagenes/logo.png">
                <div class="company-name">
                    <p class="name">Four/Twenty</p>
                    <p class="corporation">CORPORATION</p>
                </div>
            </div>
            <div class="user-actions">
                <a href="inicio_sesion.php"><img src="Imagenes/icon.png" alt="Login" class="icon"></a>
                <a href="carrito.html"><img src="Imagenes/carrito.png" alt="Carrito" class="icon"></a>
            </div>
        </div>
    </header>

    <main>

<!-- Esta parte es del Carousel, NO BORRAR -->

        <section class="carousel">
            <div class="carousel-wrapper">
                <div class="carousel-images">
                    <div class="carousel-item"><a href="#"><img src="Imagenes/vinateria.jpeg" alt="Imagen 1"></a></div>
                    <div class="carousel-item"><img src="Imagenes/Vin.png" alt="Imagen 2"></div>
                    <div class="carousel-item"><img src="Imagenes/Whis.png" alt="Imagen 3"></div>
                    <div class="carousel-item"><img src="Imagenes/hoja.png" alt="Imagen 4"></div>
                    <div class="carousel-item"><img src="Imagenes/Ron.png" alt="Imagen 5"></div>
                    <div class="carousel-item"><img src="Imagenes/Vod.png" alt="Imagen 6"></div>
                   
                </div>
            </div>
            <button class="carousel-btn prev">&#9664;</button>
            <button class="carousel-btn next">&#9654;</button>
            <div class="carousel-indicators">
                <button class="indicator" data-index="0"></button>
                <button class="indicator" data-index="1"></button>
                <button class="indicator" data-index="2"></button>
                <button class="indicator" data-index="3"></button>
                <button class="indicator" data-index="4"></button>
                <button class="indicator" data-index="5"></button>
               
            </div>
        </section>
<!-- Hasta aquí termina el carousel-->

        <div class="image-gallery">
            <?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'usuarios_db');

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los productos con ID entre 40 y 48
$sql = "SELECT * FROM productos WHERE id BETWEEN 40 AND 48";
$result = $conn->query($sql);
?>

<section class="image-gallery">
    <button class="nav-btn prev">&#9664;</button>
    <div class="gallery-wrapper">
        <div class="texts">
            <h1 class="text1">Lo Más Destacado</h1>
            <hr class="separator">
        </div>
        <div class="gallery-images">
            <?php
            // Mostrar los productos
            while ($row = $result->fetch_assoc()) {
                // Suponiendo que la columna 'imagen_url' contiene la ruta de la imagen
                $imagePath = $row['imagen']; // Ruta de la imagen desde la base de datos
                ?>
                <div class="gallery-item">
                    <a href="producto.php?id=<?php echo $row['id']; ?>">
                        <img src="<?php echo $imagePath; ?>" alt="<?php echo $row['nombre']; ?>">
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <button class="nav-btn next">&#9654;</button>
</section>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>



        </div>

        <button class="nav-btn prev">&#9664;</button>
        <button class="nav-btn next">&#9654;</button>
    </div>

<hr class="separator">




    </main>
    <script src="JS/java.js"></script>
     <div class="wrapper">
       
</body>
</html>
