<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM productos WHERE id=$id");
    $producto = $result->fetch_assoc();
}

if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];

    $sql = "UPDATE productos SET 
            codigo='$codigo', nombre='$nombre', descripcion='$descripcion', 
            cantidad='$cantidad', precio='$precio' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Producto actualizado con éxito'); window.location='ver_productos.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Editar Producto</h1>
    </header>
    <main>
        <section class="form-container">
            <form action="editar_producto.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

                <label>Código:</label>
                <input type="text" name="codigo" value="<?php echo $producto['codigo']; ?>" required>

                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>

                <label>Descripción:</label>
                <textarea name="descripcion"><?php echo $producto['descripcion']; ?></textarea>

                <label>Cantidad:</label>
                <input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>" required>

                <label>Precio:</label>
                <input type="number" name="precio" step="0.01" value="<?php echo $producto['precio']; ?>" required>

                <button type="submit" name="actualizar">Actualizar Producto</button>
            </form>
            <a href="ver_productos.php" class="btn">Cancelar</a>
        </section>
    </main>
</body>
</html>
