<?php
require('fpdf/fpdf.php');
include 'config.php';

if (isset($_POST['generar'])) {
    $cliente_id = $_POST['cliente_id'];
    $pago_recibido = floatval($_POST['pago_recibido']);
    $total = 0;
    $productos_seleccionados = $_POST['productos'] ?? [];

    if (empty($productos_seleccionados)) {
        die("Selecciona al menos un producto.");
    }

    // Obtener datos del cliente
    $cliente = $conn->query("SELECT * FROM clientes WHERE id = '$cliente_id'")->fetch_assoc();

    // Calcular el total
    $productos_detalle = [];
    foreach ($productos_seleccionados as $producto_id => $precio) {
        $productos_detalle[] = [
            'nombre' => $conn->query("SELECT nombre FROM productos WHERE id = '$producto_id'")->fetch_assoc()['nombre'],
            'precio' => $precio
        ];
        $total += $precio;
    }

    // Validar si el pago es suficiente
    if ($pago_recibido < $total) {
        die("Error: El pago recibido es insuficiente. Total a pagar: $" . number_format($total, 2));
    }

    // Calcular vuelto
    $vuelto = $pago_recibido - $total;

    // Insertar factura en la base de datos
    $sql_factura = "INSERT INTO facturas (cliente_id, total) VALUES ('$cliente_id', '$total')";
    if ($conn->query($sql_factura) === TRUE) {
        $factura_id = $conn->insert_id;

        foreach ($productos_seleccionados as $producto_id => $precio) {
            $conn->query("INSERT INTO detalle_factura (factura_id, producto_id, cantidad, subtotal) VALUES ('$factura_id', '$producto_id', 1, '$precio')");
        }

        // Crear el PDF
        class PDF extends FPDF {
            function Header() {
                $this->SetFont('Arial', 'B', 16);
                $this->Cell(190, 10, 'Factura de Compra', 0, 1, 'C');
                $this->Ln(5);
            }
        }

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        // Datos del negocio
        $pdf->Cell(190, 10, 'Tienda XYZ', 0, 1, 'C');
        $pdf->Cell(190, 5, 'Direccion: Avenida Central 123', 0, 1, 'C');
        $pdf->Cell(190, 5, 'Telefono: +123456789', 0, 1, 'C');
        $pdf->Ln(10);

        // Datos del cliente
        $pdf->Cell(190, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Nombres: ' . $cliente['nombre']), 0, 1, 'L');
        $pdf->Cell(190, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Apellidos: ' . $cliente['apellido']), 0, 1, 'L');
        $pdf->Cell(190, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Dirección: ' . $cliente['direccion']), 0, 1, 'L');
       
        
        $pdf->Ln(10);

        // Encabezado tabla de productos
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(120, 10, 'Producto', 1);
        $pdf->Cell(70, 10, 'Precio', 1, 1, 'C');

        // Productos comprados
        $pdf->SetFont('Arial', '', 12);
        foreach ($productos_detalle as $prod) {
            $pdf->Cell(120, 10, $prod['nombre'], 1);
            $pdf->Cell(70, 10, '$' . number_format($prod['precio'], 2), 1, 1, 'C');
        }

        // Total y vuelto
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(120, 10, 'Total a pagar:', 1);
        $pdf->Cell(70, 10, '$' . number_format($total, 2), 1, 1, 'C');

        $pdf->Cell(120, 10, 'Pago recibido:', 1);
        $pdf->Cell(70, 10, '$' . number_format($pago_recibido, 2), 1, 1, 'C');

        $pdf->Cell(120, 10, 'Vuelto:', 1);
        $pdf->Cell(70, 10, '$' . number_format($vuelto, 2), 1, 1, 'C');

        // Mensaje de agradecimiento
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'I', 12);
        $pdf->Cell(190, 10, 'Gracias por su compra.', 0, 1, 'C');

        // Guardar y descargar PDF
        $pdf->Output('D', 'Factura_' . $factura_id . '.pdf');
        exit;
    } else {
        die("Error al generar la factura.");
    }
}
?>
