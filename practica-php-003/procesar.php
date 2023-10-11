<?php
$mysqli = new mysqli("localhost", "root", "", "colegio");

if ($mysqli->connect_error) {
    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
}

$query = "
SELECT
    A.AluNombre,
    COUNT(E.ExaFecha) AS VecesRendidas,
    SUM(CASE WHEN E.ExaNota >= 6 THEN 1 ELSE 0 END) AS Aprobados,
    SUM(CASE WHEN E.ExaNota >= 6 THEN E.ExaNota ELSE 0 END) / SUM(CASE WHEN E.ExaNota >= 6 THEN 1 ELSE 0 END) AS PromedioAprobados
FROM
    ALUMNOS A
LEFT JOIN
    EXAMENES E ON A.AluLegajo = E.AluLegajo
LEFT JOIN
    DOCENTES D ON E.DocDocente = D.DocDocente
LEFT JOIN
    ASIGNATURAS ASI ON E.AsiAsignatura = ASI.AsiAsignatura
GROUP BY
    A.AluNombre
ORDER BY
    A.AluNombre;
";

$resultado = $mysqli->query($query);
$general = 0;

$informe = "<h2>Informe de Alumnos</h2>";
$informe .= "<table border='1'>";
$informe .= "<tr>";
$informe .= "<th>NOMBRE DEL ALUMNO</th>";
$informe .= "<th>CANTIDAD DE VECES RENDIDAS</th>";
$informe .= "<th>CANTIDAD DE APROBADOS</th>";
$informe .= "<th>PROMEDIO (aprob)</th>";
$informe .= "</tr>";
$informe .= "<br>";


while ($fila = $resultado->fetch_assoc()) {
    $informe .= "<tr>";
    $informe .= "<td>" . $fila['AluNombre'] . "</td>";
    $informe .= "<td>" . $fila['VecesRendidas'] . "</td>";
    $informe .= "<td>" . $fila['Aprobados'] . "</td>";

    if ($fila['Aprobados'] > 0) {
        $informe .= "<td>" . number_format($fila['PromedioAprobados'], 2) . "</td>";
    } else {
        $informe .= "<td>No aplica</td>";
    }

    $informe .= "</tr>";
    $general += number_format($fila['PromedioAprobados'], 2) / $resultado->num_rows;
}

$sumaAlumnos = $resultado->num_rows;
$promGral = number_format($general, 2);

$informe .= "</table>";
$informe .= "<p>Total de Alummnos: $sumaAlumnos</p>";
$informe .= "<p>Promedio de aprobados general: $promGral</p>";

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Informe de Alumnos</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="informe">
        <?php echo $informe; ?>
    </div>
    <br>
    <a href="index.html">VOLVER</a>
</body>

</html>