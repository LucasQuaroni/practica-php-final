<!DOCTYPE html>
<html>

<head>
    <title>Calcular Porcentaje</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Calcular Porcentaje</h1>
        <form method="post">
            <label for="agente_seleccionado">Selecciona un agente:</label>
            <select name="agente_seleccionado">
                <?php
                $conexion = new mysqli("localhost", "root", "", "callcenter");

                if ($conexion->connect_error) {
                    die("Error de conexión a la base de datos: " . $conexion->connect_error);
                }

                $query_agentes = "SELECT ageCodigo, ageNombre, ageActivo FROM agentes";
                $result_agentes = $conexion->query($query_agentes);

                while ($row = $result_agentes->fetch_assoc()) {
                    echo "<option value='" . $row['ageCodigo'] . "'>" . $row['ageNombre'] . "</option>";
                }

                $conexion->close();
                ?>
            </select>
            <input type="submit" name="calcular_porcentaje" value="Calcular Porcentaje" class="input">
        </form>
        <?php
        if (isset($_POST['calcular_porcentaje'])) {
            $conexion = new mysqli("localhost", "root", "", "callcenter");

            if ($conexion->connect_error) {
                die("Error de conexión a la base de datos: " . $conexion->connect_error);
            }

            $agente_seleccionado = $_POST['agente_seleccionado'];

            $query_estado_agente = "SELECT ageActivo, ageNombre FROM agentes WHERE ageCodigo = $agente_seleccionado";
            $result_estado_agente = $conexion->query($query_estado_agente);
            $agente_data = $result_estado_agente->fetch_assoc();
            $estado_agente = $agente_data['ageActivo'];
            $nombre_agente = $agente_data['ageNombre'];

            if ($estado_agente != 1) {
                echo "<h2>Porcentaje de Llamadas Atendidas del Agente: $nombre_agente</h2>";
                echo "NO SE PUEDE CALCULAR PORCENTAJE DE AGENTE INACTIVO <br>";
            } else {
                $query_total_llamadas = "SELECT SUM(ageCantidadRecibida) AS total_llamadas FROM agentes WHERE ageActivo = 1";
                $result_total_llamadas = $conexion->query($query_total_llamadas);
                $total_llamadas = $result_total_llamadas->fetch_assoc()['total_llamadas'];

                $query_llamadas_atendidas = "SELECT ageCantidadRecibida FROM agentes WHERE ageCodigo = $agente_seleccionado";
                $result_llamadas_atendidas = $conexion->query($query_llamadas_atendidas);
                $llamadas_atendidas = $result_llamadas_atendidas->fetch_assoc()['ageCantidadRecibida'];

                $porcentaje = ($llamadas_atendidas / $total_llamadas) * 100;

                echo "<h2>Porcentaje de Llamadas Atendidas del Agente: $nombre_agente</h2>";
                echo "El agente seleccionado atendió el " . round($porcentaje, 2) . "% de las llamadas. <br><br>";
            }

            $conexion->close();
        }
        ?>
        <br>
        <a href="index.php">VOLVER</a>
    </div>
</body>

</html>