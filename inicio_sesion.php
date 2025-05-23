<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Four/Twenty - Tienda de Licores</title>
    <link rel="stylesheet" href="CSS/cabeceras.css">
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&display=swap" rel="stylesheet">
    <style>
        /* Estilos específicos para Firebase */
        .firebase-user-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: none; /* Oculto inicialmente */
            cursor: pointer;
        }
        .firebase-dropdown {
            position: absolute;
            right: 10px;
            top: 70px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            display: none; /* Oculto inicialmente */
            z-index: 10;
            padding: 15px;
            width: 250px;
            font-family: 'Arial', sans-serif;
        }
        .firebase-dropdown .user-info {
            text-align: center;
            margin-bottom: 15px;
        }
        .firebase-dropdown .user-info img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .firebase-dropdown .user-info p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }
        .firebase-dropdown .user-info .user-email {
            font-weight: bold;
            color: #333;
        }
        .firebase-dropdown a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 3px;
            margin-top: 10px;
        }
        .firebase-dropdown a:hover {
            background-color: #f44336;
            color: white;
        }
    </style>
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
                <!-- Imagen que actúa como botón de inicio de sesión -->
                <img id="firebase-login-btn" src="Imagenes/icon.png" alt="Login" class="icon">
                <!-- Ícono del usuario después de iniciar sesión -->
                <img id="firebase-user-icon" class="firebase-user-icon" src="" alt="Usuario">
                <!-- Menú desplegable -->
                <div id="firebase-dropdown" class="firebase-dropdown">
                    <div class="user-info">
                        <img id="user-image" class="firebase-user-icon" src="" alt="Usuario">
                        <p id="user-name">Nombre del Usuario</p>
                        <p class="user-email" id="user-email">Correo del Usuario</p>
                    </div>
                    <a href="#" id="firebase-logout-link">Cerrar Sesión</a>
                </div>
                <a href="carrito.html"><img src="Imagenes/carrito.png" alt="Carrito" class="icon"></a>
            </div>
        </div>
    </header>

    <main>
        <!-- Contenido principal (sin cambios) -->
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
     <div class="wrapper">
    <!-- Firebase -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.2/firebase-app.js";
        import { getAuth, GoogleAuthProvider, signInWithPopup, signOut } from "https://www.gstatic.com/firebasejs/11.0.2/firebase-auth.js";

        const firebaseConfig = {
            apiKey: "AIzaSyA9aneh4lpwb16Mc4YAvuWz1ZVqFcryLns",
            authDomain: "inicio-de-sesion-8028a.firebaseapp.com",
            projectId: "inicio-de-sesion-8028a",
            storageBucket: "inicio-de-sesion-8028a.firebasestorage.app",
            messagingSenderId: "148011194083",
            appId: "1:148011194083:web:8fb95f678b8f5556d257d6",
            measurementId: "G-DSGY0SPZ97"
        };

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        const provider = new GoogleAuthProvider();
        provider.setCustomParameters({ prompt: "select_account" });

        const loginButton = document.getElementById("firebase-login-btn");
        const userIcon = document.getElementById("firebase-user-icon");
        const logoutLink = document.getElementById("firebase-logout-link");
        const dropdown = document.getElementById("firebase-dropdown");

        loginButton.addEventListener("click", async () => {
            try {
                const result = await signInWithPopup(auth, provider);
                const user = result.user;
                userIcon.src = user.photoURL;
                userIcon.style.display = "block";
                loginButton.style.display = "none";

                // Actualizar la información del usuario en el menú desplegable
                document.getElementById("user-image").src = user.photoURL;
                document.getElementById("user-name").textContent = user.displayName || user.email.split("@")[0];
                document.getElementById("user-email").textContent = user.email;
            } catch (error) {
                console.error("Error al iniciar sesión:", error);
            }
        });

        userIcon.addEventListener("click", () => {
            // Mostrar u ocultar el menú desplegable
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        });

        logoutLink.addEventListener("click", async () => {
            try {
                await signOut(auth);
                userIcon.style.display = "none";
                loginButton.style.display = "inline-block";
                dropdown.style.display = "none"; // Ocultar el menú desplegable
            } catch (error) {
                console.error("Error al cerrar sesión:", error);
            }
        });

        // Cerrar el menú si se hace clic fuera de él
        document.addEventListener("click", (e) => {
            if (!userIcon.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = "none";
            }
        });
    </script>
        <script src="JS/java.js"></script>
</body>
</html>
