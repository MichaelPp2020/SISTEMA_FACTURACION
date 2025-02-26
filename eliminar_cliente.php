<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM clientes WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cliente eliminado'); window.location='ver_clientes.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
