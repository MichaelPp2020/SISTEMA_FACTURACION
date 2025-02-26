<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente</title>
    <link rel="stylesheet" href="styles.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }
    header {
        background-color: #007BFF;
        color: white;
        padding: 10px 0;
        text-align: center;
    }
    .form-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    input, textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }
    button[type="submit"]:hover {
        background-color: darkgreen;
    }
    .btn {
        display: inline-block;
        background-color: red;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        text-align: center;
    }
    .btn:hover {
        background-color: darkred;
    }
</style>
</head>
<body>
    <header>
        <h1>Registrar Cliente</h1>
    </header>
    <main>
        <section class="form-container">
            <form action="registrar_cliente.php" method="POST">
                <label>Nombre:</label>
                <input type="text" name="nombre" required>

                <label>Apellido:</label>
                <input type="text" name="apellido" required>

                <label>Dirección:</label>
                <input type="text" name="direccion" required>

                <label>Teléfono:</label>
                <input type="text" name="telefono" required>

                <label>Email:</label>
                <input type="email" name="email" required>

                <button type="submit" name="registrar">Registrar Cliente</button>
            </form>
            <a href="index.php" class="btn">Volver</a>
        </section>
    </main>
</body>
</html>

<?php
if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $sql = "INSERT INTO clientes (nombre, apellido, direccion, telefono, email) 
            VALUES ('$nombre', '$apellido', '$direccion', '$telefono', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cliente registrado con éxito'); window.location='ver_clientes.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
