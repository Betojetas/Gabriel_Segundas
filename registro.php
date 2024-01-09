<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Formulario de Registro</title>
</head>

<body>

    <div class="container mt-5">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center">Formulario de Registro</h2>
            <form method="post">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre"
                        required>
                </div>
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
                <button type="submit" class="btn btn-warning btn-block">Registrar</button>
                <a href="login.php">login</a>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
<?php
require_once 'conexion.php';

// Procesar el formulario cuando se envíe
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena']; // Cambié el nombre para que coincida con el formulario HTML
    $nombre = $_POST['nombre']; // Agregué el campo nombre desde el formulario

    // Encriptar la contraseña utilizando password_hash
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    try {
        $rol = "usuarios"; // Puedes cambiar esto según el valor real del rol o pasarlo como un campo del formulario
        $stmt = $conexion_PDO->prepare("INSERT INTO usuarios (correo, contrasena, nombre, rol) VALUES (?, ?, ?, ?)");
        $stmt->execute([$correo, $hashed_password, $nombre, $rol]);

        echo "Usuario registrado exitosamente.";
    } catch (PDOException $e) {
        echo "Error al registrar el usuario: ".$e->getMessage();
    }
}
?>