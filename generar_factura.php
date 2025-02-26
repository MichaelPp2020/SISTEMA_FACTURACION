<style>
    body {
        font-family: Arial, sans-serif;
    }
    form {
        max-width: 600px;
        margin: 0 auto;
        charset: UTF-8;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
    }
    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }
    select, input[type="number"], button {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }
    button {
        width: auto;
        padding: 10px 20px;
    }
    a {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #f44336;
        text-decoration: none;
    }
    a:hover {
        color: #d32f2f;
        }
        a.button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #d32f2f;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        }
        a.button:hover {
        background-color: #b71c1c;
    }
</style>

<?php 
header('Content-Type: text/html; charset=UTF-8');
include 'config.php'; 
require('fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode('Generar Factura'), 0, 1, 'C');
    }
}
mysqli_set_charset($conn, 'utf8');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Generar Factura</title>
    
</head>
<body>
    <h2>Generar Factura</h2>
    <form action="procesar_factura.php" method="POST">
        
        <label>Cliente:</label>
        <select name="cliente_id" required>
            <?php
            $clientes = $conn->query("SELECT * FROM clientes");
            while ($row = $clientes->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['nombre']} {$row['apellido']}</option>";
            }
            ?>
        </select><br>
        <?php
        $productos = $conn->query("SELECT * FROM productos");
        while ($row = $productos->fetch_assoc()) {
            echo "<input type='checkbox' name='productos[{$row['id']}]' value='{$row['precio']}'> {$row['nombre']} - {$row['precio']}<br>";
        }
        ?>

        <label>Monto Recibido:</label>
        <input type="number" name="pago_recibido" required step="0.01" min="0"><br>

        <button type="submit" name="generar">Generar Factura</button>
        <a href="index.php" class="button">  Volver</a>
    </form>

    
</body>
</html>
