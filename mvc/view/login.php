<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <?php
    if (isset($data["error"])) {
        echo '<p style="color: red;">' . $data["error"] . '</p>';
    }
    ?>
    <form method="post" action="index.php?controller=login&action=iniciarSesion">
        <label for="nombre">Nombre de Usuario:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" id="clave" required>
        <br>
        <input type="submit" name="action" value="Iniciar Sesión">
    </form>
    <p>¿No tienes una cuenta? <a href="index.php?controller=registro">Registrarse</a></p>
</body>
</html>
