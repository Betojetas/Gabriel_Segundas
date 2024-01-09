<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if(!isset($_SESSION['correo']) || $_SESSION['rol'] !== 'usuarios') {
    // Si no ha iniciado sesión o no tiene el rol de usuario, redirigir a login.php
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

// Resto del contenido de usuario.php aquí
//echo "Bienvenido, usuario!";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Navbar Usuario</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <a class="navbar-brand" href="#">Viajes a Buenos Aires</a>

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
                    <a class="nav-link" href="#">Tours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Alojamientos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cerrar.php">Cerrar sesion</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container mt-5">
        <h1 class="text-center mb-4">Viajes a Buenos Aires</h1>

        <div class="row">
            <div class="col-md-6">
                <img src="https://traveler.marriott.com/es/wp-content/uploads/sites/2/2019/04/GI-968387654-Nightlife-header.jpg"
                    class="img-fluid" alt="Buenos Aires">
            </div>
            <div class="col-md-6">
                <h2>Explora la Ciudad</h2>
                <p>Descubre los encantos de Buenos Aires, desde sus barrios históricos hasta sus modernos distritos
                    comerciales.</p>
                <a href="#" class="btn btn-warning btn-block">Ver más</a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h2>Disfruta de la Gastronomía</h2>
                <p>Prueba la deliciosa comida argentina y disfruta de la variada oferta gastronómica que Buenos Aires
                    tiene para ofrecer.</p>
                <a href="#" class="btn btn-warning btn-block">Ver más</a>
            </div>
            <div class="col-md-6">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT68wfb2Gjq9j6jq_5YvRg06Q7KL4KGQb7ltg&usqp=CAU"
                    class="img-fluid" alt="Gastronomía en Buenos Aires">
            </div>
        </div>
    </div>


    <br>
    <br><br>
    <div id="map"></div>
    <script src="script.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap"></script>
    <!-- Tu contenido aquí -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>