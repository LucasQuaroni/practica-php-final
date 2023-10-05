<?php
// Datos de conexión a la base de datos MySQL
$servername = "localhost"; // Cambia esto por la dirección de tu servidor MySQL
$username = "root";
$password = "";
$dbname = "trafico"; // Cambia esto por el nombre de tu base de datos

// Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener los valores del formulario
$localidad = $_POST['localidad'];
$mes = $_POST['mes'];
$anio = $_POST['anio'];

// Consulta SQL para obtener los resultados
$sql = "SELECT FecViaje, LocOrigen, LocDestino, Cantkg
        FROM Viajes
        WHERE (LocOrigen = '$localidad' OR LocDestino = '$localidad') 
        AND MONTH(FecViaje) = '$mes' AND YEAR(FecViaje) = '$anio'";

$result = mysqli_query($conn, $sql);

// Calcular el total de kilos
$totalKilos = 0;

// Mostrar los resultados en la tabla
while ($row = mysqli_fetch_assoc($result)) {
    $fecha = $row['FecViaje'];
    $origen = $row['LocOrigen'];
    $destino = $row['LocDestino'];
    $kilos = $row['Cantkg'];
    $totalKilos += ($destino == $localidad) ? $kilos : -$kilos;

    echo "<tr>";
    echo "<td>" . date("d", strtotime($fecha)) . "</td>";
    echo "<td>" . $origen . "</td>";
    echo "<td>" . $destino . "</td>";
    echo "<td>" . number_format($kilos, 2) . "</td>";
    echo "</tr>";
}

echo "<tr>";
echo "<td colspan='3'>TOTAL</td>";
echo "<td>" . number_format($totalKilos, 2) . "</td>";
echo "</tr>";

mysqli_close($conn);
?>
