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

            $meses = array(
                1 => "Enero",
                2 => "Febrero",
                3 => "Marzo",
                4 => "Abril",
                5 => "Mayo",
                6 => "Junio",
                7 => "Julio",
                8 => "Agosto",
                9 => "Septiembre",
                10 => "Octubre",
                11 => "Noviembre",
                12 => "Diciembre"
            );

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
            $sumakgs = 0;

            if ($result->num_rows > 0) {
                echo "<p>Localidad Origen ó Destino: $localidad</p>";
                echo "<p>En el mes de: $meses[$mes] $anio</p>";
                echo "<table><tr><th>Día</th><th>Origen</th><th>Destino</th><th>Kilos</th></tr>";
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

                    $dia = date("d", strtotime($row["FecViaje"]));
                    if ($dia[0] == "0") {
                        $dia = $dia[1];
                    }
                    $sumakgs += $kgs;
                    echo "<tr><td>$dia</td><td>$origen</td><td>$destino</td><td>$kgs</td></tr>";
                }
                echo "<tr><td><b>TOTAL:</b></td><td></td><td></td><td><b>$sumakgs</b></td></tr>";
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