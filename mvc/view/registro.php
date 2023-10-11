<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <?php
    if (isset($data["error"])) {
        echo '<p style="color: red;">' . $data["error"] . '</p>';
    } elseif (isset($data["exito"])) {
        echo '<p style="color: green;">' . $data["exito"] . '</p>';
    }
    ?>
    <form method="post" action="index.php?controller=registro&action=registrar">
        <label for="nombre">Nombre de Usuario:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" id="clave" required>
        <br>
        <input type="submit" name="action" value="Registrar">
    </form>
    <p>¿Ya tienes una cuenta? <a href="index.php?controller=login">Iniciar sesión</a></p>
</body>
</html>
