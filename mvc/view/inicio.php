<!DOCTYPE html>
<html>

<head>
    <title>Bienvenido</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            color: white;
            background-color: black;
        }

        .linea {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            width: 30%;
            gap: 2rem;
        }

        a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            font-size: 1.2em;
            background-color: #e6e6e6;
            border-radius: 5px;
            height: 2rem;
            width: 10rem;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        a:hover {
            background-color: #d9d9d9;
        }
    </style>
</head>

<body>
    <h1>Bienvenido a NOTAS</h1>
    <p>Por favor, inicia sesión o regístrate para acceder al contenido.</p>
    <div class="linea">
        <a href="index.php?controller=login&action=index">Iniciar Sesión</a>
        <a href="index.php?controller=registro">Registrarse</a>
    </div>

</body>

</html>