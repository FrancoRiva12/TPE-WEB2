<?php

require 'config.php';

// Lee la acción de la URL
$action = 'home'; // Acción por defecto

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// Divide la acción en partes
$params = explode('/', $action);

// Determina qué página o controlador cargar según la acción
$viewFolder = 'view/';
$controllerFolder = 'controller/';

switch ($params[0]) {
    case 'home':
        include 'index.php'; // Carga la página principal
        break;
    case 'detalle':
        include $viewFolder . 'detalle.php'; // Carga la página de detalle de ítem
        break;
    case 'items_por_categoria':
        include $viewFolder . 'items_por_categoria.php'; // Carga la página de ítems por categoría
        break;
    case 'login':
        include $viewFolder . 'login.php'; // Carga la página de inicio de sesión
        break;
    case 'mostrar':
        include $viewFolder . 'mostrar.php'; // Carga la página de muestra de placas de video
        break;
    case 'crear':
        include $controllerFolder . 'crear.php'; // Carga el controlador para crear ítems
        break;
    case 'eliminar':
        include $controllerFolder . 'eliminar.php'; // Carga el controlador para eliminar ítems
        break;
    case 'modificar':
        include $controllerFolder . 'modificar.php'; // Carga el controlador para modificar ítems
        break;
    case 'crear_categoria':
        include $controllerFolder . 'crear_categoria.php'; // Carga el controlador para crear categorías
        break;
    case 'eliminar_categoria':
        include $controllerFolder . 'eliminar_categoria.php'; // Carga el controlador para eliminar categorías
        break;
    case 'modificar_categoria':
        include $controllerFolder . 'modificar_categoria.php'; // Carga el controlador para modificar categorías
        break;
    default:
        echo '404 Page not found';
        break;
}
?>





