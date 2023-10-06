<!DOCTYPE html>
<html>

<head>
    <title>Gestión de Herramientas</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="linea">
        <h1>Lista de Herramientas</h1>
        <form method="post" action="">
            <button type="submit" name="generar">Generar</button>
        </form>
    </div>
    <table border="1">
        <tr>
            <th>Código</th>
            <th>Descripción</th>
            <th>Stock</th>
            <th>Cantidad Prestadas</th>
            <th>Cantidad Devueltas</th>
        </tr>
        <?php
        if (isset($_POST['generar'])) {
            $conexion = mysqli_connect("localhost", "root", "", "calculo");

            if (!$conexion) {
                die("Error en la conexión: " . mysqli_connect_error());
            }

            $query = "SELECT H.HerCod, H.HerDes, H.HerSto,
                            SUM(CASE WHEN M.MovCod = 0 THEN 1 ELSE 1 END) AS CantidadPrestadas,
                            SUM(CASE WHEN M.MovCod = 1 THEN 0 ELSE 1 END) AS CantidadNoDevueltas
                    FROM HERRAMIENTAS H
                    LEFT JOIN MOVIMIENTOS M ON H.HerCod = M.HerCod
                    GROUP BY H.HerCod, H.HerDes, H.HerSto";

            $result = mysqli_query($conexion, $query);

            while ($row = mysqli_fetch_assoc($result)) { //array asociativo
                $cantidadPrestadas = $row['CantidadPrestadas'];
                $cantidadNoDevueltas = $row['CantidadNoDevueltas'];

                $cantidadDevueltas = $cantidadPrestadas - $cantidadNoDevueltas;
                $stockActual = $row['HerSto'] - $cantidadPrestadas + $cantidadDevueltas;

                echo "<tr>";
                echo "<td>" . $row['HerCod'] . "</td>";
                echo "<td>" . $row['HerDes'] . "</td>";
                echo "<td>" . $stockActual . "</td>";
                echo "<td>" . $cantidadPrestadas . "</td>";
                echo "<td>" . $cantidadDevueltas . "</td>";
                echo "</tr>";
            }

            mysqli_close($conexion);
        }
        ?>
    </table>
</body>

</html>