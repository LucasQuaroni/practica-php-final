<!-- Necestio un programa en PHP, mySQL como base de datos, y tambien html y css, que resuelva la siguiente consigna:
Una empresa tiene una sucursal en cada localidad diferente. No en todas las localidades tiene sucursal, pero en las que tiene, hay sólo una. Se dedica a realizar viajes periódicos entre cada sucursal llevando materiales. Para ello, cuenta con una base de datos donde asienta datos de los viajes realizados.  Base: TRAFICO.MDB  Tablas:   Ciudades contiene un registro por cada localidad en que la empresa realiza envíos. CodLoc (entero): código de la localidad. NomLoc (texto 30): nombre de la localidad.  Viajes contiene un registro por cada viaje realizado. LocOrigen (entero): código de localidad origen del viaje.  LocDestino (entero): código de localidad destino del viaje. Cantkg (simple): cantidad de kilos transportados en el viaje. FecViaje (dd/mm/aaaa): Fecha del viaje.  Realizar una aplicación que solicite una localidad, un mes y un año y liste todos los viajes que tuvieron como origen o destino esa localidad, acumulando la cantidad de kilos transportados, en el mes y año ingresados cuando la localidad sea destino y descuente los kilos cuando la localidad es origen.
Cuando una localidad es origen, o destino, en la tabla no debe aparecer su nombre, puesto que yas e da por sentado que ocupa este lugar. El casillero debe estar en blanco.-->
<!DOCTYPE html>
<html>

<head>
    <title>Lista de Viajes</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>

<body>
    <h1>Lista de Viajes</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="localidad">Localidad:</label>
        <input type="text" name="localidad" id="localidad" required>
        <br><br>
        <label for="mes">Mes:</label>
        <input type="number" name="mes" id="mes" min="1" max="12" required>
        <br><br>
        <label for="anio">Año:</label>
        <input type="number" name="anio" id="anio" min="1900" max="9999" required>
        <br><br>
        <input type="submit" value="Buscar">
    </form>
    <br>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $localidad = $_POST["localidad"];
        $mes = $_POST["mes"];
        $anio = $_POST["anio"];

        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "trafico";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta para obtener los viajes que tuvieron como origen o destino la localidad ingresada
        $sql = "SELECT LocOrigen, LocDestino, Cantkg, FecViaje FROM viajes WHERE (LocOrigen = (SELECT CodLoc FROM Ciudades WHERE NomLoc = '$localidad') OR LocDestino = (SELECT CodLoc FROM Ciudades WHERE NomLoc = '$localidad')) AND MONTH(FecViaje) = $mes AND YEAR(FecViaje) = $anio";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Tabla para mostrar los resultados
            echo "<table><tr><th>Origen</th><th>Destino</th><th>Kilos</th><th>Día</th></tr>";
            while ($row = $result->fetch_assoc()) {

                // Consulta para obtener el nombre de la localidad de origen
                $origen_query = "SELECT NomLoc FROM Ciudades WHERE CodLoc = " . $row["LocOrigen"];
                $origen_result = $conn->query($origen_query);
                $origen_row = $origen_result->fetch_assoc();
                $origen_nombre = $origen_row["NomLoc"];

                // Consulta para obtener el nombre de la localidad de destino
                $destino_query = "SELECT NomLoc FROM Ciudades WHERE CodLoc = " . $row["LocDestino"];
                $destino_result = $conn->query($destino_query);
                $destino_row = $destino_result->fetch_assoc();
                $destino_nombre = $destino_row["NomLoc"];

                // Verificar si la localidad ingresada es el origen o el destino
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
</body>

</html>