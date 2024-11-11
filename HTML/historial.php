<?php 

$server = "localhost";
$user = "root";
$pass = "";
$db = "new_spring";

$conexion = new mysqli($server, $user, $pass, $db, "3307");

if ($conexion->connect_errno) {
    die("Conexión fallida: " . $conexion->connect_errno);
}

// Verificar si se ha enviado el formulario
if (isset($_POST["registro"])) {
    $idMovimiento = $_POST["idmovimiento"];
    $status = $_POST["status"];
    
    // Insertar el movimiento seleccionado en el historial con el estatus especificado
    $insertarDatos = "INSERT INTO Historial (estatus, movimiento_idmovimiento) VALUES ('$status', '$idMovimiento')";
    $ejecutarInsertar = $conexion->query($insertarDatos);

    if ($ejecutarInsertar) {
        echo "<script>alert('Estatus insertado correctamente');</script>";
    } else {
        echo "<script>alert('Estatus no ingresado');</script> " . $conexion->error;
    }
}

// Consultar los movimientos y los datos del cliente en la tabla Movimiento
$consultaMovimientos = "
    SELECT m.idmovimiento, c.descripcion_problema, c.nombre, c.apellido_paterno, c.apellido_materno
    FROM Movimiento AS m
    JOIN Cliente AS c ON m.cliente_idcliente = c.idcliente
";
$resultadoMovimientos = $conexion->query($consultaMovimientos);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Fallas - SMAPA</title>
    <link rel="stylesheet" href="/CSS/normalizar.css">
    <link rel="stylesheet" href="/CSS/styles_principal.css">
    <link rel="stylesheet" href="/CSS/styles_informe.css">
</head>
<body>
    <header class="header_inicio padding_main">
        <div class="header_superior">
            <div class="logo">
                <img src="../images/logo.png">
                <a class="nav_inicio" href="/HTML/index.php">Blue Spring</a>
            </div>
        </div>
        <div class="container_menu">
            <div class="menu">
                <nav>
                    <ul>
                        <li><a href="/HTML/inicio.php" id="selected"></a></li>
                        <li><a class="link">Trámites y Servicios</a>
                            <ul>
                                <li><a href="/HTML/informe.php">Realizar</a></li>
                                <li><a href="/HTML/historial.php">Consultar</a></li>
                            </ul>
                        </li>
                        <li><a class="link" href="/HTML/historial.php">Historial</a></li>
                        <li><a class="link" href="/HTML/Almacen.php">Almacen</a></li>
                        <li><a class="link" href="/HTML/Movimiento.php">Movimiento</a></li>
                        <li><a class="link" href="/HTML/Personal.php">Personal</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <section id="informe" class="container">
        <h2>CONSULTAR</h2>
        
        <form action="#" method="post" class="styled-form">
            <div class="form-group">
                <label for="idmovimiento">Seleccione Movimiento:</label>
                <select id="idmovimiento" name="idmovimiento" required>
                    <option value="">Seleccione un movimiento</option>
                    <?php
                    // Generar las opciones de movimientos con datos del cliente
                    if ($resultadoMovimientos->num_rows > 0) {
                        while ($fila = $resultadoMovimientos->fetch_assoc()) {
                            $nombreCompleto = $fila["nombre"] . " " . $fila["apellido_paterno"] . " " . $fila["apellido_materno"];
                            echo "<option value='" . $fila["idmovimiento"] . "'>ID " . $fila["idmovimiento"] . " - " . $fila["Tipo_Problema"] . " - Cliente: " . $nombreCompleto . "</option>";
                        }
                    } else {
                        echo "<option>No hay movimientos disponibles</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Estatus:</label>
                <select id="status" name="status" required>
                    <option value="pendiente">Pendiente</option>
                    <option value="en proceso">En Proceso</option>
                    <option value="finalizado">Finalizado</option>
                </select>
            </div>
            
            <button type="submit" name="registro">Guardar en Historial</button>
        </form>
    </section>
    <footer class="footer">
        <div class="footer_content">
            <div class="footer_section about">
                <h3>Sobre Blue Spring</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam congue facilisis ipsum, a tempus nisi.</p>
            </div>
            <div class="footer_section contact">
                <h3>Contáctanos</h3>
                <p>Teléfono: +123 456 789</p>
                <p>Email: contacto@bluespring.com</p>
            </div>
        </div>
        <div class="footer_bottom">
            &copy; 2024 Blue Spring | Todos los derechos reservados
        </div>
    </footer>
</body>
</html>
