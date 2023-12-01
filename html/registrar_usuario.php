<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    if (!$conn) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO Usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Error al preparar la consulta SQL: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "sss", $nombre, $correo, $password);
    
    if (mysqli_stmt_execute($stmt)) {
        // Usuario autenticado correctamente, almacenar correo en la sesió
        $_SESSION['user_email'] = $correo;
        // Redirigir después de un registro exitoso
        header("Location: todolist.php");
        exit();
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }

    if ($registro_exitoso) {
        header("Location: index.html?registroExitoso=true");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name= "viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Registro de Usuarios</title>
</head>
<body>
    <div class= "contenedor">
        <div class = "col2">
                <div class = "info">
                        <div class="contenedor-form"
                                <h2>Registrarse</h2>
                                <form action="registrar_usuario.php" method="POST">
                                        <div class = "entrada">
                                                <label for="nombre">Nombre Completo</label>
                                                <input type="text" id="nombre" name="nombre" required><br><br>
                                        </div>
                                        <div class="entrada">
                                                <label for="correo">Correo Electrónico</label>
                                                <input type="email" id="correo" name="correo" required><br><br>
                                        </div>
                                        <div class="entrada">

                                                <label for="password">Contraseña</label>
                                                <input type="password" id="password" name="password" required><br><br>
                                        </div>
                                        <input type="submit" value="Registrarse">
                                 </form>
                         </div>

                </div>
         </div>
    </div>
</body>
</html>
