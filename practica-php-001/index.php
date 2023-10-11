<!DOCTYPE html>
<html>

<head>
    <title>Lista de Viajes</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container">
        <h1>Lista de Viajes</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="linea">
                <label for="localidad">Localidad:</label>
                <input type="text" name="localidad" id="localidad" required>
            </div>
            <div class="linea">
                <label for="mes">Mes:</label>
                <input type="number" name="mes" id="mes" min="1" max="12" required>
            </div>
            <div class="linea">
                <label for="anio">Año:</label>
                <input type="number" name="anio" id="anio" min="1900" max="9999" required>
            </div>
            <input id="buscar" type="submit" value="Buscar">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $localidad = $_POST["localidad"];
            $mes = $_POST["mes"];
            $anio = $_POST["anio"];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "trafico";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $sql = "SELECT LocOrigen, LocDestino, Cantkg, FecViaje FROM viajes WHERE (LocOrigen = (SELECT CodLoc FROM Ciudades WHERE NomLoc = '$localidad') OR LocDestino = (SELECT CodLoc FROM Ciudades WHERE NomLoc = '$localidad')) AND MONTH(FecViaje) = $mes AND YEAR(FecViaje) = $anio";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<p>Resultados para la localidad de $localidad, en el período $mes/$anio:</p>";
                echo "<table><tr><th>Origen</th><th>Destino</th><th>Kilos</th><th>Día</th></tr>";
                while ($row = $result->fetch_assoc()) {

                    $origen_query = "SELECT NomLoc FROM Ciudades WHERE CodLoc = " . $row["LocOrigen"];
                    $origen_result = $conn->query($origen_query);
                    $origen_row = $origen_result->fetch_assoc();
                    $origen_nombre = $origen_row["NomLoc"];

                    $destino_query = "SELECT NomLoc FROM Ciudades WHERE CodLoc = " . $row["LocDestino"];
                    $destino_result = $conn->query($destino_query);
                    $destino_row = $destino_result->fetch_assoc();
                    $destino_nombre = $destino_row["NomLoc"];

                    if ($origen_nombre == $localidad) {
                        $origen = "";
                        $kgs = -$row["Cantkg"];
                    } else {
                        $origen = $origen_nombre;
                        $kgs = $row["Cantkg"];
                    }

                    if ($destino_nombre == $localidad) {
                        $destino = "";
                    } else {
                        $destino = $destino_nombre;
                    }

                    echo "<tr><td>$origen</td><td>$destino</td><td>$kgs</td><td>" . date("d", strtotime($row["FecViaje"])) . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron resultados.";
            }

            $conn->close();
        }
        ?>
    </div>
</body>

</html>