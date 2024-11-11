<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "new_spring";

$conexion = new mysqli($server, $user, $pass, $db, "3307");

if ($conexion->connect_errno) {
    die("Conexión fallida: " . $conexion->connect_errno);
}

if (isset($_POST['idMateriales']) && isset($_POST['cantidad'])) {
    $idMateriales = $_POST['idMateriales'];
    $cantidad = $_POST['cantidad'];

    // Consulta SQL para actualizar el stock
    $query = "UPDATE Materiales SET stock = stock + ? WHERE idMateriales = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('ii', $cantidad, $idMateriales);

    if ($stmt->execute()) {
        echo "Stock actualizado correctamente";
    } else {
        echo "Error al actualizar stock: " . $stmt->error;
    }

    $stmt->close();
}

$conexion->close();
?>
