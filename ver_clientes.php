<?php include 'config.php'; ?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
    }
    header {
        background-color: #007BFF;
        color: white;
        padding: 10px 0;
        text-align: center;
    }
    .table-container {
        margin: 20px auto;
        width: 90%;
        max-width: 1000px;
        background-color: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 10px 0;
        text-decoration: none;
        color: white;
        background-color: #4CAF50;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .btn:hover {
        background-color: #45a049;
    }
    .btn.edit {
        background-color: #2196F3;
    }
    .btn.edit:hover {
        background-color: #0b7dda;
    }
    .btn.delete {
        background-color: #f44336;
    }
    .btn.delete:hover {
        background-color: #da190b;
    }
</style>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Lista de Clientes</h1>
    </header>
    <main>
        <section class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM clientes");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['apellido']}</td>
                            <td>{$row['direccion']}</td>
                            <td>{$row['telefono']}</td>
                            <td>{$row['email']}</td>
                            <td>
                                <a href='editar_cliente.php?id={$row['id']}' class='btn edit'>Editar</a>
                                <a href='eliminar_cliente.php?id={$row['id']}' class='btn delete' onclick='return confirm(\"¿Seguro que deseas eliminar?\")'>Eliminar</a>
                            </td>
                          </tr>";
                }
                ?>
            </table>
            <a href="index.php" class="btn">Volver</a>
        </section>
    </main>
</body>
</html>
