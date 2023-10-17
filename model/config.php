<?php
// config de la base de datos
if (!defined('DB_HOST')) {
    define('DB_HOST', 'tu_host');
}
if (!defined('DB_USER')) {
    define('DB_USER', 'tu_usuario');
}
if (!defined('DB_PASS')) {
    define('DB_PASS', 'tu_contraseña');
}
if (!defined('DB_NAME')) {
    define('DB_NAME', 'tu_base_de_datos');
}

//creamos pdo y lo llamamos cada vez que usemos config.php
$pdo = new PDO('mysql:host=localhost;dbname=placas_de_video;charset=utf8', 'root', '');

?>