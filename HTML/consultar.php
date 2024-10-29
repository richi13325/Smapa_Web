<?php
include('conexion.php'); // Asegúrate de que la conexión esté bien configurada

// Consulta para obtener todos los reportes
$query = "SELECT * FROM reportes";
$result = mysqli_query($conex, $query);

if ($result) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Celular</th>
            <th>Dirección</th>
            <th>Colonia</th>
            <th>Código Postal</th>
            <th>Descripción del Problema</th>
            <th>Correo Electrónico</th>
          </tr>";

    // Mostrar cada registro en una fila de la tabla
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['nombre']}</td>
                <td>{$row['apellido_paterno']}</td>
                <td>{$row['apellido_materno']}</td>
                <td>{$row['celular']}</td>
                <td>{$row['direccion']}</td>
                <td>{$row['colonia']}</td>
                <td>{$row['codigo_postal']}</td>
                <td>{$row['descripcion_problema']}</td>
                <td>{$row['email']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Error al consultar los datos: " . mysqli_error($conex);
}
?>
