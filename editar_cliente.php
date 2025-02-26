<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM clientes WHERE id=$id");
    $cliente = $result->fetch_assoc();
}

if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $sql = "UPDATE clientes SET 
            nombre='$nombre', apellido='$apellido', direccion='$direccion', 
            telefono='$telefono', email='$email' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cliente actualizado con éxito'); window.location='ver_clientes.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Editar Cliente</h1>
    </header>
    <main>
        <section class="form-container">
            <form action="editar_cliente.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">

                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?php echo $cliente['nombre']; ?>" required>

                <label>Apellido:</label>
                <input type="text" name="apellido" value="<?php echo $cliente['apellido']; ?>" required>

                <label>Dirección:</label>
                <input type="text" name="direccion" value="<?php echo $cliente['direccion']; ?>" required>

                <label>Teléfono:</label>
                <input type="text" name="telefono" value="<?php echo $cliente['telefono']; ?>" required>

                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $cliente['email']; ?>" required>

                <button type="submit" name="actualizar">Actualizar Cliente</button>
            </form>
            <a href="ver_clientes.php" class="btn">Cancelar</a>
        </section>
    </main>
</body>
</html>
