<?php
session_start();

// Destruye la sesión
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cierre de Sesión</title>
</head>
<body>

<h2>Cerraste la Sesión</h2>
<p>Tu sesión se ha cerrado exitosamente.</p>

<a href="login.php">Volver a Iniciar Sesión</a>

</body>
</html>