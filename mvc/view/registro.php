<!DOCTYPE html>
<html>

<head>
    <title>Registro de Usuario</title>
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
        <p>¿Ya tienes una cuenta? <a href="index.php?controller=login&action=index">Iniciar sesión</a></p>
    </form>
</body>

</html>