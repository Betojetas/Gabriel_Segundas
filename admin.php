<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if(!isset($_SESSION['correo']) || $_SESSION['rol'] !== 'admin') {
    // Si no ha iniciado sesión o no tiene el rol de admin, redirigir a login.php
    header("Location: login.php");
    exit();
}

// Verificar la inactividad
$inactivity_timeout = 200; // segundos
$last_activity = isset($_SESSION['last_activity']) ? $_SESSION['last_activity'] : 0;

if(time() - $last_activity > $inactivity_timeout) {
    // Si ha pasado el tiempo de inactividad, destruir la sesión y redirigir a login.php
    session_unset();
    session_destroy();
    header("Location: login.php?mensaje=Tu+sesion+ha+expirado");
    exit();
}

// Actualizar el tiempo de la última actividad
$_SESSION['last_activity'] = time();

// Resto del contenido de admin.php aquí
//echo "Bienvenido, admin!";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Panel de Administrador</title>

    <style>
        .yellow-bg {
            background-color: wheat;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-warning bg-warning">
        <a class="navbar-brand" href="#">Admin Panel</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Configuración</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cerrar.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Bienvenido al Panel de Administrador</h2>

        <div class="row mt-4">
            <div class="col-md-6 yellow-bg">
                <a href="#" class="text-white d-block p-4">
                    <h3>Estadísticas</h3>
                    <p>Revisa las estadísticas clave de la aplicación, como el número de usuarios, reservas realizadas,
                        etc.</p>
                </a>
            </div>
            <div class="col-md-6">
                <a href="#" class="d-block p-4">
                    <h3>Gestión de Usuarios</h3>
                    <p>Administra los usuarios de la aplicación, agrega nuevos usuarios, actualiza información, y
                        más.</p>
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <a href="#" class="d-block p-4">
                    <h3>Configuración</h3>
                    <p>Configura opciones de la aplicación, como preferencias generales, opciones de pago, etc.</p>
                </a>
            </div>
            <div class="col-md-6 yellow-bg">
                <a href="#" class="text-white d-block p-4">
                    <h3>Reportes</h3>
                    <p>Genera y revisa informes sobre el rendimiento de la aplicación y actividades recientes.</p>
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>