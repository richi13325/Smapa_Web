<?php

$server="localhost";
$user="root";
$pass="";
$db="new_spring";

$conexion=new mysqli($server,$user,$pass,$db,"3307");

if ($conexion->connect_errno){
    die("conexion fallida". $conexion->connect_errno);
} else{
    //echo "conectado";
}

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
                        <li>
                            <a href="/HTML/inicio.php" id="selected"></a>
                        </li>
                        <li><a  class="link">Trámites y Servicios</a>
                            <ul>
                                <li><a href="/HTML/informe.php">Realizar</a></li>
                                <li><a href="/HTML/historial.php">Consultar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="link" href="/HTML/historial.php">Historial</a>
                        </li>
                        <li>
                            <a class="link" href="/HTML/Almacen.php">Almacen</a>
                        </li>
                        <li>
                            <a class="link" href="/HTML/Movimiento.php">Movimiento</a>
                        </li>
                        <li>
                            <a class="link" href="/HTML/Personal.php">Personal</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
        <section id="informe" class="container " >
            <h2>Informe de Fallas en Tuberías</h2>
            <p>Si detectas fallas en las tuberías de agua, por favor repórtalo completando el siguiente formulario:</p>
            
            <form action="#" name="ejemplo" method="post" class="styled-form">

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="" required>
                </div>
        
                <div class="form-group">
                    <label for="apellido-paterno">Apellido Paterno:</label>
                    <input type="text" id="apellido-paterno" name="apellido_paterno" placeholder="" required>
                </div>
        
                <div class="form-group">
                    <label for="apellido-materno">Apellido Materno:</label>
                    <input type="text" id="apellido-materno" name="apellido_materno" placeholder="" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Número de Celular:</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección de la Falla:</label>
                    <input type="text" id="direccion" name="direccion" placeholder="" required>
                </div>

                <div class="form-group">
                    <label for="colonia">Colonia:</label>
                    <select id="colonia" name="colonia" required>
                        <option value="">Selecciona una colonia</option>
                        <option value="albania_baja">Albania Baja</option>
                        <option value="albania_alta">Albania Alta</option>
                        <option value="caminera">Caminera</option>
                        <option value="capulines">Capulines</option>
                        <option value="cerro_hueco">Cerro Hueco</option>
                        <option value="colinas_del_sur">Colinas del Sur</option>
                        <option value="el_jobo">El Jobo</option>
                        <option value="el_retiro">El Retiro</option>
                        <option value="el_rosario">El Rosario</option>
                        <option value="el_vergel">El Vergel</option>
                        <option value="emiliano_zapata">Emiliano Zapata</option>
                        <option value="estrella_roja">Estrella Roja</option>
                        <option value="fovisste">Fovisste</option>
                        <option value="francisco_i_madero">Francisco I. Madero</option>
                        <option value="jardines_del_pedregal">Jardines del Pedregal</option>
                        <option value="jardines_de_tuxtla">Jardines de Tuxtla</option>
                        <option value="las_aguilas">Las Águilas</option>
                        <option value="las_arboledas">Las Arboledas</option>
                        <option value="las_granjas">Las Granjas</option>
                        <option value="las_palmas">Las Palmas</option>
                        <option value="los_manguitos">Los Manguitos</option>
                        <option value="los_pajaros">Los Pájaros</option>
                        <option value="los_presidentes">Los Presidentes</option>
                        <option value="moctezuma">Moctezuma</option>
                        <option value="paso_limon">Paso Limón</option>
                        <option value="patria_nueva">Patria Nueva</option>
                        <option value="plan_de_ayala">Plan de Ayala</option>
                        <option value="potinaspak">Potinaspak</option>
                        <option value="san_jose_teran">San José Terán</option>
                        <option value="san_pedro_progresivo">San Pedro Progresivo</option>
                        <option value="san_roque">San Roque</option>
                        <option value="santa_cruz">Santa Cruz</option>
                        <option value="teran">Terán</option>
                        <option value="villahermosa">Villahermosa</option>
                        <option value="xamaipak">Xamaipak</option>
                        <option value="zapata">Zapata</option>
                    </select>
                </div>
                

                <div class="form-group">
                    <label for="codigo-postal">Código Postal:</label>
                    <input type="text" id="codigo-postal" name="codigo_postal" placeholder="" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción del Problema:</label>
                <select id="descripcion" name="descripcion" required>
                    <option value="">Selecciona un problema</option>
                    <option value="fuga_agua">Fuga de agua</option>
                    <option value="reparacion_tubo_surtidor">Reparación de tubo surtidor</option>
                    <option value="reparacion_toma_domiciliaria">Reparación de toma domiciliaria</option>
                    <option value="reparacion_valvula">Reparación de válvula</option>
                </select>
                </div>
                
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" placeholder="" required>
                </div>

                <div class="form-group">
                    <label for="numero_tramite">Numero de Tramite:</label>
                    <input type="number" id="numero_tramite" name="numero_tramite" placeholder="" required>
                </div>

                <button type="submit" class="submit-btn" name="registro">Enviar Reporte</button>
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

<!-- Modal para mostrar después del envío -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span id="modal-text"></span>
        <br><br>
        <button class="close-btn" id="close-modal">Cerrar</button>
    </div>
</div>

            
</body>
</html>

<?php
if(isset($_POST["registro"])){
    $nombre=$_POST["nombre"];
    $apellido_paterno=$_POST["apellido_paterno"];
    $apellido_materno=$_POST["apellido_materno"];
    $telefono=$_POST["telefono"];
    $direccion=$_POST["direccion"];
    $colonia=$_POST["colonia"];
    $codigo_postal=$_POST["codigo_postal"];
    $descripcion=$_POST["descripcion"];
    $email=$_POST["email"];
    $numero_tramite=$_POST["numero_tramite"];
    
    $insertarDatos= "INSERT INTO cliente VALUES('','$nombre','$apellido_paterno','$apellido_materno','$telefono','$direccion','$colonia','$codigo_postal','$descripcion','$email', '$numero_tramite')";

    $ejecutarInsertar=mysqli_query($conexion,$insertarDatos);
}
?>