<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los productos del ticket
$sql = "SELECT * FROM ticket";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .ticket {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            color: #333;
            text-align: center;
        }

        .ticket h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        .ticket .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }

        .ticket .item .name {
            font-size: 18px;
            color: #555;
        }

        .ticket .item .quantity {
            color: #888;
        }

        .ticket .item .price {
            font-weight: bold;
            color: #333;
        }

        .ticket .total {
            margin-top: 20px;
            font-size: 22px;
            font-weight: bold;
        }

        .ticket footer {
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <h1>Ticket de Compra</h1>

        <?php
        $total = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $total += $row['precio'] * $row['cantidad'];
                echo "<div class='item'>
                        <span class='name'>{$row['nombre']}</span>
                        <span class='quantity'>x{$row['cantidad']}</span>
                        <span class='price'>'$'{$row['precio']}</span>
                    </div>";
            }
        }
        ?>

        <div class="total">Total: $<?php echo number_format($total, 2); ?></div>
        <footer>Gracias por tu compra</footer>
    </div>
</body>
</html>

<?php
$conn->close();
?>
