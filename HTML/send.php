<?php
include('conexion.php'); // Asegúrate de que la conexión esté bien configurada

if (isset($_POST['send'])) {
    // Verificar que los campos no estén vacíos
    if (
        strlen($_POST['nombre']) >= 1 &&
        strlen($_POST['apellido-paterno']) >= 1 &&
        strlen($_POST['apellido-materno']) >= 1 &&
        strlen($_POST['celular']) >= 1 &&
        strlen($_POST['direccion']) >= 1 &&
        strlen($_POST['colonia']) >= 1 &&
        strlen($_POST['codigo-postal']) >= 1 &&
        strlen($_POST['descripcion']) >= 1 &&
        strlen($_POST['email']) >= 1
    ) {
        // Obtener los datos del formulario
        $nombre = trim($_POST['nombre']);
        $apellidoPaterno = trim($_POST['apellido-paterno']);
        $apellidoMaterno = trim($_POST['apellido-materno']);
        $celular = trim($_POST['celular']);
        $direccion = trim($_POST['direccion']);
        $colonia = trim($_POST['colonia']);
        $codigoPostal = trim($_POST['codigo-postal']);
        $descripcion = trim($_POST['descripcion']);
        $email = trim($_POST['email']);

        // Insertar los datos en la base de datos
        $consulta = "INSERT INTO reportes (nombre, apellido_paterno, apellido_materno, celular, direccion, colonia, codigo_postal, descripcion_problema, email)
                    VALUES ('$nombre', '$apellidoPaterno', '$apellidoMaterno', '$celular', '$direccion', '$colonia', '$codigoPostal', '$descripcion', '$email')";

        $resultado = mysqli_query($conex, $consulta);

        if ($resultado) {
            echo '<h3 class="success">Tu registro se ha completado</h3>';
        } else {
            echo '<h3 class="error">Ocurrió un error: ' . mysqli_error($conex) . '</h3>';
        }
    } else {
        echo '<h3 class="error">Llena todos los campos</h3>';
    }
}
?>