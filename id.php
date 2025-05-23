<?php
// Obtener el ID del producto desde la URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
} else {
    die("Producto no encontrado.");
}

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'usuarios_db');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los detalles del producto
$sql = "SELECT * FROM productos WHERE id = $productId";
$result = $conn->query($sql);

// Verificar si el producto existe
if ($result->num_rows > 0) {
    // Guardar el producto en un arreglo
    $producto = $result->fetch_assoc();
} else {
    die("Producto no encontrado.");
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto - Estilo Mercado Libre</title>
   <link rel="stylesheet" type="text/css" href="CSS/cabeceras.css">
    <link rel="stylesheet" type="text/css" href="CSS/bod.css">

    <style>
        .logo {
            font-size: 24px;
            color: #63010e;
            font-weight: bold;
        }

        .top-bar {
            background-color: #63010e; /* Cambié el color de fondo */
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .menu ul {
            list-style: none;
            padding: 0;
            display: flex;
            margin: 0;
        }

        .menu ul li {
            margin-right: 20px;
        }

        .menu ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .menu ul li a:hover {
            text-decoration: underline;
        }

        .company-name p {
            margin: 0;
            color: white;
        }

        .user-actions a {
            margin-left: 20px;
        }

        .container {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .image-container {
            flex: 2;
            position: relative;
            padding: 20px;
            border: 2px solid #ccc; 
            border-radius: 8px;
        }
        .image-container img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }
        .description-container {
            flex: 1;
            padding: 20px;
        }
        .description-container h2 {
            color: #333;
            margin: 0;
        }
        .description-container p {
            margin: 10px 0;
        }
        .product-description {
            margin: 10px 0;
            color: #666;
        }
        footer {
            background-color: #63010e;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
        .contact-info {
            margin: 0;
        }
        button {
            background-color: #ffab00;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #e69a00;
        }
        input[type="number"] {
            width: 60px;
            padding: 5px;
            margin-right: 10px;
        }
        .icon {
            margin-right: 10px;
            color: #ffab00;
        }
        .zoom-in {
            cursor: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="%23ffab00" d="M15.5 14h-.79l-.28-.27A6.5 6.5 0 1 0 14 15.5l.27.28v.79l6 6 1.5-1.5-6-6zm-3.5 0a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/></svg>') 10 10, auto;
        }
        .zoom-out {
            cursor: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="%23ffab00" d="M15.5 14h-.79l-.28-.27A6.5 6.5 0 1 0 14 15.5l.27.28v.79l6 6 1.5-1.5-6-6zm-3.5 0a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/><path fill="%23ffab00" d="M10 12h4v-2h-4v2z"/></svg>') 10 10, auto;
        }

        .helpful-buttons {
            display: flex;
            justify-content: flex-start;
            margin-top: 10px;
            margin-left: 60px;
        }

        .helpful-button {
            cursor: pointer;
            margin-right: 10px;
            font-size: 14px;
            color: #63010e;
        }

        .helpful-button:hover {
            text-decoration: underline;
        }

        .helpful-button.active {
            color: #ffab00;
        }

    </style>
</head>
<body>
    <div class="top-bar">
        <!-- Aquí va tu barra de navegación como la has definido en tu código -->
    </div>

    <br>

    <div class="container">
        <div class="image-container">
            <img src="Imagenes/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" id="product-image" class="zoom-in" onclick="toggleZoom()">
        </div>
        <div class="description-container">
            <h2 id="product-name"><?php echo $producto['nombre']; ?></h2>
            <br>
            <p><strong>Precio:</strong> <span id="product-price">$<?php echo $producto['precio']; ?></span></p>
            <br>
            <p class="product-description" id="product-description"><?php echo $producto['descripcion']; ?></p>
            <br>
            <p><strong>Cantidad:</strong> <input type="number" id="quantity" value="1" min="1"></p>
            <button onclick="addToCart()">Agregar al carrito</button>
            <br><br>
        </div>
    </div>

    <footer>
        <p class="contact-info">
            <span class="icon">📧</span> info@ejemplo.com | 
            <span class="icon">🌐</span> www.ejemplo.com | 
            <span class="icon">📱</span> Facebook | Twitter | Instagram
        </p>
    </footer>

    <script>
        let zoomed = false;

        function addToCart() {
            const quantity = document.getElementById('quantity').value;
            alert(`Se han agregado ${quantity} productos al carrito.`);
        }

        function toggleZoom() {
            const image = document.getElementById('product-image');
            zoomed = !zoomed;

            if (zoomed) {
                image.style.transform = 'scale(1.5)';
                image.classList.remove('zoom-in');
                image.classList.add('zoom-out');
            } else {
                image.style.transform = 'scale(1)';
                image.classList.remove('zoom-out');
                image.classList.add('zoom-in');
            }
        }

        // Función para cargar los detalles del producto
        async function loadProduct() {
            const urlParams = new URLSearchParams(window.location.search);
            const productId = urlParams.get('id'); // Obtener el ID del producto desde la URL

            if (productId) {
                try {
                    const response = await fetch(`get_product.php?id=${productId}`);
                    const product = await response.json();

                    if (product.error) {
                        alert('Producto no encontrado');
                        return;
                    }

                    // Actualizar la información en la página con los datos del producto
                    document.getElementById('product-name').textContent = product.nombre;
                    document.getElementById('product-price').textContent = `$${product.precio}`;
                    document.getElementById('product-description').textContent = product.descripcion;
                    document.getElementById('product-image').src = `Imagenes/${product.imagen}`;
                    // Puedes agregar más campos si es necesario
                } catch (error) {
                    console.error('Error fetching product:', error);
                }
            } else {
                alert('ID de producto no especificado en la URL');
            }
        }

        window.onload = loadProduct; // Cargar el producto al cargar la página
    </script>
</body>
</html>