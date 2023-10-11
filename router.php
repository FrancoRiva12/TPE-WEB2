<?php
require 'config.php';

// Lee la acción de la URL
$action = 'home'; // Acción por defecto

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// Divide la acción en partes
$params = explode('/', $action);

// Determina qué página cargar según la acción
switch ($params[0]) {
    case 'home':
        include 'index.php'; // Cargar la página principal
        break;
    case 'detalle':
        include 'detalle.php'; // Cargar la página de detalle de ítem
        break;
    case 'items_por_categoria':
        include 'items_por_categoria.php'; // Cargar la página de ítems por categoría
        break;
    case 'login':
        include 'login.php'; // Cargar la página de inicio de sesión
        break;
    case 'mostrar':
        include 'mostrar.php'; // Cargar la página de muestra de placas de video
        break;
    default:
        echo '404 Page not found';
        break;
}
?>