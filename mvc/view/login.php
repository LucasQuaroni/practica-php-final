<!DOCTYPE html>
<html>

<head>
    <title>Iniciar Sesión</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
        }

        p {
            margin-top: 1rem;
        }

        body {
            background-color: black;
        }
    </style>
</head>

<body>
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
        <p>¿No tienes una cuenta? <a href="index.php?controller=registro&action=index">Registrarse</a></p>
    </form>
</body>

</html>