<!DOCTYPE html>
<html>

<head>
    <title>Actualizar Agentes</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Actualizar Agentes</h1>
        <form method="post">
            <input type="submit" name="actualizar" value="Actualizar Agentes" class="input">
        </form>
        <?php
        if (isset($_POST['actualizar'])) {
            $conexion = new mysqli("localhost", "root", "", "callcenter");

            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }

            $query_actualizar_atendidas = "UPDATE agentes a
                                          SET a.ageCantidadAtendida = (
                                              SELECT COUNT(*) FROM entrantes e
                                              WHERE e.ageCodigo = a.ageCodigo
                                          )";
            $conexion->query($query_actualizar_atendidas);

            $query_actualizar_recibidas = "UPDATE agentes a
                                          SET a.ageCantidadRecibida = (
                                              SELECT COUNT(*) FROM salientes s
                                              WHERE s.ageCodigo = a.ageCodigo
                                          )";
            $conexion->query($query_actualizar_recibidas);

            $query_listado = "SELECT ageNombre, ageCantidadAtendida, ageCantidadRecibida
                             FROM agentes
                             WHERE ageActivo = 1
                             AND ageCantidadRecibida < ageCantidadAtendida";
            $result_listado = $conexion->query($query_listado);

            echo "<h2>Listado de Agentes Activos con más llamadas recibidas que realizadas:</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Nombre del Agente</th><th>Llamadas Recibidas</th><th>Llamadas Realizadas</th></tr>";

            while ($row = $result_listado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ageNombre'] . "</td>";
                echo "<td>" . $row['ageCantidadAtendida'] . "</td>";
                echo "<td>" . $row['ageCantidadRecibida'] . "</td>";
                echo "</tr>";
            }

            echo "</table> <br>";
            $conexion->close();
        }
        ?>
        <br>
        <a href="index.php">VOLVER</a>
    </div>
</body>

</html>