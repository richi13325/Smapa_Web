<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "new_spring";

$conexion = new mysqli($server, $user, $pass, $db, "3307");

if ($conexion->connect_errno) {
    die("Conexión fallida: " . $conexion->connect_errno);
}

// Consulta para obtener los clientes
$consultaClientes = "SELECT idcliente, nombre, apellido_paterno, apellido_materno, numero_tramite FROM Cliente";
$resultadoClientes = $conexion->query($consultaClientes);

// Consulta para obtener la última fecha de asistencia
$consultaUltimaFecha = "SELECT MAX(fecha) AS ultima_fecha FROM Asistencia";
$resultadoUltimaFecha = $conexion->query($consultaUltimaFecha);

if ($resultadoUltimaFecha->num_rows > 0) {
    $filaFecha = $resultadoUltimaFecha->fetch_assoc();
    $ultimaFecha = $filaFecha['ultima_fecha'];

    // Consulta para obtener los empleados que tienen asistencia en la última fecha
    $consultaEmpleadosUltimaAsistencia = "SELECT E.idEmpleados, E.nombre_empleado, E.apellido_paterno, E.apellido_materno, E.telefono 
                                          FROM Empleados E
                                          JOIN Asistencia A ON E.idEmpleados = A.Empleados_idEmpleados
                                          WHERE A.fecha = '$ultimaFecha'";
    $resultadoEmpleadosUltimaAsistencia = $conexion->query($consultaEmpleadosUltimaAsistencia);
} else {
    $resultadoEmpleadosUltimaAsistencia = [];
}

// Definir los materiales necesarios por tipo de problema
$materiales_por_problema = [
    'Fuga de agua' => [
        ['material' => 'Cemento Cruz Azul', 'cantidad' => 3],
        ['material' => 'Tubería kitec', 'cantidad' => 4],
        ['material' => 'Llave Inserción para kitec', 'cantidad' => 2],
        ['material' => 'Codo Pipa', 'cantidad' => 3],
        ['material' => 'Junta Gibault', 'cantidad' => 1],
        ['material' => 'Conector kitec', 'cantidad' => 5],
        ['material' => 'Abrazadera fierro', 'cantidad' => 2],
    ],
    'Reparación tubo surtidor' => [
        ['material' => 'PVC', 'cantidad' => 3],
        ['material' => 'Fierro', 'cantidad' => 2],
        ['material' => 'Junta Gibault', 'cantidad' => 2],
        ['material' => 'Cople PVC', 'cantidad' => 4],
        ['material' => 'Codo Liso', 'cantidad' => 3],
        ['material' => 'Tornillo y tuerca', 'cantidad' => 6],
        ['material' => 'Cemento Cruz Azul', 'cantidad' => 4],
    ],
    'Reparación de toma domiciliaria' => [
        ['material' => 'Asbesto', 'cantidad' => 4],
        ['material' => 'Cople PVC', 'cantidad' => 3],
        ['material' => 'Codo Pipa', 'cantidad' => 2],
        ['material' => 'Tubo Fierro', 'cantidad' => 5],
        ['material' => 'Goma de hule', 'cantidad' => 6],
        ['material' => 'Cople para kitec', 'cantidad' => 4],
        ['material' => 'Llave Inserción para cobre', 'cantidad' => 3],
    ],
    'Reparación de válvula' => [
        ['material' => 'Abrazadera fierro', 'cantidad' => 3],
        ['material' => 'Tapa de caja', 'cantidad' => 2],
        ['material' => 'Contramarco caja', 'cantidad' => 2],
        ['material' => 'Codo Liso', 'cantidad' => 3],
        ['material' => 'Llave Inserción para cobre', 'cantidad' => 3],
        ['material' => 'Cemento Cruz Azul', 'cantidad' => 2],
        ['material' => 'Tornillo y tuerca', 'cantidad' => 5],
    ],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimientos - SMAPA</title>
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
        <h2>Realizar Movimiento</h2>
        <form action="#" name="informe_form" method="post" class="styled-form">
            <!-- Información del cliente -->
            <div class="form-group">
                <label for="cliente">Tramite:</label>
                <select id="cliente" name="cliente_idcliente" required>
                    <option value="">Seleccione un tramite</option>
                    <?php
                    if ($resultadoClientes->num_rows > 0) {
                        while ($fila = $resultadoClientes->fetch_assoc()) {
                            echo "<option value='" . $fila["idcliente"] . "'>" . $fila["nombre"] . " " . $fila["apellido_paterno"] . " " . $fila["apellido_materno"]
                                 . " - Numero de tramite: " . $fila["numero_tramite"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay tramites registrados</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Información del empleado -->
            <div class="form-group">
                <label for="empleado">Empleado:</label>
                <select id="empleado" name="empleado_id" required>
                    <option value="">Seleccione un empleado</option>
                    <?php
                    // Verificar si hay empleados con asistencia en la última fecha
                    if ($resultadoEmpleadosUltimaAsistencia && $resultadoEmpleadosUltimaAsistencia->num_rows > 0) {
                        while ($filaEmpleado = $resultadoEmpleadosUltimaAsistencia->fetch_assoc()) {
                            echo "<option value='" . $filaEmpleado["idEmpleados"] . "'>"
                                 . $filaEmpleado["nombre_empleado"] . " " . $filaEmpleado["apellido_paterno"] . " " . $filaEmpleado["apellido_materno"]
                                 . " - Tel: " . $filaEmpleado["telefono"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay empleados con asistencia en la última fecha</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Descripción del problema -->
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <select id="descripcion" name="descripcion" required>
                    <option value="">Seleccione el tipo de falla</option>
                    <option value="Fuga de agua">Fuga de agua</option>
                    <option value="Reparación tubo surtidor">Reparación tubo surtidor</option>
                    <option value="Reparación de toma domiciliaria">Reparación de toma domiciliaria</option>
                    <option value="Reparación de válvula">Reparación de válvula</option>
                </select>
            </div>

            <button type="submit" class="submit-btn" name="registro">Enviar Reporte</button>
        </form>
    </section>

    <footer class="footer">
        <div class="footer_content">
            <div class="footer_section about">
                <h3>Sobre Blue Spring</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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

<?php
if (isset($_POST["registro"])) {
    $descripcion = $_POST["descripcion"];
    $cliente_idcliente = $_POST["cliente_idcliente"];
    $empleado_id = $_POST["empleado_id"];

    // Definir los costos preestablecidos
    $costos = [
        'Fuga de agua' => ['gasto_material' => 857.00, 'gasto_obra' => 342.80, 'gasto_total' => 1199.80],
        'Reparación tubo surtidor' => ['gasto_material' => 605.00, 'gasto_obra' => 242.00, 'gasto_total' => 847.00],
        'Reparación de toma domiciliaria' => ['gasto_material' => 513.50, 'gasto_obra' => 205.40, 'gasto_total' => 718.90],
        'Reparación de válvula' => ['gasto_material' => 412.00, 'gasto_obra' => 164.80, 'gasto_total' => 576.80],
    ];

    if (array_key_exists($descripcion, $costos)) {
        $gasto_material = $costos[$descripcion]['gasto_material'];
        $gasto_obra = $costos[$descripcion]['gasto_obra'];
        $gasto_total = $costos[$descripcion]['gasto_total'];

        // Insertar movimiento
        $insertarMovimiento = "INSERT INTO Movimiento (gasto_material, gasto_obra, gasto_total, cliente_idcliente, Empleados_idEmpleados) 
                               VALUES ('$gasto_material', '$gasto_obra', '$gasto_total', '$cliente_idcliente', '$empleado_id')";
        if ($conexion->query($insertarMovimiento)) {
            $idMovimiento = $conexion->insert_id; // Obtener el ID del movimiento recién insertado

            // Insertar materiales en la tabla Movimiento_has_Materiales
            foreach ($materiales_por_problema[$descripcion] as $material) {
                $material_name = $material['material'];
                $cantidad = $material['cantidad'];

                // Obtener el idMateriales correspondiente al material
                $consultaMaterial = "SELECT idMateriales FROM Materiales WHERE nombre_material = '$material_name'";
                $resultadoMaterial = $conexion->query($consultaMaterial);
                if ($resultadoMaterial->num_rows > 0) {
                    $filaMaterial = $resultadoMaterial->fetch_assoc();
                    $idMateriales = $filaMaterial['idMateriales'];

                    // Insertar en la tabla Movimiento_has_Materiales
                    $insertarMovimientoMaterial = "INSERT INTO Movimiento_has_Materiales (movimiento_idmovimiento, Materiales_idMateriales, cantidad) 
                                                   VALUES ('$idMovimiento', '$idMateriales', '$cantidad')";
                    $conexion->query($insertarMovimientoMaterial);
                }

                // Actualizar stock de materiales
                $actualizarStock = "UPDATE Materiales 
                                    SET stock = stock - $cantidad
                                    WHERE nombre_material = '$material_name'";

                $conexion->query($actualizarStock);
            }

            echo "<script>alert('Registro insertado correctamente, materiales actualizados y registrados en Movimiento_has_Materiales');</script>";
        } else {
            echo "<script>alert('Error al insertar el registro');</script>";
        }
    } else {
        echo "<script>alert('Tipo de reparación no válido');</script>";
    }
}

$conexion->close();
?>
