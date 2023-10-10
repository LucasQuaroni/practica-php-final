<!DOCTYPE html>
<html>

<head>
    <title>Calculadora de Consumos</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Calculadora de Consumos</h1>
        <form method="post">
            <input type="submit" name="calcular" value="Calcular">
        </form>

        <?php
        if (isset($_POST['calcular'])) {
            $conexion = new mysqli("localhost", "root", "", "telefonia");

            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }

            $query_datos = "SELECT t.nomtit, SUM(c.cancon) AS total_datos
                            FROM CONSUMOS c
                            INNER JOIN TITULARES t ON c.numlin = t.numlin
                            WHERE c.concon = 'D'
                            GROUP BY t.nomtit
                            ORDER BY total_datos DESC
                            LIMIT 1";

            $result_datos = $conexion->query($query_datos);
            $row_datos = $result_datos->fetch_assoc();

            $query_telefonia = "SELECT t.nomtit, SUM(c.cancon) AS total_telefonia
                                FROM CONSUMOS c
                                INNER JOIN TITULARES t ON c.numlin = t.numlin
                                WHERE c.concon = 'T'
                                GROUP BY t.nomtit
                                ORDER BY total_telefonia DESC
                                LIMIT 1";

            $result_telefonia = $conexion->query($query_telefonia);
            $row_telefonia = $result_telefonia->fetch_assoc();

            $query_general = "SELECT t.nomtit, SUM(c.cancon) AS total_general
                             FROM CONSUMOS c
                             INNER JOIN TITULARES t ON c.numlin = t.numlin
                             GROUP BY t.nomtit
                             ORDER BY total_general DESC
                             LIMIT 1";

            $result_general = $conexion->query($query_general);
            $row_general = $result_general->fetch_assoc();

            $conexion->close();

            echo "<h2>El resultado es:</h2>";
            echo "<div class='resultado'>";
            echo $row_datos['nomtit'] . " fue quien más dinero consumió en <span class='datos'>datos.</span><br>";
            echo $row_telefonia['nomtit'] . " fue quien más dinero consumió en <span class='telefonia'> telefonía.</span><br>";
            echo $row_general['nomtit'] . " fue quien más dinero consumió en <span class='general'> general.</span><br>";
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>