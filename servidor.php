<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Consulta para obtener los productos en el carrito
    $sql = "SELECT producto_id, nombre, precio, imagen, cantidad FROM carrito";
    $result = $conn->query($sql);

    $cartItems = [];
    $totalQuantity = 0;
    $totalPrice = 0;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = $row;
            $totalQuantity += $row['cantidad'];
            $totalPrice += $row['precio'] * $row['cantidad'];
        }
    }

    $conn->close();
    header('Content-Type: application/json');
    echo json_encode(['items' => $cartItems, 'totalQuantity' => $totalQuantity, 'totalPrice' => $totalPrice]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decodificar los datos enviados en la solicitud
    $data = json_decode(file_get_contents('php://input'), true);

    // Acción de eliminar un producto del carrito
    if (isset($data['action']) && $data['action'] === 'delete') {
        $productId = $data['product_id'];

        // Consulta para eliminar el producto del carrito
        $stmt = $conn->prepare("DELETE FROM carrito WHERE producto_id = ?");
        $stmt->bind_param("i", $productId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto']);
        }

        $stmt->close();
    }

    // Acción de actualizar la cantidad de un producto en el carrito
    if (isset($data['action']) && $data['action'] === 'update') {
        $productId = $data['product_id'];
        $newQuantity = $data['quantity'];

        // Verificar que la cantidad no sea negativa
        if ($newQuantity < 1) {
            echo json_encode(['success' => false, 'message' => 'La cantidad debe ser mayor que 0']);
            exit();
        }

        // Actualizar la cantidad del producto en la base de datos
        $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE producto_id = ?");
        $stmt->bind_param("ii", $newQuantity, $productId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Cantidad actualizada correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la cantidad']);
        }

        $stmt->close();
    }

    // Acción de realizar el pago y vaciar el carrito
if (isset($data['action']) && $data['action'] === 'pay') {
    // Consultamos los productos del carrito para transferirlos al ticket
    $sql = "SELECT producto_id, nombre, precio, descripcion, imagen, fecha_publicacion, cantidad FROM carrito";
    $result = $conn->query($sql);

    // Insertar productos en la tabla 'ticket'
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stmt = $conn->prepare("INSERT INTO ticket (producto_id, nombre, precio, descripcion, imagen, fecha_publicacion, cantidad) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isdsdsi", $row['producto_id'], $row['nombre'], $row['precio'], $row['descripcion'], $row['imagen'], $row['fecha_publicacion'], $row['cantidad']);
            $stmt->execute();
        }
    }

    // Eliminar productos del carrito
    $deleteCartSql = "DELETE FROM carrito";
    if ($conn->query($deleteCartSql)) {
        echo json_encode(['success' => true, 'message' => 'Pago realizado con éxito y carrito vacío']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al vaciar el carrito']);
    }
}


    $conn->close();
}
?>
