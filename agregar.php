<?php
// Conexión a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'usuarios_db');

// Verificar conexión
if ($mysqli->connect_error) {
    die('Error en la conexión: ' . $mysqli->connect_error);
}

// Obtener el ID del producto y la cantidad desde la solicitud POST
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];

// Asegurarse de que la cantidad sea un número entero válido
$cantidad = (int)$cantidad;
if ($cantidad <= 0) {
    echo json_encode(['success' => false, 'error' => 'Cantidad inválida.']);
    exit;
}

// Verificar si el producto ya está en el carrito
$query = "SELECT * FROM carrito WHERE producto_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // El producto ya está en el carrito, actualizar la cantidad
    $producto = $result->fetch_assoc();
    $cantidad_existente = $producto['cantidad'];
    $nueva_cantidad = $cantidad_existente + $cantidad;

    // Limitar la cantidad máxima a 2
    if ($nueva_cantidad > 2) {
        echo json_encode(['success' => false, 'error' => 'No puedes agregar más de dos unidades de este producto al carrito.']);
        exit;
    }

    // Actualizar la cantidad en el carrito
    $updateQuery = "UPDATE carrito SET cantidad = ? WHERE producto_id = ?";
    $updateStmt = $mysqli->prepare($updateQuery);
    $updateStmt->bind_param("ii", $nueva_cantidad, $id_producto);
    if ($updateStmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al actualizar el carrito.']);
    }
} else {
    // El producto no está en el carrito, insertarlo
    $query = "SELECT * FROM productos WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();

    if ($producto) {
        // Insertar el producto en el carrito
        $insertQuery = "INSERT INTO carrito (producto_id, nombre, cantidad, precio, descripcion, imagen, fecha_publicacion) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $mysqli->prepare($insertQuery);
        $insertStmt->bind_param("isidsss", $id_producto, $producto['nombre'], $cantidad, $producto['precio'], $producto['descripcion'], $producto['imagen'], $producto['fecha_publicacion']);

        if ($insertStmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al agregar el producto al carrito.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Producto no encontrado.']);
    }
}

// Cerrar la conexión
$mysqli->close();
?>
