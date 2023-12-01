<?php
// Iniciar sesión en PHP
session_start();

include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    if (!$conn) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

    // Asegurarse de escapar los datos para evitar inyecciones SQL
    $correo = mysqli_real_escape_string($conn, $correo);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM Usuarios WHERE correo = '$correo' AND contrasena = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Usuario autenticado correctamente, almacenar correo en la sesión
        $_SESSION['user_email'] = $correo;

        // Redirigir a la página de tareas
        header("Location: todolist.php");
        exit();
    } else {
        echo "Credenciales incorrectas. Intenta nuevamente.";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>IniciarSesion</title>
</head>
<body>
    <div class="contenedor">
        <div class="col2">
            <div class="info">
                <div class="contenedor-form">
                    <h2>Iniciar Sesión</h2>
                    <form action="" method="POST">
                        <div class="entrada">
                            <label for="correo">Correo Electrónico</label>
                            <input type="email" id="correo" name="correo" required><br><br>
                        </div>
                        <div class="entrada">
                            <label for="password">Contraseña</label>
                            <input type="password" id="password" name="password" required><br><br>
                        </div>

                        <input type="submit" value="Iniciar Sesión">
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
