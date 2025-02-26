<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM productos WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Producto eliminado'); window.location='ver_productos.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
