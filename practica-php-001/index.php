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
                $localidad = $_POST['localidad'];
                $mes = $_POST['mes'];
                $anio = $_POST['anio'];

                $db = new PDO("mysql:host=localhost;dbname=trafico", "root", "");

                $sql = "SELECT
                            CASE
                                WHEN LocOrigen = :loc THEN 'Origen'
                                WHEN LocDestino = :loc THEN 'Destino'
                            END AS OrigenDestino,
                            SUM(CASE WHEN LocDestino = :loc THEN Cantkg ELSE -Cantkg END) AS TotalKilos
                        FROM Viajes
                        WHERE MONTH(FecViaje) = :mes AND YEAR(FecViaje) = :anio
                        AND (:loc = LocOrigen OR :loc = LocDestino)
                        GROUP BY OrigenDestino";

                $stmt = $db->prepare($sql);
                $stmt->bindParam(":loc", $localidad, PDO::PARAM_INT);
                $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
                $stmt->bindParam(":anio", $anio, PDO::PARAM_INT);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['OrigenDestino'] . "</td>";
                    echo "<td>" . $row['TotalKilos'] . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>
</body>
</html>
