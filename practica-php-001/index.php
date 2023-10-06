<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Viajes</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container">
        <h1>Consulta de Viajes</h1>
        <form action="" method="POST">
            <div class="linea">
                <label for="localidad">Localidad:</label>
                <input type="text" id="localidad" name="localidad" required />
            </div>
            <div class="linea">
                <label for="mes">Mes:</label>
                <input type="number" id="mes" name="mes" required />
            </div>
            <div class="linea">
                <label for="anio">Año:</label>
                <input type="number" id="anio" name="anio" required />
            </div>
            <input type="submit" value="Consultar" />
        </form>

        <table>
            <caption>
                Resumen de viajes
            </caption>
            <tr>
                <th>Origen/Destino</th>
                <th>Cantidad de Kilos</th>
            </tr>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Obtener los valores del formulario
                $localidad = $_POST['localidad'];
                $mes = $_POST['mes'];
                $anio = $_POST['anio'];

                // Conectarse a la base de datos (ajusta los valores según tu configuración)
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "trafico";

                $conn = mysqli_connect($servername, $username, $password, $dbname);

                if (!$conn) {
                    die("Conexión fallida: " . mysqli_connect_error());
                }

                // Consulta SQL para obtener la cantidad de kilos según los criterios
                $sql = "SELECT
                            CASE
                                WHEN LocOrigen = '$localidad' THEN 'Origen'
                                WHEN LocDestino = '$localidad' THEN 'Destino'
                            END AS OrigenDestino,
                            SUM(CASE WHEN LocDestino = '$localidad' THEN Cantkg ELSE -Cantkg END) AS TotalKilos
                        FROM Viajes
                        WHERE MONTH(FecViaje) = '$mes' AND YEAR(FecViaje) = '$anio'
                        AND ('$localidad' = LocOrigen OR '$localidad' = LocDestino)
                        GROUP BY OrigenDestino";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['OrigenDestino'] . "</td>";
                        echo "<td>" . $row['TotalKilos'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Error en la consulta: " . mysqli_error($conn);
                }

                mysqli_close($conn);
            }
            ?>
        </table>
    </div>
</body>

</html>