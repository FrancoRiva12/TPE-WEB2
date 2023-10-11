<?php
// config de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'placas_de_video');

//creamos pdo y lo llamamos cada vez que usemos config.php en un archivo
$pdo = new PDO('mysql:host=localhost;dbname=placas_de_video;charset=utf8', 'root', '');

?>