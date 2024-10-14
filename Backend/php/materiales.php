<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener datos del POST
$datos = json_decode(file_get_contents('php://input'), true);

if ($datos) {
    foreach ($datos as $material => $cantidad) {
        // Consulta para insertar o actualizar las cantidades
        $sql = "INSERT INTO materiales (nombre, cantidad) 
                VALUES ('$material', $cantidad)
                ON DUPLICATE KEY UPDATE cantidad = $cantidad";

        if ($conn->query($sql) === TRUE) {
            $respuesta = ["message" => "Datos guardados correctamente"];
        } else {
            $respuesta = ["error" => "Error: " . $sql . "<br>" . $conn->error];
        }
    }
    // Enviar la respuesta como JSON
    echo json_encode($respuesta);
}
?>
