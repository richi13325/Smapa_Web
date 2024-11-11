<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "new_spring";

$conexion = new mysqli($server, $user, $pass, $db, "3307");

if ($conexion->connect_errno) {
    die("Conexión fallida: " . $conexion->connect_errno);
}

// Consulta SQL para obtener materiales y stock
$query = "SELECT idMateriales, nombre_material, stock FROM Materiales";
$result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMAPA</title>
    <link rel="stylesheet" href="/CSS/styles_almacen.css">
    <link rel="stylesheet" href="/CSS/styles_principal.css">
    <link rel="stylesheet" href="/CSS/normalizar.css">
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
    <main>
        <section class="material_container">
            <div class="material_box">
                <h2>Lista de materiales</h2>
                <ul class="ul_materiales">
                    <div class="h3_top">
                        <h3 class="Proveedor_name">Proveedor tal</h3>
                        <h3 class="cantidad_h3">Inventario</h3>
                    </div>

                    <?php
                    // Verificar si hay materiales en la base de datos
                    if ($result->num_rows > 0) {
                        // Recorrer los resultados y mostrarlos en HTML
                        while($row = $result->fetch_assoc()) {
                            echo "<li class='li_material'>";
                            echo "<span class='material_name'>" . $row["nombre_material"] . "</span>";
                            echo "<div class='button_container'>";
                            echo "<input type='number' class='cant_input' value='1' min='0' />";
                            echo "<span class='current_qty'>" . $row["stock"] . "</span>"; // Muestra el stock desde la base de datos
                            echo "<input type='hidden' class='material_id' value='" . $row['idMateriales'] . "' />"; // ID del material
                            echo "</div>";
                            echo "</li>";
                        }
                    } else {
                        echo "<p>No hay materiales en inventario.</p>";
                    }

                    // Cerrar la conexión a la base de datos
                    $conexion->close();
                    ?>

                </ul>   
                <div class="confirm_box">
                    <button class="confirm_button">Confirmar</button>
                </div>
            </div>
        </section>
    </main>
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

    <script>
    // Evento al hacer clic en el botón de confirmación
    document.querySelector('.confirm_button').addEventListener('click', function() {
        // Obtener todos los inputs de cantidad y su id de material
        const inputs = document.querySelectorAll('.cant_input');
        inputs.forEach(function(input) {
            const cantidad = input.value;
            const materialId = input.closest('.button_container').querySelector('.material_id').value;

            // Hacer la solicitud AJAX para actualizar el stock
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'actualizar_stock.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    const currentQty = input.closest('.button_container').querySelector('.current_qty');
                    currentQty.textContent = parseInt(currentQty.textContent) + parseInt(cantidad);
                }
            };
            
            xhr.send('idMateriales=' + materialId + '&cantidad=' + cantidad);
        });
    });
    </script>

</body>
</html>

