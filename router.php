<?php
// Cargar la configuración
require 'config.php';

// Obtener la URL solicitada
$request_uri = $_SERVER['REQUEST_URI'];

// Analizar la URL para determinar la acción
$parts = explode('/', $request_uri);
$action = $parts[1]; // Obtener el primer segmento de la URL

// Enrutamiento simple
if ($action === 'detalle') {
    include 'detalle.php';
} elseif ($action === 'items_por_categoria') {
    include 'items_por_categoria.php';
} elseif ($action === 'login') {
    include 'login.php';
} elseif ($action === 'mostrar') {
    include 'mostrar.php';
} elseif ($action === 'otra_ruta') {
    include 'otra_ruta.php';
} else {
    include 'index.php'; // Página principal por defecto
}