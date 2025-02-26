<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Facturación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: grid;
            grid-template-rows: auto 1fr auto;
            min-height: 100vh;
            margin: 0;
        }
        header, footer {
            background-color: #f8f8f8;
            padding: 1em;
            text-align: center;
        }
        header {
            background-color: #007BFF;
            color: white;
        }
        main {
            display: grid;
            place-items: center;
        }
        nav {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1em;
        }
        nav a {
            display: block;
            padding: 1em;
            background-color: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        nav a:hover {
            background-color: #0056b3;
        }
    </style>
    
</head>
<body>
    <header>
        <h1>Sistema de Facturación</h1>
    </header>
    <main>
        <section>
            <h2>Bienvenido al Sistema de Facturación</h2>
            <nav>
                <a href="registrar_cliente.php">Registrar Cliente</a>
                <a href="ver_clientes.php">Lista de Clientes</a>
                <a href="registrar_producto.php">Registrar Producto</a>
                <a href="ver_productos.php">Lista de Productos</a>
                <a href="generar_factura.php">Generar Factura</a>
            </nav>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Sistema de Facturación. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
