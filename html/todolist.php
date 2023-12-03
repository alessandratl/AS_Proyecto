<?php
// Iniciar sesión en PHP
session_start();

include("config.php");

// Verificar si el usuario está autenticado, redirigirlo a la página de inicio de sesión si no lo está
if (!isset($_SESSION['user_email'])) {
    header("Location: inicio_sesion.php");
    exit();
}

// Obtener el correo electrónico del usuario desde la sesión
$correo_usuario = $_SESSION['user_email'];

// Función para agregar una nueva tarea
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nueva_tarea'])) {
    $nueva_tarea = $_POST['nueva_tarea'];

    // Insertar la nueva tarea en la base de datos
    $sql_insert = "INSERT INTO Tareas (usuario_correo, tarea_descripcion) VALUES ('$correo_usuario', '$nueva_tarea')";
    $result_insert = mysqli_query($conn, $sql_insert);

    if (!$result_insert) {
        echo "Error al agregar la tarea.";
    }
}

// Función para marcar una tarea como completada
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['completar_tarea'])) {
    $id_tarea_completada = $_POST['completar_tarea'];

    // Actualizar el estado de completada en la tarea
    $sql_completar = "UPDATE Tareas SET completada = 1 WHERE id = $id_tarea_completada AND usuario_correo = '$correo_usuario'";
    $result_completar = mysqli_query($conn, $sql_completar);

    if (!$result_completar) {
        echo "Error al marcar la tarea como completada.";
    }
}

// Función para eliminar una tarea
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_tarea'])) {
    $id_tarea_eliminar = $_POST['eliminar_tarea'];

    // Eliminar la tarea de la base de datos
    $sql_eliminar = "DELETE FROM Tareas WHERE id = $id_tarea_eliminar AND usuario_correo = '$correo_usuario'";
    $result_eliminar = mysqli_query($conn, $sql_eliminar);
    if (!$result_eliminar) {
        echo "Error al eliminar la tarea.";
    }
}

// Función para cerrar sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cerrar_sesion'])) {
    // Destruir todas las variables de sesión
    session_unset();
    session_destroy();
    header("Location: index.html"); // Redirigir al usuario a index.html al cerrar sesión
    exit();
}

// Consulta para obtener las tareas asociadas al correo electrónico del usuario
$sql_tareas = "SELECT * FROM Tareas WHERE usuario_correo = '$correo_usuario'";
$result_tareas = mysqli_query($conn, $sql_tareas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="contenedor">
	<div class="col2">
		<div class="contenedor-form">
        
            
                
                <h2>Tareas del usuario: <?php echo $correo_usuario; ?></h2>
		
                    <!-- Formulario para agregar nueva tarea -->
                    <form action="" method="POST">
			<div class="entrada">
                        <label for="nueva_tarea">Nueva Tarea:</label>
			
                        <input type="text" id="nueva_tarea" name="nueva_tarea" required>
			
                        <input type="submit" value="Agregar">
                    </form>
		</div>

                    <!-- Mostrar lista de tareas -->
                    <ul>
                    <?php
                    if ($result_tareas) {
                        while ($row = mysqli_fetch_assoc($result_tareas)) {
                            $id_tarea = $row['id'];
                            $descripcion = $row['tarea_descripcion'];
                            $completada = $row['completada'] ? 'Completada' : 'Pendiente';

                            // Mostrar cada tarea con su descripción, estado y botones para completar o eliminar
                            echo "<li>$descripcion - $completada";
                            if (!$row['completada']) {
                                echo "<form action='' method='POST' style='display: inline;'>
                                        <input type='hidden' name='completar_tarea' value='$id_tarea'>
                                        <input type='submit' value='Completar'>
                                    </form>";
                            }
                            echo "<form action='' method='POST' style='display: inline;'>
                                    <input type='hidden' name='eliminar_tarea' value='$id_tarea'>
                                    <input type='submit' value='Eliminar'>
                                </form></li>";
                        }
                    } else {
                        echo "Error al obtener las tareas.";
                    }
                    ?>
                    </ul>

                    <!-- Formulario para cerrar sesión -->
                    <form action="" method="POST">
			
                        <input type="submit" name="cerrar_sesion" value="Cerrar Sesión">
                   	
		    </form>
		   
                    <button type="button" onclick="redirectToFestivos()">Festivos</button>
		  
                
            </div>
		
            </div>
       </div> 
    </div>
    <script>
        function redirectToFestivos() {
            // Redirige a la página de registro
            window.location.href = "Festivos.html";
        }    
    </script>
</body>

</html>

<?php
mysqli_close($conn);
?>
