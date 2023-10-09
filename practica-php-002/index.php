<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - 002</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="linea">
        <h1 class="titulo">Concesionaria</h1>
        <form method="post" action="">
            <button type="submit" name="generar">Consultar</button>
        </form>
    </div>

    <?php
    if (isset($_POST['generar'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "concesionaria";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta SQL para obtener el capital acumulado por marca
        $sql = "SELECT Marca, SUM(PrecioVenta) AS CapitalAcumulado FROM autos GROUP BY Marca";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar los resultados en una tabla
            echo "<table border='1'><tr><th>Marca</th><th>Capital Acumulado</th></tr>";
            while ($row = $result->fetch_assoc()) {
                $capitalFormateado = "$" . number_format($row["CapitalAcumulado"], 0, ".", ".");
                echo "<tr><td>" . $row["Marca"] . "</td><td>" . $capitalFormateado . "</td></tr>";
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