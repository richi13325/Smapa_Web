<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "new_spring";

$conexion = new mysqli($server, $user, $pass, $db, "3307");

if ($conexion->connect_errno) {
    die("Conexión fallida: " . $conexion->connect_errno);
}

// Consulta para obtener los empleados
$consultaEmpleados = "SELECT idEmpleados, nombre_empleado, apellido_paterno, apellido_materno FROM Empleados";
$resultadoEmpleados = $conexion->query($consultaEmpleados);

// Insertar la asistencia al enviar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEmpleado = $_POST['participante'];
    $fechaActual = date('Y-m-d'); // Fecha actual en formato Y-m-d
    $estado = "Asistencia";

    // Verificar que se haya seleccionado un empleado
    if (!empty($idEmpleado)) {
        $consultaInsertar = "INSERT INTO Asistencia (fecha, estado, Empleados_idEmpleados)
                             VALUES ('$fechaActual', '$estado', '$idEmpleado')";

        if ($conexion->query($consultaInsertar) === TRUE) {
            echo "<script>alert('Asistencia ingresada correctamente');</script>";
        } else {
            echo "<script>alert('Error al ingresar la asistencia');</script>";
        }
    } else {
        echo "<script>alert('Por favor, seleccione un empleado');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLUESPRING</title>
    <link rel="stylesheet" href="/CSS/styles_inicio.css">
    <link rel="stylesheet" href="/CSS/styles_principal.css">
    <link rel="stylesheet" href="/CSS/normalizar.css">
</head>
<body>
    <header class="header_inicio padding_main">
        <div class="header_superior">
            <div class="logo">
                <img src="../images/logo.png" alt="Logo Blue Spring">
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
    <main>
        <section class="img_inicio">
            <h1><span class="letra_1">B</span><span class="color1">lue</span> 
                <span class="letra_2">S</span><span class="color2">pring</span>
            </h1>
            <p class="h1_p">Comprometidos con el servicio y la calidad en cada paso.</p>
        </section>
        <div class="login_container">
            <form class="formulario_asistencia" action="#" method="post">
                <h2>Asistencia del día</h2>
                <label for="asistencia">Seleccione el participante:</label>
                <select id="asistencia" class="select_container" name="participante" required>
                    <option value="">Seleccione...</option>
                    <?php
                    if ($resultadoEmpleados->num_rows > 0) {
                        while ($fila = $resultadoEmpleados->fetch_assoc()) {
                            echo "<option value='" . $fila["idEmpleados"] . "'>"
                                 . $fila["nombre_empleado"] . " " . $fila["apellido_paterno"] . " " . $fila["apellido_materno"]
                                 . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay empleados registrados</option>";
                    }
                    ?>
                </select>
                <input class="submit" type="submit" value="Enviar">
            </form>
        </div>
        <section class="servicios">
            <h2>Principales Servicios</h2>
            <div class="servicios_container">
                <div class="servicio">
                    <h3 class="h3_servicio">Servicio 1</h3>
                    <img src="../images/img_tubo_surtidor.jpg" alt="Servicio 1">
                    <p class="p_servicio">Descripción breve del servicio 1.</p>
                </div>
                <div class="servicio">
                    <h3 class="h3_servicio">Servicio 2</h3>
                    <img src="../images/servicio2.jpg" alt="Servicio 2">
                    <p class="p_servicio">Descripción breve del servicio 2.</p>
                </div>
            </div>
        </section>
        <section class="galeria">
            <h2>Nuestra Galería</h2>
            <div class="galeria_container">
                <img src="../images/galeria1.jpg" alt="Galería 1">
                <img src="../images/galeria2.jpg" alt="Galería 2">
                <img src="../images/galeria3.jpg" alt="Galería 3">
                <img src="../images/galeria4.jpg" alt="Galería 4">
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="footer_content">
            <div class="footer_section support">
                <h3>Soporte</h3>
                <p>Si tienes algún problema, no dudes en contactar a nuestro equipo de soporte interno.</p>
                <p>Teléfono: +123 456 789</p>
                <p>Email: soporte@bluespring.com</p>
            </div>
            <div class="footer_section resources">
                <h3>Recursos</h3>
                <ul>
                    <li><a href="/HTML/politicas.php">Políticas de la Empresa</a></li>
                    <li><a href="/HTML/beneficios.php">Beneficios para Empleados</a></li>
                    <li><a href="/HTML/cursos.php">Cursos y Capacitación</a></li>
                </ul>
            </div>
        </div>
        <div class="footer_bottom">
            &copy; 2024 Blue Spring | Todos los derechos reservados
        </div>
    </footer>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conexion->close();
?>
