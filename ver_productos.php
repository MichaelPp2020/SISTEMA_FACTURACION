<?php include 'config.php'; ?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    header {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 0;
        text-align: center;
    }
    .table-container {
        margin: 20px auto;
        width: 90%;
        max-width: 1000px;
        background-color: #fff;
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
    .btn {
        display: inline-block;
        padding: 10px 20px;
        margin: 10px 0;
        text-decoration: none;
        color: #fff;
        background-color: #007bff;
        border-radius: 5px;
        text-align: center;
    }
    .btn.edit {
        background-color: #28a745;
    }
    .btn.delete {
        background-color: #dc3545;
    }
    .btn:hover {
        opacity: 0.8;
    }
</style>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Lista de Productos</h1>
    </header>
    <main>
        <section class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM productos");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['codigo']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['descripcion']}</td>
                            <td>{$row['cantidad']}</td>
                            <td>{$row['precio']}</td>
                            <td>
                                <a href='editar_producto.php?id={$row['id']}' class='btn edit'>Editar</a>
                                <a href='eliminar_producto.php?id={$row['id']}' class='btn delete' onclick='return confirm(\"¿Eliminar producto?\")'>Eliminar</a>
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
