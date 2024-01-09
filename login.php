<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Iniciar Sesión</title>
</head>

<body>

    <div class="container mt-5">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center">Iniciar Sesión</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" class="form-control" id="correo" name="correo"
                        placeholder="Ingrese su correo electrónico" required>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena"
                        placeholder="Ingrese su contraseña" required>
                </div>
                <button type="submit" class="btn btn-warning btn-block">Iniciar Sesión</button>
                <a href="registro.php">Registrate</a>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

<?php

// Inicializar la variable $mensaje
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : null;

// Mostrar el mensaje si no es nulo
if($mensaje !== null) {
    echo $mensaje;
}

session_start(); // Inicia la sesión en la parte superior del script

require_once 'conexion.php';

// Procesar el formulario cuando se envíe
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['contrasena'];

    try {
        // Obtener la información del usuario basada en el correo
        $stmt = $conexion_PDO->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar la contraseña
        if($usuario && password_verify($password, $usuario['contrasena'])) {
            // La contraseña es válida

            // Establecer variables de sesión
            $_SESSION['correo'] = $usuario['correo'];
            $_SESSION['rol'] = $usuario['rol'];

            // Establecer el tiempo de la última actividad
            $_SESSION['last_activity'] = time();

            // Redirigir según el rol
            if($usuario['rol'] == 'admin') {
                header("Location: admin.php");
                exit();
            } elseif($usuario['rol'] == 'usuarios') {
                header("Location: usuarios.php");
                exit();
            }
        } else {
            // La contraseña es incorrecta
            echo "Correo o contraseña incorrectos.";
        }
    } catch (PDOException $e) {
        echo "Error al iniciar sesión: ".$e->getMessage();
    }
}
?>